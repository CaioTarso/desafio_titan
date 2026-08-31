<?php

class Service
{
    public string $description;
    public float $price;
    public ?string $finished_at;
    public ?float $commission_user;
    public int $user_id_user;

    public function __construct(
        string $description,
        float $price,
        int $user_id_user
    ) {
        $this->description = $description;
        $this->price = $price;
        $this->user_id_user = $user_id_user;
    }
}




?>