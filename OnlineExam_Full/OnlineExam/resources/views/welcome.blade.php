<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<title>O-Exam | Welcome</title>
<meta charset="UTF-8">
<link rel="shortcut icon" href="/img/titleImg.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

<style>
  body,h1 {font-family: "Arial", sans-serif}
  body, html {height: 100%}
  .bgimg {
    background-image: url('/img/welcomeImg.jpg');
    height: 80%;
    background-position:center;
    background-size: cover;
  }
  </style>

</head>

<body>
    <!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-padding w3-black">

        <a href = "{{ url('/') }}" target = "_self"> 
            <img src = "/img/logoClickable.jpg" border = "0" /> 
         </a>

         
         <a href="{{ url('/login') }}" class="w3-right w3-button">Login</a>

    </div>
</div>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top" style="margin-top:48px;"><b>Welcome to O-Exam!</b></h1>
  </div>
  
</div>
<br><br>



<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <h3 class="w3-center"><span class="w3-tag w3-wide" style="background-color: #ffffff; color:#0750a3"><b>About Us</b></span></h3><br>
    <div class="w3-panel w3-leftbar w3-light-grey">
      <p>O-Exam is an online examination website created for BETMY University that enables instructors to prepare exams for students and enables students to take these exams on internet. 
        O-Exam provides convenience to its users owing to this service provided in digital environment.</p>
    </div>
  </div>
</div>

</body>
</html>
