<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;

    protected $table = 'kelurahan';
    protected $guarded = [];

    public function kecamatan(){
    	return $this->belongsTo(Kecamatan::class);
    }

    public function rukun_warga()
    {
    	return $this->hasMany(RukunWarga::class,'kelurahan_id');
    }
}
