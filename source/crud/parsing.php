<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/Classes/User.php");

if (isset($_POST['action']) && $_POST['action'] == 'create_user' ) {

    $user = new User();
    // Submitted form data
//    $u_id = trim($_POST['u_id']);
    $u_login = trim($_POST['u_login']);
    $u_pass = trim($_POST['u_pass']);
    $u_first_name = trim($_POST['u_first_name']);
    $u_last_name = trim($_POST['u_last_name']);
    
    $u_email = trim($_POST['u_email']);
    
    error_log("\n u_status : ".$u_status, 3, "/tmp/errors.log");
    if(empty($_POST['u_status']))
    {
        $u_status = 'f';
        error_log("\n _POST['u_status'] is EMPTY ", 3, "/tmp/errors.log");
    }
    else 
    {
        $u_status = trim($_POST['u_status']);
        error_log("\n _POST['u_status'] is NOT EMPTY ", 3, "/tmp/errors.log");
    }

    error_log("\n u_login : ".$u_login, 3, "/tmp/errors.log");
    error_log("\n u_pass : ".$u_pass, 3, "/tmp/errors.log");
    error_log("\n u_first_name : ".$u_first_name, 3, "/tmp/errors.log");
    error_log("\n u_last_name : ".$u_last_name, 3, "/tmp/errors.log");
    error_log("\n u_email : ".$u_email, 3, "/tmp/errors.log");
    error_log("\n u_status : ".$u_status, 3, "/tmp/errors.log");
    
    $options = array(
        'salt' => random_bytes(22),
        'cost' => 12,
      );
    
    $password_hash = password_hash($u_pass, PASSWORD_BCRYPT, $options);
    
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
    
    $userResult = $user->deleteUser($u_id);
    
    echo $userResult;
    unset($user);
    die;
}


?>
