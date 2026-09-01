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

    public function updateService($service_id, $description, $price, $user_id){
       
       $serviceexists = $this->getServiceById($service_id);

       if(!$serviceexists) {
         return false;
       }

       if ($serviceexists['user_id_user'] != $user_id) {
        return false;
    }

       $service = new Service($description, $price, $serviceexists['user_id_user'], $service_id);

       return $this->serviceRepository->update($service);
       
    }

    public function deleteService($service_id, $user_id){

        $serviceexists = $this->getServiceById($service_id);

       if(!$serviceexists) {
         return false;
       }

       if ($serviceexists['user_id_user'] != $user_id) {
        return false;
    }

       return $this->serviceRepository->delete($service_id);
    }
}



?>