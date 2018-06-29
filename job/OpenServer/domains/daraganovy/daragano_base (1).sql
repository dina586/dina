-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 09 2015 г., 10:25
-- Версия сервера: 5.5.45-cll-lve
-- Версия PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `daragano_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_blocks`
--

CREATE TABLE IF NOT EXISTS `tbl_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `page_position` varchar(255) NOT NULL,
  `is_view` int(11) NOT NULL,
  `view_title` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `tbl_blocks`
--

INSERT INTO `tbl_blocks` (`id`, `name`, `title`, `content`, `position`, `page_position`, `is_view`, `view_title`) VALUES
(2, 'Footer', '', '<div class="l-left">\r\n<p><strong>Broker:&nbsp; Sergey&nbsp;Melnikov</strong><br />\r\nLicense# 01369382<br />\r\n4302 Palm La Mesa CA,&nbsp; 91941</p>\r\n</div>\r\n\r\n<div class="l-right">\r\n<p><span style="font-size:12px"><strong>Real Estate Business Solutions</strong></span><br />\r\n<span style="font-size:12px">Powered by</span><br />\r\n<a href="http://www.365-Solutions.com" target="_blank"><span style="font-size:12px">www.365-Solutions.com</span></a></p>\r\n</div>\r\n\r\n<div class="g-clear_fix">&nbsp;</div>\r\n\r\n<p style="text-align:center">Copyright &copy; 2014 SVMRE All rights reserved</p>\r\n', 1000, 'footer', 1, 0),
(14, 'Услуги', 'Услуги', '<p>Профессиональная фото и видеосъемка любых мероприятий<br />\r\nПраздник, деловое мероприятие или просто прогулка по городу &ndash; запечатлеть любое событие Вам поможет профессиональная фотосъемка , профессиональная видеосъемка. Мы располагаем всем необходимым для того, чтобы на должном уровне провести съемку любой сложности, как в студии, так и на выезде. &nbsp;Современное оборудование, творческий подход к каждому заказу и многолетний опыт работы гарантируют результат, который удовлетворит даже самого взыскательного клиента.<br />\r\nЕсли Вам нужен профессиональный фотограф, профессиональный видеооператор для репортажной съемки, креативной фотосессии или на семейный праздник &ndash; смело обращайтесь к нам! Мы работаем на любых мероприятиях и всегда учитываем пожелания заказчика. Фотограф &nbsp;и видеооператор в Минске и любых других городах Беларуси снимет следующие мероприятия:<br />\r\nфото - и видеосъемка любых мероприятий;&nbsp;<br />\r\nсемейные и творческие фотосессии;<br />\r\nlove story;<br />\r\nсвадьбы, юбилеи, корпоративы и другие праздники;<br />\r\nФото видео съемка утренников, выпускных;<br />\r\nобработка снятого материала;<br />\r\nэксклюзивный монтаж видео;<br />\r\nсоздание фотокниги с индивидуальным дизайном.<br />\r\nНаш сайт фотографа, видеооператора содержит примеры фото- и видеоработ в разных жанрах, здесь же Вы найдете и цены, а для заключения договора и обсуждения индивидуальных подробностей будущей фотосессии или фильма мы предлагаем личную встречу в любом удобном для Вас месте.</p>\r\n', 1000, 'front_block', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_blog`
--

CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `create_date` date NOT NULL,
  `update_date` datetime NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seo_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seo_description` text CHARACTER SET utf8 NOT NULL,
  `seo_keywords` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `name`, `description`, `content`, `create_date`, `update_date`, `is_view`, `url`, `seo_title`, `seo_description`, `seo_keywords`) VALUES
(3, 'PHOTO POST', 'PHOTO POST', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>\r\n', '2015-07-08', '2015-07-09 00:00:00', 0, '', 'PHOTO POST', 'PHOTO POST', ''),
(1, 'A STICKY POST', 'A STICKY POST', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis metus vitae ligula elementum ut luctus lorem facilisis. Sed non leo nisl, ac euismod nisi. Aenean augue dolor, facilisis id fringilla ut, tempus vitae nibhfghg</p>\r\n', '2015-07-06', '2015-07-30 00:00:00', 0, '', 'A STICKY POST', 'A STICKY POST', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_email_message`
--

CREATE TABLE IF NOT EXISTS `tbl_email_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email_key` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `email_type` int(1) NOT NULL,
  `header` int(1) NOT NULL DEFAULT '1',
  `footer` int(1) NOT NULL DEFAULT '1',
  `success_message` text NOT NULL,
  `failed_message` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_key` (`email_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_email_message`
--

INSERT INTO `tbl_email_message` (`id`, `name`, `subject`, `message`, `email_key`, `comment`, `email_type`, `header`, `footer`, `success_message`, `failed_message`) VALUES
(1, 'Форма обратной связи', 'Сообщение с сайта - {SUBJECT}', '<p><strong>Иия: </strong>{NAME}</p>\r\n\r\n<p><strong>Тема:</strong> {SUBJECT}</p>\r\n\r\n<p><strong>Email:</strong> {EMAIL}</p>\r\n\r\n<p><strong>Сообщение:</strong> {MESSAGE}</p>\r\n', 'contact_form', '', 1, 1, 1, '', ''),
(2, 'Confirm registration', 'Confirm registration', '<p>Your registration has been successfully completed!</p>\r\n\r\n<p><strong>You login:</strong> {LOGIN}</p>\r\n\r\n<p><strong>Your password:</strong> {PASSWORD}</p>\r\n\r\n<p>To confirm an email address, please click here.</p>\r\n\r\n<p>{ACTIVATION_URL}</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'registration', '', 2, 1, 1, 'Thank you for your registration. Please check your email.', 'Upon registration error occurred. Please re-register or contact us.'),
(3, 'Password Recovery', 'Request for password recovery', '<p>To reset the password, use the link:<br />\r\n{PASSWORD_RECOVERY}</p>\r\n', 'password_recovery', '', 2, 1, 1, 'Please check your email. An instructions was sent to your email address.', ''),
(4, 'Эксперсс-заяка', 'Эксперсс-заяка', '<p><strong>Иия: </strong>{NAME}</p>\r\n\r\n<p><strong>Телефон:</strong> {PHONE}</p>\r\n\r\n<p><strong>Email:</strong> {EMAIL}</p>\r\n\r\n<p><strong>Сообщение:</strong> {MESSAGE}</p>\r\n', 'call_request', '', 1, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_email_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_email_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `tag_type` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `tbl_email_tags`
--

INSERT INTO `tbl_email_tags` (`id`, `name`, `tag`, `tag_type`) VALUES
(1, 'Sender Name', 'NAME', 1),
(2, 'Sender Message', 'MESSAGE', 1),
(3, 'Sender Email', 'EMAIL', 1),
(4, 'Email Subject', 'SUBJECT', 1),
(5, 'Activation Url', 'ACTIVATION_URL', 2),
(6, 'User password', 'PASSWORD', 1),
(7, 'User login', 'LOGIN', 1),
(8, 'Recover password', 'PASSWORD_RECOVERY', 2),
(9, 'Телефон', 'PHONE', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_email_tag_connect`
--

CREATE TABLE IF NOT EXISTS `tbl_email_tag_connect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_email_tag_connect`
--

