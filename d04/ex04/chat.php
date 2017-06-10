<?php
session_start();
date_default_timezone_set("Europe/Paris");

$file = fopen('../private/chat', 'r');
if ($file === false)
	return ;

flock($file, LOCK_SH);
$content = file_get_contents('../private/chat');
$content = unserialize($content);

foreach ($content as $e)
{
	echo date('[H:i]', $e['time']) . " <b>" . $e['login'] . "</b>: " . $e['msg'] . "<br />\n";
}

flock($file, LOCK_UN);
fclose($file);
