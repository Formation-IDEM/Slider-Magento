<?php

class Idem_Slider_Block_Slider extends Mage_Core_Block_Template
{
	public function test()
	{
		return 'test achevé';
	}

	public function show()
	{
		return 'slider';
	}

	public function getSlides()
	{
		return Mage::getModel('slider/slider')->getCollection()->addFieldToFilter('active', true);
	}
}