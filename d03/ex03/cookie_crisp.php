<?php
switch ($_GET["action"])
{
	case "set":
		setcookie($_GET["name"], $_GET["value"], time() + 3600);
		break;
	case "get":
		if (isset($_COOKIE[$_GET["name"]]))
			echo $_COOKIE[$_GET["name"]] . "\n";
		break ;
	case "del":
		setcookie($_GET["name"], "byebye", time() - 1);
		break ;
}
