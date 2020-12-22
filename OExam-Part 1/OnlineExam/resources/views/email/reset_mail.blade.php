<h1>Hello, {{$user->user_name}} </h1>
<p>
    Please click the <a href="{{ url('reset_password/'.$user->email.'/'.$code) }}" onclick="false">Reset Password</a> link to reset your password.
</p>
<p>(If 'Reset Password' link is not clickable, mark this email as 'Not Spam'.)
</p>


