<div class="d-flex">
    <a href="{{ route('courses.show', $id) }}" class="delete btn btn-sm btn-outline-primary me-1">
        <i class="fa-regular fa-eye"></i>
    </a>
    <a href="{{ route('courses.edit', $id) }}" class="edit btn btn-sm btn-outline-warning me-1">
        <i class="fa-regular fa-pen-to-square"></i>
    </a>
    <a href="#" data-id="{{ $id }}" class="delete-btn btn btn-sm btn-outline-danger">
        <i class="fa-regular fa-trash-can"></i>
    </a>
</div>
