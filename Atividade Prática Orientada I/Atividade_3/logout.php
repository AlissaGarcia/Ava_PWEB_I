<?php

session_start();

// Remove todos os dados da sessão
session_unset();

// Encerra a sessão
session_destroy();

// Retorna para a página de login
header("Location: index.php");

exit;

?>