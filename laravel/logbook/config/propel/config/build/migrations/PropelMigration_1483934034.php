<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483934034.
 * Generated on 2017-01-09 03:53:54 by Pharz
 */
class PropelMigration_1483934034
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

ALTER TABLE `activity` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `activity` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `activity` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `activity` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `comment` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `comment` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `comment` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `comment` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `user_id` `user_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `role` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `role` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `role` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `role` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `user` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `user` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `user` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `user` CHANGE `updated_by` `updated_by` INTEGER(11);

CREATE TABLE `oauth_access_codes`
(
    `id` VARCHAR(100) NOT NULL,
    `user_id` INTEGER(11),
    `client_id` INTEGER(11),
    `scopes` TEXT,
    `revoked` TINYINT(1),
    `expires_at` DATETIME,
    `created_at` INTEGER(11),
    `created_by` INTEGER(11),
    `updated_at` INTEGER(11),
    `updated_by` INTEGER(11),
    PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `oauth_access_codes`;

ALTER TABLE `activity` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `activity` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `activity` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `activity` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `comment` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `comment` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `comment` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `comment` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `user_id` `user_id` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `role` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `role` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `role` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `role` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `user` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `user` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `user` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `user` CHANGE `updated_by` `updated_by` INTEGER;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}