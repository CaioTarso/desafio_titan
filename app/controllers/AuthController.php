<?php

require_once '../models/User.php';
require_once '../repositories/UserRepository.php';


class AuthController {

    private $userRepository;

    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }


   public function register($name, $email, $password){

        $userexits = $this->userRepository->getUserByEmail($email);

        if ($userexits) {
            return false;
        }

        $user = new User($name, $email, $password);

        return $this->userRepository->createUser($user);
   }



    public function login($email, $password) {

        $user = $this->userRepository->LoginUser($email, $password);

        if ($user) {
            return $user;

        }
            return null;
       
    }
}



?>