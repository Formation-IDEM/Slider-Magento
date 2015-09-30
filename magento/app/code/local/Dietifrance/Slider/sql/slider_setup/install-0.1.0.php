<?php

$installer = $this;
$installer -> startSetup();
try {
	$installer -> run("	
	DROP TABLE IF EXISTS {$this->getTable('slider')};
	CREATE TABLE {$this->getTable('slider')} (
	`slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`titre` varchar(255) NOT NULL DEFAULT '',
	`url` varchar(255) NOT NULL DEFAULT '',
	`image` varchar(255) NOT NULL DEFAULT '',
	`product_id` int(11) NOT NULL,
	PRIMARY KEY (`slide_id`)
	) ENGINE = InnoDB DEFAULT CHARSET = utf8;
	");
} catch (Exception $e) {
    Mage::logException($e);
}

$installer -> endSetup();
?>