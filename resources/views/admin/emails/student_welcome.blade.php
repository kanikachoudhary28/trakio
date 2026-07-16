<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Trakio</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333333; background-color: #f4f6f9; padding: 30px; margin: 0;">

    <div style="max-width: 550px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eef2f5;">
        
        <div style="background-color: #0d6efd; padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600; letter-spacing: 0.5px;">Welcome to Trakio!</h1>
            <p style="color: #e0ebff; margin: 5px 0 0 0; font-size: 14px;">Your student account is ready</p>
        </div>

        <div style="padding: 30px;">
            <p style="font-size: 16px; margin-top: 0;">Hello <strong>{{ $studentData['name'] }}</strong>,</p>
            <p style="color: #555555; font-size: 14px;">Your profile has been successfully created by the administration. You can now log in to the student performance portal using the credentials below:</p>
            
            <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 20px; margin: 25px 0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 6px 0; font-size: 14px; color: #6c757d; width: 35%;"><strong>Login Email:</strong></td>
                        <td style="padding: 6px 0; font-size: 14px; color: #212529; font-weight: 600;">{{ $studentData['email'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; font-size: 14px; color: #6c757d;"><strong>Password:</strong></td>
                        <td style="padding: 6px 0; font-size: 15px; color: #dc3545; font-family: 'Courier New', Courier, monospace; font-weight: bold; letter-spacing: 0.5px;">
                            {{ $studentData['password'] }} <span style="font-size: 11px; color: #6c757d; font-family: sans-serif; font-weight: normal;">(Your Roll Number)</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/login') }}" style="background-color: #0d6efd; color: #ffffff; text-decoration: none; padding: 12px 35px; border-radius: 50px; font-weight: 500; font-size: 14px; display: inline-block; box-shadow: 0 3px 6px rgba(13, 110, 253, 0.2);">
                    Click Here to Login
                </a>
            </div>

            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; padding: 15px; margin-top: 20px;">
                <p style="margin: 0; font-size: 13px; color: #664d03; font-weight: 500;">
                    ⚠️ <strong>Security Notice:</strong> Your default password is set to your roll number for easy access. Please change this temporary password immediately after your first login for security reasons.
                </p>
            </div>

        </div>

        <div style="background-color: #f8f9fa; padding: 15px; text-align: center; border-top: 1px solid #e9ecef;">
            <p style="margin: 0; font-size: 12px; color: #adb5bd;">&copy; {{ date('Y') }} Trakio. All rights reserved.</p>
        </div>

    </div>

</body>
</html>