<?php
include('conexao.php');

/* =========================
   1️⃣ DELETE VIA POST
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ferramenta_id'])) {
    $id = intval($_POST['delete_ferramenta_id']);

    if ($id > 0) {
        // Bloquear exclusão se ferramenta estiver emprestada
        $check_sql = "SELECT status FROM ferramentas WHERE id = $id";
        $check_result = mysqli_query($conect, $check_sql);
        $row = mysqli_fetch_assoc($check_result);

        if ($row && $row['status'] === 'emprestada') {
            die("Não é possível excluir uma ferramenta que está emprestada.");
        }

        // DELETE
        mysqli_query($conect, "DELETE FROM ferramentas WHERE id = $id");

        // Redireciona para atualizar a lista
        header("Location: lista_ferramentas.php");
        exit;
    }
}

/* =========================
   2️⃣ EDITAR VIA POST
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_ferramenta'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome_ferramenta'];
    $descricao = $_POST['descricao'];

    $sql_update = "UPDATE ferramentas 
                   SET nome = '$nome', descricao = '$descricao'
                   WHERE id = '$id'";

    if (!mysqli_query($conect, $sql_update)) {
        die("Erro ao atualizar: " . mysqli_error($conect));
    }

    header('Location: lista_ferramentas.php');
    exit;
}

/* =========================
   3️⃣ ID EM EDIÇÃO
========================= */
$edit_id = $_GET['edit'] ?? null;

/* =========================
   4️⃣ LISTAGEM
========================= */
$sql = "SELECT 
            f.id,
            f.nome AS nome_ferramenta,
            f.status,
            f.descricao,
            f.data_retirada,
            func.nome AS nome_funcionario,
            func.cargo
        FROM ferramentas f
        LEFT JOIN funcionarios func ON f.funcionario_id = func.id";

$result = mysqli_query($conect, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conect));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ferramentas Cadastradas</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin:0; padding:0; }
        nav { background-color: #333; padding: 10px; text-align:center; }
        nav a { color:white; text-decoration:none; margin:0 15px; font-size:18px; }
        nav a:hover { text-decoration: underline; }
        h2 { text-align:center; margin-top:20px; color:#333; }
        .container { width:90%; margin:20px auto; background:white; padding:20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);}
        table { border-collapse: collapse; width:100%; margin-top:15px;}
        th, td { border:1px solid #ccc; padding:10px; text-align:left; }
        th { background-color:#eee; }
        button { background-color:#f44336; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
        button:hover { background-color:#d32f2f; }
        input[type="text"] { width: 90%; padding:4px; }
        a.btn-edit { background-color:#ffa500; color:white; padding:4px 8px; text-decoration:none; border-radius:4px; }
        a.btn-edit:hover { background-color:#ff8c00; }
    </style>
</head>
<body>

    <!-- Navegação -->
    <?php include('header.php'); ?>

    <div class="container">
        <h2>Ferramentas Cadastradas</h2>
        <table>
            <tr>
                <th>Ferramenta</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Data/Hora da Retirada</th>
                <th>Editar/Deletar</th>
                <th>Ação</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>

                <?php if ($edit_id == $row['id']): ?>
                <!-- MODO EDIÇÃO -->
                <form method="POST">
                    <td><input type="text" name="nome_ferramenta" value="<?= $row['nome_ferramenta'] ?>" required></td>
                    <td><input type="text" name="descricao" value="<?= $row['descricao'] ?>"></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['nome_funcionario'] ?? '---' ?></td>
                    <td><?= $row['cargo'] ?? '---' ?></td>
                    <td><?= $row['data_retirada'] ?? '---' ?></td>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="editar_ferramenta">Salvar</button>
                        <a href="lista_ferramentas.php">Cancelar</a>
                    </td>
                </form>

                <?php else: ?>
                <!-- MODO VISUALIZAÇÃO -->
                <td><?= $row['nome_ferramenta'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['nome_funcionario'] ?? '---' ?></td>
                <td><?= $row['cargo'] ?? '---' ?></td>
                <td><?= $row['data_retirada'] ?? '---' ?></td>
                <td>
                    <a href="lista_ferramentas.php?edit=<?= $row['id'] ?>" class="btn-edit">Editar</a>

                    <form method="POST" style="display:inline">
                        <input type="hidden" name="delete_ferramenta_id" value="<?= $row['id'] ?>">
                        <button onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </td>
                <td>
                    <?php if ($row['status'] === 'emprestada'): ?>
                        <form action="processa_devolucao.php" method="POST">
                            <input type="hidden" name="ferramenta_id" value="<?= $row['id'] ?>">
                            <button>Devolver</button>
                        </form>
                    <?php else: ?>
                        ---
                    <?php endif; ?>
                </td>
                <?php endif; ?>

            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
