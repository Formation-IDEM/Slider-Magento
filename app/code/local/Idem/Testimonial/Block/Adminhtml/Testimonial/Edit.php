<?php
class Idem_Testimonial_Block_Adminhtml_Testimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        //vwe assign the same blockGroup as the Grid Container
        $this->_blockGroup = 'testimonial';
        //and the same controller
        $this->_controller = 'adminhtml_testimonial';
        //define the label for the save and delete button
        $this->_updateButton('save', 'label','Sauvegarder les modifications');
        $this->_updateButton('delete', 'label', 'Supprimer ce témoignage');
    }
       /* Here, we're looking if we have transmitted a form object,
          to update the good text in the header of the page (edit or add) */
    public function getHeaderText()
    {
        if(Mage::registry('testimonial_data') && Mage::registry('testimonial_data')->getId())
        {
            return 'Editer le témoignage '.$this->htmlEscape(
            Mage::registry('testimonial_data')->getTitle()).'<br />';
        }
        else
        {
           return 'Add a testimonial';
        }
    }
}