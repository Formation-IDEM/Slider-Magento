<?php 
	/**
	* 
	*/
	class Tshirt_Test_Block_Products extends Mage_Core_Block_Template
	{

		protected $category_id;

		public function getProducts()
		{
			$category = Mage::getModel('catalog/category')->load($this->category_id);
			// var_dump($category);
			return $category->getProductCollection()
			->addAttributeToSelect('*');
		}

		public function setCategoryId($id)
		{
			$this->category_id = $id;
		}

		
	}