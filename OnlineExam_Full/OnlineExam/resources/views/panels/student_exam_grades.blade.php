<!DOCTYPE html>
<html>
<head>
    <title>O-Exam | My Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

            <h1><u><a href="#" onclick="goBack();">{{ $courses->course_name }}</a></u>
                &nbsp;<a style="color:#0750a3">/</a>&nbsp;
                <u><a href="" >Results</a></u>
            </h1>
          
            <br><br>
           
           
        
            <table id="exams"> 
                <h5>Exam Results</h5> 
                <tr>
                    <th>Exam Name</th>
                    <th>Exam Date & Hour</th>
                    <th>Exam Grade</th>
                    <th>Evaluation Date & Hour</th>
                </tr>



               
                @foreach ($exam as $exams )
                @if(\Illuminate\Support\Carbon::parse($exams->date)->addHours($exams->duration / 60)->addMinutes($exams->duration % 60)->isPast())
                    @foreach ($result as $results )
                        @if($results->exam_id==$exams->id)
            
                        <tr>
            
                            <td><h5 style="color:#0750a3"><b>{{ $exams->name }}</a></b></h5></td>
                            <td><h5>{{ $exams->date }}</h5></td>
                           
                            <td><h5 style="color:#0750a3"><b>{{ $results->total_grade }}</b></h5></td>
                            
                            <td><h5>{{ $results->created_at }}</h5></td>
            
                        </tr>
            
                        @endif
                    @endforeach
                    @endif
                @endforeach
              
            </table>

</div>

<script>
    function goBack() {
      window.history.back();
    }
</script>

</body>
</html>

