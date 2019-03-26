<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kelurahan;
use App\RukunWarga;
use App\TPS;

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
            return $query->where('rukun_warga_id',$parent_id);
        })->get();

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
}
