<?php

class Idem_Testimonial_Block_Links extends Mage_Checkout_Block_Links
{

	public function addTestimonialLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Idem_Test'))
        {
	        $text = 'Témoignages';
	        $parentBlock->addLink(
	            $text, 'testimonial/index', $text,
	            true, array('_secure' => true), 60, null,
	            'class="top-link-checkout"'
	        );
	    }
        return $this;
    }
}