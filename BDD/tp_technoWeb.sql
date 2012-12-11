-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2012 at 02:22 PM
-- Server version: 5.5.28
-- PHP Version: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tp_technoWeb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `idUpdate` int(11) NOT NULL,
  `idMember` int(11) NOT NULL,
  PRIMARY KEY (`idComment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE IF NOT EXISTS `Member` (
  `idMember` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(30) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  PRIMARY KEY (`idMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `Member`
--

INSERT INTO `Member` (`idMember`, `username`, `email`, `password`, `sex`, `isAdmin`, `description`, `image`, `website`) VALUES
(2, 'Suspendisse', 'non.luctus@augue.ca', 'FCQ58WTP9FX', 0, 1, 'iaculis \r\nnec, eleifend', '', ''),
(3, 'arcu.', 'Nunc.mauris@Morbinequetellus.org', 'TRE44PWR7TW', 0, 1, 'primis\r\n in faucibus orci luctus et ultrices posuere cubilia Curae;', '', ''),
(4, 'at,', 'magnis@est.edu', 'RNJ20VMA7GT', 0, 1, 'eros. Proin \r\nultrices. Duis', '', ''),
(5, 'posuere,', 'molestie@lacusQuisqueimperdiet.com', 'REW44BTR5ZI', 0, 1, 'odio\r\n sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer \r\nvitae', '', ''),
(6, 'Nam', 'nec@tinciduntadipiscingMauris.ca', 'JRC26DUL9ED', 0, 1, 'eget\r\n nisi dictum augue malesuada malesuada. Integer id magna et ipsum', '', ''),
(7, 'Donec', 'luctus@semconsequat.org', 'ROD86EYQ4WZ', 0, 0, 'elit, a \r\nfeugiat tellus lorem', '', ''),
(8, 'non', 'at@nonummy.com', 'EGZ73GYA4NS', 0, 0, 'congue. In \r\nscelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas', '', ''),
(9, 'eu', 'felis.ullamcorper@Aenean.com', 'MGP33QPJ8AO', 0, 0, 'elementum,\r\n dui quis accumsan convallis, ante', '', ''),
(10, 'ante', 'amet@luctusetultrices.edu', 'TJR42DWO4FA', 0, 0, 'ipsum \r\nnon arcu. Vivamus sit amet risus.', '', ''),
(11, 'diam', 'tortor.nibh.sit@gravida.edu', 'JXH81MHV2MP', 0, 1, 'elit, \r\na', '', ''),
(12, 'massa.', 'ac.eleifend.vitae@nullaatsem.com', 'NZR64PCR5CA', 0, 1, 'rutrum,\r\n justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed \r\nturpis nec mauris blandit mattis. Cras', '', ''),
(13, 'Phasellus', 'neque@non.ca', 'SSB50AXV1HI', 0, 0, 'Donec \r\nporttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, \r\nhendrerit id, ante. Nunc mauris sapien, cursus', '', ''),
(14, 'nisi', 'quis@Nam.com', 'MND04GKM8KF', 0, 1, 'eros non enim \r\ncommodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, \r\npretium et,', '', ''),
(15, 'sed', 'ornare.egestas@Vestibulumaccumsanneque.org', 'WWQ44RRM8ZZ', 0, 1, 'arcu.', '', ''),
(16, 'ipsum.', 'suscipit.nonummy@habitant.com', 'RIE28UQN7IJ', 0, 0, 'ullamcorper.\r\n Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, \r\nmalesuada id, erat. Etiam vestibulum', '', ''),
(17, 'montes,', 'sit.amet@esttempor.com', 'UNN48YSZ8DQ', 0, 1, 'sollicitudin\r\n commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, \r\nfeugiat non, lobortis quis, pede. Suspendisse dui.', '', ''),
(18, 'enim', 'convallis.ante@malesuadavelconvallis.ca', 'JVP34CXY5KS', 0, 0, 'commodo\r\n at, libero. Morbi accumsan', '', ''),
(19, 'cursus', 'metus.Aliquam.erat@aneque.org', 'UJK74YFG8AP', 0, 0, 'Suspendisse\r\n aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam \r\neros turpis non enim. Mauris quis turpis vitae', '', ''),
(20, 'est', 'nisi.Aenean.eget@lobortis.ca', 'HEA10YBR0OL', 0, 0, 'erat \r\nneque non quam.', '', ''),
(21, 'ipsum.', 'interdum.enim@nequeNullamnisl.org', 'KAR57OQY8LF', 0, 1, 'tellus,\r\n imperdiet non, vestibulum nec, euismod in, dolor. Fusce', '', ''),
(22, 'urna', 'tristique.neque@dolorQuisque.edu', 'VAH69RTS0LD', 0, 1, 'dictum\r\n eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, \r\nconsectetuer adipiscing', '', ''),
(23, 'ante', 'posuere@metusfacilisis.ca', 'LFJ46VCB8EW', 0, 1, 'elit, a \r\nfeugiat tellus lorem eu metus. In lorem. Donec elementum,', '', ''),
(24, 'vitae', 'sed@est.org', 'GUJ04RTY4SJ', 0, 1, 'sit amet \r\nmassa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, \r\nauctor non, feugiat nec,', '', ''),
(25, 'semper', 'urna.Nullam.lobortis@netusetmalesuada.edu', 'QNT46AAV7RC', 0, 1, 'neque\r\n tellus, imperdiet', '', ''),
(26, 'turpis.', 'ac.sem.ut@Etiam.com', 'VRC15ZNI0SY', 0, 1, 'placerat, \r\naugue. Sed molestie. Sed id risus quis diam', '', ''),
(27, 'purus,', 'amet.risus@a.edu', 'RDH68EPB7XW', 0, 0, 'massa', '', ''),
(28, 'neque', 'euismod.urna@posuere.com', 'QSS81DZJ2EB', 0, 1, 'adipiscing.\r\n Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor \r\nullamcorper, nisl arcu iaculis enim,', '', ''),
(29, 'lacinia', 'et@sitamet.edu', 'WEF81TFF0OV', 0, 1, 'euismod \r\net, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur \r\nconsequat, lectus sit amet', '', ''),
(30, 'facilisis', 'per.conubia.nostra@feugiattelluslorem.com', 'CHB39JSI5YE', 0, 1, 'sit\r\n amet', '', ''),
(31, 'id', 'Donec@Crasvulputatevelit.ca', 'QCQ55HUE1CH', 0, 1, 'consectetuer\r\n rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit.\r\n Pellentesque ultricies', '', ''),
(32, 'tellus.', 'penatibus.et@ipsum.ca', 'UMX63EUH0SX', 0, 1, 'magna. Ut\r\n tincidunt orci quis lectus. Nullam suscipit, est', '', ''),
(33, 'tellus', 'Etiam@etmagnisdis.edu', 'DMT49DEA4AU', 0, 0, 'pede. Cum \r\nsociis natoque penatibus et magnis dis parturient montes,', '', ''),
(34, 'eu', 'cursus@Aliquam.org', 'FHZ88EPP5RT', 0, 1, 'ut, \r\npharetra sed, hendrerit a,', '', ''),
(35, 'hendrerit', 'Fusce.feugiat@aliquet.ca', 'ZIH34OYO5MU', 0, 1, 'montes,\r\n nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo \r\nauctor', '', ''),
(36, 'justo.', 'lectus@purus.edu', 'CHH08QBX0WX', 0, 1, 'fermentum \r\nrisus, at fringilla purus', '', ''),
(37, 'blandit', 'Vivamus@eu.edu', 'ZBT66XYU7ZX', 0, 1, 'ornare \r\ntortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam \r\ntincidunt, nunc ac mattis ornare, lectus ante dictum', '', ''),
(38, 'nunc.', 'pede@volutpatnuncsit.org', 'IZZ16DNV7RU', 0, 1, 'convallis\r\n est, vitae sodales nisi magna sed dui. Fusce', '', ''),
(39, 'penatibus', 'mollis.vitae@Nulla.edu', 'EQC05DYN9RV', 0, 0, 'pede, \r\nmalesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer \r\nmauris id sapien. Cras dolor dolor, tempus non, lacinia at,', '', ''),
(40, 'Etiam', 'Sed.auctor@turpisvitae.edu', 'JOR88BBZ4FE', 0, 1, 'eu \r\ndui. Cum sociis natoque', '', ''),
(41, 'magna.', 'turpis@purusNullam.ca', 'KNZ02MMV6SF', 0, 1, 'Integer', '', ''),
(42, 'Fusce', 'ac@faucibusMorbivehicula.edu', 'ZOM69QUK5UU', 0, 0, 'pede,\r\n ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum \r\neget, volutpat ornare, facilisis eget,', '', ''),
(43, 'Cras', 'leo@purussapiengravida.com', 'BKJ18LFU7LU', 0, 0, 'torquent\r\n per conubia nostra, per inceptos hymenaeos. Mauris ut', '', ''),
(44, 'vestibulum.', 'blandit@dolor.com', 'CVG30OOY5XA', 0, 1, 'a \r\nultricies adipiscing,', '', ''),
(45, 'parturient', 'ridiculus.mus@insodales.com', 'RSY92EPI2BL', 0, 1, 'iaculis\r\n odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec\r\n nibh. Quisque nonummy', '', ''),
(46, 'egestas', 'id.erat@Classaptent.edu', 'LNE31NZO3MG', 0, 1, 'libero \r\nat auctor ullamcorper,', '', ''),
(47, 'tempor', 'venenatis.vel.faucibus@sodaleseliterat.edu', 'UCW89GXK5XV', 0, 1, 'lobortis\r\n risus. In', '', ''),
(48, 'diam', 'dictum@orciquislectus.edu', 'YZE25YWI7YD', 0, 0, 'amet,', '', ''),
(49, 'accumsan', 'aliquet.vel.vulputate@acmi.ca', 'OXD75GOM8OK', 0, 0, 'malesuada\r\n fringilla est. Mauris eu turpis. Nulla aliquet. Proin velit. Sed \r\nmalesuada augue ut', '', ''),
(50, 'magna', 'faucibus.orci@nibhsit.ca', 'GHW03TFX5EM', 0, 1, 'sapien, \r\ngravida non, sollicitudin a, malesuada', '', ''),
(51, 'Praesent', 'sit.amet.orci@placeratvelit.ca', 'FDO68CIG5EM', 0, 1, 'eget\r\n lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum', '', ''),
(52, 'Integer', 'consequat.dolor.vitae@pedeet.org', 'WFW87RJD0GI', 0, 0, 'Duis\r\n at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada \r\nid, erat. Etiam vestibulum massa rutrum magna. Cras', '', ''),
(53, 'Cras', 'at@antelectus.org', 'KNF63XTR8IO', 0, 1, 'ac metus \r\nvitae velit egestas lacinia. Sed congue, elit', '', ''),
(54, 'nulla.', 'cursus.et.eros@morbitristiquesenectus.edu', 'DXD18KKJ8CT', 0, 1, 'auctor\r\n velit. Aliquam nisl. Nulla eu neque pellentesque', '', ''),
(55, 'luctus', 'Nulla@dui.ca', 'BRJ85ERM2WQ', 0, 1, 'ullamcorper \r\neu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, \r\npharetra sed, hendrerit a,', '', ''),
(56, 'orci,', 'ligula@vel.edu', 'RPM38PTY0SA', 0, 1, 'risus. \r\nDonec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci\r\n tincidunt adipiscing. Mauris molestie', '', ''),
(57, 'lorem', 'facilisis.lorem@fringillaest.com', 'QKD58IXE5ZV', 0, 1, 'scelerisque\r\n mollis. Phasellus libero mauris,', '', ''),
(58, 'arcu', 'euismod.in.dolor@parturient.ca', 'VTV19IWM7GC', 0, 1, 'Aliquam\r\n gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet nec, \r\nimperdiet nec,', '', ''),
(59, 'orci', 'semper.Nam@Nullam.ca', 'MBF50ENF8NA', 0, 1, 'metus \r\nurna convallis erat,', '', ''),
(60, 'eget', 'cursus@euarcu.edu', 'MSX44NPT1PG', 0, 0, 'ornare. \r\nIn faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec \r\negestas. Duis ac arcu. Nunc mauris.', '', ''),
(61, 'vitae,', 'tortor@eumetusIn.org', 'MER08SEE9KR', 0, 1, 'at \r\nsem molestie', '', ''),
(62, 'fringilla', 'risus.Nunc.ac@natoquepenatibuset.edu', 'DCY40HXY1KK', 0, 1, 'iaculis\r\n odio. Nam interdum enim non nisi. Aenean eget metus.', '', ''),
(63, 'luctus', 'sociosqu.ad.litora@Integertinciduntaliquam.ca', 'MKC62VOG1SK', 0, 0, 'lacinia\r\n vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. \r\nAliquam rutrum lorem ac risus. Morbi metus. Vivamus', '', ''),
(64, 'eu,', 'tincidunt.tempus.risus@vitae.org', 'IFD49VRT8PG', 0, 0, 'magna.\r\n Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo \r\nhendrerit. Donec porttitor tellus non magna. Nam', '', ''),
(65, 'sociis', 'purus.mauris@congueaaliquet.edu', 'YWA28TOW8FF', 0, 1, 'In\r\n nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit \r\namet', '', ''),
(66, 'tempor', 'tristique@commodo.edu', 'KPZ91KUU5ZS', 0, 1, 'posuere \r\nat, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum \r\nplacerat, augue. Sed molestie. Sed id risus quis diam', '', ''),
(67, 'nunc', 'ullamcorper.magna@aliquetPhasellus.com', 'TDY83FRK1TV', 0, 0, 'magna.\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam \r\nlaoreet, libero et tristique pellentesque, tellus', '', ''),
(68, 'mauris,', 'malesuada.Integer@ultriciesligulaNullam.com', 'EOG42UNY5VR', 0, 0, 'at,\r\n egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et', '', ''),
(69, 'leo.', 'convallis@Vestibulum.com', 'TQB57QCN1JR', 0, 0, 'amet, \r\nconsectetuer', '', ''),
(70, 'vehicula', 'et.nunc@Duiselementumdui.org', 'RFB72FEH1MB', 0, 0, 'gravida\r\n molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras \r\ndictum ultricies', '', ''),
(71, 'enim.', 'eget.metus.eu@Quisque.org', 'ZSU91KXC8MU', 0, 0, 'libero \r\nat auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare', '', ''),
(72, 'vitae', 'ligula.elit.pretium@enimMaurisquis.org', 'PRG18YED0WD', 0, 0, 'et,\r\n euismod et,', '', ''),
(73, 'et', 'Lorem@orciUtsagittis.ca', 'AAH37ZWP1NF', 0, 0, 'magnis dis \r\nparturient montes, nascetur ridiculus mus.', '', ''),
(74, 'Aliquam', 'aliquet.odio@faucibuslectusa.ca', 'MBA31AKB4EB', 0, 1, 'egestas\r\n rhoncus. Proin nisl sem, consequat nec, mollis', '', ''),
(75, 'auctor', 'lorem@ipsumSuspendisse.edu', 'KMK01XVX3TK', 0, 0, 'Quisque\r\n fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh \r\nvulputate mauris sagittis placerat. Cras', '', ''),
(76, 'semper', 'enim@ullamcorper.org', 'TVA92HVW0WH', 0, 1, 'dignissim \r\npharetra. Nam ac nulla. In tincidunt congue', '', ''),
(77, 'libero', 'tempus@Fuscediam.edu', 'WSW44AAS3RM', 0, 0, 'rutrum eu, \r\nultrices sit amet, risus. Donec nibh enim, gravida', '', ''),
(78, 'imperdiet', 'Nullam@consequat.org', 'OLB25HXC2YZ', 0, 0, 'placerat\r\n velit. Quisque varius. Nam porttitor scelerisque neque.', '', ''),
(79, 'lorem', 'nec.enim@Nunc.org', 'LTB97IJT5BH', 0, 1, 'nisl. \r\nQuisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu \r\nnibh', '', ''),
(80, 'molestie', 'non.massa@nequesed.org', 'NGY90IAH3PT', 0, 0, 'Donec \r\nelementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu \r\ntempor erat neque non', '', ''),
(81, 'mauris', 'mauris@eratSed.ca', 'KFL95XOE3DS', 0, 1, 'et \r\nmagnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna.\r\n Suspendisse tristique', '', ''),
(82, 'Integer', 'quis.pede@facilisiSedneque.org', 'XVK78MIH5FS', 0, 0, 'lorem,\r\n auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris \r\nnulla. Integer', '', ''),
(83, 'Nam', 'nunc@Proinvelarcu.com', 'NKW18MCQ7UO', 0, 1, 'vitae,\r\n erat. Vivamus nisi. Mauris nulla.', '', ''),
(84, 'aliquet', 'ante.blandit@scelerisque.com', 'BNA40FZA5GN', 0, 1, 'vitae\r\n risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque\r\n imperdiet,', '', ''),
(85, 'non', 'Mauris.vestibulum.neque@Nam.ca', 'WUH24XXU7HW', 0, 1, 'urna.\r\n Vivamus molestie dapibus ligula. Aliquam', '', ''),
(86, 'penatibus', 'Nam@Cum.ca', 'BQO82IHO9GL', 0, 0, 'nonummy ut,\r\n molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla \r\nfacilisi.', '', ''),
(87, 'Mauris', 'ipsum.dolor@commodo.ca', 'MFD87KGU9DV', 0, 0, 'venenatis\r\n a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \r\nEtiam laoreet, libero', '', ''),
(88, 'lobortis', 'dignissim.lacus.Aliquam@cursusNuncmauris.ca', 'RSM81CWI0SU', 0, 0, 'libero.\r\n Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet \r\nluctus vulputate, nisi sem', '', ''),
(89, 'Phasellus', 'ridiculus.mus.Donec@et.org', 'STE48CVU2QL', 0, 1, 'est,\r\n mollis non, cursus non, egestas a,', '', ''),
(90, 'posuere', 'lectus@at.edu', 'LSX39UAC8NV', 0, 0, 'faucibus \r\nlectus, a sollicitudin orci sem', '', ''),
(91, 'Etiam', 'id@diam.org', 'BWY11DPI0VU', 0, 0, 'quis arcu', '', ''),
(92, 'nec', 'Sed@urnaconvallis.org', 'YHY30BNE8DF', 0, 1, 'ornare, elit \r\nelit fermentum risus, at fringilla purus', '', ''),
(93, 'fermentum', 'enim.Mauris.quis@interdum.ca', 'AMA79DOH7EG', 0, 1, 'vitae\r\n nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim.', '', ''),
(94, 'vitae', 'amet@ametdiameu.org', 'RIW45VQU5OV', 0, 0, 'id, \r\nerat. Etiam vestibulum massa rutrum magna. Cras convallis convallis \r\ndolor.', '', ''),
(95, 'lacinia', 'sollicitudin@luctuslobortis.org', 'MJD65FYM4LD', 0, 1, 'odio\r\n tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. \r\nNullam velit dui,', '', ''),
(96, 'mollis', 'est@pedeCrasvulputate.ca', 'UKM80ODO8RB', 0, 0, 'orci, \r\nconsectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi \r\nquis urna.', '', ''),
(97, 'Fusce', 'lorem.semper@scelerisquemollis.com', 'HJZ65GTG0SA', 0, 1, 'Nullam\r\n enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo.\r\n Praesent luctus. Curabitur egestas nunc', '', ''),
(98, 'odio.', 'nisi.Aenean.eget@nasceturridiculus.edu', 'ULV44KSA4BH', 0, 1, 'semper\r\n et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim \r\nlacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus', '', ''),
(99, 'quam', 'et.magna.Praesent@faucibus.org', 'UPL33KKZ0NU', 0, 1, 'tincidunt\r\n vehicula risus. Nulla eget metus', '', ''),
(100, 'dolor.', 'tincidunt.vehicula.risus@magna.com', 'BBG43YAQ3QK', 0, 1, 'Proin\r\n vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula \r\nconsectetuer rhoncus. Nullam', '', ''),
(111, 'Pouet', 'pouet@pouet', 'pouet', 1, 0, 'No description', '', ''),
(112, 'Toto', 'toto@toto', 'toto', 0, 0, 'No description', '', ''),
(113, 'a', 'a@a', 'a', 0, 1, 'Coucou, je m''appelle "A" !', '', 'www.a.fr'),
(114, 'coucou', 'coucou@coucou', 'coucou', 1, 0, 'je suis coucou', '', 'www.google.com'),
(115, 'Tata', 'tata@tata', 'tata', 1, 0, 'No description', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Update`
--

CREATE TABLE IF NOT EXISTS `Update` (
  `idUpdate` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `service` varchar(128) NOT NULL,
  `idMember` int(11) NOT NULL,
  PRIMARY KEY (`idUpdate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `Update`
--

INSERT INTO `Update` (`idUpdate`, `content`, `date`, `service`, `idMember`) VALUES
(1, 'mollis nec, cursus a, enim.', '0000-00-00', 'flickr', 34),
(2, 'egestas. Aliquam', '0000-00-00', 'gmap', 7),
(3, 'euismod urna. Nullam lobortis quam a felis \r\nullamcorper', '0000-00-00', 'gmap', 20),
(4, 'semper \r\ncursus. Integer mollis. Integer', '0000-00-00', 'youtube', 25),
(5, 'venenatis lacus. Etiam bibendum fermentum metus. Aenean \r\nsed', '0000-00-00', 'flickr', 50),
(6, 'tellus lorem', '0000-00-00', 'gmap', 29),
(7, 'commodo auctor velit.', '0000-00-00', 'youtube', 13),
(8, 'nisi nibh lacinia orci,', '0000-00-00', 'flickr', 5),
(9, 'eleifend nec, malesuada ut, sem.', '0000-00-00', 'youtube', 10),
(10, 'Nam tempor diam dictum sapien. Aenean massa. Integer \r\nvitae', '0000-00-00', 'gmap', 44),
(11, 'a, \r\nmalesuada id, erat. Etiam vestibulum massa \r\nrutrum', '0000-00-00', 'flickr', 22),
(12, 'Vivamus\r\n nisi. Mauris nulla. Integer urna.', '0000-00-00', 'gmap', 29),
(13, 'primis in faucibus orci luctus et ultrices posuere \r\ncubilia', '0000-00-00', 'flickr', 17),
(14, 'lectus \r\nante dictum mi, ac mattis', '0000-00-00', 'flickr', 17),
(15, 'vitae, sodales', '0000-00-00', 'youtube', 50),
(16, 'Aliquam erat volutpat. Nulla dignissim. Maecenas ornare \r\negestas', '0000-00-00', 'flickr', 32),
(17, 'et \r\nultrices posuere cubilia Curae; Donec tincidunt. Donec vitae \r\nerat', '0000-00-00', 'youtube', 50),
(18, 'lacus.', '0000-00-00', 'flickr', 24),
(19, 'vel, vulputate eu, odio. Phasellus at augue id ante \r\ndictum', '0000-00-00', 'gmap', 36),
(20, 'dis \r\nparturient montes, nascetur ridiculus \r\nmus.', '0000-00-00', 'youtube', 28),
(21, 'vel \r\nlectus. Cum sociis natoque penatibus et magnis dis \r\nparturient', '0000-00-00', 'gmap', 12),
(22, 'Mauris \r\nvel turpis. Aliquam adipiscing lobortis risus. In \r\nmi', '0000-00-00', 'flickr', 9),
(23, 'sit \r\namet, consectetuer', '0000-00-00', 'youtube', 25),
(24, 'dolor. Fusce feugiat. Lorem ipsum dolor sit amet, \r\nconsectetuer', '0000-00-00', 'flickr', 17),
(25, 'dictum \r\neu, eleifend nec, malesuada ut, sem. Nulla interdum. \r\nCurabitur', '0000-00-00', 'flickr', 18),
(26, 'in \r\naliquet lobortis,', '0000-00-00', 'flickr', 14),
(27, 'lorem \r\nut aliquam iaculis, lacus pede', '0000-00-00', 'gmap', 17),
(28, 'dignissim lacus.', '0000-00-00', 'youtube', 18),
(29, 'semper rutrum. Fusce dolor quam, elementum at, \r\negestas', '0000-00-00', 'youtube', 48),
(30, 'Donec \r\nnibh enim, gravida sit amet, dapibus id, \r\nblandit', '0000-00-00', 'gmap', 39),
(31, 'Duis mi\r\n enim,', '0000-00-00', 'youtube', 25),
(32, 'amet, \r\nconsectetuer adipiscing elit.', '0000-00-00', 'gmap', 43),
(33, 'velit justo nec ante. Maecenas', '0000-00-00', 'gmap', 21),
(34, 'ipsum', '0000-00-00', 'youtube', 18),
(35, 'lobortis. Class', '0000-00-00', 'flickr', 44),
(36, 'tempus risus. Donec egestas.', '0000-00-00', 'flickr', 31),
(37, 'magnis dis', '0000-00-00', 'gmap', 15),
(38, 'libero. Integer in magna. \r\nPhasellus', '0000-00-00', 'flickr', 39),
(39, 'sed, \r\nsapien.', '0000-00-00', 'youtube', 22),
(40, 'habitant', '0000-00-00', 'youtube', 20),
(41, 'Suspendisse dui. Fusce diam', '0000-00-00', 'youtube', 20),
(42, 'mollis. Phasellus libero mauris, aliquam \r\neu,', '0000-00-00', 'youtube', 16),
(43, 'aliquet magna a', '0000-00-00', 'gmap', 9),
(44, 'venenatis vel,', '0000-00-00', 'flickr', 12),
(45, 'mus. Proin vel nisl.', '0000-00-00', 'gmap', 18),
(46, 'gravida. Praesent eu nulla at sem \r\nmolestie', '0000-00-00', 'flickr', 1),
(47, 'ac \r\nurna. Ut tincidunt vehicula risus.', '0000-00-00', 'gmap', 38),
(48, 'ipsum dolor sit amet,', '0000-00-00', 'gmap', 35),
(49, 'ipsum. Donec', '0000-00-00', 'youtube', 27),
(50, 'aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus \r\ndapibus quam', '0000-00-00', 'flickr', 23),
(51, 'sem \r\nsemper erat, in', '0000-00-00', 'youtube', 49),
(52, 'Morbi \r\nmetus. Vivamus euismod', '0000-00-00', 'flickr', 3),
(53, 'erat. Sed', '0000-00-00', 'gmap', 18),
(54, 'odio a purus. Duis elementum, dui quis accumsan \r\nconvallis,', '0000-00-00', 'flickr', 25),
(55, 'metus \r\nvitae velit egestas lacinia. Sed congue, elit \r\nsed', '0000-00-00', 'youtube', 35),
(56, 'nisi \r\ndictum augue malesuada', '0000-00-00', 'youtube', 6),
(57, 'varius et,', '0000-00-00', 'gmap', 28),
(58, 'purus, in molestie tortor nibh sit amet orci. Ut \r\nsagittis', '0000-00-00', 'gmap', 50),
(59, 'mollis.\r\n Duis sit amet diam eu dolor egestas rhoncus. \r\nProin', '0000-00-00', 'gmap', 17),
(60, 'quam. \r\nPellentesque habitant morbi tristique', '0000-00-00', 'youtube', 25),
(61, 'dolor elit, pellentesque', '0000-00-00', 'gmap', 2),
(62, 'dictum eleifend, nunc risus varius orci, in consequat enim \r\ndiam', '0000-00-00', 'youtube', 47),
(63, 'iaculis, lacus pede sagittis augue, eu \r\ntempor', '0000-00-00', 'youtube', 50),
(64, 'ante \r\nblandit viverra. Donec', '0000-00-00', 'flickr', 39),
(65, 'ipsum primis in faucibus orci', '0000-00-00', 'youtube', 13),
(66, 'nisl elementum purus, accumsan', '0000-00-00', 'gmap', 29),
(67, 'massa. Suspendisse eleifend. Cras sed \r\nleo.', '0000-00-00', 'youtube', 26),
(68, 'Nunc', '0000-00-00', 'youtube', 19),
(69, 'enim, sit amet ornare lectus justo eu arcu. \r\nMorbi', '0000-00-00', 'flickr', 50),
(70, 'ultrices iaculis odio.', '0000-00-00', 'youtube', 19),
(71, 'Suspendisse aliquet, sem ut cursus', '0000-00-00', 'flickr', 35),
(72, 'pede blandit congue. In scelerisque scelerisque dui. Suspendisse\r\n ac', '0000-00-00', 'youtube', 44),
(73, 'Suspendisse sed dolor.', '0000-00-00', 'gmap', 15),
(74, 'arcu. Morbi sit amet massa. Quisque porttitor \r\neros', '0000-00-00', 'flickr', 46),
(75, 'Etiam \r\nimperdiet dictum magna.', '0000-00-00', 'flickr', 15),
(76, 'tellus sem', '0000-00-00', 'youtube', 24),
(77, 'augue. Sed molestie. Sed id risus quis \r\ndiam', '0000-00-00', 'flickr', 34),
(78, 'sodales. Mauris blandit enim', '0000-00-00', 'flickr', 5),
(79, 'tincidunt adipiscing. Mauris', '0000-00-00', 'youtube', 28),
(80, 'Proin vel arcu eu odio tristique pharetra. Quisque \r\nac', '0000-00-00', 'youtube', 3),
(81, 'mauris.\r\n Morbi non sapien molestie orci tincidunt \r\nadipiscing.', '0000-00-00', 'youtube', 44),
(82, 'odio. \r\nPhasellus at augue id ante dictum cursus. Nunc \r\nmauris', '0000-00-00', 'flickr', 1),
(83, 'Phasellus dapibus', '0000-00-00', 'flickr', 20),
(84, 'senectus et netus et malesuada fames ac turpis egestas. \r\nFusce', '0000-00-00', 'flickr', 4),
(85, 'tellus \r\njusto sit amet nulla. Donec non', '0000-00-00', 'flickr', 8),
(86, 'odio sagittis semper. Nam tempor diam dictum sapien. Aenean \r\nmassa.', '0000-00-00', 'youtube', 2),
(87, 'sed \r\nlibero. Proin sed turpis nec', '0000-00-00', 'gmap', 27),
(88, 'lorem vitae', '0000-00-00', 'youtube', 23),
(89, 'mauris ut mi. Duis risus odio, auctor \r\nvitae,', '0000-00-00', 'youtube', 37),
(90, 'ac \r\nmattis velit justo nec ante. Maecenas mi \r\nfelis,', '0000-00-00', 'gmap', 14),
(91, 'nibh. \r\nQuisque nonummy ipsum non arcu. Vivamus sit \r\namet', '0000-00-00', 'gmap', 17),
(92, 'cursus', '0000-00-00', 'youtube', 47),
(93, 'aliquet magna a neque. Nullam', '0000-00-00', 'youtube', 13),
(94, 'dolor', '0000-00-00', 'youtube', 43),
(95, 'risus varius orci, in consequat enim diam vel \r\narcu.', '0000-00-00', 'gmap', 22),
(96, 'Curae; \r\nPhasellus ornare. Fusce mollis. Duis', '0000-00-00', 'flickr', 35),
(97, 'Curabitur dictum. Phasellus in felis. Nulla \r\ntempor', '0000-00-00', 'youtube', 21),
(98, 'luctus.\r\n Curabitur', '0000-00-00', 'youtube', 4),
(99, 'morbi \r\ntristique senectus et netus', '0000-00-00', 'flickr', 44),
(100, 'feugiat non, lobortis quis, pede.', '0000-00-00', 'youtube', 33);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
