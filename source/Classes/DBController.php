<?php

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
        
        try {
            $conn = new PDO("pgsql:dbname=$this->database;host=$this->host;port=$this->port",$this->user,$this->password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $conn;
            
        } catch (\PDOException $e) {
            error_log("\n DB Connection FAILED ". print_r( $e->getMessage(), true ), 3, "/tmp/errors.log");
        }
    }
    
    function runBaseQuery($query) {
        $result = $this->conn->query($query);  

        while($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $resultset[] = $row;
        }
            
        return $resultset;
    }

    
    function runQuery($query,  $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql,  $param_value_array);
        $sql->execute();
        
        while($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $resultset[] = $row;
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    
    function bindQueryParams($sql, $param_value_array) {

        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_array[$i] = trim($param_value_array[$i]);
            $sql->bindParam( $i+1  , $param_value_array[$i]);
        }
        
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
        }
    }


    function update($query, $param_value_array) {
        
        try {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_value_array);
            return $sql->execute();
        } 
        catch (\PDOException $e) {
            error_log("\n Query update FAIL:  ".$query, 3, "/tmp/errors.log");
            error_log("\n Update FAIL Reason ". print_r( $e->getMessage(), true ), 3, "/tmp/errors.log");
        }
       
    }
}
?>