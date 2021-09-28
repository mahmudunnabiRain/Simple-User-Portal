@extends('layout.home')

@section('title', 'User List')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-between w-100 border-bottom border-dark p-3">
            <h2 class="">User List</h2>
            <input id="search_bar" onchange="searchUsers(this.value)" class="form-control mr-sm-2 w-25" type="search" placeholder="Search">
        </div>
        <div class="container w-100 d-flex flex-column justify-content-center">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody"></tbody>
                </table>
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
        function getAllUsers() {
            $.ajax({
                type:'GET',
                url:'/getallusers',
                success:function(data) {
                    $.each(data, function(index, user) {
                        $('#userTableBody').append(
                        '<tr>\
                            <td>'+user.firstName+' '+user.lastName+'</td>\
                            <td>'+calculateAge(user.birthdate)+'</td>\
                            <td>'+user.email+'</td>\
                            <td>'+user.phone+'</td>\
                        </tr>'
                    );
                    });
                }
            });
        }
        function searchUsers(keyword) {
            if(keyword.length == 0) {
                return;
            }
            $.ajax({
                type: 'GET',
                url: '/searchusers/'.concat(keyword),
                success: function(data) {
                    document.getElementById("userTableBody").innerHTML = '';
                    $.each(data, function(index, user) {
                        $('#userTableBody').append(
                        '<tr>\
                            <td>'+user.firstName+' '+user.lastName+'</td>\
                            <td>'+calculateAge(user.birthdate)+'</td>\
                            <td>'+user.email+'</td>\
                            <td>'+user.phone+'</td>\
                        </tr>'
                        );
                    });
                }
            });
        }

        function calculateAge(birthdate) {
            dob = new Date(birthdate);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            return age;
        }
        $(document).ready(function() {
            getAllUsers();
        });
    </script>

@endsection