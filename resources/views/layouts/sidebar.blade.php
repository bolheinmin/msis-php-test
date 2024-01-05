<nav class="col-2 bg-light pe-3 border-right">
    <h1 class="h4 py-3 text-center text-dark">
        <span class="d-none d-lg-inline">LMS</span>
    </h1>
    <hr>
    <div class="list-group text-center text-lg-start">
        <span class="list-group-item disabled d-none d-lg-block">
            <small>General</small>
        </span>
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i>
            <span class="d-none d-lg-inline">Dashboard</span>
        </a>
        <a href="{{ route('courses.index') }}"
           class="list-group-item list-group-item-action {{ Request::segment(1) === 'courses' ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i>
            <span class="d-none d-lg-inline">Courses</span>
        </a>
        <a href="{{ route('lessons.index') }}" class="list-group-item list-group-item-action {{ Request::segment(1) === 'lessons' ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i>
            <span class="d-none d-lg-inline">Lessons</span>
        </a>
        <a href="{{ route('assessments.index') }}" class="list-group-item list-group-item-action {{ Request::segment(1) === 'assessments' ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i>
            <span class="d-none d-lg-inline">Assessments</span>
        </a>
    </div>
</nav>
