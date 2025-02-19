@extends('admin.layouts.template')
@section('title','Admin | peddingreservations')
@section('content')
<div class="container-fluid p-5">

    <div class="card p-2 bg-secondary">
        <div class="container text-center">
            <div class="row">
              <div class="col text-start">
                <h4>Reservation Detail</h4>
                <hr>
                <p>Reservation Id : {{$pedding->id}}</p>
                <p>Reservation Date : {{($pedding->date)}}</p>
                <p>Reservation Time : {{($pedding->time)}}</p>
                <h5 style="border: 1px solid black;color:chartreuse" class="p-2">Reservation Status Message : {{$pedding->status}}</h5>
            </div>
              <div class="col text-start">
                  <h4>Reservation Detail</h4>
                  <hr>
                  <p>user Id : {{$pedding->user_id}}</p>
                  <p>username : {{$pedding->name}}</p>
                  <p>Phone : {{$pedding->phone}} </p>
                <p>People : {{$pedding->people}}</p>
                <p>Message : {{$pedding->message}}</p>
            </div>
        </div>
    </div>
        <div class="table-responsive text-nowrap container pb-4">

<hr>
<div class="row">

@if ($pedding->status == 'pending' || $pedding->status == 'success')
    <h4 class="mt-5">Reservation Procces (Reservation Status Updates)</h4>
@endif

<hr>
</div>


@if ($pedding->status === 'pending')
<div class="row d-flex">
    <div class="col">
        <form method="POST" action="{{ route('approveReservation', $pedding->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Approve</button>
        </form>
            </div>
    <div class="col">
        <form action="{{ route('rejectReservation', $pedding->id) }}" method="GET">
            @csrf
            <input type="submit" class="btn btn-danger" value="Reject">
        </form>
    </div>
</div>
@elseif($pedding->status === 'success')
<div class="row d-flex">
    <div class="col">

        <form method="POST" action="{{ route('cancelReservation', $pedding->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Cancel</button>
        </form>
            </div>
            <div class="col">
        <form action="{{ route('rejectReservation', $pedding->id) }}" method="GET">
            @csrf
            <input type="submit" class="btn btn-danger" value="Reject">
        </form>
    </div>
</div>
@endif
</div>
</div>
<a href="{{route('pendingreservation')}}" class="btn btn-danger float-end mt-3">Back</a>
</div>
@endsection
