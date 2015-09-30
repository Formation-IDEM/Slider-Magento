<?php
/**
 *  IndexController.php
 *  ------------
 * @created at : 21/09/15
 */

/**
 * Class Idem_Slider_Adminhtml_IndexController
 */
class Idem_Slider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Sliders's GRID
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Manage Sliders'));
        $this->renderLayout();
    }

    /**
     * Add and Edit Slider
     */
    public function editAction()
    {
        $slideId = $this->getRequest()->getParam('id');
        $slideModel = Mage::getModel('slider/slider')->load($slideId);
        if( $slideModel->getId() || $slideId == 0 ) {
            Mage::register('slider_data', $slideModel);
            $this->loadLayout();
            $this->_setActiveMenu('cms/slider');
            $this->_addBreadcrumb('CMS Manager', 'CMS Manager');
            $this->_addBreadcrumb('Sliders', 'Sliders');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                ->createBlock('slider/adminhtml_slider_edit')
            )->_addLeft($this->getLayout()
                ->createBlock('slider/adminhtml_slider_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError('Ce slide n\'existe pas.');
            $this->redirect('*/*/');
        }
    }

    /**
     * Add Action
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     *  Save Action
     */
    public function saveAction()
    {
        if( $this->getRequest()->getPost() )
        {
            try {
                $postData = $this->getRequest()->getPost();
                $slideModel = Mage::getModel('slider/slider');

                unset($postData['image']);
                //  Upload d'une image
                if( isset($_FILES['image']['name']) ) {
                    $path = Mage::getBaseDir('media') . DS . 'sliders' . DS;
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif']);
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($path, $this->parsePicture($_FILES['image']['name']));
                    $postData['image'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'sliders' . DS . $this->parsePicture($_FILES['image']['name']);
                } else { // Suppression de l'image
                    if( isset($postData['image']['delete']) && $postData['image']['delete'] == 1 ) {
                        $postData['image'] = '';
                    } else {
                        unset($postData['image']);
                    }
                }

                $slideModel->addData($postData)->setId($this->getRequest()->getParam('id'));

                if( $slideModel->getId() != 0 ) {
                    if( $slideModel->getData('image') ) {
                        $imageParams = explode('/', $slideModel->getData('image'));
                        $imageName = end($imageParams);
                        if( file_exists(Mage::getBaseDir('media') . DS . 'sliders' . DS . $imageName) ) {
                            unlink(Mage::getBaseDir('media') . DS . 'sliders' . DS . $imageName);
                        }
                    }
                }

                $slideModel->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Le slide a correctement été sauvegardé');
                Mage::getSingleton('adminhtml/session')->setsliderData(false);
                $this->_redirect('*/*/');
                return;
            } catch( Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setsliderdata($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', [
                    'id'    =>  $this->getRequest()->getParam('id')
                ]);
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Suppression d'un slide
     */
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 )
        {
            try
            {
                $slideModel = Mage::getModel('slider/slider');
                $slideModel->load($this->getRequest()
                    ->getParam('id'));
                if( file_exists( $slideModel->getData('image')) ) {
                    unlink($slideModel->getData('image'));
                }
                $slideModel->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('Slide supprimé avec succés');
                $this->_redirect('*/*/');
            }
            catch( Exception $e )
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                $this->_redirect('*/*/edit', [
                    'id' => $this->getRequest()->getParam('id')
                ]);
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Suppression de masse
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if( is_array($ids) ) {
            $slideModel = Mage::getModel('slider/slider');
            try {
                foreach( $ids as $id ) {
                    $slideModel->load($id);
                    $imageParams = explode('/', $slideModel->getData('image'));
                    $imageName = end($imageParams);
                    if( file_exists(Mage::getBaseDir('media') . DS . 'sliders' . DS . $imageName) ) {
                        unlink(Mage::getBaseDir('media') . DS . 'sliders' . DS . $imageName);
                    }
                    $slideModel->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess('Les slides ont bien été supprimés');
            } catch( Exception $e ) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }

        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('No Attributes Selected'));
        }

        $this->_redirect('*/*/');
    }

    private function parsePicture($fileName)
    {
        $fileName = str_replace(' ', '_', $fileName);
        $fileName = strtolower($fileName);
        return $fileName;
    }
}

/*
**  End Of File
*/