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
            
            <h1>Welcome Student 
            <br>  
            {{ $full_name }}</h1>  
            <br>


@foreach ($coursesStu as $course1)
<tr>
<td><a href="{{ url('/profile') }}">{{ $course1 ->course_name }}</a></td>
</tr>
@endforeach

            <p><a href="{{ url('/profile') }}">Profile</a></p>
            <p><a href="{{ url('/logout') }}" class="logoutLink">Logout</a></p>

        </div>
    </div>
</div>

</html>