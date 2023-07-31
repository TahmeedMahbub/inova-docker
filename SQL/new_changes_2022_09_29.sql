CREATE TABLE `bill_free_entries`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `bill_id` INT(10) UNSIGNED NOT NULL ,
    `bill_entry_id` INT(10) UNSIGNED NOT NULL ,
    `offer_id` INT(10) UNSIGNED NOT NULL ,
    `free_item_id` INT(10) UNSIGNED NULL ,
    `free_item_quantity` INT(11) UNSIGNED NULL ,
    `offer_amount` INT(11) UNSIGNED NULL ,
    `offer_amount_type` INT(11) UNSIGNED NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `bill` 
    ADD `adjustment_type` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `adjustment`,
    ADD `personal_note` VARCHAR(255) NULL DEFAULT NULL AFTER `note`,
    ADD `vendor_note` VARCHAR(255) NULL DEFAULT NULL AFTER `personal_note`;

ALTER TABLE `bill_entry`
    ADD `discount` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `rate`,
    ADD `discount_type` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `discount`;

ALTER TABLE `bill_free_entries`
    ADD CONSTRAINT `bill_free_entries_bill_fk` FOREIGN KEY (`bill_id`) REFERENCES `bill`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
    ALTER TABLE `bill_free_entries` ADD CONSTRAINT `bill_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
    ALTER TABLE `bill_free_entries` ADD CONSTRAINT `bill_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
    ALTER TABLE `bill_free_entries` ADD CONSTRAINT `bill_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `bill_free_entries` ADD `bill_entry_id` INT(10) UNSIGNED NOT NULL AFTER `bill_id`;
ALTER TABLE `bill_entry` ADD `depreciation` INT(11) UNSIGNED NOT NULL AFTER `amount`;

ALTER TABLE `bill_entry` ADD `variation_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `item_id`;
ALTER TABLE `bill_entry` ADD CONSTRAINT `bill_entry_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `invoices` ADD `branch_id` INT(10) UNSIGNED NOT NULL AFTER `customer_id`;

ALTER TABLE `invoices` ADD CONSTRAINT `invoice_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `invoice_entries` ADD `variation_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `item_id`;

ALTER TABLE `invoice_entries` ADD CONSTRAINT `invoice_entries_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `invoice_free_entries`
    (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `invoice_id` INT(10) UNSIGNED NOT NULL ,
    `invoice_entry_id` INT(10) UNSIGNED NOT NULL ,
    `offer_id` INT(10) UNSIGNED NOT NULL ,
    `free_item_id` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `free_item_quantity` INT(11) UNSIGNED NULL DEFAULT NULL,
    `offer_amount` INT(11) UNSIGNED NULL DEFAULT NULL,
    `offer_amount_type` INT(11) UNSIGNED NULL DEFAULT NULL,
    `created_by` INT(10) UNSIGNED NOT NULL,
    `updated_by` INT(10) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_invoice_entry_id_fk` FOREIGN KEY (`invoice_entry_id`) REFERENCES `invoice_entries`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_invoice_id_fk` FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `invoice_entries` ADD `rate_type` INT(11) UNSIGNED NOT NULL AFTER `rate`;

ALTER TABLE `bill_entry` ADD `rate_type` INT(11) UNSIGNED NOT NULL AFTER `rate`;

ALTER TABLE `item_variations` ADD `carton_size` INT(11) UNSIGNED NULL DEFAULT 0 AFTER `variation_name`;

ALTER TABLE `item_variations` CHANGE `sku` `sku` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `invoices` ADD `invoice_type` INT(11) UNSIGNED NOT NULL AFTER `invoice_number`;

ALTER TABLE `invoices` ADD `seller_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `item_sub_category_id`;

ALTER TABLE `invoices` ADD CONSTRAINT `invoices_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `item` CHANGE `total_parchage_return` `total_purchase_return` DOUBLE NULL DEFAULT NULL;

ALTER TABLE `item` ADD `total_stock` VARCHAR(255) NULL DEFAULT NULL AFTER `total_sales`;

ALTER TABLE `item` ADD `total_sale_return` DOUBLE NULL DEFAULT NULL AFTER `total_purchase_return`, 
                ADD `total_damaged` DOUBLE NULL DEFAULT NULL AFTER `total_sale_return`;

CREATE TABLE `depo_stock` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `invoice_entries_id` INT(10) UNSIGNED NOT NULL,
    `depo_id` INT(10) UNSIGNED NOT NULL ,
    `item_id` INT(10) UNSIGNED NOT NULL ,
    `purchase_quantity` VARCHAR(255) NULL DEFAULT NULL ,
    `sale_quantity` VARCHAR(255) NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `depo_stock` ADD CONSTRAINT `depo_stock_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_stock` ADD CONSTRAINT `depo_stock_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_stock` ADD CONSTRAINT `depo_stock_depo_id_fk` FOREIGN KEY (`depo_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_stock` ADD CONSTRAINT `depo_stock_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_stock` ADD CONSTRAINT `depo_stock_invoice_entries_fk` FOREIGN KEY (`invoice_entries_id`) REFERENCES `invoice_entries`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `damage_items` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `item_id` int(10) UNSIGNED NOT NULL,
    `variation_id` int(10) UNSIGNED NULL DEFAULT NULL,
    `quantity` double DEFAULT 0 NOT NULL,
    `vendor_id` int(10) UNSIGNED NOT NULL,
    `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
    `created_by` int(10) UNSIGNED NOT NULL,
    `updated_by` int(10) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `damage_items` ADD CONSTRAINT `damage_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `damage_items` ADD CONSTRAINT `damage_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `damage_items` ADD CONSTRAINT `damage_items_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `damage_items` ADD CONSTRAINT `damage_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `damage_items` ADD CONSTRAINT `damage_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `offers` ADD `item_variation_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `item_id`;

ALTER TABLE `offers` ADD `free_item_variation_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `free_item_id`;

ALTER TABLE `offers` ADD CONSTRAINT `offers_item_variation_id_fk` FOREIGN KEY (`item_variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `offers` ADD CONSTRAINT `offers_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `depo_sales` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `sales_number` VARCHAR(255) NOT NULL ,
    `sales_date` DATE NOT NULL ,
    `seller_id` INT(10) UNSIGNED NOT NULL ,
    `customer_id` INT(10) UNSIGNED NOT NULL ,
    `branch_id` INT(10) UNSIGNED NOT NULL ,
    `personal_note` LONGTEXT NULL DEFAULT NULL ,
    `file_name` VARCHAR(255) NULL DEFAULT NULL ,
    `file_url` VARCHAR(255) NULL DEFAULT NULL ,
    `reference` VARCHAR(255) NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `depo_sales` ADD CONSTRAINT `depo_sales_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales` ADD CONSTRAINT `depo_sales_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `depo_sales` ADD CONSTRAINT `depo_sales_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales` ADD CONSTRAINT `depo_sales_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales` ADD CONSTRAINT `depo_sales_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `depo_sales_entries` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `depo_sales_id` INT(10) UNSIGNED NOT NULL ,
    `item_id` INT(10) UNSIGNED NOT NULL ,
    `variation_id` INT(10) UNSIGNED NOT NULL ,
    `quantity` INT(11) UNSIGNED NOT NULL ,
    `description` VARCHAR(255) NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `depo_sales_entries` ADD CONSTRAINT `depo_sales_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales_entries` ADD CONSTRAINT `depo_sales_entries_depo_sales_id_fk` FOREIGN KEY (`depo_sales_id`) REFERENCES `depo_sales`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `depo_sales_entries` ADD CONSTRAINT `depo_sales_entries_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales_entries` ADD CONSTRAINT `depo_sales_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `depo_sales_entries` ADD CONSTRAINT `depo_sales_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `depo_sales_free_entries` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `depo_sales_id` INT(10) UNSIGNED NOT NULL ,
    `depo_sales_entries_id` INT(10) UNSIGNED NOT NULL ,
    `offer_id` INT(10) UNSIGNED NOT NULL ,
    `free_item_id` INT(10) UNSIGNED NULL DEFAULT NULL ,
    `free_item_quantity` INT(11) UNSIGNED NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `depo_sales_free_entries` ADD CONSTRAINT `depo_sales_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_sales_free_entries` ADD CONSTRAINT `depo_sales_free_entries_depo_sales_entries_id_fk` FOREIGN KEY (`depo_sales_entries_id`) REFERENCES `depo_sales_entries`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `depo_sales_free_entries` ADD CONSTRAINT `depo_sales_free_entries_depo_sales_id_fk` FOREIGN KEY (`depo_sales_id`) REFERENCES `depo_sales`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `depo_sales_free_entries` ADD CONSTRAINT `depo_sales_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `depo_sales_free_entries` ADD CONSTRAINT `depo_sales_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `organization_profiles` ADD `quotation_header` LONGTEXT NOT NULL AFTER `website`;

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES (NULL, 'Estimate Request', 'estimate-request', NULL, NULL);

INSERT INTO `access_level` (`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '1', '1', '132', '1', '1', '1', NULL, NULL), (NULL, '1', '1', '1', '1', '132', '2', '1', '1', NULL, NULL);

CREATE TABLE `distributor_sales` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `sales_number` VARCHAR(255) NOT NULL ,
    `seller_id` INT(10) UNSIGNED NOT NULL ,
    `customer_id` INT(10) UNSIGNED NOT NULL ,
    `branch_id` INT(10) UNSIGNED NOT NULL ,
    `sales_date` DATE NOT NULL ,
    `reference` VARCHAR(255) NULL DEFAULT NULL ,
    `description` VARCHAR(255) NULL DEFAULT NULL ,
    `amount` DOUBLE NOT NULL ,
    `total_amount` DOUBLE NOT NULL ,
    `adjustment` DOUBLE NULL DEFAULT NULL ,
    `adjustment_type` INT(11) UNSIGNED NULL DEFAULT '0' ,
    `shipping_charge` DOUBLE NULL DEFAULT NULL ,
    `tax_total` DOUBLE NULL DEFAULT NULL ,
    `personal_note` LONGTEXT NULL DEFAULT NULL ,
    `file_url` VARCHAR(255) NULL DEFAULT NULL ,
    `file_name` VARCHAR(255) NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `distributor_sales` ADD CONSTRAINT `distributor_sales_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `distributor_sales` ADD CONSTRAINT `distributor_sales_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `distributor_sales` ADD CONSTRAINT `distributor_sales_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `distributor_sales` ADD CONSTRAINT `distributor_sales_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `distributor_sales` ADD CONSTRAINT `distributor_sales_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `estimate_entries` ADD `variation_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `item_id`;

ALTER TABLE `estimate_entries` ADD CONSTRAINT `estimate_entries_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE contact ADD code VARCHAR(255) NOT NULL AFTER id;

CREATE TABLE `estimate_request` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `contact_id` INT(10) UNSIGNED NOT NULL ,
    `order_code` VARCHAR(255) NOT NULL ,
    `request_date` DATE NOT NULL ,
    `requirements` LONGTEXT NULL DEFAULT NULL ,
    `note` VARCHAR(255) NULL DEFAULT NULL ,
    `deadline_date` DATE NOT NULL ,
    `branch_id` INT(10) UNSIGNED NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `estimate_request` ADD CONSTRAINT `estimate_request_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `estimate_request` ADD CONSTRAINT `estimate_request_contact_id_fk` FOREIGN KEY (`contact_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `estimate_request` ADD CONSTRAINT `estimate_request_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `estimate_request` ADD CONSTRAINT `estimate_request_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `estimate_request_model` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `estimate_request_id` INT(10) UNSIGNED NOT NULL ,
    `model_name` VARCHAR(255) NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `estimate_request_model` ADD CONSTRAINT `estimate_request_model_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `estimate_request_model` ADD CONSTRAINT `estimate_request_model_estimate_request_id_fk` FOREIGN KEY (`estimate_request_id`) REFERENCES `estimate_request`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `estimate_request_model` ADD CONSTRAINT `estimate_request_model_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `estimate_request_model_entries` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `estimate_request_model_id` INT(10) UNSIGNED NOT NULL ,
    `length` VARCHAR(255) NOT NULL ,
    `size` VARCHAR(255) NULL DEFAULT NULL ,
    `color` VARCHAR(255) NULL DEFAULT NULL ,
    `quantity` INT(11) UNSIGNED NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `estimate_request_model_entries` ADD CONSTRAINT `estimate_request_model_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `estimate_request_model_entries` ADD CONSTRAINT `estimate_request_model_entries_estimate_request_model_id_fk` FOREIGN KEY (`estimate_request_model_id`) REFERENCES `estimate_request_model`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `estimate_request_model_entries` ADD CONSTRAINT `estimate_request_model_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

INSERT INTO `modules` 
(`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES 
(NULL, 'Product Track', 'product-track', '2022-10-31 09:27:34', '2022-10-31 09:27:34');

INSERT INTO `access_level` 
(`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES 
(NULL, '1', '1', '1', '1', '133', '1', '1', '1', '2022-10-31 09:28:33', '2022-10-31 09:28:33');

CREATE TABLE `product` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `product_name` int(10) UNSIGNED DEFAULT NULL,
    `total_product` int(11) DEFAULT NULL,
    `branch_id` int(10) UNSIGNED NOT NULL,
    `created_by` int(10) UNSIGNED NOT NULL,
    `updated_by` int(10) UNSIGNED NOT NULL,
    `item_add` int(11) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `product` ADD CONSTRAINT `product_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `product` ADD CONSTRAINT `product_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product` ADD CONSTRAINT `product_product_name_fk` FOREIGN KEY (`product_name`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product` ADD CONSTRAINT `product_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `product_phase` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `product_phase_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `product_id` int(10) UNSIGNED NOT NULL,
    `created_by` int(10) UNSIGNED NOT NULL,
    `updated_by` int(10) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `product_phase` ADD CONSTRAINT `product_phase_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase` ADD CONSTRAINT `product_phase_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `product_phase` ADD CONSTRAINT `product_phase_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `product_phase_item` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `issued_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `personal_note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
    `recipient_id` int(10) UNSIGNED DEFAULT NULL,
    `issued_by` int(10) UNSIGNED NOT NULL,
    `product_id` int(10) UNSIGNED NOT NULL,
    `product_phase_id` int(10) UNSIGNED NOT NULL,
    `created_by` int(10) UNSIGNED NOT NULL,
    `updated_by` int(10) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_issued_by_fk` FOREIGN KEY (`issued_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_product_phase_fk` FOREIGN KEY (`product_phase_id`) REFERENCES `product_phase`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_recipent_id_fk` FOREIGN KEY (`recipient_id`) REFERENCES `contact`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase_item` ADD CONSTRAINT `product_phase_item_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `product_phase_item_add` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `item_category_id` int(10) UNSIGNED DEFAULT NULL,
    `item_id` int(10) UNSIGNED DEFAULT NULL,
    `total` double DEFAULT NULL,
    `product_phase_item_id` int(10) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `product_phase_item_add` ADD CONSTRAINT `product_phase_item_add_item_category_id_fk` FOREIGN KEY (`item_category_id`) REFERENCES `item_category`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase_item_add` ADD CONSTRAINT `product_phase_item_add_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `product_phase_item_add` ADD CONSTRAINT `product_phase_item_add_product_phase_id_fk` FOREIGN KEY (`product_phase_item_id`) REFERENCES `product_phase_item`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `vendor_credit_entry` ADD `variation_id` INT(10) UNSIGNED NOT NULL AFTER `item_id`;
ALTER TABLE `vendor_credit_entry` ADD CONSTRAINT `vendor_credit_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `credit_note_entries` ADD `variation_id` INT(10) UNSIGNED NOT NULL AFTER `item_id`;
ALTER TABLE `credit_note_entries` ADD CONSTRAINT `credit_note_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `item_variations` ADD `total_purchases` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `status`,
    ADD `total_purchase_return` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_purchases`,
    ADD `total_sales` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_purchase_return`,
    ADD `total_sale_return` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_sales`,
    ADD `total_stock` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_sale_return`,
    ADD `total_damaged` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_stock`,
    ADD `total_manufacture` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_damaged`,
    ADD `total_use` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `total_manufacture`;

ALTER TABLE `item` CHANGE `total_purchases` `total_purchases` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_sales` `total_sales` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_stock` `total_stock` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_manufacture` `total_manufacture` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_use` `total_use` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_purchase_return` `total_purchase_return` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_sale_return` `total_sale_return` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `item` CHANGE `total_damaged` `total_damaged` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `bill_free_entries` ADD `free_item_variation_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `free_item_id`;

ALTER TABLE `bill_free_entries` ADD CONSTRAINT `bill_free_entries_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `invoice_free_entries` ADD `free_item_variation_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `free_item_id`;

ALTER TABLE `invoice_free_entries` ADD CONSTRAINT `invoice_free_entries_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TRIGGER `bill_entry_create_item_total_purchase_add` AFTER INSERT ON `bill_entry` FOR EACH ROW
    UPDATE `item_variations` SET total_purchases = total_purchases + new.quantity WHERE id = new.variation_id;

CREATE TRIGGER `bill_entry_delete_item_total_purchase_remove` AFTER DELETE ON `bill_entry` FOR EACH ROW
    UPDATE `item_variations` SET `total_purchases` = `total_purchases` - old.quantity WHERE `id` = old.variation_id;

CREATE TRIGGER `bill_entry_update_item_total_purchase_update` AFTER UPDATE ON `bill_entry` FOR EACH ROW
    UPDATE `item_variations` SET `total_purchases` = total_purchases - old.quantity + new.quantity WHERE id = new.variation_id;

CREATE TRIGGER `bill_free_entry_create_item_total_purchase_add` AFTER INSERT ON `damage_items` FOR EACH ROW
    UPDATE `item_variations` SET total_damaged = total_damaged + new.quantity WHERE id = new.variation_id;
    UPDATE `item` SET total_damaged = total_damaged + new.quantity WHERE id = new.item_id;

CREATE TRIGGER `bill_free_entry_delete_item_total_purchase_remove` AFTER DELETE ON `damage_items` FOR EACH ROW
    UPDATE `item_variations` SET total_damaged = total_damaged - old.quantity WHERE id = old.variation_id;
    UPDATE `item` SET total_damaged = total_damaged - old.quantity WHERE id = old.item_id;

CREATE TRIGGER `damage_item_update_stock_add` AFTER UPDATE ON `damage_items` FOR EACH ROW
    UPDATE `item_variations` SET total_damaged = total_damaged - old.quantity + new.quantity WHERE id = new.variation_id;
    UPDATE `item` SET total_damaged = total_damaged - old.quantity + new.quantity WHERE id = new.item_id;

ALTER TABLE `contact` ADD `finger_print_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `display_name`;

ALTER TABLE `users` ADD `finger_print_id` INT(11) UNSIGNED NOT NULL AFTER `password`;

CREATE TABLE manufacture (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    estimate_id INT(10) UNSIGNED NOT NULL ,
    start_date DATE NOT NULL ,
    end_date DATE NOT NULL ,
    created_by INT(10) UNSIGNED NOT NULL ,
    updated_by INT(10) UNSIGNED NOT NULL ,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE manufacture ADD FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE manufacture ADD FOREIGN KEY (estimate_id) REFERENCES estimates(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE manufacture ADD FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE manufacture_phases (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    phase_name VARCHAR(255) NOT NULL ,
    manufacture_id INT(10) UNSIGNED NOT NULL ,
    factory_id INT(10) UNSIGNED NOT NULL ,
    created_by INT(10) UNSIGNED NOT NULL ,
    updated_by INT(10) UNSIGNED NOT NULL ,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE manufacture_phases ADD FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE manufacture_phases ADD FOREIGN KEY (factory_id) REFERENCES contact(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE manufacture_phases ADD FOREIGN KEY (manufacture_id) REFERENCES manufacture(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE manufacture_phases ADD FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE


INSERT INTO contact_category (id, contact_category_name, contact_category_description, created_by, updated_by, created_at, updated_at) VALUES (NULL, 'Factory', 'Category for Factories', '1', '1', '2022-11-20 16:11:33', '2022-11-20 16:11:33')

CREATE TABLE manufacture_entries (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    manufacture_id INT(10) UNSIGNED NOT NULL ,
    item_id INT(10) UNSIGNED NOT NULL ,
    variation_id INT(10) UNSIGNED NOT NULL ,
    required_quantity DOUBLE NOT NULL ,
    manufacture_quantity DOUBLE NOT NULL DEFAULT '0' ,
    PRIMARY KEY (id)
) ENGINE = InnoDB; 

ALTER TABLE manufacture_entries ADD FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE manufacture_entries ADD FOREIGN KEY (manufacture_id) REFERENCES manufacture(id) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE manufacture_entries ADD FOREIGN KEY (variation_id) REFERENCES item_variations(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture` ADD `status` VARCHAR(255) NOT NULL DEFAULT 'incomplete' AFTER `end_date`;

ALTER TABLE `manufacture` CHANGE `estimate_id` `estimate_id` INT(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `manufacture` ADD `status` VARCHAR(255) NOT NULL DEFAULT 'incomplete' AFTER `end_date`;

ALTER TABLE `manufacture_phases` ADD `status` VARCHAR(255) NOT NULL DEFAULT 'incomplete' AFTER `factory_id`;

CREATE TABLE `manufacture_phase_raw_materials` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `manufacture_phase_id` INT(10) UNSIGNED NOT NULL ,
    `variation_id` INT(10) UNSIGNED NOT NULL ,
    `quantity` INT(11) UNSIGNED NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `manufacture_phase_raw_materials` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_raw_materials` ADD FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_raw_materials` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_raw_materials` ADD FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `manufacture_phase_disburse` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `manufacture_phase_id` INT(10) UNSIGNED NOT NULL ,
    `variation_id` INT(10) UNSIGNED NOT NULL ,
    `quantity` INT(11) UNSIGNED NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `manufacture_phase_disburse` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_disburse` ADD FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_disburse` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_disburse` ADD FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `manufacture_phase_disburse` ADD `date` DATE NOT NULL AFTER `id`;

CREATE TABLE `manufacture_phase_receive_from_factory` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `date` DATE NOT NULL ,
    `manufacture_phase_id` INT(10) UNSIGNED NOT NULL ,
    `variation_id` INT(10) UNSIGNED NOT NULL ,
    `quantity` INT(11) UNSIGNED NOT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `manufacture_phase_receive_from_factory` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_receive_from_factory` ADD FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_receive_from_factory` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_phase_receive_from_factory` ADD FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `manufacture_entries` ADD FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `manufacture_entries` ADD FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `manufacture_entries` ADD FOREIGN KEY (`variation_id`) REFERENCES `item_variations`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-------------------------------------------------------
-- CREATE NEW TRIGGERS MANUALLY --
-------------------------------------------------------

CREATE TRIGGER `manufacture_disbure_stock_in` AFTER DELETE ON `manufacture_phase_disburse` FOR EACH ROW
    UPDATE `item_variations` SET `total_use` = `total_use` - old.quantity WHERE id = old.variation_id;
    UPDATE `item` SET `total_use` = `total_use` + old.quantity WHERE id = (SELECT `item_id` FROM `item_variations` WHERE `id` = old.variation_id);

CREATE TRIGGER `manufacture_disbure_stock_out` AFTER INSERT ON `manufacture_phase_disburse` FOR EACH ROW
    UPDATE `item_variations` SET `total_use` = `total_use` + new.quantity WHERE id = new.variation_id;
    UPDATE `item` SET `total_use` = `total_use` - new.quantity WHERE id = (SELECT `item_id` FROM `item_variations` WHERE `id` = new.variation_id);

CREATE TABLE `units` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(255) NOT NULL ,
    `basic-unit-conversion` DOUBLE NOT NULL ,
    `note` LONGTEXT NULL DEFAULT NULL ,
    `created_by` INT(10) UNSIGNED NOT NULL ,
    `updated_by` INT(10) UNSIGNED NOT NULL ,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `damage_items` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `damage_items` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `damage_items` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `invoice_entries` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `invoice_entries` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `invoice_entries` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;


ALTER TABLE `bill_entry` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `bill_entry` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `bill_entry` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;


ALTER TABLE `depo_sales_entries` ADD `unit_id` UNSIGNED INT NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `depo_sales_entries` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `depo_sales_entries` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `credit_note_entries` ADD `unit_id` UNSIGNED INT NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `credit_note_entries` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `credit_note_entries` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `estimate_entries` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `estimate_entries` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `estimate_entries` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `vendor_credit_entry` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `vendor_credit_entry` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `vendor_credit_entry` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;


ALTER TABLE `stock_transfers` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `quantity`;
ALTER TABLE `stock_transfers` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `stock_transfers` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `offers` ADD `unit_id` INT UNSIGNED NULL DEFAULT NULL AFTER `base_quantity`;
ALTER TABLE `offers` ADD `basic_unit_conversion` DOUBLE NULL DEFAULT NULL AFTER `unit_id`;
ALTER TABLE `offers` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `offers` CHANGE `end_date` `end_date` TIMESTAMP NOT NULL,
CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

RENAME TABLE `check_book` TO `cheque_book`;

ALTER TABLE `payment_made` ADD `cheque_number` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `payment_mode_id`,
    ADD `cheque_issue_date` DATE NULL DEFAULT NULL AFTER `cheque_number`,
    ADD `cheque_status` VARCHAR(255) NULL DEFAULT NULL AFTER `cheque_issue_date`;

UPDATE `modules` SET `module_name` = 'Cheque Book', `module_prefix` = 'cheque-book' WHERE `modules`.`id` = 135;

ALTER TABLE `cheque_book` DROP FOREIGN KEY `check_book_bank_id_fk`;
ALTER TABLE `cheque_book` ADD CONSTRAINT `check_book_bank_id_fk` FOREIGN KEY (`bank_id`) REFERENCES `account`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `payment_receives` ADD `cheque_number` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `payment_mode_id`,
    ADD `cheque_issue_date` DATE NULL DEFAULT NULL AFTER `cheque_number`,
    ADD `cheque_status` VARCHAR(255) NULL DEFAULT NULL AFTER `cheque_issue_date`;

ALTER TABLE `payment_made` ADD `customer_note` LONGTEXT NULL DEFAULT NULL AFTER `cheque_status`;

CREATE TABLE `bill_of_materials` (`id` INT NOT NULL , `invoice_id` INT UNSIGNED NULL DEFAULT NULL , `project_name` VARCHAR(255) NULL DEFAULT NULL , `product_size` VARCHAR(255) NULL DEFAULT NULL , `date` DATE NULL DEFAULT NULL , `quantity` INT NULL DEFAULT NULL , `cho_percent` DOUBLE NULL DEFAULT '0' , `profit_percent` DOUBLE NULL DEFAULT '0' , `design_percent` DOUBLE NULL DEFAULT '0' , `sub_total` DOUBLE NOT NULL DEFAULT '0' , `mrp_percent` DOUBLE NOT NULL DEFAULT '0' , `vat_percent` DOUBLE NOT NULL DEFAULT '0' , `status` VARCHAR(255) NULL DEFAULT NULL , `trade_total` DOUBLE NOT NULL DEFAULT '0' , `created_by` INT UNSIGNED NULL DEFAULT NULL , `updated_by` INT UNSIGNED NULL DEFAULT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL ) ENGINE = InnoDB;

ALTER TABLE `bill_of_materials` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);

ALTER TABLE `bill_of_materials` CHANGE `id` `id` INT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `bill_of_materials` ADD FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_materials` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_materials` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE `bill_of_material_entries` (`id` INT NOT NULL AUTO_INCREMENT , `bill_of_material_id` INT UNSIGNED NOT NULL , `item_id` INT UNSIGNED NOT NULL , `sub_category_id` INT UNSIGNED NULL , `quantity` INT NULL , `wastage_percent` DOUBLE NULL DEFAULT '0' , `unit_id` INT UNSIGNED NULL , `unit_price` DOUBLE NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `bill_of_material_entries` ADD FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_material_entries` ADD FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_material_entries` ADD FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE `item_attribute_values` (`id` INT NOT NULL AUTO_INCREMENT , `item_id` INT NOT NULL , `attribute_values_id` INT NOT NULL , `created_by` INT NULL DEFAULT NULL , `updated_by` INT NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `item_attribute_values` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, CHANGE `item_id` `item_id` INT UNSIGNED NOT NULL, CHANGE `attribute_values_id` `attribute_values_id` INT UNSIGNED NOT NULL, CHANGE `created_by` `created_by` INT UNSIGNED NULL DEFAULT NULL, CHANGE `updated_by` `updated_by` INT UNSIGNED NULL DEFAULT NULL, CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;ALTER TABLE `item_attribute_values` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, CHANGE `item_id` `item_id` INT UNSIGNED NOT NULL, CHANGE `attribute_values_id` `attribute_values_id` INT UNSIGNED NOT NULL, CHANGE `created_by` `created_by` INT UNSIGNED NULL DEFAULT NULL, CHANGE `updated_by` `updated_by` INT UNSIGNED NULL DEFAULT NULL, CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `item_attribute_values` ADD FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `item_attribute_values` ADD FOREIGN KEY (`attribute_values_id`) REFERENCES `attribute_values`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `item_attribute_values` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `item_attribute_values` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_materials` ADD `item_id` INT UNSIGNED NOT NULL AFTER `invoice_id`;

ALTER TABLE `bill_of_materials` ADD FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `item_attribute_values` ADD `measurable` TINYINT UNSIGNED NOT NULL AFTER `attribute_values_id`;

ALTER TABLE `item_attribute_values` DROP FOREIGN KEY `item_attribute_values_ibfk_1`;
ALTER TABLE `item_attribute_values` ADD CONSTRAINT `item_attribute_values_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `item_attribute_values` DROP FOREIGN KEY `item_attribute_values_ibfk_2`;
ALTER TABLE `item_attribute_values` ADD CONSTRAINT `item_attribute_values_ibfk_2` FOREIGN KEY (`attribute_values_id`) REFERENCES `attribute_values`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `item_attribute_values` DROP FOREIGN KEY `item_attribute_values_ibfk_3`;
ALTER TABLE `item_attribute_values` ADD CONSTRAINT `item_attribute_values_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `item_attribute_values` DROP FOREIGN KEY `item_attribute_values_ibfk_4`;
ALTER TABLE `item_attribute_values` ADD CONSTRAINT `item_attribute_values_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `manufacture` CHANGE `estimate_id` `bill_of_material_id` INT UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `manufacture` DROP FOREIGN KEY `manufacture_ibfk_2`;
ALTER TABLE `manufacture` ADD CONSTRAINT `manufacture_ibfk_2` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

DROP TRIGGER IF EXISTS `bill_entry_delete_item_total_purchase_remove`;CREATE DEFINER=`ontikte1`@`localhost` TRIGGER `bill_entry_delete_item_total_purchase_remove` AFTER DELETE ON `bill_entry` FOR EACH ROW BEGIN UPDATE `item_variations` SET `total_purchases` = `total_purchases` - old.quantity WHERE id = old.variation_id; UPDATE `item` SET `total_purchases` = `total_purchases` - old.quantity, `total_stock` = `total_stock` - old.quantity WHERE id = old.item_id; END

ALTER TABLE `bill_of_materials` ADD `foh_percent` DOUBLE NOT NULL DEFAULT '0' AFTER `cho_percent`;

ALTER TABLE `bill` ADD FOREIGN KEY (`branch_id`) REFERENCES `branch`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `bill_of_material_entries` CHANGE `quantity` `quantity` DOUBLE(10,2) NULL DEFAULT NULL;

UPDATE `modules` SET `module_name` = 'Manufacture' WHERE `modules`.`id` = 133;

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES (136, 'Bill Of Materials', 'bill-of-material', '2023-05-29 16:03:42', '2023-05-29 16:03:42');

ALTER TABLE `expense` ADD `cheque_number` INT NULL DEFAULT NULL AFTER `paid_through_id`, ADD `issue_date` DATE NULL DEFAULT NULL AFTER `cheque_number`;

ALTER TABLE `bank` ADD `issue_date` DATE NULL DEFAULT NULL AFTER `cheque_number`;

add graphql_endpoint=https://graphql.inova-bd.com/schema/v1 in env

INSERT INTO `payment_mode` (`id`, `mode_name`, `description`, `created_at`, `updated_at`) VALUES ('3', 'Payment Gateway', 'Ecommerce Payment From Gateway', '2023-07-19 11:01:24', '2023-07-19 11:01:24');

INSERT INTO `account_type` (`id`, `account_name`, `description`, `parent_account_type_id`, `required_status`, `created_at`, `updated_at`) VALUES ('20', 'Payment Gateway', 'Ecommerce Payment From Gateway', '1', '0', '2023-07-19 11:20:39', '2023-07-19 11:20:39');

INSERT INTO `account` (`id`, `account_name`, `account_code`, `description`, `dashboard_watchlist`, `required_status`, `account_type_id`, `parent_account_type_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES ('106', 'Payment Gateway', 'Payment Gateway', 'Ecommerce Payment From Gateway', '0', '1', '20', '1', '1', '1', '1', '2023-07-19 11:25:13', '2023-07-19 11:25:13');

ALTER TABLE `item` ADD `ecom_id` INT NULL DEFAULT NULL AFTER `barcode_no`, ADD `ecom_code` VARCHAR(255) NULL DEFAULT NULL AFTER `ecom_id`;

ALTER TABLE `contact` ADD `gender` VARCHAR(10) NULL DEFAULT NULL AFTER `display_name`, ADD `date_of_birth` DATE NULL DEFAULT NULL AFTER `gender`;

ALTER TABLE `contact` ADD `ecom_id` INT NULL DEFAULT NULL AFTER `code`, ADD `ecom_username` VARCHAR(255) NULL DEFAULT NULL AFTER `ecom_id`;

ALTER TABLE `invoices` CHANGE `adjustment_type` `adjustment_type` INT NULL DEFAULT '0' COMMENT '0(%), 1(BDT)';

ALTER TABLE `invoices` ADD `ecom_id` INT NULL AFTER `invoice_type`;

ALTER TABLE `item` ADD `discount_percentage` FLOAT NULL AFTER `item_about`;

-------------------------------------------------------
-- Inova Live DB Upto Date --
-------------------------------------------------------