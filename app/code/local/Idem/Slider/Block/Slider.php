<?php
/**
 *  Slider.php
 *  ------------
 * @created at : 21/09/15
 */

/**
 * Class Idem_Slider_Block_Slider
 */
class Idem_Slider_Block_Slider extends Mage_Core_Block_Template
{
    protected $_slides = [];

    public function __construct()
    {
        parent::__construct();
        $slider = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($slider);
    }

    public function getSlides()
    {
        return $this->getCollection()->load();
    }
}

/*
**  End Of File
*/