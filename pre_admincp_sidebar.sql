-- phpMyAdmin SQL Dump
-- version 3.2.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 �?09 �?04 �?16:36
-- 服务器版本: 5.6.10
-- PHP 版本: 5.6.0beta4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yoa`
--

-- --------------------------------------------------------

--
-- 表的结构 `pre_admincp_sidebar`
--

CREATE TABLE IF NOT EXISTS `pre_admincp_sidebar` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `upid` smallint(5) NOT NULL DEFAULT '0',
  `controller` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pre_admincp_sidebar`
--

INSERT INTO `pre_admincp_sidebar` (`id`, `upid`, `controller`, `action`, `title`, `icon`, `displayorder`) VALUES
(1, 0, 'creditcard', 'index', '信用卡业务管理', 'fa-user', 0),
(2, 0, 'loan', 'index', '小额贷款业务管理', '', 0),
(3, 0, 'financing', 'index', '融资业务管理', '', 0),
(4, 1, 'creditcard', 'consume', '信用卡刷卡', '', 0),
(5, 1, 'creditcard', 'repayment', '信用卡代还', '', 0),
(6, 2, 'loan', 'add', '添加小贷业务订单', '', 0),
(7, 2, 'loan', 'list', '小贷业务订单列表', '', 0),
(8, 3, 'financing', 'fcash', '融资现金', '', 0),
(9, 3, 'financing', 'fcard', '融资信用卡', '', 0);
