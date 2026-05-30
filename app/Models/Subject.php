<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'teacher_id',
        'credit',
        'type',
    ];

    /**
     * Relationship
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    public function lessons()
{
    return $this->hasMany(Lesson::class);
}
}
