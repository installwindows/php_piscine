<?php
include 'utils.php';

$admin = $_SESSION['loggued_on_user'];
$user = get_user_info($admin);
$err = [];

if (empty($user))
	$err = "You need to login";
else if ($user['type'] != 'admin')
	$err = "You need to be an admin";
if (!empty($err))
{
?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Administration</title>
		</head>
		<body>
			<p><?php echo $err; ?></p>
			<a href="login.php">login</a>
		</body>
	</html>
<?php
	return ;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login = "";
	$oldlogin = "";
	$passwd = "";
	$type = "";
	$submit = "";
	$update = "";

	$submit = fix_input($_POST['submit']);
	if ($submit === "Create")
	{
		if (empty($_POST['login']))
			$err[] = "Login required";
		else
			$login = fix_input($_POST['login']);
		if (empty($_POST['passwd']))
			$err[] = "Password required";
		else
			$passwd = fix_input($_POST['passwd']);
		if (empty($_POST['type']))
			$err[] = "Type required";
		else
			$type = fix_input($_POST['type']);
		if (empty($err))
		{
			if (!ctype_alnum($login))
				$err[] = "Login must be alphanumeric";
			if (!ctype_alnum($passwd))
				$err[] = "Password must be alphanumeric";
			if (!ctype_alnum($type))
				$err[] = "Type must be alphanumeric";
			if (empty($err))
			{
				$pwd = hash('whirlpool', $passwd);
				$file = ['login' => $login, 'passwd' => $pwd, 'type' => $type];
				file_put_contents('users/' . $login, serialize($file));
				$msg = "Success!";
			}
		}
	}
	else if ($submit === "Delete")
	{
		if (empty($_POST['login']))
			$err[] = "Login required";
		else
			$login = fix_input($_POST['login']);
		if (empty($_POST['oldlogin']))
			$err[] = "Old login required";
		else
			$oldlogin = fix_input($_POST['oldlogin']);
		if (!ctype_alnum($login))
				$err[] = "Login must be alphanumeric";
		if (!ctype_alnum($oldlogin))
				$err[] = "Old login must be alphanumeric";
		if (empty($err))
		{
			if (login_exists($oldlogin))
			{
				unlink('users/' . $oldlogin);
			}
			else
				$err[] = "Don't change the old login";
		}
	}
	$update = fix_input($_POST['update']);
	if ($update === "Update")
	{
		if (empty($_POST['login']))
			$err[] = "Login required";
		else
			$login = fix_input($_POST['login']);
		if (empty($_POST['oldlogin']))
			$err[] = "Old login required";
		else
			$oldlogin = fix_input($_POST['oldlogin']);
		if (empty($_POST['type']))
			$err[] = "Type required";
		else
			$type = fix_input($_POST['type']);
		if (!ctype_alnum($login))
				$err[] = "Login must be alphanumeric";
		if (!ctype_alnum($oldlogin))
				$err[] = "Old login must be alphanumeric";
		if (!ctype_alnum($type))
			$err[] = "Type must be alphanumeric";
		if (empty($err))
		{
			if (login_exists($oldlogin))
			{
				$tmp = get_user_info($oldlogin);
				$pwd = $tmp['passwd'];
				if (!empty($_POST['passwd']))
				{
					$passwd = fix_input($_POST['passwd']);
					if (!ctype_alnum($passwd))
						$err[] = "Password must be alphanumeric";
					else
						$pwd = hash('whirlpool', $passwd);
				}
				if (empty($err))
				{
					unlink('users/' . $oldlogin);
					$file = ['login' => $login, 'passwd' => $pwd, 'type' => $type];
					file_put_contents('users/' . $login, serialize($file));
					$msg = "Success!";
				}
			}
			else
				$err[] = "Don't change the old login";
		}
	}
}
$users = get_all_users();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
	</head>
	<body>
		<h1>User Management</h1>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<h2>Users</h2>
		<?php
			foreach ($users as $u)
			{
				echo '<form action="user_management.php" method="POST">';
				echo 'Login <input type="text" name="login" value="' . $u['login'] . '" /><br />';
				echo 'Password <input type="password" name="passwd" value="" /><br />';
				echo '<input type="hidden" name="oldlogin" value="' . $u['login'] . '" />';
				echo 'Type <input type="text" name="type" value="' . $u['type'] . '" /><br />';
				echo '<input type="submit" name="submit" value="Delete" /> ';
				echo '<input type="submit" name="update" value="Update" />';
				echo '</form>';
				echo '<hr />';
			}
		?>
		<h2>Create</h2>
		<form action="user_management.php" method="POST">
			Username: <input type="text" name="login" value=""/>
			<br />
			Password: <input type="password" name="passwd" value=""/>
			<br />
			Type: <input type="text" name="type" value="normal"/>
			<br />
			<input type="submit" name="submit" value="Create" />
		</form>
		<p><a href="admin.php">admin</a></p>
	</body>
</html>
