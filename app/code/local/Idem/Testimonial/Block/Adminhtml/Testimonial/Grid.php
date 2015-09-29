<?php

class Idem_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('idem_testimonial_grid');
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
        $collection = Mage::getModel('testimonial/testimonial')->getCollection();
    //     $collection = Mage::getResourceModel($this->_getCollectionClass());
    //     /* adding customer name section */       
    //     $customerFirstNameAttr = Mage::getSingleton('customer/customer')->getResource()->getAttribute('firstname');
    //     $customerLastNameAttr = Mage::getSingleton('customer/customer')->getResource()->getAttribute('lastname');
    //     $collection
    //         ->getSelect()
    //         ->joinLeft(
    //             array('cusFirstnameTb' => $customerFirstNameAttr->getBackend()->getTable()),
    //             'main_table.customer_id = cusFirstnameTb.entity_id AND cusFirstnameTb.attribute_id = '.$customerFirstNameAttr->getId(). ' AND cusFirstnameTb.entity_type_id = '.Mage::getSingleton('customer/customer')->getResource()->getTypeId(),
    //             array('cusFirstnameTb.value')
    //         );   
    //     $collection
    //         ->getSelect()
    //         ->joinLeft(
    //             array('cusLastnameTb' => $customerLastNameAttr->getBackend()->getTable()),
    //             'main_table.customer_id = cusLastnameTb.entity_id AND cusLastnameTb.attribute_id = '.$customerLastNameAttr->getId(). ' AND cusLastnameTb.entity_type_id = '.Mage::getSingleton('customer/customer')->getResource()->getTypeId(),
    //             array('customer_name' => "CONCAT(cusFirstnameTb.value, ' ', cusLastnameTb.value)")
    //         ); 
    // /* end adding customer name section */ 
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('testimonial_id', array(
            'header' => 'id',
            'sortable' => true,
            'width' => '60',
            'index' => 'testimonial_id'
        ));

        $this->addColumn('title', array(
            'header' => 'Titre',
            'sortable' => true,
            'width' => '60',
            'index' => 'title',
        ));

        $this->addColumn('content', array(
            'header' => 'Contenu',
            'sortable' => true,
            'width' => '60',
            'index' => 'content',
        ));

        // $this->addColumn('customer_name', array(
        //     'header'    => 'Nom du membre',
        //     'index'     => 'customer_name',
        //     'filter_condition_callback' => array($this, 'customerNameFilter'),
        //     'width'     => '120px',
        // ));

        $this->addColumn('customer_id', array(
            'header'    => 'Membre',
            'index'     => 'customer_id',
            'filter_condition_callback' => array($this, 'customerNameFilter'),
            'width'     => '120px',
            'type'      => 'text',
            'renderer' =>  'Idem_Testimonial_Block_Adminhtml_Testimonial_Renderer_MyRender'
        ));
        
        $this->addColumn('approved', array(
            'header' => 'Approuvé ?',
            'sortable' => true,
            'width' => '60',
            'index' => 'approved',
            'type'    => 'options',
            'options' => array('1' => 'Oui', '0' => 'Non')
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('testimonial_id');
        $this->getMassactionBlock()->setFormFieldName('testimonial_id');
         
        $this->getMassactionBlock()
            ->addItem('delete', array(
                'label'=> Mage::helper('tax')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
                'confirm' => Mage::helper('tax')->__('Are you sure?')
            ))
            ->addItem('approve', array(
                'label'=> 'Approuver',
                'url'  => $this->getUrl('*/*/massApprove', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            ))
            ->addItem('unapprove', array(
                'label'=> 'Désapprouver',
                'url'  => $this->getUrl('*/*/massUnapprove', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            ));

        return $this;
    }

    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    // public function customerNameFilter($collection, $column)
    // {
    //     $filterValue = $column->getFilter()->getValue();
    //     if(!is_null($filterValue))
    //     {
    //         $filterValue = trim($filterValue);
    //         $filterValue = preg_replace('/[\s]+/', ' ', $filterValue);
     
    //         $whereArr = array();
    //         $whereArr[] = $collection->getConnection()->quoteInto("cusFirstnameTb.value = ?", $filterValue);
    //         $whereArr[] = $collection->getConnection()->quoteInto("cusLastnameTb.value = ?", $filterValue);
    //         $whereArr[] = $collection->getConnection()->quoteInto("CONCAT(cusFirstnameTb.value, ' ', cusLastnameTb.value) = ?", $filterValue);
    //         $where = implode(' OR ', $whereArr);
    //         $collection->getSelect()->where($where);
    //     }
    // }


}