<?php
    // a ideia seria que essas variáveis viessem de um arquivo.env, mas por não poder usar composer, deixei as variáveis no código mesmo
    Class Conexao{
    private $host = "localhost"; 
    private $dbname = "jm_informatica";
    private $user = "root";
    private $pass = "root";
    


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