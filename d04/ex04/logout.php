<?php
session_start();
if (isset($_SESSION['loggued_on_user']))
	$_SESSION['loggued_on_user'] = "";
header("Location: index.html", true, 301);
