<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://devcache1:6379,tcp://devcache1:6379');

require $_SERVER['DOCUMENT_ROOT'] . "/Classes/Util.php";
$util = new Util();

session_start();
$_SESSION["member_id"] = "";
session_destroy();

// clear cookies
$util->clearAuthCookie();

header("Location: ./index.php");
?>