<?php
require_once '../models/Service.php';


class ServiceRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function create(Service $service) {
        $stmt = $this->pdo->prepare("
            INSERT INTO service (description, price, user_id_user)
            VALUES (:description, :price, :user_id_user)
        ");

        $stmt->bindParam(':description', $service->description);
        $stmt->bindParam(':price', $service->price);
        $stmt->bindParam(':user_id_user', $service->user_id_user);

        return $stmt->execute();
    }

    public function update(Service $service) {
        $stmt = $this->pdo->prepare("
            UPDATE service
            SET
              description = :description,
              price = :price
            WHERE id_service = :id
        ");

        $stmt->bindParam(':description', $service->description);
        $stmt->bindParam(':price', $service->price);
        $stmt->bindParam(':id', $service->id_service);

        return $stmt->execute();

    }

    public function delete($service_id) {
        $stmt = $this->pdo->prepare("
           DELETE FROM service WHERE id_service = :id
        ");

        $stmt->bindParam(':id', $service_id);

        return $stmt->execute();
    }



    public function getAll()  {
        $stmt = $this->pdo->prepare("
            SELECT
                service.*,
                users.name
            FROM service
            INNER JOIN users
                ON service.user_id_user = users.id_user
            ORDER BY service.created_at ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {

        $stmt = $this->pdo->prepare("
          SELECT * FROM service WHERE id_service = :id
        ");
        
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


?>