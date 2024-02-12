<?php
namespace App\Component;

/**
 * Class qui gère les cartes.
 */
class Card
{
    public $id;
    public $visible;
    // False = recto / true = visible
    public $value;
    public $even;
    // False =  / true = paire validée
    public $art;
    public function __construct($card = null)
    {
        $this->id = $card->id ?? 0;
        $this->visible = $card->visible ?? false;
        $this->even = $card->even ?? false;
        $this->art = $card->art ?? 0;
        $this->value = $card->value ?? 0;
    }

}
