<?php
/**
 *  Grid.php
 *  ------------
 * @created at : 18/09/15
 */

class Idem_Testimonial_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_testimonial';
        $this->_blockGroup = 'testimonial';
        $this->_headerText = $this->__('Gestion des témoignages');
        $this->_addButtonLabel = $this->__('Ajouter un témoignage');

        parent::__construct();
    }


}

/*
**  End Of File
*/