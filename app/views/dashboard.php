<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>dashboard</title>
</head>
<body>
    <header>
        <div class="header-icon">
            <i class="material-icons">computer</i>
            <h1>JM Informática</h1>
        </div>
        <h3>Olá, <?= $_SESSION['user']['name'] ?>!</h3>
        <a href="/?page=logout">Sair</a>
    </header>

    <div class="container">

       <?php if (isset($_SESSION['success'])): ?>

            <div class="success-message">
                <i class="material-icons">check_circle</i>
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>

            <?php unset($_SESSION['success']); ?>

        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>

            <div class="error-message">
                <i class="material-icons">error</i>

                <span>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </span>
            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>



        <div class="dash-elements">
            <div class="dash-icon">
                <i class="material-icons">dashboard</i>
                <h2>Dashboard</h2>
            </div>

            <a class="button-create"  href="/?page=createservice">Criar serviço</a>


        </div>


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Usuário</th>
                  
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

        <tbody>

            <?php foreach ($services as $service): ?>

                <tr>
                    <td><?= $service['id_service'] ?></td>
                    <td><?= $service['description'] ?></td>
                    <td>R$ <?= number_format($service['price'], 2, ',', '.') ?></td>
                    <td><?= $service['name'] ?></td>

                    <td>
                        <?php if ($service['finished_at']): ?>
                            Finalizado
                        <?php else: ?>
                            Pendente
                        <?php endif; ?>
                    </td>

                    <td class="actions">

                                <a
                                    href="/?page=editservice&id=<?= $service['id_service'] ?>"
                                    title="Editar"
                                    class="action-button edit"
                                >
                                    <i class="material-icons">edit</i>
                                </a>

                                <form action="/" method="POST" class="delete-form">

                                    <input
                                        type="hidden"
                                        name="action"
                                        value="deleteservice"
                                    >

                                    <input
                                        type="hidden"
                                        name="id_service"
                                        value="<?= $service['id_service'] ?>"
                                    >

                                    <button type="submit" title="Excluir" class="action-button delete">
                                        <i class="material-icons">delete</i>
                                    </button>

                                </form>

                                <?php if (!$service['finished_at']): ?>

                                    <form action="/" method="POST" class="finish-form">
                                        <input type="hidden" name="action" value="finishservice">
                                        <input
                                            type="hidden"
                                            name="id_service"
                                            value="<?= $service['id_service'] ?>"
                                        >

                                        <button type="submit" title="Finalizar" class="action-button finish">
                                            <i class="material-icons">check_circle</i>
                                        </button>
                                    </form>

                                <?php endif; ?>

                            </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>