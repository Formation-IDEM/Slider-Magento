<?php

class Idem_Test_Block_Products extends Mage_Core_Block_Template{
	
	protected $_cat = 0;
	protected $_prod = 0;
	
	public function getProducts(){
					
		$category = Mage::getModel('catalog/category')->load($this->_cat);
	
		$products = Mage::getResourceModel('catalog/product_collection')
	            ->addAttributeToSelect('*')
	            ->addCategoryFilter($category);
	
		return $products;	
		
	}
	
	public function setCategoryId($id){
		
	$this->_cat = $id;
	
	return $this;
		
		
		
	}
	
	
	public function showReviews($id){
		
		$review = Mage::getModel('review/review')->getCollection()
        ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED);
		
		
	}
	
}


