-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Set-2017 às 03:41
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
-- Estrutura da tabela `entrada_estoque`
--

CREATE TABLE `entrada_estoque` (
  `id_est_entrada` int(11) NOT NULL,
  `nota_remessa_est_entrada` varchar(45) DEFAULT NULL,
  `atend_requisicao_est_entrada` varchar(45) DEFAULT NULL,
  `arquivo_est_entrada` varchar(45) DEFAULT NULL,
  `responsavel_est_entrada` varchar(45) DEFAULT NULL,
  `status_est_entrada` set('aberto','finalizado') DEFAULT NULL,
  `data_est_entrada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_hmy_caixa`
--

CREATE TABLE `entrada_estoque_hmy_caixa` (
  `id_est_caixa_hmy` int(11) NOT NULL,
  `id_entrada_est_caixa_hmy` int(11) NOT NULL,
  `id_mat_est_caixa_hmy` int(11) DEFAULT NULL,
  `quant_est_caixa_hmy` int(11) DEFAULT NULL,
  `inicio_est_caixa_hmy` varchar(30) DEFAULT NULL,
  `fim_est_caixa_hmy` varchar(30) DEFAULT NULL,
  `id_resp_est_caixa_hmy` int(11) NOT NULL,
  `data_cad_est_caixa_hmy` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_hmy_caixa_itens`
--

CREATE TABLE `entrada_estoque_hmy_caixa_itens` (
  `id_est_caixa_hmy_itens` int(10) UNSIGNED NOT NULL,
  `id_caixa_est_caixa_hmy_itens` int(11) NOT NULL,
  `item_est_caixa_hmy_itens` varchar(25) DEFAULT NULL,
  `id_mat_est_caixa_hmy_itens` int(11) DEFAULT NULL,
  `id_entrada_est_caixa_hmy_itens` int(11) DEFAULT NULL,
  `responsavel_est_caixa_hmy_itens` int(11) DEFAULT NULL,
  `data_est_caixa_hmy_itens` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_hm_avulso`
--

CREATE TABLE `entrada_estoque_hm_avulso` (
  `id_est_hm_avulso` int(11) NOT NULL,
  `id_entrada_est_hm_avulso` int(11) DEFAULT NULL,
  `id_mat_est_hm_avulso` int(11) DEFAULT NULL,
  `numero_est_hm_avulso` varchar(10) DEFAULT NULL,
  `id_resp_est_hm_avulso` int(11) DEFAULT NULL,
  `data_cad_est_hm_avulso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_lacre_pacote`
--

CREATE TABLE `entrada_estoque_lacre_pacote` (
  `id_est_lacre_pacote` int(11) NOT NULL,
  `id_entrada_est_lacre_pacote` int(11) DEFAULT NULL,
  `id_mat_est_lacre_pacote` int(11) DEFAULT NULL,
  `quant_est_lacre_pacote` int(11) DEFAULT NULL,
  `inicio_est_lacre_pacote` int(11) DEFAULT NULL,
  `fim_est_lacre_pacote` int(11) DEFAULT NULL,
  `id_resp_est_lacre_pacote` int(11) DEFAULT NULL,
  `data_cad_est_lacre_pacote` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_lacre_pacote_itens`
--

CREATE TABLE `entrada_estoque_lacre_pacote_itens` (
  `id_est_lacre_pacote_itens` int(11) NOT NULL,
  `id_pacote_est_lacre_pacote_itens` int(11) DEFAULT NULL,
  `item_est_lacre_pacote_itens` int(11) DEFAULT NULL,
  `id_mat_est_lacre_pacote_itens` int(11) DEFAULT NULL,
  `id_entrada_est_lacre_pacote_itens` int(11) DEFAULT NULL,
  `responsavel_est_lacre_pacote_itens` int(11) DEFAULT NULL,
  `data_est_lacre_pacote_itens` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque_mola`
--

CREATE TABLE `entrada_estoque_mola` (
  `id_est_mola` int(11) NOT NULL,
  `id_entrada_est_mola` int(11) DEFAULT NULL,
  `id_mat_est_mola` int(11) DEFAULT NULL,
  `quant_est_mola` int(11) DEFAULT NULL,
  `id_resp_est_mola` varchar(45) DEFAULT NULL,
  `data_cad_est_mola` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_equipe_func` int(11) NOT NULL,
  `id_equipe` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_cad_func_equipe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe_funcionarios`
--

INSERT INTO `equipe_funcionarios` (`id_equipe_func`, `id_equipe`, `id_funcionario`, `data_cad_func_equipe`) VALUES
(4, 1, 14, '2017-06-25 23:09:05'),
(5, 2, 12, '2017-08-08 02:09:41'),
(6, 1, 13, '2017-08-08 02:09:58'),
(7, 1, 15, '2017-08-22 03:38:36');

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
-- Estrutura da tabela `tipo_material`
--

CREATE TABLE `tipo_material` (
  `id_tipo_material` int(11) NOT NULL,
  `nome_tipo_material` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_material`
--

INSERT INTO `tipo_material` (`id_tipo_material`, `nome_tipo_material`) VALUES
(1, 'Hidrômetro A'),
(2, 'Hidrômetro B'),
(3, 'Hidrômetro C'),
(4, 'Hidrômetro D'),
(5, 'Hidrômetro Y'),
(6, 'Caixa Hidrômetro Y'),
(7, 'Lacre cordoalha de aço'),
(8, 'Mola dispositivo anti fraude');

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
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `rg_usuario`, `cpf_usuario`, `email_usuario`, `matricula_usuario`, `perfil_usuario`, `senha_usuario`, `status_usuario`, `data_cad_usuario`, `data_atualizacao_usuario`, `respo_cad_usuario`) VALUES
(1, 'Gabriel Costa', '22.222.222-2', '333.333.333-33', 'gabriel.cp1990@gmail.com', 'T00016110962', 2, '1bd5e0bb3f8b01c81a5a880c121bdbfd', 'ativo', '2017-06-17 05:22:40', '2017-06-26 00:14:38', NULL);

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
-- Indexes for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD PRIMARY KEY (`id_est_entrada`);

--
-- Indexes for table `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  ADD PRIMARY KEY (`id_est_caixa_hmy`),
  ADD KEY `fk_entrada_hmy_caixa_idx` (`id_entrada_est_caixa_hmy`);

--
-- Indexes for table `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  ADD PRIMARY KEY (`id_est_caixa_hmy_itens`),
  ADD KEY `fk_entrada_hmy_caixa_itens_idx` (`id_caixa_est_caixa_hmy_itens`);

--
-- Indexes for table `entrada_estoque_hm_avulso`
--
ALTER TABLE `entrada_estoque_hm_avulso`
  ADD PRIMARY KEY (`id_est_hm_avulso`),
  ADD KEY `fk_entrada_hm_avulso_idx` (`id_entrada_est_hm_avulso`);

--
-- Indexes for table `entrada_estoque_lacre_pacote`
--
ALTER TABLE `entrada_estoque_lacre_pacote`
  ADD PRIMARY KEY (`id_est_lacre_pacote`),
  ADD KEY `fk_id_entrada_estoque_idx` (`id_entrada_est_lacre_pacote`);

--
-- Indexes for table `entrada_estoque_lacre_pacote_itens`
--
ALTER TABLE `entrada_estoque_lacre_pacote_itens`
  ADD PRIMARY KEY (`id_est_lacre_pacote_itens`),
  ADD KEY `fk_entrada_lacre_pacote_itens_idx` (`id_pacote_est_lacre_pacote_itens`);

--
-- Indexes for table `entrada_estoque_mola`
--
ALTER TABLE `entrada_estoque_mola`
  ADD PRIMARY KEY (`id_est_mola`),
  ADD KEY `fk_entrada_mola_idx` (`id_entrada_est_mola`);

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
  ADD PRIMARY KEY (`id_equipe_func`);

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
-- Indexes for table `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`id_tipo_material`);

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
-- AUTO_INCREMENT for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  MODIFY `id_est_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  MODIFY `id_est_caixa_hmy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  MODIFY `id_est_caixa_hmy_itens` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `entrada_estoque_hm_avulso`
--
ALTER TABLE `entrada_estoque_hm_avulso`
  MODIFY `id_est_hm_avulso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `entrada_estoque_lacre_pacote`
--
ALTER TABLE `entrada_estoque_lacre_pacote`
  MODIFY `id_est_lacre_pacote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entrada_estoque_lacre_pacote_itens`
--
ALTER TABLE `entrada_estoque_lacre_pacote_itens`
  MODIFY `id_est_lacre_pacote_itens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;
--
-- AUTO_INCREMENT for table `entrada_estoque_mola`
--
ALTER TABLE `entrada_estoque_mola`
  MODIFY `id_est_mola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipe_funcionarios`
--
ALTER TABLE `equipe_funcionarios`
  MODIFY `id_equipe_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `id_tipo_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  ADD CONSTRAINT `fk_entrada_hmy_caixa` FOREIGN KEY (`id_entrada_est_caixa_hmy`) REFERENCES `entrada_estoque` (`id_est_entrada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  ADD CONSTRAINT `fk_entrada_hmy_caixa_itens` FOREIGN KEY (`id_caixa_est_caixa_hmy_itens`) REFERENCES `entrada_estoque_hmy_caixa` (`id_est_caixa_hmy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_hm_avulso`
--
ALTER TABLE `entrada_estoque_hm_avulso`
  ADD CONSTRAINT `fk_entrada_hm_avulso` FOREIGN KEY (`id_entrada_est_hm_avulso`) REFERENCES `entrada_estoque` (`id_est_entrada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_lacre_pacote`
--
ALTER TABLE `entrada_estoque_lacre_pacote`
  ADD CONSTRAINT `fk_entrada_lacre_pacote` FOREIGN KEY (`id_entrada_est_lacre_pacote`) REFERENCES `entrada_estoque` (`id_est_entrada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_lacre_pacote_itens`
--
ALTER TABLE `entrada_estoque_lacre_pacote_itens`
  ADD CONSTRAINT `fk_entrada_lacre_pacote_itens` FOREIGN KEY (`id_pacote_est_lacre_pacote_itens`) REFERENCES `entrada_estoque_lacre_pacote` (`id_est_lacre_pacote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_mola`
--
ALTER TABLE `entrada_estoque_mola`
  ADD CONSTRAINT `fk_entrada_mola` FOREIGN KEY (`id_entrada_est_mola`) REFERENCES `entrada_estoque` (`id_est_entrada`) ON DELETE CASCADE ON UPDATE CASCADE;

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
