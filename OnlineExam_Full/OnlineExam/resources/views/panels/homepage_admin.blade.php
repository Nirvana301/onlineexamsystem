<!DOCTYPE html>
<html>
<title>O-Exam | My Panel</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/img/titleImg.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />

<head>

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
     }        
    </script>

</head>
<body>
    

<div id="navbar" class="w3-container">

    <a href = "{{ url('/') }}" target = "_self"> 
        <img src = "/img/logoClickable.jpg" border = "0" /> 
    </a>

    @foreach ($users as $user)
    <img src="/profile_photos/{{$user->avatar}}" class="userpicture" style="border-radius:50%" width="75"
         height="75" border="0" align="right"/>
    @endforeach
    
    <a href="/profile" title="View your profile" class="h5" style="margin-top:1.5%; margin-right:15px;" aria-level="1" id="text">{{ $full_name }}</a>

    <div id="panel" class="w3-bar w3-blue">
        
        <a href="{{ url('/homepage_admin/manage_user') }}" class="w3-bar-item w3-button w3-mobile">Manage Users</a>
        <a href="{{ url('/profile') }}" class="w3-bar-item w3-button w3-mobile">Profile</a>
        <a href="{{ url('/message') }}" class="w3-bar-item w3-button w3-mobile">Message</a>
        <a href="{{ url('/logout') }}" class="w3-bar-item w3-button w3-mobile">Logout</a>

    </div>


    <div id="genel">
        @if(session('error'))
        <div id="errorDIV" class="alert alert-danger alert-dismissible" style="width: 1873px;">
        {{ session('error')}}
        </div>
        @endif

        @if(session('success'))
        <div id="successDIV" class="alert alert-success alert-dismissible" style="width: 1873px;">
        {{ session('success')}}
        </div>
        @endif

        <!-- password errors-->
        @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
        <li>{{$error}}</li>
        </div>    
        @endforeach
        @endif

        <form action="{{url('/homepage_admin/add_user')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="container3 register-form" style="margin-top: 12px">
                <div class="form">    
                    <div class="form-content" style="background-color: white;">
                        <h2 style="text-align:center;"><b>Add User</b></h2><br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-6 control-label">ID</label>
                                    <input name="id" type="number" class="form-control input-md" required="" min="1">
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

    </div>
</div>

</div>
</div>
</body>
</html>
