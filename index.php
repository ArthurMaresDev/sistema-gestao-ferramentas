<?php
include('conexao.php');

$sql = "SELECT 
            f.nome AS nome_ferramenta,
            f.descricao,
            f.data_retirada,
            func.nome AS nome_funcionario,
            func.cargo
        FROM ferramentas f
        JOIN funcionarios func ON f.funcionario_id = func.id
        WHERE f.status = 'emprestada'
        ORDER BY f.data_retirada DESC";

$result = mysqli_query($conect, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão de Ferramentas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <!-- Menu de navegação -->
    <?php
    include('header.php');
    ?>

    <div class="container">
        <h1>Painel Central</h1>
        <h2>Ferramentas Emprestadas no Momento</h2>

        <table>
            <tr>
                <th>Ferramenta</th>
                <th>Descrição</th>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Data/Hora da Retirada</th>
            </tr>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['nome_ferramenta'] ?></td>
                    <td><?= $row['descricao'] ?></td>
                    <td><?= $row['nome_funcionario'] ?></td>
                    <td><?= $row['cargo'] ?></td>
                    <td><?= $row['data_retirada'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhuma ferramenta emprestada no momento.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
