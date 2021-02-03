<!DOCTYPE html>
<html>

<head>

    <title>O-Exam | Enter Exam</title>
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
    <div class="w3-top">
        <div class="w3-padding w3-black" style="border-bottom: 2px solid #0750a3;">
    
            <a href = "{{ url('/') }}" target = "_self"> 
                <img src = "/img/logoClickable.jpg" border = "0" /> 
            </a>
    
            @if(auth()->user()->role=='Teacher')    
                <a href="{{ url('/homepage_teacher') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
            @endif  
    
            @if(auth()->user()->role=='Student')  
                <a href="{{ url('/homepage_student') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
            @endif
    
            
        </div>
    
        @if(session('error'))
        <div id="errorDIV" class="alert alert-danger alert-dismissible" style="width: 1918px;">
            <button class="close" onclick="document.getElementById('errorDIV').style.display='none'" style="text-align:right">x</button>
        {{ session('error')}}
        </div>
        @endif
    
    </div>


<form class="container">
    <div class="mx-auto">
        <img src="/img/examToday.png" style="margin-left:20%">
        <br><br>
        @if(auth()->user()->role=='Student')
            <h2 style="text-align:center; color:#0750a3">
                <b style="color:#0750a3">Course:</b>
                <b style="color: black">{{$course->course_name}}</b>
            </h2>
        @endif

        <h2 style="text-align:center;">
            <b style="color:#0750a3">Exam:</b> 
            <b style="color: black">{{$exam->name}}</b>
        </h2>
        <br>

        <h4 style="text-align:center; color:#0750a3">
            <b style="color:#0750a3">Exam Duration:</b>
            <b style="color: black">{{$exam->duration}} min</b>
        </h4>

        <h4 style="text-align:center; color:#0750a3">
            <b style="color:#0750a3">Attempts-Allowed:</b>
            <b style="color: black">{{$exam->attempts_allowed}}</b>
        </h4>
        <br>

        <h5><a href="/{{$course->id}}/exam/{{$exam->id}}" style="margin-left:225px;" class="personalInfoLink">Enter the Exam<a></h5>
    </div>
</form>

    
 
</body>
</html>