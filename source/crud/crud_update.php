<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//echo 'hello';
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
//$_SESSION['page'] = "update";
//$redis = new Redis();
//$redis->connect('devcache1', 6379);
// gets the value of message
$value = $redis->get('page');

// Hello world
echo '<br>-----//'.$value.'//----------'; 
//require_once ("Classes/DBController.php");

//echo '<br>hello1';
require_once ($_SERVER['DOCUMENT_ROOT'] ."/Classes/User.php");
//echo '<br>hello2';
//$db_handle = new DBController();
//$user = new User();
//$u_id=9;
//$u_login='abdou_test';
//$u_first_name='ABDALLAH';
//$userResult = $user->editUser($u_id,$u_login,$u_first_name);
//$_SESSION['page'] = "header";
//echo '$userResult: '.$userResult;
//if($userResult==1)
//{
//    echo "<br> successfully updated";
//}
//else
//{
//    echo "<br> update failed";
//}

?>

