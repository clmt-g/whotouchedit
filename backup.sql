/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: whotouchedit_db
-- ------------------------------------------------------
-- Server version	10.11.15-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_planifiee_techniciens`
--

DROP TABLE IF EXISTS `intervention_planifiee_techniciens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_planifiee_techniciens` (
  `idInterventionPlanifiee` bigint(20) unsigned NOT NULL,
  `idUser` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idInterventionPlanifiee`,`idUser`),
  KEY `fk_user_technicien` (`idUser`),
  CONSTRAINT `fk_intervention_planifiee` FOREIGN KEY (`idInterventionPlanifiee`) REFERENCES `interventions_planifiees` (`idInterventionPlanifiee`),
  CONSTRAINT `fk_user_technicien` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_planifiee_techniciens`
--

LOCK TABLES `intervention_planifiee_techniciens` WRITE;
/*!40000 ALTER TABLE `intervention_planifiee_techniciens` DISABLE KEYS */;
INSERT INTO `intervention_planifiee_techniciens` VALUES
(1,10),
(1,11),
(2,11),
(2,12),
(3,13),
(4,10),
(5,14),
(5,15),
(6,11),
(7,16),
(8,12),
(8,13),
(9,6),
(10,7),
(11,17),
(12,10),
(12,14),
(13,11),
(13,15),
(13,16),
(14,10),
(14,12),
(14,17),
(15,13),
(15,14),
(16,12),
(16,13),
(17,10);
/*!40000 ALTER TABLE `intervention_planifiee_techniciens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interventions`
--

DROP TABLE IF EXISTS `interventions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `interventions` (
  `idIntervention` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dateHeureDebut` datetime NOT NULL,
  `dateHeureFin` datetime NOT NULL,
  `description` text DEFAULT NULL,
  `statut` enum('en_attente','en_cours','terminee','annulee') NOT NULL DEFAULT 'en_attente',
  `commentaire` text DEFAULT NULL,
  `idMachine` bigint(20) unsigned NOT NULL,
  `idUser` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idIntervention`),
  KEY `interventions_idmachine_foreign` (`idMachine`),
  KEY `interventions_iduser_foreign` (`idUser`),
  CONSTRAINT `interventions_idmachine_foreign` FOREIGN KEY (`idMachine`) REFERENCES `machines` (`idMachine`),
  CONSTRAINT `interventions_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interventions`
--

