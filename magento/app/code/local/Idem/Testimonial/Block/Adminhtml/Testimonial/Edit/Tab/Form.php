<?php
class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('testimonial_form',
                                       array('legend'=>'Testimonial'));
        $fieldset->addField('testimonial_id', 'text',
                       array(
                          'label' => 'ID',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'testimonial_id',
                           'disabled' => 'disabled',
                    ));
        $fieldset->addField('title', 'text',
                         array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'title',
                      ));
        $fieldset->addField('message', 'textarea',
                         array(
                          'label' => 'Message',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'message',
                      ));
          $fieldset->addField('customer_id', 'text',
                    array(
                        'label' => 'Auteur ID',
                        'class' => 'required-entry',
                        'required' => true,
                        'name' => 'customer_id'
                 ));
 if ( Mage::registry('testimonial_data') )
 {
    $form->setValues(Mage::registry('testimonial_data')->getData());
  }
  return parent::_prepareForm();
 }
}