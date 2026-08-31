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
}


?>