-- MySQL Script generated by MySQL Workbench
-- Sat May  6 12:15:22 2023
-- Model: New Model    Version: 1.0
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
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusr` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idusr`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`documento` (
  `iddoc` INT NOT NULL AUTO_INCREMENT,
  `nome_doc` VARCHAR(255) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `usuario_idusr` INT NOT NULL,
  PRIMARY KEY (`iddoc`),
  CONSTRAINT `fk_documento_usuario1`
    FOREIGN KEY (`usuario_idusr`)
    REFERENCES `mydb`.`usuario` (`idusr`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`doc_share`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`doc_share` (
  `iddoc_share` INT NOT NULL AUTO_INCREMENT,
  `documento_iddoc` INT NOT NULL,
  `permissao` VARCHAR(255) NOT NULL,
  `usr_recebe` INT NOT NULL,
  PRIMARY KEY (`iddoc_share`),
  CONSTRAINT `fk_doc_share_documento1`
    FOREIGN KEY (`documento_iddoc`)
    REFERENCES `mydb`.`documento` (`iddoc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_doc_share_usuario2`
    FOREIGN KEY (`usr_recebe`)
    REFERENCES `mydb`.`usuario` (`idusr`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
