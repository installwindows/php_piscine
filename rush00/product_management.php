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
	$name = "";
	$oldname = "";
	$category = "";
	$price = "";
	$submit = "";
	$update = "";

	$submit = fix_input($_POST['submit']);
	if ($submit === "Create")
	{
		if (empty($_POST['name']))
			$err[] = "Name required";
		else
			$name = fix_input($_POST['name']);
		if (empty($_POST['price']))
			$err[] = "Price required";
		else
			$price = fix_input($_POST['price']);
		if (empty($_POST['category']))
			$err[] = "Cetegory required";
		else
			$category = fix_input($_POST['category']);
		if (empty($err))
		{
			if (!ctype_alnum($name))
				$err[] = "Name must be alphanumeric";
			if (!ctype_alnum($category))
				$err[] = "Category must be alphanumeric";
			if (preg_match('/^\d+\.\d+$/',$price) == false)
				$err[] = "Price must be a numer";
			if (empty($err))
			{
				$file = ['id' => $name, 'price' => $price, 'category' => $category];
				file_put_contents('products/' . $name, serialize($file));
				$msg = "Success!";
			}
		}
	}
	else if ($submit === "Delete")
	{
		if (empty($_POST['name']))
			$err[] = "Name required";
		else
			$name = fix_input($_POST['name']);
		if (empty($_POST['oldname']))
			$err[] = "Old name required";
		else
			$oldname = fix_input($_POST['oldname']);
		if (!ctype_alnum($name))
				$err[] = "name must be alphanumeric";
		if (!ctype_alnum($oldname))
				$err[] = "old name login must be alphanumeric";
		if (empty($err))
		{
			if (product_exists($oldname))
			{
				unlink('products/' . $oldname);
			}
			else
				$err[] = "Don't change the old login";
		}
	}
	$update = fix_input($_POST['update']);
	if ($update === "Update")
	{
		if (empty($_POST['name']))
			$err[] = "name required";
		else
			$name = fix_input($_POST['name']);
		if (empty($_POST['oldname']))
			$err[] = "Old name required";
		else
			$oldname = fix_input($_POST['oldname']);
		if (empty($_POST['price']))
			$err[] = "price required";
		else
			$price = fix_input($_POST['price']);
		if (empty($_POST['category']))
			$err[] = "Cetegory required";
		else
			$category = fix_input($_POST['category']);
		if (!ctype_alnum($name))
				$err[] = "Name must be alphanumeric";
		if (!ctype_alnum($oldname))
				$err[] = "Old name must be alphanumeric";
		if (!ctype_alnum($category))
			$err[] = "Category must be alphanumeric";
		if (preg_match('/^\d+\.\d+$/',$price) == false)
			$err[] = "Price must be a numer";
		if (empty($err))
		{
			if (product_exists($oldname))
			{
				unlink('products/' . $oldname);
				$file = ['id' => $name, 'price' => $price, 'category' => $category];
				file_put_contents('products/' . $name, serialize($file));
				$msg = "Success!";
			}
			else
				$err[] = "Don't change the old name";
		}
	}
}
$products = get_all_products();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
	</head>
	<body>
		<h1>Product Management</h1>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<h2>Products</h2>
		<?php
			foreach ($products as $p)
			{
				echo '<form action="product_management.php" method="POST">';
				echo 'Name <input type="text" name="name" value="' . $p['id'] . '" /><br />';
				echo 'Price <input type="text" name="price" value="' . $p['price'] . '" /><br />';
				echo '<input type="hidden" name="oldname" value="' . $p['id'] . '" />';
				echo 'Category <input type="text" name="category" value="' . $p['category'] . '" /><br />';
				echo '<input type="submit" name="submit" value="Delete" /> ';
				echo '<input type="submit" name="update" value="Update" />';
				echo '</form>';
				echo '<hr />';
			}
		?>
		<h2>Create</h2>
		<form action="product_management.php" method="POST">
			Name: <input type="text" name="name" value=""/>
			<br />
			Price: <input type="text" name="price" value=""/>
			<br />
			Category: <input type="text" name="category" value="normal"/>
			<br />
			<input type="submit" name="submit" value="Create" />
		</form>
		<p><a href="admin.php">admin</a></p>
	</body>
</html>
