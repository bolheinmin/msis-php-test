<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LMS</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button
                data-mdb-collapse-init
                class="navbar-toggler"
                type="button"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    LMS
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->

            <div class="d-flex align-items-center">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <!-- Avatar -->
                            <div class="dropdown">
                                <a
                                    data-mdb-dropdown-init
                                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                                    href="#"
                                    id="navbarDropdownMenuAvatar"
                                    role="button"
                                    aria-expanded="false"
                                >
                                    <p class="mb-0">{{ auth()->user()->name }}</p>
                                </a>
                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="navbarDropdownMenuAvatar"
                                >
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user-profile') }}">My profile</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="#" id="logout-btn">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div class=" pt-3" style="background: #eee; height: 100vh;">
        <h3 class="text-primary text-center">{{ $course->title }}</h3>
        <div class="container">
            <div class="card mb-4">
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
                    <h6 class="mb-2 pb-1">Lesson Progress: </h6>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $lessonProgress }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round($lessonProgress) }}%</div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border border-primary">
                                <div class="card-header">Lessons</div>
                                <div class="card-body">
                                    @foreach($course->lessons as $lesson)
                                    <div class="form-check">
                                        <input class="form-check-input lesson-check" type="checkbox"
                                               data-id="{{ $lesson->id }}" value="" id="{{ $lesson->id }}"
                                            {{ in_array($lesson->id, $completedLessonArr) ? 'checked' : '' }}
                                        />

                                        <label class="form-check-label" for="{{ $lesson->id }}">{{ $lesson->title }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border border-primary">
                                <div class="card-header">Assessments</div>
                                <div class="card-body">
                                    @foreach($course->assessments as $assessment)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="{{$assessment->id}}" />
                                            <label class="form-check-label" for="{{$assessment->id}}">{{ $assessment->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function (){
        //  back button
        $('#back-btn').on('click', function (e){
            e.preventDefault();
            window.history.go(-1);
            return false;
        });
        @if (session('error'))
        Swal.fire({
            title: "{{ session('error') }}",
            icon: "error"
        });
        @endif
        // ajax setup
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token.content
                }
            });
        } else {
            console.error('CSRF Token not found.');
        }

        loadCheckboxState();
        let course_id = {{ $course->id }};

// Add change event listener to checkboxes
        $('.lesson-check').change(function() {
            // Save the state of checkboxes in localStorage
            saveCheckboxState();

            // Send the state to the server via AJAX
            sendCheckboxStateToServer();
        });

        function loadCheckboxState() {
            // Get the state from localStorage
            var checkedIds = localStorage.getItem('checkedIds');

            if (checkedIds) {
                // Parse the JSON string and update the checkboxes
                checkedIds = JSON.parse(checkedIds);
                $('.lesson-check').prop('checked', false); // Uncheck all checkboxes
                for (var i = 0; i < checkedIds.length; i++) {
                    $('#' + checkedIds[i]).prop('checked', true);
                }
            }
        }

        function saveCheckboxState() {
            // Get an array of checked data-ids
            var checkedIds = $('.lesson-check:checked').map(function() {
                return $(this).data('id');
            }).get();

            // Convert the array to JSON and save in localStorage
            localStorage.setItem('checkedIds', JSON.stringify(checkedIds));
        }

        function sendCheckboxStateToServer() {
            // Get the state from localStorage
            var checkedIds = localStorage.getItem('checkedIds');
            console.log(checkedIds);

            // Send the state to the server via AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('complete-lessons') }}",
                data: {
                    checkedIds: checkedIds,
                    course_id: course_id,
                    // Additional data to send to the server if needed
                },
                dataType: 'json',
                success: function(res) {
                    // Remove the localStorage data after successful AJAX request
                    localStorage.removeItem('checkedIds');
                    // console.log('Checked IDs sent to server:', res);
                },
                error: function(err) {
                    // console.error('Error sending checked IDs to server:', err);
                },
            });
        }

        $('#logout-btn').on('click', function (e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure want to logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type:"POST",
                        url: "{{ url('/logout') }}",
                        success: function(res){
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>
