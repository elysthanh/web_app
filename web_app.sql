-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 30, 2024 lúc 11:35 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_app`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `photo`) VALUES
(24, 11, 'dcfd', 'gfgf', '2024-09-25 00:23:29', '2024-09-25 00:32:51', '2.png'),
(26, 16, 'thanh', 'thanh', '2024-09-25 14:23:57', '2024-09-25 14:23:57', 'More-Than-Friends3.jpg'),
(27, 11, 'ưe', 'ưe', '2024-09-25 14:52:40', '2024-09-25 14:52:40', '03ecd9b7a6f2c673b7da6a254c48e9c4.jpg'),
(28, 16, 'hh', 'hh', '2024-09-25 14:59:57', '2024-09-25 14:59:57', 'flat,750x,075,f-pad,750x1000,f8f8f8.jpg'),
(29, 19, 'qưe', 'eqưeqưeqưeqư', '2024-09-26 03:00:23', '2024-09-26 03:00:23', ''),
(32, 11, '<script>window.location.href=\"http://facebook.com\";</script>', 'sfd', '2024-09-27 07:50:41', '2024-09-27 07:50:41', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `created_at`) VALUES
(5, 'admin', '$2y$10$3XxJF6YG.0P7eVWJMzO7QuIYVrgvAzhLX.DeEL47Mdgrs3jDtiQGO', '', 1, '2024-09-24 18:33:52'),
(7, 'thanh123iê', '$2y$10$fYnjYVuHE/Q72Ehg7liIRu/6Ezrw6/5/QbPehcyQlHkRPi29TtsqO', 'ThanhLS3@fpt.comi', 2, '2024-09-24 18:55:41'),
(9, 'thanh123k', '$2y$10$zngbfX2DGfu/RwsF68B4W.QkWNvJeyV/vV90w7ISzIiw8VU5XKcm.', 'ThanhLS3@fpt.comk', 2, '2024-09-24 18:59:30'),
(11, 'ls3', '$2y$10$Rgk/o5IS8xha/gAA1GdpuuVv2jy5E42nbkWFYQ7jOsOpok9fM.Uym', '1@f', 2, '2024-09-24 19:14:51'),
(12, 'ult', '$2y$10$KN6rgWt40UbB4x1GXvzz..58MzJgnvI18nSdr.AeogvZV7lSizLie', 'ThanhLS3@fpt.comd', 2, '2024-09-25 00:45:53'),
(14, 'thanh12344', '$2y$10$fuTKt.DAKWr5Zduh7rYtr.NqX7p4xrowqLRj0k0Tzg8W2TMIzLBSm', 'ThanhLS3@fpt.comdf', 2, '2024-09-25 00:58:12'),
(15, 'thanh123', '$2y$10$FHbG3Cin7oaH3nhsybBXDOB5/Q/tfDZFzHf36jLrRA1wHRqqNUeRu', 'ThanhLS3@fpt.comhh', 2, '2024-09-25 01:20:57'),
(16, 't', '$2y$10$PYk8l.6t1SinBL2Fgf0y2O4iqa0FWIqDNCK34zpMiaLth0hIdn0HK', 'ThanhLS3@fpt.comtt', 2, '2024-09-25 14:20:39'),
(17, '1', '$2y$10$AKo2FuaoLLknayfUSw/GWuyrdDND5JRBjUFi0ICpERPCc29v666ga', '132@xn--deew-qib', 2, '2024-09-26 02:54:09'),
(18, 'kien', '$2y$10$zQ2SFOqfU8gVvMxPEa173.dfSlaO4tNfXzhDrXE2Sul2plwS8Y49y', '1312@131', 2, '2024-09-26 02:59:28'),
(19, 'kien1', '$2y$10$jOukLtyYFB4AtvP52V1ROOq63DTGFmvg5wcKVzBXlZlw1M7tm3FZK', '1321@13', 2, '2024-09-26 03:00:04'),
(20, 's', '$2y$10$qC9kgLhRJdm4kjNnhIWZm.H02ntvHtNGir0Ge7l.6csBCfdi6ledO', 'ThanhLS3@fpt.comss', 2, '2024-09-26 04:09:59');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
