-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Ago-2017 às 03:55
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

--
-- Extraindo dados da tabela `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nome_equipe`, `inspetor_equipe`, `observacao_equipe`, `tipo_equipe`, `status_equipe`, `data_cad_equipe`, `data_atualizacao_equipe`) VALUES
(1, 'Gabriel teste', 12, 'TESTE', 2, 'ativo', '2017-08-22', NULL);

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

--
-- Extraindo dados da tabela `entrada_estoque`
--

INSERT INTO `entrada_estoque` (`id_est_entrada`, `nota_remessa_est_entrada`, `atend_requisicao_est_entrada`, `arquivo_est_entrada`, `responsavel_est_entrada`, `status_est_entrada`, `data_est_entrada`) VALUES
(135, '123', '123', '12318.pdf', '1', 'aberto', '2017-08-23 02:55:37'),
(136, '456', '456', '456.pdf', '1', 'aberto', '2017-08-23 02:56:20'),
(137, '678', '678', '678.pdf', '1', 'aberto', '2017-08-23 03:03:32');

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

--
-- Extraindo dados da tabela `entrada_estoque_hm_avulso`
--

INSERT INTO `entrada_estoque_hm_avulso` (`id_est_hm_avulso`, `id_entrada_est_hm_avulso`, `id_mat_est_hm_avulso`, `numero_est_hm_avulso`, `id_resp_est_hm_avulso`, `data_cad_est_hm_avulso`) VALUES
(1, 137, 3, 'A10L102030', 1, '2017-08-23 03:06:52'),
(2, 137, 3, 'Y10L102030', 1, '2017-08-23 03:07:57');

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

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome_funcionario`, `rg_funcionario`, `cpf_funcionario`, `cargo_funcionario`, `telefone_funcionario`, `celular_funcionario`, `carro_funcionario`, `observacao_funcionario`, `status_funcionario`, `data_cad_funcionario`, `data_atualizacao_funcionario`, `responsavel_cad_funcionario`) VALUES
(12, 'Gabriel Costa Pinto', '47.270.088-1', '407.492.248-78', 2, '111-1111-1111', '222-22222-2222', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur risus vitae porttitor sodales. Phasellus ultrices arcu consequat, faucibus enim nec, aliquet nulla. Nullam ornare dui sed iaculis sollicitudin. Morbi sit amet felis mi. Donec sollicitudin laoreet lacus, et iaculis nibh porta in. Donec mattis felis viverra, pellentesque lectus sit amet, blandit dolor. Nunc rhoncus libero consequat, ultricies urna quis, volutpat neque. Integer vitae consectetur neque. Nulla quis volutpat nisi. Quisque sed dolor dapibus, hendrerit mauris eu, maximus ex. Pellentesque vitae suscipit neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin hendrerit hendrerit augue, sit amet finibus augue lacinia ut.\r\n\r\nMorbi et posuere erat, vel dictum augue. Suspendisse potenti. Aliquam sem urna, venenatis ac diam ac, iaculis volutpat diam. Nunc at nibh lorem. In eleifend, massa vitae sodales laoreet, augue nibh pharetra elit, quis aliquet eros est quis odio. Vivamus sagittis elit a ipsum vulputate, vitae eleifend lectus scelerisque. Nunc faucibus sollicitudin nulla, vehicula convallis orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas quis viverra est. Sed non nisl rhoncus, pharetra dui vel, mollis felis. Nulla convallis vestibulum eros, quis vestibulum leo mollis quis.\r\n\r\nIn accumsan, dolor tristique sollicitudin vulputate, ligula lorem convallis ligula, id ullamcorper ante sem a justo. Praesent ornare arcu at commodo euismod. Quisque aliquam porttitor sapien, et blandit massa rhoncus sed. Phasellus sit amet vulputate enim. Integer quis nisi id tellus porttitor viverra ornare quis ex. Nulla facilisi. Curabitur ultrices mollis odio, quis pretium nibh posuere sit amet. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris aliquet est luctus, bibendum sapien et, viverra dui. Vivamus blandit auctor quam, vitae molestie velit ultrices sed. Duis vehicula lectus non lacus sollicitudin pulvinar. Maecenas placerat nisl in libero elementum, eu vehicula dolor mollis.\r\n\r\nNam in leo dapibus, iaculis magna ac, maximus leo. Fusce elementum, tellus sit amet sollicitudin malesuada, dolor lorem ornare ex, non tempor enim urna et lectus. Donec a iaculis dui, suscipit commodo odio. Nunc ac nunc at enim dignissim pretium. Suspendisse vel neque odio. Suspendisse potenti. Nulla sed velit ac urna egestas convallis. Nam rhoncus non diam a auctor. Sed pellentesque erat at ante vulputate maximus.', 'inativo', '2017-06-14 02:57:28', '2017-06-14 03:08:41', NULL),
(13, 'Ana Paula Costa Pinto', '22.222.222-2', '333.333.333-33', 1, '555-5555-5555', '666-66666-6666', 6, 'Fusce sollicitudin rutrum erat sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut tincidunt libero. Nam auctor tempor malesuada. Nulla consectetur tristique orci ac dictum. Suspendisse ac pellentesque massa. Suspendisse accumsan imperdiet augue, at tempus tortor luctus at. Donec convallis nec dolor non varius. Quisque non felis ut eros ultricies suscipit. Nam odio est, varius ut eleifend vel, consequat eu turpis.', 'ativo', '2017-06-14 02:58:33', '2017-06-25 19:17:10', NULL),
(14, 'Antonio Mauricio Pinto', '66.666.666-6', '777.777.777-77', 3, '666-6666-6666', '333-33333-3333', 0, 'TESTE', 'ativo', '2017-06-14 02:59:08', NULL, NULL),
(15, 'Miguel Henrique Costa Pinto', '22.222.222-2', '555.555.555-55', 3, '666-6666-6666', '333-33333-3333', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dignissim risus in nisl commodo vehicula. Pellentesque et ultrices ex. Etiam porttitor hendrerit eros, nec dapibus metus ornare vel. Sed eu dui rutrum, consequat turpis eget, ullamcorper justo. Donec a odio eu nisi tempus condimentum nec vitae mi. Praesent at turpis nec mauris tempor varius sed nec lectus. Nam lorem diam, interdum vitae est sit amet, placerat eleifend nulla. Aliquam erat volutpat. In at mauris vel magna mattis euismod. Aliquam vel turpis suscipit est fringilla consectetur vitae id libero. Curabitur eleifend massa turpis, vel aliquet massa faucibus at. Donec luctus malesuada velit, sit amet ullamcorper metus dignissim interdum. Suspendisse potenti. Nunc ligula sem, cursus quis vulputate quis, feugiat convallis ante. Quisque tellus nunc, fringilla non pulvinar non, vestibulum quis mi. Nulla facilisis eu mi a accumsan.\r\n\r\nNam tempus facilisis sagittis. Phasellus quis augue at erat rutrum fermentum. Mauris bibendum a arcu sit amet pharetra. Donec dolor lacus, interdum et erat ut, scelerisque molestie risus. Integer consequat eget velit a dapibus. Cras condimentum laoreet sagittis. Praesent nunc nibh, bibendum eu massa eu, molestie volutpat metus. In non risus sem. Nullam at iaculis ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus accumsan, est non euismod rhoncus, lectus nibh porta felis, ut vestibulum elit dolor ut nibh. Praesent a viverra massa, vitae molestie tellus.\r\n\r\nInteger turpis mi, rhoncus vitae nibh et, commodo porttitor nisi. Praesent malesuada ullamcorper aliquet. Praesent turpis ligula, malesuada vitae tristique vitae, viverra id magna. Donec aliquet tellus et ipsum vulputate, sit amet egestas leo semper. Maecenas hendrerit scelerisque lacus in aliquam. Duis ultricies tempor justo vel rutrum. Morbi quis faucibus nisi. Nunc iaculis eros quis vehicula blandit. Aliquam scelerisque blandit nibh, non laoreet erat. Aenean ultricies ligula ac elit tempus rutrum. Nam id vulputate mi, in tincidunt diam.\r\n\r\nDonec mattis eleifend sodales. Duis iaculis, ex ac tristique malesuada, nunc sapien malesuada augue, at tristique justo diam sed dui. Aenean mollis molestie faucibus. Proin dapibus leo eget dolor rhoncus, quis faucibus dui lacinia. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent quis rutrum quam. Nulla vulputate eu lectus a malesuada. Nam in eros eros. Mauris ultricies, augue eu lacinia ornare, lectus turpis iaculis nunc, sed sagittis risus augue quis dolor. Morbi vulputate, ex a consequat rutrum, magna urna feugiat nunc, ac maximus eros sapien id metus. Donec nec leo ut felis sagittis dignissim hendrerit ut leo. Nam id lorem pretium, pretium lectus vel, sagittis odio. Donec libero tortor, laoreet in cursus efficitur, viverra ut quam. Ut fringilla velit dolor, ut fringilla neque ultrices sit amet.\r\n\r\nQuisque elementum dui ac lectus mattis, sed porta orci mollis. Vestibulum laoreet, risus sed euismod interdum, nisi leo sollicitudin urna, ut elementum ipsum nisl vel ante. Maecenas eu vestibulum ipsum. Proin sagittis nunc sed augue tincidunt varius. Nunc vitae arcu suscipit, eleifend ante et, tristique nisi. Morbi eu est ex. Praesent non eros quis nisi consequat sollicitudin in vel sapien.\r\n\r\nMorbi mattis risus eget purus scelerisque, at pharetra dolor semper. Sed ullamcorper sodales ligula, nec scelerisque quam posuere in. Curabitur tempus fringilla dictum. Proin et dui molestie, convallis odio ac, eleifend mauris. Mauris blandit felis eros, in cursus lorem vulputate sit amet. Ut ut nisi a nisl scelerisque mollis in in tortor. In tempus justo in sem tempor eleifend. Vivamus purus lacus, commodo tempor purus nec, tincidunt vehicula dolor. Vestibulum tincidunt risus id lacus feugiat laoreet. Nam facilisis pellentesque quam vitae aliquet. Pellentesque rhoncus, libero nec accumsan lobortis, massa sapien commodo ex, at laoreet metus leo non ipsum.\r\n\r\nProin nec pellentesque tellus, sed posuere est. Nullam et eros lectus. Aliquam interdum enim ligula, eu bibendum ipsum bibendum a. Sed eget luctus elit. Fusce dapibus mollis magna accumsan sagittis. Sed eget ultricies ex. Sed pharetra sed leo nec euismod. Vivamus sed vehicula lectus, vel pharetra risus. Sed dapibus aliquet commodo. Praesent ac fermentum ante, at gravida justo.\r\n\r\nVestibulum ac diam consequat, pharetra justo tempus, varius tortor. Duis magna justo, ultrices vel tristique scelerisque, placerat in sem. Vivamus ultricies, nisi ut porta vestibulum, odio orci eleifend orci, malesuada gravida tellus eros eget arcu. Duis posuere libero eget lorem placerat ullamcorper. Donec id semper metus. Mauris nisl mauris, convallis eu lobortis sed, hendrerit in nisi. Ut pulvinar vehicula risus, id molestie nibh placerat nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam interdum eros odio. Phasellus maximus in erat a maximus. Vivamus sed turpis sed augue mattis gravida. Aliquam turpis lorem, condimentum et commodo eu, aliquam sit amet ante.\r\n\r\nDuis tincidunt purus in erat sagittis, a tincidunt elit sagittis. Integer ut sem tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus nulla a lacinia auctor. Sed et auctor massa. Suspendisse ultrices sagittis odio sit amet sollicitudin. Fusce laoreet convallis ante a vestibulum. Mauris fermentum leo ac dolor accumsan, in congue est facilisis. Vestibulum lacinia metus ligula, imperdiet gravida felis imperdiet eu. Nullam imperdiet risus vel mi faucibus fermentum vel vel metus. Quisque ligula magna, feugiat id fringilla non, porttitor at lacus.', 'ativo', '2017-06-14 02:59:53', '2017-06-14 03:01:04', NULL),
(16, 'TESTE', '22.222.222-2', '333.333.333-33', 2, '888-8888-8888', '999-99999-9999', 4, 'TESTE', 'ativo', '2017-06-25 19:23:50', NULL, NULL);

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
(6, 'Lacre cordoalha de aço'),
(7, 'Mola dispositivo anti fraude');

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
-- Indexes for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD PRIMARY KEY (`id_est_entrada`);

--
-- Indexes for table `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  ADD PRIMARY KEY (`id_est_caixa_hmy`),
  ADD KEY `id_entrada_estoque_idx` (`id_entrada_est_caixa_hmy`);

