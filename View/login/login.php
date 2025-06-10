<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG-IN</title>
        <!-- LOGO INVICTUS -->
        <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../../View/stylesheet/stylesheet.css">
    <script src="../../Model/jquery-3.5.1.min.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/additional-methods.js"></script>
    <script src="login.js" defer></script>

</head>

<body>
    <header>
        <form id="UP" action="../index/index.php">
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
            <img id="user_img" src="../imagenes/src/usuario.png" alt="USER-IMG">
            <form id="loginForm" action="../../Controller/UserController.php" method="post">
                <h2>LOG IN</h2>
                <div class="form-group">
                <input class="textBox" id="login-email" type="text" name="email" placeholder="Email" /> 
                </div>
                <br>
                <div class="form-group">
                <input class="textBox" id="login-passwd" type="password" name="password" placeholder="Password" /> 
                </div>
                <br>
                <input class="boton" type="submit" name="login" value="LOG-IN">
                <div class="div-msg" style="position:absolute;padding-left:15%;">
                    <?php if (isset($_SESSION["error_login"])) {
                        echo "<p style='color:red;margin-block-end:0em;margin-block-start:0em;'>" . $_SESSION["error_login"] . "</p>";
                    } ?>
                </div>
            </form>
            <br>
            <br>
            <form action="../signin/signinUser.php" method="post">
                <h2>NEW REGISTER</h2>
                <p>DON'T HAVE ACCOUNT YET?</p>
                <input class="boton" type="submit" name="register" value="REGISTER NOW">
            </form>
        </div>

    </article>
    <footer>
        <div class="juntar">
            <form action="#UP">
                <div class="juntar6">
                    <div class="center" id="ABOUT">
                        <h2>ABOUT US</h2>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="juntar7">
                    <aside>
                        <a href="https://www.google.com"><img class="img_link" src="../imagenes/src/google.png"
                                alt="GOOGLE"></a>
                        <a href="https://www.instagram.com"><img class="img_link" src="../imagenes/src/instagram.png"
                                alt="INSTAGRAM"></a>
                        <a href="https://www.twitter.com"><img class="img_link" src="../imagenes/src/tweeter.png"
                                alt="TWEETER"></a>
                    </aside>
                    <br>
                    <input class="botonUs" type="submit" name="login" value="CONTACT US">
                </div>
            </form>
            <div class="center">
                <h5>CREATED BY: MARTINA GIL, JIAHAO LIU & ENRIC DOMÈNECH</h5>
            </div>
        </div>
    </footer>

</body>

</html>