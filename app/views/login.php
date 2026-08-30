<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Sistema de Controle de Serviços</h1>
        <h2>JM Informática</h2>
        
        <div class="info">
            
            <form action="/" method="POST">
            <div class="form-container">
                
            <input type="hidden" name="action" value="login">

            <?php if (isset($error)): ?>
                <p><?= $error ?></p>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>
            
            <div class="bottom ">
                <button type="submit">Entrar</button>
                <a href="/?page=register">Cadastrar usuário</a>
            </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>