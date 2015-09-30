<?php 
/**
* 
*/
class Tshirt_Testimonial_Model_Testimonial extends Mage_Core_Model_Abstract
{
	
	public function _construct()
	{
		$this->_init("testimonial/testimonial");
	}

	public function approuveTestimonial()
	{
        $testimonialId = $this->getData('testimonial_id');
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write'); 
        $table = $resource->getTableName('testimonial/testimonial');
        $query = "UPDATE ".$table." SET is_validate = 1 WHERE testimonial_id = ".$testimonialId;
        $writeConnection->query($query);
        return $this;
    }

}

?>