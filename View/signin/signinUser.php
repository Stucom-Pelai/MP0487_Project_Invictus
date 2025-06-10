<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW USER REGISTER</title>
    <!-- LOGO INVICTUS -->
    <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css">
    <script src="../../Model/jquery-3.5.1.min.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/additional-methods.js"></script>
    <script src="signinUser.js" defer></script>
</head>

<body>
    <header>
        <form action="../index/index.php">
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
        <div class="div_article">
            <h2>SIGN-IN</h2>
            <form id="registerForm" action="../../Controller/UserController.php" method="post">
                <div class="form-group">
                    <input class="textBox" type="text" name="email" placeholder="Email" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="username" placeholder="Name" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="surname" placeholder="Surname" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" type="text" name="nickname" placeholder="Nickname" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" id="password" type="password" name="password" placeholder="Password" />
                </div>
                <br>
                <div class="form-group">
                    <input class="textBox" id="confirm_password" type="password" name="confirm_password"
                        placeholder="Confirm password" />
                </div>
                <br>
                <input class="boton" type="submit" name="register" value="CREATE ACCOUNT">
                <div class="div-msg">
                    <?php if (isset($_SESSION["error_register"])) {
                        echo "<p style='color:red;'>" . $_SESSION["error_register"] . "</p>";
                    } ?>
                </div>
            </form>
        </div>

    </article>
    <footer>

    </footer>
</body>

</html>