INSERT INTO `tbl_email_tag_connect` (`id`, `email_id`, `tag_id`) VALUES
(3, 1, 1),
(4, 1, 2),
(5, 1, 3),
(6, 1, 4),
(8, 2, 5),
(9, 2, 6),
(10, 2, 7),
(11, 3, 8),
(12, 4, 1),
(13, 4, 2),
(14, 4, 3),
(15, 4, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_file_manager`
--

CREATE TABLE IF NOT EXISTS `tbl_file_manager` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(15) NOT NULL DEFAULT 'image',
  `folder` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1000',
  `cover` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=268 ;

--
-- Дамп данных таблицы `tbl_file_manager`
--

INSERT INTO `tbl_file_manager` (`id`, `file`, `file_type`, `folder`, `description`, `position`, `cover`, `date`, `model_id`, `model_name`) VALUES
(20, '2b40ef9af3.jpg', 'image', '684b9e3d4b', '', 1, 0, '2015-09-30 13:29:08', 1, 'Portfolio'),
(21, 'ed8a0e68b5.jpg', 'image', '684b9e3d4b', '', 2, 1, '2015-09-30 13:29:10', 1, 'Portfolio'),
(22, '70cf3b4090.jpg', 'image', '684b9e3d4b', '', 3, 0, '2015-09-30 13:29:33', 1, 'Portfolio'),
(23, '8bdba6a24d.jpg', 'image', '684b9e3d4b', '', 4, 0, '2015-09-30 13:29:44', 1, 'Portfolio'),
(26, '20d19ed67b.jpg', 'image', '684b9e3d4b', '', 7, 0, '2015-09-30 13:30:31', 1, 'Portfolio'),
(27, 'e628970303.jpg', 'image', '684b9e3d4b', '', 8, 0, '2015-09-30 13:30:45', 1, 'Portfolio'),
(28, '07969d2d1c.jpg', 'image', '684b9e3d4b', '', 9, 0, '2015-09-30 13:30:53', 1, 'Portfolio'),
(29, 'a5d716b28e.jpg', 'image', '684b9e3d4b', '', 10, 0, '2015-09-30 13:30:59', 1, 'Portfolio'),
(30, '7c0d810b74.jpg', 'image', '684b9e3d4b', '', 11, 0, '2015-09-30 13:31:06', 1, 'Portfolio'),
(31, 'eca0372852.jpg', 'image', '684b9e3d4b', '', 12, 0, '2015-09-30 13:31:17', 1, 'Portfolio'),
(32, '3d952fb70d.jpg', 'image', '684b9e3d4b', '', 13, 0, '2015-09-30 13:31:28', 1, 'Portfolio'),
(33, '3973add995.jpg', 'image', '684b9e3d4b', '', 14, 0, '2015-09-30 13:31:30', 1, 'Portfolio'),
(34, 'beb09f210c.jpg', 'image', '684b9e3d4b', '', 15, 0, '2015-09-30 13:31:50', 1, 'Portfolio'),
(35, '6961b2285b.jpg', 'image', '684b9e3d4b', '', 16, 0, '2015-09-30 13:31:53', 1, 'Portfolio'),
(36, '19c7ad8435.jpg', 'image', '684b9e3d4b', '', 17, 0, '2015-09-30 13:31:55', 1, 'Portfolio'),
(37, '0cae75511b.jpg', 'image', '684b9e3d4b', '', 18, 0, '2015-09-30 13:31:57', 1, 'Portfolio'),
(38, '8d4179d7d0.jpg', 'image', '684b9e3d4b', '', 19, 0, '2015-09-30 13:32:01', 1, 'Portfolio'),
(39, '6c94a88f87.jpg', 'image', '684b9e3d4b', '', 20, 0, '2015-09-30 13:32:03', 1, 'Portfolio'),
(40, '68778712dd.jpg', 'image', '684b9e3d4b', '', 21, 0, '2015-09-30 13:32:05', 1, 'Portfolio'),
(41, '7afcda3243.jpg', 'image', '684b9e3d4b', '', 22, 0, '2015-09-30 13:32:08', 1, 'Portfolio'),
(129, '6f3d378032.jpg', 'image', 'ad27f32d70', '', 3, 0, '2015-09-30 21:07:08', 4, 'Portfolio'),
(130, '0944893669.jpg', 'image', 'ad27f32d70', '', 4, 0, '2015-09-30 21:07:21', 4, 'Portfolio'),
(131, 'c7f996b1b0.jpg', 'image', 'ad27f32d70', '', 0, 0, '2015-09-30 21:07:23', 4, 'Portfolio'),
(132, '8254e92fae.jpg', 'image', 'ad27f32d70', '', 6, 0, '2015-09-30 21:07:49', 4, 'Portfolio'),
(135, 'd49ea5e545.jpg', 'image', 'ad27f32d70', '', 2, 0, '2015-09-30 21:08:26', 4, 'Portfolio'),
(137, 'c58cc67930.jpg', 'image', 'ad27f32d70', '', 1, 0, '2015-09-30 21:09:00', 4, 'Portfolio'),
(138, '30d0512fc8.jpg', 'image', 'ad27f32d70', '', 8, 0, '2015-09-30 21:09:27', 4, 'Portfolio'),
(139, '00f621d66e.jpg', 'image', 'ad27f32d70', '', 5, 0, '2015-09-30 21:09:29', 4, 'Portfolio'),
(140, '265bd8069a.jpg', 'image', 'ad27f32d70', '', 10, 0, '2015-09-30 21:09:46', 4, 'Portfolio'),
(142, 'c62a9b3be6.jpg', 'image', 'ad27f32d70', '', 14, 0, '2015-09-30 21:10:13', 4, 'Portfolio'),
(143, 'cbb1a27bd7.jpg', 'image', 'ad27f32d70', '', 11, 0, '2015-09-30 21:11:25', 4, 'Portfolio'),
(146, 'dbfebe211a.jpg', 'image', 'ad27f32d70', '', 12, 0, '2015-09-30 21:13:15', 4, 'Portfolio'),
(147, '741a2eb6a9.jpg', 'image', 'ad27f32d70', '', 13, 0, '2015-09-30 21:13:45', 4, 'Portfolio'),
(148, 'dcf58c5e37.jpg', 'image', 'ad27f32d70', '', 9, 0, '2015-09-30 21:14:05', 4, 'Portfolio'),
(154, 'a01e916b0c.jpg', 'image', 'ad27f32d70', '', 16, 0, '2015-09-30 21:19:33', 4, 'Portfolio'),
(155, 'd3499e592d.jpg', 'image', 'ad27f32d70', '', 15, 0, '2015-09-30 21:20:04', 4, 'Portfolio'),
(156, '0c77b348d1.jpg', 'image', 'ad27f32d70', '', 17, 0, '2015-09-30 21:21:15', 4, 'Portfolio'),
(157, '6f060a9c60.jpg', 'image', 'ad27f32d70', '', 25, 0, '2015-09-30 21:21:17', 4, 'Portfolio'),
(159, '4ee89b6619.jpg', 'image', 'ad27f32d70', '', 18, 0, '2015-09-30 21:21:46', 4, 'Portfolio'),
(160, 'e594660286.jpg', 'image', 'ad27f32d70', '', 22, 0, '2015-09-30 21:22:31', 4, 'Portfolio'),
(161, '9eb729edc1.jpg', 'image', 'ad27f32d70', '', 20, 0, '2015-09-30 21:22:44', 4, 'Portfolio'),
(162, 'afa3339965.jpg', 'image', 'ad27f32d70', '', 19, 0, '2015-09-30 21:22:46', 4, 'Portfolio'),
(163, '3d2d4892c0.jpg', 'image', 'ad27f32d70', '', 21, 0, '2015-09-30 21:23:06', 4, 'Portfolio'),
(166, '960853195a.jpg', 'image', 'ad27f32d70', '', 24, 0, '2015-09-30 21:24:10', 4, 'Portfolio'),
(167, 'e481b518c5.jpg', 'image', 'ad27f32d70', '', 23, 1, '2015-09-30 21:24:54', 4, 'Portfolio'),
(168, '8032ff69d9.jpg', 'image', 'ad27f32d70', '', 27, 0, '2015-09-30 21:25:16', 4, 'Portfolio'),
(170, '0d62f16619.jpg', 'image', 'ad27f32d70', '', 26, 0, '2015-09-30 21:25:22', 4, 'Portfolio'),
(171, '86da1ab1b0.jpg', 'image', 'ad27f32d70', '', 28, 0, '2015-09-30 21:25:41', 4, 'Portfolio'),
(173, 'e5d3ad314e.jpg', 'image', 'ad27f32d70', '', 34, 0, '2015-09-30 21:27:09', 4, 'Portfolio'),
(174, '0bf8a9d0e1.jpg', 'image', 'ad27f32d70', '', 37, 0, '2015-09-30 21:27:11', 4, 'Portfolio'),
(175, 'c1bc71fde0.jpg', 'image', 'ad27f32d70', '', 39, 0, '2015-09-30 21:27:13', 4, 'Portfolio'),
(176, 'ed37fb49b7.jpg', 'image', 'ad27f32d70', '', 32, 0, '2015-09-30 21:27:30', 4, 'Portfolio'),
(177, '939c751ec1.jpg', 'image', 'ad27f32d70', '', 30, 0, '2015-09-30 21:27:32', 4, 'Portfolio'),
(178, 'b208ff05eb.jpg', 'image', 'ad27f32d70', '', 36, 0, '2015-09-30 21:27:45', 4, 'Portfolio'),
(179, '1fcce28edb.jpg', 'image', 'ad27f32d70', '', 35, 0, '2015-09-30 21:28:09', 4, 'Portfolio'),
(180, '5f15ad8ecd.jpg', 'image', 'ad27f32d70', '', 33, 0, '2015-09-30 21:28:11', 4, 'Portfolio'),
(181, '939c7c984b.jpg', 'image', 'ad27f32d70', '', 29, 0, '2015-09-30 21:28:16', 4, 'Portfolio'),
(182, '4439de9ac2.jpg', 'image', 'ad27f32d70', '', 38, 0, '2015-09-30 21:28:21', 4, 'Portfolio'),
(183, '8754c5e344.jpg', 'image', 'ad27f32d70', '', 31, 0, '2015-09-30 21:30:48', 4, 'Portfolio'),
(184, '02e1409e7e.jpg', 'image', 'ad27f32d70', '', 40, 0, '2015-09-30 21:34:39', 4, 'Portfolio'),
(185, 'f8baa71cac.jpg', 'image', 'ad27f32d70', '', 41, 0, '2015-09-30 21:34:42', 4, 'Portfolio'),
(186, 'c45f9bd87b.jpg', 'image', 'ad27f32d70', '', 44, 0, '2015-09-30 21:34:55', 4, 'Portfolio'),
(187, '5c187299e0.jpg', 'image', 'ad27f32d70', '', 46, 0, '2015-09-30 21:35:17', 4, 'Portfolio'),
(188, 'dc0372e2c7.jpg', 'image', 'ad27f32d70', '', 43, 0, '2015-09-30 21:35:19', 4, 'Portfolio'),
(189, 'ac1b98adb0.jpg', 'image', 'ad27f32d70', '', 45, 0, '2015-09-30 21:35:28', 4, 'Portfolio'),
(190, 'c4c6d757af.jpg', 'image', 'ad27f32d70', '', 42, 0, '2015-09-30 21:35:30', 4, 'Portfolio'),
(191, '799173bd04.jpg', 'image', 'ad27f32d70', '', 47, 0, '2015-09-30 21:35:39', 4, 'Portfolio'),
(192, '5caec8d318.jpg', 'image', 'ad27f32d70', '', 7, 0, '2015-09-30 21:45:09', 4, 'Portfolio'),
(194, 'c28430504d.jpg', 'image', 'c654e6739f', '', 1, 0, '2015-09-30 21:49:44', 2, 'Portfolio'),
(195, '44178da078.jpg', 'image', 'c654e6739f', '', 0, 0, '2015-09-30 21:49:53', 2, 'Portfolio'),
(196, 'b28e051437.jpg', 'image', 'c654e6739f', '', 3, 0, '2015-09-30 21:50:08', 2, 'Portfolio'),
(197, '98c8f40cb2.jpg', 'image', 'c654e6739f', '', 4, 0, '2015-09-30 21:50:30', 2, 'Portfolio'),
(198, '72a64f55bf.jpg', 'image', 'c654e6739f', '', 5, 0, '2015-09-30 21:50:34', 2, 'Portfolio'),
(199, '06bef7c198.jpg', 'image', 'c654e6739f', '', 7, 1, '2015-09-30 21:51:10', 2, 'Portfolio'),
(200, '4c2d116625.jpg', 'image', 'c654e6739f', '', 8, 0, '2015-09-30 21:51:19', 2, 'Portfolio'),
(201, '0a62a893f1.jpg', 'image', 'c654e6739f', '', 9, 0, '2015-09-30 21:51:38', 2, 'Portfolio'),
(202, 'c5dfaa0941.jpg', 'image', 'c654e6739f', '', 10, 0, '2015-09-30 21:51:54', 2, 'Portfolio'),
(203, 'ce5b13f6a9.jpg', 'image', 'c654e6739f', '', 13, 0, '2015-09-30 21:52:09', 2, 'Portfolio'),
(204, 'be1b4b5e3b.jpg', 'image', 'c654e6739f', '', 14, 0, '2015-09-30 21:52:17', 2, 'Portfolio'),
(205, '60c96c590b.jpg', 'image', 'c654e6739f', '', 11, 0, '2015-09-30 21:52:32', 2, 'Portfolio'),
(206, '187175b833.jpg', 'image', 'c654e6739f', '', 12, 0, '2015-09-30 21:54:13', 2, 'Portfolio'),
(207, '453778b9a9.jpg', 'image', 'c654e6739f', '', 6, 0, '2015-09-30 21:54:22', 2, 'Portfolio'),
(208, '33b5a362ab.jpg', 'image', 'c654e6739f', '', 2, 0, '2015-09-30 21:54:36', 2, 'Portfolio'),
(210, 'a824dc77c5.jpg', 'image', '620e9b73c1', '', 1, 0, '2015-10-04 11:07:01', 3, 'Portfolio'),
(211, 'fd70907e0d.jpg', 'image', '620e9b73c1', '', 2, 0, '2015-10-04 11:07:21', 3, 'Portfolio'),
(212, 'b54908acf6.jpg', 'image', '620e9b73c1', '', 3, 0, '2015-10-04 11:07:25', 3, 'Portfolio'),
(213, '97dac2b735.jpg', 'image', '620e9b73c1', '', 4, 0, '2015-10-04 11:07:29', 3, 'Portfolio'),
(214, '731cb37ea8.jpg', 'image', '620e9b73c1', '', 5, 1, '2015-10-04 11:07:49', 3, 'Portfolio'),
(215, '6605d94866.jpg', 'image', '620e9b73c1', '', 6, 0, '2015-10-04 11:08:20', 3, 'Portfolio'),
(216, '96d244b9e0.jpg', 'image', '620e9b73c1', '', 7, 0, '2015-10-04 11:08:31', 3, 'Portfolio'),
(217, '558516e9e7.jpg', 'image', '620e9b73c1', '', 8, 0, '2015-10-04 11:08:34', 3, 'Portfolio'),
(218, 'd3dcbf9547.jpg', 'image', '620e9b73c1', '', 9, 0, '2015-10-04 11:08:59', 3, 'Portfolio'),
(219, '68b3a81c56.jpg', 'image', '620e9b73c1', '', 10, 0, '2015-10-04 11:09:07', 3, 'Portfolio'),
(220, '58e7578b72.jpg', 'image', '620e9b73c1', '', 11, 0, '2015-10-04 11:09:10', 3, 'Portfolio'),
(221, 'bf3ceded2a.jpg', 'image', '620e9b73c1', '', 12, 0, '2015-10-04 11:09:32', 3, 'Portfolio'),
(222, 'c02e6374d2.jpg', 'image', '620e9b73c1', '', 13, 0, '2015-10-04 11:09:39', 3, 'Portfolio'),
(223, '7678372974.jpg', 'image', '620e9b73c1', '', 14, 0, '2015-10-04 11:09:41', 3, 'Portfolio'),
(224, 'bf01ac1f9d.jpg', 'image', '620e9b73c1', '', 15, 0, '2015-10-04 11:10:28', 3, 'Portfolio'),
(225, '8b0a631a0c.jpg', 'image', '620e9b73c1', '', 16, 0, '2015-10-04 11:10:35', 3, 'Portfolio'),
(226, 'fb88dba990.jpg', 'image', '620e9b73c1', '', 17, 0, '2015-10-04 11:10:36', 3, 'Portfolio'),
(227, 'f72f8dc1c5.jpg', 'image', '620e9b73c1', '', 18, 0, '2015-10-04 11:10:42', 3, 'Portfolio'),
(228, '97d015fdfb.jpg', 'image', '620e9b73c1', '', 19, 0, '2015-10-04 11:10:55', 3, 'Portfolio'),
(229, '527ce7d5b5.jpg', 'image', '620e9b73c1', '', 20, 0, '2015-10-04 11:10:56', 3, 'Portfolio'),
(230, '79d12e307a.jpg', 'image', '620e9b73c1', '', 21, 0, '2015-10-04 11:11:04', 3, 'Portfolio'),
(231, 'fd6cb88be6.jpg', 'image', '620e9b73c1', '', 22, 0, '2015-10-04 11:11:18', 3, 'Portfolio'),
(232, '9f20e0654b.jpg', 'image', '620e9b73c1', '', 23, 0, '2015-10-04 11:11:25', 3, 'Portfolio'),
(233, '5ad8d228db.jpg', 'image', '620e9b73c1', '', 24, 0, '2015-10-04 11:11:51', 3, 'Portfolio'),
(234, 'b1a97370ac.jpg', 'image', '620e9b73c1', '', 25, 0, '2015-10-04 11:11:57', 3, 'Portfolio'),
(235, '042c0c9820.jpg', 'image', '620e9b73c1', '', 26, 0, '2015-10-04 11:12:12', 3, 'Portfolio'),
(236, '058bb27d92.jpg', 'image', '620e9b73c1', '', 27, 0, '2015-10-04 11:12:19', 3, 'Portfolio'),
(237, '63d9d8dc40.jpg', 'image', '620e9b73c1', '', 28, 0, '2015-10-04 11:12:21', 3, 'Portfolio'),
(238, '48c1918f2d.jpg', 'image', '620e9b73c1', '', 29, 0, '2015-10-04 11:12:31', 3, 'Portfolio'),
(239, '9ca156d5ea.jpg', 'image', '620e9b73c1', '', 30, 0, '2015-10-04 11:12:43', 3, 'Portfolio'),
(240, '9490850fd0.jpg', 'image', '620e9b73c1', '', 31, 0, '2015-10-04 11:12:45', 3, 'Portfolio'),
(241, '9bab6318ff.jpg', 'image', '620e9b73c1', '', 32, 0, '2015-10-04 11:12:53', 3, 'Portfolio'),
(242, '5b35ca6fa4.jpg', 'image', '620e9b73c1', '', 33, 0, '2015-10-04 11:13:00', 3, 'Portfolio'),
(243, 'ba0c3187ba.jpg', 'image', '620e9b73c1', '', 34, 0, '2015-10-04 11:13:10', 3, 'Portfolio'),
(244, '6701fcfd69.jpg', 'image', '620e9b73c1', '', 35, 0, '2015-10-04 11:13:12', 3, 'Portfolio'),
(245, '67f36dded9.jpg', 'image', '620e9b73c1', '', 36, 0, '2015-10-04 11:13:22', 3, 'Portfolio'),
(246, 'cb9005cdda.jpg', 'image', '620e9b73c1', '', 37, 0, '2015-10-04 11:13:34', 3, 'Portfolio'),
(247, 'cff31df7d6.jpg', 'image', '620e9b73c1', '', 38, 0, '2015-10-04 11:13:36', 3, 'Portfolio'),
(248, '3b96345235.jpg', 'image', '620e9b73c1', '', 39, 0, '2015-10-04 11:13:41', 3, 'Portfolio'),
(258, '2aa8b7b11b.jpg', 'image', '6d9b1fc984', '', 1, 1, '2015-10-04 13:13:57', 6, 'Portfolio'),
(259, 'de04b017cd.jpg', 'image', '3778775548', '', 1, 1, '2015-10-04 13:20:49', 7, 'Portfolio'),
(260, 'eb6d776839.jpg', 'image', '0fa023a135', '', 2, 1, '2015-10-04 13:28:42', 8, 'Portfolio'),
(261, '093f4c7df6.jpg', 'image', '554f76ef4e', '', 1, 1, '2015-10-04 13:31:04', 9, 'Portfolio'),
(266, '6173673a5b.jpg', 'image', 'bfcf1e2c9b', '', 1, 1, '2015-10-04 13:48:14', 10, 'Portfolio'),
(267, '91dbbb6226.jpg', 'image', '5662ba5d5c', '', 1, 1, '2015-10-04 17:38:14', 5, 'Portfolio');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_front_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_front_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `tbl_front_slider`
--

INSERT INTO `tbl_front_slider` (`id`, `name`, `position`, `content`) VALUES
(17, 'Свадебное фото 1', 1000, '<p>плвжаопваж</p>\r\n'),
(18, 'Свадебное фото 2', 1010, '<p>trt</p>\r\n'),
(20, 'Свадебное фото 3', 1030, '<p>ttrt</p>\r\n'),
(21, 'Свадебное фото 4', 1020, '<p>vjf</p>\r\n'),
(23, 'Детское фото 1', 1040, '<p>yty</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `create_date` date NOT NULL,
  `update_date` datetime NOT NULL,
  `is_view` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_opinion`
--

CREATE TABLE IF NOT EXISTS `tbl_opinion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `create_date` date NOT NULL,
  `view_on_main` tinyint(1) NOT NULL,
  `radiobutton` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `tbl_opinion`
--

INSERT INTO `tbl_opinion` (`id`, `name`, `content`, `is_view`, `is_new`, `create_date`, `view_on_main`, `radiobutton`) VALUES
(7, 'Оксана и Александр', '<p>Павел и Юлия!)Спасибо вам большое за фото и видео))))Все фотографии просто замечательные а видео просто нету слов ЭТО СУПЕР))))))))))))))Смеялись до слез)))) ВЫ САМЫЕ ЛУЧШИЕ))))))))))))))</p>\r\n', 1, 1, '2015-09-24', 0, 0),
(8, 'Татьяна Зверова', '<p>Огромное спасибо ребятам за чудесный предсвадебный подарок, море позитива во время свадебной фото сессии и профессионализм. Такой оперативной и слаженной работы мы еще не видели. Вы - лучшие!</p>\r\n', 1, 0, '2015-09-24', 0, 0),
(9, 'Алена Чиж', '<p>Спасибо вам огромное за чудесную фотосессию!!! Ваши фото безумно красивые и &quot;живые&quot;))Вы настоящие профессионалы!!! ))Творческого вдохновения вам в вашем нелегком труде)))</p>\r\n', 0, 0, '2015-09-25', 0, 0),
(10, 'Оля Зеневич', '<p>Спасибо вам мои хорошие ЗА ВАШУ РАБОТУ!))) Всё было просто супер, вы умнички.)) Я очень всем довольно и вы замечательные люди, фото получились очень живыми, весёлыми, яркими и нежными. Видео безусловно тоже на высоте!)) Спасибо вам огромное, наша семья вам очень благодарна!))) &nbsp;</p>\r\n', 1, 0, '2015-09-25', 1, 0),
(11, 'Алексей Кураков', '<p>))))) Спасибо!!!</p>\r\n', 1, 0, '2015-09-24', 0, 0),
(12, 'Андрей Назаренко', '<p>Спасибо за фотосет! Люди которые и вправду знают свое дело! Куча эмоций!</p>\r\n', 1, 0, '2015-09-24', 1, 0),
(13, 'Ира и Женя', '<p>Ребята,спасибо вам большое!!!Нам очень комфортно,легко и приятно с вами работать,очень надеемся что это были не последние с вами встречи!&nbsp;</p>\r\n', 1, 0, '2015-10-04', 0, 0),
(14, 'Надежда Алексеенко', '<p>Вчера целый вечер смотрела....слёзы наворачиваются!&nbsp;&nbsp;<br />\r\nКак же здорово Вы всё сделали!Такая память нам будет! &nbsp;</p>\r\n', 1, 1, '2015-10-04', 0, 0),
(15, 'Анастасия Климович', '<p>СПАСИБО! Вы лучшие из лучших! Вы в буквальном смыле преданные своему делу. Очень красиво, все фото живые, хочется смотреть и смотреть. Лучше подобного не встречала. Успехов Вам в Вашем деле!</p>\r\n', 1, 0, '2015-10-04', 0, 0),
(16, 'Марина Назаренко', '<p>Ребята!Спасибо за фото,за позитив в общении ,за Ваше терпение,за кропотливую работу!Творческих Вам успехов !Надеемся на новые встречи!</p>\r\n', 1, 0, '2015-10-04', 0, 0),
(17, 'Кристина Аулова', '<p>спасибо большое за фото сессию!такого фотографа я ещё не встречала.ты не то,что фотограф,ты и как человек просто великолепна!!!!<br />\r\nвсем советую именно её и мужа!!!)<br />\r\nвы превосходны,мы от вас в восторге!</p>\r\n', 1, 0, '2015-10-04', 1, 0),
(18, 'Анна Заеленчик', '<p>Юлька,фотографии просто супер,обалденные!<br />\r\nНет слов,что бы описать восторг!Ты просто мастер своего дела!<br />\r\nЯ очень благодарна что в самый лучший день в жизни ты была рядом и запечатлила яркие моменты этого события!</p>\r\n', 1, 0, '2015-10-04', 1, 0),
(19, 'Николай Бедрицкий', '<p>Большое спасибо! Всё сделано классно! Ребята, вы СУПЕР!!!!!</p>\r\n', 1, 0, '2015-10-04', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `name`, `content`, `url`, `title`, `description`, `keywords`) VALUES
(1, 'Профессиональная фотосъемка, видеосъемка, цены на фотографа в Минске', '<p>Мы рады приветствовать Вас на нашем сайте. Наша работа - профессиональная фото и видеосъемка праздничных и деловых мероприятий, семейная, love story, свадебная съемка, профессиональная обработка отснятого материала и эксклюзивный монтаж.</p>\r\n', 'daraganovy', 'Профессиональная фотосъемка, видеосъемка, цены на фотографа в Минске', 'daraganovy', 'daraganovy'),
(3, 'о нас', '<p><strong>Студия Daganovy</strong> &ndash; профессиональная фото- и видеосъемка любых деловых событий, бизнес-роликов, рекламных клипов, частных фотосессий и фильмов, праздников и любых других мероприятий. Каждую из своих работ мы стремимся сделать .индивидуальной, яркой и насыщенной,&nbsp; начиная от концепции съемок и заканчивая постобработкой и монтажом. Идя в ногу с техническим прогрессом, наша студия в работе использует только передовую современную технику, начиная от камер и заканчивая программным обеспечением.</p>\r\n\r\n<p>Все <a href="/video">фильмы </a>и <a href="/photo">фотосессии </a>нашего производства получаются насыщенными и увлекательными, производя на зрителя именно тот эффект, на который рассчитывает клиент при обращении к нам. Концепция, режиссура, съемка, монтаж &ndash; каждый этап выполняется профессионалами в своей области, что гарантирует по-настоящему качественный результат, зачастую даже превосходящий ожидания клиента.</p>\r\n\r\n<h2>Наши цели и задачи</h2>\r\n\r\n<p>Главной задачей для себя мы видим не только предоставление профессиональных услуг, но и постоянное развитие в области фотографии, видеосъемки и монтажа. Мы не только хотим быть лучше других, с каждым новым заказом мы стремимся быть лучше самих себя . Какой бы сложной не была съемка и ее концепция, мы выполним ее в лучшем виде, и Вы будете полностью удовлетворены результатом.</p>\r\n\r\n<h2>Оборудование студии Daganovy</h2>\r\n\r\n<p>В работе мы используем технику и аппаратуру высокого класса, такую как <strong>Sony, Canon, Nikon и Apple</strong>. Это позволяет нам исключать даже самый небольшой брак и работать с изображениями и видео в любом разрешении и формате.</p>\r\n\r\n<p>Смело обращайтесь к нам даже с самыми неожиданными задумками и идеями, вместе мы обязательно придумаем, как воплотить их в лучшем виде!</p>\r\n', 'about-us', 'О нас - профессиональная фото и видеосъемка', 'Наш команда поможет вам запечатлеть ваш праздник на всю жизнь. Индивидуальный подход к фото и видеосъемке!', 'daraganovy'),
(4, 'услуги', '<h2 style="text-align:justify">Фото и видеосъемка любых мероприятий</h2>\r\n\r\n<p style="text-align:justify"><strong>Фотосессия или фильм</strong> &ndash; отличный способ сохранить воспоминания о лучших и важных моментах личной, профессиональной и общественной жизни. Мы предлагаем съемку любых праздничных и просто значимых событий, в студии, на пленере, у Вас дома или в офисе &ndash; везде, где пожелает клиент, по самым доступным ценам.</p>\r\n\r\n<h3 style="text-align:justify">Фото- и видеосъемка свадеб в Минске: услуги</h3>\r\n\r\n<p style="text-align:justify">Если Вам нужна <a href="/photo">стильная свадебная фотосъемка</a>, <a href="/video">свадебная видеосъемка</a>, но не знаете, сможет ли свадебный фотограф или видеоператор реализовать ваши желания именно так, как Вы хотите? Обращайтесь к нам, и Вы не пожалеете! Мы учтем все пожелания и Ваши фото видео на свадьбу будут удивлять друзей и знакомых даже спустя многие годы. В дополнение к фильму мы можем предложит создание свадебной фотокниги с уникальным дизайном, который подчеркнет торжество и красоту этого волнующего дня.</p>\r\n\r\n<h3 style="text-align:justify">Фотограф и видеооператор на свадьбу: все услуги в одном месте</h3>\r\n\r\n<p style="text-align:justify">Всем нашим клиентам мы предлагаем комплексную услугу фото и видеосъемка на свадьбу, это намного удобней и выгодней как для Вас, так и для нас. Видеооператор на свадьбу, заказанный там же, где и свадебная фотосессия, будет работать намного лучше и свободнее, ведь с фотографом они будут одной командой. Это дает уникальные творческие возможности по реализации и съемке сложных сцен, которые придадут праздничному фильму изысканность, а фотосъемка свадьбы станет более уникальной.</p>\r\n\r\n<h3 style="text-align:justify">Фото видео съемка утренников, выпускных.</h3>\r\n\r\n<p style="text-align:justify">Для нас фото видеосъемка выпускного, утренников в Минске - не просто работа, это желание сделать ваши воспоминания еще более яркими и оставить для вас маленькое произведение искусства, в виде ярких фотографий, запоминающегося фильма, которые будет интересно смотреть всей семьей. Ребенок тоже будет вам благодарен, ведь повзрослев, у него всегда будет возможность окунуться в свое детство, взяв в руки фотоальбом,&nbsp; и вспомнить, с чего все начиналось.</p>\r\n\r\n<h3 style="text-align:justify">Индивидуальные фотосессии</h3>\r\n\r\n<p style="text-align:justify">Популярная в последние годы индивидуальная фотосессия &ndash; возможность не только пополнить свой альбом профессиональными качественными снимками, но еще и попробовать себя в различных амплуа, побывать на месте актеров. Обращайтесь к нам, и мы поможем определиться с образом, сюжетом и местом съемки, чтобы результат не только оправдал, но и превзошел Ваши ожидания.</p>\r\n\r\n<h3 style="text-align:justify">Семейные фотосессии</h3>\r\n\r\n<p style="text-align:justify"><strong>Семейная фотосессия с детьми </strong>&ndash; не только отличные фото, но и веселый, интересный досуг в кругу самых близкий людей. Профессиональные фото оставят этот маленький праздник&nbsp; в памяти навсегда, сохранив самые лучшие впечатления. Семейная фотосессия &ndash; лучший способ сохранить историю вашей семьи, которая на снимках останется такой же яркой, как и в&nbsp; день съемок.</p>\r\n\r\n<h3 style="text-align:justify">Фотосессии детей</h3>\r\n\r\n<p style="text-align:justify">Дети растут быстро и зачастую мы не замечаем, как они становятся совсем большими. Фотосессии с детьми &ndash; лучший подарок для Вашей семьи и детей, когда они совсем повзрослеют, ведь всегда интересно со стороны увидеть лучшие и радостные моменты собственного детства. Детский смех, веселые улыбки и Ваши малыши &ndash; все это останется с Вами навсегда в виде ярких профессиональных фотографий в семейном альбоме.</p>\r\n\r\n<h3 style="text-align:justify">Как заказать наши услуги?</h3>\r\n\r\n<p style="text-align:justify">При заказе фотосессии или видеосъемки заключается договор, четко оговаривающих обязанности исполнителя и права клиента, а также фиксируется сумма оплаты выбранной услуги. Связаться с нами Вы можете, заполнив форму обратной связи в разделе <a href="/contacts">&laquo;контакты&raquo;</a> или позвонив нам самостоятельно по указанным на сайте номерам.</p>\r\n', 'service', 'Свадебная фото и видеосъемка, услуги фотографа (оператора) на свадьбу в Минске', 'Операторы и фотографы с большим опытом и хорошим портфолио помогут вам сохранить воспоминания прошедших событий!!', 'услуги'),
(2, 'контакты', '<p><span style="font-size:18px">+37525-923-64-78 (life)</span></p>\r\n\r\n<p><span style="font-size:18px">+37533-610-15-64 (mts)</span></p>\r\n\r\n<p><span style="font-size:18px">Skype: daraganovy</span></p>\r\n\r\n<p><span style="font-size:18px">Email: daraganovy@gmail.com</span></p>\r\n', 'contact-us', 'контакты', 'контакты', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_portfolio`
--

CREATE TABLE IF NOT EXISTS `tbl_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `radiobutton` tinyint(1) NOT NULL,
  `create_date` date NOT NULL,
  `tags` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `tbl_portfolio`
--

INSERT INTO `tbl_portfolio` (`id`, `name`, `description`, `content`, `is_view`, `radiobutton`, `create_date`, `tags`) VALUES
(1, 'Свадебное фото', 'фото', '<p>Свадебные фотографии позволяют навсегда сохранить в памяти самые важные моменты праздника, передать пережитые чувства и эмоции. Хорошие фотографии являются результатом совместной, продуктивной работы фотографа и молодоженов. Свадьба - это день, насыщенный событиями, поэтому для фотографа открывается огромное поле для деятельности и творчества. В своих &nbsp;работах мы стремимся раскрыть внутренний мир, чувства, основные черты характера молодоженов.</p>\r\n', 1, 0, '2015-09-30', 'свадебное фото'),
(2, 'Love story', 'фото', '<p>Love story - &quot;любовная история&quot; - это замечательная возможность запечатлеть самые глубокие и нежные чувства влюбленных, это отличный подарок второй половинке, например, на день влюбленных, на знаменательную для Вас дату, это отличный вариант чтобы провести время с удовольствием, насладиться друг другом и получить первые фотографии в Вашем будущем семейном альбоме.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, 0, '2015-09-29', 'love story'),
(3, 'Портретное фото', 'фото', '<p>Портретная фотография - это целое искусство и отличный способ увидеть себя со стороны. Целью портретной фотографии является раскрытие индивидуальности человека, отразить суть личности и подать его в самом выгодном свете. Хороший снимок будет нести в себе и информацию о внутреннем мире: гармоничность внешних и внутренних черт. Фотографии людей, снятые на природе, &ndash; это нечто особенное. Такие снимки, в отличие от студийных фотографий, подкупают своей естественностью и отличаются большим разнообразием.&nbsp;</p>\r\n', 1, 0, '2015-09-22', 'портретное фото'),
(4, 'Детское фото', 'фото', '<p>Детская фотосъемка - это совершенно особый и сложный &nbsp;жанр фотографии, детям, в отличие от взрослых людей, абсолютно безразличен конечный результат, они никогда не сидят без дела, постоянно находятся в движении, что создает неудобство фотографу, ведь поймать красивый кадр в таких условиях не просто. Для удачной съемки фотограф должен сам немного стать ребенком и превратить весь процесс в веселую, увлекательную игру. Что может быть прекраснее смешных, ярких, иногда серьезных, неповторимых фотографий Вашего малыша, ведь детская фотография - это лучший способ вернуться в прошлое.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, 0, '2015-09-27', 'детское фото'),
(5, 'Slideshow', 'фото1', '<h5 style="text-align:center">Ира + Женя (love story)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/140983851?title=0&amp;byline=0&amp;portrait=0" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Настя + Володя + Ромка (свадебное slideshow)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/122238630" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Оксана + Александр (свадебное slideshow)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/114408206" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Оля + Саша (love story)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/93056014" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Оксана + Павел (свадебное slideshow)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/110596379" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Алиса + Алексей (love story)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/96797710" width="600"></iframe></p>\r\n\r\n<hr />\r\n<h5 style="text-align: center;">Екатерина + Алексей (свадебное slideshow)</h5>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="300" scrolling="no" src="https://player.vimeo.com/video/120453826" width="600"></iframe></p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n', 1, 0, '2015-08-31', 'slideshow'),
(6, 'Свадебное видео', 'Примеры работ', '<p>Как правило, свадебная видеосъемка включает в себя все важные моменты этого знаменательного дня &ndash; сборы молодых, выкуп невесты, свадебную церемонию в ЗАГСе, романтическую прогулку и торжество в банкетном зале.<br />\r\nПри этом романтическая прогулка молодоженов &ndash; наиболее важный момент, поскольку именно она позволяет получить самые красивые и романтичные кадры, которые могут стать основой видеоклипа.<br />\r\nЗаказывая&nbsp;видеооператора на свадьбу, помните о том, что только он способен запечатлеть все самые важные и интересные моменты вашей свадьбы и сделать ваше первое семейное видео на профессиональном уровне.</p>\r\n\r\n<h6 style="text-align:center">Анастасия &amp; Владимир</h6>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="281" src="https://player.vimeo.com/video/125598772?title=0&amp;byline=0&amp;portrait=0" width="500"></iframe></p>\r\n\r\n<p style="text-align:center">Свадебный день Насти и Володи запомнился нам&nbsp;как светлый, душевный праздник двух, любящих друг друга людей. Нам посчастливилось целый день провести в атмосфере любви и доброты.</p>\r\n\r\n<hr />\r\n<h6 style="text-align:center">Татьяна &amp; Дмитрий</h6>\r\n\r\n<h5 style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="281" src="https://player.vimeo.com/video/108559375?title=0&amp;byline=0&amp;portrait=0" width="500"></iframe></h5>\r\n\r\n<p style="text-align:center">&nbsp;Удивительно искренняя и романтичная свадьба Татьяны&nbsp;и Дмитрия. Глядя на них хочется любить и быть любимым.</p>\r\n\r\n<hr />\r\n<h6 style="text-align:center">Екатерина &amp; Евгений</h6>\r\n\r\n<h5 style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="281" scrolling="yes" src="https://player.vimeo.com/video/104322112?title=0&amp;byline=0&amp;portrait=0" width="500"></iframe></h5>\r\n\r\n<p style="text-align:center">Чувственные и открытые Екатерина и Евгений.</p>\r\n\r\n<hr />\r\n<h6 style="text-align:center">Оксана &amp; Александр</h6>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="281" scrolling="no" src="https://player.vimeo.com/video/116575825?title=0&amp;byline=0&amp;portrait=0" width="500"></iframe></p>\r\n\r\n<p style="text-align:center">Замечательная осенняя свадьба Оксаны и Александра. Ребята мужественно переносили осенний холод и согревали друг друга своими чувствами и объятиями.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n', 1, 1, '2015-09-21', 'свадебное видео'),
(7, 'Корпоративные праздники, юбилеи', 'Примеры работ', '<p>Корпоративный отдых является важной частью каждой компании, так как помогает сплотить коллектив, узнать каких-то сотрудников с другой стороны, их интересы и черты характера ни как работника, а как обычного человека.&nbsp;Профессиональная видеосъемка корпоративных мероприятий включает в себя также и съемку корпоративных вечеринок, очень популярных сегодня.</p>\r\n\r\n<hr />\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="360" src="//www.youtube.com/embed/MSm4QP58sTE" width="640"></iframe></p>\r\n\r\n<hr />\r\n<p style="text-align:center">&nbsp;</p>\r\n', 1, 1, '2015-09-20', 'корпоративы, юбилеи'),
(8, 'Утренники, выпускные', 'примеры работ', '<p>Всем родителям интересно посмотреть, чем занимаются их&nbsp;дети в&nbsp;саду, как себя ведут, кушают, гуляют, готовятся к&nbsp;школе. Как это сделать? Очень просто&nbsp;&mdash; пригласить профессионального видеооператора с&nbsp;хорошей видеокамерой и&nbsp;многолетним опытом работы, который в&nbsp;последствии смонтирует динамичный красочный фильм о жизни вашего ребенка в детском саду.</p>\r\n\r\n<hr />\r\n<p style="text-align: center;"><iframe allowfullscreen="" frameborder="0" height="360" scrolling="no" src="https://player.vimeo.com/video/141319511?title=0&amp;byline=0&amp;portrait=0" width="640"></iframe></p>\r\n', 1, 1, '2015-09-19', 'утренники, выпускные'),
(9, 'Выписка из роддома', 'примеры работ', '<p>Рождение ребенка одно из&nbsp;ярких событий в&nbsp;жизни родителей. Очень важно успеть запечатлеть самые яркие моменты в&nbsp;жизни нового человечка, ведь время детства пролетает очень быстро. С&nbsp;трепетом в&nbsp;сердце мамы записывают в&nbsp;альбомы для новорожденных первые важные даты: дата рождения, вес и&nbsp;рост, когда появился первый зубик, какое первое слово малыш произнес. Вот малыш сделал свой первый шажок. И&nbsp;все это хочется сохранить в&nbsp;памяти не&nbsp;только на&nbsp;бумаге, но&nbsp;и&nbsp;на&nbsp;фото и&nbsp;видео. Фото и&nbsp;видеосъемка выписки из&nbsp;роддома,&nbsp;крещение, первый&nbsp;день рождения&nbsp;&mdash; приятный маленький подарок себе и&nbsp;вашему ребенку.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h6 style="text-align:center">&quot;Это состояние счастьем называется...&quot;</h6>\r\n\r\n<p style="text-align:center"><iframe allowfullscreen="" frameborder="0" height="281" scrolling="no" src="https://player.vimeo.com/video/128069745?title=0&amp;byline=0&amp;portrait=0" width="500"></iframe></p>\r\n\r\n<p style="text-align:center">Нам посчастливилось поработать с талантливыми родителями Сергеем и Надеждой. Глядя на них, хочется всем пожелать как можно больше проводить времени в кругу своей семьи, любить и трепетно относиться друг к другу,&nbsp;радоваться каждому моменту в жизни.</p>\r\n', 1, 1, '2015-09-16', 'выписка из роддома'),
(10, 'Документальное видео', 'примеры работ', '<p>Экспериментальная категория.</p>\r\n', 0, 1, '2015-09-01', 'документальное');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(100) NOT NULL,
  `avatar_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `phone`, `avatar_img`) VALUES
