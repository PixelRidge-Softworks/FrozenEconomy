<?php

Namespace IcyEndymion004\FrozenEconomy;

use IcyEndymion004\FrozenEconomy\Loader;

class Economy
{
    /** @var Economy */
    protected $economy;


    /**
     * @param string $name
     * @param int $amount
     * @return void
     * sets the players money as the amount given
     */
    public static function setMoney(string $name, int $amount): void{
    $config = Loader::getEconomy();
    $player = $config->get($name);
    $current = $player;
    $config->set($name, $amount);
    $config->save();
    }

    /**
     * @param string $name
     * @return int
     * returns the amount of money the player has
     */
    public static function getMoney(string $name): int{
    $config = Loader::getEconomy();
    $amount = $config->get($name);

    return $amount;
    }

    /**
     * @param string $name
     * @param int $amount
     * @return void
     * Adds The set amount of money To the player
     */
    public static function addMoney(string $name, int $amount): void{
    $config = Loader::getEconomy();
    $now = $config->get($name);
    $math = $now + $amount;
    $config->set($name, $math);
    $config->save();
    }

    /**
     * @param string $name
     * @param int $amount
     * @return void
     * @throws \JsonException
     * Removes a players money
     */
    public static function removeMoney(string $name, int $amount): void{
    $config = Loader::getEconomy();
    $now = $config->get($name);
    $math = $now - $amount;
    $config->set($name, $math);
    $config->save();
    }

    /**
     * @param string $name
     * @return void
     * @throws \JsonException
     * Clears a players money to the starting amount
     */
    public static function clearMoney(string $name): void{
    $config = Loader::getEconomy();
    $startingamount = Loader::get()->getConfig()->get("startingamount");
    $config->set($name, $startingamount);
    $config->save();
    }




}
