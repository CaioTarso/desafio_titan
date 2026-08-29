<?php


class User {
    public string $id;
    public string $name;
    public string $email;
    public string $password;

    public function __contruct(
        string $id,
        string $name,
        string $email,
        string $password
    ){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
?>