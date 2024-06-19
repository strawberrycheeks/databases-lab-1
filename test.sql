SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `bankDB`;
CREATE DATABASE bankDB;

USE bankDB;

CREATE TABLE `individuals` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstName` TEXT CHARACTER SET utf8 NOT NULL,
  `lastName` TEXT CHARACTER SET utf8 NOT NULL,
  `secondName` TEXT CHARACTER SET utf8 NOT NULL,
  `passport` VARCHAR(10) CHARACTER SET utf8 NOT NULL,
  `inn` VARCHAR(12) CHARACTER SET utf8 NOT NULL,
  `snils` VARCHAR(11) CHARACTER SET utf8 NOT NULL,
  `driverLicense` VARCHAR(127) CHARACTER SET utf8,
  `additionalDocs` TEXT CHARACTER SET utf8,
  `notes` TEXT
);

INSERT INTO `Individuals` (`firstName`, `lastName`, `secondName`, `passport`, `inn`, `snils`, `driverLicense`, `additionalDocs`, `notes`) VALUES
('Екатерина', 'Абрамушкина', 'Сергеевна', '5015123456', '123456123456', '11111111111', '0123456789', '-', NULL),
('Полина', 'Денисова', 'Александровна', '5015123456', '123456123456', '11111111111', '0123456789', '-', 'vip-client'),
('Полина', 'Айнутдинова', 'Михайловна', '5015123456', '123456123456', '11111111111', '0123456789', '-', 'vip-client'),
('Ева', 'Смирнова', 'Андреевна', '5015123456', '123456123456', '11111111111', '0123456789', 'Водительское удостоверение', NULL),
('Виталия', 'Корниенко', 'Филипповна', '5015123456', '123456123456', '11111111111', '0123456789', '-', NULL);

CREATE TABLE Borrowers (
    `borrower_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `inn` VARCHAR(12) CHARACTER SET utf8,
    `entity_type` TINYINT, -- 0 for individual, 1 for organization
    `address` VARCHAR(255) CHARACTER SET utf8,
    `total_amount` DECIMAL(10, 2),
    `conditions` TEXT CHARACTER SET utf8,
    `legal_notes` TEXT CHARACTER SET utf8,
    `contract_list` TEXT CHARACTER SET utf8
);

CREATE TABLE loans (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `individual_id` INT,
    `borrower_id` INT,
    `amount` DECIMAL(10, 2),
    `interest_rate` DECIMAL(5, 2),
    `limitation` INT,
    `conditions` TEXT CHARACTER SET utf8,
    `notes` TEXT CHARACTER SET utf8,
    FOREIGN KEY (individual_id) REFERENCES Individuals(id),
    FOREIGN KEY (borrower_id) REFERENCES Borrowers(borrower_id)
);


CREATE TABLE OrgLoans (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `organization_id` INT,
    `borrower_id` INT,
    `individual_id` INT,
    `amount` DECIMAL(10, 2),
    `limitation` INT,
    `interest_rate` DECIMAL(5, 2),
    `conditions` TEXT CHARACTER SET utf8,
    `notes` TEXT CHARACTER SET utf8,
    FOREIGN KEY (individual_id) REFERENCES Individuals(id),
    FOREIGN KEY (borrower_id) REFERENCES Borrowers(borrower_id)
);

COMMIT;
