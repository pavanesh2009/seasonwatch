-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2010 at 07:38 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.4-2ubuntu5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ncbs_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `language_Master`
--

CREATE TABLE IF NOT EXISTS `language_Master` (
  `language_id` int(10) NOT NULL auto_increment,
  `Language_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`language_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language_Master`
--

INSERT INTO `language_Master` (`language_id`, `Language_name`) VALUES
(1, 'Scientific'),
(2, 'English'),
(3, 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE IF NOT EXISTS `location_master` (
  `tree_location_id` int(10) NOT NULL auto_increment,
  `state_id` int(10) NOT NULL,
  `city` varchar(40) NOT NULL,
  `longitude` decimal(9,7) NOT NULL,
  `latitude` decimal(9,7) default NULL,
  `location_name` varchar(100) NOT NULL,
  `zoom_factor` int(10) NOT NULL,
  PRIMARY KEY  (`tree_location_id`),
  KEY `state_id` (`state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=462 ;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`tree_location_id`, `state_id`, `city`, `longitude`, `latitude`, `location_name`, `zoom_factor`) VALUES
(439, 33, 'Kanpur', 80.3178630, 26.4578300, 'kanpur', 9),
(440, 17, 'Bengaluru', 77.6235413, 12.9050242, 'Bommanhalli', 9),
(441, 28, 'Beas', 75.2887369, 31.5157168, 'Beas', 9),
(442, 17, 'Bengaluru', 77.6450215, 13.0176621, 'Bnasawadi', 9),
(443, 33, 'Agra', 78.0100000, 27.1900000, 'Agra', 9),
(444, 28, 'Beas', 75.2887369, 31.5157168, 'Beas', 9),
(445, 28, 'Beas', 75.2887369, 31.5157168, 'beas', 9),
(446, 28, 'Beas', 75.2887369, 31.5157168, 'bea', 9),
(447, 13, 'Ambala', 76.8325730, 30.3493190, 'ambala', 9),
(448, 13, 'Ambala', 76.8325730, 30.3493190, 'ambala', 9),
(449, 13, 'Ambala', 76.8325730, 30.3493190, 'ambala', 9),
(450, 13, 'Ambala', 76.8325730, 30.3493190, 'Ambala', 9),
(451, 33, 'Agra', 78.0100000, 27.1900000, 'Agra', 9),
(452, 28, 'Beas', 75.2887369, 31.5157168, 'Beas', 9),
(453, 17, 'Bengaluru', 77.5943760, 12.9716060, 'bangalore', 9),
(454, 17, 'Bengaluru', 77.6450215, 12.9159349, 'HSR LAyout', 9),
(455, 20, 'Raisen', 78.1108279, 23.1207861, 'Raisen', 9),
(456, 20, 'Raisen', 78.1108279, 23.1207861, 'Raisen', 9),
(457, 33, 'Moradabad', 78.7707750, 28.8369800, 'Moradabad', 9),
(458, 2, 'Chittoor', 79.0948560, 13.2113900, 'chituur', 9),
(459, 14, 'Hamirpur', 76.5230390, 31.6853370, 'hamirpur', 9),
(460, 29, 'Ajmer', 74.7805192, 26.1668245, 'ajmer', 9),
(461, 33, 'Mahoba', 79.8728850, 25.2886450, 'Mahoba', 9);

-- --------------------------------------------------------

--
-- Table structure for table `seswatch_states`
--

