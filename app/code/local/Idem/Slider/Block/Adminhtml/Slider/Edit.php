<?php
class Idem_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        //vwe assign the same blockGroup as the Grid Container
        $this->_blockGroup = 'slider';
        //and the same controller
        $this->_controller = 'adminhtml_slider';
        //define the label for the save and delete button
        $this->_updateButton('save', 'label','Sauvegarder les modifications');
        $this->_updateButton('delete', 'label', 'Supprimer ce slide');
    }
       /* Here, we're looking if we have transmitted a form object,
          to update the good text in the header of the page (edit or add) */
    public function getHeaderText()
    {
        if(Mage::registry('slider_data') && Mage::registry('slider_data')->getId())
        {
            return 'Editer le slide '.$this->htmlEscape(
            Mage::registry('slider_data')->getTitle()).'<br />';
        }
        else
        {
           return 'Add a slide';
        }
    }
}