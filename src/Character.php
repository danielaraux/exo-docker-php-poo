<?php
class Character
{
    // On définis nos attributs privés
    // Pour dire que ça sera accessible uniquement depuis la classe, int pour dire qu'ils sont en intéger seulement (chiffres)
    private int $health;
    private int $mana;


    // Getter health (toujours en public, même si on ne le met pas, ça sera public par défaut)
    // Getter pour obtenir des informations
    public function getHealth()
    {
        return $this->health; // ça va retourner la valeur de health
    }

    // Getter mana
    public function getMana()
    {
        return $this->mana; // ça va retourner la valeur de mana
    }

    // Setter health
    // Setter pour mettre en place les informations
    public function setHealth(int $health)
    {
        $this->health = $health; // ça va mettre en place la valeur de health
    }

    // Setter mana
    public function setMana(int $mana)
    {
        $this->mana = $mana; // ça va mettre en place la valeur de mana
    }

    // Fonction lancée directement
    public function __construct(int $health, int $mana)
    {
        $this->setHealth($health);
        $this->setMana($mana);
    }
}
