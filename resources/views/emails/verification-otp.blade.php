<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Request Received - PathSeeker</title>
</head>
<body>
    <h2>Registration Request Received</h2>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for registering with PathSeeker as a {{ $user->role }}. Your request has been received and is pending admin approval.</p>
    <p>Please use the following OTP to verify your email:</p>
    <ul>
        <li><strong>OTP</strong>: <strong>{{ $otp }}</strong> (valid for 10 minutes)</li>
    </ul>
    <p>Visit the <a href="{{ $verificationUrl }}">verification page</a> to enter the OTP. If you encounter issues, please contact support.</p>
    <p>Best regards,<br>The PathSeeker Team</p>
</body>
</html>