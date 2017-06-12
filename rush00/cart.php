<?php
include 'utils.php';

$cart = get_cart($_SESSION['loggued_on_user']);
$err = [];
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	$delete = fix_input($_POST['delete']);
	if (!empty($delete))
		$cart = remove_from_cart($delete, $_SESSION['loggued_on_user']);
	else
		$err[] = "Invalid item id";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>BShop</title>
	</head>
	<body>
		<h2>My cart</h2>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<ul>
		<?php
			foreach ($cart as $c)
			{
				echo '<form action="cart.php" method="POST">';
				echo "<li>" . $c['qty'] . " of " . $c['id'] . ' ';
				echo '<input type="hidden" name="delete" value="' . $c['id'] . '" />';
				echo '<input type="submit" name="submit" value="Delete" /></li>';
				echo '</form>';
			}
		?>
		</ul>
		<div><?php echo cart_size($_SESSION['loggued_on_user']); ?></div>
		<a href="index.php">Home</a> <a href="checkout.php">Checkout</a>
	</body>
</html>
