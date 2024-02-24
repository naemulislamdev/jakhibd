<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getCommittees(){
        return $this->hasMany(Committee::class,'committee_type_id');
    }
}
