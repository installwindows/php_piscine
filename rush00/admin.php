<?php
include 'utils.php';

$login = $_SESSION['loggued_on_user'];
$user = get_user_info($login);
$err = "";

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
$users = [];
$products= [];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
	</head>
	<body>
		<h2>User Management</h2>
			<a href="user_management.php">Users</a>
		<h2>Product Management</h2>
			<a href="product_management.php">Products</a>
		<h2>Orders Management</h2>
			<a href="order_management.php">Orders</a>
		<hr />
		<a href="index.php">home</a>
	</body>
</html>
