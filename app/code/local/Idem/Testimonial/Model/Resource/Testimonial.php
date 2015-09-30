<?php

/**
 *  Testimonial.php
 *  ------------
 * @created at : 17/09/15
 */
class Idem_Testimonial_Model_Resource_Testimonial extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('testimonial/testimonial', 'testimonial_id');
    }
}