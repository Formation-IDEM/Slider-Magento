<?php
/**
 *  Form.php
 *  ------------
 * @created at : 21/09/15
 */

class Idem_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('slider_form', [
            'legend' =>  'Informations'
        ]);
        $fieldset->addField('title', 'text', [
            'label'     =>  'Titre',
            'class'     =>  'required-entry',
            'required'  =>  true,
            'name'      =>  'title'
        ]);
        $fieldset->addField('url', 'text', [
            'label'     =>  'URL',
            'class'     =>  'required-entry',
            'required'  =>  true,
            'name'      =>  'url'
        ]);
        $fieldset->addField('image', 'image', [
            'label'     =>  $this->__('Upload Image'),
            'required'  =>  false,
            'name'      =>  'image'
        ]);

        if( Mage::registry('slider_data') ) {
            $form->setValues(Mage::registry('slider_data')->getData());
        }
        return parent::_prepareForm();
    }
}

/*
**  End Of File
*/