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
            
            <h1>Welcome Admin
            <br>  
            {{ $full_name }}</h1>  
            <br>

            <p><a href="{{ url('/homepage_admin/add_user') }}">Add User</a></p>
            <p><a href="{{ url('/homepage_admin/manage_user') }}">Manage Users</a></p>
            <p><a href="{{ url('/profile_info') }}">Profile</a></p>
            <br>
            <a href="{{ url('/logout') }}" class="logoutLink">Logout</a>

        </div>
    </div>
</div>

</html>