<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Add User</title>
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
         <a href="{{ url('/homepage_admin') }}" class="w3-right w3-button">My Panel</a>
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

            <form action="{{url('/homepage_admin/add_user')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 112px">
                <div class="form">    
                    <div class="form-content" style="background-color: white;">
                        <h2 style="text-align:center;"><b>Add User</b></h2><br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-6 control-label">ID</label>
                                    <input name="id" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Username</label>
                                    <input name="user_name" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Password</label>
                                    <input name="password" type="password" class="form-control input-md" minlength="7" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Confirm Password</label>
                                    <input name="confirm_password" type="password" class="form-control input-md" minlength="7" required="">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Name - Surname</label>
                                    <input name="full_name" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Email</label> 
                                    <input name="email" type="email" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Locality</label>
                                    <input name="locality" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Department</label>
                                    <select style="width:100%; height:1.3cm;" class="form-control input-md" name="department" id="department">                        
                                        <option value="CS">CS</option>
                                        <option value="SE">SE</option>
                                        <option value="CE">CE</option>
                                        <option value="IE">IE</option>
                                        <option value="EE">EE</option>
                                        <option value="ME">ME</option>
                                        <option value="CT">CT</option>
                                        <option value="IR">IR</option>
                                        <option value="HS">HS</option>
                                        <option value="LA">LA</option>
                                        <option value="-">-</option>
                                      </select>      
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label" style="margin-left:236px">Role</label>  
                                    <select style= "width:100%; height:1.3cm; margin-left:238px;" class="form-control input-md" name="role" id="role">
                                      <option value="Student">Student</option>
                                      <option value="Teacher">Teacher</option>
                                      <option value="Assistant">Assistant</option>
                                      <option value="Admin">Admin</option>
                                    </select>
                                    
                                  </div>
                            </div>

                        </div>
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