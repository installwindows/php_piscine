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
		<form action="product.php" method="POST">
			<div class="item">
				Sample banana
				<ul>
					<li>Yellow</li>
					<li>4.99</li>
					<li>California</li>
				</ul>
				<input type="hidden" name="product" value="sample_banana" />
				Quantity <input type="text" name="qty" value="1" size="2" maxlength="2"/><br />
				<input type="submit" name="submit" value="Add" />
			</div>
		</form>
		<hr />
		<form action="product.php" method="POST">
			<div class="item">
				Purple Banana
				<ul>
					<li>Purple</li>
					<li>0.59</li>
					<li>East</li>
				</ul>
				<input type="hidden" name="product" value="purple_banana" />
				Quantity <input type="text" name="qty" value="1" size="2" maxlength="2"/><br />
				<input type="submit" name="submit" value="Add" />
			</div>
		</form>
		<a href="index.php">Home</a>
	</body>
</html>
