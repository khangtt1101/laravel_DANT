-- ============================================
-- FILE SQL TỔNG HỢP - BỔ SUNG TẤT CẢ BẢNG/CỘT CÒN THIẾU
-- ============================================
-- Chạy file này trong phpMyAdmin: Chọn database -> Tab SQL -> Copy toàn bộ -> Go
-- File này an toàn, có thể chạy nhiều lần (nếu bảng/cột đã có sẽ bỏ qua)

-- ============================================
-- 1. TẠO BẢNG VOUCHERS
-- ============================================
CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `max_discount_amount` decimal(12,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `usage_limit_per_user` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vouchers_code_unique` (`code`),
  KEY `vouchers_is_active_index` (`is_active`),
  KEY `vouchers_start_date_index` (`start_date`),
  KEY `vouchers_end_date_index` (`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. TẠO BẢNG VOUCHER_USAGES
-- ============================================
CREATE TABLE IF NOT EXISTS `voucher_usages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `voucher_usages_voucher_id_index` (`voucher_id`),
  KEY `voucher_usages_user_id_index` (`user_id`),
  KEY `voucher_usages_order_id_index` (`order_id`),
  KEY `voucher_usages_voucher_id_user_id_index` (`voucher_id`,`user_id`),
  CONSTRAINT `voucher_usages_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `voucher_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `voucher_usages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. TẠO BẢNG VOUCHER_CATEGORIES
-- ============================================
CREATE TABLE IF NOT EXISTS `voucher_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `voucher_categories_voucher_id_index` (`voucher_id`),
  KEY `voucher_categories_category_id_index` (`category_id`),
  CONSTRAINT `voucher_categories_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `voucher_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. THÊM CỘT VOUCHER_CODE VÀ DISCOUNT_AMOUNT VÀO BẢNG ORDERS
-- ============================================
-- Nếu cột đã tồn tại sẽ báo lỗi, nhưng không sao, bỏ qua là được

ALTER TABLE `orders` 
ADD COLUMN `voucher_code` varchar(50) DEFAULT NULL AFTER `order_code`;

ALTER TABLE `orders` 
ADD COLUMN `discount_amount` decimal(12,2) NOT NULL DEFAULT 0.00 AFTER `voucher_code`;

-- ============================================
-- 5. TẠO BẢNG CONTACT_REQUESTS (NẾU CẦN)
-- ============================================
CREATE TABLE IF NOT EXISTS `contact_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('pending','read','replied') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_requests_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- XONG! Database đã đầy đủ
-- ============================================
