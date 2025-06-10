<?php
require_once '../Model/Game.php';
require_once '../Model/User.php';
session_start();
unset($_SESSION["msg"]);
unset($_SESSION["error"]);
$myuser = $_SESSION['user'];
$lista = $_SESSION["lista"];
$game = new GameController();

//var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        echo "<p>Create button is clicked.</p>";
        $game->createGame($lista, $myuser);
    }
    if (isset($_POST["save"])) {
        echo "<p>Save changes button is clicked.</p>";
        $game->updateGame($lista, $myuser);
    }
    if (isset($_POST["delete"])) {
        echo "<p>Delete button is clicked.</p>";
        $game->deleteGame($myuser);
    }
    if (isset($_POST["cancel"])) {
        echo "<p>Cancel button is clicked.</p>";
        unset($_SESSION["msg"]);
        unset($_SESSION["error"]);
        header("Location: ../View/games/games.php");
        exit();
    }
} else {
    $game->initGamesView($myuser);
}

class GameController
{
    private $conn;

    public function __construct()
    {
        // database connection (DSN es: DATABASE SOURCE NAME)
        $dsn = 'mysql:host=localhost:3306;dbname=INVICTUS';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            echo "<br>";

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function initGamesView($user)
    {
        $consulta = "SELECT max(id_videojuego) From videojuego;";
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {

            $_SESSION["num_juegos"] = $resultado["max(id_videojuego)"];
            $i = 1;
            while ($_SESSION["num_juegos"] >= $i) {
                $consulta = "SELECT * FROM VIDEOJUEGO where id_videojuego=$i;";
                $stmt = $this->conn->prepare($consulta);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {
                    $myGame = new Game(
                        $resultado["nombre"],
                        $resultado["fecha_salida"],
                        $resultado["descripcion"],
                        $resultado["genero"],
                        $resultado["desarrolladora"],
                        $resultado["id_videojuego"],
                        $resultado["game_image_path"]
                    );
                    $lista_juegos[$i] = $myGame;
                }
                $i++;
            }
            $_SESSION["lista"] = $lista_juegos;

            if($user->getAdmin()==1){
                //redirect to login
                header("Location: ../View/games/games.php");
                exit();
            } else {
                //redirect to login
                header("Location: ../View/show-games/showGames.php");
                exit();
            }
        }
        $lista_juegos = 0;
        $_SESSION["lista"] = $lista_juegos;

        if($user->getAdmin()==1){
            //redirect to games
            header("Location: ../View/games/games.php");
            exit();
        } else {
            //redirect to show-games
            header("Location: ../View/show-games/showGames.php");
            exit();
        }
    }
    
    public function createGame($lista, $user)
    {
        if (!empty($_POST["name"]) && !empty($_POST["gender"]) && !empty($_POST["developer"]) && !empty($_POST["release_date"]) && !empty($_POST["description"])) {
            $new_game_name = $_POST["name"];
            $new_game_gender = $_POST["gender"];
            $new_game_developer = $_POST["developer"];
            $new_game_release_date = $_POST["release_date"];
            $new_game_description = $_POST["description"];

            $consulta = "SELECT nombre FROM VIDEOJUEGO WHERE nombre=:nombre";
            $stmt = $this->conn->prepare($consulta);
            $stmt->bindParam(':nombre', $new_game_name);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultado) {

                $consulta = "INSERT INTO VIDEOJUEGO (nombre, desarrolladora, fecha_salida, descripcion, genero, game_image_path) VALUES (?, ?, ?, ?, ?, '../../View/imagenes/src/usuario.png')";

                $stmt = $this->conn->prepare($consulta);

                // Vincular los parámetros con los valores
                $stmt->bindParam(1, $new_game_name);
                $stmt->bindParam(2, $new_game_developer);
                $stmt->bindParam(3, $new_game_release_date);
                $stmt->bindParam(4, $new_game_description);
                $stmt->bindParam(5, $new_game_gender);

                if ($stmt->execute()) {
                    //check against a database
                    $consulta = "SELECT id_videojuego FROM VIDEOJUEGO WHERE nombre=:nombre";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(':nombre', $new_game_name);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    var_dump($resultado);
                    if ($resultado) {

                        $new_game_id = $resultado["id_videojuego"];

                        $newGame = new Game(
                            $new_game_name,
                            $new_game_release_date,
                            $new_game_description,
                            $new_game_gender,
                            $new_game_developer,
                            $new_game_id,
                            '../../View/imagenes/src/logo_invictus-modified.png'
                        );

                        $index = count($lista);
                        $lista[$index] = $newGame;

                        $_SESSION["lista"] = $lista;
                        $_SESSION["msg"] = "Game added correctly";
                        unset($_SESSION["error"]);

                        $this->initGamesView($user);
                    }
                }
            } else {
                unset($_SESSION["msg"]);
                $_SESSION["error"]="Game already exist";

                header("Location: ../View/games/games.php");
                exit();
            }
        } else {
            unset($_SESSION["msg"]);
            $_SESSION["error"]="Missing field, please complete all fields";

            header("Location: ../View/games/games.php");
            exit();
        }
    }

