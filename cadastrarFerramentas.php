<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Ferramenta</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        /* Navegação */
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

        /* Formulário */
        .container {
            width: 50%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .container label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }

        .container input[type="text"],
        .container input[type="date"],
        .container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegação -->
     <?php
    include('header.php');
    ?>

    <!-- Conteúdo principal -->
    <div class="container">
        <h1>Cadastro de Ferramenta</h1>
        <form action="processaFerramentas.php" method="post">
            <label for="nome">Nome da Ferramenta:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="disponível">Disponível</option>
                <option value="emprestada">Emprestada</option>
                <option value="manutenção">Manutenção</option>
            </select>

            <label for="data_aquisicao">Data de Aquisição:</label>
            <input type="date" name="data_aquisicao" id="data_aquisicao" required>

            <input type="submit" value="Cadastrar Ferramenta">
        </form>
    </div>
</body>
</html>
