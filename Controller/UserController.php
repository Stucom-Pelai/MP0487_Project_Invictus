<?php
require_once '../Model/User.php';
session_start();
unset($_SESSION["error_login"]);
$user = new UserController();

var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //check buttons
    if (isset($_POST["login"])) {
        echo "<p>Login button is clicked.</p>";
        $user->login();
    }
    if (isset($_POST["logout"])) {
        echo "<p>Logout button is clicked.</p>";
        $user->logout();
    }
    if (isset($_POST["register"])) {
        echo "<p>Register button is clicked.</p>";
        $user->register();
    }
    if (isset($_POST["registerAdmin"])) {
        echo "<p>Register Admin button is clicked.</p>";
        $user->registerAdmin();
    }
    if (isset($_POST["upload_img"])) {
        echo "<p>Upload image button is clicked.</p>";
        $myuser = $_SESSION['user'];
        $user->uploadImg($myuser);
    }
    if (isset($_POST["update"])) {
        echo "<p>Update button is clicked.</p>";
        $myuser = $_SESSION['user'];
        $user->updateData($myuser);
    }
    if (isset($_POST["delete"])) {
        echo "<p>Delete button is clicked.</p>";
        $myuser = $_SESSION['user'];
        $user->deleteAccount($myuser);
    }
    if (isset($_POST["cancel"])) {
        echo "<p>Cancel button is clicked.</p>";
        header("Location: ../View/settings/settings.php");
        exit();
    }
}

