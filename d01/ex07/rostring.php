#!/usr/bin/php
<?php
function ft_split($str)
{
	$array = [];
	$i = 0;
	$len = strlen($str);

	while ($i < $len)
	{
		while (isset($str[$i]) && $str[$i] == ' ')
			$i++;
		$start = $i;
		if (isset($str[$i]) == false)
			break ;
		while (isset($str[$i]) && $str[$i] != ' ')
			$i++;
		$array[] = substr($str, $start, $i - $start);
	}
	return ($array);
}

$i = 1;
$array = [];

while ($i < $argc)
	$array = array_merge($array, ft_split($argv[$i++]));
$n = count($array);
if ($n == 0)
	return ;
$i = 1;
while (isset($array[$i]) && $i < $n - 1)
	echo $array[$i++] . " ";
echo $array[0] . "\n";
