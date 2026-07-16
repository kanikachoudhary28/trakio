<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Hello!</h2>
    <p>You are receiving this email because we received a password reset request for your Trakio account.</p>
    
    <p>Click the link below to reset your password:</p>
    <p>
        <a href="{{ url('reset-password/'.$token) }}" style="background: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
            Reset Password
        </a>
    </p>

    <p>This password reset link will expire shortly.</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>Trakio Team</p>
</body>
</html>