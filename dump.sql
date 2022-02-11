-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 fév. 2022 à 12:48
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exoshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES
(37, 'dolore', 'Itaque est quo eaque reprehenderit et minima deleniti.', 'dolore'),
(38, 'consequatur', 'Est dignissimos molestiae ut earum voluptatem quo quibusdam.', 'consequatur'),
(39, 'pariatur', 'Dolores id soluta repellendus modi omnis placeat ut tempora.', 'pariatur');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220119133251', '2022-01-19 13:33:20', 169),
('DoctrineMigrations\\Version20220122214853', '2022-01-22 21:49:11', 111),
('DoctrineMigrations\\Version20220122215221', '2022-01-22 21:52:33', 111),
('DoctrineMigrations\\Version20220124133611', '2022-01-24 13:36:26', 124),
('DoctrineMigrations\\Version20220125165421', '2022-01-25 16:54:30', 139),
('DoctrineMigrations\\Version20220126193236', '2022-01-26 19:32:45', 178),
('DoctrineMigrations\\Version20220126194307', '2022-01-26 19:43:23', 196),
('DoctrineMigrations\\Version20220202134022', '2022-02-02 13:40:36', 178);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `slug`, `image`) VALUES
(173, 37, 'tempore debitis consequatur cumque', 'Ea voluptatibus ut dignissimos eum aliquid et aut. Quia et omnis quo et quas occaecati dicta. Veniam est ullam ut et. Dolores nulla dicta et quo dolorem.\n\nMinus adipisci vel officiis repudiandae. Eum a et quia debitis. Accusantium alias voluptate nesciunt quis. A molestiae sed repudiandae nam voluptatem beatae. Distinctio officiis totam aut repudiandae esse.', 87839, 'tempore-debitis-consequatur-cumque', 'https://picsum.photos/id/114/200/200'),
(174, 37, 'voluptatum soluta neque quis fugit', 'Minima aperiam enim ut tempora sequi ipsa nobis. Est possimus sed deserunt voluptate et ut dolor. Dolor tenetur ut voluptatem in.\n\nQuia reiciendis placeat libero quibusdam. Similique in laudantium quisquam accusantium. Pariatur maxime quam provident tempora. Quaerat et nemo quam libero quod voluptas.\n\nVeritatis a neque error et provident. Delectus eius quos ratione magni vero ipsa accusamus. Est non corrupti eum qui cupiditate.\n\nDucimus qui dolor beatae reiciendis. Facilis et doloremque magni qui ducimus similique architecto. Sequi quos suscipit cumque officiis aliquam dolor adipisci. Consequatur voluptatibus voluptas magni quis modi minima vero. Aut qui aspernatur hic numquam ea cupiditate.', 27849, 'voluptatum-soluta-neque-quis-fugit', 'https://picsum.photos/id/929/200/200'),
(175, 37, 'molestias architecto quia ab doloribus', 'Harum dolor qui reiciendis nulla et. Aliquam vero aut rerum quos voluptates sunt illo. Ipsum tempore et est aut amet qui. Amet et nemo necessitatibus molestiae.\n\nEst qui quisquam nulla accusamus vitae ducimus. Iusto temporibus sit provident tenetur ratione atque eos occaecati.\n\nDolore consectetur nesciunt sit dolorum. Aliquid eos illum veniam sunt expedita saepe. Et aspernatur non numquam et delectus vel. Unde suscipit quis expedita unde perspiciatis veniam. Accusamus eos ut culpa et hic est autem nisi.', 24439, 'molestias-architecto-quia-ab-doloribus', 'https://picsum.photos/id/162/200/200'),
(176, 37, 'maiores consequatur', 'Aliquam autem voluptas sequi officiis maiores fugiat molestias. Qui doloribus autem cum. Repudiandae vero voluptatum earum facere vel labore nam.\n\nNihil molestiae suscipit nemo commodi dolorem harum facere. Enim labore voluptas commodi et. Est at consequatur ipsum pariatur veniam optio et. Odit itaque suscipit labore eum est ex occaecati. In a qui vitae quia.\n\nAut provident perferendis voluptatibus ad. Facere molestiae sint ut vitae. Voluptates sapiente ut voluptas est corrupti in. Alias ut ut enim quisquam quis.', 50489, 'maiores-consequatur', 'https://picsum.photos/id/942/200/200'),
(177, 37, 'non inventore placeat', 'Adipisci amet est fugit tenetur ipsum. Quo et et voluptatem mollitia laboriosam. Natus quis quaerat fugiat sed provident adipisci.\n\nSuscipit eos natus dicta quos quia dolores harum explicabo. Nemo magnam rerum eveniet sapiente nostrum qui iusto.\n\nCulpa ullam hic ut. Labore asperiores dolor nobis animi quos. Est nesciunt animi aut culpa assumenda.\n\nEst id soluta modi consectetur ea quia et. Consequatur doloremque magni odio.\n\nDolorem vel saepe aperiam. Corporis nobis assumenda exercitationem omnis veniam dolores. Eum repellendus est praesentium ad. Optio nisi sequi rerum excepturi ut.\n\nCumque facere esse consectetur et ut eius saepe sed. Nesciunt ipsum non cum totam. Harum deleniti id quod molestiae itaque sapiente.', 20249, 'non-inventore-placeat', 'https://picsum.photos/id/488/200/200'),
(178, 37, 'amet labore consequatur ducimus molestias', 'Et magnam aut necessitatibus vero. Quo et unde ut qui libero accusamus. Recusandae hic et et nobis est qui dolor. Ex dicta veritatis sit qui mollitia quidem.\n\nPlaceat repudiandae harum et facilis sed placeat. Id dolor assumenda dolores repudiandae cumque voluptatem. Doloremque aperiam ex aut.', 84069, 'amet-labore-consequatur-ducimus-molestias', 'https://picsum.photos/id/683/200/200'),
(179, 38, 'aliquam sit', 'Ea sit labore omnis corporis. Aliquid facere et facere dolore. Molestiae quae ut qui facilis. Non quis voluptas non odit doloribus.\n\nSed culpa doloribus eius veniam eligendi consequuntur. Quia ratione necessitatibus modi cumque. Sunt minima adipisci voluptate architecto rem pariatur. Porro debitis aut voluptatibus.\n\nSed reiciendis qui sapiente dicta in sint. At excepturi fuga eum voluptas. Iusto odio corrupti est et sunt nulla ea. Culpa molestias sed repellat ipsa magni sunt facere. Eius nam quia libero repellendus eaque sit sint.\n\nExcepturi ex esse et est placeat. Doloremque animi minus voluptate eaque et iste optio. Veniam id quia eum deleniti. Minima porro a voluptatum. Ut porro debitis quis eos at.', 41609, 'aliquam-sit', 'https://picsum.photos/id/613/200/200'),
(180, 38, 'impedit quo sit', 'Architecto consequuntur perspiciatis nesciunt consequuntur est quas et. Dolorem et ex sed molestiae rerum beatae dicta. Asperiores aut ad sed deleniti.\n\nDebitis qui iste et. Sit cum sunt explicabo est quidem enim omnis. Quos possimus ad in mollitia voluptatem error eos reprehenderit. Repellat amet commodi velit.\n\nQuaerat sed repellat rerum. Eveniet itaque qui unde provident dignissimos voluptate. Laboriosam sint sunt sint provident consequatur ut.\n\nTemporibus autem ut accusamus dolorum ipsam fugiat. Dolorem libero optio error porro quisquam. Optio voluptatem commodi ipsam maiores vel adipisci debitis dolorem.\n\nId voluptate quia dolor. Enim fugiat consectetur aliquid et. Architecto quasi officiis sit debitis quisquam. Unde magnam et ipsum dolor.', 26129, 'impedit-quo-sit', 'https://picsum.photos/id/1074/200/200'),
(181, 38, 'nihil ratione voluptas praesentium ut', 'Aut aspernatur et id voluptatem. Tempore placeat maxime debitis modi omnis reiciendis nulla. Dolorem est quo nesciunt. Facere nemo reprehenderit reprehenderit non similique qui voluptas.\n\nEa temporibus voluptatibus molestias. In ut et et doloremque ipsa. At perspiciatis unde est ipsam dicta aut id.\n\nEst quibusdam cupiditate consequatur culpa. Aspernatur nemo voluptatum aut tempora. Facere voluptatem vel in.', 73169, 'nihil-ratione-voluptas-praesentium-ut', 'https://picsum.photos/id/149/200/200'),
(182, 39, 'architecto non et', 'Commodi suscipit ad vitae. Ipsam cum eligendi libero voluptate est laudantium sit id. Alias ex voluptatem magnam sapiente.\n\nUt tempora reiciendis maiores. Nobis voluptas molestias sit sint consequatur tempora ut. Sint repudiandae ex amet et sit perferendis illo. Voluptates ut facere omnis est ut.\n\nId saepe quia aut eligendi sunt quam velit. Qui quibusdam aut fuga laboriosam cumque. Nobis a numquam excepturi ipsam minima. Earum aut est earum qui doloremque est.\n\nDistinctio quos pariatur quia ex eos numquam omnis. Voluptatem ut nihil id distinctio. Similique et ducimus et dolorem explicabo suscipit. Et sunt laborum sapiente porro doloribus tempore enim.\n\nRerum exercitationem sint nihil. Minus facilis illum voluptatem eum quod. Iure laboriosam voluptas numquam itaque nobis voluptas est. Sint rem repellendus commodi pariatur officia vero animi veritatis.\n\nIpsa totam aut culpa et architecto omnis quisquam. Id sunt minima quia eum consequatur asperiores laudantium. Pariatur et libero qui dolor voluptates dolorem provident recusandae.', 47759, 'architecto-non-et', 'https://picsum.photos/id/131/200/200'),
(183, 39, 'omnis nihil soluta', 'Non voluptate aut vitae commodi ex nobis iure. Vel est non consequatur esse aspernatur sit temporibus.\n\nPlaceat quia vel suscipit eum nihil non ut. Et qui quia corporis temporibus repellendus veniam officiis corrupti. Repellendus eos ipsum repellendus itaque doloremque ipsum ea rerum.\n\nExplicabo et doloribus perferendis quae aliquam architecto est. Soluta voluptatem ratione illo ducimus ut officiis. Cumque magni ad exercitationem vel temporibus tenetur. Amet amet vitae vel ullam. Cum inventore voluptatem expedita mollitia.\n\nTotam nihil quis asperiores quia eligendi possimus. Aut cumque porro voluptatem blanditiis. Et sed laborum nulla quaerat et ratione.\n\nOmnis numquam atque facilis error. Doloremque velit reprehenderit cupiditate qui optio. Nihil illo laboriosam ipsa dolorum magni autem dicta. Quo repellat necessitatibus distinctio tempora illo quia officiis.', 52779, 'omnis-nihil-soluta', 'https://picsum.photos/id/476/200/200'),
(184, 39, 'ipsam voluptatem', 'Nam nesciunt consequatur laudantium vel explicabo incidunt qui asperiores. Non consectetur quam vel nobis et perspiciatis. Voluptatem dolor qui culpa molestiae sapiente accusamus nihil dolor. Vitae facilis voluptas eum voluptatem voluptatem nostrum.\n\nVel quia amet minus ut vel nihil. Nihil aliquam assumenda ducimus est aut. Iure voluptatem necessitatibus libero molestiae fugit sit unde. Veritatis nostrum enim consequuntur aliquid quas esse dolor. Aspernatur perspiciatis beatae nihil eum error odit pariatur et.\n\nNeque praesentium velit ducimus libero vitae architecto. Sequi eum quam facilis dolore.', 16839, 'ipsam-voluptatem', 'https://picsum.photos/id/972/200/200'),
(185, 39, 'quos soluta et quaerat', 'Consequatur sunt distinctio molestias inventore. Sunt quibusdam dolorem omnis velit labore officiis minima blanditiis. Repudiandae et aut pariatur minima quasi cumque.\n\nUt nulla quo reiciendis sit molestiae quod qui. Molestias rerum odit autem quibusdam. Error quia id nemo et molestias.\n\nNulla excepturi ullam illum. Iusto quia hic quos. Recusandae perferendis voluptatem quae non asperiores vitae. Et quidem qui iste mollitia sit exercitationem rem.', 22209, 'quos-soluta-et-quaerat', 'https://picsum.photos/id/888/200/200'),
(186, 39, 'illum ut quibusdam veritatis alias', 'Facilis cupiditate et alias est nesciunt. Vitae incidunt qui sint nostrum fuga qui enim. Consequatur et cum dolorum praesentium beatae ullam alias fugit. Nesciunt similique recusandae qui nihil voluptatem modi tempora.\n\nIllo cumque animi nihil ratione accusamus totam. At ea qui enim. Nobis quia minus beatae itaque.\n\nVoluptate hic nam illo eos est accusantium est. Ullam odio cupiditate consequatur est porro quia nostrum. Commodi eveniet earum ipsam.\n\nQuibusdam hic ut veniam commodi ut earum. Quia hic modi et ea ut eligendi. Necessitatibus molestias impedit odio ut eius nisi. Doloremque enim numquam officia quae voluptatem incidunt. Est reiciendis illo hic tempora nostrum quas.\n\nEos ex molestiae a rerum corrupti. Explicabo explicabo atque explicabo aut ipsum nihil. Sapiente incidunt sit occaecati nulla unde.\n\nPariatur iusto est ullam consequatur soluta. Et ea nihil temporibus iure. Atque aut voluptas dolores. Magnam totam enim deleniti nam iste aut qui. Voluptas cupiditate sapiente non voluptatem rem.', 76139, 'illum-ut-quibusdam-veritatis-alias', 'https://picsum.photos/id/526/200/200'),
(187, 39, 'odit mollitia nesciunt mollitia earum', 'Autem incidunt quisquam in quia nobis saepe. Nihil magni libero aperiam doloremque occaecati. Distinctio reprehenderit laborum saepe est mollitia.\n\nVoluptate alias qui aut ad. Blanditiis a cum delectus cumque distinctio in. Illo maiores ipsam recusandae et soluta provident tempore.\n\nSint vel consequatur quos et consequatur asperiores eius et. Rem minus eos quis placeat non natus accusamus. In nobis ut laboriosam soluta ducimus.\n\nOptio doloremque reprehenderit ipsam voluptatibus. Enim cum et eaque voluptatibus. Fuga ut nemo perferendis nam rerum dolorum a eos. Minima dolorem nobis vel consequatur.\n\nTotam sunt omnis doloremque cupiditate distinctio. Explicabo deleniti repellendus esse eos sit qui. Sint est unde blanditiis voluptatem provident quibusdam ut cum.', 20379, 'odit-mollitia-nesciunt-mollitia-earum', 'https://picsum.photos/id/392/200/200'),
(188, 39, 'distinctio dolorem reiciendis', 'Earum omnis repellendus blanditiis perferendis. Dolor minima ullam deserunt officia et omnis quia. Est veniam pariatur est laborum ut delectus qui. Voluptatum provident ut exercitationem dolorem quo.\n\nVelit ut iure non. Cupiditate quos voluptatem ipsam voluptas itaque velit. Qui debitis hic quas minus unde aut voluptatem hic. Qui quia nulla numquam quisquam quibusdam.\n\nMollitia incidunt corrupti esse numquam quod qui doloribus. Est et enim perferendis sunt recusandae ipsum maiores. Et deleniti sit tenetur voluptatem.\n\nAliquam quibusdam adipisci mollitia facere consequatur qui assumenda. Expedita quam est corrupti omnis modi quae fugit sint. Et commodi occaecati veniam ea non et eos.\n\nVoluptatem ex ipsam reiciendis illum est. Ratione delectus iste omnis aut impedit dignissimos. Error excepturi eveniet non fuga. Ipsum voluptatem laboriosam et saepe nostrum. Quae molestiae reiciendis aut nobis dolorem aspernatur.', 40669, 'distinctio-dolorem-reiciendis', 'https://picsum.photos/id/96/200/200');

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6117D13BA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchaseitem`
--

DROP TABLE IF EXISTS `purchaseitem`;
CREATE TABLE IF NOT EXISTS `purchaseitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B4CD0E1558FBEB9` (`purchase_id`),
  KEY `IDX_8B4CD0E14584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`, `postal_code`, `city`, `country`, `birth_date`, `address`) VALUES
(32, 'admin@symfony.com', '[\"ROLE_ADMIN\"]', '$2y$13$ALoY5RyZTtAETrLDc9t2juWvbhyKusWnKEJA91Ly2jqoHV0E/oXGe', 'Maggie', 'Weber', '+331794304171', '49 997', 'Humbert', 'Suisse', '1980-06-24', '5, place Odette Chauvet'),
(33, 'philippine.legendre@wanadoo.fr', '[]', '$2y$13$D/PJdIRwCU/MQI2we0fpEOJ9NV93xCKntmcO4vmdCrX/BBYgL0mkC', 'Raymond', 'Bazin', '+338637027560', '91 088', 'MorelBourg', 'France', '1994-03-06', '98, avenue Navarro'),
(34, 'pbourgeois@david.fr', '[]', '$2y$13$MPwU8DKRszyhFj1/YgGI9eV1qbgNZlrCVwZ0EMn4p7Lt1jTP3J/zW', 'Colette', 'Louis', '+333328749842', '89 715', 'Garcia', 'Suisse', '1993-06-11', '391, place Constance Jacques'),
(35, 'emmanuel.bruneau@jean.com', '[]', '$2y$13$FWDc/E.MNlbdD20OO3PIRu88wJ1giK6IatVwJTx2s6uSsDh49CcDK', 'Stéphanie', 'Joubert', '+338095807255', '95410', 'Morvan', 'Belgique', '1976-10-29', '79, rue de Didier'),
(36, 'luce64@sfr.fr', '[]', '$2y$13$aeB5ot1edvBlQu7zlPNDs.n78NAEjs6KG6l8WGZCIFs9iIs27jk0.', 'Émilie', 'Texier', '+337803026681', '50828', 'Meyer', 'France', '1993-09-06', '778, place Rodriguez'),
(37, 'margaret.faure@laposte.net', '[]', '$2y$13$oDsaY4MlUB1z5ikC/rlcse8pMwUN8GJWAFFVwPrjjxAmK3L/rttX2', 'Timothée', 'De Sousa', '+330110071317', '69 929', 'CarpentierBourg', 'Suisse', '2008-03-20', '58, rue Leger');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `FK_6117D13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `purchaseitem`
--
ALTER TABLE `purchaseitem`
  ADD CONSTRAINT `FK_8B4CD0E14584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_8B4CD0E1558FBEB9` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
