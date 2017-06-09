#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
if ($argc != 2)
	return ;
if (!preg_match("/^(\w+) ([0-2]?[0-9]) (\w+) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/", $argv[1], $input))
{
	echo "Wrong Format\n";
	return ;
}
$weekday = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi",
		"Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
$month = ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre",
		"Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
$is_weekday = false;
$is_month = false;
foreach ($weekday as $day)
{
	if ($input[1] === $day)
	{
		$is_weekday = true;
		break ;
	}
}
$i = 0;
foreach ($month as $m)
{
	if ($input[3] === $m)
	{
		$is_month = true;
		$input[3] = $i % 12 + 1;
	}
	$i++;
}
if (!$is_weekday || ! $is_month)
{
	echo "Wrong Format\n";
	return ;
}
echo mktime($input[5], $input[6], $input[7], $input[3], $input[2], $input[4]) . "\n";
