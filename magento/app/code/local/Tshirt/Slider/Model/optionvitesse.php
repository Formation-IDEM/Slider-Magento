<?php

class Tshirt_Slider_Model_Optionvitesse
{
    public function toOptionArray()
    {
        return array(
            array('value' => 800, 'label'=>Mage::helper('adminhtml')->__('Lent')),
            array('value' => 500, 'label'=>Mage::helper('adminhtml')->__('Normal')),
            array('value' => 200, 'label'=>Mage::helper('adminhtml')->__('Rapide'))
        );
    }
}
