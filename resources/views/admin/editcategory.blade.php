@extends('admin.layouts.template')
@section('title','Admin | editcategory')
@section('content')
<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> Add Categori</h4>
    <div class="col-xxl">
        <div class="card mb-4 bg-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Kategori</h5>
        <small class="text-muted float-end">informasi input</small>
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
<!--Template pada framework Laravel yang digunakan untuk menampilkan pesan error validasi pada form
Kode tersebut akan mengecek apakah ada pesan error yang tersedia di dalam $errors, jika iya maka pesan error tersebut akan ditampilkan dalam bentuk daftar menggunakan tag <ul> dan <li>.-->

        <form action="{{route('updatecategory')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$category_info->id}}" name="category_id">
            <div class="row mb-3">
            <label class="col-sm-2 col-form -label" for="basic-default-name">Nama Category</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-name" value="{{$category_info->category_name}}" name="category_name"/>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
