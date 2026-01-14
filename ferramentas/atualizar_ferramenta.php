<?php
include('../conexao.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$sql = "UPDATE ferramentas 
        SET nome = '$nome', descricao = '$descricao'
        WHERE id = '$id'";

mysqli_query($conect, $sql);

header('Location: listar_ferramentas.php');
?>