-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 29 juil. 2025 à 19:29
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique_informatique`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `prenom` varchar(100) NOT NULL,
  `Poste` varchar(100) NOT NULL,
  `sexe` enum('Homme','Femme') NOT NULL,
  `statut` enum('admin','gestion') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `email`, `mot_de_passe`, `date_creation`, `prenom`, `Poste`, `sexe`, `statut`) VALUES
(61, 'Uriel Nash', 'goqary@mailinator.com', '$2y$10$BUJ6zzGTvbOJMo7dVivdKu6FcOyaj./IImAKK/dwTghoIRDO6/V06', '2025-07-07 15:34:03', 'Voluptatem architec', 'Consequatur voluptat', 'Homme', 'admin'),
(62, 'Gay Clements', 'hapikiman@mailinator.com', '$2y$10$9m1eXHsJOXWB/bnIjmvSzOMCzXe2KH6Or/IonfRgcSDDXplW9LXhq', '2025-07-07 15:50:18', 'Consectetur et adipi', 'Sapiente pariatur E', 'Femme', 'admin'),
(63, 'Cedric Fletcher', 'pugenovu@mailinator.com', '$2y$10$IonU19CfrEEPpHYFluRkpuqdfyWNHR8l7esADtfM9wpEYl4ZjkkE6', '2025-07-07 16:16:12', 'Animi sunt id a vel', 'Assumenda ex molesti', 'Femme', 'gestion'),
(64, 'Carter Page', 'qofyzefi@mailinator.com', '$2y$10$FLH8g1030tS4uZhZFaHB0.goosYD3WhGbF1B2UVCZurv2BD3BnGm2', '2025-07-07 16:33:37', 'Amet minus magni nu', 'Hic nulla ullam debi', 'Homme', 'gestion'),
(65, 'Keaton Gray', 'zisiqytew@mailinator.com', '$2y$10$TokGv7IkyC/Y2T.efXWO8.HMCM8GmPihmMoOTOVsyGfYzKaC3upK.', '2025-07-07 16:39:02', 'Est sit in quaerat ', 'Temporibus quis porr', 'Homme', 'gestion'),
(66, 'BELEM', 'belem@gmail.com', '$2y$10$McU9RLs1CkOIj3pAB9FYrugUYOwz0hSB2edtRyyQFMb1Z7n.s/UAG', '2025-07-07 16:41:22', 'Claver', 'treso', 'Homme', 'gestion'),
(67, 'BELEM', 'belemclaver30@gmail.com', '$2y$10$yDIgqDmR1wY2mvRgk7DnMewjCbxzbx9R5jZspXr9SNU76tXinwJny', '2025-07-07 16:51:45', 'Claver', 'tresss', 'Femme', 'admin'),
(68, 'BELEM', 'belemclaver30@gmail.com', '$2y$10$d1YNLUxhnNUROH1ElAn89.oq4ChVeJoatP6WZ/hNG2wF1ksYTkmkO', '2025-07-09 16:38:14', 'Patrick ', 'treso', 'Femme', 'admin'),
(69, 'BELEM', 'claver30@gmail.com', '$2y$10$sVqyke0m/KJqrmbbZm/4SOeDqiXafQiPcdMfoVovyKxGWGBPHvC9u', '2025-07-09 16:43:19', 'Claver', 'Anim dolorem nemo co', 'Homme', 'admin'),
(70, 'bambara', 'claver30@gmail.com', '$2y$10$/gPX9BV/E3W78yDLwzZHWeX/mRHkg.97ntrlYN8M1ztWHQl3iBYNa', '2025-07-15 12:03:37', 'corneille ', 'assitant', 'Homme', 'admin'),
(71, 'Joël ', 'jo@ll.com', '$2y$10$3Vgajm6So1yjNQ3non7H8ebcQCb8.V8NMmK1maWF2vykgak5N/LvO', '2025-07-17 16:15:56', 'jojo', 'dev', 'Homme', 'admin'),
(72, 'BELEM', 'belemclaver30@gmail.com', '$2y$10$2NEEEPj4aKVWpKaL9mEPg.Ztl3n6z6bhpIC.cZ6p28IrcHFrDYeQe', '2025-07-18 14:58:26', 'Claver', 'Laborum Est numquam', 'Homme', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `categorie` enum('Ordinateurs','Batteries','Accessoires','Clés USB') NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis_produits`
--

CREATE TABLE `avis_produits` (
  `review_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE `caracteristiques` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `caracteristique` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Ordinateurs', 'Ordinateurs portables et de bureau'),
(2, 'Accessoires', 'Clés USB, câbles, chargeurs, etc.'),
(3, 'Batteries', 'Batteries pour ordinateurs et autres appareils'),
(4, 'USB', 'Clés USB pour ordinateurs et autres appareils'),
(5, 'Chargeur', 'Chargeur pour ordinateurs et autres appareils');

-- --------------------------------------------------------

--
-- Structure de la table `clics_whatsapp`
--

CREATE TABLE `clics_whatsapp` (
  `id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `date_clic` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clics_whatsapp`
--

INSERT INTO `clics_whatsapp` (`id`, `product_id`, `date_clic`) VALUES
(1, 0, '2025-07-11 16:43:17'),
(2, 0, '2025-07-11 16:51:26'),
(3, 0, '2025-07-11 16:52:12'),
(4, 0, '2025-07-14 17:39:03'),
(5, 0, '2025-07-15 13:45:47'),
(6, 0, '2025-07-15 13:48:05'),
(7, 0, '2025-07-15 13:49:26'),
(8, 0, '2025-07-15 14:00:26'),
(9, 0, '2025-07-21 18:51:06'),
(10, 0, '2025-07-29 17:34:14');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` enum('En cours','Expédiée','Livrée','Annulée') DEFAULT 'En cours',
  `payment_method_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_commandes`
--

CREATE TABLE `details_commandes` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `shipping_id` int(11) NOT NULL,
  `shipping_method` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) DEFAULT NULL,
  `estimated_delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`shipping_id`, `shipping_method`, `shipping_cost`, `estimated_delivery_date`) VALUES
(1, 'Standard', 5.99, '2024-12-10'),
(2, 'Express', 15.99, '2024-12-06');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `message_staut` enum('Message_lu','Message_non_lu') NOT NULL DEFAULT 'Message_non_lu',
  `date_envoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `email`, `message`, `message_staut`, `date_envoi`) VALUES
