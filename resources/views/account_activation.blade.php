<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #2C3E50;">Welcome, {{ $user->first_name }}!</h2>
    <p style="font-size: 16px;">
        Thank you for registering with the Alumni Tracer System. To complete your registration and activate your account, please click the link below:
    </p>
    <p>
        <a href="{{ url('http://localhost:5173/account/activate/' . $user->activation_token) }}" 
           style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Activate Your Account
        </a>
    </p>
    <p style="font-size: 16px;">
        If you did not request this, please ignore this email or contact us for assistance.
    </p>
    <p style="font-size: 14px; color: #95a5a6;">
        Regards,<br>
        The Alumni Tracer System Team
    </p>
</body>
</html>
