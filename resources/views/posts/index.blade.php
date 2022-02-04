@extends('layouts.app')

@section('content')
<style>

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                      @csrf
                     <div class="tweet-text-container">
                        <input type="text" placeholder="Whats Happening!" name="body" autofocus>
                     </div>
                     <label class="custom-file-upload">
                        <input type="file" name="image" onchange="readURL(this);"/>
                        <img src="{{ asset('images/file-upload-icon.png') }}" width="32" height="32">
                    </label>                    
                      <div id="image-preview-container">
                        <img id="preview-img" height="100%" width="100%">
                      </div>
                      <div>
                        <button class="tweetBtn">Tweet</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
                   @foreach ($posts as $p)
                   <div class="card">
                       <div class="card-body">  
                        <div class="profile-container">
                            <div class="profile-icon">
                                <img id="preview-img" src="https://st2.depositphotos.com/1006318/5909/v/950/depositphotos_59095055-stock-illustration-profile-icon-male-avatar.jpg" alt="img" height="100%" width="100%" style="border-radius: 999px">
                            </div>
                           <div class="follow-container">
                            <p>{{ $p->user->name }} <span style="color: rgb(172, 156, 156)">{{ $p->created_at->diffForHumans() }}</span></p> 
                           </div>
                        </div> 
                        <div>
                           <p style="margin-left: 50px;margin-top:-12px">{{ $p->body }}</p>
                        </div>
                        <div>
                            <img src="{{ asset('uploads/images/').'/'.$p->image }}" alt="image" height="100%" width="100%">
                        </div>
                       </div>
                    </div>
                   @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-img').attr('src', e.target.result);
                    $('#preview-img').css('display', 'block');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
