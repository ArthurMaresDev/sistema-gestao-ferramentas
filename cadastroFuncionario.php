<?php
include('conexao.php');

$nome = trim($_POST['nome'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');

// Verifica se algum campo está vazio
if ($nome === '' || $cargo === '') {
    echo "Erro: Nome e Cargo são obrigatórios!";
    exit;
}

$sql = "INSERT INTO funcionarios (nome, cargo) VALUES ('$nome', '$cargo')";

if (mysqli_query($conect, $sql)) {
    header('Location: cadastroFuncionario.html');
    exit();
} else {
    echo "Erro ao cadastrar: " . mysqli_error($conect);
}

mysqli_close($conect);
?>
