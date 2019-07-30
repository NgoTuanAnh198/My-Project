/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_news

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-07-29 23:30:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `role_id` tinyint(4) DEFAULT NULL COMMENT 'Admin này có quyền gì',
  `username` varchar(255) NOT NULL COMMENT 'Tài khoản đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu đăng nhập, được lưu dạng md5',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo admin, sinh tự động theo thời gian hiện tại',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2019-07-29 08:09:01');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `name` varchar(255) DEFAULT NULL COMMENT 'Tên danh mục',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện cho danh mục',
  `description` text COMMENT 'Mô tả thêm cho danh mục',
  `status` tinyint(3) DEFAULT '0' COMMENT 'Trạng thái danh mục: 0 - disabled, 1 - active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo danh mục, sinh tự động theo thời gian hiện tại',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Tivi', '', '<p>tivi</p>\r\n\r\n<p>&nbsp;</p>\r\n', '1', '2019-07-29 21:30:59');
INSERT INTO `categories` VALUES ('2', 'Điều hòa', '', '<p>điều h&ograve;a</p>\r\n', '1', '2019-07-29 21:31:06');
INSERT INTO `categories` VALUES ('3', 'Tủ lạnh', '', '<p>tủ lạnh</p>\r\n', '1', '2019-07-29 21:31:13');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `title` varchar(255) NOT NULL COMMENT 'Tên bài viết',
  `category_id` int(11) DEFAULT NULL COMMENT 'Bài việc thuộc danh mục nào',
  `admin_id` int(11) DEFAULT NULL COMMENT 'Bài viết do admin nào tạo',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện của bài viết',
  `summary` varchar(500) DEFAULT NULL COMMENT 'Mô tả ngắn cho bài viết',
  `content` text COMMENT 'Nội dung chi tiết bài viết',
  `comment_total` int(11) DEFAULT '0' COMMENT 'Tổng số bình luận cho bài viết',
  `like_total` int(11) DEFAULT '0' COMMENT 'Tổng số like của bài viết',
  `view` int(11) DEFAULT NULL COMMENT 'Tổng số lượt xem bài viết',
  `status` tinyint(3) DEFAULT '0' COMMENT 'Trạng thái bài viết, nhận 2 giá trị sau: 0 - Disabled, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo bài viết, tự động sinh theo thời gian hiện tại',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', 'Remove expired log messages and flood control events', '1', '1', 'news-1564412949member.jpg', '12112121', '<p>2121</p>\r\n', '121', '2121', null, '1', '2019-07-29 08:19:20');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính, đồng thời là mã đơn hàng',
  `product_id` int(11) NOT NULL COMMENT 'order này chứa các sản phẩm nào',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'họ tên người mua hàng',
  `address` varchar(255) DEFAULT NULL COMMENT 'địa chỉ người mua hàng',
  `mobile` int(11) DEFAULT NULL COMMENT 'sđt người mua hàng',
  `payment_status` tinyint(4) DEFAULT NULL COMMENT 'trạng thái thanh toán: 0 - chưa thành toán, 1 - đã thanh toán',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'thời điểm tạo đơn',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT 'Mã đơn hàng, hay chính là id của đơn hàng',
  `product_id` int(11) NOT NULL COMMENT 'id sản phẩm đang thuộc về đơn hàng',
  `quanlity` int(11) DEFAULT '0' COMMENT 'Số lượng sản phẩm đang có trong đơn hàng',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_details
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `category_id` int(11) DEFAULT NULL COMMENT 'sản phẩm thuộc về danh mục nào',
  `admin_id` int(11) DEFAULT NULL COMMENT 'sản phẩm này do admin nào tạo',
  `name` varchar(255) DEFAULT NULL COMMENT 'tên sản phẩm',
  `price` int(11) DEFAULT NULL COMMENT 'giá sản phẩm',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'ảnh đại diện',
  `summary` varchar(255) DEFAULT NULL COMMENT 'mô tả ngắn cho sản phẩm',
  `content` text COMMENT 'mô tả chi tiết sản phẩm',
  `status` tinyint(3) DEFAULT NULL COMMENT 'trạng thái sản phẩm: 0 - Disabled, 1 - Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo sản phẩm',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '1', '12121', '1211212121', 'products-1564411078member.jpg', '121', '<p>12121</p>\r\n', '1', '2019-07-29 21:37:58');
INSERT INTO `products` VALUES ('2', '2', '1', '121', '121', '', '121', '<p>12121</p>\r\n', '1', '2019-07-29 21:39:26');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `name` varchar(255) NOT NULL COMMENT 'Tên quyền, ví dụ: Admin, Content, Editor ...',
  `description` varchar(255) DEFAULT NULL COMMENT 'Mô tả chi tiết cho quyền',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for slides
-- ----------------------------
DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `news_id` int(11) DEFAULT NULL COMMENT 'Slide gắn với bài viết nào',
  `image` varchar(255) DEFAULT NULL COMMENT 'Ảnh slide',
  `position` int(11) DEFAULT '0' COMMENT 'Ví trí hiển thị của slide',
  `status` tinyint(3) DEFAULT '0' COMMENT 'Trạng thái, nhận 2 giá trị: 0 - Disabled, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo slide, tự động sinh theo thời gian hiện tại',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of slides
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính',
  `email` varchar(255) NOT NULL COMMENT 'Email user, đồng thời là tài khoản đăng nhập',
  `password` varchar(255) DEFAULT NULL COMMENT 'Mật khẩu, lưu dưới dạng md5',
  `first_name` varchar(255) DEFAULT NULL COMMENT 'Tên đầu của user',
  `last_name` varchar(255) DEFAULT NULL COMMENT 'Tên cuối của user',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện',
  `job_name` varchar(255) DEFAULT NULL COMMENT 'Nghề nghiệp ',
  `status` tinyint(3) DEFAULT '0' COMMENT 'Trạng thái, nhận 2 giá trị: 0 - Disabled, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo, tự động sinh theo thời gian hiện tại',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
