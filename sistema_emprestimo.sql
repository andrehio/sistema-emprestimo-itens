-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 22-Nov-2022 às 12:25
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_emprestimo`
--
CREATE DATABASE IF NOT EXISTS `sistema_emprestimo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_emprestimo`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `inserir`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inserir` (`i_cpf` BIGINT UNSIGNED, `i_nome` VARCHAR(45), `i_sobrenome` VARCHAR(60), `i_ativo` TINYINT(1), `i_email` VARCHAR(60), `i_senha` VARCHAR(60), `i_telefone` VARCHAR(20), `i_data_cadastro` DATE, `i_nivel` VARCHAR(20))   BEGIN
	DECLARE id1 INT;
	INSERT INTO sistema_emprestimo.usuario(cpf, nome, sobrenome, ativo) VALUES (i_cpf, i_nome, i_sobrenome, i_ativo);
	SET id1 = LAST_INSERT_ID();
	INSERT INTO Sistema_Emprestimo.Login(email, senha, telefone, data_cadastro, nivel, matricula) VALUES (i_email, i_senha, i_telefone, i_data_cadastro, i_nivel, id1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
CREATE TABLE `emprestimo` (
  `idEmprestimo` int(10) UNSIGNED NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao_combinada` date DEFAULT NULL,
  `data_devolucao_efetiva` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `matricula` int(10) UNSIGNED NOT NULL,
  `idItem` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`idEmprestimo`, `data_emprestimo`, `data_devolucao_combinada`, `data_devolucao_efetiva`, `ativo`, `matricula`, `idItem`) VALUES
(1, '2022-11-11', '2022-12-02', '0000-00-00', 1, 9, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `idItem` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `item` varchar(60) NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`idItem`, `descricao`, `item`, `data_cadastro`, `ativo`) VALUES
(1, 'item 1', 'Cowboy hat', '2021-02-08', 1),
(2, 'item 2', 'Ocarina', '2022-05-01', 1),
(3, 'item 3', 'Can of peas', '2021-02-10', 1),
(4, 'item 4', 'Clothes pin', '2021-03-11', 1),
(5, 'item 5', 'Cork', '2022-03-22', 1),
(6, 'item 6', 'Teddies', '2022-07-14', 1),
(7, 'item 7', 'Wedding ring', '2021-03-18', 1),
(8, 'item 8', 'Hair pin', '2022-03-28', 0),
(9, 'item 9', 'Toilet', '2021-03-23', 0),
(10, 'item 10', 'Jigsaw puzzle', '2021-06-29', 1),
(11, 'item 11', 'Ipod charger', '2021-12-04', 1),
(12, 'item 12', 'Money', '2021-05-07', 1),
(13, 'item 13', 'Remote', '2021-01-16', 0),
(14, 'item 14', 'Nail filer', '2021-07-23', 1),
(15, 'item 15', 'Game cartridge', '2022-08-26', 1),
(16, 'item 16', 'Pocketknife', '2022-09-06', 1),
(17, 'item 17', 'Butter knife', '2021-09-16', 1),
(18, 'item 18', 'Nail clippers', '2022-08-16', 1),
(19, 'item 19', 'Teddies', '2022-05-05', 1),
(20, 'item 20', 'Cork', '2022-03-22', 1),
(21, 'Item 21', 'Talco', '2022-11-22', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `idLogin` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `nivel` varchar(20) NOT NULL,
  `matricula` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`idLogin`, `email`, `senha`, `telefone`, `data_cadastro`, `nivel`, `matricula`) VALUES
(1, 'pgullen0@tripadvisor.com', 'NGErGUHg', '6179056276', '2021-02-08', 'adm', 1),
(2, 'deseler1@biblegateway.com', '6po8nA', '5154394546', '2022-05-01', 'adm', 2),
(3, 'omingay2@imageshack.us', 'zNXTULFz', '3039649328', '2021-02-10', 'adm', 3),
(4, 'sbiggen3@usnews.com', 'nGPhdU', '9931224297', '2021-03-11', 'adm', 4),
(5, 'agirardot4@yahoo.com', 'jOLRDWgPXF', '3099996897', '2022-03-22', 'user', 5),
(6, 'ehould5@cnet.com', 'qIMfEAC0Q1', '2232539987', '2022-07-14', 'user', 6),
(7, 'nloren6@bloomberg.com', '11LWVwZ', '4559867107', '2021-03-18', 'user', 7),
(8, 'syakovliv7@woothemes.com', 'lBHS1Mu', '6614119273', '2022-03-28', 'user', 8),
(9, 'ldiehn8@ehow.com', 'oIQGpB', '4588659681', '2021-03-23', 'user', 9),
(10, 'lsirr9@weather.com', '53IYl7b', '1023354709', '2021-06-29', 'user', 10),
(11, 'cdomicoa@dedecms.com', 'KwX9JRqg', '8942213481', '2021-12-04', 'user', 11),
(12, 'dcammellb@theglobeandmail.com', 'Xj5y7GKzU', '9944677134', '2021-05-07', 'user', 12),
(13, 'dkinsleyc@auda.org.au', 'B1kkEgo', '2963669970', '2021-01-16', 'user', 13),
(14, 'abelliardd@printfriendly.com', 'U6tD73Nf', '4666161179', '2021-07-23', 'user', 14),
(15, 'mphettise@goodreads.com', 'I7vT7044f', '6826679998', '2022-08-26', 'user', 15),
(16, 'vabotsonf@liveinternet.ru', 'VUhg12', '2041471639', '2022-09-06', 'user', 16),
(17, 'bstansallg@w3.org', 'sppAqOyw51', '2217551382', '2021-09-16', 'user', 17),
(18, 'jlepperh@hibu.com', 'uiX68pyZ', '9973748155', '2022-08-16', 'user', 18),
(19, 'gnesbyi@fastcompany.com', 'zE9QXez3EKi', '6371937620', '2022-05-05', 'user', 19),
(20, 'ailbertj@tripadvisor.com', 'FmDTKS', '4181713038', '2022-09-26', 'user', 20),
(21, 'abrumenk@dailymail.co.uk', 'PXqwXBGMp', '3805568022', '2021-02-03', 'user', 21),
(22, 'pmccutheonl@china.com.cn', 'R3SD1UZb', '1048609715', '2021-06-27', 'user', 22),
(23, 'skleinsingerm@smugmug.com', '2VmY71FasR', '5569201483', '2022-01-13', 'user', 23),
(24, 'rgrogonan@tripadvisor.com', '4ZqM4B4b9', '7788034518', '2022-07-14', 'user', 24),
(25, 'posipovo@xinhuanet.com', '7IU0vlAE', '5888988685', '2021-03-03', 'user', 25),
(26, 'ewilcockesp@statcounter.com', 'LveXD3', '8749921388', '2021-10-08', 'user', 26),
(27, 'makidq@multiply.com', 'OHFMoj0fkvh', '2656515295', '2021-10-10', 'user', 27),
(28, 'rmacgettigenr@360.cn', 'L6ipC4J6', '5476358356', '2021-04-27', 'user', 28),
(29, 'kjanseys@shareasale.com', 'nIKZcmkejvnQ', '7738317538', '2022-03-09', 'user', 29),
(30, 'steesdalet@washington.edu', 'LlhejPfFaMbL', '7342539022', '2021-02-09', 'user', 30),
(31, 'cmcginnisu@deliciousdays.com', 'VUHE12CQCMN', '7579514319', '2021-10-11', 'user', 31),
(32, 'thazelgrovev@engadget.com', 'T4ZsHyl9', '3628054965', '2021-02-25', 'user', 32),
(33, 'todyvoyw@cmu.edu', '7C0zGjw0o4hz', '8373888795', '2022-10-01', 'user', 33),
(34, 'rpalmarx@cpanel.net', 'ghDCD9M', '2539078024', '2022-09-08', 'user', 34),
(35, 'dmounsiey@europa.eu', 'gGZLbhJbZG', '6752835342', '2021-05-21', 'user', 35),
(36, 'anorganz@furl.net', 'KteNMH', '3674962204', '2022-05-19', 'user', 36),
(37, 'mkenningham10@fema.gov', 'VhOkyZ7IT1XN', '3012996620', '2022-10-28', 'user', 37),
(38, 'gpollen11@earthlink.net', 'RpwOFLT', '1617738805', '2021-09-22', 'user', 38),
(39, 'bklaesson12@artisteer.com', 'wZbjzjicMUGD', '9962906622', '2021-05-09', 'user', 39),
(40, 'tsuttaby13@oaic.gov.au', 'tk2SoDa', '1374846483', '2022-05-21', 'user', 40),
(41, 'cdealey14@samsung.com', '2T3VpCe', '8233798342', '2021-02-25', 'user', 41),
(42, 'bsherrin15@go.com', 'RVTz7upiY', '1452009615', '2022-07-27', 'user', 42),
(43, 'shayhow16@tumblr.com', '8PxVSXSQ', '8945681593', '2021-03-12', 'user', 43),
(44, 'ichillingsworth17@miitbeian.gov.cn', '7KwNW99', '4739530656', '2021-12-13', 'user', 44),
(45, 'efromont18@tinypic.com', '3iCXwha', '7862195881', '2021-07-06', 'user', 45),
(46, 'kmcgilben19@ameblo.jp', '7nY6k6J', '5026471031', '2022-06-07', 'user', 46),
(47, 'esattin1a@umn.edu', 'UGvrOwlXeNj', '2384909622', '2021-03-04', 'user', 47),
(48, 'abugbird1b@scribd.com', '0wgYLwO9FI', '7502044316', '2021-10-24', 'user', 48),
(49, 'sbraunton1c@cbsnews.com', '7p1R5V', '3546437800', '2021-09-24', 'user', 49),
(50, 'rchawkley1d@aol.com', 'dI0x4r', '3501881007', '2022-01-21', 'user', 50),
(51, 'admin@admin.com', '1', '1', '2021-02-08', 'adm', 51);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `matricula` int(10) UNSIGNED NOT NULL,
  `cpf` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`matricula`, `cpf`, `nome`, `sobrenome`, `ativo`) VALUES
(1, 27682786821, 'Peg', 'Gullen', 1),
(2, 57388197162, 'Darci', 'Eseler', 1),
(3, 7353434158, 'Orlan', 'Mingay', 0),
(4, 68014662468, 'Saudra', 'Biggen', 1),
(5, 95477994993, 'Anabelle', 'Girardot', 1),
(6, 11358179388, 'Ernie', 'Hould', 1),
(7, 57125016375, 'Norbert', 'Loren', 1),
(8, 54024642579, 'Shir', 'Yakovliv', 1),
(9, 660345921, 'Lauryn', 'Diehn', 1),
(10, 10202103417, 'Lin', 'Sirr', 1),
(11, 34973275269, 'Chiquita', 'Domico', 1),
(12, 36624274265, 'Douglas', 'Cammell', 1),
(13, 74558341955, 'Devora', 'Kinsley', 1),
(14, 26231897290, 'Anett', 'Belliard', 1),
(15, 73303339329, 'Maribeth', 'Phettis', 1),
(16, 96641787345, 'Valerie', 'Abotson', 1),
(17, 56069722477, 'Bella', 'Stansall', 1),
(18, 71292823780, 'Jamison', 'Lepper', 1),
(19, 35132729685, 'Gael', 'Nesby', 1),
(20, 42524626723, 'Athene', 'Ilbert', 1),
(21, 4250010195, 'Antonetta', 'Brumen', 1),
(22, 33348299302, 'Pauly', 'McCutheon', 0),
(23, 31938053994, 'Shellysheldon', 'Kleinsinger', 1),
(24, 86672287769, 'Rafe', 'Grogona', 1),
(25, 25994156936, 'Perrine', 'Osipov', 1),
(26, 62695098698, 'Eolanda', 'Wilcockes', 1),
(27, 38773731093, 'Maura', 'Akid', 1),
(28, 12050709896, 'Rand', 'MacGettigen', 1),
(29, 50140977093, 'Killian', 'Jansey', 1),
(30, 63530742288, 'Stefa', 'Teesdale', 1),
(31, 55274843378, 'Cecile', 'McGinnis', 1),
(32, 16808120342, 'Ty', 'Hazelgrove', 1),
(33, 49321826656, 'Tadd', 'ODyvoy', 1),
(34, 12552227147, 'Ricky', 'Palmar', 1),
(35, 31906705564, 'Deb', 'Mounsie', 0),
(36, 71598871794, 'Alessandro', 'Norgan', 1),
(37, 97244752981, 'Minerva', 'Kenningham', 1),
(38, 11266208417, 'Grady', 'Pollen', 1),
(39, 10641975385, 'Bruce', 'Klaesson', 1),
(40, 37126510045, 'Tybi', 'Suttaby', 0),
(41, 51942591116, 'Candide', 'Dealey', 1),
(42, 28837803627, 'Belle', 'Sherrin', 1),
(43, 40396254518, 'Sayer', 'Hayhow', 1),
(44, 35166406082, 'Ivan', 'Chillingsworth', 1),
(45, 20875052524, 'Enrico', 'Fromont', 1),
(46, 62318455016, 'Kaela', 'McGilben', 1),
(47, 9966654963, 'Edmund', 'Sattin', 1),
(48, 62807678793, 'Angelita', 'Bugbird', 0),
(49, 11909858007, 'Stewart', 'Braunton', 1),
(50, 32299239057, 'Rosella', 'Chawkley', 1),
(51, 1, 'admin', 'admin', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`idEmprestimo`,`matricula`,`idItem`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `idItem` (`idItem`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idLogin`,`email`,`matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `idEmprestimo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `idItem` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `idLogin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `matricula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `usuario` (`matricula`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`);

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `usuario` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
