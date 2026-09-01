<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/updateservice.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Editar Serviço</title>
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

        <h1>Editar Serviço</h1>

        <div class="info">

            <form action="/" method="POST">

                <input
                    type="hidden"
                    name="action"
                    value="updateservice"
                >

                <input
                    type="hidden"
                    name="id_service"
                    value="<?= $service['id_service'] ?>"
                >

                <div class="form-group">

                    <label for="description">
                        Descrição:
                    </label>

                    <input
                        type="text"
                        id="description"
                        name="description"
                        value="<?= htmlspecialchars($service['description']) ?>"
                        required
                    >

                </div>

                <div class="form-group">
                    <label for="price">
                        Valor:
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        id="price"
                        name="price"
                        value="<?= htmlspecialchars($service['price']) ?>"
                        required
                    >
                </div>

                <div class="buttons">

                    <button class="button-save" type="submit">
                        Salvar alterações
                    </button>

                    <a class="button-cancel" href="/?page=dashboard">
                        Cancelar
                    </a>

                </div>

            </div>

</body>

</html>