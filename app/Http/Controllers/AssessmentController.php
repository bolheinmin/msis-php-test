<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Models\Assessment;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssessmentController extends Controller
{

    public function index()
    {
        if(request()->ajax()) {
            $assessments = Assessment::with('course');
            return DataTables::of($assessments)
                ->addIndexColumn()
                ->editColumn('course', function ($assessment){
                    return $assessment->course ? $assessment->course->title : '-';
                })
                ->addColumn('action', 'admin.assessments.action')
                ->editColumn('created_at', function ($course){
                    return Carbon::parse($course->created_at)->format('Y-m-d H:i:s');
                })
                ->editColumn('questions', function ($question){
                    return implode(', ', array_column($question['questions'], 'question'));
                })
                ->filterColumn('course', function ($query, $keyword) {
                    $query->whereHas('course', function ($q) use ($keyword){
                        $q->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.assessments.index');
    }

    public function create()
    {
        $courses = Course::orderBy('created_at')->get();
        return view('admin.assessments.add', compact('courses'));
    }

    public function store(StoreAssessmentRequest $request)
    {
        $course = Course::findOrFail($request->course_id);
        $request->validated();
        $data = $request->only(['title', 'moreFields', 'course_id']);
        $course->assessments()->create([
            'title' => $data['title'],
            'questions' => $data['moreFields'],
            'course_id' => $data['course_id']
        ]);
        return redirect()->route('assessments.index')->with('success', 'Assessment is successfully created.');
    }

    public function storeAssessment(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $request->validate([
            'title' => 'required',
            'moreFields.*.question' => 'required'
        ]);

        $data = $request->only(['title', 'moreFields']);

        $course->assessments()->create([
            'title' => $data['title'],
            'questions' => $data['moreFields']
        ]);
        return Response()->json($course);
    }

    public function edit(string $id)
    {
        $assessment = Assessment::findOrFail($id);
        $courses = Course::orderBy('created_at')->get();

        return view('admin.assessments.edit', compact('assessment', 'courses'));
    }

    public function update(UpdateAssessmentRequest $request, string $id)
    {
        $assessment = Assessment::findOrFail($id);
        $request->validated();
        $data = $request->only(['title', 'moreFields', 'course_id']);
        $assessment->update([
            'title' => $data['title'],
            'questions' => $data['moreFields'],
            'course_id' => $data['course_id']
        ]);
        return redirect()->route('assessments.index')->with('success', 'Assessment is successfully created.');
    }

    public function updateAssessment(Request $request)
    {
        $assessment = Assessment::findOrFail($request->id);
        $request->validate([
            'title' => 'required',
            'moreFields.*.question' => 'required'
        ]);
        $data = $request->only(['title', 'moreFields']);
        $assessment->update([
            'title' => $data['title'],
            'questions' => $data['moreFields']
        ]);
        return Response()->json($assessment);
    }

    public function destroy(Request $request)
    {
        $assessment = Assessment::findOrFail($request->id)->delete();

        return response()->json($assessment);

    }

    public function assessmentData(Request $request)
    {
        $course = Course::with('assessments')->where('id', $request->course_id)->firstOrFail();

        return view('components.assessment_data', compact('course'))->render();
    }
}
