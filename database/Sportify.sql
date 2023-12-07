CREATE DATABASE IF NOT EXISTS sportify;
USE sportify;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `felhasznalo` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$JtyEHoW2GtbWa.VrEoHJ4uIvq21VOY/k2vbYtvXQgEpX/7hxQk1Im', 'admin'),
(34, 'Erik', '$2y$10$Au0ofT.o870la/791iSwNe.sMHaVgohhTOhcxHfQ79IOI9ocGZsCq', 'user'),
(35, 'Dani', '$2y$10$4VknK4yT7fVcMxhHx0CCmOPVsQdBHK9kA4Fv/1gWAI7DYnTSRgz5q', 'user'),
(36, 'Erikszervező', '$2y$10$S1FTDNlDx9BWO/uqVjBjduZoLmhaujL5otGcEzkXV6Cn/WGPrAwxO', 'szervezo'),
(37, 'Ronaldo', '$2y$10$hqn6ySgoB9beJyec48grIeginAD05h/SEFPnYfNJsUlWR1cprpe1q', 'user'),
(38, 'Hamilton', '$2y$10$dZsPQzS6nKXTUFAPsofy0uGgbPaRdIMkdAkxX19mU3GGz7J59//DG', 'user'),
(39, 'forma1szervező', '$2y$10$fBishYZ2gUf5iajQyERmSumAA3Ym6/749EdvstT0eSV/qCfJoROVO', 'szervezo'),
(40, 'szervező', '$2y$10$8nUmJ637RtYKqpfsQ/yT/OGfNAGrV.Q8BmODxuWJEXixvOSX72QbS', 'szervezo'),
(41, 'organiser', '$2y$10$pwn13wfaeA6Jl41HC4ZvNOB/Lz9KAr9TCMprqzWdAkJoVeCz5HpM2', 'szervezo'),
(42, 'béla', '$2y$10$onwbvwdR0ArNGGP1wBwaa.SxjD8IB2ypRHURMyk4MO4i1u7awybE2', 'user'),
(43, 'jani', '$2y$10$Uh7mACgUPdKDpASXmTuRGuiUMt0AdCsyXr02Sh1CW8TTnsFY.q.OK', 'user'),
(44, 'jatekos', '$2y$10$X2tgDuzWozDoSuGTNb6Baea116rG6IVjYr7KVe6XcQSYH31rRyNua', 'user'),
(45, 'org', '$2y$10$2QDIk1VZPkKHNbJ8k28Q/OV0rAy6bMnBAOnWs3DSk41MkKxI14gI2', 'szervezo');

CREATE TABLE `esemeny` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) NOT NULL,
  `sportag` enum('foci','tenisz','f1', '') NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `esemeny` (`id`, `nev`, `sportag`, `datetime`) VALUES
(1, 'Football Match 1', 'foci', '2023-11-17 15:00:00'),
(2, 'Tennis Tournament', 'tenisz', '2023-11-18 10:30:00'),
(3, 'Formula 1 Race', 'f1', '2023-11-19 14:00:00');

CREATE TABLE `event_users` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `event_users` (`event_id`, `user_id`) VALUES (1, 35), (1, 42), (1, 43), (1, 44);

ALTER TABLE `event_users`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `contacts` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `felhasznalo` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
ALTER TABLE `esemeny` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

ALTER TABLE `event_users`
  ADD CONSTRAINT `event_users_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES esemeny(id),
  ADD CONSTRAINT `event_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES felhasznalo(id);
COMMIT;
