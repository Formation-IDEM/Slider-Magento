<?php
/**
 *  Edit.php
 *  ------------
 * @created at : 18/09/15
 */

class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'testimonial';
        $this->_controller = 'adminhtml_testimonial';
        $this->_updateButton('save', 'label', 'Sauvegarder');
        $this->_updateButton('delete', 'label', 'Supprimer');
    }

    public function getHeaderText()
    {
        if( Mage::registry('testimonial_data') && Mage::registry('testimonial_data')->getId() ) {
            return 'Editer le testimonial ' . $this->htmlEscape(Mage::registry('testimonial_data')->getData('title')) . '<br />';
        } else {
            return 'Ajouter un témoignage';
        }
    }
}

/*
**  End Of File
*/