<?php
/**
 *  Grid.php
 *  ------------
 * @created at : 18/09/15
 */

class Idem_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('testimonialGrid');
        $this->setDefaultSort('created_time');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'testimonial/testimonial_collection';
    }

    protected function _prepareMassaction()
    {
        //parent::_prepareMassaction();

        $this->setMassactionField('is_active');
        $this->setMassactionBlock()->setFormFieldName('testimonial_id');

        $this->getMassactionBlock()->addItem('delete', [
            'label'     =>  'Supprimer',
            'url'       =>  $this->getUrl('*/*/massdelete', ['' => '']),
            'confirm'   =>  'Êtes vous sûr ?'
        ]);

        return $this;
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

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    public function _prepareColumns()
    {
        $this->addColumn('testimonial_id', [
            'header'    =>  'ID',
            'align'     =>  'right',
            'width'     =>  '50px',
            'index'     =>  'testimonial_id'
        ]);
        $this->addColumn('title', array(
            'header'    => 'Titre',
            'align'     =>'left',
            'index'     => 'title',
        ));
        $this->addColumn('content', array(
            'header'    => 'Contenu',
            'align'     => 'left',
            'index'     => 'content',
        ));
        $this->addColumn('customer_name', array(
            'header'    =>  Mage::helper('adminhtml')->__('Customer Name'),
            'align'     =>  'center',
            'index'     =>  'customer_name'
        ));
        $this->addColumn('created_time', [
            'header'    =>  'Date de création',
            'align'     =>  'left',
            'index'     =>  'created_time',
            'type'      =>  'datetime',
            'format'    =>  Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'time'      =>  true,
            'tabindex'  => 1,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'align'     =>  'center'
        ]);
        $yesnoOptions = array('0' => 'Non', '1' => 'Oui');
        $this->addColumn('is_active', array(
            'header'    => 'Actif',
            'index'     => 'is_active',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $yesnoOptions,
        ));
        $this->addColumn('actions', [
            'header'    =>  'Actions',
            'width'     =>  100,
            'type'      =>  'action',
            'getter'    =>  'getId',
            'actions'   =>  [
                [
                    'caption'   =>  'Modifier',
                    'url'       =>  ['base' => '*/*/edit'],
                    'field'     =>  'id'
                ],
                [
                    'caption'   =>  'Supprimer',
                    'url'       =>  ['base' => '*/*/delete'],
                    'field'     =>  'id'
                ]
            ],
            'filter'    =>  false,
            'sortable'  =>  false,
            'is_system' =>  true
        ]);
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }
}

/*
**  End Of File
*/