<?php

class Idem_Slider_Block_Adminhtml_Slider_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'idem_slider';
        $this->_controller = 'adminhtml_slider_slider';
        $this->_headerText = 'lol';

        parent::__construct();
        $this->_removeButton('add');
    }
}