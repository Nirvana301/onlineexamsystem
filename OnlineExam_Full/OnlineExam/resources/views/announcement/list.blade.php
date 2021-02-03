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

    
<div class="ex1" style="margin-top: 135px; margin-left:35%;">
    <div class="row">
        <div class="column" style="background-color:rgb(255, 255, 255);">
            <h2 style="text-align:center;"><b>Announcements</b></h2><br>

            @if(auth()->user()->role=='Teacher' or auth()->user()->role=='Assistant')
            @if(auth()->user()->can('teacher-assistant'))
            <a class="addAnnouncementLink" href="{{ route('announcement.create') }}">Add New Announcement</a>
            <br><br><br>
            <h1 style="border-bottom: 2px solid #0750a3;"></h1>
            @endif
            @endif
            

            @if(auth()->user()->role=='Student')
            <h1 style="border-bottom: 2px solid #0750a3;"></h1>
            @endif

            
        @foreach($announcements as $announcement)
          <h5><a href="{{ route('announcement.read', [$course = \App\Models\Courses::find($announcement->course_id),$announcement]) }}">{{ $announcement->title }}</a></h5><br>
            @if(in_array(auth()->user()->role, ['Teacher', 'Assistant']))
            <form action="{{ route('announcement.delete', $announcement) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" value="{{ $announcement->id }}">
                <button type="submit" class="btn" style="background-color:#f44336; width:2.5cm">Delete</button>
              <!--<a onclick="return confirm('Are you sure to delete this announcement?')" href="/announcements/{{$announcement->id}}" class="deleteLink" id="delete">Delete</a><br><br>!-->
              <h1 style="border-bottom: 2px solid #0750a3;"></h1>
            </form>
            @endif
        @endforeach
        

        </div>
    </div>
</div>

</body>
</html>




