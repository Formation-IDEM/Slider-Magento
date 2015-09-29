<?php
class Idem_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('sliderGrid');
       $this->setDefaultSort('id_idem_slider');
       $this->setDefaultDir('DESC');
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
        $this->setMassactionIdField('slider_id');
        $this->getMassactionBlock()->setFormFieldName('id');        
        
        //Affiche l'action de masse Supprimer
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('slider')->__('Supprimer'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('slider')->__('Êtes vous sur?')
        ));
         
        return $this;
    }

   protected function _prepareColumns()
   {
       $this->addColumn('id_idem_slider',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id',
               ));
       $this->addColumn('titre',
               array(
                    'header' => 'titre',
                    'align' =>'left',
                    'index' => 'titre',
              ));
       $this->addColumn('product_id',
               array(
                    'header' => 'product_id',
                    'align' =>'left',
                    'index' => 'product_id',
              ));       
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}