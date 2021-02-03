<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Prepare Question</title>
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
            <a href="/teacher_courses/{{$courses->id}}" class="personalInfoLink" style="padding:7px 47.5px;">My Exams</a>
            <br><br>
            <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/questiontypeselect" class="personalInfoLink" 
                style="background-color:#f44336; padding:7px 61.5px;">Cancel</a>
        </li>
        </ul>
    </nav>

            <form action="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam->id}}/addexamquestionT" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 75px">
                <div class="form">
                    <div class="form-content" style="background-color: white; width: 800px;margin-top:40px">
                        <h2 style="text-align:center;"><b>Prepare Question</b></h2><br>
                        <h2 style="text-align:center;"><b>{{$courses->course_name}}</b></h2>
                        <h2 style="text-align:center;"><b>{{$exam->name}}</b></h2>

                        <br>
                        <div class="row" style="width: 900px">
                            <div class="col-md-6">

                            <div class="form-group">
                                    <label style="margin-left: 150px" class="col-md-6 control-label">Question Type:</label>
                                    <select style="width:100%; height:1.3cm; margin-left:150px;" class="form-control input-md" name="answer_type" id="qtype" readonly>
                                        <option value='Text'>Text</option>
                                    </select>
                            </div>

                            <div class="form-group">
                                    <label style="margin-left:150px;" class="col-md-6 control-label">Question:</label>
                                    <textarea name="question" style="height: 190px; resize:none; margin-left:150px;" type="text" class="form-control input-md" required=""></textarea>
                                   
                            </div>

                            <div class="form-group">
                                    <label style="margin-left:150px;" class="col-md-6 control-label">Question Point:</label>
                                    <input style="margin-left:150px;" name="evaluation_grade" id="qpoint" type="number" class="form-control input-md" required="" min="1">
                            </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:290px; width:2.5cm;" id="save"  class="btn btn-success">Save</button>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </body>
</html>


