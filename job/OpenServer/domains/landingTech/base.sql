-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 10 2015 г., 17:06
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `base`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_blocks`
--

INSERT INTO `tbl_blocks` (`id`, `name`, `title`, `content`, `position`, `page_position`, `is_view`, `view_title`) VALUES
(2, 'Footer', '', '<div class="l-left">\r\n<p><strong>Broker:&nbsp; Sergey&nbsp;Melnikov</strong><br />\r\nLicense# 01369382<br />\r\n4302 Palm La Mesa CA,&nbsp; 91941</p>\r\n</div>\r\n\r\n<div class="l-right">\r\n<p><span style="font-size:12px"><strong>Real Estate Business Solutions</strong></span><br />\r\n<span style="font-size:12px">Powered by</span><br />\r\n<a href="http://www.365-Solutions.com" target="_blank"><span style="font-size:12px">www.365-Solutions.com</span></a></p>\r\n</div>\r\n\r\n<div class="g-clear_fix">&nbsp;</div>\r\n\r\n<p style="text-align:center">Copyright &copy; 2014 SVMRE All rights reserved</p>\r\n', 1000, 'footer', 1, 0),
(13, 'Front page block', '', '<p>Welcome to SVM Real Estate, San Diego County Commercial Real Estate Broker. Please use our FREE Multi Family listings search engine for quick and easy evaluation of properties for sale in San Diego County. To get more details about a property, and to speak with our agent, please click on property ID and send us an E-Mail with your contact information. We set out to create one of the best commercial real estate MLS and vertical search engines to usher in a new way of scouring commercial real estate online. We believe commercial real estate information should be shared and marketed widely, and through this activity we help to connect industry participants in the most efficient manner possible.<br />\r\n&nbsp;</p>\r\n', 1000, 'front_block', 1, 0);

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
(1, 'Форма обратной связи', 'Офисторг сообщение с сайта - {SUBJECT}', '<p><strong>Иия: </strong>{NAME}</p>\r\n\r\n<p><strong>Тема:</strong> {SUBJECT}</p>\r\n\r\n<p><strong>Email:</strong> {EMAIL}</p>\r\n\r\n<p><strong>Сообщение:</strong> {MESSAGE}</p>\r\n', 'contact_form', '', 1, 1, 1, '', ''),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_front_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_front_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tbl_front_slider`
--

INSERT INTO `tbl_front_slider` (`id`, `name`, `position`, `content`) VALUES
(4, '2', 1020, '\r\n'),
(5, '3', 1030, '\r\n'),
(6, '7', 1000, ''),
(7, '3f', 1000, '<p>h</p>\r\n');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_opinion`
--

INSERT INTO `tbl_opinion` (`id`, `name`, `content`, `is_view`, `is_new`, `create_date`) VALUES
(4, 'Jason Adams', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis metus vitae ligula elementum ut luctus lorem facilisis. Sed non leo nisl, ac euismod nisi. Aenean augue dolor, facilisis id fringilla ut, tempus vitae nibh.', 1, 1, '2015-06-01'),
(5, 'Peter Torkin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis metus vitae ligula elementum ut luctus lorem facilisis. Sed non leo nisl, ac euismod nisi. Aenean augue dolor, facilisis id fringilla ut, tempus vitae nibh.', 1, 2, '2015-06-02'),
(6, 'Sam Woods', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis metus vitae ligula elementum ut luctus lorem facilisis. Sed non leo nisl, ac euismod nisi. Aenean augue dolor, facilisis id fringilla ut, tempus vitae nibh.', 1, 2, '0000-00-00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `name`, `content`, `url`, `title`, `description`, `keywords`) VALUES
(1, 'Front Page', '<p>Front Page</p>\r\n', 'front_page', 'Front Page', '', ''),
(2, 'Contact Us', 'Contact Us', 'contacts', 'Contact Us', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `phone`, `avatar_img`) VALUES
(1, 'admin', 'admin', '', NULL),
(2, 'Die', 'Never', '', '4c6f98f521.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL DEFAULT 'user',
  `operations` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_roles`
--

INSERT INTO `tbl_roles` (`user_id`, `role_name`, `operations`) VALUES
(1, 'admin', ''),
(2, 'developer', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'Site Name', '365-solutions', 'input', 'site_name', 1, '', 'admin', 1),
(2, 'Admin email', 'admin@admin.com', 'input', 'admin_email', 1, 'Multiple email addresses must be entered by ; (example: admin@gmail.com; user@gmail.com)', 'admin', 1),
(3, 'Blocking site', '0', 'input', 'block_site', 1, 'Possible values: 0 - The site works 1 - Website Blocked', 'developer', 1),
(4, 'Header for email messages', '', 'editor', 'email_header', 2, 'This header will be added to all email messages which will be sent from the site for users', 'admin', 0),
(5, 'Footer for email messages', '', 'editor', 'email_footer', 2, 'This text will be added to the bottom of all email messages that will be sent to users', 'admin', 0),
(6, 'SEO description', '', 'input', 'default_seo_description', 4, '', 'admin', 0),
(7, 'SEO keywords', '', 'input', 'default_seo_keywords', 4, '', 'admin', 0),
(8, 'Test email', 'admin@admin.com', 'input', 'test_email', 2, 'This email is used for sending test messages from the site', 'admin', 1),
(9, 'SMTP FROM EMAIL', 'noreply@mail.com', 'input', 'smtp_from_email', 2, '', 'admin', 1),
(10, 'SMTP FROM NAME', '365-solutions', 'input', 'smtp_from_name', 2, '', 'admin', 1),
(11, 'Default success message when email sent ', 'Your message sent successfully!', 'input', 'email_send_successfully', 2, '', 'admin', 1),
(12, 'Default error sending message', 'Sending faild...', 'input', 'email_send_failed', 2, '', 'admin', 1),
(13, 'Site email', 'test@test.com', 'input', 'site_email', 1, '', 'admin', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `login`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `status`) VALUES
(1, 'admin', '$2y$13$ZeV4oKfyLRKAXpHyQ7Ht7uY.aiMWUzIpKyfazK9geNVzD2sH9jbZW', 'admin@admin.com', 'ae67495f91228d526e73e9e011771c08', '2015-05-18 00:33:13', '2015-07-10 16:38:29', 1),
(2, 'neverdie', '$2y$13$HDOgDfjPOEl/M1nOnz7xleofdo/sClBLD.uqY0JenbXkwri1NY72.', 'wemadefoxnever@gmail.com', '6d8fc58dc54c960434a7086d95de1cd2', '2015-06-18 12:38:08', '2015-07-02 09:50:51', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
