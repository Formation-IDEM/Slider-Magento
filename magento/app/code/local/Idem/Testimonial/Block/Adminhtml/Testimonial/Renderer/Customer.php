<?php
class Idem_Testimonial_Block_Adminhtml_Testimonial_Renderer_Customer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 
public function render(Varien_Object $row)
{
$value =  $row->getData($this->getColumn()->getIndex());
$cust = Mage::getModel('customer/customer')->load($value);
$url = Mage::helper('adminhtml')->getUrl('adminhtml/customer/edit/index/id',array('id'=>$value));
return '<a href="'.$url.'">'.ucwords($cust->getName()).'</a>';
 
}
 
}
?>