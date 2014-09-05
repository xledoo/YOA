-- phpMyAdmin SQL Dump
-- version 3.2.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 �?09 �?05 �?16:19
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `pre_admincp_sidebar`
--

INSERT INTO `pre_admincp_sidebar` (`id`, `upid`, `controller`, `action`, `title`, `icon`, `displayorder`) VALUES
(1, 0, 'creditcard', 'index', '信用卡业务管理', 'fa-credit-card', 0),
(2, 0, 'loan', 'index', '小额贷款业务管理', 'fa-dollar', 0),
(3, 0, 'financing', 'index', '融资业务管理', 'fa-rmb', 0),
(4, 1, 'creditcard', 'consume', '信用卡刷卡消费', 'fa-shopping-cart', 0),
(5, 1, 'creditcard', 'repayment', '信用卡代还', 'fa-sign-in', 0),
(6, 2, 'loan', 'add', '新增小贷业务订单', 'fa-plus', 0),
(7, 2, 'loan', 'list', '小贷业务订单列表', 'fa-list', 0),
(8, 3, 'financing', 'fcash', '现金方式融资', 'fa-money', 0),
(9, 3, 'financing', 'fcard', '信用卡融资', 'fa-tags', 0),
(10, 0, 'setting', 'index', '系统运行设置', 'fa-cogs', 999),
(11, 10, 'setting', 'login', '登录账户管理', 'fa-user', 888),
(12, 10, 'setting', 'settings', '系统参数设置', 'fa-cog', 0),
(13, 10, 'setting', 'sidebar', '菜单项目维护', 'fa-folder-o', 0),
(14, 0, 'log', 'index', '系统行为日志', 'fa-edit', 0),
(15, 14, 'log', 'login', '账号登录日志', 'fa-user-md', 0),
(16, 14, 'log', 'behavior', '操作行为记录', 'fa-keyboard-o', 0),
(17, 14, 'log', 'auditing', '审核权限日志', ' fa-gavel', 0),
(18, 0, 'market', 'index', '客户营销工具', 'fa-puzzle-piece', 0),
(19, 18, 'market', 'weixin', '微信营销平台', 'fa-comments-o', 0),
(20, 18, 'market', 'sms', '手机短信群发', 'fa-apple', 0),
(21, 18, 'market', 'email', '电子邮件群发', 'fa-envelope-o', 0),
(22, 0, 'record', 'index', '业务数据分析', 'fa-tachometer', 0),
(23, 3, 'financing', 'borrow', '短期资金拆借', 'fa-retweet', 0),
(24, 22, 'record', 'capital', '资金池构成', 'fa-th', 0),
(25, 0, 'customer', 'index', '客户信息维护', 'fa-group', 0),
(26, 22, 'record', 'portfolio', '业务量分析', 'fa-signal', 0),
(27, 25, 'customer', 'list', '当前客户列表', 'fa-bar-chart-o', 0);
