<?php

class Idem_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('testimonialGrid');
       $this->setDefaultSort('id_idem_testimonial');
       $this->setDefaultDir('ASC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('testimonial/testimonial')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
       $this->addColumn('id_idem_testimonial',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'testimonial_id',
               ));
       $this->addColumn('title',
               array(
                    'header' => 'Titre',
                    'align' =>'left',
                    'index' => 'title',
              ));
       $this->addColumn('message',
       			array(
                    'header' => 'Message',
                    'align' =>'left',
                    'index' => 'message',
             ));
       $this->addColumn('customer_id',
       			array(
                    'header' => 'Auteur ID',
                    'align' =>'left',
                    'index' => 'customer_id',
             ));
       $this->addColumn('is_validate',
       			array(
                    'header' => 'Validé?',
                    'align' =>'left',
                    'index' => 'is_validate',
             ));
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
	
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('approved_field_id');
		$this->getMassactionBlock()->setFormFieldName('approved_id');
		 
		$this->getMassactionBlock()->addItem('approved', array(
			'label'=> Mage::helper('testimonial')->__('Approved'),
			'url'  => $this->getUrl('*/*/massApproved', array('' => ''))
		));
		$this->getMassactionBlock()->addItem('disapproved', array(
			'label'=> Mage::helper('testimonial')->__('Disapproved'),
			'url'  => $this->getUrl('*/*/massDisapproved', array('' => ''))
		));
		$this->getMassactionBlock()->addItem('delete', array(
			'label'=> Mage::helper('testimonial')->__('Delete'),
			'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
			'confirm' => Mage::helper('testimonial')->__('Are you sure?')
		));
		return $this;
	}
}
	