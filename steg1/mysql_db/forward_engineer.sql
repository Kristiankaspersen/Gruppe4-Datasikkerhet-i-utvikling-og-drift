-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`student` (
  `student_id` INT NOT NULL,
  `field_of_study` VARCHAR(45) NULL,
  `starting_year` INT NULL,
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `username` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email_address` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `user_role` CHAR(1) NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`course` (
  `user_username` VARCHAR(45) NOT NULL,
  `course_id` VARCHAR(45) NOT NULL,
  `course_name` VARCHAR(45) NULL,
  PRIMARY KEY (`user_username`, `course_id`),
  INDEX `fk_course_user1_idx` (`user_username` ASC) VISIBLE,
  CONSTRAINT `fk_course_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `mydb`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`message` (
  `message_id` INT NOT NULL,
  `student_student_id` INT NOT NULL,
  `course_course_id` VARCHAR(45) NOT NULL,
  `message_text` VARCHAR(1000) NULL,
  `pin_code` CHAR(4) NULL,
  PRIMARY KEY (`message_id`),
  INDEX `fk_message_student_idx` (`student_student_id` ASC) VISIBLE,
  INDEX `fk_message_course1_idx` (`course_course_id` ASC) VISIBLE,
  CONSTRAINT `fk_message_student`
    FOREIGN KEY (`student_student_id`)
    REFERENCES `mydb`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_course1`
    FOREIGN KEY (`course_course_id`)
    REFERENCES `mydb`.`course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`reply`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reply` (
  `user_username` VARCHAR(45) NOT NULL,
  `message_message_id` INT NOT NULL,
  `reply_text` VARCHAR(1000) NULL,
  PRIMARY KEY (`user_username`, `message_message_id`),
  INDEX `fk_reply_message1_idx` (`message_message_id` ASC) VISIBLE,
  INDEX `fk_reply_user1_idx` (`user_username` ASC) VISIBLE,
  CONSTRAINT `fk_reply_message1`
    FOREIGN KEY (`message_message_id`)
    REFERENCES `mydb`.`message` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reply_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `mydb`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comment` (
  `message_message_id` INT NOT NULL,
  `comment_id` INT NOT NULL,
  `comment_text` VARCHAR(1000) NULL,
  PRIMARY KEY (`message_message_id`, `comment_id`),
  CONSTRAINT `fk_comment_message1`
    FOREIGN KEY (`message_message_id`)
    REFERENCES `mydb`.`message` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_is_student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_is_student` (
  `user_username` VARCHAR(45) NOT NULL,
  `student_student_id` INT NOT NULL,
  PRIMARY KEY (`user_username`, `student_student_id`),
  INDEX `fk_user_has_student_student1_idx` (`student_student_id` ASC) VISIBLE,
  INDEX `fk_user_has_student_user1_idx` (`user_username` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_student_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `mydb`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_student_student1`
    FOREIGN KEY (`student_student_id`)
    REFERENCES `mydb`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
