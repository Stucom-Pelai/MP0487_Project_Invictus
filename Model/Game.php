<?php

class Game {
    private $id;
    private $name;
    private $gender;
    private $release_date;
    private $description;
    private $developer;
    private $img_game_path;

    // Constructor
    public function __construct($name, $release_date, $description, $gender, $developer, $id, $img_game_path) {
        $this->name = $name;
        $this->release_date = $release_date;
        $this->description = $description;
        $this->gender = $gender;
        $this->developer = $developer;
        $this->id = $id;
        $this->img_game_path = $img_game_path;
    }

    // Getter and setter methods
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getReleaseDate() {
        return $this->release_date;
    }

    public function setReleaseDate($release_date) {
        $this->release_date = $release_date;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDeveloper() {
        return $this->developer;
    }

    public function setDeveloper($developer) {
        $this->developer = $developer;
    }
    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getImageGamePath() {
        return $this->img_game_path;
    }

    public function setImageGamePath($img_game_path) {
        $this->img_game_path = $img_game_path;
    }
}
?>
