<?php

namespace IcyEndymion004\FrozenEconomy;

use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;
use IcyEndymion004\FrozenEconomy\Loader;

class EventHandler implements Listener{

    /**
     * Adds the player when they join to add them to the config file
     */
     public function onJoin(PlayerJoinEvent $ev): void{
     $player = $ev->getPlayer();
     $ign = $player->getName();
     $config = Loader::getEconomy();
     $startingamount = Loader::get()->getConfig()->get("startingamount");
     if(!$config->exists($ign)){
     $config->set($ign, $startingamount);
     $config->save();
     }else{
     }
}
}