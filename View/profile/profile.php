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
    <title>YOUR PROFILE</title>
        <!-- LOGO INVICTUS -->
        <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css">
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
                    <a href="../news/news.php">NEWS</a>
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

    <div class="profile-container">

        <div class="profile-header">
            <img src= <?php echo $user->getImagePath() ?> alt="Foto de perfil">
            <h1>
                <?php echo $user->getNickname() ?>
            </h1>
            <?php if($user->getAdmin()==1){ ?>
                <form action="../../Controller/UserController.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="filePath">
                    <?php if (!isset($_FILES['fileToUpload']['name'])) { ?>
                    <input type="submit" value="Upload Image" name="upload_img" class="boton" style="margin-top:20px;">
                    <?php } ?>
                    <?php if (isset($_SESSION["error_msg"])) { ?>
                    <p style='color:red;'> <?php echo $_SESSION["error_msg"] ?></p>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
        <div class="profile-info">
        <h2>User information</h2>
            <div class="ancho">

                <div class="ancho2">
                    <p> <strong> ID: </strong>
                        <?php echo $user->getId() ?>
                    </p>
                    <p> <strong> Name: </strong>
                        <?php echo $user->getUsername() ?>
                    </p>
                    <p> <strong> Surname: </strong>
                        <?php echo $user->getSurname() ?>
                    </p>
                    <p> <strong> Email: </strong>
                        <?php echo $user->getEmail() ?>
                    </p>
                </div>
                <div class="ancho2">
                    <p><strong> Nº Reviews: </strong>
                        <?php echo $user->getNumResenyas() ?>
                    </p>
                    <p><strong> Nº Events: </strong>
                        <?php echo $user->getNumTorneos() ?>
                    </p>
                    <p><strong> Nº Communities: </strong>
                        <?php echo $user->getNumComunidades() ?>
                    </p>
                    <p><strong> Nº Bans: </strong>
                        <?php echo $user->getNumBan() ?>
                    </p>
                </div>
            </div>

            <div>
                <h2>Description</h2>
                <p>
                    <?php echo $user->getDescription() ?>
                </p>
            </div>
        </div>

        <div class="profile-settings">
        <form action="../settings/settings.php" method="post" enctype="multipart/form-data">
                    <input type="submit" name="settings" value="Settings" style="text-transform:none;font-weight:normal;">
                </form>
        </div>

    </div>
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