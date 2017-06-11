<?php
session_start();
function fix_input($input)
{
	$input = trim($input);
	$input = htmlspecialchars($input);
	return ($input);
}
function login_exists($login)
{
	return (file_exists('users/' . $login));
}
function add_to_cart($item, $login)
{
	if (empty($login))
	{
		$cart = unserialize($_COOKIE['cart']);
		if ($cart === false)
			$cart = [];
		if (!empty($item))
		{
			$cart[] = $item;
			setcookie('cart', serialize($cart), time() + 3600 * 24 * 7);
		}
		else
			return (false);
	}
	else
	{
		if (!empty($item))
		{
			$_SESSION['cart'][] = $item;
		}
		else
			return (false);
	}
	return (true);
}

function get_cart($login)
{
	if (empty($login))
		return (unserialize($_COOKIE['cart']));
	else
		return ($_SESSION['cart']);
}

function remove_from_cart($item, $login)
{
}

function merge_cart($login)
{
}

function destroy_cart($login)
{
}

?>
