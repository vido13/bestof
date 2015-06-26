-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Gostitelj: localhost:3306
-- Čas nastanka: 15 Mar 2015 ob 08:33 PM
-- Različica strežnika: 5.5.33
-- Različica PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Podatkovna baza: `jercic`
--

-- --------------------------------------------------------

--
-- Struktura tabele `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship9` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Odloži podatke za tabelo `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `user_id`) VALUES
(7, 'Cars', 'Best of cars', '61623.jpg', 24);

-- --------------------------------------------------------

--
-- Struktura tabele `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Relationship5` (`category_id`),
  KEY `Relationship2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Odloži podatke za tabelo `lists`
--

INSERT INTO `lists` (`id`, `category_id`, `user_id`, `title`, `description`, `date`, `image`) VALUES
(12, 7, 24, 'Bugatti Veyron', 'Bugatti Veyron', '2015-03-15 20:01:06', '84476.jpg'),
(13, 7, 26, 'Volvo S60 Polestar', 'Polestar concept', '2015-03-15 20:08:28', '39156.jpg');

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook_id` varchar(50) DEFAULT NULL,
  `twitter_id` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `facebook_id`, `twitter_id`, `admin`) VALUES
(23, 'Mitja MIKLAV', '', 'mitja.miklav@gmail.com', '10203706692809599', NULL, 0),
(24, 'mitja.miklav', '6b0d31c0d563223024da45691584643ac78c96e8', 'mitja.miklav@hotmail.com', NULL, NULL, 1),
(25, 'vid.jercic', '88b14e441f4910c1791c2421f2b4eb14f7ecf60b', 'vid.jercic@gmail.com', NULL, NULL, 1),
(26, 'Vid JER?I?', '', 'vid.jercic@gmail.com', '10206186899861388', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relationship1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Odloži podatke za tabelo `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `time`, `event`) VALUES
(115, 23, '2015-03-15 19:47:50', 'User is registered and logged in with Facebook'),
(116, 23, '2015-03-15 19:47:54', 'User logged out'),
(117, 24, '2015-03-15 19:48:02', 'User created'),
(119, 25, '2015-03-15 19:51:00', 'User created'),
(120, 25, '2015-03-15 19:52:37', 'User is logged in'),
(121, 23, '2015-03-15 19:52:45', 'User is logged in with Facebook'),
(122, 23, '2015-03-15 19:52:56', 'User logged out'),
(123, 24, '2015-03-15 19:53:01', 'User is logged in'),
(124, 25, '2015-03-15 19:54:02', 'User logged out'),
(125, 26, '2015-03-15 19:54:28', 'User is registered and logged in with Facebook'),
(126, 24, '2015-03-15 19:59:32', 'User logged out'),
(127, 24, '2015-03-15 19:59:56', 'User is logged in'),
(128, 24, '2015-03-15 20:00:41', 'User created a new category.'),
(129, 24, '2015-03-15 20:01:06', 'User created new listing'),
(130, 26, '2015-03-15 20:08:28', 'User created new listing'),
(131, 24, '2015-03-15 20:22:59', 'User created new listing'),
(132, 24, '2015-03-15 20:29:08', 'User created a new category.'),
(133, 24, '2015-03-15 20:32:36', 'User logged out');

-- --------------------------------------------------------

--
-- Struktura tabele `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship7` (`user_id`),
  KEY `IX_Relationship8` (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Odloži podatke za tabelo `votes`
--

INSERT INTO `votes` (`id`, `value`, `user_id`, `list_id`) VALUES
(1, 5, 24, 12),
(2, 4, 24, 12),
(3, 0, 26, 12),
(4, 5, 26, 12),
(5, 4, 26, 13),
(6, 5, 24, 12),
(7, 5, 24, 12),
(8, 2, 24, 12);

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `Relationship9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omejitve za tabelo `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `Relationship2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Relationship5` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Omejitve za tabelo `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `Relationship1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Omejitve za tabelo `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `Relationship7` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Relationship8` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
