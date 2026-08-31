<?php

session_start();

require_once '../config/database.php';


require_once '../repositories/UserRepository.php';
require_once '../repositories/ServiceRepository.php';



require_once '../controllers/AuthController.php';
require_once '../controllers/ServiceController.php';

$conexao = new Conexao();
$db = $conexao->conectar();

$userRepository = new UserRepository($db);
$authController = new AuthController($userRepository);

$serviceRepository = new ServiceRepository($db);
$serviceController = new ServiceController($serviceRepository);




$page = $_GET['page'] ?? 'login';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
         
        $user = $authController->login(
            $_POST['email'],
            $_POST['password']
        );

        if ($user) {
            $_SESSION['user'] = $user;


            header('Location: /?page=dashboard');
            exit;

        } 
            $error = "Email ou senha inválidos.";
        
    }

    if ($action === 'register') {
        
         $user = $authController->register(
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );

        if ($user) {
        
            header('Location: /?page=login');
            exit;

        } 
            $error = "Email já cadastrado.";
            $page = 'register';
        
    }

    if ($action === 'createservice') {

    if (!isset($_SESSION['user'])) {
        header('Location: /?page=login');
        exit;
    }

        $description = $_POST['description'];
        $price = $_POST['price'];

        $user_id_user = $_SESSION['user']['id_user'];

        $created = $serviceController->createService(
            $description,
            $price,
            $user_id_user
        );

        if ($created) {
        $_SESSION['success'] = "Serviço cadastrado com sucesso!";

        header('Location: /?page=dashboard');
        exit;
    }

        $_SESSION['error'] = "Não foi possível cadastrar o serviço.";

        header('Location: /?page=createservice');
        exit;
    }

    if ($action === 'updateservice') {

    if (!isset($_SESSION['user'])) {
        header('Location: /?page=login');
        exit;
    }

    $service_id = $_POST['id_service'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $updated = $serviceController->updateService(
        $service_id,
        $description,
        $price
    );

    if ($updated) {
        $_SESSION['success'] = "Serviço atualizado com sucesso!";

        header('Location: /?page=dashboard');
        exit;
    }

    $_SESSION['error'] = "Não foi possível atualizar o serviço.";

    header('Location: /?page=editservice&id=' . $service_id);
    exit;
}


        
}

if ($page === 'register') {
    require_once '../views/register.php';
    exit;
}

if ($page === 'dashboard') {

    if (!isset($_SESSION['user'])) {
        header('Location: /?page=login');
        exit;
    }

    $services = $serviceController->getAllServices();


    require_once '../views/dashboard.php';
    exit;
}

if ($page === 'createservice') {

    if (!isset($_SESSION['user'])) {
        header('Location: /?page=login');
        exit;
    }

    require_once '../views/createservice.php';
    exit;
}

if ($page === 'editservice') {

    if (!isset($_SESSION['user'])) {
        header('Location: /?page=login');
        exit;
    }

    $service_id = $_GET['id'] ?? null;

    if (!$service_id) {
        header('Location: /?page=dashboard');
        exit;
    }

    $service = $serviceController->getServiceById($service_id);

    if (!$service) {
        header('Location: /?page=dashboard');
        exit;
    }

    require_once '../views/updateservice.php';
    exit;
}






require_once '../views/login.php';