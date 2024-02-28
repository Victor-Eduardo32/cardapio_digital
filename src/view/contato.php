<?php require '../../config.php' ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/contato.css">
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <title>BBQ - Contato</title>
</head>
<body>
    <header>
        <div class="apresentacao-estabelecimento">
            <div class="logo"><a href="#"><img src="../../public/img/BBQLogo.png" alt="BBQ_Logo"></a></div>
            <div>
                <h1>BBQ</h1>
                <h3>A melhor hambúrgueria da cidade</h3>
            </div>
        </div>

        <nav class="desktop">
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="./contato.php">Contato</a></li>
                <li><a href="./pedidos-cliente.php">Pedidos</a></li>
            </ul>
        </nav><!--navegação desktop-->
    </header>

    <section class="contato-container">
            <div class="background-container"></div>
            <div class="overlay-contato"></div>
            <form class="contato">
                <input type="text" name="nome" id="" placeholder="Nome">
                <input type="text" name="email" id="" placeholder="E-mail">
                <input type="text" name="telefone" id="" placeholder="Telefone">
                <textarea name="mensagem" id="" placeholder="Sua mensagem..." rows="4"></textarea>
                <input type="submit" value="Enviar">
            </form>
    </section><!--contato-container-->

    <footer>
        <p>BBQ - Todos os direitos reservados</p>
    </footer>
</body>
</html>