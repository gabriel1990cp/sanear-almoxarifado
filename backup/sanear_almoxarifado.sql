-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jun-2017 às 19:51
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanear_almoxarifado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nome_cargo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nome_cargo`) VALUES
(1, 'Aux. Administrativo'),
(2, 'Coordenador'),
(3, 'Encanador'),
(4, 'Inspetor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carros`
--

CREATE TABLE `carros` (
  `id_carro` int(11) NOT NULL,
  `nome_carro` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carros`
--

INSERT INTO `carros` (`id_carro`, `nome_carro`) VALUES
(1, 'Volkswagen Kombi'),
(2, 'Fiat Fiorino '),
(3, 'Fiat Strada'),
(4, 'Chevrolet Montana'),
(5, 'Volkswagen Saveiro'),
(6, 'Chevrolet Celta'),
(7, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `nome_equipe` varchar(100) DEFAULT NULL,
  `inspetor_equipe` int(11) DEFAULT NULL,
  `observacao_equipe` text,
  `tipo_equipe` int(10) DEFAULT NULL,
  `status_equipe` varchar(45) DEFAULT 'ativo',
  `data_cad_equipe` date DEFAULT NULL,
  `data_atualizacao_equipe` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe_funcionarios`
--

CREATE TABLE `equipe_funcionarios` (
  `id_func_equipe` int(11) NOT NULL,
  `id_equipe` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_cad_func_equipe` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(50) NOT NULL,
  `rg_funcionario` varchar(45) DEFAULT NULL,
  `cpf_funcionario` varchar(45) DEFAULT NULL,
  `cargo_funcionario` int(11) DEFAULT NULL,
  `telefone_funcionario` varchar(45) DEFAULT NULL,
  `celular_funcionario` varchar(45) DEFAULT NULL,
  `carro_funcionario` int(11) DEFAULT NULL,
  `observacao_funcionario` text,
  `status_funcionario` enum('ativo','inativo') DEFAULT 'ativo',
  `data_cad_funcionario` datetime DEFAULT NULL,
  `data_atualizacao_funcionario` datetime DEFAULT NULL,
  `responsavel_cad_funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='			';

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `log_acao` varchar(45) DEFAULT NULL,
  `log_responsavel` varchar(45) DEFAULT NULL,
  `log_data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nome_perfil` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nome_perfil`) VALUES
(1, 'Administrativo'),
(2, 'Almoxarifado'),
(3, 'Supervisor'),
(4, 'Sabesp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_equipes`
--

CREATE TABLE `tipo_equipes` (
  `id_tipo_equipe` int(11) NOT NULL,
  `nome_tipo_equipe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_equipes`
--

INSERT INTO `tipo_equipes` (`id_tipo_equipe`, `nome_tipo_equipe`) VALUES
(1, 'Varredura'),
(2, 'Denúncia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `rg_usuario` varchar(15) DEFAULT NULL,
  `cpf_usuario` varchar(20) DEFAULT NULL,
  `email_usuario` varchar(45) DEFAULT NULL,
  `matricula_usuario` varchar(45) DEFAULT NULL,
  `perfil_usuario` int(11) DEFAULT NULL,
  `senha_usuario` varchar(32) DEFAULT NULL,
  `status_usuario` enum('ativo','inativo') DEFAULT 'ativo',
  `data_cad_usuario` datetime DEFAULT NULL,
  `data_atualizacao_usuario` datetime DEFAULT NULL,
  `respo_cad_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indexes for table `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_carro`);

--
-- Indexes for table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `tipo_equioe_idx` (`tipo_equipe`),
  ADD KEY `inspetor_equipe_idx` (`inspetor_equipe`);

--
-- Indexes for table `equipe_funcionarios`
--
ALTER TABLE `equipe_funcionarios`
  ADD PRIMARY KEY (`id_func_equipe`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indexes for table `tipo_equipes`
--
ALTER TABLE `tipo_equipes`
  ADD PRIMARY KEY (`id_tipo_equipe`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_id_perfil_idx` (`perfil_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `carros`
--
ALTER TABLE `carros`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT for table `equipe_funcionarios`
--
ALTER TABLE `equipe_funcionarios`
  MODIFY `id_func_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipo_equipes`
--
ALTER TABLE `tipo_equipes`
  MODIFY `id_tipo_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `inspetor_equipe` FOREIGN KEY (`inspetor_equipe`) REFERENCES `funcionarios` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipo_equioe` FOREIGN KEY (`tipo_equipe`) REFERENCES `tipo_equipes` (`id_tipo_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`perfil_usuario`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
