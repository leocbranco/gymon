<?php
session_start();
if (!isset($_SESSION['id_personal'])) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if (!isset($_GET['id']) || !isset($_GET['id_treino'])) {
    die('Parâmetros inválidos.');
}

$idExercicioTreino = $_GET['id'];
$idTreino = $_GET['id_treino'];

$sql = "DELETE FROM Exercicios_Treino WHERE ID_Exercicio_Treino = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idExercicioTreino);

if ($stmt->execute()) {
    header("Location: view_training.php?id=$idTreino");
    exit();
} else {
    echo "Erro ao excluir exercício.";
}
?>
