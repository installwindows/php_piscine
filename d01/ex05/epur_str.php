#!/usr/bin/php
<?php
if ($argc != 2)
	return ;
$i = 0;
$len = strlen($argv[1]);
while (isset($argv[1][$i]) && $argv[1][$i] == ' ')
	$i++;
if ($i == $len)
	return ;
while ($i < $len)
{
	while (isset($argv[1][$i]) && $argv[1][$i] != ' ')
		echo $argv[1][$i++];
	while (isset($argv[1][$i]) && $argv[1][$i] == ' ')
		$i++;
	if (isset($argv[1][$i]) && $argv[1][$i] != ' ')
		echo " ";
}
echo "\n";
