CREATE DATABASE `pozoriste`;
USE `pozoriste`;

DROP TABLE IF EXISTS `predstava`;
CREATE TABLE `predstava` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `naziv` varchar(40) DEFAULT NULL,
    `trajanje` int(11) DEFAULT NULL,
    `ocena` decimal(5,2) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

insert into `predstava`(`id`,`naziv`,`trajanje`,`ocena`) values
(1, "Pariski Zivot", 120, 7.3),
(2, "Rezim Ljubavi", 90, 8.8);

DROP TABLE IF EXISTS `scena`;
CREATE TABLE `scena` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `naziv` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

insert into `scena`(`id`,`naziv`) values
(1, "Velika scena"),
(2, "Mala scena");

DROP TABLE IF EXISTS `raspored`;
CREATE TABLE `raspored` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `predstava_id` bigint(20) DEFAULT NULL,
    `scena_id` bigint(20) DEFAULT NULL,
    `cena` decimal(7,2) DEFAULT NULL,
    `datum` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `predstava_id` (`predstava_id`),
    KEY `scena_id` (`scena_id`),
    CONSTRAINT `raspored_ibfk_1` FOREIGN KEY (`predstava_id`) REFERENCES `predstava` (`id`),
    CONSTRAINT `raspored_ibfk_2` FOREIGN KEY (`scena_id`) REFERENCES `scena` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

insert into `raspored`(`id`,`predstava_id`,`scena_id`,`cena`,`datum`) values
(1,1,1,2000.00,'2022-11-15 20:00:00'),
(2,1,2,1000.00,'2023-01-10 21:00:00'),
(3,2,2,850.00,'2022-12-01 18:00:00');