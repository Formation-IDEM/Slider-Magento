<?php

$installer = $this;
$installer->startSetup();
try {
    $installer->run("
    ALTER TALBE {$this->getTable('testimonial')} ADD `is_active` BOOLEAN DEFAULT FALSE
");
} catch( Exception $e ) {
    Mage::logException($e);
}
$installer->endSetup();

/*
**  End Of File
*/
?>