<?php

$installer = $this;
$installer -> startSetup();

$installer -> run("	
	ALTER TABLE {$this->getTable('testimonial')}
	ADD COLUMN `is_validate` BOOLEAN NOT NULL DEFAULT FALSE;
");

$installer -> endSetup();
?>