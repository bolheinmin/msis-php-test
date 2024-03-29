@extends('layouts.app')
@section('title', 'Create Assessment')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assessment Create Form</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-start">
            @include('layouts.back_btn')
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('assessments.store') }}" method="POST" id="create-form">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control form-control-lg" name="title" value="{{ old('title') }}" />
                    <label class="form-label">Title</label>
                </div>

                <div class="input-group mb-3 input-group-lg">
                    <input type="text" name="moreFields[0][question]" class="form-control" placeholder="Please enter question" aria-describedby="button-addon2"/>
                    <button class="btn btn-success" type="button" name="add" id="add-btn" data-mdb-ripple-init data-mdb-ripple-color="dark">
                        Add More
                    </button>
                </div>
                <div id="questions">
                    <!-- Additional input fields will be appended here -->
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreAssessmentRequest', '#create-form'); !!}
    <script type="text/javascript">
        $(document).ready( function () {
            let i = 0;

            $("#add-btn").click(function(){
                ++i;

                let newQuesField =
                    '<div class="input-group mb-3 input-group-lg" id="field_' + i + '">' +
                    '<input type="text" name="moreFields[' + i + '][question]" class="form-control" placeholder="Please enter question" />' +
                    '<button type="button" class="btn btn-danger remove-field" data-fieldid="' + i + '">Remove</button>' +
                    '</div>';

                $("#questions").append(newQuesField);
            });

            $(document).on('click', '.remove-field', function(){
                var fieldId = $(this).data('fieldid');
                $("#field_" + fieldId).remove();
            });
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
