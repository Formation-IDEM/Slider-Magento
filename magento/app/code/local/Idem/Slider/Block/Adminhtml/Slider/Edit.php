<?php
class Idem_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        //vous remarquerez qu’on lui assigne le même blockGroup que le Grid Container
        $this->_blockGroup = 'slider';
        //et le meme controlleur
        $this->_controller = 'adminhtml_slider';
        //on definit les labels pour les boutons save et les boutons delete
        $this->_updateButton('save', 'label','save slider');
        $this->_updateButton('delete', 'label', 'delete slider');
    }
       /* Ici,  on regarde si on a transmit un objet au formulaire,
            afin de mettre le bon texte dans le  header (Editer ou
             Ajouter) */
    public function getHeaderText()
    {
        if( Mage::registry('slider_data')&&Mage::registry('slider_data')->getId())
        {
            return 'Editer le slider '.$this->htmlEscape(
            Mage::registry('slider_data')->getTitle()).'<br />';
        }
        else
        {
            return 'Ajouter un slider';
        }
    }
}