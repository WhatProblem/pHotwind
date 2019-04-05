-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-03-12 13:54:57
-- 服务器版本： 5.7.23
-- PHP 版本： 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `hotwind`
--

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `picurl` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '点击banner导航到的部分'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`picurl`, `tourl`) VALUES
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/banner/banner_1.jpg', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/banner/banner_2.jpg', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/banner/banner_3.jpg', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/banner/banner_4.jpg', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/banner/banner_5.jpg', 'goodsList');

-- --------------------------------------------------------

--
-- 表的结构 `fashion`
--

DROP TABLE IF EXISTS `fashion`;
CREATE TABLE IF NOT EXISTS `fashion` (
  `fashion_title` varchar(255) DEFAULT NULL COMMENT '流行 标题，例如：流行 时尚',
  `fashion_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0：流行时尚，1：流行时尚下面的部分',
  `picurl` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '导航地址',
  `pic_position` varchar(50) NOT NULL COMMENT '图片位置'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fashion`
--

INSERT INTO `fashion` (`fashion_title`, `fashion_type`, `picurl`, `tourl`, `pic_position`) VALUES
('流行 时尚', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/fashion_1.jpg', 'goodsList', 'left_top'),
('流行 时尚', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/fashion_3.jpg', 'goodsList', 'right_top'),
('流行 时尚', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/fashion_2.jpg', 'goodsList', 'left_bottom'),
('流行 时尚', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/fashion_4.jpg', 'goodsList', 'right_bottom'),
('', 1, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/combine_1.jpg', 'goodsList', 'left'),
('', 1, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/fashion/combine_2.jpg', 'goodsList', 'right');

-- --------------------------------------------------------

--
-- 表的结构 `footer`
--

DROP TABLE IF EXISTS `footer`;
CREATE TABLE IF NOT EXISTS `footer` (
  `footer_navid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '页面底部分类导航id',
  `picurl` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `tourl` varchar(100) NOT NULL COMMENT '导航地址',
  PRIMARY KEY (`footer_navid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `footer`
--

INSERT INTO `footer` (`footer_navid`, `picurl`, `tourl`) VALUES
(1, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/footer/footer_1.jpg', 'goodsList'),
(2, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/footer/footer_2.jpg', 'goodsList'),
(3, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/footer/footer_3.jpg', 'goodsList');

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id，第一无二的标识',
  `type_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品类型，例如:0女装，1:男装',
  `category_type` int(10) UNSIGNED NOT NULL COMMENT '商品具体类型，例如：男装：０：男卫衣，1：男夹克，2：男T恤，3：男衬衫，4：男休闲裤，5：男牛仔裤，6：男鞋品类，7：男士内裤\r\n女装：0：卫衣，1：外套，2：休闲裤，3：牛仔裤，4：内衣，5：美妆护肤，6：女鞋品类，7：潮流女包',
  `barcode` varchar(30) NOT NULL COMMENT '每种商品条码',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称，例如：春季是上男T恤',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_color` varchar(20) NOT NULL COMMENT '商品颜色',
  `goods_discount` decimal(10,2) DEFAULT NULL COMMENT '商品折后价',
  `onsale_remind` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '降价提醒，默认0：关闭提醒，1：打开提醒',
  `onsale_info` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '默认没有促销信息，0：没有促销信息，1：有立减，2：包邮，3：立减和包邮',
  `cut_now` varchar(255) DEFAULT NULL COMMENT '立减信息，由onsale_info决定',
  `mail_free` varchar(255) DEFAULT NULL COMMENT '包邮信息，由onsale_info决定',
  `isfav` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收藏当前商品，默认0：不收藏',
  `isnew` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否是新品，默认0：不是',
  `picurl` varchar(255) DEFAULT NULL COMMENT '商品展示图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '导航地址',
  `sale_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销类型，0：没有任何活动，1：打折，2：店铺促销，3：优惠福利，4：商城热销款',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `type_id`, `category_type`, `barcode`, `goods_name`, `goods_price`, `goods_color`, `goods_discount`, `onsale_remind`, `onsale_info`, `cut_now`, `mail_free`, `isfav`, `isnew`, `picurl`, `tourl`, `sale_type`) VALUES
(1, 1, 0, 'ht000001', '三福2019春装新品男撞色卫衣 胸前字母刺绣上衣男395192', '139.00', '红色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_1.jpg', 'goodsList', 4),
(2, 1, 3, 'ht000002', '三福2019春装新品男学院风牛津纺衬衫 文艺方领衬衣男394321', '119.00', '白色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_2.jpg', 'goodsList', 4),
(3, 1, 1, 'ht000003', '三福2019春装新品男学院风牛津纺衬衫 文艺方领衬衣男394321', '259.00', '黑色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_3.jpg', 'goodsList', 4),
(4, 0, 0, 'ht000004', '三福2019春装新品女印花连帽卫衣 休闲宽松长袖上衣女395541', '139.00', '黄色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_4.jpg', 'goodsList', 4),
(5, 0, 1, 'ht000005', '三福2019春装新品女后背刺绣牛仔外套 飘带挂饰夹克女773414', '339.00', '蓝色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_5.jpg', 'goodsList', 4),
(6, 0, 0, 'ht000006', '三福2019春装新品女小高领长袖T恤 莫代尔简约印花上衣女395128', '69.00', '白色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_6.jpg', 'goodsList', 4),
(7, 0, 6, 'ht000007', '三福2019女春学生韩版复古撞色线低帮帆布鞋休闲女鞋773045', '69.00', '黄色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_7.jpg', 'goodsList', 4),
(8, 0, 6, 'ht000008', '三福2019女春学院风撞色鞋底简约系带学生板鞋休闲女鞋773111', '79.00', '白色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_8.jpg', 'goodsList', 4),
(9, 0, 6, 'ht000009', '三福2019女春韩版潮流高帮帆布鞋学生运动休闲板鞋女鞋772894', '69.00', '黑色', NULL, 0, 1, '鞋包爆款满300-30', '', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/hotSale_9.jpg', 'goodsList', 4),
(10, 0, 0, 'ht0000010', '三福2019春装新品女人物印花卫衣 宽松圆领长袖上衣女', '159.00', '蓝色', NULL, 0, 3, '新品专区2件88折', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/girl_0_3.jpg', 'goodsList', 1),
(11, 0, 0, 'ht0000011', '三福2019春装新品女卫衣网纱裙两件套 休闲连衣裙套装女', '219.00', '白色', NULL, 0, 3, '新品专区2件88折', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/girl_0_4.jpg', 'goodsList', 1),
(12, 0, 0, 'ht0000012', '三福2019春装新品女抽绳印花卫衣 休闲宽松长袖上衣女', '119.00', '粉红色', NULL, 0, 3, '新品专区2件88折', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/girl_0_5.jpg', 'goodsList', 1),
(13, 0, 0, 'ht0000013', '三福2019夏装新品女宽松印花卫衣 休闲圆领长袖上衣女', '99.00', '灰色', NULL, 0, 2, '', '全场满99包邮', 0, 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/goods/girl_0_6.jpg', 'goodsList', 2);

-- --------------------------------------------------------

--
-- 表的结构 `saletype`
--

DROP TABLE IF EXISTS `saletype`;
CREATE TABLE IF NOT EXISTS `saletype` (
  `sale_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销类型，0：没有任何活动，1：打折，2：店铺促销，3：优惠福利，4：商城热销款',
  `sale_name` varchar(100) DEFAULT NULL COMMENT '促销名称',
  `sale_type_order` int(10) UNSIGNED NOT NULL COMMENT '促销类型排序',
  `picurl` varchar(255) DEFAULT NULL COMMENT '促销图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '导航地址'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `saletype`
--

INSERT INTO `saletype` (`sale_type`, `sale_name`, `sale_type_order`, `picurl`, `tourl`) VALUES
(2, '店铺促销', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/left.jpg', 'goodsList'),
(2, '店铺促销', 1, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/r_bot.jpg', 'goodsList'),
(2, '店铺促销', 2, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/r_top.jpg', 'goodsList'),
(1, '两件8.8折', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/region_2.jpg', 'goodsList'),
(1, '两件8.8折', 2, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/region_3.jpg', 'goodsList'),
(1, '两件8.8折', 1, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/region_1.jpg', 'goodsList'),
(3, '优惠福利', 0, 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/saletype/welfare.jpg', 'goodsList');

-- --------------------------------------------------------

--
-- 表的结构 `sorts`
--

DROP TABLE IF EXISTS `sorts`;
CREATE TABLE IF NOT EXISTS `sorts` (
  `sort_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '男装还是女装区别，0：默认女装',
  `sort_title` varchar(100) NOT NULL COMMENT '分类大标题',
  `picurl` varchar(255) DEFAULT NULL COMMENT '分类部分图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '类标题导航的部分',
  `sort_navid` int(10) UNSIGNED DEFAULT NULL COMMENT '分类导航的id：\r\n商品具体类型，例如：男装：０：男卫衣，1：男夹克，2：男T恤，3：男衬衫，4：男休闲裤，5：男牛仔裤，6：男鞋品类，7：男士内裤\r\n女装：0：卫衣，1：外套，2：休闲裤，3：牛仔裤，4：内衣，5：美妆护肤，6：女鞋品类，7：潮流女包',
  `sort_name` varchar(50) DEFAULT NULL COMMENT '分类导航的名称，例如：卫衣'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sorts`
--

INSERT INTO `sorts` (`sort_type`, `sort_title`, `picurl`, `tourl`, `sort_navid`, `sort_name`) VALUES
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_1.jpg', 'goodsList', 0, '卫衣'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_2.jpg', 'goodsList', 1, '外套'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_3.jpg', 'goodsList', 2, '休闲裤'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_4.jpg', 'goodsLIst', 3, '牛仔裤'),
(0, 'Girls热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_5.jpg', 'goodsList', 4, '文胸'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_6.jpg', 'goodsList', 5, '美妆护肤'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_7.jpg', 'goodsList', 6, '女鞋品类'),
(0, 'Girls-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/girl_sort_8.jpg', 'goodsList', 7, '潮流女包'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_1.jpg', 'goodsList', 0, '卫衣'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_2.jpg', 'goodsList', 1, '夹克'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_3.jpg', 'goodsList', 2, 'T恤'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_4.jpg', 'goodsLIst', 3, '衬衫'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_5.jpg', 'goodsList', 4, '休闲裤'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_6.jpg', 'goodsList', 5, '牛仔裤'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_7.jpg', 'goodsList', 6, '男鞋品类'),
(1, 'Boys-热门分类', 'http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/sortTitle/boy_sort_8.jpg', 'goodsList', 7, '男士内裤');

-- --------------------------------------------------------

--
-- 表的结构 `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `picurl` varchar(255) DEFAULT NULL COMMENT '主体部分图片地址',
  `tourl` varchar(50) NOT NULL COMMENT '点击主体部分导航的地址'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`picurl`, `tourl`) VALUES
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/theme/theme_1.png', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/theme/theme_2.png', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/theme/theme_3.png', 'goodsList'),
('http://whatproblem.xg1haodfed.zhihuanche.cn/public/img/theme/theme_4.png', 'goodsList');

-- --------------------------------------------------------

--
-- 表的结构 `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '评论区商品id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '评论区用户id',
  `goods_name` varchar(30) NOT NULL COMMENT '评论区商品名称',
  `goods_barcode` varchar(30) NOT NULL COMMENT '评论区商品barcode条码',
  `user_name` varchar(50) NOT NULL COMMENT '评论区用户名称',
  `comment` varchar(255) DEFAULT NULL COMMENT '评论内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id:唯一标识',
  `user_name` varchar(50) NOT NULL COMMENT '用户名称',
  `user_pwd` varchar(20) NOT NULL COMMENT '用户密码',
  `buy_id` int(10) UNSIGNED DEFAULT NULL COMMENT '购买过商品的id',
  `buy_barcode` varchar(30) DEFAULT NULL COMMENT '购买过商品的barcode',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
