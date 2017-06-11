<?php
session_start();

if (isset($_SESSION['cart']))
{
	setcookie($_SESSION['loggued_on_user']."_cart", serialize($_SESSION['cart']), time() + 3600 * 24 * 7);
	$_SESSION['cart'] = "";
}
if (isset($_SESSION['loggued_on_user']))
	$_SESSION['loggued_on_user'] = "";
header("Location: index.php", true, 301);
