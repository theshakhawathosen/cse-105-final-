<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'question',
        'status',
        'expire_at',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'expire_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }
}
