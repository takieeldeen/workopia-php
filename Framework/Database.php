<?php

    namespace Framework;
    use PDO;
    class Database {
        public $conn;

        public function __construct($config)
        {
            $dsn = "mysql:{$config['host']};port={$config['port']};dbname={$config['dbname']}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            try{
                $this->conn = new PDO($dsn,$config['username'],$config['password'],$options);
                
            } catch (PDOException $e) {
                throw new Exception("Connection to database failed: {$e->getMessage()}");
            }
        }

        public function query($query,$params= []) {
            try{
                $stmt = $this->conn->prepare($query);
                foreach($params as $param=>$value){
                    $stmt->bindValue(':'.$param,$value);
                }
                $stmt->execute();
                return $stmt;
            }catch (PDOException $e){
                throw new Exception("An Error occured while querying : {$e->getMessage()}");
            }
        }
    };