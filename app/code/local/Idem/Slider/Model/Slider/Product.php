<?php
class Idem_Slider_Model_Slider_Product extends Mage_Core_Model_Abstract 
{
    protected function _construct()
    {
        $this->_init('slider/slider_product');
    }
    public function saveSliderRelation($slider)
    {
        $data = $slider->getProductsData();
        if (!is_null($data))
        {
            $this->_getResource()->saveSliderRelation($slider, $data);
        }
        return $this;
    }
    public function getProductCollection($slider)
    {
        $collection = Mage::getResourceModel('slider/slider_product_collection')
            ->addSliderFilter($slider);
        return $collection;
    }
}