<?php

    class Dietifrance_Slider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
    {
        
        protected function _initAction()
        {
            $this->loadLayout()->_setActiveMenu('slider/set_time')
            ->_addBreadcrumb('test Manager','test Manager');
            return $this;
        }
        
        public function indexAction()
        {
            $this->_initAction();
            $this->renderLayout();
        }
        
        public function editAction()
        {
            $testId = $this->getRequest()->getParam('id');
            $testModel = Mage::getModel('slider/slider')->load($testId);
            if ($testModel->getId() || $testId == 0)
            {
                Mage::register('slider_data', $testModel);
                $this->loadLayout();
                $this->_setActiveMenu('slider/set_time');
                $this->_addBreadcrumb('test Manager', 'test Manager');
                $this->_addBreadcrumb('Test Description', 'Test Description');
                $this->getLayout()->getBlock('head')
                ->setCanLoadExtJs(true);
                $this->_addContent($this->getLayout()
                ->createBlock('slider/adminhtml_slider_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('slider/adminhtml_slider_edit_tabs')
                );
                $this->renderLayout();
            }
            else
            {
                Mage::getSingleton('adminhtml/session')
                ->addError('Test does not exist');
                $this->_redirect('*/*/');
            }
        }

        public function newAction()
        {
          $this->_forward('edit');
        }
        
        public function saveAction()
        {
            if ($this->getRequest()->getPost())
            {
 
            try {
                $postData = $this->getRequest()->getPost();
                
                $testModel = Mage::getModel('slider/slider');
                if( $this->getRequest()->getParam('id') <= 0 )
                    $testModel->setCreatedTime(
                    Mage::getSingleton('core/date')
                        ->gmtDate()
                    );
                
                ///Gestion de l'image ici/////////////////////////////////////////
                if( isset($_FILES['image']['name']) and (file_exists($_FILES['image']['tmp_name'])) ){         
                    $imagehelper = Mage::helper('slider/image');
                    $imagefile = $imagehelper->uploadImage('image');
                    $postData['image'] = "slider/".$imagefile;
                }else{
                    unset($postData['image']);
                }             
                //////////////////////////////////////////////////////////////////
                
                $testModel
                    ->addData($postData)
                    ->setUpdateTime(
                        Mage::getSingleton('core/date')
                        ->gmtDate())
                    ->setId($this->getRequest()->getParam('id'))
                    ->save();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('successfully saved');
                Mage::getSingleton('adminhtml/session')
                    ->settestData(false);
                $this->_redirect('*/*/');
                return;
            }catch (Exception $e){
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                    ->settestData($this->getRequest()
                        ->getPost()
                );
                $this->_redirect('*/*/edit',
                    array('id' => $this->getRequest()
                    ->getParam('id')));
                return;
                }
            }
            $this->_redirect('*/*/');
        }
          public function deleteAction()
          {
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $testModel = Mage::getModel('slider/slider');
                    $testModel->setId($this->getRequest()
                                        ->getParam('id'))
                              ->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }
        public function massDeleteAction()
        {
            $taxIds = $this->getRequest()->getParam('id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
            if(!is_array($taxIds)) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Please select tax(es).'));
            } else {
                try {
                    $rateModel = Mage::getModel('slider/slider');
                    foreach ($taxIds as $taxId) {
                    $rateModel->load($taxId)->delete();
                    }
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tax')->__(
                    '%d slider(s) a été supprimé.', count($taxIds)
                    )
                    );
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
             
            $this->_redirect('*/*/index');
        }

    }