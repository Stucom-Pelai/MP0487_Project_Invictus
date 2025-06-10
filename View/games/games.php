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
        <script src="../../Model/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="../../Model/jquery-validation-1.19.5/dist/additional-methods.js"></script>
    <script src="games.js" defer></script>
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
    <div class="center2">
        <div class="juntar">
            <nav class="menu">
                <a href="../games/games.php">GAMES</a>
                <a href="../reviews/reviews.php">REVIEWS</a>
                <a href="../tournaments/tournaments.php">TOURNAMENTS</a>
                <a href="../communities/communities.php">COMMUNITIES</a>
                <a href="../bans/bans.php">BANS</a>
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

            <div id="back"></div>

            <div id="addNewGame">
                <form id="form-addNewGame" action="../../Controller/GameController.php" method="post">
                    <h2>Add Game</h2>
                    <div class="form-group">
                        <input class="textBox" type="text" id="name" name="name" placeholder="Title">
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="gender" name="gender" placeholder="Gender">
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="developer" name="developer" placeholder="Developer">
                    </div>
                    <br>
                    <label>Release Date:</label><br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="release_date" name="release_date" placeholder="yyyy-mm-dd">
                    </div>
                    <br>
                    <div class="form-group">
                    <textarea class="textBox" id="description" name="description" rows="4" cols="50"
                        placeholder="Description" style="height:20%;"></textarea>
                    </div>
                    <br>
                    <!--<input type="text" id="img_game_path" name="img_game_path"><br><br>-->

                    <input id="create" type="submit" name="create" value="Create">
                    <input class="cancelar" type="submit" name="cancel" value="Cancel">
                </form>
            </div>

            <div id="updateGame">
                <form id="form-updateGame" action="../../Controller/GameController.php" method="post">
                    <h2>Update Game</h2>
                    <div class="form-group">
                    <select id="update-selector" class="textBox" name="game_id"
                        style="background-color:grey; text-align:center;">
                        <option value="0">Select a game</option>
                        <?php foreach ($lista as $game) { ?>
                            <option value="<?php echo $game->getId(); ?>"><?php echo $game->getName(); ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="game-name" name="name" placeholder="Title">
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="game-gender" name="gender" placeholder="Gender">
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="game-developer" name="developer" placeholder="Developer">
                    </div>
                    <br>
                    <label>Release Date:</label><br>
                    <div class="form-group">
                    <input class="textBox" type="text" id="game-release-date" name="release_date" placeholder="yyyy-mm-dd">
                    </div>
                    <br>
                    <div class="form-group">
                    <textarea class="textBox" id="game-description" name="description" rows="4" cols="50"
                        placeholder="Description" style="height:20%;"></textarea>
                    </div>
                    <br>
                    <!--<input type="text" id="img_game_path" name="img_game_path"><br><br>-->
                    <input id="save" type="submit" name="save" value="Save">
                    <input class="cancelar" type="submit" name="cancel" value="Cancel">
                </form>
            </div>

            <div id="deleteGame">
                <form id="form-deleteGame" action="../../Controller/GameController.php" method="post">
                    <h2>Delete Game</h2>
                    <div class="form-group">
                    <select id="delete-selector" class="textBox" name="game_id">
                        <option value="0">Select a game</option>
                        <?php foreach ($lista as $game) { ?>
                            <option value="<?php echo $game->getId(); ?>"><?php echo $game->getName(); ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <br>
                    <div class="form-group">
                    <input class="textBox" type="password" id="adminPassword" name="adminPassword"
                        placeholder="Admin Password">
                    </div>
                    <br>
                    <input id="confirm" type="submit" name="delete" value="Delete">
                    <input class="cancelar" type="submit" name="cancel" value="Cancel">
                </form>
            </div>

            <div class="div_article3">
                <input id="add" class="boton" type="submit" value="Add Game">
            </div>
            <div class="div_article4">
                <input id="update" class="boton" type="submit" value="Update Game">
            </div>
            <div class="div_article5">
                <input id="delete" class="boton" type="submit" value="Delete Game">
            </div>
        </div>
        <div class="div-msg" style="position:absolute; left:50%; transform: translate(-50%, -50%);">
            <?php if (isset($_SESSION["msg"])) {
                echo "<p style='color:green;margin-block-end:0em;margin-block-start:0em;'>" . $_SESSION["msg"] . "</p>";
            } ?>
            <?php if (isset($_SESSION["error"])) {
                echo "<p style='color:red;margin-block-end:0em;margin-block-start:0em;'>" . $_SESSION["error"] . "</p>";
            } ?>
        </div>
    </article>
</body>
</html>