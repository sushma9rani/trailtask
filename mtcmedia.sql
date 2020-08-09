--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `uuid` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_thumbnail` varchar(255) NOT NULL,
  `latitude` varchar(15) DEFAULT NULL,
  `longitude` varchar(15) DEFAULT NULL,
  `num_bedrooms` int(11) NOT NULL,
  `num_bathrooms` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `propertyType`
--

CREATE TABLE `propertyType` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `id` (`uuid`);

