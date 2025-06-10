<?php 
require_once '../../Model/User.php';
session_start();
$user = $_SESSION['user'];
include '../../Model/Calendar.php';
$calendar = new Calendar();
$d = new DateTime("now");
$t = new DateTime("yesterday");
$today = $d->format('Y-m-d');
$tomorrow = $t->format('Y-m-d');
$calendar->add_event('Birthday', $today);
$calendar->add_event('Vacations', $tomorrow, 7, 'red');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALENDAR</title>
        <!-- LOGO INVICTUS -->
        <link rel="icon" type="image/png" href="../imagenes/src/logo_invictus-modified.png">
    <link rel="stylesheet" href="../stylesheet/stylesheet.css">
    <link href="../stylesheet/calendar.css" rel="stylesheet" type="text/css">
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
                    <a href="../news/news.php">NEWS</a>
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

		<div class="content home">
			<?=$calendar?>
		</div>



    
        <br>
        <div id="calendar-title">
            <h1><?php echo $d->format('l jS F Y'); ?></h1>
        </div>
                        <!--
        <div id="calendar">
            <table>
                <thead>
                    <tr>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div><p>
                    -->
        <div class="events">
            <h2 id = "event-h2">Events</h2>
            February 6th, 2024 - "League of Legends Championship Series (LCS)"<p>
            <li>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
            <li>Time: </li>
            <p>
                February 12th, 2024 - "Overwatch League (OWL) Tournament"
                <li>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Mollit anim id est laborum.</li>
                <li>Time: </li>
            <p>
                February 18th, 2024 - "Call of Duty League (CDL) Championship"
                <li>Description: Lorem ipsum dolor sit amet. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                <li>Time: </li>
            <p>
                February 25th, 2024 - "Dota 2 Major Tournament"
                <li>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
                <li>Time: </li>
            <p>
        </div>
    
    <footer>
        <div class="juntar">
            <form action="../contact/contact.html">
                <div class="juntar6">
                    <div class="center" id="ABOUT">
                        <h2 id="0">ABOUT US</h2>
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