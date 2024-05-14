-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 05:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role`, `admin_name`, `password_hash`, `email`, `gender`) VALUES
(21, 'main', 'admin_1', '$2y$10$DiYkJvJTyTK2uG9eK3zFUu84LK15M/SRZqtCYhm8sX6bXC9lbE3Di', 'admin1@gmail.com', 'Male'),
(22, 'normal', 'admin_2', '$2y$10$cYKb17W3n.TAaL5dLEFYLO6UsTtNXY1IMXVjwtoLfo2WnidMzAwBe', 'admin_2@gmail.com', 'Male'),
(24, 'normal', 'admin_3', '$2y$10$DsMLad1nCnNUG7fA7.S24OOKJYZDuBHiyx/k0rY7V4KRBIEnDpTL2', 'admin_3@gmail.com', 'Female'),
(26, 'normal', 'admin_4', '$2y$10$PPFMO34cxT2kVuxcL2r.BeM2UVedPF18TigqJeIZo9DiNoaR5H7uK', 'admin_4@gmail.com', 'Male'),
(27, 'normal', 'admin_5', '$2y$10$Ff.Qe7Dx4e2S1kE0JQjVt.Fd7CPngu3lODSp.Q.La04UZyVuENa0y', 'admin_5@gmail.com', 'Male'),
(29, 'normal', 'admin_6', '$2y$10$.Kl54lM3UeG6a6c61bhsIuj3aGceaITLtVFEfOMV89NDq5gWMhq6C', 'admin_6@gmail.com', 'Male'),
(30, 'main', 'Leo', '$2y$10$t6Sa.mLlWce93DadoEXU5OGggxdcMz74MSo13rYIloA3hESAPwACG', 'leo@gmail.com', 'Male'),
(31, 'main', 'Louis', '$2y$10$49OkBVuEMTisxoKEE5dgvOnwzxEghDLhO35nvhdLCBK53gViaLbl.', 'louis@gmail.com', 'Male'),
(32, 'normal', 'James', '$2y$10$vrvtTBw07W6OaXghIUzSu.H2FhgNjCdQ0MJ3I69IIXAaiFoc0ooVS', 'james@gmail.com', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `details` varchar(2555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `name`, `email`, `phone`, `address`, `details`) VALUES
(785, 'James', 'james@gmail.com', '0123456789', 'asdasdasd', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"2\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"2\"}]'),
(786, 'kikiki', 'kikiki@gmail.com', '013-664564543', 'no no no no no no', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"2\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"2\"}]'),
(787, 'nike', 'james@gmail.com', '012-34567890', 'bcbcbcbc', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(788, 'mandy', 'mandy@gmail.com', '01234545677', 'mandy', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(789, 'zzzzzzzzz', 'zzz@gmail.com', '0123456789', 'zzzzzzz', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(790, 'leo', 'leo@gmail.com', '012-534545233', 'n n o no ', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(791, 'abcdef', 'abcdef@gmail.com', '0123456789', 'abcdef', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(792, 'abc', 'abc@gmail.com', '0123456789', 'abcd', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"3\"},{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":\"3\"}]'),
(793, 'nike', 'james@gmail.com', '0123456789', 'sssssss', '[{\"id\":\"367_9.5\",\"Category\":\"1\",\"quantity\":2}]'),
(794, 'James', 'james@gmail.com', '012-34567890', 'qwqeqwwe221', '[{\"id\":\"372_9\",\"Category\":\"2\",\"quantity\":2}]'),
(795, 'James', 'james0101@gmail.com', '012-34567890', 'jaemee', '[{\"id\":\"367_10\",\"Category\":\"1\",\"quantity\":5},{\"id\":\"368_9\",\"Category\":\"1\",\"quantity\":5}]'),
(796, 'nike', 'james@gmail.com', '0123456789', '123456', '[{\"id\":\"364_9\",\"Category\":\"1\",\"quantity\":\"3\"}]'),
(797, 'hahaha', 'james@gmail.com', '0123456789', 'asdfasdfadf', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"1\"},{\"id\":\"367_9\",\"Category\":\"1\",\"quantity\":10}]'),
(798, 'James', 'james@gmail.com', '012-34567890', 'No 12 Jalan 12 Taman 12', '[{\"id\":\"363_9\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"363_9.5\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"363_10\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"363_10.5\",\"Category\":\"1\",\"quantity\":1}]'),
(799, 'mandy', 'mandy@gmail.com', '0123456789', 'sssssssss', '[{\"id\":\"367_9\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"367_9.5\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"367_10\",\"Category\":\"1\",\"quantity\":1}]'),
(800, 'Louis', 'louis@gmail.com', '013-756766745', 'no no no no n o', '[{\"id\":\"363_9\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"372_9.5\",\"Category\":\"2\",\"quantity\":1},{\"id\":\"371_10\",\"Category\":\"1\",\"quantity\":1}]'),
(801, 'James', 'james@gmail.com', '012-5466543', 'No 12 Jalan abc 34 Taman def 56', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"397_9.5\",\"Category\":\"2\",\"quantity\":1},{\"id\":\"372_10.5\",\"Category\":\"2\",\"quantity\":1}]'),
(802, 'hahaha', 'haha@gmail.com', '012-34567890', 'ha ha ha ha ha', '[{\"id\":\"372_9.5\",\"Category\":\"2\",\"quantity\":2},{\"id\":\"388_9\",\"Category\":\"3\",\"quantity\":1},{\"id\":\"391_10\",\"Category\":\"3\",\"quantity\":1},{\"id\":\"394_11.5\",\"Category\":\"2\",\"quantity\":1},{\"id\":\"373_10.5\",\"Category\":\"2\",\"quantity\":1},{\"id\":\"392_9\",\"Category\":\"2\",\"quantity\":2}]'),
(803, 'nike', 'james@gmail.com', '012-3458458', 'bybyyby', '[{\"id\":\"371_9.5\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"372_10\",\"Category\":\"2\",\"quantity\":1}]'),
(804, 'hahaha', 'james@gmail.com', '012-34567890', 'qqqqqqqqqqqqqqqwwwwwwwwwwwww', '[{\"id\":\"371_9\",\"Category\":\"1\",\"quantity\":\"2\"},{\"id\":\"371_9.5\",\"Category\":\"1\",\"quantity\":\"2\"}]'),
(805, 'Mandy', 'mandy@gmail.com', '014-65645453', 'no12 jalan xyz taman def', '[{\"id\":\"363_9\",\"Category\":\"1\",\"quantity\":\"10\"},{\"id\":\"363_9.5\",\"Category\":\"1\",\"quantity\":\"10\"},{\"id\":\"363_10\",\"Category\":\"1\",\"quantity\":\"10\"},{\"id\":\"363_10.5\",\"Category\":\"1\",\"quantity\":\"10\"},{\"id\":\"363_11\",\"Category\":\"1\",\"quantity\":\"10\"},{\"id\":\"363_11.5\",\"Category\":\"1\",\"quantity\":\"10\"}]'),
(806, 'James', 'james@gmail.com', '01234545677', 'no 12 jalan 12 taman 12', '[{\"id\":\"374_9\",\"Category\":\"2\",\"quantity\":5},{\"id\":\"372_9.5\",\"Category\":\"2\",\"quantity\":5},{\"id\":\"379_10\",\"Category\":\"3\",\"quantity\":5},{\"id\":\"367_10.5\",\"Category\":\"1\",\"quantity\":5}]'),
(807, 'hahaha', 'james0101@gmail.com', '012-34567890', 'no no no no no no ', '[{\"id\":\"402_\",\"Category\":\"4\",\"quantity\":2},{\"id\":\"367_9.5\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"391_9\",\"Category\":\"3\",\"quantity\":1}]'),
(808, 'James', 'james@gmail.com', '012-463464624', 'no no no no no no', '[{\"id\":\"367_9\",\"Category\":\"1\",\"quantity\":1},{\"id\":\"396_\",\"Category\":\"4\",\"quantity\":1},{\"id\":\"388_9\",\"Category\":\"3\",\"quantity\":1}]'),
(809, 'nike', 'james@gmail.com', '012-34567890', 'asasas', '[{\"id\":\"368_9\",\"Category\":\"1\",\"quantity\":1}]'),
(810, 'ok', 'okko@gmail.com', '015-645634423', 'no no no ', '[{\"id\":\"363_9.5\",\"Category\":\"1\",\"quantity\":1}]'),
(811, 'nike', 'james0101@gmail.com', '0123456789', 'bababab', '[{\"id\":\"364_9\",\"Category\":\"1\",\"quantity\":3}]'),
(812, 'hhh', 'ccz@gmail.com', '0123456789', '123', '[{\"id\":\"362_\",\"Category\":\"1\",\"quantity\":1}]'),
(813, 'a', 's@s.s', 'd', 'f', '[{\"id\":\"391_\",\"Category\":\"3\",\"quantity\":1}]');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `No` int(255) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`No`, `Name`, `Phone`, `Email`, `Message`) VALUES
(1, 'Contact1', '1012121212', 'contact0101@gmail.com', 'very good'),
(2, 'Contact_2', '123456789', 'contact0202@gmail.com', 'ok'),
(3, 'Cindy', '1236547895', 'cindy@gmail.com', 'okok not bed'),
(4, 'mandy', '1294857471', 'mandy0202@gmail.com', 'hihi'),
(5, 'okok', '2147483647', 'okok@gmail.com', 'okok'),
(6, 'Leo', '0135654754767', 'leo@gmail.com', 'very thing is ok');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `coupon_code`, `value`, `status`) VALUES
(1, 'CODE2024', '200.00', 1),
(2, 'DISCOUNT1', '10.00', 1),
(3, 'DISCOUNT2', '150.00', 1),
(4, 'DISCOUNT3', '500.00', 1),
(5, 'INVALIDCODE', '0.00', 0),
(6, 'DISCOUNT GAO GAO', '1000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `price`, `image`, `details`) VALUES
(382, '4', 'Shoes bag 3', '99.00', 'upload/1704162840_shoes bag3.jpeg', 'This product name is shoes bag 3'),
(383, '4', 'Shoes bag4', '99.99', 'upload/1704162878_shoes bag4.png', 'This product name is shoes bag4'),
(384, '4', 'Shoes bag 5', '97.99', 'upload/1704162922_shoes bag5.jpeg', 'This product name is shoes bag5'),
(387, '2', 'Women Slipper3', '69.99', 'upload/1704163081_women slipper3.jpg', 'This product name is Women Slipper 3'),
(388, '3', 'Adidas Kid Stan Smith', '150.00', 'upload/1704165081_adidas kid stan smith.jpeg', 'This product name is adidas kid Stan Smith'),
(389, '3', 'Toddler Original Superstar', '399.99', 'upload/1704165136_adidas kid toddler original superstar.jpg', 'This product name is Toddler Original Superstar'),
(390, '3', 'Adidas Red Kid', '259.99', 'upload/1704165170_adidas red kid.jpeg', 'This product name is Adidas Red Kid'),
(391, '3', 'Adidas Shoes Sneaker', '269.99', 'upload/1704165220_adidas shoes sneaker.jpeg', 'This product name is adidas shoes Sneaker'),
(392, '2', 'Adidas Women Shoes fashion', '239.99', 'upload/1704165272_adidas Women shoes fashion.jpg', 'This product name is adidas women shoes fashion'),
(393, '2', 'Adidas Women shoes Grand Court 2.0', '259.99', 'upload/1704165352_adidas Women shoes Grand Court 2.0.jpg', 'This product name is adidas Women shoes Grand Court 2.0'),
(394, '2', 'adidas Women shoes Sneakers', '249.99', 'upload/1704165393_adidas Women shoes Sneakers.jpg', 'This product name is adidas Women shoes Sneakers'),
(395, '4', 'Adidas 4ATHLTS shoes bag', '69.99', 'upload/1704165530_adidas 4ATHLTS shoes bag.jpeg', 'This product name is adidas 4ATHLTS shoes bag'),
(396, '4', 'Adidas Original Unisex', '89.99', 'upload/1704165570_adidas Original unisex.png', 'This product name is adidas Original Unisex'),
(397, '2', 'Nike Women', '399.98', 'upload/1704168221_women.jpeg', 'This product name is Nike Women'),
(398, '1', 'Nike Men1', '349.99', 'upload/1704168386_men.jpg', 'This product name is Nike Men 1'),
(399, '1', 'Adidas Men SuperStar', '309.99', 'upload/1704184144_adidas Men superstar.jpg', 'This product name is Adidas Men SuperStar '),
(400, '1', 'Men Puma 1', '185.00', 'upload/1704186937_man puma1.jpeg', 'This product name is Man Puma 1'),
(401, '3', 'Kid Puma 1', '99.99', 'upload/1704187089_kid puma1.jpeg', 'This product name is Kid Puma 1'),
(402, '4', 'Shoes Bag 7', '188.88', 'upload/1705973469_shoes bag 7.jpg', 'This is the shoes bag name shoes bag7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `gender`, `email`, `password_hash`) VALUES
(27, 'James', 'male', 'james@gmail.com', '$2y$10$fn6h6rtYd7fmT0jVbQj8TuA9hmBkZE0Ot26/u4lRcrad7y2phfLJS'),
(30, 'Mandy', 'female', 'mandy@gmail.com', '$2y$10$jrynw4ec.NV26xeFMTenGOYZhEy/5.cmjwQ6UDvZuXvpk15dExGyW'),
(31, 'Alex', 'male', 'alex@gmail.com', '$2y$10$/S4oLUYMOQv9SQnRwe69XOyK5eKTN3Vt7iyUh/1PKAU6K2jLgT/a.'),
(32, 'Louis', 'male', 'louis@gmail.com', '$2y$10$XY2G6/M.d3JG19VBP.XPx.hsLYUHIFYWN5SKKzufXAHA92rUWwfj6'),
(33, 'Cindy', 'male', 'cindy@gmail.com', '$2y$10$CoL5AE4/VrnQ5OIUSDp2W.0AsPnKtlUMu/z8ejjju1cTFBgwAOK.a'),
(34, 'Jayden', 'male', 'jayden@gmail.com', '$2y$10$0Q33wBR8m/dGvC/wcbnHnOT3SR5dDF7otybVlc2DF1VuQK.lXgI86');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=814;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
