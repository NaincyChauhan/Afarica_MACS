<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
<p><strong>Hi {{$mailData['name']}}</strong>,</p>

<p>Forget Password.?</p>
<p>We received a request to reset the password for your account.</p>
<p>Your account reseted successfully. Kindly use following password to signin your account.</p>

<p> Your account credentials are following -<br>
    <ul>
        <li><strong>Password:</strong> {{$mailData['password']}}</li>
    </ul>
</p>

<p><strong>MACS</strong><br>
    <br>
    MACS@gmail.com</p>
</div>

</body>
</html>