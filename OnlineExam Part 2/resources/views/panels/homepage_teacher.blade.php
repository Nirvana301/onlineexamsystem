<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | Your Panel</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
     }
     </script>

</head>

<div class="container3">
    <div class="card">
        <div class="card-body">
            
            <h1>Welcome Teacher
            <br>    
            {{ $full_name }}</h1> 
            <br>
            <p><a href="{{ url('/profile_info') }}">Profile</a></p>
            <p><a href="{{ url('/logout') }}" class="logoutLink">Logout</a></p>

        </div>
    </div>
</div>

</html>