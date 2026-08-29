<?php
    Class Conexao{
    private $host = 'localhost';
    private $dbname = 'jm_informatica';
    private $user = 'root';
    private $pass = '123456';
    


    function conectar() {
        try{
            $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
            $this->user,
            $this->pass
            );
            return $conexao;
        }catch(PDOException $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
     }
    }
?>