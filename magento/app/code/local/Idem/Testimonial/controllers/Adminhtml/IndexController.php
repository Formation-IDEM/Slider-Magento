<?php
class Idem_Testimonial_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
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
      }
      public function editAction()
      {
           $testId = $this->getRequest()->getParam('id');
           $testModel = Mage::getModel('testimonial/testimonial')->load($testId);
           if ($testModel->getId() || $testId == 0)
           {
             Mage::register('testimonial_data', $testModel);
             $this->loadLayout();
             $this->_setActiveMenu('testimonial/set_time');
             $this->_addBreadcrumb('testimonial Manager', 'testimonial Manager');
             $this->_addBreadcrumb('Testimonial Description', 'Testimonial Description');
             $this->getLayout()->getBlock('head')
                  ->setCanLoadExtJs(true);
             $this->_addContent($this->getLayout()
                  ->createBlock('testimonial/adminhtml_testimonial_edit'))
                  ->_addLeft($this->getLayout()
                  ->createBlock('testimonial/adminhtml_testimonial_edit_tabs')
              );
             $this->renderLayout();
           }
           else
           {
                 Mage::getSingleton('adminhtml/session')
                       ->addError('Testimonial does not exist');
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
          } catch (Exception $e){
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
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
 							$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }
		  
	public function massDeleteAction()
	{
		$approvedId = $this->getRequest()->getParam('approved_id');
		
		if(!is_array($approvedId))
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Please select testimonial(s).'));
		}
		else 
		{
			try 
			{
				$Model = Mage::getModel('testimonial/testimonial');
				foreach ($approvedId as $apid) {
					$Model->load($apid)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('testimonial')->__(
						'Total of %d record(s) were deleted.', count($approvedId)
					)
				);
			} 
			catch (Exception $e) 
			{
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		 
		$this->_redirect('*/*/index');
	}
	
	public function massApprovedAction()
	{
		$approvedId = $this->getRequest()->getParam('approved_id');
		
		if(!is_array($approvedId))
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Please select testimonial(s).'));
		}
		else 
		{
			try 
			{
				$Model = Mage::getModel('testimonial/testimonial');
				foreach ($approvedId as $apid)
				{
					$Model->load($apid)->approvedTestimonial(1);
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('testimonial')->__(
						'Total of %d record(s) were approved.', count($approvedId)
					)
				);
			}
			catch (Exception $e) 
			{
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		
		$this->_redirect('*/*/index');
	}
	
	public function massDisapprovedAction()
	{
		$approvedId = $this->getRequest()->getParam('approved_id');
		
		if(!is_array($approvedId))
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Please select testimonial(s).'));
		}
		else 
		{
			try 
			{
				$Model = Mage::getModel('testimonial/testimonial');
				foreach ($approvedId as $apid)
				{
					$Model->load($apid)->approvedTestimonial(0);
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('testimonial')->__(
						'Total of %d record(s) were disapproved.', count($approvedId)
					)
				);
			}
			catch (Exception $e) 
			{
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		
		$this->_redirect('*/*/index');
	}
}
?>