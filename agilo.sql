
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_manager`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'manager', 'alex@w-online.ru', 1, NULL, '$2y$10$QEn9V5rpt95S3SjcTwvydOa42L9sJ6EPjtmyvH5nXm3e.R1QJaHfy', NULL, '2020-03-28 11:20:13', '2020-03-28 11:20:13');
