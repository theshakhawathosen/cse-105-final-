<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    protected $fillable = [
        'subject_id',
        'platform',
        'meeting_link',
        'date',
        'time',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
