<?php

class Idem_Testimonial_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action{
	
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('testimonial/set_time')
                ->_addBreadcrumb('testimonial Manager','testimonial Manager');
       return $this;
     }
	
      public function indexAction()
      {
         $this->_initAction();
         $this->renderLayout();
		 
		 echo  Mage::getStoreConfig('testimonial_section/testimonial_group/testimonial_moderate');
      }
	  
      public function editAction(){
      	
			//on récupère l'id du témoignage et on set testId avec
           $testId = $this->getRequest()->getParam('id');
		   //on récupère le témoignage avec l'id récupéré précedemment et on set testModel
           $testModel = Mage::getModel('testimonial/testimonial')->load($testId);
		   
		   //si le temoignage existe ou si son id = 0 on affiche le formulaire
           if ($testModel->getId() || $testId == 0){
           	
             Mage::register('testimonial_data', $testModel);
             $this->loadLayout();
             $this->_setActiveMenu('testimonial/set_time');
             $this->_addBreadcrumb('testimonial Manager', 'test Manager');
             $this->_addBreadcrumb('testimonial Description', 'Test Description');
             $this->getLayout()->getBlock('head')
                  ->setCanLoadExtJs(true);
             $this->_addContent($this->getLayout()
                  ->createBlock('testimonial/adminhtml_testimonial_edit'))
                  ->_addLeft($this->getLayout()
                  ->createBlock('testimonial/adminhtml_testimonial_edit_tabs')
              );
             $this->renderLayout();
			 
           }else{
           		
				//sinon on affiche pas le formulaire de témoignage
                 Mage::getSingleton('adminhtml/session')
                       ->addError('Test does not exist');
                 $this->_redirect('*/*/');
            }
       }

       public function newAction(){
       	
          $this->_forward('edit');
       }
	   
       public function saveAction(){
       	
		//si on a récupéré les données du formulaire
         if ($this->getRequest()->getPost()){
         	
			
           try {
                 $postData = $this->getRequest()->getPost();
                 $testModel = Mage::getModel('testimonial/testimonial');
				 
               if( $this->getRequest()->getParam('id') <= 0 )
                  $testModel->setCreatedTime(
                     Mage::getSingleton('core/date')
                            ->gmtDate()
                    );
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
				
          } 
          
          catch (Exception $e){
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
                    $testModel = Mage::getModel('testimonial/testimonial');
                    $testModel->setId($this->getRequest()
                                        ->getParam('id'))
                              ->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }
		  
		 public function massDeleteAction(){
		  	
				$testimIDs = $this->getRequest()->getParam('testimonial_id');      // $this->getMassactionBlock()->setFormFieldName('testimonial_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
				if(!is_array($testimIDs)) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Choisissez un témoignage'));
				} else {
					try {
					$testiModel = Mage::getModel('testimonial/testimonial');
					foreach ($testimIDs as $testimID) {
					$testiModel->load($testimID)->delete();
					}
					Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('testimonial')->__(
					'Total of %d record(s) were deleted.', count($testimID)
					)
					);
					} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					}
				}
				 
				$this->_redirect('*/*/index');
		}
		  
		  
		public function massValidateAction(){
			
		
				$testimIDs = $this->getRequest()->getParam('testimonial_id');      // $this->getMassactionBlock()->setFormFieldName('testimonial_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
				if(!is_array($testimIDs)) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Choisissez un témoignage'));
				} else {
					try {
					$testiModel = Mage::getModel('testimonial/testimonial');
					foreach ($testimIDs as $testimID) {
					$testiModel->load($testimID)->setIsValidate(1)->save();
					}
					Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('testimonial')->__(
					'Total of %d record(s) were approved.', count($testimID)
					)
					);
					} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					}
				}
				 
				$this->_redirect('*/*/index');
		}
		  
	
}
