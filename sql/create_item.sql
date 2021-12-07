CREATE TABLE `item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `price` float DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imageData` longtext DEFAULT NULL,
  `imageType` tinytext DEFAULT NULL,
  PRIMARY KEY (`id`)
)
    