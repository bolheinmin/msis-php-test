@foreach(collect($course->lessons)->sortBy('created_at') as $lesson)
<div class="custom-card mb-3">
    <div class="d-flex justify-content-between px-3 pt-3">
        <div class="px-3 pt-1">
            <h5 class="title">{{ $lesson->title }}</h5>
            <p class="text pb-0">{{ $lesson->content }}</p>
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis dot"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item text-primary edit-lesson-btn"
                       data-lesson="{{ base64_encode(json_encode($lesson)) }}" href="#">
                        <i class="fa-regular fa-pen-to-square me-2"></i>Edit
                    </a>
                </li>
                <li><a class="dropdown-item text-danger delete-lesson-btn" data-id="{{ $lesson->id }}" href="#"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
            </ul>
        </div>
    </div>

</div>
@endforeach
<div class="text-center mt-2">
    <a href="" class="btn add-btn add-lesson-btn"><i class="fas fa-plus me-2"></i>Add Lesson</a>
</div>
