<?php

use App\Component\Card;

require_once(__DIR__ . "/vendor/autoload.php");
session_start();
include "setup_function.php";
victory();

?>

<!-- DOCTYPE ------------------------------------------------>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8" />
        <title>Memory</title>
        <meta name="author" content="Jessy Charlet" />
        <meta name="description" content="Memory" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="viewport" content="height=device-height, initial-scale=1.0" />
        <link rel="stylesheet" href="./style.css?t=<?= time(); ?>" />
    </head>
    <!-- BODY ------------------------------------------------>
    <body>
        <?php
    /** Lancement de la partie */
    if (isset($_POST["play"])) {
        session_unset();
        $cards = setcards(6);
        shuffle($cards);
        $_SESSION["try"] = 0;
        $_SESSION["even"] = 0;
        $_SESSION["click"] = 0;
        $_SESSION["play"] = true;
        $_SESSION["return"] = 0;
        $_SESSION["cards"] = $cards;
        $_SESSION["returnF"] = array(0,0);
        $_SESSION["returnS"] = array(0,0);
        $_SESSION["start"] = date("YmdHis");
    }
    /** Accueil bouton play */
    if(isset($_SESSION["victory"]) == true){
        $_SESSION["end"] = date("YmdHis");
        echo "<div class='flou'><img class='victory' alt='victoire' src='./assets/victory.png'>";
        echo "<div class='score'>". score($_SESSION['start'], $_SESSION['end'], $_SESSION['try']) ." <span>pts</span></div>";
        echo "<form action='index.php' method='post'>
        <button type='submit' class='button_play button_play_2' name='play'>Nouvelle partie</button>
        </form></div>";
        $_SESSION["victory"] = false;
    }
    /** Une fois que la partie est lancée */
    elseif (isset($_SESSION["play"])) {
        tryCounter();
        clickSession();
        echo "<div class='main'>";
        echo "<div class='infos'><a href='index.php'> <button type='submit' class='button_play button_play_reset button_play_accueil' name='play'>Accueil</button></a>
        <form action='index.php' method='post'>
        <button type='submit' class='button_play button_play_reset' name='play'>Relancer</button>
        </form></div>";
        echo "<div class='infos'>
        <h1>Memory</h1>
        <p><strong>Retournez deux cartes</strong>, si c'est une <strong>paire</strong>, vous la <strong>validez</strong>.
        Si ce sont deux cartes <strong>différentes</strong>, elle retournent <strong>face cachée</strong>.
        Vous <strong>gagnez</strong> la partie lorsque vous avez <strong>validé toutes les paires</strong>.</br>
        <strong>Score maximum 1000</br>- 1 par seconde écoulé - 3 par tentative</strong>.</p>
        </div>";
        echo "<div class='infos'><span><img src='./assets/actions.png'></span><div>" . $_SESSION["try"] . "</div></div>";
        echo "<div class='infos'><span><img src='./assets/paires.png'></span><div>" . $_SESSION["even"] . "<span> / 6</span></div></div>";
        echo "<div class='board'>";
        foreach ($_SESSION["cards"] as $card) {
            reverse($card);
            $cardIteration = new Card($card);
            display($cardIteration);
        }
        echo "</div>";
        echo "</div>";
        evenCounter();
        delVar();
    }
    /** Page d'accueil */
    else {
        echo "<form action='index.php' method='post'>
        <button type='submit' class='button_play' name='play'>Nouvelle partie</button>
        </form>";
    }
    ?>
    <footer>./ Jessy Charlet // $Job ['memory']</footer>
</body>

</html>