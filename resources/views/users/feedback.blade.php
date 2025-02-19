
    @extends('users.layouts.userprofile')

    @section('profilecontent')
        <br><br>
        <h3>Feedback Tentang Resto</h3>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <a href="{{ route('userprofile') }}" class="">< Kembali</a> <br><br>
            <br>
        @if($feedback->isEmpty())
        <center><p style="font-size: 30px; color: white;">Belum ada feedback yang dilakukan.</p></center>
    @else
            @foreach ($feedback as $item)
                <div class="card mb-3">
                    <div class="card-body" style="color: black;">
                        <h3 class="card-title" style="font-weight: bold;">Feedback Anda</h3>
                        <div class="card-text" id="message_{{ $item->id }}" contenteditable="true">{{ $item->message }}</div>
                        <p class="card-text"><small class="text-muted">{{ $item->created_at }}</small></p>

                    </div>
                </div>
            @endforeach
        @endif

    <br><br><br><br>
    <hr>
@endsection
