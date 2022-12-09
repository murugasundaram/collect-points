<!DOCTYPE html>
<html>
<head>
    <title>Collect points</title>
</head>
<body>
	<h2>Hello!</h2>
	<p>
		Your password has been regenerated successfully! Please find the blow informations.
	</p>
    <h4>Portal Details:</h4>
    <p>Url : {{ $details['url'] }} </p>
    <p>User name : {{ $details['name'] }} </p>
    <p>Email Address : this one </p>
    <p>Password : {{ $details['password'] }} </p>
   	<br><br>
    <p>Thank you</p>
</body>
</html>