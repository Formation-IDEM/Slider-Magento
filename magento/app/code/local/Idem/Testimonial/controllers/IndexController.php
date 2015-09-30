<?php
class Idem_Testimonial_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		Mage::getStoreConfig('testimonial_section/testimonial_group/testimonial_field');
		
		$this->loadLayout();
		$this->renderLayout();
	}
}