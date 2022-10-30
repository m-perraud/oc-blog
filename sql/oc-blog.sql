-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 30 oct. 2022 à 12:48
-- Version du serveur :  5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `oc-blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentUsername` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `commentMail` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `commentText` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentStatus` tinyint(1) NOT NULL DEFAULT '0',
  `postId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`postId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `commentUsername`, `commentMail`, `commentText`, `commentDate`, `commentStatus`, `postId`) VALUES
(9, 'user1', 'user1@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed consectetur dolor. Integer nec dui enim. Nam vel felis a justo blandit accumsan.', '2022-10-19 17:16:11', 1, 69),
(10, 'User2', 'melody.perraud@gmail.com', 'Morbi vel venenatis libero, et faucibus nisl. Nulla tempus faucibus fringilla.', '2022-10-19 17:16:30', 1, 69),
(11, 'User1', 'user1@gmail.com', 'Donec auctor diam sollicitudin dictum tempus. Praesent nunc velit, ornare vel diam et, gravida ornare mauris. Cras id arcu lacus. Donec nec ultricies ipsum.', '2022-10-19 17:16:59', 0, 67),
(12, 'User2', 'user2@gmail.com', 'Maecenas varius dui ut sapien hendrerit, vel mollis lectus dictum. Phasellus eu lorem euismod, vulputate justo sit amet, tincidunt ante. Nulla vitae dignissim nulla.\r\n\r\nAenean metus nisl, condimentum et gravida at, vehicula fermentum neque. Proin blandit mi a venenatis scelerisque.', '2022-10-19 17:17:24', 1, 65),
(13, 'User1', 'user1@gmail.com', 'Quisque porttitor pharetra turpis, at venenatis erat malesuada sed. Quisque ultrices velit lacus, ut congue lacus laoreet semper. Suspendisse mauris purus, blandit vitae enim eu, varius congue turpis. Nunc tincidunt est vestibulum risus volutpat tristique.', '2022-10-19 17:17:42', 0, 65);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `postChapo` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `postText` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postAuthor` int(11) NOT NULL,
  `postImage` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`postAuthor`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `postTitle`, `postChapo`, `postText`, `postDate`, `postAuthor`, `postImage`) VALUES
