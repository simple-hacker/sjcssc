-- MySQL dump 10.13  Distrib 5.5.43, for Linux (x86_64)
--
-- Host: web58.extendcp.co.uk    Database: cl50-sjcsscnew
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `address_title` varchar(255) NOT NULL,
  `address` varchar(2255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,2,'Club House','29 Whitchurch Rd, Cardiff CF14 3JN'),(2,2,'Bowling Green','Llwynfedw Gardens, Cardiff CF14 4NW');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs`
--

LOCK TABLES `clubs` WRITE;
/*!40000 ALTER TABLE `clubs` DISABLE KEYS */;
INSERT INTO `clubs` VALUES (1,'social','St Joseph\'s Catholic Sports and Social Club','This is a new welcome message for the St Joseph\'s Catholic Sports and Social Club.',0),(2,'bowls','St Joseph&#39;s Bowls Club','A warm welcome to St Joseph&#39;s Bowls Club, Cardiff which was founded in 1976 as a sports section within St Joseph&#39;s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to the Wales Bowling Association (WBA), East Wales Private Greens Bowling Association (EWPGBA), and South Glamorgan County Bowling Association (SGCBA).\r\n\r\nWe have two competitive teams who usually play on a Saturday afternoon:\r\nFirst Team play in PG1 Division 2\r\n&#39;A&#39; Team play in PG2 Division 1\r\n\r\nA competitive team comprising of players from both teams also play midweek (Wednesday evening) in the Cardiff Municipal League (CML).\r\n\r\nOn a less competitive note, we have a team which is open to all members of the bowls club, who play local friendly Alliance matches on a Tuesday and Thursday afternoon.\r\n\r\nAll new players, experienced or novice, are welcome.',4),(3,'rugby','St Joseph&#39;s Rugby Club','A warm welcome to St Joseph&#39;s Rugby Football Club, Cardiff which was founded in 1959 as a sports section within St Joseph&#39;s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to the Welsh Rugby Union (WRU). and Cardiff and District Rugby Union (CDRU).\r\n\r\nWe have two competitive senior teams and one youth team who usually play on a Saturday afternoon:\r\n1st XV play in the WRU National League Division 1 East\r\n2nd XV play in the CDRU\r\nYouth U19\r\n\r\nAll new players, experienced or novice, are welcome.\r\n\r\nTraining Night(s)/Time(s):\r\nMonday, Wednesday and Friday 18:00 till 19:00\r\n\r\nWe also have an established Tag Rugby mini/junior section with WRU qualified and CRB checked coaches for every team.\r\nIt is a great game that allows younger players to concentrate on their ball skills and teamwork first. \r\nWe currently have space for new players in all our age groups!\r\nExperience is not needed; the only requirement is to have fun whilst learning to play the game of Rugby!\r\nBoys and girls can join us from the age of six so why not come along on a Sunday morning and let your child try out a few sessions before making a decision.\r\nPlease make sure they are wearing old clothes to train as getting dirty is part of the game.\r\nOur aim is to encourage young players to develop and enjoy the game of rugby.\r\nMany of our current senior players have come through the mini/junior section, and it&#39;s importance is evident to the survival and success of the rugby club.\r\n\r\nOur playing pitch is located at Blackweir Fields, Cardiff CF10 3EA',42),(4,'football','St Joseph&#39;s Football Club SJAFC','A warm welcome to St Joseph&#39;s Athletic Football Club, Cardiff which was founded in 1968 as a sports section within St Joseph&#39;s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to South Wales Alliance League (SWAL) and Cardiff and District Football League (CDFL).\r\n\r\nWe have two competitive senior teams who usually play on a Saturday afternoon:\r\n1st XI play in the SWAL Division 2\r\n2nd XI play in the CDFL\r\n\r\nAll new players, experienced or novice, are welcome.\r\n\r\nTraining Night(s)/Time(s):\r\nMonday, Wednesday and Friday 18:00 till 19:00\r\n\r\nOur playing pitch is located at Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF.',53),(5,'fishing','St Joseph\'s Fishing Club','A warm welcome to Cardiff Reservoir Fly Fishing Club which was founded in 1948 and operates as a sports section within St Joseph\'s Catholic Sports and Social Club, Cardiff.\r\nThe Club was originally formed from members who regularly fished Llanishen and Lisvane reservoirs until they were closed to public use in 2000.\r\nDwr Cymru (Welsh Water) is currently restoring these reservoirs and it is hoped that they will once again be used for trout fishing when works have been completed.\r\n\r\nWe meet every Thursday night at St Josephs Club and welcome anyone with an interest in fishing, and specifically fly fishing for trout.\r\nClub meetings provide regular fly-tying sessions, a weekly raffle and the occasional fishing quiz, fishing video presentations and a \'bring and buy auction\' of fishing tackle\r\nWe also organise fly fishing outings to local venues as well as those further afield to famous fisheries like Draycote Water, Chew Valley and Llandegfedd.',0);
/*!40000 ALTER TABLE `clubs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `email_title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,2,'St Josephs Bowls Club','bowls@stjosephscssc.co.uk');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(1024) DEFAULT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,1,'2018-02-23 08:00:00','Rugby Reunion','2018-03-09','20:00:00','4','','','All members, current and old, are most welcome.\r\n\r\nPlease come along and renew old acquaintances.  The more the merrier!'),(2,3,1,'2018-02-23 08:00:00','Rugby Reunion','2018-03-09','20:00:00','4','','','All members, current and old, are most welcome.\r\n\r\nPlease come along and renew old acquaintances.  The more the merrier!'),(3,5,1,'2018-01-25 08:00:00','Club Quiz','2018-02-08','20:00:00','4','','','Club Quiz to be followed by a fish and chip supper.\r\n\r\nThe quiz questions will be mainly concerned with fishing but will also have some general knowledge questions.\r\nQuiz teams will be selected on the night depending on numbers present. '),(4,5,2,'2018-02-01 08:00:00','Fly Tying','2018-02-15','20:00:00','4','','','Fly tying demonstrations and tuition will be lead by Alan Rees and Steve Jeremy.\r\nAlan is pleased to demonstrate tying specific flies suggested by members.'),(5,5,3,'2018-02-07 08:00:00','Club Outing','2018-02-21','08:00:00','53','','','Club outing to Sandford Pool Trout Fishery.\r\n\r\nAnyone wanting to attend should see Keith Higgins and pay a deposit\r\nThe fishery will be for the exclusive use of CRFFC members on the day\r\nIt is a relatively small fishery so it is essential to book your place.'),(6,5,4,'2018-02-08 08:00:00','Social Evening','2018-02-22','18:30:00','51','','','Gary Evans will be hosting his annual social evening (with free buffet and drinks) and discounted fishing tackle\r\nThis will be followed by a short CRFFC meeting at St Josephs to which all are invited.'),(7,5,5,'2018-02-15 08:00:00','Fly Tying','2018-03-01','20:00:00','4','','','Fly tying demonstrations with Alan Rees and Steve Jeremy.'),(8,5,6,'2018-02-22 08:00:00','Video Evening','2018-03-08','20:00:00','4','','','Jim Winterbottom will present a video compilation of Club outings and of Club members catching fish.'),(9,5,7,'2018-03-01 08:00:00','Fly Tying','2018-03-15','20:00:00','4','','','Fly tying with Alan Rees and Steve Jeremy'),(10,1,2,'2018-03-03 08:00:00','St Patricks Evening','2018-03-17','20:00:00','4','','','St Patricks Evening celebration with \'Rocky Road Celtic Band\' entertaining.\r\nTickets Â£6 available from club 029 2061 9286'),(11,5,8,'2018-03-14 08:00:00','Sandford Pool','2018-03-28','16:00:00','53','','','Keith Higgins and Jeff Wilson visited Sandford Pool on Tuesday 27th March.\r\nSandford is fishing well at present.'),(12,5,9,'2018-03-29 08:00:00','Woolaston Court Trout Lakes','2018-04-12','00:00:00','55','','',''),(13,5,10,'2018-10-15 08:00:00','Ynys-y-Fro Reservoirs','2018-10-29','12:00:00','56','','','Ynys-y-Fro Reservoirs are fishing well at present, despite the abrupt cold weather. Several Club members have fished the top pond over the weekend and all have caught fish, with some catch limits reported. The bottom pond has been partially emptied for repairs which are estimated to take 6 to 8 weeks. Fishing is still possible but great care must be taken as the mud is treacherous in places. The bottom pond will not be stocked until it is refilled. \r\nN.B. Fishing will continue until January 2019.'),(14,5,11,'2018-10-17 08:00:00','Clywedog Reservoir 31st October','2018-10-31','08:00:00','57','','','An boat outing to Clywedog Reservoir leaving on 31st October returning 1st November has been proposed. Members are welcome to attend and should contact Keith Higgins for more details.'),(15,5,12,'2018-10-27 08:00:00','Clywedog Reservoir','2018-11-10','12:00:00','57','','','');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtures_bowls`
--

DROP TABLE IF EXISTS `fixtures_bowls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixtures_bowls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(1024) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) NOT NULL DEFAULT '0',
  `away_team_score` int(11) NOT NULL DEFAULT '0',
  `home_team_points` int(11) NOT NULL DEFAULT '0',
  `away_team_points` int(11) NOT NULL DEFAULT '0',
  `home_team_bonus_points` int(11) NOT NULL DEFAULT '0',
  `away_team_bonus_points` int(11) NOT NULL DEFAULT '0',
  `publish_results` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtures_bowls`
--

