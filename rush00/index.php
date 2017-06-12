<?php
session_start();
session_start();
if (empty($_SESSION['loggued_on_user']))
	$user = "";
else
	$user = $_SESSION['loggued_on_user'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>BShop</title>
	</head>
	<body>
		<h1>Welcome to BShop<?php echo ", " . $user; ?></h1>
		<p>Enjoy our humongous selection of hand picked bananas from all over the world! Crafted by expert growers with the uttermost care for quality, environment, handling and flavors, we pledge to offer the BEST online shopping experience for our BELOVED customers.</p>
		<p><a href="login.php">Login</a> <a href="create.php">Create Account</a> <a href="product.php">Product</a> <a href="cart.php">Cart</a> <a href="logout.php">Logout</a> <a href="admin.php">admin</a></p>
		<br />
	</body>
</html>
