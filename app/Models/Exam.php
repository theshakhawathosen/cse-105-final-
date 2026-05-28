<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_type',
        'exam_name',
        'date',
    ];


    public function results(){
        return $this->hasMany(Result::class);
    }
}
