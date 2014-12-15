<!DOCTYPE html>

<html>
	<head>
		<title>Welcome to Task Organizr</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<!--Load jquery and jquery ui -->
		<script src="js/jquery-1.11.1.js"></script>
		<script src="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.js"></script>
		<script src="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.js"></script>		
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.css" />
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.structure.css" />
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.theme.css" />
		
		<script src="js/cookieTest.js"></script>
		<script src="js/cookies.js"></script>
		
		<!-- local styles and js -->
		<link rel="stylesheet" href="css/main.css"/>
		<script src="js/main.js"></script>
		
	</head>
	<body>
		<div id="page" class="container">
			<div id="login-form">
				<div id="content">
					<h2>Welcome to Task Organizr</h2>
					<div id="login-accordion">
						<h3>Login</h3>
						<div>
							<div class="errors">
								<p id="l1">Please enter a username</p>
								<p id="l2">Please enter a password</p>
								<p id="l3">Username or password are incorrect</p>
							</div>
							<form id="login" action="login.php" method="POST">
								<label for="username">Username: </label><input name="username" type="text"/><br />
								<label for="password">Password: </label><input name="password" type="password"/><br />
								<input type="submit" value="Login" />
							</form>
						</div>
						<h3>Register</h3>
						<div>
							<div class="errors">
								<p id="c1">Please enter a username</p>
								<p id="c2">Please enter a password</p>
								<p id="c3">Please confirm the password</p>								
								<p id="c4">Passwords do not match</p>
								<p id="c5">Username exists already</p>
							</div>	
							<form id="create" action="create.php" method="POST">
								<label for="username">Username: </label><input name="username" type="text"/><br />
								<label for="password">Password: </label><input name="password" type="password"/><br />
								<label for="confirm">Confirm Password: </label><input name="confirm" type="password"/><br />
								<input type="submit" value="Register" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>