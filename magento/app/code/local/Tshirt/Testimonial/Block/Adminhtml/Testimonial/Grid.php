<?php 

/**
* 
*/
class Tshirt_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	 public function __construct()
   {
       parent::__construct();
       $this->setId('tshirt_testimonial_grid');
       $this->setDefaultSort('testimonial_id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }

   	protected function _getCollectionClass()
	{
	    return 'testimonial/testimonial_collection';
	}

	protected function _prepareCollection()
	{
	$collection = Mage::getResourceModel($this->_getCollectionClass());
	    /* adding customer name section */       
	$customerFirstNameAttr = Mage::getSingleton('customer/customer')->getResource()->getAttribute('firstname');
	$customerLastNameAttr = Mage::getSingleton('customer/customer')->getResource()->getAttribute('lastname');
	$collection->getSelect()
	                    ->joinLeft(
	                        array('cusFirstnameTb' => $customerFirstNameAttr->getBackend()->getTable()),
	                        'main_table.customer_id = cusFirstnameTb.entity_id AND cusFirstnameTb.attribute_id = '.$customerFirstNameAttr->getId(). ' AND cusFirstnameTb.entity_type_id = '.Mage::getSingleton('customer/customer')->getResource()->getTypeId(),
	                        array('cusFirstnameTb.value')
	                    );   
	     
	$collection->getSelect()
	                    ->joinLeft(
	                        array('cusLastnameTb' => $customerLastNameAttr->getBackend()->getTable()),
	                        'main_table.customer_id = cusLastnameTb.entity_id AND cusLastnameTb.attribute_id = '.$customerLastNameAttr->getId(). ' AND cusLastnameTb.entity_type_id = '.Mage::getSingleton('customer/customer')->getResource()->getTypeId(),
	                        array('customer_name' => "CONCAT(cusFirstnameTb.value, ' ', cusLastnameTb.value)")
                    ); 
    /* end adding customer name section */ 
    $this->setCollection($collection);
    return parent::_prepareCollection();
	}


   protected function _prepareColumns()
   {
       $this->addColumn('testimonial_id',
             array(
                    'header' => 'id',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'testimonial_id',
               ));
       $this->addColumn('titre',
               array(
                    'header' => 'Titre',
                    'align' =>'left',
                    'index' => 'titre',
              ));
       $this->addColumn('message',
               array(
                    'header' => 'Message',
                    'align' =>'left',
                    'index' => 'message',
              ));
       $this->addColumn('created_time', array(
                    'header' => 'Date de création',
                    'align' =>'left',
                    'index' => 'created_time',
             ));
       $this->addColumn('customer_name', array(
                    'header' => Mage::helper('adminhtml')->__('Customer Name'),
                    'align' =>'left',
                    'index' => 'customer_name',
             ));
       $this->addColumn('is_validate', array(
                    'header' => 'Validé',
                    'align' =>'left',
                    'index' => 'is_validate',
             ));
        
         return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
	{
		$this->setMassactionIdField('delete_testimonial_id');
		$this->getMassactionBlock()->setFormFieldName('testimonial_id');

		$this->getMassactionBlock()->addItem('delete', array(
			'label'=> Mage::helper('testimonial')->__('Delete'),
			'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
			'confirm' => Mage::helper('testimonial')->__('Are you sure?')
		));
		$this->getMassactionBlock()->addItem('approuve', array(
			'label'=> Mage::helper('testimonial')->__('Approuve'),
			'url'  => $this->getUrl('*/*/massApprouve', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
			'confirm' => Mage::helper('testimonial')->__('Are you sure?')
		));
		$this->getMassactionBlock()->addItem('disapprouve', array(
			'label'=> Mage::helper('testimonial')->__('Désapprouve'),
			'url'  => $this->getUrl('*/*/massDisApprouve', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
			'confirm' => Mage::helper('testimonial')->__('Are you sure?')
		));
		return $this;
	}


    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}

 ?>