-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema follow
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema follow
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `follow` DEFAULT CHARACTER SET utf8 ;
USE `follow` ;

-- -----------------------------------------------------
-- Table `follow`.`site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`site` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `logo` VARCHAR(45) NULL DEFAULT NULL,
  `proprietaire` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `follow`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `roles` VARCHAR(255) NULL DEFAULT NULL,
  `site_id` INT NOT NULL,
  PRIMARY KEY (`id`, `site_id`),
  INDEX `fk_user_site1_idx` (`site_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_site1`
    FOREIGN KEY (`site_id`)
    REFERENCES `follow`.`site` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `follow`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(45) NULL DEFAULT NULL,
  `laDate` DATE NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_message_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_message_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `follow`.`user` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `follow`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `image_url` VARCHAR(255) NULL DEFAULT NULL,
  `created_date` VARCHAR(255) NULL DEFAULT NULL,
  `snaps` VARCHAR(255) NULL DEFAULT NULL,
  `location` VARCHAR(255) NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_post_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_post_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `follow`.`user` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `follow`.`style`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`style` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NULL DEFAULT NULL,
  `paragraphe` VARCHAR(45) NULL DEFAULT NULL,
  `lien` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `follow`.`site_has_style`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `follow`.`site_has_style` (
  `site_id` INT NOT NULL,
  `style_id` INT NOT NULL,
  PRIMARY KEY (`site_id`, `style_id`),
  INDEX `fk_site_has_style_style1_idx` (`style_id` ASC) VISIBLE,
  INDEX `fk_site_has_style_site_idx` (`site_id` ASC) VISIBLE,
  CONSTRAINT `fk_site_has_style_site`
    FOREIGN KEY (`site_id`)
    REFERENCES `follow`.`site` (`id`),
  CONSTRAINT `fk_site_has_style_style1`
    FOREIGN KEY (`style_id`)
    REFERENCES `follow`.`style` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
