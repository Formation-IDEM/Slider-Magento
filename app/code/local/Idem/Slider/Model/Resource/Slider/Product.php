<?php
class Idem_Slider_Model_Resource_Slider_Product extends Mage_Core_Model_Resource_Db_Abstract 
{
    protected function  _construct(){
        $this->_init('slider/slider_product', 'rel_id');
    }
    public function saveSliderRelation($slider, $data)
    {
        if (!is_array($data))
        {
            $data = array();
        }
        $deleteCondition = $this->_getWriteAdapter()->quoteInto('slide_id=?', $slider->getId());
        $this->_getWriteAdapter()->delete($this->getMainTable(), $deleteCondition);

        foreach($data as $productId => $info)
        {
            $this->_getWriteAdapter()->insert($this->getMainTable(), array(
                'slide_id'      => $slider->getId(),
                'product_id'     => $productId,
                'position'      => @$info['position']
            ));
        }
        return $this;
    }
}