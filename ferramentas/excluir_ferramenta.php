<?php
// ======================
// DELETE VIA POST
// ======================
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
        $sql = "DELETE FROM ferramentas WHERE id = $id";
        if (!mysqli_query($conect, $sql)) {
            die("Erro ao deletar ferramenta: " . mysqli_error($conect));
        }

        // Redireciona de volta para a lista
        header("Location: lista_ferramentas.php");
        exit;
    } else {
        die("ID inválido para exclusão.");
    }
}
?>
