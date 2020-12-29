<!DOCTYPE html>
<html>
<head>
<title>O-Exam | Users</title>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

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
     
     <a href="{{ url('/homepage_admin') }}" class="myPanelLink" style="margin-left: 78%">My Panel</a>

    </div>
</div>

<h1 style="text-align: center; margin-top: 115px; font-family:Arial;"><b>Users</b></h1>

<table id="users" border = "1">

<tr>
<th>ID</th>
<th>Username</th>
<th>Name - Surname</th>
<th>Email</th>
<th>Locality</th>
<th>Department</th>
<th>Role</th>
<th>Actions</th>
</tr>

@foreach ($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td>{{ $user->user_name }}</td>
<td>{{ $user->full_name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->locality }}</td>
<td>{{ $user->department }}</td>
<td>{{ $user->role }}</td>

<td><a href ="/homepage_admin/edit_user/{{$user->id}}" class="editLink">Edit</a>&nbsp;
<a onclick="return confirm('Are you sure to delete this user?')" href="/homepage_admin/delete_user/{{$user->id}}" class="deleteLink" id="delete">Delete</a></td>
</tr>

@endforeach
</table>

</body>
</html>