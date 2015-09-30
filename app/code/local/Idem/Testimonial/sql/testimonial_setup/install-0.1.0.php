<?php
/**
 *  install-0.1.0.php
 *  ------------
 * @created at : 17/09/15
 */

$installer = $this;
$installer->startSetup();
try {
    $installer->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('testimonial')} (
      `testimonial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `title` varchar(255) DEFAULT '',
      `content` varchar(255) NOT NULL DEFAULT '',
      `customer_id` int(11) NOT NULL DEFAULT 0,
      `created_time` datetime DEFAULT NULL,
      PRIMARY KEY(`testimonial_id`)
    )ENGINE = InnoDB DEFAULT CHARSET = utf8;
");
} catch( Exception $e ) {
    Mage::logException($e);
}
$installer->endSetup();

/*
**  End Of File
*/
?>