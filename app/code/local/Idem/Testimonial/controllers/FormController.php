<?php

/**
 *  FormController.php
 *  ------------
 * @created at : 17/09/15
 */
class Idem_Testimonial_FormController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function submitAction()
    {
        $testimonial = Mage::getModel('testimonial/testimonial');
        $testimonial->setTitle($this->getRequest()->getPost('title'));
        $testimonial->setContent($this->getRequest()->getPost('content'));
        $testimonial->setCustomerId(Mage::getSingleton('customer/session')->getCustomer()->getId());
        $testimonial->setCreatedTime(date('Y-m-d H:i:s'));
        $testimonial->save();

        Mage::getSingleton('core/session')->addSuccess('Votre testimonial a correctement été enregistré');
        $response = Mage::app()->getFrontController()->getResponse();
        $response->setRedirect(Mage::getBaseUrl() . '/testimonial');
        $response->sendResponse();
    }
}