<?php
include('conexao.php');

/* =========================
   1️⃣ DELETE FUNCIONÁRIO VIA POST
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_funcionario_id'])) {
    $id = intval($_POST['delete_funcionario_id']);

    if ($id > 0) {
        // Bloquear exclusão se o funcionário tiver alguma ferramenta atribuída
        $check_sql = "SELECT COUNT(*) as total FROM ferramentas WHERE funcionario_id = $id";
        $check_result = mysqli_query($conect, $check_sql);
        $row_check = mysqli_fetch_assoc($check_result);

        if ($row_check['total'] > 0) {
            die("Não é possível excluir um funcionário que possui ferramentas atribuídas.");
        }

        // DELETE
        mysqli_query($conect, "DELETE FROM funcionarios WHERE id = $id");

        // Redireciona para atualizar a lista
        header("Location: funcionario_lista.php");
        exit;
    }
}

/* =========================
   2️⃣ LISTAGEM
========================= */
$sql = "SELECT * FROM funcionarios";
$result = mysqli_query($conect, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conect));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
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
        a.btn-edit { background-color:#ffa500; color:white; padding:4px 8px; text-decoration:none; border-radius:4px; }
        a.btn-edit:hover { background-color:#ff8c00; }
    </style>
</head>
<body>

    <!-- Navegação -->
    <?php include('header.php'); ?>

    <div class="container">
        <h2>Lista de Funcionários</h2>
        <table>
            <tr>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Ação</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['cargo'] ?></td>
                <td>
                    <a href="editar_funcionario.php?id=<?= $row['id'] ?>" class="btn-edit">Editar</a>

                    <form method="POST" style="display:inline">
                        <input type="hidden" name="delete_funcionario_id" value="<?= $row['id'] ?>">
                        <button onclick="return confirm('Tem certeza que deseja deletar este funcionário?')">Deletar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
