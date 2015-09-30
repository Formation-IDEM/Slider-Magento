<?php

class Idem_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	public function __construct(){
	     parent::__construct();
       $this->setId('testimonialGrid');
       $this->setDefaultSort('id_idem_testimonial');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
	
   protected function _prepareCollection(){
   	
      $collection = Mage::getModel('testimonial/testimonial')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }	
	
	 protected function _prepareColumns(){
   	
			$this->addColumn('id_idem_testimonial',
		             array(
		                    'header' => 'ID',
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
			
	       	$this->addColumn('customer_id', array(
	                    'header' => 'customer_id',
	                    'align' =>'left',
	                    'index' => 'customer_id',
	                    'renderer' => 'Idem_Testimonial_Block_Adminhtml_Testimonial_Renderer_Customer'
	        ));
			
			$this->addColumn('is_validate', array(
	                    'header' => 'Validation',
	                    'align' =>'left',
	                    'index' => 'is_validate',
	        ));
			
			
			
			
	
	return parent::_prepareColumns();
   }
	
	 public function getRowUrl($row){
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


	protected function _prepareMassaction(){
		
	$this->setMassactionIdField('testimonial_id');
	$this->getMassactionBlock()->setFormFieldName('testimonial_id');
	 
	$this->getMassactionBlock()->addItem('delete', array(
	'label'=> Mage::helper('testimonial')->__('Delete'),
	'url'  => $this->getUrl('*/*/massDelete', array('' => '')), // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
	'confirm' => Mage::helper('testimonial')->__('Are you sure?')
	));
	
	$this->getMassactionBlock()->addItem('validate', array(
	'label'=> Mage::helper('testimonial')->__('Validate'),
	'url'  => $this->getUrl('*/*/massValidate', array('' => '')), // public function massValidateAction() in Mage_Adminhtml_Tax_RateController
	'confirm' => Mage::helper('testimonial')->__('Are you sure?')
	));
	 
	return $this;
	}
	
	

}