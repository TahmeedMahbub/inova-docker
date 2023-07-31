-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2023 at 12:24 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams_inova`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `id` int UNSIGNED NOT NULL,
  `create` tinyint(1) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `update` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(282, 0, 0, 0, 0, 1, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(283, 0, 0, 0, 0, 2, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(284, 0, 0, 0, 0, 3, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(285, 0, 0, 0, 0, 4, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(286, 0, 0, 0, 0, 5, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(287, 0, 0, 0, 0, 6, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(288, 0, 0, 0, 0, 8, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(289, 0, 0, 0, 0, 9, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(290, 0, 0, 0, 0, 10, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(291, 0, 0, 0, 0, 11, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(292, 0, 0, 0, 0, 12, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(293, 0, 0, 0, 0, 13, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(294, 0, 0, 0, 0, 14, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(295, 0, 0, 0, 0, 15, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(296, 0, 0, 0, 0, 16, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(297, 0, 0, 0, 0, 17, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(298, 0, 0, 0, 0, 18, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(299, 0, 0, 0, 0, 19, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(300, 0, 0, 0, 0, 20, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(301, 0, 0, 0, 0, 21, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(302, 0, 0, 0, 0, 23, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(303, 0, 0, 0, 0, 115, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(304, 0, 0, 0, 0, 116, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(305, 0, 0, 0, 0, 117, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(306, 0, 0, 0, 0, 118, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(307, 0, 0, 0, 0, 119, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(308, 0, 0, 0, 0, 120, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(309, 0, 0, 0, 0, 121, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(310, 0, 0, 0, 0, 122, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(311, 0, 0, 0, 0, 123, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(312, 0, 0, 0, 0, 124, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(313, 0, 0, 0, 0, 125, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(314, 0, 0, 0, 0, 126, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(315, 0, 0, 0, 0, 127, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(316, 0, 0, 0, 0, 128, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(317, 0, 0, 0, 0, 129, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(318, 0, 1, 0, 0, 130, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:05:43'),
(319, 0, 0, 0, 0, 131, 2, 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(321, 1, 1, 1, 1, 132, 2, 1, 1, NULL, NULL),
(323, 1, 1, 1, 1, 1, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(324, 1, 1, 1, 1, 2, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(325, 1, 1, 1, 1, 3, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(326, 1, 1, 1, 1, 4, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(327, 1, 1, 1, 1, 5, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(328, 1, 1, 1, 1, 6, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(329, 1, 1, 1, 1, 8, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(330, 1, 1, 1, 1, 9, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(331, 1, 1, 1, 1, 10, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(332, 1, 1, 1, 1, 11, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(333, 1, 1, 1, 1, 12, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(334, 1, 1, 1, 1, 13, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(335, 1, 1, 1, 1, 14, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(336, 1, 1, 1, 1, 15, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(337, 1, 1, 1, 1, 16, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(338, 1, 1, 1, 1, 17, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(339, 1, 1, 1, 1, 18, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(340, 1, 1, 1, 1, 19, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(341, 1, 1, 1, 1, 20, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(342, 1, 1, 1, 1, 21, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(343, 1, 1, 1, 1, 23, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(344, 1, 1, 1, 1, 115, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(345, 1, 1, 1, 1, 116, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(346, 1, 1, 1, 1, 117, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(347, 1, 1, 1, 1, 118, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(348, 1, 1, 1, 1, 119, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(349, 1, 1, 1, 1, 120, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(350, 1, 1, 1, 1, 121, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(351, 1, 1, 1, 1, 122, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(352, 1, 1, 1, 1, 123, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(353, 1, 1, 1, 1, 124, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(354, 1, 1, 1, 1, 125, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(355, 1, 1, 1, 1, 126, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(356, 1, 1, 1, 1, 127, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(357, 1, 1, 1, 1, 128, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(358, 1, 1, 1, 1, 129, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(359, 1, 1, 1, 1, 130, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(360, 1, 1, 1, 1, 131, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(361, 1, 1, 1, 1, 132, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(362, 1, 1, 1, 1, 133, 1, 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(363, 1, 1, 1, 1, 134, 1, 1, 1, '2022-11-23 08:08:18', '2022-11-23 08:08:18'),
(364, 1, 1, 1, 1, 135, 1, 1, 1, '2022-11-06 04:05:06', '2022-11-06 04:05:06'),
(365, 0, 0, 0, 0, 135, 2, 1, 1, '2022-11-06 04:05:06', '2022-11-06 04:05:06'),
(367, 0, 0, 0, 0, 1, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(368, 0, 0, 0, 0, 2, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(369, 0, 0, 0, 0, 3, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(370, 0, 0, 0, 0, 4, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(371, 0, 0, 0, 0, 5, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(372, 0, 0, 0, 0, 6, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(373, 0, 0, 0, 0, 8, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(374, 0, 0, 0, 0, 9, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(375, 0, 0, 0, 0, 10, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(376, 0, 0, 0, 0, 11, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(377, 0, 0, 0, 0, 12, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(378, 0, 0, 0, 0, 13, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(379, 0, 0, 0, 0, 14, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(380, 0, 0, 0, 0, 15, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(381, 0, 0, 0, 0, 16, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(382, 0, 0, 0, 0, 17, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(383, 0, 0, 0, 0, 18, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(384, 0, 0, 0, 0, 19, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(385, 0, 0, 0, 0, 20, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(386, 0, 0, 0, 0, 21, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(387, 0, 0, 0, 0, 23, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(388, 0, 0, 0, 0, 115, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(389, 0, 0, 0, 0, 116, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(390, 0, 0, 0, 0, 117, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(391, 0, 0, 0, 0, 118, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(392, 0, 0, 0, 0, 119, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(393, 0, 0, 0, 0, 120, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(394, 0, 0, 0, 0, 121, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(395, 0, 0, 0, 0, 122, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(396, 0, 0, 0, 0, 123, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(397, 0, 0, 0, 0, 124, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(398, 0, 0, 0, 0, 125, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(399, 0, 0, 0, 0, 126, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(400, 0, 0, 0, 0, 127, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(401, 0, 0, 0, 0, 128, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(402, 0, 0, 0, 0, 129, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(403, 0, 0, 0, 0, 130, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(404, 0, 0, 0, 0, 131, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(405, 0, 0, 0, 0, 132, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(406, 0, 0, 0, 0, 133, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(407, 0, 0, 0, 0, 134, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(408, 0, 0, 0, 0, 135, 3, 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(409, 0, 0, 0, 0, 1, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(410, 0, 0, 0, 0, 2, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(411, 0, 0, 0, 0, 3, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(412, 0, 0, 0, 0, 4, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(413, 0, 0, 0, 0, 5, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(414, 0, 0, 0, 0, 6, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(415, 0, 0, 0, 0, 8, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(416, 0, 0, 0, 0, 9, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(417, 0, 0, 0, 0, 10, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(418, 0, 0, 0, 0, 11, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(419, 0, 0, 0, 0, 12, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(420, 0, 0, 0, 0, 13, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(421, 0, 0, 0, 0, 14, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(422, 0, 0, 0, 0, 15, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(423, 0, 0, 0, 0, 16, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(424, 0, 0, 0, 0, 17, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(425, 0, 0, 0, 0, 18, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(426, 0, 0, 0, 0, 19, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(427, 0, 0, 0, 0, 20, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(428, 0, 0, 0, 0, 21, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(429, 0, 0, 0, 0, 23, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(430, 0, 0, 0, 0, 115, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(431, 0, 0, 0, 0, 116, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(432, 0, 0, 0, 0, 117, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(433, 0, 0, 0, 0, 118, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(434, 0, 0, 0, 0, 119, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(435, 0, 0, 0, 0, 120, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(436, 0, 0, 0, 0, 121, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(437, 0, 0, 0, 0, 122, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(438, 0, 0, 0, 0, 123, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(439, 0, 0, 0, 0, 124, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(440, 0, 0, 0, 0, 125, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(441, 0, 0, 0, 0, 126, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(442, 0, 0, 0, 0, 127, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(443, 0, 0, 0, 0, 128, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(444, 0, 0, 0, 0, 129, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(445, 0, 0, 0, 0, 130, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(446, 0, 0, 0, 0, 131, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(447, 0, 0, 0, 0, 132, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(448, 0, 0, 0, 0, 133, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(449, 0, 0, 0, 0, 134, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55'),
(450, 0, 0, 0, 0, 135, 4, 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int UNSIGNED NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `dashboard_watchlist` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `required_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_type_id` int UNSIGNED NOT NULL,
  `parent_account_type_id` int UNSIGNED NOT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_name`, `account_code`, `description`, `dashboard_watchlist`, `required_status`, `account_type_id`, `parent_account_type_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Advance Tax', 'Advance Tax', 'Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.', '0', '1', 3, 1, 1, 1, 1, '1975-08-19 20:44:01', '2004-03-15 14:29:20'),
(2, 'Employee Advance', 'Employee Advance', 'Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.', '0', '1', 3, 1, 1, 1, 1, '1994-11-25 17:28:57', '2015-09-24 17:47:06'),
(3, 'Cash', 'Cash', 'It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.', '0', '1', 4, 1, 1, 1, 1, '2009-03-30 19:10:49', '1976-02-11 10:27:51'),
(4, 'Undeposited Funds', 'Undeposited Funds', 'Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.', '0', '1', 4, 1, 1, 1, 1, '2015-01-18 06:17:38', '2000-02-19 03:26:55'),
(5, 'Accounts Receivable', 'Accounts Receivable', 'The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.', '0', '1', 2, 1, 1, 1, 1, '1998-10-26 21:15:41', '2002-02-15 22:45:16'),
(6, 'Inventory Asset', 'Inventory Asset', 'An account which tracks the value of goods in your inventory.', '0', '1', 7, 1, 1, 1, 1, '2017-10-16 20:14:10', '1991-09-13 22:24:35'),
(7, 'Opening Balance Adjustments', 'Opening Balance Adjustments', 'This account will hold the difference in the debits and credits entered during the opening balance.', '0', '1', 9, 2, 1, 1, 1, '1971-05-31 15:41:05', '1971-10-15 08:45:24'),
(8, 'Employee Reimbursements', 'Employee Reimbursements', 'This account can be used to track the reimbursements that are due to be paid out to employees.', '0', '1', 9, 2, 1, 1, 1, '1975-08-31 23:21:54', '1982-01-22 01:26:42'),
(9, 'Tax Payable', 'Tax Payable', 'The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.', '0', '1', 9, 2, 1, 1, 1, '1987-10-15 01:46:56', '2012-07-08 19:32:43'),
(10, 'Unearned Revenue', 'Unearned Revenue', 'A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.', '0', '1', 9, 2, 1, 1, 1, '1996-02-09 05:23:42', '2016-12-22 04:17:22'),
(11, 'Accounts Payable', 'Accounts Payable', 'This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.', '0', '1', 13, 2, 1, 1, 1, '2000-09-18 04:35:56', '2016-03-19 17:10:13'),
(12, 'Tag Adjustments', 'Tag Adjustments', 'This adjustment account tracks the transfers between different reporting tags.', '0', '1', 12, 2, 1, 1, 1, '2014-03-04 12:59:15', '1982-01-14 08:48:12'),
(13, 'Drawings', 'Drawings', 'The money withdrawn from a business by its owner can be tracked with this account.', '0', '1', 14, 3, 1, 1, 1, '1972-04-09 18:09:04', '2005-11-08 10:03:40'),
(14, 'Opening Balance Offset', 'Opening Balance Offset', 'This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.', '0', '1', 14, 3, 1, 1, 1, '1975-06-03 17:31:16', '1981-11-06 10:44:05'),
(15, 'Owner Equity', 'Owner Equity', 'The owners rights to the assets of a company can be quantified in the owner\'s equity account.', '0', '1', 14, 3, 1, 1, 1, '1999-09-19 05:25:06', '1998-01-07 08:59:05'),
(16, 'Sales', 'Sales', 'The income from the sales in your business is recorded under the sales account.', '0', '1', 15, 4, 1, 1, 1, '2015-04-07 18:20:35', '1987-07-11 13:58:58'),
(17, 'General Income', 'General Income', 'A general category of account where you can record any income which cannot be recorded into any other category.', '0', '1', 15, 4, 1, 1, 1, '1979-08-17 18:26:41', '1991-11-08 18:41:05'),
(18, 'Other Charges', 'Other Charges', 'Miscellaneous charges like adjustments made to the invoice can be recorded in this account.', '0', '1', 15, 4, 1, 1, 1, '1990-10-23 16:05:29', '1997-12-12 19:52:50'),
(19, 'Interest Income', 'Interest Income', 'A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.', '0', '1', 15, 4, 1, 1, 1, '2018-02-22 02:00:28', '2017-04-07 00:18:18'),
(20, 'Shipping Charge', 'Shipping Charge', 'Shipping charges made to the invoice will be recorded in this account.', '0', '1', 15, 4, 1, 1, 1, '2006-10-03 23:35:20', '2014-11-28 09:03:27'),
(21, 'Discount', 'Discount', 'Any reduction on your selling price as a discount can be recorded into the discount account.', '0', '1', 15, 4, 1, 1, 1, '1980-04-21 19:09:00', '1984-06-28 03:40:03'),
(22, 'Late Fee Income', 'Late Fee Income', 'Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.', '0', '1', 15, 4, 1, 1, 1, '2002-03-05 08:34:37', '1991-12-24 12:41:54'),
(23, 'Other Expenses', 'Other Expenses', 'Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.', '0', '1', 17, 5, 1, 1, 1, '1973-04-20 05:16:04', '2009-02-06 14:11:13'),
(24, 'Bad Debt', 'Bad Debt', 'Any amount which is lost and is unrecoverable is recorded into the bad debt account.', '0', '1', 17, 5, 1, 1, 1, '1990-11-06 11:47:55', '2010-03-04 10:39:30'),
(25, 'Exchange Gain or Loss', 'Exchange Gain or Loss', 'Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.', '0', '1', 19, 5, 1, 1, 1, '2010-02-24 02:55:32', '2017-11-24 10:29:02'),
(26, 'Cost of Goods Sold', 'Cost of Goods Sold', 'An expense account which tracks the value of the goods sold.', '0', '1', 18, 5, 1, 1, 1, '2005-08-06 09:11:59', '2008-06-27 08:46:29'),
(27, 'Prepaid Expense', 'Prepaid Expense', 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.', '0', '1', 3, 1, 1, 1, 1, '1994-02-07 17:46:52', '2012-03-15 17:28:46'),
(28, 'Conveyance', 'Conveyance', 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.', '0', '1', 17, 5, 1, 1, 1, '1987-07-06 19:16:48', '2015-04-03 02:21:00'),
(30, 'Agent Commission', 'Agent Commission', 'Agent Commission.', '0', '1', 3, 1, 1, 1, 1, '1994-09-18 08:04:55', '1971-02-09 02:08:09'),
(31, 'Sales Discount', 'Sales Discount', 'Sales discount is a reduced price offered by a business on a product or service.', '0', '1', 17, 5, 1, 1, 1, '2023-02-08 10:32:02', '2023-02-08 10:32:02'),
(107, 'Degradable Good', '', '', NULL, NULL, 6, 1, 1, 1, 1, '2022-09-28 03:45:44', '2022-09-28 03:45:44'),
(108, 'New Bank', 'New Bank', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2023-02-11 11:39:44', '2023-02-11 11:39:44'),
(109, 'DBBL - Panthapath ', 'DBBL - Panthapath ', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2023-02-12 05:56:45', '2023-02-12 05:56:45'),
(110, 'DBBL- Gulshan Branch', 'DBBL- Gulshan Branch', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2023-02-12 05:57:38', '2023-02-12 05:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `id` int UNSIGNED NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `parent_account_type_id` int UNSIGNED NOT NULL,
  `required_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `account_name`, `description`, `parent_account_type_id`, `required_status`, `created_at`, `updated_at`) VALUES
