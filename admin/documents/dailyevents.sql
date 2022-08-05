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
  `data_pb` date DEFAULT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `FK_calendario_ue` (`id_ue`),
  CONSTRAINT `FK_calendario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.calendario: ~2 rows (aproximadamente)
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `data_pb`) VALUES
	(1, '2022', 1, NULL),
	(2, '2022', 2, NULL);

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
  CONSTRAINT `FK_eventos_calendario` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_eventos_legenda` FOREIGN KEY (`id_leg`) REFERENCES `legenda` (`id_leg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.eventos: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.funcionario: ~3 rows (aproximadamente)
REPLACE INTO `funcionario` (`mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(1, 'sasd', 'asd', '2022-07-10', 'a', '2353245', '3423', 0, 1),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.legenda: ~2 rows (aproximadamente)
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(1, 'Avaliação', 'Avaliação', 'fa-glass', 'AV', '#d73333'),
	(2, 'Carnaval', 'dasdas', 'fa-glass', 'c', '#8621ca');

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
  `mat_func` int(11) NOT NULL,
  `usuario` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL,
  `senha` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nivel` int(1) unsigned DEFAULT 1,
  PRIMARY KEY (`mat_func`),
  UNIQUE KEY `usuario` (`usuario`) USING BTREE,
  KEY `nivel` (`nivel`) USING BTREE,
  CONSTRAINT `FK_usuarios_funcionario` FOREIGN KEY (`mat_func`) REFERENCES `funcionario` (`mat_func`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dailyevent.usuarios: ~2 rows (aproximadamente)
REPLACE INTO `usuarios` (`mat_func`, `usuario`, `senha`, `nivel`) VALUES
	(1, 'admin1', '123', 1),
	(2, 'admin2', '123', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
