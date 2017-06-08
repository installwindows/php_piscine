#!/usr/bin/php
<?php
function cmp($a, $b)
{
	$s = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$a = strtoupper($a);
	$b = strtoupper($b);
	$pa = strpos($s, $a);
	$pb = strpos($s, $b);

	//echo "a: " . $a . "\nb: " . $b . "\n";
	//echo "pa: " . $pa . "\npb: " . $pb . "\n";
	if (is_bool($pa) === false)
	{
		if (is_bool($pb) === false)
			return ($pa - $pb);
		else
			return (-1);
	}
	else if (is_bool($pb) === false)
	{
		return (1);
	}
	else
	{
		return (strcmp($a, $b));
	}
}
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

//echo cmp("A", "0") . "\n";
//echo cmp("#", "0") . "\n";
//return ;

$i = 1;
$array = [];

while ($i < $argc)
	$array = array_merge($array, ft_split($argv[$i++]));
usort($array, 'cmp');
$i = 0;
while (isset($array[$i]))
	echo $array[$i++] . "\n";
