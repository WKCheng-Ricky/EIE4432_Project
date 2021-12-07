CREATE TABLE `sales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemJSON` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`itemJSON`)),
  `date` date NOT NULL,
  `userId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) 