-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2018 at 10:18 PM
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
(1, 1, 'Club House', 'St Joseph\'s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN'),
(2, 2, 'St Joseph\'s Bowls Club', 'Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),
(3, 3, 'Club House', 'St Joseph\'s Catholic Sports & Social Club, 29 Whitchurch Road, Cardiff CF14 3JN');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club`, `name`, `message`) VALUES
(1, 'social', 'St Joseph\'s Social Club', 'This is the front page message for St Joseph\'s Social Club'),
(2, 'bowls', 'St Joseph\'s Bowls Club', 'This is the front page message for St Joseph\'s Bowls Club'),
(3, 'rugby', 'St Joseph\'s Rugby Club', 'This is the front page message for St Joseph\'s Rugby Club'),
(4, 'football', 'St Joseph\'s Football Club', 'This is the front page message for St Joseph\'s Football Club'),
(5, 'fishing', 'St Joseph\'s Fishing Club', 'This is the front page message for St Joseph\'s Fishing Club');

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
(5, 1, 'Secretary', 'secretary.social@sjcssc.co.uk'),
(6, 1, 'SJCSSC Treasurer', 'treasurer.social@sjcssc.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `location_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_bowls`
--

INSERT INTO `fixtures_bowls` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `location_id`, `meet_at`, `contact`, `other_information`) VALUES
(1, '2018-10-11 20:48:30', 1, 2, 3, '2018-11-25', '12:00:00', 1, 'Club House', '', ''),
(2, '2018-10-11 20:49:20', 3, 5, 5, '2018-11-13', '16:00:00', 5, 'STG', 'Phil Perks', '');

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
  `location_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_football`
--

INSERT INTO `fixtures_football` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `location_id`, `meet_at`, `contact`, `other_information`) VALUES
(1, '2018-10-11 20:56:03', 14, 17, 9, '2018-11-06', '10:00:00', 14, '', '', ''),
(2, '2018-10-11 20:56:45', 17, 20, 12, '2018-11-30', '14:00:00', 19, '', '', ''),
(3, '2018-10-11 20:57:36', 19, 14, 11, '2018-12-04', '18:00:00', 20, '', '', '');

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
  `location_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures_rugby`
--

INSERT INTO `fixtures_rugby` (`id`, `created_date`, `home_team_id`, `away_team_id`, `league_id`, `date`, `time`, `location_id`, `meet_at`, `contact`, `other_information`) VALUES
(1, '2018-10-11 20:51:40', 8, 9, 7, '2018-11-07', '19:30:00', 7, '', '', ''),
(2, '2018-10-11 20:51:40', 11, 12, 8, '2018-10-24', '15:00:00', 10, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `league` varchar(255) NOT NULL,
  `league_full` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `club_id`, `league`, `league_full`) VALUES
(1, 2, 'PG1', 'East Wales Private Greens 1'),
(2, 2, 'PG2', 'East Wales Private Greens 2'),
(3, 2, 'CML', 'Cardiff Municipal League'),
(4, 2, 'Alliance', 'Alliance'),
(5, 2, 'Friendly', ''),
(6, 3, 'Gallagher Premiership', ''),
(7, 3, 'RFU Championship', ''),
(8, 3, 'Friendly', ''),
(9, 4, 'Premier League', ''),
(10, 4, 'Bundesliga', ''),
(11, 4, 'Serie A', ''),
(12, 4, 'La Liga', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` date DEFAULT NULL,
  `expiry_date_option` varchar(20) NOT NULL,
  `important` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `location_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `club_id`, `name`, `active`) VALUES
(1, 2, 'Michael Perks', 1),
(2, 2, 'Philip Perks', 1),
(3, 2, 'Susan Perks', 1),
(4, 2, 'Matthew Perks', 1),
(5, 2, 'Laurence Perks', 1),
(6, 2, 'Niall Perks', 1),
(7, 2, 'Alice Perks', 1),
(8, 3, 'Steve Rogers', 1),
(9, 3, 'Tony Stark', 1),
(10, 3, 'Peter Parker', 1),
(11, 3, 'Thor', 1),
(12, 3, 'Doctor Strange', 1),
(13, 3, 'Bruce Banner', 1),
(14, 4, 'Clark Kent', 1),
(15, 4, 'Bruce Wayne', 1),
(16, 4, 'Barry Allen', 1),
(17, 4, 'Arthur Curry', 1),
(18, 4, 'Diana Prince', 1),
(19, 4, 'Wally West', 1),
(20, 4, 'Lois Lane', 1);

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
(1, 1, 'Club House', '029 2061 9286'),
(2, 1, 'Webmaster', '07890 101555'),
(3, 2, 'Secretary', '029 2021 7455');

-- --------------------------------------------------------

--
-- Table structure for table `squad`
--

CREATE TABLE `squad` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `fixture_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `squad`
--

INSERT INTO `squad` (`id`, `club_id`, `fixture_id`, `position_id`, `name_id`) VALUES
(1, 2, 1, 1, 1),
(2, 2, 1, 1, 2),
(3, 2, 1, 1, 3),
(4, 2, 1, 2, 4),
(5, 2, 1, 2, 4),
(6, 2, 1, 3, 6),
(7, 2, 1, 3, 7),
(8, 2, 2, 1, 1),
(9, 2, 2, 2, 2),
(10, 2, 2, 2, 3),
(11, 2, 2, 2, 6),
(12, 2, 2, 2, 4),
(13, 2, 2, 3, 5),
(14, 2, 2, 3, 7),
(15, 3, 1, 1, 8),
(16, 3, 1, 2, 9),
(17, 3, 1, 3, 10),
(18, 3, 1, 4, 11),
(19, 3, 1, 5, 12),
(20, 3, 1, 6, 13),
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
(47, 4, 3, 7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `team` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `club_id`, `team`, `location`) VALUES
(1, 2, 'St Joseph\'s', 'St Joseph\'s Bowls Club, Llwynfedw Gardens, Birchgrove, Cardiff CF14 4NW'),
(2, 2, 'Barry Athletic', 'Barry Romilly Bowling Club, Romilly Rd, Barry CF62 6LF'),
(3, 2, 'Penarth', 'Penarth Bowling Club, Rectory Road, Penarth CF64 3AN'),
(4, 2, 'Rumney', 'Rumney Hill Gardens, Newport Road, Cardiff CF3 4FD'),
(5, 2, 'Splott', 'Splott Park, Muirton Road, Splott, Cardiff CF24 2SJ'),
(6, 2, 'Whitchurch', 'Whitchurch Bowls Club, Penlline Rd, Cardiff CF14 2AD'),
(7, 3, 'St Joseph\'s', 'St Josephs RFC Clubhouse, 29 Whitchurch Road, Cardiff, CF14 3JN'),
(8, 3, 'Harlequins', 'Twickenham Stoop, Langhorn Dr, Twickenham, TW2 7SX'),
(9, 3, 'Saracens', 'Allianz Park, Greenlands Ln, London, NW4 1RL'),
(10, 3, 'Munster', 'Thomond Park, Cratloe Rd, Limerick, Ireland, IRE YSX'),
(11, 3, 'Cardiff Blues', 'Cardiff Arms Park, Westgate St, Cardiff, CF10 1JA'),
(12, 3, 'Scarlets', 'Parc y Scarlets, Pemberton Park, Llanelli, SA14 9UZ'),
(13, 3, 'Ospreys', 'Liberty Stadium, Plasmarl, Swansea, SA1 2FA'),
(14, 4, 'St Joseph\'s', 'St Joseph\'s AFC, Maes-y-Coed Road Playing Fields, St Cenydd Road, Cardiff, CF14 4AN'),
(15, 4, 'Chelsea', 'Stamford Bridge, Fulham Rd, Fulham, London, SW6 1HS'),
(16, 4, 'Liverpool', 'Anfield, Anfield Rd, Liverpool, L4 0TH'),
(17, 4, 'Arsenal', 'Emirates Stadium, Hornsey Rd, London, N7 7AJ'),
(18, 4, 'Tottenham', 'White Hart Lane, 748 High Rd, Tottenham, London, N17 0AP'),
(19, 4, 'Manchester United', 'Old Trafford, Sir Matt Busby Way, Stretford, Manchester, M16 0RA'),
(20, 4, 'Newcastle', 'St. James\' Park, Barrack Rd, Newcastle upon Tyne, NE1 4ST');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `location` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `club_id`, `venue`, `location`) VALUES
(1, 2, 'St Joseph\'s Bowls Club', 'Llwynfedw Gardens, Birchgrove, Cardiff, CF14 4NW'),
(2, 2, 'Whitchurch Bowls Club', 'Penlline Rd, Cardiff CF14 2AD'),
(3, 2, 'Barry Romilly Bowling Club', 'Romilly Rd, Barry, CF62 6LF'),
(4, 2, 'Penarth Bowling Club', 'Rectory Road, Penarth, CF64 3AN'),
(5, 2, 'Rumney Hill Gardens', 'Newport Road, Cardiff, CF3 4FD'),
(6, 2, 'Splott Park', 'Muirton Road, Splott, Cardiff, CF24 2SJ'),
(7, 3, 'St Josephs RFC Clubhouse', '29 Whitchurch Road, Cardiff, CF14 3JN'),
(8, 3, 'Liberty Stadium', 'Plasmarl, Swansea, SA1 2FA'),
(9, 3, 'Twickenham Stoop', 'Langhorn Dr, Twickenham, TW2 7SX'),
(10, 3, 'Allianz Park', 'Greenlands Ln, London, NW4 1RL'),
(11, 3, 'Thomond Park', 'Cratloe Rd, Limerick, Ireland, IRE YSX'),
(12, 3, 'Cardiff Arms Park', 'Westgate St, Cardiff, CF10 1JA'),
(13, 3, 'Parc y Scarlets', 'Pemberton Park, Llanelli, SA14 9UZ'),
(14, 4, 'St Joseph\'s AFC', 'Maes-y-Coed Road Playing Fields, St Cenydd Road, Cardiff, CF14 4AN'),
(15, 4, 'St. James\' Park', 'Barrack Rd, Newcastle upon Tyne, NE1 4ST'),
(16, 4, 'Stamford Bridge', 'Fulham Rd, Fulham, London, SW6 1HS'),
(17, 4, 'Anfield', 'Anfield Rd, Liverpool, L4 0TH'),
(18, 4, 'Emirates Stadium', 'Hornsey Rd, London, N7 7AJ'),
(19, 4, 'White Hart Lane', '748 High Rd, Tottenham, London, N17 0AP'),
(20, 4, 'Old Trafford', 'Sir Matt Busby Way, Stretford, Manchester, M16 0RA');

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
-- Indexes for table `squad`
--
ALTER TABLE `squad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixtures_bowls`
--
ALTER TABLE `fixtures_bowls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_links`
--
ALTER TABLE `menu_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outings`
--
ALTER TABLE `outings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `squad`
--
ALTER TABLE `squad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
