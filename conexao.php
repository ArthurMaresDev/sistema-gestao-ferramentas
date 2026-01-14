<?php
  date_default_timezone_set('America/Sao_Paulo');
  $servidor = "localhost";
  $usuario = "root";
  $senha = "";
  $banco = "estoque";
  
  
  $conect = mysqli_connect($servidor,$usuario,$senha,$banco);
  
    if(!$conect){
        die("Conexao falhou:". mysqli_error());
    }
       
?>