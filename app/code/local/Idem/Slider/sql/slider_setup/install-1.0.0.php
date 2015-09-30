<?php
/**
 *  install-1.0.0.php
 *  ------------
 * @created at : 21/09/15
 */

$installer = $this;
$installer->startSetup();
try {

    $installer->run("
       CREATE TABLE IF NOT EXISTS {$this->getTable('slider')} (
        `slider_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title`VARCHAR(255) NOT NULL,
        `url` VARCHAR(255) DEFAULT '',
        `image` VARCHAR(255) NOT NULL DEFAULT '',
        `product_id` int(11) DEFAULT 0,
        PRIMARY KEY(`slider_id`)
       )ENGINE = InnoDB DEFAULT CHARSET = utf8;
    ");

} catch( Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();

/*
**  End Of File
*/