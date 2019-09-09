-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 sep 2019 kl 16:51
-- Serverversion: 10.4.6-MariaDB
-- PHP-version: 7.3.9

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
  `date` datetime NOT NULL DEFAULT current_timestamp(),
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
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `git_commit` varchar(250) NOT NULL,
  `worktime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `thumbnail`, `content`, `date`, `git_commit`, `worktime`) VALUES
(7, 'Applying Physics', '', 'Added a proper physics system\r\n\r\n[code]int a = 20;[/code]', '2019-09-07 12:34:30', '', 5),
(8, 'Implementing gravity', 'https://i.imgur.com/DXEQgVZ.png', 'Gravitational force is an important thing to get right in a game\r\n\r\nSo yeah, here I implemented it\r\n\r\n[code] \r\nbool m_gravity = true;\r\nConVar sv_gravity = new ConVar(\"sv_gravity\", 800);\r\n[/code]', '2019-09-07 13:47:21', 'https://github.com/Mattias-Viklund/Blog/commit/873ed61379be3b8763effaac642586a8330580c5', 4),
(9, 'Implementing gravity', 'https://i.imgur.com/wSE1zEe.jpg', 'Gravity is super important and stuff.\r\n\r\n[code]ConVar sv_gravity = new ConVar(\"sv_gravity\", 800);\r\nvoid ApplyGravity(Player* p_player, float* deltaTime){\r\n    *p_player.position.y -= *deltaTime;\r\n}[/code]', '2019-09-07 13:49:28', 'https://github.com/Mattias-Viklund/Blog/commit/873ed61379be3b8763effaac642586a8330580c5', 4),
(10, 'Admin reminder', '', 'Try to remember this til next time.', '2019-09-07 20:48:38', '', 0),
(11, 'I think I successfully standardized this shit, now I just gotta make them comments.', '', 'yewah read the title homie', '2019-09-08 02:01:16', '', 2),
(12, 'Need to fix some stupid HTTL shit', 'https://cdn.iwastesomuchtime.com/726201820261238273.jpg', 'I really wanted to be able to use HTTL templates in different directories and let the compiler figure out the correct path for everything, but it might take a while. \r\n\r\nSo in the meantime i\'m gonna slap the entire fucking thing into the same directory and pray that the no fuckers will come for that shit, but whatever.', '2019-09-08 02:25:32', 'https://github.com/Mattias-Viklund/Sites/tree/master/HTTL', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `acctype` int(1) DEFAULT 1,
  `pincode` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `acctype`, `pincode`) VALUES
(0, 'Mew_', '$2y$10$NUm8Jp76vQ.Mr4CUSal.GuiPyUzykuBwpyFpzU4kd9qU1HAJsXYUq', '2019-09-05 22:06:57', 0, 0),
(4, 'helo', '$2y$10$BnOTOR2b.9E69ud4hGYtnucRx5arKiBLRZ5TpOoXEyBPLN5PMZfAG', '2019-09-06 09:29:18', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
