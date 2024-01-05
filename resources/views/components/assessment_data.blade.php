@foreach(collect($course->assessments)->sortBy('created_at') as $assessment)
<div class="custom-card mb-3">
    <div class="d-flex justify-content-between px-3 pt-3">
        <div class="px-3 pt-1">
            <h5 class="title">{{ $assessment->title }}</h5>
            @foreach ($assessment->questions as $question)
                <p class="text pb-0 mb-2">Question: {{ $question['question'] }}</p>
            @endforeach
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis dot"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item text-primary edit-assessment-btn"
                       data-assessment="{{ base64_encode(json_encode($assessment)) }}" href="#">
                        <i class="fa-regular fa-pen-to-square me-2"></i>Edit
                    </a>
                </li>
                <li><a class="dropdown-item text-danger delete-assessment-btn" data-id="{{ $assessment->id }}" href="#"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
            </ul>
        </div>
    </div>
</div>
@endforeach
<div class="text-center mt-2">
    <a href="" class="btn add-btn add-assessment-btn"><i class="fas fa-plus me-2"></i>Add Assessment</a>
</div>
