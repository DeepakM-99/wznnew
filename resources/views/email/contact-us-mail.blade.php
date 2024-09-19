<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email_id'] }}</p>
    <p><strong>Mobile Number:</strong> {{ $data['mobile'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
