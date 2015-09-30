<?php
class Idem_Testimonial_FormController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn()){
			$this->loadLayout();
			$this->renderLayout();
		}
		else 
		{
			$this->_redirect('customer/account/login/');
		}
	}
	
	public function submitAction()
	{
		$customer = Mage::helper('customer')->getCurrentCustomer();
		$customer_id = $customer->getId();
		$params = $this->getRequest()->getParams();
		$model = Mage::getModel("testimonial/testimonial")->setData($params, $customer_id);
		
		$model->save();
		$this->_redirect('testimonial/');
	}
}