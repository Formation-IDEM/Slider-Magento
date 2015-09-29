<?php
class Idem_Slider_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        //where is the controller
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'slider';
        //text in the admin header
        $this->_headerText = 'Gèrer vos slides';
        //value of the add button
        $this->_addButtonLabel = 'ajouter un slide';
        parent::__construct();
    }
    
}