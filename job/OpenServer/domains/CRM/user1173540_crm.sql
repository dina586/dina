-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Хост: mysql5.activeby.net
-- Время создания: Окт 28 2015 г., 12:49
-- Версия сервера: 5.5.30
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `user1173540_crm`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_blocks`
--

INSERT INTO `tbl_blocks` (`id`, `name`, `title`, `content`, `position`, `page_position`, `is_view`, `view_title`) VALUES
(1, 'Возможности "Умного дома"', 'Возможности <br/>"Умного дома":', '<p>контроль<br />\r\nкомфорт<br />\r\nбезопасность</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1000, 'capabilities', 1, 1),
(2, 'Шоу-рум в Минске', 'Шоу-рум в Минске', '<p>Приглашаем вас в будние дни с 10:00 до 19:00</p>\r\n\r\n<p>посетить демонстрационный шоу-рум в Минске</p>\r\n', 1000, 'show', 1, 1),
(3, 'Остались вопросы?', 'Остались вопросы?', '<p>Оставьте заявку,</p>\r\n\r\n<p>и мы перезвоним</p>\r\n\r\n<p>в ближайшее время!</p>\r\n', 1000, 'question', 1, 1),
(4, 'Контакты', 'Контакты', '<p>Республика Беларусь</p>\r\n\r\n<p>г. Минск</p>\r\n\r\n<p>ул. Сурганова 88, оф. 6H</p>\r\n\r\n<p>+3 75 (29) 101 66 66</p>\r\n\r\n<p><a href="mailto:info.kinex@gmail.com">info@knx.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="/upload/files/kinex_logo.png" style="width:300px" /></p>\r\n', 1000, 'contacts', 1, 1),
(5, 'Подвал сайта', '', '<div style="float: left;">\r\n<p>г. Минск</p>\r\n\r\n<p>ул. Сурганова 88, оф. 6H</p>\r\n\r\n<p>+3 75 (29) 101 66 66</p>\r\n\r\n<p><a href="mailto:info.kinex@gmail.com">info@knx.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div style="float:right">\r\n<p>разработка сайта</p>\r\n<a href="http://dvn.by" target="_blank">dvn.by</a></div>\r\n', 1000, 'footer', 1, 0),
(6, 'Шоу-рум Изображения', '', '<p><img alt="" src="/images/show_img1.jpg" style="width:100%" /> <img alt="" src="/images/show_img2.jpg" style="width:100%" /> <img alt="" src="/images/show_img3.jpg" style="width:100%" /></p>\r\n', 1000, 'show_img', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `work` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `name`, `work`, `content`, `position`, `is_view`) VALUES
(1, 'Илья Митько, солист группы «Леприконсы», объект  «Зеленый сад»:', '', 'Уже почти год использую систему Умный дом и привык к ней очень быстро. Когда нужно было немного переделать световые сценарии в гостиной – сотрудники все быстро изменили, заодно откорректировали настройки климата в спальне. Уходя из дома или ложась спать, достаточно нажать одну кнопку, тем самым выключив все лишнее и не нужно бегать по всему дому и смотреть не забыл ли что-то! Это очень удобно!', 1, 1),
(2, 'Гуща', '', 'Эту компанию мне порекомендовали знакомые. Очень понравилась четкость работы, грамотность и профессионализм сотрудников. Все поставленные перед ними задачи были четко сформулированы в техническом задании в начале сотрудничества, что позволило в конце получить нам дом с очень удобной и  действительно "умной" системой по управлению необходимым оборудованием.', 3, 1),
(3, 'Офис компании 7788', '', 'Как руководитель компании, от лица своих сотрудников хочу выразить благодарность компании Gira и ее персоналу за качественную установку системы "Умный офис". Очень порадовали сроки установки - все было сделано качественно и оперативно. В результате мы получили управление климатом, светом, а также контроль доступа, что позволило сделать условия для труда нашего коллектива еще более комфортными.', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_design`
--

CREATE TABLE IF NOT EXISTS `tbl_design` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `tbl_design`
--

