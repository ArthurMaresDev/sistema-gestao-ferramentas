<?php
require("conexao.php");

$id = intval($_GET['id']);
$sql = "DELETE FROM funcionarios WHERE id = $id";

if ($conect ->query($sql)=== TRUE){
    header("location:funcionario_lista.php");
    exit;
}else {
    echo "Erro ao deletar:". $conect->error;
}





?>