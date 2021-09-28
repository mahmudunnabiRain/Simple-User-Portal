@extends('layout.main')

@section('title', 'Login')

@section('body')
    <div class="container d-flex mt-5">

        <div class="col">
            <div class="row justify-content-center">
                <img src="{{URL('/images/user_profile_logo.png')}}" alt="Profile Logo" style="width: 60px; height: 60px;" class="img-thumbnail">
            </div>
            <div class="row justify-content-center mt-2">
                <h4>Login Panel</h4>
            </div>
            <div class="row justify-content-center mt-2">

                <div class="border border-dark rounded-sm p-4" style="width: 400px">
                    <form action="{{ route('loginUser') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="col">
                                <button type="button" onclick="clearInputs()" class="btn btn-danger btn-block">Clear</button>
                            </div>
                        </div>

                    </form>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Are you new here? <a href="{{ url('registration') }}" class="ml-2"><u>Register Now</u></a>
                        </div>
                    </div>

                    @if($errors->any())
                            <div class="d-flex justify-content-center errors mt-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                </div> 
            </div>
        </div>
    </div> 

    <script type="text/javascript">
        function clearInputs() {
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";
        }
    </script>

@endsection
