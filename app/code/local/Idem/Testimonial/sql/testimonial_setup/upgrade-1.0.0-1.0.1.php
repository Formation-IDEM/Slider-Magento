<?php

$installer = $this;
$installer->startSetup();
try
{
	$installer->run("
ALTER TABLE {$this->getTable('testimonial')} ADD COLUMN approved BOOLEAN DEFAULT FALSE;
");
}
catch(Exception $e)
{
	echo 'Exception reçue : ',  $e->getMessage(), "\n";
	exit;
}

$installer->endSetup();