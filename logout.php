<?php
// Inicializa a sessão (se ainda não estiver iniciada)
session_start();

// Destroi todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona de volta para a página inicial ou qualquer outra página desejada
header("Location: home.php");
exit;
?>
