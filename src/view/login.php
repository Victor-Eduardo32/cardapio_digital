<?php require '../../config.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <section class="login-container">
        <div class="apresentacao-login">
            <h2>Faça Login</h2>
            <h2>O melhor cardápio digital para você</h2>
            <img src="../../public/img/iconLogin.png" alt="">
        </div><!--apresetacao-login-->
        <div class="login">
            <h4>Login</h4>
            <form action="../controller/gestor/usuario/logar.php" method="post">
                <label for="usuario">Usuario</label>
                <input type="text" name="nome" placeholder="Digite seu usuário">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha">
                <input type="submit" value="Entrar">
            </form>

            
        </div><!--login-->
    </section><!--login-container-->
</body>
</html>