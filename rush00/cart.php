<?php
include 'utils.php';

$cart = get_cart($_SESSION['loggued_on_user']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>BShop</title>
	</head>
	<body>
		<h2>My cart</h2>
		<ul>
		<?php
			foreach ($cart as $c)
			{
				echo "<li>" . $c . "</li>\n";
			}
		?>
		</ul>
		<a href="index.php">Home</a>
	</body>
</html>
