@extends('admin.layouts.template')
@section('title','Admin | editroductimg')
@section('content')
<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> Edit Gambar</h4>
    <div class="col-xxl">
        <div class="card mb-4 bg-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Gambar</h5>
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
        <form action="{{route('updateproductimg')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Gambar Sebelumnya</label>

            @if(json_decode($productinfo->product_img))
            @foreach(json_decode($productinfo->product_img) as $image)
<img src="{{ asset($image) }}" style="width: 250px" loading="lazy"  class="image-contain"  alt="">
@endforeach
            @else
            <div class="col-sm-10">

                <img src="{{asset($productinfo->product_img)}}" alt="">
                            </div>
            @endif
          </div>

          <input type="hidden" name="id" value="{{$productinfo->id}}" id="">

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kirim Gambar</label>
            <div class="col-sm-10">
                <input type="file" id="product_img" class="form-control" name="product_img">
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Update gambar produk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
