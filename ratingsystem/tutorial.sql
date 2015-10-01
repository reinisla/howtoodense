CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` tinyint(2) DEFAULT NULL,
  `reviews` int(11) DEFAULT NULL,
  `sum` smallint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `ratings` (`id`, `title`, `description`, `rating`, `reviews`, `sum` ) VALUES
(1, 'Pub number one', 'Address', 0, 0, 0),
(2, 'Pub number 2', 'Address', 0, 0, 0),
(3, 'Club number 1', 'Address', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
