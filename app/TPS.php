<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TPS extends Model
{
    use SoftDeletes;

    protected $table = 'tps';
    protected $guarded = [];

    // public function tps_coverage(){
    // 	return $this->hasMany(TPSCoverage::class,'tps_id');
    // }

 //    public function rukun_tetangga()
	// {
	// 	return $this->belongsToMany(RukunTetangga::class, 'tps_coverage', 'rukun_tetangga_id', 'tps_id');
	// }

    // public function rukun_warga()
    // {
    //     return $this->belongsTo(RukunWarga::class);
    // }

    public function rukun_warga()
    {
        return $this->belongsToMany(RukunWarga::class, 'tps_coverages', 'tps_id', 'rukun_warga_id');
    }

    public function getRukunWarga()
    {
        return $this->rukun_warga()->first() ?? null;
    }

    public function voting()
    {
        return $this->hasMany(Voting::class,'tps_id');
    }

    public function voting_detail()
    {
        return $this->hasManyThrough(VotingDetail::class, Voting::class, 'tps_id', 'voting_id');
    }
}
