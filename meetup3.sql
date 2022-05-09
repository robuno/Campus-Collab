-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2022, 11:59:45
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
-- Veritabanı: `meetup3`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) UNSIGNED NOT NULL,
  `annowner` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `annownerid` int(11) NOT NULL,
  `posttext` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `announcements`
--

INSERT INTO `announcements` (`id`, `annowner`, `annownerid`, `posttext`, `date`) VALUES
(37, 'Albert Camus', 1, 'I lost my ID. Let me know that if you find my ID or please give it security. My id is 20171709099', '2022-04-20'),
(38, 'Harry Potter', 2, 'Can you please fill my PS327 course survey for my final project? Link is here: https://strawpoll.com/polls/GPgV3GV2EZa', '2022-06-22'),
(39, 'Albert Camus', 17, 'Can you please fill my EE414 course survey for my final project? Link is here: https://strawpoll.com/polls/GPgV3GV2EZa', '2022-05-05');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `attendings`
--

CREATE TABLE `attendings` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `attendings`
--

INSERT INTO `attendings` (`id`, `postid`, `userid`) VALUES
(43, 53, 16),
(44, 70, 20),
(45, 68, 20),
(46, 53, 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `postid`, `userid`) VALUES
(14, 53, 16);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `commentownerid` int(11) NOT NULL,
  `commenttext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `postid`, `commentownerid`, `commenttext`) VALUES
(34, 70, 18, 'I am not a member but i want to join, may I ?'),
(35, 70, 13, 'Yes Sena, we can create a membership for you.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `postowner` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `postownerid` int(11) NOT NULL,
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

INSERT INTO `posts` (`id`, `postowner`, `postownerid`, `posttext`, `date`, `mentorinfo`, `location`, `maxparticipants`, `posttype`, `coursecode`, `studentbranch`) VALUES
(53, 'Şule Soylu', 3, 'I want to talk about founding a new student club for developers. Let me know if you are interested in!', '2022-04-11', 'with mentor', 'Simitçi', 12, '', '', '2'),
(60, 'Harry Potter', 2, 'adsfasd', '2022-02-22', 'without mentor', 'd', 25, '', 'EE232', ''),
(62, 'Unat Tekşen', 4, 'bu benim ilk postum', '2022-05-22', 'without mentor', 'T', 56, '', 'CE356', ''),
(68, 'Furkan Korkmaz', 13, 'sdfasdfasf', '2022-05-12', 'with mentor', 'Sinema Salonu', 20, '', '', '3'),
(70, 'Furkan Korkmaz', 13, 'I\'m planning to organize an event to meet with new members in our club! I need support to organize. Please join us and discuss what we can do!', '2022-05-19', 'without mentor', 'Block C First Floor', 15, '', '', '8');

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
  `department` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `spotifyLink` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `personalWeb` varchar(255) NOT NULL,
  `instaLink` varchar(255) NOT NULL,
  `twitterLink` varchar(255) NOT NULL,
  `linkedinLink` varchar(255) NOT NULL,
  `githubLink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `mail`, `password2`, `department`, `firstName`, `lastName`, `image_url`, `spotifyLink`, `bio`, `personalWeb`, `instaLink`, `twitterLink`, `linkedinLink`, `githubLink`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Computer Engineering', 'Humeyra', 'Dogus', 'IMG-626a45a3d259e5.63080660.jpg', 'www.spotify.com', 'A raven34 is any of several larger-bodied bird species of the genus Corvus. These species do not form a single taxonomic group within the genus. There is no consistent distinction between \"crows\" and \"ravens\", and these appellations have been assigned to different species chiefly on the basis of their size.  The largest raven species are the common raven and the thick-billed raven. ', 'www.apple.com', 'www.instagram.com/uni', 'www.twitter.com/ssg', 'www.linkedin.com/unatteksen', 'www.google.com'),
(2, 'harry', '202cb962ac59075b964b07152d234b70', 'Industrial Engineering', 'Melek', 'Keskiner', 'IMG-6267190ab75411.61682716.jpg', '', 'Gözlerin gözlerime değince felaketim olurdu\r\n-melek', 'www.google.com', '', '', '', 'www.google.com'),
(3, 'sulesoylu@stu.khas.edu.tr', '202cb962ac59075b964b07152d234b70', 'Computer Engineering', 'Ahmet', 'Caner', '', '', 'QQQQQQQQQQQQQQQQQQQQQQQQQQQ', '', '', '', '', ''),
(4, 'unat@stu.khas.edu.tr', '202cb962ac59075b964b07152d234b70', 'Computer Engineering', 'Unat', 'Tekşen', 'IMG-62671d6b20cb82.61238072.jpg', '', 'TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT', '', '', '', '', ''),
(11, 'cedi@stu.khas.edu.tr', '202cb962ac59075b964b07152d234b70', 'Industrial Engineering', 'Cedi', 'Osman', '', '', '', '', '', '', '', ''),
(13, 'furk@stu.khas.edu.tr', '37693cfc748049e45d87b8c7d8b9aacd', 'Radio, Television and Cinema', 'Furkan', 'Korkmaz', 'IMG-626d8394968418.34513239.jpg', 'www.spotify.com', 'phila 76ers', 'www.google.com', 'www.amazon.com', 'www.youtube.com', 'www.linkedin.com', 'www.google.com'),
(14, '20171706027@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Electrical Electronics Engineering', 'Sule', 'Soylu', 'IMG-62763bc737cc15.30213214.jpg', 'https://open.spotify.com/user/11183555046', 'I am a senior in Kadir Has University Electrical Electronics and Computer Engineering. For about a year, I have been involved in a project on the classification and diagnosis of ECG signals based on machine learning. I have good communication skills and able to easily adapt to new environments.', '', 'https://www.instagram.com/schule_s/', '', 'https://www.linkedin.com/in/sulesoylu/', 'https://github.com/SuleS1'),
(15, '20171706022@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Electrical Electronics Engineering', 'Ali Onur', 'Askın', '', '', '', '', '', '', '', ''),
(16, '20181706022@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Electrical Electronics Engineering', 'Hüseyin', 'Aydogan', 'IMG-6276412c134cf0.23493134.jpg', '', 'Hi. I am Hüseyin. My senior year. My area of interest is 5G. I can easily adapt to any environment. ', '', 'https://www.instagram.com/itzhba/', '', 'https://www.linkedin.com/in/hüseyin-aydoğan-543076192/', ''),
(17, '20171706028@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Electrical Electronics Engineering', 'Tugberk', 'Ayhan', 'IMG-62763b5d703ad0.95237054.jpg', '', '', '', 'https://www.instagram.com/tugberkayhan/', '', 'https://www.linkedin.com/in/nailtugberkayhan/', ''),
(18, '20171304006@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Radio, Television and Cinema', 'Sena', 'Rendeci', 'IMG-62763d4d3aae76.63813868.jpg', '', '', '', '', '', '', ''),
(19, '20171810044@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Psychology', 'Meryem', 'Erkan', '', '', '', '', '', '', '', ''),
(20, '20171810004@stu.khas.edu.tr', '81dc9bdb52d04dc20036dbd8313ed055', 'Psychology', 'Gizem', 'Tosun', '', '', '', '', '', '', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `attendings`
--
ALTER TABLE `attendings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `attendings`
--
ALTER TABLE `attendings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Tablo için AUTO_INCREMENT değeri `studentclubs`
--
ALTER TABLE `studentclubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
