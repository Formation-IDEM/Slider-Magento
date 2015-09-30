<?php

/**
 *  Testimonial.php
 *  ------------
 * @created at : 17/09/15
 */
class Idem_Testimonial_Block_Testimonial extends Mage_Core_Block_Template
{
    protected $_testimonials = [];

    public function __construct()
    {
        parent::__construct();
        $testimonials = Mage::getModel('testimonial/testimonial')->getCollection();
        $this->setCollection($testimonials);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5 => 5, 10 => 10, 20 => 20));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildChildHtml('pager');
    }

    public function getItems()
    {
        $limit = 10;
        $current = 1;

        if( Mage::app()->getRequest()->getParam('limit')) {
            $current = Mage::app()->getRequest()->getParam('limit');
        }
        $offset = ($current - 1) * $limit;

        if( !$this->_testimonials ) {
            $testimonials = Mage::getModel('testimonial/testimonial')
                ->getCollection();
            $testimonials->getSelect()->order('created_time desc')->limit($limit, $offset);
            $this->_testimonials = $testimonials;
        }
        return $this->_testimonials;
    }
}