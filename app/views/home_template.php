<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/styles/style2.css">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
</head>

<body>
    <header>
        <div></div>
        <h2 id="adote">Adot</h2>
        <nav id="nav_menu">
            <a href="?pagina=home">Início</a>
            <a href="?pagina=sobre">Sobre</a>
            <a href="?pagina=adocao">Adoção</a>
            <a href="?pagina=contato">Contato</a>
            <?php if (isset($_SESSION['usuario'])): ?>
            <a href="?pagina=tutor">ADM</a>
            <a href="?pagina=auth&action=logout">Sair</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <?php include $viewPath; ?>
    </main>
    <footer>
        <p>Desenvolvido por Gabriel Sena. 2025</p>
    </footer>
</body>

</html>