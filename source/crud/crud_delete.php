<?php
require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
//require_once ("Classes/DBController.php");
require_once ("Classes/User.php");

//$db_handle = new DBController();
$user = new User();

$user_id = 2;
$userResult = $user->deleteUser($user_id);
echo '$userResult: '.$userResult;
if($userResult==1)
{
    echo "<br> successfully deleted";
}
else
{
    echo "<br> deletion failed";
}



?>