(1, 'admin', 'admin', '', NULL),
(2, 'Die', 'Never', '', '4c6f98f521.jpg'),
(3, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL DEFAULT 'user',
  `operations` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_roles`
--

INSERT INTO `tbl_roles` (`user_id`, `role_name`, `operations`) VALUES
(1, 'admin', ''),
(2, 'developer', ''),
(3, 'developer', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_seo`
--

CREATE TABLE IF NOT EXISTS `tbl_seo` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `keywords` text,
  `url` varchar(100) DEFAULT NULL,
  `model_name` varchar(50) NOT NULL,
  `model_id` int(20) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `controller_name` varchar(50) NOT NULL,
  `action_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `tbl_seo`
--

INSERT INTO `tbl_seo` (`id`, `title`, `description`, `keywords`, `url`, `model_name`, `model_id`, `module_name`, `controller_name`, `action_name`) VALUES
(1, 'photo_img', '', '', 'photo_img', 'Blog', 2, 'blog', 'view', 'view'),
(2, 'PHOTO POST', '', '', 'loll', 'Blog', 3, 'blog', 'view', 'view'),
(3, 'test', '', '', 'test', 'Blog', 4, 'blog', 'view', 'view'),
(4, 'STICKY POST', '', '', 'sticky-post', 'Blog', 1, 'blog', 'view', 'view'),
(5, 'test2', '', '', 'test2', 'Portfolio', 2, 'portfolio', 'view', 'view'),
(6, 'test1', '', '', 'test1', 'Portfolio', 1, 'portfolio', 'view', 'view'),
(7, 'фото1', '', '', 'foto1', 'Portfolio', 1, 'portfolio', 'view', 'view'),
(8, 'фото2', '', '', 'foto2', 'Portfolio', 2, 'portfolio', 'view', 'view'),
(9, 'фото3', '', '', 'foto3', 'Portfolio', 3, 'portfolio', 'view', 'view'),
(10, 'фото4', '', '', 'foto4', 'Portfolio', 4, 'portfolio', 'view', 'view'),
(11, 'фото5', '', '', 'foto5', 'Portfolio', 5, 'portfolio', 'view', 'view'),
(12, 'Свадебное видео', '', '', 'svadebnoje-video', 'Portfolio', 6, 'portfolio', 'view', 'view'),
(13, 'видео2', '', '', 'video2', 'Portfolio', 7, 'portfolio', 'view', 'view'),
(14, 'видео3', '', '', 'video3', 'Portfolio', 8, 'portfolio', 'view', 'view'),
(15, 'видео4', '', '', 'video4', 'Portfolio', 9, 'portfolio', 'view', 'view'),
(16, 'видео5', '', '', 'video5', 'Portfolio', 10, 'portfolio', 'view', 'view'),
(17, 'видео 1', '', '', 'video-1', 'Portfolio', 11, 'portfolio', 'view', 'view');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `element` enum('input','textarea','editor') NOT NULL,
  `base_key` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `visible` enum('admin','developer') NOT NULL,
  `view_in_grid` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_key` (`base_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `name`, `value`, `element`, `base_key`, `module_id`, `comment`, `visible`, `view_in_grid`) VALUES
(1, 'Site Name', 'Дарагановы', 'input', 'site_name', 1, '', 'admin', 1),
(2, 'Admin email', 'pdaraganov@yahoo.com', 'input', 'admin_email', 1, 'Multiple email addresses must be entered by ; (example: admin@gmail.com; user@gmail.com)', 'admin', 1),
(3, 'Blocking site', '0', 'input', 'block_site', 1, 'Possible values: 0 - The site works 1 - Website Blocked', 'developer', 1),
(4, 'Header for email messages', '', 'editor', 'email_header', 2, 'This header will be added to all email messages which will be sent from the site for users', 'admin', 0),
(5, 'Footer for email messages', '', 'editor', 'email_footer', 2, 'This text will be added to the bottom of all email messages that will be sent to users', 'admin', 0),
(6, 'SEO description', '', 'input', 'default_seo_description', 4, '', 'admin', 0),
(7, 'SEO keywords', '', 'input', 'default_seo_keywords', 4, '', 'admin', 0),
(8, 'Тестовый емаил', 'pdaraganov@yahoo.com', 'input', 'test_email', 2, 'This email is used for sending test messages from the site', 'admin', 1),
(9, 'SMTP FROM EMAIL', 'noreply@email.com', 'input', 'smtp_from_email', 2, '', 'admin', 1),
(10, 'SMTP FROM NAME', 'Дарагановы', 'input', 'smtp_from_name', 2, '', 'admin', 1),
(11, 'Default success message when email sent ', 'Your message sent successfully!', 'input', 'email_send_successfully', 2, '', 'admin', 1),
(12, 'Default error sending message', 'Sending faild...', 'input', 'email_send_failed', 2, '', 'admin', 1),
(13, 'Site email', 'pdaraganov@yahoo.com', 'input', 'site_email', 1, '', 'admin', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `frequency` int(11) NOT NULL,
  `portfolio_type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`, `portfolio_type`) VALUES
(1, 'видео', 6, 0),
(4, 'смешное видео', 2, 0),
(5, 'свадебное видео', 1, 1),
(9, 'корпоративы', 1, 1),
(10, 'юбилеи', 1, 1),
(11, 'утренники', 1, 1),
(12, 'выпускные', 1, 1),
(13, 'выписка из роддома', 1, 1),
(15, 'документальное', 1, 1),
(16, 'детское фото', 1, 0),
(17, 'свадебное фото', 1, 0),
(18, 'love story', 1, 0),
(19, 'портретное фото', 1, 0),
(20, 'slideshow', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` datetime NOT NULL,
  `lastvisit_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`login`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `login`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `status`) VALUES
(1, 'admin', '$2y$13$ZeV4oKfyLRKAXpHyQ7Ht7uY.aiMWUzIpKyfazK9geNVzD2sH9jbZW', 'admin@admin.com', 'ae67495f91228d526e73e9e011771c08', '2015-05-18 00:33:13', '2015-10-09 08:08:00', 1),
(2, 'neverdie', '$2y$13$HDOgDfjPOEl/M1nOnz7xleofdo/sClBLD.uqY0JenbXkwri1NY72.', 'wemadefoxnever@gmail.com', '6d8fc58dc54c960434a7086d95de1cd2', '2015-06-18 12:38:08', '2015-09-30 22:22:29', 1),
(3, 'daraganovy_root', 'dH}P_6unV7lq', 'dino4ka586@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
