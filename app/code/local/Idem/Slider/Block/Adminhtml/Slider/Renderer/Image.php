<?php 
class Idem_Slider_Block_Adminhtml_Slider_Renderer_Image extends Varien_Data_Form_Element_Image
{
    //make your renderer allow "multiple" attribute
    public function getHtmlAttributes()
    {
        return array_merge(parent::getHtmlAttributes(), array('multiple'));
    }
}