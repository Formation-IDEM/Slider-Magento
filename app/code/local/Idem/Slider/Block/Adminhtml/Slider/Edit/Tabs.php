<?php
class Idem_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
   public function __construct()
   {
        parent::__construct();
        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Edition du slide');
    }
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
                 'label' => 'Paramètres principaux',
                 'title' => 'Paramètres principaux',
                 'content' => $this->getLayout()
                               ->createBlock('slider/adminhtml_slider_edit_tab_form')
                               ->toHtml()
                               ));
        $this->addTab('products', array(
            'label' => 'Produits associés',
            'url'   => $this->getUrl('*/*/products', array('_current' => true)),
            'class'    => 'ajax'
        ));

       return parent::_beforeToHtml();
  }
}