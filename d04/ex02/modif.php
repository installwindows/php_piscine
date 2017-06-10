<?php
if ($_POST['submit'] !== "OK" || $_POST['login'] === "" || $_POST['oldpw'] === "" || $_POST['newpw'] === "" || !file_exists('../private/passwd'))
{
	echo "ERROR\n";
	return ;
}
$old_hash = hash('whirlpool', $_POST['oldpw']);
$new_hash = hash('whirlpool', $_POST['newpw']);
$file = file_get_contents('../private/passwd');
$content = unserialize($file);
$new_file = [];
$updated = false;
foreach ($content as $entry)
{
	if ($_POST['login'] === $entry['login'] && $entry['passwd'] === $old_hash)
	{
		$entry['passwd'] = $new_hash;
		$updated = true;
	}
	$new_file[] = $entry;	
}
if ($updated)
{
	echo "OK\n";
	file_put_contents('../private/passwd', serialize($new_file));
}
else
	echo "ERROR\n";
