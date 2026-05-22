<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'subject_id',
        'category',
        'link',
        'is_published',
    ];

    /**
     * Relationship
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relationship
     */
    public function files()
    {
        return $this->hasMany(ResourceFile::class);
    }
}
