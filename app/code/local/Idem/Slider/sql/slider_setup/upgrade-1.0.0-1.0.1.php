<?php

$installer = $this;
$installer->startSetup();
try
{
	$installer->run("
ALTER TABLE {$this->getTable('slider')} ADD COLUMN active BOOLEAN DEFAULT FALSE;
");
}
catch(Exception $e)
{
	echo 'Exception reçue : ',  $e->getMessage(), "\n";
	exit;
}

$installer->endSetup();