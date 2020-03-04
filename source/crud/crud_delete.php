<?php
require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
require_once ("Classes/User.php");

$user = new User();

$user_id = -1;
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



