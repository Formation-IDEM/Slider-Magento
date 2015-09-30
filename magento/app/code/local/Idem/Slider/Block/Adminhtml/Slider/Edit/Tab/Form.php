<?php
class Idem_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('slider_form',
                                       array('legend'=>'ref information'));
        $fieldset->addField('titre', 'text',
                       array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'titre',
                    ));
					
        $fieldset->addField('url', 'text',
                         array(
                          'label' => 'Lien du slide',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'url',
                      ));
					  
		$fieldset->addField('image', 'image',
                       	array(
                          'label' => 'Image',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'image',
                    ));
					
        $fieldset->addField('product', 'text',
                         array(
                          'label' => 'Produit',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'product_id',
                      ));
         
 if ( Mage::registry('slider_data') )
 {
    $form->setValues(Mage::registry('slider_data')->getData());
  }
  return parent::_prepareForm();
 }
}
