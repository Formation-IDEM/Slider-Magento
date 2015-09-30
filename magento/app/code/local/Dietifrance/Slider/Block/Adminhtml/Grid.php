<?php 

class Dietifrance_Slider_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container {
	
	
	public function __construct()
	{
		//on appelle le controller	
		$this->_controller = 'adminhtml_slider';
		//on appelle le block slider
		$this->_blockGroup = 'slider';
		//titre du module
		$this->_headerText = 'Gestion des slides';
		$this->_addButtonLabel = 'ajouter un slide';
		parent::__construct();
	}
	
	
}