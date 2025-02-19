@extends('admin.layouts.template')
@section('title', 'Admin | allcategory')
@push('css')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dtbl').DataTable();
        });
    </script>
@endpush
@section('content')
    <div class="container-fluid p-5">
        <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> All Categori</h4>
        <div class="card bg-secondary">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif


            <div class="table-responsive container text-nowrap">
                <h5 class="card-header">All category</h5>
                <table class="table" id="dtbl">
                    <thead class="table">

                        <tr>
                            <th>ID</th>
                            <th>Nama Categori</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $categori)
                            <tr>
                                <td>{{ $categori->id }}</td>
                                <td>{{ $categori->category_name }}</td>
                                <td>
                                    <a href="{{ route('editcategory', $categori->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deletecategory', $categori->id) }}" class="btn btn-warning"id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
