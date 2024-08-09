<?php
session_start();
require 'conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $comentario = $_POST['comentario'];

    // Validação básica
    if (!empty($id) && !empty($comentario)) {
        $stmt = $conexao->prepare("UPDATE comentarios SET comentario = ?, created = NOW()  WHERE id = ?");
        $stmt->bind_param('si', $comentario, $id);
       

        if ($stmt->execute()) {
            header('Location: comentarios.php');
            exit();
        } else {
            echo "Erro ao atualizar o comentário.";
        }
    }
}
?>
