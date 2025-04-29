-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2025 pada 02.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ryuzaki-store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `img_profile` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `full_name`, `img_profile`, `email`, `phone_number`, `address`, `department`, `created_at`, `updated_at`) VALUES
('ADM001', 'adminuser', '$2y$10$/Fs7ezBrAZ3oEm1xYjMYCuS/aalurjCOJ4WAgFkZerEAdf3tfST0q', 'Admin User', NULL, 'admin@example.com', '081234567890', 'Admin Address', 'Administration', '2025-01-31 15:16:51', '2025-01-31 15:16:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` char(12) NOT NULL,
  `id_customer` varchar(12) NOT NULL,
  `id_product` char(12) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_customer`, `id_product`, `quantity`, `created_at`) VALUES
('CART315940D8', 'CUST001', 'prd_679d3437', 1, '2025-04-15 01:21:20'),
('CART51D6D077', 'CUST001', 'prd_679d1b22', 1, '2025-04-15 01:21:13'),
('CARTF5706D11', 'CUST001', 'prd_679d8406', 1, '2025-04-15 01:21:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `img_profile` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `membership_level` enum('bronze','silver','gold') NOT NULL DEFAULT 'bronze',
  `total_spent` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `username`, `password`, `full_name`, `img_profile`, `email`, `phone_number`, `address`, `membership_level`, `total_spent`, `created_at`, `updated_at`) VALUES
('CUST001', 'customer1', '$2y$10$CQqxVvqbxFjGvsxyoiZ84OD7fYqEETtQyaRhQwj1E1j7YAsVfARra', 'Customer One', NULL, 'customer1@example.com', '082345678901', 'Customer Address 1', 'bronze', 0.00, '2025-02-06 20:25:57', '2025-02-06 20:25:57'),
('CUST002', 'customer2', '$2y$10$jtk/QLWsfkZJNBtDDl5MneaIpQQ59eRXQzoaJ2OB4l2bAZXP4ZQci', 'Customer One', NULL, 'customer2@example.com', '082345678902', 'Customer Address 2', 'bronze', 0.00, '2025-02-06 20:25:58', '2025-02-06 20:25:58'),
('CUST003', 'customer3', '$2y$10$sowMp.lFjsaSHhZW/479oe7m5cApu/fbmL0x.Dwwfb/NtM2xJMBIa', 'Customer One', NULL, 'customer3@example.com', '082345678903', 'Customer Address 1', 'bronze', 0.00, '2025-02-06 20:25:58', '2025-02-06 20:25:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail_order` char(12) NOT NULL,
  `id_order` char(12) NOT NULL,
  `id_customer` varchar(12) NOT NULL,
  `id_order_item` char(12) NOT NULL,
  `id_product` char(12) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
  `payment_status` enum('Not Yet Paid','Paid off','Failed') DEFAULT NULL,
  `order_status` enum('waiting for payment','processed','shipped','completed','canceled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `img_profile` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-12-23-073558', 'App\\Database\\Migrations\\CreateAdminDetailsTable', 'default', 'App', 1738334384, 1),
(2, '2024-12-23-073558', 'App\\Database\\Migrations\\CreateCustomerTable', 'default', 'App', 1738334384, 1),
(3, '2024-12-23-073558', 'App\\Database\\Migrations\\CreateOwnerTable', 'default', 'App', 1738334384, 1),
(7, '2024-12-28-044612', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1738335474, 2),
(8, '2024-12-28-044613', 'App\\Database\\Migrations\\CreateOrdersTable', 'default', 'App', 1738335495, 3),
(9, '2024-12-28-044613', 'App\\Database\\Migrations\\CreateOrderItemsTable', 'default', 'App', 1738335506, 4),
(10, '2024-12-28-044612', 'App\\Database\\Migrations\\CreateCartTable', 'default', 'App', 1738335512, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` char(12) NOT NULL,
  `id_customer` varchar(12) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `destination_address` text DEFAULT NULL,
  `status` enum('waiting for payment','processed','shipped','completed','canceled') NOT NULL DEFAULT 'waiting for payment',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `id_customer`, `order_date`, `destination_address`, `status`, `total_amount`, `created_at`, `updated_at`) VALUES
('ORD195EFEAA4', 'CUST001', '2025-02-07 02:35:20', 'Jl.afaflsmfa', '', 4986800.00, '2025-02-07 02:35:20', '2025-02-07 02:35:20'),
('ORD26CC13AED', 'CUST001', '2025-04-15 01:13:03', 'Jl. ponopringgo', '', 1263000.00, '2025-04-15 01:13:03', '2025-04-15 01:13:03'),
('ORD3A6ED500B', 'CUST001', '2025-03-25 01:22:23', 'Jl. Patriot', '', 4404700.00, '2025-03-25 01:22:23', '2025-03-25 01:22:23'),
('ORDBE67DA515', 'CUST001', '2025-04-14 08:12:15', 'Pemalang jl.junid', '', 2995000.00, '2025-04-14 08:12:15', '2025-04-14 08:12:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` char(12) NOT NULL,
  `id_order` char(12) NOT NULL,
  `id_product` char(12) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_product`, `quantity`, `price`) VALUES
('OIT3BE0BFB4D', 'ORD195EFEAA4', 'prd_679d24d9', 2, 599000.00),
('OIT6052CD100', 'ORD195EFEAA4', 'prd_679d1b22', 2, 599000.00),
('OIT64E6E4E40', 'ORDBE67DA515', 'prd_679d1b22', 5, 599000.00),
('OIT76265D0BA', 'ORD3A6ED500B', 'prd_679d3437', 3, 599900.00),
('OITA9D2870BE', 'ORD195EFEAA4', 'prd_679d829d', 2, 521000.00),
('OITBC48C68AA', 'ORD26CC13AED', 'prd_679d8406', 3, 421000.00),
('OITC62FB6F6F', 'ORD3A6ED500B', 'prd_679d829d', 5, 521000.00),
('OITCF142EC66', 'ORD195EFEAA4', 'prd_679d3437', 2, 599900.00),
('OITD45B46538', 'ORD195EFEAA4', 'prd_67a1f877', 1, 349000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `owner`
--

CREATE TABLE `owner` (
  `id_owner` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `img_profile` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_address` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `owner`
--

INSERT INTO `owner` (`id_owner`, `username`, `password`, `full_name`, `img_profile`, `email`, `phone_number`, `store_name`, `store_address`, `created_at`, `updated_at`) VALUES
('OWN001', 'Ryuzaki', '$2y$10$6TEIZNIbcZJwmaVGk9p/7uMVi6UvqQtBkX11eg8Ybgmn3Vyr4asBO', 'Zhuxyd Ryuzaki', NULL, 'ZhuxyRyuzaki@store.id', '083456789012', 'Ryuzaki Store', 'Store Address 123', '2025-01-31 15:16:18', '2025-01-31 15:16:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id_payment` varchar(12) NOT NULL,
  `id_order` varchar(12) NOT NULL,
  `method` enum('Bank Trasnfer','E-Wallet','Credit Card','COD') NOT NULL,
  `status` enum('Not Yet Paid','Paid off','Failed') NOT NULL DEFAULT 'Not Yet Paid',
  `payment_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_product` char(12) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category` enum('Atasan Pria','Atasan Wanita','Bawahan Pria','Bawahan Wantita') DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `category`, `tags`, `description`, `image`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES
('prd_679d1b22', 'Celana Panjang Regular Fit - Pria', 'Bawahan Pria', 's', 'Celana Panjang Regular Fit yang memiliki model dan gaya yang trendi dan elegan', 'uploads/img/products/1738679860_fbe5b0a5a848404a21ba.jpg,uploads/img/products/1738679860_a97224e96c1e7ded7857.jpg,uploads/img/products/1738679860_6f136f898b63ade31663.jpg,uploads/img/products/1738679860_1af523a44b045078790a.jpg,uploads/img/products/1738679860_39838c6a0e927696dff6.jpg', 599000.00, 124, '2025-01-31 18:49:06', '2025-02-04 14:37:40'),
('prd_679d24d9', 'Celana Panjang Regular Fit - Hitam - Pria', 'Bawahan Pria', 's', 'Celana Panjang Regular Fit yang memiliki model dan gaya yang trendi dan elegan', 'uploads/img/products/1738680155_14a48b9b6c966f26c13a.jpg,uploads/img/products/1738680155_e83656680748ceac6f3a.jpg,uploads/img/products/1738680155_baad84e70b09d1331510.jpg,uploads/img/products/1738680155_1e60b26d7d2caac606fd.jpg,uploads/img/products/1738680155_71a1c6affc740c408345.jpg', 599000.00, 124, '2025-01-31 19:30:33', '2025-02-04 14:42:35'),
('prd_679d3437', 'Kemeja', 'Atasan Pria', 'l', 'Kemeja Hitam ELegan', 'uploads/img/products/1738680186_bd636d9939bee8a00fce.jpg,uploads/img/products/1738680186_7d92fc3d52e61550168b.jpg,uploads/img/products/1738680186_a353b703fc61563ec7c2.jpg,uploads/img/products/1738680186_3d3cbe2d1caf485d7d3e.jpg,uploads/img/products/1738680186_9d0f2974d8903acc07cc.jpg,uploads/img/products/1738680186_c080cad80ef12100a32e.jpg', 599900.00, 56, '2025-01-31 20:36:07', '2025-02-04 14:43:06'),
('prd_679d829d', 'KEMEJA SADAS', 'Atasan Pria', 'e', 'KEMEJA PRIA', 'uploads/img/products/1738827542_e043001701a01b47a1ee.jpg,uploads/img/products/1738827542_80caf9cbf2bc261cfc5b.jpg,uploads/img/products/1738827542_9e4ac4b5a0ef4de0acb0.jpg,uploads/img/products/1738827542_464a6c05723c231fbb46.jpg,uploads/img/products/1738827542_0812be2a965b573d458d.jpg,uploads/img/products/1738827542_67a3bae1e0d5f23d2745.jpg,uploads/img/products/1738827542_2154fd6abaa1c685f6de.jpg', 521000.00, 42, '2025-02-01 02:10:37', '2025-02-06 07:39:02'),
('prd_679d8406', 'Sweater Dress Rajut Wanita', 'Atasan Wanita', 'SALE, LIMITED', 'Sweater Dress yang dirajut dari bahan wool yang hangat', 'uploads/img/products/1738827506_2b70815e60d1fa6dd225.webp,uploads/img/products/1738827506_c147a3da067e40132fa3.webp', 421000.00, 42, '2025-02-01 02:16:38', '2025-04-15 01:17:40'),
('prd_679d8f25', 'AUDIE Women\'s Cotton Graphic Crop Hoodie Maroon', 'Atasan Wanita', 'Exclusive, Popular, Sale', 'TONIQUE Women\'s Organic Cotton Graphic Cropped Hoodie\r\nSku: Audie\r\nColor: Maroon\r\nBesties Series\r\nRegular Fit Cropped Hoodie\r\n\r\nAt TONIQUE, we always seek new ways to inspire your wardrobe. Our Cropped Hoodie draws on the iconic Besties attitude to give you an edgy option when layering up. With authentic graphics that give your everyday look a unique and bold twist.', 'uploads/img/products/1738679949_0b02d16dba5bf17e14ec.webp,uploads/img/products/1738679949_aea4d4a17ee134329293.webp,uploads/img/products/1738679949_cbe9867f4f976e6f4ef0.webp,uploads/img/products/1738679949_69b02a56af2bd9ddb398.webp,uploads/img/products/1738679949_73948054dbdfb4588a96.webp,uploads/img/products/1738679949_1b384d9d5ed58f428c91.webp,uploads/img/products/1738679949_28fae2e146e4512a601c.webp', 612000.00, 421, '2025-02-01 03:04:05', '2025-02-04 14:41:07'),
('prd_67a1f877', 'TONIQUE Turtle Neck Katun Pink SALLY', 'Atasan Wanita', 'sale, popular, limited', 'TONIQUE Kaos Turtle Neck Katun Wanita Warna Pink SALLY Cotton Regular Fit Turtle Neck Pink Top\r\n\r\n\r\n\r\nModel: Ukuran S, Tinggi: 170cm, Lingkar dada: 83cm\r\n\r\nBahan: 98% Katun Combed 2% Lycra Super-Soft 1x1 Rib\r\n\r\nRegular-Fit Turtle Neck Top\r\n\r\nWarna: Merah Muda, Pink\r\n\r\nTONIQUE Basics\r\n\r\nSKU: Sally\r\n\r\nDisikat halus untuk kesan nyaman. Turtleneck kami yang elegan. Permukaan yang disikat halus untuk kehangatan ekstra. Diproses secara khusus untuk mencegah penyusutan setelah dicuci agar tetap pas. Desain turtleneck yang serbaguna dan elegan. Mudah untuk dipadupadankan.', 'uploads/img/products/1738679831_09cdeead957a9327a732.webp,uploads/img/products/1738679831_f9e42c65e7d3649d46ca.webp,uploads/img/products/1738679831_4ce1de014bc67d0e8d7a.webp,uploads/img/products/1738679831_fe00cbc599ff071b2ccc.webp,uploads/img/products/1738679831_93972d13659a559c25e1.webp,uploads/img/products/1738679831_dfe1d678fe2a2f524bb5.webp', 349000.00, 42, '2025-02-04 11:22:31', '2025-02-04 14:37:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id_review` char(12) NOT NULL,
  `id_order` char(12) NOT NULL,
  `id_customer` varchar(12) NOT NULL,
  `id_product` char(12) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_detail_order`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_detail_order` (
`id_order` char(12)
,`id_customer` varchar(12)
,`id_order_item` char(12)
,`id_product` char(12)
,`product_name` varchar(255)
,`quantity` int(11)
,`price` decimal(10,2)
,`total_price` decimal(20,2)
,`payment_status` enum('Not Yet Paid','Paid off','Failed')
,`order_status` enum('waiting for payment','processed','shipped','completed','canceled')
,`id_review` char(12)
,`rating` int(1)
,`review_text` text
,`review_created_at` datetime
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_detail_order`
--
DROP TABLE IF EXISTS `view_detail_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_order`  AS SELECT `o`.`id_order` AS `id_order`, `o`.`id_customer` AS `id_customer`, `oi`.`id_order_item` AS `id_order_item`, `oi`.`id_product` AS `id_product`, `p`.`product_name` AS `product_name`, `oi`.`quantity` AS `quantity`, `oi`.`price` AS `price`, `oi`.`quantity`* `oi`.`price` AS `total_price`, `pay`.`status` AS `payment_status`, `o`.`status` AS `order_status`, `r`.`id_review` AS `id_review`, `r`.`rating` AS `rating`, `r`.`review_text` AS `review_text`, `r`.`created_at` AS `review_created_at` FROM ((((`orders` `o` join `order_items` `oi` on(`o`.`id_order` = `oi`.`id_order`)) join `products` `p` on(`oi`.`id_product` = `p`.`id_product`)) left join `payment` `pay` on(`o`.`id_order` = `pay`.`id_order`)) left join `product_reviews` `r` on(`o`.`id_order` = `r`.`id_order` and `oi`.`id_product` = `r`.`id_product` and `o`.`id_customer` = `r`.`id_customer`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_id_customer_foreign` (`id_customer`),
  ADD KEY `cart_id_product_foreign` (`id_product`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_order_item` (`id_order_item`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_id_customer_foreign` (`id_customer`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `order_items_id_order_foreign` (`id_order`),
  ADD KEY `order_items_id_product_foreign` (`id_product`);

--
-- Indeks untuk tabel `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id_owner`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_review_order` (`id_order`),
  ADD KEY `fk_review_customer` (`id_customer`),
  ADD KEY `fk_review_product` (`id_product`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_order_ibfk_3` FOREIGN KEY (`id_order_item`) REFERENCES `order_items` (`id_order_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_order_ibfk_4` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `fk_review_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
