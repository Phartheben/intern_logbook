<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483933044.
 * Generated on 2017-01-09 03:37:24 by Pharz
 */
class PropelMigration_1483933044
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

ALTER TABLE `activity` DROP `update_at`;

ALTER TABLE `activity` DROP `update_by`;

ALTER TABLE `activity` DROP `create_at`;

ALTER TABLE `activity` DROP `create_by`;

ALTER TABLE `comment` DROP `update_at`;

ALTER TABLE `comment` DROP `update_by`;

ALTER TABLE `comment` DROP `create_at`;

ALTER TABLE `comment` DROP `create_by`;

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

ALTER TABLE `activity`
    ADD `update_at` VARCHAR(255) AFTER `description`,
    ADD `update_by` VARCHAR(255) AFTER `update_at`,
    ADD `create_at` VARCHAR(255) AFTER `update_by`,
    ADD `create_by` VARCHAR(255) AFTER `create_at`;

ALTER TABLE `comment`
    ADD `update_at` VARCHAR(255) AFTER `activity_id`,
    ADD `update_by` VARCHAR(255) AFTER `update_at`,
    ADD `create_at` VARCHAR(255) AFTER `update_by`,
    ADD `create_by` VARCHAR(255) AFTER `create_at`;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}