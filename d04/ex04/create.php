<?php
if ($_POST['submit'] !== "OK" || !isset($_POST['login']) || $_POST['login'] === "" || !isset($_POST['passwd']) || $_POST['passwd'] === "")
{
	echo "ERROR\n";
	return ;
}
$hashed_pwd = hash('whirlpool', $_POST['passwd']);

if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists('../private/passwd'))
	file_put_contents("../private/passwd", "");
$file = file_get_contents("../private/passwd");
if ($file !== "")
{
	$file = unserialize($file);
	foreach ($file as $entry)
	{
		if ($entry['login'] === $_POST['login'])
		{
			echo "ERROR\n";
			return ;
		}
	}
}
$file[] = ['login' => $_POST['login'], 'passwd' => $hashed_pwd];
$file = serialize($file);
file_put_contents("../private/passwd", $file);
header("Location: index.html", true, 301);
echo "OK\n";
