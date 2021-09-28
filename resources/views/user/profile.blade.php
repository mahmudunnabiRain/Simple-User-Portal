@extends('layout.home')

@section('title', 'Profile')

@section('content')
    <div class="d-flex flex-column">
        <div class="w-100 text-center border-bottom border-dark p-3">
            <h2>User Profile</h2>
        </div>
        <div class="container w-50 d-flex justify-content-center mt-5">
            <div class="col-3">
                <div class="row"><h5>First Name</h5></div>
                <div class="row"><h5>Last Name</h5></div>
                <div class="row"><h5>Adress</h5></div>
                <div class="row"><h5>Phone</h5></div>
                <div class="row"><h5>Email</h5></div>
                <div class="row"><h5>Birthdate</h5></div>
            </div>
            <div class="col-1">
                <div class="row"><h5>:</h5></div>
                <div class="row"><h5>:</h5></div>
                <div class="row"><h5>:</h5></div>
                <div class="row"><h5>:</h5></div>
                <div class="row"><h5>:</h5></div>
                <div class="row"><h5>:</h5></div>
            </div>
            <div class="col-5">
                <div class="row"><h5>{{ Auth::user()->firstName }}</h5></div>
                <div class="row"><h5>{{ Auth::user()->lastName }}</h5></div>
                <div class="row"><h5>{{ Auth::user()->address }}</h5></div>
                <div class="row"><h5>{{ Auth::user()->phone }}</h5></div>
                <div class="row"><h5>{{ Auth::user()->email }}</h5></div>
                <div class="row"><h5>{{ date("d-m-Y", strtotime(Auth::user()->birthdate)) }}</h5></div>
            </div>
        </div>
        
    </div>
@endsection