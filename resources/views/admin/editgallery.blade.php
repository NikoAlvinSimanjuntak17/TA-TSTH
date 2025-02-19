@extends('admin.layouts.template')
@section('title', 'Admin | Edit Gallery')
@section('content')
    <div class="container p-5">
        <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span>Edit Gallery</h4>
        <div class="col-xxl">
            <div class="card mb-4 bg-secondary">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Gallery</h5>
                    <small class="text-muted float-end">Input Information</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.gallery.update', $gallery['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Gallery</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" value="{{ $gallery['id'] }}">

                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $gallery['title'] }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Current Image</label>
                            <div class="col-sm-10">
                                <img src="{{ asset('images/'.$gallery->image) }}" style="height:100px; width:200px;" alt="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Upload New Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Gallery</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