INSERT INTO `tbl_design` (`id`, `name`, `catalog_id`, `position`) VALUES
(3, 'Управление внутренним и наружным освещением', 0, 1),
(4, 'Программирование световых сцен', 0, 2),
(5, 'Автоматическое управление освещением в зависимости от времени суток', 0, 3),
(6, 'Режим день/ночь', 0, 4),
(7, 'Дежурное освещение и т.д.', 0, 5),
(8, 'Поддержание и регулирование заданной температуры по помещениям', 1, 1),
(9, 'Управление вентиляцией и кондиционированием', 1, 2),
(10, 'Управление отоплением', 1, 3),
(11, 'Управление вытяжной вентиляцией (кухня, санузлы, ванная)', 1, 4),
(12, 'Сбор метеоданных и отображение их на устройствах', 4, 1),
(13, 'Управление автоматизированными система дома в зависимости от метеоданных', 4, 2),
(14, 'Сбор показаний счетчиков воды, газа, электроэнергии', 4, 3),
(15, 'Сценарное управление жалюзи, рольставнями, воротами, шторами, окнами т.п.', 2, 1),
(16, 'Контроль и предотвращение протечек воды', 6, 1),
(17, 'Контроль параметров электросети', 6, 2),
(18, 'Информирование об аварийной ситуации по SMS или через Интернет', 6, 3),
(19, 'Контроль доступа и общение с посетителем из любой точки дома', 3, 1),
(20, 'Контроль и видеонаблюдение за домом из любой точки мира в любое время', 3, 2),
(21, 'Управление домашним кинотеатром', 7, 1),
(22, 'Возможность выбора аудио источника в любом помещении', 7, 2),
(23, 'Возможность программирования включения/выключения техники в доме', 5, 1),
(24, 'Контроль режима работы духовки, плиты, стиральной машины', 5, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_email_message`
--

INSERT INTO `tbl_email_message` (`id`, `name`, `subject`, `message`, `email_key`, `comment`, `email_type`, `header`, `footer`, `success_message`, `failed_message`) VALUES
(2, 'Confirm registration', 'Confirm registration', '<p>Your registration has been successfully completed!</p>\r\n\r\n<p><strong>You login:</strong> {LOGIN}</p>\r\n\r\n<p><strong>Your password:</strong> {PASSWORD}</p>\r\n\r\n<p>To confirm an email address, please click here.</p>\r\n\r\n<p>{ACTIVATION_URL}</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'registration', '', 2, 1, 1, 'Thank you for your registration. Please check your email.', 'Upon registration error occurred. Please re-register or contact us.'),
(3, 'Password Recovery', 'Request for password recovery', '<p>To reset the password, use the link:<br />\r\n{PASSWORD_RECOVERY}</p>\r\n', 'password_recovery', '', 2, 1, 1, 'Please check your email. An instructions was sent to your email address.', ''),
(5, 'Заказ обратного звонка с сайта', 'GIRA - Заявка с сайта', '<p>Имя- {NAME}</p>\r\n\r\n<p>Телефон- {PHONE}</p>\r\n', 'get_a_call', '', 1, 1, 1, 'Спасибо! Мы перезвоним Вам в течение 15 минут!', 'Ошибка при отправке запроса... Пожалуйста, попробуйте еще раз.');

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
(9, 'Phone', 'PHONE', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_email_tag_connect`
--

CREATE TABLE IF NOT EXISTS `tbl_email_tag_connect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `tbl_email_tag_connect`
--

INSERT INTO `tbl_email_tag_connect` (`id`, `email_id`, `tag_id`) VALUES
(8, 2, 5),
(9, 2, 6),
(10, 2, 7),
(11, 3, 8),
(16, 5, 1),
(17, 5, 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `tbl_file_manager`
--

INSERT INTO `tbl_file_manager` (`id`, `file`, `file_type`, `folder`, `description`, `position`, `cover`, `date`, `model_id`, `model_name`) VALUES
(1, '3a0502ad9c.jpg', 'image', 'aaa335b783', '', 1, 1, '2015-07-22 19:42:35', -1, 'News'),
(11, 'd3ae88a754.jpg', 'image', 'c1cb57d116', '', 0, 0, '2015-10-19 05:14:28', 2, 'Objects'),
(12, '16f5eaf83a.jpg', 'image', 'c1cb57d116', '', 1, 0, '2015-10-19 05:14:29', 2, 'Objects'),
(13, '4691b0be03.jpg', 'image', 'c1cb57d116', '', 3, 0, '2015-10-19 05:14:30', 2, 'Objects'),
(14, '8a02c3ef3e.jpg', 'image', 'c1cb57d116', '', 2, 0, '2015-10-19 05:14:31', 2, 'Objects'),
(15, '072a963563.jpg', 'image', 'c1cb57d116', '', 4, 1, '2015-10-19 05:14:32', 2, 'Objects'),
(16, '663650a240.jpg', 'image', 'c1cb57d116', '', 5, 0, '2015-10-19 05:14:32', 2, 'Objects'),
(17, '21edbc259c.jpg', 'image', 'e2e9c01483', '', 1, 0, '2015-10-20 12:29:36', 1, 'UploadData'),
(18, 'ecf73e24e2.jpg', 'image', 'e2e9c01483', '', 2, 0, '2015-10-20 12:29:38', 1, 'UploadData'),
(19, '0d103b0e92.jpg', 'image', 'e2e9c01483', '', 3, 0, '2015-10-20 12:29:38', 1, 'UploadData'),
(20, '0d994b9849.jpg', 'image', 'e2e9c01483', '', 4, 0, '2015-10-20 12:29:39', 1, 'UploadData'),
(21, 'a4b815e9de.jpg', 'image', 'e2e9c01483', '', 5, 0, '2015-10-20 12:29:40', 1, 'UploadData'),
(22, '30c0d76c1f.jpg', 'image', 'e2e9c01483', '', 6, 0, '2015-10-20 12:29:41', 1, 'UploadData'),
(23, 'b9da386ea2.jpg', 'image', 'e2e9c01483', '', 7, 0, '2015-10-20 12:29:42', 1, 'UploadData'),
(24, '5eb480d8e6.jpg', 'image', 'e2e9c01483', '', 8, 0, '2015-10-20 12:29:43', 1, 'UploadData'),
(25, '82d4106890.jpg', 'image', 'e2e9c01483', '', 9, 0, '2015-10-20 12:29:44', 1, 'UploadData'),
(26, '60c3a67e92.jpg', 'image', 'e2e9c01483', '', 10, 0, '2015-10-20 12:29:45', 1, 'UploadData'),
(27, '37950e4655.jpg', 'image', 'e2e9c01483', '', 11, 0, '2015-10-20 12:29:46', 1, 'UploadData'),
(28, '37df163b4d.jpg', 'image', 'e2e9c01483', '', 12, 0, '2015-10-20 12:29:46', 1, 'UploadData'),
(29, 'da7ebd202f.jpg', 'image', '455e8270ae', '', 1, 0, '2015-10-20 12:36:12', 2, 'UploadData'),
(30, 'cd1342341a.jpg', 'image', '455e8270ae', '', 2, 0, '2015-10-20 12:36:13', 2, 'UploadData'),
(31, 'b4eecf187f.jpg', 'image', '455e8270ae', '', 3, 0, '2015-10-20 12:36:14', 2, 'UploadData'),
(32, 'b381a643e3.jpg', 'image', '455e8270ae', '', 4, 0, '2015-10-20 12:36:14', 2, 'UploadData'),
(33, '8a01568b06.jpg', 'image', '455e8270ae', '', 5, 0, '2015-10-20 12:36:15', 2, 'UploadData'),
(34, '987c796258.jpg', 'image', '455e8270ae', '', 6, 0, '2015-10-20 12:36:16', 2, 'UploadData'),
(35, 'ac5a19c423.jpg', 'image', '455e8270ae', '', 7, 0, '2015-10-20 12:36:17', 2, 'UploadData'),
(36, 'a206b07a56.jpg', 'image', '455e8270ae', '', 8, 0, '2015-10-20 12:36:18', 2, 'UploadData'),
(37, '57cfd7e7d1.jpg', 'image', '455e8270ae', '', 9, 0, '2015-10-20 12:36:23', 2, 'UploadData');

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
-- Структура таблицы `tbl_objects`
--

CREATE TABLE IF NOT EXISTS `tbl_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tbl_objects`
--

INSERT INTO `tbl_objects` (`id`, `name`, `content`, `position`) VALUES
(2, 'Объект по ул. Жасминовая', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система управление энергоснабжением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям (теплые полы, радиаторы отопления);</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления шторами, жалюзи, рольставнями;</li>\r\n	<li>Система контроля протечек с аварийным перекрытием коммуникаций.;</li>\r\n</ul>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление через встраиваемые панели (Touch Screen Client 19 и Gira Control Client 9&rdquo;).</li>\r\n	<li>управление с многофункционального выключателя (сценарного выключателя);</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем. При подключении видеокамер и наличии доступа в сеть &laquo;интернет&raquo;&nbsp; осуществляется&nbsp; видеонаблюдение за происходящими событиями в реальном времени.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 1),
(3, 'Объект в г. Барановичи', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям;</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления шторами, жалюзи, рольставнями;</li>\r\n	<li>Система контроля протечек;</li>\r\n	<li>оповещение о происходящих событиях голосом по телефону, SMS по сотовой связи, по &laquo;Интернет&raquo;, через динамики MULTIROOM.</li>\r\n	<li>удаленный контроль дома по мобильным устройствам</li>\r\n</ul>\r\n\r\n<p>- Интегрированы IP-камеры;</p>\r\n\r\n<p>- Интегрирована в систему автоматизации домофония (Gira);</p>\r\n\r\n<p>- автоматизация уличного освещения</p>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление через встраиваемые панели &ndash; Gira Control 19&rdquo;.</li>\r\n	<li>управление с многофункционального выключателя;</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 2),
(4, 'Объект Зеленый сад (дом) 305 кв.м.', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям;</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления рольставнями;</li>\r\n	<li>Система управления электроприводами</li>\r\n	<li>Автоматизация уличного освещения</li>\r\n</ul>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление с многофункционального выключателя;</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем. При подключении видеокамер и наличии доступа в сеть &laquo;интернет&raquo;&nbsp; возможно&nbsp; видеонаблюдение за происходящими событиями в реальном времени.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 3),
(5, 'Объект офис 7788 190 кв.м.', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям;</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления рольставнями;</li>\r\n	<li>Система управления электроприводами</li>\r\n	<li>Автоматизация уличного освещения</li>\r\n</ul>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление с многофункционального выключателя;</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем. При подключении видеокамер и наличии доступа в сеть &laquo;интернет&raquo;&nbsp; возможно&nbsp; видеонаблюдение за происходящими событиями в реальном времени.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 4),
(6, 'Объект по улице Жасминова, 61 (дом) 340 кв.м.', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система управление энергоснабжением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям (теплые полы, радиаторы отопления);</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления вытяжной вентиляцией (санузлы, кухня, ванная)</li>\r\n	<li>Система управления шторами, жалюзи, рольставнями;</li>\r\n	<li>Система контроля протечек;</li>\r\n	<li>Система сбора метеоинформации</li>\r\n	<li>Встроенная в систему автоматизации домофония (Gira);</li>\r\n	<li>Встроенный GSM-модуль;</li>\r\n	<li>Учет потребления электроэнергии;</li>\r\n	<li>автоматизация уличного освещения</li>\r\n</ul>\r\n\r\n<h2>Энергосберегающие функции</h2>\r\n\r\n<ul>\r\n	<li>возможность постановки системы на охрану при уходе из дома вместе с выключением освещения, бытовых приборов и переводом всех систем в режим энергосбережения;</li>\r\n</ul>\r\n\r\n<h2>Функции оповещения и управления</h2>\r\n\r\n<ul>\r\n	<li>оповещение о происходящих событиях голосом по телефону, SMS по сотовой связи, по &laquo;Интернет&raquo;, через динамики MULTIROOM.</li>\r\n	<li>удаленный контроль дома по мобильным устройствам (планшет, телефон)</li>\r\n</ul>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление через встраиваемые панели &ndash; Gira Control 19&rdquo;.</li>\r\n	<li>управление с многофункционального выключателя;</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 4),
(7, 'Объект по улице Стариновская (квартира) 300 кв.м.', '<ul>\r\n	<li>Система управления освещением;</li>\r\n	<li>Система&nbsp; климат-контроля по помещениям;</li>\r\n	<li>Система управления отоплением;</li>\r\n	<li>Система управления вентиляцией и кондиционированием;</li>\r\n	<li>Система управления шторами, жалюзи, рольставнями;</li>\r\n	<li>Система контроля протечек;</li>\r\n	<li>Система сбора метеоинформации</li>\r\n	<li>Функции оповещения и управления (оповещение о происходящих событиях голосом по телефону, SMS по сотовой связи, по &laquo;Интернет&raquo;)</li>\r\n</ul>\r\n\r\n<h2>Система управления и отображения информации</h2>\r\n\r\n<ul>\r\n	<li>управление с многофункционального выключателя;</li>\r\n	<li>интернет-шлюз - позволяет просматривать через защищенный доступ с любого компьютера, подключенного к сети &laquo;ИНТЕРНЕТ&raquo;, состояние дома, работу различных систем.</li>\r\n	<li>управление при помощи мобильного устройства (смартфон, планшет iPad) &ndash; управление производится при помощи графического интерфейса в отдельном приложении.</li>\r\n</ul>\r\n', 6);

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
(1, 'Инновации для вашего комфорта дома и в офисе', '<p><strong><span style="font-size:38px">Установка и обслуживание систем </span></strong></p>\r\n\r\n<p><strong><span style="font-size:38px">&quot;Умный дом&quot; в Беларуси</span></strong></p>\r\n\r\n<p>от официального представителя немецкой компании <img src="/images/gira_logo.png" style="height:18px; width:auto" /></p>\r\n', 'front_page', 'Инновации для вашего комфорта дома и в офисе', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(100) NOT NULL,
  `avatar_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `firstname`, `lastname`, `phone`, `avatar_img`) VALUES
