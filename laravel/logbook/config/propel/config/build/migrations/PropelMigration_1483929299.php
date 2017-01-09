<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483929299.
 * Generated on 2017-01-09 02:34:59 by Pharz
 */
class PropelMigration_1483929299
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

DROP TABLE IF EXISTS `activity`;

DROP TABLE IF EXISTS `comments`;

DROP TABLE IF EXISTS `role`;

DROP TABLE IF EXISTS `user`;

ALTER TABLE `migrations` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `migrations` CHANGE `migration` `migration` VARCHAR(255);

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER(11);

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

ALTER TABLE `migrations` CHANGE `id` `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `migrations` CHANGE `migration` `migration` VARCHAR(255) NOT NULL;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER NOT NULL;

CREATE TABLE `activity`
(
    `description` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `id` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    `update_at` VARCHAR(255) NOT NULL,
    `update_by` VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `comments`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `activity_id` VARCHAR(255) NOT NULL,
    `notes` VARCHAR(255) NOT NULL,
    `update_at` VARCHAR(255) NOT NULL,
    `update_by` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `role`
(
    `id` VARCHAR(255) DEFAULT \'\' NOT NULL,
    `value` VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `user`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `role_id` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}