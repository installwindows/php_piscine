#!/usr/bin/php
<?php
$fd = fopen("php://stdin", "r");
$line = "";
while (true)
{
	echo "Enter a number: ";
	if (($line = fgets($fd)) == false)
		break ;
	$line = trim($line);
	if (is_numeric($line) && strchr($line, '.') == false)
	{
		$n = intval($line);
		echo "The number " . $n . " is " . ($n % 2 ? "odd" : "even") . "\n";
	}
	else
		echo "'" . $line . "'" . " is not a number\n";
}
echo "\n";
