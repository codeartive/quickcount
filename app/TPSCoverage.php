<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TPSCoverage extends Model
{
	use SoftDeletes;

    protected $table = 'tps_coverages';
    protected $guarded = [];

    public function tps(){
    	return $this->belongsTo(TPS::class);
    }

    // public function rukun_tetangga(){
    // 	return $this->belongsTo(RukunTetangga::class);
    // }

    public function rukun_warga(){
    	return $this->belongsTo(RukunWarga::class);
    }
}
