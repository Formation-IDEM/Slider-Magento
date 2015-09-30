<?php

class Dietifrance_Head_Block_Links extends Mage_Checkout_Block_Links
{ 

	
	public function addGuideLink(){
		
		$parentBlock = $this->getParentBlock();
		
		if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Dietifrance_Head')) {
			
			$text = $this->__("Guide");
			$parentBlock->addLink($text, 'guide/index', $text, true, array(), 50, null, 'class="top-link-test"');
		
        }
		
		return $this;
		
	}
	
}