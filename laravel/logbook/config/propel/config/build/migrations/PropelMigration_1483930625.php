<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483930625.
 * Generated on 2017-01-09 02:57:05 by Pharz
 */
class PropelMigration_1483930625
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'orm' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `comments`;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER(11);

CREATE TABLE `comment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `activity_id` INTEGER,
    `update_at` VARCHAR(255),
    `update_by` VARCHAR(255),
    `create_at` VARCHAR(255),
    `create_by` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `comment_FI_1` (`activity_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'orm' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `comment`;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER;

CREATE TABLE `comments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `activity_id` INTEGER,
    `update_at` VARCHAR(255),
    `update_by` VARCHAR(255),
    `create_at` VARCHAR(255),
    `create_by` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `comments_FI_1` (`activity_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}