(1, 'Other Asset', 'Track special assets like goodwill and other intangible assets', 1, 0, '2006-12-10 00:56:44', '1992-12-23 08:58:40'),
(2, 'Accounts Receivable', 'Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices', 1, 1, '1994-11-06 19:43:24', '1988-10-12 13:13:54'),
(3, 'Other Current asset', 'Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds', 1, 0, '1997-04-02 23:06:59', '1982-07-02 01:40:37'),
(4, 'Cash', 'To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.', 1, 0, '1983-12-30 10:45:16', '1993-10-05 06:58:23'),
(5, 'Bank', 'To keep track of bank accounts like Savings, Checking, and Money Market accounts', 1, 0, '1993-07-13 01:38:48', '1996-11-21 10:32:52'),
(6, 'Fixed asset', 'Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture', 1, 0, '1975-11-13 15:16:03', '1999-03-13 21:06:20'),
(7, 'Stock', 'To keep track of your inventory assets.', 1, 0, '1988-11-03 20:37:59', '1989-02-24 14:38:31'),
(9, 'Other Current Liability', 'Any short term liability like:Customer Deposits - Tax Payable', 2, 0, '2006-11-28 12:21:19', '1983-02-11 23:23:49'),
(10, 'Credit Card', 'Create a trail of all your credit card transactions by creating a credit card account', 2, 0, '1979-12-13 17:48:02', '2003-06-04 15:14:20'),
(11, 'Long Term Liability', 'Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans', 2, 0, '1995-02-27 22:27:55', '1973-09-20 03:47:27'),
(12, 'Other Liability', 'Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc', 2, 0, '1972-05-07 08:34:12', '2007-03-24 19:11:09'),
(13, 'Accounts Payable', 'Accounts Payable', 2, 1, '2004-08-22 00:54:11', '2013-03-12 02:58:29'),
(14, 'Equity', 'Equity', 3, 0, '1996-10-13 11:29:42', '1987-06-12 21:21:30'),
(15, 'Income', 'income', 4, 0, '1997-08-12 18:56:25', '1977-05-21 10:29:56'),
(16, 'Other Income', 'Other Income', 4, 0, '2017-01-11 16:29:51', '1970-05-13 18:35:11'),
(17, 'Expense', 'Expense', 5, 0, '1984-12-11 02:20:34', '1974-12-28 10:30:16'),
(18, 'Cost of Goods Sold', 'Cost of Goods Sold', 5, 0, '2013-06-28 05:06:09', '2006-07-23 13:41:05'),
(19, 'Other Expense', 'Other Expense', 5, 0, '1989-06-15 11:22:19', '2015-04-06 07:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = Inactive\r\n1 = Active',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 'diameter', 1, 1, 1, '2023-03-18 15:11:35', '2023-03-18 15:11:35'),
(6, 'Height', 1, 1, 1, '2023-03-18 15:12:05', '2023-03-18 15:12:05'),
(7, 'T', 1, 1, 1, '2023-03-18 15:16:18', '2023-03-18 15:16:18'),
(8, 'L', 1, 1, 1, '2023-03-18 15:21:31', '2023-03-18 15:21:31'),
(9, 'W', 1, 1, 1, '2023-03-18 15:21:46', '2023-03-18 15:21:46'),
(10, 'Color', 1, 1, 1, '2023-03-18 15:22:51', '2023-03-18 15:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int UNSIGNED NOT NULL,
  `attribute_id` int UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(11, 5, '600', 1, 1, '2023-03-18 15:11:35', '2023-03-18 15:11:35'),
(12, 6, '600', 1, 1, '2023-03-18 15:12:05', '2023-03-18 15:12:05'),
(13, 7, '2', 1, 1, '2023-03-18 15:16:18', '2023-03-18 15:16:18'),
(14, 7, '5', 1, 1, '2023-03-18 15:16:18', '2023-03-18 15:16:18'),
(15, 7, '10', 1, 1, '2023-03-18 15:16:18', '2023-03-18 15:16:18'),
(16, 8, '36', 1, 1, '2023-03-18 15:21:31', '2023-03-18 15:21:31'),
(17, 8, '20', 1, 1, '2023-03-18 15:21:31', '2023-03-18 15:21:31'),
(18, 8, '24', 1, 1, '2023-03-18 15:21:31', '2023-03-18 15:21:31'),
(19, 9, '2', 1, 1, '2023-03-18 15:21:46', '2023-03-18 15:21:46'),
(20, 9, '20', 1, 1, '2023-03-18 15:21:46', '2023-03-18 15:21:46'),
(21, 9, '24', 1, 1, '2023-03-18 15:21:46', '2023-03-18 15:21:46'),
(22, 10, 'Brown', 1, 1, '2023-03-18 15:22:51', '2023-03-18 15:22:51'),
(23, 10, 'Red', 1, 1, '2023-03-18 15:22:51', '2023-03-18 15:22:51'),
(24, 10, 'Green', 1, 1, '2023-03-18 15:22:51', '2023-03-18 15:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int UNSIGNED NOT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `particulars` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cheque_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_amount` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notes` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `contact_id` int UNSIGNED NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `payment_mode_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int UNSIGNED NOT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_of_installment` int DEFAULT NULL,
  `day_interval` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `bill_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_rates` int NOT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `cms_site_id` int UNSIGNED DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `personal_note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vendor_note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total_tax` double NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `vendor_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `save` tinyint(1) DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `adjustment_type` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_due_table`
--

CREATE TABLE `bill_due_table` (
  `id` int NOT NULL,
  `bill_id` int UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `due_amount` varchar(191) NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_entry`
--

CREATE TABLE `bill_entry` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `rate` double NOT NULL,
  `rate_type` int UNSIGNED NOT NULL,
  `discount` int UNSIGNED DEFAULT NULL,
  `discount_type` int UNSIGNED DEFAULT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `depreciation` int UNSIGNED NOT NULL,
  `bill_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Triggers `bill_entry`
--
DELIMITER $$
CREATE TRIGGER `bill_entry_create_item_total_purchase_add` AFTER INSERT ON `bill_entry` FOR EACH ROW BEGIN
UPDATE `item_variations` SET total_purchases = total_purchases + new.quantity WHERE id = new.variation_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bill_entry_delete_item_total_purchase_remove` AFTER DELETE ON `bill_entry` FOR EACH ROW BEGIN
UPDATE `item_variations` SET `total_purchases` = `total_purchases` - old.quantity WHERE id = old.variation_id;
UPDATE `item` SET `total_purchases` = `total_purchases` - old.quantity WHERE id = old.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bill_entry_update_item_total_purchase_update` AFTER UPDATE ON `bill_entry` FOR EACH ROW BEGIN
UPDATE `item_variations` SET `total_purchases` = total_purchases - old.quantity + new.quantity WHERE id = new.variation_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_free_entries`
--

CREATE TABLE `bill_free_entries` (
  `id` int UNSIGNED NOT NULL,
  `bill_id` int UNSIGNED NOT NULL,
  `bill_entry_id` int UNSIGNED NOT NULL,
  `offer_id` int UNSIGNED NOT NULL,
  `free_item_id` int UNSIGNED DEFAULT NULL,
  `free_item_variation_id` int UNSIGNED DEFAULT NULL,
  `free_item_quantity` int UNSIGNED DEFAULT NULL,
  `offer_amount` int UNSIGNED DEFAULT NULL,
  `offer_amount_type` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `bill_free_entries`
--
DELIMITER $$
CREATE TRIGGER `bill_free_entry_create_item_total_purchase_add` AFTER INSERT ON `bill_free_entries` FOR EACH ROW BEGIN

UPDATE `item_variations` SET `total_purchases` = `total_purchases` + new.free_item_quantity WHERE id = new.free_item_variation_id;

UPDATE `item` SET `total_purchases` = `total_purchases` + new.free_item_quantity WHERE id = new.free_item_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bill_free_entry_delete_item_total_purchase_remove` AFTER DELETE ON `bill_free_entries` FOR EACH ROW BEGIN

UPDATE `item_variations` SET `total_purchases` = `total_purchases` - old.free_item_quantity WHERE id = old.free_item_variation_id;

UPDATE `item` SET `total_purchases` = `total_purchases` - old.free_item_quantity WHERE id = old.free_item_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bill_free_entry_update_item_total_purchase_update` AFTER UPDATE ON `bill_free_entries` FOR EACH ROW BEGIN

UPDATE `item_variations` SET `total_purchases` = `total_purchases` - old.free_item_quantity + new.free_item_quantity WHERE id = new.free_item_variation_id;

UPDATE `item` SET `total_purchases` = `total_purchases` - old.free_item_quantity + new.free_item_quantity WHERE id = new.free_item_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_materials`
--

CREATE TABLE `bill_of_materials` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `project_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `cho_percent` double DEFAULT '0',
  `profit_percent` double DEFAULT '0',
  `design_percent` double DEFAULT '0',
  `sub_total` double NOT NULL DEFAULT '0',
  `mrp_percent` double NOT NULL DEFAULT '0',
  `vat_percent` double NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `trade_total` double NOT NULL DEFAULT '0',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`id`, `invoice_id`, `item_id`, `project_name`, `product_size`, `date`, `quantity`, `cho_percent`, `profit_percent`, `design_percent`, `sub_total`, `mrp_percent`, `vat_percent`, `status`, `trade_total`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(10, NULL, 23, 'Base Product', '{\"5\":\"600\",\"6\":\"600\"}', '2023-03-18', 1, 10, 10, 1, 7509, 43, 15, 'pending', 13007.82, 1, 1, '2023-03-18 15:46:02', '2023-03-18 15:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_material_entries`
--

CREATE TABLE `bill_of_material_entries` (
  `id` int NOT NULL,
  `bill_of_material_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `sub_category_id` int UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `wastage_percent` double DEFAULT '0',
  `unit_id` int UNSIGNED DEFAULT NULL,
  `unit_price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bill_of_material_entries`
--

INSERT INTO `bill_of_material_entries` (`id`, `bill_of_material_id`, `item_id`, `sub_category_id`, `quantity`, `wastage_percent`, `unit_id`, `unit_price`) VALUES
(10, 10, 24, 1, 4, 0, NULL, 1050),
(11, 10, 25, 1, 4, 0, NULL, 50),
(12, 10, 26, 1, 1, 0, NULL, 50),
(13, 10, 27, 2, 4, 0, NULL, 160),
(14, 10, 31, 3, 6, 0, NULL, 60),
(15, 10, 32, 3, 24, 0, NULL, 5),
(16, 10, 33, 3, 1, 0, NULL, 50),
(17, 10, 34, 3, 1, 0, NULL, 10),
(18, 10, 35, 3, 1, 0, NULL, 25),
(19, 10, 36, 3, 1, 0, NULL, 2),
(20, 10, 37, 3, 1, 0, NULL, 2),
(21, 10, 38, 3, 1, 0, NULL, 150),
(22, 10, 39, 4, 2, 0, NULL, 550),
(23, 10, 40, 4, 1, 0, NULL, 600);

-- --------------------------------------------------------

--
-- Table structure for table `bill_return_entries`
--

CREATE TABLE `bill_return_entries` (
  `id` int UNSIGNED NOT NULL,
  `bill_entries_id` int UNSIGNED DEFAULT NULL,
  `returned_quantity` int DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submit`
--

CREATE TABLE `bill_submit` (
  `id` int UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int UNSIGNED DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vendor_name` int UNSIGNED DEFAULT NULL,
  `status` int UNSIGNED DEFAULT NULL COMMENT '0=not approved, 1=approved, null=yet no deceission',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_category_id` int UNSIGNED NOT NULL,
  `item_sub_category_id` int UNSIGNED NOT NULL,
  `adjustment` double DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `order_number` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_of_installment` int DEFAULT NULL,
  `day_interval` int DEFAULT NULL,
  `start_date` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submits_due_dates`
--

CREATE TABLE `bill_submits_due_dates` (
  `id` int NOT NULL,
  `bill_submit_id` int UNSIGNED NOT NULL,
  `due_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submit_entries`
--

CREATE TABLE `bill_submit_entries` (
  `id` int NOT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `rate` int NOT NULL,
  `tax_id` int UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL,
  `bill_id` int NOT NULL,
  `setting_currencies_id` int UNSIGNED DEFAULT NULL,
  `setting_currency_rates` double UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int UNSIGNED NOT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `branch_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `branch_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `branch_description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `location`, `branch_prefix`) VALUES
(1, 'Head Office', '', 1, 1, '2009-02-21 02:50:25', '2022-11-27 12:31:13', 'Gulshan', 'HO'),
(2, 'Inova Factory', 'Factory For Inova', 1, 1, '2023-02-23 09:19:03', '2023-02-23 09:19:03', 'Baipayl, Dhaka', 'Inova Factory'),
(3, 'Motijheel Showroom', 'Motijheel Sales Center ', 1, 1, '2023-02-23 09:21:24', '2023-02-23 09:21:24', 'Motijheel, Dhaka', 'Motijheel ');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `subtotal` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` tinyint DEFAULT '0' COMMENT '0 = %, 1 = flat',
  `tax` double DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `shipping` double DEFAULT NULL,
  `total` double NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_entries`
--

CREATE TABLE `cart_entries` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `cart_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `rate` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` tinyint DEFAULT NULL COMMENT '0 = %, 1 = flat',
  `total` double NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_book`
--

CREATE TABLE `cheque_book` (
  `id` int UNSIGNED NOT NULL,
  `book_collection_date` date NOT NULL,
  `bank_id` int UNSIGNED NOT NULL,
  `start_page_no` int UNSIGNED NOT NULL,
  `number_of_pages` int UNSIGNED NOT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheque_book`
--

INSERT INTO `cheque_book` (`id`, `book_collection_date`, `bank_id`, `start_page_no`, `number_of_pages`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '2023-03-19', 110, 5001, 50, 1, 1, 1, '2023-03-19 04:49:46', '2023-03-19 04:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `profile_pic_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `finger_print_id` int UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `skype_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone_number_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone_number_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `billing_street` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `billing_zip_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_zip_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `local_guard_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fb_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `contact_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `contact_category_id` int UNSIGNED NOT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_id` int UNSIGNED DEFAULT NULL,
  `present_class` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shipping_address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `billing_address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `longitude` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `latitude` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `code`, `first_name`, `last_name`, `profile_pic_url`, `display_name`, `finger_print_id`, `company_name`, `email_address`, `skype_name`, `phone_number_1`, `phone_number_2`, `phone_number_3`, `billing_street`, `billing_city`, `billing_state`, `billing_zip_code`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip_code`, `shipping_country`, `father_name`, `mother_name`, `local_guard_name`, `fb_id`, `tw_id`, `about`, `contact_status`, `contact_category_id`, `agent_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `account_id`, `present_class`, `shipping_address`, `billing_address`, `longitude`, `latitude`) VALUES
(1, '', '', '', NULL, 'Test Customer', NULL, '', '', NULL, '456789', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 1, NULL, 1, 1, 1, '2023-02-11 11:12:32', '2023-02-11 11:12:32', NULL, NULL, '', '', NULL, NULL),
(2, '', NULL, NULL, NULL, 'Factory', NULL, NULL, NULL, NULL, '8156', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 9, NULL, 1, 1, 1, '2023-02-11 11:36:28', '2023-02-11 11:36:28', NULL, NULL, NULL, NULL, NULL, NULL),
(3, '', '', '', NULL, 'New Bank', NULL, '', '', NULL, '6261', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 5, NULL, 1, 1, 1, '2023-02-11 11:39:44', '2023-02-11 11:39:44', 108, NULL, '', '', NULL, NULL),
(4, '', '', '', NULL, 'vendor', NULL, '', '', NULL, '651561', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 4, NULL, 1, 1, 1, '2023-02-11 11:44:45', '2023-02-11 11:44:45', NULL, NULL, '', '', NULL, NULL),
(5, '', NULL, NULL, NULL, 'Designer X', NULL, NULL, NULL, NULL, '812512', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 9, NULL, 1, 1, 1, '2023-02-11 11:57:01', '2023-02-11 11:57:01', NULL, NULL, NULL, NULL, NULL, NULL),
(6, '', NULL, NULL, NULL, 'Customer test', NULL, NULL, NULL, NULL, '475475475475', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, NULL, 1, 1, 1, '2023-02-12 05:38:50', '2023-02-12 05:38:50', NULL, NULL, NULL, NULL, NULL, NULL),
(7, '', NULL, NULL, NULL, 'X Ceremic', NULL, NULL, NULL, NULL, '34733848', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 4, NULL, 1, 1, 1, '2023-02-12 05:47:04', '2023-02-12 05:47:04', NULL, NULL, NULL, NULL, NULL, NULL),
(8, '', '', '', NULL, 'X Ceramic', NULL, '', '', NULL, '01745653425', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 4, NULL, 1, 1, 1, '2023-02-12 05:47:59', '2023-02-12 05:47:59', NULL, NULL, '', '', NULL, NULL),
(9, '', '', '', NULL, 'DBBL - Panthapath ', NULL, '', '', NULL, '01747679457', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 5, NULL, 1, 1, 1, '2023-02-12 05:56:45', '2023-02-12 05:56:45', 109, NULL, '', '', NULL, NULL),
(10, '', '', '', NULL, 'DBBL- Gulshan Branch', NULL, '', '', NULL, '01303285469', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 5, NULL, 1, 1, 1, '2023-02-12 05:57:38', '2023-02-12 05:57:38', 110, NULL, '', '', NULL, NULL),
(11, '', '', '', NULL, 'ABC Board Company Ltd', NULL, '', '', NULL, '01745326534', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 4, NULL, 1, 1, 1, '2023-02-23 09:59:28', '2023-02-23 09:59:28', NULL, NULL, '', 'Rampura, Badda, Dhaka', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_category`
--

CREATE TABLE `contact_category` (
  `id` int UNSIGNED NOT NULL,
  `contact_category_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `contact_category_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `contact_category`
--

INSERT INTO `contact_category` (`id`, `contact_category_name`, `contact_category_description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Customer', NULL, 1, 1, '1971-12-22 18:49:20', '1997-01-21 06:47:16'),
(2, 'Agent', NULL, 1, 1, '1979-05-15 15:26:14', '1974-03-17 10:10:59'),
(3, 'Employee', NULL, 1, 1, '1980-03-04 11:23:20', '2000-09-19 12:54:51'),
(4, 'Vendor', NULL, 1, 1, '2015-03-05 03:36:56', '1988-08-02 00:09:56'),
(5, 'Bank', NULL, 1, 1, '1979-05-15 15:26:14', '1974-03-17 10:10:59'),
(6, 'Depo', 'Depo Contacts', 1, 1, '2022-10-12 07:26:07', '2022-10-12 07:26:07'),
(7, 'Distributor', 'Distributor Contacts', 1, 1, '2022-10-16 11:21:30', '2022-10-16 11:21:30'),
(8, 'Retailer', 'Retailer Contacts', 1, 1, '2022-10-16 11:21:50', '2022-10-16 11:21:50'),
(9, 'Factory', 'Category for factories', 1, 1, '2022-11-24 02:15:07', '2022-11-24 02:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `costing_sheet`
--

CREATE TABLE `costing_sheet` (
  `id` int UNSIGNED NOT NULL,
  `item_variation_id` int UNSIGNED NOT NULL,
  `raw_material_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_notes`
--

CREATE TABLE `credit_notes` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `credit_note_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `credit_note_date` date NOT NULL,
  `shiping_charge` double NOT NULL,
  `adjustment` double NOT NULL,
  `total_credit_note` double NOT NULL,
  `available_credit` double NOT NULL,
  `customer_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `terms_and_condition` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `customer_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `credit_notes`
--

INSERT INTO `credit_notes` (`id`, `invoice_id`, `credit_note_number`, `reference`, `credit_note_date`, `shiping_charge`, `adjustment`, `total_credit_note`, `available_credit`, `customer_note`, `terms_and_condition`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `file_url`, `item_category_id`, `item_sub_category_id`, `tax_total`, `serial`) VALUES
(1, NULL, '000001', 'gfdxgbfh', '2023-03-22', 0, 0, 2520, 2520, '', '', 2, 1, 1, '2023-03-22 09:15:11', '2023-03-22 09:15:11', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_entries`
--

CREATE TABLE `credit_note_entries` (
  `id` int UNSIGNED NOT NULL,
  `serial` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `quantity` double NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `rate` double NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `credit_note_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `credit_note_entries`
--

INSERT INTO `credit_note_entries` (`id`, `serial`, `quantity`, `unit_id`, `basic_unit_conversion`, `rate`, `amount`, `discount`, `description`, `item_id`, `variation_id`, `credit_note_id`, `tax_id`, `account_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 21, 1, 1, 120, '2520', '0', '', 24, NULL, 1, 2, 16, 1, 1, '2023-03-22 09:15:11', '2023-03-22 09:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_payments`
--

CREATE TABLE `credit_note_payments` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `credit_note_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_refunds`
--

CREATE TABLE `credit_note_refunds` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_mode_id` int UNSIGNED DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `credit_note_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damage_items`
--

CREATE TABLE `damage_items` (
  `id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `vendor_id` int UNSIGNED NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `damage_items`
--
DELIMITER $$
CREATE TRIGGER `damage_item_create_item_total_damage_add` AFTER INSERT ON `damage_items` FOR EACH ROW BEGIN
UPDATE `item_variations` SET total_damaged = total_damaged + new.quantity WHERE id = new.variation_id;

UPDATE `item` SET total_damaged = total_damaged + new.quantity WHERE id = new.item_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `damage_item_delete_item_total_damage_remove` AFTER DELETE ON `damage_items` FOR EACH ROW BEGIN
UPDATE `item_variations` SET total_damaged = total_damaged - old.quantity WHERE id = old.variation_id;
UPDATE `item` SET total_damaged = total_damaged - old.quantity WHERE id = old.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `damage_item_update_item_total_damage_update` AFTER UPDATE ON `damage_items` FOR EACH ROW BEGIN

UPDATE `item_variations` SET total_damaged = total_damaged - old.quantity + new.quantity WHERE id = new.variation_id;

UPDATE `item` SET total_damaged = total_damaged - old.quantity + new.quantity WHERE id = new.item_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `depo_sales`
--

CREATE TABLE `depo_sales` (
  `id` int UNSIGNED NOT NULL,
  `sales_number` varchar(255) NOT NULL,
  `sales_date` date NOT NULL,
  `seller_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `personal_note` longtext,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depo_sales_entries`
--

CREATE TABLE `depo_sales_entries` (
  `id` int UNSIGNED NOT NULL,
  `depo_sales_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depo_sales_free_entries`
--

CREATE TABLE `depo_sales_free_entries` (
  `id` int UNSIGNED NOT NULL,
  `depo_sales_id` int UNSIGNED NOT NULL,
  `depo_sales_entries_id` int UNSIGNED NOT NULL,
  `offer_id` int UNSIGNED NOT NULL,
  `free_item_id` int UNSIGNED DEFAULT NULL,
  `free_item_variation_id` int UNSIGNED DEFAULT NULL,
  `free_item_quantity` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depo_stock`
--

CREATE TABLE `depo_stock` (
  `id` int NOT NULL,
  `invoice_entries_id` int UNSIGNED NOT NULL,
  `depo_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `purchase_quantity` varchar(255) DEFAULT NULL,
  `sale_quantity` varchar(255) DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depo_stock`
--

INSERT INTO `depo_stock` (`id`, `invoice_entries_id`, `depo_id`, `item_id`, `purchase_quantity`, `sale_quantity`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 25, '80', NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_sales`
--

CREATE TABLE `distributor_sales` (
  `id` int UNSIGNED NOT NULL,
  `sales_number` varchar(255) NOT NULL,
  `seller_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `sales_date` date NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `adjustment` double DEFAULT NULL,
  `adjustment_type` int UNSIGNED DEFAULT '0',
  `shipping_charge` double DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `personal_note` longtext,
  `file_url` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int UNSIGNED NOT NULL,
  `to` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `details` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int UNSIGNED NOT NULL,
  `estimate_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `estimate_request_id` int UNSIGNED NOT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = Not Approved\r\n1 = Approved',
  `ref` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `attn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `attn_designation` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `heading` blob,
  `customer_id` int UNSIGNED NOT NULL,
  `terms_conditions` blob,
  `table_head` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `left_notation` blob,
  `right_notation` blob,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `tax_total` double DEFAULT NULL,
  `due_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_entries`
--

CREATE TABLE `estimate_entries` (
  `id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `rate` double NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `estimate_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_request`
--

CREATE TABLE `estimate_request` (
  `id` int UNSIGNED NOT NULL,
  `contact_id` int UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `requirements` longtext,
  `note` varchar(255) DEFAULT NULL,
  `deadline_date` date NOT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_request_model`
--

CREATE TABLE `estimate_request_model` (
  `id` int UNSIGNED NOT NULL,
  `estimate_request_id` int UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_request_model_entries`
--

CREATE TABLE `estimate_request_model_entries` (
  `id` int UNSIGNED NOT NULL,
  `estimate_request_model_id` int UNSIGNED NOT NULL,
  `length` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `excess_payment`
--

CREATE TABLE `excess_payment` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_receives_id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `paid_through_id` int UNSIGNED NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `vendor_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED DEFAULT NULL,
  `tax_type` int NOT NULL,
  `bank_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cms_site_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `expense_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headertemplate`
--

CREATE TABLE `headertemplate` (
  `id` int UNSIGNED NOT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `headerType` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `headertemplate`
--

INSERT INTO `headertemplate` (`id`, `file_url`, `headerType`, `created_at`, `updated_at`) VALUES
(1, 'uploads/template/banner.png', 0, '2018-12-21 16:59:49', '2021-10-07 10:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `receive_through_id` int UNSIGNED NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `tax_type` int NOT NULL,
  `bank_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `income_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `date`, `amount`, `receive_through_id`, `tax_total`, `reference`, `note`, `account_id`, `customer_id`, `tax_id`, `tax_type`, `bank_info`, `invoice_show`, `created_by`, `updated_by`, `created_at`, `updated_at`, `income_number`, `file_url`) VALUES
(1, '2023-03-22', 10000, 3, 0, '', '', 16, 1, 1, 1, '', 'on', 1, 1, '2023-03-22 09:12:05', '2023-03-22 09:12:05', '1', NULL),
(2, '2023-03-22', 20000, 3, 0, '', 'fgfdhgfhgfhgfhb', 17, 3, 1, 1, '', 'on', 1, 1, '2023-03-22 09:12:33', '2023-03-22 09:12:33', '2', NULL),
(3, '2023-03-22', 15000, 3, 0, '', '', 19, 3, 1, 1, '', 'on', 1, 1, '2023-03-22 09:12:54', '2023-03-22 09:12:54', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int UNSIGNED NOT NULL,
  `invoice_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_type` int UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `customer_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `tax_total` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment_type` int DEFAULT '0',
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `due_amount` double DEFAULT NULL,
  `return_amount` double DEFAULT '0',
  `personal_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `save` tinyint DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `seller_id` int UNSIGNED DEFAULT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_of_installment` int DEFAULT NULL,
  `day_interval` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `agents_id` int UNSIGNED DEFAULT NULL,
  `agentcommissionAmount` double DEFAULT NULL,
  `commission_type` tinyint NOT NULL DEFAULT '0',
  `payment_recieve_id` int UNSIGNED DEFAULT NULL,
  `vat_adjustment` double DEFAULT NULL,
  `tax_adjustment` double DEFAULT NULL,
  `others_adjustment` double DEFAULT NULL,
  `cms_site_id` int UNSIGNED DEFAULT NULL,
  `delivery_person` int UNSIGNED DEFAULT NULL,
  `receive_person` int UNSIGNED DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `invoice_type`, `file_name`, `file_url`, `invoice_date`, `payment_date`, `customer_note`, `tax_total`, `shipping_charge`, `adjustment_type`, `adjustment`, `total_amount`, `due_amount`, `return_amount`, `personal_note`, `save`, `reference`, `item_category_id`, `item_sub_category_id`, `seller_id`, `customer_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `no_of_installment`, `day_interval`, `start_date`, `agents_id`, `agentcommissionAmount`, `commission_type`, `payment_recieve_id`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `cms_site_id`, `delivery_person`, `receive_person`, `receive_date`, `latitude`, `longitude`) VALUES
(2, '000001', 0, NULL, NULL, '2023-03-20', NULL, NULL, 0, 0, 1, 0, 44800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_measurements`
--

CREATE TABLE `invoices_measurements` (
  `id` int UNSIGNED NOT NULL,
  `invoices_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `raw_material_id` int UNSIGNED DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `used_qty` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_due_table`
--

CREATE TABLE `invoice_due_table` (
  `id` int NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `amount` varchar(195) NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_entries`
--

CREATE TABLE `invoice_entries` (
  `id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` int NOT NULL DEFAULT '0',
  `rate` double NOT NULL,
  `rate_type` int UNSIGNED NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `carton` int DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `invoice_entries`
--

INSERT INTO `invoice_entries` (`id`, `quantity`, `unit_id`, `basic_unit_conversion`, `amount`, `discount`, `discount_type`, `rate`, `rate_type`, `description`, `item_id`, `variation_id`, `invoice_id`, `tax_id`, `account_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `carton`, `remarks`, `serial`) VALUES
(2, 80, 2, 1, 44800, 0, 0, 560, 0, NULL, 25, NULL, 2, 1, 16, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_free_entries`
--

CREATE TABLE `invoice_free_entries` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `invoice_entry_id` int UNSIGNED DEFAULT NULL,
  `offer_id` int UNSIGNED DEFAULT NULL,
  `free_item_id` int UNSIGNED DEFAULT NULL,
  `free_item_variation_id` int UNSIGNED DEFAULT NULL,
  `free_item_quantity` int UNSIGNED DEFAULT NULL,
  `offer_amount` int UNSIGNED DEFAULT NULL,
  `offer_amount_type` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `invoice_free_entries`
--
DELIMITER $$
CREATE TRIGGER `invoice_free_create_item_total_sales_add` AFTER INSERT ON `invoice_free_entries` FOR EACH ROW BEGIN

UPDATE `item` SET `total_sales` = `total_sales` + new.free_item_quantity WHERE id = new.free_item_id;

UPDATE `item_variations` SET `total_sales` = `total_sales` + new.free_item_quantity WHERE id = new.free_item_variation_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `invoice_free_delete_item_total_sales_delete` AFTER DELETE ON `invoice_free_entries` FOR EACH ROW BEGIN

UPDATE `item` set `total_sales` = `total_sales` - old.free_item_quantity WHERE `id` = old.free_item_id;

UPDATE `item_variations` SET `total_sales` = `total_sales` - old.free_item_quantity WHERE `id` = old.free_item_variation_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_return_entries`
--

CREATE TABLE `invoice_return_entries` (
  `id` int UNSIGNED NOT NULL,
  `invoice_entries_id` int UNSIGNED DEFAULT NULL,
  `returned_quantity` int DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int UNSIGNED NOT NULL,
  `barcode_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_about` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_sales_rate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_sales_account` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_sales_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `item_sales_tax` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_purchase_rate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_purchase_account` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_purchase_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `reorder_point` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_image_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total_purchases` int NOT NULL DEFAULT '0',
  `total_sales` int NOT NULL DEFAULT '0',
  `total_stock` int NOT NULL DEFAULT '0',
  `unit_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `carton_size` int UNSIGNED NOT NULL DEFAULT '0',
  `item_category_id` int UNSIGNED NOT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `subject_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total_manufacture` int NOT NULL DEFAULT '0',
  `total_use` int NOT NULL DEFAULT '0',
  `total_purchase_return` int NOT NULL DEFAULT '0',
  `total_sale_return` int NOT NULL DEFAULT '0',
  `total_damaged` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `total_stock`, `unit_type`, `unit_id`, `basic_unit_conversion`, `carton_size`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`, `total_sale_return`, `total_damaged`) VALUES
(23, '000023', 'Side Table', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 4, NULL, 1, 1, 1, '2023-03-18 15:15:23', '2023-03-19 07:13:20', NULL, NULL, 2, 0, 0, 0, 0),
(24, '000024', 'Leg Size', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 1, 1, 1, 1, '2023-03-18 15:23:01', '2023-03-22 09:16:21', NULL, NULL, 0, 0, 10, 21, 0),
(25, '000025', 'Glass Fitting SS Disk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 80, 0, '', NULL, NULL, 0, 5, 1, 1, 1, 1, '2023-03-18 15:23:45', '2023-03-20 05:56:31', NULL, NULL, 0, 0, 0, 0, 0),
(26, '000026', 'Glass Fitting Glue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 1, 1, 1, 1, '2023-03-18 15:24:17', '2023-03-22 09:16:59', NULL, NULL, 0, 0, 12, 0, 0),
(27, '000027', 'Clear Color 10.mm Glass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 2, 1, 1, 1, '2023-03-18 15:24:55', '2023-03-18 15:24:55', NULL, NULL, 0, 0, 0, 0, 0),
(31, '000031', 'Lacquer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:28:28', '2023-03-18 15:28:28', NULL, NULL, 0, 0, 0, 0, 0),
(32, '000032', 'Star Screw 2.5\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:29:57', '2023-03-18 15:29:57', NULL, NULL, 0, 0, 0, 0, 0),
(33, '000033', 'Foam Glue (Fevicol)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:30:14', '2023-03-18 15:30:14', NULL, NULL, 0, 0, 0, 0, 0),
(34, '000034', 'Stricker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:30:25', '2023-03-18 15:30:25', NULL, NULL, 0, 0, 0, 0, 0),
(35, '000035', 'Purchase', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:30:37', '2023-03-18 15:30:37', NULL, NULL, 0, 0, 0, 0, 0),
(36, '000036', 'Clean Oil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:30:50', '2023-03-18 15:30:50', NULL, NULL, 0, 0, 0, 0, 0),
(37, '000037', 'Juteles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:31:02', '2023-03-18 15:31:02', NULL, NULL, 0, 0, 0, 0, 0),
(38, '000038', 'Packing and print', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 3, 1, 1, 1, '2023-03-18 15:31:15', '2023-03-18 15:31:15', NULL, NULL, 0, 0, 0, 0, 0),
(39, '000039', 'Labor Charge Wood Works', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 4, 1, 1, 1, '2023-03-18 15:31:29', '2023-03-18 15:31:29', NULL, NULL, 0, 0, 0, 0, 0),
(40, '000040', 'Labor Charge Glass Works', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, 4, 1, 1, 1, '2023-03-18 15:31:39', '2023-03-18 15:31:39', NULL, NULL, 0, 0, 0, 0, 0),
(41, '000041', 'Side Table', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, NULL, 1, 1, 1, '2023-03-19 05:35:55', '2023-03-19 05:35:55', NULL, NULL, 0, 0, 0, 0, 0),
(42, '000042', 'Color Glass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 5, NULL, 1, 1, 1, '2023-03-19 06:16:19', '2023-03-19 06:16:19', NULL, NULL, 0, 0, 0, 0, 0),
(43, '000043', 'table', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 0, 2, 1, 1, 1, 1, '2023-03-19 06:53:18', '2023-03-20 05:22:12', NULL, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_attribute_values`
--

CREATE TABLE `item_attribute_values` (
  `id` int NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `attribute_values_id` int UNSIGNED NOT NULL,
  `measurable` tinyint UNSIGNED NOT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `item_attribute_values`
--

INSERT INTO `item_attribute_values` (`id`, `item_id`, `attribute_values_id`, `measurable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(24, 23, 11, 1, 1, 1, '2023-03-18 15:15:23', '2023-03-18 15:15:23'),
(25, 23, 12, 1, 1, 1, '2023-03-18 15:15:23', '2023-03-18 15:15:23'),
(26, 24, 19, 1, 1, 1, '2023-03-18 15:23:01', '2023-03-18 15:23:01'),
(27, 24, 16, 1, 1, 1, '2023-03-18 15:23:01', '2023-03-18 15:23:01'),
(28, 24, 13, 1, 1, 1, '2023-03-18 15:23:01', '2023-03-18 15:23:01'),
(29, 24, 23, 0, 1, 1, '2023-03-18 15:23:01', '2023-03-18 15:23:01'),
(30, 25, 14, 1, 1, 1, '2023-03-18 15:23:45', '2023-03-18 15:23:45'),
(31, 25, 17, 1, 1, 1, '2023-03-18 15:23:45', '2023-03-18 15:23:45'),
(32, 25, 20, 1, 1, 1, '2023-03-18 15:23:45', '2023-03-18 15:23:45'),
(33, 26, 23, 0, 1, 1, '2023-03-18 15:24:17', '2023-03-18 15:24:17'),
(34, 27, 15, 1, 1, 1, '2023-03-18 15:24:55', '2023-03-18 15:24:55'),
(35, 27, 18, 1, 1, 1, '2023-03-18 15:24:55', '2023-03-18 15:24:55'),
(36, 27, 21, 1, 1, 1, '2023-03-18 15:24:55', '2023-03-18 15:24:55'),
(40, 41, 11, 0, 1, 1, '2023-03-19 05:35:55', '2023-03-19 05:35:55'),
(41, 41, 18, 0, 1, 1, '2023-03-19 05:35:55', '2023-03-19 05:35:55'),
(172, 43, 11, 0, 1, 1, '2023-03-20 05:22:12', '2023-03-20 05:22:12'),
(173, 43, 18, 0, 1, 1, '2023-03-20 05:22:12', '2023-03-20 05:22:12'),
(174, 43, 24, 0, 1, 1, '2023-03-20 05:22:12', '2023-03-20 05:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int UNSIGNED NOT NULL,
  `item_category_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_category_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `category_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `item_category_name`, `item_category_description`, `category_type`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Edible', '', NULL, 1, 1, 1, '2023-01-31 06:03:45', '2023-01-31 06:03:45'),
(2, 'Office Furniture', '', NULL, 1, 1, 1, '2023-02-11 11:13:44', '2023-02-11 11:13:44'),
(4, 'End Product', 'End Product', NULL, 1, 1, 1, '2023-02-12 05:29:17', '2023-02-12 05:29:17'),
(5, 'Raw Materials', 'Raw', NULL, 1, 1, 1, '2023-02-12 04:54:47', '2023-02-12 04:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `item_sub_category`
--

CREATE TABLE `item_sub_category` (
  `id` int UNSIGNED NOT NULL,
  `item_category_id` int UNSIGNED NOT NULL,
  `item_sub_category_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_sub_category_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `item_sub_category`
--

INSERT INTO `item_sub_category` (`id`, `item_category_id`, `item_sub_category_name`, `item_sub_category_description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 'Mehogony Wooden Part', 'Mehogony Wooden Part and Others', 1, 1, '2023-03-16 06:08:21', '2023-03-16 06:08:21'),
(2, 5, 'Clear Glass', 'Glass Related Products\r\n', 1, 1, '2023-03-16 06:08:45', '2023-03-16 06:08:45'),
(3, 5, 'Hardware', 'Hardware Products', 1, 1, '2023-03-16 06:13:39', '2023-03-16 06:13:39'),
(4, 5, 'Labor Charge', 'Labor related services\r\n', 1, 1, '2023-03-16 06:14:07', '2023-03-16 06:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `item_variations`
--

CREATE TABLE `item_variations` (
  `id` int UNSIGNED NOT NULL,
  `variation_name` varchar(255) NOT NULL,
  `carton_size` int UNSIGNED DEFAULT '0',
  `variation_sales_rate` varchar(255) DEFAULT NULL,
  `variation_purchase_rate` varchar(255) DEFAULT NULL,
  `variation_about` varchar(255) DEFAULT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `total_purchases` int UNSIGNED NOT NULL DEFAULT '0',
  `total_purchase_return` int UNSIGNED NOT NULL DEFAULT '0',
  `total_sales` int UNSIGNED NOT NULL DEFAULT '0',
  `total_sale_return` int UNSIGNED NOT NULL DEFAULT '0',
  `total_stock` int UNSIGNED NOT NULL DEFAULT '0',
  `total_damaged` int UNSIGNED NOT NULL DEFAULT '0',
  `total_manufacture` int UNSIGNED NOT NULL DEFAULT '0',
  `total_use` int UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_variation_attribute_values`
--

CREATE TABLE `item_variation_attribute_values` (
  `id` int UNSIGNED NOT NULL,
  `item_variation_id` int UNSIGNED NOT NULL,
  `attribute_values_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int UNSIGNED NOT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `debit_credit` int DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_name_id` int UNSIGNED NOT NULL,
  `jurnal_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `journal_id` int UNSIGNED DEFAULT NULL,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `income_id` int UNSIGNED DEFAULT NULL,
  `payment_receives_id` int UNSIGNED DEFAULT NULL,
  `payment_receives_entries_id` int UNSIGNED DEFAULT NULL,
  `credit_note_id` int UNSIGNED DEFAULT NULL,
  `credit_note_refunds_id` int UNSIGNED DEFAULT NULL,
  `expense_id` int UNSIGNED DEFAULT NULL,
  `bill_id` int UNSIGNED DEFAULT NULL,
  `bank_id` int UNSIGNED DEFAULT NULL,
  `bill_entry_id` int UNSIGNED DEFAULT NULL,
  `payment_made_id` int UNSIGNED DEFAULT NULL,
  `payment_made_entry_id` int UNSIGNED DEFAULT NULL,
  `contact_id` int UNSIGNED DEFAULT NULL,
  `tax_id` int UNSIGNED DEFAULT NULL,
  `pr_adjustment_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `salesComission_id` int UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `vendor_credit_id` int UNSIGNED DEFAULT NULL,
  `vendor_credit_refunds_id` int UNSIGNED DEFAULT NULL,
  `recurring_invoice_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `note`, `debit_credit`, `amount`, `account_name_id`, `jurnal_type`, `journal_id`, `invoice_id`, `income_id`, `payment_receives_id`, `payment_receives_entries_id`, `credit_note_id`, `credit_note_refunds_id`, `expense_id`, `bill_id`, `bank_id`, `bill_entry_id`, `payment_made_id`, `payment_made_entry_id`, `contact_id`, `tax_id`, `pr_adjustment_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `assign_date`, `salesComission_id`, `agent_id`, `vendor_credit_id`, `vendor_credit_refunds_id`, `recurring_invoice_id`) VALUES
(74, '', 0, -100, 110, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 8, NULL, NULL, 1, 1, '2023-03-19 05:01:35', '2023-03-19 05:30:23', '2023-03-19', NULL, NULL, NULL, NULL, NULL),
(75, '', 1, -100, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 8, NULL, NULL, 1, 1, '2023-03-19 05:01:35', '2023-03-19 05:30:23', '2023-03-19', NULL, NULL, NULL, NULL, NULL),
(76, '', 0, -2000, 110, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, 8, NULL, NULL, 1, 1, '2023-03-19 05:39:45', '2023-03-19 05:39:45', '2023-03-19', NULL, NULL, NULL, NULL, NULL),
(77, '', 1, -2000, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, 8, NULL, NULL, 1, 1, '2023-03-19 05:39:45', '2023-03-19 05:39:45', '2023-03-19', NULL, NULL, NULL, NULL, NULL),
(78, NULL, 1, 44800, 5, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(79, NULL, 0, 44800, 16, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(80, NULL, 1, 44800, 3, 'payment_receive2', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(81, NULL, 0, 44800, 10, 'payment_receive2', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(82, NULL, 0, 44800, 5, 'payment_receive1', NULL, 2, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(83, NULL, 1, 44800, 10, 'payment_receive1', NULL, 2, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', '2023-03-20', NULL, NULL, NULL, NULL, NULL),
(84, NULL, 1, 1500, 4, 'fake', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-03-07', NULL, NULL, NULL, NULL, NULL),
(85, NULL, 0, 1500, 3, 'fake', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-03-16', NULL, NULL, NULL, NULL, NULL),
(86, NULL, 1, 3500, 3, 'fake', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-03-10', NULL, NULL, NULL, NULL, NULL),
(87, NULL, 0, 3500, 4, 'fake', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-03-12', NULL, NULL, NULL, NULL, NULL),
(88, '', 1, 10000, 3, 'income', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2023-03-22 09:12:05', '2023-03-22 09:12:05', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(89, '', 0, 10000, 16, 'income', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2023-03-22 09:12:05', '2023-03-22 09:12:05', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(90, '', 0, 0, 9, 'income', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2023-03-22 09:12:05', '2023-03-22 09:12:05', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(91, 'fgfdhgfhgfhgfhb', 1, 20000, 3, 'income', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:33', '2023-03-22 09:12:33', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(92, 'fgfdhgfhgfhgfhb', 0, 20000, 17, 'income', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:33', '2023-03-22 09:12:33', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(93, 'fgfdhgfhgfhgfhb', 0, 0, 9, 'income', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:33', '2023-03-22 09:12:33', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(94, '', 1, 15000, 3, 'income', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:54', '2023-03-22 09:12:54', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(95, '', 0, 15000, 19, 'income', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:54', '2023-03-22 09:12:54', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(96, '', 0, 0, 9, 'income', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2023-03-22 09:12:54', '2023-03-22 09:12:54', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(97, 'fdxgfdggfgh', 1, 12000, 3, 'payment_receive2', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2023-03-22 09:13:52', '2023-03-22 09:13:52', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(98, 'fdxgfdggfgh', 0, 12000, 10, 'payment_receive2', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2023-03-22 09:13:52', '2023-03-22 09:13:52', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(99, '', 1, 13000, 3, 'payment_receive2', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-22 09:14:05', '2023-03-22 09:14:05', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(100, '', 0, 13000, 10, 'payment_receive2', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1, 1, '2023-03-22 09:14:05', '2023-03-22 09:14:05', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(101, NULL, 0, 2520, 5, '11', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2023-03-22 09:15:11', '2023-03-22 09:15:11', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(102, NULL, 1, 2520, 16, '11', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2023-03-22 09:15:11', '2023-03-22 09:15:11', '2023-03-22', NULL, NULL, NULL, NULL, NULL),
(103, NULL, 1, 1000, 11, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 1, 1, '2023-03-22 09:16:21', '2023-03-22 09:16:21', '2023-03-22', NULL, NULL, 1, NULL, NULL),
(104, NULL, 0, 1000, 26, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 1, 1, '2023-03-22 09:16:21', '2023-03-22 09:16:21', '2023-03-22', NULL, NULL, 1, NULL, NULL),
(105, NULL, 1, 1440, 11, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 1, 1, '2023-03-22 09:16:59', '2023-03-22 09:16:59', '2023-03-22', NULL, NULL, 2, NULL, NULL),
(106, NULL, 0, 1440, 26, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 1, 1, '2023-03-22 09:16:59', '2023-03-22 09:16:59', '2023-03-22', NULL, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `id` int UNSIGNED NOT NULL,
  `bill_of_material_id` int UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'incomplete',
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`id`, `bill_of_material_id`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 10, '2023-03-19', '2023-03-19', 'complete', 1, 1, '2023-03-19 07:12:44', '2023-03-19 07:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_entries`
--

CREATE TABLE `manufacture_entries` (
  `id` int UNSIGNED NOT NULL,
  `manufacture_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `required_quantity` double NOT NULL,
  `manufacture_quantity` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture_entries`
--

INSERT INTO `manufacture_entries` (`id`, `manufacture_id`, `item_id`, `variation_id`, `required_quantity`, `manufacture_quantity`) VALUES
(6, 6, 23, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_phases`
--

CREATE TABLE `manufacture_phases` (
  `id` int UNSIGNED NOT NULL,
  `phase_name` varchar(255) NOT NULL,
  `manufacture_id` int UNSIGNED NOT NULL,
  `factory_id` int UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'incomplete',
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture_phases`
--

INSERT INTO `manufacture_phases` (`id`, `phase_name`, `manufacture_id`, `factory_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(8, 'New Phase', 6, 2, 'complete', 1, 1, '2023-03-19 07:12:44', '2023-03-19 07:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_phase_disburse`
--

CREATE TABLE `manufacture_phase_disburse` (
  `id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `manufacture_phase_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture_phase_disburse`
--

INSERT INTO `manufacture_phase_disburse` (`id`, `date`, `manufacture_phase_id`, `item_id`, `variation_id`, `quantity`, `unit_id`, `basic_unit_conversion`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '2023-03-19', 8, 24, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(3, '2023-03-19', 8, 25, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(4, '2023-03-19', 8, 26, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(5, '2023-03-19', 8, 27, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(6, '2023-03-19', 8, 31, NULL, 6, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(7, '2023-03-19', 8, 32, NULL, 24, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(8, '2023-03-19', 8, 33, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(9, '2023-03-19', 8, 34, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(10, '2023-03-19', 8, 35, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(11, '2023-03-19', 8, 36, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(12, '2023-03-19', 8, 37, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(13, '2023-03-19', 8, 38, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(14, '2023-03-19', 8, 39, NULL, 2, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(15, '2023-03-19', 8, 40, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44');

--
-- Triggers `manufacture_phase_disburse`
--
DELIMITER $$
CREATE TRIGGER `manufacture_disbure_stock_in` AFTER DELETE ON `manufacture_phase_disburse` FOR EACH ROW BEGIN

UPDATE `item_variations` SET `total_use` = `total_use` - old.quantity WHERE id = old.variation_id;

UPDATE `item` SET `total_use` = `total_use` - old.quantity WHERE id = (SELECT `item_id` FROM `item_variations` WHERE `id` = old.variation_id);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `manufacture_disbure_stock_out` AFTER INSERT ON `manufacture_phase_disburse` FOR EACH ROW BEGIN

UPDATE `item_variations` SET `total_use` = `total_use` + new.quantity WHERE id = new.variation_id;

UPDATE `item` SET `total_use` = `total_use` + new.quantity WHERE id = (SELECT `item_id` FROM `item_variations` WHERE `id` = new.variation_id);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_phase_raw_materials`
--

CREATE TABLE `manufacture_phase_raw_materials` (
  `id` int UNSIGNED NOT NULL,
  `manufacture_phase_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `quantity` double UNSIGNED DEFAULT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture_phase_raw_materials`
--

INSERT INTO `manufacture_phase_raw_materials` (`id`, `manufacture_phase_id`, `item_id`, `variation_id`, `quantity`, `unit_id`, `basic_unit_conversion`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 8, 24, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(3, 8, 25, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(4, 8, 26, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(5, 8, 27, NULL, 4, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(6, 8, 31, NULL, 6, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(7, 8, 32, NULL, 24, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(8, 8, 33, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(9, 8, 34, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(10, 8, 35, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(11, 8, 36, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(12, 8, 37, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(13, 8, 38, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(14, 8, 39, NULL, 2, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44'),
(15, 8, 40, NULL, 1, NULL, NULL, 1, 1, '2023-03-19 13:12:44', '2023-03-19 13:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_phase_receive_from_factory`
--

CREATE TABLE `manufacture_phase_receive_from_factory` (
  `id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `manufacture_phase_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_01_18_092901_create_user_activations_table', 1),
(4, '2017_02_02_053156_create_branch_table', 1),
(5, '2017_02_02_053157_create_contact_category_table', 1),
(6, '2017_02_02_053222_create_agents_table', 1),
(7, '2017_02_02_053223_create_contact_table', 1),
(8, '2017_02_02_053225_create_customer_file_table', 1),
(9, '2017_02_10_044930_create_payment_mode_table', 1),
(10, '2017_02_10_044940_create_parent_account_type_table', 1),
(11, '2017_02_10_045717_create_account_type_table', 1),
(12, '2017_02_10_045727_create_account_table', 1),
(13, '2017_02_11_053630_create_tax_table', 1),
(14, '2017_02_11_053631_create_journal_table', 1),
(15, '2017_02_13_181447_create_item_category_table', 1),
(16, '2017_02_13_181545_create_item_table', 1),
(17, '2017_02_13_181719_create_product_table', 1),
(18, '2017_02_13_181753_create_product_phase_table', 1),
(19, '2017_02_13_181830_create_product_phase_item_table', 1),
(20, '2017_02_20_060418_create_modules_table', 1),
(21, '2017_02_20_060419_create_roles_table', 1),
(22, '2017_02_20_060456_create_access_level_table', 1),
(23, '2017_02_20_170318_create_product_phase_item_add_table', 1),
(24, '2017_03_09_071116_create_organization_profiles_table', 1),
(25, '2017_04_28_174719_create_invoices_table', 1),
(26, '2017_04_28_174745_create_invoice_entries_table', 1),
(27, '2017_04_29_161315_create_payment_receives_table', 1),
(28, '2017_04_29_161316_create_payment_receives_entries_table', 1),
(29, '2017_04_29_161406_create_credit_notes_table', 1),
(30, '2017_04_29_161420_create_credit_note_entries_table', 1),
(31, '2017_04_29_161439_create_credit_note_payments_table', 1),
(32, '2017_04_29_161458_create_credit_note_refunds_table', 1),
(33, '2017_05_05_033709_create_excess_payment_table', 1),
(34, '2015_07_15_171523_create_cms_site_table', 2),
(35, '2017_06_06_230649_create_bill_table', 2),
(36, '2017_06_06_230649_create_stock_table', 2),
(37, '2017_06_06_230716_create_bill_entry_table', 2),
(38, '2017_06_06_230904_create_payment_made_table', 2),
(39, '2017_06_06_230920_create_payment_made_entry_table', 2),
(40, '2017_07_02_093820_create_company_table', 2),
(41, '2017_07_02_093908_create_okala_table', 2),
(42, '2017_07_02_093955_create_fingerprint_table', 2),
(43, '2017_07_02_101441_create_recruitingorder_table', 2),
(44, '2017_07_02_101445_create_order_file_table', 2),
(45, '2017_07_02_101541_create_manpower_table', 2),
(46, '2017_07_02_101545_create_flight_table', 2),
(47, '2017_07_02_101552_create_relation_table', 2),
(48, '2017_07_02_111525_create_visaentrys_table', 2),
(49, '2017_07_02_112834_create_mofas_table', 2),
(50, '2017_07_02_112844_create_mofa_file_table', 2),
(51, '2017_07_02_113905_create_visa_entry_file_table', 2),
(52, '2017_07_02_113911_create_relation_mofa_visa_table', 2),
(53, '2017_07_02_114007_create_medicalSlip_table', 2),
(54, '2017_07_02_114017_create_report_file_table', 2),
(55, '2017_07_02_114116_create_musaned_table', 2),
(56, '2017_07_02_114223_create_visaStamping_table', 2),
(57, '2017_07_02_114225_create_stampingApproval_table', 2),
(58, '2017_07_02_120151_create_relation_Stam_table', 2),
(59, '2017_07_03_102404_create_visas_table', 2),
(60, '2017_07_09_053945_create_form_basis_table', 2),
(61, '2017_07_09_054306_create_medical_slip_form_table', 2),
(62, '2017_07_09_054337_create_medical_slip_form_pax_table', 2),
(63, '2017_07_09_054343_create_recruit_customer_table', 2),
(64, '2017_07_09_054400_create_medical_slip_form_pax_relation_table', 2),
(65, '2017_07_09_072348_create_bank_table', 2),
(66, '2017_07_09_105254_create_document_cat_table', 2),
(67, '2017_07_09_105323_create_document_table', 2),
(68, '2017_07_09_105359_document_category_relation_table', 2),
(69, '2017_07_10_071211_add_extracolumn_to_company_table', 2),
(70, '2017_07_10_071504_add_extracolumn_to_recruting_table', 2),
(71, '2017_07_10_102221_create_expensesector_table', 2),
(72, '2017_07_10_102313_create_recruiteexpense_table', 2),
(73, '2017_07_10_102346_create_expense_pax_table', 2),
(74, '2017_07_10_103128_create_expense_sector_pax_relation_table', 2),
(75, '2017_07_11_044752_create_agreement_paper_table', 2),
(76, '2017_07_11_044810_create_agreement_paper_pax_table', 2),
(77, '2017_07_11_044830_create_agreement_paper_pax_relation_table', 2),
(78, '2017_07_12_033953_create_incomes_table', 2),
(79, '2017_07_13_034016_create_visaacceptance_table', 2),
(80, '2017_07_13_034117_create_gamca_table', 2),
(81, '2017_07_13_034123_create_visa_process_report_table', 2),
(82, '2017_07_13_034137_create_visaacceptance_relation_table', 2),
(83, '2017_07_15_041806_add_namear_to_company_table', 2),
(84, '2017_07_15_042901_create_visaforms_table', 2),
(85, '2017_07_15_043020_create_visaformbulks_table', 2),
(86, '2017_07_15_043043_create_visaformagreement_table', 2),
(87, '2017_07_15_043130_create_visaform_and_bulk_relation_table', 2),
(88, '2017_07_15_043201_create_visaform_and_agreement_relation', 2),
(89, '2017_07_15_065551_add_submissiondate_to_visaentry_table', 2),
(90, '2017_07_16_063504_add_so_cloumn_to_visaform_table', 2),
(91, '2017_07_16_085859_add_Qualification_cloumn_to_recruitcustomer_table', 2),
(92, '2017_07_16_091948_create_immigration_clearance_table', 2),
(93, '2017_07_16_092030_create_immigration_clearance_pax_table', 2),
(94, '2017_07_16_092527_create_immigration_clearance_pax_relation_table', 2),
(95, '2017_07_19_064337_create_TicketTaxs_table', 2),
(96, '2017_07_19_070312_create_Ticketcommission_table', 2),
(97, '2017_07_19_071729_create_TicketTaxsrelation_users_table', 2),
(98, '2017_07_20_051731_create_note_sheet_table', 2),
(99, '2017_07_20_051753_create_note_sheet_pax_table', 2),
(100, '2017_07_20_051813_create_note_sheet_pax_relation_table', 2),
(101, '2017_07_20_063113_create_airline_table', 2),
(102, '2017_07_20_063202_create_airline_tax_table', 2),
(103, '2017_07_20_063236_create_ticket_hotel_table', 2),
(104, '2017_07_20_063237_create_airline_tax_relation_table', 2),
(105, '2017_07_20_063255_create_ticket_order_table', 2),
(106, '2017_07_20_063270_create_ticket_order_tax_table', 2),
(107, '2017_07_20_063316_create_ticket_order_relation_table', 2),
(108, '2017_07_20_085916_create_ticket_airlines_relation_table', 2),
(109, '2017_07_22_060301_add_order_id_to_tikcetorder_table', 2),
(110, '2017_07_22_064357_create_ticket_document_table', 2),
(111, '2017_07_22_065222_create_ticket_relation_table', 2),
(112, '2017_07_22_091918_create_backup_table', 2),
(113, '2017_07_22_125915_add_tikestan_to_backup_table', 2),
(114, '2017_07_23_072134_create_openingbalance_table', 2),
(115, '2017_07_25_051426_add_column_to_invoices_table', 2),
(116, '2017_07_25_101612_add_relationinvoice_to_invoices_table', 2),
(117, '2017_07_25_102109_create_salesComissions_table', 2),
(118, '2017_07_26_051806_add_column_tosalesComissions_table', 2),
(119, '2017_07_26_064942_add_amount_column_tosalesComissions_table', 2),
(120, '2017_07_26_121050_add_paidthrow_column_tosalesComissions_table', 2),
(121, '2017_07_29_000713_create_table_reminders_', 2),
(122, '2017_08_01_152513_create_email_table', 2),
(123, '2017_08_01_152617_create_email_relation_table', 2),
(124, '2017_08_01_173308_create_table_estimate', 2),
(125, '2017_08_01_173337_create_table_estimate_entries', 2),
(126, '2017_08_12_153258_add_aaccount_id_to_contact_table', 2),
(127, '2017_08_13_173159_create_backupshcedule_table', 2),
(128, '2017_08_20_153506_create_invoice_header_type_table', 2),
(129, '2017_08_26_181345_add_etin_to_organizationprofil_table', 2),
(130, '2017_08_27_094335_create_price_lists_table', 2),
(131, '2017_08_27_170652_add_expensenumner_to_users_table', 2),
(132, '2017_08_27_170737_add_income_numner_to_users_table', 2),
(133, '2017_09_11_111239_create_account_information_forms_table', 2),
(134, '2017_09_15_144125_create_conveyance_bills_table', 2),
(135, '2017_09_16_104832_create_conveyance_bill_lists_table', 2),
(136, '2017_09_20_115019_create_manpower_service_table', 2),
(137, '2017_09_20_130709_create_manpower_service_ticket_document_table', 2),
(138, '2017_09_20_152819_create_manpower_service_progress_status_table', 2),
(139, '2017_09_20_165633_create_manpower_service_relation_table', 2),
(140, '2017_09_24_113740_create_module_delete', 2),
(141, '2017_09_25_162241_create_reciption_categories_table', 2),
(142, '2017_09_25_162312_create_reciption_logbooks_table', 2),
(143, '2017_09_26_151605_add_location_to_branch_table', 2),
(144, '2017_09_27_152430_add_craetedby_updated_by_to_estimates_table', 2),
(145, '2017_10_03_161718_add_save_to_bill_table', 2),
(146, '2017_10_04_112216_add_save_to_expense_table', 2),
(147, '2017_10_08_124104_create_gamca_receive_submit_table', 2),
(148, '2017_10_08_124114_create_arrivel_recruit_table', 2),
(149, '2017_10_08_124142_create_gamca_file_table', 2),
(150, '2017_10_08_124854_create_gamca_file_relation_table', 2),
(151, '2017_10_09_163650_create_finger_print_files_table', 2),
(152, '2017_10_10_152202_create_trainings_table', 2),
(153, '2017_10_10_152220_create_training_files_table', 2),
(154, '2017_10_10_171208_create_completions_table', 2),
(155, '2017_10_10_171221_create_completion_files_table', 2),
(156, '2017_10_10_182235_create_fit_card_table', 2),
(157, '2017_10_10_182315_create_police_clearances_table', 2),
(158, '2017_10_10_182328_create_police_clearance_files_table', 2),
(159, '2017_10_10_182339_create_fit_card_file_table', 2),
(160, '2017_10_11_120209_create_submission_table', 2),
(161, '2017_10_11_120244_create_submission_file_table', 2),
(162, '2017_10_11_120250_create_fit_card_relation_table', 2),
(163, '2017_10_11_130916_create_confirmations_table', 2),
(164, '2017_10_11_130930_create_confirmation_files_table', 2),
(165, '2017_10_22_114851_create_customersubreference_table', 2),
(166, '2017_10_24_155236_add_votes_to_item_table', 2),
(167, '2017_10_26_120459_create_challanForm_table', 2),
(168, '2017_10_29_161460_create_journal_entries_table', 2),
(169, '2017_10_30_153235_add_assigndate_to_journalentrys_table', 2),
(170, '2017_10_30_164053_add_passport_number_to_ticketorder_table', 2),
(171, '2017_11_01_152143_add_passport_number_to_manpoerservice_table', 2),
(172, '2017_11_11_104338_create_iqamaapproval_table', 2),
(173, '2017_11_11_165620_add_column_to_invoice_entries_table', 2),
(174, '2017_11_12_103948_add_payment_recieve_id_to_invoices_table', 2),
(175, '2017_11_13_102150_add_column_to_recruit_order_table', 2),
(176, '2017_11_13_153129_drop_column_to_visa_entries_table', 2),
(177, '2017_11_13_171928_add_column_to_challan_form_table', 2),
(178, '2017_11_13_180159_add_new_column_challanform_table', 2),
(179, '2017_11_16_154015_create_recieve_table', 2),
(180, '2017_11_16_154156_create_iqama_submissions_table', 2),
(181, '2017_11_16_154219_create_insurance_table', 2),
(182, '2017_11_19_103720_create_iqama_clearance_table', 2),
(183, '2017_11_19_150619_create_iqama_receipient_table', 2),
(184, '2017_11_19_172513_add_comission_to_recruitingorder_table', 2),
(185, '2017_11_20_111124_create_iqamaacknowledgements_table', 2),
(186, '2017_11_20_173630_create_kafalas_table', 2),
(187, '2017_11_21_120952_add_visa_type_to_users_table', 2),
(188, '2017_11_22_100945_create_aftersixydays_table', 2),
(189, '2017_11_22_163439_add_cancel_for_okala_to_visaentrys_table', 2),
(190, '2017_11_23_145734_add_parent_id_to_customer_sub_reference_table', 2),
(191, '2017_11_23_155124_add_sales_commission_id_to_recruiteexpense', 2),
(192, '2017_11_27_070356_add__column_to_journal_entries_table', 2),
(193, '2017_11_27_160109_add_column_relational_passenger_to_iqamarecipient', 2),
(194, '2017_11_28_091327_add_column_upload_and_comments_to_iqamaclearance', 2),
(195, '2017_12_04_122256_create_pms__sites_table', 2),
(196, '2017_12_04_122617_create_pms__employees_table', 2),
(197, '2017_12_06_101105_add_name_to_pms_employees_table', 2),
(198, '2017_12_06_105249_add_coloum_remarks_to_stamping_approval', 2),
(199, '2017_12_06_161426_add_column_last_invoice_amount_to_recruitingorder', 2),
(200, '2017_12_06_171754_create_pms_sectors_table', 2),
(201, '2017_12_07_084328_add_column_ticket_approval_to_submission_table', 2),
(202, '2017_12_11_153022_add_column_reference_to_invoices', 2),
(203, '2017_12_14_172629_add_daily_work_hour_to_pms_employee', 2),
(204, '2017_12_18_142027_create_ticket_refunds_table', 2),
(205, '2017_12_19_123830_create_ticket_refund_others_table', 2),
(206, '2017_12_19_162639_create_contact_user_defined_function', 2),
(207, '2017_12_23_152947_add_coloum_overtime_amount_per_hour_to_pms_employee', 2),
(208, '2017_12_24_165712_create_pms_leave_settings_table', 2),
(209, '2017_12_24_165807_create_pms_leave_assigns_table', 2),
(210, '2017_12_27_105257_add_craetedby_updated_by_to_branch_table', 2),
(211, '2017_12_30_175116_create_invoice_return_entries_table', 2),
(212, '2018_01_01_100621_drop_pr_adjustment_and_note_from_invoices_table', 2),
(213, '2018_01_01_171033_create_bill_return_entries_table', 2),
(214, '2018_01_07_124433_add_remarks_column_to_recruitingorder', 2),
(215, '2018_01_07_160317_add_unit_type_column_to_item', 2),
(216, '2018_01_09_130259_add_column_invoice_bill_to_ticket_refund_others_table', 2),
(217, '2018_01_15_123101_create_pms_assign_allowances_table', 2),
(218, '2018_01_15_123130_create_pms_assign_deductions_table', 2),
(219, '2018_01_15_151835_create_pms_payroll_sheets_table', 2),
(220, '2018_01_15_170333_create_pms_payslips_table', 2),
(221, '2018_01_15_171429_create_pms_payslip_allowances_table', 2),
(222, '2018_01_15_171445_create_pms_payslip_deductions_table', 2),
(223, '2018_01_16_141349_create_pms_companies_table', 2),
(224, '2018_01_16_152355_create_pms_invoices_table', 2),
(225, '2018_01_17_095206_create_pms_settings_table', 2),
(226, '2018_01_18_171500_add_column_pms_company_id_to_pms_payroll_sheets', 2),
(227, '2018_01_20_095559_add_number_column_to_pms_payslips_table', 2),
(228, '2018_01_20_103406_create_pms_expense_sector_table', 2),
(229, '2018_01_21_112316_create_pms_receipts_table', 2),
(230, '2018_01_22_100055_create_setting_currencies_table', 2),
(231, '2018_01_22_100123_create_setting_currency_rates_table', 2),
(232, '2018_02_10_125110_create_pms_account_type_table', 2),
(233, '2018_02_10_130707_create_pms_account_sub_type_table', 2),
(234, '2018_02_10_141306_create_pms_account_table', 2),
(235, '2018_02_10_142654_create_pms_contact_category_table', 2),
(236, '2018_02_10_143051_create_pms_contact_table', 2),
(237, '2018_02_10_144904_create_pms_holiday_table', 2),
(238, '2018_02_10_150337_create_pms_advance_payment_table', 2),
(239, '2018_02_10_153142_create_pms_income_table', 2),
(240, '2018_02_11_103344_create_pmsexpenses_table', 2),
(241, '2018_02_11_104141_create_pms_payslips_payments_table', 2),
(242, '2018_02_11_145123_create_pms_expenses_payments_table', 2),
(243, '2018_04_04_104223_create_item_sub_category_table', 2),
(244, '2016_06_06_230413_create_expense_table', 3),
(245, '2018_07_17_094101_create_bill_submit_table', 3),
(246, '2018_08_15_092633_create_cms_deduction_sector_table', 3),
(247, '2018_08_15_092652_create_cms_invoices_table', 4),
(248, '2018_08_15_092654_create_cms_deduction_table', 4),
(249, '2018_09_19_155039_add_file_url_to_users_table', 4),
(250, '2018_12_07_091736_create_pms_attendance_table', 4),
(251, '2018_12_14_124217_add_coloum_absense_to_pms_attendance_table', 4),
(252, '2018_12_20_150755_add_column_overtime_to_pms_attendance', 4),
(253, '2019_09_27_125739_createlocktransaction_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int UNSIGNED NOT NULL,
  `module_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `module_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES
(1, 'Contact', 'contact', '1973-04-15 14:24:06', '1970-02-17 23:40:51'),
(2, 'Contact Category', 'contact/category', '1980-12-15 00:30:11', '2004-08-23 18:21:48'),
(3, 'Account Chart', 'account-chart', '1984-11-04 11:25:32', '2011-04-07 19:16:26'),
(4, 'Inventory Item', 'inventory', '1975-12-31 16:37:21', '2011-01-16 12:38:00'),
(5, 'Inventory Category', 'inventory/category', '2008-12-22 16:08:37', '2016-07-14 17:14:45'),
(6, 'Stock Management', 'stock-management', '1995-11-01 15:06:00', '1993-06-11 04:55:21'),
(8, 'Manual Journal', 'manual-journal', '1985-07-21 16:50:23', '1999-05-02 23:58:28'),
(9, 'Bill', 'bill', '1978-10-08 14:33:25', '1991-03-03 16:30:42'),
(10, 'Credit Note', 'credit-note', '1982-09-23 20:04:00', '1991-02-23 23:22:01'),
(11, 'Credit Note Refund ', 'credit-note/refund', '1978-01-16 21:09:58', '1979-01-26 23:42:35'),
(12, 'Expense', 'expense', '1996-12-24 14:40:00', '2013-09-11 14:27:43'),
(13, 'Inventory', 'inventory', '1995-09-10 06:17:06', '1979-07-22 08:01:26'),
(14, 'Inventory Category', 'inventory/category', '1991-02-02 10:48:09', '1984-12-05 03:56:04'),
(15, 'Invoice', 'invoice', '2012-10-12 07:07:30', '2010-03-05 12:20:41'),
(16, 'Payment Made', 'payment-made', '1995-09-06 11:51:58', '1989-05-12 20:07:45'),
(17, 'Payment Received', 'payment-received', '2011-08-19 14:12:27', '1985-12-17 10:29:44'),
(18, 'Report', 'report', '2013-10-04 18:20:55', '1993-04-01 00:12:54'),
(19, 'Stock Transfer', 'stock-transfer', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(20, 'Bank', 'bank', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(21, 'Income', 'income', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(23, 'Sales Commission', 'Commission/Sales', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(115, 'Bill Submit', 'billsubmit', '2018-01-26 20:00:00', '2018-01-26 20:00:00'),
(116, 'CRM Dailylog', 'crm/dailylog', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(117, 'CRM Status', 'crm/status', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(118, 'CRM Software Type', 'crm/software/type', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(119, 'CRM Bussiness Type', 'crm/bussiness/type', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(120, 'CRM Zone', 'crm/zone', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(121, 'CRM Report', 'crmreport', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(122, 'Discount Management', 'offerdiscountmanagement/offers', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(123, 'Offer Calculate', 'offerdiscountmanagement/offers/calculate', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(124, 'Discount Stickers', 'offerdiscountmanagement/discount-strickers', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(125, 'Pos', 'get-pos', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(126, 'Invoice Measurements', 'invoice-measurements', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(127, 'Point of sales', 'point-of-sales', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(128, 'Excel', 'excel', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(129, 'Attributes', 'attributes', '2022-09-01 07:16:46', '2022-08-31 18:00:00'),
(130, 'Estimate', 'estimate', '2022-09-27 20:40:40', '2022-09-27 18:00:00'),
(131, 'Offer', 'offer', '2022-09-27 20:41:12', '2022-09-27 18:00:00'),
(132, 'Estimate Request', 'estimate-request', '2022-10-25 18:00:00', NULL),
(133, 'Product Track', 'product-track', '2022-10-31 03:27:34', '2022-10-31 03:27:34'),
(134, 'Costing Sheet', 'costing-sheet', '2022-11-23 08:07:44', '2022-11-23 08:07:44'),
(135, 'Cheque Book', 'cheque-book', '2022-11-06 04:05:06', '2022-11-06 04:05:06');

--
-- Triggers `modules`
--
DELIMITER $$
CREATE TRIGGER `create_access_level_after_module_create` AFTER INSERT ON `modules` FOR EACH ROW BEGIN
	DECLARE total_rows INT DEFAULT 0;
	DECLARE loop_index INT DEFAULT 0;
	SELECT COUNT(*) FROM roles INTO total_rows;
	SET loop_index=0;
	WHILE loop_index<total_rows DO 
  		INSERT INTO access_level(`role_id`, `module_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES ((SELECT (`id`) FROM roles LIMIT loop_index,1), new.id, (SELECT (`id`) FROM users LIMIT 0 ,1), (SELECT (`id`) FROM users LIMIT 0 ,1), new.created_at, new.updated_at);
  		SET loop_index = loop_index + 1;
	END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `item_variation_id` int UNSIGNED DEFAULT NULL,
  `base_quantity` int UNSIGNED NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `free_item_id` int UNSIGNED DEFAULT NULL,
  `free_item_variation_id` int UNSIGNED DEFAULT NULL,
  `free_quantity` int UNSIGNED DEFAULT NULL,
  `cashback_amount` double UNSIGNED DEFAULT NULL,
  `cashback_type` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization_profiles`
--

CREATE TABLE `organization_profiles` (
  `id` int UNSIGNED NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `street` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `quotation_header` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vat_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `show_all_contact` int DEFAULT '1',
  `show_all_item` int UNSIGNED DEFAULT '1',
  `costing_sheet` int UNSIGNED NOT NULL,
  `hrms` int UNSIGNED NOT NULL,
  `unit_settings_status` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `organization_profiles`
--

INSERT INTO `organization_profiles` (`id`, `logo`, `display_name`, `company_name`, `street`, `city`, `state`, `country`, `zip_code`, `website`, `quotation_header`, `contact_number`, `email`, `created_at`, `updated_at`, `etin`, `vat_number`, `show_all_contact`, `show_all_item`, `costing_sheet`, `hrms`, `unit_settings_status`) VALUES
(1, 'logo.png', 'Inova Furniture Ltd', 'Inova Furniture Ltd', 'Gagan Shirish (1st Floor) 76 & 76, 1 ', 'Panthapath', 'Dhaka', 'Bangladesh', '1215', '', '{\"heading\":\"<p>Heading<\\/p>\\r\\n\",\"table_head\":\"Table Head\",\"terms_conditions\":\"<p>Terms and Condition<\\/p>\\r\\n\",\"left_notation\":\"<p>Left Notation<\\/p>\\r\\n\",\"right_notation\":\"<p>Right Notation<\\/p>\\r\\n\"}', '8801996704612', 'info@inova-bd.com', '2018-01-02 09:16:42', '2023-03-19 07:12:14', '', '', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parent_account_type`
--

CREATE TABLE `parent_account_type` (
  `id` int UNSIGNED NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `parent_account_type`
--

INSERT INTO `parent_account_type` (`id`, `account_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 'Assets', '1986-03-24 20:19:46', '1998-11-03 13:19:41'),
(2, 'Liability', 'Liability', '1976-10-21 04:38:54', '2002-10-17 15:03:47'),
(3, 'Equity', 'Equity', '1998-10-05 19:30:59', '1979-03-18 14:46:56'),
(4, 'income', 'income', '1976-05-18 19:24:57', '1978-09-01 03:18:25'),
(5, 'Expense', 'Expense', '1999-08-19 16:14:52', '2004-08-22 11:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_made`
--

CREATE TABLE `payment_made` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `pm_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bank_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_mode_id` int UNSIGNED DEFAULT NULL,
  `cheque_number` int UNSIGNED DEFAULT NULL,
  `cheque_issue_date` date DEFAULT NULL,
  `cheque_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `customer_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `excess_amount` double NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `vendor_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payment_made`
--

INSERT INTO `payment_made` (`id`, `amount`, `payment_date`, `pm_number`, `bank_info`, `invoice_show`, `payment_mode_id`, `cheque_number`, `cheque_issue_date`, `cheque_status`, `customer_note`, `reference`, `excess_amount`, `account_id`, `vendor_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `file_url`) VALUES
(14, -100, '2023-03-19', '000001', NULL, '', NULL, 5001, '2023-01-28', NULL, '', '', -100, 110, 8, 1, 1, '2023-03-19 05:01:35', '2023-03-19 05:30:23', NULL),
(15, -2000, '2023-03-19', '000002', NULL, NULL, NULL, 5002, '2023-03-21', NULL, '', 'joijoip', -2000, 110, 8, 1, 1, '2023-03-19 05:39:45', '2023-03-19 05:39:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_made_entry`
--

CREATE TABLE `payment_made_entry` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_made_id` int UNSIGNED NOT NULL,
  `bill_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int UNSIGNED NOT NULL,
  `mode_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `mode_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'Cash', '1992-03-24 08:15:55', '1993-05-21 05:18:51'),
(2, 'Bank Cheque', 'Bank Cheque', '1998-11-10 12:48:18', '2015-02-25 11:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receives`
--

CREATE TABLE `payment_receives` (
  `id` int UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `pr_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bank_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `amount` double NOT NULL,
  `vat_adjustment` double NOT NULL,
  `tax_adjustment` double NOT NULL,
  `others_adjustment` double NOT NULL,
  `excess_payment` double NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_mode_id` int UNSIGNED DEFAULT NULL,
  `cheque_number` int UNSIGNED DEFAULT NULL,
  `cheque_issue_date` date DEFAULT NULL,
  `cheque_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bp_amount` double DEFAULT '0',
  `agent_id` int UNSIGNED DEFAULT NULL,
  `commission_amount` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payment_receives`
--

INSERT INTO `payment_receives` (`id`, `payment_date`, `pr_number`, `reference`, `bank_info`, `invoice_show`, `note`, `amount`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `excess_payment`, `file_name`, `file_url`, `payment_mode_id`, `cheque_number`, `cheque_issue_date`, `cheque_status`, `account_id`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `bp_amount`, `agent_id`, `commission_amount`) VALUES
(4, '2023-03-20', '000001', NULL, '', 'on', NULL, 44800, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, 3, 4, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31', 0, NULL, 0),
(5, '2023-03-22', '000002', '', NULL, NULL, 'fdxgfdggfgh', 12000, 0, 0, 0, 12000, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, 1, 1, '2023-03-22 09:13:52', '2023-03-22 09:13:52', 0, NULL, 0),
(6, '2023-03-22', '000003', 'fsdvdgbfgd', NULL, NULL, '', 13000, 0, 0, 0, 13000, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, 1, 1, '2023-03-22 09:14:05', '2023-03-22 09:14:05', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_receives_entries`
--

CREATE TABLE `payment_receives_entries` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `vat_adjustment` double NOT NULL,
  `tax_adjustment` double NOT NULL,
  `others_adjustment` double NOT NULL,
  `payment_receives_id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payment_receives_entries`
--

INSERT INTO `payment_receives_entries` (`id`, `amount`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `payment_receives_id`, `invoice_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 44800, 0, 0, 0, 4, 2, 1, 1, '2023-03-20 05:56:31', '2023-03-20 05:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `product_name` int UNSIGNED DEFAULT NULL,
  `total_product` int DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `item_add` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_phase`
--

CREATE TABLE `product_phase` (
  `id` int UNSIGNED NOT NULL,
  `product_phase_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_phase_item`
--

CREATE TABLE `product_phase_item` (
  `id` int UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `issued_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `personal_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `recipient_id` int UNSIGNED DEFAULT NULL,
  `issued_by` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `product_phase_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_phase_item_add`
--

CREATE TABLE `product_phase_item_add` (
  `id` int UNSIGNED NOT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `total` double DEFAULT NULL,
  `product_phase_item_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_transfers`
--

CREATE TABLE `product_transfers` (
  `id` int UNSIGNED NOT NULL,
  `transfer_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `sr_id` int UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bill_id` int UNSIGNED DEFAULT NULL,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `creadit_note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_bill`
--

CREATE TABLE `recurring_bill` (
  `id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `recurring_bill_no` varchar(195) DEFAULT NULL,
  `order_no` varchar(195) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `day_interval` int DEFAULT NULL,
  `instance` int DEFAULT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `total_tax` double DEFAULT '0',
  `adjustment` double DEFAULT '0',
  `amount` double DEFAULT NULL,
  `cron` int NOT NULL DEFAULT '0',
  `note` varchar(195) DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_bill_entry`
--

CREATE TABLE `recurring_bill_entry` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `rate` double NOT NULL,
  `amount` double NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `recurring_bill_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_invoices`
--

CREATE TABLE `recurring_invoices` (
  `id` int UNSIGNED NOT NULL,
  `recurring_invoice_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoice_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `tax_total` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `due_amount` double DEFAULT NULL,
  `personal_note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `save` tinyint DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_category_id` int UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int UNSIGNED DEFAULT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_recieve_id` int UNSIGNED DEFAULT NULL,
  `vat_adjustment` double DEFAULT NULL,
  `tax_adjustment` double DEFAULT NULL,
  `others_adjustment` double DEFAULT NULL,
  `cms_site_id` int UNSIGNED DEFAULT NULL,
  `delivery_person` int UNSIGNED DEFAULT NULL,
  `receive_person` int UNSIGNED DEFAULT NULL,
  `receive_date` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_of_installment` varchar(195) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `day_interval` int DEFAULT NULL,
  `start_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `agents_id` int UNSIGNED DEFAULT NULL,
  `agentcommissionAmount` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `commission_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_invoice_entries`
--

CREATE TABLE `recurring_invoice_entries` (
  `id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` int NOT NULL DEFAULT '0',
  `rate` double NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `item_id` int UNSIGNED NOT NULL,
  `recurring_invoice_id` int UNSIGNED NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `carton` int DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int UNSIGNED NOT NULL,
  `reminddatetime` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Role with all access\r\n\r\n', 1, 1, '2022-11-23 08:02:56', '2022-11-23 08:02:56'),
(2, 'Buyer', 'Role for Users who are Buyer/Customer', 1, 1, '2022-10-26 08:01:27', '2022-10-26 08:01:27'),
(3, 'Sales & Marketing', 'Sales & Marketing Department', 1, 1, '2023-02-23 09:24:21', '2023-02-23 09:24:21'),
(4, 'Accounts', 'Accounts', 1, 1, '2023-02-23 09:24:55', '2023-02-23 09:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `salescommisions`
--

CREATE TABLE `salescommisions` (
  `id` int UNSIGNED NOT NULL,
  `agents_id` int UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `scNumber` int NOT NULL,
  `bank_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `show` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `CustomerNote` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `PersonalNote` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `paid_through_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_hide_show`
--

CREATE TABLE `sidebar_hide_show` (
  `id` int NOT NULL,
  `sidebar_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int UNSIGNED NOT NULL,
  `stock_transfer_id` int UNSIGNED DEFAULT NULL,
  `total` int DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_category_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `bill_id` int UNSIGNED DEFAULT NULL,
  `credit_note_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `stock_transfer_id`, `total`, `date`, `item_category_id`, `item_id`, `bill_id`, `credit_note_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `project_id`) VALUES
(5, NULL, 21, '2023-03-22', 5, 24, NULL, 1, 1, 1, 1, '2023-03-22 09:15:11', '2023-03-22 09:15:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_serial`
--

CREATE TABLE `stock_serial` (
  `id` int NOT NULL,
  `entry_date` date DEFAULT NULL,
  `bill_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock_status` int UNSIGNED DEFAULT '1',
  `damage_return` int UNSIGNED DEFAULT NULL COMMENT '1 = this product already user for damage return'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_serial_status`
--

CREATE TABLE `stock_serial_status` (
  `id` int UNSIGNED NOT NULL,
  `status_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_serial_status`
--

INSERT INTO `stock_serial_status` (`id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Aavailable', NULL, NULL),
(2, 'Sold', NULL, NULL),
(3, 'For Sale', NULL, NULL),
(4, 'Service in SR', NULL, NULL),
(5, 'Service In Head Office', NULL, NULL),
(6, 'Service Out From SR', NULL, NULL),
(7, 'Service Out from Head Office', NULL, NULL),
(8, 'Damage Return SR', NULL, NULL),
(9, 'Damage Return Head office', NULL, NULL),
(10, 'Unsold', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` int UNSIGNED NOT NULL,
  `transfer_from` int UNSIGNED NOT NULL,
  `transfer_to` int UNSIGNED NOT NULL,
  `item_category_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `date` date NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int UNSIGNED NOT NULL,
  `tax_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `amount_percentage` int DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_name`, `amount_percentage`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '0%-tax', 0, 1, 1, '1986-05-24 08:21:22', '2009-03-16 07:52:02'),
(2, '10%-tax', 10, 1, 1, '1986-05-24 08:21:22', '2009-03-16 07:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `basic_unit_conversion` double NOT NULL,
  `note` longtext,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `basic_unit_conversion`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'base unit', 1, '', 1, 1, '2023-01-31 06:09:58', '2023-01-31 06:09:58'),
(2, 'pcs', 1, '', 1, 1, '2023-01-31 06:10:13', '2023-01-31 06:10:13'),
(3, 'Sft', 144, '', 1, 1, '2023-03-19 07:47:18', '2023-03-19 07:47:18'),
(4, 'Cft', 1728, '', 1, 1, '2023-03-19 07:47:08', '2023-03-19 07:47:08'),
(5, 'inch', 1, '', 1, 1, '2023-03-19 07:46:51', '2023-03-19 07:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `finger_print_id` int UNSIGNED DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `contact_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `contact`, `note`, `email`, `password`, `finger_print_id`, `type`, `activated`, `role_id`, `branch_id`, `contact_id`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Head Office User', 'lazychat-app-icon_07c9549339609d5b881cd9cdff21f961a6c7258f.png', '', '', 'admin@ontik.net', '$2y$10$kg38pUJST/NWhz7nryNDHe797mT0.HuDT1hPPiOJBmVLmOVtAEr06', 0, 0, 1, 1, 1, NULL, 1, 1, 'Y6maFlyMOKdXDo2ezjUe0SyWGtkQIHbiEWBswfHmU7LfXtmJ7fMzUXehnwzW', '2019-01-08 20:23:44', '2021-11-18 10:08:07', NULL),
(2, 'Mr. Zihan ', '', '', '    ', 'zihan@ontik.net', '$2y$10$T/YdpMP1qeoDyK8pUv1ByuE4xoqW026gZ9IvpNMJW/0k/f3k4KxPK', 345678, 1, 1, 3, 1, NULL, 1, 1, 'kqVbq2Qvwy1TtZ9BZPmHeC4ecf4lNQF48Q06kfwfU5ZEcWtW5W97WBDYeSEw', '2023-02-23 09:27:25', '2023-02-23 09:27:25', '01303456754'),
(3, 'Mr. Forhad', '', '', '  ', 'forhad@ontik.net', '$2y$10$fCFky2ScFRSQLchtUQIcDOKX5jA5JlvRZ9p6A9B.uhsBYuDuz6owO', 780967, 1, 1, 4, 1, NULL, 1, 1, NULL, '2023-02-23 09:29:03', '2023-02-23 09:29:03', '01765435689');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 23, '248ca3daefc51a7acf595f60a8f343a0298747c81cdc3e4ef76ea6bf9ff37743', '2021-09-05 07:55:31', '2021-09-05 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit`
--

CREATE TABLE `vendor_credit` (
  `id` int UNSIGNED NOT NULL,
  `vendor_credit_no` int NOT NULL,
  `vendor_name` int UNSIGNED NOT NULL,
  `vendor_credit_date` date NOT NULL,
  `bill_id` int UNSIGNED DEFAULT NULL,
  `category` int UNSIGNED NOT NULL,
  `sub_category` int UNSIGNED NOT NULL,
  `sub_total` double NOT NULL,
  `adjustment` double NOT NULL,
  `vat_tax` double NOT NULL,
  `total` double NOT NULL,
  `presonal_note` longtext,
  `customer_note` longtext,
  `note` longtext,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_credit`
--

INSERT INTO `vendor_credit` (`id`, `vendor_credit_no`, `vendor_name`, `vendor_credit_date`, `bill_id`, `category`, `sub_category`, `sub_total`, `adjustment`, `vat_tax`, `total`, `presonal_note`, `customer_note`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2023-03-22', NULL, 0, 0, 1000, 0, 0, 1000, '', '', '', 1, 1, '2023-03-22 09:16:21', '2023-03-22 09:16:21'),
(2, 2, 7, '2023-03-22', NULL, 0, 0, 1440, 0, 0, 1440, '', '', '', 1, 1, '2023-03-22 09:16:59', '2023-03-22 09:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_entry`
--

CREATE TABLE `vendor_credit_entry` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `variation_id` int UNSIGNED DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int UNSIGNED DEFAULT NULL,
  `basic_unit_conversion` double DEFAULT NULL,
  `rate` int NOT NULL,
  `tax_id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `vendor_credit_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vendor_credit_entry`
--

INSERT INTO `vendor_credit_entry` (`id`, `item_id`, `variation_id`, `description`, `account_id`, `quantity`, `unit_id`, `basic_unit_conversion`, `rate`, `tax_id`, `amount`, `vendor_credit_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 24, NULL, '', 26, 10, 2, 1, 100, 1, 1000, 1, 1, 1, '2023-03-22 09:16:21', '2023-03-22 09:16:21'),
(2, 26, NULL, '', 26, 1728, 3, 144, 120, 1, 1440, 2, 1, 1, '2023-03-22 09:16:59', '2023-03-22 09:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_payments`
--

CREATE TABLE `vendor_credit_payments` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `bill_id` int UNSIGNED NOT NULL,
  `vendor_credit_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_refunds`
--

CREATE TABLE `vendor_credit_refunds` (
  `id` int UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_mode_id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_id` int UNSIGNED NOT NULL,
  `vendor_credit_id` int UNSIGNED NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_level_module_id_foreign` (`module_id`),
  ADD KEY `access_level_role_id_foreign` (`role_id`),
  ADD KEY `access_level_created_by_foreign` (`created_by`),
  ADD KEY `access_level_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_account_type_id_foreign` (`account_type_id`),
  ADD KEY `account_parent_account_type_id_foreign` (`parent_account_type_id`),
  ADD KEY `account_branch_id_foreign` (`branch_id`),
  ADD KEY `account_created_by_foreign` (`created_by`),
  ADD KEY `account_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_type_parent_account_type_id_foreign` (`parent_account_type_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_created_by_fk` (`created_by`),
  ADD KEY `attributes_updated_by_fk` (`updated_by`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_created_by_foreign` (`created_by`),
  ADD KEY `backup_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_contact_id_foreign` (`contact_id`),
  ADD KEY `bank_account_id_foreign` (`account_id`),
  ADD KEY `bank_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `bank_created_by_foreign` (`created_by`),
  ADD KEY `bank_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_vendor_id_foreign` (`vendor_id`),
  ADD KEY `bill_cms_site_id_foreign` (`cms_site_id`),
  ADD KEY `bill_created_by_foreign` (`created_by`),
  ADD KEY `bill_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `bill_entry`
--
ALTER TABLE `bill_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_entry_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_entry_account_id_foreign` (`account_id`),
  ADD KEY `bill_entry_tax_id_foreign` (`tax_id`),
  ADD KEY `bill_entry_item_id_foreign` (`item_id`),
  ADD KEY `bill_entry_created_by_foreign` (`created_by`),
  ADD KEY `bill_entry_updated_by_foreign` (`updated_by`),
  ADD KEY `bill_entry_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `bill_free_entries`
--
ALTER TABLE `bill_free_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_free_entries_bill_fk` (`bill_id`),
  ADD KEY `bill_free_entries_created_by_fk` (`created_by`),
  ADD KEY `bill_free_entries_free_item_id_fk` (`free_item_id`),
  ADD KEY `bill_free_entries_offer_id_fk` (`offer_id`),
  ADD KEY `bill_free_entries_bill_entry_fk` (`bill_entry_id`),
  ADD KEY `bill_free_entries_free_item_variation_id_fk` (`free_item_variation_id`);

--
-- Indexes for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `bill_of_material_entries`
--
ALTER TABLE `bill_of_material_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_of_material_id` (`bill_of_material_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_return_entries_bill_entries_id_foreign` (`bill_entries_id`),
  ADD KEY `bill_return_entries_created_by_foreign` (`created_by`),
  ADD KEY `bill_return_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill_submit`
--
ALTER TABLE `bill_submit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_submit_account_id_foreign` (`account_id`),
  ADD KEY `bill_submit_vendor_name_foreign` (`vendor_name`),
  ADD KEY `bill_submit_created_by_foreign` (`created_by`),
  ADD KEY `bill_submit_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_submit_id` (`bill_submit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `bill_submit_entries`
--
ALTER TABLE `bill_submit_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_created_by_foreign` (`created_by`),
  ADD KEY `branch_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_entries`
--
ALTER TABLE `cart_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque_book`
--
ALTER TABLE `cheque_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_book_created_by_fk` (`created_by`),
  ADD KEY `check_book_updated_by_fk` (`updated_by`),
  ADD KEY `check_book_branch_id_fk` (`branch_id`),
  ADD KEY `check_book_bank_id_fk` (`bank_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_contact_category_id_foreign` (`contact_category_id`),
  ADD KEY `contact_agent_id_foreign` (`agent_id`),
  ADD KEY `contact_branch_id_foreign` (`branch_id`),
  ADD KEY `contact_created_by_foreign` (`created_by`),
  ADD KEY `contact_updated_by_foreign` (`updated_by`),
  ADD KEY `contact_account_id_foreign` (`account_id`);

--
-- Indexes for table `contact_category`
--
ALTER TABLE `contact_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_category_created_by_foreign` (`created_by`),
  ADD KEY `contact_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `costing_sheet`
--
ALTER TABLE `costing_sheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `item_variation_id` (`item_variation_id`),
  ADD KEY `raw_material_id` (`raw_material_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_notes_customer_id_foreign` (`customer_id`),
  ADD KEY `credit_notes_created_by_foreign` (`created_by`),
  ADD KEY `credit_notes_updated_by_foreign` (`updated_by`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `item_category` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_entries_item_id_foreign` (`item_id`),
  ADD KEY `credit_note_entries_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `credit_note_entries_account_id_foreign` (`account_id`),
  ADD KEY `credit_note_entries_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_entries_updated_by_foreign` (`updated_by`),
  ADD KEY `credit_note_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `credit_note_payments_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_payments_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_payments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_refunds_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_refunds_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `credit_note_refunds_account_id_foreign` (`account_id`),
  ADD KEY `credit_note_refunds_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_refunds_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `damage_items`
--
ALTER TABLE `damage_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `damage_items_created_by_foreign` (`created_by`),
  ADD KEY `damage_items_item_id_foreign` (`item_id`),
  ADD KEY `damage_items_variation_id_foreign` (`variation_id`),
  ADD KEY `damage_items_updated_by_foreign` (`updated_by`),
  ADD KEY `damage_items_vendor_id_foreign` (`vendor_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `depo_sales`
--
ALTER TABLE `depo_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_sales_branch_id_fk` (`branch_id`),
  ADD KEY `depo_sales_created_by_fk` (`created_by`),
  ADD KEY `depo_sales_customer_id_fk` (`customer_id`),
  ADD KEY `depo_sales_seller_id_fk` (`seller_id`),
  ADD KEY `depo_sales_updated_by_fk` (`updated_by`);

--
-- Indexes for table `depo_sales_entries`
--
ALTER TABLE `depo_sales_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_sales_entries_created_by_fk` (`created_by`),
  ADD KEY `depo_sales_entries_depo_sales_id_fk` (`depo_sales_id`),
  ADD KEY `depo_sales_entries_item_id_fk` (`item_id`),
  ADD KEY `depo_sales_entries_updated_by_fk` (`updated_by`),
  ADD KEY `depo_sales_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `depo_sales_free_entries`
--
ALTER TABLE `depo_sales_free_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_sales_free_entries_created_by_fk` (`created_by`),
  ADD KEY `depo_sales_free_entries_depo_sales_entries_id_fk` (`depo_sales_entries_id`),
  ADD KEY `depo_sales_free_entries_depo_sales_id_fk` (`depo_sales_id`),
  ADD KEY `depo_sales_free_entries_free_item_id_fk` (`free_item_id`),
  ADD KEY `depo_sales_free_entries_offer_id_fk` (`offer_id`),
  ADD KEY `free_item_variation_id` (`free_item_variation_id`);

--
-- Indexes for table `depo_stock`
--
ALTER TABLE `depo_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_stock_created_by_fk` (`created_by`),
  ADD KEY `depo_stock_updated_by_fk` (`updated_by`),
  ADD KEY `depo_stock_depo_id_fk` (`depo_id`),
  ADD KEY `depo_stock_item_id_fk` (`item_id`),
  ADD KEY `depo_stock_invoice_entries_fk` (`invoice_entries_id`);

--
-- Indexes for table `distributor_sales`
--
ALTER TABLE `distributor_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributor_sales_created_by_fk` (`created_by`),
  ADD KEY `distributor_sales_customer_id_fk` (`customer_id`),
  ADD KEY `distributor_sales_seller_id_fk` (`seller_id`),
  ADD KEY `distributor_sales_updated_by_fk` (`updated_by`),
  ADD KEY `distributor_sales_branch_id_fk` (`branch_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_created_by_foreign` (`created_by`),
  ADD KEY `email_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimates_customer_id_foreign` (`customer_id`),
  ADD KEY `estimates_created_by_foreign` (`created_by`),
  ADD KEY `estimates_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimate_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `estimate_entries_item_id_foreign` (`item_id`),
  ADD KEY `estimate_entries_estimate_id_foreign` (`estimate_id`),
  ADD KEY `estimate_entries_created_by_foreign` (`created_by`),
  ADD KEY `estimate_entries_updated_by_foreign` (`updated_by`),
  ADD KEY `estimate_entries_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `estimate_request`
--
ALTER TABLE `estimate_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimate_request_branch_id_fk` (`branch_id`),
  ADD KEY `estimate_request_contact_id_fk` (`contact_id`),
  ADD KEY `estimate_request_created_by_fk` (`created_by`),
  ADD KEY `estimate_request_updated_by_fk` (`updated_by`);

--
-- Indexes for table `estimate_request_model`
--
ALTER TABLE `estimate_request_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimate_request_model_created_by_fk` (`created_by`),
  ADD KEY `estimate_request_model_estimate_request_id_fk` (`estimate_request_id`),
  ADD KEY `estimate_request_model_updated_by_fk` (`updated_by`);

--
-- Indexes for table `estimate_request_model_entries`
--
ALTER TABLE `estimate_request_model_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimate_request_model_entries_created_by_fk` (`created_by`),
  ADD KEY `estimate_request_model_entries_estimate_request_model_id_fk` (`estimate_request_model_id`),
  ADD KEY `estimate_request_model_entries_updated_by_fk` (`updated_by`);

--
-- Indexes for table `excess_payment`
--
ALTER TABLE `excess_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `excess_payment_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `excess_payment_invoice_id_foreign` (`invoice_id`),
  ADD KEY `excess_payment_created_by_foreign` (`created_by`),
  ADD KEY `excess_payment_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_paid_through_id_foreign` (`paid_through_id`),
  ADD KEY `expense_account_id_foreign` (`account_id`),
  ADD KEY `expense_cms_site_id_foreign` (`cms_site_id`),
  ADD KEY `expense_vendor_id_foreign` (`vendor_id`),
  ADD KEY `expense_tax_id_foreign` (`tax_id`),
  ADD KEY `expense_created_by_foreign` (`created_by`),
  ADD KEY `expense_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `headertemplate`
--
ALTER TABLE `headertemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_receive_through_id_foreign` (`receive_through_id`),
  ADD KEY `incomes_account_id_foreign` (`account_id`),
  ADD KEY `incomes_customer_id_foreign` (`customer_id`),
  ADD KEY `incomes_tax_id_foreign` (`tax_id`),
  ADD KEY `incomes_created_by_foreign` (`created_by`),
  ADD KEY `incomes_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_updated_by_foreign` (`updated_by`),
  ADD KEY `invoices_agents_id_foreign` (`agents_id`),
  ADD KEY `invoices_payment_recieve_id_foreign` (`payment_recieve_id`),
  ADD KEY `cms_site_id` (`cms_site_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `invoices_ibfk_1` (`item_category_id`),
  ADD KEY `invoices_ibfk_3` (`delivery_person`),
  ADD KEY `invoices_ibfk_4` (`receive_person`),
  ADD KEY `invoices_branch_id_fk` (`branch_id`),
  ADD KEY `invoices_seller_id_fk` (`seller_id`);

--
-- Indexes for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `raw_material_id` (`raw_material_id`),
  ADD KEY `invoices_id` (`invoices_id`) USING BTREE;

--
-- Indexes for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_entries_item_id_foreign` (`item_id`),
  ADD KEY `invoice_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `invoice_entries_account_id_foreign` (`account_id`),
  ADD KEY `invoice_entries_created_by_foreign` (`created_by`),
  ADD KEY `invoice_entries_updated_by_foreign` (`updated_by`),
  ADD KEY `invoice_entries_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `invoice_free_entries`
--
ALTER TABLE `invoice_free_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_free_entries_free_item_id_fk` (`free_item_id`),
  ADD KEY `invoice_free_entries_invoice_entry_id_fk` (`invoice_entry_id`),
  ADD KEY `invoice_free_entries_invoice_id_fk` (`invoice_id`),
  ADD KEY `invoice_free_entries_offer_id_fk` (`offer_id`),
  ADD KEY `invoice_free_entries_created_by_fk` (`created_by`),
  ADD KEY `invoice_free_entries_updated_by_fk` (`updated_by`),
  ADD KEY `invoice_free_entries_free_item_variation_id_fk` (`free_item_variation_id`);

--
-- Indexes for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_return_entries_invoice_entries_id_foreign` (`invoice_entries_id`),
  ADD KEY `invoice_return_entries_created_by_foreign` (`created_by`),
  ADD KEY `invoice_return_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_company_id_foreign` (`company_id`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `item_attribute_values`
--
ALTER TABLE `item_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_attribute_values_ibfk_1` (`item_id`),
  ADD KEY `item_attribute_values_ibfk_2` (`attribute_values_id`),
  ADD KEY `item_attribute_values_ibfk_3` (`created_by`),
  ADD KEY `item_attribute_values_ibfk_4` (`updated_by`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_category_branch_id_foreign` (`branch_id`),
  ADD KEY `item_category_created_by_foreign` (`created_by`),
  ADD KEY `item_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sub_category_item_category_id_foreign` (`item_category_id`),
  ADD KEY `item_sub_category_created_by_foreign` (`created_by`),
  ADD KEY `item_sub_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `item_variations`
--
ALTER TABLE `item_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `attribute_variations_created_by_fk` (`created_by`),
  ADD KEY `attribute_variations_updated_by_fk` (`updated_by`),
  ADD KEY `attribute_variations_item_id_fk` (`item_id`);

--
-- Indexes for table `item_variation_attribute_values`
--
ALTER TABLE `item_variation_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_variation_attribute_values_item_variations_id_fk` (`item_variation_id`),
  ADD KEY `item_variation_attribute_values_created_by_fk` (`created_by`),
  ADD KEY `item_variation_attribute_values_updated_by_fk` (`updated_by`),
  ADD KEY `item_variation_attribute_values_attribute_values_fk` (`attribute_values_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_branch_id_foreign` (`branch_id`),
  ADD KEY `journal_created_by_foreign` (`created_by`),
  ADD KEY `journal_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_entries_journal_id_foreign` (`journal_id`),
  ADD KEY `journal_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `journal_entries_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `journal_entries_payment_receives_entries_id_foreign` (`payment_receives_entries_id`),
  ADD KEY `journal_entries_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `journal_entries_credit_note_refunds_id_foreign` (`credit_note_refunds_id`),
  ADD KEY `journal_entries_expense_id_foreign` (`expense_id`),
  ADD KEY `journal_entries_bill_id_foreign` (`bill_id`),
  ADD KEY `journal_entries_bank_id_foreign` (`bank_id`),
  ADD KEY `journal_entries_bill_entry_id_foreign` (`bill_entry_id`),
  ADD KEY `journal_entries_payment_made_id_foreign` (`payment_made_id`),
  ADD KEY `journal_entries_payment_made_entry_id_foreign` (`payment_made_entry_id`),
  ADD KEY `journal_entries_account_name_id_foreign` (`account_name_id`),
  ADD KEY `journal_entries_contact_id_foreign` (`contact_id`),
  ADD KEY `journal_entries_income_id_foreign` (`income_id`),
  ADD KEY `journal_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `journal_entries_created_by_foreign` (`created_by`),
  ADD KEY `journal_entries_updated_by_foreign` (`updated_by`),
  ADD KEY `journal_entries_salescomission_id_foreign` (`salesComission_id`),
  ADD KEY `journal_entries_agent_id_foreign` (`agent_id`),
  ADD KEY `vendore_credit_id` (`vendor_credit_id`),
  ADD KEY `vendor_credit_refunds_id` (`vendor_credit_refunds_id`),
  ADD KEY `recurring_invoice_id` (`recurring_invoice_id`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `estimate_id` (`bill_of_material_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `manufacture_entries`
--
ALTER TABLE `manufacture_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `manufacture_id` (`manufacture_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `manufacture_phases`
--
ALTER TABLE `manufacture_phases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `factory_id` (`factory_id`),
  ADD KEY `manufacture_id` (`manufacture_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `manufacture_phase_disburse`
--
ALTER TABLE `manufacture_phase_disburse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `manufacture_phase_id` (`manufacture_phase_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `variation_id` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `manufacture_phase_raw_materials`
--
ALTER TABLE `manufacture_phase_raw_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `manufacture_phase_id` (`manufacture_phase_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `variation_id` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `manufacture_phase_receive_from_factory`
--
ALTER TABLE `manufacture_phase_receive_from_factory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `manufacture_phase_id` (`manufacture_phase_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `variation_id` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_item_fk` (`item_id`),
  ADD KEY `offer_free_item_fk` (`free_item_id`),
  ADD KEY `offers_created_by_fk` (`created_by`),
  ADD KEY `offers_updated_by_fk` (`updated_by`),
  ADD KEY `offers_item_variation_id_fk` (`item_variation_id`),
  ADD KEY `offers_free_item_variation_id_fk` (`free_item_variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `organization_profiles`
--
ALTER TABLE `organization_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_account_type`
--
ALTER TABLE `parent_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_made`
--
ALTER TABLE `payment_made`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_made_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `payment_made_account_id_foreign` (`account_id`),
  ADD KEY `payment_made_vendor_id_foreign` (`vendor_id`),
  ADD KEY `payment_made_created_by_foreign` (`created_by`),
  ADD KEY `payment_made_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_made_entry_payment_made_id_foreign` (`payment_made_id`),
  ADD KEY `payment_made_entry_bill_id_foreign` (`bill_id`),
  ADD KEY `payment_made_entry_created_by_foreign` (`created_by`),
  ADD KEY `payment_made_entry_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receives`
--
ALTER TABLE `payment_receives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_receives_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `payment_receives_account_id_foreign` (`account_id`),
  ADD KEY `payment_receives_customer_id_foreign` (`customer_id`),
  ADD KEY `payment_receives_created_by_foreign` (`created_by`),
  ADD KEY `payment_receives_updated_by_foreign` (`updated_by`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_receives_entries_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `payment_receives_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payment_receives_entries_created_by_foreign` (`created_by`),
  ADD KEY `payment_receives_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_branch_id_fk` (`branch_id`),
  ADD KEY `product_created_by_fk` (`created_by`),
  ADD KEY `product_product_name_fk` (`product_name`),
  ADD KEY `product_updated_by_fk` (`updated_by`);

--
-- Indexes for table `product_phase`
--
ALTER TABLE `product_phase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_phase_created_by_fk` (`created_by`),
  ADD KEY `product_phase_product_id_fk` (`product_id`),
  ADD KEY `product_phase_updated_by_fk` (`updated_by`);

--
-- Indexes for table `product_phase_item`
--
ALTER TABLE `product_phase_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_phase_item_created_by_fk` (`created_by`),
  ADD KEY `product_phase_item_issued_by_fk` (`issued_by`),
  ADD KEY `product_phase_item_product_id_fk` (`product_id`),
  ADD KEY `product_phase_item_product_phase_fk` (`product_phase_id`),
  ADD KEY `product_phase_item_recipent_id_fk` (`recipient_id`),
  ADD KEY `product_phase_item_updated_by_fk` (`updated_by`);

--
-- Indexes for table `product_phase_item_add`
--
ALTER TABLE `product_phase_item_add`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_phase_item_add_item_category_id_fk` (`item_category_id`),
  ADD KEY `product_phase_item_add_item_id_fk` (`item_id`),
  ADD KEY `product_phase_item_add_product_phase_id_fk` (`product_phase_item_id`);

--
-- Indexes for table `product_transfers`
--
ALTER TABLE `product_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `sr_id` (`sr_id`);

--
-- Indexes for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recurring_bill_no` (`recurring_bill_no`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category` (`item_sub_category_id`);

--
-- Indexes for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `recurring_bill_id` (`recurring_bill_id`);

--
-- Indexes for table `recurring_invoices`
--
ALTER TABLE `recurring_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recurring_invoices_invoice_number_unique` (`recurring_invoice_number`),
  ADD KEY `recurring_invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `recurring_invoices_created_by_foreign` (`created_by`),
  ADD KEY `recurring_invoices_updated_by_foreign` (`updated_by`),
  ADD KEY `recurring_invoices_payment_recieve_id_foreign` (`payment_recieve_id`),
  ADD KEY `cms_site_id` (`cms_site_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `recurring_invoices_ibfk_1` (`item_category_id`),
  ADD KEY `recurring_invoices_ibfk_3` (`delivery_person`),
  ADD KEY `recurring_invoices_ibfk_4` (`receive_person`);

--
-- Indexes for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recurring_invoice_entries_item_id_foreign` (`item_id`),
  ADD KEY `recurring_invoice_entries_invoice_id_foreign` (`recurring_invoice_id`),
  ADD KEY `recurring_invoice_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `recurring_invoice_entries_account_id_foreign` (`account_id`),
  ADD KEY `recurring_invoice_entries_created_by_foreign` (`created_by`),
  ADD KEY `recurring_invoice_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_created_by_foreign` (`created_by`),
  ADD KEY `reminders_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `salescommisions`
--
ALTER TABLE `salescommisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salescommisions_agents_id_foreign` (`agents_id`),
  ADD KEY `salescommisions_created_by_foreign` (`created_by`),
  ADD KEY `salescommisions_updated_by_foreign` (`updated_by`),
  ADD KEY `salescommisions_paid_through_id_foreign` (`paid_through_id`);

--
-- Indexes for table `sidebar_hide_show`
--
ALTER TABLE `sidebar_hide_show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_item_category_id_foreign` (`item_category_id`),
  ADD KEY `stock_item_id_foreign` (`item_id`),
  ADD KEY `stock_bill_id_foreign` (`bill_id`),
  ADD KEY `stock_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `stock_branch_id_foreign` (`branch_id`),
  ADD KEY `stock_created_by_foreign` (`created_by`),
  ADD KEY `stock_updated_by_foreign` (`updated_by`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `stock_transfer_id` (`stock_transfer_id`);

--
-- Indexes for table `stock_serial`
--
ALTER TABLE `stock_serial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `stock_serial_ibfk_4` (`updated_by`),
  ADD KEY `stock_status` (`stock_status`);

--
-- Indexes for table `stock_serial_status`
--
ALTER TABLE `stock_serial_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_from` (`transfer_from`),
  ADD KEY `transfer_to` (`transfer_to`),
  ADD KEY `transfer_item` (`item_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_created_by_foreign` (`created_by`),
  ADD KEY `tax_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activations_token_index` (`token`);

--
-- Indexes for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `vendore_name` (`vendor_name`);

--
-- Indexes for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendore_credit_entry_bill_id_foreign` (`vendor_credit_id`),
  ADD KEY `vendore_credit_entry_account_id_foreign` (`account_id`),
  ADD KEY `vendore_credit_entry_tax_id_foreign` (`tax_id`),
  ADD KEY `vendore_credit_entry_item_id_foreign` (`item_id`),
  ADD KEY `vendore_credit_entry_created_by_foreign` (`created_by`),
  ADD KEY `vendore_credit_entry_updated_by_foreign` (`updated_by`),
  ADD KEY `vendor_credit_variation_id_fk` (`variation_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `vendor_credit_id` (`vendor_credit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `vendor_credit_id` (`vendor_credit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_entry`
--
ALTER TABLE `bill_entry`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bill_free_entries`
--
ALTER TABLE `bill_free_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bill_of_material_entries`
--
ALTER TABLE `bill_of_material_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submit`
--
ALTER TABLE `bill_submit`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submit_entries`
--
ALTER TABLE `bill_submit_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_entries`
--
ALTER TABLE `cart_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cheque_book`
--
ALTER TABLE `cheque_book`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_category`
--
ALTER TABLE `contact_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `costing_sheet`
--
ALTER TABLE `costing_sheet`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_items`
--
ALTER TABLE `damage_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depo_sales`
--
ALTER TABLE `depo_sales`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depo_sales_entries`
--
ALTER TABLE `depo_sales_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depo_sales_free_entries`
--
ALTER TABLE `depo_sales_free_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depo_stock`
--
ALTER TABLE `depo_stock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `distributor_sales`
--
ALTER TABLE `distributor_sales`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estimate_request`
--
ALTER TABLE `estimate_request`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimate_request_model`
--
ALTER TABLE `estimate_request_model`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimate_request_model_entries`
--
ALTER TABLE `estimate_request_model_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `excess_payment`
--
ALTER TABLE `excess_payment`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headertemplate`
--
ALTER TABLE `headertemplate`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_free_entries`
--
ALTER TABLE `invoice_free_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `item_attribute_values`
--
ALTER TABLE `item_attribute_values`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_variations`
--
ALTER TABLE `item_variations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `item_variation_attribute_values`
--
ALTER TABLE `item_variation_attribute_values`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manufacture_entries`
--
ALTER TABLE `manufacture_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manufacture_phases`
--
ALTER TABLE `manufacture_phases`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manufacture_phase_disburse`
--
ALTER TABLE `manufacture_phase_disburse`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `manufacture_phase_raw_materials`
--
ALTER TABLE `manufacture_phase_raw_materials`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `manufacture_phase_receive_from_factory`
--
ALTER TABLE `manufacture_phase_receive_from_factory`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization_profiles`
--
ALTER TABLE `organization_profiles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parent_account_type`
--
ALTER TABLE `parent_account_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_made`
--
ALTER TABLE `payment_made`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_receives`
--
ALTER TABLE `payment_receives`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_phase`
--
ALTER TABLE `product_phase`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_phase_item`
--
ALTER TABLE `product_phase_item`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_phase_item_add`
--
ALTER TABLE `product_phase_item_add`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_transfers`
--
ALTER TABLE `product_transfers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_invoices`
--
ALTER TABLE `recurring_invoices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salescommisions`
--
ALTER TABLE `salescommisions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sidebar_hide_show`
--
ALTER TABLE `sidebar_hide_show`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_serial`
--
ALTER TABLE `stock_serial`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_serial_status`
--
ALTER TABLE `stock_serial_status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_level`
--
ALTER TABLE `access_level`
  ADD CONSTRAINT `access_level_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_account_type_id_foreign` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_type`
--
ALTER TABLE `account_type`
  ADD CONSTRAINT `account_type_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attributes_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attribute_values_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `attribute_values_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `backup`
--
ALTER TABLE `backup`
  ADD CONSTRAINT `backup_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `backup_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_cms_site_id_foreign` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  ADD CONSTRAINT `bill_due_table_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_due_table_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_due_table_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_entry`
--
ALTER TABLE `bill_entry`
  ADD CONSTRAINT `bill_entry_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `bill_free_entries`
--
ALTER TABLE `bill_free_entries`
  ADD CONSTRAINT `bill_free_entries_bill_entry_fk` FOREIGN KEY (`bill_entry_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_free_entries_bill_fk` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_free_entries_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD CONSTRAINT `bill_of_materials_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `bill_of_materials_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bill_of_materials_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bill_of_materials_ibfk_4` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `bill_of_material_entries`
--
ALTER TABLE `bill_of_material_entries`
  ADD CONSTRAINT `bill_of_material_entries_ibfk_1` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`),
  ADD CONSTRAINT `bill_of_material_entries_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `bill_of_material_entries_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  ADD CONSTRAINT `bill_return_entries_bill_entries_id_foreign` FOREIGN KEY (`bill_entries_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_return_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_return_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bill_submit`
--
ALTER TABLE `bill_submit`
  ADD CONSTRAINT `bill_submit_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_vendor_name_foreign` FOREIGN KEY (`vendor_name`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_1` FOREIGN KEY (`bill_submit_id`) REFERENCES `bill_submit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branch_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cheque_book`
--
ALTER TABLE `cheque_book`
  ADD CONSTRAINT `check_book_bank_id_fk` FOREIGN KEY (`bank_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `check_book_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `check_book_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `check_book_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_contact_category_id_foreign` FOREIGN KEY (`contact_category_id`) REFERENCES `contact_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_category`
--
ALTER TABLE `contact_category`
  ADD CONSTRAINT `contact_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `costing_sheet`
--
ALTER TABLE `costing_sheet`
  ADD CONSTRAINT `costing_sheet_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `costing_sheet_ibfk_2` FOREIGN KEY (`item_variation_id`) REFERENCES `item_variations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `costing_sheet_ibfk_3` FOREIGN KEY (`raw_material_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `costing_sheet_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD CONSTRAINT `credit_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_3` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  ADD CONSTRAINT `credit_note_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  ADD CONSTRAINT `credit_note_payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  ADD CONSTRAINT `credit_note_refunds_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `damage_items`
--
ALTER TABLE `damage_items`
  ADD CONSTRAINT `damage_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `damage_items_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `damage_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `damage_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `damage_items_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `damage_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `depo_sales`
--
ALTER TABLE `depo_sales`
  ADD CONSTRAINT `depo_sales_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `depo_sales_entries`
--
ALTER TABLE `depo_sales_entries`
  ADD CONSTRAINT `depo_sales_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_entries_depo_sales_id_fk` FOREIGN KEY (`depo_sales_id`) REFERENCES `depo_sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_entries_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_entries_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `depo_sales_free_entries`
--
ALTER TABLE `depo_sales_free_entries`
  ADD CONSTRAINT `depo_sales_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_free_entries_depo_sales_entries_id_fk` FOREIGN KEY (`depo_sales_entries_id`) REFERENCES `depo_sales_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_free_entries_depo_sales_id_fk` FOREIGN KEY (`depo_sales_id`) REFERENCES `depo_sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_free_entries_ibfk_1` FOREIGN KEY (`free_item_variation_id`) REFERENCES `depo_sales_free_entries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_sales_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `depo_stock`
--
ALTER TABLE `depo_stock`
  ADD CONSTRAINT `depo_stock_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_stock_depo_id_fk` FOREIGN KEY (`depo_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_stock_invoice_entries_fk` FOREIGN KEY (`invoice_entries_id`) REFERENCES `invoice_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_stock_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `depo_stock_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `distributor_sales`
--
ALTER TABLE `distributor_sales`
  ADD CONSTRAINT `distributor_sales_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_sales_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_sales_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_sales_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_sales_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `estimates`
--
ALTER TABLE `estimates`
  ADD CONSTRAINT `estimates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  ADD CONSTRAINT `estimate_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `estimate_request`
--
ALTER TABLE `estimate_request`
  ADD CONSTRAINT `estimate_request_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_contact_id_fk` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `estimate_request_model`
--
ALTER TABLE `estimate_request_model`
  ADD CONSTRAINT `estimate_request_model_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_model_estimate_request_id_fk` FOREIGN KEY (`estimate_request_id`) REFERENCES `estimate_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_model_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `estimate_request_model_entries`
--
ALTER TABLE `estimate_request_model_entries`
  ADD CONSTRAINT `estimate_request_model_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_model_entries_estimate_request_model_id_fk` FOREIGN KEY (`estimate_request_model_id`) REFERENCES `estimate_request_model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_request_model_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `excess_payment`
--
ALTER TABLE `excess_payment`
  ADD CONSTRAINT `excess_payment_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_cms_site_id_foreign` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_receive_through_id_foreign` FOREIGN KEY (`receive_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `cms_site_id` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`delivery_person`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_4` FOREIGN KEY (`receive_person`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_payment_recieve_id_foreign` FOREIGN KEY (`payment_recieve_id`) REFERENCES `payment_receives` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_seller_id_fk` FOREIGN KEY (`seller_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  ADD CONSTRAINT `invoices_measurements_invoices_id` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_measurements_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_measurements_raw_material_id` FOREIGN KEY (`raw_material_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  ADD CONSTRAINT `invoice_due_table_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_due_table_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_due_table_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  ADD CONSTRAINT `invoice_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_free_entries`
--
ALTER TABLE `invoice_free_entries`
  ADD CONSTRAINT `invoice_free_entries_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_free_item_id_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_invoice_entry_id_fk` FOREIGN KEY (`invoice_entry_id`) REFERENCES `invoice_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_invoice_id_fk` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_offer_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_free_entries_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  ADD CONSTRAINT `invoice_return_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_return_entries_invoice_entries_id_foreign` FOREIGN KEY (`invoice_entries_id`) REFERENCES `invoice_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_return_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_id` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_id` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_attribute_values`
--
ALTER TABLE `item_attribute_values`
  ADD CONSTRAINT `item_attribute_values_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_attribute_values_ibfk_2` FOREIGN KEY (`attribute_values_id`) REFERENCES `attribute_values` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_attribute_values_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_attribute_values_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `item_category`
--
ALTER TABLE `item_category`
  ADD CONSTRAINT `item_category_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  ADD CONSTRAINT `item_sub_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_variations`
--
ALTER TABLE `item_variations`
  ADD CONSTRAINT `attribute_variations_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attribute_variations_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attribute_variations_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `item_variation_attribute_values`
--
ALTER TABLE `item_variation_attribute_values`
  ADD CONSTRAINT `item_variation_attribute_values_attribute_values_fk` FOREIGN KEY (`attribute_values_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_variation_attribute_values_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_variation_attribute_values_item_variations_id_fk` FOREIGN KEY (`item_variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_variation_attribute_values_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_account_name_id_foreign` FOREIGN KEY (`account_name_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bill_entry_id_foreign` FOREIGN KEY (`bill_entry_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_credit_note_refunds_id_foreign` FOREIGN KEY (`credit_note_refunds_id`) REFERENCES `credit_note_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_1` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_2` FOREIGN KEY (`vendor_credit_refunds_id`) REFERENCES `vendor_credit_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_3` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_made_entry_id_foreign` FOREIGN KEY (`payment_made_entry_id`) REFERENCES `payment_made_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_receives_entries_id_foreign` FOREIGN KEY (`payment_receives_entries_id`) REFERENCES `payment_receives_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_salescomission_id_foreign` FOREIGN KEY (`salesComission_id`) REFERENCES `salescommisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD CONSTRAINT `manufacture_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_ibfk_2` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacture_entries`
--
ALTER TABLE `manufacture_entries`
  ADD CONSTRAINT `manufacture_entries_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_entries_ibfk_2` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_entries_ibfk_3` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacture_phases`
--
ALTER TABLE `manufacture_phases`
  ADD CONSTRAINT `manufacture_phases_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phases_ibfk_2` FOREIGN KEY (`factory_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phases_ibfk_3` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phases_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacture_phase_disburse`
--
ALTER TABLE `manufacture_phase_disburse`
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_2` FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_4` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_disburse_ibfk_6` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacture_phase_raw_materials`
--
ALTER TABLE `manufacture_phase_raw_materials`
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_2` FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_4` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_raw_materials_ibfk_6` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacture_phase_receive_from_factory`
--
ALTER TABLE `manufacture_phase_receive_from_factory`
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_2` FOREIGN KEY (`manufacture_phase_id`) REFERENCES `manufacture_phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_4` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacture_phase_receive_from_factory_ibfk_6` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_free_item_fk` FOREIGN KEY (`free_item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_free_item_variation_id_fk` FOREIGN KEY (`free_item_variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_item_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_item_variation_id_fk` FOREIGN KEY (`item_variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_made`
--
ALTER TABLE `payment_made`
  ADD CONSTRAINT `payment_made_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  ADD CONSTRAINT `payment_made_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receives`
--
ALTER TABLE `payment_receives`
  ADD CONSTRAINT `payment_receives_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  ADD CONSTRAINT `payment_receives_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_product_name_fk` FOREIGN KEY (`product_name`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_phase`
--
ALTER TABLE `product_phase`
  ADD CONSTRAINT `product_phase_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_phase_item`
--
ALTER TABLE `product_phase_item`
  ADD CONSTRAINT `product_phase_item_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_issued_by_fk` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_product_phase_fk` FOREIGN KEY (`product_phase_id`) REFERENCES `product_phase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_recipent_id_fk` FOREIGN KEY (`recipient_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_phase_item_add`
--
ALTER TABLE `product_phase_item_add`
  ADD CONSTRAINT `product_phase_item_add_item_category_id_fk` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_add_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_phase_item_add_product_phase_id_fk` FOREIGN KEY (`product_phase_item_id`) REFERENCES `product_phase_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_transfers`
--
ALTER TABLE `product_transfers`
  ADD CONSTRAINT `product_transfers_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_transfers_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_transfers_ibfk_3` FOREIGN KEY (`sr_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  ADD CONSTRAINT `recurring_bill_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_4` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_5` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  ADD CONSTRAINT `recurring_bill_entry_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_4` FOREIGN KEY (`recurring_bill_id`) REFERENCES `recurring_bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  ADD CONSTRAINT `recurring_invoice_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_invoice_id_foreign` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salescommisions`
--
ALTER TABLE `salescommisions`
  ADD CONSTRAINT `salescommisions_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`stock_transfer_id`) REFERENCES `stock_transfers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_serial`
--
ALTER TABLE `stock_serial`
  ADD CONSTRAINT `stock_serial_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stock_serial_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_5` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_6` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_7` FOREIGN KEY (`stock_status`) REFERENCES `stock_serial_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD CONSTRAINT `stock_transfers_ibfk_1` FOREIGN KEY (`transfer_from`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_2` FOREIGN KEY (`transfer_to`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_6` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_7` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tax`
--
ALTER TABLE `tax`
  ADD CONSTRAINT `tax_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `users_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  ADD CONSTRAINT `vendor_credit_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_ibfk_2` FOREIGN KEY (`vendor_name`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  ADD CONSTRAINT `vendor_credit_entry_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `item_variations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_bill_id_foreign` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  ADD CONSTRAINT `vendor_credit_payments_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_2` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_1` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_3` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
