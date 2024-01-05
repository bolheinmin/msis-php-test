@extends('layouts.app')
@section('title', 'Assessments')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assessments</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('assessments.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i>Create New
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white" id="assessment-datatable" style="width:100%">
                <thead class="bg-light">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Questions</th>
                    <th>Course</th>
                    <th>Action</th>
                    <th>Created At</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            @if (session('success'))
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success"
            });
            @endif
            $('#assessment-datatable').DataTable({
                ajax: "{{ route('assessments.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title', searchable: true },
                    { data: 'questions', name: 'questions', },
                    { data: 'course', name: 'course', },
                    { data: 'action', name: 'action', orderable: false },
                    { data: 'created_at', name: 'created_at' },
                ],
                order: [
                    [5, 'desc']
                ],
                columnDefs: [
                    {
                        target: 5,
                        visible: false
                    }
                ],
            });

            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
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
                                let table = $('#assessment-datatable').dataTable();
                                table.fnDraw(false);
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
