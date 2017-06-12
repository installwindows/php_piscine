<?php
include 'utils.php';

$err = [];
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$item = fix_input($_POST['product']);
	$qty = fix_input($_POST['qty']);
	//check if product exist
	if (preg_match('/^[0-9]+$/', $qty) === false || strlen($qty) > 2)
		$err[] = "Quantity invalid";
	if (empty($err))
	{
		if (add_to_cart($item, $qty, $_SESSION['loggued_on_user']))
			$msg = "Product added to cart";
		else
			$err[] = "Can't add the product";
	}
	else
		$err[] = "Invalid product";
}
$products = get_all_products();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Product</title>
	</head>
	<body>
		<div class="error">
		<?php
			foreach ($err as $e)
				echo $e . "<br />\n";
		?>
		</div>
		<div class="info">
			<p><?php echo $msg; ?></p>
		</div>
		<?php
			foreach ($products as $p)
			{
				echo '<form action="product.php" method="POST">';
				echo '<div class="item">';
				echo $p['id'] . '<br />';
				echo '<ul>';
				echo '<li>' . $p['category'] . '</li>';
				echo '<li>' . $p['price'] . '</li>';
				echo '</ul>';
				echo '<input type="hidden" name="product" value="' . $p['id'] . '" />';
				echo 'Quantity <input type="text" name="qty" value="1" size="2" maxlength="2"/><br />';
				echo '<input type="submit" name="submit" value="Add" />';
				echo '</div>';
				echo '</form>';
				echo '<hr />';
			}
		?>
		<a href="index.php">Home</a>
	</body>
</html>
