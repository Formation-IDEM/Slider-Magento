<?php
/**
 *  Edit.php
 *  ------------
 * @created at : 21/09/15
 */

class Idem_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'slider';
        $this->_controller = 'adminhtml_slider';
        $this->_updateButton('save', 'label', 'Sauvegarder');
        $this->_updateButton('delete', 'label', 'Supprimer');
    }

    public function getHeaderText()
    {
        if( Mage::registry('slider_data') && Mage::registry('slider_data')->getId() ) {
            return 'Editer le slider ' . $this->htmlEscape(Mage::registry('slider_data')->getTitle()) . '<br />';
        } else {
            return 'Ajouter un slide';
        }
    }
}

/*
**  End Of File
*/