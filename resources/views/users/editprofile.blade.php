@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Profile')
@section('csss')
<style>
    .header {
        background-color: #000000;
    }
    body{
        background-color: black;
    }
    .text-center img{
        width: 300px;
    }
    .container h1{
        color: #cda45e !important;
    }
    .password{
        margin-left: 320px;
        margin-top: 10px;
    }
    .dropdown-menu {
    display: none !important; /* Hide the dropdown menu by default */
    background-color: rgba(0, 0, 0, 0.8); /* Black with 80% opacity */
}

.navbar .dropdown:hover .dropdown-menu {
    display: block !important; /* Show the dropdown menu when the dropdown toggle is hovered */

}
.navbar .dropdown .dropdown-menu a:hover{
    color: black;
}



</style>
@endsection
@section('css')
<style>


</style>
@endsection
@section('main-content')
<br><br><br><br><br><br>
<br><br><br>

<div class="container bootstrap snippets bootdey">
    @if (session()->has('message'))
                <div id="alert" class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @elseif (session()->has('error'))
                <div id="alert" class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
    <h1 class="text-primary">Profile</h1>
    <a href="{{ route('userprofile') }}" class="">< Kembali</a> <br><br>

    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                @if (empty(Auth::user()->user_img))
                    <img src="{{asset('users/img/profil.png')}}" class="avatar img-circle img" alt="avatar">
                @else
                    <img src="{{asset(Auth::user()->user_img)}}" class="avatar img-circle img" alt="avatar">
                @endif
                <br><br>
                <h6>Upload a different photo...</h6>
                <form action="{{route('updategambar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="user_img">
                    <input type="submit" class="btn btn-success mt-2" value="Update Gambar">
                </form>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <h3>Personal info</h3>
            <form action="{{ route('editprofile') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-lg-3 control-label">User Name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="email" value="{{Auth::user()->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Tanggal Lahir:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="date" name="birth" value="{{Auth::user()->birthdate}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nomor Telepon:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="phone" value="{{Auth::user()->phone}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Alamat:</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="address" required>{{Auth::user()->address}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 text-center">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="password col-lg-8">
    <section>
        <center>
            @if (session('status') === 'password-updated')
    <p class="text-sm text-gray-600 dark:text-gray-400" id="status-message" style="background-color: #34D399; color: #000; font-size: 1.25rem;">
        {{ __('Password anda berhasil diganti') }}
    </p>
    <script>
        setTimeout(function() {
            document.getElementById('status-message').remove();
        }, 5000);
    </script>
@endif

        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 ">
                Ubah Password
            </h2>
            <p class="mt-1 text-sm text-gray-600 text-danger">
                Anda dapat mengubah password anda.<br>Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman
            </p>
        </header>

        </center>
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Password Lama
                </label>
                <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                @if($errors->updatePassword->has('current_password'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('current_password') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Password Baru
                </label>
                <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
                @if($errors->updatePassword->has('password'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('password') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                @if ($errors->updatePassword->has('password_confirmation'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <br><br>
            <div class="flex items-center gap-4">
                <center>
                <button class="btn btn-success">
                    Simpan Perubahan
                </button>
                </center>


            </div>
        </form>
    </section>
</div>
<br><br><br><br><br>

@endsection
