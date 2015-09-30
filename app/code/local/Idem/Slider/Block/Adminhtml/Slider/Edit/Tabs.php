<?php
/**
 *  Tabs.php
 *  ------------
 * @created at : 21/09/15
 */

/**
 * Class Idem_Slider_Block_Adminhtml_Slider_Edit_Tabs
 */
class Idem_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setID('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Informations sur le Slide');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', [
            'label'     =>  'Informations',
            'title'     =>  'Informations',
            'content'   =>  $this->getLayout()
                ->createBLock('slider/adminhtml_slider_edit_tab_form')
                ->toHtml(),
        ]);
        return parent::_beforeToHtml();
    }
}

/*
**  End Of File
*/