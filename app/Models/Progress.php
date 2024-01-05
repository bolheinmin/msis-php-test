<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'completed_lessons',
        'completed_assessments',
        'last_accessed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function completionPercentage()
    {
        // Assuming completion is based on completed modules:
        $totalLessons = $this->course->lessons->count();  // Get total module count
        $completedLessons = count($this->completed_lessons);

        return ($completedLessons / $totalLessons) * 100;  // Calculate percentage
    }
}
