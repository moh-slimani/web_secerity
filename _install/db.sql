use tp_web_1;

DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `consultations`;
DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `analyses`;
DROP TABLE IF EXISTS `patients`;


CREATE TABLE `patients`
(
    `id`         int          NOT NULL AUTO_INCREMENT,
    `last_name`  varchar(190) NOT NULL,
    `first_name` varchar(190) NOT NULL,
    `sex`        varchar(1),
    `address`    varchar(190),
    `civility`   varchar(190),
    `picture`    varchar(190),
    PRIMARY KEY (`id`)
);

CREATE TABLE `consultations`
(
    `id`          int            NOT NULL AUTO_INCREMENT,
    `type`        varchar(192)   NOT NULL,
    `date`        date       NOT NULL,
    `appointment` date,
    `price`       decimal(10, 3) NOT NULL,
    `description` text,
    `patient_id`  int            NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
);

CREATE TABLE `analyses`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    `designation` varchar(192) NOT NULL,
    `min_value`   varchar(192),
    `max_value`   varchar(192),
    `price`       decimal(10, 3),
    PRIMARY KEY (`id`)
);

CREATE TABLE `results`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    `description` varchar(192),
    `value`       varchar(190) NOT NULL,
    `patient_id`  int          NOT NULL,
    `analysis_id` int          NOT NULL,
    PRIMARY KEY (`id`),

    FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`analysis_id`) REFERENCES `analyses` (`id`) ON DELETE CASCADE
);

CREATE TABLE `payments`
(
    `id`            int            NOT NULL AUTO_INCREMENT,
    `date_received` datetime       NOT NULL,
    `total`         decimal(10, 3) NOT NULL,
    `amount`        decimal(10, 3) NOT NULL,
    `remainder`     decimal(10, 3) NOT NULL,
    `patient_id`    int            NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
);

CREATE TABLE `users`
(
    `id`       int          NOT NULL AUTO_INCREMENT,
    `name`     varchar(190) NOT NULL unique,
    `email`    varchar(190) NOT NULL,
    `password` varchar(190) NOT NULL,
    PRIMARY KEY (`id`)
);
