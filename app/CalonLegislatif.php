<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalonLegislatif extends Model
{
    use SoftDeletes;

    protected $table = 'calon_legislatif';
    protected $guarded = [];

    public function voting_detail(){
    	return $this->hasMany(VotingDetail::class);
    }
}
