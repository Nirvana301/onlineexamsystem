<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | Homepage</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>

<div class="container3">

    <div class="card">

        <div class="card-body">
            
            <h1>Welcome Admin
            <br>  
            {{ $full_name }}</h1>  
            <br>

            <p><a href="{{ url('/homepage_admin/add_user') }}">Add User</a></p>
            <p><a href="{{ url('/homepage_admin/manage_user') }}">Manage Users</a></p>
            <br>
            <a href="{{ url('/logout') }}" class="logoutLink">Logout</a>

        </div>
    </div>
</div>

</html>