(57, 'Fallout 76', 'Todd Howard', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dignissim, leo sed dapibus accumsan, orci nisl lobortis eros, ut lobortis nisi augue non nulla. Nullam rutrum, lorem quis tincidunt eleifend, massa ex iaculis elit, vel eleifend nisl turpis ut nunc. Donec odio est, lacinia quis blandit vel, consectetur nec quam. Suspendisse eu hendrerit nisi. Aenean pretium, elit ac interdum tincidunt, sapien nibh condimentum neque, et convallis elit urna vel velit. Vivamus aliquet convallis tortor vel ultricies. Praesent congue, mauris nec molestie tempor, sem purus ornare leo, sed tincidunt erat quam id mauris. Duis cursus ipsum arcu, a accumsan tortor fringilla sed. Cras id tincidunt ipsum, sit amet hendrerit enim. Etiam convallis rhoncus aliquet. Nam rutrum nisi et mi malesuada cursus. Cras accumsan nisi eu nunc auctor laoreet.</p>', '2022-10-19 02:57:59', 56, '1666141079.jpg'),
(58, 'Persona 5', 'Atlus', '<p>Nam fermentum ante eget turpis tempor euismod. Maecenas interdum nunc orci, id commodo dolor finibus vel. In ac metus malesuada, fringilla tortor a, pulvinar ligula. Vivamus non pulvinar ipsum. Fusce justo turpis, congue nec malesuada nec, interdum eu tortor. Aliquam posuere pellentesque faucibus. Mauris auctor dolor nec mi suscipit, vel sollicitudin neque hendrerit. Sed egestas sodales dui, sit amet egestas eros scelerisque sed. Integer fermentum tristique nulla, sed tincidunt est sagittis nec. Ut sed diam sagittis urna sodales consequat eu sit amet massa.</p>', '2022-10-19 02:58:31', 56, '1666141112.jpg'),
(59, 'Undertale', 'Toby Fox ', '<p>Suspendisse auctor ullamcorper dui et venenatis. Nunc finibus venenatis luctus. Vivamus tempus, lorem eget ornare semper, nibh enim volutpat libero, vitae imperdiet dui nibh eget eros. Praesent vel ligula et metus eleifend fermentum at nec elit. Morbi eu pharetra nisl, nec iaculis arcu. Vestibulum maximus lorem sed lectus vestibulum, pharetra tristique nunc congue. Cras ullamcorper est ac risus tempus convallis.</p>', '2022-10-19 02:58:54', 56, '1666141135.jpg'),
(60, 'Death Stranding', 'Hideo Kojima', '<p>Pellentesque congue volutpat nisi ac eleifend. Quisque et molestie lorem. Pellentesque nec sem quis ex volutpat hendrerit. In sed laoreet lectus, eget placerat nibh. Proin et ultricies nulla. Maecenas consequat, enim ut ullamcorper ornare, diam mi feugiat arcu, tincidunt iaculis quam libero sed ante. Nullam venenatis nunc est, ac feugiat tellus fermentum in. Sed interdum mauris posuere felis scelerisque dictum. In viverra dolor felis, eu maximus sapien ultricies sit amet. Donec maximus convallis turpis, a pretium arcu. Aenean placerat diam id sem consectetur viverra. Sed quis volutpat dui.</p>', '2022-10-19 02:59:18', 56, '1666141158.jpg'),
(61, 'Super Mario Bros', 'Shigeru Miyamoto', '<p>Mauris nec ultricies neque. Donec ac orci leo. Mauris et sapien ornare, consequat turpis et, cursus nisl. Cras gravida ornare vestibulum. Vestibulum felis urna, eleifend nec condimentum quis, interdum a tellus. Phasellus facilisis neque ac tincidunt posuere. Donec magna eros, imperdiet ac ultrices elementum, aliquet sit amet risus. Pellentesque vulputate, elit eget consequat ultrices, quam ante pharetra lorem, et finibus ipsum risus vitae orci. Integer fringilla lectus in augue posuere, eget ullamcorper enim fringilla. Donec eros lacus, accumsan at nunc sit amet, ultrices scelerisque felis. Suspendisse suscipit varius pharetra. Integer hendrerit eros in laoreet pharetra. Sed scelerisque nisl sit amet nulla egestas, ac egestas ipsum dapibus.</p>', '2022-10-19 02:59:56', 56, '1666141196.jpg'),
(62, 'Arkham City', 'Mark Hamill', '<p>Nullam lobortis consectetur lectus, vel lacinia eros egestas nec. Cras tempus condimentum mi, quis blandit dolor rhoncus non. In hac habitasse platea dictumst. Donec nec metus nunc. Aenean accumsan non risus et pulvinar. Integer magna dolor, iaculis eget semper vitae, congue aliquet turpis. Integer aliquam dui eget massa suscipit, eget rutrum enim lobortis. Morbi ipsum sem, rutrum at fringilla id, pulvinar nec nisi. Nunc dapibus bibendum mi, in placerat odio euismod non. Nam facilisis tellus ut odio efficitur, quis ullamcorper eros pellentesque. Nullam porta tellus massa, non fermentum nisi commodo in. Vivamus ut iaculis massa. Vivamus pellentesque finibus ligula, et laoreet erat accumsan sed. Cras odio velit, sagittis vulputate massa quis, convallis molestie nibh. Quisque vitae volutpat velit.</p>', '2022-10-19 03:00:29', 56, '1666141229.jpg'),
(63, 'Marvel : Spiderman', 'Donald Reignoux ', '<p>Nam placerat, urna quis tempor commodo, magna arcu bibendum lacus, id ullamcorper odio quam at nunc. Quisque a nibh lacus. Donec nec elit nec massa varius placerat. Donec laoreet metus risus. Duis eu leo vehicula, finibus arcu non, ornare sapien. Sed eu tempus quam, vitae gravida ipsum. Etiam odio sapien, bibendum vel dignissim sed, vestibulum at orci. Vestibulum tempor vitae erat et tristique. Phasellus eleifend sagittis ullamcorper. Nulla diam libero, ornare a arcu quis, sagittis auctor neque. Ut maximus velit non turpis ultrices, vitae convallis nisi faucibus. Nunc commodo purus lacinia risus commodo dictum. Vestibulum leo nisl, vestibulum vitae fermentum ac, malesuada ac felis. Sed pulvinar felis ut ante interdum ornare. Donec tempus eu lorem et mollis.</p>', '2022-10-19 03:00:57', 56, '1666141258.jpg'),
(64, 'God of War', 'Cori Balrog', '<p>Nullam lobortis consectetur lectus, vel lacinia eros egestas nec. Cras tempus condimentum mi, quis blandit dolor rhoncus non. In hac habitasse platea dictumst. Donec nec metus nunc. Aenean accumsan non risus et pulvinar. Integer magna dolor, iaculis eget semper vitae, congue aliquet turpis. Integer aliquam dui eget massa suscipit, eget rutrum enim lobortis. Morbi ipsum sem, rutrum at fringilla id, pulvinar nec nisi. Nunc dapibus bibendum mi, in placerat odio euismod non. Nam facilisis tellus ut odio efficitur, quis ullamcorper eros pellentesque. Nullam porta tellus massa, non fermentum nisi commodo in. Vivamus ut iaculis massa. Vivamus pellentesque finibus ligula, et laoreet erat accumsan sed. Cras odio velit, sagittis vulputate massa quis, convallis molestie nibh. Quisque vitae volutpat velit.</p>', '2022-10-19 03:01:49', 56, '1666141310.jpg'),
(65, 'World of Warcraft', 'Ion Hazzikostas', '<p>Nam placerat, urna quis tempor commodo, magna arcu bibendum lacus, id ullamcorper odio quam at nunc. Quisque a nibh lacus. Donec nec elit nec massa varius placerat. Donec laoreet metus risus. Duis eu leo vehicula, finibus arcu non, ornare sapien. Sed eu tempus quam, vitae gravida ipsum. Etiam odio sapien, bibendum vel dignissim sed, vestibulum at orci. Vestibulum tempor vitae erat et tristique. Phasellus eleifend sagittis ullamcorper. Nulla diam libero, ornare a arcu quis, sagittis auctor neque. Ut maximus velit non turpis ultrices, vitae convallis nisi faucibus. Nunc commodo purus lacinia risus commodo dictum. Vestibulum leo nisl, vestibulum vitae fermentum ac, malesuada ac felis. Sed pulvinar felis ut ante interdum ornare. Donec tempus eu lorem et mollis.</p>', '2022-10-19 03:02:28', 56, '1666141348.jpg'),
(66, 'Coloring Game', 'L.Stotch', '<p>Quisque pellentesque in enim a ornare. Fusce vitae enim lorem. Phasellus in dolor venenatis nisi malesuada congue. Proin consequat lacus lacus, id accumsan ipsum lobortis eget. Vivamus varius, metus at dignissim sagittis, tortor justo maximus metus, sed laoreet diam nunc ut ipsum. Donec varius purus ante, vitae vestibulum mauris bibendum scelerisque. Vivamus ligula mauris, iaculis eu semper vel, ultrices ut mi. Mauris placerat placerat venenatis. Etiam sodales egestas rhoncus. Curabitur ac placerat tortor, et aliquam dolor. Aliquam id eros risus. Aliquam imperdiet, diam quis varius condimentum, urna metus posuere ipsum, sit amet mollis eros lorem non urna.</p>', '2022-10-19 03:03:36', 56, '1666141417.jpg'),
(67, 'Neon White', 'Annapurna Interactive', '<p>Aliquam in elementum mauris, nec finibus lorem. Nullam et faucibus erat. Sed et elementum neque, ac ultrices augue. Fusce laoreet ex ac massa sodales dictum vitae id est. Vestibulum velit lectus, ullamcorper et ex sit amet, scelerisque mattis dui. Aliquam sodales porttitor congue. Aenean ac justo eu justo mollis finibus. Sed elementum nisl quis metus fringilla, vitae iaculis quam luctus. Nam faucibus nec enim in scelerisque. Suspendisse dapibus cursus efficitur. Integer ullamcorper mattis mi, in lobortis magna facilisis ut. Vivamus consectetur dui elit, eleifend vulputate erat dictum in. Donec sem neque, egestas sit amet enim ut, laoreet interdum mi. Donec suscipit, nunc in semper mollis, lorem enim consectetur erat, quis mollis leo velit vitae libero.</p>', '2022-10-19 03:04:03', 56, '1666141444.jpg'),
(68, 'Stardew Valley', 'ConcernedApe', '<p>Quisque quis mi eros. In ut gravida lectus. Sed dapibus luctus dapibus. Quisque nulla mauris, vestibulum non lectus eget, cursus venenatis turpis. Curabitur mollis arcu nisi, ut dapibus ipsum semper lacinia. Phasellus vel suscipit sem. Phasellus nibh ligula, commodo vel venenatis vel, egestas vitae massa. Vestibulum vehicula, sem sit amet mattis iaculis, lectus tellus molestie elit, eget vulputate justo sem et ex. Pellentesque ullamcorper venenatis erat, et malesuada tortor accumsan consectetur. Praesent odio lacus, eleifend id lacus sed, posuere ultricies orci.</p>', '2022-10-19 03:04:41', 56, '1666141482.jpg'),
(69, 'The binding of Isaac', 'Edmund McMillen', '<p>Mauris vitae luctus elit. Proin condimentum semper magna, nec luctus tortor posuere a. Sed fermentum mi sed dapibus elementum. Ut elementum, leo et dignissim condimentum, ligula diam luctus lectus, et ultricies ligula nibh vitae tortor. Phasellus nec neque eu dolor dictum molestie. Maecenas tincidunt, nisl vitae malesuada ornare, lacus purus viverra ex, a fermentum dolor enim in ipsum. Mauris tellus arcu, sollicitudin in elementum et, scelerisque at nisi. Duis sed varius libero. Nulla et venenatis ex, quis rhoncus tortor. Duis quis lectus mattis, tempus nisi nec, laoreet nibh.</p>', '2022-10-19 03:05:21', 56, '1666141521.jpg'),
(70, 'The Witcher 3', 'CD Projekt Red', '<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam id felis convallis, efficitur nulla non, facilisis dolor. Nam ut dolor sed ante rutrum tincidunt et ut augue. Sed sed turpis vulputate, molestie quam eget, rhoncus quam. Vivamus ac euismod lorem, ac euismod est. Nullam sit amet ultricies nulla, congue bibendum odio. Nullam lobortis blandit nisi, sollicitudin gravida mauris blandit eget. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer in viverra libero. Curabitur at massa eu orci pharetra facilisis et ut erat. Donec purus lacus, ultrices in dictum id, semper sed lectus. Mauris at velit sit amet nisi elementum viverra. Suspendisse dignissim, sapien nec auctor aliquam, augue velit fringilla erat, quis varius nisi sem eget turpis. Pellentesque magna velit, tristique et augue eget, dictum blandit libero. Curabitur augue mi, pellentesque sed aliquet vel, cursus luctus diam. Morbi est sapien, pellentesque sed odio sit amet, aliquam fermentum tortor.</p>', '2022-10-19 03:05:56', 56, '1666141557.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userMail` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `adminLogin` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `adminPW` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `adminStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userMail` (`userMail`),
  UNIQUE KEY `adminLogin` (`adminLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `userMail`, `adminLogin`, `adminPW`, `adminStatus`) VALUES
(56, 'admin1@gmail.com', 'Admin1', '$2y$10$3v8k6WuNBLml3nXLly7GYOyE9K6UnfwbpDwQ0ts6y8zUwfrZz4sHy', 1),
(57, 'admin2@gmail.com', 'Admin2', '$2y$10$NJZaM5BdnnLjdjnFc1DHReDi9r2Rlf9ta1tF.8wTajEVCGmApnmwa', 1),
(58, 'admin3@gmail.com', 'Admin3', '$2y$10$uhi8YwPEaPR7HCut97ekIuRJWDT7p4hfvVKmGc9jLj.IN6ROVJGOi', 1),
(59, 'user1@gmail.com', 'User1', '$2y$10$J1FWjkwXP74YytoUJz20q.EJiM20lxu.HRr/8uP/gXAEy.q2o.CJq', 0),
(60, 'user2@gmail.com', 'User2', '$2y$10$iL51YMy8Y178u.EjEW0sFeVgl/t/qL3EfGGraJ3E3wUaGQ8nvQq1e', 0),
(61, 'user3@gmail.com', 'User3', '$2y$10$Ma.HQY0sXM53HbtxFNiYA.wNLomisrFADV2jU/szB2/TznPMT2jUy', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`postAuthor`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
