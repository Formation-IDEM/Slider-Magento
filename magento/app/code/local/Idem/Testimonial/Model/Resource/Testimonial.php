<?php
class Idem_Testimonial_Model_Resource_Testimonial extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		//Nom du module et nom du model, id
		$this->_init("testimonial/testimonial", "testimonial_id");
	}
}