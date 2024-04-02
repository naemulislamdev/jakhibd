<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function subDepartment(){
        return $this->belongsTo(SubDepartment::class);
    }
    public function studentLog(){
        return $this->hasOne(StudentLog::class,'student_id');
    }
}
