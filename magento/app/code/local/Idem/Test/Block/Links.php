<?php

class Idem_Test_Block_Links extends Mage_Checkout_Block_Links
{ 

	
	public function addTestLink(){
		
		$parentBlock = $this->getParentBlock();
		
		if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Idem_Test')) {
			
			$text = $this->__("Testez Moi");
			$parentBlock->addLink($text, 'test/index', $text, true, array(), 50, null, 'class="top-link-test"');
		
        }
		
		return $this;
		
	}
	
	public function addItemLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $count = $this->getSummaryQty() ? $this->getSummaryQty()
                : $this->helper('checkout/cart')->getSummaryCount();
            if ($count == 1) {
                $text = $this->__('Items (%s item)', $count);
            } elseif ($count > 0) {
                $text = $this->__('Items (%s items)', $count);
            } else {
                $text = $this->__('Items');
            }

            $parentBlock->removeLinkByUrl($this->getUrl('checkout/cart'));
            $parentBlock->addLink($text, 'test/index', $text, true, array(), 50, null, '');
        }
        return $this;
    }

	public function addCartLink()
	    {
	        $parentBlock = $this->getParentBlock();
	        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
	            $count = $this->getSummaryQty() ? $this->getSummaryQty()
	                : $this->helper('checkout/cart')->getSummaryCount();
	            if ($count == 1) {
	                $text = $this->__('My Cart (%s item)', $count);
	            } elseif ($count > 0) {
	                $text = $this->__('My Cart (%s items)', $count);
	            } else {
	                $text = $this->__('My Cart');
	            }
	
	            $parentBlock->removeLinkByUrl($this->getUrl('checkout/cart'));
	            $parentBlock->addLink($text, 'checkout/cart', $text, true, array(), 50, null, 'class="top-link-cart"');
	        }
	        return $this;
	    }
}
