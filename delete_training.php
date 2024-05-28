<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if (!isset($_GET['id']) || !isset($_GET['id_aluno'])) {
    die('Parâmetros inválidos.');
}

$treino_id = $_GET['id'];
$aluno_id = $_GET['id_aluno'];

$sql = "DELETE FROM Treinos WHERE ID_Treino = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $treino_id);

if ($stmt->execute()) {
    header("Location: list_trainings.php?id=$aluno_id");
    exit();
} else {
    echo "Erro ao excluir treino.";
}
?>
