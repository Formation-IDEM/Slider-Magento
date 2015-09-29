<?php
class Idem_Slider_Helper_Product extends Idem_Slider_Helper_Data
{
    /**
     * get the selected articles for a product
     * @access public
     * @param Mage_Catalog_Model_Product $product
     * @return array()
     * 
     */
    public function getSelectedSliders(Mage_Catalog_Model_Product $product){
        if (!$product->hasSelectedArticles()) {
            $articles = array();
            foreach ($this->getSelectedSlidersCollection($product) as $article) {
                $articles[] = $article;
            }
            $product->setSelectedSliders($articles);
        }
        return $product->getData('selected_sliders');
    }
    /**
     * get article collection for a product
     * @access public
     * @param Mage_Catalog_Model_Product $product
     * @return Easylife_Press_Model_Resource_Article_Collection
     */
    public function getSelectedSlidersCollection(Mage_Catalog_Model_Product $product){
        $collection = Mage::getResourceSingleton('slider/slider_collection')
            ->addProductFilter($product);
        return $collection;
    }
}