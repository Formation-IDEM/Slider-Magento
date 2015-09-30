<?php
/**
 *  Tabs.php
 *  ------------
 * @created at : 18/09/15
 */

class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('testimonial_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Informations sur le témoignage');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', [
            'label'     =>  'Témoignage',
            'title'     =>  'Témoignage',
            'content'   =>  $this->getLayout()
                ->createBlock('testimonial/adminhtml_testimonial_edit_tab_form')
                ->toHtml()
        ]);
        return parent::_beforeToHtml();
    }
}

/*
**  End Of File
*/