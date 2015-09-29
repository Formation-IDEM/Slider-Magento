<?php

$installer = $this;
$installer->startSetup();
try{
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('slider')};
CREATE TABLE {$this->getTable('slider')} (
	`slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL DEFAULT '',
	`url` text NOT NULL,
	`image` text NOT NULL,
	`product_id` smallint( 11 ) NOT NULL default '0',
	`created_time` datetime DEFAULT NULL,
	PRIMARY KEY ( `slide_id` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO {$this->getTable('slider')} VALUES (NULL, 'Welcome to Slider Module', '', '', '0', NOW( ));

");
}catch(Exception $e){
	 echo 'Exception reçue : ',  $e->getMessage(), "\n";
	 exit;
}

$installer->endSetup();