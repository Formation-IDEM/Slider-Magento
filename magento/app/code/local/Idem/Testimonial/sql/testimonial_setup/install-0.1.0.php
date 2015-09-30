<?php
$installer = $this;

$installer->startSetup();

$installer->run("
	CREATE TABLE IF NOT EXISTS {$this->getTable('testimonial')} (
		`testimonial_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`title` VARCHAR(255) DEFAULT '',
		`message` VARCHAR(255) DEFAULT '',
		`customer_id` INT NOT NULL DEFAULT 0,
		`created_time` datetime DEFAULT NULL
	)");

$installer->endSetup();

?>