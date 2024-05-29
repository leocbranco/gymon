<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

$id_personal = $_SESSION['id'];
$sql_status = "SELECT Status_Personal FROM Personal WHERE ID_Personal = ?";
$stmt = $conex->prepare($sql_status);
$stmt->bind_param('i', $id_personal);
$stmt->execute();
$stmt->bind_result($status_personal);
$stmt->fetch();
$stmt->close();

if ($status_personal == 0) {
    // Redireciona para uma página de acesso negado ou mostra uma mensagem de erro
    header('Location: acesso-negado.php');
    exit();
}

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM Aluno WHERE Nome_Aluno LIKE ?";
    $stmt = $conex->prepare($sql);
    $search_param = '%' . $search . '%';
    $stmt->bind_param('s', $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $sql = "SELECT * FROM Aluno";
    $result = $conex->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        body {
            background-color: #1C1C1C;
            color: white;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background 0.2s linear, color 0.2s linear;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #2C2C2C;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: background 0.2s linear, color 0.2s linear;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #329834;
            font-size: 24px;
            transition: color 0.2s linear;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #329834;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            transition: background 0.2s linear, color 0.2s linear;
        }
        th {
            background-color: #329834;
            color: #fff;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #3E3E3E;
        }
        tr:nth-child(odd) {
            background-color: #2C2C2C;
        }
        tr:hover {
            background-color: #575757;
        }
        .button {
            background-color: #329834;
            color: white;
            padding: 2px 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 14px;
            margin-right: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Alunos Cadastrados</h1>
        <form method="get" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Pesquisar aluno pelo nome">
            <input type="submit" value="Pesquisar">
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Objetivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['ID_Aluno']; ?></td>
                    <td><?php echo $row['Nome_Aluno']; ?></td>
                    <td><?php echo $row['Email_Aluno']; ?></td>
                    <td><?php echo $row['DataNasc_Aluno']; ?></td>
                    <td><?php echo $row['Objetivo_Aluno']; ?></td>
                    <td>
                        <a href="send_training.php?id=<?php echo $row['ID_Aluno']; ?>" class="button">Enviar Treino</a>
                        <a href="list_trainings.php?id=<?php echo $row['ID_Aluno']; ?>" class="button">Ver Treinos</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php require 'menu.php'; ?>
    <script src="modoescuro/modo-escuro.js"></script>
</body>
</html>
