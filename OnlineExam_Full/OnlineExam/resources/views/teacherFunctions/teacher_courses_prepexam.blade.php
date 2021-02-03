<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Prepare Exam</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    </div>

  
    <nav class="navbar header-top fixed-top navbar-expand-lg" style="margin-top: 130px;">
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <li class="nav-item">
        <a href="/teacher_courses/{{$courses[0]->id}}" class="personalInfoLink" style="padding:7px 47.5px;">My Exams</a>
        </li>
        </ul>
    </nav>

            <form action="/teacher_courses/{{$courses[0]->id}}/teacher_courses_prepexam/" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 110px">
                <div class="form">
                    <div class="form-content" style="background-color: white;">
                        <h2 style="text-align:center;"><b>Prepare Exam</b></h2>
                        <h2 style="text-align:center;"><b>{{$courses[0]->course_name}}</b></h2><br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam Name</label>
                                    <input name="name" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam Date & Hour</label>
                                    <input name="date" type="datetime-local" class="form-control input-md" required="" >
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam Duration</label>
                                    <input name="duration" type="number" class="form-control input-md"  required="" min="1">
                                </div>
                            </div>

                            <div class="col-md-6">
                               
                               
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Attempts-Allowed</label>
                                    <input name="attempts_allowed" type="number" class="form-control input-md" required="" min="1">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:393px; width:2.5cm;" id="save"  class="btn btn-success">Save</button>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </body>
</html>
