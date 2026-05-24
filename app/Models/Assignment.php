<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'deadline',
        'file',
    ];

    /**
     * Relationship
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
