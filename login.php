<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projets;charset=utf8', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}

if (isset($_POST['username'], $_POST['password'])) {
	$check_login = $bdd->prepare('SELECT COUNT(*) AS nb FROM accounts WHERE username = ? AND password = ?');
	$check_login->execute(array($_POST['username'], $_POST['password']));
	$row = $check_login->fetch();
	if ($row['nb'] != 0) {
		header('Location: login_success.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/login.css"/>
    <title>Login</title>
</head>

<body>
	<form id="login" onsubmit="return check_user_infos()" action="login.php" method="post">
		<h1>Login</h1>
		<?php
		if (isset($_POST['username'], $_POST['password'])) {
			if ($row['nb'] != 1)
				echo '<span>Wrong login</span>';
		}
		?>
		<label for="username">Username</label>
		<input class="input" name="username" type="text" placeholder="Username">
		<p>This field is empty</p>
		<label for="password">Password</label>
		<input class="input" name="password" type="password" placeholder="Password">
		<p>This field is empty</p>
		<input id="submit" type="submit" value="Login">
		<a href="index.php">Sign up</a>
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/placeholder.js"></script>
	<script src="js/login_check_fields.js"></script>
</body>
</html>