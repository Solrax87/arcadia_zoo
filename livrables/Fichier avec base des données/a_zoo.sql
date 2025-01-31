-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (x86_64)
--
-- Host: localhost    Database: a_zoo
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `animaux`
--

DROP TABLE IF EXISTS `animaux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animaux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `habitat_id` int NOT NULL,
  `veterinaire_id` int DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `habitat_id` (`habitat_id`),
  CONSTRAINT `animaux_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animaux`
--

LOCK TABLES `animaux` WRITE;
/*!40000 ALTER TABLE `animaux` DISABLE KEYS */;
INSERT INTO `animaux` VALUES (2,'Zera','Zèbre',7,4,NULL,'2025-01-09','Super !','e4ef7b1896a08589ed16457f79d0435d.jpg'),(24,'Lino','Lion',7,14,NULL,'2025-01-29','','3d9b801132e6545c6307b087d01c1b3e.jpg'),(25,'Lobito','Loup',10,3,NULL,'2025-01-15','','6411faf7faad597fe3b7f5d534345a16.jpg'),(26,'L\'oxxo','Ours',10,3,NULL,'2025-01-20','','28d38525dec8c0f20513c733e2e2b2bc.jpg'),(27,'Coco','Crocodile',11,2,NULL,'2025-01-09','','7fb7380667baa916764790491db68e58.jpg'),(28,'Hippo',' hippopotame',11,4,NULL,'2025-01-10','','2aca0d1fccff835c4913783e9be772bb.jpg'),(29,'Veni','cerf',9,3,NULL,'2025-01-18','','377e771d73f0a6765c3c2830890a04ed.jpg'),(30,'Babe','Sanglier',9,4,NULL,'2025-01-22','','e91f4a656dbd5cc4743ecf9bc1559c8d.jpg');
/*!40000 ALTER TABLE `animaux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitats`
--

DROP TABLE IF EXISTS `habitats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitats`
--

LOCK TABLES `habitats` WRITE;
/*!40000 ALTER TABLE `habitats` DISABLE KEYS */;
INSERT INTO `habitats` VALUES (7,'Savane','La savane est un écosystème vaste et diversifié, et nos résidents profitent d\'un cadre qui imite fidèlement leur milieu naturel.','bb083bbfffb80a95829018832695d369.jpg'),(9,'Forêt','Les animaux vivent en harmonie avec un environnement qui recrée fidèlement les forêts denses et humides.','54a50897d4a6399785353b0b4e3841cb.jpg'),(10,'Montagne','Ici, les animaux résidents s\'épanouissent dans un environnement qui reflète les conditions escarpées et robustes des montagnes.','15f007651f876bedb52e708f43e35baa.jpg'),(11,'Marais','Un lieu où la nature aquatique et terrestre se rencontrent harmonieusement. ','b778ab23fad50f6a17dd1d11e42ff115.jpg');
/*!40000 ALTER TABLE `habitats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rapports`
--

DROP TABLE IF EXISTS `rapports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rapports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `animal_id` int NOT NULL,
  `habitat_id` int NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nourriture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grammage` int DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `veterinaire_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `animal_id` (`animal_id`),
  KEY `habitat_id` (`habitat_id`),
  CONSTRAINT `rapports_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`id`),
  CONSTRAINT `rapports_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rapports`
--

LOCK TABLES `rapports` WRITE;
/*!40000 ALTER TABLE `rapports` DISABLE KEYS */;
INSERT INTO `rapports` VALUES (2,'2025-01-19',2,7,'Parfait état','Foin',8000,'Très énergique comme d\'habitud',13),(3,'2025-01-20',25,10,'Très vigilante ce matin','Viande',5000,'Vaccination la semaine prochaine ',13),(5,'2025-01-10',24,7,'Parfait état','Viande',8000,'Il dormait beaucoup depuis ce matin',13),(6,'2025-01-22',30,9,'Un peu énervé','Foin et pommes',4000,'Il avait très faim',13),(8,'2025-01-20',26,10,'Dors','Poissons',2000,'Les animaliers sont laissé des poisons en cas de se réveiller.',13),(9,'2025-01-21',26,10,'Cool ! 2','Poissons',3000,'Viens de ce réveiller ',13),(10,'2025-01-21',28,11,'Toujours avec beaucoup faim','Pasteques ',20000,'Il avait une petite blessure à côté de l\'oreille gauche ',13),(11,'2025-01-22',29,10,'Il reste tranquille','foin',5000,'Vaccination fait ',13),(12,'2025-01-22',27,11,'Il est très sale du dos','Poulet',6000,'Il est resté au soleil après avoir mangé ',13);
/*!40000 ALTER TABLE `rapports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('RESTAURATION','ACTIVITÉS EN FAMILLE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Petit Train','ACTIVITÉS EN FAMILLE','Montez à bord de notre Petit Train pour une visite tranquille à travers le zoo, idéale pour découvrir nos animaux sans effort. Parfait pour les familles !','f2b48cefb65400eb2748784446bca6ee.jpg'),(11,'Balades','ACTIVITÉS EN FAMILLE','Profitez de nos Balades guidées pour explorer le zoo à pied, en immersion totale dans la nature et près des animaux. Une promenade détente pour tous !','f06a126b2a0881a550ad92739dbc837c.jpg'),(12,'Spectacles','ACTIVITÉS EN FAMILLE','Assistez à nos Spectacles captivants mettant en scène des animaux. Un moment inoubliable pour toute la famille, alliant divertissement et découverte !','5a4364bdad8513a37530a7c3721f21c5.jpg');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temoignages`
--

DROP TABLE IF EXISTS `temoignages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temoignages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` enum('Mmm...','Moyen','Superbe!') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temoignages`
--

LOCK TABLES `temoignages` WRITE;
/*!40000 ALTER TABLE `temoignages` DISABLE KEYS */;
INSERT INTO `temoignages` VALUES (1,'Jean Dupont','Superbe!','C’était une expérience incroyable!','2025-01-08 17:20:39'),(2,'Vincent','Mmm...','Je ne suis pas sure...','2025-01-08 17:23:47'),(3,'car','Superbe!','Prueba dos','2025-01-08 17:32:11'),(5,'Carlos','Moyen','Il manque des choses mais pas mal','2025-01-08 17:30:43'),(6,'Cody','Superbe!','J\'adore toutes les animaux !','2025-01-08 17:31:53'),(12,'Victor','Superbe!','J\'adore voir le lion en action !','2025-01-20 18:39:35');
/*!40000 ALTER TABLE `temoignages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('veterinaire','employe','administrateur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (12,'Carlos Rodriguez','carlos@arcadia.fr','$2y$10$xOoZh5hOH.xwLsGNCdeLZuO3x5D1G5fVDphrG0/tyPGJcTELHFtsC','administrateur','2025-01-23 13:39:49'),(13,'Rodriguez Cody','cody@arcadia.fr','$2y$10$sSO68eEHu/Rvg57.zP0u/ucONgzxd4Hn4yDri82PPSEPAep.GPKDm','veterinaire','2025-01-23 13:49:09'),(14,'Djeïla Rodriguez','djeila@arcadia.fr','$2y$10$PkUejqhjWjSZyFw/qaRs/.FXZjyHH2tWnX.WQMhYIIuhjtUs.ThdS','employe','2025-01-24 13:18:35');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-24 18:17:22
