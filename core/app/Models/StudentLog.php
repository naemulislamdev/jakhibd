<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentLog extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = ['id'];
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
