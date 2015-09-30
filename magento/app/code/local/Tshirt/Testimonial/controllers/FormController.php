<?php 
/**
* 
*/
class Tshirt_Testimonial_FormController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$this->loadLayout();
			$this->renderLayout();
		}
		else
		{
			$this->_redirect('customer/account/login');
		}
		
	}

	public function submitAction()
	{
		$params = $this->getRequest()->getParams();
		$date = date('Y-m-d H:i:s');
		$customerId = Mage::getSingleton('customer/session')->getCustomerGroupId();
		$params['customer_id'] = $customerId;
		$params['created_time'] = $date;

		$formulaire = Mage::getModel('testimonial/testimonial');

		$formulaire
		->setData($params)
		->save();

		$this->_redirect('testimonial/index/index');
	}
}
?>