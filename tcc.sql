SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`administrador` (
  `codigo` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(16),
  PRIMARY KEY (`codigo`)) 
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `mydb`.`orientador` (
  `codigo` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `rg` varchar(45) NULL ,
  `expeditor` varchar(45) NULL ,
  `cpf` varchar(11) NOT NULL UNIQUE,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `senha` VARCHAR(16) NOT NULL ,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`cargo` (
  `codigo` INT NOT NULL AUTO_INCREMENT,  
  `cargo` VARCHAR(80) NULL  UNIQUE,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`prova` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL UNIQUE , 
  `data_criacao` date NULL ,
  `data_realizacao` datetime NULL ,
  `duracao` int NULL ,
    PRIMARY KEY (`codigo`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`disciplina` (
  `codigo` INT NOT NULL AUTO_INCREMENT,  
  `disciplina` VARCHAR(80) NULL  UNIQUE,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`candidato` (
  `codigo` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NULL ,
  `rg` varchar(45) NULL ,
  `expeditor` varchar(45) NULL ,
  `cpf` varchar(11) NULL ,
  `data_nascimento` date NULL ,
  `email` VARCHAR(45) NULL ,
  `senha` VARCHAR(16) NULL ,
  `cargo_codigo` INT NOT NULL ,
  `escolaridade` VARCHAR(45) NULL ,
  `telefone` INT(11) NULL ,
  `rua` VARCHAR(30) NULL ,
  `numero` INT NULL ,
  `cep` INT NULL ,
  `bairro` VARCHAR(45) NULL ,
  `cidade` VARCHAR(45) NULL ,
  `estado` VARCHAR(45) NULL ,
  `complemento` VARCHAR(45) NULL ,
  UNIQUE INDEX `rg_UNIQUE` (`rg` ASC) ,
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  PRIMARY KEY (`codigo`) ,
  INDEX `fk_candidato_cargo1` (`cargo_codigo` ASC) ,
  CONSTRAINT `fk_candidato_cargo1`
    FOREIGN KEY (`cargo_codigo` )
    REFERENCES `mydb`.`cargo` (`codigo` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `mydb`.`grupo` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL UNIQUE ,
  `orientador_codigo` INT NOT NULL ,
  `prova_codigo` INT NOT NULL ,
  PRIMARY KEY (`codigo`, `orientador_codigo`, `prova_codigo`) ,
  INDEX `fk_grupo_orientador1` (`orientador_codigo` ASC) ,
  INDEX `fk_grupo_prova1` (`prova_codigo` ASC) ,
  CONSTRAINT `fk_grupo_orientador1`
    FOREIGN KEY (`orientador_codigo` )
    REFERENCES `mydb`.`orientador` (`codigo` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_prova1`
    FOREIGN KEY (`prova_codigo` )
    REFERENCES `mydb`.`prova` (`codigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`candidato_has_grupo` (
  `candidato_codigo` INT NOT NULL ,
  `grupo_codigo` INT NOT NULL ,
  `resposta_candidato` VARCHAR(45) NULL ,
  `acertos` INT NULL ,
  PRIMARY KEY (`candidato_codigo`, `grupo_codigo`) ,
  INDEX `fk_candidato_has_grupo_grupo1` (`grupo_codigo` ASC) ,
  INDEX `fk_candidato_has_grupo_candidato1` (`candidato_codigo` ASC) ,
  CONSTRAINT `fk_candidato_has_grupo_candidato1`
    FOREIGN KEY (`candidato_codigo` )
    REFERENCES `mydb`.`candidato` (`codigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_candidato_has_grupo_grupo1`
    FOREIGN KEY (`grupo_codigo` )
    REFERENCES `mydb`.`grupo` (`codigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`questao` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(15) NULL ,
  `descricao` TEXT NULL ,
  `gabarito` CHAR(1) NULL ,
  `a` TEXT NULL ,
  `b` TEXT NULL ,
  `c` TEXT NULL ,
  `d` TEXT NULL ,
  `disciplina_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_questao_disciplina1` (`disciplina_codigo` ASC) ,
  CONSTRAINT `fk_questao_disciplina1`
    FOREIGN KEY (`disciplina_codigo` )
    REFERENCES `mydb`.`disciplina` (`codigo` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `mydb`.`prova_has_questao` (
  `prova_codigo` INT NOT NULL,
  `questao_codigo` INT NOT NULL ,
  `numero_questao` INT NULL ,
  PRIMARY KEY (`prova_codigo`, `questao_codigo`) ,
  INDEX `fk_prova_has_questao_questao1` (`questao_codigo` ASC) ,
  INDEX `fk_prova_has_questao_prova1` (`prova_codigo` ASC) ,
  CONSTRAINT `fk_prova_has_questao_prova1`
    FOREIGN KEY (`prova_codigo`)
    REFERENCES `mydb`.`prova` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prova_has_questao_questao1`
    FOREIGN KEY (`questao_codigo` )
    REFERENCES `mydb`.`questao` (`codigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO administrador VALUES (null, 'Administrador',  'admin');

SET GLOBAL auto_increment_increment=1;
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
