<?php

    class Idem_Slider_Block_Slider extends Mage_Core_Block_Template{
        
        public function initSlider(){
            
            $init ='';
            $initSpeedTransition = Mage::getStoreConfig('slider/slider_group/speed_transition',Mage::app()->getStore());
            $initSlideTime = Mage::getStoreConfig('slider/slider_group/slide_time',Mage::app()->getStore());
            $initAuto = Mage::getStoreConfig('slider/slider_group/auto',Mage::app()->getStore());
            
            if($initAuto){
                $init .= 'auto : true,';
            }else{
                $init .= 'auto : false,';
            }            
            $init .= 'speed:'.$initSpeedTransition.',';
            $init .= 'pause:'.$initSlideTime;
            
            return $init;
                       
        }

    
    }