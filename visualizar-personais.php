<?php

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Lista de Personais</h1>
    <div id="message"></div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="personal-<?php echo $row['ID_Personal']; ?>">
                <td><?php echo $row['ID_Personal']; ?></td>
                <td><?php echo $row['Nome_Personal']; ?></td>
                <td><?php echo $row['Email_Personal']; ?></td>
                <td class="status">
                    <?php echo $row['Status_Personal'] == 1 ? 'Aprovado' : ($row['Status_Personal'] == 0 ? 'Negado' : 'Em Avaliação'); ?>
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
    </script>
</body>
</html>
<?php
$conex->close();
?>
