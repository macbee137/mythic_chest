-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jan 2024 um 08:06
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `gojoshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `PID` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` text NOT NULL,
  `serialnumber` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_details` varchar(500) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `last_changed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`PID`, `product_name`, `price`, `serialnumber`, `product_category`, `product_details`, `product_image`, `last_changed`) VALUES
(1, 'Death Note', '2.000.000', 'DNB_294759375467', 'Item', 'The Human whose name is written in this note shall die. This note will not take effect unless the writer has the subject\'s face in mind when writing his/her name. This is to prevent people who share the same name from being affected.', '..\\public\\imgs\\deathnote.jpg', '2023-12-21 10:53:04'),
(2, 'ARMS .454 Casull Auto', '500.000', 'HAC_194893094283', 'Fire Arm', 'The Casull is a semi-automatic magnum pistol, based on two pre-WW1 handgun designs by Colt: the M1903 and M1905 pistols (the early versions of the M1911). The gun weighs approximately 6 kg unloaded and has a magazine capacity of six.', '..\\public\\imgs\\hellsing.webp', '2023-12-20 09:17:51'),
(3, 'Sword Of Kusanagi ', '25.000.000', 'SOK_194370976290', 'Combat Weapon', 'According to Shinto priest Matsuoka Masanao, who actually saw the sword somewhere during the Edo Period (1603 – 1868), Kusanagi is about 82 cm long and the blade looks like a calamus leaf. The middle of the sword has a thickness from the grip of about 18 cm with an appearance of a fish spine.', '..\\public\\imgs\\kusanagi-schwert-schwarz.jpg', '2023-12-20 09:20:45'),
(4, 'Inverted Spear of Heaven', '850.000', 'ISH_483961329435', 'Combat Weapon', 'The Inverted Spear of Heaven is a dagger with a jitte-shaped blade. It has a «q» shaped circular hand guard that points out on the side of the longer blade. Additionally, the weapon has a black handle with a circular link at the end that allows it to be connected to metal chains.', '..\\public\\imgs\\Spear-of-Heaven-t.webp', '2024-01-08 08:04:43'),
(5, 'Playful Cloud', '450.000', 'PCJ_234096784932', 'Combat Weapon', 'First shown in possession by Suguru Geto during his attack on Jujutsu high, Playful Cloud is an extremely powerful weapon that allowed the curse user to fight on equal terms against an enraged Yuta Okkotsu. After a heated clash between the two, Suguru lost possession of Playful Cloud after being struck by Yuta.', '..\\public\\imgs\\playful.jpg', '2023-12-20 09:30:22'),
(6, 'Split Soul Katana', '30.000.000', 'SSK_234566690023', 'Combat Weapon', 'The Split Soul Katana ignores all physical toughness to cut through the hardest substances and strike directly at the soul of its target. Its full power can only be unleashed by those with eyes that can see the souls of inorganic objects. It is a highly valuable cursed tool worth five hundred million yen.', '..\\public\\imgs\\spli-soul.png', '2023-12-20 09:38:26'),
(7, 'Nanami’s Sword', '5.000.000', 'NNS_1230948678932', 'Combat Weapon', 'Nanami\'s primary weapon is a short blunt sword with a wooden handle and a blade wrapped in a cloth with a splattered black dot design. Maki\'s wields a new polearm during the Goodwill Event. The blade is a cursed tool but the handle is a normal staff hilt.', '..\\public\\imgs\\nanami-sword_.jpg', '2023-12-20 09:42:39'),
(8, 'Tessaiga', '2.500.000', 'INU_345223409834', 'Combat Weapon', 'Tessaiga, also spelled Tetsusaiga, is a powerful yōkai sword wielded by the inu-hanyō Inuyasha during the main story. Originally owned by his father who had instructed Tōtōsai to forge this sword by using one of his own fangs as material for the sword\'s blade. Out of the two blades, Tessaiga was \"the sword of destruction\" with an ability said to \"kill a hundred demons in a single stroke\".', '..\\public\\imgs\\Tessaiga_Sword.jpg', '2023-12-20 09:45:28'),
(9, 'Samehada', '45.000.000', 'SMH_345611290084', 'Combat Weapon', 'Samehada is unique for being a sentient weapon that gains nourishment from the chakra of others and, as such, the blade is at its happiest when engorged with chakra that possesses both a distinctive and pleasant flavour. It apparently greatly enjoys Killer B\'s chakra since, according to Kisame, it tastes like octopus.', '..\\public\\imgs\\samehada.png', '2023-12-20 10:05:44'),
(10, 'Yoru', '15.000.000', 'YOR_398764539823', 'Combat Weapon', 'A Western-looking sword, Yoru is a cruciform and well-ornated weapon with a curved, single-edged, black blade—resembling an oversized kriegsmesser. It has a total length of well over two meters, being over a head taller than Mihawk (who stands at 198 cm) when placed on his back.', '..\\public\\imgs\\yoru.png', '2023-12-20 11:31:37'),
(11, 'ARMS 13mm Anti-Freak Combat Pistol: Jackal', '500.000', 'HAC_194893094284', 'Fire Arm', 'The Jackal fires a huge, armor-piercing, 13mm explosive rounds. The rounds are jacketed with a \\\"casing\\\" of blessed Macedonian silver and feature an explosive tip containing a charge of pre-blessed mercury. However, the 13mm round\\\'s size limits the Jackal\\\'s magazine capacity to six rounds.', '..\\public\\imgs\\hellsing-jackalp.webp', '2023-12-21 11:00:59'),
(12, 'Nyoibō', '7.000.000', 'DBN_777342349844', 'Combat Weapon', 'The Power Pole (如意棒, Nyoibō, lit. \"Compliant Pole\", or more correctly \"Staff That Obeys One\'s Will\") is a magical, length-changing staff that is owned and wielded by Goku for most of the original Dragon Ball series.', '..\\public\\imgs\\Nyoibo.webp', '2023-12-20 11:54:52'),
(13, 'Gomu Gomu no Mi', '100.000.000', 'MDR_234765432198', 'Devilfruit', 'The Gomu Gomu no Mi which is also referred to as “Hito Hito Model: Nika” It is a Mythical Zoan-type Devil Fruit that enablhes the user\\\\\\\'s body to stretch, making the user a rubber Human (ゴム人間 Gomu Ningen). \\\\\\\"Gomu\\\\\\\" means \\\\\\\"Gum\\\\\\\" in Japanese.', '..\\public\\imgs\\GomuGomu.jpg', '2023-12-21 10:54:44'),
(14, 'Ope Ope no Mi', '100.000.000', 'TLD_112233789100', 'Devilfruit', 'The Ope Ope no Mi is a Paramecia-type Devil Fruit that grants the ability to create a spherical forcefield wherein the user can freely rearrange, take apart (without harm), and generally remodel the structure/anatomy of anything and anyone (themself included) in a \\\"surgical\\\" way', '..\\public\\imgs\\BeautyPassOpeOpe.jpg', '2023-12-21 11:06:44'),
(15, 'Senzu Beans 25 Stk.', '500.000', 'SZB_445566330981', 'Heal and Nutrition', 'Senzu Beans not only recoup a fighter\'s strength, but they also help them recover from incredibly traumatic injuries. These magical beans are grown by a talking cat of all things and have been vital in keeping Goku and his friends alive long enough to take down their toughest opponents.', '..\\public\\imgs\\senzu-beans-explained-dbz.webp\r\n', '2023-12-21 08:47:29');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(50) NOT NULL,
  `UUID` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `birthday` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pfp` varchar(255) NOT NULL,
  `joined_at` date NOT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `UUID`, `username`, `firstname`, `lastname`, `email`, `password`, `gender`, `birthday`, `street`, `postcode`, `country`, `pfp`, `joined_at`, `role`) VALUES
(1, '657f0ba4073b0', 'admin', 'admin', 'admin', 'admin@shop.at', '$2y$10$JmFWP0BO5VK5JNZgfKvUUu47IifVC5cQEe1cxn1PmvU9RP7cWE9N6', 'Male', '1992-02-08', 'adminstreet', '8904', 'Austria', '', '0000-00-00', 1),
(2, '657e450fa24e2', 'shroud', 'johann', 'schraudinger', 'shroud@inger.at', '$2y$10$hm5I7VU8MluaeMG6KWjteecqYPrWM0W0lwO1WD5nGiNfKIj83neg.', 'Male', '2000-07-05', 'aimstreet', '9000', 'Canada', '', '0000-00-00', 2),
(4, '657f28dc11bdb', 'ninscha', 'nina', 'bloodartist', 'nina@blood.at', '$2y$10$nM3/wE64y7Pd.R1otzw1DeJ99ARu8HbKV1i8thF0secp6t.woMXDC', 'Female', '2002-05-26', 'Schmiedeweg', '8940', 'Liezen', '', '2023-12-17', 2),
(6, '658147d821b7a', 'snowfakes', 'luki', 'spitzer', 'luki@snow.at', '$2y$10$n24JMBxFrt9k4.LJOxKVOe/bgrE/Ez3EX2hpvdEuMCKd6pyFm6RUG', 'Male', '2001-01-01', 'Bakerstreet', '69420', 'Neverland', '', '2023-12-19', 2),
(7, '6581485639871', 'michl', 'michi', 'koller', 'michi@backinhell.at', '$2y$10$4gTca74hsP6vGNviJVfzke3VLjAcqXLEoh7N/SwtNRZw/M7oN33y2', 'Male', '1999-03-02', 'Feldbachstrasse', '8090', 'Austria', '', '2023-12-19', 2),
(8, '658148c596469', 'butters', 'marcel', 'muellner', 'butter@scotch.com', '$2y$10$WhfxyC1mpoKcaipbcoZgY.fYoxQHhYE80wt0lIAT1k8U9k.Bofkmm', 'Divers', '2012-11-10', 'Poststreet', '4567', 'Castleland', '', '2023-12-19', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `PID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
