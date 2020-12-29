<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Profile</title>
      
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
        <a href="{{ url('/homepage_admin') }}" class="myPanelLink" style="margin-left: 78%">My Panel</a>
        @endif    

        @if($role=="Student")    
        <a href="{{ url('/homepage_student') }}" class="myPanelLink" style="margin-left: 78%">My Panel</a>
        @endif  

        @if($role=="Teacher")    
        <a href="{{ url('/homepage_teacher') }}" class="myPanelLink" style="margin-left: 78%">My Panel</a>
        @endif  

        @if($role=="Assistant")    
        <a href="{{ url('/homepage_assistant') }}" class="myPanelLink" style="margin-left: 78%">My Panel</a>
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
        <br><br><br><br><br>
        <a href="{{ url('/profile_info') }}" class="personalInfoLink">Personal Information</a>
        <br><br>
        <a href="{{ url('/change_password') }}" class="changePassLink">Change Password</a>
    </div>

    

    <form action = "/profile_info" method = "post">
            {{csrf_field()}}
            <div class="container3 register-form">
                <div class="form">
                        <h2 style="text-align:center; margin-top:130px;"><b>Personal Information</b></h2>
                    
                    <div class="form-content " style="background-color: white; width:700px">
                        <div class="row" style="width: 950px">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Username</label>
                                    <input style="margin-left:95px" name="user_name" type="text" class="form-control input-md" value = '<?php echo$users[0]->user_name; ?>' required="" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Name - Surname</label>
                                    <input style="margin-left:95px" name="full_name" type="text" class="form-control input-md" value = '<?php echo$users[0]->full_name; ?>' required="">
                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Email</label> 
                                    <input style="margin-left:95px" name="email" type="email" class="form-control input-md" value = '<?php echo$users[0]->email; ?>' required="">  
                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Locality</label>
                                    <input style="margin-left:95px" name="locality" type="text" class="form-control input-md" value = '<?php echo$users[0]->locality; ?>' required="">
                                </div>
                                
                            </div>
                        <div class="col-md-6">

                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:238px; width:4cm;" id="save" name="save" class="btn btn-success">Save Changes</button>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>