<?php

//print_r($_POST);
//require_once $_SERVER['DOCUMENT_ROOT'] . '/dbconfig.php';

require_once ($_SERVER['DOCUMENT_ROOT'] . "/Classes/User.php");

//$db_handle = new DBController();

//error_log("\n You hit parsing.php!", 3, "/tmp/errors.log");


if (isset($_POST['action']) && $_POST['action'] == 'create_user' ) {

//    error_reporting(1);
    $user = new User();
    // Submitted form data
    $u_id = trim($_POST['u_id']);
    $u_login = trim($_POST['u_login']);
    $u_pass = trim($_POST['u_pass']);
    $u_first_name = trim($_POST['u_first_name']);
    $u_last_name = trim($_POST['u_last_name']);
    $u_status = trim($_POST['u_status']);
    $u_email = trim($_POST['u_email']);
    
//    error_log("\n Before hash!", 3, "/tmp/errors.log");
    $options = array(
        'salt' => random_bytes(22),
        'cost' => 12,
      );
    
    $password_hash = password_hash($u_pass, PASSWORD_BCRYPT, $options);
//    error_log("\n Pass HASH!".$password_hash, 3, "/tmp/errors.log");
//    die;
//    error_log("\n After hash!", 3, "/tmp/errors.log");
    $userResult = $user->addUser( $u_login, $u_email, $password_hash, $u_first_name, $u_last_name, $u_status);
    echo $userResult;
    unset($user);
    die;
}

if (isset($_POST['action']) && $_POST['action'] == 'update_user' ) {

    $user = new User();
    // Submitted form data
    $u_id = trim($_POST['u_id_edit']);
    $u_login = trim($_POST['u_login_edit']);
//    $u_pass = trim($_POST['u_pass_edit']);
    $u_first_name = trim($_POST['u_first_name_edit']);
    $u_last_name = trim($_POST['u_last_name_edit']);
    $u_status = trim($_POST['u_status_edit']);
    $u_email = trim($_POST['u_email_edit']);
    
    $userResult = $user->updateUser($u_id,$u_login,$u_email,$u_first_name,$u_last_name,$u_status);
    echo $userResult;
    unset($user);
    die;
}

if (isset($_POST['action']) && $_POST['action'] == 'get_user' ) {

    $user = new User();
    // Submitted form data
    $u_id = trim($_POST['u_id']);
    
//    echo "qdqsdqsdqsdqsdqs".$u_id;
    
//    error_log("\n Your ID ".$u_id, 3, "/tmp/errors.log");
    $userResult = $user->getUserById($u_id);
    for($i=0; $i< count($userResult); $i++)
    {
        $response[] = $userResult[$i];
    }
    
//    error_log("\n DUMP ". print_r( $response, true ), 3, "/tmp/errors.log");
    
    $output = array(
        "data"    => $response
       );
    echo json_encode($output);
    unset($user);
    die;
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_user' ) {

    $user = new User();
    // Submitted form data
    $u_id = trim($_POST['u_id']);
    
//    echo "qdqsdqsdqsdqsdqs".$u_id;
    
//    error_log("\n Your ID ".$u_id, 3, "/tmp/errors.log");
    $userResult = $user->deleteUser($u_id);
    
    echo $userResult;
    unset($user);
    die;
}


?>
