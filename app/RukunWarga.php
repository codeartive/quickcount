<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RukunWarga extends Model
{
    use SoftDeletes;

    protected $table = 'rukun_warga';
    protected $guarded = [];

    public function kelurahan(){
    	return $this->belongsTo(Kelurahan::class);
    }
}
