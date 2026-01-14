<?php



include('conexao.php'); 
$funcionario_id = $_POST['funcionario_id'];
$ferramenta_id = $_POST['ferramenta_id'];
$data_retirada = date("Y-m-d H:i:s"); 

$sql = "UPDATE ferramentas 
        SET funcionario_id = '$funcionario_id', status = 'emprestada', data_retirada = '$data_retirada'
        WHERE id = '$ferramenta_id'";

if (mysqli_query($conect, $sql)) {
    header('Location: atribuir_ferramenta.php');
    exit();
} else {
    echo "Erro: " . mysqli_error($conect);
}

mysqli_close($conect);
?>
