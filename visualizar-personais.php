<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

$sql = "SELECT * FROM Personal";
$result = $conex->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Personais - GymON</title>
    <link rel="stylesheet" href="css/styleadm.css"> 
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'menu-admin.php'; ?>
    <h1>Lista de Personais</h1>
    <input type="text" id="searchInput" placeholder="Pesquisar por nome..." onkeyup="filterTable()">
    <div id="message"></div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>CREF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="personal-<?php echo $row['ID_Personal']; ?>">
                <td><?php echo $row['ID_Personal']; ?></td>
                <td class="personal-name"><?php echo $row['Nome_Personal']; ?></td>
                <td><?php echo $row['Email_Personal']; ?></td>
                <td class="status">
                    <?php echo $row['Status_Personal'] == 1 ? 'Aprovado' : ($row['Status_Personal'] == 0 ? 'Negado' : 'Em Avaliação'); ?>
                </td>
                <td>
                    <a href="<?php echo $row['CREF_Personal']; ?>" target="_blank">Ver CREF</a>
                </td>
                <td>
                    <button class="aprovar-btn" data-id="<?php echo $row['ID_Personal']; ?>">Aprovar</button>
                    <button class="negar-btn" data-id="<?php echo $row['ID_Personal']; ?>">Negar</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('.aprovar-btn').click(function() {
                var id_personal = $(this).data('id');
                $.post('processar-aprovacao.php', { id_personal: id_personal, aprovar: true }, function(response) {
                    $('#personal-' + id_personal + ' .status').text('Aprovado');
                    $('#message').text(response).fadeIn().delay(3000).fadeOut();
                });
            });

            $('.negar-btn').click(function() {
                var id_personal = $(this).data('id');
                $.post('processar-aprovacao.php', { id_personal: id_personal, negar: true }, function(response) {
                    $('#personal-' + id_personal + ' .status').text('Negado');
                    $('#message').text(response).fadeIn().delay(3000).fadeOut();
                });
            });
        });

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table tbody");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("personal-name")[0];
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
