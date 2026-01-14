<?php
include('../conexao.php');

$id = $_GET['id'];
$sql = "SELECT * FROM ferramentas WHERE id = '$id'";
$result = mysqli_query($conect, $sql);
$ferramenta = mysqli_fetch_assoc($result);
?>

<form action="atualizar_ferramenta.php" method="POST">
    <input type="hidden" name="id" value="<?= $ferramenta['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome" value="<?= $ferramenta['nome'] ?>" required>

    <label>Descrição</label>
    <input type="text" name="descricao" value="<?= $ferramenta['descricao'] ?>">

    <button type="submit">Salvar</button>
</form>