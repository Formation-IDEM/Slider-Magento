<?php 

/**
* 
*/
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
		$collection = Mage::getResourceModel($this->_getCollectionClass()); 
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
    	$this->addColumn('slide_id',
            array(
                    'header' => 'id',
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
                    'header' => 'Url',
                    'align' =>'left',
                    'index' => 'url',
            ));
    	$this->addColumn('image', 
       		array(
                    'header' => 'Image',
                    'align' =>'left',
                    'index' => 'image',
            ));
    	$this->addColumn('product_id', 
    		array(
                    'header' => 'id du produit',
                    'align' =>'left',
                    'index' => 'product_id',
            ));
        
    	return parent::_prepareColumns();
    }

      protected function _prepareMassaction()
    {
        $this->setMassactionIdField('delete_slide_id');
        $this->getMassactionBlock()->setFormFieldName('slide_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('slider')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('slider')->__('supprimer?')
        ));
        return $this;
    }


	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}

 ?>