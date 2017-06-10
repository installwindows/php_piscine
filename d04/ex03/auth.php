<?php
function auth($login, $passwd)
{
	if (!file_exists('../private/passwd'))
		return (false);
	$file = file_get_contents('../private/passwd');
	$file = unserialize($file);
	$pwd = hash('whirlpool', $passwd);
	if ($file === "")
		return (false);
	foreach ($file as $e)
	{
		if ($e['login'] === $login && $e['passwd'] === $pwd)
			return (true);
	}
	return (false);
}
?>
