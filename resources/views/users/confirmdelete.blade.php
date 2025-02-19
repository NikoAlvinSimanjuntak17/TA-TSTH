@extends('users.layouts.userprofile')

@section('profilecontent')
    <br><br>
    <h3>Konfirmasi Hapus Reservasi</h3>
    <br>
    <div class="card bg-dark text-white">
        <div class="card-body">
            <h4 class="card-title" style="font-weight: bolder; font-size:30px; "> {{ $reservation->name }}</h4>
            <p class="card-text" style="color:gray;"><strong>Tanggal:</strong> {{ $reservation->date }}</p>
            <p class="card-text" style="color:gray;"><strong>Waktu:</strong> {{ substr($reservation->time, 0, 5) }}</p>
            <p class="card-text" style="color:gray;"><strong>Jumlah Orang:</strong> {{ $reservation->people }}</p>
            <p class="card-text" style="color:gray;"><strong>Pesan:</strong> {{ $reservation->message }}</p>
            <p class="card-text" style="color:gray;"><strong>Status:</strong>
                @if($reservation->status == 'confirmed')
                    <span class="badge badge-success">Confirmed</span>
                @elseif($reservation->status == 'pending')
                    <span class="badge badge-danger">Pending</span>
                @else
                    <span class="badge badge-secondary">{{ $reservation->status }}</span>
                @endif
            </p>
        </div>
        <div class="card-footer">
            <div class="btn-group" role="group">
                <form action="{{ route('deletereservation', $reservation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <a href="{{ route('peddingreservations') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
    </div>
@endsection
