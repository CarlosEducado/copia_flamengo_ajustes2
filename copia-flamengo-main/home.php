<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link rel="stylesheet" href="src/css/home.css">

    <title>Nação - Home</title>
</head>

<body>

    <header>
        <div class="logo-mobile">
            <a href="#"><img src="src/img/logo-crf.png" alt="Logo CRF" class="logo-mobile"></a>
        </div>
        <div class="titulo">
            <a href="#">
                <h1>Feed do Urubu</h1>
            </a>
        </div>

        <div class="menu-desktop">
            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="comentarios.php">Comentarios</a> </li>
                    </ul>
                </nav>
            </div>
            <?php
            echo '<a style=color:blue href="?logout=true">Sair</a>';
            ?>
            <div class="icone-perfil">
                
                <i class="bi bi-person-circle"></i>
            </div>
        </div>
    </header>
    
    <main>

    </main>
    <script src="src/js/script.js" defer></script>
</body>

</html>