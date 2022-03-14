<?php

declare(strict_types=1);

namespace IcyEndymion004\FrozenEconomy;

use IcyEndymion004\FrozenEconomy\Commands\PlayerGetMoney;
use IcyEndymion004\FrozenEconomy\Commands\PlayerSendMoney;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{

    /** @var self */
    private static $instance;

    /** @var Config */
    protected $economy;
    /** @var Economy */
    protected $api;

    public function onLoad() : void {
        self::$instance = $this;
        $this->api = new Economy();
    }
    public function onEnable(): void
    {
    $this->getLogger()->notice("This Plugin was created By IcyEndymion004 with partnership with pixelated Studio's");
    $this->registercommands();
    $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
    $this->economy = new Config($this->getDataFolder() . "economydata.yml", Config::YAML);
    }
    /**
     * gets the data file for the economy
     * @return Config
     */
    public static function getEconomy(): Config
    {
        return self::get()->economy;
    }

    /**
     * Returns a instance of loader
     * @return $this
     */
    public static function get() : self {
        return self::$instance;
    }

    public function registercommands(): void{
       # $this->getServer()->getCommandMap()->register("FrozenEconomy", new ());
       # $this->getServer()->getCommandMap()->register("FrozenEconomy", new ());
      #  $this->getServer()->getCommandMap()->register("FrozenEconomy", new ());
      #  $this->getServer()->getCommandMap()->register("FrozenEconomy", new ());
        //player commands
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new PlayerSendMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new PlayerGetMoney());
    }
    public function API() : Economy {
        return $this->api;
    }

}
