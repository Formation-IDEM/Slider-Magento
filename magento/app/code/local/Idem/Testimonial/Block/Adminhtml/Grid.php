<?php 

class Idem_Testimonial_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container {
	
	
	public function __construct()
	{
		//on appelle le controller	
		$this->_controller = 'adminhtml_testimonial';
		//on appelle le block testimonial
		$this->_blockGroup = 'testimonial';
		//titre du module
		$this->_headerText = 'Gestion des temoignages';
		$this->_addButtonLabel = 'ajouter un temoignage';
		parent::__construct();
	}
	
	
}
