<?php
include 'utils.php';

session_start();

$msg = "";
$err = [];
$login = "";
$passwd = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['login']))
		$err[] = "Login required";
	else
		$login = fix_input($_POST['login']);
	if (empty($_POST['passwd']))
		$err[] = "Password required";
	else
		$passwd = fix_input($_POST['passwd']);
	if (empty($err))
	{
		if (!ctype_alnum($login))
			$err[] = "Login must be alphanumeric";
		if (!ctype_alnum($passwd))
			$err[] = "Password must be alphanumeric";
		if (login_exists($login))
			$err[] = "Login already exist";
		if (empty($err))
		{
			$pwd = hash('whirlpool', $passwd);
			$file[] = ['login' => $login, 'passwd' => $pwd];
			file_put_contents('users/' . $login, serialize($file));
			$_SESSION['loggued_on_user'] = $_POST['login'];
			$msg = "Success!";
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<body>
		<h2>Create Account</h2>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<form action="create.php" method="POST">
			Username: <input type="text" name="login" value="<?php echo $login; ?>"/>
			<br />
			Password: <input type="password" name="passwd" value="<?php echo $passwd ?>"/>
			<br />
			<input type="submit" name="submit" value="OK" />
		</form>
		<a href="index.php">Home</a>
		<div class="success">
		<?php
			echo $msg . "<br />\n";
			if (!empty($msg))
			{
		?>
				<script>setTimeout(function(){window.location = "index.php";}, 2000);</script>
		<?php
			}
		?>
		</div>
	</body>
</html>