LOCK TABLES `interventions` WRITE;
/*!40000 ALTER TABLE `interventions` DISABLE KEYS */;
INSERT INTO `interventions` VALUES
(1,'2025-12-17 08:00:00','2025-12-17 12:00:00','Maintenance préventive trimestrielle complète','terminee','Tous les points de contrôle validés. Aucune anomalie détectée. Machine opérationnelle.',1,10,NULL),
(2,'2025-12-19 14:00:00','2025-12-19 17:30:00','Changement des outils de coupe usés et calibration','terminee','Remplacement de 8 outils. Calibration effectuée avec succès. Précision rétablie.',2,11,NULL),
(3,'2025-12-22 09:00:00','2025-12-22 11:00:00','Nettoyage et vérification des optiques laser','terminee','Optiques nettoyées. Puissance laser vérifiée et conforme. Tests de découpe OK.',3,12,NULL),
(4,'2025-12-25 10:30:00','2025-12-25 14:00:00','Réglage de la précision d\'usinage 5 axes','terminee','Calibration des 5 axes effectuée. Précision rétablie à ±0.005mm. Machine performante.',4,10,NULL),
(5,'2025-12-27 08:00:00','2025-12-27 10:30:00','Mise à jour du programme de soudure','terminee','Nouveau programme installé et testé. Trajectoire optimisée. Gain de 15% sur le temps de cycle.',5,13,NULL),
(6,'2025-12-29 13:00:00','2025-12-29 16:45:00','Contrôle du système de refroidissement injection','terminee','Circuit de refroidissement vérifié. Température stabilisée. Ajout de fluide frigorigène.',6,14,NULL),
(7,'2025-12-31 09:30:00','2025-12-31 12:00:00','Remplacement de la courroie de transmission','terminee','Ancienne courroie remplacée. Tension ajustée. Vibrations éliminées.',9,15,NULL),
(8,'2026-01-02 14:00:00','2026-01-02 15:30:00','Graissage et entretien général des glissières','terminee','Graissage effectué selon procédure. Glissement fluide rétabli.',16,16,NULL),
(9,'2026-01-04 08:00:00','2026-01-04 10:00:00','Changement de la lame de cisaille','terminee','Nouvelle lame installée. Coupe nette et précise. Tests sur différentes épaisseurs validés.',10,17,NULL),
(10,'2026-01-06 10:00:00','2026-01-06 12:30:00','Remplacement des disques de meulage','terminee','Disques usés remplacés. Système d\'aspiration vérifié et nettoyé.',11,10,NULL),
(11,'2026-01-07 13:30:00','2026-01-07 15:00:00','Calibration de la machine de mesure CMM','terminee','Calibration annuelle effectuée avec étalons certifiés. Certificat de conformité émis.',14,6,NULL),
(12,'2026-01-08 09:00:00','2026-01-08 11:00:00','Réparation du mandrin de perçage','terminee','Mandrin démonté, nettoyé et remonté. Centrage vérifié. Serrage optimal.',12,12,NULL),
(13,'2026-01-09 14:00:00','2026-01-09 16:30:00','Changement des bandes abrasives de polissage','terminee','Bandes usées remplacées. Vitesse de rotation ajustée. Qualité de finition améliorée.',13,13,NULL),
(14,'2026-01-10 08:30:00','2026-01-10 10:00:00','Affûtage des forets de perçage radiale','terminee','Lot de 12 forets affûtés. Angles de coupe contrôlés. Prêts pour utilisation.',15,14,NULL),
(15,'2026-01-11 11:00:00','2026-01-11 12:30:00','Remplacement de la lame de scie circulaire','terminee','Lame carbure installée. Alignement vérifié. Coupe propre et rapide.',17,15,NULL),
(16,'2026-01-12 09:00:00','2026-01-12 11:00:00','Maintenance de l\'étau-limeur','terminee','Graissage général. Courroies vérifiées. Machine fonctionnelle malgré son âge.',18,16,NULL),
(17,'2026-01-13 13:00:00','2026-01-13 16:00:00','Contrôle qualité post-installation','terminee','Tests complets effectués. Machine conforme aux spécifications. Mise en production validée.',3,7,NULL),
(18,'2026-01-14 08:00:00','2026-01-14 09:30:00','Vérification des systèmes de sécurité','terminee','Arrêts d\'urgence testés. Capteurs de sécurité fonctionnels. Conformité réglementaire OK.',7,17,NULL),
(19,'2026-01-15 10:00:00','2026-01-15 11:30:00','Mise à jour du logiciel de contrôle CNC','terminee','Firmware mis à jour vers version 4.2.1. Nouvelles fonctionnalités activées. Tests OK.',8,11,NULL),
(20,'2026-01-16 09:03:36','2026-01-16 11:03:36','Remplacement d\'un capteur de température défectueux','terminee','Ancien capteur remplacé. Température surveillée correctement. Alarme testée.',6,10,NULL),
(21,'2026-01-16 10:03:36','2026-01-16 16:03:36','Remplacement des joints hydrauliques de la presse','en_cours','Démontage terminé. Nettoyage des circuits en cours. Installation des nouveaux joints prévue cet après-midi.',19,12,NULL),
(22,'2026-01-16 11:03:36','2026-01-16 17:03:36','Révision générale annuelle','en_cours','Changement des roulements en cours. 60% de la révision effectuée.',20,13,NULL),
(23,'2026-01-16 12:03:36','2026-01-16 18:03:36','Maintenance trimestrielle du compresseur','en_cours','Vidange effectuée. Filtres changés. Contrôle de la pression en cours.',21,14,NULL),
(24,'2026-01-16 13:03:36','2026-01-16 19:03:36','Diagnostic et réparation du système de refroidissement','en_cours','Fuite localisée au niveau du circuit principal. Commande de pièces urgente effectuée.',22,15,NULL),
(25,'2026-01-16 13:33:36','2026-01-16 20:03:36','Réparation du générateur électrique (court-circuit)','en_cours','Technicien constructeur sur site. Diagnostic en cours. Pièces spéciales nécessaires.',23,8,NULL),
(26,'2026-01-16 14:03:36','2026-01-16 16:03:36','Contrôle de routine hebdomadaire','en_cours','Inspection en cours. Vérification des niveaux et des paramètres de fonctionnement.',1,16,NULL),
(27,'2026-01-16 14:03:36','2026-01-16 17:03:36','Nettoyage complet et préparation pour certification','en_cours','Nettoyage approfondi en préparation de l\'audit qualité de la semaine prochaine.',14,17,NULL),
(28,'2026-01-16 14:33:36','2026-01-16 18:03:36','Optimisation des paramètres de soudure','en_cours','Tests de différents réglages pour améliorer la qualité des soudures sur nouvelles pièces.',5,11,NULL),
(29,'2026-01-16 20:03:36','2026-01-16 22:03:36','Inspection des systèmes pneumatiques','en_attente',NULL,2,10,NULL),
(30,'2026-01-17 08:00:00','2026-01-17 10:00:00','Changement des filtres à air','en_attente',NULL,21,11,NULL),
(31,'2026-01-17 13:00:00','2026-01-17 15:30:00','Test de charge et performance','en_attente',NULL,8,6,NULL),
(32,'2026-01-18 09:00:00','2026-01-18 11:00:00','Vérification de l\'alignement des axes','en_attente',NULL,4,12,NULL),
(33,'2026-01-18 14:00:00','2026-01-18 16:00:00','Remplacement préventif des flexibles hydrauliques','en_attente',NULL,19,13,NULL),
(34,'2026-01-19 08:30:00','2026-01-19 12:00:00','Formation du personnel sur les nouvelles fonctionnalités','en_attente',NULL,3,7,NULL),
(35,'2026-01-20 10:00:00','2026-01-20 12:30:00','Contrôle des niveaux d\'huile et de fluides','en_attente',NULL,7,14,NULL),
(36,'2026-01-21 09:00:00','2026-01-21 10:30:00','Mise à jour du logiciel de gestion','en_attente',NULL,9,15,NULL),
(37,'2026-01-22 14:00:00','2026-01-22 17:00:00','Audit de sécurité annuel','en_attente',NULL,6,8,NULL),
(38,'2026-01-23 08:00:00','2026-01-23 11:00:00','Remplacement des guides de coupe','en_attente',NULL,10,16,NULL),
(39,'2026-01-23 13:30:00','2026-01-23 15:30:00','Inspection visuelle complète','en_attente',NULL,13,17,NULL),
(40,'2026-01-25 10:00:00','2026-01-25 12:00:00','Contrôle électrique et sécurité','en_attente',NULL,5,9,NULL);
/*!40000 ALTER TABLE `interventions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interventions_planifiees`
--

DROP TABLE IF EXISTS `interventions_planifiees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `interventions_planifiees` (
  `idInterventionPlanifiee` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `type` enum('preventive','controle_periodique','calibration','amelioration') NOT NULL,
  `description` text DEFAULT NULL,
  `statut` enum('planifiee','en_cours','terminee','annulee') NOT NULL DEFAULT 'planifiee',
  `frequence` enum('quotidienne','hebdomadaire','mensuelle','trimestrielle','annuelle','ponctuelle') NOT NULL,
  `idMachine` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idInterventionPlanifiee`),
  KEY `interventions_planifiees_idmachine_foreign` (`idMachine`),
  CONSTRAINT `interventions_planifiees_idmachine_foreign` FOREIGN KEY (`idMachine`) REFERENCES `machines` (`idMachine`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interventions_planifiees`
--

LOCK TABLES `interventions_planifiees` WRITE;
/*!40000 ALTER TABLE `interventions_planifiees` DISABLE KEYS */;
INSERT INTO `interventions_planifiees` VALUES
(1,'2026-01-23 08:00:00','2026-01-23 12:00:00','preventive','Maintenance préventive trimestrielle complète - Vérification de tous les systèmes critiques','planifiee','trimestrielle',1,NULL),
(2,'2026-01-23 13:00:00','2026-01-23 17:00:00','preventive','Maintenance préventive trimestrielle - Contrôle du système de tournage et lubrification','planifiee','trimestrielle',2,NULL),
(3,'2026-01-19 10:00:00','2026-01-19 11:30:00','preventive','Vérification hebdomadaire des paramètres laser et état des optiques','planifiee','hebdomadaire',3,NULL),
(4,'2026-01-26 08:00:00','2026-01-26 12:00:00','preventive','Maintenance mensuelle - Graissage, vérification des outils et calibration','planifiee','mensuelle',4,NULL),
(5,'2026-01-30 09:00:00','2026-01-30 11:00:00','preventive','Contrôle mensuel du robot - Trajectoires, capteurs et système de soudure','planifiee','mensuelle',5,NULL),
(6,'2026-01-31 14:00:00','2026-01-31 17:00:00','calibration','Calibration annuelle complète - Tous les axes et capteurs de précision','planifiee','annuelle',2,NULL),
(7,'2026-02-06 09:00:00','2026-02-06 12:00:00','calibration','Calibration semestrielle avec étalons certifiés - CMM','planifiee','annuelle',14,NULL),
(8,'2026-02-16 10:00:00','2026-02-16 13:00:00','calibration','Recalibration des paramètres d\'injection et contrôle température','planifiee','trimestrielle',6,NULL),
(9,'2026-02-16 09:00:00','2026-02-16 16:00:00','controle_periodique','Contrôle réglementaire annuel de sécurité - Organisme agréé','planifiee','annuelle',19,NULL),
(10,'2026-02-21 08:30:00','2026-02-21 17:00:00','controle_periodique','Contrôle réglementaire annuel - Compresseur sous pression','planifiee','annuelle',21,NULL),
(11,'2026-01-23 14:00:00','2026-01-23 16:00:00','controle_periodique','Contrôle mensuel des dispositifs de sécurité et arrêts d\'urgence','planifiee','mensuelle',7,NULL),
(12,'2026-02-05 13:00:00','2026-02-05 18:00:00','amelioration','Installation d\'un nouveau système de lubrification automatique pour optimiser la durée de vie','planifiee','ponctuelle',9,NULL),
(13,'2026-02-26 08:00:00','2026-02-26 17:00:00','amelioration','Upgrade du système de contrôle vers nouvelle version avec interface tactile','planifiee','ponctuelle',8,NULL),
(14,'2026-03-03 09:00:00','2026-03-04 17:00:00','amelioration','Installation d\'un système de surveillance en temps réel (IoT) pour monitoring à distance','planifiee','ponctuelle',1,NULL),
(15,'2026-02-06 10:00:00','2026-02-06 15:00:00','amelioration','Remplacement du système d\'aspiration par un modèle plus performant et silencieux','planifiee','ponctuelle',11,NULL),
(16,'2025-12-16 08:00:00','2025-12-16 10:00:00','controle_periodique','Vérification de la marqueuse','terminee','mensuelle',10,NULL),
(17,'2025-12-11 09:00:00','2025-12-11 11:00:00','controle_periodique','Changement de certaines vis','annulee','trimestrielle',15,NULL);
/*!40000 ALTER TABLE `interventions_planifiees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machines`
--

DROP TABLE IF EXISTS `machines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `machines` (
  `idMachine` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `dateInstallation` date NOT NULL,
  `etat` enum('opérationnelle','en_maintenance','planifiée','en_panne','hors_service') NOT NULL DEFAULT 'opérationnelle',
  `criticite` enum('faible','moyen','critique') NOT NULL DEFAULT 'moyen',
  `localisation` varchar(200) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMachine`),
  UNIQUE KEY `machines_reference_unique` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machines`
--

LOCK TABLES `machines` WRITE;
/*!40000 ALTER TABLE `machines` DISABLE KEYS */;
INSERT INTO `machines` VALUES
(1,'Fraiseuse CNC X500','CNC-X500-2023','2023-03-15','opérationnelle','critique','Atelier A - Zone 1','Machine principale pour la production de pièces de haute précision. Maintenance trimestrielle obligatoire.',NULL),
(2,'Tour automatique TA-3000','TA-3000-2022','2022-11-20','opérationnelle','critique','Atelier A - Zone 2','Capacité de tournage jusqu\'à 300mm de diamètre. Production continue 24/7.',NULL),
(3,'Découpe laser DL-5000','DL-5000-2024','2024-01-05','opérationnelle','critique','Atelier C - Zone 1','Installation récente. Capacité de découpe 5000W. Encore sous garantie constructeur.',NULL),
(4,'Centre d\'usinage CU-800','CU-800-2023','2023-07-12','opérationnelle','critique','Atelier A - Zone 3','Centre 5 axes pour pièces complexes. Utilisé pour les prototypes et petites séries.',NULL),
(5,'Robot de soudure RS-2000','RS-2000-2022','2022-09-18','opérationnelle','critique','Atelier D - Zone 1','Robot 6 axes pour soudure MIG/MAG. Programmation flexible pour différents produits.',NULL),
(6,'Presse injection PI-1500','PI-1500-2021','2021-05-22','opérationnelle','critique','Atelier E - Zone 1','Injection plastique 150 tonnes. Production de composants pour l\'assemblage final.',NULL),
(7,'Fraiseuse CNC X700','CNC-X700-2023','2023-10-08','opérationnelle','critique','Atelier A - Zone 4','Machine jumelle de la X500 pour augmenter les capacités de production.',NULL),
(8,'Tour CNC TC-400','TC-400-2024','2024-02-14','opérationnelle','critique','Atelier A - Zone 5','Nouveau tour CNC haute performance. Contrôle numérique dernière génération.',NULL),
(9,'Plieuse CNC PC-400','PC-400-2023','2023-08-30','opérationnelle','moyen','Atelier C - Zone 2','Pliage de tôles jusqu\'à 4mm d\'épaisseur et 4 mètres de longueur.',NULL),
(10,'Cisaille guillotine CG-300','CG-300-2020','2020-03-17','opérationnelle','moyen','Atelier C - Zone 3','Coupe de tôles jusqu\'à 3mm. Lame changée tous les 6 mois.',NULL),
(11,'Meuleuse automatique MA-150','MA-150-2021','2021-11-05','opérationnelle','moyen','Atelier B - Zone 2','Finition des pièces métalliques. Système d\'aspiration des poussières intégré.',NULL),
(12,'Perceuse à colonne PC-25','PC-25-2019','2019-06-12','opérationnelle','moyen','Atelier B - Zone 1','Perçage de précision pour diamètres jusqu\'à 25mm.',NULL),
(13,'Polisseuse automatique PA-500','PA-500-2022','2022-04-20','opérationnelle','moyen','Atelier F - Zone 1','Polissage et finition de surface. Utilisée en fin de chaîne de production.',NULL),
(14,'Machine de contrôle CMM-1000','CMM-1000-2023','2023-05-15','opérationnelle','moyen','Laboratoire Qualité','Machine de mesure tridimensionnelle. Contrôle qualité des pièces usinées.',NULL),
(15,'Perceuse radiale PR-800','PR-800-2020','2020-09-12','opérationnelle','faible','Atelier B - Zone 3','Utilisation ponctuelle pour perçages spéciaux et prototypes.',NULL),
(16,'Affûteuse d\'outils AO-100','AO-100-2018','2018-07-22','opérationnelle','faible','Atelier Outillage','Affûtage des outils de coupe. Utilisée par les techniciens d\'outillage.',NULL),
(17,'Scie circulaire SC-350','SC-350-2019','2019-10-30','opérationnelle','faible','Atelier B - Zone 4','Découpe de barres métalliques. Usage occasionnel.',NULL),
(18,'Étau-limeur EL-200','EL-200-2017','2017-03-08','opérationnelle','faible','Atelier B - Zone 5','Machine ancienne utilisée pour des travaux spécifiques. Peu sollicitée.',NULL),
(19,'Presse hydraulique PH-250','PH-250-2021','2021-06-10','en_maintenance','moyen','Atelier B - Zone 1','Maintenance préventive en cours. Remplacement des joints hydrauliques et vérification complète.',NULL),
(20,'Fraiseuse universelle FU-300','FU-300-2020','2020-08-15','en_maintenance','moyen','Atelier A - Zone 6','Révision générale annuelle. Changement des roulements et contrôle de la géométrie.',NULL),
(21,'Compresseur d\'air CA-5000','CA-5000-2019','2019-12-01','en_maintenance','critique','Local Technique','Maintenance trimestrielle. Vidange et contrôle du système de filtration.',NULL),
(22,'Rectifieuse plane RP-1200','RP-1200-2019','2019-04-22','en_panne','moyen','Atelier A - Zone 3','Panne du système de refroidissement. Circuit défectueux. Pièces en commande ETA 5 jours.',NULL),
(23,'Électro-érosion EE-400','EE-400-2020','2020-07-18','en_panne','critique','Atelier A - Zone 7','Problème électrique majeur. Court-circuit sur le générateur. Attente intervention constructeur.',NULL),
(24,'Scie à ruban SR-600','SR-600-2018','2018-12-05','hors_service','faible','Atelier B - Zone 4','Fin de vie. Remplacée par SC-350. Démantèlement prévu Q2 2026.',NULL),
(25,'Tour conventionnel TC-150','TC-150-2015','2015-02-10','hors_service','faible','Zone de stockage','Obsolète. Remplacé par les tours CNC. En attente de revente.',NULL);
/*!40000 ALTER TABLE `machines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_01_01_214204_modify_user_table',1),
(5,'2026_01_01_214350_create_machine_table',1),
(6,'2026_01_01_214439_create_intervention_table',1),
(7,'2026_01_01_214556_create_intervention_planifie_table',1),
(8,'2026_01_01_214647_create_intervention_planifie_technicien_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('uSvsObxUKneAfwGMo2ioBnoQstueF9nY89Eggz0r',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:147.0) Gecko/20100101 Firefox/147.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM2EzOFV4TEhDcjB1N2JHT2U4elFXZmI3ME9tTFRQZm9nTUFvSkNINyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYW5hbHl0aXF1ZS9rcGkiO3M6NToicm91dGUiO3M6MTQ6ImFuYWx5dGlxdWUua3BpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1768576483);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('technicien','responsable','admin','direction') NOT NULL DEFAULT 'technicien',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin','Système','admin@whotouchedit.fr','admin',NULL,'$2y$12$EWfQBuATKKBdezgqzQf4Z.m1.qxTJ7w5CDX5woZLIGy2uIag0YlkO',NULL,'2026-01-16 13:03:33','2026-01-16 13:03:33',NULL),
(2,'Rousseau','Claire','claire.rousseau@whotouchedit.fr','admin',NULL,'$2y$12$aVN1rfHkO0OlA.GApT.1XO8soPoBM3iNPwVeKVvCnzhuBXcaMkbDO',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(3,'Dupont','Marie','direction@whotouchedit.fr','direction',NULL,'$2y$12$U020BG/GvzVfHH/fZEs.JeyYej8ptaLRFiVEDHBZ9.9YI26WnMaZO',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(4,'Laurent','François','francois.laurent@whotouchedit.fr','direction',NULL,'$2y$12$f3AxFKVrON//U1u1Aq7uvO0YpbVMt6OYlcSPJnjcmNC9IofrmmXpi',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(5,'Petit','Isabelle','isabelle.petit@whotouchedit.fr','direction',NULL,'$2y$12$2HT/BYdPT8p0qe6YvUEQEem0fvQCbm7poA02qWLMPsQZV62B7Rpza',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(6,'Martin','Pierre','responsable@whotouchedit.fr','responsable',NULL,'$2y$12$mvskQNKXGjbVSsjcKUcfveNopuIZSDRsjOL8eagfHHKvDQ48MZUoq',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(7,'Dubois','Laurent','laurent.dubois@whotouchedit.fr','responsable',NULL,'$2y$12$M/2eWhnk/zxff.r227.5jeKOVvHIqvgChJ.C2HZVQPdpJsIvTFKy6',NULL,'2026-01-16 13:03:34','2026-01-16 13:03:34',NULL),
(8,'Garcia','Carmen','carmen.garcia@whotouchedit.fr','responsable',NULL,'$2y$12$BRtkKo3jUSri/3BZ3v9HWuEP4wwQfma.KI2m3Mz3ZrSto.zRfghvC',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(9,'Roux','Marc','marc.roux@whotouchedit.fr','responsable',NULL,'$2y$12$EdAHnvPZdAE4s0TMYlSEuep8rocaxdR0jyaZ5KGnoBjOW1ikws2eO',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(10,'Bernard','Sophie','technicien@whotouchedit.fr','technicien',NULL,'$2y$12$1GXqdPYBexld3/Kre9I2GOFp4kSLVFxrSJE52wr9W5wgdA5BavLK.',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(11,'Leroy','Thomas','thomas.leroy@whotouchedit.fr','technicien',NULL,'$2y$12$CUWK4mKSAzWd8mNq6aul/ukIG4Pg449V9vbqm6XOMubZwL3PlDGPu',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(12,'Moreau','Julie','julie.moreau@whotouchedit.fr','technicien',NULL,'$2y$12$PA..ZClCRX2Ve8yLumrruOSMUsAXUOhSeYM4aUpi2eXIfsHNt.sZS',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(13,'Simon','Lucas','lucas.simon@whotouchedit.fr','technicien',NULL,'$2y$12$rLVAmKKR3ydUW8v/KnlzcOwjQqykZs9ynbaM0Qi68ptA0S1NDRU9a',NULL,'2026-01-16 13:03:35','2026-01-16 13:03:35',NULL),
(14,'Michel','Émilie','emilie.michel@whotouchedit.fr','technicien',NULL,'$2y$12$Tju9kdFKuq7R/m9hx9xITe0oO5mClZofnKFHN7s1ePlY8XSvZwLfq',NULL,'2026-01-16 13:03:36','2026-01-16 13:03:36',NULL),
(15,'Lefebvre','Alexandre','alexandre.lefebvre@whotouchedit.fr','technicien',NULL,'$2y$12$l.pwiOtVwFgWvHktjOKu5.SaPgUyZbvxrJdq/XOqgizvsRnTRvmkC',NULL,'2026-01-16 13:03:36','2026-01-16 13:03:36',NULL),
(16,'Mercier','Pauline','pauline.mercier@whotouchedit.fr','technicien',NULL,'$2y$12$8kMuBCpgMETGDPSgyryP0.b073KBP.XKHtW4zHcxhEv0y50kiJsqe',NULL,'2026-01-16 13:03:36','2026-01-16 13:03:36',NULL),
(17,'Blanc','Maxime','maxime.blanc@whotouchedit.fr','technicien',NULL,'$2y$12$1P1Owo5FIuRQKrB2lBuDAeK/XzmcZGm14tvQ5EjVx49mcNSVEPnCK',NULL,'2026-01-16 13:03:36','2026-01-16 13:03:36',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-21 18:24:16
