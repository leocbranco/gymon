<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login-aluno.php');
    exit();
}

function verificaAluno($conex, $idAluno) {
    if ($idAluno != $_SESSION['id']) {
        header('Location: naoautorizado.php');
    }
}

function verificaTreinoAluno($conex, $idTreino, $idAluno) {
    $sql = "SELECT ID_Treino FROM Treinos WHERE ID_Treino = ? AND ID_Aluno = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("ii", $idTreino, $idAluno);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>
