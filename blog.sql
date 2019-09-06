-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 06 sep 2019 kl 15:17
-- Serverversion: 10.1.36-MariaDB
-- PHP-version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `blog`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `thumbnail`, `content`, `date`) VALUES
(1, 'First POST GUYS!!!', 'https://pbs.twimg.com/profile_images/653700295395016708/WjGTnKGQ_400x400.png', 'NYAAAH', '2019-09-06 11:39:36'),
(2, 'aye second post', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoV4-9QvSR5Cz5q8UwIZCMX-76voibk8nfiyRvBhRvlfs8hyQM', 'NYAAAH', '2019-09-06 12:38:23'),
(3, 'BBCODE', 'https://i.imgur.com/wSE1zEe.jpg', '[img]https://i.imgur.com/2fnC5un.jpg[/img][br]1[/br][b]STRONG YES[/b][img]https://i.imgur.com/PAx9Ioj.jpg[/img]', '2019-09-06 14:24:59'),
(4, 'asdasdg', 'asdgasdg', 'asdgasdasdg', '2019-09-06 14:46:41'),
(5, 'fourth reich', 'https://cdn.vox-cdn.com/thumbor/VD8JI2zquKWDCQuPxlc6Rnhw-1I=/0x0:876x584/1200x800/filters:focal(368x222:508x362)/cdn.vox-cdn.com/uploads/chorus_image/image/62841097/instagram_egg.0.jpg', 'SUCK\r\nA\r\nTOE\r\nOR SOMETHING\r\n\r\n[b]EGG2[/b]\r\n[img]https://www.abc.net.au/news/image/10714652-3x2-700x467.jpg[/img]', '2019-09-06 15:09:43');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `acctype` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `acctype`) VALUES
(0, 'Mew_', '$2y$10$NUm8Jp76vQ.Mr4CUSal.GuiPyUzykuBwpyFpzU4kd9qU1HAJsXYUq', '2019-09-05 22:06:57', 0),
(4, 'helo', '$2y$10$BnOTOR2b.9E69ud4hGYtnucRx5arKiBLRZ5TpOoXEyBPLN5PMZfAG', '2019-09-06 09:29:18', 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
