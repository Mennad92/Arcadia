-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le : jeu. 01 août 2024 à 03:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcadia`
--

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `id_habitat` int(11) NOT NULL,
  `id_race` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `timeDate` text NOT NULL,
  `nourriture` text NOT NULL,
  `gramme` int(11) NOT NULL,
  `avisVeterinaire` text NOT NULL,
  `details_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `prenom`, `id_habitat`, `id_race`, `images`, `descriptions`, `timeDate`, `nourriture`, `gramme`, `avisVeterinaire`, `details_count`) VALUES
(45, 'Mennad', 1, 1, 'https://encrypted-tbn2.gstatic.com/licensed-image?q=tbn:ANd9GcQK0gKnT8PX2oBi7ZCEvJDPnaVdHuQB31xR5cZ6evMlK3bWrvt60PztDCNdF2H1EtcxNi9XP8velWjs2ck', 'Il vole', '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `confirme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `comment`, `confirme`) VALUES
(22, 'Mennad', 'Test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

CREATE TABLE `habitat` (
  `id_habitat` int(11) NOT NULL,
  `habitat_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `accueilImage` text NOT NULL,
  `bg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`id_habitat`, `habitat_name`, `description`, `title`, `image`, `accueilImage`, `bg`) VALUES
(1, 'marais', '<ul class=\"m-2 text-arcadiaSecondary\">\r\n            <li>\r\n                <a class=\"nav-link text-arcadiaTertiary\" href=\"#\"><b>Milieu Aquatique et Terrestre :</b></a> Les marais\r\n                offrent un mélange\r\n                unique d\'environnements aquatiques\r\n                et\r\n                terrestres, ce qui en fait des habitats riches en biodiversité. Les parties aquatiques fournissent des\r\n                ressources alimentaires et des sites de reproduction pour de nombreuses espèces aquatiques, tandis que\r\n                les\r\n                zones terrestres adjacentes offrent des abris et des sites de nidification pour une variété d\'animaux\r\n                terrestres.\r\n            </li>\r\n            <li>\r\n                <a class=\"nav-link text-arcadiaTertiary\" href=\"#\"><b>Biodiversité :</b></a> En raison de leur diversité\r\n                d\'habitats, les\r\n                marais abritent une grande variété\r\n                d\'espèces\r\n                animales, notamment des oiseaux, des poissons, des amphibiens, des reptiles, des mammifères, des\r\n                insectes et\r\n                d\'autres invertébrés. Certains marais sont également des habitats importants pour les espèces en voie de\r\n                disparition ou menacées.\r\n            </li>\r\n\r\n            <li><a class=\"nav-link text-arcadiaTertiary\" href=\"#OisMarais\"><b>Oiseaux Aquatiques : </b></a> Les marais\r\n                sont\r\n                particulièrement\r\n                importants pour les oiseaux aquatiques tels\r\n                que les\r\n                hérons, les aigrettes, les canards et les foulques. Ces oiseaux trouvent des ressources\r\n                alimentaires abondantes dans les eaux peu profondes du marais, comme les poissons, les crustacés, les\r\n                insectes aquatiques et les amphibiens.</li>\r\n            <li>\r\n                <a class=\"nav-link text-arcadiaTertiary\" href=\"#Amphibiens\"><b>Amphibiens et Reptiles:</b></a> Les\r\n                marais\r\n                fournissent des habitats\r\n                vitaux pour de nombreux amphibiens, comme\r\n                les\r\n                grenouilles, les crapauds et les salamandres, ainsi que pour les reptiles tels que les tortues d\'eau et\r\n                les\r\n                serpents aquatiques. Les zones humides du marais offrent des sites de reproduction sécurisés pour ces\r\n                animaux et fournissent également des proies abondantes.\r\n            </li>\r\n            <li>\r\n                <a class=\"nav-link text-arcadiaTertiary\" href=\"#Mammifere\"><b>Mammifères:</b></a> Certains mammifères,\r\n                comme les\r\n                castors, les loutres\r\n                et les ratons laveurs, vivent également\r\n                dans\r\n                les marais. Ces animaux dépendent des ressources alimentaires fournies par les zones humides et\r\n                utilisent\r\n                souvent les roseaux et les autres végétations aquatiques pour construire leurs terriers ou leurs nids.\r\n            </li>\r\n            <li>\r\n                <a class=\"nav-link text-arcadiaTertiary\" href=\"#Insecte\"><b>Insectes et Autres Invertébrés:</b></a> Les\r\n                marais\r\n                abritent une\r\n                multitude d\'invertébrés, y compris des insectes\r\n                comme les libellules, les moustiques, les coléoptères aquatiques et les papillons, ainsi que des\r\n                crustacés\r\n                comme les crevettes d\'eau douce et les crabes. Ces invertébrés jouent un rôle important dans la chaîne\r\n                alimentaire du marais, servant de nourriture à de nombreux autres animaux.\r\n            </li>\r\n\r\n        </ul>\r\n\r\n        <p class=\"my-5 p-5 border-1 border border-arcadiaSecondary rounded mx-auto w-75 fs-5 text-arcadiaSecondary\">En\r\n            résumé, les marais sont des habitats écologiquement importants qui soutiennent une riche diversité\r\n            d\'animaux, allant des oiseaux aquatiques et des amphibiens aux mammifères et aux invertébrés. Leur\r\n            combinaison unique d\'environnements aquatiques et terrestres en fait des zones vitales pour la vie sauvage\r\n            et des écosystèmes précieux à protéger.\r\n        </p>', 'LES MARAIS', 'image/marais2.jpg', 'image/marais.jpg', 'bg-marais'),
(2, 'savane', '\r\nLa savane est l\'un des écosystèmes les plus emblématiques de la planète, caractérisé par de vastes étendues de terres herbeuses parsemées d\'arbres dispersés. Cette région, située principalement dans les régions tropicales et subtropicales, offre un paysage spectaculaire où la faune et la flore se sont adaptées à des conditions environnementales uniques.\r\n\r\nDescription de la Savane :\r\n\r\n1. Paysage : La savane se distingue par ses vastes plaines herbeuses qui s\'étendent à perte de vue, souvent entrecoupées de buissons, de bosquets d\'arbres isolés et de rivières serpentines. Les arbres caractéristiques de la savane, tels que les acacias et les baobabs, parsèment le paysage, offrant des points d\'ombre et des refuges pour la faune.\r\n\r\n2. Climat : La savane est soumise à un climat semi-aride à tropical, caractérisé par des saisons distinctes de pluie et de sécheresse. Pendant la saison des pluies, les plaines verdoyantes s\'animent de couleurs vives et les rivières débordent, créant des zones humides temporaires. En revanche, la saison sèche apporte des températures élevées et des précipitations limitées, ce qui peut entraîner des conditions difficiles pour la vie sauvage.\r\n\r\n3. Faune : La savane abrite une diversité incroyable d\'animaux adaptés à ses vastes étendues ouvertes. Des herbivores emblématiques tels que les éléphants, les girafes, les zèbres et les antilopes se déplacent en troupeaux à la recherche de pâturages frais. Ces grands herbivores attirent également des prédateurs redoutables tels que les lions, les léopards, les guépards et les hyènes, qui chassent souvent en meute pour traquer leurs proies.\r\n\r\n4. Flore : Les plantes de la savane sont adaptées aux conditions de sécheresse et de feu fréquentes. Les herbes hautes et résistantes, telles que les graminées, dominent le paysage et constituent la principale source de nourriture pour de nombreux herbivores. Les arbres de la savane sont souvent dotés de racines profondes et de feuilles épaisses pour conserver l\'eau, tandis que certaines espèces présentent des adaptations uniques, telles que l\'écorce épaisse des baobabs, pour survivre aux conditions arides.\r\n\r\n5. Importance écologique : La savane joue un rôle crucial dans l\'équilibre écologique mondial en abritant une biodiversité riche et en fournissant des services écosystémiques essentiels tels que la régulation des cycles hydrologiques et la séquestration du carbone. De plus, de nombreuses communautés humaines dépendent des ressources naturelles de la savane pour leur subsistance, ce qui souligne l\'importance de la conservation de cet écosystème précieux.', 'LA SAVANE', 'image/savane2.jpg', 'image/savane.jpg', 'bg-sable'),
(3, 'jungle', 'Paysage : La jungle, également connue sous le nom de forêt tropicale humide, est un écosystème luxuriant caractérisé par une végétation dense et une canopée dense. Les arbres immenses s\'élèvent vers le ciel, formant un dôme verdoyant qui filtre la lumière du soleil, créant des nuances de vert et des ombres mystérieuses. Les lianes serpentent autour des troncs d\'arbres, tandis que les plantes épiphytes colonisent chaque recoin disponible.\r\n\r\nClimat : La jungle bénéficie d\'un climat tropical humide, avec des températures chaudes toute l\'année et des précipitations abondantes. Les pluies fréquentes alimentent la luxuriante végétation de la jungle, créant un habitat idéal pour une incroyable diversité de plantes et d\'animaux. Cependant, les fortes précipitations peuvent également entraîner des inondations et des glissements de terrain dans les régions les plus vulnérables.\r\n\r\nFaune : La jungle abrite une incroyable variété d\'espèces, allant des plus petits insectes aux grands prédateurs. Les singes agilement se déplacent dans les arbres, tandis que les jaguars et les tigres rôdent silencieusement dans les sous-bois à la recherche de proies. Les oiseaux aux couleurs vives peuplent la canopée, tandis que les serpents venimeux se cachent parmi les feuilles mortes. Les grenouilles arboricoles, les lézards camouflés et les papillons exotiques ajoutent à la richesse de la biodiversité de la jungle.\r\n\r\n', 'LA JUNGLE', 'image/jungle2.jpg', 'image/jungle.jpg', 'bg-jungle');

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `id_race` int(11) NOT NULL,
  `race` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id_race`, `race`) VALUES
(1, 'Oiseaux'),
(2, 'Chien'),
(3, 'Singe'),
(4, 'Tigre'),
(5, 'Tortue');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'veterinaire'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `images` varchar(255) NOT NULL,
  `descriptions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `titre`, `images`, `descriptions`) VALUES
(1, 'Restaurants', 'image/restaurant.jpg', 'C\'est un très bon restaurant.'),
(2, 'Le train des animaux', 'image/train.jpg', 'C\'est un train quoi'),
(3, 'Les Guides', 'image/guide.jpg', 'C\'est des guides en vrai');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `secrets` varchar(30) NOT NULL,
  `dates` datetime NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `pseudo`, `pass`, `secrets`, `dates`, `role_id`) VALUES
(7, 'Administrateur@gmail.com', '', '$2y$10$RuOLOcygfchCtnpetVqAjOeKFHCWjPt9zExI0XKJ68bqND6Ug3ytu', 'cb66c715e41562ac2643679c881b7f', '2024-05-06 21:13:16', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_habitat_key` (`id_habitat`),
  ADD KEY `id_race_key` (`id_race`) USING BTREE;

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`id_habitat`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id_race`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `id_habitat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id_race` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD CONSTRAINT `id_habitat_key` FOREIGN KEY (`id_habitat`) REFERENCES `habitat` (`id_habitat`),
  ADD CONSTRAINT `id_race_key` FOREIGN KEY (`id_race`) REFERENCES `race` (`id_race`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id_key` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
