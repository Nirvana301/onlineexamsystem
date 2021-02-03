<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Add Question</title>
    <link rel="shortcut icon" href="/img/titleImg.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
        }
      </script>

    <style>
        body {
          background-image: url('/img/logoBackground.png');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: 100% 100%;
        }
    </style>

    </head>

    <body>
            
    <!-- Links (sit on top) -->
    <div class="w3-top">
        <div class="w3-padding w3-black" style="border-bottom: 2px solid #0750a3;">
        <a href = "{{ url('/') }}" target = "_self"> 
            <img src = "/img/logoClickable.jpg" border = "0" /> 
         </a>
         <a href="{{ url('/homepage_teacher') }}" class="w3-right w3-button">My Panel</a>
         
        </div>
    </div>

    <div class="container3" style="margin-top: 5%; margin-left:1%;">
        <br>

        <h1><u><b><a href="/teacher_courses/{{$courses->id}}" style="color:#007bff">{{ $courses->course_name }}</a></b></u>
            &nbsp;<a style="color:#0750a3">/</a>&nbsp;
            <u><b><a href="" style="color:#007bff">Add Question</a></b></u>
        </h1>
        <br>
    
        <h2 style="text-align:left; color: #0750a3"><b>Exam Name: {{$exam->name}}</b></h2>
        <br>
        <h3 style="text-align:left;">Select a Question Type</h3>
        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/addexamquestionMC" class="w3-center w3-button">Multiple Choice</a>&nbsp;&nbsp;
        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/addexamquestionT" class="w3-center w3-button">Text</a>

    </div>

</body>
</html>