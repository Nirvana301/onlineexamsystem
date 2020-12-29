<!DOCTYPE html>
<html>

<head>
<title>O-Exam | Reset Password</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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

<a href="{{ url('/') }}" style="text-decoration: none; padding: 10px 20px;
background-color: #0750a3;
text-decoration: none;
color:white;
margin-left: 93%;
margin-top: 10px;
display: inline-block; ">Homepage</a>

<form action="{{ url('reset_password/'.$user->email.'/'.$code)}}" method="post">
    {{ csrf_field() }}

  <div class="container">
    <header id="snap-pm-header" class="clearfix">
        <h2 style="text-align:center">Reset Password</h2>
        <br>
        
    </header>
    <br>
    
    <!-- password errors-->
    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
        <li>{{$error}}</li>
        </div>    
        @endforeach
    @endif


    <label><b>Password</b></label>
    <input type="password" name="password" id="password" class="form-control" required>

    <label><b>Confirm Password</b></label>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>

    <button type="submit" class="button">Change Password</button>
  
</form>

</body>

</html>