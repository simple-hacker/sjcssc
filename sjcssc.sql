-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2019 at 08:42 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sjcssc`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `address_title` varchar(255) NOT NULL,
  `address` varchar(2255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `club_id`, `address_title`, `address`) VALUES
(2, 2, 'St Joseph&#39;s Bowls Club', 'Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),
(3, 3, 'Club House', 'St Joseph&#39;s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN'),
(6, 1, 'Club House 2', 'St Joseph&#39;s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club`, `name`, `message`, `team_id`) VALUES
(1, 'social', 'St Joseph&#39;s Catholic Sports and Social Club', 'Welcome to St Joseph&#39;s Catholic Sports and Social Club homepage.', 0),
(2, 'bowls', 'St Joseph&#39;s Bowls Club', 'A warm welcome to St Joseph&#39;s Bowls Club, Cardiff which was founded in 1976 as a sports section within St Joseph&#39;s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to the Wales Bowling Association (WBA), East Wales Private Greens Bowling Association (EWPGBA), and South Glamorgan County Bowling Association (SGCBA).\r\n\r\nWe have two competitive teams who usually play on a Saturday afternoon:\r\nFirst Team play in PG1 Division 3\r\n&#39;A&#39; Team play in PG2 Division 1\r\n\r\nA competitive team comprising of players from both teams also play midweek (Wednesday evening) in the Cardiff Municipal League (CML).\r\n\r\nOn a less competitive note, we have a team which is open to all members of the bowls club, who play local friendly Alliance matches on a Tuesday and Thursday afternoon.\r\n\r\nAll new players, experienced or novice, are welcome.', 1),
(3, 'rugby', 'St Joseph&#39;s Rugby Club', 'A warm welcome to St Joseph\'s Rugby Football Club, Cardiff which was founded in 1959 as a sports section within St Joseph\'s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to the Welsh Rugby Union (WRU). and Cardiff and District Rugby Union (CDRU).\r\n\r\nWe have two competitive senior teams and one youth team who usually play on a Saturday afternoon:\r\n1st XV play in the WRU National League Division 1 East\r\n2nd XV play in the CDRU\r\nYouth U19\r\n\r\nAll new players, experienced or novice, are welcome.\r\n\r\nTraining Night(s)/Time(s):\r\nMonday, Wednesday and Friday 18:00 till 19:00\r\n\r\nWe also have an established Tag Rugby mini/junior section with WRU qualified and CRB checked coaches for every team.\r\nIt is a great game that allows younger players to concentrate on their ball skills and teamwork first. \r\nWe currently have space for new players in all our age groups!\r\nExperience is not needed; the only requirement is to have fun whilst learning to play the game of Rugby!\r\nBoys and girls can join us from the age of six so why not come along on a Sunday morning and let your child try out a few sessions before making a decision.\r\nPlease make sure they are wearing old clothes to train as getting dirty is part of the game.\r\nOur aim is to encourage young players to develop and enjoy the game of rugby.\r\nMany of our current senior players have come through the mini/junior section, and it\'s importance is evident to the survival and success of the rugby club.\r\n\r\nOur playing pitch is located at Blackweir Fields, Cardiff CF10 3EA', 7),
(4, 'football', 'St Joseph&#39;s Football Club SJAFC', 'A warm welcome to St Joseph\'s Athletic Football Club, Cardiff which was founded in 1968 as a sports section within St Joseph\'s Catholic Sports and Social Club, Cardiff.\r\n\r\nWe are affiliated to South Wales Alliance League (SWAL) and Cardiff and District Football League (CDFL).\r\n\r\nWe have two competitive senior teams who usually play on a Saturday afternoon:\r\n1st XI play in the SWAL Division 2\r\n2nd XI play in the CDFL\r\n\r\nAll new players, experienced or novice, are welcome.\r\n\r\nTraining Night(s)/Time(s):\r\nMonday, Wednesday and Friday 18:00 till 19:00\r\n\r\nOur playing pitch is located at Maes-y-Coed Road Playing Fields, St Cenydd Road, Heath, CARDIFF.', 14),
(5, 'fishing', 'St Joseph\'s Fishing Club', 'A warm welcome to Cardiff Reservoir Fly Fishing Club which was founded in 1948 and operates as a sports section within St Joseph\'s Catholic Sports and Social Club, Cardiff.\r\nThe Club was originally formed from members who regularly fished Llanishen and Lisvane reservoirs until they were closed to public use in 2000.\r\nDwr Cymru (Welsh Water) is currently restoring these reservoirs and it is hoped that they will once again be used for trout fishing when works have been completed.\r\n\r\nWe meet every Thursday night at St Josephs Club and welcome anyone with an interest in fishing, and specifically fly fishing for trout.\r\nClub meetings provide regular fly-tying sessions, a weekly raffle and the occasional fishing quiz, fishing video presentations and a \'bring and buy auction\' of fishing tackle\r\nWe also organise fly fishing outings to local venues as well as those further afield to famous fisheries like Draycote Water, Chew Valley and Llandegfedd.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `email_title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `club_id`, `email_title`, `email`) VALUES
(1, 2, 'Club Secretary', 'secretary.bowls@sjcssc.co.uk'),
(2, 2, 'Chairman', 'chairman.bowls@sjcssc.co.uk'),
(3, 3, 'Club Secretary', 'secretary.rugby@sjcssc.co.uk'),
(4, 4, 'Club Secretary', 'secretary.football@sjcssc.co.uk'),
(7, 1, 'Social Secretary', 'social@stjosephscssc.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `club_id`, `event_id`, `created_date`, `title`, `date`, `time`, `location_id`, `meet_at`, `contact`, `other_information`) VALUES
(1, 2, 1, '2018-10-26 11:38:18', 'New Year&#39;s Eve Party', '2018-12-31', '22:00:00', 2, 'Times Square', 'Philip', 'We have changed to a NYE party.'),
(3, 2, 2, '2018-10-26 17:09:31', 'Christmas Event', '2018-12-10', '20:00:00', NULL, 'Party Room', '', 'Black Tie');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures_bowls`
--

CREATE TABLE `fixtures_bowls` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) DEFAULT NULL,
  `away_team_score` int(11) DEFAULT NULL,
  `home_team_points` int(11) DEFAULT NULL,
  `away_team_points` int(11) DEFAULT NULL,
  `home_team_bonus_points` int(11) DEFAULT NULL,
  `away_team_bonus_points` int(11) DEFAULT NULL,
  `publish_results` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_bowls`
--

INSERT INTO `fixtures_bowls` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `venue_id`, `meet_at`, `contact`, `other_information`, `home_team_score`, `away_team_score`, `home_team_points`, `away_team_points`, `home_team_bonus_points`, `away_team_bonus_points`, `publish_results`) VALUES
(1, '2018-10-11 20:48:30', 2, 1, 3, '2018-09-02', '12:00:00', 1, 'Club House', '', '', 20, 41, 20, 89, 4, 6, 1),
(19, '2018-10-29 14:52:50', 2, 1, 17, '2018-11-10', '07:00:00', 5, 'Club House', '', 'Updated Fixture details.', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fixtures_football`
--

CREATE TABLE `fixtures_football` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) DEFAULT NULL,
  `away_team_score` int(11) DEFAULT NULL,
  `publish_results` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_football`
--

INSERT INTO `fixtures_football` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `venue_id`, `meet_at`, `contact`, `other_information`, `home_team_score`, `away_team_score`, `publish_results`) VALUES
(1, '2018-10-11 20:56:03', 14, 17, 9, '2018-11-06', '10:00:00', 14, '', '', '', NULL, NULL, 0),
(2, '2018-10-11 20:56:45', 17, 20, 12, '2018-11-30', '14:00:00', 19, '', '', '', NULL, NULL, 0),
(3, '2018-10-11 20:57:36', 19, 14, 11, '2018-12-04', '18:00:00', 20, '', '', '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fixtures_rugby`
--

CREATE TABLE `fixtures_rugby` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `home_team_score` int(11) DEFAULT NULL,
  `away_team_score` int(11) DEFAULT NULL,
  `publish_results` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_rugby`
--

INSERT INTO `fixtures_rugby` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `venue_id`, `meet_at`, `contact`, `other_information`, `home_team_score`, `away_team_score`, `publish_results`) VALUES
(1, '2018-10-11 20:51:40', 8, 9, 7, '2018-11-07', '19:30:00', 7, '', '', '', NULL, NULL, 0),
(2, '2018-10-11 20:51:40', 11, 12, 8, '2018-10-24', '15:00:00', 10, '', '', '', 89, 77, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `league` varchar(255) NOT NULL,
  `league_full` varchar(255) NOT NULL,
  `league_website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `club_id`, `isDeleted`, `league`, `league_full`, `league_website`) VALUES
(1, 2, 0, 'PG1', 'East Wales Private Greens 1', ''),
(2, 2, 0, 'PG2', 'East Wales Private Greens 2', ''),
(3, 2, 0, 'CML', 'Cardiff Municipal League', ''),
(6, 3, 0, 'Gallagher Premiership', '', ''),
(7, 3, 0, 'RFU Championship', '', ''),
(8, 3, 0, 'Friendly', '', ''),
(9, 4, 0, 'Premier League', '', ''),
(10, 4, 0, 'Bundesliga', '', ''),
(11, 4, 0, 'Serie A', '', ''),
(12, 4, 0, 'La Liga', '', ''),
(15, 2, 0, 'Alliance', 'Alliance', ''),
(16, 2, 0, 'Friendly', 'Friendly', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_links`
--

CREATE TABLE `menu_links` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `menu_link_title` varchar(128) NOT NULL,
  `menu_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_links`
--

INSERT INTO `menu_links` (`id`, `club_id`, `menu_link_title`, `menu_link`) VALUES
(2, 2, 'Gallery', 'https://photos.google.com/share/AF1QipPEgEGUddnQenmTu2JdUVho3m-jz6hL5maHUpW2x4tO3WpTMADixGf_uY6ObCfk4A?key=MC1RWEhwRHFIdWtEbG9PMXhfb1ZOVXY3aHFqTHNn'),
(3, 2, 'League', 'http://eastwalesprivategreensba.org/?page_id=62'),
(7, 1, 'Facebook', 'https://www.facebook.com');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` date DEFAULT NULL,
  `expiry_date_option` varchar(20) NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `club_id`, `notice_id`, `event_id`, `created_date`, `expiry_date`, `expiry_date_option`, `important`, `title`, `notice`) VALUES
(1, 1, 1, NULL, '2018-10-13 12:19:38', '2018-12-05', '', 0, 'Social Notice One', 'This is the first notice for Social.'),
(2, 1, 2, NULL, '2018-10-13 12:19:38', NULL, '', 0, 'Second Social Notice', 'This is the second notice for the Social club.'),
(3, 2, 1, NULL, '2018-10-13 12:19:38', NULL, '', 0, 'Bowls Meeting', 'You need to attend this meeting for bowls.'),
(4, 2, 2, NULL, '2018-10-13 12:19:38', '2018-12-25', '', 1, 'Christmas Party', 'Don\'t forget about the Christmas party.');

-- --------------------------------------------------------

--
-- Table structure for table `outings`
--

CREATE TABLE `outings` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `report` text NOT NULL,
  `publish_report` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outings`
--

INSERT INTO `outings` (`id`, `created_date`, `title`, `date`, `time`, `venue_id`, `meet_at`, `contact`, `other_information`, `report`, `publish_report`) VALUES
(1, '2018-10-29 17:15:57', 'RTF', '2018-10-08', '09:00:00', 21, 'LH', 'JJ', 'Loads of information here.', 'WASSSSSSSSSSSSSSSSUP', 1),
(4, '2018-11-04 10:45:44', 'Wicked Outing', '2018-11-14', '09:00:00', 21, '', '', 'Please bring all your equipment.', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `club_id`, `isDeleted`, `name`, `email`, `active`) VALUES
(8, 3, 0, 'Steve Rogers', '', 1),
(9, 3, 0, 'Tony Stark', '', 1),
(10, 3, 0, 'Peter Parker', '', 1),
(11, 3, 0, 'Thor', '', 1),
(12, 3, 0, 'Doctor Strange', '', 1),
(13, 3, 0, 'Bruce Banner', '', 1),
(14, 4, 0, 'Clark Kent', '', 1),
(15, 4, 0, 'Bruce Wayne', '', 1),
(16, 4, 0, 'Barry Allen', '', 1),
(17, 4, 0, 'Arthur Curry', '', 1),
(18, 4, 0, 'Diana Prince', '', 1),
(19, 4, 0, 'Wally West', '', 1),
(20, 4, 0, 'Lois Lane', '', 1),
(31, 2, 1, 'Michael Perks', 'michael@live.co.uk', 0),
(32, 2, 0, 'Philip Perks', 'philip@viringmedia.com', 1),
(33, 2, 0, 'Matthew Perks', 'matthew@ntlworld.com', 1),
(34, 2, 0, 'Susan Perks', 'susan@virginmedia.com', 1),
(35, 2, 0, 'Niall Perks', 'niall@perks.cymru', 1),
(36, 2, 1, 'Brenna', 'brennax@gmail.com', 0),
(37, 2, 0, 'Ninja', '', 1),
(38, 2, 1, 'Dr Lupo', '', 1),
(39, 2, 1, 'Myth', '', 1),
(40, 2, 1, 'Dakotaz', '', 1),
(42, 2, 0, 'Steve Rodgers', '', 1),
(43, 2, 0, 'Tony Stark', '', 1),
(44, 2, 0, 'Spiderman', '', 1),
(45, 2, 0, 'Superman', '', 1),
(46, 2, 0, 'Sean', '', 1),
(47, 2, 0, 'Tom', '', 1),
(48, 2, 0, 'Shane', '', 1),
(49, 2, 0, 'Sheldon', '', 1),
(50, 2, 0, 'Raj', '', 1),
(51, 2, 0, 'Leonard', '', 1),
(52, 2, 0, 'Howard', '', 1),
(53, 2, 0, 'Mitch', '', 1),
(54, 2, 0, 'Will', '', 1),
(55, 2, 0, 'Blake', '', 1),
(56, 2, 0, 'Anthony', '', 1),
(57, 2, 0, 'Sophie', '', 1),
(58, 2, 0, 'Jordan', '', 1),
(59, 2, 1, 'Edyta', '', 1),
(60, 2, 0, 'Ed', '', 1),
(61, 2, 0, 'Ben', '', 1),
(62, 3, 0, 'R1', '', 1),
(63, 3, 0, 'R2', '', 1),
(64, 3, 0, 'R3', '', 1),
(65, 3, 0, 'R4', '', 1),
(66, 2, 0, 'Batman', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phone_numbers`
--

CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `phone_number_title` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_numbers`
--

INSERT INTO `phone_numbers` (`id`, `club_id`, `phone_number_title`, `phone_number`) VALUES
(3, 2, 'Secretary', '029 2021 7455');

-- --------------------------------------------------------

--
-- Table structure for table `squads`
--

CREATE TABLE `squads` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `fixture_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `squads`
--

INSERT INTO `squads` (`id`, `club_id`, `fixture_id`, `position_id`, `name_id`) VALUES
(1, 2, 1, 1, 31),
(2, 2, 1, 1, 32),
(3, 2, 1, 1, 33),
(4, 2, 1, 2, 34),
(5, 2, 1, 2, 35),
(6, 2, 1, 5, 36),
(7, 2, 1, 5, 37),
(21, 3, 2, 1, 13),
(22, 3, 2, 2, 11),
(23, 3, 2, 3, 9),
(24, 3, 2, 4, 12),
(25, 3, 2, 5, 10),
(26, 3, 2, 6, 8),
(27, 4, 1, 1, 14),
(28, 4, 1, 2, 15),
(29, 4, 1, 3, 16),
(30, 4, 1, 4, 17),
(31, 4, 1, 5, 18),
(32, 4, 1, 6, 19),
(33, 4, 1, 7, 20),
(34, 4, 2, 1, 20),
(35, 4, 2, 2, 18),
(36, 4, 2, 3, 16),
(37, 4, 2, 4, 14),
(38, 4, 2, 5, 15),
(39, 4, 2, 6, 17),
(40, 4, 2, 7, 19),
(41, 4, 3, 1, 16),
(42, 4, 3, 2, 14),
(43, 4, 3, 3, 18),
(44, 4, 3, 4, 17),
(45, 4, 3, 5, 15),
(46, 4, 3, 6, 20),
(47, 4, 3, 7, 19),
(60, 2, 1, 0, 39),
(61, 2, 1, 0, 40),
(81, 3, 1, 0, 62),
(82, 3, 1, 0, 63),
(83, 3, 1, 0, 64),
(84, 3, 1, 0, 65),
(85, 3, 1, 1, 8),
(86, 3, 1, 2, 9),
(87, 3, 1, 3, 10),
(88, 3, 1, 4, 11),
(89, 3, 1, 5, 12),
(90, 3, 1, 6, 13),
(102, 2, 19, 0, 55),
(103, 2, 19, 0, 53),
(104, 2, 19, 0, 54),
(105, 2, 19, 1, 56),
(106, 2, 19, 1, 57),
(107, 2, 19, 2, 59),
(108, 2, 19, 2, 58),
(109, 2, 19, 3, 61),
(110, 2, 19, 3, 60),
(111, 2, 19, 4, 31),
(112, 2, 19, 4, 32),
(113, 2, 19, 5, 66),
(114, 2, 19, 6, 45);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `home_team` tinyint(1) NOT NULL DEFAULT '0',
  `team` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `club_id`, `isDeleted`, `home_team`, `team`, `location`) VALUES
