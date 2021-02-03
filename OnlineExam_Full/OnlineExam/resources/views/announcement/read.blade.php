
<!DOCTYPE html>
<head>
    <title>O-Exam | Announcement</title>
    <meta charset="UTF-8">
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

            @if(auth()->user()->role=='Assistant')  
            <a href="{{ url('/homepage_assistant') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
            @endif

            @if(auth()->user()->role=='Student')  
            <a href="{{ url('/homepage_student') }}" class="w3-right w3-button" style="font-family:Verdana, sans-serif">My Panel</a>
            @endif

        </div>
    </div>

    
    <form action="{{ route('announcement.edit', $announcement) }}" method="get">
        @csrf
     <div class="text-center">
        <div class="container3 register-form" style="margin-top: 100px">
            <div class="form">
                <div class="form-content" style="background-color: white; width:595px; font-family:Verdana, sans-serif">
                    <img src = "/img/announcementImg.png" border = "0" style="width: 25%; height=25%; margin-left: 195px;"> 
                    <div class="row" style="width: 900px">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="course" style="margin-left:50px" class="col-md-6 control-label">Course</label>
                                <select name="course_id" id="course" class="form-control input-md" style="margin-left:50px; height:1.3cm" disabled>
                                    @if(auth()->user()->role=='Teacher' or auth()->user()->role=='Assistant')
                                        @foreach($courses as $course)
                                            <option
                                                value="{{ $course->id }}" @if($announcement->course_id == $course->id) selected @endif>
                                                    {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    @endif

                                    @if(auth()->user()->role=='Student')
                                        @foreach ($coursesStu as $course1)
                                            @foreach($courses as $course2)
                                                @if($course1->course_id==$course2->id)
                                                    <option
                                                        value="{{ $course1->id }}" @if($announcement->course_id == $course2->id) selected @endif>
                                                        {{ $course2->course_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif              
                                </select>       
                                
                            </div>

                            <div class="form-group">
                                <label for="title" style="margin-left:50px" class="col-md-6 control-label">From</label>
                                <input style="margin-left:50px; background-color:white;" disabled="yes" name="createdby" id="createdby" type="text" class="form-control input-md" value="{{ DB::table('users')->where('id',  $announcement->created_by)->first()->full_name}}">
                            </div>
                            
                              
                            <div class="form-group">
                                <label for="title" style="margin-left:50px" class="col-md-6 control-label">Title</label>
                                <input style="margin-left:50px; background-color:white;" disabled="yes" name="title" id="title" type="text" class="form-control input-md" value="{{ $announcement->title }}">
                            </div>
    
                            <div class="form-group">
                                <label for="content" style="margin-left:50px" class="col-md-6 control-label">Content</label> 
                                <textarea style="margin-left:50px; resize:none; height:190px; background-color:white;" disabled="yes" name="content" id="content" type="text" class="form-control input-md" readonly>{{ $announcement->content }}</textarea>
                            </div>
                            
                        </div>
                    <div class="col-md-6">
    
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-8">
                            @if(in_array(auth()->user()->role, ['Teacher', 'Assistant']))
                            <a href="{{ route('announcement.edit', $announcement) }}" class="editLink" style="margin-left:220px;">Edit</a>
                            @endif
                            <br><br><br>
                            <a href="{{ route('announcement.list', \App\Models\Courses::find($announcement->course_id)) }}" class="deleteLink" style="margin-left:216px">Back</a>
                        </div>

                      </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    </form>

</body>
</html>

