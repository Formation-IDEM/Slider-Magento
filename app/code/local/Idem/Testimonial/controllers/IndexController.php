<?php

/**
 *  IndexController.php
 *  ------------
 * @created at : 17/09/15
 */
class Idem_Testimonial_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Testimonials'));
        $this->renderLayout();
    }

}