CREATE TABLE IF NOT EXISTS `seswatch_states` (
  `state_id` bigint(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY  (`state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seswatch_states`
--

INSERT INTO `seswatch_states` (`state_id`, `state`) VALUES
(24, 'Mizoram'),
(23, 'Meghalaya'),
(22, 'Manipur'),
(21, 'Maharashtra'),
(20, 'Madhya Pradesh'),
(19, 'Lakshadweep'),
(18, 'Kerala'),
(17, 'Karnataka'),
(16, 'Jharkhand'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(13, 'Haryana'),
(12, 'Gujarat'),
(11, 'Goa'),
(10, 'Delhi'),
(9, 'Daman and Diu'),
(8, 'Dadra and Nagar Have'),
(7, 'Chhattisgarh'),
(6, 'Chandigarh'),
(5, 'Bihar'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(2, 'Andhra Pradesh'),
(1, 'Andaman and Nicobar '),
(25, 'Nagaland'),
(26, 'Orissa'),
(27, 'Panducherry'),
(28, 'Punjab'),
(29, 'Rajasthan'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Tripura'),
(33, 'Uttar Pradesh'),
(34, 'Uttarakhand'),
(35, 'West Bengal'),
(36, 'Not In India');

-- --------------------------------------------------------

--
-- Table structure for table `species_alternate_name`
--

CREATE TABLE IF NOT EXISTS `species_alternate_name` (
  `alternate_name_id` int(10) NOT NULL auto_increment,
  `language_id` int(10) NOT NULL,
  `alternative_name` varchar(60) NOT NULL,
  `species_id` int(10) NOT NULL,
  PRIMARY KEY  (`alternate_name_id`),
  KEY `language_master_species_alternate_name_fk` (`language_id`),
  KEY `species_master_species_alternate_name_fk` (`species_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=319 ;

--
-- Dumping data for table `species_alternate_name`
--

INSERT INTO `species_alternate_name` (`alternate_name_id`, `language_id`, `alternative_name`, `species_id`) VALUES
(1, 1, 'Mimosa leucophloea', 1001),
(2, 1, 'Acacia arabica', 1002),
(3, 1, 'Crateva marmelos', 1003),
(4, 1, 'Pavia indica', 1004),
(5, 1, 'Mimosa amara', 1006),
(6, 1, 'Acacia lebbeck', 1007),
(7, 1, 'Mimosa procera', 1008),
(8, 1, 'Conocarpus latifolia', 1010),
(9, 1, 'Sceura marina', 1011),
(10, 1, 'Melia azadirachta', 1012),
(11, 1, 'Bauhinia malabarica', 1013),
(12, 1, 'Bauhinia semla', 1015),
(13, 1, 'Bauhinia malabaricum', 1016),
(14, 1, 'Butea frondosa', 1018),
(15, 1, 'Cochlospermum gossyp', 1024),
(16, 1, 'Coffea canephora', 1026),
(17, 1, 'Cordia dichottoma', 1027),
(18, 1, 'Dalbergia lanceolari', 1029),
(19, 1, 'Poinciana regia', 1031),
(20, 1, 'Dillenia speciosa', 1032),
(21, 1, 'Dillenia baillonii', 1033),
(22, 1, 'Duabanga sonneratioi', 1034),
(23, 1, 'Erythrina variegata', 1035),
(24, 1, 'Ficus glomerata', 1037),
(25, 1, 'Gliricidia maculata', 1040),
(26, 1, 'Ulmus integrifolia ', 1042),
(27, 1, 'Jacaranda chelonia', 1043),
(28, 1, 'Kigelia pinnata', 1044),
(29, 1, 'Kydia fraterna Roxb.', 1045),
(30, 1, 'Lagerstroemia flos-r', 1046),
(31, 1, 'Lantana camara var. ', 1047),
(32, 1, 'Macaranga roxburghii', 1048),
(33, 1, 'Bassia longifolia', 1049),
(34, 1, 'Melia australis', 1051),
(35, 1, 'Mesua coromandelina', 1052),
(36, 1, 'Magnolia champaca', 1053),
(37, 1, 'Mimosops elengi', 1055),
(38, 1, 'Stephegyne parvifoli', 1056),
(39, 1, 'Anthcephalus cadamba', 1059),
(40, 1, 'Nyctanthes arbortris', 1060),
(41, 1, 'Parkia africana', 1061),
(42, 1, 'Peltophorum ferrugin', 1062),
(43, 1, 'Elate sylvestris', 1063),
(44, 1, 'Emblica officinalis', 1064),
(45, 1, 'Pongamia glabra', 1067),
(46, 1, 'Acacia cumanensis', 1068),
(47, 1, 'Pterospermum aceroid', 1069),
(48, 1, 'Quercus incana', 1071),
(49, 1, 'Saraca indica', 1075),
(50, 1, 'Tabebuia argentea', 1081),
(51, 1, 'Terminalia alata', 1087),
(52, 1, 'Mallotus nudiflorus', 1089),
(53, 1, 'Ziziphus jujuba', 1090),
(54, 1, ' Acacia scorpioides', 1002),
(55, 1, ' Acacia macrophylla', 1007),
(56, 1, ' Erythrina monosperm', 1018),
(57, 1, ' Bombax gossypium', 1024),
(58, 1, ' Dillenia floribunda', 1033),
(59, 1, ' Ficus lucescens', 1037),
(60, 1, ' Tanarius peltatus', 1048),
(61, 1, ' Bassia latifolia', 1049),
(62, 1, ' Melia japonica', 1051),
(63, 1, 'Mesua nagassarium', 1052),
(64, 1, ' Millettia pinnata', 1067),
(65, 1, ' Acacia juliflora', 1068),
(66, 1, ' Mimosa arabica', 1002),
(67, 1, ' Feuilleea lebbeck', 1007),
(68, 1, ' Madhuca indica', 1049),
(69, 1, ' Melia sempervivens', 1051),
(70, 1, ' Mesua pedunculata', 1052),
(71, 1, ' Derris indica', 1067),
(72, 1, 'Acacia salinarum', 1068),
(73, 1, ' Mimosa nilotica', 1002),
(74, 1, ' Mimosa lebbeck', 1007),
(75, 1, ' Madhuca latifolia', 1049),
(76, 1, ' Melia azadirachta', 1051),
(77, 1, ' Mesua roxburghii', 1052),
(78, 1, ' Algarobia juliflora', 1068),
(79, 1, ' Mimosa scorpioides', 1002),
(80, 1, ' Mimosa speciosa', 1007),
(81, 1, ' Illipe latifolia', 1049),
(82, 1, ' Melia azedarach var', 1051),
(83, 1, ' Desmanthus salinaru', 1068),
(84, 1, ' Acacia arabica var.', 1002),
(85, 1, ' Mimosa juliflora', 1068),
(86, 1, ' Mimosa piliflora', 1068),
(87, 1, ' Mimosa salinarum', 1068),
(88, 1, ' Neltuma bakeri', 1068),
(89, 1, ' Neltumajuliflora', 1068),
(90, 2, 'White Bark Acacia', 1001),
(91, 2, 'Egyptian mimosa', 1002),
(92, 2, 'Quince', 1003),
(93, 2, 'Coramandel ailanto', 1005),
(94, 2, 'Bitter albizia', 1006),
(95, 2, 'Koko', 1007),
(96, 2, 'White siris', 1008),
(97, 2, 'DevilÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s tree', 1009),
(98, 2, 'Dhau', 1010),
(99, 2, 'White Mangrove', 1011),
(100, 2, 'Margosa', 1012),
(101, 2, 'Purple bauhinia', 1013),
(102, 2, 'Burmese silk orchid', 1014),
(103, 2, 'North Indian Orchid ', 1015),
(104, 2, '(Red) silk cotton', 1016),
(105, 2, 'Palmira palm', 1017),
(106, 2, 'Bastard teak', 1018),
(107, 2, 'Black dammer', 1019),
(108, 2, 'Fish-tail palm', 1020),
(109, 2, 'Indian laburnum', 1021),
(110, 2, 'Kapok', 1022),
(111, 2, 'Floss-silk tree', 1023),
(112, 2, 'Yellow silk cottontr', 1024),
(113, 2, 'Mountain coffee', 1025),
(114, 2, 'Large sebesten', 1027),
(115, 2, 'Takoli', 1029),
(116, 2, 'Indian rosewood', 1030),
(117, 2, 'Flame tree', 1031),
(118, 2, 'Elephant apple', 1032),
(119, 2, 'Karmal', 1033),
(120, 2, 'Indian coral tree', 1035),
(121, 2, 'Barh', 1036),
(122, 2, 'Cluster fig', 1037),
(123, 2, 'Peepal', 1038),
(124, 2, 'Kharpat', 1039),
(125, 2, 'Mexican lilac', 1040),
(126, 2, 'Yemtani', 1041),
(127, 2, 'Entire-leaved elm tr', 1042),
(128, 2, 'Blue Jacaranda', 1043),
(129, 2, 'Balam khira', 1044),
(130, 2, 'Bharanga', 1045),
(131, 2, 'Giant Crape-myrtle', 1046),
(132, 2, 'Chand Kal', 1048),
(133, 2, 'Honey tree', 1049),
(134, 2, 'Mango', 1050),
(135, 2, 'China berry', 1051),
(136, 2, 'Ceylon ironwood', 1052),
(137, 2, 'Champak', 1053),
(138, 2, 'Akash neem', 1054),
(139, 2, 'Tanjong', 1055),
(140, 2, 'White Mullberry', 1057),
(141, 2, 'Jamaican cherry', 1058),
(142, 2, 'Cadamba', 1059),
(143, 2, 'Night-flowering jasm', 1060),
(144, 2, 'Parkia', 1061),
(145, 2, 'Copper pod', 1062),
(146, 2, 'Silver Date Palm', 1063),
(147, 2, 'Indian gooseberry', 1064),
(148, 2, 'Madras Thorn', 1065),
(149, 2, 'False ashoka', 1066),
(150, 2, 'Indian beech', 1067),
(151, 2, 'Mesquite', 1068),
(152, 2, 'Bayur tree', 1069),
(153, 2, 'Pomegranate', 1070),
(154, 2, 'Blackjack Oak', 1071),
(155, 2, 'Tree Rhododendron', 1072),
(156, 2, 'Fragrant sandalwood', 1074),
(157, 2, 'Sita-ashok', 1075),
(158, 2, 'Salwa', 1076),
(159, 2, 'African tulip tree', 1077),
(160, 2, 'Junglee badam', 1078),
(161, 2, 'Indian-tragacanth', 1079),
(162, 2, 'Indian blackberry', 1080),
(163, 2, 'Paraguayan Trumpet t', 1081),
(164, 2, 'Tamarind', 1082),
(165, 2, 'Sagun', 1083),
(166, 2, 'Baheda', 1085),
(167, 2, 'Indian almond', 1086),
(168, 2, 'Asan', 1087),
(169, 2, 'Australian Red Cedar', 1088),
(170, 2, 'Desert apple', 1090),
(171, 2, ' brewers acacia', 1001),
(172, 2, ' Egyptian thorn', 1002),
(173, 2, ' Stone apple', 1003),
(174, 2, '  Wheel tree', 1006),
(175, 2, ' East Indian Walnut', 1007),
(176, 2, ' Tall albizia', 1008),
(177, 2, ' Dita bark tree', 1009),
(178, 2, ' Dhoy', 1010),
(179, 2, ' Neem', 1012),
(180, 2, ' Butterfly tree', 1013),
(181, 2, ' Bidi Leaf Tree', 1014),
(182, 2, ' bombax', 1016),
(183, 2, ' Toddy palm', 1017),
(184, 2, ' Parrot Tree', 1018),
(185, 2, ' Golden shower', 1021),
(186, 2, ' Singapore kapok', 1022),
(187, 2, ' Torchwood tree', 1024),
(188, 2, ' Indian Dalbergia', 1030),
(189, 2, ' Flamboyant', 1031),
(190, 2, ' Large-flowered deli', 1032),
(191, 2, ' tiger''s claw tree', 1035),
(192, 2, ' Bo tree', 1038),
(193, 2, ' Mother of cocoa', 1040),
(194, 2, ' Jungle cork tree', 1042),
(195, 2, ' Neeli gulmohur', 1043),
(196, 2, ' Bhoti', 1045),
(197, 2, ' Queen''s Crape-myrtl', 1046),
(198, 2, ' Bead Tree', 1051),
(199, 2, ' Indian rose chestnu', 1052),
(200, 2, ' Champaka', 1053),
(201, 2, ' Neem chameli', 1054),
(202, 2, ' Spanish cherry', 1055),
(203, 2, ' Chinese Mullberry', 1057),
(204, 2, ' Panama berry', 1058),
(205, 2, ' Common bur-flower t', 1059),
(206, 2, ' Tree of sorrow', 1060),
(207, 2, ' African locust tree', 1061),
(208, 2, ' Rusty shield bearer', 1062),
(209, 2, '  Wild Date Palm', 1063),
(210, 2, ' Emblic', 1064),
(211, 2, ' Green champa', 1066),
(212, 2, ' Honge Tree', 1067),
(213, 2, ' Algarroba', 1068),
(214, 2, ' Dinner Plate Tree', 1069),
(215, 2, ' Burans', 1072),
(216, 2, ' White Sandalwood', 1074),
(217, 2, ' Sakhu', 1076),
(218, 2, ' Fountain Tree', 1077),
(219, 2, ' Java olive', 1078),
(220, 2, ' Gum karaya', 1079),
(221, 2, ' Silver Trumpet tree', 1081),
(222, 2, ' Belliric Myrobalan', 1085),
(223, 2, ' Bengal almond', 1086),
(224, 2, ' Indian Laurel', 1087),
(225, 2, ' Toon', 1088),
(226, 2, ' Indian jujube', 1090),
(227, 2, ' distillers acacia', 1001),
(228, 2, ' Mimosa', 1002),
(229, 2, ' Wood apple', 1003),
(230, 2, ' Frywood', 1007),
(231, 2, ' White cheesewood', 1009),
(232, 2, ' Geranium tree', 1013),
(233, 2, ' Wine palm', 1017),
(234, 2, ' Palash', 1018),
(235, 2, ' Purging fistula', 1021),
(236, 2, ' Kapok', 1022),
(237, 2, ' Buttercup tree', 1024),
(238, 2, ' Bombay blackwoodd', 1030),
(239, 2, ' Royal poinciana', 1031),
(240, 2, ' Hondapara tree', 1032),
(241, 2, ' Lenten tree', 1035),
(242, 2, ' bodhi tree', 1038),
(243, 2, ' Black poui', 1043),
(244, 2, ' Illya', 1045),
(245, 2, ' BanabÃƒÆ’Ã‚Â¡ Plant', 1046),
(246, 2, ' China Tree', 1051),
(247, 2, ' Tree jasmine', 1054),
(248, 2, ' Maulsari', 1055),
(249, 2, ' Strawberry tree', 1058),
(250, 2, ' wild cinchona', 1059),
(251, 2, ' Coral jasmine', 1060),
(252, 2, ' Badminton ball tree', 1061),
(253, 2, ' Yellow gulmohur', 1062),
(254, 2, ' Indian wild date', 1063),
(255, 2, ' Emblic myrobalan', 1064),
(256, 2, ' Indian fir', 1066),
(257, 2, ' Pongam Tree', 1067),
(258, 2, ' Southwest thorn', 1068),
(259, 2, ' Scarlet bell', 1077),
(260, 2, ' Great sterculia', 1078),
(261, 2, ' Indian gum tragacan', 1079),
(262, 2, ' Yellow tabebuia', 1081),
(263, 2, ' Bastard myrobalan', 1085),
(264, 2, ' Singapore almond', 1086),
(265, 2, ' Silver grey wood', 1087),
(266, 2, ' Suren', 1088),
(267, 2, ' Bel', 1003),
(268, 2, ' Shack shack', 1007),
(269, 2, ' Milkwood pine', 1009),
(270, 2, ' Orchid tree', 1013),
(271, 2, ' Brab tree', 1017),
(272, 2, ' Dhak', 1018),
(273, 2, ' Ceiba', 1022),
(274, 2, ' Cotton shellseed', 1024),
(275, 2, ' Sisu', 1030),
(276, 2, ' Indian catmon', 1032),
(277, 2, ' Tiger claw', 1035),
(278, 2, ' holy tree', 1038),
(279, 2, ' Green ebony', 1043),
(280, 2, ' Potari', 1045),
(281, 2, ' Pride-of-India', 1051),
(282, 2, ' Jam tree', 1058),
(283, 2, ' Gong-stick tree', 1061),
(284, 2, ' Golden Flamboyant', 1062),
(285, 2, ' Sugar palm', 1063),
(286, 2, ' Mast tree', 1066),
(287, 2, ' Squirt tree', 1077),
(288, 2, ' Peon', 1078),
(289, 2, ' Beach almond', 1085),
(290, 2, ' Malabar almond', 1086),
(291, 2, ' Beli fruit', 1003),
(292, 2, ' Rattlepod', 1007),
(293, 2, ' Blackboard tree', 1009),
(294, 2, ' Pink butterfly tree', 1013),
(295, 2, ' Palmyra', 1017),
(296, 2, ' White Silk-Cotton T', 1022),
(297, 2, ' Golden silk cotton ', 1024),
(298, 2, ' Ma-tad', 1032),
(299, 2, ' Pride-of-China', 1051),
(300, 2, ' Cotton Candy berry', 1058),
(301, 2, ' Yellow Flamboyant', 1062),
(302, 2, ' Poon Tree', 1078),
(303, 2, ' Tropical almond', 1086),
(304, 2, ' Lebbeck tree', 1007),
(305, 2, ' Purple butterfly tr', 1013),
(306, 2, ' Sugar palm', 1017),
(307, 2, ' Chalta', 1032),
(308, 2, ' Persian Lilac', 1051),
(309, 2, ' Yellow Flame Tree', 1062),
(310, 2, ' Sea almond', 1086),
(311, 2, ' Flea Tree', 1007),
(312, 2, ' Cambodian palm', 1017),
(313, 2, ' Indian Lilac', 1051),
(314, 2, ' Talisay tree', 1086),
(315, 2, ' Ice-apple', 1017),
(316, 2, ' Umbrella tree', 1086),
(317, 2, ' African fan palm', 1017),
(318, 2, ' borassus palm', 1017);

-- --------------------------------------------------------

--
-- Table structure for table `species_images_table`
--

CREATE TABLE IF NOT EXISTS `species_images_table` (
  `species_image_id` int(10) NOT NULL auto_increment,
  `tree_image_desc` varchar(200) NOT NULL,
  `image_type` varchar(20) NOT NULL,
  `file_name` int(10) NOT NULL,
  `path_filename` varchar(100) NOT NULL,
  `species_id` int(10) NOT NULL,
  PRIMARY KEY  (`species_image_id`),
  KEY `p_species_master_ncbs__fk` (`species_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `species_images_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `Species_master`
--

CREATE TABLE IF NOT EXISTS `Species_master` (
  `species_id` int(10) NOT NULL auto_increment,
  `species_primary_common_name` varchar(60) NOT NULL,
  `species_scientific_name` varchar(60) NOT NULL,
  `species_search_names` varchar(500) NOT NULL,
  `family` varchar(60) NOT NULL,
  `vegetation_type` varchar(60) NOT NULL,
  `status_in_india` varchar(60) NOT NULL,
  `habitat_type` varchar(1000) NOT NULL,
  `distribution_in_india` varchar(1000) NOT NULL,
  `leaf_shape_category` int(10) NOT NULL,
  `size_description` varchar(1000) NOT NULL,
  `flower_description` varchar(1000) NOT NULL,
  `bark_description` varchar(1000) NOT NULL,
  `fruit_description` varchar(1000) NOT NULL,
  `leaf_type` varchar(60) NOT NULL,
  `spine_thorn_description` varchar(1000) NOT NULL,
  `flowering_time` varchar(1000) NOT NULL,
  `fruiting_time` varchar(1000) NOT NULL,
  `time_of_leaf_flush` varchar(1000) NOT NULL,
  `special_notes_on_phenology` varchar(20) NOT NULL,
  `similar_species` varchar(1000) NOT NULL,
  `known_pollinators` varchar(1000) NOT NULL,
  `known_seed_dispersers` varchar(1000) NOT NULL,
  `uses_by_humans` varchar(1000) NOT NULL,
  `list_of_references` varchar(1000) NOT NULL,
  `special_notes_on_the_species` varchar(1000) NOT NULL,
  PRIMARY KEY  (`species_id`),
  KEY `species_id` (`species_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1164 ;

--
-- Dumping data for table `Species_master`
--

INSERT INTO `Species_master` (`species_id`, `species_primary_common_name`, `species_scientific_name`, `species_search_names`, `family`, `vegetation_type`, `status_in_india`, `habitat_type`, `distribution_in_india`, `leaf_shape_category`, `size_description`, `flower_description`, `bark_description`, `fruit_description`, `leaf_type`, `spine_thorn_description`, `flowering_time`, `fruiting_time`, `time_of_leaf_flush`, `special_notes_on_phenology`, `similar_species`, `known_pollinators`, `known_seed_dispersers`, `uses_by_humans`, `list_of_references`, `special_notes_on_the_species`) VALUES
(1000, 'White Babool', 'Acacia leucophloea', 'White Babool, Acacia leucophloea', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1001, 'Babool', 'Acacia nilotica', 'Babool, Acacia nilotica', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1002, 'Wood apple', 'Aegle marmelos', 'Wood apple, Aegle marmelos', 'Rutaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1003, 'Indian Horsechestnut ', 'Aesculus indica', 'Indian Horsechestnut , Aesculus indica', 'Hippocastanaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1004, 'Tree of heaven', 'Ailanthus excelsa', 'Tree of heaven, Ailanthus excelsa', 'Simarubaceaea', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1005, 'Krishna Siris', 'Albizia amara', 'Krishna Siris, Albizia amara', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1006, 'Lebbeck tree', 'Albizia lebbeck ', 'Lebbeck tree, Albizia lebbeck ', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1007, 'White siris', 'Albizia procera', 'White siris, Albizia procera', 'Fabaceae Ã‚Â ', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1008, 'Devil''s tree', 'Alstonia scholaris', 'Devil''s tree, Alstonia scholaris', 'Apocynaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1009, 'Axlewood tree', 'Anogeissus latifolia', 'Axlewood tree, Anogeissus latifolia', 'Combretaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1010, 'Grey Mangrove', 'Avicennia marina', 'Grey Mangrove, Avicennia marina', 'Acanthaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1011, 'Neem', 'Azadirachta indica ', 'Neem, Azadirachta indica ', 'Meliaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1012, 'Purple bauhinia', 'Bauhinia purpurea ', 'Purple bauhinia, Bauhinia purpurea ', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1013, 'Jhinjheri', 'Bauhinia rasemosa', 'Jhinjheri, Bauhinia rasemosa', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1014, 'Semla', 'Bauhinia retusa', 'Semla, Bauhinia retusa', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1015, 'Red-silk cotton', 'Bombax ceiba ', 'Red-silk cotton, Bombax ceiba ', 'Bombacaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1016, 'Toddy palm', 'Borassus flabellifer', 'Toddy palm, Borassus flabellifer', 'Arecaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1017, 'Flame of the forest', 'Butea monosperma', 'Flame of the forest, Butea monosperma', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1018, 'Black dammer', 'Canarium strictum', 'Black dammer, Canarium strictum', 'Burseraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1019, 'Fish-tail palm', 'Caryota urens', 'Fish-tail palm, Caryota urens', 'Arecaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1020, 'Indian laburnum', 'Cassia fistula', 'Indian laburnum, Cassia fistula', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1021, 'White-silk cotton', 'Ceiba pentandra ', 'White-silk cotton, Ceiba pentandra ', 'Bombacaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1022, 'Floss-silk tree', 'Chorisia speciosa', 'Floss-silk tree, Chorisia speciosa', 'Bombacaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1023, 'Yellow-silk cotton tree', 'Cochlospermum religiosum', 'Yellow-silk cotton tree, Cochlospermum religiosum', 'Bixaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1024, 'Mountain coffee', 'Coffea arabica', 'Mountain coffee, Coffea arabica', 'Rubiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1025, 'Robusta coffee', 'Coffea robusta', 'Robusta coffee, Coffea robusta', 'Rubiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1026, 'Large sebesten', 'Cordia wallichii', 'Large sebesten, Cordia wallichii', 'Boraginaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1027, 'Tanner''s Tree', 'Coriaria nepalensis', 'Tanner''s Tree, Coriaria nepalensis', 'Coriariaceae ', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1028, 'Bastard rose-wood', 'Dalbergia lanceolaria', 'Bastard rose-wood, Dalbergia lanceolaria', 'Fabaceae', '0', '0', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1029, 'Indian rosewood', 'Dalbergia sissoo', 'Indian rosewood, Dalbergia sissoo', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1030, 'Gulmohur ', 'Delonix regia', 'Gulmohur , Delonix regia', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1031, 'Elephant apple', 'Dillenia indica', 'Elephant apple, Dillenia indica', 'Dilleniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1032, 'Karkat', 'Dillenia pentagyna', 'Karkat, Dillenia pentagyna', 'Dilleniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1033, 'Duabanga', 'Duabanga grandiflora', 'Duabanga, Duabanga grandiflora', 'Lythraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1034, 'Indian coral tree', 'Erythrina indica', 'Indian coral tree, Erythrina indica', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1035, 'Banyan tree', 'Ficus bengalensis', 'Banyan tree, Ficus bengalensis', 'Moraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1036, 'Country Fig', 'Ficus racemosa', 'Country Fig, Ficus racemosa', 'Moraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1037, 'Peepal', 'Ficus religiosa', 'Peepal, Ficus religiosa', 'Moraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1038, 'Garuga', 'Garuga pinnata', 'Garuga, Garuga pinnata', 'Burseraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1039, 'Quickstick', 'Gliricidia sepium', 'Quickstick, Gliricidia sepium', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1040, 'Gamar', 'Gmelina arborea', 'Gamar, Gmelina arborea', 'Verbenaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1041, 'Indian elm', 'Holoptelea integrifolia', 'Indian elm, Holoptelea integrifolia', 'Ulmaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1042, 'Jacaranda', 'Jacaranda mimosifolia', 'Jacaranda, Jacaranda mimosifolia', 'Bignoniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1043, 'Sausage Tree', 'Kigelia africana', 'Sausage Tree, Kigelia africana', 'Bignoniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1044, 'Kydia', 'Kydia calycina', 'Kydia, Kydia calycina', 'Malvaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1045, 'Pride of India', 'Lagerstroemia speciosa ', 'Pride of India, Lagerstroemia speciosa ', 'Lythraceae ', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1046, 'Spanish flag', 'Lantana camara', 'Spanish flag, Lantana camara', 'Verbenaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1047, 'Chandada', 'Macaranga peltata', 'Chandada, Macaranga peltata', 'Euphorbiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1048, 'Mahua', 'Madhuca longifolia (var. latifolia)', 'Mahua, Madhuca longifolia (var. latifolia)', 'Sapotaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1050, 'China berry', 'Melia azedarach', 'China berry, Melia azedarach', 'Meliaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1051, 'Nag champa', 'Mesua ferrea', 'Nag champa, Mesua ferrea', 'Clusiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1052, 'Champa', 'Michelia champaca', 'Champa, Michelia champaca', 'Magnoliaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1053, 'Indian Cork Tree', 'Millingtonia hortensis', 'Indian Cork Tree, Millingtonia hortensis', 'Bignoniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1054, 'Maulsari', 'Mimusops elengi', 'Maulsari, Mimusops elengi', 'Sapotaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1055, 'Kaim', 'Mitragyna parviflora ', 'Kaim, Mitragyna parviflora ', 'Rubiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1056, 'Silkworm Mullberry ', 'Morus alba', 'Silkworm Mullberry , Morus alba', 'Moracea', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1057, 'Singapore cherry', 'Muntingia calabura', 'Singapore cherry, Muntingia calabura', 'Tiliacaea', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1058, 'Kadamb', 'Neolamarckia cadamba', 'Kadamb, Neolamarckia cadamba', 'Rubiaceae ', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1059, 'Harsingar', 'Nyctanthes arbor-tristis ', 'Harsingar, Nyctanthes arbor-tristis ', 'Oleaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1060, 'Badminton-ball tree', 'Parkia biglandulosa', 'Badminton-ball tree, Parkia biglandulosa', 'Mimosaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1061, 'Copper-pod', 'Peltophorum pterocarpum', 'Copper-pod, Peltophorum pterocarpum', 'Caesalpiniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1062, 'Khajur', 'Phoenix sylvestris', 'Khajur, Phoenix sylvestris', 'Arecaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1063, 'Amla', 'Phyllanthus emblica', 'Amla, Phyllanthus emblica', 'Phyllanthaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1064, 'Jungle Jalebi', 'Pithecellobium dulce  ', 'Jungle Jalebi, Pithecellobium dulce  ', 'Mimosaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1065, 'Ashoka', 'Polyalthia longifolia', 'Ashoka, Polyalthia longifolia', 'Annonaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1066, 'Pongam Tree', 'Pongamia pinnata', 'Pongam Tree, Pongamia pinnata', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1067, 'Vilaiti keekae', 'Prosopis juliflora', 'Vilaiti keekae, Prosopis juliflora', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1068, 'Kanak Champa', 'Pterospermum acerifolium', 'Kanak Champa, Pterospermum acerifolium', 'Malvaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1069, 'Pomegranate', 'Punica granatum', 'Pomegranate, Punica granatum', 'Lythraceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1070, 'Grey Oak', 'Quercus leucotrichophora', 'Grey Oak, Quercus leucotrichophora', 'Fagaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1071, 'Himalyan Rhododendron', 'Rhododendron arboreum', 'Himalyan Rhododendron, Rhododendron arboreum', 'Ericaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1072, 'Nilgiri Rhododendron', 'Rhododendron nilagiricum ', 'Nilgiri Rhododendron, Rhododendron nilagiricum ', 'Ericaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1073, 'Sandalwood', 'Santalum album', 'Sandalwood, Santalum album', 'Santalaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1074, 'True Ashok', 'Saraca asoca', 'True Ashok, Saraca asoca', 'Fabaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1075, 'Sal', 'Shorea robusta', 'Sal, Shorea robusta', 'Dipterocarpaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1076, 'African tulip', 'Spathodea campanulata', 'African tulip, Spathodea campanulata', 'Bignoniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1077, 'Wild Almond', 'Sterculia foetida', 'Wild Almond, Sterculia foetida', 'Caesalpiniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1078, 'The Ghost Tree', 'Sterculia urens', 'The Ghost Tree, Sterculia urens', 'Sterculiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1079, 'Jammun', 'Syzygium cumini', 'Jammun, Syzygium cumini', 'Myrtaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1080, 'Caribbean Trumpet Tree', 'Tabebuia aurea', 'Caribbean Trumpet Tree, Tabebuia aurea', 'Bignoniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1081, 'Tamarind', 'Tamarindus indica', 'Tamarind, Tamarindus indica', 'Caesalpiniaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1082, 'Teak', 'Tectona grandis', 'Teak, Tectona grandis', 'Verbenaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1083, 'Arjun tree', 'Terminalia arjuna', 'Arjun tree, Terminalia arjuna', 'Combretaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1084, 'Belleric myrobalan', 'Terminalia bellirica', 'Belleric myrobalan, Terminalia bellirica', 'Combretaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1085, 'Indian Almond', 'Terminalia catappa', 'Indian Almond, Terminalia catappa', 'Combretaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1086, 'Indian laurel', 'Terminalia tomentosa', 'Indian laurel, Terminalia tomentosa', 'Combretaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1087, 'Indian Mahogany', 'Toona ciliata', 'Indian Mahogany, Toona ciliata', 'Meliaceae ', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1088, 'False white teak', 'Trewia nudiflora', 'False white teak, Trewia nudiflora', 'Euphorbiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1089, 'Ber', 'Ziziphus mauritiana', 'Ber, Ziziphus mauritiana', 'Rhamnaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1090, 'Mango (unknown variety)', 'Mangifera indica', 'Mango (unknown variety), Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1091, 'Mango Aabehayat ', 'Mangifera indica', 'Aabehayat Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1092, 'Mango Airi ', 'Mangifera indica', 'Airi Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1093, 'Mango Allampur Beneshan ', 'Mangifera indica', 'Allampur Beneshan Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1094, 'Mango Alphonso ', 'Mangifera indica', 'Alphonso Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1095, 'Mango Amrapali ', 'Mangifera indica', 'Amrapali Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1096, 'Mango Arkapuneet ', 'Mangifera indica', 'Arkapuneet Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1097, 'Mango Badami ', 'Mangifera indica', 'Badami Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1098, 'Mango Bangalora ', 'Mangifera indica', 'Bangalora Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1099, 'Mango Banganpalli ', 'Mangifera indica', 'Banganpalli Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1100, 'Mango Bathua ', 'Mangifera indica', 'Bathua Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1101, 'Mango Beneshan ', 'Mangifera indica', 'Beneshan Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1102, 'Mango Bombai ', 'Mangifera indica', 'Bombai Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1103, 'Mango Bombay Green (Sarauli) ', 'Mangifera indica', 'Bombay Green (Sarauli) Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1104, 'Mango Cheruku Rasam ', 'Mangifera indica', 'Cheruku Rasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1105, 'Mango Cherukurasam ', 'Mangifera indica', 'Cherukurasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1106, 'Mango Cherukurasam ', 'Mangifera indica', 'Cherukurasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1107, 'Mango Chinna Rasam ', 'Mangifera indica', 'Chinna Rasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1108, 'Mango Chosa ', 'Mangifera indica', 'Chosa Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1109, 'Dussheri Mango', 'Mangifera indica', 'Dussheri Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1110, 'Mango Fazli ', 'Mangifera indica', 'Fazli Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1111, 'Mango Fernandin ', 'Mangifera indica', 'Fernandin Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1112, 'Mango Gilas ', 'Mangifera indica', 'Gilas Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1113, 'Mango Gulabkhas ', 'Mangifera indica', 'Gulabkhas Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1114, 'Mango Hardil-aziz ', 'Mangifera indica', 'Hardil-aziz Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1115, 'Mango Himayat ', 'Mangifera indica', 'Himayat Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1116, 'Mango Himayuddin ', 'Mangifera indica', 'Himayuddin Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1117, 'Mango Himsagar ', 'Mangifera indica', 'Himsagar Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1118, 'Mango Husnaara ', 'Mangifera indica', 'Husnaara Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1119, 'Mango Jamadar  ', 'Mangifera indica', 'Jamadar  Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1120, 'Mango Jehangir', 'Mangifera indica', 'Jehangir Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1121, 'Mango Kaju ', 'Mangifera indica', 'Kaju Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1122, 'Mango Kesar ', 'Mangifera indica', 'Kesar Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1123, 'Mango Khatta Meetha ', 'Mangifera indica', 'Khatta Meetha Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1124, 'Mango Kishenbhog ', 'Mangifera indica', 'Kishenbhog Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1125, 'Mango Kothapalli Kobbari ', 'Mangifera indica', 'Kothapalli Kobbari Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1126, 'Mango Langra ', 'Mangifera indica', 'Langra Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1127, 'Mango Lucknowi ', 'Mangifera indica', 'Lucknowi Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1128, 'Mango Malkurad  ', 'Mangifera indica', 'Malkurad  Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1129, 'Mango Mallika ', 'Mangifera indica', 'Mallika Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1130, 'Mango Manjeera ', 'Mangifera indica', 'Manjeera Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1131, 'Mango Mankurad ', 'Mangifera indica', 'Mankurad Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1132, 'Mango Mithwa Ghazipur ', 'Mangifera indica', 'Mithwa Ghazipur Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1133, 'Mango Mithwa Sundar Shah ', 'Mangifera indica', 'Mithwa Sundar Shah Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1134, 'Mango Mulgoa ', 'Mangifera indica', 'Mulgoa Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1135, 'Mango Mundappa ', 'Mangifera indica', 'Mundappa Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1136, 'Mango Nauras ', 'Mangifera indica', 'Nauras Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1137, 'Mango Neelum ', 'Mangifera indica', 'Neelum Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1138, 'Mango Olour ', 'Mangifera indica', 'Olour Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1139, 'Mango Pairi ', 'Mangifera indica', 'Pairi Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1140, 'Mango Panchadara Kalasa ', 'Mangifera indica', 'Panchadara Kalasa Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1141, 'Mango Pedda Rasam ', 'Mangifera indica', 'Pedda Rasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1142, 'Mango Peddarasam ', 'Mangifera indica', 'Peddarasam Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1143, 'Mango Rajapuri ', 'Mangifera indica', 'Rajapuri Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1144, 'Mango Rasgola ', 'Mangifera indica', 'Rasgola Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1145, 'Mango Raspoonia ', 'Mangifera indica', 'Raspoonia Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1146, 'Mango Raspuri ', 'Mangifera indica', 'Raspuri Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1147, 'Mango Ratole ', 'Mangifera indica', 'Ratole Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1148, 'Mango Rumani ', 'Mangifera indica', 'Rumani Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1149, 'Mango Safeda ', 'Mangifera indica', 'Safeda Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1150, 'Mango Samar Behest Chausa ', 'Mangifera indica', 'Samar Behest Chausa Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1151, 'Mango Sharbati Begrain ', 'Mangifera indica', 'Sharbati Begrain Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1152, 'Mango Sindhu ', 'Mangifera indica', 'Sindhu Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1153, 'Mango Sukul ', 'Mangifera indica', 'Sukul Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1154, 'Mango Suvarnarekha ', 'Mangifera indica', 'Suvarnarekha Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1155, 'Mango Taimoorlang ', 'Mangifera indica', 'Taimoorlang Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1156, 'Mango Taimuriya ', 'Mangifera indica', 'Taimuriya Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1157, 'Mango Totapuri ', 'Mangifera indica', 'Totapuri Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1158, 'Mango Vanraj ', 'Mangifera indica', 'Vanraj Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1159, 'Mango Zardalu ', 'Mangifera indica', 'Zardalu Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', ''),
(1160, 'Mango Zawahiri ', 'Mangifera indica', 'Zawahiri Mango, Mangifera indica', 'Anacardiaceae', '', '', '0', '0', 0, '', '', '', '', '', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE IF NOT EXISTS `trees` (
  `tree_Id` int(10) NOT NULL auto_increment,
  `tree_desc` varchar(1000) default NULL,
  `is_fertilised` tinyint(1) default NULL,
  `is_watered` tinyint(1) default NULL,
  `species_id` int(10) NOT NULL,
  `tree_location_id` int(10) NOT NULL,
  `location_type` varchar(60) NOT NULL,
  `degree_of_slope` int(10) default NULL,
  `aspect` varchar(60) NOT NULL,
  `distance_from_water` int(10) default NULL,
  PRIMARY KEY  (`tree_Id`),
  KEY `p_species_master_trees_fk` (`species_id`),
  KEY `location_master_trees_fk` (`tree_location_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1030 ;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`tree_Id`, `tree_desc`, `is_fertilised`, `is_watered`, `species_id`, `tree_location_id`, `location_type`, `degree_of_slope`, `aspect`, `distance_from_water`) VALUES
(1028, 'This is dummy text1', 1, 1, 1047, 0, 'Farmland', 26, 'SouthWest', 25),
(1027, '', 1, 1, 1047, 0, 'Campus', 50, 'NorthEast', 25),
(1029, 'This is dummy text for wood apple..', 1, 1, 1002, 0, 'Garden/Park', 49, 'SouthEast', 33),
(1026, 'Dummy Text', 1, 1, 1052, 0, 'Garden/Park', 50, 'North', 33),
(1025, 'Dummy text', 1, 1, 1028, 0, 'Garden/Park', 49, 'NorthWest', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tree_measurement`
--

CREATE TABLE IF NOT EXISTS `tree_measurement` (
  `measurement_id` int(10) NOT NULL auto_increment,
  `tree_Id` int(10) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `date_of_measurement` date NOT NULL,
  `tree_girth` decimal(7,2) default NULL,
  `tree_height` decimal(7,2) default NULL,
  `tree_damage` tinyint(1) default NULL,
  `other_notes` varchar(1000) default NULL,
  PRIMARY KEY  (`measurement_id`),
  KEY `trees_tree_measurement__fk` (`tree_Id`),
  KEY `user_tree_measurement__fk` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1008 ;

--
-- Dumping data for table `tree_measurement`
--

INSERT INTO `tree_measurement` (`measurement_id`, `tree_Id`, `user_id`, `date_of_measurement`, `tree_girth`, `tree_height`, `tree_damage`, `other_notes`) VALUES
(1006, 1028, 85, '2010-06-04', 25.00, 25.00, 2, ''),
(1005, 1027, 85, '2010-06-08', 25.00, 25.00, 1, ''),
(1007, 1029, 85, '2010-06-11', 67.00, 25.00, 2, 'this is other notes for wood apple..'),
(1004, 1026, 85, '2010-06-09', 25.00, 25.00, 2, 'Dummy Text'),
(1003, 1025, 85, '2010-06-03', 25.00, 25.00, 2, 'Dummy text');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL auto_increment,
  `md5_id` varchar(200) collate latin1_general_ci NOT NULL default '',
  `full_name` tinytext collate latin1_general_ci NOT NULL,
  `user_name` varchar(200) collate latin1_general_ci NOT NULL default '',
  `user_email` varchar(220) collate latin1_general_ci NOT NULL default '',
  `user_role` varchar(200) collate latin1_general_ci NOT NULL,
  `pwd` varchar(200) collate latin1_general_ci NOT NULL default '',
  `address` text collate latin1_general_ci NOT NULL,
  `address1` text collate latin1_general_ci NOT NULL,
  `address2` text collate latin1_general_ci NOT NULL,
  `city` text collate latin1_general_ci NOT NULL,
  `district` text collate latin1_general_ci NOT NULL,
  `state_id` int(10) NOT NULL,
  `landline_stdcode` varchar(6) collate latin1_general_ci NOT NULL,
  `landline_num` bigint(15) NOT NULL,
  `mobile` bigint(15) NOT NULL,
  `zip` varchar(6) collate latin1_general_ci NOT NULL,
  `fax` varchar(200) collate latin1_general_ci NOT NULL default '',
  `website` text collate latin1_general_ci NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `users_ip` varchar(200) collate latin1_general_ci NOT NULL default '',
  `approved` int(1) NOT NULL default '0',
  `activation_code` int(10) NOT NULL default '0',
  `banned` int(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `state_id` (`state_id`),
  FULLTEXT KEY `idx_search` (`full_name`,`address`,`user_email`,`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=134 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `md5_id`, `full_name`, `user_name`, `user_email`, `user_role`, `pwd`, `address`, `address1`, `address2`, `city`, `district`, `state_id`, `landline_stdcode`, `landline_num`, `mobile`, `zip`, `fax`, `website`, `date`, `users_ip`, `approved`, `activation_code`, `banned`) VALUES
(85, '3ef815416f775098fe977004015c6193', 'user1', '', 'user1@example.com', '', '827ccb0eea8a706c4c34a16891f84e7b', 'Jayanagar, Bangalore', 'SST chamber', '!st floor', 'Bangalore', 'Bangalore', 17, '05281', 2446269, 9740352941, '', '', '', '2010-02-09', '127.0.0.1', 0, 0, 0),
(133, '9fc3d7152ba9336a670e36d0ed79bc43', 'Pavanesh', 'pavanesh', 'pavanesh2009@gmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'Bangalore', 'Bangalore', 0, '05281', 244629, 9740352941, '244629', '', '', '2010-04-27', '127.0.0.1', 0, 0, 0),
(132, '65ded5353c5ee48d0b7d48c591b8f430', 'Neeral', 'neeraj', 'neer@example.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'Bangalore', 'Bangalore', 22, '', 0, 0, '', '', '', '2010-04-26', '127.0.0.1', 0, 0, 0),
(131, '1afa34a7f984eeabdbb0a7d494132ee5', 'Pavanesh', 'pavan', 'pavan@example.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'Bangalore', 'Bangalore', 13, '', 0, 0, '', '', '', '2010-04-26', '127.0.0.1', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tree_observations`
--

CREATE TABLE IF NOT EXISTS `user_tree_observations` (
  `observation_id` int(10) NOT NULL auto_increment,
  `date` date NOT NULL,
  `observation_time` time NOT NULL,
  `is_leaf_mature` tinyint(1) NOT NULL,
  `is_leaf_fresh` tinyint(1) NOT NULL,
  `is_flower_bud` tinyint(1) NOT NULL,
  `is_fruit_ripe` tinyint(1) NOT NULL,
  `is_fruit_unripe` tinyint(1) NOT NULL,
  `is_flower_open` tinyint(1) NOT NULL,
  `freshleaf_count` varchar(10) NOT NULL,
  `matureleaf_count` varchar(10) NOT NULL,
  `bud_count` varchar(10) NOT NULL,
  `fruit_ripe_count` varchar(10) NOT NULL,
  `fruit_unripe_count` varchar(10) NOT NULL,
  `open_flower_count` varchar(10) NOT NULL,
  `animal_desc` varchar(1000) NOT NULL,
  `birds_desc` varchar(1000) NOT NULL,
  `insect_desc` varchar(1000) NOT NULL,
  `temperature_max` int(4) default NULL,
  `temperature_min` int(4) default NULL,
  `rainfall_mm` int(4) default NULL,
  `humidity_mm` decimal(3,2) default NULL,
  `user_tree_id` int(10) NOT NULL,
  PRIMARY KEY  (`observation_id`),
  KEY `user_tree_id` (`user_tree_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=813 ;

--
-- Dumping data for table `user_tree_observations`
--

INSERT INTO `user_tree_observations` (`observation_id`, `date`, `observation_time`, `is_leaf_mature`, `is_leaf_fresh`, `is_flower_bud`, `is_fruit_ripe`, `is_fruit_unripe`, `is_flower_open`, `freshleaf_count`, `matureleaf_count`, `bud_count`, `fruit_ripe_count`, `fruit_unripe_count`, `open_flower_count`, `animal_desc`, `birds_desc`, `insect_desc`, `temperature_max`, `temperature_min`, `rainfall_mm`, `humidity_mm`, `user_tree_id`) VALUES
(811, '2010-05-04', '00:00:00', 1, 2, 2, 1, 1, 1, '', 'Many', '', 'Many', 'Many', 'Full', 'This is dummy text', '', '', 0, 0, 0, 0.00, 1005),
(810, '2010-05-11', '00:00:00', 1, 1, 0, 1, 1, 1, 'Full', 'Many', '', 'Many', 'Many', '', 'Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text   Thsi is dummy text    ', '', '', 0, 0, 0, 0.00, 1006),
(809, '2010-05-05', '00:00:00', 1, 0, 0, 0, 0, 1, '', 'Full', '', '', '', 'Few', 'this is dummy text q    ', '', '', 0, 0, 0, 0.00, 1003),
(808, '2010-04-06', '00:00:00', 1, 1, 1, 1, 1, 1, '', '', '', '', '', '', '', '', '', 0, 0, 0, 0.00, 990),
(807, '2010-04-12', '00:00:00', 0, 1, 1, 1, 1, 1, '', '', 'Many', '', 'Few', 'Few', '', '', '', 0, 0, 0, 0.00, 949),
(806, '2010-04-19', '00:00:00', 0, 0, 2, 2, 2, 2, '', '', '', '', '', '', '', '', '', 0, 0, 0, 0.00, 999),
(805, '2010-04-04', '00:00:00', 0, 1, 1, 0, 2, 0, 'Many', '', 'Many', '', '', '', '   ', '', '', 0, 0, 0, 0.00, 998),
(804, '2010-04-12', '00:00:00', 0, 1, 0, 2, 2, 2, 'Many', '', '', '', '', '', '', '', '', 0, 0, 0, 0.00, 992),
(803, '2010-04-08', '00:00:00', 2, 2, 2, 0, 1, 1, '', '', '', '', 'Many', 'Full', 'dummy text', '', '', 0, 0, 0, 0.00, 990),
(802, '2010-04-01', '00:00:00', 1, 1, 0, 2, 2, 2, 'Many', 'Many', '', '', '', '', '', '', '', 0, 0, 0, 0.00, 949),
(812, '2010-06-02', '00:00:00', 0, 1, 0, 1, 0, 0, 'Many', '', '', 'Many', '', '', '  ', '', '', 0, 0, 0, 0.00, 1007);

-- --------------------------------------------------------

--
-- Table structure for table `user_tree_table`
--

CREATE TABLE IF NOT EXISTS `user_tree_table` (
  `user_tree_id` int(10) NOT NULL auto_increment,
  `tree_nickname` varchar(100) NOT NULL,
  `tree_id` int(10) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`user_tree_id`),
  KEY `trees_user_tree_table_fk` (`tree_id`),
  KEY `ncbs_user_user_tree_table_fk` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1008 ;

--
-- Dumping data for table `user_tree_table`
--

INSERT INTO `user_tree_table` (`user_tree_id`, `tree_nickname`, `tree_id`, `user_id`) VALUES
(1007, 'Wood Apple', 1029, 85),
(1004, 'Champa1', 1026, 85);
