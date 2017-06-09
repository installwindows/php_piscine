<?php
if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "Ilovemylittleponey")
{
	echo "<html><body>";
	echo "\nHello Zaz<br />\n";
	echo "<img src='data:image/png;base64,";
	echo base64_encode(file_get_contents("../img/42.png"));
	echo "'>\n";
	echo "</body></html>\n";
}
else
{
	header('HTTP/1.0 401 Unauthorized');
	header('WWW-Authenticate: Basic realm=\'\'Member area\'\'');
	echo "<html><body>";
	echo "That area is accessible for members only";
	echo "</body></html>\n";
}
