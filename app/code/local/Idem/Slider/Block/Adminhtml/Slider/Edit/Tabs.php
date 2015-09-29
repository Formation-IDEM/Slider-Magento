<?php
  class Idem_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     public function __construct()
     {
          parent::__construct();
          $this->setId('slider_tabs');
          $this->setDestElementId('edit_form');
          $this->setTitle('Information sur le slide');
  }
  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
               'label' => 'Information slider',
               'title' => 'Information slider',
               'content' => $this->getLayout()
        ->createBlock('slider/adminhtml_slider_edit_tab_form')
        ->toHtml()
         ));
         return parent::_beforeToHtml();
    }
}