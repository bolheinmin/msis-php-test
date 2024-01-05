@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lesson Create Form</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-start">
            @include('layouts.back_btn')
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('lessons.store') }}" method="POST" id="create-form">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control form-control-lg" name="title" value="{{ old('title') }}" />
                    <label class="form-label">Title</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea class="form-control" rows="3" name="content">{{ old('content') }}</textarea>
                    <label class="form-label">Content</label>
                </div>
                <div class="from-group mb-4">
                    <select name="course_id" class="form-select select-course">
                        @foreach($courses as $course)
                            <option></option>
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <div class="col-md-6">
                        <!-- Submit button -->
                        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreLessonRequest', '#create-form'); !!}
    <script type="text/javascript">
        $(document).ready( function () {
            // select 2
            $('.select-course').select2({
                theme: "material",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: "-- Choose Course --",
                allowClear: true
            });
        });
    </script>
@endsection
