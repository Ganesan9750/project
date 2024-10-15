<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email Sent</title>
</head>
<body>
	<form action="http://localhost/api_email/create.php" method="POST">
		<center>
			<div>
				<h2>Email</h2>
				<input type="text" name="email" id="email" placeholder="Enter the Email id">
				<br>
				<br>
				<input type="text" name="subject" id="subject" placeholder="Enter the Subject">
				<br>
				<br>
				<input type="text" name="message" id="message" placeholder="Enter the Message">
				<br>
				<br>
				<button type="submit">Send</button>
			</div>
		</center>
	</form>
</body>
</html>
<script>
	alert("message is Sent!!")
</script>