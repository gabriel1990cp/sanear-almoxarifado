-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jul-2017 às 23:59
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pedido_garantido`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_md5_cliente` varchar(32) DEFAULT NULL,
  `nome_cliente` varchar(50) NOT NULL,
  `rg_cliente` varchar(15) DEFAULT NULL,
  `cpf_cliente` varchar(20) DEFAULT NULL,
  `cnpj_cliente` varchar(20) DEFAULT NULL,
  `email_cliente` varchar(50) DEFAULT NULL,
  `cep_cliente` varchar(20) DEFAULT NULL,
  `endereco_cliente` varchar(60) DEFAULT NULL,
  `numero_cliente` varchar(10) DEFAULT NULL,
  `complemento_cliente` varchar(50) DEFAULT NULL,
  `bairro_cliente` varchar(50) DEFAULT NULL,
  `cidade_cliente` varchar(50) DEFAULT NULL,
  `estado_cliente` varchar(50) DEFAULT NULL,
  `referencia_cliente` varchar(70) DEFAULT NULL,
  `telefone_cliente` varchar(20) DEFAULT NULL,
  `celular_cliente` varchar(20) DEFAULT NULL,
  `data_cad_cliente` datetime DEFAULT NULL,
  `senha_cliente` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_md5_cliente`, `nome_cliente`, `rg_cliente`, `cpf_cliente`, `cnpj_cliente`, `email_cliente`, `cep_cliente`, `endereco_cliente`, `numero_cliente`, `complemento_cliente`, `bairro_cliente`, `cidade_cliente`, `estado_cliente`, `referencia_cliente`, `telefone_cliente`, `celular_cliente`, `data_cad_cliente`, `senha_cliente`) VALUES
(3, '3d1a01edb1a15dfc55a7e86756c10db4', 'Manoel', '22.222.222-2', '111.111.111-11', '00.000.000/0000-00', 'gabriel.cp1990@gmail.com', '02039-050', 'Rua Joaquim Osório de Azevedo', '1', '1', 'Jardim São Paulo(Zona Norte)', 'São Paulo', 'SP', '111111111', '1111-1111', '11111-1111', '2016-06-09 05:12:42', NULL),
(4, 'd195eec5ca33c9267226211c6bff0305', 'teste', '33.333.333-3', '222.222.222-22', '11.111.111/1111-11', 'mariajose', '02039-050', 'Rua Joaquim Osório de Azevedo', '1', '1', '1', 'São Paulo', 'SP', '', '1111-1111', '11111-1111', '2016-06-09 05:28:32', 'alessandro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_prod`
--

