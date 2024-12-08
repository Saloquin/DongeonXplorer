-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 01 déc. 2024 à 16:53
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dungeon`
--

-- --------------------------------------------------------

--
-- Structure de la table `armor`
--

DROP TABLE IF EXISTS `armor`;
CREATE TABLE IF NOT EXISTS `armor` (
  `armor_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `defense` int DEFAULT NULL,
  `initiative` int DEFAULT NULL,
  PRIMARY KEY (`armor_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `armor`
--

INSERT INTO `armor` (`armor_id`, `item_id`, `defense`, `initiative`) VALUES
(4, 42, 10, 2),
(5, 46, 15, 1),
(6, 40, 25, 0);

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
CREATE TABLE IF NOT EXISTS `chapter` (
  `chapter_id` int NOT NULL AUTO_INCREMENT,
  `chapter_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`chapter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `chapter_title`, `content`, `image`) VALUES
(1, 'Introduction', 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l\'immense forêt, est étrangement calme quand le bourgmestre s\'approche de vous. Homme d\'apparence usée par les années et les soucis, il vous adresse un regard désespéré.\n« Ma fille… elle a disparu dans la forêt. Personne n’a osé la chercher… sauf vous, peut-être ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J\'ai besoin de vous pour la retrouver. »\nVous sentez le poids de la mission qui s’annonce, et un frisson parcourt votre échine.\nBientôt, la forêt s\'ouvre devant vous, sombre et menaçante. La quête commence.', 'Images/chapter/Village01.jpg'),
(2, 'L\'orée de la forêt', 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s’offrent à vous : l’un sinueux, bordé de vieux arbres noueux ; l’autre droit mais envahi par des ronces épaisses.', 'Images/chapter/chapter2.jpg'),
(3, 'L\'arbre aux corbeaux', 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.', 'Images/chapter/chapter3.jpg'),
(4, 'Le sanglier enragé', 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !', 'Images/chapter/.jpg'),
(5, 'Rencontre avec le paysan', 'Tandis que vous progressez, une voix humaine s’élève, interrompant le silence de la forêt. Vous tombez sur un vieux paysan, accroupi près de champignons aux couleurs vives. Il sursaute en vous voyant, puis se détend, vous souriant tristement.\n« Vous devriez faire attention, étranger, murmure-t-il. La nuit, des cris terrifiants retentissent depuis le cœur de la forêt… Des créatures rôdent. »', 'Images/chapter/chapter5.jpg'),
(6, 'Le loup noir', 'À mesure que vous avancez, un bruissement attire votre attention. Une silhouette sombre s’élance soudainement devant vous : un loup noir aux yeux perçants. Son poil est hérissé et sa gueule laisse entrevoir des crocs acérés. Vous sentez son regard fixé sur vous, prêt à bondir.\nLe combat est inévitable.', 'Images/chapter/.jpg'),
(7, 'La clairière aux pierres anciennes', 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées, comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les ombres des pierres semblent danser sous la lueur de la lune.', 'Images/chapter/chapter7.jpg'),
(8, 'Les murmures du ruisseau', 'Essoufflé mais déterminé, vous arrivez près d’un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.', 'Images/chapter/chapter8.jpg'),
(9, 'Au pied du château', 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu.\nVous sentez que la véritable aventure commence ici, et que l’influence du sorcier n’est peut-être pas qu’une légende…', 'Images/chapter/chapter9.jpg'),
(10, 'La lumière au bout du néant', 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres.\nAlors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l’obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens.\n« Brave âme, ton chemin n\'est pas achevé... À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. »\nLa lumière s\'intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité.\nLorsque la lumière vous enveloppe, vous ouvrez de nouveau les yeux, retrouvant la terre ferme sous vos pieds. Vous êtes de retour, sans autre possession que votre volonté de reprendre cette quête. Mais cette fois-ci, peut-être, saurez-vous éviter les pièges fatals qui vous ont mené à votre perte.', 'Images/chapter/death.jpg'),
(11, 'La curiosité tua le chat', 'La pierre, massive et gravée de runes scintillantes, semble vibrer doucement, comme si elle respirait. À mesure que vous vous approchez, une chaleur oppressante envahit votre corps, et vos forces commencent à vous abandonner. Vos jambes flanchent, votre souffle se fait court, tandis qu’un éclat spectral parcourt les inscriptions. Vous comprenez trop tard que la pierre aspire lentement votre énergie vitale, s’abreuvant de votre essence pour nourrir un pouvoir ancien et impitoyable.', 'Images/chapter/chapter11.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `chapter_treasure`
--

DROP TABLE IF EXISTS `chapter_treasure`;
CREATE TABLE IF NOT EXISTS `chapter_treasure` (
  `ch_treasure_id` int NOT NULL AUTO_INCREMENT,
  `chapter_id` int NOT NULL,
  `treasure_id` int NOT NULL,
  PRIMARY KEY (`ch_treasure_id`),
  KEY `chapter_id` (`chapter_id`),
  KEY `treasure_id` (`treasure_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `class_description` text,
  `base_pv` int NOT NULL,
  `base_mana` int NOT NULL,
  `strength` int NOT NULL,
  `initiative` int NOT NULL,
  `class_image` text NOT NULL,
  `max_items` int NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `class_description`, `base_pv`, `base_mana`, `strength`, `initiative`, `class_image`, `max_items`) VALUES
