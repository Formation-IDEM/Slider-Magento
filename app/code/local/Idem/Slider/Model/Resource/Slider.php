<?php

class Idem_Slider_Model_Resource_Slider extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
		$this->_init('slider/slider', 'slide_id');
	}

}