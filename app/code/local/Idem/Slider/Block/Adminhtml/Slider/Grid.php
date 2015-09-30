<?php
/**
 *  Grid.php
 *  ------------
 * @created at : 21/09/15
 */

class Idem_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setID('sliderGrid');
        $this->setDefautSort('slider_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slider_ids');
        $this->getMassactionBlock()->setFormFieldName('ids');

        $this->getMassactionBlock()->addItem('delete', [
            'label'     =>  $this->__('Delete'),
            'url'       =>  $this->getUrl('*/*/massDelete', ['' => '']),
            'confirm'   => Mage::helper('tax')->__('Are you sure?')
        ]);
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slider_id', [
            'header'    =>  'ID',
            'align'     =>  'right',
            'width'     =>  '50px',
            'index'     =>  'slider_id'
        ]);

        $this->addColumn('title', [
            'header'    =>  $this->__('Title'),
            'align'     =>  'left',
            'index'     =>  'title'
        ]);

        $this->addColumn('url', [
            'header'    =>  $this->__('Url'),
            'align'     =>  'left',
            'index'     =>  'url'
        ]);

        $this->addColumn('image', [
            'header'    =>  $this->__('Picture'),
            'align'     =>  'left',
            'index'     =>  'image',
        ]);

        $this->addColumn('product_id', [
            'header'    =>  $this->__('Products'),
            'align'     =>  'center',
            'index'     =>  'product_id'
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