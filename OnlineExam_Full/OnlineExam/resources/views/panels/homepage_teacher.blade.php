<!DOCTYPE html>
<html>
<title>O-Exam | My Panel</title>
<link rel="shortcut icon" href="/img/titleImg.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />

<head>

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
     }
     </script>

</head>
<body>

<div id="navbar" class="w3-container">
    <a href = "{{ url('/') }}" target = "_self"> 
        <img src = "/img/logoClickable.jpg" border = "0" /> 
    </a>

    @foreach ($users as $user)
    <img src="/profile_photos/{{$user->avatar}}" class="userpicture" style="border-radius:50%" width="75"
         height="75" border="0" align="right"/>
    @endforeach

    <a href="/profile" title="View your profile" class="h5" style="margin-top:1.5%; margin-right:15px;" aria-level="1" id="text">{{ $full_name }}</a>

    <div id="panel" class="w3-bar w3-blue">
        <a href="/homepage_teacher" class="w3-bar-item w3-button w3-mobile">Courses</a>
        <a href="{{route("announcement.create") }}" class="w3-bar-item w3-button w3-mobile">Add Announcement</a>
        <a href="{{ url('/profile') }}" class="w3-bar-item w3-button w3-mobile">Profile</a>
        <a href="{{ url('/message') }}" class="w3-bar-item w3-button w3-mobile">Message</a>
        <a href="{{ url('/logout') }}" class="w3-bar-item w3-button w3-mobile">Logout</a>


    </div>
    <div id="genel">
        <div id="courses">
            @foreach ($courses as $course)
                        <div id="course">
                            <b><a href="/teacher_courses/{{$course->id}}">{{ $course->course_name }} </a></b>
                            <a href = "/teacher_courses/{{$course->id}}" target = "_self"> 
                                <img src="/img/dersresmi.png" type="submit" style="border-radius:50%;" height="90%">
                            </a>
                            
                            <a href="{{route("announcement.list",$course) }}">Announcements</a>
                        </div>
            @endforeach
        </div>
    </div>

</div>

</div>
</div>
</body>
</html>
