<?php 
/**
* 
*/
class Idem_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
		//echo mage::getStoreConfig('slider_section/slider_group/vitesse_select');
		//echo mage::getStoreConfig('slider_section/slider_group/pause_select');
	}

}
?>