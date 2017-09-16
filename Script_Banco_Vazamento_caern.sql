-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema vazamento_caern
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema vazamento_caern
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `vazamento_caern` DEFAULT CHARACTER SET utf8 ;
USE `vazamento_caern` ;

-- -----------------------------------------------------
-- Table `vazamento_caern`.`caern_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vazamento_caern`.`caern_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(60) NOT NULL,
  `email_usuario` VARCHAR(45) NOT NULL,
  `senha_usuario` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vazamento_caern`.`caern_ponto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vazamento_caern`.`caern_ponto` (
  `id_ponto` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `log_ponto` VARCHAR(45) NOT NULL,
  `lat_ponto` VARCHAR(45) NOT NULL,
  `rua_ponto` VARCHAR(100) NOT NULL,
  `estado_ponto` VARCHAR(60) NOT NULL,
  `cidade_ponto` VARCHAR(60) NULL,
  PRIMARY KEY (`id_ponto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vazamento_caern`.`caern_vazamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vazamento_caern`.`caern_vazamento` (
  `id_vazamento` INT NOT NULL AUTO_INCREMENT,
  `descricao_vazamento` TEXT NOT NULL,
  `status_vazamento` INT NOT NULL DEFAULT 0 COMMENT '0 = reclamação fechada\n1 = reclamação aberta\n',
  `data_vazamento` DATETIME NOT NULL,
  `gravidade_vazamento` VARCHAR(50) NOT NULL,
  `tempo_vazamento` INT(11) NULL,
  `imagem_vazamento` VARCHAR(150) NULL,
  `caern_ponto_id_ponto` INT ZEROFILL NOT NULL,
  `caern_usuario_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_vazamento`, `caern_ponto_id_ponto`, `caern_usuario_id_usuario`),
  INDEX `fk_caern_vazamento_caern_ponto_idx` (`caern_ponto_id_ponto` ASC),
  INDEX `fk_caern_vazamento_caern_usuario1_idx` (`caern_usuario_id_usuario` ASC),
  CONSTRAINT `fk_caern_vazamento_caern_ponto`
    FOREIGN KEY (`caern_ponto_id_ponto`)
    REFERENCES `vazamento_caern`.`caern_ponto` (`id_ponto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_caern_vazamento_caern_usuario1`
    FOREIGN KEY (`caern_usuario_id_usuario`)
    REFERENCES `vazamento_caern`.`caern_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
