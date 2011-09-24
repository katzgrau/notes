/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50137
Source Host           : localhost:3306
Source Database       : notes

Target Server Type    : MYSQL
Target Server Version : 50137
File Encoding         : 65001

Date: 2010-03-25 08:55:29
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `account_types`
-- ----------------------------
DROP TABLE IF EXISTS `account_types`;
CREATE TABLE `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `renewal_deal_price` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account_types
-- ----------------------------
INSERT INTO `account_types` VALUES ('1', 'Individual', '23', '20', '2009-05-21 10:54:10', '2009-05-21 10:54:13');
INSERT INTO `account_types` VALUES ('2', 'Group', '29', '27', '2009-05-21 10:54:26', '2009-05-21 10:54:30');
INSERT INTO `account_types` VALUES ('3', 'Individual Trial', '0', '0', '2009-05-22 11:08:51', '2009-05-22 11:08:53');

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `signup_coupon_code` varchar(16) DEFAULT NULL,
  `starting_cost` double NOT NULL,
  `discount` float DEFAULT NULL,
  `payment_expiration` datetime NOT NULL,
  `comments` mediumtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_type_id` (`account_type_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `signup_coupon_id` (`signup_coupon_code`),
  CONSTRAINT `accounts_ibfk_4` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `accounts_ibfk_5` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `accounts_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------

-- ----------------------------
-- Table structure for `accounts_pending`
-- ----------------------------
DROP TABLE IF EXISTS `accounts_pending`;
CREATE TABLE `accounts_pending` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `coupon_code` varchar(16) NOT NULL,
  `purchase_price` float NOT NULL,
  `is_trial` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `coupon_id` (`coupon_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts_pending
-- ----------------------------

-- ----------------------------
-- Table structure for `coupons`
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `after_price` float NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_single_use` tinyint(1) NOT NULL,
  `is_trial` tinyint(1) NOT NULL,
  `sales_person` int(11) NOT NULL,
  `term_expiration` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `sales_person` (`sales_person`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of coupons
-- ----------------------------

-- ----------------------------
-- Table structure for `dictionary`
-- ----------------------------
DROP TABLE IF EXISTS `dictionary`;
CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `value` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dictionary
-- ----------------------------

-- ----------------------------
-- Table structure for `emails`
-- ----------------------------
DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(100) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of emails
-- ----------------------------

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `orig_name` varchar(120) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `file_type` varchar(40) NOT NULL,
  `file_size` int(11) NOT NULL,
  `is_image` tinyint(1) NOT NULL,
  `is_insertable_image` tinyint(1) NOT NULL,
  `height_px` int(11) NOT NULL,
  `width_px` int(11) NOT NULL,
  `to_be_processed` tinyint(1) NOT NULL DEFAULT '1',
  `is_stored_locally` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `files_ibfk_3` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE,
  CONSTRAINT `files_ibfk_4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'None', '', '2009-03-19 22:00:54', '2009-03-19 22:00:59');

-- ----------------------------
-- Table structure for `hits`
-- ----------------------------
DROP TABLE IF EXISTS `hits`;
CREATE TABLE `hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `hits_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of hits
-- ----------------------------
INSERT INTO `hits` VALUES ('1', '1', '160', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:05:01');
INSERT INTO `hits` VALUES ('2', '1', '160', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:05:30');
INSERT INTO `hits` VALUES ('3', '1', '160', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:05:42');
INSERT INTO `hits` VALUES ('4', '1', '160', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:07:26');
INSERT INTO `hits` VALUES ('5', '1', '160', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:08:40');
INSERT INTO `hits` VALUES ('6', '1', '161', 'f1fcff06fc49a267adb7a267c9434a30', '2010-03-16 20:08:43');
INSERT INTO `hits` VALUES ('7', '1', '160', '9d05f0482842cd7f933e1aa388ce3c53', '2010-03-16 20:46:25');
INSERT INTO `hits` VALUES ('8', '1', '160', '9d05f0482842cd7f933e1aa388ce3c53', '2010-03-16 20:46:26');
INSERT INTO `hits` VALUES ('9', '1', '161', '9d05f0482842cd7f933e1aa388ce3c53', '2010-03-16 20:46:28');
INSERT INTO `hits` VALUES ('10', '1', '161', '9d05f0482842cd7f933e1aa388ce3c53', '2010-03-16 20:46:28');
INSERT INTO `hits` VALUES ('11', '1', '160', '7dcd8e9956c806d6373e6eb831701256', '2010-03-17 08:36:58');
INSERT INTO `hits` VALUES ('12', '1', '161', '7dcd8e9956c806d6373e6eb831701256', '2010-03-17 08:37:03');
INSERT INTO `hits` VALUES ('13', '1', '160', '894d7034265c5dafba2562401b46721c', '2010-03-25 08:41:59');

-- ----------------------------
-- Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `list_priority` int(11) NOT NULL DEFAULT '128',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_priority` (`list_priority`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `links_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `page_title` varchar(50) NOT NULL,
  `page_slug` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `list_priority` int(11) NOT NULL DEFAULT '128',
  `is_draft` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_slug` (`page_slug`),
  KEY `published` (`published`),
  KEY `site_id` (`site_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('160', '1', '0', 'Home', 'home', '<p>Welcome to <Site Name> for Thomas Jefferson Elementary School!</p><p>This is your website\'s default text. You can edit this however you would like!</p>', '128', '0', '1', '2010-03-16 20:04:49', '2010-03-16 20:04:49');
INSERT INTO `pages` VALUES ('161', '1', '0', 'A cool new page!', 'a-cool-new-page', '<p>=D</p>', '128', '0', '1', '2010-03-16 20:08:30', '2010-03-16 20:08:38');

-- ----------------------------
-- Table structure for `payment_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `payment_notifications`;
CREATE TABLE `payment_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(45) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `purchase_price` float NOT NULL,
  `content` text NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `sender_ip` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `preferences`
-- ----------------------------
DROP TABLE IF EXISTS `preferences`;
CREATE TABLE `preferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of preferences
-- ----------------------------

-- ----------------------------
-- Table structure for `renews_pending`
-- ----------------------------
DROP TABLE IF EXISTS `renews_pending`;
CREATE TABLE `renews_pending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  `coupon_code` varchar(16) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`),
  CONSTRAINT `renews_pending_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of renews_pending
-- ----------------------------

-- ----------------------------
-- Table structure for `sales_persons`
-- ----------------------------
DROP TABLE IF EXISTS `sales_persons`;
CREATE TABLE `sales_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_persons
-- ----------------------------
INSERT INTO `sales_persons` VALUES ('1', 'admin', 'admin', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `sites`
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `theme_id` int(11) NOT NULL DEFAULT '1',
  `display_name` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_name` (`site_name`),
  KEY `user_id` (`user_id`),
  KEY `theme_id` (`theme_id`),
  CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sites_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('1', '1', 'plumber', 'password', '10', 'plumber', '2010-03-16 20:04:49', '2010-03-16 20:04:49');

-- ----------------------------
-- Table structure for `themes`
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(200) NOT NULL,
  `list_priority` int(11) NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of themes
-- ----------------------------
INSERT INTO `themes` VALUES ('1', 'mighty', 'Mighty', 'A simple, general theme emphasizing simple tones of green, gray, and black.', 'simple, general, green, teacher, writer', '100', '1', '2009-03-20 12:52:47', '2009-03-20 12:52:51');
INSERT INTO `themes` VALUES ('2', 'liquid-01', 'Greenboard', 'A clean cut theme which is green, gray, and black, and provides a professional look and feel.', 'professional, green, board, general, blog', '90', '1', '2009-03-25 11:22:05', '2009-03-25 11:22:08');
INSERT INTO `themes` VALUES ('3', 'cleanblog', 'Clean', 'A clean, professional-looking theme with soft gray and earth tones. It has a resume or portfolio-like layout.', 'resume, portfolio, grey, professional', '80', '1', '2009-04-18 20:22:58', '2009-04-18 20:22:58');
INSERT INTO `themes` VALUES ('4', 'coolwater', 'Cool Water', 'A theme a little more on the fun side. Emphasizes blues, greens, and bold fonts. This works nicely for younger audiences.', '', '70', '1', '2009-04-18 20:22:58', '2009-04-18 20:22:58');
INSERT INTO `themes` VALUES ('6', 'nautica', 'Office', 'A simple theme oriented towards older, student-like audiences. It has a school-like look and feel, reminiscent of a collegiate setting.', 'school, college, professor, professional, blue', '60', '1', '2009-04-18 20:23:51', '2009-04-18 20:23:51');
INSERT INTO `themes` VALUES ('7', 'vectorlover', 'Vector', 'A fun theme with an artsy and young feel to it. It primarily uses earth tones of green and brown, and uses them well.', 'young, vector, fun, art, green', '40', '1', '2009-04-20 10:26:34', '2009-04-20 10:26:34');
INSERT INTO `themes` VALUES ('8', 'techjunkie', 'Suave', 'A clean, blue theme which has a very modern feel to it. It is general purpose, and works well for both young and older audiences.', 'suave, blue, cool', '30', '1', '2009-04-20 20:41:52', '2009-04-20 20:41:52');
INSERT INTO `themes` VALUES ('9', 'outdoor', 'Outdoor', 'A rustic-yet-modern design with an clean, outdoor feel.', 'brown, green, outdoor, rustic, wood, wooded', '20', '1', '2009-04-20 20:41:52', '2009-04-20 20:41:52');
INSERT INTO `themes` VALUES ('10', 'naturalessence', 'Natural Essence', 'A modern, and beautiful design with aspects of both function and simplicity. It\'s primary color is a shade of brown, accented with gray.', 'brown, flower, modern', '15', '1', '2009-04-21 13:11:48', '2009-04-21 13:11:48');
INSERT INTO `themes` VALUES ('11', 'pluralism', 'Undercurrent', 'A clean design with light gray, blue, and light blue used with perfection.', 'blue, light blue, general, basic, simple', '65', '1', '2009-04-21 13:11:48', '2009-04-21 13:11:48');
INSERT INTO `themes` VALUES ('12', 'terrafirma', 'Academic', 'A basic theme that seems to throw you right into the library. Uses brown and orange, with imagery of books to create an intellectual and academic feel.', 'school, library, academia, academic, professor, books, brown, orange', '45', '1', '2009-04-21 13:12:53', '2009-04-21 13:12:53');
INSERT INTO `themes` VALUES ('13', 'zenlike', 'Zen', 'A beautiful theme with greens, blacks, a wooded background, and an overall sense of peace. It displays a blend of modernism, and oriental culture.', 'oriental, modern, zen, peace', '25', '1', '2009-04-21 13:12:53', '2009-04-21 13:12:53');
INSERT INTO `themes` VALUES ('14', 'antique', 'Antique', 'A clean theme using light blues and copper tones to give a lively, but professional look. It seems to orient itself towards writers, those with online portfolios.', 'english, general, writing, portfolio, orange, copper, red', '30', '1', '2009-07-21 16:58:00', '2009-07-21 16:58:07');
INSERT INTO `themes` VALUES ('15', 'bluespring', 'Blue Spring', 'A modern, slick theme using neon blues and dark grays to send a new-age feel.', 'dark, science, latin, language', '50', '1', '2009-07-21 16:58:59', '2009-07-21 16:59:07');
INSERT INTO `themes` VALUES ('16', 'hobbit', 'Hobbit', 'A literature-oriented design with a focus on classic or medieval literature.', 'writing, english, literature, medieval, hobbit', '28', '1', '2009-07-21 17:00:04', '2009-07-21 17:00:04');
INSERT INTO `themes` VALUES ('17', 'inf08', 'Windoe', 'A clean blue theme which provides a feel of school, work, office environments, and portfolios. It has both functional and elegant design.', 'school, office, blue, clean, functional, function', '9', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `themes` VALUES ('18', 'metamorphsunrise', 'Sunrise', 'A red-orange theme with images of an eastern sunrise over the ocean. It invokes feelings of peace, relaxation, and warmth.', 'sun, morning, evening, dusk, sunset', '43', '1', '2009-07-21 17:01:17', '2009-07-21 17:01:17');
INSERT INTO `themes` VALUES ('19', 'metamorphwp', 'Writer', 'A blog-like theme which seems to invoke the image of hard work, organization, and a fast-paced lifestyle.', 'writer', '28', '1', '2009-07-21 17:01:17', '2009-07-21 17:01:17');
INSERT INTO `themes` VALUES ('20', 'nautica05', 'Sea & Sky', 'A clean and light design which focuses on the air, clouds, and sky.', 'nautica, water, ocean, blue, air, sky', '8', '1', '2009-07-21 17:02:51', '2009-07-21 17:02:51');
INSERT INTO `themes` VALUES ('21', 'nonzero_blue', 'Newstyle Blue', 'A modern web-2.0-esque design in blue.', 'blue, shiny, web, 2.0, web 2.0, new,age', '12', '1', '2009-07-21 17:02:51', '2009-07-21 17:02:51');
INSERT INTO `themes` VALUES ('22', 'nonzero_green', 'Newstyle Green', 'A modern web-2.0-esque design in green.', 'green, shiny, web, 2.0, web 2.0, new,age', '13', '1', '2009-07-21 17:04:04', '2009-07-21 17:04:04');
INSERT INTO `themes` VALUES ('23', 'nonzero_magenta', 'Newstyle Magenta', 'A modern web-2.0-esque design in magenta.', 'magenta, shiny, web, 2.0, web 2.0, new,age', '14', '1', '2009-07-21 17:04:04', '2009-07-21 17:04:04');
INSERT INTO `themes` VALUES ('24', 'nonzero_red', 'Newstyle Red', 'A modern web-2.0-esque design in red.', 'red, shiny, web, 2.0, web 2.0, new,age', '15', '1', '2009-07-21 17:05:02', '2009-07-21 17:05:02');
INSERT INTO `themes` VALUES ('25', 'pointspace', 'Point / Counterpoint', 'A dark, but professional theme with a pinch of grays and glitter.', 'grays, glitter, red, magenta', '23', '1', '2009-07-21 17:05:02', '2009-07-21 17:05:02');
INSERT INTO `themes` VALUES ('26', 'port_blue', 'Classic Blue', 'A simple blue theme with a modern feel. Evokes the look and feel of a blog.', 'simple, classic, blue', '27', '1', '2009-07-21 17:05:48', '2009-07-21 17:05:48');
INSERT INTO `themes` VALUES ('27', 'port_green', 'Classic Green', 'A simple green theme with a modern feel. Evokes the look and feel of a blog.', 'simple, classic, blue', '28', '1', '2009-07-21 17:05:48', '2009-07-21 17:05:48');
INSERT INTO `themes` VALUES ('28', 'summer', 'Summer Day', 'A design which provides the freshness of a summer day at the beach.  Soft yellows and light blues combine to create crisp, and beautiful look.', 'summer, yellow, blue, fresh, crisp', '11', '1', '2009-07-21 17:06:38', '2009-07-21 17:06:38');
INSERT INTO `themes` VALUES ('29', 'summerbreeze', 'Late Summer Breeze', 'A crisp, fresh-feeling theme, reminiscent of cool summer mornings and lazy days at the beach.', 'summer, blue, fresh, crisp', '11', '1', '2009-07-21 17:06:38', '2009-07-21 17:06:38');
INSERT INTO `themes` VALUES ('30', 'redmusic', 'Rocker', 'A cool theme geared up for a more fun, go-wild feel. Features reds and oranges, with the silhouetted imagery of a band rocking out.', 'Red, orange, rock, roll, band, music, songs', '29', '1', '2009-07-21 17:07:21', '2009-07-21 17:07:21');
INSERT INTO `themes` VALUES ('31', 'metamorphhills', 'Green Slopes', 'A green theme with images of long, rolling hills. Provides a feeling of fresh, airiness that can only be found in the countryside.', 'green, hills, golf, air, fresh, grass, trees, outdoor', '32', '1', '2009-07-21 17:07:21', '2009-07-21 17:07:21');
INSERT INTO `themes` VALUES ('32', 'metamorphenergy', 'Energy Bolt', 'A dark, but energy-filled theme screaming science and physics.', 'science, physics, math, energy, light, atom, nuclear, nucleus, particle', '67', '1', '2009-07-21 17:08:20', '2009-07-21 17:08:20');
INSERT INTO `themes` VALUES ('33', 'metamorphearth', 'The Blue Marble', 'A theme with the famed astronaut-taken picture, \"The Blue Marble\" in the background.', '', '68', '1', '2009-07-21 17:08:20', '2009-07-21 17:08:20');

-- ----------------------------
-- Table structure for `user_themes`
-- ----------------------------
DROP TABLE IF EXISTS `user_themes`;
CREATE TABLE `user_themes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ut_user` (`user_id`),
  KEY `fk_ut_theme` (`theme_id`),
  CONSTRAINT `fk_ut_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ut_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_themes
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'Kenny', 'plumber', null, null, null, null, null, null, 'plumber@gmail.com', null, '2010-03-16 20:04:49', '2010-03-16 20:04:49');
