<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    /**
     * Relationships
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function take_attendence()
    {
        return $this->hasMany(TakeAttendance::class);
    }
}
