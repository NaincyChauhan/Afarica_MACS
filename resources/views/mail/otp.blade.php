<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
<p><strong>Hi {{$mailData['name']}}</strong>,</p>

<p>One Time Password</p>
<p>{{$mailData['otp']}} is the One Time Password (OTP) for your Login valid for 10 minutes. Do not share your OTP with anyone, MACS never calls to verify OTP. With Regards, MACS112.</p>

</div>

</body>
</html>