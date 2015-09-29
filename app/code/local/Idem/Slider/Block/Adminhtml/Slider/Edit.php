<?php

    class Idem_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
        
       public function __construct()
       {
            parent::__construct();
            $this->_objectId = 'id';
            //vwe assign the same blockGroup as the Grid Container
            $this->_blockGroup = 'slider';
            //and the same controller
            $this->_controller = 'adminhtml_slider';
            //define the label for the save and delete button
            $this->_updateButton('save', 'label','Sauvegarder slider');
            $this->_updateButton('delete', 'label', 'Supprimer slider');
        }
       
        public function getHeaderText()
        {
            if( Mage::registry('test_data')&&Mage::registry('test_data')->getId())
             {
                  return 'Editer le slider '.$this->htmlEscape(
                  Mage::registry('test_data')->getTitle()).'<br />';
             }
             else
             {
                 return 'Ajouter un slider';
             }
        }
}