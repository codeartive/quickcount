<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TPS extends Model
{
    use SoftDeletes;

    protected $table = 'tps';
    protected $guarded = [];

    public function tps_coverage(){
    	return $this->hasMany(TPSCoverage::class,'tps_id');
    }
}
