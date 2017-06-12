<?php
include 'utils.php';

$msg = "";
$err = [];
$login = $_SESSION['loggued_on_user'];
if (empty($login))
	$err[] = "You need to be login";
$cart = get_cart($login);
if (empty($cart))
	$err[] = "Your cart is empty";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$submit = "";

	if (empty($_POST['submit']))
		$err[] = "Submit invalid";
	else
		$submit = fix_input($_POST['submit']);
	if ($submit === 'Accept')
	{
		$order = create_order($login, $cart);
		$msg = $order['id'];
	}
	else
		$err[] = "Submit value invalid";
}
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
		<div>
		<?php
			if (empty($err) && empty($msg))
			{
				$total = 0;
				foreach ($cart as $c)
				{
					$item = get_product_info($c['id']);
					$total += $item['price'];
					echo $c['qty'] . " of " . $c['id'] . ' for ' . $item['price'] . '<br />';
				}
				echo '<br /><b>Total: ' . $total . '</b><br />';
		?>
				<form action="checkout.php" method="POST">
					<input type="submit" name="submit" value="Accept" />
				</form>
		<?php
			}
		?>
		</div>
		<div>
		<?php
			if (!empty($msg))
				echo "Your order id is " . $msg;
		?>
		</div>
		<a href="index.php">Home</a>
	</body>
</html>
