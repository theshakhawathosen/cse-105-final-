<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'subject_id',
        'topic',
        'notes',
        'date',
        'platform'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
