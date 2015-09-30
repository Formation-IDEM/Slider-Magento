<?php

/**
 * Class Idem_Test_Block_Test
 */
class Idem_Test_Block_Test extends Mage_Core_Block_Template
{
    private $_defaultCategory = 4;

    protected $_products;
    protected $_category;
    protected $_categoryId;
    protected $_categoryProducts;

    /**
     * Retourne les informations d'une catégorie
     *
     * @return Mage_Core_Model_Abstract
     */
    public function getCategory()
    {
        $load = ( !$this->_categoryId ) ? $this->_defaultCategory : $this->_categoryId;
        if( (!$this->_category) ) {
            $this->_category = Mage::getModel('catalog/category')
                ->load($load);
        }
        return $this->_category;
    }

    /**
     * Définit une ID de catégorie
     *
     * @param $categoryId
     */
    public function setCategory($categoryId)
    {
        $this->_categoryId = $categoryId;
    }

    /**
     * Retourne la liste des produits d'une catégorie
     *
     * @return mixed
     */
    public function getCategoryProducts()
    {
        if( !$this->_categoryProducts ) {
            $this->_categoryProducts = Mage::getModel('catalog/category')
                ->load($this->getCategory()->getId())
                ->getProductCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToSort('created_at', 'DESC')
                ->setPageSize(5)
                ->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);
        }
        return $this->_categoryProducts;
    }

    /**
     * Retourne la liste des 5 derniers produits visibles
     *
     * @return mixed
     */
    public function getProducts()
    {
        if( !$this->_products ) {
            $this->_products = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToSort('created_at', 'DESC')
                ->setPageSize(5)
                ->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);
        }
        return $this->_products;
    }

    public function getCommentsByProductId($productId)
    {
        $comments = Mage::getModel('review/review')
            ->getResourceCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addEntityFilter('product', $productId)
            ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
            ->setDateOrder()
            ->addRateVotes();

        return $comments;
    }

    public function getRatingByComment($comment)
    {
        $avg = 0;
        $rating = [];
        foreach( $comment->getRatingVotes() as $vote )
        {
            $rating[] = $vote->getPercent();
        }
        $avg += array_sum($rating) / count($rating);
        return $avg;
    }
}