<?php
include 'utils.php';

$err = [];
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$item = fix_input($_POST['product']);
	if (!empty($item))
	{
		if (add_to_cart($item, $_SESSION['loggued_on_user']))
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
				<input type="submit" name="submit" value="Add" />
			</div>
		</form>
		<a href="index.php">Home</a>
	</body>
</html>
