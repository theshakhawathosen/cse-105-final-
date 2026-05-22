<?php

namespace App\Models;

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
}
