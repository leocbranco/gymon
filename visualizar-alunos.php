<?php

include_once('cfg.php');


$sql = "SELECT * FROM Aluno";
$result = $conex->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Alunos - GymON</title>
    <link rel="stylesheet" href="css/styleadm.css"> 
</head>
<body>
    <h1>Lista de Alunos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID_Aluno']; ?></td>
                <td><?php echo $row['Nome_Aluno']; ?></td>
                <td><?php echo $row['Email_Aluno']; ?></td>
                <td><?php echo $row['DataNasc_Aluno']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conex->close();
?>
