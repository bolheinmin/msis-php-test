<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile()
    {
        $user = Auth::user();
        $progress = Progress::where('user_id', $user->id)->get();
//        dd($progress);
        return view('frontend.user_profile', compact('progress'));
    }

    public function browseCourse()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses->pluck('id')->toArray();
        $courses = Course::orderBy('created_at')->get();
//        dd($courses);
        return view('frontend.courses', compact('courses', 'enrolledCourses'));
    }

    public function learnCourse($courseId)
    {
        $user_id = Auth::user()->id;
        $course = Course::findOrFail($courseId);

        $progress = Progress::where('user_id', $user_id)
            ->where('course_id', $courseId)
            ->first();

        $totalLessons = $course->lessons->count();
        $completedLessons = json_decode($progress->completed_lessons, true);
        $lessonProgress = (count($completedLessons) / $totalLessons) * 100;

//        dd(count($completedLessons));

        return view('frontend.learn_course', compact('course','lessonProgress', 'completedLessons'));
    }

    public function completeLesson(Request $request)
    {
        $user = Auth::user();
        $progress = Progress::where('user_id', $user->id)
            ->where('course_id', $request->course_id)
            ->first();

        if ($progress) {
            // If the record exists, retrieve existing completed lessons and merge with new values
            $completedLessons = json_decode($progress->completed_lessons, true) ?? [];
            $newCompletedLessons = json_decode($request->checkedIds, true) ?? [];
            $mergedCompletedLessons = array_unique(array_merge($completedLessons, $newCompletedLessons));

            // Update the existing record with the merged completed lessons
            $progress->update(['completed_lessons' => json_encode($mergedCompletedLessons)]);
        } else {
            // If the record doesn't exist, create a new one with the new values
            Progress::create([
                'user_id' => $user->id,
                'course_id' => $request->course_id,
                'completed_lessons' => $request->checkedIds
            ]);
        }


        return response()->json($progress);

    }

    public function getCompletedLessons($userId, $courseId)
    {
        $user = User::findOrFail($userId);
        $course = Course::findOrFail($courseId);

        $completedLessons = $user->completedLessons($courseId);

        // Use $completedLessons as needed
    }
}
