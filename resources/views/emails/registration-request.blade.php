<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Status - PathSeeker</title>
</head>
<body>
    <h2>Registration Request Received</h2>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for registering with PathSeeker as a {{ $user->role }}. Your request has been received and is pending admin approval.</p>
    <p>To verify your email, please use one of the following options:</p>
    <ul>
        <li><strong>Verification Link</strong>: <a href="{{ $verificationUrl }}">Click here to verify your email</a></li>
        <li><strong>OTP</strong>: Use the code <strong>{{ $otp }}</strong> on the verification page (valid for 10 minutes).</li>
    </ul>
    <p>You will be redirected to the verification page after registration. If you encounter issues, please contact support.</p>
    <p>Best regards,<br>The PathSeeker Team</p>
</body>
</html>