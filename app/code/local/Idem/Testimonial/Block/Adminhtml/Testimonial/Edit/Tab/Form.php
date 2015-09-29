<?php

class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
        $customers = Mage::getModel('customer/customer')
                        ->getCollection()
                        ->addAttributeToSelect('firstname')
                        ->addAttributeToSelect('lastname');
        foreach($customers as $customer)
        {
            $customersCollection[$customer->getId()] = $customer->getName();
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('testimonial_form', array('legend'=>'Edition du témoignage'));
        $fieldset->addField('title', 'text',
                       array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'title',
                    ));
        $fieldset->addField('content', 'textarea',
                         array(
                          'label' => 'Contenu',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'content',
                      ));
        $fieldset->addField('customerId', 'select',
                         array(
                          'label' => 'Membre',
                          'name' => 'customerId[]',
                          'class' => 'required-entry',
                          'required' => true,
                          'values'  => $customersCollection,
                      ));
        $fieldset->addField('approved', 'select',
                         array(
                          'label' => 'Approuvé ?',
                          'name' => 'approved[]',
                          'class' => 'required-entry',
                          'required' => true,
                          'values'  => array('0'=>'Non', '1'=>'Oui'),
                      ));
        if(Mage::registry('testimonial_data'))
        {
            $form->setValues(Mage::registry('testimonial_data')->getData());
        }
        return parent::_prepareForm();
    }
}