<?php 
 	$installer = $this;
 	$installer->startSetup();
 	try
 	{
	 	$installer->run
	 		(
		 		"ALTER TABLE {$this->getTable('testimonial')} ADD COLUMN is_validate BOOLEAN DEFAULT FALSE;"
	 		);
 	}
 	catch(Exception $e)
 	{
 		echo 'Exception recu : ', $e->getMessage();
 	}
 	$installer->endSetup();
 ?>