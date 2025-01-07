<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <h1>Welcome, {{ $user->first_name }}!</h1>
    <p>Your account has been successfully created in the Alumni Tracer System. To activate your account, please click the link below:</p>
    <p><a href="http://localhost:5173/account/activate/{{ $user->activation_token }}">Activate Your Account</a></p>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
