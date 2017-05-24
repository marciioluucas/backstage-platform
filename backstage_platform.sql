-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema backstage_platform
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema backstage_platform
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `backstage_platform` DEFAULT CHARACTER SET latin1 ;
USE `backstage_platform` ;

-- -----------------------------------------------------
-- Table `backstage_platform`.`equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`equipe` (
  `pk_equipe` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`pk_equipe`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `backstage_platform`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`usuario` (
  `pk_usuario` INT(20) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `matricula` INT(40) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nivel` INT(1) NOT NULL DEFAULT '1',
  `ativado` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `backstage_platform`.`membro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`membro` (
  `pk_membro` INT(11) NOT NULL AUTO_INCREMENT,
  `fk_equipe` INT(11) NOT NULL,
  `funcao` VARCHAR(50) NOT NULL,
  `fk_usuario` INT(20) NOT NULL,
  `is_ocupado` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_membro`, `fk_equipe`, `fk_usuario`),
  INDEX `fk_programador_equipe1_idx` (`fk_equipe` ASC),
  INDEX `fk_membro_usuario1_idx` (`fk_usuario` ASC),
  CONSTRAINT `fk_membro_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `backstage_platform`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_programador_equipe1`
    FOREIGN KEY (`fk_equipe`)
    REFERENCES `backstage_platform`.`equipe` (`pk_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `backstage_platform`.`proposta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`proposta` (
  `pk_proposta` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `fk_usuario` INT(20) NOT NULL,
  `data` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`pk_proposta`, `fk_usuario`),
  INDEX `fk_Proposta_usuario_idx` (`fk_usuario` ASC),
  CONSTRAINT `fk_Proposta_usuario`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `backstage_platform`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `backstage_platform`.`projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`projeto` (
  `fk_equipe` INT(11) NOT NULL,
  `fk_proposta` INT(11) NOT NULL,
  `status` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fk_equipe`, `fk_proposta`),
  INDEX `fk_equipe_has_proposta_proposta1_idx` (`fk_proposta` ASC),
  INDEX `fk_equipe_has_proposta_equipe1_idx` (`fk_equipe` ASC),
  CONSTRAINT `fk_equipe_has_proposta_equipe1`
    FOREIGN KEY (`fk_equipe`)
    REFERENCES `backstage_platform`.`equipe` (`pk_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipe_has_proposta_proposta1`
    FOREIGN KEY (`fk_proposta`)
    REFERENCES `backstage_platform`.`proposta` (`pk_proposta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `backstage_platform`.`voto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backstage_platform`.`voto` (
  `pk_voto` INT(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` INT(20) NOT NULL,
  `fk_proposta` INT(11) NOT NULL,
  PRIMARY KEY (`pk_voto`, `fk_usuario`, `fk_proposta`),
  INDEX `fk_voto_usuario1_idx` (`fk_usuario` ASC),
  INDEX `fk_voto_proposta1_idx` (`fk_proposta` ASC),
  CONSTRAINT `fk_voto_proposta1`
    FOREIGN KEY (`fk_proposta`)
    REFERENCES `backstage_platform`.`proposta` (`pk_proposta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voto_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `backstage_platform`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
