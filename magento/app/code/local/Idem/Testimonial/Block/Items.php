<?php 

class Idem_Testimonial_Block_Items extends Mage_Core_Block_Template{
	

	public function getItems(){
	
		//on récupère la collection d'Items
		$collection = Mage::getModel("testimonial/testimonial")->getCollection();
		$collection->addFieldToFilter('is_validate','1');
		return $collection;
	
	}
		

	
}




