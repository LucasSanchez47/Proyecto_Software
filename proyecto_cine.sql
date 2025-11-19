-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 07:43:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_cine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `ID_Asiento` int(11) NOT NULL,
  `ID_Sala` int(11) NOT NULL,
  `fila` varchar(5) NOT NULL,
  `numero` int(11) NOT NULL,
  `etiqueta` varchar(10) GENERATED ALWAYS AS (concat(`fila`,`numero`)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`ID_Asiento`, `ID_Sala`, `fila`, `numero`) VALUES
(5, 1, 'A', 1),
(13, 1, 'A', 2),
(21, 1, 'A', 3),
(29, 1, 'A', 4),
(37, 1, 'A', 5),
(45, 1, 'A', 6),
(53, 1, 'A', 7),
(61, 1, 'A', 8),
(69, 1, 'A', 9),
(77, 1, 'A', 10),
(6, 1, 'B', 1),
(14, 1, 'B', 2),
(22, 1, 'B', 3),
(30, 1, 'B', 4),
(38, 1, 'B', 5),
(46, 1, 'B', 6),
(54, 1, 'B', 7),
(62, 1, 'B', 8),
(70, 1, 'B', 9),
(78, 1, 'B', 10),
(7, 1, 'C', 1),
(15, 1, 'C', 2),
(23, 1, 'C', 3),
(31, 1, 'C', 4),
(39, 1, 'C', 5),
(47, 1, 'C', 6),
(55, 1, 'C', 7),
(63, 1, 'C', 8),
(71, 1, 'C', 9),
(79, 1, 'C', 10),
(8, 1, 'D', 1),
(16, 1, 'D', 2),
(24, 1, 'D', 3),
(32, 1, 'D', 4),
(40, 1, 'D', 5),
(48, 1, 'D', 6),
(56, 1, 'D', 7),
(64, 1, 'D', 8),
(72, 1, 'D', 9),
(80, 1, 'D', 10),
(9, 1, 'E', 1),
(17, 1, 'E', 2),
(25, 1, 'E', 3),
(33, 1, 'E', 4),
(41, 1, 'E', 5),
(49, 1, 'E', 6),
(57, 1, 'E', 7),
(65, 1, 'E', 8),
(73, 1, 'E', 9),
(81, 1, 'E', 10),
(10, 1, 'F', 1),
(18, 1, 'F', 2),
(26, 1, 'F', 3),
(34, 1, 'F', 4),
(42, 1, 'F', 5),
(50, 1, 'F', 6),
(58, 1, 'F', 7),
(66, 1, 'F', 8),
(74, 1, 'F', 9),
(82, 1, 'F', 10),
(11, 1, 'G', 1),
(19, 1, 'G', 2),
(27, 1, 'G', 3),
(35, 1, 'G', 4),
(43, 1, 'G', 5),
(51, 1, 'G', 6),
(59, 1, 'G', 7),
(67, 1, 'G', 8),
(75, 1, 'G', 9),
(83, 1, 'G', 10),
(12, 1, 'H', 1),
(20, 1, 'H', 2),
(28, 1, 'H', 3),
(36, 1, 'H', 4),
(44, 1, 'H', 5),
(52, 1, 'H', 6),
(60, 1, 'H', 7),
(68, 1, 'H', 8),
(76, 1, 'H', 9),
(84, 1, 'H', 10),
(132, 2, 'A', 1),
(140, 2, 'A', 2),
(148, 2, 'A', 3),
(156, 2, 'A', 4),
(164, 2, 'A', 5),
(172, 2, 'A', 6),
(180, 2, 'A', 7),
(188, 2, 'A', 8),
(196, 2, 'A', 9),
(204, 2, 'A', 10),
(212, 2, 'A', 11),
(220, 2, 'A', 12),
(228, 2, 'A', 13),
(236, 2, 'A', 14),
(244, 2, 'A', 15),
(133, 2, 'B', 1),
(141, 2, 'B', 2),
(149, 2, 'B', 3),
(157, 2, 'B', 4),
(165, 2, 'B', 5),
(173, 2, 'B', 6),
(181, 2, 'B', 7),
(189, 2, 'B', 8),
(197, 2, 'B', 9),
(205, 2, 'B', 10),
(213, 2, 'B', 11),
(221, 2, 'B', 12),
(229, 2, 'B', 13),
(237, 2, 'B', 14),
(245, 2, 'B', 15),
(134, 2, 'C', 1),
(142, 2, 'C', 2),
(150, 2, 'C', 3),
(158, 2, 'C', 4),
(166, 2, 'C', 5),
(174, 2, 'C', 6),
(182, 2, 'C', 7),
(190, 2, 'C', 8),
(198, 2, 'C', 9),
(206, 2, 'C', 10),
(214, 2, 'C', 11),
(222, 2, 'C', 12),
(230, 2, 'C', 13),
(238, 2, 'C', 14),
(246, 2, 'C', 15),
(135, 2, 'D', 1),
(143, 2, 'D', 2),
(151, 2, 'D', 3),
(159, 2, 'D', 4),
(167, 2, 'D', 5),
(175, 2, 'D', 6),
(183, 2, 'D', 7),
(191, 2, 'D', 8),
(199, 2, 'D', 9),
(207, 2, 'D', 10),
(215, 2, 'D', 11),
(223, 2, 'D', 12),
(231, 2, 'D', 13),
(239, 2, 'D', 14),
(247, 2, 'D', 15),
(136, 2, 'E', 1),
(144, 2, 'E', 2),
(152, 2, 'E', 3),
(160, 2, 'E', 4),
(168, 2, 'E', 5),
(176, 2, 'E', 6),
(184, 2, 'E', 7),
(192, 2, 'E', 8),
(200, 2, 'E', 9),
(208, 2, 'E', 10),
(216, 2, 'E', 11),
(224, 2, 'E', 12),
(232, 2, 'E', 13),
(240, 2, 'E', 14),
(248, 2, 'E', 15),
(137, 2, 'F', 1),
(145, 2, 'F', 2),
(153, 2, 'F', 3),
(161, 2, 'F', 4),
(169, 2, 'F', 5),
(177, 2, 'F', 6),
(185, 2, 'F', 7),
(193, 2, 'F', 8),
(201, 2, 'F', 9),
(209, 2, 'F', 10),
(217, 2, 'F', 11),
(225, 2, 'F', 12),
(233, 2, 'F', 13),
(241, 2, 'F', 14),
(249, 2, 'F', 15),
(138, 2, 'G', 1),
(146, 2, 'G', 2),
(154, 2, 'G', 3),
(162, 2, 'G', 4),
(170, 2, 'G', 5),
(178, 2, 'G', 6),
(186, 2, 'G', 7),
(194, 2, 'G', 8),
(202, 2, 'G', 9),
(210, 2, 'G', 10),
(218, 2, 'G', 11),
(226, 2, 'G', 12),
(234, 2, 'G', 13),
(242, 2, 'G', 14),
(250, 2, 'G', 15),
(139, 2, 'H', 1),
(147, 2, 'H', 2),
(155, 2, 'H', 3),
(163, 2, 'H', 4),
(171, 2, 'H', 5),
(179, 2, 'H', 6),
(187, 2, 'H', 7),
(195, 2, 'H', 8),
(203, 2, 'H', 9),
(211, 2, 'H', 10),
(219, 2, 'H', 11),
(227, 2, 'H', 12),
(235, 2, 'H', 13),
(243, 2, 'H', 14),
(251, 2, 'H', 15),
(259, 3, 'A', 1),
(267, 3, 'A', 2),
(275, 3, 'A', 3),
(283, 3, 'A', 4),
(291, 3, 'A', 5),
(299, 3, 'A', 6),
(307, 3, 'A', 7),
(315, 3, 'A', 8),
(323, 3, 'A', 9),
(331, 3, 'A', 10),
(339, 3, 'A', 11),
(347, 3, 'A', 12),
(355, 3, 'A', 13),
(363, 3, 'A', 14),
(371, 3, 'A', 15),
(260, 3, 'B', 1),
(268, 3, 'B', 2),
(276, 3, 'B', 3),
(284, 3, 'B', 4),
(292, 3, 'B', 5),
(300, 3, 'B', 6),
(308, 3, 'B', 7),
(316, 3, 'B', 8),
(324, 3, 'B', 9),
(332, 3, 'B', 10),
(340, 3, 'B', 11),
(348, 3, 'B', 12),
(356, 3, 'B', 13),
(364, 3, 'B', 14),
(372, 3, 'B', 15),
(261, 3, 'C', 1),
(269, 3, 'C', 2),
(277, 3, 'C', 3),
(285, 3, 'C', 4),
(293, 3, 'C', 5),
(301, 3, 'C', 6),
(309, 3, 'C', 7),
(317, 3, 'C', 8),
(325, 3, 'C', 9),
(333, 3, 'C', 10),
(341, 3, 'C', 11),
(349, 3, 'C', 12),
(357, 3, 'C', 13),
(365, 3, 'C', 14),
(373, 3, 'C', 15),
(262, 3, 'D', 1),
(270, 3, 'D', 2),
(278, 3, 'D', 3),
(286, 3, 'D', 4),
(294, 3, 'D', 5),
(302, 3, 'D', 6),
(310, 3, 'D', 7),
(318, 3, 'D', 8),
(326, 3, 'D', 9),
(334, 3, 'D', 10),
(342, 3, 'D', 11),
(350, 3, 'D', 12),
(358, 3, 'D', 13),
(366, 3, 'D', 14),
(374, 3, 'D', 15),
(263, 3, 'E', 1),
(271, 3, 'E', 2),
(279, 3, 'E', 3),
(287, 3, 'E', 4),
(295, 3, 'E', 5),
(303, 3, 'E', 6),
(311, 3, 'E', 7),
(319, 3, 'E', 8),
(327, 3, 'E', 9),
(335, 3, 'E', 10),
(343, 3, 'E', 11),
(351, 3, 'E', 12),
(359, 3, 'E', 13),
(367, 3, 'E', 14),
(375, 3, 'E', 15),
(264, 3, 'F', 1),
(272, 3, 'F', 2),
(280, 3, 'F', 3),
(288, 3, 'F', 4),
(296, 3, 'F', 5),
(304, 3, 'F', 6),
(312, 3, 'F', 7),
(320, 3, 'F', 8),
(328, 3, 'F', 9),
(336, 3, 'F', 10),
(344, 3, 'F', 11),
(352, 3, 'F', 12),
(360, 3, 'F', 13),
(368, 3, 'F', 14),
(376, 3, 'F', 15),
(265, 3, 'G', 1),
(273, 3, 'G', 2),
(281, 3, 'G', 3),
(289, 3, 'G', 4),
(297, 3, 'G', 5),
(305, 3, 'G', 6),
(313, 3, 'G', 7),
(321, 3, 'G', 8),
(329, 3, 'G', 9),
(337, 3, 'G', 10),
(345, 3, 'G', 11),
(353, 3, 'G', 12),
(361, 3, 'G', 13),
(369, 3, 'G', 14),
(377, 3, 'G', 15),
(266, 3, 'H', 1),
(274, 3, 'H', 2),
(282, 3, 'H', 3),
(290, 3, 'H', 4),
(298, 3, 'H', 5),
(306, 3, 'H', 6),
(314, 3, 'H', 7),
(322, 3, 'H', 8),
(330, 3, 'H', 9),
(338, 3, 'H', 10),
(346, 3, 'H', 11),
(354, 3, 'H', 12),
(362, 3, 'H', 13),
(370, 3, 'H', 14),
(378, 3, 'H', 15),
(386, 4, 'A', 1),
(394, 4, 'A', 2),
(402, 4, 'A', 3),
(410, 4, 'A', 4),
(418, 4, 'A', 5),
(426, 4, 'A', 6),
(434, 4, 'A', 7),
(442, 4, 'A', 8),
(450, 4, 'A', 9),
(458, 4, 'A', 10),
(466, 4, 'A', 11),
(474, 4, 'A', 12),
(482, 4, 'A', 13),
(490, 4, 'A', 14),
(498, 4, 'A', 15),
(387, 4, 'B', 1),
(395, 4, 'B', 2),
(403, 4, 'B', 3),
(411, 4, 'B', 4),
(419, 4, 'B', 5),
(427, 4, 'B', 6),
(435, 4, 'B', 7),
(443, 4, 'B', 8),
(451, 4, 'B', 9),
(459, 4, 'B', 10),
(467, 4, 'B', 11),
(475, 4, 'B', 12),
(483, 4, 'B', 13),
(491, 4, 'B', 14),
(499, 4, 'B', 15),
(388, 4, 'C', 1),
(396, 4, 'C', 2),
(404, 4, 'C', 3),
(412, 4, 'C', 4),
(420, 4, 'C', 5),
(428, 4, 'C', 6),
(436, 4, 'C', 7),
(444, 4, 'C', 8),
(452, 4, 'C', 9),
(460, 4, 'C', 10),
(468, 4, 'C', 11),
(476, 4, 'C', 12),
(484, 4, 'C', 13),
(492, 4, 'C', 14),
(500, 4, 'C', 15),
(389, 4, 'D', 1),
(397, 4, 'D', 2),
(405, 4, 'D', 3),
(413, 4, 'D', 4),
(421, 4, 'D', 5),
(429, 4, 'D', 6),
(437, 4, 'D', 7),
(445, 4, 'D', 8),
(453, 4, 'D', 9),
(461, 4, 'D', 10),
(469, 4, 'D', 11),
(477, 4, 'D', 12),
(485, 4, 'D', 13),
(493, 4, 'D', 14),
(501, 4, 'D', 15),
(390, 4, 'E', 1),
(398, 4, 'E', 2),
(406, 4, 'E', 3),
(414, 4, 'E', 4),
(422, 4, 'E', 5),
(430, 4, 'E', 6),
(438, 4, 'E', 7),
(446, 4, 'E', 8),
(454, 4, 'E', 9),
(462, 4, 'E', 10),
(470, 4, 'E', 11),
(478, 4, 'E', 12),
(486, 4, 'E', 13),
(494, 4, 'E', 14),
(502, 4, 'E', 15),
(391, 4, 'F', 1),
(399, 4, 'F', 2),
(407, 4, 'F', 3),
(415, 4, 'F', 4),
(423, 4, 'F', 5),
(431, 4, 'F', 6),
(439, 4, 'F', 7),
(447, 4, 'F', 8),
(455, 4, 'F', 9),
(463, 4, 'F', 10),
(471, 4, 'F', 11),
(479, 4, 'F', 12),
(487, 4, 'F', 13),
(495, 4, 'F', 14),
(503, 4, 'F', 15),
(392, 4, 'G', 1),
(400, 4, 'G', 2),
(408, 4, 'G', 3),
(416, 4, 'G', 4),
(424, 4, 'G', 5),
(432, 4, 'G', 6),
(440, 4, 'G', 7),
(448, 4, 'G', 8),
(456, 4, 'G', 9),
(464, 4, 'G', 10),
(472, 4, 'G', 11),
(480, 4, 'G', 12),
(488, 4, 'G', 13),
(496, 4, 'G', 14),
(504, 4, 'G', 15),
(393, 4, 'H', 1),
(401, 4, 'H', 2),
(409, 4, 'H', 3),
(417, 4, 'H', 4),
(425, 4, 'H', 5),
(433, 4, 'H', 6),
(441, 4, 'H', 7),
(449, 4, 'H', 8),
(457, 4, 'H', 9),
(465, 4, 'H', 10),
(473, 4, 'H', 11),
(481, 4, 'H', 12),
(489, 4, 'H', 13),
(497, 4, 'H', 14),
(505, 4, 'H', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `ID_cargo` int(11) NOT NULL,
  `Cargo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`ID_cargo`, `Cargo`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Limpieza'),
(4, 'Cajero\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_Compra` int(11) NOT NULL,
  `Cod_producto` int(11) NOT NULL,
  `Cod_Entrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `Cod_Entrada` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `ID_Funcion` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Asiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`Cod_Entrada`, `fecha`, `ID_Funcion`, `ID_Usuario`, `ID_Asiento`) VALUES
(1, '2025-11-19', 8, 5, 165),
(2, '2025-11-19', 8, 5, 173),
(3, '2025-11-19', 8, 5, 181),
(4, '2025-11-19', 6, 5, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pelicula`
--

CREATE TABLE `estado_pelicula` (
  `id_estado` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pelicula`
--

INSERT INTO `estado_pelicula` (`id_estado`, `nombre`) VALUES
(1, 'estreno'),
(2, 'preventa'),
(3, 'proximo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `ID_Funcion` int(11) NOT NULL,
  `ID_Pelicula` int(11) NOT NULL,
  `ID_Sala` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`ID_Funcion`, `ID_Pelicula`, `ID_Sala`, `fecha`, `horario`) VALUES
(1, 3, 1, '2025-11-22', '15:30:00'),
(2, 3, 1, '2025-11-22', '18:30:00'),
(3, 5, 2, '2025-11-22', '17:00:00'),
(4, 5, 2, '2025-11-22', '20:00:00'),
(5, 2, 3, '2025-11-22', '21:00:00'),
(6, 5, 1, '2025-11-21', '19:00:00'),
(7, 5, 1, '2025-11-21', '22:00:00'),
(8, 3, 2, '2025-11-21', '16:00:00'),
(9, 3, 2, '2025-11-21', '19:00:00'),
(10, 2, 3, '2025-11-21', '20:00:00'),
(11, 3, 1, '2025-11-22', '15:30:00'),
(12, 3, 1, '2025-11-22', '18:30:00'),
(13, 5, 2, '2025-11-22', '17:00:00'),
(14, 5, 2, '2025-11-22', '20:00:00'),
(15, 2, 3, '2025-11-22', '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `ID_peliculas` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `duracion` int(20) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `genero` varchar(50) NOT NULL,
  `estreno` date NOT NULL,
  `id_estado` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`ID_peliculas`, `titulo`, `duracion`, `poster`, `descripcion`, `genero`, `estreno`, `id_estado`) VALUES
(2, 'el castillo vagabundo', 119, '50f828534d857fa3e78ddf6b693a4e41.jpg', 'Después de que una bruja la transforma en una anciana, una fabricante de sombreros busca refugio en la casa ambulante de un mago muy peculiar.', 'Fantasia', '2004-11-20', 1),
(3, 'Son como niños 2', 101, 'soncomoniños2.jpg', 'Tres años después de la reunión que volvió a unirlo a sus amigos de la infancia, Lenny Feder regresa junto a su familia a su pueblo natal para poder estar más cerca de sus amigos.', 'Comedia', '2013-09-19', 2),
(5, '¿Dónde están las Rubias?', 101, 'rubias.jpg', '¿Qué sucede cuando dos agentes del FBI se disfrazan como princesas millonarias para infiltrarse en la alta sociedad? La locura no se detiene y las payasadas no terminan cuando estos dos hermanos cambian los trajes por las tangas. Mucha actitud, mucha música con ritmo y una memorable competencia de baile disco te mantendrán riendo de principio a fin.\r\n', 'Comedia/Policial', '2004-04-11', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(40) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `cantidad` int(8) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre`, `cantidad`, `categoria`, `precio`, `descripcion`, `imagen`, `estado`, `foto`) VALUES
(11, 'Combo Familiar', 20, 'Pochoclos Dulces', 7000.00, '2 Baldes de pochoclos + 4 gaseosas medianas + 2 golosinas sin eleccion (sujeta a disponibilidad del cine) + 1 agua. Imagen a modo ilustrativo.', '1763501015_familiar.png', 'activo', ''),
(12, 'Vaso los 4 fantasticos ', 30, 'Bebidas', 20000.00, '1 (*)Vaso \"Los 4 Fantásticos: Primeros pasos\" sin contenido. (*)4 modelos disponibles a eleccion en el cine, sujeto a disponibilidad. UNIDADES LIMITADAS.', '1763512440_Captura de pantalla 2025-11-18 213229.png', 'activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro`
--

CREATE TABLE `retiro` (
  `Cod_retiro` int(8) NOT NULL,
  `ID_Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `ID_Sala` int(11) NOT NULL,
  `sala` enum('3d','2d','4d','') NOT NULL DEFAULT '',
  `Cant_Butacas` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`ID_Sala`, `sala`, `Cant_Butacas`) VALUES
(1, '', 120),
(2, '', 120),
(3, '', 120),
(4, '', 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Direccion` varchar(30) NOT NULL,
  `Num_telefono` int(10) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contrasenia` varchar(255) NOT NULL,
  `ID_cargo` int(11) NOT NULL,
  `Foto_perfil` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `Nombre`, `Apellido`, `Direccion`, `Num_telefono`, `Correo`, `Contrasenia`, `ID_cargo`, `Foto_perfil`) VALUES
(5, 'eze', 'fdgdfs', 'fdsgs', 2147483647, 'pepe48@gmail.com', '$2y$10$8Imy/dBvyGV1TNAt6ZdBKOUCVzumSFAI5FLZluIm8vE.gfW3KVleu', 2, ''),
(6, 'eze', 'sdf', 'dgsd', 23423534, 'tengohambre@gmail.com', '$2y$10$5gmmjOpX3UqrQkEHN1S5F.anTW28ngkeW0D58NRRj/Ymxa7.6yvHC', 1, '6_1763356369.jpg'),
(9, 'perro', 'qewr', '213', 23423425, 'perro@gmail.com', '$2y$10$bZbc/pwpZWn9d57qRfrGmeJbinHCmkzA64zQSfBoXlnWUapJi1Y7W', 2, ''),
(14, 'gato', 'dfasdf', '2fdsaf', 1221445, 'gato@gmail.com', '$2y$10$c1MyeOpXPJlJChHRCwdDMOXfdADMhbgJTgayAubqvL9YdJIhGwyF.', 4, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`ID_Asiento`),
  ADD UNIQUE KEY `ID_Sala` (`ID_Sala`,`fila`,`numero`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID_cargo`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `Cod_producto` (`Cod_producto`),
  ADD KEY `Cod_Entrada` (`Cod_Entrada`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`Cod_Entrada`),
  ADD KEY `fk_entrada_funcion` (`ID_Funcion`),
  ADD KEY `fk_entradas_usuario` (`ID_Usuario`),
  ADD KEY `fk_entrada_asiento` (`ID_Asiento`);

--
-- Indices de la tabla `estado_pelicula`
--
ALTER TABLE `estado_pelicula`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`ID_Funcion`),
  ADD KEY `ID_Pelicula` (`ID_Pelicula`),
  ADD KEY `ID_Sala` (`ID_Sala`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`ID_peliculas`),
  ADD KEY `fk_estado` (`id_estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `retiro`
--
ALTER TABLE `retiro`
  ADD PRIMARY KEY (`Cod_retiro`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`ID_Sala`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD KEY `ID_cargo` (`ID_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asientos`
--
ALTER TABLE `asientos`
  MODIFY `ID_Asiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `ID_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `Cod_Entrada` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `ID_Funcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `ID_peliculas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `fk_asiento_sala` FOREIGN KEY (`ID_Sala`) REFERENCES `salas` (`ID_sala`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`Cod_producto`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`Cod_Entrada`) REFERENCES `entradas` (`Cod_Entrada`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_asiento` FOREIGN KEY (`ID_Asiento`) REFERENCES `asientos` (`ID_Asiento`),
  ADD CONSTRAINT `fk_entrada_funcion` FOREIGN KEY (`ID_Funcion`) REFERENCES `funciones` (`ID_Funcion`),
  ADD CONSTRAINT `fk_entradas_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_usuario`);

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `funciones_ibfk_1` FOREIGN KEY (`ID_Pelicula`) REFERENCES `peliculas` (`ID_peliculas`),
  ADD CONSTRAINT `funciones_ibfk_2` FOREIGN KEY (`ID_Sala`) REFERENCES `salas` (`ID_sala`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado_pelicula` (`id_estado`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_cargo`) REFERENCES `cargos` (`ID_cargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
