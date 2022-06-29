<?php

namespace IcyEndymion004\FrozenEconomy\Commands;

use IcyEndymion004\FrozenEconomy\Economy;
use IcyEndymion004\FrozenEconomy\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\utils\TextFormat;

class PlayerTopMoney extends Command {

    public $plugin;

    public function __construct()
    {
        parent::__construct("topmoney", "Shows The players with the highest amount of money.", "/topmoney", ["topbal", "moneytop", "baltop"]);
        $this->setPermission("player.base.frozen.economy");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $prefix = "§8§l[§r§4*§8§l]§r§9 Frozen§1Economy §8§l[§r§4*§8§l]§r ";
        if(!$this->testPermission($sender)) {
            $sender->sendMessage($prefix . "§cYou do not have the permission to use this command.");
            return;
        }
        $top = Economy::getTopMoney();
        $place = 0;
        $sender->sendMessage($prefix . "§aTop Money");
        foreach ($top as $player => $money){
            if($place > 9){
                break;
            }
            $format = "§c" . ($place + 1) . ".§g $player §aWith§6 $money";
            $place = $place + 1;
            $sender->sendMessage($format);
        }
    }
}