-- MySQL Script generated by MySQL Workbench
-- qui 10 jan 2019 20:22:30 -02
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema horta-web
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `horta-web` ;

-- -----------------------------------------------------
-- Schema horta-web
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `horta-web` ;
SHOW WARNINGS;
USE `horta-web` ;

-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groups` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `institutions_id` INT UNSIGNED NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `institutions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `institutions` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `institutions` (
  `id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `plants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plants` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `plants` (
  `id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `interes_rate` DECIMAL(10,2) NULL,
  `institutions_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `transaction`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transaction` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` INT UNSIGNED NOT NULL,
  `type` VARCHAR(10) NOT NULL,
  `amount` DECIMAL(10,2) NULL,
  `users_idusers` INT UNSIGNED NOT NULL,
  `plants_id` INT UNSIGNED NOT NULL,
  `groups_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `user_group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_group` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `user_group` (
  `iduser_group` INT UNSIGNED NOT NULL,
  `permission` VARCHAR(45) NOT NULL,
  `groups_id` INT UNSIGNED NOT NULL,
  `users_idusers` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`iduser_group`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `user_notification_clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_notification_clients` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `user_notification_clients` (
  `users_idusers` INT UNSIGNED NOT NULL)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` INT UNSIGNED NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `phone` CHAR(11) NULL,
  `birth` DATE NULL,
  `gender` CHAR(1) NULL,
  `notes` TEXT NULL,
  `email` VARCHAR(60) NULL,
  `password` VARCHAR(255) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `permission` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idusers`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `user_social_data`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_social_data` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `user_social_data` (
  `users_idusers` INT UNSIGNED NOT NULL)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
