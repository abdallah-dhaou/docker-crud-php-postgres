<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://devcache1:6379,tcp://devcache1:6379');


session_start();
$_SESSION["member_id"] = "";
session_destroy();
?>