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



            <form action="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam[0]->id}}/" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 112px">
                <div class="form">
                    <div class="form-content" style="background-color: white;">
                        <h2 style="text-align:center;"><b>Exam-Information</b></h2><br>
                        <h2 style="text-align:left;"><b>{{$courses->course_name}}</b></h2>
                        <a href="/teacher_courses/{{$courses->id}}" class="w3-left w3-button">My Exams</a>
                        <a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exam[0]->id}}/questiontypeselect" class="w3-right w3-button">Add Question</a>
                        <br>
                        </br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam-Name</label>
                                    <input name="ename" type="text" class="form-control input-md" value='<?php echo$exam[0]->name; ?>' required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam-Date & Time</label>
                                    <input name="edate" type="text" class="form-control input-md" value='<?php echo$exam[0]->date; ?>' required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Exam-Duration</label>
                                    <input name="edurate" type="number" class="form-control input-md" value='<?php echo$exam[0]->duration; ?>' minlength="7" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Total-Grade</label>
                                    <input name="totalgrade" type="number" class="form-control input-md"value='<?php echo$exam[0]->total_grade; ?>'  minlength="7" required="">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Attempts-Allowed</label>
                                    <input name="attempts" type="number" class="form-control input-md" value='<?php echo$exam[0]->attempts_allowed; ?>' required="">
                                </div>


                                <div class="form-group">
                                    <label class="col-md-6 control-label">Course-Name</label>
                                    <select style="width:100%; height:1.3cm;" class="form-control input-md" name="coursename" id="cname">

                                        <option value="{{$courses->id}}">{{$courses->course_name}}</option>

                                      </select>
                                </div>
                            </div>



                        </div>

                        @foreach ($question as $questions)
                            <div class="form-group" id ="ca">
                                <label class="col-md-6 control-label">Question & Answer Type:</label>
                                @if($questions->answer_type =='Text')
                                    <a href ="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/addexamquestionT/{{$questions->id}}/examquestionTedit" class="editLink">Edit</a>&nbsp;
                                    <a onclick="return confirm('Are you sure to delete this user?')" href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/deletequestion/{{$questions->id}}" class="deleteLink" id="delete">Delete</a></td>
                                @else
                                    <a href ="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/addexamquestionMC/{{$questions->id}}/examquestionMCedit" class="editLink">Edit</a>&nbsp;
                                    <a onclick="return confirm('Are you sure to delete this user?')" href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$questions->exam_id}}/deletequestion/{{$questions->id}}" class="deleteLink" id="delete">Delete</a></td>
                                @endif
                                <input name="value" id="correctanswer" type="text" class="form-control input-md"  value="{{$questions->question}}"  required="" readonly>
                                <input name="answer" id="correctanswer" type="text" class="form-control input-md"  value="{{$questions->answer_type}}" required="" readonly>
                            </div>


                        @endforeach


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:393px; width:2.5cm;" id="save" name="save" class="btn btn-success">Save</button>


                            </div>
                          </div>

                    </div>
                </div>
            </div>
        </form>

    </body>
</html>
