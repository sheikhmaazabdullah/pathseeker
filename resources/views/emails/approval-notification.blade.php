<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Status - PathSeeker</title>
</head>
<body>
    <h2>Registration {{ ucfirst($status) }}</h2>
    <p>Dear {{ $user->name }},</p>
    <p>Your registration as a {{ $user->role }} has been {{ $status }}.</p>
    @if ($status === 'approved')
        <p>You can now log in to PathSeeker.</p>
    @else
        <p>If you believe this is an error, please contact support.</p>
    @endif
    <p>Best regards,<br>The PathSeeker Team</p>
</body>
</html>