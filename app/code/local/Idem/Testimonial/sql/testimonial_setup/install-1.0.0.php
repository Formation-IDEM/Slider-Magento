<?php

$installer = $this;
$installer->startSetup();
try{
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('testimonial')};
CREATE TABLE {$this->getTable('testimonial')} (
	`testimonial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL DEFAULT '',
	`content` text NOT NULL,
	`customer_id` smallint( 11 ) NOT NULL default '0',
	`created_time` datetime DEFAULT NULL,
	PRIMARY KEY ( `testimonial_id` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO {$this->getTable('testimonial')} VALUES (NULL, 'Welcome to Testimonial Module', 'test this content', '0', NOW( ));

");
}catch(Exception $e){
	 echo 'Exception reçue : ',  $e->getMessage(), "\n";
	 exit;
}

$installer->endSetup();