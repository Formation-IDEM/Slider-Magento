<?php
class Tshirt_Testimonial_Block_Adminhtml_Testimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        //vous remarquerez qu’on lui assigne le même blockGroup que le Grid Container
        $this->_blockGroup = 'testimonial';
        //et le meme controlleur
        $this->_controller = 'adminhtml_testimonial';
        //on definit les labels pour les boutons save et les boutons delete
        $this->_updateButton('save', 'label','save reference');
        $this->_updateButton('delete', 'label', 'delete reference');
    }
       /* Ici,  on regarde si on a transmit un objet au formulaire,
            afin de mettre le bon texte dans le  header (Editer ou
             Ajouter) */
    public function getHeaderText()
    {
        if( Mage::registry('testimonial_data')&&Mage::registry('testimonial_data')->getId())
         {
              return 'Editer le testimonial '.$this->htmlEscape(
              Mage::registry('testimonial_data')->getTitle()).'<br />';
         }
         else
         {
             return 'Ajouter un testimonial';
         }
    }
}