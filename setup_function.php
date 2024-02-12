<?php

use App\Component\Card;

function setCards($number)
/** Création des cartes */
{
    $a = 1;
    $cards = array();
    for ($i = 1; $i <= $number; $i++) {
        $cards[$a] = new Card();
        $cards[$a]->value = $i;
        $cards[$a]->id = $a;
        $cards[$a]->art = "<img src='./assets/card-" . $i . ".png'/>";
        $a++;
        $cards[$a] = new Card();
        $cards[$a]->value = $i;
        $cards[$a]->id = $a;
        $cards[$a]->art = "<img src='./assets/card-" . $i . ".png'/>";
        $a++;
    }
    return $cards;
}

function display($cardIteration)
/** Affiche les cartes */
{
    if ($cardIteration->visible == false) {
        echo "<form action='index.php' method='post'>
        <input name='id' id='id' type='hidden' value='" . $cardIteration->id . "' />
        <input name='value' id='value' type='hidden' value='" . $cardIteration->value . "' />
        <button type='submit' class='cards' name='click'><img src='./assets/back-card.png'/></button>
        </form>";
    } elseif ($cardIteration->visible == true or $cardIteration->even == true) {
        echo $cardIteration->art;
    }
}

function tryCounter()
/** Compte le nombre de tentatives */
{
    if (isset($_POST["click"])) {
        $_SESSION["click"]++;
        if ($_SESSION["click"] == 2) {
            $_SESSION["try"]++;
            $_SESSION["click"] = 0;
        }
    }
}

function clickSession()
/** Ajoute la première et la seconde carte dans la session */
{
    if (isset($_POST["click"])) {
        if ($_SESSION["returnF"][0] == 0) {
            $_SESSION["returnF"][0] = $_POST["id"];
            $_SESSION["returnF"][1] = $_POST["value"];
        } else {
            $_SESSION["returnS"][0] = $_POST["id"];
            $_SESSION["returnS"][1] = $_POST["value"];
        }
    }
}

function delVar()
/** Remet les cartes visibles à 0 et recharge la page */
{
    if ($_SESSION["returnS"][0] != 0) {
        $_SESSION["returnF"][0] = 0;
        $_SESSION["returnF"][1] = 0;
        $_SESSION["returnS"][0] = 0;
        $_SESSION["returnS"][1] = 0;
        header("Refresh:0.5");
    }
}

function reverse($card)
/** Rend visible les deux premières cartes choisies */
{
    if ($card->even == true or $card->id == $_SESSION["returnF"][0] or $card->id == $_SESSION["returnS"][0]) {
        $card->visible = true;
    } else {
        $card->visible = false;
    }
}

function evenCounter()
/** Détecte les paire et les enregistres */
{
    if ($_SESSION["returnF"][0] != 0 and $_SESSION["returnF"][1] == $_SESSION["returnS"][1]) {
        $_SESSION["even"]++;
        $f = $_SESSION["returnF"][1];
        foreach ($_SESSION["cards"] as $card) {
            if ($card -> value == $f) {
                $card -> even = true;
            }
        }
    }
}

function score($start, $end, $try)
/** Calcul le score */
{
    $score = $end - $start;
    $score = 1000 - $score;
    $score = $score - $try * 3;
    return $score;
}

function victory()
/** Conditions de victoire */
{
    if (isset($_SESSION["even"])){
        if ($_SESSION["even"] ==6)
    {$_SESSION["victory"]=true;}}
}