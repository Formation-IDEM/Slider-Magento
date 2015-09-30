<?php
class Idem_Test_Block_Products extends Mage_Core_Block_Template
{
	protected $_categoryId = 0;
	
 	public function getProducts()
	{
		$category = Mage::getModel('catalog/category')->load($this->_categoryId);

		$products = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect('*')
            ->addCategoryFilter($category);
			
		return $products;
	}
	
	public function setId($id)
	{
		$this->_categoryId = $id;
		return $this;
	}
}