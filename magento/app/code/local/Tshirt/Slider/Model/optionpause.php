<?php

class Tshirt_Slider_Model_Optionpause
{
    public function toOptionArray()
    {
        return array(
            array('value' => 600, 'label'=>Mage::helper('adminhtml')->__('Lent')),
            array('value' => 400, 'label'=>Mage::helper('adminhtml')->__('Normal')),
            array('value' => 200, 'label'=>Mage::helper('adminhtml')->__('Rapide'))
        );
    }
}
