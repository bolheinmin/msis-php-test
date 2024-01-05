<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            $courses = Course::with('instructor');
            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('instructor',function ($course){
                    return $course->instructor ? $course->instructor->name : '-';
                })
                ->addColumn('action', 'admin.courses.action')
                ->editColumn('created_at', function ($course){
                    return Carbon::parse($course->created_at)->format('Y-m-d H:i:s');
                })
                ->editColumn('description', function ($course){
                    return Str::limit($course->description, 50);
                })
                ->editColumn('level', function ($course){
                    return match ($course->level) {
                        'beginner' => '<span class="badge badge-info">Beginner</span>',
                        'intermediate' => '<span class="badge badge-primary">Intermediate</span>',
                        default => '<span class="badge badge-success">Advanced</span>',
                    };
                })
                ->filterColumn('instructor', function ($query, $keyword) {
                    $query->whereHas('instructor', function ($q) use ($keyword){
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->rawColumns(['action', 'level'])
                ->make(true);
        }
        return view('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = User::where('role', 'instructor')->orderBy('name')->get();
        return view('admin.courses.add', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course is successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
//        dd($course);
        $instructors = User::where('role', 'instructor')->orderBy('name')->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validated();

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $course = Course::findOrFail($request->id)->delete();
        return Response()->json($course);
    }
}
