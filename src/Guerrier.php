<?php

require_once 'Character.php';

// extends pour hériter de la class Character
class Guerrier extends Character
{

    // Attributs privés
    private string $weapon;
    private int $weaponDamage;
    private string $shield;
    private int $shieldValue;

    // GETTERS
    public function getWeapon()
    {
        return $this->weapon;
    }

    public function getweaponDamage()
    {
        return $this->weaponDamage;
    }

    public function getShield()
    {
        return $this->shield;
    }

    public function getshieldValue()
    {
        return $this->shieldValue;
    }


    // SETTERS
    public function setWeapon(string $weapon)
    {
        $this->weapon = $weapon; // ça va mettre en place la valeur de weapon
    }

    public function setweaponDamage(int $weaponDamage)
    {
        $this->weaponDamage = $weaponDamage; // ça va mettre en place la valeur de weaponDamage
    }

    public function setShield(string $shield)
    {
        $this->shield = $shield; // ça va mettre en place la valeur de shield
    }

    public function setshieldValue(int $shieldValue)
    {
        $this->shieldValue = $shieldValue; // ça va mettre en place la valeur de shieldValue
    }

    // Fonction lancée directement
    public function __construct(int $health, int $mana, string $weapon, int $weaponDamage, string $shield, int $shieldValue)
    {
        parent::__construct($health, $mana); // On fais le construct de Character et on ajoute sa valeur
        $this->setWeapon($weapon);
        $this->setweaponDamage($weaponDamage);
        $this->setShield($shield);
        $this->setshieldValue($shieldValue);

    }

    // Fonction pour voir les dégats de l'arme
    public function attack(): int
    {
        return $this->getweaponDamage();
    }



    // Fonction pour calculer les dégâts subis en tenant compte de la valeur du bouclier
    public function getDamage(int $damage)
    {
        // $realDamage = $damage - $this->getshieldValue();
        // if ($realDamage > 0) {
        // $this->setHealth($this->getHealth() - $realDamage);
        // }

        $damageReceived = max(0, $damage - $this->getshieldValue());
        $this->setHealth($this->getHealth() - $damageReceived);
        return $damageReceived;
    }
}
