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
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'menu-admin.php'; ?>
    <h1>Lista de Alunos</h1>
    <input type="text" id="searchInput" placeholder="Pesquisar por nome..." onkeyup="filterTable()">
    <div id="message"></div>
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
                <td class="aluno-name"><?php echo $row['Nome_Aluno']; ?></td>
                <td><?php echo $row['Email_Aluno']; ?></td>
                <td><?php echo $row['DataNasc_Aluno']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table tbody");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("aluno-name")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>

<?php
$conex->close();
?>
