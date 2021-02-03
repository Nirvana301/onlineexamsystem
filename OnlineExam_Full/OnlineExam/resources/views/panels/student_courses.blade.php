<!DOCTYPE html>
<html>

<head>

    <title>O-Exam | My Panel</title>
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

    @if(session('error'))
    <div id="errorDIV" class="alert alert-danger alert-dismissible" style="width: 1918px;">
        <button class="close" onclick="document.getElementById('errorDIV').style.display='none'" style="text-align:right">x</button>
    {{ session('error')}}
    </div>
    @endif

</div>

<div class="container3" style="margin-top: 5%; margin-left:1%;">
    <br><br>

    <h1><u><a href="/student_courses/{{$courses_students->id}}">{{ $courses[0]->course_name }}</a></u></h1><br>
    <h5>
        <a href="/student_courses/{{$courses[0]->id}}/student_exam_grades" style="text-decoration:none">
            <img src="/img/examImg.jpg" class="img-thumbnail" style="border-radius:50%;" width="75" height="75">&nbsp;Exam Results
        </a>
    </h5>
    <br><br>

    <table id="exams"> 
        <h5>Exam Details</h5> 
        <tr>
            <th>Exam Name</th>
            <th>Exam Date & Hour</th>
            <th>Exam Solution</th>
        </tr>
    
        @foreach ($exam as $exams)
        <tr>
            <td><h5><b><a href="/{{$courses_students->course_id}}/exam/{{$exams->id}}/enter_exam" style="text-decoration: none">
                <img src="/img/examImg.jpg" class="img-thumbnail" style="border-radius:50%;" width="75" height="75">&nbsp;{{ $exams->name }}</a></b></h5></td>
            <td><h5>{{ $exams->date }}</h5></td>
            @if(\Illuminate\Support\Carbon::parse($exams->date)->addHours($exams->duration / 60)->addMinutes($exams->duration % 60)->isPast())
                    <td>
                        @if($file = $exams->files()->latest()->first())
                            <h5><a href="{{ route('file.upload.download', [$file]) }}">{{ $file->file_name }}</a></h5>
                        @else
                            <h5>No uploaded solution for exam</h5>
                        @endif
                    </td>
                @else
                    <td>
                        <h5>Exam is not Suitable for file upload</h5>
                    </td>
                @endif
        </tr>
        @endforeach  
    </table>

</div>

</body>
</html>
