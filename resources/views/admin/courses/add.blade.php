@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course Create Form</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-start">
            @include('layouts.back_btn')
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" id="create-form">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control form-control-lg" name="title" value="{{ old('title') }}" />
                    <label class="form-label">Title</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                    <label class="form-label">Description</label>
                </div>
                <div class="from-group mb-4">
                    <select name="instructor_id" class="form-select select-instructor">
                        @foreach($instructors as $instructor)
                            <option></option>
                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-regular fa-calendar-days trailing"></i>
                    <input type="text" class="form-control form-control-lg form-icon-trailing active date-picker" name="start_date" value="{{ old('start_date') }}"/>
                    <label class="form-label">Start Date</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-regular fa-calendar-days trailing"></i>
                    <input type="text" class="form-control form-control-lg form-icon-trailing active date-picker" name="end_date" value="{{ old('end_date') }}"/>
                    <label class="form-label">End Date</label>
                </div>

                <h6 class="mb-2 pb-1">Level: </h6>
                <div class="form-check form-check-inline mb-4">
                    <input class="form-check-input" type="radio" name="level" id="beginner" value="beginner"  />
                    <label class="form-check-label" for="beginner">Beginner</label>
                </div>
                <div class="form-check form-check-inline mb-4">
                    <input class="form-check-input" type="radio" name="level" id="intermediate" value="intermediate" />
                    <label class="form-check-label" for="intermediate">Intermediate</label>
                </div>
                <div class="form-check form-check-inline mb-4">
                    <input class="form-check-input" type="radio" name="level" id="advanced" value="advanced" />
                    <label class="form-check-label" for="advanced">Advanced</label>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreCourseRequest', '#create-form'); !!}
    <script type="text/javascript">
        $(document).ready( function () {
            // select 2
            $('.select-instructor').select2({
                theme: "material",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: "-- Choose Instructor --",
                allowClear: true
            });

            $('.date-picker').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });
        });
    </script>
@endsection
