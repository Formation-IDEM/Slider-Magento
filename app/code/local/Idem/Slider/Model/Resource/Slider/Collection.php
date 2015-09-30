<?php
/**
 *  Collection.php
 *  ------------
 * @created at : 21/09/15
 */

class Idem_Slider_Model_Resource_Slider_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('slider/slider');
    }
}

/*
**  End Of File
*/