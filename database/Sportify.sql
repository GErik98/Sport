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
(24, 'szervezo', '$2y$10$N4SwfHT5xYNu8Exqv/Ly6.gQAdL5WV3KcpQMTD3hvGopBsucfjr6u', 'szervezo'),
(26, 'user', '$2y$10$xULNDshsbC5YQ5Z5S0Y1F.1jMHfFKoLJP3HGJm6sIJhgM.eCVpm.y', 'user');

CREATE TABLE `rendezveny` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) NOT NULL,
  `sportag` enum('foci','tenisz','f1','') NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rendezveny` (`id`, `nev`, `sportag`, `datetime`) VALUES
(1, 'Football Match 1', 'foci', '2023-11-17 15:00:00'),
(2, 'Tennis Tournament', 'tenisz', '2023-11-18 10:30:00'),
(3, 'Formula 1 Race', 'f1', '2023-11-19 14:00:00');

ALTER TABLE `contacts` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `felhasznalo` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
ALTER TABLE `rendezveny` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
