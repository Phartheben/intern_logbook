<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1483936456.
 * Generated on 2017-01-09 04:34:16 by Pharz
 */
class PropelMigration_1483936456
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

ALTER TABLE `oauth_access_codes` CHANGE `user_id` `user_id` INTEGER(11);

ALTER TABLE `oauth_access_codes` CHANGE `client_id` `client_id` INTEGER(11);

ALTER TABLE `oauth_access_codes` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_access_codes` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_access_codes` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_access_codes` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `user_id` `user_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_access_tokens` CHANGE `updated_by` `updated_by` INTEGER(11);

ALTER TABLE `oauth_clients` CHANGE `user_id` `user_id` INTEGER(11);

ALTER TABLE `oauth_clients` CHANGE `redirect` `redirect` TEXT(11);

ALTER TABLE `oauth_clients` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_clients` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_clients` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_clients` CHANGE `updated_by` `updated_by` INTEGER(11);

CREATE INDEX `oauth_clients_FI_1` ON `oauth_clients` (`user_id`);

ALTER TABLE `oauth_personal_access_clients` CHANGE `client_id` `client_id` INTEGER(11);

ALTER TABLE `oauth_personal_access_clients` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_personal_access_clients` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_personal_access_clients` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_personal_access_clients` CHANGE `updated_by` `updated_by` INTEGER(11);

CREATE INDEX `oauth_personal_access_clients_FI_1` ON `oauth_personal_access_clients` (`client_id`);

ALTER TABLE `oauth_refresh_tokens` CHANGE `created_at` `created_at` INTEGER(11);

ALTER TABLE `oauth_refresh_tokens` CHANGE `created_by` `created_by` INTEGER(11);

ALTER TABLE `oauth_refresh_tokens` CHANGE `updated_at` `updated_at` INTEGER(11);

ALTER TABLE `oauth_refresh_tokens` CHANGE `updated_by` `updated_by` INTEGER(11);

CREATE INDEX `oauth_refresh_tokens_FI_1` ON `oauth_refresh_tokens` (`access_token_id`);

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

ALTER TABLE `oauth_access_codes` CHANGE `user_id` `user_id` INTEGER;

ALTER TABLE `oauth_access_codes` CHANGE `client_id` `client_id` INTEGER;

ALTER TABLE `oauth_access_codes` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_access_codes` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_access_codes` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_access_codes` CHANGE `updated_by` `updated_by` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `user_id` `user_id` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `client_id` `client_id` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_access_tokens` CHANGE `updated_by` `updated_by` INTEGER;

DROP INDEX `oauth_clients_FI_1` ON `oauth_clients`;

ALTER TABLE `oauth_clients` CHANGE `user_id` `user_id` INTEGER;

ALTER TABLE `oauth_clients` CHANGE `redirect` `redirect` VARCHAR;

ALTER TABLE `oauth_clients` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_clients` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_clients` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_clients` CHANGE `updated_by` `updated_by` INTEGER;

DROP INDEX `oauth_personal_access_clients_FI_1` ON `oauth_personal_access_clients`;

ALTER TABLE `oauth_personal_access_clients` CHANGE `client_id` `client_id` INTEGER;

ALTER TABLE `oauth_personal_access_clients` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_personal_access_clients` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_personal_access_clients` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_personal_access_clients` CHANGE `updated_by` `updated_by` INTEGER;

DROP INDEX `oauth_refresh_tokens_FI_1` ON `oauth_refresh_tokens`;

ALTER TABLE `oauth_refresh_tokens` CHANGE `created_at` `created_at` INTEGER;

ALTER TABLE `oauth_refresh_tokens` CHANGE `created_by` `created_by` INTEGER;

ALTER TABLE `oauth_refresh_tokens` CHANGE `updated_at` `updated_at` INTEGER;

ALTER TABLE `oauth_refresh_tokens` CHANGE `updated_by` `updated_by` INTEGER;

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