<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | Exam Submissions</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="/img/titleImg.png" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    <style>
        body {
        background-image: url('/img/logoBackground.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        }
    </style>

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
        }
    </script>

</head>

<body>
    <!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-padding w3-black" style="border-bottom: 2px solid #0750a3;">

        <a href = "{{ url('/') }}" target = "_self"> 
            <img src = "/img/logoClickable.jpg" border = "0" /> 
        </a>

        @if(auth()->user()->role=='Teacher')    
            <a href="{{ url('/homepage_teacher') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
        @endif  

        @if(auth()->user()->role=='Assistant')  
            <a href="{{ url('/homepage_assistant') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
        @endif

        @if(auth()->user()->role=='Student')  
            <a href="{{ url('/homepage_student') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
        @endif
 
    </div>

    @if(session('success'))
        <div id="successDIV" class="alert alert-success alert-dismissible" style="width: 1918px;">
        {{ session('success')}}
        </div>

        <script>
            setTimeout(function() {
            $('#successDIV').fadeOut('fast');
        }, 3750); 
        </script>
    @endif

</div>

<div class="container3" style="margin-top: 5%; margin-left:1%;">
    <br><br>

            <h1><u><a href="/teacher_courses/{{$course->id}}">{{ $course->course_name }}</a></u>
                &nbsp;<a style="color:#0750a3">/</a>&nbsp;
                <u><a href="" >Submissions</a></u>
            </h1>
            <br>
            <h1><td>{{ $exam->name }}</td></h1>
            <br>

            <table id="exams"> 
                <h5>Participants</h5> 
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                </tr>
            
                @foreach($students as $student)
                        <tr>
                            <td><h5><b>{{ $student->id }}</b></h5></td>
                            <td><h5><b><a href="/{{ $course->id }}/exam/{{ $exam->id }}/evaluate/{{ $student->id }}">{{$student->full_name}}</a></b></h5></td>
                        </tr>
                @endforeach
            </table>

</div>

</body>
</html>