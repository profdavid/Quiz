# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.13-MariaDB)
# Base de Dados: infin526_quizv2
# Tempo de Geração: 2023-09-20 14:28:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela equipe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipe`;

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equnome` varchar(200) NOT NULL,
  `equlogada` int(11) NOT NULL DEFAULT 0,
  `equlogo` varchar(100) DEFAULT NULL,
  `idevento` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_equipe_evento1_idx` (`idevento`),
  CONSTRAINT `fk_equipe_evento1` FOREIGN KEY (`idevento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela equipe_questaoresposta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipe_questaoresposta`;

CREATE TABLE `equipe_questaoresposta` (
  `idequipe` int(11) NOT NULL,
  `idquestaoresposta` int(11) NOT NULL,
  `eqrponto` int(11) NOT NULL,
  `eqttempo` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idequipe`,`idquestaoresposta`),
  KEY `fk_equipe_questaoresposta_questaoresposta1_idx` (`idquestaoresposta`),
  KEY `fk_equipe_questaoresposta_equipe1_idx` (`idequipe`),
  CONSTRAINT `fk_equipe_questaoresposta_equipe1` FOREIGN KEY (`idequipe`) REFERENCES `equipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipe_questaoresposta_questaoresposta1` FOREIGN KEY (`idquestaoresposta`) REFERENCES `questaoresposta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela evento
# ------------------------------------------------------------

DROP TABLE IF EXISTS `evento`;

CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evenome` varchar(200) NOT NULL,
  `evesituacao` int(11) NOT NULL DEFAULT 0 COMMENT '0 - criado\n1 - iniciado\n2 - finalizado',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;

INSERT INTO `evento` (`id`, `evenome`, `evesituacao`, `criado_em`, `atualizado_em`)
VALUES
	(1,'Quiz Teste 01',0,'2023-09-15 12:15:39','2023-09-18 09:31:52'),
	(2,'Quiz Teste 02',0,'2023-09-18 10:00:24','2023-09-18 10:00:24');

/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logtexto` text DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_log_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_log_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela questao
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questao`;

CREATE TABLE `questao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queordem` int(11) NOT NULL,
  `quetempo` int(11) NOT NULL,
  `queponto` int(11) NOT NULL,
  `quetexto` text DEFAULT NULL,
  `queimg` varchar(100) DEFAULT NULL,
  `quedtliberacao` timestamp NULL DEFAULT NULL,
  `quedtlimite` timestamp NULL DEFAULT NULL,
  `quesituacao` int(11) NOT NULL DEFAULT 0 COMMENT '0 - não liberada\n1 - liberada',
  `idevento` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_questao_evento1_idx` (`idevento`),
  CONSTRAINT `fk_questao_evento1` FOREIGN KEY (`idevento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela questaoresposta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questaoresposta`;

CREATE TABLE `questaoresposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qrordem` varchar(10) NOT NULL,
  `qrtexto` text DEFAULT NULL,
  `qrimg` varchar(100) DEFAULT NULL,
  `qrcorreta` int(11) NOT NULL DEFAULT 0,
  `idquestao` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_questaoresposta_questao1_idx` (`idquestao`),
  CONSTRAINT `fk_questaoresposta_questao1` FOREIGN KEY (`idquestao`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usunome` varchar(100) NOT NULL,
  `usuemail` varchar(100) NOT NULL,
  `ususenha` varchar(100) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `ideventoativo` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_usuario_evento1_idx` (`ideventoativo`),
  CONSTRAINT `fk_usuario_evento1` FOREIGN KEY (`ideventoativo`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`id`, `usunome`, `usuemail`, `ususenha`, `ativo`, `ideventoativo`, `criado_em`, `atualizado_em`)
VALUES
	(1,'David Paolini Develly','dpdevelly@gmail.com','$2y$10$7PTc7/eNq3sz/s2jWljAUufd02jx2K/mlhKMDdOdXNXoRQJPAYLeS',1,1,'2023-09-15 11:16:23','2023-09-15 11:58:23'),
	(3,'Administrador','adm@adm.com.br','$2y$10$Y/UM2fVGxrr44HG646pU7uVBT6dL7JeSCi.xS2Obk9/s7YAbsdy..',1,NULL,'2023-09-20 11:25:52','2023-09-20 11:25:52');

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
