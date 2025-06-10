<?php
require_once '../../Model/User.php';
session_start();
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER SETTINGS</title>
    <!-- LOGO INVICTUS -->
    <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css">
    <script src="../../Model/jquery-3.5.1.min.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/additional-methods.js"></script>
    <script src="settings.js" defer></script>
</head>

<body>

    <header>
        <form action="../profile/profile.php">
            <div class="div_header_left">
                <input class="botonCancel" type="submit" name="cancel" value="Cancel">
            </div>
            <div class="div_header_middle">
                <img class="img_logo" src="../imagenes/src/logo_invictus-modified.png" alt="LOGO INVICTUS GAMERS">
                <img class="img_title" src="../imagenes/src/titulo proyecto.png" alt="INVICTUS GAMERS">
            </div>
            <div class="div_header_right">Cancel</div>
        </form>
    </header>
    <article>
        <form id="form-settings" action="../../Controller/UserController.php" method="post">
            <div class="div_article1">
                <h2>CHANGE USER DATA</h2>
                <div class="form-group">
                    <input class="textBox" type="text" name="email" placeholder="Email"
                        value="<?php echo $user->getEmail() ?>" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="username" placeholder="Username"
                        value="<?php echo $user->getUsername() ?>" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="surname" placeholder="Surname"
                        value="<?php echo $user->getSurname() ?>" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="nickname" placeholder="Nickname"
                        value="<?php echo $user->getNickname() ?>" />
                </div>
                <br>
                <div class="form-group">
                    <textarea name="description" class="description" placeholder="Description" cols="10"
                        rows="3"><?php echo $user->getDescription() ?></textarea>
                </div>
                <br>
            </div>

            <div class="div_article2">
                <h2>CHANGE PASSWORD</h2>
                <div class="form-group">
                    <input class="textBox" type="password" name="old_password" placeholder="Insert current password"
                        minlength="8" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="password" id="new_password" name="new_password"
                        placeholder="Insert new password" minlength="8" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="password" name="new_password_confirmation"
                        placeholder="Confirm new password" minlength="8" />
                </div>
                <br>

                <h2>DELETE ACCOUNT</h2>
                <div class="form-group">
                    <input class="textBox" type="password" name="password"
                        placeholder="Insert current password for delete the account" />
                </div>
                <br>
                <input id="botonDelete" type="button" value="DELETE ACCOUNT">
            </div>

            <div class="div_article">
                <input class="boton" id="update" type="submit" name="update" value="SAVE CHANGES">
                <div class="div-msg">
                    <?php if (isset($_SESSION["msg"])) {
                        echo "<p style='color:green;margin-block-end:0em;margin-block-start:0em;'>" . $_SESSION["msg"] . "</p>";
                    } ?>
                    <?php if (isset($_SESSION["error"])) {
                        echo "<p style='color:red;margin-block-end:0em;margin-block-start:0em;'>" . $_SESSION["error"] . "</p>";
                    } ?>
                </div>
            </div>

            <div id="back"></div>
            <div id="confirmacion">
                <p>¿Está seguro de que desea eliminar su cuenta?</p>
                <input id="eliminar" type="submit" name="delete" value="Delete">
                <input id="cancelar" type="submit" name="cancel" value="Cancel">
            </div>

        </form>

    </article>
    <footer>

    </footer>
</body>

</html>