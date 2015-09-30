<?php

class Tshirt_Slider_Model_Optionvitesse
{
    public function toOptionArray()
    {
        return array(
            array('value' => 8000, 'label'=>Mage::helper('adminhtml')->__('Lent')),
            array('value' => 500, 'label'=>Mage::helper('adminhtml')->__('Normal')),
            array('value' => 20, 'label'=>Mage::helper('adminhtml')->__('Rapide'))
        );
    }
}
