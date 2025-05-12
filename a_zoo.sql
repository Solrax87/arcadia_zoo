-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 24-04-2025 a las 17:44:07
-- Versión del servidor: 5.7.39
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `a_zoo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `veterinaire_id` int(11) DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `animaux`
--

INSERT INTO `animaux` (`id`, `nom`, `espece`, `habitat_id`, `veterinaire_id`, `etat`, `date`, `detail`, `image_path`) VALUES
(2, 'Zera', 'Zèbre', 7, 4, NULL, '2025-01-09', 'Super !', 'e4ef7b1896a08589ed16457f79d0435d.jpg'),
(24, 'Lino', 'Lion', 7, 14, NULL, '2025-01-29', '', '3d9b801132e6545c6307b087d01c1b3e.jpg'),
(25, 'Lobito', 'Loup', 10, 3, NULL, '2025-01-15', '', '6411faf7faad597fe3b7f5d534345a16.jpg'),
(26, 'L\'oxxo', 'Ours', 10, 3, NULL, '2025-01-20', '', '28d38525dec8c0f20513c733e2e2b2bc.jpg'),
(27, 'Coco', 'Crocodile', 11, 2, NULL, '2025-01-09', '', '7fb7380667baa916764790491db68e58.jpg'),
(28, 'Hippo', ' hippopotame', 11, 4, NULL, '2025-01-10', '', '2aca0d1fccff835c4913783e9be772bb.jpg'),
(29, 'Veni', 'cerf', 9, 3, NULL, '2025-01-18', '', '377e771d73f0a6765c3c2830890a04ed.jpg'),
(30, 'Babe', 'Sanglier', 9, 4, NULL, '2025-01-22', '', 'e91f4a656dbd5cc4743ecf9bc1559c8d.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habitats`
--

INSERT INTO `habitats` (`id`, `nom`, `description`, `image_path`) VALUES
(7, 'Savane', 'La savane est un écosystème vaste et diversifié, et nos résidents profitent d\'un cadre qui imite fidèlement leur milieu naturel.', 'bb083bbfffb80a95829018832695d369.jpg'),
(9, 'Forêt', 'Les animaux vivent en harmonie avec un environnement qui recrée fidèlement les forêts denses et humides.', '54a50897d4a6399785353b0b4e3841cb.jpg'),
(10, 'Montagne', 'Ici, les animaux résidents s\'épanouissent dans un environnement qui reflète les conditions escarpées et robustes des montagnes.', '15f007651f876bedb52e708f43e35baa.jpg'),
(11, 'Marais', 'Un lieu où la nature aquatique et terrestre se rencontrent harmonieusement. ', 'b778ab23fad50f6a17dd1d11e42ff115.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rapports`
--

CREATE TABLE `rapports` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `animal_id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nourriture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grammage` int(11) DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `veterinaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rapports`
--

INSERT INTO `rapports` (`id`, `date`, `animal_id`, `habitat_id`, `etat`, `nourriture`, `grammage`, `commentaire`, `veterinaire_id`) VALUES
(2, '2025-01-19', 2, 7, 'Parfait état', 'Foin', 8000, 'Très énergique comme d\'habitud', 13),
(3, '2025-01-20', 25, 10, 'Très vigilante ce matin', 'Viande', 5000, 'Vaccination la semaine prochaine ', 13),
(5, '2025-01-10', 24, 7, 'Parfait état', 'Viande', 8000, 'Il dormait beaucoup depuis ce matin', 13),
(6, '2025-01-22', 30, 9, 'Un peu énervé', 'Foin et pommes', 4000, 'Il avait très faim', 13),
(8, '2025-01-20', 26, 10, 'Dors', 'Poissons', 2000, 'Les animaliers sont laissé des poisons en cas de se réveiller.', 13),
(9, '2025-01-21', 26, 10, 'Cool ! 2', 'Poissons', 3000, 'Viens de ce réveiller ', 13),
(10, '2025-01-21', 28, 11, 'Toujours avec beaucoup faim', 'Pasteques ', 20000, 'Il avait une petite blessure à côté de l\'oreille gauche ', 13),
(11, '2025-01-22', 29, 10, 'Il reste tranquille', 'foin', 5000, 'Vaccination fait ', 13),
(12, '2025-01-22', 27, 11, 'Il est très sale du dos', 'Poulet', 6000, 'Il est resté au soleil après avoir mangé ', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('RESTAURATION','ACTIVITÉS EN FAMILLE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `titre`, `type`, `description`, `image_path`) VALUES
(1, 'Petit Train', 'ACTIVITÉS EN FAMILLE', 'Montez à bord de notre Petit Train pour une visite tranquille à travers le zoo, idéale pour découvrir nos animaux sans effort. Parfait pour les familles !', 'f2b48cefb65400eb2748784446bca6ee.jpg'),
(11, 'Balades', 'ACTIVITÉS EN FAMILLE', 'Profitez de nos Balades guidées pour explorer le zoo à pied, en immersion totale dans la nature et près des animaux. Une promenade détente pour tous !', 'f06a126b2a0881a550ad92739dbc837c.jpg'),
(12, 'Spectacles', 'ACTIVITÉS EN FAMILLE', 'Assistez à nos Spectacles captivants mettant en scène des animaux. Un moment inoubliable pour toute la famille, alliant divertissement et découverte !', '5a4364bdad8513a37530a7c3721f21c5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temoignages`
--

CREATE TABLE `temoignages` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` enum('Mmm...','Moyen','Superbe!') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temoignages`
--

INSERT INTO `temoignages` (`id`, `nom_prenom`, `qualification`, `message`, `date`) VALUES
(1, 'Jean Dupont', 'Superbe!', 'C’était une expérience incroyable!', '2025-01-08 17:20:39'),
(2, 'Vincent', 'Mmm...', 'Je ne suis pas sure...', '2025-01-08 17:23:47'),
(3, 'car', 'Superbe!', 'Prueba dos', '2025-01-08 17:32:11'),
(5, 'Carlos', 'Moyen', 'Il manque des choses mais pas mal', '2025-01-08 17:30:43'),
(6, 'Cody', 'Superbe!', 'J\'adore toutes les animaux !', '2025-01-08 17:31:53'),
(12, 'Victor', 'Superbe!', 'J\'adore voir le lion en action !', '2025-01-20 18:39:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('veterinaire','employe','administrateur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `password`, `role`, `created_at`) VALUES
(12, 'Carlos Rodriguez', 'carlos@arcadia.fr', '$2y$10$xOoZh5hOH.xwLsGNCdeLZuO3x5D1G5fVDphrG0/tyPGJcTELHFtsC', 'administrateur', '2025-01-23 13:39:49'),
(13, 'Rodriguez Cody', 'cody@arcadia.fr', '$2y$10$sSO68eEHu/Rvg57.zP0u/ucONgzxd4Hn4yDri82PPSEPAep.GPKDm', 'veterinaire', '2025-01-23 13:49:09'),
(14, 'Djeïla Rodriguez', 'djeila@arcadia.fr', '$2y$10$PkUejqhjWjSZyFw/qaRs/.FXZjyHH2tWnX.WQMhYIIuhjtUs.ThdS', 'employe', '2025-01-24 13:18:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Indices de la tabla `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animaux`
--
ALTER TABLE `animaux`
  ADD CONSTRAINT `animaux_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Filtros para la tabla `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `rapports_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`id`),
  ADD CONSTRAINT `rapports_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
