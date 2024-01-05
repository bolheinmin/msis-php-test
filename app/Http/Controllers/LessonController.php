<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LessonController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $lessons = Lesson::with('course');
            return DataTables::of($lessons)
                ->addIndexColumn()
                ->editColumn('course', function ($lesson){
                    return $lesson->course ? $lesson->course->title : '-';
                })
                ->addColumn('action', 'admin.lessons.action')
                ->editColumn('created_at', function ($course){
                    return Carbon::parse($course->created_at)->format('Y-m-d H:i:s');
                })
                ->filterColumn('course', function ($query, $keyword) {
                    $query->whereHas('course', function ($q) use ($keyword){
                        $q->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.lessons.index');
    }

    public function create()
    {
        $courses = Course::orderBy('created_at')->get();
        return view('admin.lessons.add', compact('courses'));
    }

    public function store(StoreLessonRequest $request)
    {
        $course = Course::findOrFail($request->course_id);
        $data = $request->validated();
        $course->lessons()->create($data);
        return redirect()->route('lessons.index')->with('success', 'Lesson is successfully created.');
    }

    public function storeLesson(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $course->lessons()->create($data);
        return Response()->json($course);
    }

    public function edit(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::orderBy('created_at')->get();

        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(UpdateLessonRequest $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $data = $request->validated();
        $lesson->update($data);
        return redirect()->route('lessons.index')->with('success', 'Lesson is successfully updated.');
    }

    public function updateLesson(Request $request)
    {
        $lesson = Lesson::findOrFail($request->id);
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $lesson->update($data);
        return Response()->json($lesson);
    }

    public function destroy(Request $request)
    {
        $lesson = Lesson::findOrFail($request->id)->delete();

        return response()->json($lesson);

    }


    public function lessonData(Request $request)
    {
        $course = Course::with('lessons')->where('id', $request->course_id)->firstOrFail();

        return view('components.lesson_data', compact('course'))->render();
    }
}
