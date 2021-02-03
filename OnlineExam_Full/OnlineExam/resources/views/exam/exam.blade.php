<!DOCTYPE html>
<html>
<head>

    <title>O-Exam | Exam</title>
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
            background-color: rgb(243, 243, 243);
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
        @if(auth()->user()->role=='Student')
        <a href="{{ url('/homepage_student') }}" class="w3-right w3-button">My Panel</a>
        @endif
        @if(auth()->user()->role=='Teacher')
            <a href="{{ url('/homepage_teacher') }}" class="w3-right w3-button">My Panel</a>
        @endif

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

    @if(auth()->user()->role=='Teacher')
    <nav class="navbar header-top fixed-top navbar-expand-lg" style="margin-top: 130px;">
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <li class="nav-item">
            <a class="personalInfoLink" href="/{{$course->id}}/exam/{{$exam->id}}/participants">Exam Submission</a>
            <br><br>
            <a class="personalInfoLink" href="/teacher_courses/{{$course->id}}/teacher_examsedit/{{$exam->id}}">Exam Information</a>
        </li>
        </ul>
    </nav>
    @endif

    <form
        action="/{{ $course->id }}/exam/{{ $exam->id }}{{ auth()->user()->role == "Teacher" ? "/evaluate/".$user->id : "" }}"
        method="post" class="container">
        @csrf
        <div class="mx-auto" style="margin-top: 40px;">
            @if(auth()->user()->role=='Teacher')
            <h2 style="text-align:center; color:#007BFF"><b><a href="/teacher_courses/{{$course->id}}">{{$course->course_name}}</a></b></h2>
            @endif

            @if(auth()->user()->role=='Student')
            <h2 style="text-align:center; color:#0750a3"><b>{{$course->course_name}}</b></h2>
            @endif

            <h2 style="text-align:center;"><b>{{$exam->name}}</b></h2><br>

            <h4 style="text-align:left; color:#0750a3"><b>Exam Duration:</b>
                <b style="color:black">{{$exam->duration}} min</b>
            </h4>

            <h4 style="text-align:left; color:#0750a3"><b>Attempts-Allowed:</b>
                <b style="color: black">{{$exam->attempts_allowed}}</b>
            </h4>
            <br>
            
            
            @foreach($questions as $question)
              @if(!($question->answers()->where(['is_true' => 1])->count()!=1 and $question->answer_type=='MultipleChoice'))
                <h4>(Point: {{ $question->evaluation_grade }})</h4>
                <h3>{{ $question->question }}</h3>

                @forelse($question->answers as $answer)
                    <input type="hidden" name="multiple_choice[{{ $question->id }}][question_id]"
                           class="form-check-input"
                           value="{{ $question->id }}">
                    <input type="radio" name="multiple_choice[{{ $question->id }}][answer_value]"
                           class="form-check-input"
                           value="{{ $answer->value }}" autocomplete="off"
                           @if(isset($question->multipleChoiceSubmission[0]) && $question->multipleChoiceSubmission[0]->answer_value == $answer->value)
                           checked
                        @endif
                        @if(\App\Models\Attempt::where(['exam_id' => $exam->id, 'student_id' => auth()->user()->id])->count() >= $exam->attempts_allowed)
                       disabled="disabled"
                    @endif
                    >
                    <label for="multiple_choice[]" class="form-check-label">{{ $answer->value }}
                        ) {{ $answer->answer }}</label>
                    <br>
                @empty
                    <input type="hidden" name="text[{{ $question->id }}][question_id]" class="form-check-input"
                           value="{{ $question->id }}">
                    <label>
                        <input type="text" name="text[{{ $question->id }}][answer]" class="form-control"
                               autocomplete="off"
                               @if(isset($question->textSubmission[0]))
                               value="{{ $question->textSubmission[0]->answer }}"
                            @endif
                            @if(\App\Models\Attempt::where(['exam_id' => $exam->id, 'student_id' => auth()->user()->id])->count() >= $exam->attempts_allowed)
                           disabled="disabled"
                        @endif
                        >
                    </label>
                @endforelse
                @if(auth()->user()->role == "Teacher")
                    <input type="number" name="grades[{{ $question->answer_type }}][{{ $question->id }}]"
                           class="form-inline my-2 form-control" style="width: 80px;" min="0"
                           max="{{ $question->evaluation_grade }}"
                           @if(isset($question->{$question->answer_type. 'Submission'}[0]->grade) && auth()->user()->role == "Teacher")
                           value="{{ $question->{$question->answer_type. 'Submission'}[0]->grade }}"
                        @endif>
                @endif
                @endif
            @endforeach

            @if(\App\Models\Attempt::where(['exam_id' => $exam->id, 'student_id' => auth()->user()->id])->count() >= $exam->attempts_allowed)
            <button type="submit" class="btn btn-primary my-4 form-control" style="visibility:hidden">Submit</button>

            <nav class="navbar header-top fixed-top navbar-expand-lg" style="margin-top: 130px;">
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <li class="nav-item">
            <a href="/student_courses/{{$courses_Students[0]->id}}" class="personalInfoLink" style="padding:7px 47.5px;">My Exams</a>
            <br><br>

        </li>
        </ul>
    </nav>

             @else           
            <button type="submit" class="btn btn-primary my-4 form-control" >Submit</button>

            @endif
        </div>

    </form>

</body>
</html>
