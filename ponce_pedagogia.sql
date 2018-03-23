-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 18/03/2018 às 14:13
-- Versão do servidor: 10.0.32-MariaDB-0+deb8u1
-- Versão do PHP: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `ponce_pedagogia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `administrador`
--

INSERT INTO `administrador` (`id`, `nome`, `email`, `senha`, `data_registro`) VALUES
(1, 'Darlan Nakamura', 'darlannakamura@hotmail.com', '$2y$12$1DNXn9p7z4QNk.3sGoyKI.rShPrUJqSbDTcEVl2ZKzE1XQ1b4yRx.', '2018-02-27 13:08:32'),
(2, 'Rosiane Ponce', 'rosianeponce@congresso.com.br', '$2y$12$TWl2LkTAzucY0C8MBHzkg.v8B0QMyj9x4F734nn12rWZllShoj1V6', '2018-03-06 15:01:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_graduacao`
--

CREATE TABLE IF NOT EXISTS `aluno_graduacao` (
  `id_participante` int(11) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `cidade_instituicao` varchar(255) NOT NULL,
  `estado_instituicao` varchar(2) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `semestre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `aluno_graduacao`
--

INSERT INTO `aluno_graduacao` (`id_participante`, `instituicao`, `cidade_instituicao`, `estado_instituicao`, `curso`, `semestre`) VALUES
(6, 'Unesp', 'Presidente Prudente', 'SP', 'Computação', '5 termo'),
(7, 'Harvard', 'Cambridge', 'RN', 'Ciência da Computação ', 'Oitavo semestre '),
(8, 'FCT Unesp - Presidente Prudente', 'Presidente Prudente', 'SP', 'Ciência da Computação', 'Terceiro Semestre'),
(9, 'Unesp', 'Presidente Prudente', 'SP', 'Ciencia da Computação', '8 semestre'),
(10, 'FCT UNESP', 'Presidente Prudente', 'SP', 'Computação', 'Terceiro '),
(13, 'UNESP', 'Presidente Prudente', 'SP', 'Pedagogia', 'Segundo'),
(14, 'UNESP', 'Presidente Prudente', 'SP', 'Ciência da Computação', 'Terceiro semestre'),
(32, 'Unesp', 'Presidente Prudente', 'SP', 'Ciencia da Computaçao', '7 semestre'),
(34, 'FCT UNESP ', 'Presidente Prudente', 'SP', 'Computação ', '3'),
(35, 'FCT - Unesp', 'Presidente Prudente', 'SP', 'História', '5'),
(38, 'FCT UNESP', 'Presidente Prudente', 'SP', 'Ciência da Computação', '9'),
(39, 'FCT - Unesp', 'Presidente Prudente', 'SP', 'Ciência da Computação', '9'),
(41, 'Unesp', 'Venceslau', 'SP', 'Engenharia de Pesca', '17 semestre'),
(52, 'Unoeste', 'Presidente Prudente', 'SP', 'Educação Física', '5');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_pos_graduacao`
--

CREATE TABLE IF NOT EXISTS `aluno_pos_graduacao` (
  `id_participante` int(11) NOT NULL,
  `tematica_da_pesquisa` varchar(255) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `cidade_instituicao` varchar(255) NOT NULL,
  `estado_instituicao` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `aluno_pos_graduacao`
--

INSERT INTO `aluno_pos_graduacao` (`id_participante`, `tematica_da_pesquisa`, `instituicao`, `cidade_instituicao`, `estado_instituicao`, `curso`) VALUES
(3, 'História e Educação', 'Unesp  de Assis', 'Assis', 'SP', 'História'),
(5, 'Pedagogia', 'ITA', 'São Carlos', 'BA', 'Biologia'),
(11, 'Fkksjcks', 'Fksdj', 'Dlksjfkdkdkd', 'SP', 'Dkksjsjs'),
(15, 'C para projetos', 'UNESP', 'Presidente Prudente', 'SP', 'Ciência da Computação'),
(33, 'A arte da liderança ', 'UFMS', 'Campo Grande', 'MS', 'Pedagogia '),
(44, 'Linguagem interna e autodomínio da conduta', 'Unesp', 'Presidente Prudente ', 'SP', 'Mestrado em educação '),
(48, 'Pedagogia Aplicada à Educação', 'Harvard', 'Dracena', 'SP', 'Química'),
(49, 'Potato', 'Unesp', 'Dracena', 'MA', 'Dracea');

-- --------------------------------------------------------

--
-- Estrutura para tabela `coautor`
--

CREATE TABLE IF NOT EXISTS `coautor` (
  `id_participante` int(11) NOT NULL,
  `id_trabalho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `demais_profissionais`
--

CREATE TABLE IF NOT EXISTS `demais_profissionais` (
  `id_participante` int(11) NOT NULL,
  `area_de_atuacao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `demais_profissionais`
--

INSERT INTO `demais_profissionais` (`id_participante`, `area_de_atuacao`) VALUES
(30, 'Saúde'),
(31, 'darlan'),
(37, 'Educação'),
(43, 'Psicólogo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eixo`
--

CREATE TABLE IF NOT EXISTS `eixo` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `eixo`
--

INSERT INTO `eixo` (`id`, `nome`) VALUES
(1, 'Fundamentos teórico-filosóficos da Pedagogia Histórico-Crítica'),
(2, 'Fundamentos Psicológicos da Pedagogia Histórico-crítica'),
(3, 'Fundamentos Didáticos, Currículo e Pedagogia Histórico-crítica'),
(4, 'Educação inclusiva e Pedagogia Histórico-crítica'),
(5, 'Educação do Campo, luta de classes e Pedagogia Histórico-Crítica'),
(6, 'Educação não-formal, identidades sociais e Pedagogia Histórico-Crítica');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descricao` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `log`
--

INSERT INTO `log` (`id`, `ip`, `timestamp`, `descricao`, `id_usuario`) VALUES
(1, '179.247.245.96', '2018-03-16 02:43:19', 'O participante alterou os dados.', 40),
(2, '179.247.245.96', '2018-03-16 02:51:06', 'O participante efetuou o login.', 40),
(3, '179.247.245.96', '2018-03-16 02:51:19', 'O participante saiu do painel.', 40),
(4, '179.247.245.96', '2018-03-16 02:52:48', 'O participante efetuou o login.', 40),
(5, '179.247.245.96', '2018-03-16 02:56:12', 'O participante enviou uma dúvida.', 40),
(6, '179.247.245.96', '2018-03-16 02:59:21', 'O participante enviou uma dúvida.', 40),
(7, '179.247.245.96', '2018-03-16 03:00:01', 'O participante enviou uma dúvida.', 40),
(8, '179.247.245.96', '2018-03-16 03:35:00', 'O participante saiu do painel.', 40),
(9, '186.217.106.1', '2018-03-16 16:44:05', 'O participante saiu do painel.', 2),
(10, '186.217.106.1', '2018-03-16 16:54:05', 'O participante efetuou o login.', 49),
(11, '186.217.106.1', '2018-03-16 17:21:26', 'O participante enviou o comprovante.', 49),
(12, '186.217.106.1', '2018-03-16 18:21:29', 'O participante efetuou o login.', 49),
(13, '186.217.107.82', '2018-03-16 18:55:52', 'O participante efetuou o login.', 40),
(14, '187.73.216.108', '2018-03-17 01:29:02', 'Participante cadastrado com sucesso.', 52),
(15, '187.73.216.108', '2018-03-17 01:30:03', 'O participante efetuou o login.', 52),
(16, '187.73.216.108', '2018-03-17 01:35:35', 'O participante efetuou o login.', 52),
(17, '189.124.4.111', '2018-03-17 11:48:26', 'Participante cadastrado com sucesso.', 53),
(18, '189.124.4.111', '2018-03-17 11:49:27', 'O participante efetuou o login.', 53),
(19, '187.57.231.238', '2018-03-18 16:19:25', 'O participante efetuou o login.', 40),
(20, '187.57.231.238', '2018-03-18 16:19:46', 'O participante saiu do painel.', 40),
(21, '187.57.231.238', '2018-03-18 16:20:00', 'O participante efetuou o login.', 49),
(22, '143.208.113.2', '2018-03-18 16:52:30', 'O participante efetuou o login.', 49),
(23, '143.208.113.2', '2018-03-18 17:07:19', 'O participante efetuou o login.', 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `minicurso`
--

CREATE TABLE IF NOT EXISTS `minicurso` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `minicurso`
--

INSERT INTO `minicurso` (`id`, `nome`, `data_registro`) VALUES
(1, 'Educação Inclusiva e Pedagogia Histórico-crítica', '2018-03-02 16:47:03'),
(2, 'Fundamentos Filosóficos da Pedagogia Histórico-crítica e Políticas educacionais Contemporâneas', '2018-03-02 16:47:03'),
(3, 'Adolescência, atividade de estudo e formação de conceitos', '2018-03-06 05:13:06'),
(4, 'Contribuições da Neuropsicologia para a compreensão do desenvolvimento das Funções Psicológicas Superiores e dos problemas de escolarização', '2018-03-06 05:13:06'),
(5, 'Literatura infantil e a Pedagogia Histórico-crítica', '2018-03-06 05:13:06'),
(6, 'O ensino escolar na primeira infância', '2018-03-06 05:13:06'),
(7, 'Relações entre os Fundamentos Psicológicos da Pedagogia Histórico-crítica e Currículo', '2018-03-06 05:13:06'),
(8, 'A alfabetização sob o enfoque histórico-crítico', '2018-03-06 05:13:06'),
(9, 'A organização da atividade de ensino pelo professor alfabetizador: contribuição da Teoria Histórico-Cultural', '2018-03-06 05:13:06'),
(10, 'Conferência de encerramento: “A defesa da escola pública na perspectiva histórico-crítica em tempos de suicídio democrático” - Dermeval Saviani.', '2018-03-06 05:13:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `nivel`
--

INSERT INTO `nivel` (`id`, `nome`) VALUES
(1, 'Educação Infantil'),
(2, 'Fundamental I'),
(3, 'Fundamental II'),
(4, 'Ensino Médio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `submeter_trabalho` int(11) NOT NULL COMMENT '0 - Não, 1 - SIM',
  `foto_comprovante` varchar(255) NOT NULL,
  `id_tipo_inscricao` int(11) NOT NULL,
  `status_inscricao` int(11) NOT NULL COMMENT '0 - Em Análise, 1 - Aprovado, 2 - Reprovado',
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_resposta` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `key_ativar` varchar(255) NOT NULL,
  `ativo` int(11) NOT NULL COMMENT '0 - Não, 1 - SIM'
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `participante`
--

INSERT INTO `participante` (`id`, `nome`, `email`, `cpf`, `celular`, `telefone`, `endereco`, `numero`, `bairro`, `complemento`, `cidade`, `estado`, `cep`, `submeter_trabalho`, `foto_comprovante`, `id_tipo_inscricao`, `status_inscricao`, `senha`, `data_registro`, `data_resposta`, `key_ativar`, `ativo`) VALUES
(1, 'Felipe Nakamura', 'felipe@hotmail.com', '999.999.999-99', '(18) 9999-9999', '', 'Avenida do Teste', '123', 'Teste', 'Casa', 'Dracena', 'SP', '17900-000', 1, '3c80a6dfeb0fa6ea4c0be4344e7b00a9.pdf', 1, 0, '$2y$12$KW9dyt8fZOXEdA60TZ4RmewlsAdCm9T7Nrg4Igi2iXzCYGQRT57RO', '2018-02-27 13:14:01', '2018-02-14 02:00:00', '', 1),
(3, 'Ana Paula Ferrari Peres', 'ana_ferrari93@outlook.com', '999.999.999-99', '(18) 99667-5424', 'telefone', 'Alameda Salvador, 433', '', 'Portal dos Girassóis', '', 'Dracena', 'SP', '19020410', 1, '0b0ecbf39f1f312692116c10d417bf9b.png', 2, 3, '$2y$12$lK0u0snKPOLGfiejU0ZVeO.Yw4WBoMiEAjY7.CiCasuT5hzEBz.p2', '2018-03-01 13:04:22', '0000-00-00 00:00:00', '', 1),
(4, 'Arthur Reis', 'arthur@hotmail.com', '45287632819', '999999999', '9999999999', 'Rua do teste', '', 'Parque das Aroeiras', '', 'Monte Aprazível', 'SP', '15150000', 0, '791ed87220551025b0408b68113b477f.jpg', 3, 2, '$2y$12$GVV98.u8bv7o/wihqL1CJes0ckbJu8BTi/zHOBnUhKKC4EX8ue68S', '2018-03-01 21:12:34', '0000-00-00 00:00:00', '', 0),
(5, 'Bruno Santos', 'bruno@hotmail.com', '123123123', '999999999', '999999999999', 'Avenida Teste', '', 'Centro', '', 'Dracena', 'SP', '19020410', 1, '4998f3c0b68429f59de7d5cd6955c4dc.jpeg', 2, 1, '$2y$12$LBxN8K10NM.SotKSAXQZFuzs5fovRgO7bL0mq3Rope..JohU5POF6', '2018-03-02 16:46:33', '0000-00-00 00:00:00', '', 0),
(6, 'Giulia Campos de Oliveira', 'giuliacoliveira@gmail.com', '393.348.278-07', '(13) 98169-5675', '(13) 3329-5281', 'Rua Rui Barbosa', '', 'Canto do Forte', '', 'Praia Grande', 'SP', '11700-170', 1, '', 1, 0, '$2y$12$ATZqzbnDSJCXGGbWiLR5H.5.CMx91wJ/U4dt.ntTni2ywNYAMqXTa', '2018-03-05 18:49:44', '0000-00-00 00:00:00', '', 0),
(7, 'Bruno dos Santos', 'bruh_santos@live.com', '449.528.508-69', '(18) 99695-4531', '(18) 3263-2576', 'Rua João Salum, 31', '', 'Vila Prado', '', 'Santo Anastácio', 'SP', '19360-000', 1, '5ce7a770389fdd860ca8f91567a768c8.png', 1, 1, '$2y$12$vV4fSBYjxy6kcfeUqSUddeqac5P1YoJTjVDDdDrASmnIa5j5z1Nyq', '2018-03-05 18:50:39', '0000-00-00 00:00:00', '', 0),
(8, 'Luiz Filipe Monge', 'luizfilipemonge@hotmail.com', '475.110.638-45', '(18) 99673-5986', '', 'Rua José Bongiovani 1545', '', 'Jardim Esplanada', '', 'Presidente Prudente', 'SP', '19061-450', 0, '', 1, 0, '$2y$12$H6BbPMHWcsTt51Vnl3mJNu02Zy0L.Bip7UFcRMBwPUV5rgWUoCXAq', '2018-03-05 18:58:04', '0000-00-00 00:00:00', '', 0),
(9, 'Pietro Barcarollo Schiavinato', 'pietrobschiavinato@outlook.com', '430.006.378-85', '(18) 99762-7854', '(18) 3324-7376', 'Rua Anita Garibaldi', '', 'Vila Santa Rita', '', 'Assis', 'SP', '19807-290', 1, '', 1, 0, '$2y$12$rhOFP/g02TPYClQtc6hxYuaAl44SKV7XD3OhRfpveGqhIqnIIwIde', '2018-03-05 19:18:29', '0000-00-00 00:00:00', '', 0),
(10, 'Vinícius Vedovotto', 'vinicius_vedovotto@hotmail.com', '446.248.208-51', '(19) 99868-2834', '(19) 3855-1177', 'Rua Alfredo Macarini', '', 'Jardim das Rosas', '', 'Presidente Prudente', 'SP', '19060-240', 0, '', 1, 0, '$2y$12$H6V21TsHiXG3kHvtDxyLJ.x4dGn2qK0XI3qNXeBfU6Z4lwzfsF2v2', '2018-03-05 19:30:00', '0000-00-00 00:00:00', '', 0),
(11, 'Rafael chaves', 'teco@1', '123.556.552-87', '(11) 11155-5228', '', 'Rua Valdemar Severo Bonfim', '', 'Jardim Santa Mônica', '', 'Presidente Prudente', 'SP', '19045-280', 0, '', 2, 0, '$2y$12$AWMXc35Q77AMPfeRxcLhLuXAeM20jvdi/NCu4RpFTFayLQ/cEcNWa', '2018-03-05 19:34:06', '0000-00-00 00:00:00', '', 0),
(12, 'Arthur Reis da Silva', 'arthur_aero@hotmail.com', '452.557.118-70', '(18) 98187-5909', '(17) 3265-2670', 'Rua Rodrigo de Oliveira Lima', '', 'Parque das Aroeiras', '', 'Monte Aprazível', 'SP', '15150-000', 1, '35d8295e45e004a440d93da4900c26e4.png', 3, 1, '$2y$12$wX8GZ.PJXGsTizDXb.2pcOrf3V5NS1TOtlA92n16SGarR/rAzTBRi', '2018-03-05 19:38:14', '0000-00-00 00:00:00', '', 0),
(13, 'João da Silva', 'joao_silva@hotmail.com', '234.234.424-43', '(18) 99329-3458', '', 'Av. Brasil', '', 'Centro', '', 'Teodoro Sampaio', 'SP', '19280-000', 1, '', 1, 0, '$2y$12$qPPiUIExsiCBcpK0IFwbDueV3kh7B68lmAsF8.D0Be5rnUd/Fb8gy', '2018-03-05 20:05:24', '0000-00-00 00:00:00', '', 0),
(14, 'Jediael Morais', 'jediaelms@hotmail.com', '423.425.534-54', '(18) 99432-3433', '', 'Av. Brasil', '', 'Centro', '', 'Teodoro Sampaio', 'SP', '19280-000', 1, '', 1, 0, '$2y$12$yc583KtlMk2v1KN22WON7e2acyvneEgacMwnb40Bzti19z5zKKz5W', '2018-03-05 20:14:07', '0000-00-00 00:00:00', '', 0),
(15, 'Teste', 'teste@teste.com', '222.222.222-22', '(11) 11111-1111', '(22) 2222-2222', 'Rua Melem Isaac', '', 'Jardim das Rosas', '', 'Presidente Prudente', 'SP', '19060-140', 1, '87fa79dd98c78e2aac244e9221d49a56.png', 2, 0, '$2y$12$7hv9nDsMzT/z25SkSCdane4WHd52gv4SpMD1szVzQAyfMThNTy8cq', '2018-03-05 22:03:13', '0000-00-00 00:00:00', '', 0),
(28, 'Darlan Murilo Nakamura de Araújo', 'darlanmnakamura@gmail.com', '452.876.328-19', '(18) 99743-1595', '(18) 9999-9999', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, '405dc016531a9d6536c2758e5867b609.jpeg', 4, 0, '$2y$12$ycNrRXHAUiJvNuptnGVLIuEJBrUWG/ifgWuPyDTHQk06BMvvnZ4ma', '2018-03-06 02:52:32', '0000-00-00 00:00:00', '8851', 1),
(30, 'Projetos EJcomp', 'projetos.ejcomp@gmail.com', '354.449.805-76', '(18) 99743-1595', '(18) 9999-9999', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, '', 5, 0, '$2y$12$JfkRlq8SpIcr0DWkcnozJOCOXbDKG8/uh6V7uB1hXJhHNBl4zNT7O', '2018-03-06 02:58:42', '0000-00-00 00:00:00', 'fb78', 1),
(31, 'teco', 'teco@hotmail.com', '280.051.839-17', '(99) 99999-9999', '(99) 9999-9999', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, '', 5, 0, '$2y$12$Qd3H9IH90E0xVn1L76gm1.qGnA84RRPaL1h5UHYD5mO8C3W3lrFIC', '2018-03-06 03:04:43', '0000-00-00 00:00:00', '', 0),
(32, 'FELIPE TANJI RIBEIRO', 'felipetanjir@gmail.com', '470.054.968-84', '(18) 99198-0684', '(18) 3271-1052', 'Carlos Gomes', '', 'Centro', '', 'Presidente Venceslau', 'SP', '19400-000', 0, '', 1, 0, '$2y$12$aMU7S3Ud5GhQw6uBkiGIceq6rWElBQb7ZaWmO634ccfTW6QtGEcbe', '2018-03-06 03:08:00', '0000-00-00 00:00:00', '41dc3e8c', 1),
(33, 'João Marcelo', 'gregoquiral@gmail.com', '187.257.788-11', '(18) 99631-1598', '(18) 3263-2576', 'Rua Jardim das Rosas', '', 'Vila São José', '', 'Santo Anastácio', 'SP', '19360-000', 0, '', 2, 0, '$2y$12$TOLa0JlPDouI5Pq5.yF0qOXAyyaz/t4A39KfSZ6Zb/aTVsAKSeT.q', '2018-03-06 03:11:23', '0000-00-00 00:00:00', '51c8962b', 1),
(34, 'João Pedro Silva Baptista', 'joaosbaptista@hotmail.com', '471.829.828-89', '(11) 99516-7239', '', 'Rua Dona Militânia', '', 'Vila Santa Helena', '', 'Presidente Prudente', 'SP', '19015-690', 0, '', 1, 0, '$2y$12$V9PgFVoMMs/.W1qFXMROnOOI9X5sHkNUlCTEPBP4KvK4O.Cvx6GgO', '2018-03-06 03:13:02', '0000-00-00 00:00:00', '3dfde7f1', 0),
(35, 'Ana Paula Ferrari Peres', 'ana@hotmail.com', '280.607.820-29', '(99) 99999-9999', '(99) 9999-9999', 'Avenida Presidente Vargas, 1604', '', 'Centro', '', 'Dracena', 'SP', '17900-000', 1, '', 1, 0, '$2y$12$Pz3dMd8sQ2FIJmHPyAop/.aG.WSK.I0fdW8yv8r2KK37y0Yf66l5S', '2018-03-06 05:05:21', '0000-00-00 00:00:00', '', 0),
(37, 'Teste da Madrugada', 'joao_da_silvev@hotmail.com', '985.586.480-85', '(99) 99999-9999', '(99) 9999-9999', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 0, '', 5, 0, '$2y$12$I7HzKddloebzIreF0GNT2.BW7yKFJPYuowgbyYwxzogJsd2cuPMcq', '2018-03-06 05:10:03', '0000-00-00 00:00:00', '507bedf6', 0),
(38, 'Matheus Palmeira Gonçalves dos Santos', 'matheus_160497@hotmail.com', '453.669.608-35', '(12) 99724-1795', '', 'Rua Marechal Rondon', '', 'Jardim Amália', '', 'Caçapava', 'SP', '12280-019', 1, '', 1, 0, '$2y$12$mmPKv07c4t9uYplAc4Jplexw8W/0FcLywF0MsqfA/bElPaDOB9RdS', '2018-03-06 14:37:47', '0000-00-00 00:00:00', '580df3e3', 1),
(39, 'Darlan Murilo Nakamura de Araújo', 'math.160497@gmail.com', '327.728.236-87', '(18) 99743-1595', '(18) 3822-2642', 'Rua Paulo Marques, 574', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, 'd29d5de67dfa5490922fc9524d07721e.png', 1, 2, '$2y$12$NqUWsRsV5LUBfjzCOLK0dOt0fBDmrU2k/XbEdYN4qcLrfg3a.sLw2', '2018-03-06 15:34:01', '0000-00-00 00:00:00', '21e03d2c', 1),
(40, 'Rosiane de Fátima Ponce', 'rosianeponce@uol.com.br', '212.682.478-04', '(18) 99795-4942', '(18) 3916-3089', 'Rua Deputado Fernando Ferrari, 245 -Apto 303', '', 'Jardim Paulistano', '', 'Presidente Prudente', 'SP', '19013-730', 1, '58b5ff952263c6b9570e9ed68ca4795a.jpeg', 3, 2, '$2y$12$AiaHgFRXVc.Gj.2PuBNPbeF7hU8g/82K/Mfm8nW33zIO4no6El0C2', '2018-03-06 15:34:02', '0000-00-00 00:00:00', '', 1),
(41, 'Hugo Seiji', 'hugo_seiji@hotmail.com', '149.022.542-04', '(18) 99999-9999', '(18) 9999-9999', 'Rua Manganês, 310', '', 'Ideal', '', 'Londrina', 'PR', '86030-020', 1, '', 1, 0, '$2y$12$lD9CN5mxAhfQgRW/iJ9h0.P7Aqu6LJEZjVCD82zDcRCgv.Wj5dHWe', '2018-03-08 21:37:09', '0000-00-00 00:00:00', '0baa089a', 1),
(42, 'Marcos Vinicius Francisco ', 'marcos_educa01@yahoo.com.br', '339.189.678-75', '(18) 99640-0404', '', 'Rua Maurílio Luciano Lopes', '', 'Jardim Novo Bongiovani', '', 'Presidente Prudente', 'SP', '19026-665', 1, '', 3, 3, '$2y$12$cOIheZhx89A7XtStTn3UXenvMyvTl0btqNpCqh31Sw5.ACxyvHC.m', '2018-03-14 17:27:25', '0000-00-00 00:00:00', '2fe61c86', 1),
(43, 'Dimitri Francisco Santos Cunha ', 'cunhadimitri@gmail.com', '390.174.388-00', '(18) 98810-7608', '', 'Rua Cabo Luiz Carlos Ferrari', '', 'Jardim Itapura', '', 'Presidente Prudente', 'SP', '19035-010', 0, '', 5, 0, '$2y$12$FOE9rdqB8TlgZJOwvJTRDOGIqu8dzoEJbWfrtHW4DVbnYxc53rwme', '2018-03-14 17:31:51', '0000-00-00 00:00:00', '026454c0', 1),
(44, 'Vinícius Willian da Costa Branquinho', 'viniciusw_branquinho@hotmail.com', '418.906.388-62', '(18) 99648-4886', '', 'Osvaldo Francisco Oliveira', '', 'Antônio Daraia', '', 'Presidente Venceslau', 'SP', '19400-000', 1, '', 2, 0, '$2y$12$rriulIa8fEXzuAxCkaajm.5oWu9/iF1rUbMfh8UWaCjhLcxoq4ErK', '2018-03-14 17:32:48', '0000-00-00 00:00:00', 'a83b5dd3', 1),
(45, 'ERIKA PORCELI ALANIZ', 'a.porcelierika@gmail.com', '264.919.528-27', '(99) 6099-424', '', 'Rua Felismino Fernandes dos Santos', '', 'Jardim Europa', '', 'Ourinhos', 'SP', '19914-430', 1, '', 3, 0, '$2y$12$WID/chSXRp8bJZYhsOS8UuXKdS/utDHTLlhGvD0wrKaUzUdJri04e', '2018-03-15 18:24:58', '0000-00-00 00:00:00', '3b9eacb9', 1),
(47, 'Jorge Luís Mazzeo Mariano', 'jorgemariano86@yahoo.com.br', '348.271.328-60', '(18) 98152-1598', '', 'Rua Carmelindo Braga, 312', '', 'Residencial Morumbi', '', 'Presidente Venceslau', 'SP', '19400-000', 1, '', 3, 0, '$2y$12$UH5Qfp.znETouaYtUGQfp.Jt0CaSaqFprplwm8PhV4.3HRJmUIiKi', '2018-03-15 18:30:28', '0000-00-00 00:00:00', '5d5112b0', 1),
(48, 'Bruno Santos', 'gregoquiral@hotmail.com', '123.142.125-21', '(99) 99999-9999', '(99) 9999-9999', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, '', 2, 0, '$2y$12$Z.1L5SdNcii5X8x4JNTw0.BIFf.GXm2f.gPvVuad36xoqrDu4rKOO', '2018-03-16 16:48:59', '0000-00-00 00:00:00', '5ca7b0f9', 0),
(49, 'Teste de noite', 'jediaelms@gmail.com', '123.213.144-12', '(12) 32131-3212', '(12) 3213-1322', 'potato', '', 'potato', '', 'Teodoro Sampaio', 'SP', '19280-000', 1, '42ab4c7084342b2690964819c0352cbb.jpeg', 2, 1, '$2y$12$kI5oJc3M2RC3/e2M4irGPeJTjsSSfqifqmsHQi30ciHCdkY/HGu3i', '2018-03-16 16:52:25', '0000-00-00 00:00:00', '03f2dd54', 1),
(50, 'Darlan Murilo Nakamura de Araújo', 'darlannakamura@hotmail.com', '121.132.131-23', '(12) 32131-2312', '(12) 3213-1322', 'Rua Paulo Marques', '', 'Vila Boa Vista', '', 'Presidente Prudente', 'SP', '19020-410', 1, '', 3, 0, '$2y$12$AIdxC0z0OuyoXZQ8GSp7rukmTWXQ555.AibgWlagpwk/6CxW71Ql6', '2018-03-16 18:41:19', '0000-00-00 00:00:00', '', 0),
(52, 'Guilherme Bellonci Cereja', 'guicereja@gmail.com', '204.590.428-82', '(18) 98199-7166', '', 'Rua Maestro Francisco Fortunato', '', 'Jardim Bela Daria', '', 'Presidente Prudente', 'SP', '19013-190', 1, '', 1, 0, '$2y$12$cN2eh5cSWstB73pRJvqUOOYCABGN1t8J1e0TLf6C0rToEtXX6TeXu', '2018-03-17 01:29:02', '0000-00-00 00:00:00', '3f2b4bf9', 1),
(53, 'Elaine Gomes Ferro ', 'elainegferro@hotmail.com', '345.826.568-62', '(18) 98142-3890', '', 'Rua Carmelindo Braga,  312.', '', 'Residencial Morumbi ', '', 'Presidente Venceslau', 'SP', '19400-000', 0, '', 4, 0, '$2y$12$ovz1MIE3K8vD6v7hp2cFbOLn1expswgXoSQuj.76Pw2hd5HoB60Eu', '2018-03-17 11:48:26', '0000-00-00 00:00:00', '1b3c9910', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `participante_interesse_minicurso`
--

CREATE TABLE IF NOT EXISTS `participante_interesse_minicurso` (
  `id_participante` int(11) NOT NULL,
  `id_minicurso` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `participante_interesse_minicurso`
--

INSERT INTO `participante_interesse_minicurso` (`id_participante`, `id_minicurso`, `data_registro`) VALUES
(1, 1, '2018-03-03 16:38:52'),
(3, 2, '2018-03-03 16:38:46'),
(5, 2, '2018-03-03 16:38:35'),
(6, 1, '2018-03-05 18:49:52'),
(7, 1, '2018-03-05 18:51:02'),
(7, 2, '2018-03-05 18:51:02'),
(8, 1, '2018-03-05 18:58:28'),
(8, 2, '2018-03-05 18:58:28'),
(9, 2, '2018-03-05 19:18:40'),
(10, 2, '2018-03-05 19:30:06'),
(11, 1, '2018-03-05 19:34:12'),
(11, 2, '2018-03-05 19:34:12'),
(12, 1, '2018-03-05 19:38:23'),
(14, 1, '2018-03-05 20:14:14'),
(15, 1, '2018-03-05 22:03:20'),
(32, 1, '2018-03-06 03:08:10'),
(32, 2, '2018-03-06 03:08:10'),
(33, 2, '2018-03-06 03:11:32'),
(34, 1, '2018-03-06 03:13:09'),
(34, 2, '2018-03-06 03:13:09'),
(35, 1, '2018-03-06 05:05:31'),
(35, 2, '2018-03-06 05:05:31'),
(37, 2, '2018-03-06 05:10:07'),
(38, 3, '2018-03-06 14:38:11'),
(38, 5, '2018-03-06 14:38:10'),
(38, 6, '2018-03-06 14:38:10'),
(39, 8, '2018-03-06 15:36:34'),
(39, 9, '2018-03-06 15:36:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_universitario`
--

CREATE TABLE IF NOT EXISTS `professor_universitario` (
`id_participante` int(11) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `cidade_instituicao` varchar(255) NOT NULL,
  `estado_instituicao` varchar(2) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `atua_na_pos_graduacao` int(11) NOT NULL COMMENT 'Se 0 - Não 1 - Sim'
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `professor_universitario`
--

INSERT INTO `professor_universitario` (`id_participante`, `instituicao`, `cidade_instituicao`, `estado_instituicao`, `curso`, `departamento`, `atua_na_pos_graduacao`) VALUES
(4, 'Unesp - Prudente', 'Presidente Prudente', 'SP', 'Ciências da Computação', 'Departamento de Matemática e Computação', 1),
(12, 'UNESP', 'Presidente Prudente', 'SP', 'Ciencias da Computação', 'História', 0),
(40, 'FCT UNESP', 'Presidente Prudente', 'SP', 'Geografia', 'Educação e Programa de Pós-Graduação e Educação', 1),
(42, 'Unoeste ', 'Presidente Prudente ', 'SP', 'Faclepp ', 'PPGE', 1),
(45, 'Unoeste', 'Presidente Prudente', 'SP', 'Mestrado em Educação', 'Mestrado em Educação', 1),
(47, 'Universidade do Oeste Paulista', 'Presidente Prudente', 'SP', 'Educação', 'Mestrado em Educação', 1),
(50, 'Paciencias', 'Placebo', 'PA', 'Doidera', 'Doidera', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prof_ensino_publico`
--

CREATE TABLE IF NOT EXISTS `prof_ensino_publico` (
  `id_participante` int(11) NOT NULL,
  `escola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `prof_ensino_publico`
--

INSERT INTO `prof_ensino_publico` (`id_participante`, `escola`) VALUES
(28, 'Objetivo'),
(53, 'EMEFEI Joaquim Rodrigues Batata');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prof_ensino_publico_nivel`
--

CREATE TABLE IF NOT EXISTS `prof_ensino_publico_nivel` (
  `id_participante_professor` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `prof_ensino_publico_nivel`
--

INSERT INTO `prof_ensino_publico_nivel` (`id_participante_professor`, `id_nivel`) VALUES
(28, 1),
(28, 2),
(53, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_inscricao`
--

CREATE TABLE IF NOT EXISTS `tipo_inscricao` (
`id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tipo_inscricao`
--

INSERT INTO `tipo_inscricao` (`id`, `tipo`) VALUES
(1, 'Aluno Graduação'),
(2, 'Aluno Pós-Graduação'),
(3, 'Professor Universitário'),
(4, 'Professor Ensino Público'),
(5, 'Demais Profissionais');

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalho`
--

CREATE TABLE IF NOT EXISTS `trabalho` (
  `id_participante` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL COMMENT 'Título do Trabalho. Ex: Business Process Model Aplicado a Engenharia de software Experimental',
  `arquivo_sem_nome_autor` varchar(255) NOT NULL,
  `arquivo_com_nome_autor` varchar(255) NOT NULL,
  `id_eixo` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Em Análise, 1 - Aprovado, 2 - Reprovado',
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_resposta` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `trabalho`
--

INSERT INTO `trabalho` (`id_participante`, `titulo`, `arquivo_sem_nome_autor`, `arquivo_com_nome_autor`, `id_eixo`, `status`, `data_registro`, `data_resposta`) VALUES
(1, 'Business Process Model aplicado a Engenharia de Software', 'fb30d3ad7ea95bfdb928eb29cd911910.pdf', '59869c1ecf43e165b3eeaf46a542e897.pdf', 6, 1, '2018-03-03 03:23:23', '0000-00-00 00:00:00'),
(5, 'Business Process Model aplicado a Engenharia de Software', 'ee1be3272807827dbd4c54287c65b9b1.pdf', '5059fee6814df511716a18bb0ef1e859.pdf', 4, 0, '2018-03-03 03:10:34', '0000-00-00 00:00:00'),
(7, 'Requerimento da EJCOMP', 'a85e33b1f5502ae3ef0e4dc9a7343076.pdf', 'd760b6acaa8d67522a70db220070f18a.pdf', 3, 2, '2018-03-05 19:57:38', '0000-00-00 00:00:00'),
(15, 'Redes', '8365b0faddaf99c8f042e19ec02fcac0.docx', 'c2075e532cb3f752e8fc7479de2573c2.docx', 2, 0, '2018-03-05 22:08:25', '0000-00-00 00:00:00'),
(28, 'Business Process Model aplicado a Engenharia de Software', '9d51f75a4cea94fe6f56d98d6d79feb6.doc', 'e035f45d28280537cbf20bde91a8ab85.pdf', 2, 0, '2018-03-06 04:23:15', '0000-00-00 00:00:00'),
(39, 'Business Process Model aplicado a Engenharia de Software', 'b4db13f4c2d567216d53e50f4580f7b8.pdf', '68d218e65aa3725a6a786ec14a119437.pdf', 1, 2, '2018-03-06 16:31:36', '0000-00-00 00:00:00'),
(40, 'pedagogia histórico crítica', '44bf920db787fd425031a86545a15d85.pdf', '16bcc97559634db6f425354ff3acb524.doc', 1, 0, '2018-03-14 17:58:39', '0000-00-00 00:00:00');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aluno_graduacao`
--
ALTER TABLE `aluno_graduacao`
 ADD PRIMARY KEY (`id_participante`);

--
-- Índices de tabela `aluno_pos_graduacao`
--
ALTER TABLE `aluno_pos_graduacao`
 ADD PRIMARY KEY (`id_participante`);

--
-- Índices de tabela `coautor`
--
ALTER TABLE `coautor`
 ADD PRIMARY KEY (`id_participante`,`id_trabalho`), ADD KEY `iddd_ttrr` (`id_trabalho`);

--
-- Índices de tabela `demais_profissionais`
--
ALTER TABLE `demais_profissionais`
 ADD PRIMARY KEY (`id_participante`);

--
-- Índices de tabela `eixo`
--
ALTER TABLE `eixo`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `minicurso`
--
ALTER TABLE `minicurso`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `participante`
--
ALTER TABLE `participante`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD KEY `id_tipo_inscir` (`id_tipo_inscricao`);

--
-- Índices de tabela `participante_interesse_minicurso`
--
ALTER TABLE `participante_interesse_minicurso`
 ADD PRIMARY KEY (`id_participante`,`id_minicurso`), ADD KEY `fk_id_minic` (`id_minicurso`);

--
-- Índices de tabela `professor_universitario`
--
ALTER TABLE `professor_universitario`
 ADD PRIMARY KEY (`id_participante`);

--
-- Índices de tabela `prof_ensino_publico`
--
ALTER TABLE `prof_ensino_publico`
 ADD PRIMARY KEY (`id_participante`);

--
-- Índices de tabela `prof_ensino_publico_nivel`
--
ALTER TABLE `prof_ensino_publico_nivel`
 ADD PRIMARY KEY (`id_participante_professor`,`id_nivel`), ADD KEY `fk_id_jnive` (`id_nivel`);

--
-- Índices de tabela `tipo_inscricao`
--
ALTER TABLE `tipo_inscricao`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `trabalho`
--
ALTER TABLE `trabalho`
 ADD PRIMARY KEY (`id_participante`), ADD KEY `fk_id_eix` (`id_eixo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `eixo`
--
ALTER TABLE `eixo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de tabela `minicurso`
--
ALTER TABLE `minicurso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `participante`
--
ALTER TABLE `participante`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de tabela `professor_universitario`
--
ALTER TABLE `professor_universitario`
MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de tabela `tipo_inscricao`
--
ALTER TABLE `tipo_inscricao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `aluno_graduacao`
--
ALTER TABLE `aluno_graduacao`
ADD CONSTRAINT `fk_id_part` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `coautor`
--
ALTER TABLE `coautor`
ADD CONSTRAINT `iddd_ttrr` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id_participante`),
ADD CONSTRAINT `iddddd_par` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `demais_profissionais`
--
ALTER TABLE `demais_profissionais`
ADD CONSTRAINT `fk_id_partttt` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `participante`
--
ALTER TABLE `participante`
ADD CONSTRAINT `id_tipo_inscir` FOREIGN KEY (`id_tipo_inscricao`) REFERENCES `tipo_inscricao` (`id`);

--
-- Restrições para tabelas `participante_interesse_minicurso`
--
ALTER TABLE `participante_interesse_minicurso`
ADD CONSTRAINT `fk_id_minic` FOREIGN KEY (`id_minicurso`) REFERENCES `minicurso` (`id`),
ADD CONSTRAINT `fk_id_parttttc` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `professor_universitario`
--
ALTER TABLE `professor_universitario`
ADD CONSTRAINT `fk_iddd_part` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `prof_ensino_publico`
--
ALTER TABLE `prof_ensino_publico`
ADD CONSTRAINT `fk_id_particc` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `prof_ensino_publico_nivel`
--
ALTER TABLE `prof_ensino_publico_nivel`
ADD CONSTRAINT `fk_id_jnive` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id`),
ADD CONSTRAINT `fk_id_partidd` FOREIGN KEY (`id_participante_professor`) REFERENCES `participante` (`id`);

--
-- Restrições para tabelas `trabalho`
--
ALTER TABLE `trabalho`
ADD CONSTRAINT `fk_id_eix` FOREIGN KEY (`id_eixo`) REFERENCES `eixo` (`id`),
ADD CONSTRAINT `fk_id_partasdasd` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
