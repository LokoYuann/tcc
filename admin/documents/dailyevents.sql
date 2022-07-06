-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para dailyevent
DROP DATABASE IF EXISTS `dailyevent`;
CREATE DATABASE IF NOT EXISTS `dailyevent` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dailyevent`;

-- Copiando estrutura para tabela dailyevent.calendario
DROP TABLE IF EXISTS `calendario`;
CREATE TABLE IF NOT EXISTS `calendario` (
  `id_calendario` int(11) NOT NULL AUTO_INCREMENT,
  `ano_letivo` year(4) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `FK_calendario_ue` (`id_ue`),
  CONSTRAINT `FK_calendario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.calendario: ~2 rows (aproximadamente)
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`) VALUES
	(1, '2022', 1),
	(2, '2022', 2);

-- Copiando estrutura para tabela dailyevent.eventos
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `dt_ini_ev` date DEFAULT NULL,
  `dt_fim_ev` date DEFAULT NULL,
  `id_calendario` int(11) DEFAULT NULL,
  `id_leg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento`) USING BTREE,
  KEY `FK_eventos_calendario` (`id_calendario`),
  KEY `FK_eventos_legenda` (`id_leg`),
  CONSTRAINT `FK_eventos_calendario` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`),
  CONSTRAINT `FK_eventos_legenda` FOREIGN KEY (`id_leg`) REFERENCES `legenda` (`id_leg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.eventos: ~2 rows (aproximadamente)
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(17, '2022-07-05', '2022-08-05', 1, 1),
	(19, '2022-05-05', '2022-10-05', NULL, NULL);

-- Copiando estrutura para tabela dailyevent.funcionario
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `mat_func` int(11) NOT NULL AUTO_INCREMENT,
  `funcao_func` varchar(10) DEFAULT NULL,
  `nome_func` varchar(20) DEFAULT NULL,
  `nasc_func` date DEFAULT NULL,
  `sexo_func` char(1) DEFAULT NULL,
  `tel_func` char(11) DEFAULT NULL,
  `cpf_func` char(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL,
  PRIMARY KEY (`mat_func`),
  KEY `FK_funcionario_localidade` (`cep`),
  KEY `FK_funcionario_ue` (`id_ue`),
  CONSTRAINT `FK_funcionario_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_funcionario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.funcionario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dailyevent.legenda
DROP TABLE IF EXISTS `legenda`;
CREATE TABLE IF NOT EXISTS `legenda` (
  `id_leg` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_evento` varchar(15) DEFAULT NULL,
  `desc_leg` varchar(100) DEFAULT NULL,
  `simbolo_leg` varchar(100) DEFAULT NULL,
  `sigla_leg` varchar(4) DEFAULT NULL,
  `cor_leg` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id_leg`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.legenda: ~2 rows (aproximadamente)
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(1, 'Avaliação', 'Avaliação', 'fa-burst', 'AV', '#d73333'),
	(2, 'Avaliação', 'Semana que devem ocorrer as pr', 'fa-book', 'SP', '#2fc65c'),
	(12, 'asd', 'ads', 'C:/xampp/htdocs/admin/static/img/simbolos/', 'asda', '#542626'),
	(19, 'asd', 'asd', 'fa-glass', 'asd', '#000000'),
	(23, 'asd', 'asd', 'fa-book', 'asd', '#e60000'),
	(24, '1', '1', '', '1', '#000000');

-- Copiando estrutura para tabela dailyevent.localidade
DROP TABLE IF EXISTS `localidade`;
CREATE TABLE IF NOT EXISTS `localidade` (
  `cep` int(11) NOT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `logradouro` varchar(20) DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.localidade: ~2 rows (aproximadamente)
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(0, 'RJ', 'RJ', 'Quintino', 'Clarimundo de Melo', '847', NULL),
	(1, NULL, NULL, NULL, NULL, NULL, NULL);

-- Copiando estrutura para tabela dailyevent.ue
DROP TABLE IF EXISTS `ue`;
CREATE TABLE IF NOT EXISTS `ue` (
  `id_ue` int(11) NOT NULL AUTO_INCREMENT,
  `tel_ue` char(10) DEFAULT NULL,
  `nome_ue` varchar(100) DEFAULT NULL,
  `sigla_ue` varchar(7) DEFAULT NULL,
  `email_ue` varchar(20) DEFAULT NULL,
  `logo_ue` varchar(25) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ue`),
  KEY `FK_ue_localidade` (`cep`),
  CONSTRAINT `FK_ue_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.ue: ~2 rows (aproximadamente)
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(1, '2123324085', 'Escola Técnica Estadual República', 'ETER', 'caq@faetec.rj.gov.br', NULL, 0),
	(2, NULL, NULL, NULL, NULL, NULL, 1);

-- Copiando estrutura para tabela dailyevent.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `mat_func` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `nivel` int(1) unsigned DEFAULT 1,
  PRIMARY KEY (`mat_func`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`) USING BTREE,
  KEY `nivel` (`nivel`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dailyevent.usuarios: 3 rows
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`mat_func`, `usuario`, `senha`, `nivel`) VALUES
	(7, 'admin1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
	(8, 'admin2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
	(9, 'admin3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
