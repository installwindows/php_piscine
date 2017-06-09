#!/usr/bin/php
<?php
function update_a($str)
{
	$str = preg_replace_callback("/>(.*?)</s", function ($match) {return (">" . strtoupper($match[1]) . "<");}, $str[0]);
	$str = preg_replace_callback('/title="(.*?)"/s', function ($match) {return ('title="' . strtoupper($match[1]) . '"');}, $str);
	return ($str);
}
if ($argc != 2 || !file_exists($argv[1]))
	return ;
$file = file_get_contents($argv[1]);
if ($file === false)
	return ;
echo preg_replace_callback('/<a.*?<\/a>/is', 'update_a', $file);
