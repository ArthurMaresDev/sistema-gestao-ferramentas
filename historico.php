<?php
include('conexao.php');

$busca = $_GET['busca'] ?? '';

$sql = "SELECT 
            h.data_retirada,
            h.data_devolucao,
            h.status,
            f.nome AS nome_ferramenta,
            func.nome AS nome_funcionario,
            func.cargo
        FROM historico h
        JOIN ferramentas f ON h.ferramenta_id = f.id
        JOIN funcionarios func ON h.funcionario_id = func.id
        WHERE func.nome LIKE '%$busca%'
        ORDER BY h.data_retirada DESC";

$result = mysqli_query($conect, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Movimentações</title>
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

        h2 {
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

        .busca-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .busca-print form input[type="text"] {
            padding: 5px;
        }

        .busca-print input[type="submit"], .busca-print button {
            padding: 6px 12px;
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Menu de navegação -->
     <?php
    include('header.php');
    ?>

    <div class="container">
        <h2>Histórico de Movimentações</h2>

        <div class="busca-print">
            <form method="GET">
                <label>Buscar por funcionário:</label>
                <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>">
                <input type="submit" value="Buscar">
            </form>
            <button onclick="window.print()">Imprimir</button>
        </div>

        <table>
            <tr>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Ferramenta</th>
                <th>Data de Retirada</th>
                <th>Data de Devolução</th>
                <th>Status</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['nome_funcionario'] ?></td>
                <td><?= $row['cargo'] ?></td>
                <td><?= $row['nome_ferramenta'] ?></td>
                <td><?= $row['data_retirada'] ?></td>
                <td><?= $row['data_devolucao'] ?? '---' ?></td>
                <td><?= ucfirst($row['status']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
