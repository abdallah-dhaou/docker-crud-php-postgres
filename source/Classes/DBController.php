<?php

//echo "<br> from dbcontroller";
class DBController {
    private $host = "db";
    private $user = "abdou";
    private $password = "mypassword";
    private $database = "mydb";
    private $port = "5432";
    private $conn;
    
    function __construct() {
        $this->conn = $this->connectDB();
    }   
    
    function connectDB() {
//        $conn = new PDO("pgsql:dbname=$this->database;host=$this->host;port=$this->port",$this->user,$this->password);
//        //$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//        return $conn;
        
        
        try {
            $conn = new PDO("pgsql:dbname=$this->database;host=$this->host;port=$this->port",$this->user,$this->password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//            $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
//            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//            echo 'A connection to the PostgreSQL database sever established.';

            return $conn;
            
        } catch (\PDOException $e) {
//            echo 'A connection to the PostgreSQL database sever has FAILED.';
//            echo $e->getMessage();
            error_log("\n DB Connection FAILED ". print_r( $e->getMessage(), true ), 3, "/tmp/errors.log");
        }
    }
    
    function runBaseQuery($query) {
        $result = $this->conn->query($query);  
        
//        var_dump($result->fetch(\PDO::FETCH_ASSOC));
//        if ($result->fetch(\PDO::FETCH_ASSOC)) {
            while($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $resultset[] = $row;
            }
            
//            echo '------'.count($resultset).'-------';
//        }
        return $resultset;
    }
    
    
    
//    function runQuery($query, $param_type, $param_value_array) {
//        $sql = $this->conn->prepare($query);
//        $this->bindQueryParams($sql, $param_type, $param_value_array);
//        $sql->execute();
//        $result = $sql->get_result();
//        
//        if ($result->num_rows > 0) {
//            while($row = $result->fetch_assoc()) {
//                $resultset[] = $row;
//            }
//        }
//        
//        if(!empty($resultset)) {
//            return $resultset;
//        }
//    }
    
    function runQuery($query,  $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql,  $param_value_array);
        $sql->execute();
//        $result = $sql->get_result();
        
//        if ($result->num_rows > 0) {
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                $resultset[] = $row;
            }
//        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    
    function bindQueryParams($sql, $param_value_array) {
//        error_reporting(1);
//        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
//            $param_value_reference[] = & $param_value_array[$i];
//            echo 'i: '.$i .' with val: '.$param_value_array[$i];
            $param_value_array[$i] = trim($param_value_array[$i]);
//            $param_value_array[$i] = pg_escape_string($param_value_array[$i]);
            $sql->bindParam( $i+1  , $param_value_array[$i]);
//            echo "test";
        }

        
        
//        try {
//            // bloc try
//        } 
//        catch (\PDOException $e) {
////            echo 'A connection to the PostgreSQL database sever has FAILED.';
////            echo $e->getMessage();
//        }
        
    }
    

    
    function insert($query, $param_value_array) {
        
        try
        {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_value_array);

            return $sql->execute();
        
        } 
        catch (\PDOException $e) {
            error_log("\n Query insert FAIL:  ".$query, 3, "/tmp/errors.log");
            error_log("\n Insert FAIL Reason ". print_r( $e->getMessage(), true ), 3, "/tmp/errors.log");
//            echo $e->getMessage();
        }
    }
    
//    function update($query, $param_type, $param_value_array) {
//        $sql = $this->conn->prepare($query);
//        $this->bindQueryParams($sql, $param_type, $param_value_array);
//        $sql->execute();
//    }
    
    function update($query, $param_value_array) {
        
        try {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_value_array);
            return $sql->execute();
        } 
        catch (\PDOException $e) {
            error_log("\n Query update FAIL:  ".$query, 3, "/tmp/errors.log");
            error_log("\n Update FAIL Reason ". print_r( $e->getMessage(), true ), 3, "/tmp/errors.log");
//            echo $e->getMessage();
        }
        
        
        
//        $sql = $this->conn->prepare($query);
//        $this->bindQueryParams($sql, $param_value_array);
//        return $sql->execute();
    }
}
?>