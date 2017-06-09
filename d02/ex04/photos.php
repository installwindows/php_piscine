#!/usr/bin/php
<?php
if ($argc != 2)
	return ;
if (($doc = file_get_contents($argv[1])) === false)
	return ;
preg_match_all('/<img.*?src="([^"]+)"/si', $doc, $imgs);
$dir = $argv[1];
if (substr($dir, 0, 7) == "http://")
	$dir = substr($dir, 7);
if (!file_exists($dir))
	mkdir($dir, 0777);
$i = 0;
while (isset($imgs[1][$i]))
{
	echo $imgs[1][$i] . "\n";
	$url = $imgs[1][$i];
	if (substr($url, 0, 1) == "/")
		$url = $argv[1] . $url;
	file_put_contents($dir . "/" . basename($imgs[1][$i]), fopen($url, 'r'));
	$i++;
}
