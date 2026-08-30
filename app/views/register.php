<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <h2>Sistema de Controle de Serviços</h2><br>
        <p>JM Informática</p>
    </div>

    <form action="/" method="POST">

        <input type="hidden" name="action" value="register">

        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="bottom ">
            <button type="submit">Cadastrar</button>
            <a href="/?page=login">Já tem uma conta? Entrar</a>
        </div>
       


</body>
</html>