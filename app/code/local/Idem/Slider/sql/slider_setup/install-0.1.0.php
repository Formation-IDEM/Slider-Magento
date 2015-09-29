<?php

//Pour crée un fichier d'update-> update-0.1.0-0.1.1

$installer = $this;
$installer->startSetup();
$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('slider')};
    CREATE TABLE {$this->getTable('slider')} (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `titre` varchar(255),
        `url` varchar(255),
        `image` varchar(255),
        `product_id` int(11),
        PRIMARY KEY (`id`)
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
");
$installer->endSetup();

?>