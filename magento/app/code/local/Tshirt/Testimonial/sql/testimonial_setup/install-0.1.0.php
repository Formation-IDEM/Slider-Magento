<?php 
 	$installer = $this;
 	$installer->startSetup();
 	try
 	{
	 	$installer->run
	 		(
		 		"CREATE TABLE {$this->getTable('testimonial')}
		 		(
		 			testimonial_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
		 			titre VARCHAR(100) NOT NULL,
		 			message VARCHAR(255) NOT NULL,
		 			customer_id INT,
		 			created_time DATE
		 		)"
	 		);
 	}
 	catch(Exception $e)
 	{
 		echo 'Exception recu : ', $e->getMessage();
 	}
 	$installer->endSetup();
 ?>