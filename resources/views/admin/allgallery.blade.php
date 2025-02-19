@extends('admin.layouts.template')
@section('title','Admin | All Gallery')
@section('content')
<div class="container-fluid p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> All Gallery</h4>
    <div class="card bg-secondary">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header" style="color: rgb(180, 2, 2);">ALL GALLERY</h5>
            <table class="table" id="dtbl">
                <thead class="table">
                    <tr>
                        <th>TITLE</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{ $gallery->title }}</td>
                        <td>
                            <img src="{{ asset('images/'.$gallery->image) }}" style="height:100px; width:200px;" alt="">
                        </td>
                        <td>
                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this gallery?')">Delete</button>
                            </form>
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
