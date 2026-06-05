-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-06-2026 a las 13:33:34
-- Versión del servidor: 10.11.14-MariaDB-0+deb12u2
-- Versión de PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conapdis`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddColumnIfNotExists` (IN `tableName` VARCHAR(100), IN `columnName` VARCHAR(100), IN `columnDefinition` VARCHAR(500))   BEGIN
    DECLARE columnCount INT;
    
    SELECT COUNT(*) INTO columnCount
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @dbname
    AND TABLE_NAME = tableName
    AND COLUMN_NAME = columnName;
    
    IF columnCount = 0 THEN
        SET @sql = CONCAT('ALTER TABLE ', tableName, ' ADD COLUMN ', columnName, ' ', columnDefinition);
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artificios`
--

CREATE TABLE `artificios` (
  `id` varchar(10) NOT NULL,
  `nombre_artificio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `artificios`
--

INSERT INTO `artificios` (`id`, `nombre_artificio`) VALUES
('-ortesis', 'Ortesis'),
('-protesis', 'Protesis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atenciones`
--

CREATE TABLE `atenciones` (
  `numero_aten` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_aten` date DEFAULT NULL,
  `atencion_solicitada` text DEFAULT NULL,
  `atencion_recibida` varchar(10) DEFAULT NULL,
  `atencion_brindada` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT 'Sin atencion',
  `por` int(12) DEFAULT NULL,
  `asignado` int(12) DEFAULT NULL,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `urgencia` text DEFAULT NULL,
  `archivo` varchar(2048) DEFAULT NULL,
  `informe` varchar(20248) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `atenciones`
--

INSERT INTO `atenciones` (`numero_aten`, `cedula`, `fecha_aten`, `atencion_solicitada`, `atencion_recibida`, `atencion_brindada`, `statu`, `por`, `asignado`, `fecha_creada`, `urgencia`, `archivo`, `informe`) VALUES
(442, 17977264, '2025-08-28', NULL, '2-MuletasL', '-ayudatec', 'Atendido', 14033947, 14033947, '2025-08-28 15:35:00', NULL, NULL, NULL),
(444, 15835054, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2025-11-17 14:13:25', NULL, NULL, NULL),
(445, 3569533, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2025-11-18 13:41:31', NULL, NULL, NULL),
(446, 24530170, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2025-11-18 14:01:52', NULL, NULL, NULL),
(447, 6243569, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-01-19 15:08:42', NULL, NULL, NULL),
(448, 20565667, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-19 16:00:21', NULL, NULL, NULL),
(449, 19397245, '2026-03-24', NULL, '-MuletasCa', '-ayudatec', 'Atendido', 14838761, 14838761, '2026-01-19 17:06:01', NULL, NULL, NULL),
(450, 21537046, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-19 17:59:24', NULL, NULL, NULL),
(451, 25624227, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-19 18:10:53', NULL, NULL, NULL),
(452, 5754220, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-19 18:24:17', NULL, NULL, NULL),
(453, 6453964, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-19 18:39:08', NULL, NULL, NULL),
(454, 7360723, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 14:03:23', NULL, NULL, NULL),
(455, 6504450, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 14:17:17', NULL, NULL, NULL),
(456, 18598845, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 14:24:59', NULL, NULL, NULL),
(457, 30235535, '2026-03-24', NULL, '2-MuletasM', '-ayudatec', 'Atendido', 14838761, 14838761, '2026-01-20 14:31:25', NULL, NULL, NULL),
(458, 5423480, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 14:38:48', NULL, NULL, NULL),
(459, 23148581, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 14:58:36', NULL, NULL, NULL),
(460, 6349747, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 15:05:07', NULL, NULL, NULL),
(461, 6349747, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 15:35:45', NULL, NULL, NULL),
(462, 11554051, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 15:52:18', NULL, NULL, NULL),
(463, 12340086, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 16:10:22', NULL, NULL, NULL),
(464, 7445492, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 16:50:40', NULL, NULL, NULL),
(465, 9461522, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 17:07:10', NULL, NULL, NULL),
(466, 30908646, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-20 17:26:50', NULL, NULL, NULL),
(467, 8164768, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-21 14:12:07', NULL, NULL, NULL),
(468, 22764199, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-21 15:31:20', NULL, NULL, NULL),
(469, 12142595, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-01-22 13:39:30', NULL, NULL, NULL),
(470, 2976398, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-01-26 15:11:24', NULL, NULL, NULL),
(471, 4124735, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-27 17:46:27', NULL, NULL, NULL),
(472, 20329013, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-28 18:28:51', NULL, NULL, NULL),
(473, 15684500, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-01-30 18:31:04', NULL, NULL, NULL),
(474, 4854616, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-02-02 13:50:28', NULL, NULL, NULL),
(475, 4854616, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-02-02 13:53:12', NULL, NULL, NULL),
(476, 4854616, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 83752749, '2026-02-02 13:54:28', NULL, NULL, NULL),
(477, 5601699, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-09 13:52:55', NULL, NULL, NULL),
(478, 13218170, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-10 12:07:10', NULL, NULL, NULL),
(479, 4169840, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-10 14:44:14', NULL, NULL, NULL),
(480, 25226787, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-11 13:23:44', NULL, NULL, NULL),
(481, 3215528, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-12 13:20:36', NULL, NULL, NULL),
(482, 9953256, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-12 17:10:20', NULL, NULL, NULL),
(483, 23623881, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-19 18:04:26', NULL, NULL, NULL),
(484, 26463644, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 11692632, '2026-02-20 15:28:23', NULL, NULL, NULL),
(485, 25674958, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, 14838761, '2026-02-20 16:10:23', NULL, NULL, NULL),
(486, 33351791, '2026-02-23', 'Silla de rueda ergonomica N16', '1.1-S.E16', '-ayudatec', 'Atendido', 14033947, 14033947, '2026-02-23 16:18:58', 'urgente', NULL, NULL),
(488, 6297759, NULL, '1-oac', '19-Brpl52', NULL, 'Sin atencion', NULL, 14838761, '2026-02-25 14:26:21', NULL, NULL, NULL),
(489, 6361308, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 14838761, '2026-03-02 16:16:34', NULL, NULL, NULL),
(490, 3233121, '2026-03-24', '1-oac', '1-silla.r', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-05 17:31:50', NULL, NULL, NULL),
(491, 14260655, '2026-03-24', '1-oac', '4-baston.p', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-05 17:36:37', NULL, NULL, NULL),
(492, 3885513, '2026-03-24', '1-oac', '3-baston', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-05 17:44:06', NULL, NULL, NULL),
(493, 3405632, '2026-03-24', '1-oac', '30-sllsr', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-05 18:00:19', NULL, NULL, NULL),
(495, 175734311, NULL, '1-oac', '28-chorm', NULL, 'Sin atencion', NULL, 14033947, '2026-03-05 18:50:11', NULL, NULL, NULL),
(496, 3233121, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 22892583, '2026-03-05 18:53:15', NULL, NULL, NULL),
(497, 14128684, NULL, '1-oac', '31-sllsr', NULL, 'Sin atencion', NULL, 14033947, '2026-03-05 18:57:01', NULL, NULL, NULL),
(498, 3990577, NULL, '1-oac', '6-andadera', NULL, 'Sin atencion', NULL, 22892583, '2026-03-05 19:00:00', NULL, NULL, NULL),
(499, 9961396, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 14033947, '2026-03-05 19:01:56', NULL, NULL, NULL),
(500, 4233724, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 22892583, '2026-03-05 19:04:34', NULL, NULL, NULL),
(501, 81305530, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 14033947, '2026-03-05 19:05:26', NULL, NULL, NULL),
(502, 8365339, '2026-03-24', '1-oac', '3-baston', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-05 19:38:19', NULL, NULL, NULL),
(503, 1219526, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 22892583, '2026-03-05 19:43:11', NULL, NULL, NULL),
(504, 2807454, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14033947, '2026-03-06 14:40:26', NULL, NULL, NULL),
(505, 34157683, NULL, '1-oac', '2-MuletasM', NULL, 'Sin atencion', NULL, 14033947, '2026-03-06 14:46:37', NULL, NULL, NULL),
(506, 23682288, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 83752749, '2026-03-06 15:13:06', NULL, NULL, NULL),
(507, 8340872, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 83752749, '2026-03-06 15:49:49', NULL, NULL, NULL),
(508, 2381410, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 22892583, '2026-03-06 15:52:34', NULL, NULL, NULL),
(509, 2976398, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 83752749, '2026-03-06 16:02:46', NULL, NULL, NULL),
(510, 6359029, NULL, '1-oac', '10-Cola', NULL, 'Sin atencion', NULL, 14838761, '2026-03-06 16:09:21', NULL, NULL, NULL),
(511, 20047968, '2026-03-24', '1-oac', '27-Sllc', '-ayudatec', 'Atendido', 14838761, 14838761, '2026-03-06 18:52:06', NULL, NULL, NULL),
(512, 5415186, NULL, '1-oac', '6-andadera', NULL, 'Sin atencion', NULL, 83752749, '2026-03-09 14:35:07', NULL, NULL, NULL),
(513, 6260994, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 14033947, '2026-03-09 15:07:15', NULL, NULL, NULL),
(514, 3474857, NULL, '1-oac', '6-andadera', NULL, 'Sin atencion', NULL, 83752749, '2026-03-09 15:12:11', NULL, NULL, NULL),
(515, 3530623, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14033947, '2026-03-09 16:53:57', NULL, NULL, NULL),
(516, 20027969, NULL, '1-oac', '-bastonRas', NULL, 'Sin atencion', NULL, 14838761, '2026-03-10 13:13:10', NULL, NULL, NULL),
(517, 6728217, NULL, '1-oac', '6-andadera', NULL, 'Sin atencion', NULL, 14838761, '2026-03-10 15:30:21', NULL, NULL, NULL),
(518, 9957384, '2026-03-24', '1-oac', '2-MuletasL', '-ayudatec', 'Atendido', 14838761, 83752749, '2026-03-10 17:09:20', NULL, NULL, NULL),
(519, 19401635, '2026-03-24', '1-oac', '-MuletasCa', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-10 19:46:06', NULL, NULL, NULL),
(520, 5413770, '2026-03-24', '1-oac', '6-andadera', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-10 19:54:44', NULL, NULL, NULL),
(521, 5225379, '2026-03-24', '1-oac', '18-Brpl50', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-10 20:21:12', NULL, NULL, NULL),
(522, 28143325, NULL, '1-oac', '31-sllsr', NULL, 'Sin atencion', NULL, 83752749, '2026-03-11 13:15:58', NULL, NULL, NULL),
(523, 10498342, NULL, '1-oac', '-MuletasCa', NULL, 'Sin atencion', NULL, 14033947, '2026-03-11 13:34:29', NULL, NULL, NULL),
(524, 22748260, NULL, '1-oac', '18-Brpl50', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 14:24:39', NULL, NULL, NULL),
(525, 15204032, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 14:32:07', NULL, NULL, NULL),
(526, 9005493, NULL, '1-oac', '6-andadera', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 14:37:40', NULL, NULL, NULL),
(527, 6062851, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 14:45:56', NULL, NULL, NULL),
(528, 3839860, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 14:54:25', NULL, NULL, NULL),
(529, 27200412, NULL, '1-oac', '2-MuletasM', NULL, 'Sin atencion', NULL, 20825903, '2026-03-11 15:21:43', NULL, NULL, NULL),
(530, 4545711, NULL, '1-oac', '31-sllsr', NULL, 'Sin atencion', NULL, 83752749, '2026-03-11 15:36:44', NULL, NULL, NULL),
(531, 14518823, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14033947, '2026-03-16 15:30:40', NULL, NULL, NULL),
(532, 12298380, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14033947, '2026-03-16 15:33:36', NULL, NULL, NULL),
(533, 14299632, NULL, '1-oac', '1.6-SRB', NULL, 'Sin atencion', NULL, 14838761, '2026-03-16 17:41:41', NULL, NULL, NULL),
(534, 3191519, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 14838761, '2026-03-16 17:51:48', NULL, NULL, NULL),
(535, 12880192, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14838761, '2026-03-16 18:37:51', NULL, NULL, NULL),
(536, 15167158, NULL, '1-oac', '2-MuletasM', NULL, 'Sin atencion', NULL, 14838761, '2026-03-17 13:38:07', NULL, NULL, NULL),
(537, 13636974, '2026-03-17', '1-oac', '1-silla.r', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-17 14:06:47', NULL, NULL, NULL),
(538, 5143496, '2026-03-17', '1-oac', '1-silla.r', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-17 14:11:21', NULL, NULL, NULL),
(539, 5575875, NULL, '1-oac', '4-baston.p', NULL, 'Sin atencion', NULL, 14838761, '2026-03-19 13:07:15', NULL, NULL, NULL),
(540, 6081936, NULL, '1-oac', '18-Brpl50', NULL, 'Sin atencion', NULL, 14033947, '2026-03-19 14:43:28', NULL, NULL, NULL),
(541, 3423317, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14033947, '2026-03-19 15:33:55', NULL, NULL, NULL),
(542, 16227883, '2026-03-24', '1-oac', '-MuletasCa', '-ayudatec', 'Atendido', 22892583, 22892583, '2026-03-19 19:36:29', NULL, NULL, NULL),
(543, 4085757, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 14838761, '2026-03-20 19:26:50', NULL, NULL, NULL),
(544, 4085757, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 14838761, '2026-03-20 19:29:33', NULL, NULL, NULL),
(545, 18511929, NULL, '1-oac', '-MuletasCa', NULL, 'Sin atencion', NULL, 14838761, '2026-03-23 16:25:59', NULL, NULL, NULL),
(546, 3074974, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 83752749, '2026-03-23 18:46:45', NULL, NULL, NULL),
(547, 6157880, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 83752749, '2026-03-23 18:54:09', NULL, NULL, NULL),
(548, 6030036, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 83752749, '2026-03-23 19:03:41', NULL, NULL, NULL),
(549, 6470022, NULL, '1-oac', '3-baston', NULL, 'Sin atencion', NULL, 22892583, '2026-03-24 15:53:45', NULL, NULL, NULL),
(550, 8183568, '2026-03-24', '1-oac', '3-baston', '-ayudatec', 'Atendido', 14838761, 14838761, '2026-03-24 16:38:15', NULL, NULL, NULL),
(551, 6109804, '2026-03-24', '1-oac', '4-baston.p', '-ayudatec', 'Atendido', 14838761, 14838761, '2026-03-24 17:37:31', NULL, NULL, NULL),
(552, 6062851, '2026-03-24', '1-oac', '4-baston.p', '-remitido', 'Atendido', 14838761, 14838761, '2026-03-24 17:49:46', NULL, NULL, NULL),
(553, 3609914, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 20825903, '2026-03-25 12:54:07', NULL, NULL, NULL),
(554, 18750389, NULL, '1-oac', '2-MuletasL', NULL, 'Sin atencion', NULL, 14838761, '2026-03-26 13:43:06', NULL, NULL, NULL),
(555, 37407453, NULL, '1-oac', '29-chorg', NULL, 'Sin atencion', NULL, 16902651, '2026-03-26 14:05:39', NULL, NULL, NULL),
(556, 27803002, NULL, '1-oac', '10-Cola', NULL, 'Sin atencion', NULL, 14838761, '2026-03-26 16:05:21', NULL, NULL, NULL),
(557, 13515218, NULL, '1-oac', '27-Sllc', NULL, 'Sin atencion', NULL, 14838761, '2026-04-06 15:29:32', NULL, NULL, NULL),
(558, 6109467, NULL, '1-oac', '1-silla.r', NULL, 'Sin atencion', NULL, 14838761, '2026-04-08 13:13:20', NULL, NULL, NULL),
(559, 3252047, NULL, '1-oac', '2-MuletasM', NULL, 'Sin atencion', NULL, 14838761, '2026-04-08 16:21:15', NULL, NULL, NULL),
(560, 4274948, NULL, '1-oac', NULL, NULL, 'Sin atencion', NULL, 20825903, '2026-04-08 16:34:06', NULL, NULL, NULL),
(561, 20027969, NULL, '1-oac', '18-Brpl50', NULL, 'Sin atencion', NULL, 83752749, '2026-04-16 15:40:50', NULL, NULL, NULL),
(562, 15835054, NULL, '1-oac', '-MuletasCa', NULL, 'Sin atencion', NULL, 14838761, '2026-04-27 18:27:23', NULL, NULL, NULL),
(563, 15835054, NULL, '1-oac', '-MuletasCa', NULL, 'Sin atencion', NULL, 14838761, '2026-04-27 18:27:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atenciones_coordinaciones`
--

CREATE TABLE `atenciones_coordinaciones` (
  `asignado` int(12) DEFAULT NULL,
  `numero_aten` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_aten` date DEFAULT NULL,
  `atencion_solicitada` text DEFAULT NULL,
  `atencion_recibida` varchar(10) DEFAULT NULL,
  `atencion_brindada` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT 'Sin atencion',
  `por` int(12) DEFAULT NULL,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `urgencia` text DEFAULT NULL,
  `archivo` varchar(2048) DEFAULT NULL,
  `informe` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `atenciones_coordinaciones`
--

INSERT INTO `atenciones_coordinaciones` (`asignado`, `numero_aten`, `cedula`, `fecha_aten`, `atencion_solicitada`, `atencion_recibida`, `atencion_brindada`, `statu`, `por`, `fecha_creada`, `urgencia`, `archivo`, `informe`) VALUES
(18212377, 246, 25997137, '2025-02-06', 'llenado del gas domestico', NULL, '-orientado', 'Atendido', 18212377, '2025-02-06 19:31:17', 'media', NULL, NULL),
(18212377, 247, 25997137, '2025-02-13', 'gas domestico', NULL, '-orientado', 'Atendido', 18212377, '2025-02-06 19:31:48', 'urgente', NULL, NULL),
(18212377, 248, 4692416, '2025-02-14', 'Silla de ruedas estandar', NULL, '-remitido', 'Atendido', 18212377, '2025-02-06 19:54:30', 'urgente', NULL, NULL),
(22200486, 249, 17832610, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-02-06 20:05:26', NULL, NULL, NULL),
(18212377, 250, 8424575, '2025-02-17', 'gas domestico', NULL, '-orientado', 'Atendido', 8683522, '2025-02-06 20:10:24', 'urgente', NULL, NULL),
(18212377, 251, 4688373, '2025-03-05', 'atencion gas domestico, llenads', NULL, '-orientado', 'Atendido', 8683522, '2025-02-06 20:16:59', 'urgente', NULL, NULL),
(18212377, 252, 5953844, '2025-03-05', 'llenado del gas domestico', NULL, '-orientado', 'Atendido', 8683522, '2025-02-06 20:20:27', 'urgente', NULL, NULL),
(22200486, 258, 25695551, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-02-07 19:41:16', NULL, NULL, NULL),
(22200486, 259, 26251194, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-02-10 17:26:14', NULL, NULL, NULL),
(18212377, 260, 8642045, '2025-02-14', 'gas domestico', NULL, '-orientado', 'Atendido', 8683522, '2025-02-10 19:00:41', 'urgente', NULL, NULL),
(18212377, 310, 12662749, '2025-02-26', 'Glucometro', NULL, '-remitido', 'Atendido', 18212377, '2025-02-26 15:30:15', 'urgente', NULL, NULL),
(13058552, 311, 10791762, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-03-24 18:20:11', NULL, NULL, NULL),
(18212377, 312, 4188883, '2025-03-26', 'ASIGNACIÓN DEL BONO JOSE GREGORIO HERNANDEZ', NULL, '-remitido', 'Atendido', 18212377, '2025-03-26 17:19:14', 'urgente', NULL, NULL),
(15186731, 313, 17763220, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 13:06:54', NULL, NULL, NULL),
(15186731, 314, 8549825, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 13:37:43', NULL, NULL, NULL),
(15186731, 315, 8442973, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 13:46:29', NULL, NULL, NULL),
(15186731, 316, 5705838, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 13:55:09', NULL, NULL, NULL),
(15186731, 317, 2657067, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 14:07:53', NULL, NULL, NULL),
(15186731, 318, 17910415, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 14:19:26', NULL, NULL, NULL),
(15186731, 319, 3338072, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-04-07 14:31:11', NULL, NULL, NULL),
(13458141, 320, 8683522, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2025-07-29 18:56:48', NULL, NULL, NULL),
(8683522, 321, 1046565, NULL, NULL, NULL, NULL, 'Sin atencion', NULL, '2026-03-12 15:45:57', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atenciones_laboratorios`
--

CREATE TABLE `atenciones_laboratorios` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `laboratorio` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `tipo_artificio` text DEFAULT NULL,
  `artificio_protesis` int(10) DEFAULT NULL,
  `artificio_ortesis` int(10) DEFAULT NULL,
  `fecha_asistencia` date DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `expediente` varchar(255) DEFAULT NULL,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `por` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_recibida`
--

CREATE TABLE `atencion_recibida` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `atencion_recibida`
--

INSERT INTO `atencion_recibida` (`id`, `nombre`) VALUES
('-audio', 'Audiometria'),
('-ayudatec', 'Ayuda Tecnica'),
('-encuen', 'Encuentro'),
('-jorna', 'Jornada'),
('-orientado', 'Orientado'),
('-orte', 'Ortesis'),
('-prote', 'Protesis'),
('-remitido', 'Remitido'),
('-taller', 'Taller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_solicitada`
--

CREATE TABLE `atencion_solicitada` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `atencion_solicitada`
--

INSERT INTO `atencion_solicitada` (`id`, `nombre`) VALUES
(8476, 'Atención a través de coordinación estadal'),
(8477, 'Atención a través de OAC'),
(8480, 'Audiometría'),
(8478, 'Cita laboratorio órtesis y prótesis'),
(8483, 'Participante de encuentro'),
(8482, 'Participante de taller'),
(8481, 'Rehabilitación'),
(8479, 'Reparación Artificio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audiometria`
--

CREATE TABLE `audiometria` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_cita` date DEFAULT NULL,
  `status` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `audiometria`
--

INSERT INTO `audiometria` (`id`, `cedula`, `fecha_cita`, `status`, `descripcion`) VALUES
(28, 2983212, '2025-06-19', 'Audiometria completada', ' '),
(29, 2976984, '2025-06-16', 'cita dada', ''),
(30, 30165406, '2025-06-12', 'cita dada', 'Prueba'),
(31, 30165406, '2025-06-13', 'cita dada', 'ashduhas'),
(32, 30165406, '2025-06-13', 'cita dada', 'aswdada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE `avances` (
  `id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rehabilitacion` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `status` text DEFAULT 'en proceso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`id`, `descripcion`, `fecha`, `rehabilitacion`, `fecha_cita`, `status`) VALUES
(36, NULL, '2025-06-12 17:51:16', 30, '2025-06-13', 'en proceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayudas_tec`
--

CREATE TABLE `ayudas_tec` (
  `id` int(11) NOT NULL,
  `tipo_ayuda_tec` varchar(10) DEFAULT NULL,
  `cedula` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancosvzla`
--

CREATE TABLE `bancosvzla` (
  `id-banco` int(11) NOT NULL,
  `nombre-Banco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bancosvzla`
--

INSERT INTO `bancosvzla` (`id-banco`, `nombre-Banco`) VALUES
(1, 'BANCO CENTRAL DE VENEZUELA'),
(102, 'BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL'),
(104, 'VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL'),
(105, 'BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL'),
(108, 'BANCO PROVINCIAL, S.A. BANCO UNIVERSAL'),
(114, 'BANCO DEL CARIBE, C.A. BANCO UNIVERSAL'),
(115, 'BANCO EXTERIOR, C.A. BANCO UNIVERSAL'),
(116, 'BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.'),
(128, 'BANCO CARONI, C.A. BANCO UNIVERSAL'),
(134, 'BANESCO BANCO UNIVERSAL S.A.C.A.'),
(137, 'BANCO SOFITASA BANCO UNIVERSAL, C.A.'),
(138, 'BANCO PLAZA, BANCO UNIVERSAL C.A.'),
(146, 'BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.'),
(149, 'BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO'),
(151, 'BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL'),
(157, 'DELSUR BANCO UNIVERSAL, C.A.'),
(163, 'BANCO DEL TESORO, C.A. BANCO UNIVERSAL'),
(166, 'BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL'),
(168, 'BANCRECER S.A. BANCO DE DESARROLLO'),
(169, 'MI BANCO, BANCO MICROFINANCIERO, C.A.'),
(171, 'BANCO ACTIVO, C.A. BANCO UNIVERSAL'),
(172, 'BANCAMIGA BANCO MICROFINANCIERO, C.A.'),
(173, 'BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL'),
(174, 'BANPLUS BANCO UNIVERAL, C.A.'),
(175, 'BANCO BICENTENARIO BANCO UNIVERSAL, C.A.'),
(176, 'NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL'),
(177, 'BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.'),
(190, 'CITIBANK N.A.'),
(191, 'BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

CREATE TABLE `beneficiario` (
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `fecha_naci` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `nacionalidad` char(2) NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` char(1) NOT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `pertenece_etnia` varchar(2) DEFAULT 'no',
  `etnia` varchar(50) DEFAULT NULL,
  `edo_civil` text NOT NULL,
  `nro_hijo` int(2) DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `discapacidad` varchar(10) NOT NULL,
  `atencion_solicitada` varchar(10) DEFAULT NULL,
  `certificado` varchar(50) DEFAULT NULL,
  `registrado_por` text DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_registro` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`cedula`, `nombre`, `apellido`, `fecha_naci`, `email`, `telefono`, `nacionalidad`, `edad`, `sexo`, `estado_civil`, `pertenece_etnia`, `etnia`, `edo_civil`, `nro_hijo`, `estado`, `municipio`, `direccion`, `parroquia`, `discapacidad`, `atencion_solicitada`, `certificado`, `registrado_por`, `fecha_registro`, `fecha_actualizacion`, `ip_registro`) VALUES
(1046565, 'RAFAEL JOSE', 'RAMIREZ VELASQUEZ', '1971-01-05', '', '04262929302', 'V', 54, 'M', NULL, 'no', NULL, 'soltero/a', 1, '18', '309', '', '808', 'Distrofia', '0-aten-coo', '409417', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(1219526, 'ANA JOAQUINA', 'LINARES', '1937-01-26', 'AURAMORALES@GMAIL.COM', '04122624826', 'V', 89, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1128', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(1231546, 'adssadw', 'asdeede', '2002-09-18', '', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'casado/a', 1, '21', '390', '', '978', 'dis_ecto', '0-aten-coo', '', 'Deiker Fernandez', '2025-01-18', '2026-04-13 04:37:41', NULL),
(1256456, 'Jose jose', 'Carvajal carvajal', '2002-09-18', 'rekied1842@gmail.com', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'casado/a', 1, '1', '1', '', '1', 'AnemiaCrni', '8-rehabili', '', 'Deiker Fernandez', '2024-12-15', '2026-04-13 04:37:41', NULL),
(2381410, 'MARIA JOSEFINA', 'MORENO', '1941-01-04', 'MARUJACOROMOTO@GMAIL.COM', '04222004756', 'V', 85, 'M', NULL, 'no', NULL, 'casado/a', 2, '24', '462', '', '1123', 'Distrofia', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-06', '2026-04-13 04:37:41', NULL),
(2657067, 'froilan jose', 'cortes rojas', '1943-06-01', 'cortesfroillan35@gmail.com', '04121577571', 'V', 81, 'M', NULL, 'no', NULL, 'casado/a', 7, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(2807454, 'cristobal ', 'duque', '1943-08-06', 'ysidro.adan@gmail.com', '11111111111', 'V', 82, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1117', 'motora', '1-oac', '00000000', 'ADAN CARTAGENA', '2026-03-06', '2026-04-13 04:37:41', NULL),
(2924229, 'Porfirio Rafael', 'Lopez Silva', '1944-04-21', '', '04169971630', 'V', 80, 'M', NULL, 'no', NULL, 'casado/a', 16, '18', '309', '', '807', 'motora', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(2925571, 'Jesus', 'Anton', '1941-11-06', 'mariaalejrivas@gmail.com', '04120424573', 'V', 83, 'M', NULL, 'no', NULL, 'casado/a', 0, '18', '309', '', '808', 'Ceguera_To', '0-aten-coo', '302893', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(2929513, 'carmen', 'machado', '1941-03-07', '', '04268930902', 'V', 83, 'F', NULL, 'no', NULL, 'soltero/a', 8, '18', '309', '', '811', 'motora', '0-aten-coo', '-168932', 'Laura Beatriz Pinto Hernandez', '2025-02-17', '2026-04-13 04:37:41', NULL),
(2958517, 'CARMEN ', 'CHIRINOS', '1947-01-10', 'LUISAECHIRINOS15@GMAIL.COM', '04127028982', 'V', 79, 'F', NULL, 'no', NULL, 'divorciado/a', 1, '24', '462', '', '1124', 'Distrofia', '1-oac', '00000', 'Isabel Ramirez', '2026-01-22', '2026-04-13 04:37:41', NULL),
(2976398, 'CLARA VIRGINIA', 'GORRI DE FERNANDEZ', '1939-02-13', 'las5v@hotmail.com', '04242537670', 'V', 86, 'F', NULL, 'no', NULL, 'casado/a', 3, '24', '462', '', '1137', 'Distrofia', '1-oac', '0', 'Francisco Ibanez', '2026-01-26', '2026-04-13 04:37:41', NULL),
(2976984, 'gladys', 'canelon', '1944-01-01', 'jesuspereira12977664@hotmail.com', '02124518482', 'V', 81, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1127', '1-AS/D', NULL, '', 'Yeselim Perez', '2025-06-11', '2026-04-13 04:37:41', NULL),
(2983212, 'Carlos', 'alvarez', '1945-01-11', 'jesuspereira12977664@hotmail.com', '04142275277', 'V', 80, 'M', NULL, 'no', NULL, 'casado/a', 0, '14', '239', '', '644', '1-AS/D', NULL, '', 'Yeselim Perez', '2025-06-11', '2026-04-13 04:37:41', NULL),
(3074974, 'ADELA', 'TARIBA DE ROCHA', '1941-11-15', 'PASAMOSUNA@GMAIL.COM', '04241198439', 'V', 84, 'F', NULL, 'no', NULL, 'casado/a', 3, '24', '462', '', '1123', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-03-23', '2026-04-13 04:37:41', NULL),
(3191519, 'maria soledad', 'rosales ', '1942-05-19', 'pesadillajr2023@gmail.com', '04241903487', 'V', 83, 'F', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16', '2026-04-13 04:37:41', NULL),
(3215528, 'LUIS EMILIO', 'SANTOS BERMUDEZ', '1944-11-06', 'candelarioliendo@gmail.com', '04126378326', 'V', 81, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1127', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-12', '2026-04-13 04:37:41', NULL),
(3233121, 'MIRIAM RAFAELA ', 'OCARIZ MANRIQUE', '1947-03-31', 'MYRIAMOCARIZ@GMAIL.COM', '04261048194', 'V', 78, 'F', NULL, 'no', NULL, 'divorciado/a', 1, '24', '462', '', '1117', 'motora', '1-oac', '441127', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(3252047, 'ALEXY  ANTONIO', 'WETTO', '1949-01-28', 'luisolivares1580@gmail.com', '04123030173', 'V', 77, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'Distrofia', '1-oac', '000', 'Luis Alberto  Olivares CONAPDIS', '2026-04-08', '2026-04-13 04:37:41', NULL),
(3338072, 'jesus ', 'benitez', '1947-09-06', 'heinleguzman0127@gmail.com', '04125996901', 'V', 77, 'M', NULL, 'no', NULL, 'casado/a', 3, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(3405632, 'ALICIA', 'UZCATEGUI', '1937-01-10', 'Yohannyteran73@gmail.com', '04241351277', 'V', 89, 'F', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'ESQ', '1-oac', '384167', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(3423317, 'JOSE ', 'GOMEZ', '1946-01-10', 'ysidro.adan@gmail.com', '04262187417', 'V', 80, 'M', NULL, 'no', NULL, 'casado/a', 2, '24', '462', '', '1117', 'motora', '1-oac', '000000', 'ADAN CARTAGENA', '2026-03-19', '2026-04-13 04:37:41', NULL),
(3474857, 'LUIS ANTONIO', 'AVILAN PUERTA', '1949-05-25', 'CECICHACON0108@GMAIL.COM', '04127989715', 'V', 76, 'M', NULL, 'no', NULL, 'casado/a', 1, '24', '462', '', '1123', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-03-09', '2026-04-13 04:37:41', NULL),
(3530623, 'bibiano', 'graterol', '1946-12-17', 'ysidro.adan@gmail.com', '04123901485', 'V', 79, 'M', NULL, 'no', NULL, 'viudo/a', 1, '21', '390', '', '982', 'motora', '1-oac', '000000', 'ADAN CARTAGENA', '2026-03-09', '2026-04-13 04:37:41', NULL),
(3569533, 'MARCIA LUCILA ', 'BENITEZ DE AZOCAR', '1945-10-26', 'LUISOLIVARES1580@GMAIL.COM', '04148025642', 'V', 80, 'F', NULL, 'no', NULL, 'casado/a', 1, '14', '243', '', '654', 'motora', '1-oac', '000', 'Luis Alberto  Olivares CONAPDIS', '2025-11-18', '2026-04-13 04:37:41', NULL),
(3605666, 'Manuel Antonio ', 'Diaz', '1949-12-07', 'crismard65g@gmail.com', '04147745666', 'V', 75, 'M', NULL, 'no', NULL, 'casado/a', 4, '18', '309', '', '808', 'Arr_crd', '0-aten-coo', '1232294', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(3609914, 'DANIEL', 'LIENDO COLINA', '1950-02-17', 'NOOOO@GMAIL.COM', '04268062956', 'V', 76, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1137', 'Distrofia', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-25', '2026-04-13 04:37:41', NULL),
(3839860, 'JESUS EULOGIO', 'MIJARES RADA', '1950-12-25', 'NOOOOO@GMAQIL.COM', '04122076195', 'V', 75, 'M', NULL, 'no', NULL, 'casado/a', 2, '14', '241', '', '648', 'motora', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(3885513, 'SANDRA MARIA', 'TROMPIZ ALVAREZ', '1948-09-19', 'Yohannyteran73@gmail.com', '04242274388', 'V', 77, 'F', NULL, 'no', NULL, 'divorciado/a', 0, '24', '462', '', '1133', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(3990577, 'RAFAEL ANGEL', 'ALVARADO PAREDES', '1951-08-06', 'Mariaeditha08@gmail.com', '04241040235', 'V', 74, 'M', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1129', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(4085757, 'MARIA DEL VALLE ', 'URBANEJA DE  RATIA ', '1947-01-31', 'luisolivares1580@gmail.com', '04142232468', 'V', 79, 'F', NULL, 'no', NULL, 'casado/a', 1, '14', '223', '', '601', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-20', '2026-04-13 04:37:41', NULL),
(4124735, 'JULIO RENGIFO', 'ORTEGA ', '2026-01-27', 'LUISOLIVARES1580@GMAIL.COM', '04122179287', 'V', 0, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1129', 'motora', '1-oac', '0378558', 'Luis Alberto  Olivares CONAPDIS', '2026-01-27', '2026-04-13 04:37:41', NULL),
(4169840, 'ARGENIS ANDRES ', 'PEREZ RIOS ', '1955-09-20', 'ARMANDOLEONEL2412@gmail.com', '04129134372', 'V', 70, 'M', NULL, 'no', NULL, 'soltero/a', 0, '14', '234', '', '634', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-10', '2026-04-13 04:37:41', NULL),
(4184459, 'Carmen Elvira', 'Rodriguez', '1950-11-15', 'jbarrios47@hotmail.com', '04142843086', 'V', 74, 'F', NULL, 'no', NULL, 'casado/a', 6, '18', '309', '', '808', 'motora', '0-aten-coo', '0507370', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(4188883, 'Luis Jose ', 'Villaroel ', '1949-12-02', '', '04128657378', 'V', 75, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '810', 'motora', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-03-26', '2026-04-13 04:37:41', NULL),
(4233724, 'TERESITA', 'HERNANDEZ', '1954-04-22', 'Yohannyteran73@gmail.com', '04242365876', 'V', 71, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1119', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(4274948, 'ANA DE LI', 'SANDIA LABRADOR', '1950-08-27', 'LOPEZSILVACP@GMAIL.COM', '04123703758', 'V', 75, 'F', NULL, 'no', NULL, 'casado/a', 2, '24', '462', '', '1137', 'Distrofia', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-04-08', '2026-04-13 04:37:41', NULL),
(4545711, 'COLUMBA jOSEFINA ', 'RIZZO DE MARCANO ', '1942-08-28', 'mrizlope24@gmail.com', '04121753986', 'V', 83, 'F', NULL, 'no', NULL, 'casado/a', 11, '4', '44', '', '131', 'parkinson', '1-oac', '', 'Francisco Ibanez', '2026-03-11', '2026-04-13 04:37:41', NULL),
(4562051, 'FLORSINA ', 'SALAZAR DEPEREZ ', '1941-04-08', '', '02934320233', 'V', 83, 'M', NULL, 'no', NULL, 'casado/a', 5, '18', '309', '', '810', 'motora', '0-aten-coo', '166079', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(4688373, 'Zoraida ', 'Salazar', '1950-06-09', '', '04125724021', 'V', 74, 'F', NULL, 'no', NULL, 'casado/a', 3, '18', '309', '', '807', 'Distrofia', '0-aten-coo', '401948', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(4692182, 'Jesus ', 'Cordova', '1943-03-15', '', '04148042733', 'V', 81, 'M', NULL, 'no', NULL, 'soltero/a', 7, '18', '309', '', '808', 'Baja_Visio', '0-aten-coo', '124329', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(4692308, 'JUANA DE DIOS ', 'MARIN DE SALAZAR', '1955-03-08', 'PIYUYITA92@GMAIL.COM', '04248591499', 'V', 69, 'F', NULL, 'no', NULL, 'casado/a', 5, '18', '309', '', '807', 'insuficie', '0-aten-coo', '150045', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(4692416, 'Cruz Elena ', 'Meneses', '1948-06-18', '', '04248455622', 'V', 76, 'F', NULL, 'no', NULL, 'soltero/a', 1, '18', '309', '', '807', 'motora', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(4692497, 'Marleny Josefina', 'Pulido', '1946-07-10', 'maryflorpulido@gmail.com', '02934521370', 'V', 78, 'F', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '807', 'Distrofia', '0-aten-coo', '126885', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(4854616, 'CARMEN LEONOR', 'DUARTE', '1951-05-20', 'asmeliquitero@gmail.com', '04261871343', 'V', 74, 'F', NULL, 'no', NULL, 'casado/a', 3, '24', '462', '', '1133', 'Distrofia', '1-oac', '93218', 'Francisco Ibanez', '2026-02-02', '2026-04-13 04:37:41', NULL),
(5083520, 'Luis', 'Weffe', '1956-12-22', '', '04141931868', 'V', 68, 'M', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '807', 'motora', '0-aten-coo', '336044', 'Ivan Jose ', '2025-02-26', '2026-04-13 04:37:41', NULL),
(5143496, 'Oscar ', 'riera', '1952-05-05', '', '04167208899', 'V', 73, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1135', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-17', '2026-04-13 04:37:41', NULL),
(5225379, 'LUIS RAMON', 'ROJAS TERAN', '1956-10-21', 'LUISROJAS@GMAIL.COM', '04127048065', 'V', 69, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1135', 'Oj_bd', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-10', '2026-04-13 04:37:41', NULL),
(5413770, 'GUIOMAR DEL MILAGRO ', 'RIVERO DE BARRADAS', '1956-03-04', 'GUIOMARRIVERO@GMAIL.COM', '04167514659', 'V', 70, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1125', 'motora', '1-oac', '447742', 'YOHANNY TERAN  CONAPDIS', '2026-03-10', '2026-04-13 04:37:41', NULL),
(5415186, 'CARMEN', 'DODERO DE SUARES', '1934-04-22', 'NAAA02@GMAIL.COM', '04128631258', 'V', 91, 'F', NULL, 'no', NULL, 'divorciado/a', 1, '24', '462', '', '1137', 'Distrofia', '1-oac', '1', 'Francisco Ibanez', '2026-03-09', '2026-04-13 04:37:41', NULL),
(5423480, 'EMILIO ANTONIO', 'GUTIERREZ    HERRERA ', '1959-11-12', 'LUISOLIVARES1580@gmail.com', '00000000000', 'V', 66, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1118', 'Ceguera_To', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(5575875, 'PEDRO OSWALDO', 'RODRIGUEZ CRUZ', '1957-05-19', 'luisolivares1580@gmail.com', '04143087402', 'V', 68, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1137', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-19', '2026-04-13 04:37:41', NULL),
(5595232, 'FLOR DE MARIA', 'GONZALEZ DE CASTRO', '1944-01-21', 'auroracastro678@gmail.com', '04167212792', 'V', 82, 'F', NULL, 'no', NULL, 'casado/a', 8, '14', '230', '', '620', '1-AS/D', '1-oac', '', 'Francisco Ibanez', '2026-04-08', '2026-04-13 04:37:41', NULL),
(5601699, 'JESUS RAFAEL', 'MOY GOMEZ', '1954-07-21', 'luisolivares1580@gmail.com', '04143323623', 'V', 71, 'M', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1117', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-09', '2026-04-13 04:37:41', NULL),
(5705838, 'carmen elena', 'galanton', '1949-02-26', 'pintohernandezlaurabeatriz@gmail.com', '04124016586', 'V', 75, 'F', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(5754220, 'JUANA  NOLBERTA ', 'MORENO', '1931-06-06', 'LUISOLIVARES1580@gmail.com', '04242411419', 'V', 94, 'F', NULL, 'no', NULL, 'soltero/a', 3, '24', '462', '', '1137', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(5953844, 'Ghasam', 'El Jurde', '1958-07-25', '', '04248312517', 'V', 66, 'M', NULL, 'no', NULL, 'casado/a', 2, '18', '309', '', '807', 'motora', '0-aten-coo', '301169', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(6030036, 'AIDA MARICELA                                 ', 'QUEVEDO', '1960-04-24', 'NAZARETHQUEVEDO22@GMAIL.COM', '04126332584', 'V', 65, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1129', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-03-23', '2026-04-13 04:37:41', NULL),
(6062851, 'RITA YAJAIRA ', 'HERNANDEZ', '1955-08-16', 'NOOOOOO@GTMAIL.COM', '04264542539', 'V', 70, 'F', NULL, 'no', NULL, 'casado/a', 3, '24', '462', '', '1124', 'motora', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(6081936, 'RICARDO', 'CASTILLO', '1958-05-14', 'ysidro.adan@gmail.com', '04120000000', 'V', 67, 'M', NULL, 'no', NULL, 'soltero/a', 4, '24', '462', '', '1130', 'Ceguera_To', '1-oac', '0000000', 'ADAN CARTAGENA', '2026-03-19', '2026-04-13 04:37:41', NULL),
(6109467, 'MILAGROS MARISOL ', 'ALARCON TORRES', '1961-06-22', 'yulimarcordero25@gmail.com', '04129588167', 'V', 64, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1138', 'motora', '1-oac', '00', 'Luis Alberto  Olivares CONAPDIS', '2026-04-08', '2026-04-13 04:37:41', NULL),
(6109804, 'ELIZABETH ', 'ARTEAGA', '1958-04-18', 'luisolivares1580@gmail.com', '04169198844', 'V', 67, 'F', NULL, 'no', NULL, 'casado/a', 1, '24', '462', '', '1127', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-24', '2026-04-13 04:37:41', NULL),
(6157880, 'OMAR ', 'TABASTA', '1963-10-23', 'TABASTAOMAR@HOTMAIL.COM', '04125916061', 'V', 62, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1118', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-03-23', '2026-04-13 04:37:41', NULL),
(6243569, 'YTALO ANTONIO', 'ESCALONA', '1964-11-01', 'franksib123@gmail.com', '04122206677', 'V', 61, 'M', NULL, 'no', NULL, 'casado/a', 3, '24', '462', '', '1117', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-01-19', '2026-04-13 04:37:41', NULL),
(6260994, 'ELBA ', 'CRESPO', '1964-06-13', 'ysidro.adan@gmail.com', '04125776207', 'V', 61, 'F', NULL, 'no', NULL, 'soltero/a', 3, '24', '462', '', '1133', 'motora', '1-oac', '0000000', 'ADAN CARTAGENA', '2026-03-09', '2026-04-13 04:37:41', NULL),
(6297759, 'JOSE LUIS', 'MENDEZ', '1969-02-15', 'luisolivares1580@gmail.com', '04123080958', 'V', 57, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'Ceguera_To', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-25', '2026-04-13 04:37:41', NULL),
(6349747, 'YUBELINE  COROMOTO', 'GASCON DIAZ', '1968-04-19', 'LUISOLIVARES1580@gmail.com', '04266921042', 'V', 57, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1121', 'Ceguera_To', '1-oac', '407803', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(6359029, 'LUIS  ALBERTO ', 'DURAN AGUILAR', '0060-09-03', 'anaduranherbert@gmail.com', '04241827528', 'V', 65, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1117', 'Distrofia', '1-oac', '000', 'Luis Alberto  Olivares CONAPDIS', '2026-03-06', '2026-04-13 04:37:41', NULL),
(6361308, 'NORAH YSABEL', 'MENDOZA DE CORONIL', '1958-02-16', 'docenteorgullosa2024@gmail.co', '04120900419', 'V', 68, 'F', NULL, 'no', NULL, 'casado/a', 2, '24', '462', '', '1119', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-02', '2026-04-13 04:37:41', NULL),
(6453964, 'LEONARDO  ARTURO', 'HERRERA', '1965-01-11', 'LUISOLIVARES1580@gmail.com', '04146253207', 'V', 61, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1137', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(6470022, 'HENRRY GABRIEL', 'VILLARROEL VIZCAINO', '1958-10-09', 'HENNRRYVILLAROEL@GMAIL.COM', '04141263597', 'V', 67, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1138', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-24', '2026-04-13 04:37:41', NULL),
(6504450, 'VICTOR MANUEL', 'TABASQUEZ', '1965-01-19', 'LUISOLIVARES1580@gmail.com', '04241730388', 'V', 61, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1137', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(6539799, 'Mercedes Josefina', 'Fuentes', '1947-02-03', '', '04248901817', 'V', 78, 'M', NULL, 'no', NULL, 'soltero/a', 7, '18', '309', '', '807', 'motora', '0-aten-coo', '162807', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(6728217, 'DUBER RAFAEL ', 'CORDERO NAVAS', '1964-09-25', 'deisycordero961@gmail.com', '04263219742', 'V', 61, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1128', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-10', '2026-04-13 04:37:41', NULL),
(7360723, 'JANET MILAGROS', 'LOPEZ', '1962-04-28', 'LUISOLIVARES1580@gmail.com', '04121712835', 'V', 63, 'F', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1137', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(7445492, 'YANETZI JOSEFINA', 'LOYO RIVAS', '1968-09-22', 'LUISOLIVARES1580@gmail.com', '04142558352', 'V', 57, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1132', 'Ceguera_To', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(8164768, 'MARIA OLIDINA', 'ROBAYO DE AGUERO', '1936-01-11', 'Ramirezcarolina968@gmail.com', '04125865859', 'V', 90, 'F', NULL, 'no', NULL, 'casado/a', 1, '24', '462', '', '1120', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-21', '2026-04-13 04:37:41', NULL),
(8183568, 'CARLOS   OMAR', 'LOPEZ', '1960-12-07', 'luisolivares1580@gmail.com', '04127910798', 'V', 65, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1135', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-24', '2026-04-13 04:37:41', NULL),
(8303365, 'Cristina del Valle', 'Garcia', '1958-07-24', 'yanetzi68@gmail.com', '04147745666', 'V', 66, 'F', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '808', 'motora', '0-aten-coo', '112400', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(8340872, 'ORLANDO JOSE ', 'HERNANDEZ', '1964-02-08', 'mrizlope24@gmail.com', '04129311251', 'V', 62, 'M', NULL, 'no', NULL, 'casado/a', 4, '2', '23', '', '67', 'Distrofia', '1-oac', '04129311251', 'Francisco Ibanez', '2026-03-06', '2026-04-13 04:37:41', NULL),
(8365339, 'GLADYS JOSEFINA', 'MARQUEZ RODRIGUEZ', '1960-05-11', 'Yohannyteran73@gmail.com', '04123357117', 'V', 65, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1127', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(8424575, 'Juan Vicente', 'Salazar', '1956-01-27', '', '04161818047', 'V', 69, 'M', NULL, 'no', NULL, 'viudo/a', 3, '18', '309', '', '807', 'paralisis', '0-aten-coo', '54467', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(8430868, 'YRMA DEL VALLE', 'BASTARDO', '1949-06-15', '', '04264061688', 'V', 75, 'F', NULL, 'no', NULL, 'casado/a', 6, '18', '309', '', '810', 'motora', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(8432960, 'CARMEN BEATRIZ ', 'SALAZARLANDAETA', '1951-12-14', '', '04248879023', 'V', 73, 'F', NULL, 'no', NULL, 'casado/a', 6, '18', '309', '', '810', 'motora', '0-aten-coo', '155586', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(8442973, 'wilfredo', 'vallejo', '1950-10-27', 'pintohernandezlaurabeatriz@gmail.com', '04124016586', 'V', 73, 'M', NULL, 'no', NULL, 'casado/a', 1, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(8549825, 'francisca', 'martinez de vallejo', '1955-06-13', 'pintohernandezlaurabeatriz@gmail.com', '04248815740', 'V', 69, 'F', NULL, 'no', NULL, 'casado/a', 1, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(8636544, 'RAFAEL JOSE ', 'FLORES RODRIGUEZ', '1958-02-13', '', '04161641998', 'V', 67, 'M', NULL, 'no', NULL, 'soltero/a', 4, '18', '296', '', '762', 'cardiopati', '0-aten-coo', '11621', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(8636894, 'Luisa', 'Rodriguez', '1967-06-14', '', '04248852088', 'V', 57, 'F', NULL, 'no', NULL, 'soltero/a', 3, '18', '309', '', '807', 'motora', '0-aten-coo', '350743', 'Ivan Jose ', '2025-02-26', '2026-04-13 04:37:41', NULL),
(8642045, 'juan', 'fajardo', '1964-09-10', '', '04123015223', 'V', 60, 'M', NULL, 'no', NULL, 'soltero/a', 3, '18', '309', '', '808', '1-AS/D', '0-aten-coo', '0', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(8642390, 'Jose', 'Hernandez', '1967-11-05', '', '04149958328', 'V', 57, 'M', NULL, 'no', NULL, 'casado/a', 3, '18', '309', '', '807', 'cardiopati', '0-aten-coo', '323458', 'Ivan Jose ', '2025-02-26', '2026-04-13 04:37:41', NULL),
(8647915, 'luis', 'fajardo', '1962-02-28', '', '02938428868', 'V', 62, 'M', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '808', '1-AS/D', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(8652636, 'Hilda josefina', 'patino', '1962-09-20', '', '04248110739', 'V', 62, 'M', NULL, 'no', NULL, 'soltero/a', 7, '18', '303', '', '785', 'motora', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(8683522, 'felix', 'key', '1967-05-06', 'key522@gmail.com', '04267705580', 'V', 58, 'M', NULL, 'no', NULL, 'casado/a', 0, '18', '304', '', '788', '1-AS/D', '0-aten-coo', '', 'Maria Monterola', '2025-07-29', '2026-04-13 04:37:41', NULL),
(9005493, 'JOSE RAMON', 'ARAUJO', '1957-08-28', 'NOOOOO@GIMAIL.COM', '04265869009', 'V', 68, 'M', NULL, 'no', NULL, 'casado/a', 1, '14', '229', '', '619', 'motora', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(9274044, 'Arquimedez Rafael ', 'Henriquez ', '1960-08-20', '', '04164206660', 'V', 64, 'M', NULL, 'no', NULL, 'soltero/a', 3, '18', '309', '', '808', 'Diabetes_M', '0-aten-coo', '0381765', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(9275125, 'zoraida', 'carrillo', '1961-05-25', '', '04162360030', 'V', 63, 'F', NULL, 'no', NULL, 'casado/a', 4, '18', '309', '', '807', 'motora', '0-aten-coo', '592726', 'Laura Beatriz Pinto Hernandez', '2025-02-25', '2026-04-13 04:37:41', NULL),
(9461522, 'RAMIRO ', 'GRANADOS CARVACHO', '1960-04-10', 'LUISOLIVARES1580@gmail.com', '04123100285', 'V', 65, 'M', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1127', 'Baja_Visio', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(9953256, 'JOSE MIGUEL', 'JIMENEZ RUIZ ', '1967-09-19', 'airin.ajrs@gmail.com', '04263130982', 'V', 58, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1122', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-12', '2026-04-13 04:37:41', NULL),
(9957384, 'JOSE EUGENIO ', 'ALZOLAY ZAMBRANO', '1967-05-22', 'NAAAAA@GMAIL.COM', '04142811676', 'V', 58, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1137', 'motora', '1-oac', '', 'Francisco Ibanez', '2026-03-10', '2026-04-13 04:37:41', NULL),
(9961396, 'LINDA', 'VIELMA', '1971-08-01', 'ysidro.adan@gmail.com', '04242502403', 'V', 54, 'F', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1138', 'motora', '1-oac', '0000000', 'ADAN CARTAGENA', '2026-03-05', '2026-04-13 04:37:41', NULL),
(9973719, 'DIUNYS JOSE ', 'LISBOARENGEL ', '1966-11-11', '', '04160821410', 'V', 58, 'M', NULL, 'no', NULL, 'soltero/a', 1, '18', '309', '', '810', 'motora', '0-aten-coo', '179704', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(9980488, 'JOSE LUIS ', 'VASQUEZ', '1969-04-11', 'JOVASQUEZ064@GMAIL.COM', '04248544045', 'V', 55, 'M', NULL, 'no', NULL, 'divorciado/a', 2, '18', '309', '', '807', 'motora', '0-aten-coo', '43782', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(10462058, 'ARECELYS MARGARITA ', 'MALAVE', '1969-01-11', 'RACELYSMALAVE69@GMAIL.COM', '04248656925', 'V', 56, 'F', NULL, 'no', NULL, 'soltero/a', 2, '18', '309', '', '809', 'Distrofia', '0-aten-coo', '135767', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(10467713, 'Henry', 'Mercie', '1968-11-09', '', '04145424431', 'V', 56, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '807', 'motora', '0-aten-coo', '257162', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(10498342, 'wuilma', 'arcila', '1971-05-05', 'ysidro.adan@gmail.com', '04261996539', 'V', 54, 'M', NULL, 'no', NULL, 'soltero/a', 2, '14', '239', '', '644', 'motora', '1-oac', '24436', 'ADAN CARTAGENA', '2026-03-11', '2026-04-13 04:37:41', NULL),
(10791762, 'Asdrubal Jose', 'Galindo Curvelo', '1969-05-22', 'asdubalgalindo@gmail.com', '04124280152', 'V', 55, 'M', NULL, 'no', NULL, 'casado/a', 6, '14', '234', '', '633', 'Obesidad-M', '0-aten-coo', '434381', 'Leomar Alberto Mata Betancourt', '2025-03-24', '2026-04-13 04:37:41', NULL),
(10792919, 'YEBRI JOSE ', 'MARCANO', '1970-09-06', '', '04248832509', 'V', 54, 'M', NULL, 'no', NULL, 'soltero/a', 5, '18', '309', '', '808', 'motora', '0-aten-coo', '188253', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(10950457, 'JAIRO RUBEN', 'DEL VALLE ALFONZO ', '1971-11-30', '', '04161568437', 'V', 53, 'M', NULL, 'no', NULL, 'soltero/a', 3, '18', '309', '', '807', 'motora', '0-aten-coo', '73440', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(11554051, 'JOHNNY  ELIAS', 'CHUQUI DJECKI', '1973-08-21', 'LUISOLIVARES1580@gmail.com', '04242495192', 'V', 52, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1117', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(12142595, 'MARIBET', 'RUIZ', '1971-02-17', 'franksib123@gmail.com', '04120463243', 'V', 54, 'F', NULL, 'no', NULL, 'soltero/a', 3, '24', '462', '', '1127', 'Ceguera_To', '1-oac', '04120463243', 'Francisco Ibanez', '2026-01-22', '2026-04-13 04:37:41', NULL),
(12298380, 'NEILA', 'PARUCHO', '1974-05-26', 'ysidro.adan@gmail.com', '04247784548', 'V', 51, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1137', 'motora', '1-oac', '000000', 'ADAN CARTAGENA', '2026-03-16', '2026-04-13 04:37:41', NULL),
(12340086, 'LENIN EDUARDO ', 'PARADAS  PALACIOS ', '1976-03-01', 'LUISOLIVARES1580@gmail.com', '04143012852', 'V', 49, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1117', 'Ceguera_To', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(12561565, 'Jose', 'Fernández', '2002-09-18', 'rekied1842@gmail.com', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'casado/a', 2, '3', '29', '', '81', 'dis_ecto', '1-oac', '', 'Deiker Fernandez', '2025-01-18', '2026-04-13 04:37:41', NULL),
(12662749, 'Cruz ', 'Gomez', '1973-03-01', '', '04160338347', 'V', 51, 'M', NULL, 'no', NULL, 'casado/a', 2, '18', '309', '', '808', 'Baja_Visio', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-26', '2026-04-13 04:37:41', NULL),
(12670978, 'RICHARD JOSE ', 'RAMOS MAESTRE ', '1972-12-12', '', '04128588824', 'V', 52, 'M', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '807', 'motora', '0-aten-coo', '42893', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(12880192, 'JOSE LUIS ', 'HUMBRIA CASTILLO', '1973-04-19', 'omarfarias62@hotmail.com', '04142732306', 'V', 52, 'M', NULL, 'no', NULL, 'soltero/a', 2, '14', '229', '', '619', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16', '2026-04-13 04:37:41', NULL),
(13218170, 'NISSEL MARIELY', 'BELTRAN CEBALLOS', '1970-12-14', 'luisolivares1580@gmail.com', '04165871458', 'V', 55, 'F', NULL, 'no', NULL, 'soltero/a', 0, '14', '232', '', '629', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-10', '2026-04-13 04:37:41', NULL),
(13515218, 'JULIO CESAR ', 'MICTILCORDERO ', '1977-09-20', 'corderosierra5@gmail.com', '04122037655', 'V', 48, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1122', 'motora', '1-oac', '00', 'Luis Alberto  Olivares CONAPDIS', '2026-04-06', '2026-04-13 04:37:41', NULL),
(13636974, 'Gabriel ', 'Soto', '1976-06-22', '', '04129584326', 'V', 49, 'M', NULL, 'no', NULL, 'casado/a', 2, '24', '462', '', '1127', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-17', '2026-04-13 04:37:41', NULL),
(13772495, 'MARITZA DEL CARMEN ', 'SALAZAR ', '1974-06-25', '', '04163098462', 'V', 50, 'F', NULL, 'no', NULL, 'soltero/a', 3, '18', '309', '', '808', 'motora', '0-aten-coo', '372495', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(14128684, 'AMAURY ARGENIS', 'RODRIGUEZ', '1974-09-09', 'ysidro.adan@gmail.com', '04126036991', 'V', 51, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1118', 'motora', '1-oac', '208887', 'ADAN CARTAGENA', '2026-03-05', '2026-04-13 04:37:41', NULL),
(14260655, 'MARIA MERCEDES', 'RISCANEVO DE OCANTO', '1944-02-02', 'Yohannyteran73@gmail.com', '04125751861', 'V', 82, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1127', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(14299632, 'VERONICA ', 'NAPOLITANO', '1977-04-18', 'rojasdehidalgo@gmail.com', '04241275980', 'V', 48, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1117', 'motora', '1-oac', '', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16', '2026-04-13 04:37:41', NULL),
(14518823, 'EUGENIO', 'ARIZA', '1980-10-31', 'ysidro.adan@gmail.com', '04120000000', 'V', 45, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1130', 'motora', '1-oac', '000000', 'ADAN CARTAGENA', '2026-03-16', '2026-04-13 04:37:41', NULL),
(14596035, 'ANGEL JOSE ', 'RODRIGUEZ ', '1981-01-19', 'ANGELJOSE481@GMAIL.COM', '04121867116', 'V', 44, 'M', NULL, 'no', NULL, 'casado/a', 3, '18', '309', '', '810', 'Distrofia', '0-aten-coo', '323975', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(14886764, 'Rodolfo ', 'Marin', '1980-01-18', 'Marinrodriguezrodolfo@gmail.com', '04129962246', 'V', 45, 'M', NULL, 'no', NULL, 'casado/a', 3, '18', '309', '', '808', 'Insu_rnalc', '0-aten-coo', '', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(15167158, 'MARCOS  PLINIO ', 'DUGARTE PEÑALOZA', '1980-02-21', 'luisolivares1580@gmail.com', '04242802210', 'V', 46, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1135', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-17', '2026-04-13 04:37:41', NULL),
(15204032, 'JOSE  ANTONIO ', 'ESPINOZA NUÑEZ', '1979-06-03', 'NOOOOOO@GMAIL.COM', '04242648856', 'V', 46, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1118', 'Distrofia', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(15684500, 'ANGELICA', 'CAICEDO MENDOZA', '1946-01-27', 'edi0951@gmail.com', '04261022547', 'V', 80, 'F', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'motora', '1-oac', '10', 'Luis Alberto  Olivares CONAPDIS', '2026-01-30', '2026-04-13 04:37:41', NULL),
(15835054, 'MARCOS ALEJANDRO ', 'AGUIAR SILVA ', '1983-02-21', 'LUISOLIVARES1580@GMAIL.COM', '04167199123', 'V', 42, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1137', 'motora', '1-oac', '403351', 'Luis Alberto  Olivares CONAPDIS', '2025-11-17', '2026-04-13 04:37:41', NULL),
(16227883, 'MARIA CRISTINA ', 'NARVAEZ  DE ROMERO', '1948-04-14', 'MARIANARVAEZ@GMAIL.COM', '04141800099', 'V', 77, 'F', NULL, 'no', NULL, 'casado/a', 0, '14', '225', '', '612', 'motora', '1-oac', '410506', 'YOHANNY TERAN  CONAPDIS', '2026-03-19', '2026-04-13 04:37:41', NULL),
(17763220, 'daniel eduardo', 'lopez velasquez', '1982-06-10', 'pintohernandezlaurabeatriz@gmail.com', '04248815740', 'V', 42, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '811', 'Hipoacusia', '0-aten-coo', '103451', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(17763521, 'Jhoan ', 'Alzolar', '1986-01-20', 'jhoanalzolar37@gmail.com', '04269441883', 'V', 39, 'M', NULL, 'no', NULL, 'soltero/a', 4, '18', '309', '', '807', 'motora', '0-aten-coo', '425282', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(17832610, 'yenny carolina ', 'linares villareal ', '1988-04-10', 'yclv2204@gmail.com', '04260376312', 'V', 36, 'M', NULL, 'no', NULL, 'casado/a', 2, '14', '223', '', '601', 'Afecc_tiro', '0-aten-coo', '', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(17910415, 'francys', 'vasquez', '1985-11-20', 'pintohernandezlaurabeatriz@gmail.com', '04164691359', 'V', 38, 'F', NULL, 'no', NULL, 'casado/a', 2, '18', '309', '', '811', '1-AS/D', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-04-07', '2026-04-13 04:37:41', NULL),
(17977264, 'NORELIS', 'SALCEDO', '2025-08-27', '', '02125417035', 'V', 0, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1131', 'motora', '1-oac', '', 'ADAN CARTAGENA', '2025-08-28', '2026-04-13 04:37:41', NULL),
(18210098, 'JEAN CARLOS ', 'PATIÑO MARVAL ', '1983-02-01', '', '04124697967', 'V', 42, 'M', NULL, 'no', NULL, 'soltero/a', 1, '18', '309', '', '808', 'motora', '0-aten-coo', '11944', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(18211838, 'Vanesa', 'Urbaneja', '1986-05-04', 'Vanesaurbanejamalave@gmail.com', '04148211918', 'V', 38, 'F', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '807', 'Insu_rnalc', '0-aten-coo', '276170', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(18511929, 'HECTOR  JOSE ', 'CAMPOS SANTAELLA', '1988-07-21', 'giselasantaella20@gmail.com', '04120110733', 'V', 37, 'M', NULL, 'no', NULL, 'soltero/a', 1, '14', '241', '', '647', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-23', '2026-04-13 04:37:41', NULL),
(18598845, 'ERNESTO JOSE ', 'GUZMAN IGUARO', '1986-04-10', 'LUISOLIVARES1580@gmail.com', '04149048538', 'V', 39, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1118', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(18750389, 'JOSE ALEXANDER', 'CABRITA HERNANDEZ ', '1987-01-15', 'cabritaana@gmail.com', '04241571893', 'V', 39, 'M', NULL, 'no', NULL, 'soltero/a', 0, '14', '241', '', '648', 'motora', '1-oac', '', 'Luis Alberto  Olivares CONAPDIS', '2026-03-26', '2026-04-13 04:37:41', NULL),
(19397245, 'FRANKLIN MARK', 'RAMOS HERNANDEZ ', '1985-11-29', 'LUISOLIVARES1580@gmail.com', '04164258201', 'V', 40, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1130', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(19401635, 'EUGEMAR ANILC', 'FIGUERAS', '1990-12-01', '', '04129905920', 'V', 35, 'F', NULL, 'no', NULL, 'soltero/a', 0, '14', '237', '', '641', 'motora', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-10', '2026-04-13 04:37:41', NULL),
(19893082, 'Lety del Carmen', 'Narvaez', '1989-11-17', '', '04246727025', 'V', 35, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'motora', '0-aten-coo', '298007', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(20027969, 'EVERCIO  DE JESUS  ', 'SALAS  BARRETO', '1963-04-17', 'luisolivares1580@gmail.com', '04245402077', 'V', 62, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1117', 'Ceguera_To', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-03-10', '2026-04-13 04:37:41', NULL),
(20047968, 'YITER', 'CADENAS ROMERO', '1987-05-07', 'luisolivares1580@gmail.com', '04149186377', 'V', 38, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1118', 'motora', '1-oac', '000', 'Luis Alberto  Olivares CONAPDIS', '2026-03-06', '2026-04-13 04:37:41', NULL),
(20064934, 'JOSSETH RAFAEL ', 'GARCIA', '1984-11-26', '', '04248034232', 'V', 40, 'M', NULL, 'no', NULL, 'casado/a', 1, '18', '309', '', '808', 'D_di', '0-aten-coo', '117201', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(20329013, 'JOHANNA EMPERATRIZ', 'BERMUDEZ DUGARTE', '1982-09-12', 'aliciaymariangellisieglett@GMAIL.COM', '04123994509', 'V', 43, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1130', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-28', '2026-04-13 04:37:41', NULL),
(20565667, 'AMDO ENRIQUE ', 'MOYA SALAZAR', '1993-09-13', 'LUISOLIVARES1580@gmail.com', '04128203378', 'V', 32, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1137', 'motora', '1-oac', '111440', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(21537046, 'SIUL  YAMIRAT', 'CORTEZ VALERO', '1989-05-20', 'LUISOLIVARES1580@gmail.com', '04120296381', 'V', 36, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1137', 'motora', '1-oac', '295285', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(22748260, 'HONORATO ', 'CACERES', '1952-02-08', 'NOOOO@GIMAIL.COM', '04161938001', 'V', 74, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1133', 'Baja_Visio', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(22764199, 'MILAGROS YOSELIN ', 'GARCIA PERNIA', '1992-01-21', 'TOMASAPERNIAMEDICA@gmail.com', '04121227348', 'V', 34, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1129', 'motora', '1-oac', '384306', 'Luis Alberto  Olivares CONAPDIS', '2026-01-21', '2026-04-13 04:37:41', NULL),
(23148581, 'FABIAN', 'DE HORTA MANJARRES', '1955-12-22', 'LUISOLIVARES1580@gmail.com', '04241426298', 'V', 70, 'M', NULL, 'no', NULL, 'soltero/a', 2, '14', '241', '', '651', 'Ceguera_To', '1-oac', '2040', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(23623881, 'JESUS ALEJANDRO', 'PERNALETE  PERNALETE', '1995-03-02', 'cebm1484@gmail.com', '04142664699', 'V', 30, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1117', 'motora', '1-oac', '19595', 'Luis Alberto  Olivares CONAPDIS', '2026-02-19', '2026-04-13 04:37:41', NULL),
(23682288, 'VICENTE ANTONIO', 'DIAZ LECHE', '1966-10-20', '', '04264444358', 'V', 59, 'M', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1137', 'Distrofia', '1-oac', '', 'Francisco Ibanez', '2026-03-06', '2026-04-13 04:37:41', NULL),
(24530170, 'LUIS IVAN', 'ROJAS MORA', '1964-03-21', 'IVANROJASS092@GMAIL.COM', '04260351548', 'V', 61, 'M', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1120', 'motora', '1-oac', '0000', 'Luis Alberto  Olivares CONAPDIS', '2025-11-18', '2026-04-13 04:37:41', NULL),
(24753523, 'ROSMARY CAROLINA ', 'PEREZ MICAT', '1994-11-20', '', '04248838448', 'V', 30, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '807', 'Sordo', '0-aten-coo', '42539', 'JOSE MARQUEZ', '2025-02-21', '2026-04-13 04:37:41', NULL),
(25226787, 'JOSE ALEXANDER', 'APONTE', '1991-07-22', 'jslxdrpnt@gmail.com', '04141225711', 'V', 34, 'M', NULL, 'no', NULL, 'soltero/a', 1, '24', '462', '', '1123', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-11', '2026-04-13 04:37:41', NULL),
(25414998, 'Jonas', 'Ravelo', '1994-03-11', '', '04121170607', 'V', 30, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'Distrofia', '0-aten-coo', '257169', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(25624227, 'MOISES ENRIQUE ', 'DIAZ', '1995-09-25', 'LUISOLIVARES1580@gmail.com', '04241228201', 'V', 30, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1124', 'motora', '1-oac', '246307', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19', '2026-04-13 04:37:41', NULL),
(25674958, 'JEAN FRAN ', 'MARQUEZ MEZA', '1995-02-20', 'luisolivares1580@gmail.com', '04128438342', 'V', 31, 'M', NULL, 'no', NULL, 'soltero/a', 0, '14', '237', '', '641', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-02-20', '2026-04-13 04:37:41', NULL),
(25695551, 'Yunior Hernán ', 'Blanco Guzmán ', '1994-08-02', 'elgriblanco8@gmail.com', '04241840252', 'V', 30, 'M', NULL, 'no', NULL, 'soltero/a', 3, '14', '232', '', '625', 'motora', '0-aten-coo', '', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-07', '2026-04-13 04:37:41', NULL),
(25897300, 'jose gregorio', 'lobaton', '1993-08-31', '', '04121611946', 'V', 31, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'S.Acogniti', '0-aten-coo', '', 'Laura Beatriz Pinto Hernandez', '2025-02-25', '2026-04-13 04:37:41', NULL),
(25997137, 'Gerson', 'Diaz', '1995-12-16', '', '04121899328', 'V', 29, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '809', 'D_di', '0-aten-coo', '38928', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(26031317, 'Joaquin', 'Arismendi', '2017-09-04', 'isabellanza@gmail.com', '04120802924', 'V', 7, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '809', 'motora', '0-aten-coo', '298259', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(26251194, 'enyeber', 'rodriguez', '2016-09-09', 'coromotoreginfo78@gmail.com', '04162766304', 'V', 8, 'M', NULL, 'no', NULL, 'casado/a', 0, '14', '223', '', '601', 'motora', '0-aten-coo', '0', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(26463644, 'NELSON NAIL', 'LINAREZ RONDON', '0098-02-20', 'ramirezisab2210@gmail.com', '04245573582', 'V', 28, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1127', 'displasia', '1-oac', '0', 'Isabel Ramirez', '2026-02-20', '2026-04-13 04:37:41', NULL),
(27200412, 'DANYERLIS ALAXANDRA', 'PEREIRA TORRES', '1999-11-30', 'NOOOOOO@GMAIL.COM', '04123371460', 'V', 26, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1128', 'motora', '1-oac', '', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11', '2026-04-13 04:37:41', NULL),
(27803002, 'GABRIEL ALBERTO', 'ROJAS ECHEVERRIAS', '2001-10-04', 'nelidagutierrez21@gmail.com', '04169998336', 'V', 24, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1118', 'motora', '1-oac', '0017121', 'Luis Alberto  Olivares CONAPDIS', '2026-03-26', '2026-04-13 04:37:41', NULL),
(28044742, 'Jose Alejandro', 'Serrano', '2000-12-26', '', '04264369458', 'V', 24, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'D_di', '0-aten-coo', '0117391', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(28143325, 'YORGELIS ALEXANDRA  ', 'ALVARADO VALERA', '2001-10-12', 'NAAAAA@GMAIL.COM', '04145312315', 'V', 24, 'F', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1135', 'paralisis', '1-oac', '', 'Francisco Ibanez', '2026-03-11', '2026-04-13 04:37:41', NULL),
(28447405, 'jeyns ', 'galindo', '2018-08-23', 'yurielvis.2016@gmail.com', '04127084798', 'V', 7, 'M', NULL, 'no', NULL, 'casado/a', 0, '24', '462', '', '1117', 'motora', '1-oac', '1', 'Yurielvis Marian Gomez Rodriguez CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(30000000, 'Jose', 'Fernández', '2002-09-18', 'rekied1842@gmail.com', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'casado/a', 0, '11', '129', '', '417', 'Down', '1-oac', '', 'Deiker Fernandez', '2024-12-15', '2026-04-13 04:37:41', NULL),
(30165406, 'Deiker Jose', 'Fernandez', '2002-09-18', 'rekied1842@gmail.com', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'soltero/a', 1, '13', '179', '', '515', 'AnemiaCrni', NULL, '-1', 'Deiker Fernandez', '2025-01-20', '2026-04-13 04:37:41', NULL),
(30165411, 'Jose', 'Fernández', '2002-09-18', 'rekied1842@gmail.com', '04120183670', 'V', 22, 'M', NULL, 'no', NULL, 'casado/a', 2, '14', '223', '', '601', 'Baja_Visio', NULL, '0', 'Deiker Fernandez', '2025-01-20', '2026-04-13 04:37:41', NULL),
(30235535, 'LEUDYS JESUS ', 'GONZALEZ BRAZON ', '2004-05-23', 'LUISOLIVARES1580@gmail.com', '04129620098', 'V', 21, 'M', NULL, 'no', NULL, 'soltero/a', 1, '21', '390', '', '978', 'motora', '1-oac', '0', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(30444385, 'Lusiangelis', 'Rodriguez', '2004-06-29', 'rluciangelis26@gmail.com', '04164970781', 'V', 20, 'F', NULL, 'no', NULL, 'soltero/a', 0, '18', '306', '', '795', 'TEA', '0-aten-coo', '191415', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(30908646, 'LUISANA MARIA ', 'RONDON PEREIRA', '2005-09-03', 'LUISOLIVARES1580@gmail.com', '04241259951', 'V', 20, 'F', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1138', 'motora', '1-oac', '19513', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20', '2026-04-13 04:37:41', NULL),
(33351791, 'JESUS', 'ROSALES', '2010-02-25', 'ysidro.adan@gmail.com', '04122009860', 'V', 15, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1122', 'motora', '1-oac', '000000000', 'ADAN CARTAGENA', '2026-02-23', '2026-04-13 04:37:41', NULL),
(33419859, 'LUIS FERNANDO', 'VASQUEZ PINTO', '2010-02-08', 'Yohannyteran73@gmail.com', '04144447240', 'V', 16, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1118', 'Distrofia', '1-oac', '', 'YOHANNY TERAN  CONAPDIS', '2026-03-05', '2026-04-13 04:37:41', NULL),
(33685946, 'jeferson', 'otero', '2008-06-17', '', '04125633667', 'V', 16, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'motora', '0-aten-coo', '232345', 'Ivan Jose ', '2025-02-26', '2026-04-13 04:37:41', NULL),
(34157683, 'fabian', 'egui', '2012-07-07', 'ysidro.adan@gmail.com', '04241534845', 'V', 13, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1117', 'motora', '1-oac', '0000010000', 'ADAN CARTAGENA', '2026-03-06', '2026-04-13 04:37:41', NULL),
(34601579, 'Reinaldo Jose ', 'Espinoza', '2012-06-24', 'espinreinaldo978@gmail.com', '04123501488', 'V', 12, 'M', NULL, 'no', NULL, 'casado/a', 0, '18', '296', '', '762', 'Anacusia', '0-aten-coo', '', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(37407453, 'ANGEL DAVID', 'MORILLO MORA ', '2016-07-20', 'dayana23crespo@gmail.com', '04124761085', 'V', 9, 'M', NULL, 'no', NULL, 'soltero/a', 0, '14', '234', '', '633', 'paralisis', '1-oac', '000000', 'Leydy Crespo Conapdis', '2026-03-26', '2026-04-13 04:37:41', NULL),
(81305530, 'MARIANA', 'DELGADO', '1945-07-18', 'ysidro.adan@gmail.com', '04242899237', 'E', 80, 'F', NULL, 'no', NULL, 'soltero/a', 2, '24', '462', '', '1138', 'motora', '1-oac', '0000000', 'ADAN CARTAGENA', '2026-03-05', '2026-04-13 04:37:41', NULL),
(175734311, 'ISAIAS EDUARDO', 'PERAZA', '2021-04-30', 'ysidro.adan@gmail.com', '04245158280', 'V', 4, 'M', NULL, 'no', NULL, 'soltero/a', 0, '24', '462', '', '1117', 'paralisis', '1-oac', '0000000000', 'ADAN CARTAGENA', '2026-03-05', '2026-04-13 04:37:41', NULL),
(177636621, 'Cristofer ', 'Viloria', '2016-01-19', 'mariannyscristofer@gmail.com', '04145836205', 'V', 9, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '306', '', '795', 'TEA', '0-aten-coo', '1408456', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL),
(193458901, 'Maximiliano Jose', 'suarez', '2018-03-17', '18arleana.1512@gmail.com', '04163868202', 'V', 6, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'TEA', '0-aten-coo', '395526', 'JOSE MARQUEZ', '2025-02-10', '2026-04-13 04:37:41', NULL),
(200264934, 'Josseth', 'Garcia', '1984-11-26', '', '04248356934', 'V', 40, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'Neuro_cog', '0-aten-coo', '117201', 'Ivan Jose ', '2025-02-25', '2026-04-13 04:37:41', NULL),
(210932441, 'Jesus Alfredo', 'Gereguan', '2015-04-23', '', '04267162255', 'V', 9, 'M', NULL, 'no', NULL, 'soltero/a', 0, '18', '309', '', '808', 'motora', '0-aten-coo', '19251', 'JOSE MARQUEZ', '2025-02-06', '2026-04-13 04:37:41', NULL);

--
-- Disparadores `beneficiario`
--
DELIMITER $$
CREATE TRIGGER `ELIMBEN_AD` AFTER DELETE ON `beneficiario` FOR EACH ROW INSERT INTO ben_eliminados ( cedula, nombre, apellido, discapacidad,  fecha_eliminacion) 




















VALUES (OLD.cedula, OLD.nombre, OLD.apellido, OLD.discapacidad,  NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beneficiario_AI` AFTER INSERT ON `beneficiario` FOR EACH ROW INSERT INTO reg_beneficiario(cedula, nombre, apellido, registrado_por, INSERTADO) 




















VALUES(NEW.cedula, NEW.nombre, NEW.apellido, NEW.registrado_por, NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `detectar_modificacion` AFTER UPDATE ON `beneficiario` FOR EACH ROW BEGIN









































    INSERT INTO `modificaciones_beneficiarios` (nombre, apellido, cedula, fecha)




















    VALUES (OLD.nombre, OLD.apellido, OLD.cedula, NOW());









































END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ben_eliminados`
--

CREATE TABLE `ben_eliminados` (
  `id` int(11) NOT NULL,
  `cedula` int(12) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `fecha_eliminacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ben_eliminados`
--

INSERT INTO `ben_eliminados` (`id`, `cedula`, `nombre`, `apellido`, `discapacidad`, `fecha_eliminacion`) VALUES
(38, 30165406, 'DEIKER', 'FERNANDEZ', 'TrstHemrr', '2023-08-19 23:40:28'),
(39, 4857859, 'Yaji', 'Lopez', 'Alzheimer', '2023-08-20 14:46:44'),
(40, 30165403, 'DEIKER', 'FERNANDEZ', 'Seguera_To', '2023-08-20 14:46:45'),
(41, 30165404, 'DEIKER', 'FERNANDEZ', 'Anacusia', '2023-08-20 14:46:45'),
(42, 30165406, 'deiker', 'Fernandez', 'IRC_HEMO', '2023-08-20 14:46:45'),
(43, 30165406, 'DEIKER', 'FERNANDEZ', 'Sordo', '2023-08-21 10:21:36'),
(44, 4584875, 'Miguel', 'Lopez', 'AparatoFon', '2023-08-21 10:24:03'),
(45, 48445, 'Kelvin', 'Pena', 'acondro', '2023-08-21 10:24:48'),
(46, 34234, 'valentina', 'corral', 'Sordo', '2023-08-21 11:13:31'),
(47, 23445, 'betania', 'herlo', 'acondro', '2023-08-21 13:33:03'),
(48, 132444, 'david', 'martinez', 'CegHipo', '2023-08-21 13:33:17'),
(49, 654326, 'carlos', 'ramirez', 'CegHipo', '2023-08-21 14:04:25'),
(50, 123456, 'maria', 'gonzalez', 'Baja_Visio', '2023-08-22 16:06:08'),
(51, 301265401, 'adsad', 'asddas', 'acondro', '2023-08-23 12:50:31'),
(52, 151642, 'asdasd', 'dadsd', 'acondro', '2023-08-23 12:50:37'),
(53, 15848, 'Kelvin', 'Pena', 'acondro', '2023-08-24 09:38:28'),
(54, 62654, 'Deiker', 'fernandez', 'acondro', '2023-08-24 09:38:28'),
(55, 215154, 'sdasd', 'sadasd', 'acondro', '2023-08-24 09:38:28'),
(56, 484545, 'Kelvin', 'Pela', 'AnemiaCrni', '2023-08-24 09:38:28'),
(57, 521548, 'Carol', 'Perez', 'Anacusia', '2023-08-24 09:38:28'),
(58, 585548, 'Kelvin', 'Pena', 'AnemiaCrni', '2023-08-24 09:38:28'),
(59, 1515546, 'Kelvin', 'Pel', 'acondro', '2023-08-24 09:38:28'),
(60, 4582151, 'pastor', 'contreras', 'acondro', '2023-08-24 09:38:28'),
(61, 4584485, 'Kelvin', 'contreras', 'acondro', '2023-08-24 09:38:28'),
(62, 5145131, 'Kelvin', 'Pelo', 'acondro', '2023-08-24 09:38:28'),
(63, 20125151, 'Kelvin', 'Plo', 'acondro', '2023-08-24 09:38:28'),
(64, 30165402, 'Deiker', 'Fernandez', 'Baja_Visio', '2023-08-24 09:38:28'),
(65, 34341234, 'VALENTINA', 'perez', 'acondro', '2023-08-24 09:38:28'),
(66, 971423738, 'gerardio', 'perez', 'DeficitDG', '2023-08-24 09:38:28'),
(67, 123456, 'Columba', 'Chapellin', '1-AS/D', '2023-09-02 17:12:26'),
(68, 10722053, 'ELIBERTO ANTONIO', 'VAZQUEZ MEJIAS', 'DeficitDG', '2023-09-15 20:32:09'),
(69, 12731757, 'CAROLINA', 'CRESPO', '1-AS/D', '2023-10-26 12:31:24'),
(70, 28484435, 'MIguel Angel', 'Lopez Gonzalez', '1-AS/D', '2023-10-26 12:31:59'),
(71, 124584, 'Carlos', 'Lopez Gonzalez', 'AnemiaCrni', '2023-11-24 10:43:36'),
(72, 487848, 'Deiker', 'fuentes', 'motora', '2023-12-18 10:40:12'),
(73, 1545856, 'Carlos Jose', 'Fernandez carvajal', 'Baja_Visio', '2024-01-10 16:24:45'),
(74, 484986, 'Pablito Gonzalez', 'Fernandezz', 'Anacusia', '2024-02-23 09:11:37'),
(75, 1236655, 'Alguien con ', 'apellido doble', 'VIH', '2024-02-23 09:11:37'),
(76, 4549646, 'Luis samen', 'carvajal', 'VIH', '2024-02-23 09:11:38'),
(77, 4581245, 'Kelvin', 'Perez', '1-AS/D', '2024-02-23 09:11:38'),
(78, 4585899, 'Miguel', 'Palacios', '1-AS/D', '2024-02-23 09:11:38'),
(79, 4858584, 'Jose Miguel', 'Fernández Carvajal', '1-AS/D', '2024-02-23 09:11:38'),
(80, 10722053, 'ELIBERTO ANTONIO', 'VAZQUEZ MEJIAS', 'DeficitDG', '2024-02-23 09:11:38'),
(81, 12545859, 'Carlos Sebastian', 'Perez Gonzalez', 'AparatoFon', '2024-02-23 09:11:39'),
(82, 13123223, 'Jose', 'Fernández', 'ESQ', '2024-02-23 09:11:39'),
(83, 13711717, 'DEIKER', 'FERNANDEZ', '1-AS/D', '2024-02-23 09:11:39'),
(84, 13894817, 'EVELYN', 'FERNANDEZ', '1-AS/D', '2024-02-23 09:11:39'),
(85, 15245484, 'Marco Perez', 'Gil Caraballo', 'Alzheimer', '2024-02-23 09:11:39'),
(86, 28484465, 'hsf', 'dsdsd', 'BVAnac', '2024-02-23 09:11:39'),
(87, 30165402, 'DEIKER', 'FERNANDEZ', '1-AS/D', '2024-02-23 09:11:39'),
(88, 30165406, 'DEIKER', 'CHAPELLIN', 'insuficie', '2024-02-23 09:11:39'),
(89, 45848412, 'Carlos jose ', 'Torres villaroel', 'epoc', '2024-02-23 09:11:40'),
(90, 48758452, 'Evelyn Edidd', 'Chapellin Fuentes', 'AparatoFon', '2024-02-23 09:11:40'),
(91, 67676767, 'fty', 'ty', '1-AS/D', '2024-02-23 09:11:40'),
(92, 87847483, 'José', 'Fernández', 'SordCeg', '2024-02-23 09:11:40'),
(93, 137117171, 'Columba', 'Chapellin', '1-AS/D', '2024-02-23 09:11:40'),
(94, 137117175, 'Deiker', 'CHAPELLIN', '1-AS/D', '2024-02-23 09:11:40'),
(95, 138948169, 'Jose', 'Fernández', 'DiscIntCr', '2024-02-23 09:37:46'),
(96, 30165402, 'dd', 'dd', 'Distrofia', '2024-02-23 09:41:59'),
(97, 13894817, 'Jose', 'Fernández', 'Alzheimer', '2024-02-23 09:43:05'),
(98, 13894817, 'Jose', 'Fernández', 'Baja_Visio', '2024-02-23 09:45:28'),
(99, 13894810, 'Jose', 'Fernández', 'Alzheimer', '2024-02-23 09:52:55'),
(100, 13894812, 'Jose', 'Fernández', 'Alzheimer', '2024-02-23 09:52:56'),
(101, 13894817, 'Jose', 'Fernández', 'Alzheimer', '2024-02-23 09:52:56'),
(102, 1389443, 'Jose', 'Fernández', 'Alzheimer', '2024-02-23 09:53:16'),
(103, 13894817, 'Jose', 'Fernández', 'esclerosis', '2024-02-23 10:13:05'),
(104, 2342343, 'Jose', 'Fernández', 'esclerosis', '2024-03-08 10:31:41'),
(105, 3251545, 'MIguel Angel', 'Lopez Gonzalez', 'Anacusia', '2024-04-08 13:18:51'),
(106, 4858584, 'Jose', 'Fernández', 'Baja_Visio', '2024-04-08 13:18:54'),
(107, 8261209, 'soraima', 'torres', 'epoc', '2024-04-08 13:18:56'),
(108, 13711717, 'Jose peña', 'Fernández', 'Alzheimer', '2024-04-08 13:18:59'),
(109, 13894817, 'Jose', 'Fernández', 'esclerosis', '2024-04-08 13:19:01'),
(110, 28484435, 'Gerardo', 'Salazar', 'ESQ', '2024-04-08 13:19:03'),
(111, 30165406, 'Jose Alberto', 'Fernández', 'epoc', '2024-04-08 13:19:06'),
(112, 30165490, 'Carol g', 'Nose q mas', 'VIH', '2024-04-08 13:19:08'),
(113, 45612312, 'Grecia Jose', 'Penalta dominguez', 'epoc', '2024-04-08 13:19:11'),
(114, 45848754, 'Carolina Miguelina', 'Herrera Gonzalez', 'neurofibro', '2024-04-08 13:19:14'),
(115, 48585843, 'Jose', 'Fernández', 'esclerosis', '2024-04-08 13:19:16'),
(116, 8787878, 'Marcos', 'hidalgo', 'ESQ', '2024-04-09 10:44:59'),
(117, 28484435, 'Gerardo', 'Salazar', 'Anacusia', '2024-04-09 10:45:13'),
(118, 2625623, 'desadasas', 'asdsadsa', 'AnemiaCrni', '2024-11-07 14:14:10'),
(119, 4584852, 'Jose', 'Fernández', 'cardiopati', '2024-11-07 16:14:56'),
(120, 8261209, 'soraima', 'torres', 'Baja_Visio', '2024-11-07 16:14:56'),
(121, 8999541, 'jose reinaldo', 'torres berriosss', 'Baja_Visio', '2024-11-07 16:14:56'),
(122, 12545215, 'Algo mas', 'algo mas', 'cardiopati', '2024-11-07 16:14:56'),
(123, 25131202, 'Felix Key', 'fuentes', 'VIH', '2024-11-07 16:14:56'),
(124, 25454456, 'andreina', 'moros', 'Obesidad-M', '2024-11-07 16:14:56'),
(125, 30165406, 'Deiker Jose', 'Fernandez Carvajal', 'Alzheimer', '2024-11-07 16:14:56'),
(126, 45454545, 'mario', 'castañeda', 'acondro', '2024-11-07 16:14:56'),
(127, 45787874, 'maria', 'delgado', '1-AS/D', '2024-11-07 16:14:56'),
(128, 54545454, 'Felix Key', 'dfaaa', 'epoc', '2024-11-07 16:14:56'),
(129, 54878785, 'maria', 'delgado', '1-AS/D', '2024-11-07 16:14:56'),
(130, 56565656, 'Felix Key', 'sasas', '1-AS/D', '2024-11-07 16:14:56'),
(131, 65465656, 'Felix Key', 'lk', 'VIH', '2024-11-07 16:14:56'),
(132, 301654061, 'Camila ', 'lopez', 'ESQ', '2024-11-07 16:14:56'),
(133, 5135116, 'Carolna', 'sadsadsad', 'Alzheimer', '2024-11-10 09:23:56'),
(134, 45612312, 'Jose', 'Fernández', 'Anacusia', '2024-11-10 09:23:56'),
(135, 4549646, 'Deiker', 'Fernández', 'cardiopati', '2024-11-10 09:27:30'),
(136, 0, 'Jose', 'Fernández', 'Anacusia', '2024-11-28 09:15:20'),
(137, 12345678, 'Deiker ', 'Fernandez', 'Anacusia', '2024-11-28 09:54:54'),
(138, 54412515, 'Jose', 'Fernández', 'Anacusia', '2024-11-28 09:54:55'),
(139, 45684512, 'Deiker Jose ', 'Fernandez Carvajal', 'TEA', '2024-12-15 09:35:13'),
(140, 54515135, 'asdasdas', 'sadsads', 'Anacusia', '2025-01-18 11:25:29'),
(141, 30165406, 'Prueba', 'prueba', '1-AS/D', '2025-01-20 09:27:10'),
(142, 30165408, 'Jose', 'Fernández', 'Baja_Visio', '2025-01-20 09:27:14'),
(143, 30165409, 'Jose', 'Fernández', 'Baja_Visio', '2025-01-20 09:27:20'),
(144, 54515135, 'Jose', 'Fernández', 'dis_ecto', '2025-01-20 09:27:35'),
(145, 1231546, 'adssadw', 'asdeede', 'dis_ecto', '2025-02-12 09:13:12'),
(146, 1256456, 'Jose jose', 'Carvajal carvajal', 'AnemiaCrni', '2025-02-12 09:13:12'),
(147, 12561565, 'Jose', 'Fernández', 'dis_ecto', '2025-02-12 09:13:12'),
(148, 30000000, 'Jose', 'Fernández', 'Down', '2025-02-12 09:13:12'),
(149, 30165406, 'Deiker Jose', 'Fernandez', 'AnemiaCrni', '2025-02-12 09:14:21'),
(150, 30165411, 'Jose', 'Fernández', 'Baja_Visio', '2025-02-12 09:14:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas_protesis`
--

CREATE TABLE `caracteristicas_protesis` (
  `id` int(11) NOT NULL,
  `id_historia` int(11) NOT NULL,
  `tipo_rodilla` text NOT NULL,
  `tipo_pie` text NOT NULL,
  `tipo_socket` text NOT NULL,
  `clasificacion_socket` text NOT NULL,
  `metodo_suspension` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_ortesis_protesis`
--

CREATE TABLE `cita_ortesis_protesis` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `laboratorio` varchar(10) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `fecha_toma` date DEFAULT NULL,
  `fecha_prueba` date DEFAULT NULL,
  `status` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `artificio` text DEFAULT NULL,
  `medidas` text DEFAULT NULL,
  `evaluacion_tomada` text DEFAULT NULL,
  `apto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cita_ortesis_protesis`
--

INSERT INTO `cita_ortesis_protesis` (`id`, `cedula`, `laboratorio`, `fecha_cita`, `fecha_toma`, `fecha_prueba`, `status`, `descripcion`, `artificio`, `medidas`, `evaluacion_tomada`, `apto`) VALUES
(123, 30165406, NULL, NULL, '2025-01-18', NULL, 'Medidas tomadas', 'asdfsa', '-protesis', 'fdsgd', NULL, 'Si'),
(124, 30165406, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conapdis_beneficiarios`
--

CREATE TABLE `conapdis_beneficiarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nacionalidad` varchar(2) DEFAULT 'V',
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(3) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT 'M',
  `numero_hijos` int(2) DEFAULT 0,
  `estado_civil` varchar(20) DEFAULT NULL,
  `pertenece_etnia` varchar(2) DEFAULT 'no',
  `etnia` varchar(50) DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `tipo_discapacidad` varchar(100) NOT NULL,
  `numero_certificado` varchar(50) DEFAULT NULL,
  `tipo_atencion_solicitada` varchar(100) DEFAULT NULL,
  `tipo_ayuda_tecnica` varchar(100) DEFAULT NULL,
  `recibe_bono_jose_gregorio` varchar(2) DEFAULT 'no',
  `cuidador_nombre` varchar(100) DEFAULT NULL,
  `cuidador_cedula` varchar(20) DEFAULT NULL,
  `nivel_academico` varchar(50) DEFAULT NULL,
  `profesion_oficio` varchar(100) DEFAULT NULL,
  `labora_actualmente` varchar(2) DEFAULT 'no',
  `tiene_emprendimiento` varchar(2) DEFAULT 'no',
  `nombre_emprendimiento` varchar(100) DEFAULT NULL,
  `rif_emprendimiento` varchar(20) DEFAULT NULL,
  `area_comercial` varchar(50) DEFAULT NULL,
  `tiene_credito_bancario` varchar(2) DEFAULT 'no',
  `nombre_banco` varchar(100) DEFAULT NULL,
  `usuario_registrador` varchar(100) DEFAULT NULL,
  `estado_registro` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_registro` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conapdis_documentos`
--

CREATE TABLE `conapdis_documentos` (
  `id` bigint(20) NOT NULL,
  `beneficiario_id` bigint(20) NOT NULL,
  `tipo_documento` enum('cedula','informe_medico','fotografia','solicitud') NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) NOT NULL,
  `tamano_archivo` int(11) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinaciones_estadales`
--

CREATE TABLE `coordinaciones_estadales` (
  `id` varchar(12) NOT NULL,
  `nombre_coordinacion` text NOT NULL,
  `municipio` varchar(20) DEFAULT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `coordinaciones_estadales`
--

INSERT INTO `coordinaciones_estadales` (`id`, `nombre_coordinacion`, `municipio`, `codigo`) VALUES
('C-amaz', 'Amazonas', NULL, 've-am'),
('C-Anzo', 'Anzoátegui', NULL, 've-an'),
('C-Apu', 'Apure', NULL, 've-ap'),
('C-Arag', 'Aragua', NULL, 've-ar'),
('C-Bar', 'Barinas', NULL, 've-ba'),
('C-Bolv', 'Bolivar', NULL, 've-bo'),
('C-Cbb', 'Carabobo', NULL, 've-ca'),
('C-Coj', 'Cojedes', NULL, 've-co'),
('C-Dct', 'Distrito Capital', NULL, 've-df'),
('C-Dlta', 'Delta Amacuro', NULL, 've-da'),
('C-falc', 'Falcón', NULL, 've-fa'),
('C-guar', 'Guárico', NULL, 've-gu'),
('C-lar', 'Lara', NULL, 've-la'),
('C-Lguai', 'La Guaira', NULL, 've-213'),
('C-merid', 'Mérida', NULL, 've-me'),
('C-miran', 'Miranda', NULL, 've-mi'),
('C-monag', 'Monagas', NULL, 've-mo'),
('C-Nva-es', 'Nueva Esparta', NULL, 've-ne'),
('C-port', 'Portuguesa', NULL, 've-po'),
('C-sucr', 'Sucre', NULL, 've-su'),
('C-tach', 'Táchira', NULL, 've-ta'),
('C-Trujillo', 'Trujillo', NULL, 've-tr'),
('C-Yarac', 'Yaracuy', NULL, 've-ya'),
('C-Zla', 'Zulia', NULL, 've-zu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copiascedula`
--

CREATE TABLE `copiascedula` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `archivo` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
('1-Salud', 'D. Salud'),
('2-M. Vivie', 'Mision Vivienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_cuidador`
--

CREATE TABLE `detalles_cuidador` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nombre` text DEFAULT NULL,
  `cedula_r` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalles_cuidador`
--

INSERT INTO `detalles_cuidador` (`id`, `cedula`, `nombre`, `cedula_r`) VALUES
(140, 2929513, 'eeibe cardiet', 15111248),
(141, 3605666, 'Crismar Diaz', 25467498),
(142, 8303365, 'Yanetzi Diaz ', 136773582),
(143, 9274044, 'ARMINDA JOSEFINA RAPOSO', 14124470),
(144, 8636544, 'YARITZA COVA', 10952530),
(145, 10950457, 'GÉNESIS MARQUEZ', 23805334),
(146, 4562051, 'JUAN PEREZ ', 13225922),
(147, 25414998, 'Gladis Ravelo', 13630280),
(148, 25897300, 'beatriz rivero', 9279835),
(149, 26031317, 'isabel lanza', 14420194),
(150, 200264934, 'Dulmari Garcia', 5089202),
(151, 4692182, 'iralis cordova', 9975648),
(152, 2925571, 'Maria Rivas', 11826860),
(153, 8636894, 'Solenny Rodriguez', 9272093),
(154, 12662749, 'Yarida Egañez', 12267317),
(155, 8442973, 'francisca martinez de vallejo', 8549825),
(156, 3338072, 'heinle guzman barreto', 11384008),
(157, 8683522, 'Carolina crespo', 12731757),
(158, 21537046, 'MARINA DEL VALLE  VALERO', 6040652),
(159, 25624227, 'MARINA DEL VALLE  VALERO', 6040652),
(160, 5754220, 'MARINA DEL VALLE  VALERO', 6040652),
(161, 6453964, 'MARINA DEL VALLE  VALERO', 6040652),
(162, 6504450, 'URIMAR LAICRIS TERAN ', 25217317),
(163, 18598845, 'EZEQUIEL ENRIQUE GONZALEZ FLORES', 24203364),
(164, 30235535, 'USNERY DEL VALLE BRAZON TENIA', 15877444),
(165, 5423480, 'USNERY DEL VALLE BRAZON TENIA', 15877444),
(166, 22764199, 'TOMASA PERNIAMEDINA', 6066760),
(167, 2976398, 'VIRGILIO JESUS FERNANDEZ', 6439194),
(168, 20329013, 'alicia dugarte baptista', 6283587),
(169, 5601699, 'SOL MARIA  VEGA CARDENAS', 13162296),
(170, 4169840, 'ARMANDO ROJAS', 6158422),
(171, 3215528, 'candelaria amada liendo aponte', 6019945),
(172, 25674958, 'LUIS RAFAEL MARQUEZ MEZA', 6967670),
(173, 3233121, 'RUTZANA DELGADO OCARIZ', 10511335),
(174, 3405632, 'fanny uzcategui', 10538926),
(175, 33419859, 'MARIFRANCIS PINTO', 19087415),
(176, 175734311, 'EDUARDO PERAZA', 17753431),
(177, 1219526, 'AURA MARISOL MORALES DIAZ', 8773797),
(178, 34157683, 'karka martins', 18143302),
(179, 2381410, 'MARUJA COROMOTO GONZALEZ', 11692699),
(180, 19401635, 'MARIA EUGENIA FIGUERAS', 6510593),
(181, 5413770, 'YUBRAUKA RIVERO', 12383358),
(182, 37407453, '', 12639562),
(183, 4274948, 'ALIGIERI LOPEZ SILVA', 9953286);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_emprendimiento`
--

CREATE TABLE `detalles_emprendimiento` (
  `id` int(11) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `nombre_emprendimiento` text DEFAULT NULL,
  `rif_emprendimiento` varchar(50) DEFAULT NULL,
  `area_comercial` text DEFAULT NULL,
  `banco` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_institucionales`
--

CREATE TABLE `detalles_institucionales` (
  `id` int(11) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `proteccion_social` char(3) DEFAULT NULL,
  `institucion_registrado` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalles_institucionales`
--

INSERT INTO `detalles_institucionales` (`id`, `cedula`, `proteccion_social`, `institucion_registrado`) VALUES
(277, 2929513, 'si', NULL),
(278, 4692497, 'no', NULL),
(279, 2924229, 'no', NULL),
(280, 3605666, 'si', NULL),
(281, 8303365, 'no', NULL),
(282, 9274044, 'no', NULL),
(283, 13772495, 'no', NULL),
(284, 18210098, 'no', NULL),
(285, 8636544, 'si', NULL),
(286, 9980488, 'no', NULL),
(287, 4692308, 'no', NULL),
(288, 1046565, 'no', NULL),
(289, 10462058, 'no', NULL),
(290, 10950457, 'si', NULL),
(291, 10792919, 'no', NULL),
(292, 24753523, 'si', NULL),
(293, 20064934, 'no', NULL),
(294, 12670978, 'si', NULL),
(295, 4562051, 'no', NULL),
(296, 14596035, 'no', NULL),
(297, 9973719, 'no', NULL),
(298, 8432960, 'no', NULL),
(299, 8430868, 'no', NULL),
(300, 10467713, 'no', NULL),
(301, 9275125, 'no', NULL),
(302, 25414998, 'si', NULL),
(303, 25897300, 'no', NULL),
(304, 14886764, 'no', NULL),
(305, 18211838, 'no', NULL),
(306, 26031317, 'no', NULL),
(307, 200264934, 'si', NULL),
(308, 4692182, 'no', NULL),
(309, 2925571, 'si', NULL),
(310, 33685946, 'no', NULL),
(311, 8642390, 'no', NULL),
(312, 8636894, 'no', NULL),
(313, 5083520, 'no', NULL),
(314, 12662749, 'si', NULL),
(315, 10791762, 'no', NULL),
(316, 4188883, 'no', NULL),
(317, 17763220, 'si', NULL),
(318, 8549825, 'no', NULL),
(319, 8442973, 'no', NULL),
(320, 5705838, 'no', NULL),
(321, 2657067, 'no', NULL),
(322, 17910415, 'si', NULL),
(323, 3338072, 'no', NULL),
(324, 2983212, 'no', NULL),
(325, 2976984, 'no', NULL),
(326, 8683522, 'no', NULL),
(327, 17977264, 'no', NULL),
(328, 15835054, 'no', NULL),
(329, 3569533, 'si', NULL),
(330, 24530170, 'no', NULL),
(331, 6243569, 'no', NULL),
(332, 20565667, 'si', NULL),
(333, 19397245, 'si', NULL),
(334, 21537046, 'si', NULL),
(335, 25624227, 'no', NULL),
(336, 5754220, 'si', NULL),
(337, 6453964, 'si', NULL),
(338, 7360723, 'no', NULL),
(339, 6504450, 'no', NULL),
(340, 18598845, 'no', NULL),
(341, 30235535, 'no', NULL),
(342, 5423480, 'no', NULL),
(343, 23148581, 'no', NULL),
(344, 6349747, 'no', NULL),
(345, 11554051, 'no', NULL),
(346, 12340086, 'si', NULL),
(347, 7445492, 'no', NULL),
(348, 9461522, 'no', NULL),
(349, 30908646, 'no', NULL),
(350, 8164768, 'no', NULL),
(351, 22764199, 'no', NULL),
(352, 12142595, 'no', NULL),
(353, 2958517, 'no', NULL),
(354, 2976398, 'no', NULL),
(355, 4124735, 'no', NULL),
(356, 20329013, 'no', NULL),
(357, 15684500, 'no', NULL),
(358, 4854616, 'no', NULL),
(359, 5601699, 'no', NULL),
(360, 13218170, 'no', NULL),
(361, 4169840, 'no', NULL),
(362, 25226787, 'no', NULL),
(363, 3215528, 'no', NULL),
(364, 9953256, 'no', NULL),
(365, 23623881, 'no', NULL),
(366, 26463644, 'no', NULL),
(367, 25674958, 'no', NULL),
(368, 33351791, 'no', NULL),
(369, 6297759, 'no', NULL),
(370, 6361308, 'no', NULL),
(371, 3233121, 'no', NULL),
(372, 14260655, 'no', NULL),
(373, 3885513, 'no', NULL),
(374, 3405632, 'si', NULL),
(375, 33419859, 'si', NULL),
(376, 175734311, 'no', NULL),
(377, 28447405, 'no', NULL),
(378, 14128684, 'si', NULL),
(379, 3990577, 'no', NULL),
(380, 9961396, 'si', NULL),
(381, 4233724, 'no', NULL),
(382, 81305530, 'no', NULL),
(383, 8365339, 'no', NULL),
(384, 1219526, 'no', NULL),
(385, 2807454, 'no', NULL),
(386, 34157683, 'no', NULL),
(387, 23682288, 'no', NULL),
(388, 8340872, 'no', NULL),
(389, 2381410, 'no', NULL),
(390, 6359029, 'no', NULL),
(391, 20047968, 'no', NULL),
(392, 5415186, 'no', NULL),
(393, 6260994, 'no', NULL),
(394, 3474857, 'no', NULL),
(395, 3530623, 'no', NULL),
(396, 20027969, 'no', NULL),
(397, 6728217, 'no', NULL),
(398, 9957384, 'no', NULL),
(399, 19401635, 'si', NULL),
(400, 5413770, 'no', NULL),
(401, 5225379, 'no', NULL),
(402, 28143325, 'no', NULL),
(403, 10498342, 'si', NULL),
(404, 22748260, 'no', NULL),
(405, 15204032, 'no', NULL),
(406, 9005493, 'no', NULL),
(407, 6062851, 'no', NULL),
(408, 3839860, 'no', NULL),
(409, 27200412, 'no', NULL),
(410, 4545711, 'no', NULL),
(411, 14518823, 'si', NULL),
(412, 12298380, 'no', NULL),
(413, 14299632, 'no', NULL),
(414, 3191519, 'no', NULL),
(415, 12880192, 'no', NULL),
(416, 15167158, 'no', NULL),
(417, 13636974, 'no', NULL),
(418, 5143496, 'no', NULL),
(419, 5575875, 'no', NULL),
(420, 6081936, 'no', NULL),
(421, 3423317, 'no', NULL),
(422, 16227883, 'no', NULL),
(423, 4085757, 'no', NULL),
(424, 18511929, 'no', NULL),
(425, 3074974, 'no', NULL),
(426, 6157880, 'no', NULL),
(427, 6030036, 'no', NULL),
(428, 6470022, 'no', NULL),
(429, 8183568, 'no', NULL),
(430, 6109804, 'no', NULL),
(431, 3609914, 'no', NULL),
(432, 18750389, 'no', NULL),
(433, 37407453, 'no', NULL),
(434, 27803002, 'no', NULL),
(435, 13515218, 'no', NULL),
(436, 6109467, 'no', NULL),
(437, 5595232, 'no', NULL),
(438, 3252047, 'no', NULL),
(439, 4274948, 'no', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(10) NOT NULL,
  `descripcion` text NOT NULL,
  `cedula` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `descripcion`, `cedula`) VALUES
(63, 'sabana de brito', 2929513),
(64, 'bebedero sector 4 bloque 5', 4692497),
(65, 'calle lasima Sabilar casa sin numero ', 2924229),
(66, 'las palomas santisimo sacramento', 3605666),
(67, 'callesacramento', 8303365),
(68, 'CALLE LOS ÁNGELES  PUNTA DE MATA ', 9274044),
(69, 'GUATRAPICHE SEGUNDA CALLE N26', 13772495),
(70, 'LAS PALOMAS CALLE LA ALEGRIA ', 18210098),
(71, 'TACAL 2', 8636544),
(72, 'TRES PICOS SECTOR MIRASOLES', 9980488),
(73, 'BOLIVARIANO CASCAJAL VIEJO,PINTO SALINAS ', 4692308),
(74, 'LAS PALOMAS ', 1046565),
(75, 'SANTA ANA CALLE PRINCIPAL ', 10462058),
(76, 'BUENA VISTA', 10950457),
(77, 'AV.LAS PALOMAS', 10792919),
(78, ' LA LLANADA SECTOR 1 VIRGEN DEL VALLE ', 24753523),
(79, 'LAS PALOMAS SECTOR CAICAGUITA', 20064934),
(80, 'LOS COCOS ', 12670978),
(81, 'PLAZA BOLIVAR', 4562051),
(82, 'CUMANAGOTO', 14596035),
(83, 'CUMANAGOTO 2 CALLE 1 N10', 9973719),
(84, 'SAN LUIS SEGUNDA VEREDA CASA 9', 8432960),
(85, 'SAN LUIS SEGUNDO VEREDA 6 CASA 3', 8430868),
(86, 'calla cajigal', 10467713),
(87, 'bebedero calle 2vereda 29  casa 29', 9275125),
(88, 'boca de sbana(inan)', 25414998),
(89, 'boca de sabana,sector el carmen', 25897300),
(90, 'calle rivero', 14886764),
(91, 'brasil', 18211838),
(92, 'peñoñ', 26031317),
(93, 'las palomas', 200264934),
(94, 'las palomas', 4692182),
(95, 'campeche', 2925571),
(96, 'guarapiche', 33685946),
(97, 'las parcelas', 8642390),
(98, 'las casa', 8636894),
(99, 'villa venecia', 5083520),
(100, 'San Jose Calle principal #A14', 12662749),
(101, 'Urbanismo Pueblo Nuevo Lote 4 Torre 4', 10791762),
(102, 'san luis III', 4188883),
(103, 'guatacaral,sector el rincon', 17763220),
(104, 'guatacaral,sector el rincon', 8549825),
(105, 'guatacaral,sector el rincon', 8442973),
(106, 'guatacaral,sector el rincon', 5705838),
(107, 'guatacara,sector el rincon', 2657067),
(108, 'guatacaral,sector el rincon', 17910415),
(109, 'guatacaral,sector el rincon', 3338072),
(110, 'guarenas', 2983212),
(111, 'casa sin numero', 2976984),
(112, 'el vigia', 8683522),
(113, 'xxxxxxxx', 17977264),
(114, 'CALLE LAUOL', 15835054),
(115, 'RUIZ PINEDA SECTOR -1DIVIDIVI LA LOMA GUARENAS ', 3569533),
(116, 'HOYADA', 24530170),
(117, 'SANTA ROSALIA', 6243569),
(118, 'av principal  los robles la  pastora ', 20565667),
(119, 'CARACAS', 19397245),
(120, 'RESIDENCIA FRANCISCO DE MIRANDA  BLOQUE 24LETRA B APTB-1', 21537046),
(121, 'URB LIBERTADOR PARROQUIA RECREO', 25624227),
(122, 'AV CIRCUMBALACION RAFAEL URDANETA EDF ESTE PISO 8 APT8-1 CATIA', 5754220),
(123, 'AV BARAL  EDF PROFECIONAL BARAL PISO 2', 6453964),
(124, 'HORIZONTE CATIA', 7360723),
(125, ' CATIA', 6504450),
(126, ' ANTIMANO LA RANGELA', 18598845),
(127, 'PARAMACONIS', 30235535),
(128, 'DIRECCION CARAPITA ANTIMANO SECTOR LA ACEQUIA ', 5423480),
(129, 'PETARE LA DOLORITA SUCRE', 23148581),
(130, 'CARACAS', 6349747),
(131, 'CARACAS', 11554051),
(132, 'CARACAS', 12340086),
(133, 'SECTOR COTIZA ', 7445492),
(134, 'av principal  los robles la  pastora', 9461522),
(135, '23 DE ENERO', 30908646),
(136, 'AV BARAL  ', 8164768),
(137, 'PRINCIPAL MACARAO', 22764199),
(138, 'SECTOR SAN RUPERTO', 12142595),
(139, 'CENTRO RESIDENCIAQL SOLANO TORRE C PISO 5 ATO05-03', 2958517),
(140, 'AV CALLE CHILE A BOLIVIA', 2976398),
(141, 'MACARAO ', 4124735),
(142, 'san agustin', 20329013),
(143, 'esquina de jesus', 15684500),
(144, 'ESQUINA PALO GRANDE  AP 111 PISO 11 RESIDENCIA MIL CENTRO', 4854616),
(145, 'SAN JOSE', 5601699),
(146, ' MAITANA KM 28 SECTOR  PALMIRA  MUNICIPIO PARACOTOS ', 13218170),
(147, 'SANTA BARBARA', 4169840),
(148, 'cota 905', 25226787),
(149, 'pastora', 3215528),
(150, 'barrio bicentenario', 9953256),
(151, 'urb simon bolivar  calle guicaipuro', 23623881),
(152, 'LA PASTORA ESQUI. COLA DE PATO ', 26463644),
(153, 'EL ROSARIO DE  BARRIO EL CARMEN', 25674958),
(154, 'KM 4', 33351791),
(155, 'san agustin', 6297759),
(156, 'RUIZ PINEDA UD7 CARICUADO BLOQUE 13-ESC.3,PISO-2 APT-207', 6361308),
(157, 'AV PANTEON RESIDENCIAS ALTARES APART.4', 3233121),
(158, 'ATRÁS DE MIRAFLORES', 14260655),
(159, 'AV SAN MARTÍN CAPUCHINOS', 3885513),
(160, 'Colinas de vista alegre', 3405632),
(161, 'LAHIERBABUENA ', 33419859),
(162, 'S/D', 175734311),
(163, 'av baralt', 28447405),
(164, 'S/D', 14128684),
(165, 'RUIZ PINEDA BLOQUE 4', 3990577),
(166, 'S/D', 9961396),
(167, 'Caricuao alto de yagual', 4233724),
(168, 'S/D', 81305530),
(169, 'SECTOR LOS MECEDORES', 8365339),
(170, 'CALLE ZULIA PARTE ALTA', 1219526),
(171, 'S/D', 2807454),
(172, 'S/D', 34157683),
(173, 'CATIA', 23682288),
(174, 'PUERTO LA CRUZ  URB SAN NICOIAS CALLEJON EL PARAISO', 8340872),
(175, 'AV MORAN CALLE EL CARMEN CALLE MOSCU', 2381410),
(176, 'san agustin', 6359029),
(177, 'CARAPITA', 20047968),
(178, 'AV EL CUARTEL EDIFICIO CONTINENTAL APT PISO 2 APT 2', 5415186),
(179, 'ARTIGAS EL ATLANTICO', 6260994),
(180, 'AV SAN M,ARTIN LA QUEBRADITA 1 BLOQUE 4 RESIDENCIA HORIZONTE PISO 2 APT 2-01', 3474857),
(181, 'S/D', 3530623),
(182, 'san agustin', 20027969),
(183, 'barrio el milagro la vega', 6728217),
(184, 'CARETERA VIEJA CARACAS LA GUAIRA BARRIO NUEVO HORIZONTE CASA 54', 9957384),
(185, 'SANTA LUCIA CASA N8', 19401635),
(186, 'AV INTERCOMUNAL DEL VALLE RESIDENCIAS SANTO ANGEL PISO 25 CALLE 14', 5413770),
(187, 'EL CEMENTERIO AL FINAL DE LA CALLE BOYACA ', 5225379),
(188, 'CALLE EL DESVIO DE LA BANDERA CASA 77', 28143325),
(189, 'S/D', 10498342),
(190, 'CALLE REAL NUEVO MUMDO SECTOR EL GUARATARO CASA 40', 22748260),
(191, 'AV PRICIPAL DEL ALGODONAL AL LADO DEL EDF ALASKA REFUGIO MULTI FAMILIAR EL REFUGIO', 15204032),
(192, 'AV FRANCISCO DE MIRANDA  EDF EDIFICIO METROPOL PISO 14', 9005493),
(193, 'BELLO MONTE EDF ABC PB', 6062851),
(194, 'BARRIO NUEVO PETARE ', 3839860),
(195, 'TERRAZA DE LA VEGA EDF 7 PLANTA BAJA', 27200412),
(196, 'URBANIZACION LA CANDELARIA CALLE PINTOSALINAS CASA NUMERO 31 ', 4545711),
(197, 'S/D', 14518823),
(198, 'PROPATRIA CALLE 4 CASA 8', 12298380),
(199, 'altagracia', 14299632),
(200, 'altagracia', 3191519),
(201, 'san antonio', 12880192),
(202, 'CEMENTERIO AV. NUEVA GRANADA ', 15167158),
(203, 'Puente guanabano casa nº21 ', 13636974),
(204, 'Av nueva granda con cruce al colegio mi oca cerca de servimoto', 5143496),
(205, 'PLAN DE MANZANO  SECTOR LA LINEA ', 5575875),
(206, 'S/D', 6081936),
(207, 'S/D', 3423317),
(208, 'SANTA CRUZ DEL ESTE ', 16227883),
(209, 'DOLORITA', 4085757),
(210, 'kilometro 3 del junquito', 18511929),
(211, 'RESIDENCIA LOS LEONES APTO 7 PISO 7 ', 3074974),
(212, 'SECTOR CALLE NUEVA', 6157880),
(213, 'LAS ADJUTAS BARRIO EL SIPRES PARTE ALTA LA ASEQUIA ESCALERA 3 DE MAYO', 6030036),
(214, 'MONTE PIEDAD 23 DE ENERO', 6470022),
(215, 'MATA PALO', 8183568),
(216, 'DIEGO DE LOZADA', 6109804),
(217, '1 ra Tranversal de Ruperto Lugo,casa numero 26', 3609914),
(218, 'SECTOR NOGAL', 18750389),
(219, 'urbanismio santa marta  edif. 20-08 piso 4 apto 02', 37407453),
(220, 'antimano frnte los bomberos', 27803002),
(221, 'calle luisa caceres de arismendi  luis hurtado junquito', 13515218),
(222, '23 de enero ', 6109467),
(223, 'urb maria de san jose via la cabricera casa 7', 5595232),
(224, 'PLAZA PANTEON', 3252047),
(225, 'CONJUNTO RESIDENCIAL LA FUNDACION APARTAMENTO 1-I ALTA VISTA', 4274948);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacid`
--

CREATE TABLE `discapacid` (
  `nombre_discapacidad` text NOT NULL,
  `id_disca` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `discapacid`
--

INSERT INTO `discapacid` (`nombre_discapacidad`, `id_disca`) VALUES
('Sin discapacidad', '1-AS/D'),
('Cardiovascular', '10-cardiov'),
('Hematológica', '11-Hematol'),
('Inmunológica', '12-Inmunol'),
('Respiratoria', '13-Respira'),
('Sistema Digestivo', '14-S.Diges'),
('Metabólico/endocrino', '15-met/end'),
('Músculo esquelética', '2-m.esque'),
('Acondroplasia', '21-acondro'),
('Nefrologicas', '22-nefrol'),
('Sindrome de weaver', '23-weaver'),
('Piel y estructuras relacionadas', '24-piel'),
('Neurologicos', '25-neurol'),
('Genitales y de la reproducción', '26-GeniRep'),
('Renal y urinaria ', '27-Renalur'),
('Displacía Ectodérmica ', '28-Displac'),
('Visual', '3-visual'),
('Auditiva', '4-auditiva'),
('Mental-Intelectual', '6-intelec'),
('Mental-Psicosocial', '7-psicosoc'),
('Sordoceguera', '8-Sordoceg'),
('Voz y habla', '9-voz-habl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE `discapacidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `discapacidad`
--

INSERT INTO `discapacidad` (`id`, `nombre`) VALUES
(23289, 'Acondroplasia'),
(23298, 'Auditiva'),
(23282, 'Cardiovascular'),
(23296, 'Displacía Ectodérmica'),
(23294, 'Genitales y de la reproducción'),
(23283, 'Hematológica'),
(23284, 'Inmunológica'),
(23299, 'Mental-Intelectual'),
(23300, 'Mental-Psicosocial'),
(23287, 'Metabólico/endocrino'),
(23288, 'Músculo esquelética'),
(23290, 'Nefrológicas'),
(23293, 'Neurológicos'),
(23292, 'Piel y estructuras relacionadas'),
(23295, 'Renal y urinaria'),
(23285, 'Respiratoria'),
(23281, 'Sin discapacidad'),
(23291, 'Síndrome de Weaver'),
(23286, 'Sistema Digestivo'),
(23301, 'Sordoceguera'),
(23297, 'Visual'),
(23302, 'Voz y habla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacid_e`
--

CREATE TABLE `discapacid_e` (
  `nombre_e` text NOT NULL,
  `id_e` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `general` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discapacid_e`
--

INSERT INTO `discapacid_e` (`nombre_e`, `id_e`, `general`) VALUES
('Sin discapacidad', '1-AS/D', '1-AS/D'),
('Acondroplasia clásica', 'acondro', '21-acondro'),
('Afecciones cronicas', 'Afecci_cro', '26-GeniRep'),
('Afecciones tiroides', 'Afecc_tiro', '15-met/end'),
('Afecciones urinarias crónicas', 'Afecc_urc', '27-Renalur'),
('Alzheimer', 'Alzheimer', '6-intelec'),
('Anacusia', 'Anacusia', '4-auditiva'),
('Anemia Crónica', 'AnemiaCrni', '11-Hematol'),
('Ausencia del Aparato Fonador', 'AparatoFon', '9-voz-habl'),
('Arritmias cardiacas', 'Arr_crd', '10-cardiov'),
('Afecciones renales, vejiga y vías urinarias', 'Ar_vyvu', '27-Renalur'),
('Baja Visión', 'Baja_Visio', '3-visual'),
('Bronquitis crónica ', 'Brn_c', '13-Respira'),
('Baja Visión con Anacusia', 'BVAnac', '8-Sordoceg'),
('Baja Visión con Hipoacusia', 'BVHipo', '8-Sordoceg'),
('cardiopatía isquémica crónica', 'cardiopati', '10-cardiov'),
('Ceguera con Anacusia', 'CegAnac', '8-Sordoceg'),
('Ceguera con Hipoacusia', 'CegHipo', '8-Sordoceg'),
('Ceguera Total', 'Ceguera_To', '3-visual'),
('Ceguera parcial', 'Cegue_P', '3-visual'),
('Ceguera total ojo izquierdo', 'Cg_ti', '3-visual'),
('Ceguera total ojo derecho', 'C_td', '3-visual'),
('Déficit del desarrollo global', 'DeficitDG', '6-intelec'),
('Diabetes Mellitus', 'Diabetes_M', '15-met/end'),
('Disfunción Intestinal Crónica', 'DiscIntCr', '14-S.Diges'),
('Displasia distrófica', 'displasia', '21-acondro'),
('Distrofia muscular', 'Distrofia ', '2-m.esque'),
('Displasia Ectodérmica ', 'dis_ecto', '28-Displac'),
('Síndrome de Down', 'Down', '6-intelec'),
('Déficit de desarrollo intelectual', 'D_di', '6-intelec'),
('Enfisema pulmonar', 'Efi_pl', '13-Respira'),
('Enfermedad de la piel ', 'Enfermedad', '24-piel'),
('enfermedad pulmonar obstructiva crónica', 'epoc', '13-Respira'),
('Eritema verrugoso', 'eritemaver', '24-piel'),
('Esclerodermia', 'escleroder', '24-piel'),
('Esclerosis Múltiple', 'esclerosis', '25-neurol'),
('Esquizofrenia', 'ESQ', '7-psicosoc'),
('Fibrosis pulmonar', 'Fibro_pl', '13-Respira'),
('Habla (Fluidez y ritmo)', 'habla_9', '9-voz-habl'),
('Hidrocefalia', 'hidrocefal', '25-neurol'),
('Hipoacusia', 'Hipoacusia', '4-auditiva'),
('Hipocondroplásia', 'hipocondro', '21-acondro'),
('Hipoacusia Profunda', 'Hipo_p', '4-auditiva'),
('Hipoacusia severa', 'Hipo_sv', '4-auditiva'),
('Infecciones pulmonares crónicas', 'Infcc_pcr', '13-Respira'),
('Insuficiencia Hepática', 'InsufHepat', '14-S.Diges'),
('insuficiencia cardiaca', 'insuficie', '10-cardiov'),
('Insuficiencia renal crónica ', 'Insu_rnalc', '27-Renalur'),
('Insuficiencia Renal Crónica en Hemodiálisis', 'IRC_HEMO', '22-nefrol'),
('Labio leporino', 'Lb_lp', '9-voz-habl'),
('Macrocefalia', 'macrocefal', '25-neurol'),
('Malformaciones cardiacas', 'Malformaci', '10-cardiov'),
('Microcefalia', 'microcefal', '25-neurol'),
('motora', 'motora', '2-m.esque'),
('Neurofibromatosis (bultos benignos en la piel)', 'neurofibro', '24-piel'),
('Neurocognitivo ', 'Neuro_cog', '7-psicosoc'),
('Neurofibroma cutáneo', 'Neuro_cut', '24-piel'),
('Obesidad Mórbida', 'Obesidad-M', '15-met/end'),
('Obsesivo compulsivo ', 'Obs_com', '7-psicosoc'),
('Baja vision en el ojo derecho', 'Oj_bd', '3-visual'),
('Baja vision en el ojo izquierdo', 'Oj_bi', '3-visual'),
('Oncológica ', 'Oncologica', '24-piel'),
('Oncológico ', 'Oncolo_gen', '26-GeniRep'),
('Oncológico ', 'Oncolo_met', '15-met/end'),
('Oncológico', 'Onco_gc', '13-Respira'),
('Oncológico', 'Onco_herna', '11-Hematol'),
('Oncológico ', 'Onco_Inmun', '12-Inmunol'),
('Oncológico ', 'Onco_lc', '14-S.Diges'),
('Oncológico ', 'Onco_ryuri', '27-Renalur'),
('Oncológico', 'on_crz', '10-cardiov'),
('Osteoacondrodisplásia', 'osteodispl', '21-acondro'),
('Parálisis cerebral', 'paralisis', '25-neurol'),
('Parkinson', 'parkinson', '25-neurol'),
('Pseudoacondroplásia', 'pseudoacon', '21-acondro'),
('Psicoafectivo ', 'Psico_afec', '7-psicosoc'),
('Quemadura deformante de la piel', 'quemadurap', '24-piel'),
('Síndromes con afecciones cognitivas', 'S.Acogniti', '6-intelec'),
('Síndrome de asperger (T.E.A) ', 'Sndr_As', '7-psicosoc'),
('Sordoceguera', 'SordCeg', '8-Sordoceg'),
('Sordo', 'Sordo', '4-auditiva'),
('Síndrome de Weaver', 'SWeaver', '23-weaver'),
('Trastorno de ansiedad generalizado', 'TAG', '7-psicosoc'),
('Trastorno bipolar', 'TB', '7-psicosoc'),
('Trastornos del Espectro Autista TEA', 'TEA', '6-intelec'),
('Trastorno esquizo-afectivo', 'TESQAF', '7-psicosoc'),
('Trasplante de corazon', 'Trans_cora', '10-cardiov'),
('Trastornos generales del metabolismo', 'Tras_GnMt', '15-met/end'),
('Trastornos Hemorrágicos', 'TrstHemrr', '11-Hematol'),
('Ulceras gastro-duodenales cronicas ', 'Ug_dc', '14-S.Diges'),
('La malformación de la vena de Galeno', 'vena_galen', '25-neurol'),
('Vestibular', 'Vestibular', '4-auditiva'),
('Inmunodeficiencias: VIH', 'VIH', '12-Inmunol'),
('Vocalización', 'voca_lin', '9-voz-habl'),
('Voz habla y vocalización', 'voz_Hbvc', '9-voz-habl'),
('La voz ', 'vo_z', '9-voz-habl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuentros`
--

CREATE TABLE `encuentros` (
  `id` int(11) NOT NULL,
  `fecha_encuentro` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `actividad` text NOT NULL,
  `gerencia` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `encuentros`
--

INSERT INTO `encuentros` (`id`, `fecha_encuentro`, `estado`, `municipio`, `parroquia`, `actividad`, `gerencia`) VALUES
(25, '2025-02-05', '14', '241', '647', 'encuento estadal de FMJGH CONAPDIS ', '4Gtno'),
(26, '2026-05-22', '19', '363', '871', 'ruta turistica con la findacion de ciegos y deficientes viuales del estado tachira', '4Gtno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela_comunitaria`
--

CREATE TABLE `escuela_comunitaria` (
  `id_curso` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `Tema` text NOT NULL,
  `comunidad` text NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `gerencia` varchar(5) DEFAULT NULL,
  `fecha_creada` date NOT NULL DEFAULT current_timestamp(),
  `coordinacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `escuela_comunitaria`
--

INSERT INTO `escuela_comunitaria` (`id_curso`, `fecha_inicio`, `fecha_final`, `Tema`, `comunidad`, `estado`, `municipio`, `parroquia`, `gerencia`, `fecha_creada`, `coordinacion`) VALUES
(23, '2025-02-09', '2025-02-09', 'u', 'Alicia Benites', '21', '390', '978', '4Gtno', '2025-02-09', NULL),
(24, '2025-02-09', '2025-02-09', 'sadsa', 'Alicia Benites', '9', '100', '309', '4Gtno', '2025-02-09', 'C-Dct'),
(25, '2002-09-18', '2002-09-18', 'sadsa', 'Alicia Benites', '13', '179', '515', '4Gtno', '2025-02-09', 'C-miran'),
(26, '2025-02-13', '2025-02-13', 'sensibilizacion y trato adecuado y difusion de la ley dirigido a los guardias del pueblo', 'copa de oro', '19', '350', '838', '4Gtno', '2025-02-14', 'C-tach'),
(27, '2026-04-29', '2026-04-29', 'Buen trato a las personas con discapacidad y marco juridico ', 'Comuna Simon Bolivar', '24', '462', '1138', '3Gtnd', '2026-04-30', ''),
(28, '2026-05-15', '2026-05-15', 'liderasgo ', 'monte o', '24', '462', '1138', '3Gtnd', '2026-05-06', ''),
(29, '2026-05-15', '2026-05-15', 'liderasgo ', 'simon bolivar', '24', '462', '1134', '3Gtnd', '2026-05-06', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`, `codigo`) VALUES
(25397, 'Amazonas', NULL),
(25398, 'Anzoátegui', NULL),
(25399, 'Apure', NULL),
(25400, 'Aragua', NULL),
(25401, 'Barinas', NULL),
(25402, 'Bolívar', NULL),
(25403, 'Carabobo', NULL),
(25404, 'Cojedes', NULL),
(25405, 'Delta Amacuro', NULL),
(25406, 'Distrito Capital', NULL),
(25407, 'Falcón', NULL),
(25408, 'Guárico', NULL),
(25409, 'Lara', NULL),
(25410, 'Mérida', NULL),
(25411, 'Miranda', NULL),
(25412, 'Monagas', NULL),
(25413, 'Nueva Esparta', NULL),
(25414, 'Portuguesa', NULL),
(25415, 'Sucre', NULL),
(25416, 'Táchira', NULL),
(25417, 'Trujillo', NULL),
(25418, 'La Guaira', NULL),
(25419, 'Yaracuy', NULL),
(25420, 'Zulia', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estados` varchar(10) NOT NULL,
  `nombre_estado` text NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estados`, `nombre_estado`, `codigo`) VALUES
('1', 'Amazonas', 've-am'),
('10', 'Falcón', 've-fa'),
('11', 'Guárico', 've-gu'),
('12', 'Lara', 've-la'),
('13', 'Mérida', 've-me'),
('14', 'Miranda', 've-mi'),
('15', 'Monagas', 've-mo'),
('16', 'Nueva Esparta', 've-ne'),
('17', 'Portuguesa', 've-po'),
('18', 'Sucre', 've-su'),
('19', 'Táchira', 've-ta'),
('2', 'Anzoátegui', 've-an'),
('20', 'Trujillo', 've-tr'),
('21', 'La Guaira', 've-213'),
('22', 'Yaracuy', 've-ya'),
('23', 'Zulia', 've-zu'),
('24', 'Distrito Capital', 've-df'),
('25', 'Dependencias Federales', ''),
('3', 'Apure', 've-ap'),
('4', 'Aragua', 've-ar'),
('5', 'Barinas', 've-ba'),
('6', 'Bolívar', 've-bo'),
('7', 'Carabobo', 've-ca'),
('8', 'Cojedes', 've-co'),
('9', 'Delta Amacuro', 've-da');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_muñon`
--

CREATE TABLE `estado_muñon` (
  `id` int(11) NOT NULL,
  `id_historia` int(11) NOT NULL,
  `forma` text NOT NULL,
  `cicatriz` text NOT NULL,
  `piel` text NOT NULL,
  `musculatura` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_muñon`
--

INSERT INTO `estado_muñon` (`id`, `id_historia`, `forma`, `cicatriz`, `piel`, `musculatura`) VALUES
(9, 19, 'Cilindrica', 'Sensible', 'Callosa', 'Firme'),
(10, 20, 'Cilindrica', 'Sensible', 'Decolorada', 'Intermedia'),
(11, 21, 'Conica', 'Sensible', 'Decolorada', 'Intermedia'),
(12, 22, 'Cilindrica', 'Curada', 'Decolorada', 'Firme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiaresoac`
--

CREATE TABLE `familiaresoac` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `cedula` int(12) NOT NULL,
  `id_atencion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `familiaresoac`
--

INSERT INTO `familiaresoac` (`id`, `nombre`, `apellido`, `cedula`, `id_atencion`) VALUES
(3, 'darwin', 'montilla', 13126838, 442),
(4, 'FANNY ', 'UZCATEGUI', 10538926, 493),
(5, 'ELIEZER', 'DELGADO', 10511334, 490),
(6, 'FRANCELIA COROMOTO', 'PIMENTEL  VILLEGAS', 17829828, 511),
(7, 'WALKELYM', 'MENDOZA', 6255230, 520),
(8, 'ISAURA DEL VALLE', 'BRITO', 10880908, 550);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerencia`
--

CREATE TABLE `gerencia` (
  `id` varchar(5) NOT NULL,
  `Nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `gerencia`
--

INSERT INTO `gerencia` (`id`, `Nombre`) VALUES
('1Tec', 'Tecnologia'),
('2Atc', 'Atencion Ciudadano'),
('3Gtnd', 'Gestion y desarrollo social'),
('4Gtno', 'Gestion operativa estadal'),
('5Logi', 'Gestion logistica y infrastructura'),
('6Plan', 'Planificación y presupuesto'),
('otro', 'Otro ente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_reparaciones_beneficiarios`
--

CREATE TABLE `historial_reparaciones_beneficiarios` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `id_cita_reparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_medica`
--

CREATE TABLE `historia_medica` (
  `id` int(100) NOT NULL,
  `cedula` int(12) NOT NULL,
  `artificio` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `artificio_medidas` text NOT NULL,
  `diseño` text DEFAULT NULL,
  `lado_afectado` text DEFAULT NULL,
  `zona_del_lado` text DEFAULT NULL,
  `nervio` text DEFAULT NULL,
  `tecnico` text DEFAULT NULL,
  `fecha_medidas` date DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `solicitud` text NOT NULL,
  `clasificacion` text DEFAULT NULL,
  `codigo_cita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historia_medica`
--

INSERT INTO `historia_medica` (`id`, `cedula`, `artificio`, `artificio_medidas`, `diseño`, `lado_afectado`, `zona_del_lado`, `nervio`, `tecnico`, `fecha_medidas`, `fecha_apertura`, `solicitud`, `clasificacion`, `codigo_cita`) VALUES
(27, 4549646, '-ortesis', 'ort-super', 'convencional', 'Derecho', 'hombro', 'Paralisis de plexo braquial', NULL, '2002-09-18', '2023-10-19', 'Inmovulizador de hombro', NULL, 60),
(28, 1545856, '-ortesis', 'ort-infe', NULL, NULL, NULL, NULL, NULL, '2002-09-18', '2023-10-19', 'Aparato largo con banda pelvica', NULL, 61),
(29, 4549646, '-ortesis', 'ort-infe', NULL, NULL, NULL, NULL, NULL, '2002-09-18', '2024-11-10', 'Aparato largo con banda pelvica', NULL, 64),
(30, 12345678, '-ortesis', 'ort-super', 'convencional', 'Izquierdo', 'hombro', 'Paralisis de plexo braquial', NULL, '2002-09-18', '2024-11-27', 'Cabestrillo', NULL, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_medica_protesis`
--

CREATE TABLE `historia_medica_protesis` (
  `id` int(11) NOT NULL,
  `codigo_cita` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nivel_actividad` text NOT NULL,
  `lado_amputacion` text NOT NULL,
  `nivel_amputacion` text NOT NULL,
  `z_afectada` text NOT NULL,
  `estado_munon` int(11) DEFAULT NULL,
  `caracteristicas_pro` int(11) DEFAULT NULL,
  `diseno` text NOT NULL,
  `fecha_medidas` date NOT NULL,
  `fecha_cita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_medicos`
--

CREATE TABLE `informes_medicos` (
  `id` int(12) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informes_medicos`
--

INSERT INTO `informes_medicos` (`id`, `cedula`, `nombre`, `pdf_path`) VALUES
(2, 30165406, 'Deiker Jose', NULL),
(3, 30165406, 'Deiker Jose', NULL),
(4, 30165406, 'Deiker Jose', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos_sesion`
--

CREATE TABLE `intentos_sesion` (
  `cedula` int(11) NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT 0,
  `ultimo_intento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `numero_personas` int(11) NOT NULL,
  `gerencia` varchar(5) DEFAULT NULL,
  `coordinacion` varchar(12) DEFAULT NULL,
  `fecha_creada` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id`, `estado`, `municipio`, `parroquia`, `numero_personas`, `gerencia`, `coordinacion`, `fecha_creada`) VALUES
(110, '11', '129', '417', 2, '4Gtno', 'C-miran', '2025-02-12 13:16:00'),
(111, '1', '1', '1', 1, '2Atc', NULL, '2025-02-12 13:16:00'),
(112, '24', '462', '1117', 2, '4Gtno', 'C-amaz', '2025-02-12 13:16:00'),
(113, '19', '363', '872', 21, '4Gtno', 'C-tach', '2025-02-12 13:16:00'),
(114, '19', '363', '871', 15, '4Gtno', 'C-tach', '2025-02-12 13:16:00'),
(115, '19', '363', '869', 55, '4Gtno', 'C-tach', '2025-02-21 17:00:17'),
(116, '7', '90', '289', 32, '4Gtno', 'C-Cbb', '2025-02-25 16:54:00'),
(117, '18', '309', '811', 12, '4Gtno', 'C-sucr', '2025-04-07 13:09:35'),
(118, '14', '223', '608', -160, '4Gtno', 'C-miran', '2025-06-10 16:11:22'),
(119, '14', '223', '604', 150, '4Gtno', 'C-miran', '2025-06-10 16:14:35'),
(120, '18', '309', '807', 5, '4Gtno', 'C-sucr', '2025-07-07 14:44:38'),
(121, '19', '341', '818', 20, '4Gtno', 'C-tach', '2026-05-25 15:28:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id` varchar(10) NOT NULL,
  `nombre_laboratorio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id`, `nombre_laboratorio`) VALUES
('4-tomedi', 'Toma medidas'),
('5-pruebar', 'Prueba artificio'),
('ortesis2', 'Laboratorio ortesis'),
('protesis1', 'Laboratorio Protesis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL,
  `nombre_lab` text NOT NULL,
  `estado` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `nombre_lab`, `estado`, `correo`, `telefono`) VALUES
(1, ' DR. NARCISO VELÁSQUEZ ', '2', 'ORTOPROTESISANZOATEGUI@GMAIL.COM', '0412-947-12-51'),
(6, 'DR. FRANCISCO ANTONIO RISQUEZ ', '24', 'ORTOPROTESISRISQUEZ@GMAIL.COM', '0426-212-22-34'),
(7, 'LABORATORIO DE ÓRTESIS Y PRÓTESIS', '7', 'ORTOPROTESISCARABOBO@GMAIL.COM', '0412-8361955'),
(8, 'DR. DANIEL CAMEJO ACOSTA', '12', 'ORTOPROTESISLARAAMB@GMAIL.COM', '0412-095-41-29'),
(9, 'HOSPITAL UNIVERSITARIO DE LOS ANDES', '13', 'ORTOPROTESISMERIDA@GMAIL.COM', '0414-758-15-73'),
(10, 'DR. JOSÉ GREGORIO HERNÁNDEZ', '14', 'ORTOPROTESISMIRANDA@GMAIL.COM', '0412-579-92-17 '),
(11, 'HOSPITAL UNIVERSITARIO DE MARACAIBO', '23', 'ORTOPROTESISZULIA@GMAIL.COM', '0426-1231426'),
(12, 'HOSPITAL DR. JULIO RODRÍGUEZ', '18', 'ORTOPROTESISSUCRE@GMAIL.COM', '0424-848-90-32'),
(13, 'LABORATORIO DE NUEVA ESPARTA', '16', 'ORTOPROTESISNUEVAESPARTA@GMAIL.COM', '0412-3599216');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificaciones_beneficiarios`
--

CREATE TABLE `modificaciones_beneficiarios` (
  `id` int(12) NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modificaciones_beneficiarios`
--

INSERT INTO `modificaciones_beneficiarios` (`id`, `cedula`, `nombre`, `apellido`, `fecha`) VALUES
(23, '45612312', 'Jose', 'Fernández', '2024-11-07 20:24:41'),
(24, '4549646', 'Deiker', 'Fernández', '2024-11-07 20:27:13'),
(25, '4549646', 'Deiker', 'Fernández', '2024-11-07 20:27:24'),
(26, '4549646', 'Deiker', 'Fernández', '2024-11-07 20:28:15'),
(27, '4549646', 'Deiker', 'Fernández', '2024-11-07 20:28:31'),
(28, '0', 'Jose', 'Fernández', '2024-11-10 13:40:55'),
(29, '2381410', 'MARIA JOSEFINA', 'MORENO', '2026-03-24 15:45:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_escuela`
--

CREATE TABLE `modulos_escuela` (
  `id_curso` int(11) NOT NULL,
  `profesor` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nombre_modulo` text NOT NULL,
  `contenido` text NOT NULL,
  `modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `modulos_escuela`
--

INSERT INTO `modulos_escuela` (`id_curso`, `profesor`, `fecha`, `hora`, `nombre_modulo`, `contenido`, `modulo`) VALUES
(16, 'Deiker fernandez', '2023-04-20', '07:00:00', 'Modulo  I', 'JIIIIIIIIIIIII', 3),
(16, 'Deiker fernandez', '2023-04-22', '14:56:00', 'Modulo  II', 'hhhhhh', 4),
(16, 'Pedro perez', '2023-04-19', '07:00:00', 'Modulo III', 'Lorem ipsum es el texto que se usa habitualmente en diseÃ±o grÃ¡fico en demostraciones de tipografÃ­as o de borradores de diseÃ±o para probar el diseÃ±o visual antes de insertar el texto final', 5),
(16, 'Alexis Veitia', '2023-05-05', '07:00:00', 'Modulo iV', 'Planificacion de un juego', 6),
(18, 'Deiker fernandez', '2023-04-19', '08:00:00', 'Modulo  I', 'AAAAAAAA', 7),
(18, 'Alexis Veitia', '2023-04-06', '20:00:00', 'Modulo  II', 'AAAAAAAAAAAAAAAAA', 8),
(18, 'Pedro perez', '2023-04-21', '22:00:00', 'Modulo iV', 'Proporcionalidad y porcentaje.', 9),
(19, 'Pedro perez', '2002-09-18', '06:30:00', 'Modulo  I', ',jl,jhlj', 10),
(21, 'Pedro perez', '2002-09-18', '07:00:00', 'Modulo  I', 'Explicación fenomeno de pulco', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `estado_id`) VALUES
(1, 'Baruta', 0),
(2, 'Casacoima', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipios` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipios`, `estado`, `nombre`) VALUES
('1', '1', 'Alto Orinoco'),
('10', '2', 'Manuel Ezequiel Bruzual'),
('100', '9', 'Antonio Díaz'),
('101', '9', 'Casacoima'),
('102', '9', 'Pedernales'),
('103', '9', 'Tucupita'),
('104', '10', 'Acosta'),
('105', '10', 'Bolívar'),
('106', '10', 'Buchivacoa'),
('107', '10', 'Cacique Manaure'),
('108', '10', 'Carirubana'),
('109', '10', 'Colina'),
('11', '2', 'Diego Bautista Urbaneja'),
('110', '10', 'Dabajuro'),
('111', '10', 'Democracia'),
('112', '10', 'Falcon'),
('113', '10', 'Federacion'),
('114', '10', 'Jacura'),
('115', '10', 'Jose Laurencio Silva'),
('116', '10', 'Los Taques'),
('117', '10', 'Mauroa'),
('118', '10', 'Miranda'),
('119', '10', 'Monseñor Iturriza'),
('12', '2', 'Fernando Peñalver'),
('120', '10', 'Palmasola'),
('121', '10', 'Petit'),
('122', '10', 'Piritu'),
('123', '10', 'San Francisco'),
('124', '10', 'Sucre'),
('125', '10', 'Tocopero'),
('126', '10', 'Union'),
('127', '10', 'Urumaco'),
('128', '10', 'Zamora'),
('129', '11', 'Camaguan'),
('13', '2', 'Francisco Del Carmen Carvajal'),
('130', '11', 'Chaguaramas'),
('131', '11', 'El Socorro'),
('132', '11', 'Jose Felix Ribas'),
('133', '11', 'Jose Tadeo Monagas'),
('134', '11', 'Juan German Roscio'),
('135', '11', 'Julian Mellado'),
('136', '11', 'Las Mercedes'),
('137', '11', 'Leonardo Infante'),
('138', '11', 'Pedro Zaraza'),
('139', '11', 'Ortíz'),
('14', '2', 'General Sir Arthur McGregor'),
('140', '11', 'San Geronimo de Guayabal'),
('141', '11', 'San Jose de Guaribe'),
('142', '11', 'Santa Maria de Ipire'),
('143', '11', 'Sebastian Francisco de Miranda'),
('144', '12', 'Andres Eloy Blanco'),
('145', '12', 'Crespo'),
('146', '12', 'Iribarren'),
('147', '12', 'Jiménez'),
('148', '12', 'Moran'),
('149', '12', 'Palavecino'),
('15', '2', 'Guanta'),
('150', '12', 'Simon Planas'),
('151', '12', 'Torres'),
('152', '12', 'Urdaneta'),
('16', '2', 'Independencia'),
('17', '2', 'Jose Gregorio Monagas'),
('179', '13', 'Alberto Adriani'),
('18', '2', 'Juan Antonio Sotillo'),
('180', '13', 'Andres Bello'),
('181', '13', 'Antonio Pinto Salinas'),
('182', '13', 'Aricagua'),
('183', '13', 'Arzobispo Chacón'),
('184', '13', 'Campo Elias'),
('185', '13', 'Caracciolo Parra Olmedo'),
('186', '13', 'Cardenal Quintero'),
('187', '13', 'Guaraque'),
('188', '13', 'Julio Cesar Salas'),
('189', '13', 'Justo Briceño'),
('19', '2', 'Juan Manuel Cajigal'),
('190', '13', 'Libertador'),
('191', '13', 'Miranda'),
('192', '13', 'Obispo Ramos de Lora'),
('193', '13', 'Padre Noguera'),
('194', '13', 'Pueblo Llano'),
('195', '13', 'Rangel'),
('196', '13', 'Rivas Dávila'),
('197', '13', 'Santos Marquina'),
('198', '13', 'Sucre'),
('199', '13', 'Tovar'),
('2', '1', 'Atabapo'),
('20', '2', 'Libertad'),
('200', '13', 'Tulio Febres Cordero'),
('201', '13', 'Zea'),
('21', '2', 'Francisco de Miranda'),
('22', '2', 'Pedro María Freites'),
('223', '14', 'Acevedo'),
('224', '14', 'Andrés Bello'),
('225', '14', 'Baruta'),
('226', '14', 'Brión'),
('227', '14', 'Buroz'),
('228', '14', 'Carrizal'),
('229', '14', 'Chacao'),
('23', '2', 'Píritu'),
('230', '14', 'Cristóbal Rojas'),
('231', '14', 'El Hatillo'),
('232', '14', 'Guaicaipuro'),
('233', '14', 'Independencia'),
('234', '14', 'Lander'),
('235', '14', 'Los Salias'),
('236', '14', 'Páez'),
('237', '14', 'Paz Castillo'),
('238', '14', 'Pedro Gual'),
('239', '14', 'Plaza'),
('24', '2', 'San José de Guanipa'),
('240', '14', 'Simón Bolívar'),
('241', '14', 'Sucre'),
('242', '14', 'Urdaneta'),
('243', '14', 'Zamora'),
('25', '2', 'San Juan de Capistrano'),
('258', '15', 'Acosta'),
('259', '15', 'Aguasay'),
('26', '2', 'Santa Ana'),
('260', '15', 'Bolívar'),
('261', '15', 'Caripe'),
('262', '15', 'Cedeño'),
('263', '15', 'Ezequiel Zamora'),
('264', '15', 'Libertador'),
('265', '15', 'Maturín'),
('266', '15', 'Piar'),
('267', '15', 'Punceres'),
('268', '15', 'Santa Bárbara'),
('269', '15', 'Sotillo'),
('27', '2', 'Simón Bolívar'),
('270', '15', 'Uracoa'),
('271', '16', 'Antolín del Campo'),
('272', '16', 'Arismendi'),
('273', '16', 'García'),
('274', '16', 'Gómez'),
('275', '16', 'Maneiro'),
('276', '16', 'Marcano'),
('277', '16', 'Mariño'),
('278', '16', 'Península de Macanao'),
('279', '16', 'Tubores'),
('28', '2', 'Simón Rodríguez'),
('280', '16', 'Villalba'),
('281', '16', 'Díaz'),
('282', '17', 'Agua Blanca'),
('283', '17', 'Araure'),
('284', '17', 'Esteller'),
('285', '17', 'Guanare'),
('286', '17', 'Guanarito'),
('287', '17', 'Monseñor José Vicente de Unda'),
('288', '17', 'Ospino'),
('289', '17', 'Páez'),
('29', '3', 'Achaguas'),
('290', '17', 'Papelón'),
('291', '17', 'San Genaro de Boconoíto'),
('292', '17', 'San Rafael de Onoto'),
('293', '17', 'Santa Rosalía'),
('294', '17', 'Sucre'),
('295', '17', 'Turén'),
('296', '18', 'Andrés Eloy Blanco'),
('297', '18', 'Andrés Mata'),
('298', '18', 'Arismendi'),
('299', '18', 'Benítez'),
('3', '1', 'Atures'),
('30', '3', 'Biruaca'),
('300', '18', 'Bermúdez'),
('301', '18', 'Bolívar'),
('302', '18', 'Cajigal'),
('303', '18', 'Cruz Salmerón Acosta'),
('304', '18', 'Libertador'),
('305', '18', 'Mariño'),
('306', '18', 'Mejía'),
('307', '18', 'Montes'),
('308', '18', 'Ribero'),
('309', '18', 'Sucre'),
('31', '3', 'Muñóz'),
('310', '18', 'Valdéz'),
('32', '3', 'Páez'),
('33', '3', 'Pedro Camejo'),
('34', '3', 'Rómulo Gallegos'),
('341', '19', 'Andrés Bello'),
('342', '19', 'Antonio Rómulo Costa'),
('343', '19', 'Ayacucho'),
('344', '19', 'Bolívar'),
('345', '19', 'Cárdenas'),
('346', '19', 'Córdoba'),
('347', '19', 'Fernández Feo'),
('348', '19', 'Francisco de Miranda'),
('349', '19', 'García de Hevia'),
('35', '3', 'San Fernando'),
('350', '19', 'Guásimos'),
('351', '19', 'Independencia'),
('352', '19', 'Jáuregui'),
('353', '19', 'José María Vargas'),
('354', '19', 'Junín'),
('355', '19', 'Libertad'),
('356', '19', 'Libertador'),
('357', '19', 'Lobatera'),
('358', '19', 'Michelena'),
('359', '19', 'Panamericano'),
('36', '4', 'Atanasio Girardot'),
('360', '19', 'Pedro María Ureña'),
('361', '19', 'Rafael Urdaneta'),
('362', '19', 'Samuel Darío Maldonado'),
('363', '19', 'San Cristóbal'),
('364', '19', 'Seboruco'),
('365', '19', 'Simón Rodríguez'),
('366', '19', 'Sucre'),
('367', '19', 'Torbes'),
('368', '19', 'Uribante'),
('369', '19', 'San Judas Tadeo'),
('37', '4', 'Bolívar'),
('370', '20', 'Andrés Bello'),
('371', '20', 'Boconó'),
('372', '20', 'Bolívar'),
('373', '20', 'Candelaria'),
('374', '20', 'Carache'),
('375', '20', 'Escuque'),
('376', '20', 'José Felipe Márquez Cañizalez'),
('377', '20', 'Juan Vicente Campos Elías'),
('378', '20', 'La Ceiba'),
('379', '20', 'Miranda'),
('38', '4', 'Camatagua'),
('380', '20', 'Monte Carmelo'),
('381', '20', 'Motatán'),
('382', '20', 'Pampán'),
('383', '20', 'Pampanito'),
('384', '20', 'Rafael Rangel'),
('385', '20', 'San Rafael de Carvajal'),
('386', '20', 'Sucre'),
('387', '20', 'Trujillo'),
('388', '20', 'Urdaneta'),
('389', '20', 'Valera'),
('39', '4', 'Francisco Linares Alcántara'),
('390', '21', 'Vargas'),
('391', '22', 'Arístides Bastidas'),
('392', '22', 'Bolívar'),
('4', '1', 'Autana'),
('40', '4', 'José Ángel Lamas'),
('407', '22', 'Bruzual'),
('408', '22', 'Cocorote'),
('409', '22', 'Independencia'),
('41', '4', 'José Félix Ribas'),
('410', '22', 'José Antonio Páez'),
('411', '22', 'La Trinidad'),
('412', '22', 'Manuel Monge'),
('413', '22', 'Nirgua'),
('414', '22', 'Peña'),
('415', '22', 'San Felipe'),
('416', '22', 'Sucre'),
('417', '22', 'Urachiche'),
('418', '22', 'José Joaquín Veroes'),
('42', '4', 'José Rafael Revenga'),
('43', '4', 'Libertador'),
('44', '4', 'Mario Briceño Iragorry'),
('441', '23', 'Almirante Padilla'),
('442', '23', 'Baralt'),
('443', '23', 'Cabimas'),
('444', '23', 'Catatumbo'),
('445', '23', 'Colón'),
('446', '23', 'Francisco Javier Pulgar'),
('447', '23', 'Páez'),
('448', '23', 'Jesús Enrique Losada'),
('449', '23', 'Jesús María Semprún'),
('45', '4', 'Ocumare de la Costa de Oro'),
('450', '23', 'La Cañada de Urdaneta'),
('451', '23', 'Lagunillas'),
('452', '23', 'Machiques de Perijá'),
('453', '23', 'Mara'),
('454', '23', 'Maracaibo'),
('455', '23', 'Miranda'),
('456', '23', 'Rosario de Perijá'),
('457', '23', 'San Francisco'),
('458', '23', 'Santa Rita'),
('459', '23', 'Simón Bolívar'),
('46', '4', 'San Casimiro'),
('460', '23', 'Sucre'),
('461', '23', 'Valmore Rodríguez'),
('462', '24', 'Libertador'),
('47', '4', 'San Sebastián'),
('48', '4', 'Santiago Mariño'),
('49', '4', 'Santos Michelena'),
('5', '1', 'Manapiare'),
('50', '4', 'Sucre'),
('51', '4', 'Tovar'),
('52', '4', 'Urdaneta'),
('53', '4', 'Zamora'),
('54', '5', 'Alberto Arvelo Torrealba'),
('55', '5', 'Andrés Eloy Blanco'),
('56', '5', 'Antonio José de Sucre'),
('57', '5', 'Arismendi'),
('58', '5', 'Barinas'),
('59', '5', 'Bolívar'),
('6', '1', 'Maroa'),
('60', '5', 'Cruz Paredes'),
('61', '5', 'Ezequiel Zamora'),
('62', '5', 'Obispos'),
('63', '5', 'Pedraza'),
('64', '5', 'Rojas'),
('65', '5', 'Sosa'),
('66', '6', 'Caroní'),
('67', '6', 'Cedeño'),
('68', '6', 'El Callao'),
('69', '6', 'Gran Sabana'),
('7', '1', 'Río Negro'),
('70', '6', 'Heres'),
('71', '6', 'Piar'),
('72', '6', 'Angostura (Raúl Leoni)'),
('73', '6', 'Roscio'),
('74', '6', 'Sifontes'),
('75', '6', 'Sucre'),
('76', '6', 'Padre Pedro Chien'),
('77', '7', 'Bejuma'),
('78', '7', 'Carlos Arvelo'),
('79', '7', 'Diego Ibarra'),
('8', '2', 'Anaco'),
('80', '7', 'Guacara'),
('81', '7', 'Juan José Mora'),
('82', '7', 'Libertador'),
('83', '7', 'Los Guayos'),
('84', '7', 'Miranda'),
('85', '7', 'Montalbán'),
('86', '7', 'Naguanagua'),
('87', '7', 'Puerto Cabello'),
('88', '7', 'San Diego'),
('89', '7', 'San Joaquín'),
('9', '2', 'Aragua'),
('90', '7', 'Valencia'),
('91', '8', 'Anzoátegui'),
('92', '8', 'Tinaquillo'),
('93', '8', 'Girardot'),
('94', '8', 'Lima Blanco'),
('95', '8', 'Pao de San Juan Bautista'),
('96', '8', 'Ricaurte'),
('97', '8', 'Rómulo Gallegos'),
('98', '8', 'San Carlos'),
('99', '8', 'Tinaco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE `observacion` (
  `id` int(50) NOT NULL,
  `observacion` varchar(200) NOT NULL,
  `id_atencion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orientaciones`
--

CREATE TABLE `orientaciones` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_orientacion` date NOT NULL,
  `cedula` int(11) NOT NULL,
  `por` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `orientaciones`
--

INSERT INTO `orientaciones` (`id`, `descripcion`, `fecha_orientacion`, `cedula`, `por`) VALUES
(17, 'kk', '2024-02-08', 30165406, NULL),
(18, 'Vino buscando un televisor', '2024-03-08', 30165406, NULL),
(19, 'asdasdasdsad', '2024-05-02', 8261209, NULL),
(20, 'asdasdas', '2024-05-02', 8999541, NULL),
(21, 'llenado', '2025-02-13', 25997137, 18212377),
(22, 'Se hizo el llenado ', '2025-02-14', 8642045, 8683522),
(23, 'Se lleno la bombona', '2025-02-17', 8424575, 8683522),
(24, 'Gas llenada ', '2025-03-05', 4688373, 8683522),
(25, 'Llenada ', '2025-03-05', 5953844, 8683522);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ortesis`
--

CREATE TABLE `ortesis` (
  `id` int(10) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ortesis`
--

INSERT INTO `ortesis` (`id`, `nombre`) VALUES
(3, 'Férula de mano'),
(4, 'Férula de pie'),
(5, 'Rodilleras'),
(6, 'Faja'),
(7, 'Corset'),
(8, 'Collarín cervical'),
(9, 'AFOs'),
(10, 'Férula Harrys'),
(11, 'Separador de muslos'),
(12, 'Reparación de férulas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `nombre_parroquia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id`, `municipio`, `nombre_parroquia`) VALUES
('1', '1', 'Alto Orinoco'),
('10', '3', 'Luis Alberto Gómez'),
('100', '33', 'Cunaviche'),
('1000', '413', 'Nirgua'),
('1001', '414', 'San Andrés'),
('1002', '414', 'Yaritagua'),
('1003', '415', 'San Javier'),
('1004', '415', 'Albarico'),
('1005', '415', 'San Felipe'),
('1006', '416', 'Sucre'),
('1007', '417', 'Urachiche'),
('1008', '418', 'El Guayabo'),
('1009', '418', 'Farriar'),
('101', '34', 'Elorza'),
('1010', '441', 'Isla de Toas'),
('1011', '441', 'Monagas'),
('1012', '442', 'San Timoteo'),
('1013', '442', 'General Urdaneta'),
('1014', '442', 'Libertador'),
('1015', '442', 'Marcelino Briceño'),
('1016', '442', 'Pueblo Nuevo'),
('1017', '442', 'Manuel Guanipa Matos'),
('1018', '443', 'Ambrosio'),
('1019', '443', 'Carmen Herrera'),
('102', '34', 'La Trinidad'),
('1020', '443', 'La Rosa'),
('1021', '443', 'Germán Ríos Linares'),
('1022', '443', 'San Benito'),
('1023', '443', 'Rómulo Betancourt'),
('1024', '443', 'Jorge Hernández'),
('1025', '443', 'Punta Gorda'),
('1026', '443', 'Arístides Calvani'),
('1027', '444', 'Encontrados'),
('1028', '444', 'Udón Pérez'),
('1029', '445', 'Moralito'),
('103', '35', 'San Fernando'),
('1030', '445', 'San Carlos del Zulia'),
('1031', '445', 'Santa Cruz del Zulia'),
('1032', '445', 'Santa Bárbara'),
('1033', '445', 'Urribarrí'),
('1034', '446', 'Carlos Quevedo'),
('1035', '446', 'Francisco Javier Pulgar'),
('1036', '446', 'Simón Rodríguez'),
('1037', '446', 'Guamo-Gavilanes'),
('1038', '448', 'La Concepción'),
('1039', '448', 'San José'),
('104', '35', 'El Recreo'),
('1040', '448', 'Mariano Parra León'),
('1041', '448', 'José Ramón Yépez'),
('1042', '449', 'Jesús María Semprún'),
('1043', '449', 'Barí'),
('1044', '450', 'Concepción'),
('1045', '450', 'Andrés Bello'),
('1046', '450', 'Chiquinquirá'),
('1047', '450', 'El Carmelo'),
('1048', '450', 'Potreritos'),
('1049', '451', 'Libertad'),
('105', '35', 'Peñalver'),
('1050', '451', 'Alonso de Ojeda'),
('1051', '451', 'Venezuela'),
('1052', '451', 'Eleazar López Contreras'),
('1053', '451', 'Campo Lara'),
('1054', '452', 'Bartolomé de las Casas'),
('1055', '452', 'Libertad'),
('1056', '452', 'Río Negro'),
('1057', '452', 'San José de Perijá'),
('1058', '453', 'San Rafael'),
('1059', '453', 'La Sierrita'),
('106', '35', 'San Rafael de Atamaica'),
('1060', '453', 'Las Parcelas'),
('1061', '453', 'Luis de Vicente'),
('1062', '453', 'Monseñor Marcos Sergio Godoy'),
('1063', '453', 'Ricaurte'),
('1064', '453', 'Tamare'),
('1065', '454', 'Antonio Borjas Romero'),
('1066', '454', 'Bolívar'),
('1067', '454', 'Cacique Mara'),
('1068', '454', 'Carracciolo Parra Pérez'),
('1069', '454', 'Cecilio Acosta'),
('107', '36', 'Pedro José Ovalles'),
('1070', '454', 'Cristo de Aranza'),
('1071', '454', 'Coquivacoa'),
('1072', '454', 'Chiquinquirá'),
('1073', '454', 'Francisco Eugenio Bustamante'),
('1074', '454', 'Idelfonzo Vásquez'),
('1075', '454', 'Juana de Ávila'),
('1076', '454', 'Luis Hurtado Higuera'),
('1077', '454', 'Manuel Dagnino'),
('1078', '454', 'Olegario Villalobos'),
('1079', '454', 'Raúl Leoni'),
('108', '36', 'Joaquín Crespo'),
('1080', '454', 'Santa Lucía'),
('1081', '454', 'Venancio Pulgar'),
('1082', '454', 'San Isidro'),
('1083', '455', 'Altagracia'),
('1084', '455', 'Faría'),
('1085', '455', 'Ana María Campos'),
('1086', '455', 'San Antonio'),
('1087', '455', 'San José'),
('1088', '456', 'Donaldo García'),
('1089', '456', 'El Rosario'),
('109', '36', 'José Casanova Godoy'),
('1090', '456', 'Sixto Zambrano'),
('1091', '457', 'San Francisco'),
('1092', '457', 'El Bajo'),
('1093', '457', 'Domitila Flores'),
('1094', '457', 'Francisco Ochoa'),
('1095', '457', 'Los Cortijos'),
('1096', '457', 'Marcial Hernández'),
('1097', '458', 'Santa Rita'),
('1098', '458', 'El Mene'),
('1099', '458', 'Pedro Lucas Urribarrí'),
('11', '3', 'Pahueña Limón de Parhueña'),
('110', '36', 'Madre María de San José'),
('1100', '458', 'José Cenobio Urribarrí'),
('1101', '459', 'Rafael Maria Baralt'),
('1102', '459', 'Manuel Manrique'),
('1103', '459', 'Rafael Urdaneta'),
('1104', '460', 'Bobures'),
('1105', '460', 'Gibraltar'),
('1106', '460', 'Heras'),
('1107', '460', 'Monseñor Arturo Álvarez'),
('1108', '460', 'Rómulo Gallegos'),
('1109', '460', 'El Batey'),
('111', '36', 'Andrés Eloy Blanco'),
('1110', '461', 'Rafael Urdaneta'),
('1111', '461', 'La Victoria'),
('1112', '461', 'Raúl Cuenca'),
('1113', '447', 'Sinamaica'),
('1114', '447', 'Alta Guajira'),
('1115', '447', 'Elías Sánchez Rubio'),
('1116', '447', 'Guajira'),
('1117', '462', 'Altagracia'),
('1118', '462', 'Antímano'),
('1119', '462', 'Caricuao'),
('112', '36', 'Los Tacarigua'),
('1120', '462', 'Catedral'),
('1121', '462', 'Coche'),
('1122', '462', 'El Junquito'),
('1123', '462', 'El Paraíso'),
('1124', '462', 'El Recreo'),
('1125', '462', 'El Valle'),
('1126', '462', 'La Candelaria'),
('1127', '462', 'La Pastora'),
('1128', '462', 'La Vega'),
('1129', '462', 'Macarao'),
('113', '36', 'Las Delicias'),
('1130', '462', 'San Agustín'),
('1131', '462', 'San Bernardino'),
('1132', '462', 'San José'),
('1133', '462', 'San Juan'),
('1134', '462', 'San Pedro'),
('1135', '462', 'Santa Rosalía'),
('1136', '462', 'Santa Teresa'),
('1137', '462', 'Sucre (Catia)'),
('1138', '462', '23 de enero'),
('114', '36', 'Choroní'),
('115', '37', 'Bolívar'),
('116', '38', 'Camatagua'),
('117', '38', 'Carmen de Cura'),
('118', '39', 'Santa Rita'),
('119', '39', 'Francisco de Miranda'),
('12', '3', 'Platanillal Platanillal'),
('120', '39', 'Moseñor Feliciano González'),
('121', '40', 'Santa Cruz'),
('122', '41', 'José Félix Ribas'),
('123', '41', 'Castor Nieves Ríos'),
('124', '41', 'Las Guacamayas'),
('125', '41', 'Pao de Zárate'),
('126', '41', 'Zuata'),
('127', '42', 'José Rafael Revenga'),
('128', '43', 'Palo Negro'),
('129', '43', 'San Martín de Porres'),
('13', '4', 'Samariapo'),
('130', '44', 'El Limón'),
('131', '44', 'Caña de Azúcar'),
('132', '45', 'Ocumare de la Costa'),
('133', '46', 'San Casimiro'),
('134', '46', 'Güiripa'),
('135', '46', 'Ollas de Caramacate'),
('136', '46', 'Valle Morín'),
('137', '47', 'San Sebastían'),
('138', '48', 'Turmero'),
('139', '48', 'Arevalo Aponte'),
('14', '4', 'Sipapo'),
('140', '48', 'Chuao'),
('141', '48', 'Samán de Güere'),
('142', '48', 'Alfredo Pacheco Miranda'),
('143', '49', 'Santos Michelena'),
('144', '49', 'Tiara'),
('145', '50', 'Cagua'),
('146', '50', 'Bella Vista'),
('147', '51', 'Tovar'),
('148', '52', 'Urdaneta'),
('149', '52', 'Las Peñitas'),
('15', '4', 'Munduapo'),
('150', '52', 'San Francisco de Cara'),
('151', '52', 'Taguay'),
('152', '53', 'Zamora'),
('153', '53', 'Magdaleno'),
('154', '53', 'San Francisco de Asís'),
('155', '53', 'Valles de Tucutunemo'),
('156', '53', 'Augusto Mijares'),
('157', '54', 'Sabaneta'),
('158', '54', 'Juan Antonio Rodríguez Domínguez'),
('159', '55', 'El Cantón'),
('16', '4', 'Guayapo'),
('160', '55', 'Santa Cruz de Guacas'),
('161', '55', 'Puerto Vivas'),
('162', '56', 'Ticoporo'),
('163', '56', 'Nicolás Pulido'),
('164', '56', 'Andrés Bello'),
('165', '57', 'Arismendi'),
('166', '57', 'Guadarrama'),
('167', '57', 'La Unión'),
('168', '57', 'San Antonio'),
('169', '58', 'Barinas'),
('17', '5', 'Alto Ventuari'),
('170', '58', 'Alberto Arvelo Larriva'),
('171', '58', 'San Silvestre'),
('172', '58', 'Santa Inés'),
('173', '58', 'Santa Lucía'),
('174', '58', 'Torumos'),
('175', '58', 'El Carmen'),
('176', '58', 'Rómulo Betancourt'),
('177', '58', 'Corazón de Jesús'),
('178', '58', 'Ramón Ignacio Méndez'),
('179', '58', 'Alto Barinas'),
('18', '5', 'Medio Ventuari'),
('180', '58', 'Manuel Palacio Fajardo'),
('181', '58', 'Juan Antonio Rodríguez Domínguez'),
('182', '58', 'Dominga Ortiz de Páez'),
('183', '59', 'Barinitas'),
('184', '59', 'Altamira de Cáceres'),
('185', '59', 'Calderas'),
('186', '60', 'Barrancas'),
('187', '60', 'El Socorro'),
('188', '60', 'Mazparrito'),
('189', '61', 'Santa Bárbara'),
('19', '5', 'Bajo Ventuari'),
('190', '61', 'Pedro Briceño Méndez'),
('191', '61', 'Ramón Ignacio Méndez'),
('192', '61', 'José Ignacio del Pumar'),
('193', '62', 'Obispos'),
('194', '62', 'Guasimitos'),
('195', '62', 'El Real'),
('196', '62', 'La Luz'),
('197', '63', 'Ciudad Bolívia'),
('198', '63', 'José Ignacio Briceño'),
('199', '63', 'José Félix Ribas'),
('2', '1', 'Huachamacare Acanaña'),
('20', '6', 'Victorino'),
('200', '63', 'Páez'),
('201', '64', 'Libertad'),
('202', '64', 'Dolores'),
('203', '64', 'Santa Rosa'),
('204', '64', 'Palacio Fajardo'),
('205', '65', 'Ciudad de Nutrias'),
('206', '65', 'El Regalo'),
('207', '65', 'Puerto Nutrias'),
('208', '65', 'Santa Catalina'),
('209', '66', 'Cachamay'),
('21', '6', 'Comunidad'),
('210', '66', 'Chirica'),
('211', '66', 'Dalla Costa'),
('212', '66', 'Once de Abril'),
('213', '66', 'Simón Bolívar'),
('214', '66', 'Unare'),
('215', '66', 'Universidad'),
('216', '66', 'Vista al Sol'),
('217', '66', 'Pozo Verde'),
('218', '66', 'Yocoima'),
('219', '66', '5 de Julio'),
('22', '7', 'Casiquiare'),
('220', '67', 'Cedeño'),
('221', '67', 'Altagracia'),
('222', '67', 'Ascensión Farreras'),
('223', '67', 'Guaniamo'),
('224', '67', 'La Urbana'),
('225', '67', 'Pijiguaos'),
('226', '68', 'El Callao'),
('227', '69', 'Gran Sabana'),
('228', '69', 'Ikabarú'),
('229', '70', 'Catedral'),
('23', '7', 'Cocuy'),
('230', '70', 'Zea'),
('231', '70', 'Orinoco'),
('232', '70', 'José Antonio Páez'),
('233', '70', 'Marhuanta'),
('234', '70', 'Agua Salada'),
('235', '70', 'Vista Hermosa'),
('236', '70', 'La Sabanita'),
('237', '70', 'Panapana'),
('238', '71', 'Andrés Eloy Blanco'),
('239', '71', 'Pedro Cova'),
('24', '7', 'San Carlos de Río Negro'),
('240', '72', 'Raúl Leoni'),
('241', '72', 'Barceloneta'),
('242', '72', 'Santa Bárbara'),
('243', '72', 'San Francisco'),
('244', '73', 'Roscio'),
('245', '73', 'Salóm'),
('246', '74', 'Sifontes'),
('247', '74', 'Dalla Costa'),
('248', '74', 'San Isidro'),
('249', '75', 'Sucre'),
('25', '7', 'Solano'),
('250', '75', 'Aripao'),
('251', '75', 'Guarataro'),
('252', '75', 'Las Majadas'),
('253', '75', 'Moitaco'),
('254', '76', 'Padre Pedro Chien'),
('255', '76', 'Río Grande'),
('256', '77', 'Bejuma'),
('257', '77', 'Canoabo'),
('258', '77', 'Simón Bolívar'),
('259', '78', 'Güigüe'),
('26', '8', 'Anaco'),
('260', '78', 'Carabobo'),
('261', '78', 'Tacarigua'),
('262', '79', 'Mariara'),
('263', '79', 'Aguas Calientes'),
('264', '80', 'Ciudad Alianza'),
('265', '80', 'Guacara'),
('266', '80', 'Yagua'),
('267', '81', 'Morón'),
('268', '81', 'Yagua'),
('269', '82', 'Tocuyito'),
('27', '8', 'San Joaquín'),
('270', '82', 'Independencia'),
('271', '83', 'Los Guayos'),
('272', '84', 'Miranda'),
('273', '85', 'Montalbán'),
('274', '86', 'Naguanagua'),
('275', '87', 'Bartolomé Salóm'),
('276', '87', 'Democracia'),
('277', '87', 'Fraternidad'),
('278', '87', 'Goaigoaza'),
('279', '87', 'Juan José Flores'),
('28', '9', 'Cachipo'),
('280', '87', 'Unión'),
('281', '87', 'Borburata'),
('282', '87', 'Patanemo'),
('283', '88', 'San Diego'),
('284', '89', 'San Joaquín'),
('285', '90', 'Candelaria'),
('286', '90', 'Catedral'),
('287', '90', 'El Socorro'),
('288', '90', 'Miguel Peña'),
('289', '90', 'Rafael Urdaneta'),
('29', '9', 'Aragua de Barcelona'),
('290', '90', 'San Blas'),
('291', '90', 'San José'),
('292', '90', 'Santa Rosa'),
('293', '90', 'Negro Primero'),
('294', '91', 'Cojedes'),
('295', '91', 'Juan de Mata Suárez'),
('296', '92', 'Tinaquillo'),
('297', '93', 'El Baúl'),
('298', '93', 'Sucre'),
('299', '94', 'La Aguadita'),
('3', '1', 'Marawaka Toky Shamanaña'),
('30', '11', 'Lechería'),
('300', '94', 'Macapo'),
('301', '95', 'El Pao'),
('302', '96', 'El Amparo'),
('303', '96', 'Libertad de Cojedes'),
('304', '97', 'Rómulo Gallegos'),
('305', '98', 'San Carlos de Austria'),
('306', '98', 'Juan Ángel Bravo'),
('307', '98', 'Manuel Manrique'),
('308', '99', 'General en Jefe José Laurencio Silva'),
('309', '100', 'Curiapo'),
('31', '11', 'El Morro'),
('310', '100', 'Almirante Luis Brión'),
('311', '100', 'Francisco Aniceto Lugo'),
('312', '100', 'Manuel Renaud'),
('313', '100', 'Padre Barral'),
('314', '100', 'Santos de Abelgas'),
('315', '101', 'Imataca'),
('316', '101', 'Cinco de Julio'),
('317', '101', 'Juan Bautista Arismendi'),
('318', '101', 'Manuel Piar'),
('319', '101', 'Rómulo Gallegos'),
('32', '12', 'Puerto Píritu'),
('320', '102', 'Pedernales'),
('321', '102', 'Luis Beltrán Prieto Figueroa'),
('322', '103', 'San José (Delta Amacuro)'),
('323', '103', 'José Vidal Marcano'),
('324', '103', 'Juan Millán'),
('325', '103', 'Leonardo Ruíz Pineda'),
('326', '103', 'Mariscal Antonio José de Sucre'),
('327', '103', 'Monseñor Argimiro García'),
('328', '103', 'San Rafael (Delta Amacuro)'),
('329', '103', 'Virgen del Valle'),
('33', '12', 'San Miguel'),
('330', '10', 'Clarines'),
('331', '10', 'Guanape'),
('332', '10', 'Sabana de Uchire'),
('333', '104', 'Capadare'),
('334', '104', 'La Pastora'),
('335', '104', 'Libertador'),
('336', '104', 'San Juan de los Cayos'),
('337', '105', 'Aracua'),
('338', '105', 'La Peña'),
('339', '105', 'San Luis'),
('34', '12', 'Sucre'),
('340', '106', 'Bariro'),
('341', '106', 'Borojó'),
('342', '106', 'Capatárida'),
('343', '106', 'Guajiro'),
('344', '106', 'Seque'),
('345', '106', 'Zazárida'),
('346', '106', 'Valle de Eroa'),
('347', '107', 'Cacique Manaure'),
('348', '108', 'Norte'),
('349', '108', 'Carirubana'),
('35', '13', 'Valle de Guanape'),
('350', '108', 'Santa Ana'),
('351', '108', 'Urbana Punta Cardón'),
('352', '109', 'La Vela de Coro'),
('353', '109', 'Acurigua'),
('354', '109', 'Guaibacoa'),
('355', '109', 'Las Calderas'),
('356', '109', 'Macoruca'),
('357', '110', 'Dabajuro'),
('358', '111', 'Agua Clara'),
('359', '111', 'Avaria'),
('36', '13', 'Santa Bárbara'),
('360', '111', 'Pedregal'),
('361', '111', 'Piedra Grande'),
('362', '111', 'Purureche'),
('363', '112', 'Adaure'),
('364', '112', 'Adícora'),
('365', '112', 'Baraived'),
('366', '112', 'Buena Vista'),
('367', '112', 'Jadacaquiva'),
('368', '112', 'El Vínculo'),
('369', '112', 'El Hato'),
('37', '14', 'El Chaparro'),
('370', '112', 'Moruy'),
('371', '112', 'Pueblo Nuevo'),
('372', '113', 'Agua Larga'),
('373', '113', 'El Paují'),
('374', '113', 'Independencia'),
('375', '113', 'Mapararí'),
('376', '114', 'Agua Linda'),
('377', '114', 'Araurima'),
('378', '114', 'Jacura'),
('379', '115', 'Tucacas'),
('38', '14', 'Tomás Alfaro'),
('380', '115', 'Boca de Aroa'),
('381', '116', 'Los Taques'),
('382', '116', 'Judibana'),
('383', '117', 'Mene de Mauroa'),
('384', '117', 'San Félix'),
('385', '117', 'Casigua'),
('386', '118', 'Guzmán Guillermo'),
('387', '118', 'Mitare'),
('388', '118', 'Río Seco'),
('389', '118', 'Sabaneta'),
('39', '14', 'Calatrava'),
('390', '118', 'San Antonio'),
('391', '118', 'San Gabriel'),
('392', '118', 'Santa Ana'),
('393', '119', 'Boca del Tocuyo'),
('394', '119', 'Chichiriviche'),
('395', '119', 'Tocuyo de la Costa'),
('396', '120', 'Palmasola'),
('397', '121', 'Cabure'),
('398', '121', 'Colina'),
('399', '121', 'Curimagua'),
('4', '1', 'Mavaka Mavaka'),
('40', '15', 'Guanta'),
('400', '122', 'San José de la Costa'),
('401', '122', 'Píritu'),
('402', '123', 'San Francisco'),
('403', '124', 'Sucre'),
('404', '124', 'Pecaya'),
('405', '125', 'Tocópero'),
('406', '126', 'El Charal'),
('407', '126', 'Las Vegas del Tuy'),
('408', '126', 'Santa Cruz de Bucaral'),
('409', '127', 'Bruzual'),
('41', '15', 'Chorrerón'),
('410', '127', 'Urumaco'),
('411', '128', 'Puerto Cumarebo'),
('412', '128', 'La Ciénaga'),
('413', '128', 'La Soledad'),
('414', '128', 'Pueblo Cumarebo'),
('415', '128', 'Zazárida'),
('416', '113', 'Churuguara'),
('417', '129', 'Camaguán'),
('418', '129', 'Puerto Miranda'),
('419', '129', 'Uverito'),
('42', '16', 'Mamo'),
('420', '130', 'Chaguaramas'),
('421', '131', 'El Socorro'),
('422', '132', 'Tucupido'),
('423', '132', 'San Rafael de Laya'),
('424', '133', 'Altagracia de Orituco'),
('425', '133', 'San Rafael de Orituco'),
('426', '133', 'San Francisco Javier de Lezama'),
('427', '133', 'Paso Real de Macaira'),
('428', '133', 'Carlos Soublette'),
('429', '133', 'San Francisco de Macaira'),
('43', '16', 'Soledad'),
('430', '133', 'Libertad de Orituco'),
('431', '134', 'Cantaclaro'),
('432', '134', 'San Juan de los Morros'),
('433', '134', 'Parapara'),
('434', '135', 'El Sombrero'),
('435', '135', 'Sosa'),
('436', '136', 'Las Mercedes'),
('437', '136', 'Cabruta'),
('438', '136', 'Santa Rita de Manapire'),
('439', '137', 'Valle de la Pascua'),
('44', '17', 'Mapire'),
('440', '137', 'Espino'),
('441', '138', 'San José de Unare'),
('442', '138', 'Zaraza'),
('443', '139', 'San José de Tiznados'),
('444', '139', 'San Francisco de Tiznados'),
('445', '139', 'San Lorenzo de Tiznados'),
('446', '139', 'Ortiz'),
('447', '140', 'Guayabal'),
('448', '140', 'Cazorla'),
('449', '141', 'San José de Guaribe'),
('45', '17', 'Piar'),
('450', '141', 'Uveral'),
('451', '142', 'Santa María de Ipire'),
('452', '142', 'Altamira'),
('453', '143', 'El Calvario'),
('454', '143', 'El Rastro'),
('455', '143', 'Guardatinajas'),
('456', '143', 'Capital Urbana Calabozo'),
('457', '144', 'Quebrada Honda de Guache'),
('458', '144', 'Pío Tamayo'),
('459', '144', 'Yacambú'),
('46', '17', 'Santa Clara'),
('460', '145', 'Fréitez'),
('461', '145', 'José María Blanco'),
('462', '146', 'Catedral'),
('463', '146', 'Concepción'),
('464', '146', 'El Cují'),
('465', '146', 'Juan de Villegas'),
('466', '146', 'Santa Rosa'),
('467', '146', 'Tamaca'),
('468', '146', 'Unión'),
('469', '146', 'Aguedo Felipe Alvarado'),
('47', '17', 'San Diego de Cabrutica'),
('470', '146', 'Buena Vista'),
('471', '146', 'Juárez'),
('472', '147', 'Juan Bautista Rodríguez'),
('473', '147', 'Cuara'),
('474', '147', 'Diego de Lozada'),
('475', '147', 'Paraíso de San José'),
('476', '147', 'San Miguel'),
('477', '147', 'Tintorero'),
('478', '147', 'José Bernardo Dorante'),
('479', '147', 'Coronel Mariano Peraza '),
('48', '17', 'Uverito'),
('480', '148', 'Bolívar'),
('481', '148', 'Anzoátegui'),
('482', '148', 'Guarico'),
('483', '148', 'Hilario Luna y Luna'),
('484', '148', 'Humocaro Alto'),
('485', '148', 'Humocaro Bajo'),
('486', '148', 'La Candelaria'),
('487', '148', 'Morán'),
('488', '149', 'Cabudare'),
('489', '149', 'José Gregorio Bastidas'),
('49', '17', 'Zuata'),
('490', '149', 'Agua Viva'),
('491', '150', 'Sarare'),
('492', '150', 'Buría'),
('493', '150', 'Gustavo Vegas León'),
('494', '151', 'Trinidad Samuel'),
('495', '151', 'Antonio Díaz'),
('496', '151', 'Camacaro'),
('497', '151', 'Castañeda'),
('498', '151', 'Cecilio Zubillaga'),
('499', '151', 'Chiquinquirá'),
('5', '1', 'Sierra Parima Parimabé'),
('50', '18', 'Puerto La Cruz'),
('500', '151', 'El Blanco'),
('501', '151', 'Espinoza de los Monteros'),
('502', '151', 'Lara'),
('503', '151', 'Las Mercedes'),
('504', '151', 'Manuel Morillo'),
('505', '151', 'Montaña Verde'),
('506', '151', 'Montes de Oca'),
('507', '151', 'Torres'),
('508', '151', 'Heriberto Arroyo'),
('509', '151', 'Reyes Vargas'),
('51', '18', 'Pozuelos'),
('510', '151', 'Altagracia'),
('511', '152', 'Siquisique'),
('512', '152', 'Moroturo'),
('513', '152', 'San Miguel'),
('514', '152', 'Xaguas'),
('515', '179', 'Presidente Betancourt'),
('516', '179', 'Presidente Páez'),
('517', '179', 'Presidente Rómulo Gallegos'),
('518', '179', 'Gabriel Picón González'),
('519', '179', 'Héctor Amable Mora'),
('52', '19', 'Onoto'),
('520', '179', 'José Nucete Sardi'),
('521', '179', 'Pulido Méndez'),
('522', '180', 'La Azulita'),
('523', '181', 'Santa Cruz de Mora'),
('524', '181', 'Mesa Bolívar'),
('525', '181', 'Mesa de Las Palmas'),
('526', '182', 'Aricagua'),
('527', '182', 'San Antonio'),
('528', '183', 'Canagua'),
('529', '183', 'Capurí'),
('53', '19', 'San Pablo'),
('530', '183', 'Chacantá'),
('531', '183', 'El Molino'),
('532', '183', 'Guaimaral'),
('533', '183', 'Mucutuy'),
('534', '183', 'Mucuchachí'),
('535', '184', 'Fernández Peña'),
('536', '184', 'Matriz'),
('537', '184', 'Montalbán'),
('538', '184', 'Acequias'),
('539', '184', 'Jají'),
('54', '20', 'San Mateo'),
('540', '184', 'La Mesa'),
('541', '184', 'San José del Sur'),
('542', '185', 'Tucaní'),
('543', '185', 'Florencio Ramírez'),
('544', '186', 'Santo Domingo'),
('545', '186', 'Las Piedras'),
('546', '187', 'Guaraque'),
('547', '187', 'Mesa de Quintero'),
('548', '187', 'Río Negro'),
('549', '188', 'Arapuey'),
('55', '20', 'El Carito'),
('550', '188', 'Palmira'),
('551', '189', 'San Cristóbal de Torondoy'),
('552', '189', 'Torondoy'),
('553', '190', 'Antonio Spinetti Dini'),
('554', '190', 'Arias'),
('555', '190', 'Caracciolo Parra Pérez'),
('556', '190', 'Domingo Peña'),
('557', '190', 'El Llano'),
('558', '190', 'Gonzalo Picón Febres'),
('559', '190', 'Jacinto Plaza'),
('56', '20', 'Santa Inés'),
('560', '190', 'Juan Rodríguez Suárez'),
('561', '190', 'Lasso de la Vega'),
('562', '190', 'Mariano Picón Salas'),
('563', '190', 'Milla'),
('564', '190', 'Osuna Rodríguez'),
('565', '190', 'Sagrario'),
('566', '190', 'El Morro'),
('567', '190', 'Los Nevados'),
('568', '191', 'Andrés Eloy Blanco'),
('569', '191', 'La Venta'),
('57', '20', 'La Romereña'),
('570', '191', 'Piñango'),
('571', '191', 'Timotes'),
('572', '192', 'Eloy Paredes'),
('573', '192', 'San Rafael de Alcázar'),
('574', '192', 'Santa Elena de Arenales'),
('575', '193', 'Santa María de Caparo'),
('576', '194', 'Pueblo Llano'),
('577', '195', 'Cacute'),
('578', '195', 'La Toma'),
('579', '195', 'Mucuchíes'),
('58', '21', 'Atapirire'),
('580', '195', 'Mucurubá'),
('581', '195', 'San Rafael'),
('582', '196', 'Gerónimo Maldonado'),
('583', '196', 'Bailadores'),
('584', '197', 'Tabay'),
('585', '198', 'Chiguará'),
('586', '198', 'Estánquez'),
('587', '198', 'Lagunillas'),
('588', '198', 'La Trampa'),
('589', '198', 'Pueblo Nuevo del Sur'),
('59', '21', 'Boca del Pao'),
('590', '198', 'San Juan'),
('591', '199', 'El Amparo'),
('592', '199', 'El Llano'),
('593', '199', 'San Francisco'),
('594', '199', 'Tovar'),
('595', '200', 'Independencia'),
('596', '200', 'María de la Concepción Palacios Blanco'),
('597', '200', 'Nueva Bolivia'),
('598', '200', 'Santa Apolonia'),
('599', '201', 'Caño El Tigre'),
('6', '2', 'Ucata Laja Lisa'),
('60', '21', 'El Pao'),
('600', '201', 'Zea'),
('601', '223', 'Aragüita'),
('602', '223', 'Arévalo González'),
('603', '223', 'Capaya'),
('604', '223', 'Caucagua'),
('605', '223', 'Panaquire'),
('606', '223', 'Ribas'),
('607', '223', 'El Café'),
('608', '223', 'Marizapa'),
('609', '224', 'Cumbo'),
('61', '21', 'Pariaguán'),
('610', '224', 'San José de Barlovento'),
('611', '225', 'El Cafetal'),
('612', '225', 'Las Minas'),
('613', '225', 'Nuestra Señora del Rosario'),
('614', '226', 'Higuerote'),
('615', '226', 'Curiepe'),
('616', '226', 'Tacarigua de Brión'),
('617', '227', 'Mamporal'),
('618', '228', 'Carrizal'),
('619', '229', 'Chacao'),
('62', '22', 'Cantaura'),
('620', '230', 'Charallave'),
('621', '230', 'Las Brisas'),
('622', '231', 'El Hatillo'),
('623', '232', 'Altagracia de la Montaña'),
('624', '232', 'Cecilio Acosta'),
('625', '232', 'Los Teques'),
('626', '232', 'El Jarillo'),
('627', '232', 'San Pedro'),
('628', '232', 'Tácata'),
('629', '232', 'Paracotos'),
('63', '22', 'Libertador'),
('630', '233', 'Cartanal'),
('631', '233', 'Santa Teresa del Tuy'),
('632', '234', 'La Democracia'),
('633', '234', 'Ocumare del Tuy'),
('634', '234', 'Santa Bárbara'),
('635', '235', 'San Antonio de los Altos'),
('636', '236', 'Río Chico'),
('637', '236', 'El Guapo'),
('638', '236', 'Tacarigua de la Laguna'),
('639', '236', 'Paparo'),
('64', '22', 'Santa Rosa'),
('640', '236', 'San Fernando del Guapo'),
('641', '237', 'Santa Lucía del Tuy'),
('642', '238', 'Cúpira'),
('643', '238', 'Machurucuto'),
('644', '239', 'Guarenas'),
('645', '240', 'San Antonio de Yare'),
('646', '240', 'San Francisco de Yare'),
('647', '241', 'Leoncio Martínez'),
('648', '241', 'Petare'),
('649', '241', 'Caucagüita'),
('65', '22', 'Urica'),
('650', '241', 'Filas de Mariche'),
('651', '241', 'La Dolorita'),
('652', '242', 'Cúa'),
('653', '242', 'Nueva Cúa'),
('654', '243', 'Guatire'),
('655', '243', 'Bolívar'),
('656', '258', 'San Antonio de Maturín'),
('657', '258', 'San Francisco de Maturín'),
('658', '259', 'Aguasay'),
('659', '260', 'Caripito'),
('66', '23', 'Píritu'),
('660', '261', 'El Guácharo'),
('661', '261', 'La Guanota'),
('662', '261', 'Sabana de Piedra'),
('663', '261', 'San Agustín'),
('664', '261', 'Teresen'),
('665', '261', 'Caripe'),
('666', '262', 'Areo'),
('667', '262', 'Capital Cedeño'),
('668', '262', 'San Félix de Cantalicio'),
('669', '262', 'Viento Fresco'),
('67', '23', 'San Francisco'),
('670', '263', 'El Tejero'),
('671', '263', 'Punta de Mata'),
('672', '264', 'Chaguaramas'),
('673', '264', 'Las Alhuacas'),
('674', '264', 'Tabasca'),
('675', '264', 'Temblador'),
('676', '265', 'Alto de los Godos'),
('677', '265', 'Boquerón'),
('678', '265', 'Las Cocuizas'),
('679', '265', 'La Cruz'),
('68', '24', 'San José de Guanipa'),
('680', '265', 'San Simón'),
('681', '265', 'El Corozo'),
('682', '265', 'El Furrial'),
('683', '265', 'Jusepín'),
('684', '265', 'La Pica'),
('685', '265', 'San Vicente'),
('686', '266', 'Aparicio'),
('687', '266', 'Aragua de Maturín'),
('688', '266', 'Chaguamal'),
('689', '266', 'El Pinto'),
('69', '25', 'Boca de Uchire'),
('690', '266', 'Guanaguana'),
('691', '266', 'La Toscana'),
('692', '266', 'Taguaya'),
('693', '267', 'Cachipo'),
('694', '267', 'Quiriquire'),
('695', '268', 'Santa Bárbara'),
('696', '269', 'Barrancas'),
('697', '269', 'Los Barrancos de Fajardo'),
('698', '270', 'Uracoa'),
('699', '271', 'Antolín del Campo'),
('7', '2', 'Yapacana Macuruco'),
('70', '25', 'Boca de Chávez'),
('700', '272', 'Arismendi'),
('701', '273', 'García'),
('702', '273', 'Francisco Fajardo'),
('703', '274', 'Bolívar'),
('704', '274', 'Guevara'),
('705', '274', 'Matasiete'),
('706', '274', 'Santa Ana'),
('707', '274', 'Sucre'),
('708', '275', 'Aguirre'),
('709', '275', 'Maneiro'),
('71', '26', 'Pueblo Nuevo'),
('710', '276', 'Adrián'),
('711', '276', 'Juan Griego'),
('712', '276', 'Yaguaraparo'),
('713', '277', 'Porlamar'),
('714', '278', 'San Francisco de Macanao'),
('715', '278', 'Boca de Río'),
('716', '279', 'Tubores'),
('717', '279', 'Los Baleales'),
('718', '280', 'Vicente Fuentes'),
('719', '280', 'Villalba'),
('72', '26', 'Santa Ana'),
('720', '281', 'San Juan Bautista'),
('721', '281', 'Zabala'),
('722', '283', 'Capital Araure'),
('723', '283', 'Río Acarigua'),
('724', '284', 'Capital Esteller'),
('725', '284', 'Uveral'),
('726', '285', 'Guanare'),
('727', '285', 'Córdoba'),
('728', '285', 'San José de la Montaña'),
('729', '285', 'San Juan de Guanaguanare'),
('73', '27', 'Bergantín'),
('730', '285', 'Virgen de la Coromoto'),
('731', '286', 'Guanarito'),
('732', '286', 'Trinidad de la Capilla'),
('733', '286', 'Divina Pastora'),
('734', '287', 'Monseñor José Vicente de Unda'),
('735', '287', 'Peña Blanca'),
('736', '288', 'Capital Ospino'),
('737', '288', 'Aparición'),
('738', '288', 'La Estación'),
('739', '289', 'Páez'),
('74', '27', 'Caigua'),
('740', '289', 'Payara'),
('741', '289', 'Pimpinela'),
('742', '289', 'Ramón Peraza'),
('743', '290', 'Papelón'),
('744', '290', 'Caño Delgadito'),
('745', '291', 'San Genaro de Boconoito'),
('746', '291', 'Antolín Tovar'),
('747', '292', 'San Rafael de Onoto'),
('748', '292', 'Santa Fe'),
('749', '292', 'Thermo Morles'),
('75', '27', 'El Carmen'),
('750', '293', 'Santa Rosalía'),
('751', '293', 'Florida'),
('752', '294', 'Sucre'),
('753', '294', 'Concepción'),
('754', '294', 'San Rafael de Palo Alzado'),
('755', '294', 'Uvencio Antonio Velásquez'),
('756', '294', 'San José de Saguaz'),
('757', '294', 'Villa Rosa'),
('758', '295', 'Turén'),
('759', '295', 'Canelones'),
('76', '27', 'El Pilar'),
('760', '295', 'Santa Cruz'),
('761', '295', 'San Isidro Labrador'),
('762', '296', 'Mariño'),
('763', '296', 'Rómulo Gallegos'),
('764', '297', 'San José de Aerocuar'),
('765', '297', 'Tavera Acosta'),
('766', '298', 'Río Caribe'),
('767', '298', 'Antonio José de Sucre'),
('768', '298', 'El Morro de Puerto Santo'),
('769', '298', 'Puerto Santo'),
('77', '27', 'Naricual'),
('770', '298', 'San Juan de las Galdonas'),
('771', '299', 'El Pilar'),
('772', '299', 'El Rincón'),
('773', '299', 'General Francisco Antonio Váquez'),
('774', '299', 'Guaraúnos'),
('775', '299', 'Tunapuicito'),
('776', '299', 'Unión'),
('777', '300', 'Santa Catalina'),
('778', '300', 'Santa Rosa'),
('779', '300', 'Santa Teresa'),
('78', '27', 'San Crsitóbal'),
('780', '300', 'Bolívar'),
('781', '300', 'Maracapana'),
('782', '302', 'Libertad'),
('783', '302', 'El Paujil'),
('784', '302', 'Yaguaraparo'),
('785', '303', 'Cruz Salmerón Acosta'),
('786', '303', 'Chacopata'),
('787', '303', 'Manicuare'),
('788', '304', 'Tunapuy'),
('789', '304', 'Campo Elías'),
('79', '28', 'Edmundo Barrios'),
('790', '305', 'Irapa'),
('791', '305', 'Campo Claro'),
('792', '305', 'Maraval'),
('793', '305', 'San Antonio de Irapa'),
('794', '305', 'Soro'),
('795', '306', 'Mejía'),
('796', '307', 'Cumanacoa'),
('797', '307', 'Arenas'),
('798', '307', 'Aricagua'),
('799', '307', 'Cogollar'),
('8', '2', 'Caname Guarinuma'),
('80', '28', 'Miguel Otero Silva'),
('800', '307', 'San Fernando'),
('801', '307', 'San Lorenzo'),
('802', '308', 'Villa Frontado (Muelle de Cariaco)'),
('803', '308', 'Catuaro'),
('804', '308', 'Rendón'),
('805', '308', 'San Cruz'),
('806', '308', 'Santa María'),
('807', '309', 'Altagracia'),
('808', '309', 'Santa Inés'),
('809', '309', 'Valentín Valiente'),
('81', '29', 'Achaguas'),
('810', '309', 'Ayacucho'),
('811', '309', 'San Juan'),
('812', '309', 'Raúl Leoni'),
('813', '309', 'Gran Mariscal'),
('814', '310', 'Cristóbal Colón'),
('815', '310', 'Bideau'),
('816', '310', 'Punta de Piedras'),
('817', '310', 'Güiria'),
('818', '341', 'Andrés Bello'),
('819', '342', 'Antonio Rómulo Costa'),
('82', '29', 'Apurito'),
('820', '343', 'Ayacucho'),
('821', '343', 'Rivas Berti'),
('822', '343', 'San Pedro del Río'),
('823', '344', 'Bolívar'),
('824', '344', 'Palotal'),
('825', '344', 'General Juan Vicente Gómez'),
('826', '344', 'Isaías Medina Angarita'),
('827', '345', 'Cárdenas'),
('828', '345', 'Amenodoro Ángel Lamus'),
('829', '345', 'La Florida'),
('83', '29', 'El Yagual'),
('830', '346', 'Córdoba'),
('831', '347', 'Fernández Feo'),
('832', '347', 'Alberto Adriani'),
('833', '347', 'Santo Domingo'),
('834', '348', 'Francisco de Miranda'),
('835', '349', 'García de Hevia'),
('836', '349', 'Boca de Grita'),
('837', '349', 'José Antonio Páez'),
('838', '350', 'Guásimos'),
('839', '351', 'Independencia'),
('84', '29', 'Guachara'),
('840', '351', 'Juan Germán Roscio'),
('841', '351', 'Román Cárdenas'),
('842', '352', 'Jáuregui'),
('843', '352', 'Emilio Constantino Guerrero'),
('844', '352', 'Monseñor Miguel Antonio Salas'),
('845', '353', 'José María Vargas'),
('846', '354', 'Junín'),
('847', '354', 'La Petrólea'),
('848', '354', 'Quinimarí'),
('849', '354', 'Bramón'),
('85', '29', 'Mucuritas'),
('850', '355', 'Libertad'),
('851', '355', 'Cipriano Castro'),
('852', '355', 'Manuel Felipe Rugeles'),
('853', '356', 'Libertador'),
('854', '356', 'Doradas'),
('855', '356', 'Emeterio Ochoa'),
('856', '356', 'San Joaquín de Navay'),
('857', '357', 'Lobatera'),
('858', '357', 'Constitución'),
('859', '358', 'Michelena'),
('86', '29', 'Queseras del medio'),
('860', '359', 'Panamericano'),
('861', '359', 'La Palmita'),
('862', '360', 'Pedro María Ureña'),
('863', '360', 'Nueva Arcadia'),
('864', '361', 'Delicias'),
('865', '361', 'Pecaya'),
('866', '362', 'Samuel Darío Maldonado'),
('867', '362', 'Boconó'),
('868', '362', 'Hernández'),
('869', '363', 'La Concordia'),
('87', '30', 'Biruaca'),
('870', '363', 'San Juan Bautista'),
('871', '363', 'Pedro María Morantes'),
('872', '363', 'San Sebastián'),
('873', '363', 'Dr. Francisco Romero Lobo'),
('874', '364', 'Seboruco'),
('875', '365', 'Simón Rodríguez'),
('876', '366', 'Sucre'),
('877', '366', 'Eleazar López Contreras'),
('878', '366', 'San Pablo'),
('879', '367', 'Torbes'),
('88', '31', 'Bruzual'),
('880', '368', 'Uribante'),
('881', '368', 'Cárdenas'),
('882', '368', 'Juan Pablo Peñalosa'),
('883', '368', 'Potosí'),
('884', '369', 'San Judas Tadeo'),
('885', '370', 'Araguaney'),
('886', '370', 'El Jaguito'),
('887', '370', 'La Esperanza'),
('888', '370', 'Santa Isabel'),
('889', '371', 'Boconó'),
('89', '31', 'Mantecal'),
('890', '371', 'El Carmen'),
('891', '371', 'Mosquey'),
('892', '371', 'Ayacucho'),
('893', '371', 'Burbusay'),
('894', '371', 'General Ribas'),
('895', '371', 'Guaramacal'),
('896', '371', 'Vega de Guaramacal'),
('897', '371', 'Monseñor Jáuregui'),
('898', '371', 'Rafael Rangel'),
('899', '371', 'San Miguel'),
('9', '3', 'Fernando Girón Tovar'),
('90', '31', 'Quintero'),
('900', '371', 'San José'),
('901', '372', 'Sabana Grande'),
('902', '372', 'Cheregüé'),
('903', '372', 'Granados'),
('904', '373', 'Arnoldo Gabaldón'),
('905', '373', 'Bolivia'),
('906', '373', 'Carrillo'),
('907', '373', 'Cegarra'),
('908', '373', 'Chejendé'),
('909', '373', 'Manuel Salvador Ulloa'),
('91', '31', 'Rincón Hondo'),
('910', '373', 'San José'),
('911', '374', 'Carache'),
('912', '374', 'La Concepción'),
('913', '374', 'Cuicas'),
('914', '374', 'Panamericana'),
('915', '374', 'Santa Cruz'),
('916', '375', 'Escuque'),
('917', '375', 'La Unión'),
('918', '375', 'Santa Rita'),
('919', '375', 'Sabana Libre'),
('92', '31', 'San Vicente'),
('920', '376', 'El Socorro'),
('921', '376', 'Los Caprichos'),
('922', '376', 'Antonio José de Sucre'),
('923', '377', 'Campo Elías'),
('924', '377', 'Arnoldo Gabaldón'),
('925', '378', 'Santa Apolonia'),
('926', '378', 'El Progreso'),
('927', '378', 'La Ceiba'),
('928', '378', 'Tres de Febrero'),
('929', '379', 'El Dividive'),
('93', '32', 'Guasdualito'),
('930', '379', 'Agua Santa'),
('931', '379', 'Agua Caliente'),
('932', '379', 'El Cenizo'),
('933', '379', 'Valerita'),
('934', '380', 'Monte Carmelo'),
('935', '380', 'Buena Vista'),
('936', '380', 'Santa María del Horcón'),
('937', '381', 'Motatán'),
('938', '381', 'El Baño'),
('939', '381', 'Jalisco'),
('94', '32', 'Aramendi'),
('940', '382', 'Pampán'),
('941', '382', 'Flor de Patria'),
('942', '382', 'La Paz'),
('943', '382', 'Santa Ana'),
('944', '383', 'Pampanito'),
('945', '383', 'La Concepción'),
('946', '383', 'Pampanito II'),
('947', '384', 'Betijoque'),
('948', '384', 'José Gregorio Hernández'),
('949', '384', 'La Pueblita'),
('95', '32', 'El Amparo'),
('950', '384', 'Los Cedros'),
('951', '385', 'Carvajal'),
('952', '385', 'Campo Alegre'),
('953', '385', 'Antonio Nicolás Briceño'),
('954', '385', 'José Leonardo Suárez'),
('955', '386', 'Sabana de Mendoza'),
('956', '386', 'Junín'),
('957', '386', 'Valmore Rodríguez'),
('958', '386', 'El Paraíso'),
('959', '387', 'Andrés Linares'),
('96', '32', 'San Camilo'),
('960', '387', 'Chiquinquirá'),
('961', '387', 'Cristóbal Mendoza'),
('962', '387', 'Cruz Carrillo'),
('963', '387', 'Matriz'),
('964', '387', 'Monseñor Carrillo'),
('965', '387', 'Tres Esquinas'),
('966', '388', 'Cabimbú'),
('967', '388', 'Jajó'),
('968', '388', 'La Mesa de Esnujaque'),
('969', '388', 'Santiago'),
('97', '32', 'Urdaneta'),
('970', '388', 'Tuñame'),
('971', '388', 'La Quebrada'),
('972', '389', 'Juan Ignacio Montilla'),
('973', '389', 'La Beatriz'),
('974', '389', 'La Puerta'),
('975', '389', 'Mendoza del Valle de Momboy'),
('976', '389', 'Mercedes Díaz'),
('977', '389', 'San Luis'),
('978', '390', 'Caraballeda'),
('979', '390', 'Carayaca'),
('98', '33', 'San Juan de Payara'),
('980', '390', 'Carlos Soublette'),
('981', '390', 'Caruao Chuspa'),
('982', '390', 'Catia La Mar'),
('983', '390', 'El Junko'),
('984', '390', 'La Guaira'),
('985', '390', 'Macuto'),
('986', '390', 'Maiquetía'),
('987', '390', 'Naiguatá'),
('988', '390', 'Urimare'),
('989', '391', 'Arístides Bastidas'),
('99', '33', 'Codazzi'),
('990', '392', 'Bolívar'),
('991', '407', 'Chivacoa'),
('992', '407', 'Campo Elías'),
('993', '408', 'Cocorote'),
('994', '409', 'Independencia'),
('995', '410', 'José Antonio Páez'),
('996', '411', 'La Trinidad'),
('997', '412', 'Manuel Monge'),
('998', '413', 'Salóm'),
('999', '413', 'Temerla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_curso`
--

CREATE TABLE `participante_curso` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_encuentro`
--

CREATE TABLE `participante_encuentro` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `fecha_naci` date NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` char(1) NOT NULL,
  `nacionalidad` char(2) NOT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `direccion` varchar(10) NOT NULL,
  `encuentro` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `participante_encuentro`
--

INSERT INTO `participante_encuentro` (`id`, `cedula`, `nombre`, `apellido`, `telefono`, `fecha_naci`, `edad`, `sexo`, `nacionalidad`, `discapacidad`, `direccion`, `encuentro`, `email`) VALUES
(10, 11496046, 'edelmira', 'ramirez', '04163711711', '1971-12-17', 54, 'F', 'V', '1-AS/D', '871', 26, 'edelmiraramirezparra@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_escuela`
--

CREATE TABLE `participante_escuela` (
  `cedula` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` char(2) NOT NULL,
  `nacionalidad` char(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_taller`
--

CREATE TABLE `participante_taller` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_recibido` date NOT NULL,
  `taller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_nacimiento`
--

CREATE TABLE `partida_nacimiento` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `archivo` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_jornadas`
--

CREATE TABLE `personas_jornadas` (
  `id` int(11) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `discapacidad` varchar(10) NOT NULL,
  `ayuda_tecnica` varchar(10) NOT NULL,
  `fecha_jaten` date DEFAULT NULL,
  `numero_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personas_jornadas`
--

INSERT INTO `personas_jornadas` (`id`, `cedula`, `nombre`, `apellido`, `discapacidad`, `ayuda_tecnica`, `fecha_jaten`, `numero_jornada`) VALUES
(18, 29926569, 'giovanny ', 'jimenez', 'motora', '2-MuletasM', '2025-02-03', 113),
(19, 32786189, 'gabriela ', 'borrero', 'motora', '2-MuletasM', '2025-02-03', 113),
(20, 28603403, 'jose kiliam', 'rodriguez', 'Distrofia', '1-silla.r', '2025-02-03', 113),
(21, 22640570, 'elsida ', 'corredor', 'motora', '1-silla.r', '2025-02-03', 113),
(22, 22520588, 'CARLOS', 'GELVEZ', 'motora', 'S/N', '2025-02-04', 113),
(23, 26807487, 'SERAFIN', 'RODRIGUEZ', 'motora', 'S/N', '2025-02-04', 113),
(24, 699087, 'JOSE ', 'MENDEZ', 'motora', '3-baston', '2025-02-04', 113),
(25, 191080, 'MARIO', 'GOMEZ', 'motora', '3-baston', '2025-02-04', 113),
(26, 10148693, 'GLORIA', 'DE VARGAS', 'motora', '3-baston', '2025-02-04', 113),
(27, 10868793, 'JORGE', 'ZAMBRANO', 'motora', 'S/N', '2025-02-04', 113),
(28, 17384470, 'MONICA ', 'BARRIOS', 'motora', '3-baston', '2025-02-04', 113),
(29, 23152982, 'FLOR', 'DIAZ', 'motora', '3-baston', '2025-02-04', 113),
(30, 10145250, 'DORIS ', 'VELAZCO', 'motora', '3-baston', '2025-02-04', 113),
(32, 15568795, 'cristina', 'flores', 'esclerosis', '6-andadera', '2025-02-04', 113),
(33, 13350421, 'rodrigo ', 'gonzalez', 'D_di', 'S/N', '2025-02-05', 113),
(34, 5644444, 'carmen', 'rosalez', '1-AS/D', 'S/N', '2025-02-05', 113),
(35, 26841301, 'eloisa', 'florez', 'motora', '6-andadera', '2025-02-05', 113),
(76, 147087582, 'maria', 'rincon de amaya', 'motora', '1-silla.r', '2025-02-05', 113),
(92, 83638008, 'agustina', 'juarez', '1-AS/D', '11-panales', '2025-02-05', 113),
(123, 12970574, 'PAULA SONERLYN', 'SIERRA SANTANDER', '1-AS/D', 'S/N', '2025-02-10', 114),
(124, 29830748, 'YORGELIS FABIOLA', 'CHACON  CELIS', '1-AS/D', 'S/N', '2025-02-10', 114),
(125, 25168359, 'carolina viviana', 'orozco gonzalez', '1-AS/D', 'S/N', '2025-02-14', 114),
(126, 25169052, 'daikely rosvely', 'quintan garcia', '1-AS/D', 'S/N', '2025-02-14', 114),
(127, 19597720, 'rosa virginia', 'varela marin', '1-AS/D', 'S/N', '2025-02-14', 114),
(128, 20716057, 'yuleidy andreina', 'carrero chacon', '1-AS/D', 'S/N', '2025-02-14', 114),
(129, 17456975, 'hersy karina', 'peña vera', '1-AS/D', 'S/N', '2025-02-14', 114),
(130, 19777893, 'andreina judith', 'ramirez araque', '1-AS/D', 'S/N', '2025-02-14', 114),
(131, 12972320, 'milagros socorro ', 'mendoza rios ', '1-AS/D', 'S/N', '2025-02-14', 114),
(132, 13972550, 'july esmeralda ', 'montañez roa', '1-AS/D', 'S/N', '2025-02-14', 114),
(133, 14646041, 'adriana ', 'salas', '1-AS/D', 'S/N', '2025-02-14', 114),
(134, 11505068, 'francia magaly', 'jaimes fuentes', '1-AS/D', 'S/N', '2025-02-14', 114),
(135, 21471838, 'leidy', 'rivera', '1-AS/D', 'S/N', '2025-02-14', 114),
(136, 13940202, 'heidy yureima', 'duque arello', '1-AS/D', 'S/N', '2025-02-14', 114),
(137, 17812028, 'dayana', 'careño', '1-AS/D', 'S/N', '2025-02-14', 114),
(138, 21139494, 'leiner', 'botello', 'motora', 'S/N', '2026-05-25', 121);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes`
--

CREATE TABLE `porcentajes` (
  `fecha` varchar(255) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `porcentajes`
--

INSERT INTO `porcentajes` (`fecha`, `porcentaje`) VALUES
('2023-07-27', 15.2),
('2023-07-28', 2.9),
('2023-07-30', 0),
('2023-07-31', 0),
('2023-08-02', 0),
('2023-08-05', 3.7),
('2023-08-06', 0),
('2023-08-07', 0),
('2023-08-09', 0),
('0000-00-00', 100),
('August', 1.3),
('September', 0),
('October', 0),
('November', 3.7),
('December', 0),
('January', 24.3),
('February', 10),
('March', 35.1),
('April', 2.6),
('May', 0),
('June', 0),
('July', 1.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protesis`
--

CREATE TABLE `protesis` (
  `id` int(10) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `protesis`
--

INSERT INTO `protesis` (`id`, `nombre`) VALUES
(5, 'Prótesis transfemoral'),
(6, 'Prótesis transtibial'),
(7, 'Prótesis superior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba_artificios`
--

CREATE TABLE `prueba_artificios` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_pruebas` date DEFAULT NULL,
  `pruebas` text DEFAULT NULL,
  `artificio_prueba` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_beneficiario`
--

CREATE TABLE `reg_beneficiario` (
  `id` int(11) NOT NULL,
  `cedula` int(12) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `registrado_por` tinytext DEFAULT NULL,
  `INSERTADO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reg_beneficiario`
--

INSERT INTO `reg_beneficiario` (`id`, `cedula`, `nombre`, `apellido`, `registrado_por`, `INSERTADO`) VALUES
(108, 45612312, 'Jose', 'Fernández', 'Deiker Fernandez', '2024-11-07 16:22:35'),
(109, 5135116, 'Carolna', 'sadsadsad', 'Deiker Fernandez', '2024-11-09 17:19:58'),
(110, 0, 'Jose', 'Fernández', 'Deiker Fernandez', '2024-11-10 09:37:43'),
(111, 11111111, 'Jose', 'Fernández', 'Deiker Fernandez', '2024-11-10 09:47:24'),
(112, 54412515, 'Jose', 'Fernández', 'Felix Key', '2024-11-11 08:19:30'),
(113, 12345678, 'Deiker ', 'Fernandez', 'Deiker Fernandez', '2024-11-25 10:48:05'),
(114, 45684512, 'Deiker Jose ', 'Fernandez Carvajal', 'Deiker Fernandez', '2024-11-28 09:58:21'),
(115, 30000000, 'Jose', 'Fernández', 'Deiker Fernandez', '2024-12-15 09:38:35'),
(116, 54515135, 'asdasdas', 'sadsads', 'Deiker Fernandez', '2024-12-15 10:06:44'),
(117, 1256456, 'Jose jose', 'Carvajal carvajal', 'Deiker Fernandez', '2024-12-15 10:39:16'),
(118, 30165406, 'Prueba', 'prueba', 'Deiker Fernandez', '2025-01-17 12:07:52'),
(119, 54515135, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-01-18 11:34:00'),
(120, 12561565, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-01-18 11:45:17'),
(121, 1231546, 'adssadw', 'asdeede', 'Deiker Fernandez', '2025-01-18 13:30:03'),
(122, 30165408, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-01-20 09:15:39'),
(123, 30165409, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-01-20 09:16:11'),
(124, 30165411, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-01-20 09:17:14'),
(125, 30165406, 'Deiker Jose', 'Fernandez', 'Deiker Fernandez', '2025-01-20 09:28:35'),
(126, 1231546, 'adssadw', 'asdeede', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(127, 1256456, 'Jose jose', 'Carvajal carvajal', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(128, 4184459, 'Carmen Elvira', 'Rodriguez', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(129, 4688373, 'Zoraida ', 'Salazar', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(130, 4692416, 'Cruz Elena ', 'Meneses', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(131, 5953844, 'Ghasam', 'El Jurde', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(132, 6539799, 'Mercedes Josefina', 'Fuentes', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(133, 8424575, 'Juan Vicente', 'Salazar', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(134, 8642045, 'juan', 'fajardo', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(135, 8647915, 'luis', 'fajardo', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(136, 8652636, 'Hilda josefina', 'patino', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(137, 12561565, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(138, 17763521, 'Jhoan ', 'Alzolar', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(139, 17832610, 'yenny carolina ', 'linares villareal ', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-12 09:14:26'),
(140, 19893082, 'Lety del Carmen', 'Narvaez', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(141, 25695551, 'Yunior Hernán ', 'Blanco Guzmán ', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-12 09:14:26'),
(142, 25997137, 'Gerson', 'Diaz', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(143, 26251194, 'enyeber', 'rodriguez', 'ELIEZER ALEJANDRO COLMENAREZ', '2025-02-12 09:14:26'),
(144, 28044742, 'Jose Alejandro', 'Serrano', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(145, 30000000, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(146, 30165406, 'Deiker Jose', 'Fernandez', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(147, 30165411, 'Jose', 'Fernández', 'Deiker Fernandez', '2025-02-12 09:14:26'),
(148, 30444385, 'Lusiangelis', 'Rodriguez', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(149, 34601579, 'Reinaldo Jose ', 'Espinoza', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(150, 177636621, 'Cristofer ', 'Viloria', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(151, 193458901, 'Maximiliano Jose', 'suarez', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(152, 210932441, 'Jesus Alfredo', 'Gereguan', 'JOSE MARQUEZ', '2025-02-12 09:14:26'),
(153, 2929513, 'carmen', 'machado', 'Laura Beatriz Pinto Hernandez', '2025-02-17 13:09:38'),
(154, 4692497, 'Marleny Josefina', 'Pulido', 'JOSE MARQUEZ', '2025-02-21 11:53:46'),
(155, 2924229, 'Porfirio Rafael', 'Lopez Silva', 'JOSE MARQUEZ', '2025-02-21 12:03:49'),
(156, 3605666, 'Manuel Antonio ', 'Diaz', 'JOSE MARQUEZ', '2025-02-21 12:19:44'),
(157, 8303365, 'Cristina del Valle', 'Garcia', 'JOSE MARQUEZ', '2025-02-21 12:25:51'),
(158, 9274044, 'Arquimedez Rafael ', 'Henriquez ', 'JOSE MARQUEZ', '2025-02-21 12:31:52'),
(159, 13772495, 'MARITZA DEL CARMEN ', 'SALAZAR ', 'JOSE MARQUEZ', '2025-02-21 12:37:30'),
(160, 18210098, 'JEAN CARLOS ', 'PATIÑO MARVAL ', 'JOSE MARQUEZ', '2025-02-21 12:41:35'),
(161, 8636544, 'RAFAEL JOSE ', 'FLORES RODRIGUEZ', 'JOSE MARQUEZ', '2025-02-21 12:48:46'),
(162, 9980488, 'JOSE LUIS ', 'VASQUEZ', 'JOSE MARQUEZ', '2025-02-21 12:53:31'),
(163, 4692308, 'JUANA DE DIOS ', 'MARIN DE SALAZAR', 'JOSE MARQUEZ', '2025-02-21 12:57:21'),
(164, 1046565, 'RAFAEL JOSE', 'RAMIREZ VELASQUEZ', 'JOSE MARQUEZ', '2025-02-21 13:00:48'),
(165, 10462058, 'ARECELYS MARGARITA ', 'MALAVE', 'JOSE MARQUEZ', '2025-02-21 13:06:27'),
(166, 10950457, 'JAIRO RUBEN', 'DEL VALLE ALFONZO ', 'JOSE MARQUEZ', '2025-02-21 13:12:36'),
(167, 10792919, 'YEBRI JOSE ', 'MARCANO', 'JOSE MARQUEZ', '2025-02-21 13:18:17'),
(168, 24753523, 'ROSMARY CAROLINA ', 'PEREZ MICAT', 'JOSE MARQUEZ', '2025-02-21 13:24:47'),
(169, 20064934, 'JOSSETH RAFAEL ', 'GARCIA', 'JOSE MARQUEZ', '2025-02-21 13:28:40'),
(170, 12670978, 'RICHARD JOSE ', 'RAMOS MAESTRE ', 'JOSE MARQUEZ', '2025-02-21 13:33:31'),
(171, 4562051, 'FLORSINA ', 'SALAZAR DEPEREZ ', 'JOSE MARQUEZ', '2025-02-21 13:39:15'),
(172, 14596035, 'ANGEL JOSE ', 'RODRIGUEZ ', 'JOSE MARQUEZ', '2025-02-21 13:44:53'),
(173, 9973719, 'DIUNYS JOSE ', 'LISBOARENGEL ', 'JOSE MARQUEZ', '2025-02-21 13:49:20'),
(174, 8432960, 'CARMEN BEATRIZ ', 'SALAZARLANDAETA', 'JOSE MARQUEZ', '2025-02-21 13:52:04'),
(175, 8430868, 'YRMA DEL VALLE', 'BASTARDO', 'JOSE MARQUEZ', '2025-02-21 13:55:01'),
(176, 10467713, 'Henry', 'Mercie', 'Ivan Jose ', '2025-02-25 09:21:27'),
(177, 9275125, 'zoraida', 'carrillo', 'Laura Beatriz Pinto Hernandez', '2025-02-25 09:51:03'),
(178, 25414998, 'Jonas', 'Ravelo', 'Ivan Jose ', '2025-02-25 09:55:25'),
(179, 25897300, 'jose gregorio', 'lobaton', 'Laura Beatriz Pinto Hernandez', '2025-02-25 10:11:05'),
(180, 14886764, 'Rodolfo ', 'Marin', 'Ivan Jose ', '2025-02-25 10:12:41'),
(181, 18211838, 'Vanesa', 'Urbaneja', 'Ivan Jose ', '2025-02-25 10:17:06'),
(182, 26031317, 'Joaquin', 'Arismendi', 'Ivan Jose ', '2025-02-25 10:22:32'),
(183, 200264934, 'Josseth', 'Garcia', 'Ivan Jose ', '2025-02-25 10:37:59'),
(184, 4692182, 'Jesus ', 'Cordova', 'Ivan Jose ', '2025-02-25 10:44:50'),
(185, 2925571, 'Jesus', 'Anton', 'Ivan Jose ', '2025-02-25 10:50:41'),
(186, 33685946, 'jeferson', 'otero', 'Ivan Jose ', '2025-02-26 10:16:29'),
(187, 8642390, 'Jose', 'Hernandez', 'Ivan Jose ', '2025-02-26 10:19:38'),
(188, 8636894, 'Luisa', 'Rodriguez', 'Ivan Jose ', '2025-02-26 10:24:20'),
(189, 5083520, 'Luis', 'Weffe', 'Ivan Jose ', '2025-02-26 10:28:08'),
(190, 12662749, 'Cruz ', 'Gomez', 'JOSE MARQUEZ', '2025-02-26 11:30:15'),
(191, 10791762, 'Asdrubal Jose', 'Galindo Curvelo', 'Leomar Alberto Mata Betancourt', '2025-03-24 14:20:11'),
(192, 4188883, 'Luis Jose ', 'Villaroel ', 'JOSE MARQUEZ', '2025-03-26 13:19:14'),
(193, 17763220, 'daniel eduardo', 'lopez velasquez', 'Laura Beatriz Pinto Hernandez', '2025-04-07 09:06:54'),
(194, 8549825, 'francisca', 'martinez de vallejo', 'Laura Beatriz Pinto Hernandez', '2025-04-07 09:37:43'),
(195, 8442973, 'wilfredo', 'vallejo', 'Laura Beatriz Pinto Hernandez', '2025-04-07 09:46:29'),
(196, 5705838, 'carmen elena', 'galanton', 'Laura Beatriz Pinto Hernandez', '2025-04-07 09:55:09'),
(197, 2657067, 'froilan jose', 'cortes rojas', 'Laura Beatriz Pinto Hernandez', '2025-04-07 10:07:53'),
(198, 17910415, 'francys', 'vasquez', 'Laura Beatriz Pinto Hernandez', '2025-04-07 10:19:26'),
(199, 3338072, 'jesus ', 'benitez', 'Laura Beatriz Pinto Hernandez', '2025-04-07 10:31:11'),
(200, 2983212, 'Carlos', 'alvarez', 'Yeselim Perez', '2025-06-11 11:52:39'),
(201, 2976984, 'gladys', 'canelon', 'Yeselim Perez', '2025-06-11 11:57:03'),
(202, 8683522, 'felix', 'key', 'Maria Monterola', '2025-07-29 14:56:48'),
(203, 17977264, 'NORELIS', 'SALCEDO', 'ADAN CARTAGENA', '2025-08-28 11:34:59'),
(204, 15835054, 'MARCOS ALEJANDRO ', 'AGUIAR SILVA ', 'Luis Alberto  Olivares CONAPDIS', '2025-11-17 10:13:25'),
(205, 3569533, 'MARCIA LUCILA ', 'BENITEZ DE AZOCAR', 'Luis Alberto  Olivares CONAPDIS', '2025-11-18 09:39:15'),
(206, 24530170, 'LUIS IVAN', 'ROJAS MORA', 'Luis Alberto  Olivares CONAPDIS', '2025-11-18 10:01:52'),
(207, 6243569, 'YTALO ANTONIO', 'ESCALONA', 'Francisco Ibanez', '2026-01-19 11:08:42'),
(208, 20565667, 'AMDO ENRIQUE ', 'MOYA SALAZAR', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 12:00:21'),
(209, 19397245, 'FRANKLIN MARK', 'RAMOS HERNANDEZ ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 13:06:01'),
(210, 21537046, 'SIUL  YAMIRAT', 'CORTEZ VALERO', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 13:59:24'),
(211, 25624227, 'MOISES ENRIQUE ', 'DIAZ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 14:10:53'),
(212, 5754220, 'JUANA  NOLBERTA ', 'MORENO', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 14:24:17'),
(213, 6453964, 'LEONARDO  ARTURO', 'HERRERA', 'Luis Alberto  Olivares CONAPDIS', '2026-01-19 14:39:08'),
(214, 7360723, 'JANET MILAGROS', 'LOPEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:03:23'),
(215, 6504450, 'VICTOR MANUEL', 'TABASQUEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:17:17'),
(216, 18598845, 'ERNESTO JOSE ', 'GUZMAN IGUARO', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:24:59'),
(217, 30235535, 'LEUDYS JESUS ', 'GONZALEZ BRAZON ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:31:25'),
(218, 5423480, 'EMILIO ANTONIO', 'GUTIERREZ    HERRERA ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:38:48'),
(219, 23148581, 'FABIAN', 'DE HORTA MANJARRES', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 10:58:36'),
(220, 6349747, 'YUBELINE  COROMOTO', 'GASCON DIAZ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 11:05:07'),
(221, 11554051, 'JOHNNY  ELIAS', 'CHUQUI DJECKI', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 11:52:18'),
(222, 12340086, 'LENIN EDUARDO ', 'PARADAS  PALACIOS ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 12:10:21'),
(223, 7445492, 'YANETZI JOSEFINA', 'LOYO RIVAS', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 12:50:40'),
(224, 9461522, 'RAMIRO ', 'GRANADOS CARVACHO', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 13:07:10'),
(225, 30908646, 'LUISANA MARIA ', 'RONDON PEREIRA', 'Luis Alberto  Olivares CONAPDIS', '2026-01-20 13:26:50'),
(226, 8164768, 'MARIA OLIDINA', 'ROBAYO DE AGUERO', 'Luis Alberto  Olivares CONAPDIS', '2026-01-21 10:12:07'),
(227, 22764199, 'MILAGROS YOSELIN ', 'GARCIA PERNIA', 'Luis Alberto  Olivares CONAPDIS', '2026-01-21 11:31:20'),
(228, 12142595, 'MARIBET', 'RUIZ', 'Francisco Ibanez', '2026-01-22 09:39:30'),
(229, 2958517, 'CARMEN ', 'CHIRINOS', 'Isabel Ramirez', '2026-01-22 12:21:11'),
(230, 2976398, 'CLARA VIRGINIA', 'GORRI DE FERNANDEZ', 'Francisco Ibanez', '2026-01-26 11:11:24'),
(231, 4124735, 'JULIO RENGIFO', 'ORTEGA ', 'Luis Alberto  Olivares CONAPDIS', '2026-01-27 13:46:27'),
(232, 20329013, 'JOHANNA EMPERATRIZ', 'BERMUDEZ DUGARTE', 'Luis Alberto  Olivares CONAPDIS', '2026-01-28 14:28:51'),
(233, 15684500, 'ANGELICA', 'CAICEDO MENDOZA', 'Luis Alberto  Olivares CONAPDIS', '2026-01-30 14:31:04'),
(234, 4854616, 'CARMEN LEONOR', 'DUARTE', 'Francisco Ibanez', '2026-02-02 09:50:28'),
(235, 5601699, 'JESUS RAFAEL', 'MOY GOMEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-02-09 09:52:55'),
(236, 13218170, 'NISSEL MARIELY', 'BELTRAN CEBALLOS', 'Luis Alberto  Olivares CONAPDIS', '2026-02-10 08:07:10'),
(237, 4169840, 'ARGENIS ANDRES ', 'PEREZ RIOS ', 'Luis Alberto  Olivares CONAPDIS', '2026-02-10 10:44:14'),
(238, 25226787, 'JOSE ALEXANDER', 'APONTE', 'Luis Alberto  Olivares CONAPDIS', '2026-02-11 09:23:44'),
(239, 3215528, 'LUIS EMILIO', 'SANTOS BERMUDEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-02-12 09:20:36'),
(240, 9953256, 'JOSE MIGUEL', 'JIMENEZ RUIZ ', 'Luis Alberto  Olivares CONAPDIS', '2026-02-12 13:10:20'),
(241, 23623881, 'JESUS ALEJANDRO', 'PERNALETE  PERNALETE', 'Luis Alberto  Olivares CONAPDIS', '2026-02-19 14:04:26'),
(242, 26463644, 'NELSON NAIL', 'LINAREZ RONDON', 'Isabel Ramirez', '2026-02-20 11:28:23'),
(243, 25674958, 'JEAN FRAN ', 'MARQUEZ MEZA', 'Luis Alberto  Olivares CONAPDIS', '2026-02-20 12:10:23'),
(244, 33351791, 'JESUS', 'ROSALES', 'ADAN CARTAGENA', '2026-02-23 12:18:58'),
(245, 6297759, 'JOSE LUIS', 'MENDEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-02-25 10:26:21'),
(246, 6361308, 'NORAH YSABEL', 'MENDOZA DE CORONIL', 'Luis Alberto  Olivares CONAPDIS', '2026-03-02 12:16:33'),
(247, 3233121, 'MIRIAM RAFAELA ', 'OCARIZ MANRIQUE', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 13:31:49'),
(248, 14260655, 'MARIA MERCEDES', 'RISCANEVO DE OCANTO', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 13:36:37'),
(249, 3885513, 'SANDRA MARIA', 'TROMPIZ ALVAREZ', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 13:44:06'),
(250, 3405632, 'ALICIA', 'UZCATEGUI', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 14:00:19'),
(251, 33419859, 'LUIS FERNANDO', 'VASQUEZ PINTO', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 14:42:42'),
(252, 175734311, 'ISAIAS EDUARDO', 'PERAZA', 'ADAN CARTAGENA', '2026-03-05 14:50:11'),
(253, 28447405, 'jeyns ', 'galindo', 'Yurielvis Marian Gomez Rodriguez CONAPDIS', '2026-03-05 14:51:20'),
(254, 14128684, 'AMAURY ARGENIS', 'RODRIGUEZ', 'ADAN CARTAGENA', '2026-03-05 14:57:01'),
(255, 3990577, 'RAFAEL ANGEL', 'ALVARADO PAREDES', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 15:00:00'),
(256, 9961396, 'LINDA', 'VIELMA', 'ADAN CARTAGENA', '2026-03-05 15:01:56'),
(257, 4233724, 'TERESITA', 'HERNANDEZ', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 15:04:34'),
(258, 81305530, 'MARIANA', 'DELGADO', 'ADAN CARTAGENA', '2026-03-05 15:05:26'),
(259, 8365339, 'GLADYS JOSEFINA', 'MARQUEZ RODRIGUEZ', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 15:38:19'),
(260, 1219526, 'ANA JOAQUINA', 'LINARES', 'YOHANNY TERAN  CONAPDIS', '2026-03-05 15:43:11'),
(261, 2807454, 'cristobal ', 'duque', 'ADAN CARTAGENA', '2026-03-06 10:40:26'),
(262, 34157683, 'fabian', 'egui', 'ADAN CARTAGENA', '2026-03-06 10:46:37'),
(263, 23682288, 'VICENTE ANTONIO', 'DIAZ LECHE', 'Francisco Ibanez', '2026-03-06 11:13:06'),
(264, 8340872, 'ORLANDO JOSE ', 'HERNANDEZ', 'Francisco Ibanez', '2026-03-06 11:49:49'),
(265, 2381410, 'MARIA JOSEFINA', 'MORENO', 'YOHANNY TERAN  CONAPDIS', '2026-03-06 11:52:34'),
(266, 6359029, 'LUIS  ALBERTO ', 'DURAN AGUILAR', 'Luis Alberto  Olivares CONAPDIS', '2026-03-06 12:09:21'),
(267, 20047968, 'YITER', 'CADENAS ROMERO', 'Luis Alberto  Olivares CONAPDIS', '2026-03-06 14:52:06'),
(268, 5415186, 'CARMEN', 'DODERO DE SUARES', 'Francisco Ibanez', '2026-03-09 10:35:07'),
(269, 6260994, 'ELBA ', 'CRESPO', 'ADAN CARTAGENA', '2026-03-09 11:07:15'),
(270, 3474857, 'LUIS ANTONIO', 'AVILAN PUERTA', 'Francisco Ibanez', '2026-03-09 11:12:11'),
(271, 3530623, 'bibiano', 'graterol', 'ADAN CARTAGENA', '2026-03-09 12:53:57'),
(272, 20027969, 'EVERCIO  DE JESUS  ', 'SALAS  BARRETO', 'Luis Alberto  Olivares CONAPDIS', '2026-03-10 09:13:10'),
(273, 6728217, 'DUBER RAFAEL ', 'CORDERO NAVAS', 'Luis Alberto  Olivares CONAPDIS', '2026-03-10 11:30:21'),
(274, 9957384, 'JOSE EUGENIO ', 'ALZOLAY ZAMBRANO', 'Francisco Ibanez', '2026-03-10 13:09:20'),
(275, 19401635, 'EUGEMAR ANILC', 'FIGUERAS', 'YOHANNY TERAN  CONAPDIS', '2026-03-10 15:46:06'),
(276, 5413770, 'GUIOMAR DEL MILAGRO ', 'RIVERO DE BARRADAS', 'YOHANNY TERAN  CONAPDIS', '2026-03-10 15:54:44'),
(277, 5225379, 'LUIS RAMON', 'ROJAS TERAN', 'YOHANNY TERAN  CONAPDIS', '2026-03-10 16:21:12'),
(278, 28143325, 'YORGELIS ALEXANDRA  ', 'ALVARADO VALERA', 'Francisco Ibanez', '2026-03-11 09:15:58'),
(279, 10498342, 'wuilma', 'arcila', 'ADAN CARTAGENA', '2026-03-11 09:34:29'),
(280, 22748260, 'HONORATO ', 'CACERES', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 10:24:39'),
(281, 15204032, 'JOSE  ANTONIO ', 'ESPINOZA NUÑEZ', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 10:32:07'),
(282, 9005493, 'JOSE RAMON', 'ARAUJO', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 10:37:40'),
(283, 6062851, 'RITA YAJAIRA ', 'HERNANDEZ', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 10:45:56'),
(284, 3839860, 'JESUS EULOGIO', 'MIJARES RADA', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 10:54:25'),
(285, 27200412, 'DANYERLIS ALAXANDRA', 'PEREIRA TORRES', 'Mariangel Amairani Pereira Pantoja ', '2026-03-11 11:21:43'),
(286, 4545711, 'COLUMBA jOSEFINA ', 'RIZZO DE MARCANO ', 'Francisco Ibanez', '2026-03-11 11:36:44'),
(287, 14518823, 'EUGENIO', 'ARIZA', 'ADAN CARTAGENA', '2026-03-16 11:30:40'),
(288, 12298380, 'NEILA', 'PARUCHO', 'ADAN CARTAGENA', '2026-03-16 11:33:36'),
(289, 14299632, 'VERONICA ', 'NAPOLITANO', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16 13:41:41'),
(290, 3191519, 'maria soledad', 'rosales ', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16 13:51:48'),
(291, 12880192, 'JOSE LUIS ', 'HUMBRIA CASTILLO', 'Luis Alberto  Olivares CONAPDIS', '2026-03-16 14:37:51'),
(292, 15167158, 'MARCOS  PLINIO ', 'DUGARTE PEÑALOZA', 'Luis Alberto  Olivares CONAPDIS', '2026-03-17 09:38:07'),
(293, 13636974, 'Gabriel ', 'Soto', 'YOHANNY TERAN  CONAPDIS', '2026-03-17 10:06:47'),
(294, 5143496, 'Oscar ', 'riera', 'YOHANNY TERAN  CONAPDIS', '2026-03-17 10:11:21'),
(295, 5575875, 'PEDRO OSWALDO', 'RODRIGUEZ CRUZ', 'Luis Alberto  Olivares CONAPDIS', '2026-03-19 09:07:15'),
(296, 6081936, 'RICARDO', 'CASTILLO', 'ADAN CARTAGENA', '2026-03-19 10:43:28'),
(297, 3423317, 'JOSE ', 'GOMEZ', 'ADAN CARTAGENA', '2026-03-19 11:33:55'),
(298, 16227883, 'MARIA CRISTINA ', 'NARVAEZ  DE ROMERO', 'YOHANNY TERAN  CONAPDIS', '2026-03-19 15:36:29'),
(299, 4085757, 'MARIA DEL VALLE ', 'URBANEJA DE  RATIA ', 'Luis Alberto  Olivares CONAPDIS', '2026-03-20 15:26:50'),
(300, 18511929, 'HECTOR  JOSE ', 'CAMPOS SANTAELLA', 'Luis Alberto  Olivares CONAPDIS', '2026-03-23 12:25:59'),
(301, 3074974, 'ADELA', 'TARIBA DE ROCHA', 'Francisco Ibanez', '2026-03-23 14:46:45'),
(302, 6157880, 'OMAR ', 'TABASTA', 'Francisco Ibanez', '2026-03-23 14:54:09'),
(303, 6030036, 'AIDA MARICELA                                 ', 'QUEVEDO', 'Francisco Ibanez', '2026-03-23 15:03:41'),
(304, 6470022, 'HENRRY GABRIEL', 'VILLARROEL VIZCAINO', 'YOHANNY TERAN  CONAPDIS', '2026-03-24 11:53:45'),
(305, 8183568, 'CARLOS   OMAR', 'LOPEZ', 'Luis Alberto  Olivares CONAPDIS', '2026-03-24 12:38:15'),
(306, 6109804, 'ELIZABETH ', 'ARTEAGA', 'Luis Alberto  Olivares CONAPDIS', '2026-03-24 13:37:31'),
(307, 3609914, 'DANIEL', 'LIENDO COLINA', 'Mariangel Amairani Pereira Pantoja ', '2026-03-25 08:54:07'),
(308, 18750389, 'JOSE ALEXANDER', 'CABRITA HERNANDEZ ', 'Luis Alberto  Olivares CONAPDIS', '2026-03-26 09:43:06'),
(309, 37407453, 'ANGEL DAVID', 'MORILLO MORA ', 'Leydy Crespo Conapdis', '2026-03-26 10:05:39'),
(310, 27803002, 'GABRIEL ALBERTO', 'ROJAS ECHEVERRIAS', 'Luis Alberto  Olivares CONAPDIS', '2026-03-26 12:05:21'),
(311, 13515218, 'JULIO CESAR ', 'MICTILCORDERO ', 'Luis Alberto  Olivares CONAPDIS', '2026-04-06 11:29:32'),
(312, 6109467, 'MILAGROS MARISOL ', 'ALARCON TORRES', 'Luis Alberto  Olivares CONAPDIS', '2026-04-08 09:13:20'),
(313, 5595232, 'FLOR DE MARIA', 'GONZALEZ DE CASTRO', 'Francisco Ibanez', '2026-04-08 10:56:36'),
(314, 3252047, 'ALEXY  ANTONIO', 'WETTO', 'Luis Alberto  Olivares CONAPDIS', '2026-04-08 12:21:15'),
(315, 4274948, 'ANA DE LI', 'SANDIA LABRADOR', 'Mariangel Amairani Pereira Pantoja ', '2026-04-08 12:34:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rehabilitaciones`
--

CREATE TABLE `rehabilitaciones` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `status` text DEFAULT '\'inactivo\'',
  `fecha_insertado` timestamp NOT NULL DEFAULT current_timestamp(),
  `por` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rehabilitaciones`
--

INSERT INTO `rehabilitaciones` (`id`, `cedula`, `descripcion`, `status`, `fecha_insertado`, `por`) VALUES
(30, 30165406, 'dsfdgfds', 'activo', '2025-05-06 13:13:06', 30165406);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitidos`
--

CREATE TABLE `remitidos` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `departamento` varchar(5) NOT NULL,
  `coordinacion` varchar(12) DEFAULT NULL,
  `por` text NOT NULL,
  `gerencia_remitente` varchar(5) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` text NOT NULL,
  `statu` text DEFAULT NULL,
  `informe` varchar(2048) DEFAULT NULL,
  `solicitud` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `remitidos`
--

INSERT INTO `remitidos` (`id`, `cedula`, `departamento`, `coordinacion`, `por`, `gerencia_remitente`, `fecha`, `motivo`, `statu`, `informe`, `solicitud`) VALUES
(125, 30000000, '5Logi', '', '30165406', '4Gtno', '2024-12-15', 'Porque quiere un curso', 'Aceptado', NULL, ''),
(126, 1256456, '5Logi', '', '30165406', '4Gtno', '2025-01-21', 'Segun peticion de gerente', 'Aceptado', NULL, 'Silla de ruedas estandar'),
(127, 4692416, '2Atc', '', '18212377', '4Gtno', '2025-02-14', 'silla de ruedas', NULL, '', 'Silla de ruedas estandar'),
(128, 12662749, '2Atc', '', '18212377', '4Gtno', '2025-02-26', 'solicitu de glucometro', NULL, '', 'Glucometro'),
(129, 4188883, '2Atc', '', '18212377', '4Gtno', '2025-03-26', 'ASIGNACION DELBONO JOSEGREGORIO HERNANDEZ ', NULL, '', 'ASIGNACIÓN DEL BONO JOSE GREGORIO HERNANDEZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparacion_artificios`
--

CREATE TABLE `reparacion_artificios` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_reparacion` date DEFAULT NULL,
  `artificio` varchar(10) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `reparacion_artificios`
--

INSERT INTO `reparacion_artificios` (`id`, `cedula`, `fecha_reparacion`, `artificio`, `status`, `descripcion`) VALUES
(6, 13711717, NULL, NULL, NULL, ''),
(18, 12345678, '2002-09-18', 'asda', 'Cita dada', 'asdasdsadsadsa'),
(38, 30165406, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` varchar(5) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
('1adm', 'administrador'),
('2coor', 'Coordinador'),
('3supe', 'Superusuario'),
('4nali', 'Analista'),
('coorA', 'Coordinador de area'),
('coorN', 'Coordinacion nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `descripcion` text NOT NULL,
  `seguimiento` varchar(10) DEFAULT NULL,
  `fecha_seguimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`id`, `cedula`, `descripcion`, `seguimiento`, `fecha_seguimiento`) VALUES
(30, 48758452, 'Se le asigno fecha para venir a buscar el 26-11-2023', NULL, '2023-10-26'),
(31, 13894817, 'aaaa', NULL, '2024-01-09'),
(32, 13894817, 'aaaa', NULL, '2024-02-01'),
(33, 30165406, 'dd', NULL, '2024-02-08'),
(34, 30165406, 'aa', NULL, '2024-02-08'),
(35, 30165406, 'dd', NULL, '2024-02-08'),
(36, 30165406, 'asdad', NULL, '2024-02-08'),
(37, 30165406, 'Solicitud de una regleta con punzon', NULL, '2024-02-08'),
(38, 30165406, 'aa', NULL, '2024-02-08'),
(39, 30165406, 'asdad', NULL, '2024-02-08'),
(40, 67676767, 'asdad', NULL, '2024-02-08'),
(41, 30165406, 'mimi', NULL, '2024-02-08'),
(42, 137117175, 'cualquiera', NULL, '2024-02-08'),
(43, 30165406, 'aua', NULL, '2024-02-14'),
(44, 30165406, 's', NULL, '2024-02-14'),
(45, 8424575, 'esta persona fue atendida atravez del convenido de la mison y la empresa sucre gas', NULL, '2025-02-14'),
(46, 8424575, 'esta persona fue atendida atravez del convenido de la mison y la empresa sucre gas', NULL, '2025-02-14'),
(47, 8424575, 'esta persona fue atendida atravez del convenido de la mison y la empresa sucre gas', NULL, '2025-02-14'),
(48, 8424575, 'esta persona fue atendida atravez del convenido de la mison y la empresa sucre gas', NULL, '2025-02-14'),
(49, 2929513, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(50, 2929513, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(51, 2924229, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(52, 3605666, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(53, 8303365, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(54, 4184459, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(55, 13772495, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(56, 18210098, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(57, 8636544, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(58, 9980488, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(59, 4692308, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(60, 1046565, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(61, 1046565, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(62, 10462058, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(63, 10950457, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(64, 10792919, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(65, 24753523, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(66, 20064934, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(67, 12670978, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(68, 4562051, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(69, 14596035, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(70, 9973719, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(71, 8652636, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(72, 8430868, 'fue atendida por los equipos gracias a los equipos de la FMJGH con la empresa sucre Gas', NULL, '2025-02-21'),
(73, 2924229, 'esta persona fue atendida atreves del convenido de la mison y la empresa sucre gas', NULL, '2025-02-24'),
(74, 2925571, 'atencion de gas domestico', NULL, '2025-02-26'),
(75, 4692182, 'Atención de gas', NULL, '2025-02-26'),
(76, 200264934, 'Atención de gas', NULL, '2025-02-26'),
(77, 9980488, 'Atención de gas', NULL, '2025-02-26'),
(78, 26031317, 'Atención de gas', NULL, '2025-02-26'),
(79, 8647915, 'Atención de gas', NULL, '2025-02-26'),
(80, 2925571, 'Atención de gas', NULL, '2025-02-26'),
(81, 5083520, 'Atendido por gas', NULL, '2025-02-26'),
(82, 8636894, 'Atendido por gas', NULL, '2025-02-26'),
(83, 8642390, 'Atendido por gas', NULL, '2025-02-26'),
(84, 33685946, 'Atendido por gas', NULL, '2025-02-26'),
(85, 18211838, 'Atendido por gas', NULL, '2025-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_infraestructura`
--

CREATE TABLE `servicios_infraestructura` (
  `id` varchar(255) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_infraestructura`
--

INSERT INTO `servicios_infraestructura` (`id`, `nombre`) VALUES
('apertura', 'Apertura de historia medica'),
('asesoria', 'Asesoria o información'),
('entrega', 'Entrega '),
('prueba_marcha', 'Prueba de marcha'),
('solicitud_reparacion', 'Solicitud de reparacion'),
('toma_medidas', 'Toma de medida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_desarrollo`
--

CREATE TABLE `solicitudes_desarrollo` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `solicitud` varchar(10) NOT NULL,
  `fecha_asig` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_encuentro`
--

CREATE TABLE `solicitudes_encuentro` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `solicitud` varchar(10) NOT NULL,
  `fecha_asig` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE `taller` (
  `id` int(11) NOT NULL,
  `fecha_taller` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `actividad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoatencion`
--

CREATE TABLE `tipoatencion` (
  `id` varchar(10) NOT NULL,
  `nombre_atencion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipoatencion`
--

INSERT INTO `tipoatencion` (`id`, `nombre_atencion`) VALUES
('0-aten-coo', ' coordinación estatal\r\n'),
('1-oac', 'Atencion a traves de OAC'),
('10-partic', 'Participante taller'),
('11-partic', 'Participante Encuentro'),
('2-ayudte', 'Entrega Ayuda Tecnica'),
('3-orypro', 'Cita laboratorio ortesis y protesis'),
('4-tomedi', 'Toma Medidas'),
('5-pruebar', 'Prueba artifcio'),
('6-repaart', 'Reparacion Artificio'),
('7-audiom', 'Audiometria'),
('8-rehabili', 'Calibracion de Protesis Auditivas'),
('9-soliproa', 'Solicitud de protesis auditivas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ayuda_tecnica`
--

CREATE TABLE `tipo_ayuda_tecnica` (
  `id` varchar(10) NOT NULL,
  `nombre_tipoayuda` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_ayuda_tecnica`
--

INSERT INTO `tipo_ayuda_tecnica` (`id`, `nombre_tipoayuda`) VALUES
('-bastonRas', 'Baston de rastreo plegable numero 48'),
('-MuletasCa', 'Muletas canadienses adultos'),
('1-silla.r', 'Silla de rueda'),
('1.1-S.E16', 'Silla de rueda ergonómica N16'),
('1.1-S.E18', 'Silla de rueda ergonómica N18'),
('1.2-S.E14', 'Silla de rueda ergonómica N14'),
('1.4-S.R.A.', 'Silla de ruedas reclinable '),
('1.5-SRPE', 'Silla de rueda pediátrica ergonómica'),
('1.6-SRB', 'Silla de rueda bariátricas'),
('1.7-COP', 'Coche ortopédico pediátrico'),
('10-Cola', 'Colchon antiescaras'),
('10-lentes', 'Lentes'),
('11-Coj', 'Cojin antiescaras'),
('11-pañales', 'Pañales'),
('12-Mucp', 'Muletas canadienses pediatricas'),
('12-Pro-aud', 'Protesis auditivas'),
('13-Brpl34', 'Baston de rastreo plegable numero 34'),
('13-Pro-cad', 'Protesis de Cadera'),
('14-Brpl36', 'Baston de rastreo plegable numero 36'),
('14-Pro-rod', 'Protesis de rodilla'),
('15-Brpl38', 'Baston de rastreo plegable numero 38'),
('15-Brpl44', 'Baston de rastreo plegable numero 44'),
('15-Pro-den', 'Protesis Dental'),
('16-Brpl46', 'Baston de rastreo plegable numero 46'),
('18-Brpl50', 'Baston de rastreo plegable numero 50'),
('19-Brpl52', 'Baston de rastreo plegable numero 52'),
('2-muletas', 'Muletas'),
('2-MuletasL', 'Muletas talla L'),
('2-MuletasM', 'Muletas talla M'),
('2-MuletasS', 'Muletas talla S'),
('20-Rglp', 'Regleta con punzon'),
('21-Btrpd', 'Baston de rastreo pediatricos'),
('21-sllm', 'Silla a motor'),
('22-Apm', 'Andadera pediatrica multifuncional'),
('23-Apr', 'Andadera pediatrica con ruedas'),
('25-Anpp', 'Andadera pediatrica posterior'),
('26-Anpf', 'Andadera pediatrica fija'),
('27-Sllc', 'Silla de rueda clinica'),
('28-chorm', 'Coche ortopedico mediano'),
('29-chorg', 'Coche ortopedico grande'),
('3-baston', 'Baston de punto'),
('30-sllsr', 'Silla sanitaria sin ruedas'),
('31-sllsr', 'Silla sanitaria con ruedas'),
('4-baston.p', 'Baston de 4 Puntas'),
('5-ap.audio', 'Aparato de audiometria'),
('6-andadera', 'Andadera adulto fija'),
('7-CamaCli', 'Cama Clinica'),
('8-Grab', 'Grabadora'),
('9-felula', 'Ferula'),
('S/N', 'Sin entrega');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toma_medidas`
--

CREATE TABLE `toma_medidas` (
  `id` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `fecha_medidas` date DEFAULT NULL,
  `medidas` decimal(10,0) DEFAULT NULL,
  `artificio` varchar(10) DEFAULT NULL,
  `codigo_cita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `passwordd` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `gerencia` varchar(5) NOT NULL,
  `rol` varchar(5) NOT NULL,
  `coordinacion` varchar(12) DEFAULT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `profile_photo` varchar(2048) DEFAULT NULL,
  `institucion` text DEFAULT NULL,
  `fecha_creada` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `nombre`, `passwordd`, `email`, `telefono`, `sexo`, `gerencia`, `rol`, `coordinacion`, `bloqueado`, `profile_photo`, `institucion`, `fecha_creada`) VALUES
(3396200, 'Oscar Nieto', '$2y$10$o1ZMfnuQX4dAo9y67iFtReaxMuNUmTaD0aErB.lKw1p6Pu5ZhTpQW', 'nietoo@gmail.com', '04141781283', 'm', '2Atc', '4nali', NULL, 0, NULL, 'fmjgh', '2026-02-26 14:20:54'),
(4676999, 'Prueba Amazonas', '$2y$10$19IMNCUegHpImwyXVzY/iOmLozWeQAzDKD.83SiAMHBuy/aBigDja', 'PruebaAmazonas@gmail.com', '04120183670', 'f', '4Gtno', '2coor', 'C-miran', 0, NULL, 'fmjgh', '2025-02-12 13:24:11'),
(5271019, 'Rosaida Rodriguez Morales', '$2y$10$sc8bfIDEp8P/hIc92If7J.NuJScK/cjGa7cU11wStcx6CI0Yg1cga', 'fmjgh.poa@gmail.com', '04128984684', 'f', '4Gtno', '4nali', NULL, 0, NULL, 'fmjgh', '2025-02-17 14:40:36'),
(5335066, 'Omaira Ibarra', '$2y$10$A72mmq6rTxS39A/fNRsQ7OMnKY7w5IisJ0C0FDIKZQbp9vFT64IT2', 'ojiray2012@gmail.com', '04267705580', 'f', '4Gtno', '2coor', 'C-Dlta', 0, NULL, 'conapdis', '2025-02-12 13:24:11'),
(5760216, 'JOSE JESUS GODOY ARAUJO', '$2y$10$..yst.6xN.XmcyBgs9iFo.l2UQZRUjO9G3xd.knnn2m.jOwNhh2NS', 'TRUJILLO.CONAPDIS@GMAIL.COM', '04120183669', 'm', '4Gtno', '2coor', 'C-Trujillo', 0, NULL, NULL, '2025-02-12 13:24:11'),
(6219863, ' MERLIN DEL CARMEN RODRIGUEZ', '$2y$10$fNTq3uPo2FlINFEYzFIcM.z0oFzUfQTW5Bjw/NgMEz.1qVbfGBYsG', 'REGIONFALCON.MISIONJGH@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-falc', 0, NULL, NULL, '2025-02-12 13:24:11'),
(6401413, 'Dulce Trujillo', '$2y$10$.Yu/0LVPaVc3s7UjnMQUeOmLS72PZVcurVZoQ0e7SzvoJtDeVfBAW', 'dulce.trujillo@gmail.com', '04140136165', 'f', '3Gtnd', '1adm', NULL, 1, NULL, 'fmjgh', '2026-04-30 13:58:30'),
(7872081, 'CARMEN JOSEFINA SUAREZ URDANETA', '$2y$10$g1EMrU4ko3P6PpVYgOiGGOlPJ78CFm8HTeLi4QgglLgEoUNYhTHda', 'FMJGHZULIA@gmail.com', '04120183670', 'f', '4Gtno', '2coor', 'C-Zla', 0, NULL, NULL, '2025-02-12 13:24:11'),
(8180312, 'MERIDA YRALI LOPEZ GUEVARA', '$2y$10$hP.Dm/86iQ/Rx2tJfByBRuxueIqNgfUkbbWwn1Aa2XKKSppUtgybm', 'FMJGHBOLIVAR@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Bolv', 0, NULL, NULL, '2025-02-12 13:24:11'),
(8294635, 'SOLANGE CURPA', '$2y$10$WPr0gT1IZLYWT1nLtUHGt..SS/Q4dn8sXPDgh7mbTA2J7sb096YXy', 'FMJGHANZOATEGUI@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Anzo', 0, NULL, NULL, '2025-02-12 13:24:11'),
(8683522, 'Felix Key', '$2y$10$h4aS26vHkLnqw0w9i4qx/uKczncL5LfBqsFtbfj.4mBc0oXndykLW', 'key522@gmail.com', '04267705580', 'm', '4Gtno', '3supe', 'C-Dct', 0, NULL, NULL, '2025-02-12 13:24:11'),
(8836547, 'GLENDA CANTILLO ', '$2y$10$INNhy0rTt55Oj3imKTZ4Du78xiFyHXqPhFgS4ryInov/wMy0PnJLW', 'FMJGHCARABOBO@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Cbb', 0, NULL, NULL, '2025-02-12 13:24:11'),
(11378442, 'Erika Jimenes ', '$2y$10$L1H2grBN2cSBl5XiTtS46.zOt/EsmXLPW2QJNahK0vpq2rzRiU4qm', 'erikajgh2@gmail.com', '04242052810', 'f', '2Atc', '1adm', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(11692632, 'Isabel Ramirez', '$2y$10$tplfcT/jplIE.NhdGVUkxOPaJgRJ9ussKdl1FhpdP6pJWTf9KY3Xi', 'ramirezisab2210@gmail.com', '04128856803', 'f', '2Atc', '4nali', NULL, 0, NULL, 'conapdis', '2026-01-21 15:26:57'),
(11786348, 'JORGE MONTERO', '$2y$10$UFu/Z/9sNDBKFkimjqTZ9OFE9BJNvXKbS59uTtVfKdTCQVFTb/fx2', 'LARAFMJGH@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-lar', 0, NULL, NULL, '2025-02-12 13:24:11'),
(12094532, 'Marlene Araujo CONAPDIS', '$2y$10$EmjEl/jrge.8ovC99h44ZurK.qsYKOKRn8IxQtXIOc4HR67piiP5.', 'marlenearaujoquin@gmail.com', '04126369168', 'f', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(12214993, 'Cruz Del Valle', '$2y$10$6s1gsID0JZ/G8GonFm/i0uOqiBXsk.wo4yvgiH9gKOORr1syBH3Ua', 'cruzmarca123@gmil.com', '04241915336', 'f', '4Gtno', '4nali', 'C-sucr', 0, NULL, 'fmjgh', '2025-02-26 15:14:05'),
(12356458, 'tag', '$2y$10$DUhtCyo7ZsbBGMlruoQ8q.onH6oOtkA2bdUcVDdmctHoReAaqgd5e', 'tag@gmail.com', '04120183670', 'm', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(12728049, 'FABRICIO FIGUEREDO', '$2y$10$HFihv/SpgoRblz6AIu0V4OmlWB/E1NKQX6WlJKyTfnVzMRIBkFG7W', 'FMJGH.BARINAS1@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-Bar', 0, NULL, NULL, '2025-02-12 13:24:11'),
(13058552, 'Leomar Alberto Mata Betancourt', '$2y$10$M2MNGJtk37qNF7k5ibUW6OZrGc2lqcKU6DKmcVgfkd0Paot8MaS3S', 'leomarmate@gmail.com', '04121790995', 'm', '4Gtno', '4nali', 'C-miran', 0, NULL, 'fmjgh', '2025-03-24 17:59:47'),
(13458141, 'Maria Monterola', '$2y$10$lZtd1AG//fYiGtUUlcc0Re9qDkSHnuGZ3NfDzUxozK6.DgLVoewZ.', 'mariale.monterola@gmail.com', '04265102772', 'f', '4Gtno', '1adm', 'C-sucr', 0, NULL, 'fmjgh', '2025-07-29 18:51:31'),
(13711717, 'Administrador OP', '$2y$10$S6dKkR2C00YXlRMMYlOF.ODV3bDFlRg3gWtPT8mJxuCUpZZ8VxWV6', 'deiker1842@gmail.com', '04120183670', 'm', '4Gtno', '1adm', 'C-Dct', 0, NULL, 'fmjgh', '2025-02-12 13:24:11'),
(13908781, 'OSWALDO APONTE', '$2y$10$XNFfhn33/xtL1LnXi/KRT.DhPXJ2F7kFElHpuQ80/wnmj1jYQSEVW', 'FMJGHLAGUAIRA@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-Lguai', 0, NULL, NULL, '2025-02-12 13:24:11'),
(13985230, 'ARELIS ZALAZAR', '$2y$10$PIesbf9J8ECx5qTsP7a80eThdhxYqkHfpjl/aEGF2IYp78mGMt5QO', 'FMJGHYARACUY@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Yarac', 0, NULL, NULL, '2025-02-12 13:24:11'),
(14033947, 'ADAN CARTAGENA', '$2y$10$tCwU.n6/xekOaRZdrMjX5u/7oQ3eNEvlW2a4oSp485nRxOuBE7SBm', 'YSIDRO.ADAN@GMAIL.COM', '04128273068', 'm', '2Atc', '1adm', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(14035068, 'Analista', '$2y$10$s/Z.PXPV/MEWL67vTGSY0eI6bbJwDWjSJNCswWDSkZh0UOjmqK6p2', 'analista@gmail.com', '04120183670', 'm', '4Gtno', '4nali', 'C-amaz', 0, NULL, 'fmjgh', '2025-02-12 13:24:11'),
(14035069, 'Coordinador', '$2y$10$ptWCKWyuMMbYilPReSu8cuGuxfGATHIylglbelQtSZ809IGiIuWme', 'deiker1842@gmail.com', '04120183670', 'm', '4Gtno', '2coor', 'C-amaz', 0, NULL, 'fmjgh', '2025-02-12 13:24:11'),
(14054729, 'RAMON ENRIQUE GONZALEZ LOPEZ', '$2y$10$TYex.N3YM7rbdGAQEC5L8eLYBrSyzeEC0ee06mgjbP4xpUJBtP4UW', 'NUEVAESPARTA.CONAPDIS@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-Nva-es', 0, NULL, NULL, '2025-02-12 13:24:11'),
(14614716, 'FRANKLIN SALAS ', '$2y$10$95fp3LGzcbGemy5V3yrYYeMPLkMA1h3m.wUGBXqU7Z2O49ZuMMbJ.', 'REGIONCOJEDES.FMJGH@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-Coj', 0, NULL, NULL, '2025-02-12 13:24:11'),
(14838761, 'Luis Alberto  Olivares CONAPDIS', '$2y$10$VqHph9JFq4mcAZvNBomkr.DnzLTfRr5iH.yZsETVzby9kYghPhctO', 'laluisolivares1580@gmail.com', '04125482655', 'm', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(15113742, 'David Jose', '$2y$10$YgOsQL6E.DOizU8J27Xo2eF2q4crBARJztnB5F1CI1EBpWTlz8CN.', 'camacarodavid750@gmail.com', '04262450499', 'm', '4Gtno', '4nali', 'C-sucr', 0, NULL, 'fmjgh', '2025-02-26 15:39:54'),
(15186731, 'Laura Beatriz Pinto Hernandez', '$2y$10$IUyo6w899b5EU7KggZF4O.qKGXdTubHl/LorCLHguZU8kd42St1Aq', 'pintohernandezlaurabeatriz@gmail.com', '04160330266', 'm', '4Gtno', '4nali', 'C-sucr', 0, NULL, 'fmjgh', '2025-02-17 15:06:18'),
(15621127, 'ADRIAN DAVID RODRIGUEZ', '$2y$10$5xw832dH0ZvvphbfB/o.NuhY18W4NIL.m/ujBJhJGo7I2x8z3gf4S', 'merida2023fmjgh@gmail.com', '04120183670', 'm', '4Gtno', '2coor', 'C-merid', 0, NULL, NULL, '2025-02-12 13:24:11'),
(16598577, 'Jeanne Nava', '$2y$10$GeWU8xO.A1mf7VKswXMkKOz.ghv.Rbr0iQfyQa60otGyoIKDloJYa', 'ing.jeannenava@gmail.com', '04265189725', 'm', '4Gtno', '3supe', 'C-Dct', 0, NULL, NULL, '2025-02-12 13:24:11'),
(16751291, 'ANDY JAVIER SUAREZ ', '$2y$10$AgkfuMU5qE3qPZG20JsJK.ESY8Y7NW.uEioZlOarrrXfop9ugzF6G', 'FMJGHPORTUGUESA@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-port', 0, NULL, NULL, '2025-02-12 13:24:11'),
(16902651, 'Leydy Crespo Conapdis', '$2y$10$VkRnP6N5nyEetbtkWBcZ1ugkQLJjGb6sXBqT0APSARXe5C7C4huiW', 'dayana23crespo@gmail.com', '04126125536', 'f', '2Atc', '1adm', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(17120132, 'Aris Meralys Diaz Urrutia', '$2y$10$wf.Or1dUtm86sAlGnmsYR.31RLtEWic7EL7LjBK7ett9oZAEFinvG', 'fundacionjgh01@gmail.com', '04241561177', 'f', '5Logi', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(17120137, 'Aris Diaz', '$2y$10$ayEbi4naqI4NM8OHaLu5ReCodG/GctXQx6YZcP7dNuiUP2.X447VO', 'medicinageneraljgh@gmail.com', '04241561177', 'f', '5Logi', '4nali', NULL, 0, NULL, 'fmjgh', '2025-04-02 14:30:58'),
(17240163, 'GREGORIA YDROGO', '$2y$10$u34RKTfWuoHiu08cNbhaA.Kj.mwisufanzX4xOaOv/N.Gxx30H2OS', 'FMJGHMONAGAS1@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-monag', 0, NULL, NULL, '2025-02-12 13:24:11'),
(17646043, 'MARILYN ISABEL VERA DE BOTELLO', '$2y$10$CX3LsmKr.oyYYMxw6LxSMugY3VEgYPYdhlthRgWxi/q9QsvdkhYQ6', 'FMJGHTACHIRA@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-tach', 0, NULL, NULL, '2025-02-12 13:24:11'),
(18022997, 'FABRICIO JOSE SALAZAR CRESPO', '$2y$10$h9aSYiuauYFGhf0S5MKFLu4q6495LMG6pX5hNil2ITXn40ANp.sze', 'FMJGHDISTRITOCAPITAL@GMAIL.COM', '04120183668', 'm', '4Gtno', '2coor', 'C-Dct', 0, NULL, NULL, '2025-02-12 13:24:11'),
(18210787, 'Ivan Jose ', '$2y$10$7TmUQLEW1G3G0pxeP2t0oep5z5xghrB4z.pjUyMxsQ9t6iHIh15Re', 'duranivan008@gmail.com', '04124988284', 'm', '4Gtno', '4nali', 'C-sucr', 0, NULL, 'fmjgh', '2025-02-24 13:48:56'),
(18212377, 'JOSE MARQUEZ', '$2y$10$6Xx36nbg9.wi2MMCQIBGbu/DTBXVCYsUykqg4kKBXVlshTWPE86jC', 'FMJGHSUCRE@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-sucr', 0, NULL, NULL, '2025-02-12 13:24:11'),
(18728216, 'Jairo Forero', '$2y$10$ljtzvj9QbWffd7zssE01buI/5yGWhXUN7oir3htr70GeHYFlfDJCW', 'eliasj.forero@gmail.com', '04120172764', 'm', '3Gtnd', '1adm', NULL, 0, NULL, 'fmjgh', '2026-04-30 15:40:05'),
(19266038, 'KERVIN REINA', '$2y$10$Lw57vFNIATJXPOSh9UZQYeW.NMHXgPmNK9ZoOZygepZPpb9bMZlBS', 'FMJGHGUARICO@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-guar', 0, NULL, NULL, '2025-02-12 13:24:11'),
(19437797, 'Taimara Teran', '$2y$10$nBDdTBbCCRLkdlTXRZzoJOncQhOsBahARMLnoflYF.P4oWi4st.Xy', 'anzoategui.conapdis@gmail.com', '04267705580', 'f', '4Gtno', '2coor', 'C-Anzo', 0, NULL, 'conapdis', '2025-02-12 13:24:11'),
(19470290, 'LILIANA  OROZCO ', '$2y$10$xQK46cO062tJn875xDlO1e8btbVjL1X.koEj.Mhea6iYLZ5RSo/u2', 'APURE.FMJGH@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Apu', 0, NULL, NULL, '2025-02-12 13:24:11'),
(20120779, 'yohailix patricia salcedo medina', '$2y$10$4DnHG5PZORlTxlOeWSSFneYq2dBfiXyApeY4s0a9BMW2LWKEVEVpG', 'yohailixsalcedo@gmail.com', '04247141870', 'f', '4Gtno', '4nali', 'C-tach', 0, NULL, 'fmjgh', '2025-02-12 13:24:11'),
(20825903, 'Mariangel Amairani Pereira Pantoja ', '$2y$10$desXRwV1UhoEZsD9pmWQLeJMVBW4f3q4aqCFL8E2242ghIm7m3FiK', 'mariangel26012018@gmail.com', '04149166637', 'm', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(21204417, 'YARIBETH YORSELYN BONACI RODRIGUEZ', '$2y$10$/lnblV0KvF3dTIJi17aKju0Lm/GKeCEklvw4kiP8Yd/d29/Fy.pcm', 'FMJGHARAGUA@GMAIL.COM', '04120183670', 'f', '4Gtno', '2coor', 'C-Arag', 0, NULL, NULL, '2025-02-12 13:24:11'),
(21549517, 'JOSE GREGORIO ROJAS', '$2y$10$I3DZMexhOnkhYxhpVWsAe.m5TJ4klyLRswmLG9CgvaKOUzOsuCpju', 'AMAZONASFMJGH0103@GMAIL.COM', NULL, 'm', '4Gtno', '2coor', 'C-amaz', 0, NULL, NULL, '2025-02-12 13:24:11'),
(22038114, 'Paola Sanchez CONAPDIS', '$2y$10$CsX7J1odhk0esYP25yRDCOoDXdEIwdun9UyrJ/cv991Nd.BCHLTsy', 'paolasancheztrejos23@gmail.com', '04120192211', 'f', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(22200486, 'ELIEZER ALEJANDRO COLMENAREZ', '$2y$10$/9kr33o7CaEuJts9d0BEfOXXiIhD1Vz7BztZUAFlIEdSYkRgIWmDi', 'FMJGHMIRANDA@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-miran', 0, NULL, NULL, '2025-02-12 13:24:11'),
(22530676, 'Yurielvis Marian Gomez Rodriguez CONAPDIS', '$2y$10$o0/juKW8fBfHx4L..MDrCuXCYY4S8urOBp53L9tFvfK1hhkzbD1QG', 'yurielvis.2016@gmail.com', '04142706941', 'f', '2Atc', '2coor', NULL, 0, '672b819e6d3ff.jpg', NULL, '2025-02-12 13:24:11'),
(22694077, 'Joel gil', '$2y$10$0qa/L5Q9usQoN.oM64AE6uNsoZXtI5G7AXu7cioHXKQxfI9XE0H4G', 'joelanto.91@gmail.com', '04242654264', 'm', '2Atc', '4nali', NULL, 0, NULL, 'conapdis', '2026-01-21 15:22:14'),
(22892583, 'YOHANNY TERAN  CONAPDIS', '$2y$10$Ab0CqXu9a1fcvSARkZsqIukVbAdgvuB1ZfT13vLVZLXoxUi8DouY2', 'YOHANNYTERAN73@GMAIL.COM', '04168171780', 'f', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(24118205, 'LUIS MIGUEL VELASQUEZ RODRIGUEZ', '$2y$10$9J/TdxjCZTL.5qWfzUBtH.IpJAmIyikk1CCEms0ZbkMuzY8XZAX3i', 'REGIONDELTAAMACURO.FMJGH@GMAIL.COM', '04120183670', 'm', '4Gtno', '2coor', 'C-Dlta', 0, NULL, NULL, '2025-02-12 13:24:11'),
(25032291, 'Yeselim Perez', '$2y$10$EQcdo/W5Sfm.OJdCn9hiC.T77ibD1Mzn.5yqCh95PvzfhzFeJdN.O', 'jghmision@gmail.com', '04143140477', 'f', '5Logi', '4nali', NULL, 0, NULL, 'fmjgh', '2025-06-11 15:48:10'),
(27659846, 'Cesar D Crespo Lopez', '$2y$10$7Tr5XrE6hDBoRP2XIkXojekwvfbEB8TAVRsxbx06cQyaykG6iV0HO', 'cesarcespo@gmail.com', '04242765212', 'm', '5Logi', '1adm', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(28058907, 'Fabiana  Dakeisy Mejias Rodriguez', '$2y$10$Xz2YJ2RFnzVd66.8Jf1K/OQUpMntt8a1VXqJBSZXUdAKhB9HVXH/i', 'fabiestefan1001rodriguez@gmail.com', '04269477700', 'f', '2Atc', '4nali', NULL, 0, NULL, 'fmjgh', '2026-05-12 15:49:49'),
(28484435, 'Gerardo', '$2y$10$yVNSeXZG/y9vzDZXxBEmF..RFHZ/RTUfKlHfLYhtt7IClYM2BSK62', 'torresanibal388@gmail.com', '04129058612', 'm', '4Gtno', '2coor', 'C-Bolv', 0, NULL, NULL, '2025-02-12 13:24:11'),
(30165406, 'Deiker Fernandez', '$2y$10$n.LdDWlFIZXC3Zz8nooLku4PLkDdbUR/KCtTfkKd2MvjZyxcRpz5m', 'deiker1842@gmail.com', '04120183670', 'm', '4Gtno', '3supe', 'C-Dct', 0, '65f06739d6d22.png', 'fmjgh', '2025-02-12 13:24:11'),
(30165407, 'Prueba OAC', '$2y$10$ISYhGw6F7AF3KuR/dOMeDerWb77QGm7.4cNAQaEBPAT6FH1yyxc6e', 'de184@gmail.com', '04120183670', 'm', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11'),
(30708925, 'Jeanny Ramos', '$2y$10$4O0hnKTm8MSqfwnTjjXsO.y6RTTnO3dL9axIUFVERA2LgoOY4xhsy', 'jeanniramos77@gmail.com', '04262636692', 'f', '2Atc', '4nali', NULL, 0, NULL, 'fmjgh', '2026-05-14 17:53:15'),
(33398163, 'Wilmary Alexandra Montes Arnal', '$2y$10$fPH6HrgVrc7zNTZafSxTsOFJV0W8WC6CdM2H/YBIwMgrefRDnJs.C', 'wilmarytamontes@gmail.com', '04269477000', 'f', '2Atc', '4nali', NULL, 0, NULL, 'fmjgh', '2026-05-12 15:40:57'),
(83752749, 'Francisco Ibanez', '$2y$10$eiaP0gr//0lTfvdoJA/YyeN7VWZOFN6CcCpdU2W8BIIZqt47Dp45C', 'franksib123@gmail.com', '04122007768', 'm', '2Atc', '2coor', NULL, 0, NULL, NULL, '2025-02-12 13:24:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artificios`
--
ALTER TABLE `artificios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `atenciones`
--
ALTER TABLE `atenciones`
  ADD PRIMARY KEY (`numero_aten`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `atencion_recibida` (`atencion_recibida`),
  ADD KEY `atencion_brindada` (`atencion_brindada`),
  ADD KEY `por` (`por`),
  ADD KEY `asignado` (`asignado`);

--
-- Indices de la tabla `atenciones_coordinaciones`
--
ALTER TABLE `atenciones_coordinaciones`
  ADD PRIMARY KEY (`numero_aten`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `atencion_recibida` (`atencion_recibida`),
  ADD KEY `atencion_brindada` (`atencion_brindada`),
  ADD KEY `por` (`por`),
  ADD KEY `asignado` (`asignado`);

--
-- Indices de la tabla `atenciones_laboratorios`
--
ALTER TABLE `atenciones_laboratorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`,`laboratorio`,`tipo`),
  ADD KEY `laboratorio` (`laboratorio`),
  ADD KEY `atenciones_laboratorios_ibfk_3` (`tipo`),
  ADD KEY `artificio_protesis` (`artificio_protesis`),
  ADD KEY `artificio_ortesis` (`artificio_ortesis`);

--
-- Indices de la tabla `atencion_recibida`
--
ALTER TABLE `atencion_recibida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `atencion_solicitada`
--
ALTER TABLE `atencion_solicitada`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `audiometria`
--
ALTER TABLE `audiometria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rehabilitacion` (`rehabilitacion`);

--
-- Indices de la tabla `ayudas_tec`
--
ALTER TABLE `ayudas_tec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_ayuda_tec` (`tipo_ayuda_tec`,`cedula`),
  ADD KEY `ayudas_tec_ibfk_1` (`cedula`);

--
-- Indices de la tabla `bancosvzla`
--
ALTER TABLE `bancosvzla`
  ADD PRIMARY KEY (`id-banco`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `estado` (`estado`),
  ADD KEY `discapacidad` (`discapacidad`),
  ADD KEY `atencion_solicitada` (`atencion_solicitada`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `parroquia` (`parroquia`);

--
-- Indices de la tabla `ben_eliminados`
--
ALTER TABLE `ben_eliminados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caracteristicas_protesis`
--
ALTER TABLE `caracteristicas_protesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_cita` (`id_historia`),
  ADD KEY `id_historia` (`id_historia`);

--
-- Indices de la tabla `cita_ortesis_protesis`
--
ALTER TABLE `cita_ortesis_protesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laboratorio` (`laboratorio`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `conapdis_beneficiarios`
--
ALTER TABLE `conapdis_beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_cedula` (`cedula`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `idx_fecha_registro` (`fecha_registro`);

--
-- Indices de la tabla `conapdis_documentos`
--
ALTER TABLE `conapdis_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_beneficiario` (`beneficiario_id`);

--
-- Indices de la tabla `coordinaciones_estadales`
--
ALTER TABLE `coordinaciones_estadales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipio` (`municipio`);

--
-- Indices de la tabla `copiascedula`
--
ALTER TABLE `copiascedula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_cuidador`
--
ALTER TABLE `detalles_cuidador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `detalles_emprendimiento`
--
ALTER TABLE `detalles_emprendimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `detalles_institucionales`
--
ALTER TABLE `detalles_institucionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `discapacid`
--
ALTER TABLE `discapacid`
  ADD PRIMARY KEY (`id_disca`);

--
-- Indices de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `discapacid_e`
--
ALTER TABLE `discapacid_e`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `general` (`general`);

--
-- Indices de la tabla `encuentros`
--
ALTER TABLE `encuentros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado` (`estado`,`municipio`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `parroquia` (`parroquia`),
  ADD KEY `gerencia` (`gerencia`);

--
-- Indices de la tabla `escuela_comunitaria`
--
ALTER TABLE `escuela_comunitaria`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `estado` (`estado`,`municipio`,`parroquia`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `parroquia` (`parroquia`),
  ADD KEY `gerencia` (`gerencia`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estados`);

--
-- Indices de la tabla `estado_muñon`
--
ALTER TABLE `estado_muñon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_cita` (`id_historia`),
  ADD KEY `id_historia` (`id_historia`);

--
-- Indices de la tabla `familiaresoac`
--
ALTER TABLE `familiaresoac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atencion` (`id_atencion`);

--
-- Indices de la tabla `gerencia`
--
ALTER TABLE `gerencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_reparaciones_beneficiarios`
--
ALTER TABLE `historial_reparaciones_beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cita_reparacion` (`id_cita_reparacion`);

--
-- Indices de la tabla `historia_medica`
--
ALTER TABLE `historia_medica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `artificio` (`artificio`),
  ADD KEY `codigo_cita` (`codigo_cita`);

--
-- Indices de la tabla `historia_medica_protesis`
--
ALTER TABLE `historia_medica_protesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_munon` (`estado_munon`,`caracteristicas_pro`),
  ADD KEY `codigo_cita` (`codigo_cita`),
  ADD KEY `caracteristicas_pro` (`caracteristicas_pro`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `informes_medicos`
--
ALTER TABLE `informes_medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `intentos_sesion`
--
ALTER TABLE `intentos_sesion`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `estado` (`estado`),
  ADD KEY `parroquia` (`parroquia`),
  ADD KEY `gerencia` (`gerencia`),
  ADD KEY `coordinacion` (`coordinacion`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `modificaciones_beneficiarios`
--
ALTER TABLE `modificaciones_beneficiarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos_escuela`
--
ALTER TABLE `modulos_escuela`
  ADD PRIMARY KEY (`modulo`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`,`estado_id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipios`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atencion` (`id_atencion`);

--
-- Indices de la tabla `orientaciones`
--
ALTER TABLE `orientaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `por` (`por`);

--
-- Indices de la tabla `ortesis`
--
ALTER TABLE `ortesis`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipio` (`municipio`);

--
-- Indices de la tabla `participante_curso`
--
ALTER TABLE `participante_curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participante_encuentro`
--
ALTER TABLE `participante_encuentro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taller` (`encuentro`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `discapacidad` (`discapacidad`);

--
-- Indices de la tabla `participante_escuela`
--
ALTER TABLE `participante_escuela`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `discapacidad` (`discapacidad`),
  ADD KEY `estado` (`estado`,`municipio`,`parroquia`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `parroquia` (`parroquia`);

--
-- Indices de la tabla `participante_taller`
--
ALTER TABLE `participante_taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taller` (`taller`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `partida_nacimiento`
--
ALTER TABLE `partida_nacimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `personas_jornadas`
--
ALTER TABLE `personas_jornadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ayuda_tecnica` (`ayuda_tecnica`,`numero_jornada`),
  ADD KEY `discapacidad` (`discapacidad`),
  ADD KEY `numero_jornada` (`numero_jornada`);

--
-- Indices de la tabla `protesis`
--
ALTER TABLE `protesis`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba_artificios`
--
ALTER TABLE `prueba_artificios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `artificio_prueba` (`artificio_prueba`);

--
-- Indices de la tabla `reg_beneficiario`
--
ALTER TABLE `reg_beneficiario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rehabilitaciones`
--
ALTER TABLE `rehabilitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `por` (`por`);

--
-- Indices de la tabla `remitidos`
--
ALTER TABLE `remitidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `gerencia_remitente` (`gerencia_remitente`),
  ADD KEY `coordinacion` (`coordinacion`);

--
-- Indices de la tabla `reparacion_artificios`
--
ALTER TABLE `reparacion_artificios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `servicios_infraestructura`
--
ALTER TABLE `servicios_infraestructura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_desarrollo`
--
ALTER TABLE `solicitudes_desarrollo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `solicitud` (`solicitud`);

--
-- Indices de la tabla `solicitudes_encuentro`
--
ALTER TABLE `solicitudes_encuentro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `solicitud` (`solicitud`);

--
-- Indices de la tabla `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado` (`estado`,`municipio`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `parroquia` (`parroquia`);

--
-- Indices de la tabla `tipoatencion`
--
ALTER TABLE `tipoatencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_ayuda_tecnica`
--
ALTER TABLE `tipo_ayuda_tecnica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `toma_medidas`
--
ALTER TABLE `toma_medidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `codigo_cita` (`codigo_cita`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `gerencia` (`gerencia`),
  ADD KEY `rol` (`rol`),
  ADD KEY `coordinacion` (`coordinacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atenciones`
--
ALTER TABLE `atenciones`
  MODIFY `numero_aten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT de la tabla `atenciones_coordinaciones`
--
ALTER TABLE `atenciones_coordinaciones`
  MODIFY `numero_aten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT de la tabla `atenciones_laboratorios`
--
ALTER TABLE `atenciones_laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `atencion_solicitada`
--
ALTER TABLE `atencion_solicitada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8485;

--
-- AUTO_INCREMENT de la tabla `audiometria`
--
ALTER TABLE `audiometria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `ayudas_tec`
--
ALTER TABLE `ayudas_tec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `ben_eliminados`
--
ALTER TABLE `ben_eliminados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `caracteristicas_protesis`
--
ALTER TABLE `caracteristicas_protesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cita_ortesis_protesis`
--
ALTER TABLE `cita_ortesis_protesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de la tabla `conapdis_beneficiarios`
--
ALTER TABLE `conapdis_beneficiarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conapdis_documentos`
--
ALTER TABLE `conapdis_documentos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `copiascedula`
--
ALTER TABLE `copiascedula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `detalles_cuidador`
--
ALTER TABLE `detalles_cuidador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT de la tabla `detalles_emprendimiento`
--
ALTER TABLE `detalles_emprendimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `detalles_institucionales`
--
ALTER TABLE `detalles_institucionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23304;

--
-- AUTO_INCREMENT de la tabla `encuentros`
--
ALTER TABLE `encuentros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `escuela_comunitaria`
--
ALTER TABLE `escuela_comunitaria`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25422;

--
-- AUTO_INCREMENT de la tabla `estado_muñon`
--
ALTER TABLE `estado_muñon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `familiaresoac`
--
ALTER TABLE `familiaresoac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historial_reparaciones_beneficiarios`
--
ALTER TABLE `historial_reparaciones_beneficiarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_medica`
--
ALTER TABLE `historia_medica`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `historia_medica_protesis`
--
ALTER TABLE `historia_medica_protesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `informes_medicos`
--
ALTER TABLE `informes_medicos`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modificaciones_beneficiarios`
--
ALTER TABLE `modificaciones_beneficiarios`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `modulos_escuela`
--
ALTER TABLE `modulos_escuela`
  MODIFY `modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=519420467;

--
-- AUTO_INCREMENT de la tabla `orientaciones`
--
ALTER TABLE `orientaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ortesis`
--
ALTER TABLE `ortesis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `participante_curso`
--
ALTER TABLE `participante_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participante_encuentro`
--
ALTER TABLE `participante_encuentro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `participante_taller`
--
ALTER TABLE `participante_taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `partida_nacimiento`
--
ALTER TABLE `partida_nacimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas_jornadas`
--
ALTER TABLE `personas_jornadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `protesis`
--
ALTER TABLE `protesis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `prueba_artificios`
--
ALTER TABLE `prueba_artificios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reg_beneficiario`
--
ALTER TABLE `reg_beneficiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT de la tabla `rehabilitaciones`
--
ALTER TABLE `rehabilitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `remitidos`
--
ALTER TABLE `remitidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `reparacion_artificios`
--
ALTER TABLE `reparacion_artificios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `solicitudes_desarrollo`
--
ALTER TABLE `solicitudes_desarrollo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitudes_encuentro`
--
ALTER TABLE `solicitudes_encuentro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `toma_medidas`
--
ALTER TABLE `toma_medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atenciones`
--
ALTER TABLE `atenciones`
  ADD CONSTRAINT `atenciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_ibfk_2` FOREIGN KEY (`atencion_recibida`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `atenciones_ibfk_3` FOREIGN KEY (`atencion_brindada`) REFERENCES `atencion_recibida` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_ibfk_4` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_ibfk_5` FOREIGN KEY (`asignado`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE;

--
-- Filtros para la tabla `atenciones_coordinaciones`
--
ALTER TABLE `atenciones_coordinaciones`
  ADD CONSTRAINT `atenciones_coordinaciones_ibfk_1` FOREIGN KEY (`atencion_recibida`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atenciones_coordinaciones_ibfk_2` FOREIGN KEY (`atencion_brindada`) REFERENCES `atencion_recibida` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_coordinaciones_ibfk_3` FOREIGN KEY (`asignado`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atenciones_coordinaciones_ibfk_4` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atenciones_coordinaciones_ibfk_5` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `atenciones_laboratorios`
--
ALTER TABLE `atenciones_laboratorios`
  ADD CONSTRAINT `atenciones_laboratorios_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_laboratorios_ibfk_2` FOREIGN KEY (`laboratorio`) REFERENCES `laboratorios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atenciones_laboratorios_ibfk_3` FOREIGN KEY (`tipo`) REFERENCES `servicios_infraestructura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atenciones_laboratorios_ibfk_4` FOREIGN KEY (`artificio_protesis`) REFERENCES `protesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atenciones_laboratorios_ibfk_5` FOREIGN KEY (`artificio_ortesis`) REFERENCES `ortesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `audiometria`
--
ALTER TABLE `audiometria`
  ADD CONSTRAINT `audiometria_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`rehabilitacion`) REFERENCES `rehabilitaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD CONSTRAINT `beneficiario_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiario_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiario_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beneficiario_ibfk_4` FOREIGN KEY (`discapacidad`) REFERENCES `discapacid_e` (`id_e`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiario_ibfk_5` FOREIGN KEY (`atencion_solicitada`) REFERENCES `tipoatencion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `caracteristicas_protesis`
--
ALTER TABLE `caracteristicas_protesis`
  ADD CONSTRAINT `caracteristicas_protesis_ibfk_1` FOREIGN KEY (`id_historia`) REFERENCES `historia_medica_protesis` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cita_ortesis_protesis`
--
ALTER TABLE `cita_ortesis_protesis`
  ADD CONSTRAINT `cita_ortesis_protesis_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `cita_ortesis_protesis_ibfk_2` FOREIGN KEY (`laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `copiascedula`
--
ALTER TABLE `copiascedula`
  ADD CONSTRAINT `copiascedula_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_cuidador`
--
ALTER TABLE `detalles_cuidador`
  ADD CONSTRAINT `detalles_cuidador_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_emprendimiento`
--
ALTER TABLE `detalles_emprendimiento`
  ADD CONSTRAINT `detalles_emprendimiento_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_institucionales`
--
ALTER TABLE `detalles_institucionales`
  ADD CONSTRAINT `detalles_institucionales_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `discapacid_e`
--
ALTER TABLE `discapacid_e`
  ADD CONSTRAINT `discapacid_e_ibfk_1` FOREIGN KEY (`general`) REFERENCES `discapacid` (`id_disca`) ON DELETE CASCADE;

--
-- Filtros para la tabla `encuentros`
--
ALTER TABLE `encuentros`
  ADD CONSTRAINT `encuentros_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `encuentros_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `encuentros_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `encuentros_ibfk_4` FOREIGN KEY (`gerencia`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `escuela_comunitaria`
--
ALTER TABLE `escuela_comunitaria`
  ADD CONSTRAINT `escuela_comunitaria_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `escuela_comunitaria_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `escuela_comunitaria_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `escuela_comunitaria_ibfk_4` FOREIGN KEY (`gerencia`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `familiaresoac`
--
ALTER TABLE `familiaresoac`
  ADD CONSTRAINT `familiaresoac_ibfk_1` FOREIGN KEY (`id_atencion`) REFERENCES `atenciones` (`numero_aten`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_reparaciones_beneficiarios`
--
ALTER TABLE `historial_reparaciones_beneficiarios`
  ADD CONSTRAINT `historial_reparaciones_beneficiarios_ibfk_1` FOREIGN KEY (`id_cita_reparacion`) REFERENCES `reparacion_artificios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia_medica_protesis`
--
ALTER TABLE `historia_medica_protesis`
  ADD CONSTRAINT `historia_medica_protesis_ibfk_1` FOREIGN KEY (`codigo_cita`) REFERENCES `cita_ortesis_protesis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historia_medica_protesis_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE;

--
-- Filtros para la tabla `informes_medicos`
--
ALTER TABLE `informes_medicos`
  ADD CONSTRAINT `informes_medicos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD CONSTRAINT `jornada_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `jornada_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `jornada_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jornada_ibfk_4` FOREIGN KEY (`gerencia`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jornada_ibfk_5` FOREIGN KEY (`coordinacion`) REFERENCES `coordinaciones_estadales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE;

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`id_atencion`) REFERENCES `atenciones_coordinaciones` (`numero_aten`) ON DELETE CASCADE;

--
-- Filtros para la tabla `participante_encuentro`
--
ALTER TABLE `participante_encuentro`
  ADD CONSTRAINT `participante_encuentro_ibfk_1` FOREIGN KEY (`discapacidad`) REFERENCES `discapacid_e` (`id_e`) ON DELETE CASCADE;

--
-- Filtros para la tabla `participante_escuela`
--
ALTER TABLE `participante_escuela`
  ADD CONSTRAINT `participante_escuela_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `participante_escuela_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `participante_escuela_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participante_escuela_ibfk_4` FOREIGN KEY (`id_curso`) REFERENCES `escuela_comunitaria` (`id_curso`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partida_nacimiento`
--
ALTER TABLE `partida_nacimiento`
  ADD CONSTRAINT `partida_nacimiento_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_jornadas`
--
ALTER TABLE `personas_jornadas`
  ADD CONSTRAINT `personas_jornadas_ibfk_1` FOREIGN KEY (`ayuda_tecnica`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `personas_jornadas_ibfk_2` FOREIGN KEY (`numero_jornada`) REFERENCES `jornada` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rehabilitaciones`
--
ALTER TABLE `rehabilitaciones`
  ADD CONSTRAINT `rehabilitaciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `rehabilitaciones_ibfk_2` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE;

--
-- Filtros para la tabla `remitidos`
--
ALTER TABLE `remitidos`
  ADD CONSTRAINT `remitidos_ibfk_1` FOREIGN KEY (`departamento`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remitidos_ibfk_2` FOREIGN KEY (`gerencia_remitente`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `taller`
--
ALTER TABLE `taller`
  ADD CONSTRAINT `taller_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  ADD CONSTRAINT `taller_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  ADD CONSTRAINT `taller_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `toma_medidas`
--
ALTER TABLE `toma_medidas`
  ADD CONSTRAINT `toma_medidas_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`coordinacion`) REFERENCES `coordinaciones_estadales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`gerencia`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
