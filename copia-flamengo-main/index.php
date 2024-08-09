<?php
session_start();
include_once('conexao.php');

// Verifica se o usuário já está logado
if (isset($_SESSION['login'])) {
    // Se a ação de logout for solicitada
    if (isset($_GET['logout'])) {
        unset($_SESSION['login']);
        session_destroy();
        header('Location: login.php');
        exit();
    }
    // Inclui a página inicial se o usuário estiver logado
    include('home.php');
    exit();
}

// Processa o login se o formulário for enviado
if (isset($_POST['acao'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    // Usa consultas preparadas para evitar SQL Injection
    $verifica = "SELECT * FROM dados WHERE email= '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $verifica);

    if ($resultado->num_rows > 0) {
        $_SESSION['login'] = $email;
        header('Location: index.php');
        exit();
    } else {
        $error_message = "E-mail ou senha inválidos!";
    }
}

// Inclui a página de login se o usuário não estiver logado
include('login.php');
?>
