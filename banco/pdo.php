<?php
class usePDO {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "banco_ar";
    private $instance;

    function getInstance(){
        if(empty($instance)){
            $instance = $this->connection();
        }
        return $instance;
    }

    private function connection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection Failed: " . $e->getMessage() . "<br>";
        }
    }

    function createDB(){
        try {
            $cnx = $this->getInstance();
            if($cnx === NULL){          
                $cnx = new PDO("mysql:host=$this->servername",$this->username,$this->password);                
                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $cnx->exec($sql);
        }
        catch (PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function createTableProdutos(){
        try {
            $cnx = $this->getInstance();
            $sql = "CREATE TABLE IF NOT EXISTS produto (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100) NOT NULL,
                descricao VARCHAR(100) NOT NULL,
                codigo VARCHAR(100) NOT NULL,
				fabricante VARCHAR(100) NOT NULL,
				validade VARCHAR(50))";				
            
            $cnx->exec($sql);
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function createTableUsuarios(){
        try {
            $cnx = $this->getInstance();
            $sql = "CREATE TABLE IF NOT EXISTS usuario (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(50) NOT NULL,
                senha VARCHAR(100) NOT NULL)";			

            $cnx->exec($sql);
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function insert($sql){
        try {
            $cnx = $this->getInstance();
            $error = $cnx->prepare($sql);
            $error->execute();
            echo "Error Ocurred: " .implode(":", $error->errorInfo());
            if($error->errorCode() == 0){
                return;
            }
            else{
                return "Falha ao inserir dados no banco";
            }
        }
        catch(PDOException $e){
            return "Falha ao inserir dados";
        }
    }

    function sql($sql){
        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);
            return $result;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}