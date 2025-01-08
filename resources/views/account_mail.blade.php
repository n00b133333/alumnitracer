<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; text-align: center;">
    <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #f4f4f9; margin: 0; padding: 0;">
        <tr>
            <td align="center">
                <table width="600px" cellspacing="0" cellpadding="0" style="background-color: #ffffff; margin: 20px auto; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="background-color: #007bff; padding: 20px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">Welcome, {{ $user->first_name }}!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: center; line-height: 1.6;">
                            <p style="margin: 0; font-size: 16px;">Your account has been successfully created in the Alumni Tracer System.</p>
                            <p style="margin: 20px 0; font-size: 16px;">To activate your account, please click the button below:</p>
                            <a href="http://localhost:5173/account/activate/{{ $user->activation_token }}" 
                               style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; font-weight: bold; margin-top: 10px;">
                               Activate Your Account
                            </a>
                            <p style="margin: 20px 0 0; font-size: 14px; color: #555;">If you did not request this, please ignore this email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #007bff; padding: 10px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #ffffff;">&copy; 2025 Alumni Tracer System. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
