-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2009 at 11:39 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL auto_increment,
  `account_type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `signup_coupon_code` varchar(16) default NULL,
  `starting_cost` double NOT NULL,
  `discount` float default NULL,
  `payment_expiration` datetime NOT NULL,
  `comments` mediumtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `account_type_id` (`account_type_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `signup_coupon_id` (`signup_coupon_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_pending`
--

CREATE TABLE `accounts_pending` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `site_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `coupon_code` varchar(16) NOT NULL,
  `purchase_price` float NOT NULL,
  `is_trial` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  USING BTREE (`id`),
  KEY `coupon_id` (`coupon_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accounts_pending`
--


-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `renewal_deal_price` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `price`, `renewal_deal_price`, `created`, `modified`) VALUES
(1, 'Individual', 23, 20, '2009-05-21 10:54:10', '2009-05-21 10:54:13'),
(2, 'Group', 29, 27, '2009-05-21 10:54:26', '2009-05-21 10:54:30'),
(3, 'Individual Trial', 0, 0, '2009-05-22 11:08:51', '2009-05-22 11:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(45) NOT NULL,
  `after_price` float NOT NULL,
  `comment` varchar(200) default NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_single_use` tinyint(1) NOT NULL,
  `is_trial` tinyint(1) NOT NULL,
  `sales_person` int(11) NOT NULL,
  `term_expiration` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `sales_person` (`sales_person`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `coupons`
--

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `value` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dictionary`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL auto_increment,
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
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `site_id` (`site_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `files`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `details` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `details`, `created`, `modified`) VALUES
(1, 'None', '', '2009-03-19 22:00:54', '2009-03-19 22:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL auto_increment,
  `site_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `list_priority` int(11) NOT NULL default '128',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `list_priority` (`list_priority`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `links`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL auto_increment,
  `site_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL default '0',
  `page_title` varchar(50) NOT NULL,
  `page_slug` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `list_priority` int(11) NOT NULL default '128',
  `is_draft` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `page_slug` (`page_slug`),
  KEY `published` (`published`),
  KEY `site_id` (`site_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `pages`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_templates`
--

CREATE TABLE `page_templates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `display_name` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `list_priority` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `list_priority` (`list_priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `page_templates`
--

INSERT INTO `page_templates` (`id`, `name`, `display_name`, `description`, `list_priority`, `created`) VALUES
(1, 'contact-information', 'Contact Information', 'A table of contact information', 1, '2009-07-13 14:27:11'),
(2, '7-day-weekly-calendar', '7 day Weekly Calendar', 'A calendar grid of seven days of the week, allowing the user to input events and information for those days', 4, '2009-07-13 14:27:16'),
(3, 'office-hours', 'Office Hours', 'A table for displaying office hours', 2, '2009-07-13 14:29:00'),
(4, 'monthly-calendar', 'Monthly Calendar', 'A calendar for this month', 5, '2009-07-13 15:09:18'),
(5, '5-day-weekly-calendar', '5 Day week Calendar', 'A calendar grid of Monday through Friday, allowing users to input events or content in each of those days', 3, '2009-07-13 16:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `payment_notifications`
--

CREATE TABLE `payment_notifications` (
  `id` int(11) NOT NULL auto_increment,
  `site_name` varchar(45) default NULL,
  `account_id` int(11) default NULL,
  `purchase_price` float NOT NULL,
  `content` text NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `sender_ip` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `user_id`, `name`, `value`, `created`, `modified`) VALUES
(1, 16, 'show_intro_message', '0', '2009-09-01 13:41:29', '2009-09-01 13:41:29'),
(2, 16, 'tooltips_on', '1', '2009-09-01 13:41:30', '2009-09-01 13:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `renews_pending`
--

CREATE TABLE `renews_pending` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  `coupon_code` varchar(16) default NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `renews_pending`
--

INSERT INTO `renews_pending` (`id`, `account_id`, `purchase_price`, `coupon_code`, `created`) VALUES
(1, 18, 20, '', '2009-09-09 23:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `sales_persons`
--

CREATE TABLE `sales_persons` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sales_persons`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `theme_id` int(11) NOT NULL default '1',
  `display_name` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `site_name` (`site_name`),
  KEY `user_id` (`user_id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sites`
--

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL auto_increment,
  `theme_name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(200) NOT NULL,
  `list_priority` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `theme_name`, `display_name`, `description`, `tags`, `list_priority`, `created`, `modified`) VALUES
(1, 'mighty', 'Mighty', 'A simple, general theme emphasizing simple tones of green, gray, and black.', 'simple, general, green, teacher, writer', 100, '2009-03-20 12:52:47', '2009-03-20 12:52:51'),
(2, 'liquid-01', 'Greenboard', 'A clean cut theme which is green, gray, and black, and provides a professional look and feel.', 'professional, green, board, general, blog', 90, '2009-03-25 11:22:05', '2009-03-25 11:22:08'),
(3, 'cleanblog', 'Clean', 'A clean, professional-looking theme with soft gray and earth tones. It has a resume or portfolio-like layout.', 'resume, portfolio, grey, professional', 80, '2009-04-18 20:22:58', '2009-04-18 20:22:58'),
(4, 'coolwater', 'Cool Water', 'A theme a little more on the fun side. Emphasizes blues, greens, and bold fonts. This works nicely for younger audiences.', '', 70, '2009-04-18 20:22:58', '2009-04-18 20:22:58'),
(6, 'nautica', 'Office', 'A simple theme oriented towards older, student-like audiences. It has a school-like look and feel, reminiscent of a collegiate setting.', 'school, college, professor, professional, blue', 60, '2009-04-18 20:23:51', '2009-04-18 20:23:51'),
(7, 'vectorlover', 'Vector', 'A fun theme with an artsy and young feel to it. It primarily uses earth tones of green and brown, and uses them well.', 'young, vector, fun, art, green', 40, '2009-04-20 10:26:34', '2009-04-20 10:26:34'),
(8, 'techjunkie', 'Suave', 'A clean, blue theme which has a very modern feel to it. It is general purpose, and works well for both young and older audiences.', 'suave, blue, cool', 30, '2009-04-20 20:41:52', '2009-04-20 20:41:52'),
(9, 'outdoor', 'Outdoor', 'A rustic-yet-modern design with an clean, outdoor feel.', 'brown, green, outdoor, rustic, wood, wooded', 20, '2009-04-20 20:41:52', '2009-04-20 20:41:52'),
(10, 'naturalessence', 'Natural Essence', 'A modern, and beautiful design with aspects of both function and simplicity. It''s primary color is a shade of brown, accented with gray.', 'brown, flower, modern', 15, '2009-04-21 13:11:48', '2009-04-21 13:11:48'),
(11, 'pluralism', 'Undercurrent', 'A clean design with light gray, blue, and light blue used with perfection.', 'blue, light blue, general, basic, simple', 65, '2009-04-21 13:11:48', '2009-04-21 13:11:48'),
(12, 'terrafirma', 'Academic', 'A basic theme that seems to throw you right into the library. Uses brown and orange, with imagery of books to create an intellectual and academic feel.', 'school, library, academia, academic, professor, books, brown, orange', 45, '2009-04-21 13:12:53', '2009-04-21 13:12:53'),
(13, 'zenlike', 'Zen', 'A beautiful theme with greens, blacks, a wooded background, and an overall sense of peace. It displays a blend of modernism, and oriental culture.', 'oriental, modern, zen, peace', 25, '2009-04-21 13:12:53', '2009-04-21 13:12:53'),
(14, 'antique', 'Antique', 'A clean theme using light blues and copper tones to give a lively, but professional look. It seems to orient itself towards writers, those with online portfolios.', 'english, general, writing, portfolio, orange, copper, red', 30, '2009-07-21 16:58:00', '2009-07-21 16:58:07'),
(15, 'bluespring', 'Blue Spring', 'A modern, slick theme using neon blues and dark grays to send a new-age feel.', 'dark, science, latin, language', 50, '2009-07-21 16:58:59', '2009-07-21 16:59:07'),
(16, 'hobbit', 'Hobbit', 'A literature-oriented design with a focus on classic or medieval literature.', 'writing, english, literature, medieval, hobbit', 28, '2009-07-21 17:00:04', '2009-07-21 17:00:04'),
(17, 'inf08', 'Windoe', 'A clean blue theme which provides a feel of school, work, office environments, and portfolios. It has both functional and elegant design.', 'school, office, blue, clean, functional, function', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'metamorphsunrise', 'Sunrise', 'A red-orange theme with images of an eastern sunrise over the ocean. It invokes feelings of peace, relaxation, and warmth.', 'sun, morning, evening, dusk, sunset', 43, '2009-07-21 17:01:17', '2009-07-21 17:01:17'),
(19, 'metamorphwp', 'Writer', 'A blog-like theme which seems to invoke the image of hard work, organization, and a fast-paced lifestyle.', 'writer', 28, '2009-07-21 17:01:17', '2009-07-21 17:01:17'),
(20, 'nautica05', 'Sea & Sky', 'A clean and light design which focuses on the air, clouds, and sky.', 'nautica, water, ocean, blue, air, sky', 8, '2009-07-21 17:02:51', '2009-07-21 17:02:51'),
(21, 'nonzero_blue', 'Newstyle Blue', 'A modern web-2.0-esque design in blue.', 'blue, shiny, web, 2.0, web 2.0, new,age', 12, '2009-07-21 17:02:51', '2009-07-21 17:02:51'),
(22, 'nonzero_green', 'Newstyle Green', 'A modern web-2.0-esque design in green.', 'green, shiny, web, 2.0, web 2.0, new,age', 13, '2009-07-21 17:04:04', '2009-07-21 17:04:04'),
(23, 'nonzero_magenta', 'Newstyle Magenta', 'A modern web-2.0-esque design in magenta.', 'magenta, shiny, web, 2.0, web 2.0, new,age', 14, '2009-07-21 17:04:04', '2009-07-21 17:04:04'),
(24, 'nonzero_red', 'Newstyle Red', 'A modern web-2.0-esque design in red.', 'red, shiny, web, 2.0, web 2.0, new,age', 15, '2009-07-21 17:05:02', '2009-07-21 17:05:02'),
(25, 'pointspace', 'Point / Counterpoint', 'A dark, but professional theme with a pinch of grays and glitter.', 'grays, glitter, red, magenta', 23, '2009-07-21 17:05:02', '2009-07-21 17:05:02'),
(26, 'port_blue', 'Classic Blue', 'A simple blue theme with a modern feel. Evokes the look and feel of a blog.', 'simple, classic, blue', 27, '2009-07-21 17:05:48', '2009-07-21 17:05:48'),
(27, 'port_green', 'Classic Green', 'A simple green theme with a modern feel. Evokes the look and feel of a blog.', 'simple, classic, blue', 28, '2009-07-21 17:05:48', '2009-07-21 17:05:48'),
(28, 'summer', 'Summer Day', 'A design which provides the freshness of a summer day at the beach.  Soft yellows and light blues combine to create crisp, and beautiful look.', 'summer, yellow, blue, fresh, crisp', 11, '2009-07-21 17:06:38', '2009-07-21 17:06:38'),
(29, 'summerbreeze', 'Late Summer Breeze', 'A crisp, fresh-feeling theme, reminiscent of cool summer mornings and lazy days at the beach.', 'summer, blue, fresh, crisp', 11, '2009-07-21 17:06:38', '2009-07-21 17:06:38'),
(30, 'redmusic', 'Rocker', 'A cool theme geared up for a more fun, go-wild feel. Features reds and oranges, with the silhouetted imagery of a band rocking out.', 'Red, orange, rock, roll, band, music, songs', 29, '2009-07-21 17:07:21', '2009-07-21 17:07:21'),
(31, 'metamorphhills', 'Green Slopes', 'A green theme with images of long, rolling hills. Provides a feeling of fresh, airiness that can only be found in the countryside.', 'green, hills, golf, air, fresh, grass, trees, outdoor', 32, '2009-07-21 17:07:21', '2009-07-21 17:07:21'),
(32, 'metamorphenergy', 'Energy Bolt', 'A dark, but energy-filled theme screaming science and physics.', 'science, physics, math, energy, light, atom, nuclear, nucleus, particle', 67, '2009-07-21 17:08:20', '2009-07-21 17:08:20'),
(33, 'metamorphearth', 'The Blue Marble', 'A theme with the famed astronaut-taken picture, "The Blue Marble" in the background.', '', 68, '2009-07-21 17:08:20', '2009-07-21 17:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `first_name` varchar(20) default NULL,
  `last_name` varchar(20) default NULL,
  `address` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(5) default NULL,
  `country` varchar(50) default NULL,
  `phone` varchar(15) default NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(15) default NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_4` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_5` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_3` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_ibfk_4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `renews_pending`
--
ALTER TABLE `renews_pending`
  ADD CONSTRAINT `renews_pending_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sites_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE NO ACTION;
