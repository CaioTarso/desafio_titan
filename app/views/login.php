<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Sistema de Controle de Serviços</h2><br>
        <p>JM Informática</p>
    </div>

    <form action="/" method="POST">

        <input type="hidden" name="action" value="login">

        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="bottom ">
            <button type="submit">Entrar</button>
            <a href="/?page=register">Cadastrar usuário</a>
        </div>
       


</body>
</html>