<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RukunWarga extends Model
{
    use SoftDeletes;

    protected $table = 'rukun_warga';
    protected $guarded = ['kecamatan'];

    public function kelurahan(){
    	return $this->belongsTo(Kelurahan::class);
    }

    // public function rukun_tetangga(){
    // 	return $this->hasMany(RukunTetangga::class,'rukun_warga_id');
    // }

    public function tps(){
    	return $this->hasMany(TPS::class,'tps_id');
    }
}
