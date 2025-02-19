@extends('admin.layouts.template')
@section('title','Admin | editroductimg')
@section('content')
<div class="container">
    <br>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Ubah Password
                            </h2>
            <p class="mt-1 text-sm text-gray-600 text-danger">
                Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Password Lama
                </label>
                <input id="current_password" name="current_password" type="password" class="form-control bg-secondary" autocomplete="current-password" placeholder="masukkan password lama anda.." />
                @if($errors->updatePassword->has('current_password'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('current_password') }}
                    </span>
                @endif
            </div>
            <br>

            <div class="form-group">
                <label for="password" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Password Baru
                </label>
                <input id="password" name="password" type="password" class="form-control bg-secondary" autocomplete="new-password" placeholder="masukkan password baru"/>
                @if($errors->updatePassword->has('password'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('password') }}
                    </span>
                @endif
            </div>
            <br>

            <div class="form-group">
                <label for="password_confirmation" class="block font-medium text-lg text-gray-900 dark:text-gray-100">
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control bg-secondary" autocomplete="new-password" placeholder="konfirmasi password"/>
                @if ($errors->updatePassword->has('password_confirmation'))
                    <span class="text-sm text-danger">
                        {{ $errors->updatePassword->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <br><br>
            @if (session('status') === 'password-updated')
            <p class="text-sm text-gray-600 dark:text-gray-400" id="status-message">
                {{ __('Password anda telah berhasil diperbaharui') }}
            </p>
            <script>
                setTimeout(function() {
                    document.getElementById('status-message').remove();
                }, 5000);
            </script>
        @endif
            <div class="flex items-center gap-4">
                <button class="btn btn-success">
                    Save
                </button>


            </div>
        </form>

    </section>
</div><br><br><br>
@endsection
