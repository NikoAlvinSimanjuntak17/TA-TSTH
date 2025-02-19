@extends('admin.layouts.template')
@section('title','Admin | Add Gallery')
@section('content')

<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> Add Gallery</h4>
    <div class="col-xxl">
        <div class="card mb-4 bg-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0" style="color: rgb(180, 2, 2);">Tambahkan Data</h5>
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

                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="gallery_name">Gallery Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gallery_name" name="title" placeholder="Gallery Title" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="gallery_deskripsi">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="gallery_deskripsi" placeholder="Description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="gallery_img">Upload Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="gallery_img" class="form-control" name="image" required>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add Gallery</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