(1, 2, 0, 1, 'St Joseph\'s', 'St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),
(2, 2, 0, 0, 'Barry Athletic', 'Barry Romilly Bowling Club, Romilly Rd, Barry CF62 6LF'),
(3, 2, 0, 0, 'Penarth', 'Penarth Bowling Club, Rectory Road, Penarth CF64 3AN'),
(4, 2, 0, 0, 'Rumney', 'Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD'),
(5, 2, 0, 0, 'Splott', 'Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),
(6, 2, 0, 0, 'Whitchurch', 'Whitchurch Bowls Club, Penlline Rd, Cardiff CF14 2AD'),
(7, 3, 0, 1, 'St Joseph\'s', 'St Josephs RFC Clubhouse, 29 Whitchurch Road, Cardiff, CF14 3JN'),
(8, 3, 0, 0, 'Harlequins', 'Twickenham Stoop, Langhorn Dr, Twickenham, TW2 7SX'),
(9, 3, 0, 0, 'Saracens', 'Allianz Park, Greenlands Ln, London, NW4 1RL'),
(10, 3, 0, 0, 'Munster', 'Thomond Park, Cratloe Rd, Limerick, Ireland, IRE YSX'),
(11, 3, 0, 0, 'Cardiff Blues', 'Cardiff Arms Park, Westgate St, Cardiff, CF10 1JA'),
(12, 3, 0, 0, 'Scarlets', 'Parc y Scarlets, Pemberton Park, Llanelli, SA14 9UZ'),
(13, 3, 0, 0, 'Ospreys', 'Liberty Stadium, Plasmarl, Swansea, SA1 2FA'),
(14, 4, 0, 1, 'St Joseph\'s', 'St Joseph\'s AFC, Maes-y-Coed Road Playing Fields, St Cenydd Road, Cardiff, CF14 4AN'),
(15, 4, 0, 0, 'Chelsea', 'Stamford Bridge, Fulham Rd, Fulham, London, SW6 1HS'),
(16, 4, 0, 0, 'Liverpool', 'Anfield, Anfield Rd, Liverpool, L4 0TH'),
(17, 4, 0, 0, 'Arsenal', 'Emirates Stadium, Hornsey Rd, London, N7 7AJ'),
(18, 4, 0, 0, 'Tottenham', 'White Hart Lane, 748 High Rd, Tottenham, London, N17 0AP'),
(19, 4, 0, 0, 'Manchester United', 'Old Trafford, Sir Matt Busby Way, Stretford, Manchester, M16 0RA'),
(20, 4, 0, 0, 'Newcastle', 'St. James\' Park, Barrack Rd, Newcastle upon Tyne, NE1 4ST'),
(24, 1, 0, 0, 'Dark Army', 'Zombie Island'),
(28, 2, 1, 0, 'Test', 'Nowhere');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_date`, `username`, `password`, `salt`, `name`, `email`, `permissions`, `admin`) VALUES
(1, '2018-10-12 12:53:15', 'michael', '$2y$10$O6BFkDdT.mm/1bcTYee.7uZUO6rZbOyO1gthhmLvDlrQEf6atGQra', '3878b867c81b48dfaef48b4c6109014d', 'Michael Perks', 'admin@sjcssc.co.uk', '1,2,3,4,5', 1),
(2, '2018-10-12 12:53:15', 'philip', '$2y$10$F98JMbxw0RfP3wEtNtZ5Cu1ZDZ.8KiUCMBAHoFfMItyrPSznfnLHO', '5b72778877d2c21a2323a2a58a167437', 'Philip Perks', 'philip@sjcssc.co.uk', '2', 0),
(4, '2018-10-22 16:04:38', 'fakeperson', '$2y$10$7KEUP3GM30mCAiRLCkdTNuEwyZCo8P4y1nQxrW2ItLzqUFYET.BQa', 'adf8a6791473dc09ea0f1428b22db0fb', 'Fake Person', 'fake@person.com', '3,4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `venue` varchar(255) NOT NULL,
  `location` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `club_id`, `isDeleted`, `venue`, `location`) VALUES
(1, 2, 0, 'St Joseph\'s Bowls Club', 'Llwynfedw Gardens, Birchgrove, Cardiff, CF14 4NW'),
(2, 2, 0, 'Whitchurch Bowls Club', 'Penlline Rd, Cardiff CF14 2AD'),
(3, 2, 1, 'Barry Romilly Bowling Club', 'Romilly Rd, Barry, CF62 6LF'),
(5, 2, 0, 'Newport Bowling Club', 'Newport Road, Cardiff, CF3 4FD'),
(7, 3, 0, 'St Josephs RFC Clubhouse', '29 Whitchurch Road, Cardiff, CF14 3JN'),
(8, 3, 0, 'Liberty Stadium', 'Plasmarl, Swansea, SA1 2FA'),
(9, 3, 0, 'Twickenham Stoop', 'Langhorn Dr, Twickenham, TW2 7SX'),
(10, 3, 0, 'Allianz Park', 'Greenlands Ln, London, NW4 1RL'),
(11, 3, 0, 'Thomond Park', 'Cratloe Rd, Limerick, Ireland, IRE YSX'),
(12, 3, 0, 'Cardiff Arms Park', 'Westgate St, Cardiff, CF10 1JA'),
(13, 3, 0, 'Parc y Scarlets', 'Pemberton Park, Llanelli, SA14 9UZ'),
(14, 4, 0, 'St Joseph\'s AFC', 'Maes-y-Coed Road Playing Fields, St Cenydd Road, Cardiff, CF14 4AN'),
(15, 4, 0, 'St. James\' Park', 'Barrack Rd, Newcastle upon Tyne, NE1 4ST'),
(16, 4, 0, 'Stamford Bridge', 'Fulham Rd, Fulham, London, SW6 1HS'),
(17, 4, 0, 'Anfield', 'Anfield Rd, Liverpool, L4 0TH'),
(18, 4, 0, 'Emirates Stadium', 'Hornsey Rd, London, N7 7AJ'),
(19, 4, 0, 'White Hart Lane', '748 High Rd, Tottenham, London, N17 0AP'),
(20, 4, 0, 'Old Trafford', 'Sir Matt Busby Way, Stretford, Manchester, M16 0RA'),
(21, 5, 0, 'Heath Lake', 'Cardiff, CF22 WAT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures_bowls`
--
ALTER TABLE `fixtures_bowls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures_football`
--
ALTER TABLE `fixtures_football`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures_rugby`
--
ALTER TABLE `fixtures_rugby`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_links`
--
ALTER TABLE `menu_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outings`
--
ALTER TABLE `outings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squads`
--
ALTER TABLE `squads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fixtures_bowls`
--
ALTER TABLE `fixtures_bowls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fixtures_football`
--
ALTER TABLE `fixtures_football`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fixtures_rugby`
--
ALTER TABLE `fixtures_rugby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_links`
--
ALTER TABLE `menu_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outings`
--
ALTER TABLE `outings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `squads`
--
ALTER TABLE `squads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
