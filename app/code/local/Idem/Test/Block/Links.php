<?php

class Idem_Test_Block_Links extends Mage_Checkout_Block_Links
{

	public function addTestLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Idem_Test'))
        {
	        $text = 'page de test';
	        $parentBlock->addLink(
	            $text, 'test', $text,
	            true, array('_secure' => true), 60, null,
	            'class="top-link-checkout"'
	        );
	    }
        return $this;
    }

    public function addCartLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Idem_Test'))
        {
	        $text = 'panier remplacé';
	        $parentBlock->addLink(
	            $text, 'test', $text,
	            true, array('_secure' => true), 60, null,
	            'class="top-link-checkout"'
	        );
	    }
        return $this;
    }
}