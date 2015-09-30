<?php 
/**
* 
*/
class Tshirt_Slider_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	
	public function __construct()
	{
		$this->_controller = 'adminhtml_slider';
		$this->_blockGroup = 'slider';
		$this->_headerText = 'Gestion des sliders';
		$this->_addButtonLabel = 'Ajouter des images';
		parent::__construct();
	}
}


 ?>