    public function updateGame($lista, $user)
    {
        if (isset($_POST["game_id"])) {

            $game_id = $_POST["game_id"];
            $updated = false;

            if ($lista[$game_id]->getId() == $game_id) {

                if (isset($_POST["name"])) {
                    $new_game_name = $_POST["name"];

                    if ($new_game_name != $lista[$game_id]->getName()) {
                        //check against a database
                        $consulta = "UPDATE VIDEOJUEGO SET nombre=:nombre where id_videojuego=:id";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":nombre", $new_game_name);
                        $stmt->bindParam(":id", $game_id);

                        if ($stmt->execute()) {
                            $updated = true;
                            $lista[$game_id]->setName($new_game_name);
                        }
                    }
                }

                if (isset($_POST["gender"])) {
                    $new_game_gender = $_POST["gender"];

                    if ($new_game_gender != $lista[$game_id]->getGender()) {
                        //check against a database
                        $consulta = "UPDATE VIDEOJUEGO SET genero=:gender where id_videojuego=:id";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":gender", $new_game_gender);
                        $stmt->bindParam(":id", $game_id);

                        if ($stmt->execute()) {
                            $updated = true;
                            $lista[$game_id]->setGender($new_game_gender);
                        }
                    }
                }

                if (isset($_POST["developer"])) {
                    $new_game_developer = $_POST["developer"];

                    if ($new_game_developer != $lista[$game_id]->getDeveloper()) {
                        //check against a database
                        $consulta = "UPDATE VIDEOJUEGO SET desarrolladora=:developer where id_videojuego=:id";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":developer", $new_game_developer);
                        $stmt->bindParam(":id", $game_id);

                        if ($stmt->execute()) {
                            $updated = true;
                            $lista[$game_id]->setDeveloper($new_game_developer);
                        }
                    }
                }

                if (isset($_POST["release_date"])) {
                    $new_game_release_date = $_POST["release_date"];

                    if ($new_game_release_date != $lista[$game_id]->getReleaseDate()) {
                        //check against a database
                        $consulta = "UPDATE VIDEOJUEGO SET fecha_salida=:release_date where id_videojuego=:id";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":release_date", $new_game_release_date);
                        $stmt->bindParam(":id", $game_id);

                        if ($stmt->execute()) {
                            $updated = true;
                            $lista[$game_id]->setReleaseDate($new_game_release_date);
                        }
                    }
                }

                if (isset($_POST["description"])) {
                    $new_game_description = $_POST["description"];

                    if ($new_game_description != $lista[$game_id]->getDescription()) {
                        //check against a database
                        $consulta = "UPDATE VIDEOJUEGO SET descripcion=:description where id_videojuego=:id";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":description", $new_game_description);
                        $stmt->bindParam(":id", $game_id);

                        if ($stmt->execute()) {
                            $updated = true;
                            $lista[$game_id]->setDescription($new_game_description);
                        }
                    }
                }
            }
        }

        if ($updated) {
            $_SESSION['lista'] = $lista;
            $_SESSION["msg"] = "All changes have been saved";
            unset($_SESSION['error']);

            $this->initGamesView($user);

        } else {
            $_SESSION["error"] = "No changes made";
            unset($_SESSION['msg']);

            header("Location: ../View/games/games.php");
            exit();
        }
    }

    public function deleteGame($user)
    {
        $userId = $user->getId();
        $userEmail = $user->getEmail();

        if ($_POST["game_id"] != 0) {
            if (!empty($_POST["adminPassword"])) {
                $adminPassword = $_POST["adminPassword"];
                $gameId = $_POST["game_id"];
                echo $_POST["game_id"];
                $consulta = "SELECT id_usuario FROM USUARIO WHERE email=:email AND contrasena=:password AND user_admin=1";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":email", $userEmail);
                $stmt->bindParam(":password", $adminPassword);

                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {
                    if ($userId == $resultado["id_usuario"]) {

                        $consulta = "DELETE FROM VIDEOJUEGO where id_videojuego=:id;";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":id", $gameId);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                        if (!$resultado) {
                            $_SESSION["msg"] = "Game deleted correctly";
                            unset($_SESSION['error']);

                            $this->initGamesView($user);

                        } else {
                            $_SESSION["error"] = "Game didnt exist";
                            unset($_SESSION['msg']);

                            //redirect to login
                            header("Location: ../View/games/games.php");
                            exit();
                        }
                    }
                } else {
                    $_SESSION["error"] = "Password didnt match";
                    unset($_SESSION['msg']);
                    //redirect to login
                    header("Location: ../View/games/games.php");
                    exit();
                }
            } else {
                $_SESSION["error"] = "Please enter admin password";
                unset($_SESSION['msg']);
                //redirect to login
                header("Location: ../View/games/games.php");
                exit();
            }

        } else {
            $_SESSION["error"] = "Please select a game to delete";
            unset($_SESSION['msg']);
            //redirect to login
            header("Location: ../View/games/games.php");
            exit();
        }
    }
}