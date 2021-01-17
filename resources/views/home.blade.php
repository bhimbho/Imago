@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ Route('home') }}">Home</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="{{ Route('user_images.index') }}">My Images</a>
                        {{-- <a class="flex-sm-fill text-sm-center nav-link" href="#">Bulk Images</a> --}}
                        {{-- <a class="flex-sm-fill text-sm-center nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Logout</a> --}}
                      </nav>
                      <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-warning">Image(s) Added ! ({{ $images->count() }})</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-dark text-white">Private Images ({{ $private->count() }})</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-warning">Public Images ({{ $public->count() }})</div>
                                </div>
                            </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
