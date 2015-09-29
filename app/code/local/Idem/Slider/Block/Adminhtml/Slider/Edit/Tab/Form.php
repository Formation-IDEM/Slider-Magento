<?php

class Idem_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
        $form = new Varien_Data_Form(array(
                'id' => 'edit_dfgform',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'),'store' => $this->getRequest()->getParam('store'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form', array('legend'=>'Edition du slide'));
        $fieldset->addField('title', 'text',
                       array(
                          'label' => 'Titre',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'title',
                    ));
        $fieldset->addField('url', 'text',
                         array(
                          'label' => 'URL',
                          'required' => false,
                          'name' => 'url',
                      ));
        $fieldset->addField('image', 'image', array(
            'name'      => 'image', // declare this as array. Otherwise only one image will be uploaded
            'label'     => 'Image',
            'title'     => 'image',
            'class' => 'required-entry',
            'required'  => true,
        ));

        if(Mage::registry('slider_data'))
        {
            $form->setValues(Mage::registry('slider_data')->getData());
        }
        return parent::_prepareForm();
    }
}