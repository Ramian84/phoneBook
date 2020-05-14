--
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT 1,
  `street` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `addresses`:
--   `name_id`
--       `names` -> `id`
--   `city_id`
--       `cities` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `cities`:
--

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `names`:
--

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `number` varchar(233) NOT NULL,
  `label` varchar(233) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `phones`:
--   `name_id`
--       `names` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `photos`:
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users_details`:
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id_foreign_key` (`name_id`) USING BTREE,
  ADD KEY `city_address_foreign_key` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_foreign_key` (`name_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_user_id_foreign_key` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`