CREATE TABLE `entrada_prod` (
  `id_entrada_prod` int(10) UNSIGNED NOT NULL,
  `id_md5_entrada_prod` varchar(32) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `fornecedor_entrada_prod` varchar(45) DEFAULT NULL,
  `compra_entrada_prod` double(9,2) DEFAULT NULL,
  `venda_entrada_prod` double(9,2) DEFAULT NULL,
  `quant_entrada_prod` varchar(45) DEFAULT NULL,
  `nota_entrada_prod` varchar(45) DEFAULT NULL,
  `data_entrada_produto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='			';

--
-- Extraindo dados da tabela `entrada_prod`
--

INSERT INTO `entrada_prod` (`id_entrada_prod`, `id_md5_entrada_prod`, `id_produto`, `fornecedor_entrada_prod`, `compra_entrada_prod`, `venda_entrada_prod`, `quant_entrada_prod`, `nota_entrada_prod`, `data_entrada_produto`) VALUES
(3, 'faa0340cd28113e1fc36b695ced8055b', 3, 'Gabriel', 1.11, 2.22, '11', '11', '2016-06-09 05:03:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id_itens_pedido` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT '0',
  `id_cliente_itens_pedido` int(11) DEFAULT NULL,
  `id_produto_itens_pedido` int(11) DEFAULT NULL,
  `quant_produto_itens_pedido` int(11) DEFAULT NULL,
  `valor_prod_itens_pedido` double(9,2) DEFAULT NULL,
  `data_itens_pedido` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id_itens_pedido`, `id_pedido`, `id_cliente_itens_pedido`, `id_produto_itens_pedido`, `quant_produto_itens_pedido`, `valor_prod_itens_pedido`, `data_itens_pedido`) VALUES
(3, 3, 2, 3, 1, 2.22, '2016-06-09'),
(4, 3, 2, 3, 2, 2.22, '2016-06-09'),
(5, 4, 2, 3, 1, 2.22, '2016-06-09'),
(6, 5, 3, 3, 1, 2.22, '2016-06-09'),
(7, 6, 4, 3, 1, 2.22, '2016-06-09'),
(8, 7, 4, 3, 2, 2.22, '2016-06-09'),
(9, 8, 2, 3, 10, 2.22, '2017-05-02'),
(10, 0, 2, 3, 1, 2.22, '2017-05-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(10) NOT NULL,
  `usuario_login` varchar(40) NOT NULL,
  `senha_login` varchar(32) NOT NULL,
  `acessos_login` int(10) NOT NULL,
  `tipo_perfil_login` int(11) DEFAULT NULL,
  `status_login` varchar(45) DEFAULT NULL,
  `data_cadastro_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_login`, `usuario_login`, `senha_login`, `acessos_login`, `tipo_perfil_login`, `status_login`, `data_cadastro_login`) VALUES
(1, 'gabriel.cp1990@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `cliente_pedido` int(11) DEFAULT NULL,
  `pagamento_pedido` varchar(45) DEFAULT NULL,
  `data_pedido` datetime DEFAULT NULL,
  `status_final_pedido` varchar(50) DEFAULT 'pendente',
  `data_status` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `cliente_pedido`, `pagamento_pedido`, `data_pedido`, `status_final_pedido`, `data_status`) VALUES
(3, 2, 'Dinheiro', '2016-06-09 05:04:04', 'pendente', NULL),
(4, 2, 'Cheque', '2016-06-09 05:06:57', 'Entrega Confirmada', '2016-06-09 05:09:05'),
(5, 3, 'Cartão', '2016-06-09 05:13:09', 'Entrega Confirmada', '2017-05-03 01:24:29'),
(6, 4, 'Cheque', '2016-06-09 05:31:51', 'pendente', NULL),
(7, 4, 'Cheque', '2016-06-09 05:39:23', 'pendente', NULL),
(8, 2, 'Dinheiro', '2017-05-02 04:37:58', 'pendente', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `id_md5_produto` varchar(32) DEFAULT NULL,
  `descricao_produto` varchar(50) NOT NULL,
  `cat_produto` varchar(45) DEFAULT NULL,
  `peso_produto` int(10) DEFAULT NULL,
  `unid_med_produto` enum('kg','ml','lt') DEFAULT NULL,
  `marca_produto` varchar(45) DEFAULT NULL,
  `cod_produto` varchar(45) DEFAULT NULL,
  `data_cad_produto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_md5_produto`, `descricao_produto`, `cat_produto`, `peso_produto`, `unid_med_produto`, `marca_produto`, `cod_produto`, `data_cad_produto`) VALUES
(3, 'fe146fcfcfb677b13e908bf6b5f73c72', 'Aguá', 'GALÃO', 350, 'ml', 'Agua boa', '1045', '2016-06-09 05:03:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_pedido`
--

CREATE TABLE `status_pedido` (
  `id_status_pedido` int(11) NOT NULL,
  `id_pedido_status_pedido` int(11) DEFAULT NULL,
  `status_pedido` varchar(50) DEFAULT NULL,
  `data_status_pedido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status_pedido`
--

INSERT INTO `status_pedido` (`id_status_pedido`, `id_pedido_status_pedido`, `status_pedido`, `data_status_pedido`) VALUES
(8, 3, 'Pendente', '2016-06-09 05:04:04'),
(9, 4, 'Pendente', '2016-06-09 05:06:57'),
(10, 4, 'Cliente não atendeu 1ª tentativa', '2016-06-09 05:07:31'),
(11, 4, 'Entrega Confirmada', '2016-06-09 05:09:05'),
(12, 5, 'Pendente', '2016-06-09 05:13:09'),
(13, 6, 'Pendente', '2016-06-09 05:31:51'),
(14, 7, 'Pendente', '2016-06-09 05:39:23'),
(15, 7, 'Não entregue', '2017-05-02 01:38:55'),
(16, 8, 'Pendente', '2017-05-02 04:37:58'),
(17, 8, 'Em Trânsito', '2017-05-02 04:38:20'),
(18, 8, 'Cliente não atendeu 1ª tentativa', '2017-05-03 01:23:10'),
(19, 5, 'Cliente não atendeu 1ª tentativa', '2017-05-03 01:23:30'),
(20, 5, 'Entrega Confirmada', '2017-05-03 01:24:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `entrada_prod`
--
ALTER TABLE `entrada_prod`
  ADD PRIMARY KEY (`id_entrada_prod`);

--
-- Indexes for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id_itens_pedido`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `status_pedido`
--
ALTER TABLE `status_pedido`
  ADD PRIMARY KEY (`id_status_pedido`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `entrada_prod`
--
ALTER TABLE `entrada_prod`
  MODIFY `id_entrada_prod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id_itens_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status_pedido`
--
ALTER TABLE `status_pedido`
  MODIFY `id_status_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
