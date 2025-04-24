-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Sam 17 Août 2013 à 00:32
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `creative`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer_option`
--

CREATE TABLE IF NOT EXISTS `answer_option` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `QUESTION_id` smallint(5) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`QUESTION_id`),
  KEY `fk_ANSWER_OPTION_QUESTION1_idx` (`QUESTION_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `answer_option-member`
--

CREATE TABLE IF NOT EXISTS `answer_option-member` (
  `ANSWER_OPTION_id` mediumint(8) unsigned NOT NULL,
  `ANSWER_OPTION_QUESTION_id` smallint(5) unsigned NOT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ANSWER_OPTION_id`,`ANSWER_OPTION_QUESTION_id`,`MEMBER_id`),
  KEY `fk_ANSWER_OPTION_has_MEMBER_MEMBER1_idx` (`MEMBER_id`),
  KEY `fk_ANSWER_OPTION_has_MEMBER_ANSWER_OPTION1_idx` (`ANSWER_OPTION_id`,`ANSWER_OPTION_QUESTION_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `answre_free`
--

CREATE TABLE IF NOT EXISTS `answre_free` (
  `QUESTION_id` smallint(5) unsigned NOT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`QUESTION_id`,`MEMBER_id`),
  KEY `fk_ANSWRE_FREE_QUESTION1_idx` (`QUESTION_id`),
  KEY `fk_ANSWRE_FREE_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `answre_free`
--

INSERT INTO `answre_free` (`QUESTION_id`, `MEMBER_id`, `answer`) VALUES
(1, 1, '8'),
(2, 1, 'middle'),
(7, 1, 'XoRoX'),
(8, 1, 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `CATEGORY_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_NEWS_CATEGORY1_idx` (`CATEGORY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `created`, `content`, `CATEGORY_id`) VALUES
(1, 'bienvenue', '2012-08-31 07:27:08', '<div class="center">\r\nJe viens de finir ma formation et suis dès à présent à la recherche d''un travail en Ile-de-France.<br />\r\n\r\nje souhaite intégrer une équipe de développement logiciel afin d’enrichir mon expérience professionnelle et pouvoir mettre à profit celle déjà acquise.<br />\r\n\r\nMa formation m''a permis d''apporcher des languages, tels que : c, c++, java, php procédural et orienté objet, SQL,vb.net, delphi, windev.<br />\r\n\r\nCurieux, j''aime me documenter et j''ai donc naturellement appris un peu plus de ces languages grâce à certains sites internet.<br />\r\n\r\nRigoureux et méthodique, je vous assure de mon investissement dans le travail que vous me confierez.<br />\r\n\r\nJe me tiens à votre entière disposition pour tout renseignement complémentaire et je vous remercie par avance de l''attention que vous porterez à ma demande.<br />\r\n\r\nJe vous prie d''agréer, Madame, Monsieur, l''expression de mes salutations distinguées.\r\n</div>', 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_has_content`
--

CREATE TABLE IF NOT EXISTS `article_has_content` (
  `ARTICLE_id` smallint(5) unsigned NOT NULL,
  `CONTENT_id` smallint(5) unsigned NOT NULL,
  `position` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`ARTICLE_id`,`CONTENT_id`),
  KEY `fk_ARTICLE_has_CONTENT_CONTENT1_idx` (`CONTENT_id`),
  KEY `fk_ARTICLE_has_CONTENT_ARTICLE1_idx` (`ARTICLE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article_has_content`
--

INSERT INTO `article_has_content` (`ARTICLE_id`, `CONTENT_id`, `position`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `availability`
--

CREATE TABLE IF NOT EXISTS `availability` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `monday` binary(48) DEFAULT NULL,
  `tuesday` binary(48) DEFAULT NULL,
  `wednesday` binary(48) DEFAULT NULL,
  `thursday` binary(48) DEFAULT NULL,
  `friday` binary(48) DEFAULT NULL,
  `saturday` binary(48) DEFAULT NULL,
  `sunday` binary(48) DEFAULT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_AVAILABILITY_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `away`
--

CREATE TABLE IF NOT EXISTS `away` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `departure` timestamp NULL DEFAULT NULL,
  `comeback` timestamp NULL DEFAULT NULL,
  `message` tinytext COLLATE utf8_unicode_ci,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_AWAY_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `block`
--

INSERT INTO `block` (`id`, `name`) VALUES
(1, 'banner'),
(2, 'menu'),
(3, 'content'),
(4, 'footer');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE_CATEGORY_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CATEGORY_TYPE_CATEGORY1_idx` (`TYPE_CATEGORY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `TYPE_CATEGORY_id`) VALUES
(1, 'none', NULL, 1),
(2, 'C.V.', 'Voici les différents formats dans lequel vous pouvez télécharger mon C.V. : ', 2),
(3, 'Vcard', 'Ces deux fichiers sont en faites des cartes de visites virtuels, qui vous permettent de m''enregistrer dans votre carnet d''adresse.Le format "Vcard" est principalement utilisé par les logiciels microsoft, tandis que le format "LDIF" est principalement util', 2),
(4, 'LOGICIEL LIBRE', NULL, 3),
(5, 'AUTRES', NULL, 3),
(6, 'BLOGS', NULL, 3),
(7, 'STANDARD / VALIDATION', NULL, 3),
(8, 'GENERAL', NULL, 3),
(9, 'HTML', NULL, 3),
(10, 'PHP', NULL, 3),
(11, 'JAVASCRIPT', NULL, 3),
(12, 'LINUX', NULL, 3),
(13, 'GRAPHISME', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `confrontation`
--

CREATE TABLE IF NOT EXISTS `confrontation` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `schedule` timestamp NULL DEFAULT NULL,
  `LINEUP_id` smallint(5) unsigned NOT NULL,
  `OPPONENT_id` smallint(5) unsigned NOT NULL,
  `TYPE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_MATCH_LINEUP1_idx` (`LINEUP_id`),
  KEY `fk_MATCH_OPPONENT1_idx` (`OPPONENT_id`),
  KEY `fk_MATCH_TYPE1_idx` (`TYPE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `confrontation`
--

INSERT INTO `confrontation` (`id`, `schedule`, `LINEUP_id`, `OPPONENT_id`, `TYPE_id`) VALUES
(1, '2012-06-14 14:10:09', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `object` tinyint(3) unsigned DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `created` timestamp NULL DEFAULT NULL,
  `wasRead` tinyint(1) DEFAULT '0',
  `answered` tinyint(1) DEFAULT '0',
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `OBJECT_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONTACT_MEMBER1_idx` (`MEMBER_id`),
  KEY `fk_CONTACT_OBJECT1_idx` (`OBJECT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact_not_account`
--

CREATE TABLE IF NOT EXISTS `contact_not_account` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `OBJECT_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONTACT_NOT_ACCOUNT_OBJECT1_idx` (`OBJECT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `enable` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONTENT_TYPE1_idx` (`TYPE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `content`
--

INSERT INTO `content` (`id`, `enable`, `name`, `TYPE_id`) VALUES
(1, 1, 'home', 2);

-- --------------------------------------------------------

--
-- Structure de la table `content-page`
--

CREATE TABLE IF NOT EXISTS `content-page` (
  `CONTENT_id` smallint(5) unsigned NOT NULL,
  `PAGE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`CONTENT_id`,`PAGE_id`),
  KEY `fk_CONTENT_has_PAGE_PAGE1_idx` (`PAGE_id`),
  KEY `fk_CONTENT_has_PAGE_CONTENT1_idx` (`CONTENT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `content-page`
--

INSERT INTO `content-page` (`CONTENT_id`, `PAGE_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demo`
--

CREATE TABLE IF NOT EXISTS `demo` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `TYPE_id` smallint(5) unsigned NOT NULL,
  `CONFRONTATION_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_DEMO_TYPE1_idx` (`TYPE_id`),
  KEY `fk_DEMO_WAR1_idx` (`CONFRONTATION_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CATEGORY_id` smallint(5) unsigned NOT NULL,
  `EXTENSION_NAME_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_DOWNLOAD_CATEGORY1_idx` (`CATEGORY_id`),
  KEY `fk_DOWNLOAD_EXTENSION_NAME1_idx` (`EXTENSION_NAME_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `download`
--

INSERT INTO `download` (`id`, `title`, `CATEGORY_id`, `EXTENSION_NAME_id`) VALUES
(1, 'Format Vcard (.vcf)', 3, 1),
(2, 'Format LDIF (.ldif)', 3, 2),
(3, 'Format Word 2007 (.docx)', 2, 3),
(4, 'Format Word 1997-2003 (.doc)', 2, 4),
(5, 'Format Acrobat Reader (.pdf)', 2, 5),
(6, 'Format Open Office (.odt)', 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `driving_license`
--

CREATE TABLE IF NOT EXISTS `driving_license` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `driving_license`
--

INSERT INTO `driving_license` (`id`, `name`) VALUES
(1, 'B');

-- --------------------------------------------------------

--
-- Structure de la table `driving_license-member`
--

CREATE TABLE IF NOT EXISTS `driving_license-member` (
  `DRIVING_LICENSE_id` smallint(5) unsigned NOT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`DRIVING_LICENSE_id`,`MEMBER_id`),
  KEY `fk_DRIVING_LICENSE_has_MEMBER_MEMBER1_idx` (`MEMBER_id`),
  KEY `fk_DRIVING_LICENSE_has_MEMBER_DRIVING_LICENSE1_idx` (`DRIVING_LICENSE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `driving_license-member`
--

INSERT INTO `driving_license-member` (`DRIVING_LICENSE_id`, `MEMBER_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `extension`
--

CREATE TABLE IF NOT EXISTS `extension` (
  `id` smallint(6) NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXTENSION_NAME_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_EXTENSION_EXTENSION_NAME1_idx` (`EXTENSION_NAME_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `extension`
--

INSERT INTO `extension` (`id`, `extension`, `EXTENSION_NAME_id`) VALUES
(1, 'vcf', 1),
(2, 'ldif', 2),
(3, 'docx', 3),
(4, 'doc', 4),
(5, 'pdf', 5),
(6, 'odt', 6);

-- --------------------------------------------------------

--
-- Structure de la table `extension_name`
--

CREATE TABLE IF NOT EXISTS `extension_name` (
  `id` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE_FILE_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_EXTENSION_NAME_TYPE_FILE1_idx` (`TYPE_FILE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `extension_name`
--

INSERT INTO `extension_name` (`id`, `name`, `TYPE_FILE_id`) VALUES
(1, 'Vcard', 2),
(2, 'LDIF', 2),
(3, 'Word 2007', 1),
(4, 'Word 1997', 1),
(5, 'Acrobat', 1),
(6, 'Open Office texte', 1);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `name`) VALUES
(1, 'CS');

-- --------------------------------------------------------

--
-- Structure de la table `game-question`
--

CREATE TABLE IF NOT EXISTS `game-question` (
  `GAME_id` smallint(5) unsigned NOT NULL,
  `QUESTION_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`QUESTION_id`,`GAME_id`),
  KEY `fk_GAME_has_QUESTION_QUESTION1_idx` (`QUESTION_id`),
  KEY `fk_GAME_has_QUESTION_GAME1_idx` (`GAME_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `game-question`
--

INSERT INTO `game-question` (`GAME_id`, `QUESTION_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `gaming_details`
--

CREATE TABLE IF NOT EXISTS `gaming_details` (
  `id` int(11) NOT NULL,
  `steamFriend` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `gaming_details`
--

INSERT INTO `gaming_details` (`id`, `steamFriend`) VALUES
(1, 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `hardware`
--

CREATE TABLE IF NOT EXISTS `hardware` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `computerCase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monitor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyboard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `speaker` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `headset` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `powerSupplie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graphicsCard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherboard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `memory` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayResolution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soundCard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `connectionSpeed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ISP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONFIGURATION_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lineup`
--

CREATE TABLE IF NOT EXISTS `lineup` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GAME_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_LINEUP_GAME1_idx` (`GAME_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `lineup`
--

INSERT INTO `lineup` (`id`, `name`, `GAME_id`) VALUES
(1, 'LU 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `link`
--

INSERT INTO `link` (`id`, `name`, `link`) VALUES
(1, 'Accueil', 'index.php'),
(2, 'C.V.', 'index.php?module=cv'),
(3, 'Portefolio', 'index.php?module=portefolio'),
(4, 'Téléchargement', 'index.php?module=download'),
(5, 'Contact', 'index.php?module=contact'),
(6, 'Liens', 'index.php?module=links'),
(7, 'a', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CATEGORY_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_LINKS_CATEGORY1_idx` (`CATEGORY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Contenu de la table `links`
--

INSERT INTO `links` (`id`, `name`, `link`, `description`, `CATEGORY_id`) VALUES
(1, 'Framasoft', 'http://www.framasoft.net', 'Un réseau de sites web collaboratifs sur le libre en général.', 4),
(2, 'Clubic', 'http://www.clubic.com/', 'Un bon site pour trouver des logiciels (libres ou non).', 5),
(3, 'Hardware.fr', 'http://www.hardware.fr/', 'Si vous désirez en savoir plus sur ce qu''il y a dans vos PC, ce site est tout indiqué.', 5),
(4, 'Gros pixels', 'http://www.grospixels.com/site/encysyst.php', 'Description des grandes marques qui ont fait l''histoire de l''informatique et de la console!', 5),
(5, 'Le StandBlog', 'http://standblog.org/', 'Le blog de Tristan Nitot qui porte principalement sur les standards du Web, les navigateurs et la technologie, très souvent mis à jour et contenu de qualité.', 6),
(6, 'Blog and Blues', 'http://blog-and-blues.org/', 'Le blog de Laurent Denis qui porte sur les techniques et standards de la qualité web, de nombreuses informations de qualité.', 6),
(7, 'Openweb', 'http://openweb.eu.org/', 'Le site pour apprendre ce qu''il faut savoir sur les standards du web.', 7),
(8, 'Le W3C', 'http://www.w3.org/', 'Le site des normes de divers langages ((X)HTML, CSS, etc...), ainsi que des validateurs de code pour vérifier si votre code est aux normes.', 7),
(9, 'Validateur RSS', 'http://feedvalidator.org/', 'Pratique pour créer un fil RSS normé.', 7),
(10, 'Yoyodesign', 'http://www.yoyodesign.org/doc/w3c/index.php', 'Ce site présente les traductions de certaines spécifications du W3C en français.', 7),
(11, 'Opquast', 'http://www.opquast.com/', 'Un ensemble de recommandations pour améliorer les sites web en général.', 7),
(12, 'Ocawa', 'http://www.ocawa.com/', 'Un validateur d''accessibilité.', 7),
(13, 'Accessiweb', 'http://www.accessiweb.org/', 'Des conseils pour rendre un site web plus accessible.', 7),
(14, 'Commentcamarche.net', 'http://www.commentcamarche.net/', 'Un site de vulgarisation informatique en général (la programmation, les réseaux, etc...).', 8),
(15, 'W3Schools.com', 'http://www.w3schools.com/', 'Tutoriaux complets sur les différentes technologies utilisées sur le web : HTML, XHTML, XML, CSS, JavaScript...', 8),
(16, 'HotScripts', 'http://www.hotscripts.com/', 'Regroupe de nombreux codes sources et ressources pour les différents langages utilisés sur le web.', 8),
(17, 'Pompage.net', 'http://www.pompage.net/', 'Un site où l''on peut trouver des traductions francophones des derniers tutoriels et autres documents concernant la conception de sites.', 9),
(18, 'XHTML.net', 'http://www.xhtml.net/xhtmlcss/', 'Des articles intéressants et bien construits.', 9),
(19, 'Alsacreations', 'http://www.alsacreations.com/articles/', 'Des tutoriels sur le XHTML et les CSS. Très accessible et de bonne qualité.', 9),
(20, 'getElementById.com', 'http://getelementbyid.com/news/index.aspx', 'Site sur le DHTML', 9),
(21, 'NeXeN', 'http://www.nexen.net/', 'Site actif et complet en français sur le PHP et MySQL', 10),
(22, 'ASP-PHP.net', 'http://www.asp-php.net/', 'Un très bon site pour apprendre le PHP et/ou l''ASP.', 10),
(23, 'Tout JavaScript', 'http://www.toutjavascript.com/main/index.php3', 'Vous y trouverez des cours et des scripts', 11),
(24, 'Venkman', 'https://developer.mozilla.org/en-US/docs/Venkman', 'Débogger JavaScript (Fonctionne avec Mozilla)', 11),
(25, 'TooLinux', 'http://www.toolinux.com/', 'Portail français consacré à Linux', 12),
(26, 'Linux Online', 'http://www.linux.org/', 'Généralités sur linux', 12),
(27, 'Linuxfr', 'http://linuxfr.org/', 'Un très bon site sur Linux, et le monde du libre en général. Très souvent mis à jour et contenu de qualité.', 12),
(28, 'Linuxgraphic', 'http://www.linuxgraphic.org/wp/', 'Graphistes, ce site est fait pour vous. Vous ne pourrez plus dire qu''il est impossible de faire du graphisme sous Linux!', 12),
(29, 'shellunix', 'http://www.shellunix.com/', 'Site qui résume les principales commandes unix, sh, csh, ksh, sed, awk...', 12),
(30, 'Rpmfind', 'http://rpmfind.net/', 'Un moteur de recherche de "rpms", pour trouver des tonnes de programmes sous Mandrake, Redhat, etc...', 12),
(31, 'ibiblio linux archive', 'http://www.ibiblio.org/software/linux/', 'Ensemble de programmes pour Linux et copie des principales distributions', 12),
(32, 'Position is Everything', 'http://www.positioniseverything.net/explorer.html', 'Un excellent site sur les problèmes de positionnements via le CSS.', 13),
(33, 'Ergolab', 'http://www.ergolab.net/', 'Des conseils sur l''ergonomie web et logiciel.', 13);

-- --------------------------------------------------------

--
-- Structure de la table `link_has_content`
--

CREATE TABLE IF NOT EXISTS `link_has_content` (
  `LINK_id` smallint(5) unsigned NOT NULL,
  `BLOCK_id` tinyint(3) unsigned NOT NULL,
  `position` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`LINK_id`,`BLOCK_id`),
  KEY `fk_LINK_has_CONTENT_LINK1_idx` (`LINK_id`),
  KEY `fk_LINK_has_CONTENT_BLOCK1_idx` (`BLOCK_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `link_has_content`
--

INSERT INTO `link_has_content` (`LINK_id`, `BLOCK_id`, `position`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE IF NOT EXISTS `localisation` (
  `id` smallint(6) NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `localisation`
--

INSERT INTO `localisation` (`id`, `adress`, `cp`, `town`, `country`, `nationality`, `department`) VALUES
(1, '1017 Boulevard de la Paix', '14200', 'HEROUVILLE SAINT CLAIR', 'france', 'français', 'basse-normandie');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `side1CT` tinyint(1) DEFAULT NULL,
  `resultSide1Us` tinyint(4) DEFAULT NULL,
  `resultSide2Us` tinyint(4) DEFAULT NULL,
  `resultSide1Them` tinyint(4) DEFAULT NULL,
  `resultSide2Them` tinyint(4) DEFAULT NULL,
  `rapport` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CONFRONTATION_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_map_MATCH1_idx` (`CONFRONTATION_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nick` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `sendEmail` tinyint(1) DEFAULT '0',
  `GAMING_DETAILS_id` int(11) DEFAULT NULL,
  `PERSONAL_DETAILS_id` mediumint(9) DEFAULT NULL,
  `LOCALISATION_id` smallint(6) DEFAULT NULL,
  `RESUME_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_MEMBER_GAMING_DETAILS1_idx` (`GAMING_DETAILS_id`),
  KEY `fk_MEMBER_PERSONAL_DETAILS1_idx` (`PERSONAL_DETAILS_id`),
  KEY `fk_MEMBER_LOCALISATION1_idx` (`LOCALISATION_id`),
  KEY `fk_MEMBER_RESUME_PERSONAL_DETAILS1_idx` (`RESUME_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `created`, `email`, `nick`, `password`, `admin`, `sendEmail`, `GAMING_DETAILS_id`, `PERSONAL_DETAILS_id`, `LOCALISATION_id`, `RESUME_id`) VALUES
(1, '2012-06-12 15:57:26', 'emploi@lucas-girard.fr', 'XoRoX', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 1, 0, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `member-lineup`
--

CREATE TABLE IF NOT EXISTS `member-lineup` (
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `LINEUP_id` smallint(5) unsigned NOT NULL,
  `rang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MEMBER_id`,`LINEUP_id`),
  KEY `fk_MEMBER_has_LINEUP_LINEUP1_idx` (`LINEUP_id`),
  KEY `fk_MEMBER_has_LINEUP_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `member-vehicle`
--

CREATE TABLE IF NOT EXISTS `member-vehicle` (
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `VEHICLE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`MEMBER_id`,`VEHICLE_id`),
  KEY `fk_MEMBER_has_VEHICLE_VEHICLE1_idx` (`VEHICLE_id`),
  KEY `fk_MEMBER_has_VEHICLE_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `member-vehicle`
--

INSERT INTO `member-vehicle` (`MEMBER_id`, `VEHICLE_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `CATEGORY_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_NEWS_MEMBER_idx` (`MEMBER_id`),
  KEY `fk_NEWS_CATEGORY1_idx` (`CATEGORY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `title`, `created`, `intro`, `content`, `MEMBER_id`, `CATEGORY_id`) VALUES
(1, 'test', '2012-06-12 15:58:10', 'test intro', 'test content', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `news_has_content`
--

CREATE TABLE IF NOT EXISTS `news_has_content` (
  `NEWS_id` smallint(5) unsigned NOT NULL,
  `CONTENT_id` smallint(5) unsigned NOT NULL,
  `position` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`NEWS_id`,`CONTENT_id`),
  KEY `fk_NEWS_has_CONTENT_CONTENT1_idx` (`CONTENT_id`),
  KEY `fk_NEWS_has_CONTENT_NEWS1_idx` (`NEWS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `object`
--

CREATE TABLE IF NOT EXISTS `object` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `opponent`
--

CREATE TABLE IF NOT EXISTS `opponent` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineup` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `opponent`
--

INSERT INTO `opponent` (`id`, `name`, `site`, `lineup`) VALUES
(1, 'noob', 'www.noob.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CATEGORY_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PAGE_CATEGORY1_idx` (`CATEGORY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `name`, `CATEGORY_id`) VALUES
(1, 'home', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personal_details`
--

CREATE TABLE IF NOT EXISTS `personal_details` (
  `id` mediumint(9) NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maritalStatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthPlace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `personal_details`
--

INSERT INTO `personal_details` (`id`, `firstName`, `lastName`, `gender`, `maritalStatus`, `birthday`, `birthPlace`) VALUES
(1, 'lucas', 'girard', 'm', 'célibataire', '1988-10-07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE_TYPE_id` smallint(5) unsigned NOT NULL,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PHONE_PHONE_TYPE1_idx` (`PHONE_TYPE_id`),
  KEY `fk_PHONE_MEMBER1_idx` (`MEMBER_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `phone`
--

INSERT INTO `phone` (`id`, `name`, `number`, `PHONE_TYPE_id`, `MEMBER_id`) VALUES
(1, 'Telephone Fixe', '02/31/94/00/47', 1, 1),
(2, 'Telephone Mobile', '07/70/64/67/09', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `phone_type`
--

CREATE TABLE IF NOT EXISTS `phone_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `phone_type`
--

INSERT INTO `phone_type` (`id`, `name`) VALUES
(1, 'fixe'),
(2, 'mobile');

-- --------------------------------------------------------

--
-- Structure de la table `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `object` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `MEMBER_idSend` smallint(5) unsigned NOT NULL,
  `MEMBER_idReceive` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PM_MEMBER1_idx` (`MEMBER_idSend`),
  KEY `fk_PM_MEMBER2_idx` (`MEMBER_idReceive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`) VALUES
(1, 'Sites Internet'),
(3, 'Module site internet'),
(4, 'Jeux');

-- --------------------------------------------------------

--
-- Structure de la table `portfolio_element`
--

CREATE TABLE IF NOT EXISTS `portfolio_element` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `technology` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PORTFOLIO_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PORTFOLIO_ELEMENT_PORTFOLIO1_idx` (`PORTFOLIO_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `portfolio_element`
--

INSERT INTO `portfolio_element` (`id`, `name`, `link`, `type`, `technology`, `comment`, `PORTFOLIO_id`) VALUES
(1, 'Panel TeamSpeak', '', 'Aide ponctuel sur du PHP.', 'PHP, PERL.', 'ce site a été créé pour administrer un serveur TeamSpeak version 2 (logiciel de VOIP, principalement utilisé par les joueurs).', 1),
(2, 'Plus ou moins ?', 'javascript:lauch()', 'Développement didactique.', 'JavaScript<script type=''text/javascript'' src=''js/moreLess.js''></script>', '', 4),
(4, 'Upload + retouche image', 'test/imageCrop/', 'Module de VER''SON OPTIQUE.', 'XHTML 1.1 STRICT, CSS 2, JavaScript.', 'Ce module a été mis en place pour faciliter le remplissage de la galerie. Il a évité l’installation et l’utilisation d’un logiciel pour la correction simple des images.', 3),
(5, 'Disponibilité', 'test/dispo/', 'Développement didactique.', 'XHTML, CSS, JavaScript.', 'Va de pair avec un autre module qui signale les absences ponctuel entre deux dates et/ou heures.', 3),
(6, 'VER''SON OPTIQUE', 'test/VOL/', 'contrat pour la création d''un site internet.', 'XHTML 1.1 STRICT, CSS 2, JavaScript.', 'création d''un site internet bilingue à partir de zéro et administrable par une personne n''ayant jamais fait ça.', 1),
(7, 'CRESS BN', 'http://www.cress-bn.org/', 'contrat pour la création d''un site internet.', 'XHTML, CSS 3, JavaScript.', 'la demande principale était le remplacement urgent du site précèdent car piraté.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE_QUESTION_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_QUESTION_TYPE_QUESTION1_idx` (`TYPE_QUESTION_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `question`, `TYPE_QUESTION_id`) VALUES
(1, 'XP', 1),
(2, 'LVL', 1),
(3, 'T_P', 5),
(4, 'T_A', 5),
(5, 'CT_P', 5),
(6, 'CT_A', 5),
(7, 'pseudo', 1),
(8, 'steamid', 1);

-- --------------------------------------------------------

--
-- Structure de la table `recruitment`
--

CREATE TABLE IF NOT EXISTS `recruitment` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `microphone` tinyint(4) DEFAULT NULL,
  `TS3` tinyint(4) DEFAULT NULL,
  `WIRE` tinyint(4) DEFAULT NULL,
  `knowUs` tinyint(4) DEFAULT NULL,
  `other` text COLLATE utf8_unicode_ci,
  `MEMBER_id` smallint(5) unsigned NOT NULL,
  `GAME_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RECRUITMENT_MEMBER1_idx` (`MEMBER_id`),
  KEY `fk_RECRUITMENT_GAME1_idx` (`GAME_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `vcard` tinyint(1) DEFAULT NULL,
  `ldif` tinyint(1) DEFAULT NULL,
  `studiesLevel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telework` tinyint(1) DEFAULT NULL,
  `remuneration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `resume`
--

INSERT INTO `resume` (`id`, `vcard`, `ldif`, `studiesLevel`, `telework`, `remuneration`) VALUES
(1, 1, 1, 'BAC +2', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `resume_activities`
--

CREATE TABLE IF NOT EXISTS `resume_activities` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESUME_ACTIVITIES_TITLE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_ACTIVITIES_RESUME_ACTIVITIES_TITLE1_idx` (`RESUME_ACTIVITIES_TITLE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `resume_activities`
--

INSERT INTO `resume_activities` (`id`, `name`, `RESUME_ACTIVITIES_TITLE_id`) VALUES
(1, 'Veille informative quotidienne (nouveau matériel, technologie, droit, etc...).', 1),
(2, 'Développement web dans l’objectif de découvrir et/ou maîtriser de nouvelles connaissances.', 1),
(3, 'Développement logiciel afin d''approcher les technologies de développement client et client/serveur.', 1),
(4, 'Jeux en ligne, en équipe. j’aime la cohésion du groupe et le fait d’élaborer des stratégies.', 1),
(5, 'Dépannage et création de pc dans mon entourage.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `resume_activities_title`
--

CREATE TABLE IF NOT EXISTS `resume_activities_title` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESUME_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_ACTIVITIES_TITLE_RESUME1_idx` (`RESUME_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `resume_activities_title`
--

INSERT INTO `resume_activities_title` (`id`, `name`, `RESUME_id`) VALUES
(1, 'Informatique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `resume_education`
--

CREATE TABLE IF NOT EXISTS `resume_education` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `startYear` year(4) DEFAULT NULL,
  `endYear` year(4) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obtained` tinyint(1) DEFAULT NULL,
  `RESUME_id` smallint(5) unsigned NOT NULL,
  `SCHOOL_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_EDUCATION_RESUME1_idx` (`RESUME_id`),
  KEY `fk_RESUME_EDUCATION_SCHOOL1_idx` (`SCHOOL_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `resume_education`
--

INSERT INTO `resume_education` (`id`, `startYear`, `endYear`, `name`, `obtained`, `RESUME_id`, `SCHOOL_id`) VALUES
(1, 2010, 2012, 'BTS Informatique de Gestion', 1, 1, 1),
(2, 2008, 2010, 'BTS Informatique de Gestion', 0, 1, 2),
(3, 2006, 2008, 'Bac STI électrotechnique', 0, 1, 3),
(4, 2004, 2006, 'BEP électrotechnique', 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `resume_education-resume_option`
--

CREATE TABLE IF NOT EXISTS `resume_education-resume_option` (
  `RESUME_EDUCATION_id` smallint(5) unsigned NOT NULL,
  `RESUME_OPTION_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`RESUME_EDUCATION_id`,`RESUME_OPTION_id`),
  KEY `fk_RESUME_EDUCATION_has_RESUME_OPTION_RESUME_OPTION1_idx` (`RESUME_OPTION_id`),
  KEY `fk_RESUME_EDUCATION_has_RESUME_OPTION_RESUME_EDUCATION1_idx` (`RESUME_EDUCATION_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `resume_education-resume_option`
--

INSERT INTO `resume_education-resume_option` (`RESUME_EDUCATION_id`, `RESUME_OPTION_id`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resume_option`
--

CREATE TABLE IF NOT EXISTS `resume_option` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `resume_option`
--

INSERT INTO `resume_option` (`id`, `name`) VALUES
(1, 'Anglais ');

-- --------------------------------------------------------

--
-- Structure de la table `resume_skill`
--

CREATE TABLE IF NOT EXISTS `resume_skill` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` tinyint(4) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `RESUME_SKILL_TITLE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_SKILL_RESUME_SKILL_TITLE1_idx` (`RESUME_SKILL_TITLE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Contenu de la table `resume_skill`
--

INSERT INTO `resume_skill` (`id`, `name`, `number`, `level`, `RESUME_SKILL_TITLE_id`) VALUES
(1, 'XHTML', 1, NULL, 1),
(2, 'HTML', 2, NULL, 1),
(3, 'CSS', 3, NULL, 1),
(4, 'PHP', 4, NULL, 1),
(5, 'SQL', 5, NULL, 1),
(6, 'DHTML', 6, NULL, 1),
(7, 'C', 7, NULL, 1),
(8, 'C++', 8, NULL, 1),
(9, 'FLASH AS2/AS3', 9, NULL, 1),
(10, 'Javascript', 10, NULL, 1),
(11, 'Normes W3C', 1, NULL, 2),
(12, 'Optimisation des pages', 2, NULL, 2),
(13, 'Affiliation', 3, NULL, 2),
(14, 'Administration phpMyAdmin', 4, NULL, 2),
(15, 'Méthode d''analyse, de conception et de réalisation de systèmes d''informations informatisés : Merise', 5, NULL, 2),
(16, 'Utilisation d''un debugger : xdebug', 6, NULL, 2),
(17, 'Framework Symfony', 1, NULL, 3),
(18, 'OScommerce', 2, NULL, 3),
(19, 'Installation et configuration diverses (Apache, Active Directory, ...)', 1, NULL, 4),
(20, 'Utilisation du protocole SSH', 2, NULL, 4),
(21, 'Windows (95, 98, NT4, XP 32 et 64 bits)', 1, NULL, 5),
(22, 'Linux (Damn Small Linux, KNOPPIX)', 2, NULL, 5),
(23, 'Windows Serveur 2003', 3, NULL, 5),
(24, 'Linux Serveur (gentoo, debian)', 4, NULL, 5),
(25, 'Dépannage : Ultimate Boot CD', 5, NULL, 5),
(26, 'Adobe Dreamweaver', 1, NULL, 6),
(27, 'Microsoft Visual Studio', 2, NULL, 6),
(28, 'Netbeans', 3, NULL, 6),
(29, 'Notepadd++', 4, NULL, 6),
(30, 'Wamp', 5, NULL, 6),
(31, 'Xoopserver', 6, NULL, 6),
(32, 'Environnement LAMP (Linux, Apache, MySQL, Php) : Wamp et Xoopserver', 7, NULL, 6),
(33, 'Adobe Flash', 1, NULL, 7),
(34, 'Adobe Photoshop', 2, NULL, 7),
(35, 'GIMP', 3, NULL, 7),
(36, 'SwishMax', 4, NULL, 7),
(37, 'Microsoft Office', 1, NULL, 8),
(38, 'OpenOffice', 2, NULL, 8),
(39, 'Firefox', 1, NULL, 9),
(40, 'Internet Explorer', 2, NULL, 9),
(41, 'Opera', 3, NULL, 9),
(42, 'Safari', 4, NULL, 9),
(43, 'Anglais (Technique)', 1, NULL, 10),
(44, 'Utilisation d’un ordinateur personnel depuis l''âge de 10 ans.', 1, NULL, 11),
(45, 'Installation et configuration hardware et software de PC.', 2, NULL, 11),
(46, 'Donne régulièrement des conseils en hardware auprès de connaissance.', 3, NULL, 11),
(47, 'Dépannage hardware et software de PC, par téléphone, VOIP ou à domicile.', 4, NULL, 11),
(48, 'Connaissance sur les architectures matériels (processeurs, cartes mères, ...)', 5, NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `resume_skill_title`
--

CREATE TABLE IF NOT EXISTS `resume_skill_title` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` tinyint(4) DEFAULT NULL,
  `RESUME_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_SKILL_TITLE_RESUME1_idx` (`RESUME_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `resume_skill_title`
--

INSERT INTO `resume_skill_title` (`id`, `name`, `number`, `RESUME_id`) VALUES
(1, 'Languages de Programmation', 1, 1),
(2, 'Compétences liées au développement', 2, 1),
(3, 'Connaissances de CMS', 3, 1),
(4, 'Administration serveur', 4, 1),
(5, 'Utilisation Système d''exploitation (OS)', 5, 1),
(6, 'Connaissances de logiciels de développement', 6, 1),
(7, 'Connaissances de logiciels de graphisme', 7, 1),
(8, 'Connaissances de suites bureautique', 8, 1),
(9, 'Connaissances de navigateurs internet', 9, 1),
(10, 'Langues', 10, 1),
(11, 'Autres', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resume_work_experience`
--

CREATE TABLE IF NOT EXISTS `resume_work_experience` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `situation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESUME_WORK_EXPERIENCE_TYPE_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_WORK_EXPERIENCE_RESUME_WORK_EXPERIENCE_TYPE1_idx` (`RESUME_WORK_EXPERIENCE_TYPE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `resume_work_experience`
--

INSERT INTO `resume_work_experience` (`id`, `startDate`, `endDate`, `company`, `situation`, `RESUME_WORK_EXPERIENCE_TYPE_id`) VALUES
(1, '2011-06-00', '2011-09-00', 'CRESS BN', 'Développeur', 1),
(2, '2010-12-00', '2010-12-00', 'VER''SON OPTIQUE', 'Développeur', 1),
(3, '2008-10-00', '2009-06-00', 'DALEP', 'Webmaster', 1),
(5, '2009-12-00', '2010-04-00', 'CRESS BN', 'Développeur', 3);

-- --------------------------------------------------------

--
-- Structure de la table `resume_work_experience_skill`
--

CREATE TABLE IF NOT EXISTS `resume_work_experience_skill` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESUME_WORK_EXPERIENCE_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_WORK_EXPERIENCE_SKILL_RESUME_WORK_EXPERIENCE1_idx` (`RESUME_WORK_EXPERIENCE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `resume_work_experience_skill`
--

INSERT INTO `resume_work_experience_skill` (`id`, `name`, `RESUME_WORK_EXPERIENCE_id`) VALUES
(1, 'création d''un nouveau site internet', 1),
(2, 'hébergement vidéo', 1),
(3, 'fonctions sociales', 1),
(4, 'migration des données vers le nouveau site', 1),
(5, 'Formalisation d’une charte graphique existante', 2),
(6, 'création d''un nouveau site internet', 2),
(7, 'interface d’administration simpliste', 2),
(8, 'correction de la forme de l’image', 2),
(9, 'administration de site OS Commerce', 3),
(10, 'modification en PHP et HTML', 3),
(11, 'application archivage en Visual Basic .NET', 5),
(12, 'mise à jour et amélioration du site internet', 5);

-- --------------------------------------------------------

--
-- Structure de la table `resume_work_experience_type`
--

CREATE TABLE IF NOT EXISTS `resume_work_experience_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESUME_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESUME_WORK_EXPERIENCE_TYPE_RESUME1_idx` (`RESUME_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `resume_work_experience_type`
--

INSERT INTO `resume_work_experience_type` (`id`, `name`, `description`, `RESUME_id`) VALUES
(1, 'Contrats', NULL, 1),
(2, 'Intérims', 'Eté 2008-2009-2010-2012 – Diverses missions d’intérims', 1),
(3, 'Stage', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `school`
--

INSERT INTO `school` (`id`, `name`, `town`) VALUES
(1, 'CNED', 'Caen'),
(2, 'AIFCC', 'Caen'),
(3, 'Institut Lemonnier', 'Caen');

-- --------------------------------------------------------

--
-- Structure de la table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(4) NOT NULL,
  `IP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE_SERVER_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_SERVER_TYPE_SERVER1_idx` (`TYPE_SERVER_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `server`
--

INSERT INTO `server` (`id`, `number`, `IP`, `port`, `password`, `description`, `TYPE_SERVER_id`) VALUES
(1, 1, '1111', NULL, NULL, 'ffa', 1),
(2, 2, '1111', NULL, 'pracc', 'war', 2);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `theme_has_block`
--

CREATE TABLE IF NOT EXISTS `theme_has_block` (
  `THEME_id` tinyint(3) unsigned NOT NULL,
  `BLOCK_id` tinyint(3) unsigned NOT NULL,
  `positionX` tinyint(3) unsigned DEFAULT NULL,
  `postionY` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`THEME_id`,`BLOCK_id`),
  KEY `fk_THEME_has_BLOCK_BLOCK1_idx` (`BLOCK_id`),
  KEY `fk_THEME_has_BLOCK_THEME1_idx` (`THEME_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'menu'),
(2, 'article');

-- --------------------------------------------------------

--
-- Structure de la table `type_category`
--

CREATE TABLE IF NOT EXISTS `type_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_category`
--

INSERT INTO `type_category` (`id`, `name`) VALUES
(1, 'all'),
(2, 'download'),
(3, 'links');

-- --------------------------------------------------------

--
-- Structure de la table `type_confrontation`
--

CREATE TABLE IF NOT EXISTS `type_confrontation` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rules` text COLLATE utf8_unicode_ci,
  `network` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `type_confrontation`
--

INSERT INTO `type_confrontation` (`id`, `name`, `rules`, `network`) VALUES
(1, 'esl mr15 versus', 'tada', 'esl');

-- --------------------------------------------------------

--
-- Structure de la table `type_demo`
--

CREATE TABLE IF NOT EXISTS `type_demo` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_file`
--

CREATE TABLE IF NOT EXISTS `type_file` (
  `id` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_file`
--

INSERT INTO `type_file` (`id`, `name`) VALUES
(1, 'fichier texte'),
(2, 'fichier contact');

-- --------------------------------------------------------

--
-- Structure de la table `type_question`
--

CREATE TABLE IF NOT EXISTS `type_question` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_question`
--

INSERT INTO `type_question` (`id`, `name`) VALUES
(1, 'text'),
(2, 'textArea'),
(3, 'radio'),
(4, 'check'),
(5, 'dropDown');

-- --------------------------------------------------------

--
-- Structure de la table `type_server`
--

CREATE TABLE IF NOT EXISTS `type_server` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_server`
--

INSERT INTO `type_server` (`id`, `name`, `number`, `visibility`) VALUES
(1, 'ffa', '1', 1),
(2, 'war', '2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `vehicle`
--

INSERT INTO `vehicle` (`id`, `name`) VALUES
(1, 'voiture');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `answer_option`
--
ALTER TABLE `answer_option`
  ADD CONSTRAINT `fk_ANSWER_OPTION_QUESTION1` FOREIGN KEY (`QUESTION_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `answer_option-member`
--
ALTER TABLE `answer_option-member`
  ADD CONSTRAINT `fk_ANSWER_OPTION_has_MEMBER_ANSWER_OPTION1` FOREIGN KEY (`ANSWER_OPTION_id`, `ANSWER_OPTION_QUESTION_id`) REFERENCES `answer_option` (`id`, `QUESTION_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ANSWER_OPTION_has_MEMBER_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `answre_free`
--
ALTER TABLE `answre_free`
  ADD CONSTRAINT `fk_ANSWRE_FREE_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ANSWRE_FREE_QUESTION1` FOREIGN KEY (`QUESTION_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_NEWS_CATEGORY10` FOREIGN KEY (`CATEGORY_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `article_has_content`
--
ALTER TABLE `article_has_content`
  ADD CONSTRAINT `fk_ARTICLE_has_CONTENT_ARTICLE1` FOREIGN KEY (`ARTICLE_id`) REFERENCES `article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ARTICLE_has_CONTENT_CONTENT1` FOREIGN KEY (`CONTENT_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `fk_AVAILABILITY_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `away`
--
ALTER TABLE `away`
  ADD CONSTRAINT `fk_AWAY_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_CATEGORY_TYPE_CATEGORY1` FOREIGN KEY (`TYPE_CATEGORY_id`) REFERENCES `type_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `confrontation`
--
ALTER TABLE `confrontation`
  ADD CONSTRAINT `fk_MATCH_LINEUP1` FOREIGN KEY (`LINEUP_id`) REFERENCES `lineup` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MATCH_OPPONENT1` FOREIGN KEY (`OPPONENT_id`) REFERENCES `opponent` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MATCH_TYPE1` FOREIGN KEY (`TYPE_id`) REFERENCES `type_confrontation` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_CONTACT_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONTACT_OBJECT1` FOREIGN KEY (`OBJECT_id`) REFERENCES `object` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact_not_account`
--
ALTER TABLE `contact_not_account`
  ADD CONSTRAINT `fk_CONTACT_NOT_ACCOUNT_OBJECT1` FOREIGN KEY (`OBJECT_id`) REFERENCES `object` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_CONTENT_TYPE1` FOREIGN KEY (`TYPE_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `content-page`
--
ALTER TABLE `content-page`
  ADD CONSTRAINT `fk_CONTENT_has_PAGE_CONTENT1` FOREIGN KEY (`CONTENT_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONTENT_has_PAGE_PAGE1` FOREIGN KEY (`PAGE_id`) REFERENCES `page` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `demo`
--
ALTER TABLE `demo`
  ADD CONSTRAINT `fk_DEMO_TYPE1` FOREIGN KEY (`TYPE_id`) REFERENCES `type_demo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DEMO_WAR1` FOREIGN KEY (`CONFRONTATION_id`) REFERENCES `confrontation` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `fk_DOWNLOAD_CATEGORY1` FOREIGN KEY (`CATEGORY_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DOWNLOAD_EXTENSION_NAME1` FOREIGN KEY (`EXTENSION_NAME_id`) REFERENCES `extension_name` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `driving_license-member`
--
ALTER TABLE `driving_license-member`
  ADD CONSTRAINT `fk_DRIVING_LICENSE_has_MEMBER_DRIVING_LICENSE1` FOREIGN KEY (`DRIVING_LICENSE_id`) REFERENCES `driving_license` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DRIVING_LICENSE_has_MEMBER_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `extension`
--
ALTER TABLE `extension`
  ADD CONSTRAINT `fk_EXTENSION_EXTENSION_NAME1` FOREIGN KEY (`EXTENSION_NAME_id`) REFERENCES `extension_name` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `extension_name`
--
ALTER TABLE `extension_name`
  ADD CONSTRAINT `fk_EXTENSION_NAME_TYPE_FILE1` FOREIGN KEY (`TYPE_FILE_id`) REFERENCES `type_file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `game-question`
--
ALTER TABLE `game-question`
  ADD CONSTRAINT `fk_GAME_has_QUESTION_GAME1` FOREIGN KEY (`GAME_id`) REFERENCES `game` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_GAME_has_QUESTION_QUESTION1` FOREIGN KEY (`QUESTION_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hardware`
--
ALTER TABLE `hardware`
  ADD CONSTRAINT `fk_CONFIGURATION_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lineup`
--
ALTER TABLE `lineup`
  ADD CONSTRAINT `fk_LINEUP_GAME1` FOREIGN KEY (`GAME_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `fk_LINKS_CATEGORY1` FOREIGN KEY (`CATEGORY_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `link_has_content`
--
ALTER TABLE `link_has_content`
  ADD CONSTRAINT `fk_LINK_has_CONTENT_BLOCK1` FOREIGN KEY (`BLOCK_id`) REFERENCES `block` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LINK_has_CONTENT_LINK1` FOREIGN KEY (`LINK_id`) REFERENCES `link` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `fk_map_MATCH1` FOREIGN KEY (`CONFRONTATION_id`) REFERENCES `confrontation` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_MEMBER_GAMING_DETAILS1` FOREIGN KEY (`GAMING_DETAILS_id`) REFERENCES `gaming_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_LOCALISATION1` FOREIGN KEY (`LOCALISATION_id`) REFERENCES `localisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_PERSONAL_DETAILS1` FOREIGN KEY (`PERSONAL_DETAILS_id`) REFERENCES `personal_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_RESUME_PERSONAL_DETAILS1` FOREIGN KEY (`RESUME_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `member-lineup`
--
ALTER TABLE `member-lineup`
  ADD CONSTRAINT `fk_MEMBER_has_LINEUP_LINEUP1` FOREIGN KEY (`LINEUP_id`) REFERENCES `lineup` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_has_LINEUP_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `member-vehicle`
--
ALTER TABLE `member-vehicle`
  ADD CONSTRAINT `fk_MEMBER_has_VEHICLE_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_has_VEHICLE_VEHICLE1` FOREIGN KEY (`VEHICLE_id`) REFERENCES `vehicle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_NEWS_CATEGORY1` FOREIGN KEY (`CATEGORY_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NEWS_MEMBER` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `news_has_content`
--
ALTER TABLE `news_has_content`
  ADD CONSTRAINT `fk_NEWS_has_CONTENT_CONTENT1` FOREIGN KEY (`CONTENT_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NEWS_has_CONTENT_NEWS1` FOREIGN KEY (`NEWS_id`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_PAGE_CATEGORY1` FOREIGN KEY (`CATEGORY_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `fk_PHONE_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PHONE_PHONE_TYPE1` FOREIGN KEY (`PHONE_TYPE_id`) REFERENCES `phone_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pm`
--
ALTER TABLE `pm`
  ADD CONSTRAINT `fk_PM_MEMBER1` FOREIGN KEY (`MEMBER_idSend`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PM_MEMBER2` FOREIGN KEY (`MEMBER_idReceive`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `portfolio_element`
--
ALTER TABLE `portfolio_element`
  ADD CONSTRAINT `fk_PORTFOLIO_ELEMENT_PORTFOLIO1` FOREIGN KEY (`PORTFOLIO_id`) REFERENCES `portfolio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_QUESTION_TYPE_QUESTION1` FOREIGN KEY (`TYPE_QUESTION_id`) REFERENCES `type_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recruitment`
--
ALTER TABLE `recruitment`
  ADD CONSTRAINT `fk_RECRUITMENT_GAME1` FOREIGN KEY (`GAME_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RECRUITMENT_MEMBER1` FOREIGN KEY (`MEMBER_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_activities`
--
ALTER TABLE `resume_activities`
  ADD CONSTRAINT `fk_RESUME_ACTIVITIES_RESUME_ACTIVITIES_TITLE1` FOREIGN KEY (`RESUME_ACTIVITIES_TITLE_id`) REFERENCES `resume_activities_title` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_activities_title`
--
ALTER TABLE `resume_activities_title`
  ADD CONSTRAINT `fk_RESUME_ACTIVITIES_TITLE_RESUME1` FOREIGN KEY (`RESUME_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_education`
--
ALTER TABLE `resume_education`
  ADD CONSTRAINT `fk_RESUME_EDUCATION_RESUME1` FOREIGN KEY (`RESUME_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RESUME_EDUCATION_SCHOOL1` FOREIGN KEY (`SCHOOL_id`) REFERENCES `school` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_education-resume_option`
--
ALTER TABLE `resume_education-resume_option`
  ADD CONSTRAINT `fk_RESUME_EDUCATION_has_RESUME_OPTION_RESUME_EDUCATION1` FOREIGN KEY (`RESUME_EDUCATION_id`) REFERENCES `resume_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RESUME_EDUCATION_has_RESUME_OPTION_RESUME_OPTION1` FOREIGN KEY (`RESUME_OPTION_id`) REFERENCES `resume_option` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_skill`
--
ALTER TABLE `resume_skill`
  ADD CONSTRAINT `fk_RESUME_SKILL_RESUME_SKILL_TITLE1` FOREIGN KEY (`RESUME_SKILL_TITLE_id`) REFERENCES `resume_skill_title` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_skill_title`
--
ALTER TABLE `resume_skill_title`
  ADD CONSTRAINT `fk_RESUME_SKILL_TITLE_RESUME1` FOREIGN KEY (`RESUME_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_work_experience`
--
ALTER TABLE `resume_work_experience`
  ADD CONSTRAINT `fk_RESUME_WORK_EXPERIENCE_RESUME_WORK_EXPERIENCE_TYPE1` FOREIGN KEY (`RESUME_WORK_EXPERIENCE_TYPE_id`) REFERENCES `resume_work_experience_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_work_experience_skill`
--
ALTER TABLE `resume_work_experience_skill`
  ADD CONSTRAINT `fk_RESUME_WORK_EXPERIENCE_SKILL_RESUME_WORK_EXPERIENCE1` FOREIGN KEY (`RESUME_WORK_EXPERIENCE_id`) REFERENCES `resume_work_experience` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resume_work_experience_type`
--
ALTER TABLE `resume_work_experience_type`
  ADD CONSTRAINT `fk_RESUME_WORK_EXPERIENCE_TYPE_RESUME1` FOREIGN KEY (`RESUME_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `server`
--
ALTER TABLE `server`
  ADD CONSTRAINT `fk_SERVER_TYPE_SERVER1` FOREIGN KEY (`TYPE_SERVER_id`) REFERENCES `type_server` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `theme_has_block`
--
ALTER TABLE `theme_has_block`
  ADD CONSTRAINT `fk_THEME_has_BLOCK_BLOCK1` FOREIGN KEY (`BLOCK_id`) REFERENCES `block` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_THEME_has_BLOCK_THEME1` FOREIGN KEY (`THEME_id`) REFERENCES `theme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
