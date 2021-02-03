<!DOCTYPE html>
<html>
<head>

    <title>O-Exam | Message</title>
    
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="/img/titleImg.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</div>
      

<input id="userss" list="brow" placeholder="Search Users By Name or Username..." style="width: 20%; height:1.5cm; margin-top:135px; margin-left:39%;">
<input type="button" onclick="printUsername();" value="Select User" class="btn" style="background-color: #0750a3; color:white">
<datalist id="brow">
    @foreach ($users as $user)  
        <option>{{$user->user_name}} &nbsp; ({{$user->full_name}})</option>
    @endforeach
</datalist>


<div class="float-container" >
    <div class="float-child" >
        <div class="ex1">
            <div class="row">
                <div class="column" style="background-color:rgb(255, 255, 255);">
                    <h2 style="text-align:center"><b>Inbox</b></h2>

                <h1 style="border-bottom: 2px solid #0750a3;"></h1>
                    @foreach ($messages as $message)
                        @if($message->receiver==Auth::user()->id)

 
                            <b><p style="color:#0750a3">Subject:</p></b>
                            <p id="subjectP">{{ $message->subject }}</p>
                            

                            <b><p style="color:#0750a3">Sender:</p></b>
                            <p id="senderP">{{ DB::table('users')->where('id', $message->sender)->first()->user_name}} &nbsp; ({{ DB::table('users')->where('id', $message->sender)->first()->full_name}})</p>

                            <b><p style="color:#0750a3">Message:</p></b>
                            <p>{{$message->created_at}}</p>
                            <textarea style="resize: none; width:535px; height:220px; background-color:white;" disabled="yes" readonly>{{ $message->message}}</textarea>
                            <br><br>
                            
                            <a href="#" onclick="return replyFunction();" class="editLink" id="messageReply">Reply</a>
                            <a onclick="return confirm('Are you sure to delete this message?')" href="/message/{{$message->id}}" class="deleteLink" id="delete">Delete</a>
                            <br><br>
                            <h1 style="border-bottom: 2px solid #0750a3;"></h1>

                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <div class="float-child">
        <form action="{{url('/message')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="messageContainer">
                <div class="form">
                    <div class="form-content" style="background-color: white; width:650px; height:640px;">
                        <h2 style="text-align:center"><b>Send Message</b></h2><br>
                        <div class="row" style="width:950px">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Subject:</label>
                                    <input style="margin-left:95px" id="subject" name="subject" type="text" class="form-control input-md" required="">
                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">To:</label>
                                    <input style="margin-left:95px" id="receiver" name="receiver" type="text" class="form-control input-md" required="" placeholder="Write a username...">

                                </div>

                                <div class="form-group">
                                    <label style="margin-left:95px" class="col-md-6 control-label">Write a Message:</label>
                                    <textarea style="margin-left:95px; height:190px; resize:none" name="message" type="text" class="form-control input-md" required=""></textarea>

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                <button style="margin-left:255px; width:2.5cm;" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
function replyFunction() {
  var user = document.getElementById("senderP").innerHTML;
  var user_name=user.split(" ")[0];
  document.getElementById("receiver").value=user_name;
  document.getElementById("subject").value=document.getElementById("subjectP").innerHTML;
}

 function printUsername(){
    var user = document.getElementById("userss").value;
    var user_name = user.split(" ")[0];
    document.getElementById("receiver").value=user_name;
}
</script>
</body>
</html>
