CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `shopkeeper` tinyint(1) NOT NULL DEFAULT 0,
  `username` tinytext NOT NULL,
  `pwd` longtext NOT NULL,
  `nickname` tinytext DEFAULT NULL,
  `gender` tinytext NOT NULL DEFAULT 'M',
  `email` tinytext NOT NULL,
  `imageData` longtext DEFAULT NULL,
  `imageType` varchar(25) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
)