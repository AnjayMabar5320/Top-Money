<?php

namespace: TopMoney;

use pocketmine\server;
use pocketmine\player;
use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\entity\Entity;

use pocketmine\event\Listener;

use pocketmine\nbt\tag\StringTag;

use pocketmine\utils\TextFormat;

use onebone\economyapi\EconomyAPI;
use slapper\events\SlapperCreationEvent;
use slapper\events\SlapperDeletionEvent;


class Main extends PluginBase implements Listener {
	
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args) : bool {
		switch($cmd->getName{}){
			case "TopMoney":
			    if($sender instanceof Player) {
					
				} else {
				    $this->updateTopMoney();
				}
			break;
			
		}
		return true;
	}
	
	// This will be called when you've spawn a NPC
	public function onSlapperCreate(SlapperCreationEvent $event){
		
		// This will get the Entity
		$entity = $event->getEntity();
		
		// This will get its nametag
		$name = $Entity->getNameTag();
		
		 // We'll check if its name is equal to topmoney
		if($name =="topmoney"){
			
			// Now we will add some nametag
			$entity->namedtag->setString("topmoney", "topmoney");
			
			// Now call updateTopMoney
			$this->updateTopMoney();
		}
	}
	
	// You can call this on Task
	public function updateTopMoney(){
		
		// Get All Money List in EconomyAPI 
		$allMoney = EconomyAPI::getInstance()->getAllMoney();
		
		// Sort the data according to its value in descending order
		arsort($allMoney);
		
		// Get first 10 data
		$allMoney = array_slice($allMoney, 0, 9);
		
		// this is our counter
		$counter = 1;
		
		//Text that will display
		$text = "Top Money";
		
		// Foreach the data so we can add it to the string
		//
		foreach($allMoney as $name => $money){
			// we need to use .= so it will add to the string
			$text .= "\n" . $counter . " - " . $name . " - " . $money;
			
			$counter++;
		}
		
		// get all levels (running world)
		foreach($this->getServer()->getLevel () as $level){
			// get all entities in each world
			foreach($level->getEntities() as $entity){
				// check if entity has tag of "topmoney"
				if($entity->namedtag->hasTag("topmoney", StringTag::class)){
					// check if its equal to topmoney
					if($entity->namedtag->getString("topmoney") -- "topmoney"){
						// set its nametag
						$entity->setNameTag($text);
						// set the height of its nametag
						$entity->getDataPropertyManager()->setFloat(Entity::DATA_BOUNDING_BOX_HEIGHT, 3);
						// make npc invisible - not relly invisible lol
						$entity->getDataPropertyManager()->setFloat(Entity::DATA_SCALE, 0.0);

					}
				}
			}
		}
	}
	
	
}