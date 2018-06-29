-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 04 2015 г., 16:50
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dina_farmstay`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `tbl_blocks`
--

INSERT INTO `tbl_blocks` (`id`, `name`, `title`, `content`, `position`, `page_position`, `is_view`, `view_title`) VALUES
(1, 'Контакты в шапке', '', '<div>\n					<p>\n						8 (017) <span class="size">234 55 67</span> <br/>\n						телефон / факс\n					</p>\n				</div>\n				<div>\n					<p class="r-phone">\n						<span class="color">МТС:</span> 8 (029) <span class="size">764 65 99</span><br/>\n						городской телефон\n					</p>\n				</div>\n				<div>\n					<p>\n						<span class="color">velcom:</span> 8 (029) <span class="size">874 76 54</span><br/>\n						<span class="color r-mts">МТС:</span> 8 (029) <span class="size">764 65 99</span>\n					</p>\n				</div>', 1000, 'header', 1, 0),
(2, 'Подвал сайта', '', '<div class="g-footer_left">\n				<div class="b-footer_contacts l-left">\n					<p>Приемная:    +375(17) 344-20-47</p>      \n					<p>Бухгалтерия: +375(17)299-69-20</p>\n					<p>Email: <a href="mailto:avtokomfort@mail.ru">avtokomfort@mail.ru</a></p>\n				</div>\n				<div class="b-footer_social l-right">\n					<a href="https://www.facebook.com/profile.php?id=100009142730188" class="social-f" target = "_blank">f</a>\n					<a href="https://vk.com/id295337895" class="social-v" target = "_blank">в</a>\n				</div>\n			</div>\n			<div class="g-footer_right">\n				<p>создание сайтов</p>\n				<p><a href="http://www.dvn.by">www.dvn.by</a></p>\n			</div>', 1000, 'footer', 1, 0),
(33, 'Корзина', '', '<p>Если вы не хотите тратить время на подбор товаров в интернет-магазине, можете отправить нам экспресс-заявку. В этом случае вы не получите счет моментально, как при обычном оформлении заказа, зато переложите все заботы на нашего оператора. Он подберет товары по вашему списку и пришлет счет на согласование.</p>\r\n\r\n<p>Впишите в таблицу перечень товаров, укажите необходимое количество и, по возможности, код товара. Если нет времени и на это, можете всю свою заявку написать в поле &laquo;примечание&raquo; простыми словами.</p>\r\n', 1000, 'cart', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_catalog`
--

CREATE TABLE IF NOT EXISTS `tbl_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `is_view` int(1) NOT NULL,
  `letter` varchar(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`id`, `name`, `content`, `parent_id`, `position`, `is_view`, `letter`, `url`, `seo_title`, `seo_description`, `seo_keywords`) VALUES
(1, 'Бумага, тетради и другая бумажная продукция', '<p>Бумага &laquo;SvetoCoһpy&raquo;-&nbsp;офисная &nbsp;бумага массой 80г/м2. &nbsp;Белизна 146% CIE.&nbsp;&nbsp;</p>\r\n\r\n<p>Бумага&nbsp;SvetoCopy&nbsp;формата A4 относится к категории качества C. Самая популярная офисная бумага благодаря своим отличным техническим характеристикам. Отличное качество печати на любой копировально-множительной технике и печатающих устройствах. Отсутствие пылевого отделения, высокая жесткость, идеальная геометрия листа обеспечат бесперебойную работу всего офисного оборудования. Бумага&nbsp;SvetoCopy&nbsp;прошла тестирование в лабораториях Финляндии, где получила высокую оценку.</p>\r\n\r\n<p>Срок архивного хранения более 200 лет.&nbsp;</p>\r\n', -1, 1, 1, 'б', 'bumaga', 'Бумага, тетради и другая бумажная продукция', '', ''),
(2, 'Канцелярские и школьные принадлежности', '', -1, 1000, 1, 'к', 'kancelyarskije-i-shkolynyje-prinadlezhnosti', 'Канцелярские и школьные принадлежности', '', ''),
(3, 'Пишущие и художественные принадлежности', '', -1, 1000, 1, 'п', 'pishushhije-i-khudozhestvennyje-prinadlezhnosti', 'Пишущие и художественные принадлежности', '', ''),
(4, 'Файлы, папки, портфели, настольные системы хранения', '', -1, 1000, 1, 'ф', 'fajly-papki-portfeli-nastolynyje-sistemy-khranenija', 'Файлы, папки, портфели, настольные системы хранения', '', ''),
(5, 'Демонстрационное, торговое, банковское оборудование', '', -1, 1000, 1, 'д', 'demonstracionnoje-torgovoje-bankovskoje-oborudovanije', 'Демонстрационное, торговое, банковское оборудование', '', ''),
(6, 'Хозтовары, посуда, продукты питания и бытовая техника', '', -1, 1000, 1, 'х', 'hoztovary-posuda-produkty-pitanija-i-bytovaja-tehnika', 'Хозтовары, посуда, продукты питания и бытовая техника', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_content`
--

