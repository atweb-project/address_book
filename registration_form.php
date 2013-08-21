<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Address Book</title>
<link type="text/css" href="style.css" rel="stylesheet">
</head>
<body>
<div id="content-box">
	<div id="internal">
	<h2>Καλώς ήρθατε στο προσωπικό σας Address book</h2>
	<img alt="" src="addressbook_image.png">
	<div id="registration-box">
			<div id="registration-internal">
				<form action="register.php" method="post">
					<fieldset id="login">
						<label id="un"><b>Username:</b></label>
						<input id="un"type="text" name="username" size="30" maxlength="60"/><br />
						<label id="pw"><b>Password:</b></label>
						<input id="pw" type="password" name="password" size="30" maxlength="30"/><br />
						<label id="e"><b>Email:</b></label>
						<input id="e" type="text" name="email" size="30" maxlength="30"/><br />
						<input id="button-register" type="submit" value="Εγγραφή"/>
						<input type="hidden" name="submitted" value="TRUE" />
					</fieldset>
				</form>
				
			</div>
		</div>
		
	</div>
</div>
</body>
</html>