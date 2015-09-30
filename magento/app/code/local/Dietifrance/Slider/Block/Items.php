<?php 

class Dietifrance_Slider_Block_Items extends Mage_Core_Block_Template{
	

	public function getItems(){
	
		//on récupère la collection d'Items
		$collection = Mage::getModel("slider/slider")->getCollection();
		return $collection;
	
	}
		
	public function getConfig(){
		
		$speed = Mage::getStoreConfig('slider/slider_group/speed_transition');
		$time = Mage::getStoreConfig('slider/slider_group/slide_time');
		
		$opt = "auto: true, speed: ".$speed.", pause: ".$time."";
		
		
		return $opt;
		
	}
	
}




