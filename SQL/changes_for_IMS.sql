CREATE TABLE `ams_ims`.`attributes`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(255) NOT NULL ,
    `status` INT(10) UNSIGNED NOT NULL DEFAULT '1',
    `created_by` INT(10) UNSIGNED NULL ,
    `updated_by` INT(10) UNSIGNED NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES (NULL, 'Attributes', 'attributes', NULL, NULL);
INSERT INTO `access_level` (`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`)
VALUES (NULL, '1', '1', '1', '1', '129', '1', '1', '1', NULL, NULL);

ALTER TABLE `attributes` ADD CONSTRAINT `attributes_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `attributes` ADD CONSTRAINT `attributes_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `ams_ims`.`attribute_values`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `attribute_id` INT(10) UNSIGNED NOT NULL ,
    `value` VARCHAR(255) NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `item` ADD `carton_size` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `unit_type`;

CREATE TABLE `ams_ims`.`item_variations`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `variation_name` VARCHAR(255) NOT NULL ,
    `variation_sales_rate` VARCHAR(255) NULL DEFAULT NULL ,
    `variation_purchase_rate` VARCHAR(255) NULL DEFAULT NULL ,
    `variation_about` VARCHAR(255) NULL DEFAULT NULL ,
    `item_id` INT(10) UNSIGNED NOT NULL ,
    `sku` VARCHAR(255) NULL ,
    `status` INT(10) UNSIGNED NOT NULL DEFAULT '1',
    `created_by` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
 ENGINE = InnoDB;

 ALTER TABLE `item_variations` ADD CONSTRAINT `attribute_variations_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
 ALTER TABLE `item_variations` ADD CONSTRAINT `attribute_variations_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
 ALTER TABLE `item_variations` ADD CONSTRAINT `attribute_variations_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

 CREATE TABLE `ams_ims`.`item_variation_attribute_values`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `item_variation_id` INT(10) UNSIGNED NOT NULL ,
    `attribute_values_id` INT(10) UNSIGNED NOT NULL,
    `attribute_id` INT(10) UNSIGNED NOT NULL ,
    `variation_value` VARCHAR(255) NOT NULL ,
    `created_by` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `item_variation_attribute_values` ADD CONSTRAINT `item_variation_attribute_values_item_variations_id_fk` FOREIGN KEY (`item_variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `item_variation_attribute_values` ADD CONSTRAINT `item_variation_attribute_values_attribute_values_fk` FOREIGN KEY (`attribute_values_id`) REFERENCES `attribute_values`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `item_variation_attribute_values` ADD CONSTRAINT `item_variation_attribute_values_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `item_variation_attribute_values` ADD CONSTRAINT `item_variation_attribute_values_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `bill` ADD `branch_id` INT(10) UNSIGNED NOT NULL AFTER `file_url`;

ALTER TABLE ams_ims.item_variation_attribute_values DROP FOREIGN KEY item_variation_attribute_values_attribute_id_fk;

ALTER TABLE `item_variation_attribute_values`
  DROP `attribute_id`,
  DROP `variation_value`;

-- After hour changes 2022-09-27

CREATE TABLE `ams_ims`.`offers`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `item_id` INT(10) UNSIGNED NOT NULL ,
    `base_quantity` INT(11) UNSIGNED NOT NULL ,
    `start_date` TIMESTAMP NOT NULL ,
    `end_date` TIMESTAMP NOT NULL ,
    `free_item_id` INT(10) UNSIGNED NULL ,
    `free_quantity` INT(11) UNSIGNED NULL ,
    `cashback_amount` DOUBLE UNSIGNED NULL ,
    `cashback_type` INT(11) UNSIGNED NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES (NULL, 'Offer', 'offer', NULL, NULL);

INSERT INTO `access_level` 
    (`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`)
    VALUES (NULL, '1', '1', '1', '1', '131', '1', '1', '1', '2022-09-28 02:42:13', '2022-09-28 02:42:13');

ALTER TABLE `offers` ADD CONSTRAINT `offer_item_fk` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `offers` ADD CONSTRAINT `offer_free_item_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `offers` ADD CONSTRAINT