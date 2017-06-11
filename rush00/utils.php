<?php
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
?>
