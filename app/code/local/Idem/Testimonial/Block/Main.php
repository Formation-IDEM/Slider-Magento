<?php

class Idem_Testimonial_Block_Main extends Mage_Core_Block_Template
{
	public function essai()
	{
		echo 'ceci est un essai';
	}

	public function getTestimonial()
	{
		$params = $this->getRequest()->getParams();
		//echo $params['id'];
		if(!$params['id'])
		{
			$session = Mage::getSingleton('core/session');
			$session->addError('Problème, pas d\'id ?');
			return;
		}
		else
		{
			$model = Mage::getModel('testimonial/testimonial')->load($params['id']);
			return $model;			
		}


		//$models = Mage::getModel('testimonial/testimonial')->getCollection();

		//$model->load($params['id']);
	}

	public function getTestimonials()
	{
		$testimonials = Mage::getModel('testimonial/testimonial')->getCollection();
		return $testimonials;
	}
}