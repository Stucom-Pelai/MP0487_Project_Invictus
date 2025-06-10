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
    <title>NEWS</title>
        <!-- LOGO INVICTUS -->
        <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css">
    <script src="../../Model/jquery-3.5.1.min.js"></script>
    <script src="news.js" defer></script>
    <script src="../../Model/slick-1.8.1/slick/slick.min.js"></script>
    <script src="../../Model/slick-1.8.1/slick/slick.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
</head>

<body>
    <header>
        <div class="juntar">
            <form action="../../Controller/UserController.php" method="post">
                <div class="juntar5">
                <img class="img_logo" src="../imagenes/src/logo_invictus-modified.png" alt="LOGO INVICTUS GAMERS">
                    <img class="img_title" src="../imagenes/src/titulo proyecto.png" alt="INVICTUS GAMERS">
                </div>
                <div class="juntar4">
                    <nav>
                        <img src="../imagenes/src/usuario.png" alt="user">
                        <input class="boton_header" type="submit" name="logout" value="LOG-OUT">
                    </nav>
                </div>
            </form>
        </div>
        <div class="center2">
            <div class="juntar">
                <nav class="menu">
                    <a href="../profile/profile.php">PROFILE</a>
                    <a href="../events/events.php">CALENDAR</a>
                    <?php if($user->getAdmin()==1){ ?>
                    <a href="../admin/admin.php">ADMIN</a>
                    <?php } else { ?>
                    <a href="../../Controller/GameController.php">GAMES</a>
                    <?php }  ?>
                    <a href="../contact/contact.php">CONTACT</a>
                    <a href="#ABOUT">ABOUT US</a>
                </nav>
            </div>
        </div>
    </header>
    <div class="content">
        <article>
            <img id="news-img-header" src="../imagenes/src/opengraph.png" alt="MSI">
            <div class="slider">
                <div class="news-slide">
                    <h3>TITULO NOTICIA 1</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="news-slide">
                    <h3>TITULO NOTICIA 2</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="news-slide">
                    <h3>TITULO NOTICIA 3</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="news-slide">
                    <h3>TITULO NOTICIA 4</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="news-slide">
                    <h3>TITULO NOTICIA 5</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="news-slide">
                    <h3>TITULO NOTICIA 6</h3>
                    <h5>subtitulo</h5>
                    <img class="img-header" src="../imagenes/src/ordenador.png" alt="PC">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Nisi ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
            </p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
                tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas
                semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
                tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas
                semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
                tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas
                semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
                tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas
                semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </article>
    </div>

    <p>
    <footer>
        <div class="juntar">
            <form action="../contact/contact.php">
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
                                alt="TWITTER"></a>
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