(1, 'Guerrier', 'Un combattant spécialisé dans les armes et la défense', 150, 50, 20, 15, '/DongeonXplorer/Images/classe/Berserker.jpg', 5),
(2, 'Paladin', 'Un combattant sacré, entre le guerrier et le magicien', 120, 100, 18, 12, '/DongeonXplorer/Images/classe/paladin.jpg', 5),
(3, 'Magicien', 'Un utilisateur de magie avec une faible défense mais une grande puissance magique', 80, 150, 5, 10, '/DongeonXplorer/Images/classe/Magician01.jpg', 3),
(4, 'Voleur', 'Un expert de l\'esquive et des attaques rapides', 100, 30, 18, 20, '/DongeonXplorer/Images/classe/Thief.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `consumable`
--

DROP TABLE IF EXISTS `consumable`;
CREATE TABLE IF NOT EXISTS `consumable` (
  `consumable_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `health` int DEFAULT NULL,
  `mana` int DEFAULT NULL,
  PRIMARY KEY (`consumable_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `consumable`
--

INSERT INTO `consumable` (`consumable_id`, `item_id`, `health`, `mana`) VALUES
(3, 43, 50, NULL),
(4, 47, NULL, 30);

-- --------------------------------------------------------

--
-- Structure de la table `encounter`
--

DROP TABLE IF EXISTS `encounter`;
CREATE TABLE IF NOT EXISTS `encounter` (
  `encounter_id` int NOT NULL AUTO_INCREMENT,
  `chapter_id` int NOT NULL,
  `entity_type` enum('monster','npc') NOT NULL,
  PRIMARY KEY (`encounter_id`),
  KEY `chapter_id` (`chapter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hero`
--

DROP TABLE IF EXISTS `hero`;
CREATE TABLE IF NOT EXISTS `hero` (
  `hero_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `chapter_id` int DEFAULT NULL,
  `hero_name` varchar(50) NOT NULL,
  `class_id` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pv` int NOT NULL,
  `mana` int NOT NULL,
  `strength` int NOT NULL,
  `initiative` int NOT NULL,
  `armor` int DEFAULT NULL,
  `primary_weapon` int DEFAULT NULL,
  `secondary_weapon` int DEFAULT NULL,
  `xp` int NOT NULL,
  `money` int DEFAULT NULL,
  `current_level` int DEFAULT '1',
  PRIMARY KEY (`hero_id`),
  KEY `user_id` (`user_id`),
  KEY `chapter_id` (`chapter_id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hero`
--

INSERT INTO `hero` (`hero_id`, `user_id`, `chapter_id`, `hero_name`, `class_id`, `image`, `pv`, `mana`, `strength`, `initiative`, `armor`, `primary_weapon`, `secondary_weapon`, `xp`, `money`, `current_level`) VALUES
(11, 1, 7, 'Jacobe', 4, NULL, 100, 30, 18, 20, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventory_id` int NOT NULL AUTO_INCREMENT,
  `quantity` int DEFAULT NULL,
  `hero_id` int NOT NULL,
  `item_id` int NOT NULL,
  PRIMARY KEY (`inventory_id`),
  KEY `hero_id` (`hero_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` text,
  `item_type` enum('weapon','armor','consumable','loot') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`item_id`, `item_image`, `item_name`, `item_description`, `item_type`) VALUES
(41, 'item01.jpg', 'Épée du Guerrier', 'Une épée forgée pour les guerriers, augmente la force.', 'weapon'),
(42, 'item02.jpg', 'Armure Légère', 'Armure légère offrant une bonne protection.', 'armor'),
(43, 'item03.jpg', 'Potion de soin', 'Restaure 50 points de vie.', 'consumable'),
(44, 'item04.jpg', 'Coffre au trésor', 'Un coffre contenant des trésors.', 'loot'),
(45, 'item05.jpg', 'Hache de Barbare', 'Une hache à deux mains infligeant de lourds dégâts.', 'weapon'),
(46, 'item06.jpg', 'Casque de Fer', 'Un casque robuste qui protège la tête des attaques.', 'armor'),
(47, 'item07.jpg', 'Potion de Mana', 'Restaure 30 points de mana.', 'consumable'),
(48, 'item08.jpg', 'Bague du Pouvoir', 'Une bague rare qui augmente la force magique.', 'loot'),
(49, 'item09.jpg', 'Épée de Glace', 'Une épée enchantée qui inflige des dégâts de glace.', 'weapon'),
(50, 'item10.jpg', 'Armure Royale', 'Armure lourde et résistante, utilisée par les chevaliers royaux.', 'armor');

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `level` int NOT NULL,
  `required_xp` int NOT NULL,
  `pv_bonus` int NOT NULL,
  `mana_bonus` int NOT NULL,
  `strength_bonus` int NOT NULL,
  `initiative_bonus` int NOT NULL,
  PRIMARY KEY (`level_id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `level`
--

INSERT INTO `level` (`level_id`, `class_id`, `level`, `required_xp`, `pv_bonus`, `mana_bonus`, `strength_bonus`, `initiative_bonus`) VALUES
(1, 1, 1, 1000, 10, 0, 2, 1),
(2, 1, 2, 2500, 20, 0, 4, 2),
(3, 1, 3, 5000, 30, 5, 6, 3),
(4, 1, 1, 0, 10, 5, 2, 1),
(5, 1, 2, 100, 15, 8, 3, 2),
(6, 1, 3, 250, 20, 12, 4, 3),
(7, 1, 4, 500, 30, 18, 5, 4),
(8, 1, 5, 1000, 40, 25, 6, 5),
(9, 1, 6, 2000, 50, 35, 7, 6),
(10, 1, 7, 4000, 60, 45, 8, 7),
(11, 1, 8, 8000, 75, 60, 9, 8),
(12, 1, 9, 16000, 90, 80, 10, 9),
(13, 1, 10, 32000, 120, 100, 12, 10),
(14, 2, 1, 0, 10, 5, 2, 1),
(15, 2, 2, 100, 15, 8, 3, 2),
(16, 2, 3, 250, 20, 12, 4, 3),
(17, 2, 4, 500, 30, 18, 5, 4),
(18, 2, 5, 1000, 40, 25, 6, 5),
(19, 2, 6, 2000, 50, 35, 7, 6),
(20, 2, 7, 4000, 60, 45, 8, 7),
(21, 2, 8, 8000, 75, 60, 9, 8),
(22, 2, 9, 16000, 90, 80, 10, 9),
(23, 2, 10, 32000, 120, 100, 12, 10);

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `link_id` int NOT NULL AUTO_INCREMENT,
  `chapter_id` int NOT NULL,
  `next_chapter_id` int NOT NULL,
  `link_description` text,
  PRIMARY KEY (`link_id`),
  KEY `chapter_id` (`chapter_id`),
  KEY `next_chapter_id` (`next_chapter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`link_id`, `chapter_id`, `next_chapter_id`, `link_description`) VALUES
(84, 10, 1, 'vous êtes mort mais une deuxième chance est toujours accordée à ceux qui possèdent de l\'espoir'),
(83, 9, 1, 'atteindre le château'),
(82, 8, 9, 'ignorer la pierre et continuer'),
(80, 7, 9, 'suivre le chemin tortueux'),
(81, 8, 11, 'toucher la pierre gravée'),
(79, 7, 8, 'prendre le sentier couvert de mousse'),
(77, 6, 7, 'survivre au loup'),
(78, 6, 10, 'être vaincu par le loup'),
(76, 5, 7, 'écouter le paysan'),
(75, 4, 10, 'échouer face au sanglier'),
(74, 4, 8, 'vaincre le sanglier'),
(73, 3, 6, 'ignorer les bruits et de poursuivre votre route'),
(72, 3, 5, 'rester prudent'),
(71, 2, 4, 'empruntez le sentier couvert de ronces'),
(69, 1, 2, 'se diriger vers la foret'),
(70, 2, 3, 'empruntez le chemin sinueux'),
(51, 11, 10, 'La pierre aspire votre vitalité');

-- --------------------------------------------------------

--
-- Structure de la table `loot`
--

DROP TABLE IF EXISTS `loot`;
CREATE TABLE IF NOT EXISTS `loot` (
  `loot_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`loot_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `loot`
--

INSERT INTO `loot` (`loot_id`, `item_id`, `quantity`) VALUES
(3, 44, 1),
(4, 48, 3);

-- --------------------------------------------------------

--
-- Structure de la table `monster`
--

DROP TABLE IF EXISTS `monster`;
CREATE TABLE IF NOT EXISTS `monster` (
  `monster_id` int NOT NULL AUTO_INCREMENT,
  `encounter_id` int NOT NULL,
  `monster_name` varchar(50) NOT NULL,
  `pv` int NOT NULL,
  `mana` int DEFAULT NULL,
  `initiative` int NOT NULL,
  `strength` int NOT NULL,
  `attack` text,
  `loot_id` int DEFAULT NULL,
  `xp` int NOT NULL,
  PRIMARY KEY (`monster_id`),
  UNIQUE KEY `encounter_id` (`encounter_id`),
  KEY `loot_id` (`loot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `npc`
--

DROP TABLE IF EXISTS `npc`;
CREATE TABLE IF NOT EXISTS `npc` (
  `npc_id` int NOT NULL AUTO_INCREMENT,
  `encounter_id` int NOT NULL,
  `npc_name` varchar(50) NOT NULL,
  `npc_description` text,
  PRIMARY KEY (`npc_id`),
  UNIQUE KEY `encounter_id` (`encounter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `npc_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`npc_id`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `spell`
--

DROP TABLE IF EXISTS `spell`;
CREATE TABLE IF NOT EXISTS `spell` (
  `spell_id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `spell_name` varchar(255) NOT NULL,
  `spell_description` text NOT NULL,
  `dice_count` int NOT NULL,
  `mana_cost` int NOT NULL,
  `learning_level` int NOT NULL,
  PRIMARY KEY (`spell_id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `treasure`
--

DROP TABLE IF EXISTS `treasure`;
CREATE TABLE IF NOT EXISTS `treasure` (
  `treasure_id` int NOT NULL AUTO_INCREMENT,
  `loot_name` varchar(50) NOT NULL,
  `loot_description` text,
  `item_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`treasure_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `users_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `users_image`, `created_at`) VALUES
(1, 'saloquin', '$2y$10$aQTJHZChBfWFYYKgiafeD.7qVRfehpDgiZ..5vi7gTRmdQx4UU5nW', 'https://p4.wallpaperbetter.com/wallpaper/558/222/507/pokemon-pikachu-wallpaper-preview.jpg', '2024-11-28 22:27:34');

-- --------------------------------------------------------

--
-- Structure de la table `weapon`
--

DROP TABLE IF EXISTS `weapon`;
CREATE TABLE IF NOT EXISTS `weapon` (
  `weapon_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `damage` int DEFAULT NULL,
  `defense` int DEFAULT NULL,
  `mana` int DEFAULT NULL,
  `isTwoHanded` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`weapon_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `weapon`
--

INSERT INTO `weapon` (`weapon_id`, `item_id`, `damage`, `defense`, `mana`, `isTwoHanded`) VALUES
(4, 41, 15, NULL, NULL, 1),
(5, 45, 20, NULL, NULL, 1),
(6, 49, 18, NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