CREATE TABLE IF NOT EXISTS `tbl_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `name`, `content`, `url`, `seo_title`, `seo_description`, `seo_keywords`) VALUES
(1, 'Добро пожаловать в наш интернет-магазин', '<p>День рождения нашей фирмы &mdash; 18 мая 1994 года. Тогда мы носили другое имя и, фактически, стояли у истоков формирования рынка офисных товаров в нашей стране. Мы с гордостью можем назвать себя одним из наиболее опытных его операторов.</p>\r\n\r\n<p>Уже в те далекие годы наша компания предложила своим клиентам самый большой и полный комплекс товаров и услуг деловой сферы. При этом фирма всегда старалась быть образцом качества обслуживания и полноты сервиса.</p>\r\n\r\n<p>Теперь &laquo;Автокомфорт&raquo; заслуженно находится в числе лидеров среди предприятий своей отрасли. Мы не только снабжаем офисы по всей Беларуси канцелярскими товарами и бумагой, оргтехникой и сейфами, печатями и штампами, офисной мебелью и хозтоварами. Наша фирма также поставляет все это, а также школьные принадлежности, в магазины нашей страны. Производители наших товаров расположены по всему миру.</p>\r\n\r\n<p>&laquo;Автокомфорт&raquo; за эти годы серьезно выросло: более 100 сотрудников, большой парк доставочного транспорта, собственное офисное здание, логистический центр, несколько складов, самые передовые учетные и управленческие технологии.</p>\r\n', 'dobro-pozhalovaty-v-nash-internet-magazin', 'Добро пожаловать в наш интернет-магазин', '', ''),
(2, 'Способы доставки и получения заказов', '<p>Условия работы нашей компании будут удобны для каждого клиента и мы надеемся,что они подтолкнут Вас на дальнейшее плодотворное сотрудничество.<br />\r\n<strong>&nbsp;Мы можем предложить Вам:</strong><br />\r\n&nbsp; &nbsp; -индивидуальный подход к каждому клиенту и его запросу,<br />\r\n&nbsp; &nbsp; -качественное,вежливое и терпеливое обслуживание,<br />\r\n&nbsp; &nbsp; -удобную для Вас систему заказов (через сайт,по телефону/факсу),<br />\r\n&nbsp; &nbsp; -возможность приобретения товаров под заказ,<br />\r\n&nbsp; &nbsp; -оперативную поставку складской продукции,<br />\r\n&nbsp; &nbsp; -срочную доставку по Минску,<br />\r\n&nbsp; &nbsp; -персонального менеджера.<br />\r\n<br />\r\nПродажа товаров осуществляется как физическим лицам за наличный расчет,так и юридическим лицам по безналичному расчету.<br />\r\nМы работаем с физическими и юридическими лицами за наличный и безналичный расчет на условиях предоплаты,частичной предоплаты,оплаты по факту поставки и с отсрочкой платежа,что позволяет Вам выбрать наилучший вариант работы с нами.<br />\r\n<br />\r\nВсем предприятиям и организациям,финансируемы<br />\r\nм из бюджета,мы предоставляем возможность отсрочки платежа.<br />\r\n<br />\r\n<strong>Заказ товара Вы сможете сделать удобным для Вас способом:</strong><br />\r\n&nbsp; &nbsp;- посредством on-line-заявки,<br />\r\n&nbsp; &nbsp;- телефонной связи,<br />\r\n&nbsp; &nbsp;- электронной почты,<br />\r\n&nbsp; &nbsp;- заявкой по факсу.<br />\r\n<strong>Порядок осуществления заказа:</strong><br />\r\n1) после получения Вашей заявки наш менеджер свяжется с Вами для уточнения и корректировки заказа,<br />\r\n2) затем выставит счет в любой удобной для Вас форме( по факсу, по электронной почте),<br />\r\n3) после поступления денег &nbsp;на наш р/ счет менеджер согласует &nbsp;с Вами время и место доставки товара,<br />\r\n4) затем товар отгружается со склада и следует по указанному адресу,<br />\r\n5) при получении товара Вы получите следующие документы: договор поставки,товарную или товарно- транспортную накладную.<br />\r\n<br />\r\n<strong>ВНИМАНИЕ!</strong> Счет-фактуру нужно оплатить в течение 3- х банковских дней.Если она не будет оплачена вовремя,то заказ снимается.<br />\r\nНаличие товара по выставленному счету гарантируется только в течение 3-х банковских дней.<br />\r\n<br />\r\n<strong>Условия и сроки доставки товара:</strong><br />\r\n<br />\r\n<strong>Бесплатная доставка по Минску:</strong><br />\r\n- для корпоративных клиентов- сумма заказа от 600000 рублей с учетом НДС,<br />\r\n-для оптовых клиентов-сумма заказа от 3000000 рублей с учетом НДС.<br />\r\n<br />\r\nПри сумме заказа менее 600000 рублей с учетом НДС стоимость доставки 100000 рублей.<br />\r\n<br />\r\nЗаказы за пределами г.Минска согласовывайте с менеджерами по телефону.</p>\r\n\r\n<p>Доставка товара осуществляется с момента получения оплаты либо поступления заказа с отсрочкой платежа - в течение 1-2 дней по Минску , по регионам - 3-5 дней.</p>\r\n\r\n<p><strong>Срочная доставка!</strong><br />\r\nМы осуществляем срочную доставку по Минску в течение 1-2 часов при условии:<br />\r\n&nbsp; &nbsp;-предоплаты при ее подтверждении,<br />\r\n&nbsp; &nbsp;-при заказе на сумму более 2000000 рублей и наличной оплате в момент доставки.<br />\r\n<br />\r\n<strong>Товары под заказ.</strong><br />\r\nЕсли Вам необходим товар,которого нет в наличии,мы можем осуществить поставку такого товара.<br />\r\n<br />\r\nНаличие и срок поставки такого товара оговаривается дополнительно с менеджером &nbsp;или On line-консультантом.<br />\r\nОплата заказного товара осуществляется путем внесения 50-проц.предоплаты,так как товар заказывается специально под Вас. Для этого необходимо оплатить его любым возможным способом оплаты,предварительно согласовав оплату с менеджером.<br />\r\nПри поступлении товара на склад с Вами свяжется менеджер для согласования даты и времени доставки товара.<br />\r\n<br />\r\n<strong>Время работы интернет-магазина.</strong><br />\r\n<br />\r\nOnline заказы принимаются &nbsp;КРУГЛОСУТОЧНО.<br />\r\nОбработка заказов - с 9,00 до 20,00 (понедельник - пятница)<br />\r\nСклад - с 9,00 до 17,00 (понедельник -пятница)<br />\r\nВыходные дни - суббота,воскресенье.<br />\r\n<br />\r\nЗаказы,поступившие до 15.00,обрабатываются в этот же день; заказы,поступившие после 15.00 -на следующий день.</p>\r\n', 'sposoby-dostavki-i-poluchenija-zakazov', 'Способы доставки и получения заказов', 'Бесплатная доставка. Если сумма вашего заказа превышает 600 000 рублей, мы бесплатно доставим его на рабочее место в Минске и любом другом городе Беларуси. Платная доставка. Если сумма заказа составляет менее 600 000 рублей, доставка обойдется вам в 60 000 рублей. Самостоятельное получение. Вы можете самостоятельно забрать свой заказ в одном из наших пунктов получения заказов: Минск, ул. Игнатенко, 2 (карта) Время работы: по будням с 9:00 до 18:00 Минск, ст. метро «Октябрьская», ТЦ «Купаловский», пав. № 78 (схема) Время работы: с 12:00 до 19:00, выходной понедельник Минск, ст. метро «Малиновка», пр. Дзержинского, 131 (карта) Время работы: по будням с 10:00 до 19:00, в выходные с 10:00 до 16:00. Брест, ул. Советская, 46 (схема) Время работы: по будням с 9:00 до 17:30 Барановичи, ул. Жукова, 2/2 (карта) Время работы: по будням с 9:00 до 17:00 Получение заказов в указанных п', ''),
(3, 'Контакты', '<h5>Прием заказов и консультация по телефонам</h5>\r\n\r\n<ul>\r\n	<li>8 (017) 201-41-41 Многоканальный телефон</li>\r\n	<li>8 (801) 201-41-41 Бесплатный по Беларуси (с городского телефона)</li>\r\n	<li>8 (029) 610-41-41 velcom</li>\r\n	<li>8 (029) 710-41-41 МТС</li>\r\n	<li>8 (0163) 58-00-00 Многоканальный телефон</li>\r\n	<li>8 (017) 551-20-14 Факс для платежек</li>\r\n</ul>\r\n\r\n<h5>Время работы операторов</h5>\r\n\r\n<p>Консультанты и операторы работают в будние дни с 8:30 до 17:00. Заказы в интернет-магазине принимаются круглосуточно без выходных дней с выпиской документов на оплату в автоматическом режиме.</p>\r\n\r\n<h5>Карта проезда</h5>\r\n', 'contact-us', 'Контакты', '', ''),
(4, 'О компании', '<p><strong>Добро пожаловать на наш сайт!</strong></p>\r\n\r\n<p>Наша компания предложит вам&nbsp;канцелярские товары&nbsp;ведущих производителей по ценам, которые обрадуют любого руководителя, а их высокое качество окажет позитивное влияние на всю деловую атмосферу вашего офиса.</p>\r\n\r\n<p>Собранность и организованность сотрудников не в последней мере зависит от того, какими&nbsp;канцтоварами&nbsp;они обеспечены. Ведь сберечь время и оптимизировать работу помогут даже такие мелочи, как небольших размеров блокнот, ежедневник и даже ручка.</p>\r\n\r\n<p>Мы предлагаем Вам самый широкий ассортимент товаров для офиса, среди которых неизменным спросом пользуется офисная бумага всех видов, офисные принадлежности,расходные материалы, дыроколы, ручки, скоросшиватели, папки и другая необходимая&nbsp;канцелярия.</p>\r\n\r\n<p>Зачем ломать голову, когда близится день рождения вашего начальника, сотрудника или же просто нужного заказчика? Хорошие,престижные&nbsp;канцелярские товары&nbsp;&nbsp;всегда были в цене. И в этом случае вы сможете найти у нас и презентабельную папку для бумаг из натуральной кожи, и респектабельные портфели и кейсы, стильные визитницы и многое другое из атрибутов преуспевающего делового человека.</p>\r\n\r\n<p>На складе нашей компании в Минске всегда в наличии необходимое количество самых ходовых позиций товара.Постоянно поддерживаемый товарный запас и широкий ассортимент на складе позволяет нам осуществлять выполнение заявок в полном объеме.<br />\r\nНаш клиент, будь то частный предприниматель,корпоративный представитель,отделение банка либо магазин,работая с нами,может быть уверен,что его заказ будет выполнен точно,в полном объеме и в срок, а наши высококвалифицированные сотрудники помогут Вам в выборе любого необходимого для Вас товара.<br />\r\n&nbsp;</p>\r\n', 'o-kompanii', 'О компании', '', '');

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
-- Структура таблицы `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `is_view` int(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `phone`) VALUES
(1, 'admin', 'admin', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL DEFAULT 'user',
  `operations` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_roles`
--

INSERT INTO `tbl_roles` (`user_id`, `role_name`, `operations`) VALUES
(1, 'admin', '');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_key` (`base_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `name`, `value`, `element`, `base_key`, `module_id`, `comment`, `visible`) VALUES
(1, 'Site Name', 'Monster-Life', 'input', 'site_name', 1, '', 'admin'),
(2, 'Admin email', 'admin@admin.com', 'input', 'admin_email', 1, 'Multiple email addresses must be entered by ; (example: admin@gmail.com; user@gmail.com)', 'admin'),
(3, 'Blocking site', '0', 'input', 'block_site', 1, 'Possible values: 0 - The site works 1 - Website Blocked', 'developer'),
(4, 'Header for email messages', '', 'editor', 'email_header', 2, 'This header will be added to all email messages which will be sent from the site for users', 'admin'),
(5, 'Footer for email messages', '', 'editor', 'email_footer', 2, 'This text will be added to the bottom of all email messages that will be sent to users', 'admin'),
(6, 'SEO description', '', 'input', 'default_seo_description', 4, '', 'admin'),
(7, 'SEO keywords', '', 'input', 'default_seo_keywords', 4, '', 'admin'),
(8, 'Test email', 'admin@admin.com', 'input', 'test_email', 2, 'This email is used for sending test messages from the site', 'admin'),
(9, 'SMTP FROM EMAIL', 'noreply@mail.com', 'input', 'smtp_from_email', 2, '', 'admin'),
(10, 'SMTP FROM NAME', '"Офисторг" - Ваш надежный партнер!', 'input', 'smtp_from_name', 2, '', 'admin'),
(11, 'Default success message when email sent ', 'Your message sent successfully!', 'input', 'email_send_successfully', 2, '', 'admin'),
(12, 'Default error sending message', 'Sending faild...', 'input', 'email_send_failed', 2, '', 'admin'),
(13, 'Twitter key', '', 'input', 'twitter_key', 10, 'Register your app here: <a href = "https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>', 'developer'),
(14, 'Twitter secret', '', 'input', 'twitter_secret', 10, 'Register your app here: <a href = "https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>', 'developer'),
(15, 'Google client id', '', 'input', 'google_client_id', 10, 'Register your app here: <a href = "https://code.google.com/apis/console/">https://code.google.com/apis/console/</a>', 'developer'),
(16, 'Google client secret', '', 'input', 'google_client_secret', 10, 'Register your app here: <a href = "https://code.google.com/apis/console/">https://code.google.com/apis/console/</a>', 'developer'),
(17, 'Yandex client id', '', 'input', 'yandex_client_id', 10, 'Register your app here: <a href = "https://oauth.yandex.ru/client/my">https://oauth.yandex.ru/client/my</a>', 'developer'),
(18, 'Yandex client secret', '', 'input', 'yandex_client_secret', 10, 'Register your app here: <a href = "https://oauth.yandex.ru/client/my">https://oauth.yandex.ru/client/my</a>', 'developer'),
(19, 'Facebook client id', '', 'input', 'facebook_client_id', 10, 'Register your app here: <a href = "https://developers.facebook.com/apps/">https://developers.facebook.com/apps/</a>', 'developer'),
(20, 'Facebook client secret', '', 'input', 'facebook_client_secret', 10, 'Register your app here: <a href = "https://developers.facebook.com/apps/">https://developers.facebook.com/apps/</a>', 'developer'),
(21, 'Vkontakte client id', '', 'input', 'vkontakte_client_id', 10, 'Register your app here: <a href = "https://vk.com/editapp?act=create&site=1">https://vk.com/editapp?act=create&site=1</a>', 'developer'),
(22, 'Vkontakte client secret', '', 'input', 'vkontakte_client_secret', 10, 'Register your app here: <a href = "https://vk.com/editapp?act=create&site=1">https://vk.com/editapp?act=create&site=1</a>', 'developer'),
(23, 'Linkedin key', '', 'input', 'linkedin_key', 10, 'Register your app here: <a href = "https://www.linkedin.com/secure/developer">https://www.linkedin.com/secure/developer</a>', 'developer'),
(24, 'Linkedin secret', '', 'input', 'linkedin_secret', 10, 'Register your app here: <a href = "https://www.linkedin.com/secure/developer">https://www.linkedin.com/secure/developer</a>', 'developer'),
(25, 'Github client id', '', 'input', 'github_client_id', 10, 'Register your app here: <a href = "https://github.com/settings/applications">https://github.com/settings/applications</a>', 'developer'),
(26, 'Github client secret', '', 'input', 'github_client_secret', 10, 'Register your app here: <a href = "https://github.com/settings/applications">https://github.com/settings/applications</a>', 'developer'),
(27, 'Mailru client id', '', 'input', 'mailru_client_id', 10, 'Register your app here: <a href = "http://api.mail.ru/sites/my/add">http://api.mail.ru/sites/my/add</a>', 'developer'),
(28, 'Mailru client secret', '', 'input', 'mailru_client_secret', 10, 'Register your app here: <a href = "http://api.mail.ru/sites/my/add">http://api.mail.ru/sites/my/add</a>', 'developer'),
(29, 'Dropbox client id', '', 'input', 'dropbox_client_id', 10, 'Register your app here: <a href = "https://www.dropbox.com/developers/apps/create">https://www.dropbox.com/developers/apps/create</a>', 'developer'),
(30, 'Dropbox client secret', '', 'input', 'dropbox_client_secret', 10, 'Register your app here: <a href = "https://www.dropbox.com/developers/apps/create">https://www.dropbox.com/developers/apps/create</a>', 'developer'),
(36, 'Site email', 'test@test.com', 'input', 'site_email', 1, '', 'admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `login`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `status`) VALUES
(1, 'admin', '$2y$13$ZeV4oKfyLRKAXpHyQ7Ht7uY.aiMWUzIpKyfazK9geNVzD2sH9jbZW', 'admin@admin.com', 'ae67495f91228d526e73e9e011771c08', '2015-05-18 00:33:13', '2015-06-06 18:41:40', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
