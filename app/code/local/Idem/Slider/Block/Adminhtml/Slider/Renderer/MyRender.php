<?php

class Idem_Slider_Block_Adminhtml_Slider_Renderer_MyRender extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value =  $row->getData($this->getColumn()->getIndex());
    	$customer = Mage::getModel('customer/customer')->load($value);
    	$url = Mage::helper('adminhtml')->getUrl('adminhtml/customer/edit/index/id',array('id'=>$value));
		return '<a href="'.$url.'">'.ucwords($customer->getName()).'</a>';
    }
}