@extends('layouts.app')
@section('title', 'Edit Book')
@section('content')
<section class="content pb-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('book.update', $book)}}" autocomplete="off" method="POST" id="create" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{$book->title}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="description form-control" name="description">{{$book->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">PDF</label>
                                    <input type="file" name="pdf" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Book Type</label>
                                    <select name="book_type_id" class="form-control">
                                        @foreach ($book_types as $book_type)
                                        <option value="{{$book_type->id}}" @if($book_type->id == $book->book_type_id) selected @endif>{{$book_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Writer</label>
                                    <select name="writer_id" class="form-control">
                                        @foreach ($writers as $writer)
                                        <option value="{{$writer->id}}" @if($writer->id == $book->writer_id) selected @endif>{{$writer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <a href="/book" class="btn btn-danger action-btn mr-2">Cancel</a>
                            <button type="submit" class="btn btn-primary action-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