(1, 'belemclaver30@gmail.com', 'tres beau', 'Message_lu', '2025-07-15 18:20:39'),
(2, 'belemclaver30@gmail.com', 'tres bien bro', 'Message_lu', '2025-07-15 18:55:52'),
(3, 'belemclaver30@gmail.com', 'ertyu', 'Message_lu', '2025-07-17 16:02:48'),
(4, 'belemclaver30@gmail.com', 'vvvvv', 'Message_lu', '2025-07-17 16:05:10'),
(5, 'belemclaver30@gmail.com', 'bonjour', 'Message_lu', '2025-07-18 16:17:26'),
(6, 'belemclaver30@gmail.com', 'bonjour br com', 'Message_lu', '2025-07-18 16:44:41'),
(7, 'belemclaver30@gmail.com', 'dx \r\n', 'Message_lu', '2025-07-29 17:25:45');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `payment_method_id` int(11) NOT NULL,
  `method_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`payment_method_id`, `method_name`) VALUES
(1, 'Carte de crédit'),
(2, 'PayPal'),
(3, 'Virement bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `panier_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `processeur` varchar(250) NOT NULL,
  `stockage` varchar(20) NOT NULL,
  `ecran` int(2) NOT NULL,
  `ram` varchar(20) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `first_image` varchar(250) DEFAULT NULL,
  `second_image` varchar(250) DEFAULT NULL,
  `third_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`product_id`, `name`, `processeur`, `stockage`, `ecran`, `ram`, `prix`, `category_id`, `image_url`, `first_image`, `second_image`, `third_image`) VALUES
(69, 'Bruno Bean', 'Voluptas eaque susci', 'Cupiditate at sapien', 1, 'Dolores est sint ali', 25, 5, 'captur.png', '', NULL, NULL),
(70, 'davinci', 'Aliquid rerum nesciu', 'Ab dolore quo porro ', 72, 'Deserunt eaque sit p', 78, 3, '34445.png', '', NULL, NULL),
(71, 'Gisela Thomas', 'Nam autem et pariatu', '500 G', 13, '16G', 150000, 1, '9.jpg', '', NULL, NULL),
(72, 'Rafael Hines', 'Esse aperiam lorem ', 'Aliqua Est recusan', 76, 'Atque doloribus qui ', 27, 4, '7.jpg', '', NULL, NULL),
(74, 'Wynter Henderson', 'Atque ex error rerum', 'Aliquid quam consect', 44, 'Quisquam ut ullamco ', 59, 2, '10212202-m-removebg-preview.png', '', NULL, NULL),
(75, 'Deborah Kirk', 'Sit sed accusantium', 'Perspiciatis veniam', 49, 'Quis sunt error vel ', 9, 1, '1.jpeg', '186096223-removebg-preview.png', 'externe-grafikkarte-notebook-2-removebg-preview.png', 'tertiary1-removebg-preview.png'),
(76, 'claver', 'Voluptate et officia', 'Nulla sint atque non', 5, 'Distinctio Qui aliq', 16, 1, 'valorizacao-do-funcionario-nas-empresas.webp', 'fondaccueil1.jpeg', 'fondaccueil3.png', 'gestionnaire-femme-noire-emotionnelle-regardant-ecran-ordinateur-faisant-gestes_116547-77413.jpg'),
(77, 'Regan Dawson', 'Eiusmod dolor unde v', 'Ab odio velit offic', 50, 'Dolor hic magnam duc', 34, 1, 'cin2.png', 'CADRE1-CARRE-JESCO-CISSIN-MONT-SINAI-COM.png', 'camera.png', '34445.png'),
(78, 'Mira Trevino', 'Eius quibusdam qui s', 'Enim aut voluptatum ', 74, 'Quidem quod voluptas', 60, 4, 'jescoo11.png', 'jescoo.png', 'Toastmasters_2011.png', '34445.png'),
(79, 'Samuel Lawson', 'Vitae nulla qui adip', 'Qui et placeat illu', 15, 'Error rerum error pr', 72, 3, 'pop1.jpeg', 'camera.png', 'jescoo.png', 'jescoo11.png'),
(80, 'Keelie Figueroa', 'Illo aut expedita es', 'Inventore excepteur ', 62, 'Voluptatem anim nost', 8, 2, 'GAB.jpg', '34445.png', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis_produits`
--
ALTER TABLE `avis_produits`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id` (`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `clics_whatsapp`
--
ALTER TABLE `clics_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`panier_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `avis_produits`
--
ALTER TABLE `avis_produits`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `clics_whatsapp`
--
ALTER TABLE `clics_whatsapp`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `panier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_produits`
--
ALTER TABLE `avis_produits`
  ADD CONSTRAINT `avis_produits_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `avis_produits_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Contraintes pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  ADD CONSTRAINT `caracteristiques_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `paiement` (`payment_method_id`),
  ADD CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`shipping_id`) REFERENCES `livraison` (`shipping_id`);

--
-- Contraintes pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD CONSTRAINT `details_commandes_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `commandes` (`order_id`),
  ADD CONSTRAINT `details_commandes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
