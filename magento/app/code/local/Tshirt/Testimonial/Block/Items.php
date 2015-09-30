<?php
/**
* 
*/
class Tshirt_Testimonial_Block_Items extends Mage_Core_Block_Template
{
	
	public function getItems()
	{

		$items = Mage::getModel("testimonial/testimonial")->getCollection();

		return $items;

	}
}