<?php


class User {
    public int $id;
    public string $name;
    public string $email;
    public string $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    ){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
?>