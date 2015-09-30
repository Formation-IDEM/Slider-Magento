<?php

class Idem_Testimonial_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_testimonial';
		$this->_blockGroup = 'testimonial';
		$this->_headerText = 'Gestion des témoignages';
		$this->_addButtonLabel = 'Ajouter un temoignage';
		parent::__construct();
	}
}
