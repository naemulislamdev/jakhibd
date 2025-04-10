<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function subDepartment(){
        return $this->hasMany(SubDepartment::class,'department_id');
    }
    public function result(){
        return $this->hasMany(Result::class, 'department_id');
    }
}
