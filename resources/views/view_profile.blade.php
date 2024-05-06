@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">User Profile</h2>
                    </div>
                    <div class="card-body">
                        @auth
                            <h3>Welcome, {{ auth()->user()->name }}</h3>
                            <div class="mb-3">
                                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            </div>
                        @endauth
                        @guest
                            <p>Please <a href="{{ url('login') }}">sign in</a> to view your profile.</p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
