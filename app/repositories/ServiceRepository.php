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

    public function getPendingServices($user_id, $limit) {
        $stmt = $this->pdo->prepare("
            SELECT id_service, description FROM service
            WHERE user_id_user = :user_id AND finished_at IS NULL
            ORDER BY created_at DESC
            LIMIT :limit   
        ");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalMadeByUserId($user_id, $limit) {
        $stmt = $this->pdo->prepare("
            SELECT SUM(price) as total_made FROM service
            WHERE user_id_user = :user_id AND finished_at IS NOT NULL
            ORDER BY finished_at DESC
            LIMIT :limit
        ");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT); 
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total_made'];
    }



    public function getAll($filters = [])
    {
        $query = "
            SELECT
                service.*,
                users.name
            FROM service
            INNER JOIN users
                ON service.user_id_user = users.id_user
        ";

        $conditions = [];
        $params = [];

        if (!empty($filters['description'])) {
            $conditions[] = "service.description LIKE :description";
            $params[':description'] = '%' . $filters['description'] . '%';
        }

        if (!empty($filters['start_date'])) {
            $conditions[] = "service.created_at >= :start_date";
            $params[':start_date'] = $filters['start_date'] . ' 00:00:00';
        }

        if (!empty($filters['end_date'])) {
            $conditions[] = "service.finished_at <= :end_date";
            $params[':end_date'] = $filters['end_date'] . ' 23:59:59';
        }

        if (!empty($filters['status'])) {

            if ($filters['status'] === 'pending') {
                $conditions[] = "service.finished_at IS NULL";
            }

            if ($filters['status'] === 'finished') {
                $conditions[] = "service.finished_at IS NOT NULL";
            }
        }

        if (!empty($filters['user_id'])) {
            $conditions[] = "service.user_id_user = :user_id";
            $params[':user_id'] = $filters['user_id'];
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY service.created_at ASC";

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {

        $stmt = $this->pdo->prepare("
          SELECT
            service.*,
            users.name,
            users.email
        FROM service
        INNER JOIN users
            ON service.user_id_user = users.id_user
        WHERE service.id_service = :id
        ");
        
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function finish(Service $service) {
        $stmt = $this->pdo->prepare("
            UPDATE service
            SET finished_at = NOW(),
            commission_user = :commission_user
            WHERE id_service = :id
        ");

        $stmt->bindParam(':id', $service->id_service);
        $stmt->bindParam(':commission_user', $service->commission_user);

        return $stmt->execute();
    }
}


?>