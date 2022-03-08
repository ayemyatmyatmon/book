@extends('layouts.app')
@section('title', 'Book')

@section('content')
<div class="pb-3">
    <div class="d-inline-block">
        <a href="/book/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Book</a>
    </div>
</div>
<div class="pb-2 filter">
    <div class="card card-body">
        <div class="row">
            <div class="col-6 col-md-4">
                <div class="form-group">
                    <label>Book Type</label>
                    <select class="custom-select book_type_id">
                        <option value="">All</option>
                        @foreach ($book_types as $book_type)
                        <option value="{{ $book_type->id }}">{{ $book_type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="form-group">
                    <label>Writer</label>
                    <select class="custom-select writer_id">
                        <option value="">All</option>
                        @foreach ($writers as $writer)
                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content pb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered data-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Book Type</th>
                                <th>Writer</th>
                                <th>PDF</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '/book/datatable/ssd',
            columns: [
                {
                    data: "plus-icon",
                    name: "plus-icon",
                    defaultContent: null
                },
                {
                    data: "title",
                    name: "title",
                    defaultContent: "-",
                    class: ""
                },
                {
                    data: "description",
                    name: "description",
                    defaultContent: "-",
                    class: ""
                },
                {
                    data: "book_type_name",
                    name: "book_type_name",
                    defaultContent: "-",
                    class: ""
                },
                {
                    data: "writer_name",
                    name: "writer_name",
                    defaultContent: "-",
                    class: ""
                },
                {
                    data: "pdf",
                    name: "pdf",
                    defaultContent: "-",
                    class: ""
                },
                {
                    data: "created_at",
                    name: "created_at",
                    class: ""
                },
                {
                    data: "updated_at",
                    name: "updated_at",
                    class: ""
                },
                {
                    data: "action",
                    name: "action",
                    class: ""
                }
            ],
            responsive: {
                details: {
                    type: "column",
                    target: 0
                }
            },
            columnDefs: [{
                    targets: "no-sort",
                    orderable: false
                },
                {
                    className: "control",
                    orderable: false,
                    targets: 0
                },
                {
                    targets: "hidden",
                    visible: false
                }
            ]
        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal("Are you sure, you want to delete?", {
                    className: "danger-bg",
                    buttons: [true, "Yes"],
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `/book/${id}`,
                        type: 'DELETE',
                        success: function() {
                            table.ajax.reload();
                        },
                        error: function(res) {
                            var errorMessages = '';
                            var errors = Object.values(JSON.parse(res.responseText)['errors']);
                            for(var i = 0; i < errors.length; i++){
                                errorMessages += errors[i].join(' ')
                            }
                            swal({
                                icon: 'error',
                                title: "The given data is invalid",
                                text: errorMessages
                            });
                        }
                    });
                }
            });
        });

        $('.book_type_id, .writer_id').on('change', function(){
            var book_type_id = $('.book_type_id').val();
            var writer_id = $('.writer_id').val();
            table.ajax.url(`/book/datatable/ssd?book_type_id=${book_type_id}&writer_id=${writer_id}`).load();
        });
    });
</script>
@endsection
