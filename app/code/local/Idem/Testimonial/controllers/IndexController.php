<?php

class Idem_Testimonial_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$this->loadLayout();
	    	$this->renderLayout();
		}
	}

	public function showAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$this->loadLayout();
			$this->_initLayoutMessages('core/session');
	    	$this->renderLayout();
	    }
	}
}