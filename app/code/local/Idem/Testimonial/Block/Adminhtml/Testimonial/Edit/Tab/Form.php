<?php
/**
 *  Form.php
 *  ------------
 * @created at : 18/09/15
 */

class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $customers = Mage::getModel('customer/customer')->getCollection()->addAttributeToSelect('*');
        $customerSelect = [['value' => -1, 'label' => 'Sélectionnez un auteur']];
        foreach( $customers as $customer ) {
            $customerSelect[] = ['value' => $customer->getId(), 'label' => $customer->getName()];
        }

        $testimonial = Mage::getModel('testimonial/testimonial')->load($this->getRequest()->getParam('id'));

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('testimonial_form', [
            'legend'    =>  'ref information',
        ]);
        $fieldset->addField('title', 'text', [
            'label'     =>  'Titre',
            'class'     =>  '',
            'name'      =>  'title'
        ]);
        $fieldset->addField('content', 'text', [
            'label'     =>  'Contenu',
            'class'     =>  'required-entry',
            'required'  =>  true,
            'name'      =>  'content'
        ]);
        $fieldset->addField('customer_id', 'select', [
            'label'     =>  'Auteur',
            'class'     =>  'required-entry',
            'required'  =>  true,
            'name'      =>  'customer_id',
            'values'    =>  $customerSelect
        ]);
        $fieldset->addField('is_active', 'checkbox', [
            'label'     =>  'Actif ?',
            'name'      =>  'is_active',
            'onclick'   => 'this.value = this.checked ? 1 : 0;',
            'checked'   => (int)$testimonial->getData('is_active') > 0 ? 'checked' : '',
        ]);

        if( Mage::registry('testimonial_data') ) {
            $form->setValues(Mage::registry('testimonial_data')->getData());
        }
        return parent::_prepareForm();
    }
}

/*
**  End Of File
*/