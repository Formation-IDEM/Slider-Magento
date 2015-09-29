<?php
class Idem_Testimonial_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // where is the controller
        $this->_controller = 'adminhtml_testimonial';
        $this->_blockGroup = 'testimonial';

        // text in the admin header
        $this->_headerText = 'Gestion des témoignages';

        // value of the add button
        $this->_addButtonLabel = 'Ajouter un témoignage';
        parent::__construct();
    }
}