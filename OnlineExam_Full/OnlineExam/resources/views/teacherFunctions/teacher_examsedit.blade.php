<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <head>

    <title>O-Exam | Edit Exam</title>
   
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

        <!-- password errors-->
        @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
        <li>{{$error}}</li>
        </div>
        @endforeach
        @endif

    </div>

    <nav class="navbar header-top fixed-top navbar-expand-lg" style="margin-top: 130px;">
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <li class="nav-item">
            <a href="/teacher_courses/{{$courses->id}}" class="personalInfoLink" style="padding:7px 47.5px;">My Exams</a>
            <br><br>
            @if($exam[0]->date < $currentdate)
            <a href="/{{$courses->id}}/exam/{{$exam[0]->id}}/participants" class="personalInfoLink">Exam Submission</a>
            @endif
        </li>
        </ul>
    </nav>
           @if($fintime >= $currentdate)
            <form action="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam[0]->id}}/" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 40px">
                <div class="form">
                    <div class="form-content" style="background-color: white; width:850px; margin-top:70px">
                        <h2 style="text-align:center;"><b>Exam Information</b></h2><br>
                        <h2 style="text-align:center;"><b>{{$courses->course_name}}</b></h2>
                        
                        
                        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam[0]->id}}/questiontypeselect" class="w3-right w3-button">Add Question</a>
                        <div class="row" style="width: 950px;">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Name</label>
                                    <input style="margin-left: 160px;" name="ename" type="text" class="form-control input-md" value='<?php echo$exam[0]->name; ?>' required="">
                                </div>
                                @if( $adate>=$currentdate)
                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Date & Time</label>
                                    <input style="margin-left: 160px;" name="edate" type="text" class="form-control input-md" value='<?php echo$exam[0]->date; ?>' required="">
                                </div>
                               @endif


                               @if( $adate<$currentdate)
                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Date & Time</label>
                                    <input style="margin-left: 160px;" name="edate" type="text" class="form-control input-md" value='<?php echo$exam[0]->date; ?>' required="" readonly>
                                </div>
                               @endif

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Duration</label>
                                    <input style="margin-left: 160px;" name="edurate" type="number" class="form-control input-md" value='<?php echo$exam[0]->duration; ?>' minlength="7" required="" min="1">
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Total Grade</label>
                                    <input style="margin-left: 160px;" name="totalgrade" type="number" class="form-control input-md"value='<?php echo$qpoint; ?>'  minlength="7" required="" min="1" readonly>
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Attempts-Allowed</label>
                                    <input style="margin-left: 160px;" name="attempts" type="number" class="form-control input-md" value='<?php echo$exam[0]->attempts_allowed; ?>' required="" min="1">
                                </div>
                            </div>



                        </div>

                        @foreach ($question as $questions)
                            <div class="form-group" id ="ca">
                                <label class="col-md-6 control-label">Question & Answer Type:</label>
                                
                                <input name="value" id="correctanswer" type="text" class="form-control input-md"  value="(Point: {{$questions->evaluation_grade}})  {{$questions->answer_type}} :      {{$questions->question}} "  required="" readonly>
                                
                                @if($questions->answer_type =='MultipleChoice')
                                
                                @if($questions->answers()->where(['is_true' => 1])->count()!=1)
                                <h6 style ="color:red;">"Question has no exactly one correct answer to appear"</h6>
                                @endif
                                   @foreach($questions->answers()->get() as $answer)
                                   
                                   <input type="radio" id="age1" name="age" value="30" disabled>
                                            <label for="age1">{{$answer->value}} : {{$answer->answer}}</label><br>
                                           
                                    
                                    @endforeach
                                   
                                @endif
                                @if($questions->answer_type =='Text')
                                <br>
                                    <a href ="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/addexamquestionT/{{$questions->id}}/examquestionTedit" class="editLink" style="margin-top:50px">Edit</a>&nbsp;
                                    <a onclick="return confirm('Are you sure to delete this question?')" href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/deletequestion/{{$questions->id}}" class="deleteLink" id="delete">Delete</a></td>
                                    <br>
                                @else
                                <br>
                                    <a href ="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/addexamquestionMC/{{$questions->id}}/examquestionMCedit" class="editLink" style="margin-top:50px">Edit</a>&nbsp;
                                    <a onclick="return confirm('Are you sure to delete this question?')" href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/deletequestion/{{$questions->id}}" class="deleteLink" id="delete">Delete</a></td>
                                    <br>
                                @endif
                                <br>
                            </div>


                        @endforeach
                        


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:310px; width:2.5cm;" id="save" name="save" class="btn btn-success">Save</button>


                            </div>
                          </div>

                    </div>
                </div>
            </div>
        </form>
        @endif

        @if($fintime < $currentdate)
        <form action="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam[0]->id}}/" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 40px">
                <div class="form">
                    <div class="form-content" style="background-color: white; width:850px; margin-top:70px">
                        <h2 style="text-align:center;"><b>Exam Information</b></h2><br>
                        <h2 style="text-align:center;"><b>{{$courses->course_name}}</b></h2>
                        
                        
                        <div class="row" style="width: 950px;">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Name</label>
                                    <input style="margin-left: 160px;" name="ename" type="text" class="form-control input-md" value='<?php echo$exam[0]->name; ?>' required="" disabled>
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Date & Time</label>
                                    <input style="margin-left: 160px;" name="edate" type="text" class="form-control input-md" value='<?php echo$exam[0]->date; ?>' required="" disabled>
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Exam Duration</label>
                                    <input style="margin-left: 160px;" name="edurate" type="number" class="form-control input-md" value='<?php echo$exam[0]->duration; ?>' minlength="7" required="" min="1" disabled>
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Total Grade</label>
                                    <input style="margin-left: 160px;" name="totalgrade" type="number" class="form-control input-md"value='<?php echo$qpoint; ?>'  minlength="7" required="" min="1" disabled >
                                </div>

                                <div class="form-group">
                                    <label style="margin-left: 160px;" class="col-md-6 control-label">Attempts-Allowed</label>
                                    <input style="margin-left: 160px;" name="attempts" type="number" class="form-control input-md" value='<?php echo$exam[0]->attempts_allowed; ?>' required="" min="1" disabled>
                                </div>
                            </div>



                        </div>

                        

                        @foreach ($question as $questions)
                            <div class="form-group" id ="ca">
                                      
                                <label class="col-md-6 control-label">Question & Answer Type:</label>
                              
                                
                                <input name="value" id="correctanswer" type="text" class="form-control input-md"  value="(Point: {{$questions->evaluation_grade}})  {{$questions->answer_type}} :      {{$questions->question}} "  required="" disabled>
                                
                                @if($questions->answer_type =='MultipleChoice')
                                <br>
                                
                                   @foreach($questions->answers()->get() as $answer)
                                   
                                   <input type="radio" id="age1" name="age" value="30" disabled>
                                            <label for="age1">{{$answer->value}} : {{$answer->answer}}</label><br>
                                            
                                           
                                    
                                    @endforeach
                                   
                                @endif
                               

                               
                            </div>


                        @endforeach

                        
                        
                       

                    </div>
                </div>
            </div>
        </form>
        @endif
           
        









    </body>
</html>
