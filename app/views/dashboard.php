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

        <div class="dash-user-infos">

            <div class="info-card">
              
                <div class="info-card-header">
                    <span class="material-icons">attach_money</span>
                    <h2 class="info-title">Total arrecadado por você</h2>
                </div>

                <div class="total-card">
                    R$ <?= number_format($totalMade, 2, ',', ',') ?>
                </div>
       
            </div>

            <div class="info-card">
              
                <div class="info-card-header">
                    <span class="material-icons">pending_actions</span>
                    <h2 class="info-title">Seus serviços pendentes</h2>
                </div>

                <div class="services-card">
                   <?php if (empty($pendingServices)): ?>

                        <p>Você não possui serviços pendentes.</p>

                        <?php else: ?>

                            <?php foreach ($pendingServices as $service): ?>

                                <div class="pending-service">
                                    <span>
                                    ID: <?= htmlspecialchars($service['id_service']) ?>
                                    </span>

                                    <span>
                                    Descrição:  <?= htmlspecialchars($service['description']) ?>
                                    </span>
                                </div>

                            <?php endforeach; ?>

                     <?php endif; ?>
                </div>
            </div>
        
        </div>
       
        <div class="filter-area"> 
            <div class="filter-icon">
                <i class="material-icons">filter_alt</i>
                <h2>Filtro</h2>

            </div>

            <div class="filters">
                
                <form action="/" method="GET">

                    <input type="hidden" name="page" value="dashboard">

                    <div class="filter-group">
                        <label for="description">Descrição</label>

                        <input
                            type="text"
                            id="description"
                            name="description"
                            value="<?= htmlspecialchars($_GET['description'] ?? '') ?>"
                            placeholder="Buscar serviço..."
                        >
                    </div>


                    <div class="filter-group">
                        <label for="start_date">Data de início</label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="<?= htmlspecialchars($_GET['start_date'] ?? '') ?>"
                        >
                    </div>

                    <div class="filter-group">
                        <label for="end_date">Data final</label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="<?= htmlspecialchars($_GET['end_date'] ?? '') ?>"
                        >
                    </div>

                    <div class="filter-group">
                        <label for="status">Status</label>

                        <select id="status" name="status">
                            <option value="">Todos</option>

                            <option
                                value="pending"
                                <?= ($_GET['status'] ?? '') === 'pending' ? 'selected' : '' ?>
                            >
                                Pendente
                            </option>

                            <option
                                value="finished"
                                <?= ($_GET['status'] ?? '') === 'finished' ? 'selected' : '' ?>
                            >
                                Finalizado
                            </option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="user_id">Usuário</label>

                        <select id="user_id" name="user_id">

                            <option value="">Todos</option>

                            <?php foreach ($users as $user): ?>

                                <option
                                    value="<?= $user['id_user'] ?>"
                                    <?= ($_GET['user_id'] ?? '') == $user['id_user'] ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($user['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="filter-actions">

                        <button type="submit">
                            Filtrar
                        </button>

                        <a href="/?page=dashboard">
                            Limpar
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Usuário</th>
                  
                    <th>Status</th>
                    <th class="actions-header">Ações</th>
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

                                <form action="/" method="POST" class="delete-form" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">

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

                                    <button type="submit" title="Excluir" class="action-button delete ">
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