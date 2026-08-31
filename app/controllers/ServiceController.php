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

    public function getServiceById($id) {
        return $this->serviceRepository->getById($id);
    }

    public function createService($description, $price, $user_id_user) {

      $service = new Service (
         $description,
         $price,
         $user_id_user
      );

      return $this->serviceRepository->create($service);
    }

    public function updateService($service_id, $description, $price){
       
       $serviceexists = $this->getServiceById($service_id);

       if(!$serviceexists) {
         return false;
       }

       $service = new Service($description, $price, $serviceexists['user_id_user'], $service_id);

       return $this->serviceRepository->update($service);
       
    }
}



?>