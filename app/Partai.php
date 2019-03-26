<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partai extends Model
{
    use SoftDeletes;

    protected $table = 'partai';
    protected $guarded = [];

    public function calon_legislatif(){
    	return $this->hasMany(CalonLegislatif::class,'partai_id');
    }
}
