@extends('layout.main')

@section('title', 'Registration')

@section('body')
    <div class="container d-flex mt-5">

        <div class="col">
            <div class="row justify-content-center">
                <img src="{{URL('/images/user_profile_logo.png')}}" alt="Profile Logo" style="width: 60px; height: 60px;" class="img-thumbnail">
            </div>
            <div class="row justify-content-center mt-2">
                <h4>Registration Panel</h4>
            </div>
            <div class="row justify-content-center mt-2">

                <div class="border border-dark rounded-sm p-4" style="width: 500px">
                    <form action="{{ route('createUser') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstName" name="firstName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" oninput="verifyEmail(this.value)" class="form-control" id="email" name="email">
                                <small id="emailHelp" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthdate" class="col-sm-3 col-form-label">Birthdate</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birthdate" name="birthdate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                    

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <div class="col">
                                <a type="button" href="{{ route('login') }}" class="btn btn-danger btn-block">Cancel</a>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function verifyEmail(email) {
            if(email.length == 0) {
                document.getElementById("emailHelp").innerHTML = "";
                return;
            }
            $.ajax({
                type: 'GET',
                url: '/verifyemail/'.concat(email),
                success: function(data) {
                    if(data.registered == 'yes')
                        document.getElementById("emailHelp").innerHTML = "Email already taken.";
                    else
                        document.getElementById("emailHelp").innerHTML = "";
                }
            });
        }
    </script>
    
@endsection
