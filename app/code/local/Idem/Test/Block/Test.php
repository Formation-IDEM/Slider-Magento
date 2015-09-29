<?php

class Idem_Test_Block_Test extends Mage_Core_Block_Template
{
	public function getProducts()
	{
		if(Mage::registry('current_category'))
		{
			$this->category_id = Mage::registry('current_category')->getId();
		}

		$products = Mage::getModel('catalog/category')
		->load($this->category_id)
		->getProductCollection()
		->addAttributeToFilter('visibility', 4)
		->addAttributeToSelect('*');

		return	$products;
	}

	public function setCategoryId($id)
	{
		$this->category_id = $id;
	}
}