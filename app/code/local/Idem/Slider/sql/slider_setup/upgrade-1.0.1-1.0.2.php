<?php

$installer = $this;
$installer->startSetup();
try
{
    $this->run("
    DROP TABLE IF EXISTS {$this->getTable('slider/slider_product')};
    CREATE TABLE {$this->getTable('slider/slider_product')} (
        `rel_id` int(11) unsigned NOT NULL auto_increment,
        `slide_id` int(11) unsigned NOT NULL,
        `product_id` int(11) unsigned NOT NULL,
        `position` int(11) unsigned NOT NULL default '0',
    PRIMARY KEY  (`rel_id`),
    UNIQUE KEY `UNIQUE_SLIDER_PRODUCT` (`slide_id`,`product_id`),
    CONSTRAINT `IDEM_SLIDER_SLIDER_PRODUCT` FOREIGN KEY (`slide_id`) REFERENCES {$this->getTable('slider')} (`slide_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `IDEM_SLIDER_PRODUCT_SLIDER` FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog_product_entity')} (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
    )
    ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
}
catch(Exception $e)
{
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
    exit;
}

$installer->endSetup();