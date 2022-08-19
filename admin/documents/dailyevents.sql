-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 10:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailyevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendario`
--

CREATE TABLE `calendario` (
  `id_calendario` int(11) NOT NULL,
  `ano_letivo` year(4) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL,
  `data_pb` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendario`
--

INSERT INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `data_pb`) VALUES
(1, 2022, 1, NULL),
(2, 2022, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `dt_ini_ev` date DEFAULT NULL,
  `dt_fim_ev` date DEFAULT NULL,
  `id_calendario` int(11) DEFAULT NULL,
  `id_leg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
(1, '2022-04-03', '2022-04-15', NULL, 1),
(2, '2022-03-01', '2022-03-03', 2, 2),
(3, '2022-08-15', '2022-08-15', NULL, 4),
(4, '2022-05-19', '2022-05-19', NULL, 3),
(5, '2022-01-06', '2022-01-06', NULL, 5),
(7, '2022-11-07', '2022-11-07', NULL, 6),
(9, '2022-01-05', '2022-01-05', NULL, 7),
(10, '2022-11-15', '2022-11-15', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `mat_func` int(11) NOT NULL,
  `funcao_func` varchar(10) DEFAULT NULL,
  `nome_func` varchar(20) DEFAULT NULL,
  `nasc_func` date DEFAULT NULL,
  `sexo_func` char(1) DEFAULT NULL,
  `tel_func` char(11) DEFAULT NULL,
  `cpf_func` char(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
(1, 'jk', 'asd', '2022-07-10', 'a', '2353245', '3423', 20231020, 1),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `legenda`
--

CREATE TABLE `legenda` (
  `id_leg` int(11) NOT NULL,
  `tipo_evento` varchar(50) DEFAULT NULL,
  `desc_leg` varchar(60) DEFAULT NULL,
  `simbolo_leg` varchar(50) DEFAULT NULL,
  `sigla_leg` varchar(4) DEFAULT NULL,
  `cor_leg` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `legenda`
--

INSERT INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
(1, 'Avaliação', 'Teste de aceitabilidade do que foi aprendido.', 'fa-book', 'AV', '#46adfb'),
(2, 'Conselho de Classe', 'Colegiado escolar.', '', 'COC', '#93140b'),
(3, 'Feira Literária da Oscar Tenório', 'Projeto literário elaborado pelo GEOT e docentes.', '', 'FLOT', '#ffffff'),
(4, 'Feira de Ciência', 'Evento que costuma durar um dia.', '', 'FC', '#293bc2'),
(5, 'Recuperação', 'Programa de aulas extras para recuperação de notas.', '', 'R', '#f3e51b'),
(6, 'Reunião com Responsáveis', 'Reunião que aborda pautas coletivas sobre as turmas.', '', 'RR', '#088110'),
(7, 'Feira Técnica', 'Projeto anual organizado pela escola.', '', 'FT', '#60521f'),
(8, 'Recesso Escolar', 'Pausa de reorganização para as atividades letivas.', '', 'RE', '#55af75'),
(9, 'Feriados', 'Dias não úteis determinados pelas autoridades.', NULL, 'F', NULL),
(10, 'Ínicio do ano letivo', 'Período em que as aulas começam oficialmente.', NULL, 'IAL', NULL),
(11, 'Dia do professor', 'Data comemorativa que homenageia esses profissionais.', NULL, NULL, NULL),
(12, 'Retorno do professor', 'Retorno dos professores às unidades escolares.', NULL, NULL, NULL),
(13, 'Férias', 'Período de descanso para estudantes e funcionários.', NULL, NULL, NULL),
(14, 'Acolhimento dos discentes', 'Acolhimento dos alunos que estão iniciando o ano.', NULL, NULL, NULL),
(15, 'Lançamento de notas', 'Registro dos resultados das avaliações. ', NULL, NULL, NULL),
(16, 'Resultado final', 'Documento que registra o resultado final de todos os alunos.', NULL, NULL, NULL),
(17, 'Planejamento e Semana de acolhimento', 'Período de aproximação entre alunos e a comunidade escolar.', NULL, NULL, NULL),
(18, 'Término da 1ª etapa', 'Encerramento da primeira etapa.', NULL, NULL, NULL),
(19, 'Término da 2ª etapa', 'Encerramento da segunda etapa.', NULL, NULL, NULL),
(20, 'Término da 3ª etapa', 'Encerramento da terceira etapa.', NULL, NULL, NULL),
(21, 'Conselho de Classe Final', 'Avaliação de fim de ano.', NULL, NULL, NULL),
(22, 'Recuperação Final', 'Última avaliação para os alunos com notas baixas.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `localidade`
--

CREATE TABLE `localidade` (
  `cep` int(11) NOT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `logradouro` varchar(30) DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `localidade`
--

INSERT INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
(9991060, 'SP', 'Diadema', 'Conceição', 'Rua Guarani', '735', NULL),
(20231020, 'RJ', 'Rio de Janeiro', 'Quintino', 'Clarimundo de Melo', '847', NULL),
(20271202, 'RJ', 'Rio de Janeiro', 'Maracanã', 'General Canabarro', '291', NULL),
(20941160, 'RJ', 'Rio de Janeiro', 'Maracanã', 'Bartolomeu de Gusmão', '846', NULL),
(21073460, 'RJ', 'Rio de Janeiro', 'Olaria', 'Paranhos', NULL, NULL),
(21240535, 'RJ', 'Rio de Janeiro', 'Jardim América', 'Jornalista Antônio de Freitas', '75', '(NULL)'),
(21311281, 'RJ', 'Rio de Janeiro', 'Centro', '20 de Abril', '14', NULL),
(21610210, 'RJ', 'Rio de Janeiro', 'Marechal Hermes', 'João Vicente', '1775', NULL),
(21610211, 'RJ', 'Rio de janeiro', 'Deodoro', 'São Vicente', '2151', NULL),
(21610330, 'RJ', 'Rio de Janeiro', 'Marechal Hermes', 'Xavier Curado', 's/n', NULL),
(21625001, 'RJ', 'Rio de Janeiro', 'Ricardo de Albuquerque', 'Estrada Marechal Alencastro', '5', NULL),
(23550050, 'RJ', 'Rio de Janeiro', 'Santa Cruz', 'Largo do Bodegão', '46', NULL),
(24110305, 'RJ', 'Niterói', 'Barreto', 'Guimarães Junior', '182', NULL),
(25266006, 'RJ', 'Duque de Caxias', 'Santa Lucia', 'Avenida Vitória', '841', NULL),
(26221080, 'RJ', 'Nova Iguaçu', 'Centro', 'Luiz de Lima', '272', NULL),
(26600000, 'RJ', 'Paracambi', 'Fábrica', 'Dom Pedro II', 's/n', NULL),
(27210240, 'RJ', 'Volta Redonda', 'Santo Agostinho', 'Mil e Quinze', 's/n', NULL),
(27330052, 'RJ', 'Barra Mansa', 'Barbará', 'Rodovia Sérgio Braga', 's/n', NULL),
(28016812, 'RJ', 'Campos dos Goytacazes', 'Parque California', 'Avenida Alberto Lamego', '712', NULL),
(28993000, 'RJ', 'Saquarema', 'Bacaxa', 'Capitão Nunes', 's/n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ue`
--

CREATE TABLE `ue` (
  `id_ue` int(11) NOT NULL,
  `tel_ue` char(10) DEFAULT NULL,
  `nome_ue` varchar(100) DEFAULT NULL,
  `sigla_ue` varchar(7) DEFAULT NULL,
  `email_ue` varchar(50) DEFAULT NULL,
  `logo_ue` varchar(25) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ue`
--

INSERT INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
(1, '2123324085', 'Escola Técnica Estadual República', 'ETER', 'caq@faetec.rj.gov.br', NULL, 20231020),
(2, '2123341741', 'Escola Técnica Estadual Ferreira Viana', 'ETEFV', 'etefv@faetec.rj.gov.br', NULL, 20271202),
(3, '2123341738', 'Escola Técnica Estadual Adolpho Bloch', 'ETEAB', 'eteab@faetec.rj.gov.br', NULL, 20941160),
(4, '2123338337', 'Escola Técnica Estadual Juscelino Kubitschek', 'ETEJK', 'juscelinokubitscheck@sectec.rio.gov.br', NULL, 21240535),
(5, '2123329721', 'Escola Técnica Estadual de Teatro Martins Pena', 'ETETMP', 'direcaomartinspena@yahoo.com.br', NULL, 21311281),
(6, '2123321063', 'Escola Tecnica Estadual Visconde de Mauá', 'ETEVM', 'etevm@faetec.rj.gov.br', NULL, 21610210),
(7, '2123321056', 'Escola Tecnica Estadual Oscar Tenório', 'ETEOT', 'secretaria.eteot@oi.com.br', NULL, 21610330),
(8, '2123337225', 'Escola Técnica Estadual Santa Cruz', 'ETESC', 'etesc@faetec.rj.gov.br', NULL, 23550050),
(9, '2127259148', 'Escola Técnica Estadual Henrique Lage', 'ETEHL', 'secretaria.etehl@faetec.rio.gov.br', NULL, 24110305),
(10, '2127871011', 'Escola Tecnica Estadual Imbariê', 'ETEIMB', ' eteimbarie@gmail.com', NULL, 25266006),
(11, '2123339545', 'Escola Técnica de Transporte Engenheiro Silva Freire', 'ETTESF', 'engsilvafreire@gmail.com', NULL, 21610211),
(12, '1140561362', 'Escola Técnica Estadual Juscelino Kubitschek de Oliveira', 'ETEJKO', 'e166dir@cps.sp.gov.br', NULL, 9991060),
(13, '2433244889', 'Escola Técnica Estadual Barra Mansa', 'ETEBM', 'cvtbarramansa@gmail.com', NULL, 27330052),
(14, '2226513014', 'Escola Técnica Estadual Helber Vignoli Muniz', 'ETEHVM', 'equipegestora2015@hotmail.com', NULL, 28993000),
(15, '2227386595', 'Escola Técnia Estadual João Barcelos Martins ', 'ETEJBM', 'secretariajbm@yahoo.com.br', NULL, 28016812),
(16, '2126694808', 'Escola Técnica Estadual João Luiz do Nascimento', 'ETEJLN', 'etejln@faetec.rj.gov.br', NULL, 26221080),
(17, '2133571807', 'ETE Mercedes Mendes Teixeira ', 'ETEMMT', 'etmmmt@faetec.rj.gov.br', NULL, 21625001),
(18, '2136933224', 'Escola Técnica Estadual Paracambi', 'ETEP', 'secretaria@eteprc.faetec.rj.gov.br', NULL, 26600000),
(19, '2433456781', 'ETP Amaury Cesar Vieira', 'ETEACV', 'eteacv@faetec.rj.gov.br', NULL, 27210240),
(20, '2123347497', 'FAETEC Alemão Unidade Paranhos Olaria', 'ALEMAO', 'aupo@faetec.rio.gov.br', NULL, 21073460);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `mat_func` int(11) NOT NULL,
  `usuario` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL,
  `senha` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nivel` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`mat_func`, `usuario`, `senha`, `nivel`) VALUES
(1, 'admin1', '123', 1),
(2, 'admin2', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_calendario`),
  ADD KEY `FK_calendario_ue` (`id_ue`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`) USING BTREE,
  ADD KEY `FK_eventos_calendario` (`id_calendario`),
  ADD KEY `FK_eventos_legenda` (`id_leg`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`mat_func`),
  ADD KEY `FK_funcionario_localidade` (`cep`),
  ADD KEY `FK_funcionario_ue` (`id_ue`);

--
-- Indexes for table `legenda`
--
ALTER TABLE `legenda`
  ADD PRIMARY KEY (`id_leg`);

--
-- Indexes for table `localidade`
--
ALTER TABLE `localidade`
  ADD PRIMARY KEY (`cep`);

--
-- Indexes for table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`id_ue`),
  ADD KEY `FK_ue_localidade` (`cep`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`mat_func`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE,
  ADD KEY `nivel` (`nivel`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_calendario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `mat_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `legenda`
--
ALTER TABLE `legenda`
  MODIFY `id_leg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ue`
--
ALTER TABLE `ue`
  MODIFY `id_ue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `FK_calendario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_eventos_calendario` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_eventos_legenda` FOREIGN KEY (`id_leg`) REFERENCES `legenda` (`id_leg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `FK_funcionario_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_funcionario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `FK_ue_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_funcionario` FOREIGN KEY (`mat_func`) REFERENCES `funcionario` (`mat_func`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
