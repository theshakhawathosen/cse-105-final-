<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    protected $fillable = [
        'resource_id',
        'file',
        'original_name',
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
