<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotingDetail extends Model
{
    use SoftDeletes;

    protected $table = 'voting_details';
    protected $guarded = [];

    public function voting(){
    	return $this->belongsTo(Voting::class);
    }

    public function calon_legislatif(){
    	return $this->belongsTo(CalonLegislatif::class);
    }
}
