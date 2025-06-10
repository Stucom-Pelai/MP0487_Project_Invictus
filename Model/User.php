<?php

class User
{
    private $id;
    private $email;
    private $username;
    private $surname;
    private $nickname;
    private $password;
    private $description;
    private $num_resenyas;
    private $num_torneos;
    private $num_comunidades;
    private $user_admin;
    private $num_ban;
    private $imagePath;

    public function __construct($id, $email, $username, $surname, $nickname, $description, $num_resenyas, $num_torneos, $num_comunidades, $user_admin, $num_ban, $imagePath){
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->surname = $surname;
        $this->nickname = $nickname;
        $this->description = $description;
        $this->num_resenyas = $num_resenyas;
        $this->num_torneos = $num_torneos;
        $this->num_comunidades = $num_comunidades;
        $this->user_admin = $user_admin;
        $this->num_ban = $num_ban;
        $this->imagePath = $imagePath;
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getNumResenyas()
    {
        return $this->num_resenyas;
    }

    public function setNumResenyas($num_resenyas)
    {
        $this->num_resenyas = $num_resenyas;
    }

    public function getNumTorneos()
    {
        return $this->num_torneos;
    }

    public function setNumTorneos($num_torneos)
    {
        $this->num_torneos = $num_torneos;
    }

    public function getNumComunidades()
    {
        return $this->num_comunidades;
    }

    public function setNumComunidades($num_comunidades)
    {
        $this->num_comunidades = $num_comunidades;
    }

    public function getAdmin()
    {
        return $this->user_admin;
    }

    public function setAdmin($user_admin)
    {
        $this->user_admin = $user_admin;
    }

    public function getNumBan()
    {
        return $this->num_ban;
    }

    public function setNumBan($num_ban)
    {
        $this->num_ban = $num_ban;
    }

    public function setImagePath($path)
    {
        $this->imagePath = $path;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }
}