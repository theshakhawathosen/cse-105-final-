<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
    protected $fillable = [
        'title',
        'subject_id',
        'description',
        'deadline',
        'file',
        'status',
    ];

    /**
     * Relationship
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
