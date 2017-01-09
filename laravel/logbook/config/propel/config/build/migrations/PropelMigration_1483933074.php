<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483933074.
 * Generated on 2017-01-09 03:37:54 by Pharz
 */
class PropelMigration_1483933074
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

ALTER TABLE `activity`
    ADD `created_at` INTEGER(11) AFTER `description`,
    ADD `created_by` INTEGER(11) AFTER `created_at`,
    ADD `updated_at` INTEGER(11) AFTER `created_by`,
    ADD `updated_by` INTEGER(11) AFTER `updated_at`;

ALTER TABLE `comment`
    ADD `created_at` INTEGER(11) AFTER `activity_id`,
    ADD `created_by` INTEGER(11) AFTER `created_at`,
    ADD `updated_at` INTEGER(11) AFTER `created_by`,
    ADD `updated_by` INTEGER(11) AFTER `updated_at`;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER(11);

ALTER TABLE `role`
    ADD `created_at` INTEGER(11) AFTER `value`,
    ADD `created_by` INTEGER(11) AFTER `created_at`,
    ADD `updated_at` INTEGER(11) AFTER `created_by`,
    ADD `updated_by` INTEGER(11) AFTER `updated_at`;

ALTER TABLE `user`
    ADD `created_at` INTEGER(11) AFTER `role_id`,
    ADD `created_by` INTEGER(11) AFTER `created_at`,
    ADD `updated_at` INTEGER(11) AFTER `created_by`,
    ADD `updated_by` INTEGER(11) AFTER `updated_at`;

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

ALTER TABLE `activity` DROP `created_at`;

ALTER TABLE `activity` DROP `created_by`;

ALTER TABLE `activity` DROP `updated_at`;

ALTER TABLE `activity` DROP `updated_by`;

ALTER TABLE `comment` DROP `created_at`;

ALTER TABLE `comment` DROP `created_by`;

ALTER TABLE `comment` DROP `updated_at`;

ALTER TABLE `comment` DROP `updated_by`;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER;

ALTER TABLE `role` DROP `created_at`;

ALTER TABLE `role` DROP `created_by`;

ALTER TABLE `role` DROP `updated_at`;

ALTER TABLE `role` DROP `updated_by`;

ALTER TABLE `user` DROP `created_at`;

ALTER TABLE `user` DROP `created_by`;

ALTER TABLE `user` DROP `updated_at`;

ALTER TABLE `user` DROP `updated_by`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}