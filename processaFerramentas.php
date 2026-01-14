<?php

 include('conexao.php');
 $nome = $_POST['nome'];
 $descricao=$_POST['descricao'];
 $status=$_POST['status'];

 $sql ="INSERT INTO ferramentas(nome,descricao,status) VALUES ('$nome','$descricao','$status')";

 if(mysqli_query($conect,$sql)){
   header('Location: cadastrarFerramentas.php');
    exit();
 } else{
    echo "Erro: ".mysqli_error($conect);
 }
 mysqli_close($conect);


?>