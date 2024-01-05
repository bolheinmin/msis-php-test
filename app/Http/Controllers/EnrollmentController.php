<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll($courseId)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is not already enrolled in the course
        if (!$user->enrollments()->where('course_id', $courseId)->exists()) {
            // Enroll the user in the course
            Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
            ]);

            return redirect()->back()->with('success', 'Enrolled successfully.');
        }

        return redirect()->back()->with('error', 'You are already enrolled in this course.');
    }

    public function unenroll($courseId)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is enrolled in the course
        $enrollment = $user->enrollments()->where('course_id', $courseId)->first();

        if ($enrollment) {
            // Unenroll the user from the course
            $enrollment->delete();

            return redirect()->back()->with('success', 'Unenrolled successfully.');
        }

        return redirect()->back()->with('error', 'You are not enrolled in this course.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
