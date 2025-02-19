@extends('admin.layouts.template')
@section('title','Admin | allproduct')
@push('css')
    <link href="{{asset('css/tables.css')}}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

@endpush
@push('js')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <script>
        $(document).ready(function() {
            $('#dtbl').DataTable();
        });
    </script>
@endpush
@section('content')
<div class="container-fluid p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> All Product</h4>
    <a class="btn btn-success export-btn" href="{{ route('export.excel') }}">
        <i class="fas fa-file-excel"></i> Export to Excel
    </a><br><br>
        <div class="card bg-secondary">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header">All Product Information</h5>
          <table class="table" id="dtbl">
            <thead class="table">
              <tr>
                <th>Nama Produk</th>
                <th>Gambar</th>
                <th>Jenis Kategori</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($products as $product)
              <tr>
                <form action=""></form>
                    <td>{{$product->product_name}}</td>
                    <td>   @if(json_decode($product->product_img))<div class="">@foreach(json_decode($product->product_img) as $image)<img src="{{ asset($image) }}" style="height:100px; width:200px;" alt="">@endforeach <br>
                        <a href="{{route('editproductimg',$product->id)}}" class="btn btn-primary">Update Image</a>
                        </div>
                        @else
                        <div class=""><img src="{{asset($product->product_img)}}" height="100em" width="100em" alt=""> <br>
                            <a href="{{route('editproductimg',$product->id)}}" class="btn btn-primary">Update Image</a>
                        </div>
                        @endif
                    <td>{{$product->product_category_name}}</td>
                    </td>
                    @if ($product->quantity === 0)
                    <td><p class="text-danger">Stok Habis</p></td>
                    @else
                    <td>{{$product->quantity}}</td>
                    @endif
                    <td>{{$product->product_deskripsi}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{route('editproduct',$product->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('deleteproduct' ,$product->id)}}" data-name="" class="btn btn-warning delete" id="delete">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
          </table>
        </div>
    </div>
    {{-- {{$products->links()}} --}}
</div>
@endsection
