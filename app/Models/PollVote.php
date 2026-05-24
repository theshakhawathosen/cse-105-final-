<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    protected $fillable = [
        'poll_id',
        'poll_option_id',
        'student_id',
    ];

    /**
     * Relationships
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'poll_option_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
