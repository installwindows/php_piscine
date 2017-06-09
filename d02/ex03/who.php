#!/usr/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');
$file = file_get_contents('/var/run/utmpx');
$file = substr($file, 1256);
$user = get_current_user();
$data = [];
$entrytype = 'a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad';
while ($file != NULL)
{
	$entry = unpack($entrytype, $file);
	if ($entry['type'] == 7)
	{
		$date = date("M  j H:i", $entry['time1']);
		$data[] = trim($entry['user']) . "  " . trim($entry['line']) . "  " . $date;
	}
	$file = substr($file, 628);
}
sort($data);
foreach ($data as $e)
	echo $e . "\n";
