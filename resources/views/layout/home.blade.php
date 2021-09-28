@extends('layout.main')

@section('title', 'Home')

@section('body')

<style>

/* The top navbar */
.navbar {
  position: sticky; /* Set the navbar to fixed position */
  top: 0; /* Position the navbar at the top of the page */
  width: 100%; /* Full width */
}

/* The side navigation menu */
.sidebar {
  margin: 0;
  padding: 0;
  width: 180px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: hidden;
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 180px;
  padding: 0px;
  height: auto;
}

</style>

<!-- Top navbar -->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand font-weight-bold" href="#">Navigation</a>

    <div class="dropdown">
            <a class="dropdown-toggle text-white" href="#" style="text-decoration:none;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ request()->is('admin') ? 'Admin' : Auth::user()->firstName}} {{ request()->is('admin') ? '' : Auth::user()->lastName}}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Change Password</a>
                <div class="dropdown-divider"></div>
                <form class="dropdown-item" action="{{ route('logoutUser') }}" method="post">
                  @csrf
                  <button class="btn btn-danger btn-block" type="submit">Logout</button>
                </form>
            </div>
    </div>
</nav>

 <!-- The sidebar -->
<div class="sidebar">
  @if(Session::has('isAdmin'))
  <a class="{{ request()->is('admin') ? 'active' : ''}}" href="{{ route('userlist') }}">User List</a>
  @else
  <a class="{{ request()->is('profile') ? 'active' : ''}}" href="{{ route('profile') }}">Profile Page</a>
  <a class="{{ request()->is('change_password') ? 'active' : ''}}" href="#">Change Password</a>
  @endif
</div>

<!-- Page content -->
<div class="content">
  @yield('content')
</div> 
@endsection
