<?php
include 'utils.php';

$err = [];
$login = $_SESSION['loggued_in_user'];
if (empty($login))
	$err[] = "You need to be login";
$cart = get_cart($login);
if (empty($cart))
	$err[] = "Your cart is empty";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Checkout</title>
	</head>
	<body>
		<h2>Checkout</h2>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
	</body>
</html>
