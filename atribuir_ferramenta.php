<?php
include('conexao.php');

$sql_func = "SELECT id, nome FROM funcionarios";
$result_func = mysqli_query($conect, $sql_func);

$sql_ferr = "SELECT id, nome,descricao FROM ferramentas WHERE status = 'disponivel'";
$result_ferr = mysqli_query($conect, $sql_ferr);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribuição de Ferramenta</title>
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
            width: 50%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            display: block;
            margin-top: 15px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

     <?php
    include('header.php');
    ?>

    <!-- Conteúdo principal -->
    <div class="container">
        <h2>Atribuição de Ferramenta</h2>
        <form action="processaAtribuicao.php" method="post">
            <label for="funcionario">Funcionário:</label>
            <select name="funcionario_id" required>
                <option value="">-- Selecione o Funcionário --</option>
                <?php while($func = mysqli_fetch_assoc($result_func)): ?>
                    <option value="<?= $func['id'] ?>"><?= $func['nome'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="ferramenta">Ferramenta:</label>
            <select name="ferramenta_id" required>
                <option value="">-- Selecione a Ferramenta --</option>
                <?php while($ferr = mysqli_fetch_assoc($result_ferr)): ?>
                    <option value="<?= $ferr['id'] ?>">
                      <?= $ferr['nome'] ?> - <?= $ferr['descricao'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Atribuir Ferramenta">
        </form>
    </div>
</body>
</html>
