<?php 
 	$installer = $this;
 	$installer->startSetup();
 	
 	$installer->run
 		(
	 		"CREATE TABLE {$this->getTable('slider')}
	 		(
	 			slide_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	 			titre VARCHAR(100) NOT NULL DEFAULT '',
	 			url VARCHAR(255) DEFAULT '',
	 			image VARCHAR(255) DEFAULT '',
	 			product_id INT NOT NULL DEFAULT 0
	 		)"
 		);
 	
 	$installer->endSetup();
 ?>