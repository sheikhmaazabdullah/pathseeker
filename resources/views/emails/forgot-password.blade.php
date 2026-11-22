<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset - PathSeeker</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background-color: #007bff; color: #fff; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 10px; font-size: 12px; color: #666; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PathSeeker</h1>
            <p>Your Career Journey Starts Here</p>
        </div>
        <div class="content">
            <h2>Password Reset Request</h2>
            <p>Dear {{ $user->name }},</p>
            <p>We received a request to reset your password. Your OTP is: <strong>{{ $otp }}</strong></p>
            <p>Please click the button below to enter the OTP and reset your password:</p>
            <p>
                <a href="{{ route('password.reset.otp') }}?email={{ urlencode($user->email) }}" class="btn">Reset Password</a>
            </p>
            <p>This OTP is valid for 10 minutes. Please do not share it with anyone. If you didn’t request this, contact us at <a href="mailto:pathseekershere@gmail.com">pathseekershere@gmail.com</a>.</p>
            <p>Best regards,<br>The PathSeeker Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PathSeeker. All rights reserved.</p>
        </div>
    </div>
</body>
</html>