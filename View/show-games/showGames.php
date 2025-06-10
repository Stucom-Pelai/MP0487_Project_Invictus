<?php
require_once '../../Model/Game.php';
require_once '../../Model/User.php';
session_start();
$user = $_SESSION["user"];
$lista = $_SESSION["lista"];

foreach ($lista as $game) {
    $datos[] = array(
        "id" => $game->getId(),
        "name" => $game->getName(),
        "gender" => $game->getGender(),
        "release_date" => $game->getReleaseDate(),
        "description" => $game->getDescription(),
        "developer" => $game->getDeveloper(),
        "img_game_path" => $game->getImageGamePath()
    );
}

$json_resultante = json_encode($datos);

if ($lista != 0) {
    ?>
    <script> let mostraLista = true; </script>
    <?php
} else {
    ?>
    <script> let mostraLista = false; </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN GAMES</title>
    <!-- LOGO INVICTUS -->
    <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css" defer>
    <script src="../../Model/jquery-3.5.1.min.js"></script>
    <script src="../../Model/slick-1.8.1/slick/slick.min.js"></script>
    <script src="../../Model/slick-1.8.1/slick/slick.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="../games/games.js" defer></script>
    <style>
        .slick-slide {
            height: auto;
        }
    </style>
</head>

<header>
    <div id="gameData" style="display:none;">
        <?php echo $json_resultante; ?>
    </div>
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
                <a href="../news/news.php">NEWS</a>
                <a href="../events/events.php">CALENDAR</a>
                <a href="../contact/contact.php">CONTACT</a>
                <a href="#ABOUT">ABOUT US</a>
            </nav>
        </div>
    </div>
</header>

<body>
    <article>
        <div class="center">
            <h1>VIDEO GAMES</h1>
            <?php if ($lista != 0) { ?>
                <div class="slider">
                    <?php foreach ($lista as $game) { ?>
                        <div class="games-slide">
                            <img class="img-header" src="<?php echo $game->getImageGamePath(); ?>" alt="PC">
                            <div class="label">
                                <label><strong><?php echo $game->getName(); ?> </strong></label><br>
                                <label style="font-size:14px;"><?php echo $game->getGender(); ?></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <h2 id="void_list" style="display:none;">Games list is empty, please create a new game!</h2>
            <?php } ?>
            <br><br>
        </div>
    </article>
</body>
</html>