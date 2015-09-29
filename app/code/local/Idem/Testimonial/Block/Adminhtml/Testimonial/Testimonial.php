<?php

class Idem_Testimonial_Block_Adminhtml_Testimonial_Testimonial extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'idem_testimonial';
        $this->_controller = 'adminhtml_testimonial_testimonial';
        $this->_headerText = 'lol';

        parent::__construct();
        $this->_removeButton('add');
    }
}