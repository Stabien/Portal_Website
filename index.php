<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projets;charset=utf8', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
	$check_username = $bdd->query('SELECT username FROM accounts WHERE username="' . strtolower($_POST['username']) . '"');
	$check_email_address = $bdd->query('SELECT email_address FROM accounts WHERE email_address="' . strtolower($_POST['email']) . '"');
	if (!$check_username->fetch() && !$check_email_address->fetch()) {
		$req = $bdd->prepare('INSERT INTO accounts (username, email_address, password) VALUES(?, ?, ?)');
		$req->execute(array($_POST['username'], strtolower($_POST['email']), $_POST['password']));
		header('Location: registration_success.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Registration</title>
</head>

<body>
	<form id="login" onsubmit="return check_user_infos()" action="index.php" method="post">
		<h1>Registration</h1>
		<label for="username">Username</label>
		<input class="input" name="username" type="text" placeholder="Username">
		<p>Please enter a valid username</p>
		<?php 
		if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
			if ($check_username->fetch())
				echo '<span>This username is already taken</span>';
		}
		?>
		<label for="email">Email address</label>
		<input class="input" name="email" type="text" placeholder="Email">
		<p>Please enter a valid email address</p>
		<?php 
		if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
			if ($check_email_address->fetch())
				echo '<span>This email address is already taken</span>';
		}
		?>
		<label for="password">Password</label>
		<input class="input" name="password" type="password" placeholder="Password">
		<p>Please enter a valid password</p>
		<label for="password_confirmation">Password confirmation</label>
		<input class="input" name="password_confirmation" type="password" placeholder="Confirm your password">
		<p>Please enter a valid password</p>
		<input id="submit" type="submit" value="Sign up">
		<a href="login.php">Sign in</a>
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/placeholder.js"></script>
	<script src="js/registration_check_fields.js"></script>
</body>

</html>