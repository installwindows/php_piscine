<?php
session_start();
date_default_timezone_set("Europe/Paris");

$user = $_SESSION['loggued_on_user'];
if ($user === "")
{
	header("Location: index.html", true, 301);
	echo "ERROR\n";
	return ;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<input type="text" name="msg" />
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!file_exists('../private/chat'))
		file_put_contents('../private/chat', "");
	$file = fopen('../private/chat', 'r+');
	flock($file, LOCK_EX);

	$content = file_get_contents('../private/chat');
	$content = unserialize($content);

	$content[] = ['login' => $user, 'time' => time(), 'msg' => $_REQUEST['msg']];
	file_put_contents('../private/chat', serialize($content));

	flock($file, LOCK_UN);
	fclose($file);
}
