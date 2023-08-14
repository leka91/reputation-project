@extends('index')

@section('title', '| Landing page')

@section('content')
    <div class="container-fluid bg-light p-5">
        <div class="container bg-light p-5">
            <h1 class="display-5">Welcome to {{ config('app.name') }}</h1>
            <p class="mb-5">Check your reputation score</p>
            <hr>
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('dashboardPost') }}" method="POST">
                @csrf
                <label for="basic-url" class="form-label">Your domain URL</label>
                <div class="input-group mb-3 @error('domain') has-validation @enderror">
                    <span class="input-group-text" id="basic-addon">https://example.com/</span>
                    <input type="text" name="domain" class="form-control  @error('domain') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon">
                    
                    <button class="btn btn-primary" type="submit" id="basic-addon">Check</button>
                    @error('domain')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div> 
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection