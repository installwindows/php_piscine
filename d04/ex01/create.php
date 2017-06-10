<?php
if ($_POST['submit'] !=== "OK" || !isset($_POST['login']) || $_POST['login'] === "" || !isset($_POST['passwd'] || $_POST['passwd'] === "")
{
	echo "ERROR\n";
	return ;
}
$hashed_pwd = hash('whirlpool', $_POST['passwd']);

if (file_exists('private/passwd'))
{
}
