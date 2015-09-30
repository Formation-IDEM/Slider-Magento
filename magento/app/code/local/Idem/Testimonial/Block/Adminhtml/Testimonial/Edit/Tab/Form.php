<?php
class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('testimonial_form',
                                       array('legend'=>'ref information'));
        $fieldset->addField('titre', 'text',
                       array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'titre',
                    ));
        $fieldset->addField('message', 'textarea',
                         array(
                          'label' => 'Message',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'message',
                      ));
         
 if ( Mage::registry('testimonial_data') )
 {
    $form->setValues(Mage::registry('testimonial_data')->getData());
  }
  return parent::_prepareForm();
 }
}