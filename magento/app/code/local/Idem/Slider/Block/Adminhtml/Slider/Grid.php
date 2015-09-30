<?php

class Idem_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	public function __construct(){
	     parent::__construct();
       $this->setId('sliderGrid');
       $this->setDefaultSort('id_idem_slider');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
	
   protected function _prepareCollection(){
   	
      $collection = Mage::getModel('slider/slider')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }	
	
	 protected function _prepareColumns(){
   	
			$this->addColumn('id_idem_slider',
		             array(
		                    'header' => 'ID',
		                    'align' =>'right',
		                    'width' => '50px',
		                    'index' => 'slide_id',
		    ));
			
	       	$this->addColumn('titre',
	               array(
	                    'header' => 'Titre',
	                    'align' =>'left',
	                    'index' => 'titre',
	        ));
			
		 	$this->addColumn('url',
	       array(
	            'header' => 'url',
	            'align' =>'left',
	            'index' => 'url',
	      	));
			
			$this->addColumn('image',
	       array(
	            'header' => 'image',
	            'align' =>'left',
	            'index' => 'image',
	      	));
			
			
	       	$this->addColumn('product_id', array(
	                    'header' => 'product_id',
	                    'align' =>'left',
	                    'index' => 'product_id'
	        ));
			
		
			
			
			
			
	
	return parent::_prepareColumns();
   }
	
	 public function getRowUrl($row){
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


	protected function _prepareMassaction(){
		
	$this->setMassactionIdField('slide_id');
	$this->getMassactionBlock()->setFormFieldName('slide_id');
	 
	$this->getMassactionBlock()->addItem('delete', array(
	'label'=> Mage::helper('slider')->__('Delete'),
	'url'  => $this->getUrl('*/*/massDelete', array('' => '')), // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
	'confirm' => Mage::helper('slider')->__('Are you sure?')
	));
	
	
	 
	return $this;
	}
	
	

}