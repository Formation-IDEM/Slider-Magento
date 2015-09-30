<?php
/**
 *  IndexController.php
 *  ------------
 * @created at : 21/09/15
 */

/**
 * Class Idem_Slider_IndexController
 */
class Idem_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Slider'));
        $this->renderLayout();
    }
}

/*
**  End Of File
*/