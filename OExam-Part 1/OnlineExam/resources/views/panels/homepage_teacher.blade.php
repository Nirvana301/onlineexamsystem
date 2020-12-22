<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | Homepage</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>

<div class="container3">

    <div class="card">

        <div class="card-body">
            
            <h1>Welcome Teacher
            <br>    
            {{ $full_name }}</h1> 
            <br>

            <p><a href="{{ url('/logout') }}" class="logoutLink">Logout</a></p>

        </div>
    </div>
</div>

</html>