@extends('users.layouts.userprofile')

@section('profilecontent')
    <section id="book-a-table" class="book-a-table">
        <div class="container" data-aos="fade-up">
            <div class="section text-center">
                <h2 >Edit Reservasi</h2>
            </div><br>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{ route('updatereservation', $reservation->id) }}" method="POST" class="reservasi">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $reservation->name }}" required>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $reservation->email }}" required>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                        <label for="phone">Telepon:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $reservation->phone }}" required>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group mt-3" style="color: #f9f9f9;">
                        <label for="date">Tanggal:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $reservation->date }}" required>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group mt-3">
                        <label for="time">Waktu:</label>
                        <input type="time" class="form-control" id="time" name="time" value="{{ $reservation->time }}" required>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group mt-3">
                        <label for="people">Jumlah Orang:</label>
                        <input type="number" class="form-control" id="people" name="people" value="{{ $reservation->people }}" required>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="message">Pesan Tambahan:</label>
                    <textarea class="form-control" id="message" name="message">{{ $reservation->message }}</textarea>
                </div><br><br>
                <div class="text-center"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
            </form>
        </div>
    </section>
@endsection
