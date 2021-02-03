<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Change Password</title>
    <link rel="shortcut icon" href="/img/titleImg.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
    
        <div class="col-sm-3">
            <a href="{{ url('/profile') }}" class="profileLink">Profile</a>
            <br><br>
            <a href="{{ url('/profile_info') }}" class="personalInfoLink">Personal Information</a>
            <br><br>
            <a href="{{ url('/change_password') }}" class="changePassLink">Change Password</a>
        </div>

            <form action="{{url('/change_password')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 40px">
                <div class="form">                    
                    <div class="form-content" style="background-color: white; width:700px;">
                        <h2 style="text-align:center"><b>Change Password</b></h2><br>
                        <div class="row" style="width:950px">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Old Password</label>
                                    <input style="margin-left:95px" name="old_password" type="password" class="form-control input-md" minlength="7" required="">
                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">New Password</label>
                                    <input style="margin-left:95px" name="new_password" type="password" class="form-control input-md" minlength="7" required="">
                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Confirm New Password</label>
                                    <input style="margin-left:95px" name="confirm_new_password" type="password" class="form-control input-md" minlength="7" required="">
                                </div>
                            </div>
                            
                            </div>        
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                  <button style="margin-left:215px; width:4.5cm;" id="save" name="save" class="btn btn-success">Change Password</button>
                                </div>
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>