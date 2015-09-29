<?php
class Idem_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('slider_form',array('legend'=>'ref information'));
       $fieldset->addField('titre', 'text',
                       array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'titre'
                    ));
       $fieldset->addField('url', 'text',
                       array(
                          'label' => 'URL',
                          'name' => 'url'
                    ));
                    
        $fieldset->addField('image', 'image', array(
                  'label'     => Mage::helper('slider')->__('Image'),
                  'name'      => 'image',
        ));
        
        $products = Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*');
        
        $tabProduct = array();
        $tabProduct[-1] = 'Selectionné un produit';
          
        foreach ($products as $product) {
            $tabProduct[intval($product->getId())] = $product->getName();
        }
        
        $fieldset->addField('product_id', 'select', array(
                  'label'     => 'Produit',
                  'name'      => 'product_id',
                  'onclick' => "",
                  'onchange' => "",
                  'value'   => '1',
                  'values' => $tabProduct,
                  'disabled' => false,
                  'readonly' => false,
                  'after_element_html' => '<small>Comments</small>',
                  'tabindex' => 1
        ));
                       
 if ( Mage::registry('slider_data') )
 {
    $form->setValues(Mage::registry('slider_data')->getData());
  }
  return parent::_prepareForm();
 }
}