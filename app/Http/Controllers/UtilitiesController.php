<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kelurahan;
use App\RukunWarga;
use App\TPS;
use App\Voting;
use App\VotingDetail;
use DB;

class UtilitiesController extends Controller
{
	public function dataMapping($data){
		$result = collect([]);
		foreach ($data as $d) {
			$result->push([
				'id' => $d->id,
				'text' => $d->name,
			]);
		}
		return $result;
	}

    public function getDataKecamatan()
    {
    	$data = Kecamatan::all();
    	return $this->dataMapping($data);
    }

    public function getDataKelurahan($parent_id=null)
    {
    	$data = Kelurahan::when($parent_id!=null,function($query) use($parent_id){
    		return $query->where('kecamatan_id',$parent_id);
    	})->get();

    	return $this->dataMapping($data);
    }

    public function getDataRukunWarga($parent_id=null)
    {
    	$data = RukunWarga::when($parent_id!=null,function($query) use($parent_id){
    		return $query->where('kelurahan_id',$parent_id);
    	})->get();

    	return $this->dataMapping($data);
    }

    public function getDataRukunTetangga($parent_id=null)
    {
    	$data = RukunTetangga::when($parent_id!=null,function($query) use($parent_id){
    		return $query->where('rukun_warga_id',$parent_id);
    	})->get();

    	return $this->dataMapping($data);
    }

    // public function getDataTPS($parent_id=null)
    // {
    // 	$data = TPS::when($parent_id!=null,function($query) use($parent_id){
    // 		return $query->whereHas('tps_coverage',function($coverage) use($parent_id){
    // 			$coverage->where('rukun_tetangga_id',$parent_id);
    // 		});
    // 	})->get();

    // 	return $this->dataMapping($data);
    // }

    public function getDataTPS($parent_id=null)
    {
        $data = TPS::when($parent_id!=null,function($query) use($parent_id){
            return $query->whereHas('tps_coverage',function($coverage) use($parent_id){
                $coverage->where('rukun_warga_id',$parent_id);  
            });
        })->get();

        return $this->dataMapping($data);
    }

    public function getDataTPSFiltered($parent_id=null)
    {
        $list_tps_done = Voting::all()->pluck('tps_id');
        $data = TPS::when($parent_id!=null,function($query) use($parent_id){
            return $query->whereHas('tps_coverage',function($coverage) use($parent_id){
                $coverage->where('rukun_warga_id',$parent_id);  
            });
        })->whereNotIn('id',$list_tps_done)->get();

        return $this->dataMapping($data);
    }

    public function getDataPartai()
    {
        $data = Partai::all();
        return $this->dataMapping($data);
    }

    public function getDataCalonLegislatif($parent_id=null)
    {
        $data = CalonLegislatif::when($parent_id!=null,function($query) use($parent_id){
            return $query->where('partai_id',$parent_id);
        })->get();

        return $this->dataMapping($data);
    }

    public function getDataVoting(Request $request)
    {
        $params = $request->params;

        $data = VotingDetail::join('voting','voting.id','voting_details.voting_id')
                ->join('calon_legislatif','calon_legislatif.id','voting_details.calon_legislatif_id')
                ->select('calon_legislatif.id','calon_legislatif.name','voting_details.value',DB::raw('sum(value) as total_suara'))
                ->when(!empty($params['byKecamatan']),function($query) use($params){
                    return $query->whereHas('voting.tps.rukun_warga.kelurahan.kecamatan',function($kecamatan) use($params){
                        $kecamatan->where('id',$params['byKecamatan']);
                    });
                })
                ->when(!empty($params['byKelurahan']),function($query) use($params){
                    return $query->whereHas('voting.tps.rukun_warga.kelurahan',function($kelurahan) use($params){
                        $kelurahan->where('id',$params['byKelurahan']);
                    });
                })
                ->when(!empty($params['byRW']),function($query) use($params){
                    return $query->whereHas('voting.tps.rukun_warga',function($rw) use($params){
                        $rw->where('rukun_warga.id',$params['byRW']);
                    });
                })
                ->when(!empty($params['byTPS']),function($query) use($params){
                    return $query->whereHas('voting.tps',function($tps) use($params){
                        $tps->where('id',$params['byTPS']);
                    });
                })
                ->groupBy('calon_legislatif.id')
                ->get();
        
        $caleg = $data->pluck('name');
        $total_suara = $data->pluck('total_suara');
        $color = [];
        $iColor = 0;
        foreach ($data as $value) {
            $color[] = $this->getColorPattern($iColor);
            $iColor += 1;
        }

        return ['caleg' => $caleg,'total_suara' => $total_suara, 'color' => $color];
    }

    public function rand_color() {
        return '#' . strtoupper(str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
    }

    public function getColorPattern($value){

        $letters = '0123456789ABCDEF';
        $color = '#';
        for ($i = 0; $i < 6; $i++ ) {
            $color .= $letters[rand(0,15)];
        }

        switch ($value) {
            case '0': $color = "#DC143C"; break;
            case '1': $color = "#fdfe02"; break;
            case '2': $color = "#7CFC00"; break;
            case '3': $color = "#4169E1"; break;
            case '4': $color = "#FFA500"; break;
            case '5': $color = "#9370DB"; break;
            case '6': $color = "#4B0082"; break;
            case '7': $color = "#98FB98"; break;
            case '8': $color = "#D2691E"; break;
            case '9': $color = "#B0C4DE"; break;
            default: $color; break;
        };

        return $color;
        
    }
}
