<?php

/**
 *  TestimonialController.php
 *  ------------
 * @created at : 17/09/15
 */
class Idem_Testimonial_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('testimonial/set_time')->_addBreadcrumb('Témoignages', 'Témoignages');
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $testId = $this->getRequest()->getParam('id');
        $testModel = Mage::getModel('testimonial/testimonial')->load($testId);
        if( $testModel->getId() || $testId == 0 )
        {
            Mage::register('testimonial_data', $testModel);
            $this->loadLayout();
            $this->_setActiveMenu('testimonial/set_time');
            $this->_addBreadcrumb('Témoignages', 'Témoignages');
            $this->_addBreadcrumb('Action', 'Action');
            $this->getLayout()->getBlock('head')
                ->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                ->createBlock('testimonial/adminhtml_testimonial_edit'))
                ->_addLeft($this->getLayout()
                    ->createBlock('testimonial/adminhtml_testimonial_edit_tabs')
                );
            $this->renderLayout();
        } else
        {
            Mage::getSingleton('adminhtml/session')
                ->addError('Testimonial does not exist');
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $postData['is_active'] = ($postData['is_active'] === null) ? false : true;
                $testModel = Mage::getModel('testimonial/testimonial');
                if( $this->getRequest()->getParam('id') <= 0 ) {
                    $testModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
                }

                $testModel->addData($postData);
                $testModel->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())
                    ->setId($this->getRequest()->getParam('id'))
                    ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Le témoignage a correctement été sauvegardé');
                Mage::getSingleton('adminhtml/session')->settestData(false);
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->settestData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $testModel = Mage::getModel('testimonial/testimonial');
                $testModel->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('Le témoignage a correctement été supprimé');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('testimonial_id');
        if( !is_array($ids) ) {
            Mage::getSingleton('adminhtml/session')->addError('Veuillez sélectionner des témoignages');
        } else {
            try {
                $testModel = Mage::getModel('testimonial/testimonial');
                foreach( $ids as $id ) {
                    $testModel->load($id)->delete();
                }

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('Les témoignages ont correctement été supprimés');
            } catch( Exception $e ) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->redirect('*/*/index');
    }
}