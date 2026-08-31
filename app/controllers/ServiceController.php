<?php

require_once '../models/Service.php';
require_once '../repositories/ServiceRepository.php';



class ServiceController {

    private $serviceRepository;

    public function __construct($serviceRepository) {
        $this->serviceRepository = $serviceRepository;
    }

    public function getAllServices() {
        return $this->serviceRepository->getAll();
    }

    public function createService($description, $price, $user_id_user) {

      $service = new Service (
         $description,
         $price,
         $user_id_user
      );

      return $this->serviceRepository->create($service);
    }
}



?>