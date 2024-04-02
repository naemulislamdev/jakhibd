<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadriRegister extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function badriRegisterType(){
        return $this->belongsTo(Topic::class,'badri_type_id');
    }
}
