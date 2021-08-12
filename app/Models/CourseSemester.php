<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSemester extends Model
{
    use HasFactory;
    protected $guarded = [];

    function course()
    {
        return $this->belongsTo(Course::class);
    }
    function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
