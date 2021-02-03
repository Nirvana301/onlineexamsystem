<!DOCTYPE html>
<head>
    <title>O-Exam | Edit Announcement</title>
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

<script>
    if(!!window.performance && window.performance.navigation.type === 2){
        console.log('Reloading');
        window.location.href="http://localhost:8000/";
 }
 </script>

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

        </div>
    </div>

    <nav class="navbar header-top fixed-top navbar-expand-lg" style="margin-top: 130px;">
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <li class="nav-item">
            <a href="#" onclick="goBack();" class="personalInfoLink" 
                style="background-color:#f44336; color:white; padding:7px 61.5px;">Cancel</a>
        </li>
        </ul>
    </nav>

    
    <form action="{{ route('announcement.update', $announcement) }}" method="post">
        @csrf
        @method('PATCH')
     <div class="text-center">
        <div class="container3 register-form" style="margin-top: 150px">
            <div class="form">
                <div class="form-content" style="background-color: white; width:650px; font-family:Verdana, sans-serif">
                    <h2 style="text-align:center;"><b>Edit Announcement</b></h2><br>
                    <div class="row" style="width: 950px">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="title" style="margin-left:65px" class="col-md-6 control-label">Title</label>
                                <input style="margin-left:65px" name="title" id="title" type="text" class="form-control input-md" required="" maxlength="40" value="{{ $announcement->title }}">
                            </div>
    
                            <div class="form-group">
                                <label for="content" style="margin-left:65px" class="col-md-6 control-label">Content</label> 
                                <textarea style="margin-left:65px; resize:none; height:190px;" name="content" id="content" type="text" class="form-control input-md" required="">{{ $announcement->content }}</textarea>
                            </div>
                            
                        </div>
                    <div class="col-md-6">
    
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-8">
                          <button style="margin-left:235px; width:2.5cm;" type="submit" class="btn btn-success">Save</button>
                          
                        </div>
                      </div>
                      
                      </div>
                </div>
            </div>
        </div>
    </div>
    </form>


    <script>
        function goBack() {
          window.history.back();
        }
    </script>

</body>
</html>




