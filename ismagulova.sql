-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 22 2021 г., 02:52
-- Версия сервера: 5.7.29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ismagulova`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `begin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `text`, `price`, `author`, `created`, `begin`, `status`) VALUES
(1, 'Курс по финансовой грамотности', '<p>видео уроки<br>раздаточный материал для выполнения домашних заданий<br>общий чат с преподавателем<br>проверка домашнего задания<br>общий созвон с мной для сессии вопросов и ответов</p>', '', 10000, 'Alzhan', '2020-11-02 14:58:15', '2020-11-02 14:58:15', '1'),
(2, 'Курс по инвестициям', '<p>видео уроки<br>раздаточный материал для выполнения домашних заданий<br>общий чат с преподавателем<br>проверка домашнего задания<br>общий созвон с мной для сессии вопросов и ответов</p>', '', 40000, 'Alzhan', '2020-11-03 02:02:22', '2020-11-03 02:02:22', '1'),
(3, 'Финансовые консультации', '<p>видео уроки<br>раздаточный материал для выполнения домашних заданий<br>общий чат с преподавателем<br>проверка домашнего задания<br>общий созвон с мной для сессии вопросов и ответов</p>', '', 30000, 'Alzhan', '2020-11-30 12:49:49', '2020-11-30 12:49:49', '1'),
(5, 'Курс 5', '<p>Текст курса 55</p>', '<p>Текст курса 5</p>', 123, 'Alzhan', '2021-01-21 14:04:24', '2021-01-21 14:04:24', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_left` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_right` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` float(15,6) UNSIGNED NOT NULL,
  `base` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `code`, `symbol_left`, `symbol_right`, `value`, `base`) VALUES
(3, 'Тенге', 'KZT', '₸', '', 1.000000, '1'),
(4, 'Доллар', 'USD', '$', '', 0.002400, '0'),
(5, 'Евро', 'EUR', '€', '', 0.002000, '0'),
(6, 'Рубль', 'RUR', '₽', '', 0.170000, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `filesson`
--

CREATE TABLE `filesson` (
  `id` int(11) NOT NULL,
  `lesson` int(11) NOT NULL,
  `file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `description`, `image`, `created`, `modified`, `status`) VALUES
(2, 'Троянский Cov: ученые объяснили феномен повторного заражения', '<p>Они выдвинули гипотезу, что&nbsp;коронавирус «прячется» во&nbsp;внеклеточных пузырьках, а&nbsp;затем выходит наружу.</p><h3>Затаившееся зло</h3><p>Согласно рекомендациям <a href=\"https://news.mail.ru/company/voz/\">ВОЗ</a>, пациента после перенесенного COVID-19 можно выписать из&nbsp;больницы после двух последовательных отрицательных результатов ПЦР. Анализы нужно проводить с&nbsp;разницей во&nbsp;времени не&nbsp;меньше суток.</p>', 'db6851a2b511434d6674505ad4aea03619cd0ee7.jpg', '2021-01-15 01:01:28', '2021-01-15 01:01:28', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `messagefiles`
--

CREATE TABLE `messagefiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reading` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `visible` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `parent`, `sender`, `reciever`, `email`, `subject`, `text`, `created`, `reading`, `visible`) VALUES
(18, 0, 36, 35, 'adm1nistratorportala@yandex.ru', 'Тема 5 от пользователя', '<p>Письмо 5 от пользователя</p>', '2021-01-21 13:42:20', '1', '1'),
(19, 18, 36, 36, 'adm1nistratorportala@yandex.ru', 'Ответ на тему 5', '<p>Ответ на 5<br>Предыдущее сообщение:</p><p>Письмо 5 от пользователя</p>', '2021-01-21 13:45:15', '1', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `my_courses`
--

CREATE TABLE `my_courses` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `currency` enum('KZT','RUR','EUR','USD') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KZT',
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `created`, `modified`, `currency`, `note`) VALUES
(28, 36, '0', '2021-01-21 19:04:59', '2021-01-22 01:41:37', 'KZT', '');

-- --------------------------------------------------------

--
-- Структура таблицы `order_course`
--

CREATE TABLE `order_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_course`
--

INSERT INTO `order_course` (`id`, `order_id`, `course_id`, `qty`, `title`, `price`) VALUES
(33, 28, 2, 1, 'Курс по инвестициям', 40000),
(34, 28, 3, 2, 'Финансовые консультации', 30000);

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reading` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `streams`
--

CREATE TABLE `streams` (
  `id` int(11) NOT NULL,
  `courses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lessons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `recovery_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `token`, `ip`, `created`, `role`, `status`, `recovery_time`) VALUES
(35, 'Alzhan', 'alzhan_ismagulov@list.ru', '$2y$10$QbVPVdwF//zBqXzQjOJmyeY7TUjvqr6InzclJKWH4U1M7Kfr6QodC', '123', '', '127.0.0.1', '2020-10-18 12:05:18', 'admin', '1', 1604169562),
(36, 'user', 'adm1nistratorportala@yandex.ru', '$2y$10$Mv2iezyC31OtrwDkiNdWbuDaMtX9I/CXs0exGbyzwh38lB9G9yoWe', '321', '', '127.0.0.1', '2020-10-18 12:35:38', 'user', '1', NULL),
(37, 'Асемгуль', 'ismagulova.finance@gmail.com', '$2y$10$OPNVZNMkYVYpXGVQknN0Oe8zZwYNsFLyEVBcZvYdm0eLzOV0Cu4bO', '+36706549190', '', '127.0.0.1', '2020-10-31 12:49:36', 'admin', '1', NULL),
(38, 'user2', 'user2@mail.ru', '$2y$10$CgGIInbEX5qHQ0ikZ4wIcueHMRzx5La05IkeC3j7rlkokqmGzEpyK', '432', '', '127.0.0.1', '2020-11-12 01:41:45', 'user', '1', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filesson`
--
ALTER TABLE `filesson`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`id`);

--
-- Индексы таблицы `messagefiles`
--
ALTER TABLE `messagefiles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `my_courses`
--
ALTER TABLE `my_courses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_course`
--
ALTER TABLE `order_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`id`),
  ADD KEY `order_id_2` (`order_id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iin` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `filesson`
--
ALTER TABLE `filesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `messagefiles`
--
ALTER TABLE `messagefiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `my_courses`
--
ALTER TABLE `my_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `order_course`
--
ALTER TABLE `order_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_course`
--
ALTER TABLE `order_course`
  ADD CONSTRAINT `order_course_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
