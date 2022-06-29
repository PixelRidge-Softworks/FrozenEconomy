<?php

namespace IcyEndymion004\AspiredGangs\Commands\SubCommands\Admin;

use IcyEndymion004\FrozenEconomy\Economy;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class AdminClearPlayerMoney extends Command {

    public function __construct()
    {
        parent::__construct("clearmoney", "Allows Admins to clear a player's money", "/clearmoney (player)", ["wipemoney", "wipebal", "clearbal"]);
        $this->setPermission("admin.base.frozen.economy");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $prefix = "§8§l[§r§4*§8§l]§r§9 Frozen§1Economy §8§l[§r§4*§8§l]§r ";
        if(!$this->testPermission($sender)) {
            $sender->sendMessage($prefix . "§cYou do not have the permission to use this command.");
            return;
        }
        if(count($args) == 1){
            $sender->sendMessage($prefix . $this->getUsage());
            return;
        }
        if(!is_string($args[0])){
            $sender->sendMessage($prefix . $this->getUsage());
            return;
        }
        Economy::clearMoney($args[0]);
        $player = $args[0];
        $sender->sendMessage($prefix . "You cleared $player money");

    }
}