<!DOCTYPE html>
<html>
<head>
<title>O-Exam | Users</title>

<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

</head>
<body>

    <h1 style="text-align: center">Users</h1>

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