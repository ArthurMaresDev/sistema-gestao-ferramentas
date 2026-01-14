<?php
 

include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ferramenta_id'])) {
    $ferramenta_id = $_POST['ferramenta_id'];
    $data_devolucao = date("Y-m-d H:i:s");

    
    $sql_select = "SELECT funcionario_id, data_retirada FROM ferramentas WHERE id = '$ferramenta_id'";
    $result = mysqli_query($conect, $sql_select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $funcionario_id = $row['funcionario_id'];
        $data_retirada = $row['data_retirada'] ?? date("Y-m-d H:i:s");


        
        $sql_historico = "INSERT INTO historico (ferramenta_id, funcionario_id, data_retirada, data_devolucao, status)
                          VALUES ('$ferramenta_id', '$funcionario_id', '$data_retirada', '$data_devolucao', 'devolvida')";

        if (mysqli_query($conect, $sql_historico)) {
            
            $sql_update = "UPDATE ferramentas 
                           SET status = 'disponível', funcionario_id = NULL, data_retirada = NULL 
                           WHERE id = '$ferramenta_id'";

            if (mysqli_query($conect, $sql_update)) {
                header('Location: lista_ferramentas.php');
                exit();
            } else {
                echo "Erro ao atualizar a ferramenta: " . mysqli_error($conect);
            }
        } else {
            echo "Erro ao registrar no histórico: " . mysqli_error($conect);
        }

    } else {
        echo "Ferramenta não encontrada ou sem vínculo com funcionário.";
    }

} else {
    echo "Requisição inválida.";
}

mysqli_close($conect);
?>
