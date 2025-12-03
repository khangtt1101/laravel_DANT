CREATE TABLE IF NOT EXISTS `voucher_categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `voucher_id` BIGINT UNSIGNED NOT NULL,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `voucher_categories_voucher_id_index` (`voucher_id`),
    KEY `voucher_categories_category_id_index` (`category_id`),
    CONSTRAINT `voucher_categories_voucher_id_foreign`
        FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE,
    CONSTRAINT `voucher_categories_category_id_foreign`
        FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
