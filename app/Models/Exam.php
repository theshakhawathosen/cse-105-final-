<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_type',
        'exam_name',
        'subject_id',
        'date',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
