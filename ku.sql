-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 24 2019 г., 15:13
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ku`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bds_one`
--

CREATE TABLE IF NOT EXISTS `bds_one` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `bd` varchar(255) DEFAULT '',
  `count` int(11) NOT NULL,
  `site` varchar(255) DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `up` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `domens`
--

CREATE TABLE IF NOT EXISTS `domens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bad` int(3) NOT NULL,
  `domen` varchar(255) NOT NULL,
  `domen_new` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `domen_check` int(3) NOT NULL DEFAULT '0',
  `http` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` int(15) NOT NULL,
  `links_count` int(10) NOT NULL,
  `forms_count` int(10) NOT NULL,
  `find` varchar(255) NOT NULL,
  `time_scan` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domen` (`domen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `dumpers_one`
--

CREATE TABLE IF NOT EXISTS `dumpers_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `filed_id` int(10) unsigned NOT NULL,
  `bd` varchar(255) NOT NULL,
  `table` varchar(255) NOT NULL,
  `filed` varchar(255) NOT NULL,
  `get` int(3) NOT NULL DEFAULT '0',
  `multi` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `filed_id` (`filed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `fileds`
--

CREATE TABLE IF NOT EXISTS `fileds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `get` varchar(255) DEFAULT '',
  `lastlimit` varchar(255) DEFAULT '',
  `function` varchar(255) DEFAULT '',
  `count` int(11) NOT NULL,
  `ipbase` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `dok` int(5) DEFAULT '0',
  `site` varchar(255) DEFAULT '0',
  `multi` int(2) DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `up` int(3) NOT NULL DEFAULT '0',
  `name` varchar(500) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `typedb` varchar(255) NOT NULL,
  `dumping_one` int(3) NOT NULL DEFAULT '0',
  `login` varchar(255) NOT NULL,
  `adress` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `fileds_one`
--

CREATE TABLE IF NOT EXISTS `fileds_one` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `get` varchar(255) DEFAULT '',
  `lastlimit` varchar(255) DEFAULT '',
  `function` varchar(255) DEFAULT '',
  `count` int(11) NOT NULL,
  `ipbase` varchar(255) DEFAULT NULL,
  `ipbase2` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `filed` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `dok` int(5) DEFAULT '0',
  `site` varchar(255) DEFAULT '0',
  `multi` int(2) DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `up` int(3) NOT NULL DEFAULT '0',
  `potok` int(3) NOT NULL DEFAULT '0',
  `pri` int(3) NOT NULL,
  `name` varchar(500) NOT NULL,
  `adress` varchar(500) NOT NULL,
  `login` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filed` (`filed`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `hash`
--

CREATE TABLE IF NOT EXISTS `hash` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) DEFAULT '0',
  `pass` varchar(255) DEFAULT '0',
  `hash` varchar(255) DEFAULT '0',
  `date` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT '0',
  `text` varchar(255) DEFAULT '0',
  `function` varchar(255) DEFAULT '0',
  `squle` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domen` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `bd` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hashtype` varchar(255) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL DEFAULT '0',
  `hash2` varchar(255) DEFAULT '0',
  `meiler` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `mx` varchar(255) NOT NULL DEFAULT '0',
  `abuse` int(3) NOT NULL DEFAULT '0',
  `down` int(3) NOT NULL DEFAULT '0',
  `clean` int(3) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`email`,`pass`),
  KEY `i_meiler` (`meiler`) USING BTREE,
  KEY `i_date` (`date`) USING BTREE,
  KEY `i_domen` (`domen`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mails_dumping`
--

CREATE TABLE IF NOT EXISTS `mails_dumping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `domen` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `bd` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hashtype` varchar(255) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL DEFAULT '0',
  `hash2` varchar(255) DEFAULT '0',
  `meiler` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `mx` varchar(255) NOT NULL DEFAULT '0',
  `abuse` int(3) NOT NULL DEFAULT '0',
  `down` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `i_meiler` (`meiler`) USING BTREE,
  KEY `i_date` (`date`) USING BTREE,
  KEY `i_domen` (`domen`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mails_one`
--

CREATE TABLE IF NOT EXISTS `mails_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `domen` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `bd` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hashtype` varchar(255) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL DEFAULT '0',
  `hash2` varchar(255) DEFAULT '0',
  `meiler` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `mx` varchar(255) NOT NULL DEFAULT '0',
  `abuse` int(3) NOT NULL DEFAULT '0',
  `down` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `i_meiler` (`meiler`) USING BTREE,
  KEY `i_date` (`date`) USING BTREE,
  KEY `i_domen` (`domen`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `multis`
--

CREATE TABLE IF NOT EXISTS `multis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filed_id` int(11) DEFAULT '0',
  `post_id` int(11) DEFAULT '0',
  `domen` varchar(255) DEFAULT '0',
  `lastlimit` int(11) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `get` int(2) DEFAULT '0',
  `potok` int(2) DEFAULT '0',
  `function` int(3) DEFAULT '0',
  `prich` varchar(255) DEFAULT '0',
  `isp` varchar(255) DEFAULT '0',
  `dok` int(3) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `multis_one`
--

CREATE TABLE IF NOT EXISTS `multis_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filed_id` int(11) DEFAULT '0',
  `post_id` int(11) DEFAULT '0',
  `domen` varchar(255) DEFAULT '0',
  `lastlimit` int(11) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `get` int(2) DEFAULT '0',
  `potok` int(2) DEFAULT '0',
  `function` int(3) DEFAULT '0',
  `prich` varchar(255) DEFAULT '0',
  `isp` varchar(255) DEFAULT '0',
  `dok` int(3) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `m_users`
--

CREATE TABLE IF NOT EXISTS `m_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `domen` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL DEFAULT '0',
  `m_pass` varchar(255) NOT NULL DEFAULT '0',
  `m_priv` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `shema` varchar(255) NOT NULL DEFAULT '0',
  `bd` varchar(255) NOT NULL DEFAULT '0',
  `table` varchar(255) DEFAULT '0',
  `column` varchar(255) NOT NULL DEFAULT '0',
  `column_16` int(3) NOT NULL DEFAULT '0',
  `count_n` int(3) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `count_new` int(20) NOT NULL,
  `check_count` int(3) NOT NULL DEFAULT '0',
  `domen` varchar(255) DEFAULT '0',
  `card2` varchar(255) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL,
  `date_new` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT '0',
  `typedb` varchar(255) NOT NULL,
  `count_new2` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ordersTable_one`
--

CREATE TABLE IF NOT EXISTS `ordersTable_one` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `shema` varchar(255) NOT NULL DEFAULT '0',
  `bd` varchar(255) NOT NULL DEFAULT '0',
  `table` varchar(255) DEFAULT '0',
  `card2` varchar(255) NOT NULL,
  `column_16` int(3) NOT NULL DEFAULT '0',
  `count_n` int(3) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `domen` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_card`
--

CREATE TABLE IF NOT EXISTS `orders_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(3) NOT NULL,
  `column` text NOT NULL,
  `data` text NOT NULL,
  `prich` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_one`
--

CREATE TABLE IF NOT EXISTS `orders_one` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `shema` varchar(255) NOT NULL DEFAULT '0',
  `bd` varchar(255) NOT NULL DEFAULT '0',
  `table` varchar(255) DEFAULT '0',
  `card2` varchar(255) NOT NULL,
  `column` varchar(255) NOT NULL DEFAULT '0',
  `column_16` int(3) NOT NULL DEFAULT '0',
  `count_n` int(3) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `domen` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pentest`
--

CREATE TABLE IF NOT EXISTS `pentest` (
  `page` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prohod` int(10) unsigned NOT NULL,
  `gurl` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tables` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `status` int(10) unsigned NOT NULL,
  `multi_count` int(3) NOT NULL DEFAULT '0',
  `work` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `sposob` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `method` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `column` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `mysqlbd` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `file_priv` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `version` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tic` int(3) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `proverka_self` int(10) unsigned NOT NULL,
  `domen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `find` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `getmail` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `maska` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `tema` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `testing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pr` int(50) NOT NULL DEFAULT '0',
  `pr_check` int(3) NOT NULL DEFAULT '0',
  `alexa` int(50) NOT NULL DEFAULT '100000000',
  `alexa_check` int(3) NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'checking',
  `country_check` int(3) NOT NULL DEFAULT '0',
  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `order_check` int(3) NOT NULL DEFAULT '0',
  `crawler` int(3) NOT NULL DEFAULT '0',
  `get_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `http` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `up` int(2) NOT NULL DEFAULT '0',
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn_check` int(3) NOT NULL DEFAULT '0',
  `header` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'get',
  `all_check` int(3) NOT NULL DEFAULT '0',
  `sqlmap_check` int(11) NOT NULL DEFAULT '0',
  `path_query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'txt',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domen` (`domen`),
  UNIQUE KEY `url` (`url`),
  KEY `ddd` (`domen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts_all`
--

CREATE TABLE IF NOT EXISTS `posts_all` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prohod` int(10) unsigned NOT NULL,
  `gurl` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tables` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `status` int(10) unsigned NOT NULL,
  `work` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `sposob` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `method` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `column` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `mysqlbd` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `file_priv` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `version` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tic` int(3) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `proverka_self` int(10) unsigned NOT NULL,
  `domen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path_query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_count` int(10) NOT NULL DEFAULT '0',
  `check_posts` int(3) NOT NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `find` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `getmail` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `maska` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `tema` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `testing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pr` int(50) NOT NULL DEFAULT '0',
  `pr_check` int(3) NOT NULL DEFAULT '0',
  `alexa` int(50) NOT NULL DEFAULT '100000000',
  `alexa_check` int(3) NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'checking',
  `country_check` int(3) NOT NULL DEFAULT '0',
  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `order_check` int(3) NOT NULL DEFAULT '0',
  `crawler` int(3) NOT NULL DEFAULT '0',
  `get_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `header` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'get',
  `http` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `up` int(2) NOT NULL DEFAULT '0',
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn_check` int(3) NOT NULL DEFAULT '0',
  `table_admin_check` int(3) NOT NULL DEFAULT '0',
  `cookies` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `sqlmap_check` int(3) NOT NULL DEFAULT '0',
  `all_check` int(3) NOT NULL DEFAULT '0',
  `insert_post` int(3) NOT NULL DEFAULT '0',
  `from` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'txt',
  `multi_count` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `path_query` (`path_query`),
  UNIQUE KEY `path_query_2` (`path_query`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts_one`
--

CREATE TABLE IF NOT EXISTS `posts_one` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prohod` int(10) unsigned NOT NULL,
  `gurl` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tables` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `status` int(10) unsigned NOT NULL,
  `work` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `sposob` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `method` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `column` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mysqlbd` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `file_priv` varchar(255) CHARACTER SET latin1 DEFAULT '0',
  `version` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `tic` int(3) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `proverka_self` int(10) unsigned NOT NULL,
  `domen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `find` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `getmail` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `maska` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `tema` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `testing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pr` int(50) NOT NULL DEFAULT '0',
  `pr_check` int(3) NOT NULL DEFAULT '0',
  `alexa` int(50) NOT NULL DEFAULT '100000000',
  `alexa_check` int(3) NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'cheking',
  `country_check` int(3) DEFAULT '0',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `up` int(2) NOT NULL DEFAULT '0',
  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `order_check` int(3) NOT NULL DEFAULT '0',
  `path1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `path2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `path3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `site1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `site2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `site3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `path_conf1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `path_conf2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `path_conf3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ssn_check` int(3) NOT NULL DEFAULT '0',
  `cookies` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `http` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://',
  `header` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'get',
  `sqlmap_check` int(3) NOT NULL DEFAULT '0',
  `all_check` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domen` (`domen`),
  UNIQUE KEY `url` (`url`),
  KEY `ddd` (`domen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `renders`
--

CREATE TABLE IF NOT EXISTS `renders` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `domen` varchar(255) NOT NULL DEFAULT '0',
  `countNoHash` int(25) NOT NULL DEFAULT '0',
  `countHash` int(25) NOT NULL DEFAULT '0',
  `countMail` int(25) NOT NULL DEFAULT '0',
  `countPass` int(25) NOT NULL DEFAULT '0',
  `download` varchar(255) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL DEFAULT '0000-00-00',
  `randPass` varchar(255) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '0',
  `lastCountNoHash` int(15) NOT NULL DEFAULT '0',
  `lastCountHash` int(15) NOT NULL DEFAULT '0',
  `lastCountMail` int(15) NOT NULL DEFAULT '0',
  `statusNoHash` int(4) NOT NULL DEFAULT '0',
  `statusHash` int(15) NOT NULL DEFAULT '0',
  `statusMail` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `renders_one`
--

CREATE TABLE IF NOT EXISTS `renders_one` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `domen` varchar(255) NOT NULL DEFAULT '0',
  `countNoHash` int(25) NOT NULL DEFAULT '0',
  `countHash` int(25) NOT NULL DEFAULT '0',
  `countMail` int(25) NOT NULL DEFAULT '0',
  `countPass` int(25) NOT NULL DEFAULT '0',
  `download` varchar(255) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL DEFAULT '0000-00-00',
  `randPass` varchar(255) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '0',
  `lastCountNoHash` int(15) NOT NULL DEFAULT '0',
  `lastCountHash` int(15) NOT NULL DEFAULT '0',
  `lastCountMail` int(15) NOT NULL DEFAULT '0',
  `statusNoHash` int(4) NOT NULL DEFAULT '0',
  `statusHash` int(15) NOT NULL DEFAULT '0',
  `statusMail` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '0',
  `value` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ssn`
--

CREATE TABLE IF NOT EXISTS `ssn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) DEFAULT NULL,
  `shema` varchar(255) NOT NULL DEFAULT '0',
  `bd` varchar(255) NOT NULL DEFAULT '0',
  `table` varchar(255) DEFAULT '0',
  `column` varchar(255) NOT NULL DEFAULT '0',
  `column_16` int(3) NOT NULL DEFAULT '0',
  `count_n` int(3) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `count_new` int(20) NOT NULL,
  `check_count` int(3) NOT NULL DEFAULT '0',
  `domen` varchar(255) DEFAULT '0',
  `card2` varchar(255) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL,
  `date_new` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT '0',
  `count_new2` int(20) NOT NULL DEFAULT '0',
  `typedb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ssn_card`
--

CREATE TABLE IF NOT EXISTS `ssn_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(3) NOT NULL,
  `column` text NOT NULL,
  `data` text NOT NULL,
  `prich` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `starts`
--

CREATE TABLE IF NOT EXISTS `starts` (
  `lasttime` int(11) DEFAULT NULL,
  `time_start` int(11) DEFAULT NULL,
  `function` varchar(255) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `squle_id` int(11) DEFAULT '0',
  `potok` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
