<?php

$installer = $this;
$installer -> startSetup();
try {
	$installer -> run("	
	DROP TABLE IF EXISTS {$this->getTable('testimonial')};
	CREATE TABLE {$this->getTable('testimonial')} (
	`testimonial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`titre` varchar(255) NOT NULL DEFAULT '',
	`message` varchar(255) NOT NULL DEFAULT '',
	`customer_id` int(11) NOT NULL,
	`created_time` datetime DEFAULT NULL, 
	PRIMARY KEY (`testimonial_id`)
	) ENGINE = InnoDB DEFAULT CHARSET = utf8;
	");
} catch (Exception $e) {
    Mage::logException($e);
}

$installer -> endSetup();
?>

