<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role','user')->count();
        $instructors = User::where('role','instructor')->count();
        $courses = Course::all()->count();
        $lessons = Lesson::all()->count();
        $assessments = Assessment::all()->count();
        return view('admin.dashboard', compact('users', 'instructors', 'courses', 'lessons', 'assessments'));
    }
}
