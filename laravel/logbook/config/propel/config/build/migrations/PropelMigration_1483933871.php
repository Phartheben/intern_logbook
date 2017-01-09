<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483933871.
 * Generated on 2017-01-09 03:51:11 by Pharz
 */
class PropelMigration_1483933871
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

DROP TABLE IF EXISTS `oauth_auth_codes`;

DROP TABLE IF EXISTS `oauth_clients`;

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

ALTER TABLE `activity` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `activity` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `activity` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `activity` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `comment` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `comment` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `comment` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `comment` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `migrations` CHANGE `batch` `batch` INTEGER(11);

DROP INDEX `oauth_access_tokens_user_id_index` ON `oauth_access_tokens`;

ALTER TABLE `oauth_access_tokens` CHANGE `user_id` `user_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `revoked` `revoked` TINYINT(1);

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens`
    ADD `created_by` INTEGER(11) AFTER `created_at`,
    ADD `updated_by` INTEGER(11) AFTER `updated_at`;

ALTER TABLE `role` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `role` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `role` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `role` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `user` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `user` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `user` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `user` CHANGE `updated_by` `updated_by` INTEGER(11);

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

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER NOT NULL;

ALTER TABLE `oauth_access_tokens` CHANGE `revoked` `revoked` TINYINT(1) NOT NULL;

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` DATETIME;

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` DATETIME;

ALTER TABLE `oauth_access_tokens` DROP `created_by`;

ALTER TABLE `oauth_access_tokens` DROP `updated_by`;

CREATE INDEX `oauth_access_tokens_user_id_index` ON `oauth_access_tokens` (`user_id`);

ALTER TABLE `role` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `role` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `role` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `role` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `user` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `user` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `user` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `user` CHANGE `updated_by` `updated_by` INTEGER;

CREATE TABLE `oauth_auth_codes`
(
    `id` VARCHAR(100) NOT NULL,
    `user_id` INTEGER NOT NULL,
    `client_id` INTEGER NOT NULL,
    `scopes` TEXT,
    `revoked` TINYINT(1) NOT NULL,
    `expires_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `oauth_clients`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `name` VARCHAR(255) NOT NULL,
    `secret` VARCHAR(100) NOT NULL,
    `redirect` TEXT NOT NULL,
    `personal_access_client` TINYINT(1) NOT NULL,
    `password_client` TINYINT(1) NOT NULL,
    `revoked` TINYINT(1) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB;

CREATE TABLE `oauth_personal_access_clients`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `client_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB;

CREATE TABLE `oauth_refresh_tokens`
(
    `id` VARCHAR(100) NOT NULL,
    `access_token_id` VARCHAR(100) NOT NULL,
    `revoked` TINYINT(1) NOT NULL,
    `expires_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `oauth_refresh_tokens_access_token_id_index` (`access_token_id`(100))
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}