<?php

class Idem_Testimonial_FormController extends Mage_Core_Controller_Front_Action
{
	public function submitAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$session = Mage::getSingleton('core/session');
			
			$params = $this->getRequest()->getParams();
			if($params['title'] && $params['content'])
			{
				$testimonial = Mage::getModel('testimonial/testimonial')
					->setTitle($params['title'])
					->setContent($params['content'])
					->setCreatedTime(date('Y-m-d H:i:s'))
					->setCustomerId(Mage::getSingleton('customer/session')->getCustomer()->getId())
					->save();

				$session->addSuccess('Témoignage ajouté !');			
			}
			else
			{
				$session->addError('Avez-vous bien rempli tous les champs ?!');
			}

			$this->loadLayout();
			$this->_initLayoutMessages('core/session');
	    	$this->renderLayout();
	    }
	}

	public function indexAction()
	{
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$this->loadLayout();
	    	$this->renderLayout();
		}
	}
}