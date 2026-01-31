-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_no` varchar(20) NOT NULL,
  `airline` varchar(100) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `arrival` varchar(100) DEFAULT NULL,
  `status` enum('On Time','Delayed','Boarding','Departed','Arrived') NOT NULL DEFAULT 'On Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_no`, `airline`, `departure`, `arrival`, `status`) VALUES
(1, 'AA101', 'American Airlines', 'JFK', 'LAX', ''),
(2, 'DL202', 'Delta Air Lines', 'ATL', 'ORD', 'Boarding'),
(3, 'UA303', 'United Airlines', 'SFO', 'DEN', 'Departed'),
(4, 'BA404', 'British Airways', 'LHR', 'JFK', 'Arrived'),
(5, 'AF505', 'Air France', 'CDG', 'FCO', 'Delayed'),
(6, 'LH606', 'Lufthansa', 'FRA', 'DXB', ''),
(7, 'EK707', 'Emirates', 'DXB', 'SIN', 'Boarding'),
(8, 'QR808', 'Qatar Airways', 'DOH', 'LHR', 'Departed'),
(9, 'SQ909', 'Singapore Airlines', 'SIN', 'SYD', 'Arrived'),
(10, 'CX010', 'Cathay Pacific', 'HKG', 'NRT', ''),
(11, 'JL111', 'Japan Airlines', 'NRT', 'ICN', 'Boarding'),
(12, 'KE212', 'Korean Air', 'ICN', 'BKK', 'Departed'),
(13, 'TG313', 'Thai Airways', 'BKK', 'HKT', 'Arrived'),
(14, 'QF414', 'Qantas', 'SYD', 'MEL', ''),
(15, 'NZ515', 'Air New Zealand', 'AKL', 'CHC', 'Boarding'),
(16, 'AC616', 'Air Canada', 'YYZ', 'YVR', 'Departed'),
(17, 'WS717', 'WestJet', 'YVR', 'YYC', 'Arrived'),
(18, 'IB818', 'Iberia', 'MAD', 'BCN', ''),
(19, 'AZ919', 'ITA Airways', 'FCO', 'MXP', 'Delayed'),
(20, 'KL020', 'KLM', 'AMS', 'BRU', 'Arrived'),
(21, 'SK121', 'SAS', 'CPH', 'ARN', 'Boarding'),
(22, 'AY222', 'Finnair', 'HEL', 'OSL', 'Departed'),
(23, 'LO323', 'LOT Polish', 'WAW', 'PRG', ''),
(24, 'SU424', 'Aeroflot', 'SVO', 'LED', 'Arrived'),
(25, 'TK525', 'Turkish Airlines', 'IST', 'CAI', 'Boarding'),
(26, 'ET626', 'Ethiopian Airlines', 'ADD', 'NBO', 'Departed'),
(27, 'SA727', 'South African Air', 'JNB', 'CPT', 'Arrived'),
(28, 'MS828', 'EgyptAir', 'CAI', 'AMM', ''),
(29, 'RJ929', 'Royal Jordanian', 'AMM', 'DXB', 'Delayed'),
(30, 'AI030', 'Air India', 'DEL', 'BOM', 'Departed'),
(43, 'AA685', 'Emirates', 'ORD', 'LHR', 'Departed'),
(44, 'AA811', 'American Airlines', 'LHR', 'JFK', 'Arrived'),
(45, 'AA142', 'Emirates', 'LHR', 'ORD', 'On Time'),
(46, 'AA927', 'Delta', 'ATL', 'DXB', 'On Time'),
(47, 'AA588', 'Emirates', 'ORD', 'JFK', 'Arrived'),
(48, 'RJ292', 'Emirates', 'JFK', 'DXB', 'On Time'),
(49, 'IA512', 'Indian Airlines', 'TIA', 'IA', 'Departed');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'Noar', 'noar.mikullovci@gmail.com', '$2y$10$Xh6rA/Tqi8j.cQx9K5qEE.N9krPvFKljy0V7CF97GK/Qrs8aSZBPy'),
(3, 'orges', 'orges@gmail.com', '$2y$10$17JbQwkXAOXX0nK/l7W2QO9CHwoRe7SZChZn17ss.1UH60rL4o.SK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flight_no` (`flight_no`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
