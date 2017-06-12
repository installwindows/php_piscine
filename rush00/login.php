<?php
include 'utils.php';

session_start();

function auth($login, $passwd)
{
	if (!file_exists('users/' . $login))
		return (false);
	$file = file_get_contents('users/' . $login);
	$content = unserialize($file);
	$pwd = hash('whirlpool', $passwd);
	if ($content['login'] === $login && $content['passwd'] === $pwd)
		return (true);
	return (false);
}

$login = "";
$passwd = "";
$err = [];
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login = fix_input($_POST['login']);
	$passwd = fix_input($_POST['passwd']);

	if (auth($login, $passwd))
	{
		$_SESSION['loggued_on_user'] = $login;
		merge_cart($login);
		$msg = "Success!";
	}
	else
		$err[] = "Invalid login and/or password";
}
?>
<!DOCTYPE html>
<html>
	<body>
		<h2>Login</h2>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<form action="login.php" method="POST">
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
