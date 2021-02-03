<!DOCTYPE html>
<html>

<head>

<title>O-Exam | Forgot Your Password?</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

</head>

<body>

<form action="{{ url('/forgot_password') }}" method="post">
    {{ csrf_field() }}

  <div class="container">
    <header id="snap-pm-header" class="clearfix">
        <h2 style="text-align:center">Forgot Your Password?</h2>
        <br>
        <h5 style="text-align:center">Enter your email address and we'll send you a link to reset your password.</h5>
    </header>
    <br>
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
        {{ session('error')}}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
        {{ session('success')}}
        </div>
    @endif

    <label><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="email" class="form-control" required>
    <button type="submit" class="button">Reset Password</button>
  
</form>

</body>

</html>