LOCK TABLES `fixtures_bowls` WRITE;
/*!40000 ALTER TABLE `fixtures_bowls` DISABLE KEYS */;
INSERT INTO `fixtures_bowls` VALUES (1,'2018-04-03 08:00:00',1,4,6,'2018-04-17','14:30:00','Pontyclun Institute Athletic Club, Castan Road, Pontyclun CF72 9EH','CANCELLED','','Pontyclun Athletic\'s green is not playable.',50,70,0,0,0,0,1),(2,'2018-04-07 08:00:00',2,4,7,'2018-04-21','14:30:00','Mackintosh Bowls Club, Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW','14:00 STG','Mike Foster 07967 265746','',77,107,0,0,0,0,1),(3,'2018-04-11 08:00:00',3,4,7,'2018-04-25','14:30:00','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','17:30 STG','Denis Moriarty 07773 037737','',35,78,0,0,0,0,1),(4,'2018-04-12 08:00:00',4,20,6,'2018-04-26','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',74,55,0,0,0,0,1),(5,'2018-04-17 08:00:00',5,4,6,'2018-05-01','14:30:00','Cardiff Athletic Bowls Club, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','14:00 STG','Dai Rees 07546 962407','',46,67,0,0,0,0,1),(6,'2018-04-18 08:00:00',4,18,5,'2018-05-02','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','17:30 STG','Denis Moriarty 07773 037737','',112,27,6,0,8,0,1),(7,'2018-04-19 08:00:00',6,4,6,'2018-05-03','14:30:00','Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD','14:00 STG','Dai Rees 07546 962407','',55,58,0,0,0,0,1),(8,'2018-04-21 08:00:00',4,13,3,'2018-05-05','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00','Mike Foster 07967 265746','',84,65,6,0,7,1,1),(9,'2018-04-21 08:00:00',7,4,4,'2018-05-05','00:00:00','Barry Athletic Bowls Club, Off Paget Road, Barry Island, Barry CF62 5TQ','13:15 Llwynfedw Gardens','Neil ODonnell 07802 595918','The following people please take their cars: P Perks, J OKeefe, N ODonnell, A Cawley',84,66,6,0,4,4,1),(10,'2018-04-24 08:00:00',4,1,6,'2018-05-08','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',66,61,0,0,0,0,1),(11,'2018-04-25 08:00:00',8,4,5,'2018-05-09','18:00:00','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','17:30 STG','Denis Moriarty 07773 037737','',45,65,0,6,2,6,1),(12,'2018-04-26 08:00:00',9,4,6,'2018-05-10','00:00:00','St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',65,61,0,0,0,0,1),(13,'2018-04-28 08:00:00',10,4,8,'2018-05-12','00:00:00','Caerphilly Social Bowls Club, Morgan Jones Park, Nantgarw Road, Caerphilly CF83 1AP','','','',47,97,0,0,0,0,1),(14,'2018-04-28 08:00:00',4,12,4,'2018-05-12','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',110,69,6,0,6,2,1),(15,'2018-05-02 08:00:00',6,4,5,'2018-05-16','00:00:00','Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD','','','',56,66,0,6,2,6,1),(16,'2018-05-03 08:00:00',4,5,6,'2018-05-17','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',58,64,0,0,0,0,1),(17,'2018-05-05 08:00:00',11,4,8,'2018-05-19','00:00:00','Rhiwbina Bowls Club, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA','','','',70,67,0,0,0,0,1),(18,'2018-05-09 08:00:00',4,3,5,'2018-05-23','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',76,51,6,0,6,2,1),(19,'2018-05-10 08:00:00',4,6,6,'2018-05-24','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',82,45,0,0,0,0,1),(20,'2018-05-12 08:00:00',4,22,8,'2018-05-26','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw gardens','Mike Foster 07967 265746','',74,79,0,0,0,0,1),(21,'2018-05-12 08:00:00',12,4,4,'2018-05-26','14:30:00','Llanbradach Bowls Club, Rear of High Street, Llanbradach, Caerphilly CF83 3LP','13:15 Llwynfedw Gardens','Tony Symons 07531 359935','',67,94,0,6,2,6,1),(22,'2018-05-15 08:00:00',13,4,6,'2018-05-29','00:00:00','Penarth Bowling Club, Rectory Road, Penarth CF64 3AN','','','',74,56,0,0,0,0,1),(23,'2018-05-16 08:00:00',14,4,5,'2018-05-30','18:00:00','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','17:30 STG','Denis Moriarty 07773 037737','',38,51,0,6,2,6,1),(24,'2018-05-17 08:00:00',4,2,6,'2018-05-31','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','CANCELLED','','',0,0,0,0,0,0,1),(25,'2018-05-19 08:00:00',15,4,3,'2018-06-02','14:30:00','Sully Sports Bowls Club, Sully Sports and Social Club, South Road, Sully, Vale of Glamorgan, CF64 5SP','13:15 Llwynfedw Gardens','Mike Foster 07967 265746','',65,88,0,6,2,6,1),(26,'2018-05-19 08:00:00',4,28,4,'2018-06-02','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','N ODonnell 07802 595918','',69,104,0,6,4,4,1),(27,'2018-05-22 08:00:00',4,22,6,'2018-06-05','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Dai Rees 07546 962407','',71,55,0,0,0,0,1),(28,'2018-05-23 08:00:00',4,25,5,'2018-06-06','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','17:30 Llwynfedw Gardens','Denis Moriarty 07773 037737','',67,45,6,0,8,0,1),(29,'2018-05-24 08:00:00',16,4,6,'2018-06-07','14:30:00','Windsor Bowling Club, Robinswood Crescent, Penarth, Vale of Glamorgan CF64 3JF','','','',46,66,0,0,0,0,1),(30,'2018-05-26 08:00:00',4,26,3,'2018-06-09','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Paul Cope 07972 359457','',59,82,0,6,3,5,1),(31,'2018-05-26 08:00:00',17,4,4,'2018-06-09','14:30:00','Penylan Bowling Club, Marlborough Rd, Cardiff CF23 5BU','14:00 STG','Neil ODonnell','',90,61,6,0,6,2,1),(32,'2018-05-29 08:00:00',11,4,6,'2018-06-12','14:30:00','Rhiwbina Bowls Club, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA','','','',58,65,0,0,0,0,1),(33,'2018-05-30 08:00:00',4,27,5,'2018-06-13','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',65,60,6,0,7,1,1),(34,'2018-05-31 08:00:00',9,4,6,'2018-06-14','00:00:00','St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',49,69,0,0,0,0,1),(35,'2018-06-02 08:00:00',5,4,3,'2018-06-16','14:30:00','Cardiff Athletic Bowls Club, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','13:15 Llwynfedw Gardens ALL PLAYERS (Limited parking at Cardiff Arms Park - Rolling Stones Concert)','Mike Foster 07967 265746','',62,85,0,6,2,6,1),(36,'2018-06-02 08:00:00',4,9,4,'2018-06-16','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Neil ODonnell 07802 595918','',86,77,6,0,5,3,1),(37,'2018-06-05 08:00:00',4,22,6,'2018-06-19','00:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',71,82,0,0,0,0,1),(38,'2018-06-06 08:00:00',18,4,5,'2018-06-20','00:00:00','Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ','','','',52,58,0,6,2,6,1),(39,'2018-06-09 08:00:00',4,15,3,'2018-06-23','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw gardens','Mike Foster 07967 265746','',0,0,6,0,8,0,1),(40,'2018-06-09 08:00:00',19,4,4,'2018-06-23','14:30:00','Harlequins Bowls Club, Park Grove, Aberdare CF44 8EL','13:00 Llwynfedw Gardens','Neil ODonnell 07802 595918','',71,84,0,6,2,6,1),(41,'2018-06-12 08:00:00',20,4,6,'2018-06-26','14:30:00','Murch Bowls Club, Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP','CANCELLED','','',0,0,0,0,0,0,1),(42,'2018-06-13 08:00:00',4,8,5,'2018-06-27','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','17:30 Llwynfedw Gardens','Denis Moriarty 07773 037737','',79,44,6,0,8,0,1),(43,'2018-06-14 08:00:00',9,4,6,'2018-06-28','14:30:00','St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',68,51,0,0,0,0,1),(44,'2018-06-16 08:00:00',13,4,3,'2018-06-30','14:30:00','Penarth Bowling Club, Rectory Road, Penarth CF64 3AN','13:15 Llwynfedw Gardens','Mike Foster 07967 265746','',70,83,0,6,4,4,1),(45,'2018-06-16 08:00:00',4,22,4,'2018-06-30','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Neil ODonnell 07802 595918','',67,93,0,6,3,5,1),(46,'2018-06-20 08:00:00',4,6,5,'2018-07-04','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','17:30 Llwynfedw Gardens','Denis Moriarty 07773 037737','',85,45,6,0,8,0,1),(47,'2018-06-23 08:00:00',22,4,3,'2018-07-07','14:30:00','Whitchurch Hospital, Park Road, Whitchurch, Cardiff CF14 7XB','14:00 STG','Mike Foster 07967 265746','',79,79,3,3,4,4,1),(48,'2018-06-23 08:00:00',4,31,4,'2018-07-07','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Neil ODonnell 07802 595918','',60,110,0,6,0,8,1),(49,'2018-06-26 08:00:00',5,4,6,'2018-07-10','14:30:00','Cardiff Bowling Club, Sophia Gardens/Canton, Cardiff CF11 9SW','','','',70,55,0,0,0,0,1),(50,'2018-06-27 08:00:00',3,4,5,'2018-07-11','17:00:00','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','16:30 STG','Denis Moriarty 07773 037737','',45,67,0,6,2,6,1),(51,'2018-06-28 08:00:00',9,4,6,'2018-07-12','14:30:00','St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',55,65,0,0,0,0,1),(52,'2018-06-30 08:00:00',4,2,3,'2018-07-14','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',78,57,6,0,4,4,1),(53,'2018-07-03 08:00:00',22,4,6,'2018-07-17','14:30:00','Whitchurch Bowls Club, Penlline Rd, Cardiff CF14 2AD','','','',79,70,0,0,0,0,1),(54,'2018-07-04 08:00:00',4,14,5,'2018-07-18','18:00:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','Llwynfedw Gardens 17:30','Densi Moriarty 07773 037737','',72,35,6,0,8,0,1),(55,'2018-07-05 08:00:00',4,5,6,'2018-07-19','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',80,64,0,0,0,0,1),(56,'2018-07-07 08:00:00',4,7,4,'2018-07-21','14:30:00','St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','14:00 Llwynfedw Gardens','Neil ODonnell 07802 595918','',69,86,0,6,2,6,1),(67,'2019-03-08 12:49:39',2,4,7,'2019-04-20','14:30:00','Mackintosh BC, Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW','','','',0,0,0,0,0,0,0),(68,'2019-03-08 12:50:27',4,20,6,'2019-04-25','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(69,'2019-03-08 12:51:23',4,26,3,'2019-04-27','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(70,'2019-03-08 12:54:48',50,4,4,'2019-04-27','14:30:00','Dinas Powys BC, St Andrew&#39;s Rd, Dinas Powys CF64 4HB','','','',0,0,0,0,0,0,0),(71,'2019-03-08 12:58:04',5,4,6,'2019-04-30','14:30:00','Cardiff Athletic BC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','','','',0,0,0,0,0,0,0),(72,'2019-03-08 12:59:00',6,4,6,'2019-05-02','14:30:00','Rumney BC, Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD','','','',0,0,0,0,0,0,0),(73,'2019-03-08 14:11:18',5,4,3,'2019-05-04','14:30:00','Cardiff Athletic BC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','','','',0,0,0,0,0,0,0),(74,'2019-03-08 14:11:53',4,31,4,'2019-05-04','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(75,'2019-03-08 14:13:02',4,1,6,'2019-05-07','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(76,'2019-03-08 14:13:55',8,4,5,'2019-05-08','18:00:00','Roath Park BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','','','',0,0,0,0,0,0,0),(77,'2019-03-08 14:14:47',9,4,6,'2019-05-09','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(78,'2019-03-08 14:46:59',4,10,8,'2019-05-11','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(79,'2019-03-08 14:47:51',6,4,5,'2019-05-15','18:00:00','Rumney BC, Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD','','','',0,0,0,0,0,0,0),(80,'2019-03-08 14:48:37',4,23,6,'2019-05-16','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(82,'2019-03-08 17:45:42',4,32,8,'2019-05-18','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(83,'2019-03-08 17:46:15',4,3,5,'2019-05-22','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(84,'2019-03-08 17:46:57',4,6,6,'2019-05-23','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(85,'2019-03-08 17:52:52',24,4,8,'2019-05-25','14:30:00','Whitchurch BC, Penlline Rd, Cardiff CF14 2AD','','','',0,0,0,0,0,0,0),(86,'2019-03-08 17:53:44',4,23,4,'2019-05-25','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(87,'2019-03-08 17:54:46',13,4,6,'2019-05-28','14:30:00','Penarth BC, Rectory Road, Penarth CF64 3AN','','','',0,0,0,0,0,0,0),(88,'2019-03-08 17:55:14',14,4,5,'2019-05-29','18:00:00','Fairoak BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','','','',0,0,0,0,0,0,0),(89,'2019-03-08 17:55:50',4,2,6,'2019-05-30','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(90,'2019-03-08 17:56:21',4,32,3,'2019-06-01','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(91,'2019-03-08 17:57:03',7,4,4,'2019-09-14','14:30:00','Barry Athletic BC, Off Paget Road, Barry Island, Barry CF62 5TQ','','','',0,0,0,0,0,0,0),(92,'2019-03-08 17:57:35',4,22,6,'2019-06-04','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(93,'2019-03-08 17:58:10',4,25,5,'2019-06-05','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(94,'2019-03-08 17:58:44',1,4,6,'2019-06-06','14:30:00','Pontyclun BC, Castan Road, Pontyclun CF72 9EH','','','',0,0,0,0,0,0,0),(95,'2019-03-08 17:59:26',9,4,3,'2019-06-08','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(96,'2019-03-08 18:00:35',4,28,4,'2019-06-08','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(97,'2019-03-08 18:38:35',32,4,6,'2019-06-11','14:30:00','Rhiwbina BC, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA','','','',0,0,0,0,0,0,0),(98,'2019-03-08 18:39:05',4,27,5,'2019-06-12','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(99,'2019-03-08 18:39:37',9,4,6,'2019-06-13','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(100,'2019-03-08 18:40:17',4,24,3,'2019-06-15','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(101,'2019-03-08 18:40:46',24,4,4,'2019-06-15','14:30:00','Whitchurch BC, Penlline Rd, Cardiff CF14 2AD','','','',0,0,0,0,0,0,0),(102,'2019-03-08 18:41:35',4,24,6,'2019-06-18','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(103,'2019-03-08 18:42:17',1,4,6,'2019-06-20','14:30:00','Pontyclun BC, Castan Road, Pontyclun CF72 9EH','','','',0,0,0,0,0,0,0),(104,'2019-03-08 18:42:53',19,4,4,'2019-06-22','14:30:00','Harlequins BC, Park Grove, Aberdare CF44 8EL','','','',0,0,0,0,0,0,0),(105,'2019-03-08 18:43:26',20,4,6,'2019-06-25','14:30:00','Murch BC, Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP','','','',0,0,0,0,0,0,0),(106,'2019-03-08 18:44:13',4,8,5,'2019-06-26','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(107,'2019-03-08 18:44:48',9,4,6,'2019-06-27','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(108,'2019-03-08 18:45:16',16,4,3,'2019-06-29','14:30:00','Windsor BC, Robinswood Crescent, Penarth, Vale of Glamorgan CF64 3JF','','','',0,0,0,0,0,0,0),(109,'2019-03-08 18:45:49',4,17,4,'2019-06-29','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(110,'2019-03-08 19:28:55',4,51,7,'2019-06-30','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(111,'2019-03-08 19:29:25',4,6,5,'2019-07-03','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(112,'2019-03-08 19:31:55',52,4,4,'2019-07-06','14:30:00','Guest Memorial BC, Charlotte Gardens, Dowlais, Merthyr Tydfil CF48 3LJ','','','',0,0,0,0,0,0,0),(113,'2019-03-08 19:32:26',23,4,6,'2019-07-09','14:30:00','Cardiff BC, Sophia Gardens/Canton, Cardiff CF11 9SW','','','',0,0,0,0,0,0,0),(114,'2019-03-08 19:33:07',3,4,5,'2019-07-10','18:00:00','St Peter&#39;s BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP','','','',0,0,0,0,0,0,0),(115,'2019-03-08 19:33:40',9,4,6,'2019-07-11','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(116,'2019-03-08 19:34:12',26,4,3,'2019-07-13','14:30:00','Llantrisant BC, 1 Cardiff Rd, Llantrisant, Pontyclun CF72 8DG','','','',0,0,0,0,0,0,0),(117,'2019-03-08 19:34:51',4,50,4,'2019-07-13','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(118,'2019-03-08 19:36:06',24,4,6,'2019-07-16','14:30:00','Whitchurch BC, Penlline Rd, Cardiff CF14 2AD','','','',0,0,0,0,0,0,0),(119,'2019-03-08 19:36:38',4,14,5,'2019-07-17','18:00:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(120,'2019-03-08 19:37:16',4,23,6,'2019-07-18','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(121,'2019-03-08 19:37:52',4,5,3,'2019-07-20','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(122,'2019-03-08 19:38:20',31,4,4,'2019-07-20','14:30:00','Ystradfechan BC, Ystradfechan Fields, Treorchy, Rhondda Cynon Taff CF42 6HL','','','',0,0,0,0,0,0,0),(123,'2019-03-08 19:39:00',29,4,6,'2019-07-23','14:30:00','Barry Romilly BC, Romilly Rd, Barry CF62 6LF','','','',0,0,0,0,0,0,0),(124,'2019-03-08 19:39:29',25,4,5,'2019-07-24','18:00:00','St Alban&#39;s BC, Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ','','','',0,0,0,0,0,0,0),(125,'2019-03-08 19:40:27',4,13,6,'2019-07-25','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(126,'2019-03-08 19:41:00',4,23,3,'2019-07-27','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(127,'2019-03-08 19:41:27',23,4,4,'2019-07-27','14:30:00','Cardiff BC, Sophia Gardens/Canton, Cardiff CF11 9SW','','','',0,0,0,0,0,0,0),(128,'2019-03-08 19:43:01',27,4,5,'2019-07-31','18:00:00','Ely BC','','','',0,0,0,0,0,0,0),(129,'2019-03-08 19:43:43',4,23,6,'2019-08-01','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(130,'2019-03-08 19:44:08',32,4,3,'2019-08-03','14:30:00','Rhiwbina BC, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA','','','',0,0,0,0,0,0,0),(131,'2019-03-08 19:44:40',4,7,4,'2019-08-03','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(132,'2019-03-08 19:45:11',4,9,3,'2019-08-10','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(133,'2019-03-08 19:45:42',28,4,4,'2019-08-10','14:30:00','Merthyr West End BC, The Grove, Merthyr Tydfil CF47 8YR','','','',0,0,0,0,0,0,0),(134,'2019-03-08 19:46:10',5,4,6,'2019-08-13','14:30:00','Cardiff Athletic BC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','','','',0,0,0,0,0,0,0),(135,'2019-03-08 19:46:41',4,29,6,'2019-08-15','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(136,'2019-03-08 19:47:11',24,4,3,'2019-08-17','14:30:00','Whitchurch BC, Penlline Rd, Cardiff CF14 2AD','','','',0,0,0,0,0,0,0),(137,'2019-03-08 19:47:40',4,24,4,'2019-08-17','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(138,'2019-03-08 19:48:11',4,22,6,'2019-08-20','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(139,'2019-03-08 19:48:42',2,4,6,'2019-08-22','14:30:00','Mackintosh BC, Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW','','','',0,0,0,0,0,0,0),(140,'2019-03-08 19:49:15',4,19,4,'2019-08-24','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(141,'2019-03-08 19:50:11',20,4,6,'2019-08-27','14:30:00','Murch BC, Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP','','','',0,0,0,0,0,0,0),(142,'2019-03-08 19:51:03',23,4,6,'2019-08-29','14:30:00','Cardiff BC, Sophia Gardens/Canton, Cardiff CF11 9SW','','','',0,0,0,0,0,0,0),(143,'2019-03-08 19:52:06',4,16,3,'2019-08-31','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(144,'2019-03-08 19:52:52',17,4,4,'2019-08-31','14:30:00','Penylan BC, Marlborough Rd, Cardiff CF23 5BU','','','',0,0,0,0,0,0,0),(145,'2019-03-08 19:53:27',4,32,6,'2019-09-03','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0),(146,'2019-03-08 19:54:47',23,4,7,'2019-09-04','18:00:00','Cardiff BC, Sophia Gardens/Canton, Cardiff CF11 9SW','','','',0,0,0,0,0,0,0),(147,'2019-03-08 19:55:36',9,4,6,'2019-07-05','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(148,'2019-03-08 19:58:09',9,4,6,'2019-09-05','14:30:00','St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG','','','',0,0,0,0,0,0,0),(149,'2019-03-08 19:58:42',5,4,3,'2019-09-07','14:30:00','Cardiff Athletic BC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA','','','',0,0,0,0,0,0,0),(150,'2019-03-08 19:59:18',4,52,4,'2019-09-07','14:30:00','St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW','','','',0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `fixtures_bowls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtures_football`
--

DROP TABLE IF EXISTS `fixtures_football`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixtures_football` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(1024) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) DEFAULT NULL,
  `away_team_score` int(11) DEFAULT NULL,
  `publish_results` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtures_football`
--

LOCK TABLES `fixtures_football` WRITE;
/*!40000 ALTER TABLE `fixtures_football` DISABLE KEYS */;
INSERT INTO `fixtures_football` VALUES (1,'2018-01-20 08:00:00',53,38,1,'2018-02-03','14:30:00','St Joseph\'s AFC, Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF','','','',NULL,NULL,0),(2,'2018-02-03 08:00:00',39,53,1,'2018-02-17','14:30:00','Llanharry AFC, Llanharry Recreation Ground, Llanharry, Pontyclun CF72 9HL','','','',NULL,NULL,0),(3,'2018-02-10 08:00:00',53,41,1,'2018-02-24','14:30:00','St Joseph\'s AFC, Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF','','','',NULL,NULL,0),(4,'2018-01-27 08:00:00',40,53,1,'2018-02-10','14:30:00','Penrhiwfer AFC, Tonypandy CF40 1XX','','','',NULL,NULL,0);
/*!40000 ALTER TABLE `fixtures_football` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtures_rugby`
--

DROP TABLE IF EXISTS `fixtures_rugby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixtures_rugby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(1024) DEFAULT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) DEFAULT NULL,
  `away_team_score` int(11) DEFAULT NULL,
  `publish_results` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtures_rugby`
--

LOCK TABLES `fixtures_rugby` WRITE;
/*!40000 ALTER TABLE `fixtures_rugby` DISABLE KEYS */;
INSERT INTO `fixtures_rugby` VALUES (1,'2017-08-19 08:00:00',42,47,2,'2017-09-02','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',37,25,1),(2,'2017-08-26 08:00:00',43,42,2,'2017-09-09','14:30:00','Glamorgan Wanderers RFC, Memorial Ground, Stirling Rd, Cardiff CF5 4SR','','','',24,26,1),(3,'2017-09-02 08:00:00',42,46,2,'2017-09-16','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',42,26,1),(4,'2017-09-09 08:00:00',44,42,2,'2017-09-23','14:30:00','Porth Harlequins RFC, The Welfare Ground, Porth, Rhondda Cynon Taff, CF39 9TW','','','',39,31,1),(5,'2017-09-16 08:00:00',42,48,2,'2017-09-30','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',22,27,1),(6,'2017-09-23 08:00:00',42,47,9,'2017-10-07','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',43,10,1),(7,'2017-09-30 08:00:00',6,42,2,'2017-10-14','14:30:00','Rumney RFC, Riverside Park, Hartland Rd, Rumney, Llanrumney CF3 4JL','','','',17,33,1),(8,'2017-10-07 08:00:00',42,11,2,'2017-10-21','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',17,5,1),(9,'2017-10-14 08:00:00',42,49,9,'2017-10-28','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',28,20,1),(10,'2017-10-21 08:00:00',26,42,2,'2017-11-04','14:30:00','Llantrisant RFC, St David\'s Pl, Llantrisant, Pontyclun CF72 8HA','','','',17,13,1),(11,'2017-10-28 08:00:00',42,35,2,'2017-11-11','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',31,34,1),(12,'2017-11-25 08:00:00',46,42,9,'2017-12-09','14:30:00','Mountain Ash RFC, Parc Dyffryn Pennar: Dyffryn Road, Mountain Ash, Rhondda Cynon Taff, CF45 4DA','','','',14,6,1),(13,'2017-12-02 08:00:00',47,42,2,'2017-12-16','14:30:00','Heol-Y-Cyw RFC, 37 High Street, Bridgend, CF35 6HR','','','',24,16,1),(14,'2017-12-16 08:00:00',42,43,2,'2017-12-30','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',10,28,1),(15,'2017-12-23 08:00:00',46,42,2,'2018-01-06','14:30:00','Mountain Ash RFC, Parc Dyffryn Pennar: Dyffryn Road, Mountain Ash, Rhondda Cynon Taff, CF45 4DA','','','',46,10,1),(16,'2017-12-30 08:00:00',42,44,2,'2018-01-13','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',29,14,1),(17,'2018-01-06 08:00:00',48,42,2,'2018-01-20','14:30:00','Dinas Powys RFC, Dinas Powys Athletic Club, The Pavilion, Dinas Powys CF64 4DL','','','',8,3,1),(18,'2018-01-13 08:00:00',42,6,2,'2018-01-27','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',26,12,1),(19,'2018-02-03 08:00:00',11,42,2,'2018-02-17','14:30:00','Rhiwbina RFC, Caedelyn Park, Cardiff CF14 1BE','','','',NULL,NULL,0),(20,'2018-02-17 08:00:00',42,26,2,'2018-03-03','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',NULL,NULL,0),(21,'2018-02-24 08:00:00',35,42,2,'2018-03-10','14:30:00','Ystrad Rhondda RFC, 81 Gelligaled Rd, Ystrad, Pentre CF41 7RQ','','','',NULL,NULL,0),(22,'2018-03-10 08:00:00',42,36,2,'2018-03-24','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',NULL,NULL,0),(23,'2018-03-24 08:00:00',37,42,2,'2018-04-07','14:30:00','Llanharan Rugby Football Club, Bridgend Road, Llanharan, Rhondda Cynon Taf CF72 9RD','','','',NULL,NULL,0),(24,'2018-03-31 08:00:00',36,42,2,'2018-04-14','14:30:00','Treorchy RFC, 126 High St, Treorchy CF42 6PB','','','',NULL,NULL,0),(25,'2018-04-07 08:00:00',42,37,2,'2018-04-21','14:30:00','St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA','','','',NULL,NULL,0);
/*!40000 ALTER TABLE `fixtures_rugby` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leagues`
--

DROP TABLE IF EXISTS `leagues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `league` varchar(255) NOT NULL,
  `league_full` varchar(255) NOT NULL,
  `league_website` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leagues`
--

LOCK TABLES `leagues` WRITE;
/*!40000 ALTER TABLE `leagues` DISABLE KEYS */;
INSERT INTO `leagues` VALUES (1,4,0,'SWAL Division 2','',''),(2,3,0,'WRU NL Lge 1 East Central','',''),(3,2,0,'PG1','East Wales Private Greens Association - First Teams',''),(4,2,0,'PG2','East Wales Private Greens Association - SecondTeams',''),(5,2,0,'CML','Cardiff & District Municipal League',''),(6,2,0,'Alliance','Midweek Friendly Match(es)',''),(7,2,0,'Friendly','Friendly Match(es)',''),(8,2,0,'WBA','Welsh Bowling Association',''),(9,3,0,'WRU Cup','',''),(10,2,1,'Test league','Test League practice','Test.co.uk');
/*!40000 ALTER TABLE `leagues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_links`
--

DROP TABLE IF EXISTS `menu_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `menu_link_title` varchar(128) NOT NULL,
  `menu_link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_links`
--

LOCK TABLES `menu_links` WRITE;
/*!40000 ALTER TABLE `menu_links` DISABLE KEYS */;
INSERT INTO `menu_links` VALUES (1,4,'League','http://www.southwalesallianceleague.co.uk/Divisions?div=9177&age=all'),(2,3,'League','http://www.wru.co.uk/eng/club/leagues/tables.php?includeref=1999&season=2017-2018&stage=1EC'),(3,2,'Gallery','https://photos.google.com/share/AF1QipPEgEGUddnQenmTu2JdUVho3m-jz6hL5maHUpW2x4tO3WpTMADixGf_uY6ObCfk4A?key=MC1RWEhwRHFIdWtEbG9PMXhfb1ZOVXY3aHFqTHNn'),(5,5,'Gallery','https://photos.app.goo.gl/ycZg6aCp8DPAoXpK2'),(6,2,'League','http://eastwalesprivategreensba.co.uk/');
/*!40000 ALTER TABLE `menu_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` date DEFAULT NULL,
  `expiry_date_option` varchar(20) NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `notice` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (1,1,1,NULL,'2018-01-23 00:00:00','2018-02-06','+ 2 Weeks',0,'Website Change','Visitors to stjosephsbowlsclub.co.uk are being re-directed to stjosephscssc.co.uk\r\n\r\nThis website has been created to communicate to our social club members all notices, events, fixtures, and activities taking place within the club and to amalgamate the websites of all our sports sections ie Bowls, Boxing, Football, and Rugby into one website.\r\n\r\nEach sports section is having their current website reviewed for suitable content before migrating to their own sub-section.  The Bowls section is the first to undergo this process and all other sections will follow suit as soon as possible.\r\n\r\nWe hope you like the new look.'),(2,5,1,NULL,'2018-07-30 00:00:00','2018-08-13','+ 2 Weeks',0,'Cardiff Reservoirs Fly Fishing Club','Club meetings are held at St Josephs Club every Thursday evening starting between 7 and 7:30 pm'),(3,2,1,NULL,'2018-09-23 00:00:00','2018-10-07','+ 2 Weeks',0,'Green Closed','The green is now closed as of Sunday 23 September 2018.\r\nIt will re-open in April 2019.'),(4,1,2,NULL,'2018-11-08 00:00:00','2018-11-22','+ 2 Weeks',1,'Bowls AGM','Tuesday 13th November 2018 20:00\r\nAll players are encouraged to attend.\r\n'),(5,2,2,NULL,'2018-11-08 00:00:00','2018-11-22','+ 2 Weeks',1,'AGM','Tuesday 13th November 2018 20:00\r\nAll players are encouraged to attend.'),(6,2,3,NULL,'2018-11-08 00:00:00','2018-11-22','+ 2 Weeks',1,'Presentation Evening','Friday 23rd November 2018 \r\nAnnual presentation evening to be held at Cyncoed Golf Club.'),(7,1,3,NULL,'2018-11-08 00:00:00','2018-11-22','+ 2 Weeks',1,'Bowls Presentation Evening','Friday 23rd November 2018 \r\nAnnual presentation evening to be held at Cyncoed Golf Club.'),(8,2,4,NULL,'2019-02-05 17:55:31','2019-02-13','+1 Week',0,'Test Notice','Test notice description.\r\n\r\nEDIT: more text added'),(10,2,5,NULL,'2019-03-13 17:46:40','2019-03-28','+2 Weeks',1,'Pre-Season Players Meeting','Thursday 21st March 2019 20:00\r\nPre-Season Players Meeting to be held in St Joseph&#39;s Sports and Social Club.\r\nAll players, current and new, are encouraged to attend.');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outings`
--

DROP TABLE IF EXISTS `outings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(1024) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `report` text NOT NULL,
  `publish_report` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outings`
--

LOCK TABLES `outings` WRITE;
/*!40000 ALTER TABLE `outings` DISABLE KEYS */;
INSERT INTO `outings` VALUES (1,'2018-02-10 08:00:00','Ravensnest Trout Fishery','2018-02-24','00:00:00','Ravensnest Trout Fishery, Raglan Road, Tintern, Chepstow, Gwent, NP16 6TP','','','','This small fishery may not be everybody\'s cup of tea but it usually fishes well enough to give inexperienced anglers a fish or two, although at times it can be challenging. I visited with Jeff Wilson on a very cold morning. Jeff caught 7 and I caught 4 that included a beautiful rainbow of 3lb 4oz (see gallery).\r\nThe fishery is in the new ownership of a very enthusiastic young chap called Russell.  He has already closed Edward\'s dingy wooden hut and refurbished the adjacent brick pumping station. He has a clear vision of how he wants to develop the fishery starting in the near future by dredging all the pools and bringing the top pool back on line. He has increased his prices slightly to Â£20 for 6 hours catch and release but that includes free tea or coffee, and he can provide breakfasts and burgers.  He also has a loyalty scheme â€“ fish 12 times and get another visit free.\r\nReport by Maurice Prendergast.',1),(2,'2018-03-14 08:00:00','Sandford Pool','2018-03-28','08:00:00','Sandford Pool Trout Fishery, Sandford Road, Alvington, Lydney, Gloucestershire GL15 6PZ','','','','Keith Higgins and Jeff Wilson visited Sandford Pool on Tuesday 27th March 2018. \r\nSandford is fishing well at present, both took their ten fish limits and Keith took the best rainbow estimated at about 4lb. See the Gallery for photos',1),(3,'2018-03-14 08:00:00','Woolaston Court Trout Lakes','2018-03-28','17:00:00','Woolaston Court Trout Lakes, Main Road, Woolaston, Lydney, Gloucestershire GL15 6PJ','','','','Woolaston Court Trout Lakes are fishing well at present, with many anglers taking limit bags',1),(4,'2018-03-14 08:00:00','Ravensnest Trout Fishery','2018-03-28','17:00:00','Ravensnest Trout Fishery, Raglan Road, Tintern, Chepstow, Gwent, NP16 6TP','','','','Ravensnest Trout Fishery is fishing well at present. Maurice Prendergast, Jim Winterbottom, Fred Hooper and Jeff Wilson visited the fishery recently and all caught fish. Maurice did particularly well taking 6 fish including a lovely rainbow of about 4lb. The water at Ravensnest does tend to get progressively more coloured after a few days of heavy rain due to the river carrying down silt - see the gallery for pictures when Keith Higgins and Jeff Wilson visited one very rainy day and the water was the colour of milk chocolate!',1),(5,'2018-06-18 08:00:00','Sandford Pool','2018-07-02','14:00:00','Sandford Pool Trout Fishery, Sandford Road, Alvington, Lydney, Gloucestershire GL15 6PZ','Sandford Pool','Keith Higgins','An afternoon / evening outing has been proposed for Sandford Pool on Monday 2nd July. Come and go as you please after 2p.m.\r\nContact Keith Higgins for details or turn up to one of our weekly Club meetings at St Joseph\'s Club','A Club outing to Sandford Pool took place on 2nd July 2018. Six members attended this afternoon / evening event and all enjoyed the excellent fishing and bacon butties! Photos from Sandford have been published on the website \'gallery\'. Thanks go to Sami and Ken for allowing our Club exclusive use of their fishery especially as they normally close on Mondays.',1),(6,'2018-07-18 08:00:00','Ravensnest Trout Fishery','2018-08-01','17:00:00','Ravensnest Trout Fishery, Raglan Road, Tintern, Chepstow, Gwent, NP16 6TP','Ravensnest','JW','','Ravensnest is fishing well at present, despite the prolonged hot weather. 5 Club members fished there on Tuesday 31st July and most caught fish. Jim Winterbottom caugh 8, Jeff Wilson 8, Maurice Prendergast 6, Rory Fagan 4 and Fred Hooper was smahed by a whopper before he could get it in the net. Jeff caught the 2 best fish of the day estimated at about 6lb. Most fish were caught on buzzers and egg flies with a few taking black lures.\r\nA good day was had by all and an added bonus was a free bacon roll provided by the owner, Russell mid morning. Photos are in the Gallery section on our website.',1),(7,'2018-10-15 08:00:00','Ynys-y-Fro Reservoirs','2018-10-29','00:00:00','Ynys-y-Fro Reservoirs, near Fourteen Locks visitor centre, Newport, Gwent NP10 9GN','Ynys-y-Fro','JW','','Ynys-y-Fro Reservoirs are fishing well at present despite the sudden cold snap. Several CRFFC members fished the top pond over the weekend and all caught fish with some reaching their catch limits. The bottom pond has been partially emptied for repairs with the water level down about 4 metres. Fishing is still possible there and some NRFFA members have caught fish but great care must be taken as the mud is treacherous in places and it is not safe to fish off the dam wall. Repairs will take 6 to 8 weeks and the estimated refill time is up to 3 months. The bottom pond will not be stocked until the water levels have increased.',1),(8,'2018-10-27 08:00:00','Clywedog Reservoir','2018-11-10','12:00:00','Clywedog Reservoir','','','','A 2 day outing to Clywedog Reservoir by 4 CRFFC members on 7th and 8th November was very successful, despite the foul weather conditions, with over 40 fish to the two boats. Best rainbow of (an estimated) 4lb was caught by Jim Winterbottom with the average size of fish 2.5 lbs.  The fish were in superb condition and fought really hard. A few blues were also taken and they fought spectacularly jumping well clear of the water. Successful flies were predominantly egg flies and large cat\'s whiskers fished under a sight bob, but fish were also take pulling lures. Clywedog closes on 30th November.',1);
/*!40000 ALTER TABLE `outings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remove` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,2,0,'P Perks','',1,0),(2,2,0,'P Cuddihy','',1,0),(3,2,0,'P Speakman','',1,0),(4,2,0,'G Champion','',1,0),(5,2,0,'T George','',1,0),(6,2,0,'P Walsh','',1,0),(7,2,0,'A Bridge','',1,0),(8,2,0,'L Newman','',1,0),(9,2,0,'A Cawley','',1,0),(10,2,0,'K Barry','',1,0),(11,2,0,'C Darmanin','',1,0),(12,2,0,'C Balch','',1,0),(13,2,0,'P Taylor','',1,0),(14,2,0,'D Rees','',1,0),(15,2,0,'M OBrien','',1,0),(16,2,0,'M Todd','',1,0),(17,2,0,'P Cope','',1,0),(18,2,0,'T Symons','',1,0),(19,2,0,'D Moriarty','',1,0),(20,2,0,'M Foster','',1,0),(21,2,0,'R Foley','',1,0),(23,2,0,'W Pitt','',1,0),(24,2,0,'T Edwards','',1,0),(25,2,0,'C Evans','',1,0),(26,2,0,'W George','',1,0),(27,2,0,'B Cornish','',1,0),(28,2,0,'K Magner','',1,0),(29,2,0,'T Tumelty','',1,0),(30,2,0,'B Donaghue','',1,0),(31,2,0,'M Rees','',1,0),(32,2,0,'B OKeefe','',1,0),(33,2,0,'T Barrett','',1,0),(34,2,0,'B Morrissey','',1,0),(36,2,0,'Je Burns','',1,0),(37,2,0,'D Hooper','',1,0),(38,2,0,'N O\'Donnell','',1,0),(39,2,0,'L Badham','',1,0),(41,2,0,'A Whelan','',1,0),(42,2,0,'M Harmon','',1,0),(43,2,0,'Jo Burns','',1,0),(44,2,0,'J OKeefe','',1,0),(45,2,0,'D Owen','',1,0),(46,2,0,'B Pitt','',1,0),(49,2,0,'P Castree','',1,0),(50,2,0,'G Copeland','',1,0),(66,2,0,'M C Davies','',1,0);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_numbers`
--

DROP TABLE IF EXISTS `phone_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `phone_number_title` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_numbers`
--

LOCK TABLES `phone_numbers` WRITE;
/*!40000 ALTER TABLE `phone_numbers` DISABLE KEYS */;
INSERT INTO `phone_numbers` VALUES (1,2,'Secretary - Paul Cope','07972 359457'),(2,2,'Fixture Secretary - Phil Perks','07504 973775');
/*!40000 ALTER TABLE `phone_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `squads`
--

DROP TABLE IF EXISTS `squads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `squads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `fixture_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=624 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `squads`
--

LOCK TABLES `squads` WRITE;
/*!40000 ALTER TABLE `squads` DISABLE KEYS */;
INSERT INTO `squads` VALUES (1,2,2,1,1),(2,2,2,1,2),(3,2,2,1,3),(4,2,2,1,4),(5,2,2,2,5),(6,2,2,2,6),(7,2,2,2,7),(8,2,2,2,8),(9,2,2,3,9),(10,2,2,3,10),(11,2,2,3,11),(12,2,2,3,12),(13,2,2,4,13),(14,2,2,4,14),(15,2,2,4,15),(16,2,2,4,16),(17,2,2,5,17),(18,2,2,5,18),(19,2,2,5,19),(20,2,2,5,20),(21,2,3,1,6),(22,2,3,1,21),(23,2,3,1,66),(24,2,3,1,2),(25,2,3,2,17),(26,2,3,2,23),(27,2,3,2,19),(28,2,3,2,11),(29,2,3,3,3),(30,2,3,3,24),(31,2,3,3,25),(32,2,3,3,20),(33,2,3,4,5),(34,2,3,4,7),(35,2,3,4,26),(36,2,3,4,27),(37,2,3,0,28),(38,2,5,1,1),(39,2,5,1,29),(40,2,5,1,3),(41,2,5,1,16),(42,2,5,2,30),(43,2,5,2,28),(44,2,5,2,17),(45,2,5,2,18),(46,2,5,3,9),(47,2,5,3,31),(48,2,5,3,8),(49,2,5,3,32),(50,2,5,4,13),(51,2,5,4,33),(52,2,5,4,14),(53,2,5,4,34),(54,2,6,1,66),(55,2,6,1,24),(56,2,6,1,12),(57,2,6,1,36),(58,2,6,2,25),(59,2,6,2,26),(60,2,6,2,7),(61,2,6,2,27),(62,2,6,3,3),(63,2,6,3,2),(64,2,6,3,20),(65,2,6,3,4),(66,2,6,4,28),(67,2,6,4,17),(68,2,6,4,19),(69,2,6,4,11),(70,2,6,0,5),(71,2,6,0,1),(72,2,6,0,21),(73,2,7,1,30),(74,2,7,1,37),(75,2,7,1,14),(76,2,7,1,38),(77,2,7,2,1),(78,2,7,2,39),(79,2,7,2,8),(80,2,7,2,18),(81,2,7,3,13),(82,2,7,3,33),(83,2,7,3,9),(84,2,7,3,34),(85,2,7,4,66),(86,2,7,4,31),(87,2,7,4,3),(88,2,7,4,32),(89,2,8,1,17),(90,2,8,1,2),(91,2,8,1,11),(92,2,8,1,12),(93,2,8,2,5),(94,2,8,2,3),(95,2,8,2,20),(96,2,8,2,4),(97,2,8,3,28),(98,2,8,3,26),(99,2,8,3,7),(100,2,8,3,27),(101,2,8,4,66),(102,2,8,4,19),(103,2,8,4,15),(104,2,8,4,36),(105,2,9,1,1),(107,2,9,1,16),(108,2,9,2,13),(109,2,9,2,21),(110,2,9,2,41),(111,2,9,2,42),(112,2,9,3,43),(113,2,9,3,44),(114,2,9,3,38),(115,2,9,3,18),(116,2,9,4,9),(117,2,9,4,10),(118,2,9,4,8),(119,2,9,4,32),(120,2,9,0,31),(121,2,11,1,3),(122,2,11,1,19),(123,2,11,1,7),(124,2,11,1,27),(125,2,11,2,28),(126,2,11,2,5),(127,2,11,2,25),(128,2,11,2,45),(129,2,11,3,21),(130,2,11,3,17),(131,2,11,3,26),(132,2,11,3,36),(133,2,11,4,66),(134,2,11,4,24),(135,2,11,4,20),(136,2,11,4,11),(137,2,11,0,46),(138,2,20,1,66),(139,2,20,1,19),(140,2,20,1,45),(141,2,20,1,36),(142,2,20,2,46),(143,2,20,2,24),(144,2,20,2,7),(145,2,20,2,27),(146,2,20,3,20),(147,2,20,3,29),(148,2,20,3,42),(149,2,20,3,4),(150,2,20,4,17),(151,2,20,4,33),(152,2,20,4,15),(153,2,20,4,11),(154,2,21,1,13),(155,2,21,1,37),(156,2,21,1,41),(157,2,21,1,34),(158,2,21,2,9),(159,2,21,2,43),(160,2,21,2,8),(161,2,21,2,18),(162,2,21,3,49),(163,2,21,3,44),(164,2,21,3,1),(165,2,21,3,32),(166,2,21,4,6),(167,2,21,4,21),(168,2,21,4,14),(169,2,21,4,16),(170,2,23,1,46),(171,2,23,1,24),(172,2,23,1,20),(173,2,23,1,4),(174,2,23,2,66),(175,2,23,2,44),(176,2,23,2,7),(177,2,23,2,27),(178,2,23,3,28),(179,2,23,3,19),(180,2,23,3,15),(181,2,23,3,11),(182,2,23,4,5),(183,2,23,4,25),(184,2,23,4,45),(185,2,23,4,36),(186,2,25,1,17),(187,2,25,1,43),(188,2,25,1,15),(189,2,25,1,11),(190,2,25,2,28),(191,2,25,2,19),(192,2,25,2,7),(193,2,25,2,27),(194,2,25,3,20),(195,2,25,3,24),(196,2,25,3,42),(197,2,25,3,4),(198,2,25,4,66),(199,2,25,4,3),(200,2,25,4,45),(201,2,25,4,36),(202,2,26,1,13),(203,2,26,1,37),(204,2,26,1,41),(205,2,26,1,34),(206,2,26,2,9),(207,2,26,2,21),(208,2,26,2,8),(209,2,26,2,18),(210,2,26,3,6),(211,2,26,3,10),(212,2,26,3,14),(213,2,26,3,16),(214,2,26,4,1),(215,2,26,4,44),(216,2,26,4,38),(217,2,26,4,32),(218,2,27,1,9),(219,2,27,1,5),(220,2,27,1,10),(221,2,27,1,8),(222,2,27,2,13),(223,2,27,2,31),(224,2,27,2,37),(225,2,27,2,14),(226,2,27,3,49),(227,2,27,3,6),(228,2,27,3,44),(229,2,27,3,34),(230,2,27,4,1),(231,2,27,4,39),(232,2,27,4,41),(233,2,27,4,3),(234,2,28,1,46),(235,2,28,1,5),(236,2,28,1,17),(237,2,28,1,7),(238,2,28,2,28),(239,2,28,2,24),(240,2,28,2,2),(241,2,28,2,36),(242,2,28,3,6),(243,2,28,3,19),(244,2,28,3,15),(245,2,28,3,11),(246,2,28,4,1),(247,2,28,4,3),(248,2,28,4,25),(249,2,28,4,45),(250,2,30,1,17),(251,2,30,1,43),(252,2,30,1,15),(253,2,30,1,11),(254,2,30,2,28),(255,2,30,2,19),(256,2,30,2,7),(257,2,30,2,27),(258,2,30,3,20),(259,2,30,3,24),(260,2,30,3,42),(261,2,30,3,36),(262,2,30,4,46),(263,2,30,4,3),(264,2,30,4,26),(265,2,30,4,45),(266,2,31,1,13),(267,2,31,1,41),(268,2,31,1,2),(269,2,31,1,34),(270,2,31,2,9),(271,2,31,2,21),(272,2,31,2,8),(273,2,31,2,18),(274,2,31,3,37),(275,2,31,3,10),(276,2,31,3,14),(277,2,31,3,16),(278,2,31,4,1),(279,2,31,4,44),(280,2,31,4,38),(281,2,31,4,32),(282,2,35,1,17),(283,2,35,1,43),(284,2,35,1,15),(285,2,35,1,11),(286,2,35,2,28),(287,2,35,2,19),(288,2,35,2,7),(289,2,35,2,27),(290,2,35,3,46),(291,2,35,3,24),(292,2,35,3,42),(293,2,35,3,4),(294,2,35,4,66),(295,2,35,4,36),(296,2,35,4,3),(297,2,35,4,20),(298,2,36,1,31),(299,2,36,1,41),(300,2,36,1,2),(301,2,36,1,34),(302,2,36,2,30),(303,2,36,2,9),(304,2,36,2,10),(305,2,36,2,8),(306,2,36,3,37),(307,2,36,3,5),(308,2,36,3,14),(309,2,36,3,16),(310,2,36,4,1),(311,2,36,4,44),(312,2,36,4,38),(313,2,36,4,32),(314,2,39,1,37),(315,2,39,1,43),(316,2,39,1,15),(317,2,39,1,11),(318,2,39,2,28),(319,2,39,2,19),(320,2,39,2,7),(321,2,39,2,27),(322,2,39,3,46),(323,2,39,3,24),(324,2,39,3,42),(325,2,39,3,4),(326,2,39,4,66),(327,2,39,4,3),(328,2,39,4,36),(329,2,39,4,20),(330,2,40,1,31),(331,2,40,1,41),(332,2,40,1,2),(333,2,40,1,34),(334,2,40,2,9),(335,2,40,2,10),(336,2,40,2,8),(337,2,40,2,18),(338,2,40,3,13),(339,2,40,3,5),(340,2,40,3,14),(341,2,40,3,16),(342,2,40,4,1),(343,2,40,4,44),(344,2,40,4,38),(345,2,40,4,32),(346,2,42,1,21),(347,2,42,1,24),(348,2,42,1,7),(349,2,42,1,27),(350,2,42,2,66),(351,2,42,2,38),(352,2,42,2,25),(353,2,42,2,36),(354,2,42,3,28),(355,2,42,3,19),(356,2,42,3,2),(357,2,42,3,11),(358,2,42,4,46),(359,2,42,4,5),(360,2,42,4,17),(361,2,42,4,20),(362,2,44,1,20),(363,2,44,1,37),(364,2,44,1,7),(365,2,44,1,27),(366,2,44,2,46),(367,2,44,2,24),(368,2,44,2,42),(369,2,44,2,4),(370,2,44,3,17),(371,2,44,3,43),(372,2,44,3,15),(373,2,44,3,11),(374,2,44,3,1),(375,2,44,4,66),(376,2,44,4,3),(377,2,44,4,2),(378,2,44,4,36),(379,2,45,1,28),(380,2,45,1,41),(381,2,45,1,19),(382,2,45,1,34),(383,2,45,2,9),(384,2,45,2,10),(385,2,45,2,8),(386,2,45,2,18),(387,2,45,3,13),(388,2,45,3,5),(389,2,45,3,14),(390,2,45,3,16),(391,2,45,4,1),(392,2,45,4,44),(393,2,45,4,38),(394,2,45,4,32),(395,2,45,0,21),(396,2,45,0,31),(397,2,46,1,1),(398,2,46,1,24),(399,2,46,1,20),(400,2,46,1,7),(401,2,46,2,66),(402,2,46,2,43),(403,2,46,2,25),(404,2,46,2,36),(405,2,46,3,46),(406,2,46,3,5),(407,2,46,3,38),(408,2,46,3,4),(409,2,46,4,28),(410,2,46,4,19),(411,2,46,4,15),(412,2,46,4,11),(413,2,47,1,20),(414,2,47,1,37),(415,2,47,1,7),(416,2,47,1,27),(417,2,47,2,46),(418,2,47,2,24),(419,2,47,2,42),(420,2,47,2,4),(421,2,47,3,17),(422,2,47,3,43),(423,2,47,3,15),(424,2,47,3,11),(425,2,47,4,66),(426,2,47,4,3),(427,2,47,4,2),(428,2,47,4,36),(429,2,48,1,28),(430,2,48,1,41),(431,2,48,1,19),(432,2,48,1,34),(433,2,48,2,21),(434,2,48,2,9),(435,2,48,2,10),(436,2,48,2,8),(437,2,48,3,13),(438,2,48,3,5),(439,2,48,3,14),(440,2,48,3,16),(441,2,48,4,1),(442,2,48,4,44),(443,2,48,4,38),(444,2,48,4,32),(445,2,48,0,31),(446,2,50,1,43),(447,2,50,1,25),(448,2,50,1,20),(449,2,50,1,4),(450,2,50,2,28),(451,2,50,2,17),(452,2,50,2,7),(453,2,50,2,27),(454,2,50,3,44),(455,2,50,3,5),(456,2,50,3,38),(457,2,50,3,36),(458,2,50,4,1),(459,2,50,4,2),(460,2,50,4,15),(461,2,50,4,11),(462,2,54,1,43),(463,2,54,1,24),(464,2,54,1,25),(465,2,54,1,4),(466,2,54,2,1),(467,2,54,2,66),(468,2,54,2,17),(469,2,54,2,27),(470,2,54,3,46),(471,2,54,3,5),(472,2,54,3,7),(473,2,54,3,20),(474,2,54,4,28),(475,2,54,4,19),(476,2,54,4,2),(477,2,54,4,11),(478,2,56,1,28),(479,2,56,1,21),(480,2,56,1,41),(481,2,56,1,32),(482,2,56,2,9),(483,2,56,2,44),(484,2,56,2,10),(485,2,56,2,8),(486,2,56,3,13),(487,2,56,3,1),(488,2,56,3,14),(489,2,56,3,16),(490,2,56,4,50),(491,2,56,4,5),(492,2,56,4,19),(493,2,56,4,38),(494,2,56,0,31),(598,2,61,1,1),(599,2,61,1,14),(600,2,61,1,18),(601,2,61,1,66),(602,2,9,1,37),(603,2,9,1,14),(616,2,65,1,37),(617,2,65,1,14),(618,2,65,1,66),(619,2,65,1,1);
/*!40000 ALTER TABLE `squads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `home_team` tinyint(1) NOT NULL DEFAULT '0',
  `team` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,2,0,0,'Pontyclun BC','Castan Road, Pontyclun CF72 9EH'),(2,2,0,0,'Mackintosh BC','Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW'),(3,2,0,0,'St Peter\'s BC','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(4,2,0,1,'St Joseph\'s BC','Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),(5,2,0,0,'Cardiff Athletic BC','Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA'),(6,2,0,0,'Rumney BC','Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD'),(7,2,0,0,'Barry Athletic BC','Off Paget Road, Barry Island, Barry CF62 5TQ'),(8,2,0,0,'Roath Park BC','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(9,2,0,0,'St Fagan\'s BC','St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG'),(10,2,0,0,'Caerphilly Social BC','Morgan Jones Park, Nantgarw Road, Caerphilly CF83 1AP'),(11,2,1,0,'Rhiwbina BC','Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA'),(12,2,0,0,'Llanbradach BC','Rear of High Street, Llanbradach, Caerphilly CF83 3LP'),(13,2,0,0,'Penarth BC','Rectory Road, Penarth CF64 3AN'),(14,2,0,0,'Fairoak BC','Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(15,2,0,0,'Sully Sports BC','Sully Sports and Social Club, South Road, Sully, Vale of Glamorgan, CF64 5SP'),(16,2,0,0,'Windsor BC','Robinswood Crescent, Penarth, Vale of Glamorgan CF64 3JF'),(17,2,0,0,'Penylan BC','Marlborough Rd, Cardiff CF23 5BU'),(18,2,0,0,'Splott Phoenix BC','Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),(19,2,0,0,'Harlequins BC','Park Grove, Aberdare CF44 8EL'),(20,2,0,0,'Murch BC','Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP'),(22,2,0,0,'Whitchurch Hospital BC','Park Road, Whitchurch, Cardiff CF14 7XB'),(23,2,0,0,'Cardiff BC','Sophia Gardens/Canton, Cardiff CF11 9SW'),(24,2,0,0,'Whitchurch BC','Penlline Rd, Cardiff CF14 2AD'),(25,2,0,0,'St Alban\'s BC','Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),(26,2,0,0,'Llantrisant BC','1 Cardiff Rd, Llantrisant, Pontyclun CF72 8DG'),(27,2,0,0,'Ely BC','Poplar Road, Cardiff CF5 3PS'),(28,2,0,0,'Merthyr West End BC','The Grove, Merthyr Tydfil CF47 8YR'),(29,2,0,0,'Barry Romilly BC','Romilly Rd, Barry CF62 6LF'),(30,2,0,0,'Pentyrch BC','Pentyrch Lawn Tennis Club, Parc y Dwrlyn, Penuel Road, Pentyrch, Vale of Glamorgan CF15 9QJ'),(31,2,0,0,'Ystradfechan BC','Ystradfechan Fields, Treorchy, Rhondda Cynon Taff CF42 6HL'),(32,2,0,0,'Rhiwbina BC','Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA'),(33,3,0,0,'Rhiwbina RFC','Caedelyn Park, Cardiff CF14 1BE'),(34,3,0,0,'Llantrisant RFC','St David\'s Pl, Llantrisant, Pontyclun CF72 8HA'),(35,3,0,0,'Ystrad Rhondda RFC','81 Gelligaled Rd, Ystrad, Pentre CF41 7RQ'),(36,3,0,0,'Treorchy RFC','126 High St, Treorchy CF42 6PB'),(37,3,0,0,'Llanharan Rugby Football Club','Bridgend Road, Llanharan, Rhondda Cynon Taf CF72 9RD'),(38,4,0,0,'Llanrumney United FC','Riverside Park, Hartland Road, Llanrumney, Cardiff CF3 4JL'),(39,4,0,0,'Llanharry AFC','Llanharry Recreation Ground, Llanharry, Pontyclun CF72 9HL'),(40,4,0,0,'Penrhiwfer AFC','Tonypandy CF40 1XX'),(41,4,0,0,'Carnetown',''),(42,3,0,1,'St Joseph\'s RFC','Blackweir Fields, Cardiff CF10 3EA'),(43,3,0,0,'Glamorgan Wanderers RFC','Memorial Ground, Stirling Rd, Cardiff CF5 4SR'),(44,3,0,0,'Porth Harlequins RFC','The Welfare Ground, Porth, Rhondda Cynon Taff, CF39 9TW'),(45,3,0,0,'Rumney RFC','Riverside Park, Hartland Rd, Rumney, Llanrumney CF3 4JL'),(46,3,0,0,'Mountain Ash RFC','Parc Dyffryn Pennar: Dyffryn Road, Mountain Ash, Rhondda Cynon Taff, CF45 4DA'),(47,3,0,0,'Heol-Y-Cyw RFC','37 High Street, Bridgend, CF35 6HR'),(48,3,0,0,'Dinas Powys RFC','Dinas Powys Athletic Club, The Pavilion, Dinas Powys CF64 4DL'),(49,3,0,0,'Cilfynydd',''),(50,2,0,0,'Dinas Powys BC','St Andrew\'s Rd, Dinas Powys CF64 4HB'),(51,2,0,0,'Avenue BC','Avenue Rd, Leamington Spa CV31 3PG'),(52,2,0,0,'Guest Memorial BC','Charlotte Gardens, Dowlais, Merthyr Tydfil CF48 3LJ'),(53,4,0,1,'St Joseph\'s AFC','Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2018-10-12 12:53:15','michael','$2y$10$O6BFkDdT.mm/1bcTYee.7uZUO6rZbOyO1gthhmLvDlrQEf6atGQra','3878b867c81b48dfaef48b4c6109014d','Michael Perks','admin@sjcssc.co.uk','1,2,3,4,5',1),(5,'2019-02-04 00:29:19','sjcsscadmin','$2y$10$RJViIN1oXCHPzm1EBcehEebUhMx/i1kltnZPxozC4iCjYE7ge6iWe','4a8b796df8ea584de335b793ceccb191','Philip Perks','philip.perks@ntlworld.co.uk','1,2,3,4,5',1),(6,'2019-02-08 17:23:50','Footballer','$2y$10$Z8QDh7mExypl5ThtidKhquG0DTIifirV1/Z.aKn2HP/BDjqlr.BoC','21177d2fe3bfd04bf1d01b9eacecb18e','A N Other','football@gmail.com','4',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venues`
--

DROP TABLE IF EXISTS `venues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `location` varchar(750) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `club_id` (`club_id`,`location`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venues`
--

LOCK TABLES `venues` WRITE;
/*!40000 ALTER TABLE `venues` DISABLE KEYS */;
INSERT INTO `venues` VALUES (1,4,0,'Llanrumney United FC, Riverside Park, Hartland Road, Llanrumney, Cardiff CF3 4JL'),(2,4,0,'Penrhiwfer AFC, Tonypandy CF40 1XX'),(3,4,0,'Llanharry AFC, Llanharry Recreation Ground, Llanharry, Pontyclun CF72 9HL'),(4,1,0,'St Joseph\'s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN'),(5,4,0,'St Joseph\'s AFC, Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF'),(6,2,0,'Barry Athletic Bowls Club, Off Paget Road, Barry Island, Barry CF62 5TQ'),(7,2,0,'Barry Romilly Bowling Club, Romilly Rd, Barry CF62 6LF'),(8,2,0,'Blaenrhondda Bowling Club, Blaenrhondda Park, Brook Street, Treorchy CF42 5SF'),(9,2,0,'Caerphilly Social Bowls Club, Morgan Jones Park, Nantgarw Road, Caerphilly CF83 1AP'),(10,2,0,'Cardiff Athletic Bowls Club, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA'),(11,2,0,'Cardiff Bowling Club, Sophia Gardens/Canton, Cardiff CF11 9SW'),(12,2,0,'County Conservative Club, 163 Caerphilly Rd, Cardiff CF14 4QB'),(13,2,0,'Cyfarthfa Bowls Club, Cyfarthfa Park, Brecon Rd, Merthyr Tydfil CF47 8RE'),(14,2,0,'Dinas Powis Bowling Club, St Andrews Road, Dinas Powis, Vale of Glamorgan CF64 4DL'),(15,2,0,'Dinas Powys RFC, Dinas Powys Athletic Club, The Pavilion, Dinas Powys CF64 4DL'),(16,2,0,'Guest Memorial Bowls Club, Charlotte Gardens, Dowlais, Merthyr Tydfil CF48 3LJ'),(17,2,0,'Harlequins Bowls Club, Park Grove, Aberdare CF44 8EL'),(18,2,0,'Llanbradach Bowls Club, Rear of High Street, Llanbradach, Caerphilly CF83 3LP'),(19,2,0,'Llantrisant Bowling Club, 1 Cardiff Rd, Llantrisant, Pontyclun CF72 8DG'),(20,2,0,'Mackintosh Bowls Club, Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW'),(21,2,0,'Merthyr West End Bowls Club, The Grove, Merthyr Tydfil CF47 8YR'),(22,2,0,'Murch Bowls Club, Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP'),(23,2,0,'Penarth Bowling Club, Rectory Road, Penarth CF64 3AN'),(24,2,0,'Pentyrch Lawn Tennis Club, Parc y Dwrlyn, Penuel Road, Pentyrch, Vale of Glamorgan CF15 9QJ'),(25,2,0,'Penylan Bowling Club, Marlborough Rd, Cardiff CF23 5BU'),(26,2,0,'Penyrheol Bowling Club, Aneurin Park, Penyrhoel, Caerphilly CF83 2PG'),(27,2,0,'Pontyclun Institute Athletic Club, Castan Road, Pontyclun CF72 9EH'),(28,2,0,'Poplar Road, Fairwater, Cardiff CF5 3PS'),(29,2,0,'Rhiwbina Bowls Club, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA'),(30,2,0,'Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(31,2,0,'Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD'),(32,2,0,'St Fagan\'s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG'),(33,2,0,'St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),(34,2,0,'Sully Sports Bowls Club, Sully Sports and Social Club, South Road, Sully, Vale of Glamorgan, CF64 5SP'),(35,2,0,'The Aneurin Bevan, Caerphilly Rd, Cardiff CF14 4AD'),(36,2,0,'The Birchgrove, 3 Birchgrove Rd, Cardiff CF14 1RR'),(37,2,0,'Whitchurch Bowls Club, Penlline Rd, Cardiff CF14 2AD'),(38,2,0,'Whitchurch Hospital, Park Road, Whitchurch, Cardiff CF14 7XB'),(39,2,0,'Windsor Bowling Club, Robinswood Crescent, Penarth, Vale of Glamorgan CF64 3JF'),(40,2,0,'Ynyscynon Bowling Club, Ynyscynon Road, Trealaw, Tonypandy CF40 2GB'),(41,2,0,'Ystradfechan Bowls Club, Ystradfechan Fields, Treorchy, Rhondda Cynon Taff CF42 6HL'),(42,2,0,'Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),(43,3,0,'St Joseph\'s RFC, Blackweir Fields, Cardiff CF10 3EA'),(44,3,0,'Dinas Powys RFC, Dinas Powys Athletic Club, The Pavilion, Dinas Powys CF64 4DL'),(45,3,0,'Llanharan Rugby Football Club, Bridgend Road, Llanharan, Rhondda Cynon Taf CF72 9RD'),(46,3,0,'Llantrisant RFC, St David\'s Pl, Llantrisant, Pontyclun CF72 8HA'),(47,3,0,'Rhiwbina RFC, Caedelyn Park, Cardiff CF14 1BE'),(48,3,0,'Rumney RFC, Riverside Park, Hartland Rd, Rumney, Llanrumney CF3 4JL'),(49,3,0,'Ystrad Rhondda RFC, 81 Gelligaled Rd, Ystrad, Pentre CF41 7RQ'),(50,3,0,'Treorchy RFC, 126 High St, Treorchy CF42 6PB'),(51,5,0,'Gary Evans Fishing Tackle Shop, 105-109 Whitchurch Rd, Cardiff CF14 3JQ'),(52,5,0,'Ravensnest Trout Fishery, Raglan Road, Tintern, Chepstow, Gwent, NP16 6TP'),(53,5,0,'Sandford Pool Trout Fishery, Sandford Road, Alvington, Lydney, Gloucestershire GL15 6PZ'),(54,5,0,'St Joseph\'s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN'),(55,5,0,'Woolaston Court Trout Lakes, Main Road, Woolaston, Lydney, Gloucestershire GL15 6PJ'),(56,5,0,'Ynys-y-Fro Reservoirs, near Fourteen Locks visitor centre, Newport, Gwent NP10 9GN'),(57,5,0,'Clywedog Reservoir'),(58,3,0,'Glamorgan Wanderers RFC, Memorial Ground, Stirling Rd, Cardiff CF5 4SR'),(59,3,0,'Porth Harlequins RFC, The Welfare Ground, Porth, Rhondda Cynon Taff, CF39 9TW'),(60,3,0,'Mountain Ash RFC, Parc Dyffryn Pennar: Dyffryn Road, Mountain Ash, Rhondda Cynon Taff, CF45 4DA'),(61,3,0,'Heol-Y-Cyw RFC, 37 High Street, Bridgend, CF35 6HR'),(69,2,0,'CABC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA'),(70,2,0,'Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA'),(72,2,0,'Mackintosh BC, Mackintosh Sports Club, 38 Keppoch St, Cardiff CF24 3JW'),(73,2,0,'St Joseph&#39;s BC, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),(75,2,0,'Dinas Powys BC, St Andrew&#39;s Rd, Dinas Powys CF64 4HB'),(76,2,0,'Cardiff Athletic BC, Cardiff Arms Park, Westgate Street, Cardiff CF10 1JA'),(77,2,0,'Rumney BC, Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD'),(81,2,0,'Roath Park BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(82,2,0,'St Fagan&#39;s BC, St Fagan&#39;s Cricket Club, Crofft-y-Genau Road, St. Fagans, Cardiff CF5 6EG'),(91,2,0,'Whitchurch BC, Penlline Rd, Cardiff CF14 2AD'),(93,2,0,'Penarth BC, Rectory Road, Penarth CF64 3AN'),(94,2,0,'Fairoak BC'),(97,2,0,'Barry Athletic BC, Off Paget Road, Barry Island, Barry CF62 5TQ'),(100,2,0,'Pontyclun BC, Castan Road, Pontyclun CF72 9EH'),(103,2,0,'Rhiwbina BC, Lon-y-Dail, Rhiwbina, Cardiff CF14 6EA'),(110,2,0,'Harlequins BC, Park Grove, Aberdare CF44 8EL'),(111,2,0,'Murch BC, Sunnycroft Lane, Dinas Powys, Vale of Glamorgan CF64 4QP'),(114,2,0,'Windsor BC, Robinswood Crescent, Penarth, Vale of Glamorgan CF64 3JF'),(116,2,0,'Fairoak BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(119,2,0,'Guest Memorial BC, Charlotte Gardens, Dowlais, Merthyr Tydfil CF48 3LJ'),(120,2,0,'Cardiff BC, Sophia Gardens/Canton, Cardiff CF11 9SW'),(121,2,0,'St Peter&#39;s BC, Roath Pleasure Gardens, Ninian Rd, Cardiff CF23 5EP'),(123,2,0,'Llantrisant BC, 1 Cardiff Rd, Llantrisant, Pontyclun CF72 8DG'),(129,2,0,'Ystradfechan BC, Ystradfechan Fields, Treorchy, Rhondda Cynon Taff CF42 6HL'),(130,2,0,'Barry Romilly BC, Romilly Rd, Barry CF62 6LF'),(131,2,0,'St Alban&#39;s BC, Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),(135,2,0,'Ely BC'),(140,2,0,'Merthyr West End BC, The Grove, Merthyr Tydfil CF47 8YR'),(151,2,0,'Penylan BC, Marlborough Rd, Cardiff CF23 5BU');
/*!40000 ALTER TABLE `venues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cl50-sjcsscnew'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-19 21:08:33
