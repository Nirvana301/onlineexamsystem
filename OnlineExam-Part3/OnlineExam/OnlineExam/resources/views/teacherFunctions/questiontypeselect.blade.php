<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | PreperaExam</title>
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
          background-image: url('/img/grayBackground.png');
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

        @if(session('error'))
        <div id="errorDIV" class="alert alert-danger alert-dismissible" style="width: 1918px;">
        {{ session('error')}}
        </div>

        <script>
            setTimeout(function() {
            $('#errorDIV').fadeOut('fast');
        }, 3750); 
        </script>
        @endif

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

        <!-- password errors-->
        @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
        <li>{{$error}}</li>
        </div>    
        @endforeach
        @endif

    </div>
                      <br><br><br><br>
                        <h2 style="text-align:left;"><b>{{$courses->course_name}}</b></h2>
                        <h2 style="text-align:left;"><b>{{$exam->name}}</b></h2>

                        <a href="/teacher_courses/{{$courses->id}}" class="w3-left w3-button">My Exams</a><br><br><br>
                        <h2 style="text-align:left;"><b>Select a Question Type</b></h2><br>
                        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/addexamquestionMC" class="w3-center w3-button">MultipleChoice</a>

                        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/addexamquestionT" class="w3-center w3-button">Text</a>





    </body>
</html>