(1, 'admin', 'admin', '', NULL),
(2, 'Never', 'Die', '', 'c313e3beb7.jpg'),
(3, 'demo', 'demo', '', NULL);

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
(3, 'user', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `name`, `value`, `element`, `base_key`, `module_id`, `comment`, `visible`, `view_in_grid`) VALUES
(1, 'Имя сайта', 'GIRA', 'input', 'site_name', 1, '', 'admin', 1),
(2, 'Admin email', 'info@knx.by; info.kinex@gmail.com', 'input', 'admin_email', 1, 'Multiple email addresses must be entered by ; (example: admin@gmail.com; user@gmail.com)', 'admin', 1),
(3, 'Blocking site', '0', 'input', 'block_site', 1, 'Possible values: 0 - The site works 1 - Website Blocked', 'developer', 1),
(4, 'Header for email messages', '', 'editor', 'email_header', 2, 'This header will be added to all email messages which will be sent from the site for users', 'developer', 0),
(5, 'Footer for email messages', '', 'editor', 'email_footer', 2, 'This text will be added to the bottom of all email messages that will be sent to users', 'developer', 0),
(6, 'SEO description', '', 'input', 'default_seo_description', 4, '', 'admin', 0),
(7, 'SEO keywords', '', 'input', 'default_seo_keywords', 4, '', 'admin', 0),
(8, 'Тестовый емаил', 'info@knx.by; info.kinex@gmail.com', 'input', 'test_email', 2, 'This email is used for sending test messages from the site', 'admin', 1),
(9, 'SMTP FROM EMAIL', 'noreply@email.com', 'input', 'smtp_from_email', 2, '', 'developer', 1),
(10, 'SMTP FROM NAME', 'GIRA', 'input', 'smtp_from_name', 2, '', 'developer', 1),
(11, 'Default success message when email sent ', 'Your message sent successfully!', 'input', 'email_send_successfully', 2, '', 'developer', 1),
(12, 'Default error sending message', 'Sending faild...', 'input', 'email_send_failed', 2, '', 'developer', 1),
(13, 'Site email', 'test@test.com', 'input', 'site_email', 1, '', 'developer', 1),
(14, 'Телефон в шапке', '+375 (29) 101 66 66', 'input', 'header_phone', 1, '', 'admin', 1),
(15, 'Адрес в шапке', '  г. Минск, ул. Сурганова, 88 оф. 6H', 'input', 'header_address', 1, '', 'admin', 1),
(16, 'Блок 1 - Число', '110', 'input', 'lider1_number', 6, '', 'admin', 1),
(17, 'Блок 1 - Текс', 'лет<br>немецкому <br>бренду <b>GIRA</b>', 'input', 'lider1_letter', 6, '', 'admin', 1),
(18, 'Блок 2 - Число', '2 500', 'input', 'lider2_number', 6, '', 'admin', 1),
(19, 'Блок 2 - Текст', 'базовых<br>элементов<br>управления<br>', 'input', 'lider2_text', 6, '', 'admin', 1),
(20, 'Блок 3 - Число', '39', 'input', 'lider3_number', 6, '', 'admin', 1),
(21, 'Блок 3 - Текст', 'стран по всему<br>миру с нашими<br>представительствами<br>', 'input', 'lider3_text', 6, '', 'admin', 1),
(22, 'Блок 4 - Число', '7', 'input', 'lider4_number', 6, '', 'admin', 1),
(23, 'Блок 4 - Текст', 'лет на рынке <br>Беларусии', 'input', 'lider4_text', 6, '', 'admin', 1),
(24, 'Блок 5 - Число', '  24', 'input', 'lider5_number', 6, '', 'admin', 1),
(25, 'Блок 5 - Текст', 'часа на <br>предварительную<br>смету', 'input', 'lider5_text', 6, '', 'admin', 1),
(26, 'Блок 6 - Число', '36', 'input', 'lider6_number', 6, '', 'admin', 1),
(27, 'Блок 6 - Текст', 'месяцев гарантии<br>на оборудование и<br>установку', 'input', 'lider6_text', 6, '', 'admin', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `name`, `position`, `img_name`) VALUES
(1, 'Трайпл', 1, '1.png'),
(2, 'БЧ', 2, '2.png'),
(3, 'united company', 3, '3.png'),
(4, 'Fusion House', 4, '4.png'),
(5, 'Экспедиция', 5, '5.png'),
(6, 'Velcome', 5, '6.png'),
(7, 'Белгазпромбанк', 6, '7.png'),
(8, 'Wargaming', 7, '8.png'),
(9, 'Ждановичи', 7, '9.png');

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
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `login`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `status`) VALUES
(1, 'admin', '$2y$13$ZeV4oKfyLRKAXpHyQ7Ht7uY.aiMWUzIpKyfazK9geNVzD2sH9jbZW', 'admin@admin.com', 'ae67495f91228d526e73e9e011771c08', '1970-01-01 03:00:00', '2015-10-28 12:33:25', 1),
(2, 'neverdie', '$2y$13$HDOgDfjPOEl/M1nOnz7xleofdo/sClBLD.uqY0JenbXkwri1NY72.', 'wemadefoxnever@gmail.com', '6d8fc58dc54c960434a7086d95de1cd2', '1970-01-01 03:00:00', '2015-10-27 08:53:49', 1),
(3, 'demo', '$2y$13$0sNqMiJLjQong/DtzlycNuUFvAeODJur6GzpJa13D5O6fXqzm8Quy', 'demo@demo.com', '13918ada7d0531981b053fafc5aa23a8', '2015-07-09 22:16:00', '2015-07-15 20:56:30', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
