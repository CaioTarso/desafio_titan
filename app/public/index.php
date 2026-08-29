<?php   
    require_once '../config/database.php';
  
    $conexao = new Conexao();

    $db = $conexao->conectar();

    if ($db) {
        echo 'Conexão com o banco realizada com sucesso!';
    }
?>