-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 13 sep 2019 kl 13:28
-- Serverversion: 10.3.17-MariaDB-log-cll-lve
-- PHP-version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `gcssffft_blog`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `thumbnail`, `content`, `date`, `git_commit`, `worktime`) VALUES
(1, 'Finishing up the blog.', 'https://www.stickpng.com/assets/images/58481791cef1014c0b5e4994.png', 'I started working on this blog last thursday [i](2019-09-05)[/i].\r\nNow, 4 days later, it\'s pretty much operational.\r\nAnd by that I mean that whatever I hacked together actually kind of works and shows you this message I\'m writing now, but damn it\'s hacky, I really need to fix that.\r\n\r\nNo worries though, it\'s something to work on later, but for now I will start working on the project this blog actually was meant for.\r\n\r\nThe Unity game \'Grapple Guy\'.\r\nIt\'ll be epic, I\'ll show you later.', '2019-09-12 00:36:48', '', 0),
(4, 'Patching up the site.', 'https://i.ytimg.com/vi/gt0yhHthKz4/hqdefault.jpg', 'Added some more admin controls, can now edit and delete posts directly from the main page.\r\n[img]https://i.gyazo.com/10e6eaed97bc6f01298a967e98e5bd4d.png[/img]\r\n\r\nThe navigation bar now changes depending on if you are logged in, and if you are logged in as an administrator it will give you access to all the admin control things.\r\n\r\n[img]https://i.gyazo.com/5e162deefc40cb7cb5453bd4798845d3.png[/img]\r\n\r\nThe delete function ain\'t pretty. But it kind of works.\r\n\r\n\r\n[i]So much work went into this.[/i]\r\n[url]https://youtu.be/gt0yhHthKz4[/url]\r\nIf you have time, listen to this masterpiece.', '2019-09-12 00:36:57', 'https://github.com/Mattias-Viklund/Exedump/commit/def5c0aa48b36472bce163583be0e38cdc113976', 5),
(5, 'Starting on \'Grapple Guy\'', 'https://i.imgur.com/rTyUs0x.png', '[i]Working title, I know, funny right? no? yeah it sux.[/i]\r\n\r\nDespite the hate for Unity I\'ve grown to know it would probably be very simple to toss something kind of nice looking together for this project in it.\r\n\r\n[img]https://i.gyazo.com/46c662374fb2ab44b7e5a3bfefa18702.png[/img]\r\n\r\nIt just won\'t look as good or play as well, but I hope that tweaking the entire physics engine to what I need might fix it.\r\n\r\nSo after loading the project I\'m met with a familiar sight. \r\nThe unity default scene, completely gray and empty\r\n\r\nSo after I added the standard plane (basically a 2d rectangle in a 3d world, ideal for movement testing). A Capsule component, my so called \"Player\" it looked something like this.\r\n[img]https://i.gyazo.com/05c7b06eaa8cd026a87fa534dddcd4a4.png[/img]\r\n\r\nCreated a simple folder structure, and a script called Movement.cs, a C# Unity Script file.\r\n[img]https://i.gyazo.com/1a83d7ef80f642a00e3462e4911b70f5.png[/img]\r\n\r\nSet up my default editor Visual Studio 2019 (Preview).\r\n[img]https://i.gyazo.com/ba2f7be366180ec76f7d0793e07e8c42.png[/img]\r\n\r\nAnd opened up Movement.cs and this is what I see, a dreadfully empty document that contains this.\r\n[code]using System.Collections;\r\nusing System.Collections.Generic;\r\nusing UnityEngine;\r\n\r\npublic class Movement : MonoBehaviour\r\n{\r\n    private void Start()\r\n    {\r\n\r\n\r\n    }\r\n\r\n    private void Update()\r\n    {\r\n\r\n\r\n    }\r\n}[/code]\r\n\r\nNow, if you don\'t know any programming, don\'t worry, it\'s all pretty explanatory.\r\n\r\nThe Start() function gets called once by Unity at the start of the scene.\r\nThe Update() function gets called once every single frame that the game renders, i.e. somewhere around the neighborhood of 60 frames per second(fps), but I\'m going to target somewhere around 144 fps for this project because it\'s so much nicer.\r\n\r\n[img]https://i.gyazo.com/cd9fcba6abeda8baa7943edf4910c35c.png[/img]\r\nAfter sitting and twiddling my thumbs for a solid 15 minutes searching for something to listening to I decided to just kind of write from memory what I though the [url]https://github.com/ValveSoftware/source-sdk-2013/blob/master/mp/src/game/shared/gamemovement.cpp[/url] source engine movement code looked like, but in C# and not in source engine and not using vectors in the same way.\r\n\r\nI came up with this little devil.\r\nStole the acceleration values straight out of [url]https://github.com/id-Software/Quake-III-Arena/blob/master/code/game/bg_pmove.c[/url] but since they are for a completely different, (and much superior) physics engine, they won\'t work in unity.\r\n\r\nBut testing and tweaking will, tweaking not being the meth kind of tweaking, but software one.\r\n\r\nPlus this, this was very helpful, thanks stackoverflow from 6 years and 9 months ago. [url]https://gamedev.stackexchange.com/questions/45639/implementing-strafe-jumping[/url]\r\n\r\nI\'ll continue tomorrow, just gotta do some git magic to get this spaghetti on the interwebs.', '2019-09-12 01:01:26', 'https://github.com/Mattias-Viklund/GrappleGuy/commit/547fd8a9ac606d55ca3aed3b98bab0485031ff4f', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `acctype`, `pincode`) VALUES
(0, 'Mew_', '$2y$10$NUm8Jp76vQ.Mr4CUSal.GuiPyUzykuBwpyFpzU4kd9qU1HAJsXYUq', '2019-09-05 22:06:57', 0, 0),
(1, 'Testing', '$2y$10$BnOTOR2b.9E69ud4hGYtnucRx5arKiBLRZ5TpOoXEyBPLN5PMZfAG', '2019-09-06 09:29:18', 1, 0);

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
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
