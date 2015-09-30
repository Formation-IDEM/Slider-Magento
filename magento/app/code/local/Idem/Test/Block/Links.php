<?php

class Idem_Test_Block_Links extends Mage_Checkout_Block_Links
{
	public function addCartLink()
	{
		$parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Idem_Test'))
        {
			$parentBlock->addLink('Testez-moi', 'test', 'Bonjour toi!', true, array(), 9, null, 'class="top-link"');
        }
        return $this;
	}
}
