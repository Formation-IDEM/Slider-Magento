<?php
class Idem_Testimonial_Model_Testimonial extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		//Nom du module et nom du model
		$this->_init("testimonial/testimonial");
	}
	
	public function approvedTestimonial($nb)
	{
		$modelid = $this->getData('testimonial_id');
		
		$resource = Mage::getSingleton('core/resource');
 
		$writeConnection = $resource->getConnection('core_write');
		 
		$table = $resource->getTableName('testimonial/testimonial');

		$query = "UPDATE ".$table." SET is_validate = ".$nb." WHERE testimonial_id = ".$modelid;
		
		$writeConnection->query($query);
		
		return $this;
	}
}