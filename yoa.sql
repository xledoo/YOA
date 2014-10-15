-- phpMyAdmin SQL Dump
-- version 3.2.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 �?10 �?15 �?09:07
-- 服务器版本: 5.7.4
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
-- 表的结构 `pre_admincp_checkmobile`
--

CREATE TABLE IF NOT EXISTS `pre_admincp_checkmobile` (
  `mobile` varchar(11) NOT NULL,
  `sign` varchar(6) NOT NULL,
  `sendip` varchar(15) NOT NULL,
  `dateline` int(10) NOT NULL,
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pre_admincp_checkmobile`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `pre_admincp_sidebar`
--

INSERT INTO `pre_admincp_sidebar` (`id`, `upid`, `controller`, `action`, `title`, `icon`, `displayorder`) VALUES
(1, 0, 'creditcard', 'index', '信用卡业务管理', 'fa-credit-card', 1),
(2, 0, 'loan', 'index', '小贷业务管理', 'fa-dollar', 2),
(3, 0, 'financing', 'index', '融资业务管理', 'fa-rmb', 3),
(4, 1, 'creditcard', 'consume', '信用卡套现', 'fa-shopping-cart', 2),
(5, 1, 'creditcard', 'repayment', '信用卡代还', 'fa-sign-in', 1),
(6, 2, 'loan', 'add', '新增小贷业务订单', 'fa-plus', 1),
(7, 2, 'loan', 'list', '小贷业务订单列表', 'fa-list', 2),
(8, 3, 'financing', 'fcash', '现金融资', 'fa-money', 1),
(9, 3, 'financing', 'fcard', '信用卡融资', 'fa-tags', 2),
(10, 0, 'setting', 'index', '系统运行设置', 'fa-cogs', 999),
(11, 10, 'setting', 'slogin', '账号登录管理', 'fa-user', 999),
(12, 10, 'setting', 'settings', '系统参数设置', 'fa-cog', 0),
(13, 10, 'setting', 'sidebar', '菜单项目维护', 'fa-folder-o', 0),
(14, 0, 'log', 'index', '系统行为日志', 'fa-edit', 998),
(15, 14, 'log', 'llogin', '账号登录日志', 'fa-user-md', 0),
(16, 14, 'log', 'behavior', '操作行为记录', 'fa-keyboard-o', 0),
(17, 14, 'log', 'auditing', '审核权限日志', ' fa-gavel', 0),
(18, 0, 'market', 'index', '客户营销工具', 'fa-puzzle-piece', 4),
(19, 18, 'market', 'weixin', '微信营销平台', 'fa-comments-o', 3),
(20, 18, 'market', 'sms', '手机短信群发', 'fa-apple', 1),
(21, 18, 'market', 'email', '电子邮件群发', 'fa-envelope-o', 2),
(22, 0, 'record', 'index', '业务数据分析', 'fa-tachometer', 5),
(23, 3, 'financing', 'borrow', '短期资金拆借', 'fa-retweet', 3),
(24, 22, 'record', 'capital', '资金池构成', 'fa-th', 0),
(25, 0, 'customer', 'index', '客户信息维护', 'fa-group', 6),
(26, 22, 'record', 'portfolio', '业务量分析', 'fa-signal', 0),
(27, 25, 'customer', 'clist', '当前客户列表', 'fa-bar-chart-o', 0),
(28, 3, 'financing', 'rate', '结息打款计划', 'fa-th', 99);

-- --------------------------------------------------------

--
-- 表的结构 `pre_admincp_smsender`
--

CREATE TABLE IF NOT EXISTS `pre_admincp_smsender` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(20) NOT NULL,
  `sendip` varchar(15) NOT NULL,
  `dateline` int(10) NOT NULL DEFAULT '0',
  `mobile` char(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pre_admincp_smsender`
--


-- --------------------------------------------------------

--
-- 表的结构 `pre_common_banks`
--

CREATE TABLE IF NOT EXISTS `pre_common_banks` (
  `bid` mediumint(5) NOT NULL AUTO_INCREMENT,
  `bankname` char(20) NOT NULL,
  `sign` char(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bankname` (`bankname`) USING BTREE,
  UNIQUE KEY `bankname_2` (`bankname`) USING BTREE,
  UNIQUE KEY `sign` (`sign`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `pre_common_banks`
--

INSERT INTO `pre_common_banks` (`bid`, `bankname`, `sign`, `status`) VALUES
(1, '农业银行', 'abc', 1),
(2, '建设银行', 'ccb', 1),
(3, '工商银行', 'icbc', 1),
(4, '交通银行', 'boco', 1),
(5, '中国银行', 'boc', 1),
(6, '招商银行', 'cmb', 1),
(7, '广发银行', 'gdb', 1),
(8, '民生银行', 'cmbc', 1),
(9, '光大银行', 'cebb', 1),
(10, '中信银行', 'ecitic', 1),
(11, '平安银行', 'pingan', 1),
(13, '华夏银行', 'hxb', 1),
(14, '邮政储蓄银行', 'post', 1),
(15, '浦发银行', 'spdb', 1),
(16, '兴业银行', 'cib', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pre_common_customer`
--

CREATE TABLE IF NOT EXISTS `pre_common_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pre_common_customer`
--

INSERT INTO `pre_common_customer` (`id`, `customer`, `mobile`, `email`, `dateline`) VALUES
(1, '徐力', '18687444499', 'xledoo@qq.com', 0),
(2, '彭普', '15924907828', '124910168@qq.com', 0),
(3, '莫小贝', '15633332222', 'hoo@126.com', 0),
(4, '秦文', '13955555443', '243035210@qq.com', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pre_common_setting`
--

CREATE TABLE IF NOT EXISTS `pre_common_setting` (
  `skey` varchar(255) NOT NULL,
  `svalue` text NOT NULL,
  `stype` enum('off','radio','checkbox','text','select','textarea') NOT NULL DEFAULT 'text',
  `stitle` varchar(255) NOT NULL,
  `sremark` text NOT NULL,
  PRIMARY KEY (`skey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `pre_common_setting`
--

INSERT INTO `pre_common_setting` (`skey`, `svalue`, `stype`, `stitle`, `sremark`) VALUES
('sitename', '云丼投资OA业务管理系统', 'text', '站点名称', '当前站点的名称'),
('siteoff', '0', 'off', '站点开关', '站点开关'),
('siteurl', 'http://oa.finabao.com', 'text', '站点域名', '当前站点的域名'),
('siteinfo', '站点相关信息', 'textarea', '站点信息', '站点相关信息'),
('fina_status', '0=融资\r\n1=提现\r\n2=打款', 'textarea', '认证状态设置', '认证状态设置信息'),
('SMS_USERNAME', 'xledoo', 'text', '短信接口登录用户名', '短信接口登录用户名'),
('SMS_PASSWORD', 'zmin821001', 'text', '短信接口登录密码', '短信接口登录密码'),
('SMS_CHARSET', 'utf8', 'text', '短信接口字符集', '短信接口字符集'),
('SMS_INTERFACE', 'http://api.chanyoo.cn/{charset}/interface/send_sms.aspx?username={username}&password={password}&receiver={mobile}&content={message}', 'textarea', '短信接口URL', '短信接口URL'),
('MAIL_ADDRESS', 'pengpu1987@126.com', 'text', '发送邮箱地址', '发送邮件的地址'),
('MAIL_SMTP', 'smtp.126.com', 'text', '邮箱SMTP服务器', '邮箱SMTP服务器'),
('MAIL_LOGINNAME', 'pengpu1987', 'text', '邮箱登录帐号', '邮箱登录的账号'),
('MAIL_PASSWORD', 'pp135642', 'text', '登录密码', '邮箱登录密码'),
('MAIL_CHARSET', 'UTF-8', 'text', '字符集', '字符集'),
('MAIL_AUTH', 'true', 'text', '邮箱认证', '邮箱的认证'),
('MAIL_HTML', 'true', 'text', '文档格式', 'true HTML格式 false TXT格式');

-- --------------------------------------------------------

--
-- 表的结构 `pre_finance_cash`
--

CREATE TABLE IF NOT EXISTS `pre_finance_cash` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `stype` enum('cash','card') NOT NULL,
  `customer` varchar(20) NOT NULL,
  `money` float(10,2) NOT NULL,
  `startime` int(10) NOT NULL,
  `endtime` int(10) NOT NULL DEFAULT '0',
  `rate` int(3) NOT NULL DEFAULT '20',
  `cbankname` varchar(20) NOT NULL,
  `ccardnum` varchar(25) NOT NULL,
  `zday` tinyint(2) NOT NULL,
  `hkday` tinyint(2) NOT NULL,
  `mobile` char(11) NOT NULL,
  `bankname` varchar(20) NOT NULL,
  `cardnum` varchar(25) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `sponsor` varchar(10) NOT NULL,
  `verify` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pre_finance_cash`
--

INSERT INTO `pre_finance_cash` (`id`, `stype`, `customer`, `money`, `startime`, `endtime`, `rate`, `cbankname`, `ccardnum`, `zday`, `hkday`, `mobile`, `bankname`, `cardnum`, `status`, `sponsor`, `verify`) VALUES
(1, 'cash', '徐力', 100000.00, 1404144000, 1412827162, 20, 'gdb', '6234567892211233', 0, 0, '18687444499', 'ccb', '6227077774444477', 1, '徐力', '6bfa8f6bb15cc5e51b550142269d986b'),
(2, 'card', '字符串', 100000.00, 1404144000, 1413271429, 10, 'icbc', '4270300046233523', 2, 25, '18666554431', 'icbc', '6777777777777777', 1, '', '63b36f6701f87bc14929784d6d975717'),
(3, 'card', '数据库', 50000.00, 1409500800, 1412906548, 20, 'cebb', '622887655161572122', 0, 0, '18234567890', 'boc', '555555555555555555', 0, 'asdf', 'd525b950b387f92a27afead2fc61c30b');

-- --------------------------------------------------------

--
-- 表的结构 `pre_finance_ratelog`
--

CREATE TABLE IF NOT EXISTS `pre_finance_ratelog` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cashid` smallint(8) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `stype` enum('cash','card') NOT NULL,
  `money` float(10,2) NOT NULL,
  `rate` float(10,2) NOT NULL,
  `bankname` varchar(20) NOT NULL,
  `cardnum` varchar(25) NOT NULL,
  `dateline` int(10) NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ratedate` int(10) NOT NULL,
  `verify` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pre_finance_ratelog`
--

INSERT INTO `pre_finance_ratelog` (`id`, `cashid`, `customer`, `mobile`, `stype`, `money`, `rate`, `bankname`, `cardnum`, `dateline`, `remark`, `status`, `ratedate`, `verify`) VALUES
(3, 1, '徐力', '18687444499', 'cash', 100000.00, 2000.00, 'ccb', '6227077774444477', 1412755410, '10月融资利息', 1, 0, ''),
(2, 2, '李杰', '18687444499', 'card', 100000.00, 1000.00, 'icbc', '633333333333333', 1412179200, '10月融资利息', 0, 0, ''),
(4, 3, '张子栋', '18687444499', 'cash', 50000.00, 1000.00, 'pingan', '555555555555555555', 1412755512, '10月融资利息', 0, 0, ''),
(5, 4, '意大利', '15924907828', 'card', 70000.00, 1400.00, 'hxb', '622202554488778', 1412755512, '10月融资利息', 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `pre_finance_settle`
--

CREATE TABLE IF NOT EXISTS `pre_finance_settle` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `usable` float(10,2) NOT NULL DEFAULT '0.00',
  `freeze` float(10,2) NOT NULL DEFAULT '0.00',
  `dateline` int(10) NOT NULL,
  `verify` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pre_finance_settle`
--

INSERT INTO `pre_finance_settle` (`id`, `usable`, `freeze`, `dateline`, `verify`) VALUES
(1, 100000.00, 0.00, 1410000000, ''),
(2, 50000.00, 0.00, 1410000001, '');

-- --------------------------------------------------------

--
-- 表的结构 `pre_loan`
--

CREATE TABLE IF NOT EXISTS `pre_loan` (
  `id` smallint(8) NOT NULL AUTO_INCREMENT,
  `signid` varchar(16) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `money` float(10,2) NOT NULL DEFAULT '0.00',
  `rate` int(3) NOT NULL,
  `dateline` int(10) NOT NULL,
  `stype` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pre_loan`
--


-- --------------------------------------------------------

--
-- 表的结构 `pre_loan_car`
--

CREATE TABLE IF NOT EXISTS `pre_loan_car` (
  `id` smallint(8) NOT NULL AUTO_INCREMENT,
  `signid` varchar(16) NOT NULL,
  `paizhao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pre_loan_car`
--

