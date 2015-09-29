<?php

class Idem_Testimonial_Model_Resource_Testimonial_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
    {
            $this->_init('testimonial/testimonial');
    }
}