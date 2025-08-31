<?php

require_once 'Character.php';

class Orc extends Character
{
    private int $damageMin;
    private int $damageMax;

    // GETTERS
    public function getdamageMin()
    {
        return $this->damageMin;
    }

    public function getdamageMax()
    {
        return $this->damageMax;
    }


    // SETTERS
    public function setdamageMin(int $damageMin)
    {
        $this->damageMin = $damageMin; // ça va mettre en place la valeur de damageMin
    }

    public function setdamageMax(int $damageMax)
    {
        $this->damageMax = $damageMax; // ça va mettre en place la valeur de damageMax
    }



    // Fonction lancée directement
    public function __construct(int $health, int $mana, int $damageMin, int $damageMax)
    {
        parent::__construct($health, $mana); // On fais le construct de Character et on ajoute sa valeur
        $this->setdamageMin($damageMin);
        $this->setdamageMax($damageMax);
    }

    // Fonction qui retourne un nombre aléatoire entre damageMin et damageMax
    public function attack(): int
    {
        return rand($this->getdamageMin(), $this->getdamageMax());
    }


    public function getDamageOrc(int $damage)
    {
        $newHealth = $this->getHealth() - $damage;
        $this->setHealth($newHealth);
        return $newHealth;
    }
}
