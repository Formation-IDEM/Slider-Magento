<?php

class Idem_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('idem_slider_grid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'slider/slider_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slide_id', array(
            'header' => 'id',
            'sortable' => true,
            'width' => '60',
            'index' => 'slide_id'
        ));

        $this->addColumn('title', array(
            'header' => 'Titre',
            'sortable' => true,
            'width' => '60',
            'index' => 'title',
        ));

        $this->addColumn('active', array(
            'header' => 'Actif ?',
            'sortable' => true,
            'width' => '60',
            'index' => 'active',
            'type'    => 'options',
            'options' => array('1' => 'Oui', '0' => 'Non')
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('slide_id');
         
        $this->getMassactionBlock()
            ->addItem('delete', array(
                'label'=> Mage::helper('tax')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
                'confirm' => Mage::helper('tax')->__('Are you sure?')
            ))
            ->addItem('approve', array(
                'label'=> 'Activer',
                'url'  => $this->getUrl('*/*/massActive', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            ))
            ->addItem('unapprove', array(
                'label'=> 'Désactiver',
                'url'  => $this->getUrl('*/*/massUnactive', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            ));

        return $this;
    }

    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}