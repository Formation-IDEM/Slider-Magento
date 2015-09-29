<?php

class Idem_Slider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
    {
        $this
        ->loadLayout()
        ->_setActiveMenu('slider/set_time')
        ->_addBreadcrumb('test Manager','test Manager');
       	return $this;
    }

	public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

  public function productsAction(){
      //$this->_initEntity(); //if you don't have such a method then replace it with something that will get you the entity you are editing.
      //$this->loadLayout();
      $slideId = $this->getRequest()->getParam('id');
      $slider = Mage::getModel('slider/slider')->load($slideId);
      Mage::register('current_slider', $slider);
      $this->_initAction();
      $this
        ->getLayout()
        ->getBlock('slider.edit.tab.product')
        ->setSliderProducts($this->getRequest()->getPost('slider_products', null));
      $this->renderLayout();
  }
  public function productsgridAction(){
      $slideId = $this->getRequest()->getParam('id');
      $slider = Mage::getModel('slider/slider')->load($slideId);
      Mage::register('current_slider', $slider);
      $this->_initAction();
      $this->loadLayout();
      $this->getLayout()->getBlock('slider.edit.tab.product')
          ->setSliderProducts($this->getRequest()->getPost('slider_products', null));
      $this->renderLayout();
  }

    public function massActiveAction()
    {
        $sliderIds = $this->getRequest()->getParam('slide_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
    	if(!is_array($sliderIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select tax(es).'));
        } 
        else 
        {
            try 
            {
            	$sliderModel = Mage::getModel('slider/slider');
                foreach($sliderIds as $taxId)
                {
                    $sliderModel
                    	->load($taxId)
                    	->setActive('1')
                    	->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
		                Mage::helper('tax')->__(
		                'Total of %d record(s) were actived.', count($sliderIds)
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

    public function massUnactiveaction()
    {
        $sliderIds = $this->getRequest()->getParam('slide_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
    	if(!is_array($sliderIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select tax(es).'));
        } 
        else 
        {
            try 
            {
            	$sliderModel = Mage::getModel('slider/slider');
                foreach($sliderIds as $taxId)
                {
                    $sliderModel
                    	->load($taxId)
                    	->setActive(false)
                    	->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
		                Mage::helper('tax')->__(
		                'Total of %d record(s) were unactived.', count($sliderIds)
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

    public function massDeleteAction()
    {
        $sliderIds = $this->getRequest()->getParam('slide_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($sliderIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select tax(es).'));
        } 
        else 
        {
            try 
            {
                $sliderModel = Mage::getModel('slider/slider');
                foreach($sliderIds as $taxId)
                {
                    $sliderModel->load($taxId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
		                Mage::helper('tax')->__(
		                'Total of %d record(s) were deleted.', count($sliderIds)
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

  public function editAction()
	{
		$testId = $this->getRequest()->getParam('id');
		$testModel = Mage::getModel('slider/slider')->load($testId);
		if($testModel->getId() || $testId == 0)
		{
			if(Mage::getStoreConfig('slider_section/slider_group/slider_select',Mage::app()->getStore()))
			{
				$testModel->setApproved('1');				
			}
			Mage::register('slider_data', $testModel);
			$this->loadLayout();
			$this->_setActiveMenu('slider/set_time');
			$this->_addBreadcrumb('slider Manager', 'slider Manager');
			$this->_addBreadcrumb('Test Description', 'Test Description');
			$this
				->getLayout()->getBlock('head')
				->setCanLoadExtJs(true);
			$this
				->_addContent($this->getLayout()
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
       try
       {
            $postData = $this->getRequest()->getPost();
            if(isset($_FILES['image']['size']) && $_FILES['image']['size'] != null)
            {
                $imageHelper = Mage::helper('slider/image');
                $imageFile = $imageHelper->uploadImage('image');
                $postData['image'] = $imageHelper->getMediaPath().'/'.$imageFile;                
            }
            else
            {
                unset($postData['image']);
            }


             $testModel = Mage::getModel('slider/slider');
           if( $this->getRequest()->getParam('id') <= 0 )
              $testModel->setCreatedTime(
                 Mage::getSingleton('core/date')
                        ->gmtDate()
                );

                $products = $this->getRequest()->getPost('products', -1);
                if ($products != -1)
                {
                    $testModel->setProductsData(Mage::helper('adminhtml/js')->decodeGridSerializedInput($products));
                }

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
      catch (Exception $e)
      {
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
}