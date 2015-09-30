<?php 

/**
* 
*/
class Tshirt_Slider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('slider/set_time')
                ->_addBreadcrumb('slider Manager','slider Manager');
       return $this;
    }

	public function indexAction(){
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
	        $this->_addBreadcrumb('slider Manager', 'slider Manager');
	        $this->_addBreadcrumb('Slider Description', 'Slider Description');
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
            	->addError('Slider does not exist');
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
     		try 
     		{
	            $postData = $this->getRequest()->getPost();
	            $testModel = Mage::getModel('slider/slider');
            	if( $this->getRequest()->getParam('id') <= 0 )
              		$testModel->setCreatedTime( Mage::getSingleton('core/date')->gmtDate() );
              	$testModel
                ->addData($postData)
                ->setUpdateTime( Mage::getSingleton('core/date')->gmtDate() )
                ->setId($this->getRequest()->getParam('id'))
                ->save();
            	Mage::getSingleton('adminhtml/session')->addSuccess('successfully saved');
            	Mage::getSingleton('adminhtml/session')->settestData(false);
            	$this->_redirect('*/*/');
            	return;
      		}
      		catch (Exception $e)
      		{
	            Mage::getSingleton('adminhtml/session')->addError( $e->getMessage() );
	            Mage::getSingleton('adminhtml/session')->settestData( $this->getRequest()->getPost() );
	            $this->_redirect( '*/*/edit', array( 'id' => $this->getRequest()->getParam('id') ) );
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
                $testModel->setId( $this->getRequest()->getParam('id') )->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect( '*/*/edit', array( 'id' => $this->getRequest()->getParam('id') ) );
            }
        }
        $this->_redirect('*/*/');
    }

  public function massDeleteAction()
	{
		$sliderIds = $this->getRequest()->getParam('slide_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
		if(!is_array($sliderIds)) 
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Please select slider(es).'));
		}
		else
		{
			try
			{
				$rateModel = Mage::getModel('slider/slider');
				foreach ($sliderIds as $sliderId)
				{
					$rateModel->load($sliderId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess( Mage::helper('slider')->__( 'Total of %d record(s) were deleted.', count($sliderIds) ) );
			}
			catch (Exception $e)
			{
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		} 
		$this->_redirect('*/*/index');
	}

  


}
