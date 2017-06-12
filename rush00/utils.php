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

function save_cart($cart, $login)
{
	if (empty($login))
	{
		setcookie('cart', serialize($cart), time() + 3600 * 24 * 7);
	}
	else
	{
		$_SESSION['cart'] = $cart;
	}
}

function get_cart($login)
{
	if (empty($login))
	{
		$cart = unserialize($_COOKIE['cart']);
		if ($cart === false)
			return ([]);
		else
			return ($cart);
	}
	else
	{
		if (empty($_SESSION['cart']))
			return ([]);
		else
			return ($_SESSION['cart']);
	}
}

function add_to_cart($item, $qty, $login)
{
	$cart = get_cart($login);
	$new_cart = [];
	$inc = false;

	foreach ($cart as $c)
	{
		if ($c['id'] === $item)
		{
			$inc = true;
			$c['qty'] += $qty;
		}
		$new_cart[] = $c;
	}
	if (!$inc)
	{
		$new_cart = $cart;
		$new_cart[] = ['id' => $item, 'qty' => $qty];
	}
	save_cart($new_cart, $login);
	return (true);	
}

function remove_from_cart($item, $login)
{
	$cart = get_cart($login);
	$new_cart = [];
	foreach ($cart as $c)
	{
		if ($c['id'] === $item)
			continue;
		$new_cart[] = $c;
	}
	save_cart($new_cart, $login);
	return ($new_cart);
}

function merge_cart($login)
{
	$cart = get_cart("");
	$user_cart = [];

	if ($cart !== false)
	{
		foreach ($cart as $item)
			$_SESSION['cart'][] = $item;
		setcookie('cart', 'rip', time() - 1);
	}
	if (isset($_COOKIE[$login . "_cart"]))
	{
		$user_cart = unserialize($_COOKIE[$login . "_cart"]);
		if ($user_cart === false)
			$user_cart = [];
		foreach ($user_cart as $item)
			$_SESSION['cart'][] = $item;
		setcookie($login . "_cart", 'rip', time() - 1);
	}
}

function cart_size($login)
{
	$cart = get_cart($login);
	return (count($cart));
}

function destroy_cart($login)
{
}

function get_user_info($login)
{
	$user = file_get_contents('users/' . $login);
	$user = unserialize($user);
	if ($user == false)
		$user = "";
	return ($user);
}

function get_all_users()
{
	$users = [];
	$files = scandir('users/');
	if ($files == false)
		return ([]);
	foreach ($files as $file)
	{
		if (!in_array($file, array('.', '..')))
		{
			$content = get_user_info($file);
			if (!empty($content))
				$users[] = $content;
		}
	}
	return ($users);
}

function get_product_info($product)
{
	$p = file_get_contents('products/' . $product);
	$p = unserialize($p);
	if ($p == false)
		$p = "";
	return ($p);
}

function get_all_products()
{
	$products = [];
	$files = scandir('products/');
	if ($files == false)
		return ([]);
	foreach ($files as $file)
	{
		if (!in_array($file, array('.', '..')))
		{
			$content = get_product_info($file);
			if ($content != false)
				$products[] = $content;
		}
	}
	return ($products);
}

function product_exists($product)
{
	return (file_exists('products/' . $product));
}

function get_order_info($id)
{
	$p = file_get_contents('orders/' . $id);
	$p = unserialize($p);
	if ($p == false)
		$p = "";
	return ($p);
}

function get_all_orders()
{
	$orders = [];
	$files = scandir('orders/');
	if ($files == false)
		return ([]);
	foreach ($files as $file)
	{
		if (!in_array($file, array('.', '..')))
		{
			$content = get_order_info($file);
			if ($content != false)
				$orders[] = $content;
		}
	}
	return ($orders);
}

function order_exists($id)
{
	return (file_exists('orders/' . $id));
}

function create_order($login, $cart)
{
	$order = [];

	$order[] = ['id' => time(), 'login' => $login];
	foreach ($cart as $c)
	{
		$order[] = $c;
	}
	return ($order);
}

?>
