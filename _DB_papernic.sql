-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Kas 2016, 21:25:08
-- Sunucu sürümü: 10.1.16-MariaDB
-- PHP Sürümü: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `papernic`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_type` smallint(6) NOT NULL,
  `contact_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_office` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gsm` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `im` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `notes` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_type`, `contact_name`, `email`, `citizenship_no`, `tax_id`, `tax_office`, `phone`, `gsm`, `fax`, `im`, `web`, `address`, `country_id`, `notes`, `is_deleted`) VALUES
(1, 1, 'John Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `country`
--

CREATE TABLE `country` (
  `country_id` smallint(6) NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `country`
--

INSERT INTO `country` (`country_id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo (Brazzaville)'),
(50, 'Congo (Kinshasa)'),
(51, 'Cook Islands'),
(52, 'Costa Rica'),
(53, 'Côte Ivoire'),
(54, 'Croatia'),
(55, 'Cuba'),
(56, 'Cyprus'),
(57, 'Czech Republic'),
(58, 'Denmark'),
(59, 'Djibouti'),
(60, 'Dominica'),
(61, 'Dominican Republic'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'French Guiana'),
(75, 'French Polynesia'),
(76, 'French Southern Lands'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Gibraltar'),
(83, 'Greece'),
(84, 'Greenland'),
(85, 'Grenada'),
(86, 'Guadeloupe'),
(87, 'Guam'),
(88, 'Guatemala'),
(89, 'Guernsey'),
(90, 'Guinea'),
(91, 'Guinea-Bissau'),
(92, 'Guyana'),
(93, 'Haiti'),
(94, 'Heard and McDonald Islands'),
(95, 'Honduras'),
(96, 'Hong Kong'),
(97, 'Hungary'),
(98, 'Iceland'),
(99, 'India'),
(100, 'Indonesia'),
(101, 'Iran'),
(102, 'Iraq'),
(103, 'Ireland'),
(104, 'Isle of Man'),
(105, 'Israel'),
(106, 'Italy'),
(107, 'Jamaica'),
(108, 'Japan'),
(109, 'Jersey'),
(110, 'Jordan'),
(111, 'Kazakhstan'),
(112, 'Kenya'),
(113, 'Kiribati'),
(114, 'Korea, North'),
(115, 'Korea, South'),
(116, 'Kuwait'),
(117, 'Kyrgyzstan'),
(118, 'Laos'),
(119, 'Latvia'),
(120, 'Lebanon'),
(121, 'Lesotho'),
(122, 'Liberia'),
(123, 'Libya'),
(124, 'Liechtenstein'),
(125, 'Lithuania'),
(126, 'Luxembourg'),
(127, 'Macau'),
(128, 'Macedonia'),
(129, 'Madagascar'),
(130, 'Malawi'),
(131, 'Malaysia'),
(132, 'Maldives'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Martinique'),
(137, 'Mauritania'),
(138, 'Mauritius'),
(139, 'Mayotte'),
(140, 'Mexico'),
(141, 'Micronesia'),
(142, 'Moldova'),
(143, 'Monaco'),
(144, 'Mongolia'),
(145, 'Montenegro'),
(146, 'Montserrat'),
(147, 'Morocco'),
(148, 'Mozambique'),
(149, 'Myanmar'),
(150, 'Namibia'),
(151, 'Nauru'),
(152, 'Nepal'),
(153, 'Netherlands'),
(154, 'Netherlands Antilles'),
(155, 'New Caledonia'),
(156, 'New Zealand'),
(157, 'Nicaragua'),
(158, 'Niger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Norfolk Island'),
(162, 'Northern Mariana Islands'),
(163, 'Norway'),
(164, 'Oman'),
(165, 'Pakistan'),
(166, 'Palau'),
(167, 'Palestine'),
(168, 'Panama'),
(169, 'Papua New Guinea'),
(170, 'Paraguay'),
(171, 'Peru'),
(172, 'Philippines'),
(173, 'Pitcairn'),
(174, 'Poland'),
(175, 'Portugal'),
(176, 'Puerto Rico'),
(177, 'Qatar'),
(178, 'Reunion'),
(179, 'Romania'),
(180, 'Russian Federation'),
(181, 'Rwanda'),
(182, 'Saint Barthélemy'),
(183, 'Saint Helena'),
(184, 'Saint Kitts and Nevis'),
(185, 'Saint Lucia'),
(186, 'Saint Martin (French part)'),
(187, 'Saint Pierre and Miquelon'),
(188, 'Saint Vincent and the Grenadines'),
(189, 'Samoa'),
(190, 'San Marino'),
(191, 'Sao Tome and Principe'),
(192, 'Saudi Arabia'),
(193, 'Senegal'),
(194, 'Serbia'),
(195, 'Seychelles'),
(196, 'Sierra Leone'),
(197, 'Singapore'),
(198, 'Slovakia'),
(199, 'Slovenia'),
(200, 'Solomon Islands'),
(201, 'Somalia'),
(202, 'South Africa'),
(203, 'South Georgia'),
(204, 'Spain'),
(205, 'Sri Lanka'),
(206, 'Sudan'),
(207, 'Suriname'),
(208, 'Svalbard'),
(209, 'Swaziland'),
(210, 'Sweden'),
(211, 'Switzerland'),
(212, 'Syria'),
(213, 'Taiwan'),
(214, 'Tajikistan'),
(215, 'Tanzania'),
(216, 'Thailand'),
(217, 'Timor-Leste'),
(218, 'Togo'),
(219, 'Tokelau'),
(220, 'Tonga'),
(221, 'Trinidad and Tobago'),
(222, 'Tunisia'),
(223, 'Türkiye'),
(224, 'Turkmenistan'),
(225, 'Turks and Caicos Islands'),
(226, 'Tuvalu'),
(227, 'Uganda'),
(228, 'Ukraine'),
(229, 'United Arab Emirates'),
(230, 'United Kingdom'),
(231, 'US Outlying Islands'),
(232, 'United States of America'),
(233, 'Uruguay'),
(234, 'Uzbekistan'),
(235, 'Wallis and Futuna Islands'),
(236, 'Vanuatu'),
(237, 'Vatican City'),
(238, 'Venezuela'),
(239, 'Western Sahara'),
(240, 'Vietnam'),
(241, 'Virgin Islands, British'),
(242, 'Virgin Islands, U.S.'),
(243, 'Yemen'),
(244, 'Zambia'),
(245, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `customer_id` smallint(6) NOT NULL,
  `login_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `account_started` int(11) NOT NULL,
  `account_expires` int(11) NOT NULL,
  `database_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `database_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `database_password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `account_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_limit` smallint(6) NOT NULL,
  `disk_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dashboard`
--

CREATE TABLE `dashboard` (
  `dashboard_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `dashboard`
--

INSERT INTO `dashboard` (`dashboard_id`, `user_id`, `message`, `timestamp`) VALUES
(1, 1, 'Hello world!', 1478377040);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `document_subject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_date` date DEFAULT NULL,
  `from_contact` int(11) DEFAULT NULL,
  `to_contact` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `filing_cabinet_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `notes` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_private` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `is_temp` tinyint(1) DEFAULT '1',
  `temp_timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `document`
--

INSERT INTO `document` (`document_id`, `document_subject`, `document_no`, `document_date`, `from_contact`, `to_contact`, `category_id`, `type_id`, `filing_cabinet_no`, `expiry_date`, `notes`, `date_added`, `user_id`, `is_private`, `is_deleted`, `is_temp`, `temp_timestamp`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1478375959, 1, NULL, 0, 1, 1478375959),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1478376154, 1, NULL, 0, 1, 1478376154),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1478376171, 1, NULL, 0, 1, 1478376171),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1478376227, 1, NULL, 0, 1, 1478376227),
(5, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1478376247, 1, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document_category`
--

CREATE TABLE `document_category` (
  `document_category_id` int(11) NOT NULL,
  `document_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document_custom_field`
--

CREATE TABLE `document_custom_field` (
  `custom_field_id` int(11) NOT NULL,
  `custom_field_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `length` smallint(6) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `lookup_values` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `row` smallint(6) DEFAULT NULL,
  `column` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document_custom_value`
--

CREATE TABLE `document_custom_value` (
  `custom_value_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `value` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document_file`
--

CREATE TABLE `document_file` (
  `file_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `path` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `size` double NOT NULL,
  `date_added` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `document_file`
--

INSERT INTO `document_file` (`file_id`, `document_id`, `path`, `file_name`, `size`, `date_added`, `user_id`) VALUES
(2, 5, '/2016/11/5/54568/', 'aaa.jpg', 0.05, 1478376993, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `document_type`
--

CREATE TABLE `document_type` (
  `document_type_id` int(11) NOT NULL,
  `document_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `options` varchar(1000) COLLATE utf8_unicode_ci DEFAULT 'a:0:{}',
  `session_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `full_name`, `is_deleted`, `options`, `session_id`, `session_timestamp`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Demo User', 0, 'a:21:{s:8:"is_admin";b:1;s:10:"smtp_email";s:0:"";s:14:"smtp_host_name";s:0:"";s:14:"smtp_user_name";s:0:"";s:13:"smtp_password";s:0:"";s:9:"smtp_port";s:3:"587";s:14:"smtp_auth_mode";s:5:"login";s:15:"smtp_encryption";s:0:"";s:18:"priv_document_edit";s:4:"true";s:20:"priv_document_delete";s:4:"true";s:17:"priv_contact_edit";s:4:"true";s:19:"priv_contact_delete";s:4:"true";s:16:"priv_file_upload";s:4:"true";s:18:"priv_file_download";s:4:"true";s:16:"priv_file_delete";s:4:"true";s:17:"priv_document_add";b:1;s:16:"priv_contact_add";b:1;s:17:"contact_list_show";i:20;s:18:"document_list_show";i:20;s:11:"date_format";s:5:"d.m.Y";s:11:"time_format";s:3:"H:i";}', 'te0rarfq99oovs53a2reqnaj07', 1478377286);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Tablo için indeksler `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `UNIQ_81398E095CB2E05D` (`login_id`),
  ADD UNIQUE KEY `UNIQ_81398E09E7927C74` (`email`);

--
-- Tablo için indeksler `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`dashboard_id`);

--
-- Tablo için indeksler `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Tablo için indeksler `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`document_category_id`);

--
-- Tablo için indeksler `document_custom_field`
--
ALTER TABLE `document_custom_field`
  ADD PRIMARY KEY (`custom_field_id`),
  ADD UNIQUE KEY `UNIQ_351D9C4072102B16` (`custom_field_name`);

--
-- Tablo için indeksler `document_custom_value`
--
ALTER TABLE `document_custom_value`
  ADD PRIMARY KEY (`custom_value_id`);

--
-- Tablo için indeksler `document_file`
--
ALTER TABLE `document_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Tablo için indeksler `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`document_type_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UNIQ_8D93D64924A232CF` (`user_name`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `country`
--
ALTER TABLE `country`
  MODIFY `country_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- Tablo için AUTO_INCREMENT değeri `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `dashboard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `document_category`
--
ALTER TABLE `document_category`
  MODIFY `document_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `document_custom_field`
--
ALTER TABLE `document_custom_field`
  MODIFY `custom_field_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `document_custom_value`
--
ALTER TABLE `document_custom_value`
  MODIFY `custom_value_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `document_file`
--
ALTER TABLE `document_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `document_type`
--
ALTER TABLE `document_type`
  MODIFY `document_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
