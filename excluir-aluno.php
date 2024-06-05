<?php
include_once('cfg.php');

$id = $_GET['ID_Aluno'];

// Excluir registros relacionados na tabela 'treinos'
$sqlDeleteTreinos = "DELETE FROM treinos WHERE ID_Aluno = ?";
$stmtTreinos = $conex->prepare($sqlDeleteTreinos);
$stmtTreinos->bind_param("i", $id);
$stmtTreinos->execute();

// Excluir o aluno
$sqlDeleteAluno = "DELETE FROM aluno WHERE ID_Aluno = ?";
$stmtAluno = $conex->prepare($sqlDeleteAluno);
$stmtAluno->bind_param("i", $id);
$resultDeleteAluno = $stmtAluno->execute();

if ($resultDeleteAluno) {
    header('Location: home.php');
    exit;
} else {
    echo "Erro ao excluir usuário.";
}
?>
