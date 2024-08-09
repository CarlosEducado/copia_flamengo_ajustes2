<?php
session_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="src/css/comentarios.css">
    <title>Nação - Comentarios</title>
</head>

<body>
    <!-- <p class='msg'>Por favor, preencha tudo</p> -->
    <!-- <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?> -->
    <header>
        <div class="logo-mobile">
            <a href="index.php"><img src="src/img/logo-crf.png" alt="Logo CRF" class="logo-mobile"></a>
        </div>
        <div class="titulo">
            <a href="index.php">
                <h1>Feed do Urubu</h1>
            </a>
        </div>
        <div class="icone-perfil">
            <?php

            
                echo "<h3 class='nome-comentario'>" .$_SESSION['login']. "</h3>";
            ?>
            <i class="bi bi-person-circle"></i>
        </div>
    </header>

    <main>
        <section class="sessao-comentario">
            <form action="processa_comentario.php" method="post">
                <div class="box-comentario">
                    <textarea type="text" name="comentario" id="" placeholder="Deixe seu comentario...">

                    </textarea>
                    <!-- <input type="text" name="" id="" placeholder="Deixe seu comentario..."> -->
                </div>

                <!-- <div class="email-comentario">
                    <input type="email" name="emailcoment" id="" placeholder="Seu email ">
                </div> -->

                <button class="btn-comentario" type="submit">Comentar</button>
            </form>

            <?php
            if (isset($_GET['delete'])) {
                $id = (int)$_GET['delete'];
                if ($id > 0) {

                    $delete = "DELETE FROM comentarios WHERE id = $id";
                    if (mysqli_query($conexao, $delete) === true) {
                        header("Location: comentarios.php");
                        exit;
                    }
                }
            }
            // Consulta para selecionar os usuários com limite para paginação
            $select_user = "SELECT c.id , d.nome, c.comentario, c.created, c.email  FROM dados d LEFT JOIN comentarios c ON d.id = c.dados_id ORDER BY c.created DESC";
            $selected_user = mysqli_query($conexao, $select_user);
            // Loop para exibir os usuários da página atual
            while ($row_user = mysqli_fetch_assoc($selected_user)) {
                if (!empty($row_user['comentario'])) {
                    $comentario_id = $row_user['id'];
                    $comentario_texto = htmlspecialchars($row_user['comentario']);
                    $nome = htmlspecialchars($row_user['nome']);
                    $data = date('d/m/Y H:i', strtotime($row_user['created']));

                    echo "<div id='comentario-$comentario_id' class='comentario-container'>";
                    echo "    <div class='comentario' id='comentario-text-$comentario_id'>";
                    echo "        <div class='top-comentario'>";
                    echo "            <h3 class='nome-comentario'>$nome</h3>";
                    echo "            <p class='data-comentario'>$data</p>";
                    echo "        </div>";
                    echo "        <h4 class='texto-comentario'>$comentario_texto</h4>";

                    if ($_SESSION['login'] == $row_user['email']) {
                        echo "    <div class='btn-acao'>";
                        echo "        <a href='#' class='btn-editar' onclick='editarComentario($comentario_id)'>";
                        echo "            <i class='bi bi-pen'></i>";
                        echo "        </a>";
                        echo "        <a href='?delete=$comentario_id' class='btn-excluir'>";
                        echo "            <i class='bi bi-trash-fill'></i>";
                        echo "        </a>";
                        echo "    </div>";
                    }

                    echo "    </div>";

                    // Formulário de edição (inicialmente escondido)
                    echo "    <div id='edit-form-$comentario_id' class='edit-form' style='display: none;'>";
                    echo "        <form action='update_comentario.php' method='POST'>";
                    echo "            <input type='hidden' name='id' value='$comentario_id'>";
                    echo "            <textarea class='comentario' name='comentario' required>$comentario_texto</textarea>";
                    echo "            <div class='btn-acao-edit'>";
                    echo "                <button class='btn-editar2' type='submit'>Salvar</button>";
                    echo "                <button class='btn-editar2' type='button' onclick='cancelarEdicao($comentario_id)'>Cancelar</button>";
                    echo "            </div>";
                    echo "        </form>";
                    echo "    </div>";

                    echo "    <hr>";
                    echo "</div>";
                }
            }

            ?>
        </section>
    </main>

    <script src="src/js/script.js" defer></script>
</body>

</html>