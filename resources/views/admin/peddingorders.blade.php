@extends('admin.layouts.template')
@section('title','Admin | peddingorders')
@push('css')
    <link href="{{asset('css/tables.css')}}" rel="stylesheet" />
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
    <h4 class="fw-bold py-3 mb-4"><span class="text fw-light">Pages / </span> Pedding Order</h4>
    <a class="btn btn-success export-btn" href="{{ route('export.excel.order') }}">
        <i class="fas fa-file-excel"></i> Export Data Pesanan
    </a><br><br>
    <div class="card mb-5 bg-secondary">
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header" style="color: rgb(180, 2, 2);">LIST ORDER</h5>
        <table class="table" >
            <tr style="color: white;">
    <th>Customer Name</th>
    <th>Status</th>
    <th>OrderDate</th>
    <th>Pembayaran</th>
    <th>Action</th>
            </tr>
    @foreach ($pending_orders as $order)
    <tr>
        <td>{{$order->nama}}</td>
        <td>
            @if($order->status == 'paid')
            *{{$order->status}}
            @else
                {{$order->status}}
            @endif
        </td>        <td>{{ \Carbon\Carbon::parse($order->time)->format('d M Y')}}</td>
        <td>
            @if($order->status == 'paid' || $order->status == 'in progress' || $order->status == 'selesai')
                sudah dibayar
            @else
                belum dibayar
            @endif
        </td>

        <td><a href="{{route('pendingorderdetail',$order->id)}}" class="btn btn-primary">Detail</a></td>
    </tr>
    @endforeach
        </table>
<p style="font-size: smaller; margin-left:68em;">Note : * Menunggu Konfirmasi</p>
 </div>
    </div>

     <div class="card bg-secondary">
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header" style="color: rgb(180, 2, 2);">RIWAYAT ORDER</h5>
        <table class="table" >
            <tr style="color: white;">
    <th>Customer Name</th>
    <th>Status</th>
    <th>OrderDate</th>
    <th>Action</th>
            </tr>
    @foreach ($pending_selesai as $order)
    <tr>
        <td>{{$order->nama}}</td>
        <td>{{$order->status}}</td>
        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y')}}</td>
        <td><a href="{{route('pendingorderdetail',$order->id)}}" class="btn btn-primary">Detail</a></td>
    </tr>

    @endforeach
        </table>
 </div>
    </div>
    </div>
@endsection
