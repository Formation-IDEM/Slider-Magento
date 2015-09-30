<?php
/**
 *  IndexController.php
 *  ------------
 * @created at : 15/09/15
 */


class Idem_Test_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function tutoAction()
    {
        echo 'test';
    }
}

/*
**  End Of File
*/