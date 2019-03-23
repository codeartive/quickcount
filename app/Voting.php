<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voting extends Model
{
    use SoftDeletes;

    protected $table = 'voting';
    protected $guarded = [];

    public function tps()
    {
    	return $this->belongsTo(TPS::class);
    }

    public function voting_detail(){
    	return $this->hasMany(VotingDetail::class,'voting_id');
    }
}
