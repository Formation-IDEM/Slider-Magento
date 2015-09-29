<?php

class Idem_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$this->loadLayout();
	    	$this->renderLayout();
		}
	}
}