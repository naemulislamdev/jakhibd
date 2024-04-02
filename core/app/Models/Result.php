<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
