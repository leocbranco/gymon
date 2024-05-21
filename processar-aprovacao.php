<?php
include_once('cfg.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_personal = $_POST['id_personal'];

    if (isset($_POST['aprovar'])) {
        // Atualizar o status do personal para aprovado (Status_Personal = 1)
        $stmt = $conex->prepare("UPDATE Personal SET Status_Personal = 1 WHERE ID_Personal = ?");
        $stmt->bind_param('i', $id_personal);
        $stmt->execute();
        $stmt->close();

        echo "Personal aprovado com sucesso!";
    } elseif (isset($_POST['negar'])) {
        // Atualizar o status do personal para negado (Status_Personal = 0)
        $stmt = $conex->prepare("UPDATE Personal SET Status_Personal = 0 WHERE ID_Personal = ?");
        $stmt->bind_param('i', $id_personal);
        $stmt->execute();
        $stmt->close();

        echo "Personal negado.";
    }
}

$conex->close();
?>