class UserController
{
    private $conn;
    public function __construct()
    {
        // database connection (DSN es abreviado DATOS SERVER NAME)
        $dsn = 'mysql:host=localhost:3306;dbname=INVICTUS';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function register(): void
    {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $surname = $_POST["surname"];
        $nickname = $_POST["nickname"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password == $confirm_password) {

            //check against a database
            $consulta = "SELECT id_usuario FROM USUARIO WHERE email=:email";
            $stmt = $this->conn->prepare($consulta);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {

                $id_result = $resultado['id_usuario'];

                //user already exist, display an error message
                $_SESSION["logged"] = false;
                $_SESSION["error_register"] = "User already exist";

                //redirect to login
                header("Location: ../View/signin/signinUser.php");
                exit();

            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                try {
                    //preparar y ejecutar la consulta Insert para añadir al nuevo usuario a la BBDD
                    $consulta = "INSERT INTO USUARIO (nombre, apellidos, nikname, email, contrasena, descripcion, user_admin, user_image_path) VALUES (?, ?, ?, ?, ?, 'Default description for new users, you should change it', false, '../../View/imagenes/src/usuario.png')";

                    // Preparar la consulta
                    $stmt = $this->conn->prepare($consulta);

                    // Vincular los parámetros con los valores
                    $stmt->bindParam(1, $username);
                    $stmt->bindParam(2, $surname);
                    $stmt->bindParam(3, $nickname);
                    $stmt->bindParam(4, $email);
                    $stmt->bindParam(5, $hash);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($resultado == false) {

                        //check against a database
                        $consulta = "SELECT * FROM USUARIO WHERE email=:email";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":email", $email);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($resultado) {

                            $id_result = $resultado['id_usuario'];
                            $name_result = $resultado['nombre'];
                            $surname_result = $resultado['apellidos'];
                            $nickname_result = $resultado['nikname'];
                            $email_result = $resultado['email'];
                            $description_result = $resultado['descripcion'];
                            $admin_result = $resultado['user_admin'];
                            $image_result = $resultado['user_image_path'];

                            //preparar y ejecutar la consulta adicional
                            $consulta = "SELECT count(*) FROM RESENA WHERE id_usuario=:id_usuario;";
                            $stmt = $this->conn->prepare($consulta);
                            $stmt->bindParam(":id_usuario", $id_result);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $resenas_result = $resultado['count(*)'];

                            //preparar y ejecutar la consulta adicional
                            $consulta = "SELECT count(*) FROM EVENTO WHERE id_organizador=:id_usuario;";
                            $stmt = $this->conn->prepare($consulta);
                            $stmt->bindParam(":id_usuario", $id_result);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $eventos_result = $resultado['count(*)'];

                            //preparar y ejecutar la consulta adicional
                            $consulta = "SELECT count(*) FROM PARTICIPAR_COMUNIDAD WHERE id_usuario=:id_usuario;";
                            $stmt = $this->conn->prepare($consulta);
                            $stmt->bindParam(":id_usuario", $id_result);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $communitie_result = $resultado['count(*)'];

                            //preparar y ejecutar la consulta adicional
                            $consulta = "SELECT count(*) FROM BAN WHERE id_usuario = :id_usuario;";
                            $stmt = $this->conn->prepare($consulta);
                            $stmt->bindParam(":id_usuario", $id_result);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $ban_result = $resultado['count(*)'];

                            $usuario = new User(
                                $id_result,
                                $email_result,
                                $name_result,
                                $surname_result,
                                $nickname_result,
                                $description_result,
                                $resenas_result,
                                $eventos_result,
                                $communitie_result,
                                $admin_result,
                                $ban_result,
                                $image_result
                            );

                            $_SESSION["logged"] = true;
                            $_SESSION['user'] = $usuario;

                            //redirect to home page
                            header("Location: ../View/profile/profile.php");
                            exit();
                        }

                    }
                } catch (mysqli_sql_exception $e) {
                    // Capturar la excepción de duplicación de entrada (correo electrónico duplicado)
                    if ($e->getCode() === 1062) {

                        //authentication failed, display an error message
                        $_SESSION["logged"] = false;
                        $_SESSION["error_register"] = "El correo electrónico ya está en uso.";

                        //redirect to login
                        header("Location: ../View/signin/signinUser.php");
                        exit();

                    } else {
                        echo "Error: " . $e->getMessage(); // Otra excepción ocurrió
                    }
                }
            }
        } else {

            $_SESSION["logged"] = false;
            $_SESSION["error_register"] = "Passwords didn't match";

            //redirect to signin
            header("Location: ../View/signin/signinUser.php");
            exit();
        }
    }
    public function registerAdmin(): void
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        //check against a database
        $consulta = "SELECT id_usuario FROM USUARIO WHERE email=:email";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado == true) {

            $id_result = $resultado['id_usuario'];

            //user already exist, display an error message
            $_SESSION["logged"] = false;
            $_SESSION["error_register"] = "User already exist";

            //redirect to login
            header("Location: ../View/signin/signinAdmin.php");
            exit();

        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {

                //preparar y ejecutar la consulta Insert para añadir al nuevo usuario a la BBDD
                $consulta = "INSERT INTO USUARIO (nombre, apellidos, nikname, email, contrasena, descripcion, user_admin, user_image_path) VALUES (null, null, null, ?, ?, 'Default description for new users, you should change it', true, '../../View/imagenes/src/usuario.png');";

                // Preparar la consulta
                $stmt = $this->conn->prepare($consulta);

                // Vincular los parámetros con los valores
                $stmt->bindParam(1, $email);
                $stmt->bindParam(2, $hash);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado == false) {

                    //check against a database
                    $consulta = "SELECT * FROM USUARIO WHERE email=:email";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($resultado) {

                        $id_result = $resultado['id_usuario'];
                        $name_result = $resultado['nombre'];
                        $surname_result = $resultado['apellidos'];
                        $nickname_result = $resultado['nikname'];
                        $email_result = $resultado['email'];
                        $description_result = $resultado['descripcion'];
                        $admin_result = $resultado['user_admin'];
                        $image_result = $resultado['user_image_path'];

                        //preparar y ejecutar la consulta adicional
                        $consulta = "SELECT count(*) FROM RESENA WHERE id_usuario=:id_usuario;";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":id_usuario", $id_result);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $resenas_result = $resultado['count(*)'];

                        //preparar y ejecutar la consulta adicional
                        $consulta = "SELECT count(*) FROM EVENTO WHERE id_organizador=:id_usuario;";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":id_usuario", $id_result);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $eventos_result = $resultado['count(*)'];

                        //preparar y ejecutar la consulta adicional
                        $consulta = "SELECT count(*) FROM PARTICIPAR_COMUNIDAD WHERE id_usuario=:id_usuario;";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":id_usuario", $id_result);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $communitie_result = $resultado['count(*)'];

                        //preparar y ejecutar la consulta adicional
                        $consulta = "SELECT count(*) FROM BAN WHERE id_usuario = :id_usuario;";
                        $stmt = $this->conn->prepare($consulta);
                        $stmt->bindParam(":id_usuario", $id_result);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $ban_result = $resultado['count(*)'];

                        $usuario = new User(
                            $id_result,
                            $email_result,
                            $name_result,
                            $surname_result,
                            $nickname_result,
                            $description_result,
                            $resenas_result,
                            $eventos_result,
                            $communitie_result,
                            $admin_result,
                            $ban_result,
                            $image_result
                        );

                        $_SESSION["logged"] = true;
                        $_SESSION['user'] = $usuario;

                        //redirect to home page
                        header("Location: ../View/profile/profile.php");
                        exit();
                    }

                }
            } catch (mysqli_sql_exception $e) {
                // Capturar la excepción de duplicación de entrada (correo electrónico duplicado)
                if ($e->getCode() === 1062) {

                    //authentication failed, display an error message
                    $_SESSION["logged"] = false;
                    $_SESSION["error_register"] = "El correo electrónico ya está en uso.";

                    //redirect to login
                    header("Location: ../View/signin/signinUser.php");
                    exit();

                } else {
                    echo "Error: " . $e->getMessage(); // Otra excepción ocurrió
                }
            }
        }
    }

    public function login(): void
    {
        if (isset($_POST["password"]) && isset($_POST["email"])) {

            $password = $_POST["password"];
            $email = $_POST["email"];

            $consulta = "SELECT contrasena FROM USUARIO WHERE email=:email";
            $stmt = $this->conn->prepare($consulta);
            $stmt->bindParam(":email", $email);

            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($password, $resultado['contrasena'])) {

                //check against a database
                $consulta = "SELECT * FROM USUARIO WHERE email=:email";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {

                    $id_result = $resultado['id_usuario'];
                    $name_result = $resultado['nombre'];
                    $surname_result = $resultado['apellidos'];
                    $nickname_result = $resultado['nikname'];
                    $email_result = $resultado['email'];
                    $description_result = $resultado['descripcion'];
                    $admin_result = $resultado['user_admin'];
                    $image_result = $resultado['user_image_path'];

                    //preparar y ejecutar la consulta adicional
                    $consulta = "SELECT count(*) FROM RESENA WHERE id_usuario=:id_usuario;";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":id_usuario", $id_result);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $resenas_result = $resultado['count(*)'];

                    //preparar y ejecutar la consulta adicional
                    $consulta = "SELECT count(*) FROM EVENTO WHERE id_organizador=:id_usuario;";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":id_usuario", $id_result);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $eventos_result = $resultado['count(*)'];

                    //preparar y ejecutar la consulta adicional
                    $consulta = "SELECT count(*) FROM PARTICIPAR_COMUNIDAD WHERE id_usuario=:id_usuario;";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":id_usuario", $id_result);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $communitie_result = $resultado['count(*)'];

                    //preparar y ejecutar la consulta adicional
                    $consulta = "SELECT count(*) FROM BAN WHERE id_usuario = :id_usuario;";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":id_usuario", $id_result);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $ban_result = $resultado['count(*)'];

                    $usuario = new User(
                        $id_result,
                        $email_result,
                        $name_result,
                        $surname_result,
                        $nickname_result,
                        $description_result,
                        $resenas_result,
                        $eventos_result,
                        $communitie_result,
                        $admin_result,
                        $ban_result,
                        $image_result
                    );
                    var_dump($usuario);
                    $_SESSION["logged"] = true;
                    $_SESSION['user'] = $usuario;

                    //redirect to home page
                    header("Location: ../View/profile/profile.php");
                    exit();

                } else {

                    //authentication failed, display an error message
                    $_SESSION["logged"] = false;
                    $_SESSION["error_login"] = "Invalid username or password";

                    //redirect to login
                    header("Location: ../View/login/login.php");
                    exit();
                }
            } else {
                //authentication failed, display an error message
                $_SESSION["logged"] = false;
                $_SESSION["error_login"] = "User does not exist";

                //redirect to login
                header("Location: ../View/login/login.php");
                exit();
            }
        }
    }
    public function logout(): void
    {
        session_unset();
        session_destroy();
        //redirect to home page
        header("Location: ../View/index/index.php");
        exit();
    }

    public function uploadImg($user): void
    {
        // Verificar si se ha enviado un archivo
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] !== '') {

            // Directorio donde se almacenarán las imágenes
            $target_dir = "../View/imagenes/profileImg/";
            $file_name = basename($_FILES["fileToUpload"]["name"]);
            $target_file = $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verificar el tamaño del archivo
            if ($_FILES["fileToUpload"]["size"] > 1200000) {

                echo $_FILES["fileToUpload"]["size"];
                $_SESSION["error_msg"] = "Lo siento, tu archivo es demasiado grande.";
                //redirect to profile
                header("Location: ../View/profile/profile.php");
                exit();
            }

            // Permitir ciertos formatos de archivo
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                $_SESSION["error_msg"] = "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
                //redirect to profile
                header("Location: ../View/profile/profile.php");
                exit();
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $target_file)) {

                // Actualizar el campo de la ruta de la imagen en la tabla de usuarios
                $user_image_path = "../" . $target_dir . $file_name; // Ruta relativa al directorio de subidas
                $user->setImagePath($user_image_path); // Actualizar la ruta de la imagen en el objeto de usuario

                // Actualizar el campo de la ruta de la imagen en la tabla de usuarios
                $consulta = "UPDATE usuario SET user_image_path = '$user_image_path' WHERE id_usuario = " . $user->getId();

                $stmt = $this->conn->prepare($consulta);

                if ($stmt->execute()) {
                    unset($_SESSION['error_msg']);

                    //redirect to home page
                    header("Location: ../View/profile/profile.php");
                    exit();

                } else {
                    $_SESSION["error_msg"] = "Error al actualizar la ruta de imagen en la base de datos";

                    //redirect to home page
                    header("Location: ../View/profile/profile.php");
                    exit();
                }

            } else {

                //display an error message
                $_SESSION["error_msg"] = "Lo siento, hubo un error al subir tu archivo";

                //redirect to profile
                header("Location: ../View/profile/profile.php");
                exit();
            }

        } else {

            //display an error message
            $_SESSION["error_msg"] = "No se ha seleccionado ningún archivo";

            //redirect to profile
            header("Location: ../View/profile/profile.php");
            exit();
        }

    }
    public function updateData($user)
    {
        $id = $user->getID();
        $updated = false;
        if (isset($_POST["email"])) {
            $new_email = $_POST["email"];
            $email = $user->getEmail();
            if ($email != $new_email) {
                //check against a database
                $consulta = "UPDATE USUARIO SET email=:email where id_usuario=:id";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":email", $new_email);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $updated = true;
                    $user->setEmail($new_email);
                }
            }
        }

        if (isset($_POST["username"])) {
            $new_username = $_POST["username"];
            $username = $user->getUsername();
            if ($username != $new_username) {
                //check against a database
                $consulta = "UPDATE USUARIO SET nombre=:nombre where id_usuario=:id";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":nombre", $new_username);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $updated = true;
                    $user->setUsername($new_username);
                }
            }
        }

        if (isset($_POST["surname"])) {
            $new_surname = $_POST["surname"];
            $surname = $user->getSurname();
            if ($surname != $new_surname) {
                //check against a database
                $consulta = "UPDATE USUARIO SET apellidos=:apellidos where id_usuario=:id";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":apellidos", $new_surname);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $updated = true;
                    $user->setSurname($new_surname);
                }
            }
        }

        if (isset($_POST["nickname"])) {
            $new_nickname = $_POST["nickname"];
            $nickname = $user->getNickname();
            if ($nickname != $new_nickname) {
                //check against a database
                $consulta = "UPDATE USUARIO SET nikname=:nickname where id_usuario=:id";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":nickname", $new_nickname);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $updated = true;
                    $user->setNickname($new_nickname);
                }
            }
        }

        if (isset($_POST["description"])) {
            $new_description = $_POST["description"];
            $description = $user->getDescription();
            if ($description != $new_description) {
                //check against a database
                $consulta = "UPDATE USUARIO SET descripcion=:description where id_usuario=:id";
                $stmt = $this->conn->prepare($consulta);
                $stmt->bindParam(":description", $new_description);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $updated = true;
                    $user->setDescription($new_description);
                }
            }
        }

        if (!empty($_POST["old_password"]) && !empty($_POST["new_password"]) && !empty($_POST["new_password_confirmation"])) {
            
            if(isset($_POST["old_password"])){
                $old_password = $_POST["old_password"];
            }
            if(isset($_POST["new_password"])){
                $new_password = $_POST["new_password"];
            }
            if(isset($_POST["new_password_confirmation"])){
                $new_password_confirmation = $_POST["new_password_confirmation"];
            }

            //check against a database
            $consulta = "SELECT id_usuario, contrasena FROM USUARIO WHERE id_usuario=:id";
            $stmt = $this->conn->prepare($consulta);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($old_password, $resultado['contrasena'])) {

                if ($old_password != $new_password && $new_password == $new_password_confirmation) {
                    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    //check against a database
                    $consulta = "UPDATE USUARIO SET contrasena=:new_password where id_usuario=:id";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":new_password", $new_hashed_password);
                    $stmt->bindParam(":id", $id);

                    if ($stmt->execute()) {
                        $updated = true;
                    }
                }

            } else {
                unset($_SESSION['msg']);
                $_SESSION["error"] = "Invalid current password";

                //redirect to login
                header("Location: ../View/settings/settings.php");
                exit();
            }
        } 

        if (!empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["surname"]) && !empty($_POST["nickname"]) && !empty($_POST["description"])) {
            if ($updated) {
                $_SESSION['user'] = $user;
                $_SESSION["msg"] = "All changes have been saved";
                unset($_SESSION["error"]);

                //redirect to login
                header("Location: ../View/settings/settings.php");
                exit();
            } else {
                $_SESSION["error"] = "No changes made";
                unset($_SESSION['msg']);

                //redirect to login
                header("Location: ../View/settings/settings.php");
                exit();
            }
        } else {
            $_SESSION["error"] = "Missing field, please complete all fields";
            unset($_SESSION['msg']);

            //redirect to login
            header("Location: ../View/settings/settings.php");
            exit();
        }

    }
    public function deleteAccount($user)
    {
        $id = $user->getID();
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
            $email = $user->getEmail();

            $consulta = "SELECT id_usuario, contrasena FROM USUARIO WHERE email=:email";
            $stmt = $this->conn->prepare($consulta);
            $stmt->bindParam(":email", $email);

            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($password, $resultado['contrasena'])) {
                $id_result = $resultado['id_usuario'];
                if ($id == $id_result) {

                    $consulta = "DELETE FROM USUARIO where id_usuario=:id";
                    $stmt = $this->conn->prepare($consulta);
                    $stmt->bindParam(":id", $id);

                    if ($stmt->execute()) {
                        unset($_SESSION['user']);

                        //redirect to index
                        header("Location: ../View/index/index.php");
                        exit();
                    }
                }
            } else {
                $_SESSION["error"] = "Invalid current password";
                unset($_SESSION['msg']);

                //redirect to settings
                header("Location: ../View/settings/settings.php");
                exit();
            }
        }
    }
}

