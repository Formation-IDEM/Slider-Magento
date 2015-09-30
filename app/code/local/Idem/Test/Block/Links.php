<?php
/**
 *  Links.php
 *  ------------
 * @created at : 15/09/15
 */

/**
 * Class Idem_Test_Block_Links
 */
class Idem_Test_Block_Links extends Mage_Checkout_Block_Links
{
    /**
     * Crée un lien de test
     *
     * @param $label
     * @param $url
     * @return $this
     */
    public function addTestLink($label, $url)
    {
        $parentBlock = $this->getParentBlock();
        if( $parentBlock )
        {
            $parentBlock->addLink($label, $url, $label, true, array('_secure' => true), 60, null, 'class="top-link-cart"');
        }

        return $this;
    }

    /**
     * Add shopping cart link to parent block
     *
     * @return $this
     */
    public function addCartLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $text = $this->__('My Cart');

            $parentBlock->removeLinkByUrl($this->getUrl('checkout/cart'));
            $parentBlock->addLink($text, 'checkout/cart', $text, true, array(), 50, null, 'class="top-link-cart"');
        }
        return $this;
    }

    /**
     * Retourne le nombre d'items du panier
     *
     * @return mixed
     */
    public function getSummaryQuantity()
    {
        if( Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout') ) {
            $count = $this->getSummaryQty() ? $this->getSummaryQty()
                : $this->helper('checkout/cart')->getSummaryCount();

            return $count;
        }
    }

    /**
     * Add link on checkout page to parent block
     *
     * @return $this
     */
    public function addCheckoutLink()
    {
        if (!$this->helper('checkout')->canOnepageCheckout()) {
            return $this;
        }

        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $text = $this->__('Checkout');
            $parentBlock->addLink(
                $text, 'checkout', $text,
                true, array('_secure' => true), 60, null,
                'class="top-link-checkout"'
            );
        }
        return $this;
    }
}

/*
**  End Of File
*/