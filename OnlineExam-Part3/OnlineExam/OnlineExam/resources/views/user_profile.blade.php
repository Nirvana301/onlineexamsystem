<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Profile</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    <style>
        body {
          background-image: url('/img/grayBackground.png');
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
            
    <!-- Links (sit on top) -->
    <div class="w3-top">
        <div class="w3-padding w3-black" style="border-bottom: 2px solid #0750a3;">

        <a href = "{{ url('/') }}" target = "_self"> 
        <img src = "/img/logoClickable.jpg" border = "0" /> 
        </a>
     
        @if($role=="Admin")    
        <a href="{{ url('/homepage_admin') }}" class="w3-right w3-button">My Panel</a>
        @endif    

        @if($role=="Student")    
        <a href="{{ url('/homepage_student') }}" class="w3-right w3-button">My Panel</a>
        @endif  

        @if($role=="Teacher")    
        <a href="{{ url('/homepage_teacher') }}" class="w3-right w3-button">My Panel</a>
        @endif  

        @if($role=="Assistant")    
        <a href="{{ url('/homepage_assistant') }}" class="w3-right w3-button">My Panel</a>
        @endif    

        </div>
    </div>

    <div class="container bootstrap snippet">
          <div class="text-center">
            <h1>{{$full_name}}</h1>
            <img src="/profile_photos/{{$user->avatar}}" class="img-thumbnail" style="width:150px; height:150px; float:center; border-radius:50%;">
            <form enctype="multipart/form-data" action="/profile" method="POST"> 
                <br>
                <input type="file" name="avatar" accept="image/*" style="margin-left: 60px">
                <br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br>
                <input type="submit" class="pull-right btn btn-sm btn-primary" value="Submit">
                <br><br><br><br>
                <a href="{{ url('/profile_info') }}" class="personalInfoLink">Personal Information</a>
                <br><br>
                <a href="{{ url('/change_password') }}" class="changePassLink">Change Password</a>
            </form>
          </div>
    </div>
    
 </body>
</html>