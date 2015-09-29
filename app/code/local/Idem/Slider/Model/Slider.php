<?php

class Idem_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
	protected function _construct()
	{
		$this->_init('slider/slider');
	}

	protected $_productInstance = null;

	public function getProductInstance()
	{
	    if (!$this->_productInstance) 
	    {
	        $this->_productInstance = Mage::getSingleton('slider/slider_product');
	    }
	    return $this->_productInstance;
	}

	protected function _afterSave() 
	{
	    $this->getProductInstance()->saveSliderRelation($this);
	    return parent::_afterSave();
	}

	public function getSelectedProducts()
	{
	    if (!$this->hasSelectedProducts()) 
	    {
	        $products = array();
	        foreach ($this->getSelectedProductsCollection() as $product) 
	        {
	            $products[] = $product;
	        }
	        $this->setSelectedProducts($products);
	    }
	    return $this->getData('selected_products');
	}

	public function getSelectedProductsCollection()
	{
	    $collection = $this->getProductInstance()->getProductCollection($this);
	    return $collection;
	}
}