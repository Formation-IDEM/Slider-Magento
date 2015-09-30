<?php

class Tshirt_Slider_Model_Optionpause
{
    public function toOptionArray()
    {
        return array(
            array('value' => 6000, 'label'=>Mage::helper('adminhtml')->__('Lent')),
            array('value' => 400, 'label'=>Mage::helper('adminhtml')->__('Normal')),
            array('value' => 20, 'label'=>Mage::helper('adminhtml')->__('Rapide'))
        );
    }
}
