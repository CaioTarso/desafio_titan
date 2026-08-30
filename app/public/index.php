<?php

session_start();

require_once '../config/database.php';
require_once '../repositories/UserRepository.php';
require_once '../controllers/AuthController.php';

$conexao = new Conexao();
$db = $conexao->conectar();

$userRepository = new UserRepository($db);
$authController = new AuthController($userRepository);

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


    require_once '../views/dashboard.php';
    exit;
}





require_once '../views/login.php';