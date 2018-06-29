-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 26 2015 г., 11:28
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `coldman`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `description`, `content`, `is_view`, `title`, `keywords`) VALUES
(1, 'Продукты и решения', 'product', '<p>От лица команды разработчиков “Патриот Софт” мы рады приветствовать Вас на борту нашего корабля. Наша команда укомплектована высококлассным техническим и сервисным составом. Уровень наших специалистов позволяет нам на высоте выполнять фигуры высшего пилотажа в слоях облачных технологий, автоматизированных производственных решений, онлайн систем и мобильных приложений.</p>', 1, 'Продукты и решения', 'Продукты и решения');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
