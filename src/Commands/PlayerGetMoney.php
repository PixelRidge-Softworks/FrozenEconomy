<?php

declare(strict_types=1);

namespace IcyEndymion004\FrozenEconomy\Commands;

use pocketmine\command\Command;
use IcyEndymion004\FrozenEconomy\Economy;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use IcyEndymion004\FrozenEconomy\Loader;
use pocketmine\plugin\PluginOwned;

final class PlayerGetMoney extends Command implements PluginOwned {

    public function __construct() {
        parent::__construct("getmoney", "Shows a players money", null, ['getbal', "seebal", "seemoney"]);
        $this->setPermission("player.base.frozen.economy");
        $this->setUsage("§8§l[§r§4*§8§l]§r§9 Frozen§1Economy §8§l[§r§4*§8§l]§r Usage: /seemoney {player}");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $prefix = "§8§l[§r§4*§8§l]§r§9 Frozen§1Economy §8§l[§r§4*§8§l]§r ";
        if(!$this->testPermission($sender)) {
        $sender->sendMessage($prefix . "§cYou do not have the permission to use this command.");
        return;
        }
        if(!isset($args[0])){
        $sender->sendMessage($prefix . "§cPlease Specify a players name.");
        return;
        }
        $api = $this->getAPI();
        $money = $api->getMoney($args[0]);
        $money = strval($money);
        $sender->sendMessage($prefix . "§a" . $args[0] . " Has " .$money . "$");


    }

    /**
     * @return Economy
     * gets into the economy API
     */
    public function getAPI(): Economy{
    return Loader::get()->API();
    }
    /**
     * @return Plugin
     */
    public function getOwningPlugin(): Plugin {
        return Loader::get();
    }
}