@extends('layouts.app')
@section('title', 'Course Detail')
@section('style')
    <style>
        .custom-card {
            background-color: #fff;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .dot{
            font-size: 20px !important;
            color: #b1b4b7;
        }
        .title{
            font-size: 25px;
            color: #464e56;
            font-weight: 600;
            text-align: left;
        }
        .text{
            font-size: 15px;
            font-weight: 500;
            color: #868e94;
            text-align: left;
        }

        .add-btn {
            display: block;
            background: #fff;
            color: #000;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .add-btn:hover {
            color: #fff;
        }

        /*----------- Sweetalert ----------*/
        div:where(.swal2-container) .swal2-html-container {
            z-index: 1;
            justify-content: center;
            margin: 1em 1.6em 0.3em;
            padding: 0;
            overflow: auto;
            color: inherit;
            font-size: 1.125em;
            font-weight: normal;
            line-height: normal;
            text-align: start !important;
            word-wrap: break-word;
            word-break: break-word;
        }

        .select2-container--open {
            z-index: 99999999999999;
        }

        .dropdown-toggle:after {
            display: none;
        }
    </style>
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Course Detail</h1>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-start">
            @include('layouts.back_btn')
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">Title: </h6>
                        <p class="text-muted">{{ $course->title }}</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">Instructor: </h6>
                        <p class="text-muted">{{ $course->instructor->name  }}</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">Description: </h6>
                        <p class="text-muted">{{ $course->description }}</p>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">Level: </h6>
                        {!! match($course->level) {
                            'beginner' => '<span class="badge bg-info">Beginner</span>',
                            'intermediate' => '<span class="badge bg-primary">Intermediate</span>',
                            default => '<span class="badge bg-success">Advanced</span>',
                        } !!}
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">Start Date: </h6>
                        <p class="text-muted">{{ $course->start_date }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-2 pb-1">End Date: </h6>
                        <p class="text-muted">{{ $course->end_date }}</p>
                    </div>
                </div>
            </div>
            <div>
        </div>
    </div>
</div>
</div>

<!-- Lessons and Assessments -->
<h5 class="my-4"><span class="border-start border-primary border-5 me-2"></span>Lessons and Assessments</h5>
<div class="row">
    <!-- Lessons -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light text-dark"><i class="fa-solid fa-list-check me-2"></i>
                Lessons
            </div>
            <div class="card-body bg-light">
                <div class="lesson-data">
                    <!-- Lessons data component -->
                </div>
            </div>
        </div>
    </div>

    <!-- Assessments -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light text-dark"><i class="fa-solid fa-list-check me-2"></i>Assessments</div>
            <div class="card-body bg-light">
                <div class="assessment-data">
                    <!-- Assessments data component -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            let course_id = "{{ $course->id }}";

            // lessons
            function lessonData(){
                $.ajax({
                    type:"GET",
                    url: "{{ url('lesson-data') }}",
                    data: { course_id: course_id},
                    success: function (res) {
                        $('.lesson-data').html(res);
                    }
                });
            }
            lessonData();

            // add lesson
            $(document).on('click', '.add-lesson-btn',function (event){
                event.preventDefault();

                Swal.fire({
                    title: "Add Lesson",
                    html:`<form id="lesson-form">
                    <input type="hidden" name="course_id" value="${ course_id }">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3">
                         <label class="form-label">Content</label>
                         <textarea name="content" class="form-control" rows="3"></textarea>
                    </div>
                </form>`,
                    showCancelButton: false,
                    confirmButtonText: "Save",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = $('#lesson-form').serialize();
                        // console.log(formData);
                        $.ajax({
                            type:"POST",
                            url: "{{ url('store-lesson') }}",
                            data: formData,
                            dataType: 'json',
                            success: function (res){
                                // console.log(res);
                                lessonData();
                                Toast.fire({
                                    icon: "success",
                                    title: "Successfully Created."
                                });
                            }
                        });
                    }
                });
            });

            // edit lesson
            $(document).on('click', '.edit-lesson-btn', function (event) {
                event.preventDefault();
                let lesson = JSON.parse(atob($(this).data('lesson')));
                // console.log(lesson);
                Swal.fire({
                    title: "Edit Lesson",
                    html:`<form id="edit-lesson-form">
                    <input type="hidden" name="id" value="${ lesson.id }" >
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control form-control-lg" id="title" value="${ lesson.title }">
                    </div>
                    <div class="mb-1">
                         <label class="form-label">Content</label>
                         <textarea name="content" class="form-control" id="description" rows="3">${ lesson.content }</textarea>
                    </div>
                </form>`,
                    showCancelButton: false,
                    confirmButtonText: "Update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = $('#edit-lesson-form').serialize();
                        console.log(formData);
                        $.ajax({
                            type:"POST",
                            url: "{{ url('update-lesson') }}",
                            data: formData,
                            success: function (res){
                                // console.log(res);
                                lessonData();
                                Toast.fire({
                                    icon: "success",
                                    title: "Successfully Updated."
                                });
                            }
                        });
                    }
                });
            });

            // delete lesson
            $(document).on('click', '.delete-lesson-btn', function (event) {
                event.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure want to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"POST",
                            url: "{{ url('delete-lesson') }}",
                            data: { id: id},
                            dataType: 'json',
                            success: function(res){
                                lessonData();
                                Swal.fire({
                                    title: "Deleted!",
                                    icon: "success"
                                });
                            }
                        });
                    }
                });
            });


            // assessments
            // lessons
            function assessmentData(){
                $.ajax({
                    type:"GET",
                    url: "{{ url('assessment-data') }}",
                    data: { course_id: course_id},
                    success: function (res) {
                        $('.assessment-data').html(res);
                    }
                });
            }
            assessmentData();

            // add assessment
            $(document).on('click', '.add-assessment-btn',function (event){
                event.preventDefault();

                Swal.fire({
                    title: "Add Assessment",
                    html:`<form id="assessment-form">
                    <input type="hidden" name="course_id" value="${ course_id }">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                    <label class="form-label">Questions</label>
                    <div class="input-group mb-3">
                        <input type="text" name="moreFields[0][question]" class="form-control" />
                        <button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button>
                    </div>
                    </div>

                    <div id="questions">
                        <!-- Additional input fields will be appended here -->
                    </div>
                </form>`,
                    showCancelButton: false,
                    confirmButtonText: "Save",
                    didOpen: function (){
                        let i = 0;

                        $("#add-btn").click(function(){
                            ++i;

                            let newQuesField = '<div class="form-group" id="field_' + i + '">' +
                                '<div class="input-group mb-3">' +
                                '<input type="text" name="moreFields[' + i + '][question]" class="form-control" />' +
                                '<button type="button" class="btn btn-danger remove-field" data-fieldid="' + i + '">Remove</button>' +
                                '</div>' +
                                '</div>';

                            $("#questions").append(newQuesField);
                        });

                        $(document).on('click', '.remove-field', function(){
                            var fieldId = $(this).data('fieldid');
                            $("#field_" + fieldId).remove();
                        });
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = $('#assessment-form').serialize();
                        console.log(formData);
                        $.ajax({
                            type:"POST",
                            url: "{{ url('store-assessment') }}",
                            data: formData,
                            dataType: 'json',
                            success: function (res){
                                // console.log(res);
                                assessmentData();
                                Toast.fire({
                                    icon: "success",
                                    title: "Successfully Created."
                                });
                            }
                        });
                    }
                });
            });

            // edit assessment
            $(document).on('click', '.edit-assessment-btn', function (event) {
                event.preventDefault();
                let assessment = JSON.parse(atob($(this).data('assessment')));
                let questions = assessment.questions;
                let i = 0;
                let questionFields = '';
                questions.forEach(function (data){
                    console.log(data);
                    questionFields += `<div class="input-group mb-1">
                                        <input type="text" name="moreFields[${i}][question]" class="form-control" value="${ data.question }" />
                                        </div>`
                    ++i;
                });

                //console.log(assessment.questions);
                Swal.fire({
                    title: "Edit Assessment",
                    html:`<form id="edit-assessment-form">
                    <input type="hidden" name="id" value="${ assessment.id }>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" value="${ assessment.title }">
                    </div>

                    <div class="form-group">
                    <label class="form-label">Questions</label>
                    ${ questionFields }
                    </div>

                    <div id="questions">
                        <!-- Additional input fields will be appended here -->
                    </div>
                </form>`,
                    showCancelButton: false,
                    confirmButtonText: "Update",
                    didOpen: function (){
                        let i = 0;

                        $("#add-btn").click(function(){
                            ++i;

                            let newQuesField = '<div class="form-group" id="field_' + i + '">' +
                                '<div class="input-group mb-3">' +
                                '<input type="text" name="moreFields[' + i + '][question]" class="form-control" />' +
                                '<button type="button" class="btn btn-danger remove-field" data-fieldid="' + i + '">Remove</button>' +
                                '</div>' +
                                '</div>';

                            $("#questions").append(newQuesField);
                        });

                        $(document).on('click', '.remove-field', function(){
                            var fieldId = $(this).data('fieldid');
                            $("#field_" + fieldId).remove();
                        });
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = $('#edit-assessment-form').serialize();
                        console.log(formData);
                        $.ajax({
                            type:"POST",
                            url: "{{ url('update-assessment') }}",
                            data: formData,
                            success: function (res){
                                // console.log(res);
                                assessmentData();
                                Toast.fire({
                                    icon: "success",
                                    title: "Successfully Updated."
                                });
                            }
                        });
                    }
                });
            });

            // delete assessment
            $(document).on('click', '.delete-assessment-btn', function (event) {
                event.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure want to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"POST",
                            url: "{{ url('delete-assessment') }}",
                            data: { id: id},
                            dataType: 'json',
                            success: function(res){
                                assessmentData();
                                Swal.fire({
                                    title: "Deleted!",
                                    icon: "success"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
