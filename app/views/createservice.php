<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/createservice.css">
    <title>Criar Serviço</title>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>

            <div class="error-message">
                <i class="material-icons">error</i>

                <span>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </span>
            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>
        <h1>Cadastrar Serviço</h1>
        
        <div class="info">
            
            <form action="/" method="POST">

                <input type="hidden" name="action" value="createservice">

                <div class="form-container">

                    <?php if (isset($error)): ?>
                        <p><?= $error ?></p>
                    <?php endif; ?>

                    <div class="form-group">

                        <label for="description">Descrição:</label>

                        <input
                            type="text"
                            id="description"
                            name="description"
                            placeholder="Descrição do serviço"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="price">Valor:</label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            placeholder="Insira o valor"
                            step="0.01"
                            required
                        >

                    </div>

                    <div class="bottom">

                        <button type="submit">
                            Cadastrar
                        </button>

                    </div>

                </div>

        </form>
    </div>
</body>
</html>


