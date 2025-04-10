<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function result(){
        return $this->hasMany(Result::class, 'subject_id');
    }
}
