<!DOCTYPE html>
<html>

<head>

<title>O-Exam | Login</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

</head>

<body>

<form action="check" method="post" enctype="multipart/form-data">
    @csrf
  <div class="container">
    <header id="snap-pm-header" class="clearfix">
        <h1 style="text-align:center">Login</h1>
    </header>

    <br>

    @if(session()->get('msg'))
    <div class="alert alert-danger alert-dismissible">
        {{session()->get('msg')}}
    </div>
    @endif


    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
        {{ session('success')}}
        </div>
    @endif
    

    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user_name" class="form-control" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" class="form-control" required>

    <button type="submit" class="button">Login</button>

  </div>

  <div class="container2" style="background-color:#ffffff">
    
    <a href="{{url ('/forgot_password')}}">Forgot password?</a>

  </div>
  
</form>

</body>

</html>
