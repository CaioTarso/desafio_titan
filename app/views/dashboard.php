<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <title>dashboard</title>
</head>
<body>
    <header>
        <h1>JM Informática</h1>
        <h3>Olá, <?= $_SESSION['user']['name'] ?>!</h3>
        <a href="/?page=logout">Sair</a>
    </header>

    <div class="container">
        <div class="dash-elements">
            <h2>Dashboard</h2>

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

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>