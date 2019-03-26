<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RukunTetangga extends Model
{
    use SoftDeletes;

    protected $table = 'rukun_tetangga';
    protected $guarded = [];

    public function rukun_warga(){
    	return $this->belongsTo(RukunWarga::class);
    }

    public function tps()
	{
		return $this->belongsToMany(TPS::class, 'tps_coverage', 'tps_id', 'rukun_tetangga_id');
	}
}
