<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | My Panel</title>
    <link rel="shortcut icon" href="/img/titleImg.png" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
</div>

<div class="container3" style="margin-top: 5%; margin-left:1%;">
    <br>
    <h1><u><a href="/teacher_courses/{{$courses->id}}">{{ $courses->course_name }}</a></u></h1><br>
    <h5>
        <a href="/teacher_courses/{{$courses->id}}/teacher_courses_prepexam" style="text-decoration: none">
            <img src="/img/examImg.jpg" class="img-thumbnail" style="border-radius:50%;" width="75" height="75">&nbsp;Prepare Exam for This Course
        </a>
    </h5>
    <br><br>

        <table id="exams">
            <h5>Details of Prepared Exams</h5> 
            <tr>
                <th>Exam ID</th>
                <th>Exam Name</th>
                <th>Exam Date & Hour</th>
                <th>Action</th>
            </tr>

            @foreach ($exam as $exams)
             
            <tr>
                <td><h5>{{ $exams->id}}</h5></td>
                <td><h5><b><a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exams->id}}" style="text-decoration: none">
                    <img src="/img/examImg.jpg" class="img-thumbnail" style="border-radius:50%;" width="75" height="75">&nbsp;{{ $exams->name }}</a></b></h5>
                </td>
                <td><h5>{{ $exams->date }}</h5></td>
                <td><a onclick="return confirm('Are you sure to delete this exam?')" href="/teacher_courses/{{$courses->id}}/deleteexam/{{$exams->id}}" class="deleteLink" id="delete">Delete</a></td>
            </tr>
          


            
            @endforeach  
        </table>
        
</div>

</body>
</html>
