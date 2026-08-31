<?php

class Service
{
    public ?int $id_service;
    public string $description;
    public float $price;
    public ?string $finished_at;
    public ?float $commission_user;
    public int $user_id_user;

    public function __construct(
        string $description,
        float $price,
        int $user_id_user,
        ?int $id_service = null
    ) {
        $this->id_service = $id_service;
        $this->description = $description;
        $this->price = $price;
        $this->user_id_user = $user_id_user;
        $this->finished_at = null;
        $this->commission_user = null;
    }
}




?>