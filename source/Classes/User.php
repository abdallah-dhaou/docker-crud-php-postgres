<?php 
//echo "<br> test from class user";
require_once ("DBController.php");

class User
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addUser($u_login, $u_email, $u_pass, $u_first_name,$u_last_name, $u_status) {
        $query = "INSERT INTO users  (u_login, u_email, u_pass, u_first_name, u_last_name, u_status) VALUES (?, ?, ?, ?, ?, ?)";
        $paramValue = array(
            $u_login,
            $u_email,
            $u_pass, 
            $u_first_name, 
            $u_last_name, 
            $u_status
        );
        
        error_log("\n DUMP addUser data". print_r( $paramValue, true ), 3, "/tmp/errors.log");
        $result = $this->db_handle->insert($query, $paramValue);
        return $result;

    }
    
    function updateUser($id,$login,$email,$first_name,$last_name,$status) {
        $query = "UPDATE users SET 
                    u_login = ?, 
                    u_email = ? ,
                    u_first_name = ? ,
                    u_last_name = ? ,
                    u_status = ? 
                    WHERE u_id = ?";
//        $paramType = "sissi";
        $paramValue = array(
            $login,
            $email,
            $first_name,
            $last_name,
            $status,
            $id

        );
        
//        $this->db_handle->update($query, $paramType, $paramValue);
        $result = $this->db_handle->update($query, $paramValue);
        
        return $result;
    }
    
    function deleteUser($user_id) {
        $query = "DELETE FROM users WHERE u_id = ?";
        $paramValue = array(
            $user_id
        );
        $result = $this->db_handle->update($query, $paramValue);
        
        return $result;
    }
    
    function getUserById($student_id) {
        $query = "SELECT * FROM users WHERE u_id = ?";
        $paramValue = array(
            $student_id
        );
        
        $result = $this->db_handle->runQuery($query,  $paramValue);
        return $result;
    }
    
    function getUserByLogin($login) {
        $query = "SELECT * FROM users WHERE u_login = ?";
        $paramValue = array(
            $login
        );
        
        $result = $this->db_handle->runQuery($query,  $paramValue);
        return $result;
    }
    
    function getAllUser() {
        $sql = "SELECT * FROM users";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
    
    function getNextUserID() {
        $sql = "SELECT max(u_id) from users";

        $result = $this->db_handle->runBaseQuery($sql);
                
        return $result;
    }
}
?>