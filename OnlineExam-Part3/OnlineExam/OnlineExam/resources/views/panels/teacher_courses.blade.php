<!DOCTYPE html>
<html>

<head>
    <title>O-Exam | Your Panel</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    <script>
        if(!!window.performance && window.performance.navigation.type === 2){
            console.log('Reloading');
            window.location.href="http://localhost:8000/";
     }
     </script>

</head>

<div class="container3">
    <div class="card">
        <div class="card-body">

            <h1>Teacher
            <br>
            {{auth()->user()->full_name}}</h1>

            <br>



<h1><td>{{ $courses->course_name }}</td></h1>

@foreach ($exam as $exams)
<table >
<tr>
    <th>Exam-name</th>
    <th>Exam-ID</th>
</tr>
<tr>
<td><a href="/teacher_courses/{{$courses->id}}/teacher_examsedit/{{$exams->id}}">{{ $exams->name }}</a></td>
<td><a href="">{{ $exams->id }}</a></td>
    <td><a onclick="return confirm('Are you sure to delete this user?')" href="/teacher_courses/{{$courses->id}}/deleteexam/{{$exams->id}}" class="deleteLink" id="delete">Delete</a></td>
</tr>

</table>
@endforeach




            <p><a href="/teacher_courses/{{$courses->id}}/teacher_courses_prepexam">PrepareExam</a></p>


        </div>
    </div>
    <p><a href="{{ url('/logout') }}" class="logoutLink" style="background-color: #4CAF50">Logout</a></p>
</div>

</html>
