<?php
/**
 *  Grid.php
 *  ------------
 * @created at : 21/09/15
 */

class Idem_Slider_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'slider';
        $this->_headerText = 'Gestion des slides';
        $this->_addButtonLabel = 'Ajouter un slide';
        parent::__construct();
    }
}

/*
**  End Of File
*/