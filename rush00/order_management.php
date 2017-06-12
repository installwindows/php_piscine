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
	$id = "";
	$oldid = "";
	$submit = "";

	$submit = fix_input($_POST['submit']);
	if ($submit === "Delete")
	{
		if (empty($_POST['id']))
			$err[] = "Id required";
		else
			$id = fix_input($_POST['id']);
		if (empty($_POST['oldid']))
			$err[] = "Old id required";
		else
			$oldid = fix_input($_POST['oldid']);
		if (!ctype_alnum($id))
				$err[] = "id must be alphanumeric";
		if (!ctype_alnum($oldid))
				$err[] = "old id login must be alphanumeric";
		if (empty($err))
		{
			if (order_exists($oldid))
			{
				unlink('orders/' . $oldid);
			}
			else
				$err[] = "Don't change the old id";
		}
	}
}
$orders = get_all_orders();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
	</head>
	<body>
		<h1>Order Management</h1>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<h2>Orders</h2>
		<?php
			foreach ($orders as $p)
			{
				echo '<form action="order_management.php" method="POST">';
				echo 'Id <input type="text" name="id" value="' . $p[0]['id'] . '" /><br />';
				echo 'Login <input type="text" name="login" value="' . $p[0]['login'] . '" /><br />';
				echo '<input type="hidden" name="oldid" value="' . $p[0]['id'] . '" />';
				echo '<input type="hidden" name="oldlogin" value="' . $p[0]['login'] . '" />';
				$i = 1;
				while (isset($p[$i]))
				{
					echo '<ul>';
					echo '<li>Price <input type="text" name="price" value="' . $p[$i]['price'] . '" /></li>';
					echo '<input type="hidden" name="oldname" value="' . $p[$i]['id'] . '" />';
					echo '<li>Category <input type="text" name="category" value="' . $p[$i]['category'] . '" /></li>';
					echo '</ul>';
					$i++;
				}
				echo '<input type="submit" name="submit" value="Delete" /> ';
				echo '</form>';
				echo '<hr />';
			}
		?>
		<p><a href="admin.php">admin</a></p>
	</body>
</html>
