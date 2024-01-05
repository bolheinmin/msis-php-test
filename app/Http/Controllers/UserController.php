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
        $user = Auth::user();
        $course = Course::findOrFail($courseId);
        $totalLessons = $course->lessons->count();
        $completedLessons = Progress::where('course_id', $courseId)->pluck('completed_lessons')->count();
        $lessonProgress = ($completedLessons / $totalLessons) * 100;

        $completedLessonData = Progress::where('course_id', $courseId)->pluck('completed_lessons')->toArray();
        $firstElement = isset($originalArray[0]) ? $completedLessonData[0] : null;

        if ($firstElement !== null) {
            $decodedArray = json_decode($firstElement, true);
            $completedLessonArr = array_map('intval', $decodedArray);

//            dd($completedLessonArr);
        } else {
            $completedLessonArr = [];
//            dd($completedLessonArr);
        }
        return view('frontend.learn_course', compact('course','lessonProgress', 'completedLessonArr'));
    }

    public function completeLesson(Request $request)
    {
        $user = Auth::user();
        $progress = new Progress();
        $progress->user_id = $user->id;
        $progress->course_id = $request->course_id;
        $progress->completed_lessons = $request->checkedIds;
        $progress->save();

        return 'success';

    }

    public function getCompletedLessons($userId, $courseId)
    {
        $user = User::findOrFail($userId);
        $course = Course::findOrFail($courseId);

        $completedLessons = $user->completedLessons($courseId);

        // Use $completedLessons as needed
    }
}