--
-- Indexes for table `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  ADD PRIMARY KEY (`id_est_caixa_hmy_itens`),
  ADD KEY `id_entrada_estoque_hmy_caixa_idx` (`id_caixa_est_caixa_hmy_itens`);

--
-- Indexes for table `entrada_estoque_hm_avulso`
--
ALTER TABLE `entrada_estoque_hm_avulso`
  ADD PRIMARY KEY (`id_est_hm_avulso`);

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
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipe_funcionarios`
--
ALTER TABLE `equipe_funcionarios`
  MODIFY `id_equipe_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  MODIFY `id_est_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  MODIFY `id_est_caixa_hmy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  MODIFY `id_est_caixa_hmy_itens` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=524;
--
-- AUTO_INCREMENT for table `entrada_estoque_hm_avulso`
--
ALTER TABLE `entrada_estoque_hm_avulso`
  MODIFY `id_est_hm_avulso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
  MODIFY `id_tipo_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Limitadores para a tabela `entrada_estoque_hmy_caixa`
--
ALTER TABLE `entrada_estoque_hmy_caixa`
  ADD CONSTRAINT `id_entrada_estoque` FOREIGN KEY (`id_entrada_est_caixa_hmy`) REFERENCES `entrada_estoque` (`id_est_entrada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrada_estoque_hmy_caixa_itens`
--
ALTER TABLE `entrada_estoque_hmy_caixa_itens`
  ADD CONSTRAINT `id_entrada_estoque_hmy_caixa` FOREIGN KEY (`id_caixa_est_caixa_hmy_itens`) REFERENCES `entrada_estoque_hmy_caixa` (`id_est_caixa_hmy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`perfil_usuario`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
