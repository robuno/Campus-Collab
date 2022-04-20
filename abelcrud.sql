-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Nis 2022, 23:19:30
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `abelcrud`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) UNSIGNED NOT NULL,
  `annowner` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `posttext` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `announcements`
--

INSERT INTO `announcements` (`id`, `annowner`, `posttext`, `date`) VALUES
(2, 'Seda', 'announce1', '0000-00-00'),
(22, 'Cedi', 'mentorszannounce2', '0124-05-12'),
(23, 'Sinem', 'announce13', '0023-05-12'),
(24, 'Ömer', 'announce14', '0124-05-12'),
(25, 'Selin', 'announce1415', '0012-05-12'),
(26, 'Ahmet', 'announce112', '2124-05-12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `postowner` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `posttext` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `mentorinfo` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `maxparticipants` int(11) NOT NULL,
  `posttype` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `coursecode` varchar(20) NOT NULL,
  `studentbranch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `postowner`, `posttext`, `date`, `mentorinfo`, `location`, `maxparticipants`, `posttype`, `coursecode`, `studentbranch`) VALUES
(2, 'Unat', 'aabababababab', '2022-05-13', 'yes', 'D Blok', 0, 'studymeeting', 'CE356', ''),
(22, 'James', 'mentorsz', '2022-05-12', 'without mentor', 'xDBlok', 1252, 'studymeeting', 'EL202', ''),
(23, 'Cedi', 'dededededede', '2022-05-12', 'with mentor', 'axDBlok', 2, 'studymeeting', 'CE244', ''),
(24, 'Furkan', 'afasdf', '2022-05-12', 'without mentor', 'qxDBlok', 555, 'studymeeting', 'KHAS100', ''),
(25, 'Ayse', 'mentorluyeniii', '2022-05-12', 'with mentor', 'xDBlok', 12521, 'studymeeting', '', ''),
(26, 'Ahmet', 'treterterter', '2022-05-12', 'without mentor', 'B Blok', 25, 'studentbranch', '', ''),
(27, 'Sule', 'qwrqwrqwrqr', '2022-04-12', 'with mentor', 'asdfa', 126125, 'studymeeting', 'IE412', ''),
(28, 'Sude', 'asgasd', '2022-12-15', 'with mentor', 'xvsfgfdC Blok', 621, 'studentbranch', '', ''),
(30, 'Humeyra', '33333333333333', '2022-12-15', 'without mentor', 'T Blok', 23, 'studentbranch', '', '7'),
(34, 'Margot', 'Bu bir ders calisma etkinligidir.', '2022-02-24', 'without mentor', 'Block B', 25, '', 'CE244', ''),
(35, 'Margot', 'dersss', '2022-02-24', 'with mentor', 'b', 24, '', 'CE244', ''),
(36, 'James', 'kulüp', '2022-04-22', 'without mentor', 'd', 252, '', '', '5'),
(39, 'Kadir', 'zxzcvzcxv', '2022-03-12', 'without mentor', 'blok b', 464, '', 'CE344', ''),
(43, 'Albert Camus', 'textextetxet', '2022-02-04', 'without mentor', 'A Blok', 77, '', '', '2'),
(45, 'Marie Curie', 'law meeting', '2022-02-24', 'without mentor', 'Starbucks', 2525, '', '', '7'),
(49, 'Marie Curie', 'qwerqwer', '2022-02-24', 'without mentor', 'F Blok', 25, '', '', '5'),
(50, 'Marie Curie', 'branch meeting', '2022-02-22', 'with mentor', 'X Blok', 5, '', '', '4');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `studentclubs`
--

CREATE TABLE `studentclubs` (
  `id` int(11) NOT NULL,
  `clubname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `studentclubs`
--

INSERT INTO `studentclubs` (`id`, `clubname`) VALUES
(1, ''),
(2, 'IEEE'),
(3, 'Dance Club'),
(4, 'Engineering Society'),
(5, 'Photography Club'),
(6, 'Sinehas'),
(7, 'Ataturkist Youth Club'),
(8, 'HasHasPati'),
(9, 'Law Society');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password2` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `mail`, `password2`, `firstName`, `lastName`) VALUES
(1, 'admin', '123', 'Albert', 'Camus'),
(2, 'harry', '456', 'Harry', 'Potter');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `studentclubs`
--
ALTER TABLE `studentclubs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Tablo için AUTO_INCREMENT değeri `studentclubs`
--
ALTER TABLE `studentclubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
