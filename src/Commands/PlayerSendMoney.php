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

final class PlayerSendMoney extends Command implements PluginOwned {


    public function __construct() {
        parent::__construct("pay", "Shows a players money", null, ["paymoney", "sendmoney"]);
        $this->setPermission("player.base.frozen.economy");
        $this->setUsage("§8§l[§r§4*§8§l]§r§9 Frozen§1Economy §8§l[§r§4*§8§l]§r Usage: /paymoney {player} {amount}");
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
        if(!isset($args[1])){
            $sender->sendMessage($prefix . "§cPlease Specify a amount");
        }
        $api = $this->getAPI();
        $yourmoney = $api->getMoney($sender->getName());
        if($yourmoney > $args[1]){
        $api->removeMoney($sender->getName(), intval($args[1]));
        $api->addMoney($args[0], intval($args[1]));
        $sender->sendMessage($prefix . "§aYou sent" . $args[0] . " " . $args[1] . "$ Money");
        }else{
        $sender->sendMessage($prefix . "§c You do not have that much money");
        }




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
