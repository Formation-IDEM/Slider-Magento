<?php

class Idem_Testimonial_FormController extends Mage_Core_Controller_Front_Action {
	
	public function indexAction(){
		
	
		
		$this->loadLayout();
		
		$this->renderLayout();
		
	}
	
	public function submitAction(){
		
		$params=$this->getRequest()->getParams();
		
		echo $params['id'];
		
		$model = Mage::getModel("testimonial/testimonial");
		$model->load('testimonial_id');
		$model->setTitre($_POST['titre']);
		$model->setMessage($_POST['message']);
		
		$model->save();
		
		$this->_redirect('testimonial/index/index');
	}
	
}