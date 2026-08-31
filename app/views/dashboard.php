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
                    <td>R$ <?= $service['price'] ?></td>
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
                                >
                                    <i class="material-icons">edit</i>
                                </a>

                                <a
                                    href="/?page=deleteservice&id=<?= $service['id_service'] ?>"
                                    title="Excluir"
                                >
                                    <i class="material-icons">delete</i>
                                </a>

                                <?php if (!$service['finished_at']): ?>

                                    <a
                                        href="/?page=finishservice&id=<?= $service['id_service'] ?>"
                                        title="Finalizar"
                                    >
                                        <i class="material-icons">check_circle</i>
                                    </a>

                                <?php endif; ?>

                            </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>