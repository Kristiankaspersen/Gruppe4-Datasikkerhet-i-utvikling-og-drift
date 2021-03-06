-- MySQL Script generated by MySQL Workbench
-- Sat Feb  5 20:56:39 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GruppeFireDB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GruppeFireDB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GruppeFireDB` DEFAULT CHARACTER SET utf8mb4 ;
USE `GruppeFireDB` ;

-- -----------------------------------------------------
-- Table `GruppeFireDB`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`student` (
  `student_id` INT NOT NULL,
  `field_of_study` VARCHAR(45) NULL,
  `starting_year` YEAR NOT NULL,
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`user` (
  `username` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `user_role` ENUM('student', 'lecturer', 'admin') NOT NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `GruppeFireDB`.`user` (`email` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`student_has_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`student_has_user` (
  `student_student_id` INT NOT NULL,
  `user_username` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_student_id`, `user_username`),
  CONSTRAINT `fk_student_has_user_student`
    FOREIGN KEY (`student_student_id`)
    REFERENCES `GruppeFireDB`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_user_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `GruppeFireDB`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_student_has_user_user1_idx` ON `GruppeFireDB`.`student_has_user` (`user_username` ASC);

CREATE INDEX `fk_student_has_user_student_idx` ON `GruppeFireDB`.`student_has_user` (`student_student_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`course` (
  `course_id` CHAR(8) NOT NULL,
  `course_name` VARCHAR(45) NOT NULL,
  `pin_code` INT(4) NULL,
  PRIMARY KEY (`course_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`lecturer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`lecturer` (
  `lecturer_id` INT NOT NULL,
  `profilepicture` VARCHAR(100) NULL,
  `course_course_id` CHAR(8) NOT NULL,
  PRIMARY KEY (`lecturer_id`),
  CONSTRAINT `fk_lecturer_course1`
    FOREIGN KEY (`course_course_id`)
    REFERENCES `GruppeFireDB`.`course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lecturer_course1_idx` ON `GruppeFireDB`.`lecturer` (`course_course_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`lecturer_has_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`lecturer_has_user` (
  `lecturer_lecturer_id` INT NOT NULL,
  `user_username` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lecturer_lecturer_id`, `user_username`),
  CONSTRAINT `fk_lecturer_has_user_lecturer1`
    FOREIGN KEY (`lecturer_lecturer_id`)
    REFERENCES `GruppeFireDB`.`lecturer` (`lecturer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturer_has_user_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `GruppeFireDB`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lecturer_has_user_user1_idx` ON `GruppeFireDB`.`lecturer_has_user` (`user_username` ASC);

CREATE INDEX `fk_lecturer_has_user_lecturer1_idx` ON `GruppeFireDB`.`lecturer_has_user` (`lecturer_lecturer_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`message` (
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `course_course_id` CHAR(8) NOT NULL,
  `student_student_id` INT NOT NULL,
  `message_text` TEXT NOT NULL,
  PRIMARY KEY (`message_id`),
  CONSTRAINT `fk_message_course1`
    FOREIGN KEY (`course_course_id`)
    REFERENCES `GruppeFireDB`.`course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_student1`
    FOREIGN KEY (`student_student_id`)
    REFERENCES `GruppeFireDB`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_message_course1_idx` ON `GruppeFireDB`.`message` (`course_course_id` ASC);

CREATE INDEX `fk_message_student1_idx` ON `GruppeFireDB`.`message` (`student_student_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`reply`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`reply` (
  `message_message_id` INT NOT NULL,
  `lecturer_lecturer_id` INT NOT NULL,
  `reply_text` TEXT NOT NULL,
  PRIMARY KEY (`message_message_id`, `lecturer_lecturer_id`),
  CONSTRAINT `fk_message_has_lecturer_message1`
    FOREIGN KEY (`message_message_id`)
    REFERENCES `GruppeFireDB`.`message` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_has_lecturer_lecturer1`
    FOREIGN KEY (`lecturer_lecturer_id`)
    REFERENCES `GruppeFireDB`.`lecturer` (`lecturer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_message_has_lecturer_lecturer1_idx` ON `GruppeFireDB`.`reply` (`lecturer_lecturer_id` ASC);

CREATE INDEX `fk_message_has_lecturer_message1_idx` ON `GruppeFireDB`.`reply` (`message_message_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`comment` (
  `comment_id` INT NOT NULL AUTO_INCREMENT,
  `message_message_id` INT NOT NULL,
  `comment_text` TEXT NOT NULL,
  PRIMARY KEY (`comment_id`, `message_message_id`),
  CONSTRAINT `fk_comment_message1`
    FOREIGN KEY (`message_message_id`)
    REFERENCES `GruppeFireDB`.`message` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_comment_message1_idx` ON `GruppeFireDB`.`comment` (`message_message_id` ASC);


-- -----------------------------------------------------
-- Table `GruppeFireDB`.`pwdReset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`pwdReset` (
  `pwdResetId` INT(11) NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` VARCHAR(100) NULL,
  `pwdResetSelector` TEXT NULL,
  `pwdResetToken` LONGTEXT NULL,
  `pwdResetExpires` TEXT NULL,
  PRIMARY KEY (`pwdResetId`))
ENGINE = InnoDB;

USE `GruppeFireDB` ;

-- -----------------------------------------------------
-- Placeholder table for view `GruppeFireDB`.`VWstudents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`VWstudents` (`username` INT, `first_name` INT, `last_name` INT, `email` INT, `password` INT, `user_role` INT, `student_id` INT, `field_of_study` INT, `starting_year` INT);

-- -----------------------------------------------------
-- Placeholder table for view `GruppeFireDB`.`VWlecturer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GruppeFireDB`.`VWlecturer` (`username` INT, `first_name` INT, `last_name` INT, `email` INT, `password` INT, `user_role` INT, `lecturer_id` INT, `profilepicture` INT, `course_course_id` INT);

-- -----------------------------------------------------
-- View `GruppeFireDB`.`VWstudents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GruppeFireDB`.`VWstudents`;
USE `GruppeFireDB`;
CREATE  OR REPLACE VIEW `VWstudents` 
AS 
SELECT  U.*, S.*
FROM  student AS S 
JOIN student_has_user AS SHU
ON S.student_id = SHU.student_student_id 
JOIN user AS U 
ON U.username = SHU.user_username;

-- -----------------------------------------------------
-- View `GruppeFireDB`.`VWlecturer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GruppeFireDB`.`VWlecturer`;
USE `GruppeFireDB`;
CREATE  OR REPLACE VIEW `VWlecturer` 
AS 
SELECT  U.*, L.*
FROM  lecturer AS L 
JOIN lecturer_has_user AS LHU
ON L.lecturer_id = LHU.lecturer_lecturer_id 
JOIN user AS U 
ON U.username = LHU.user_username;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Inserting courses
INSERT INTO course (course_id, course_name, pin_code) VALUES ("ITM30617","Utvikling av interaktive nettsteder", 1234); 
INSERT INTO course (course_id, course_name, pin_code) VALUES ("ITF15019","Innf??ring i datasikkerhet", 4321); 
INSERT INTO course (course_id, course_name, pin_code) VALUES ("BVN13092","Utvikling av interaktive bavianer", 3214); 
INSERT INTO course (course_id, course_name, pin_code) VALUES ("OKS12032","Innf??ring i okse", 5678); 

