

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `cart`

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category`, `created_at`) VALUES
(1, 'How do I register as a farmer?', 'Click on Sign Up button, fill in your details, and select \"Farmer\" as your role. You will receive a confirmation email.', 'Account', '2026-01-05 10:17:35'),
(2, 'How can I contact an expert?', 'Go to the Q&A section and post your question, or use the chat feature to directly message available experts.', 'General', '2026-01-05 10:17:35'),
(3, 'What payment methods are accepted?', 'We currently accept Cash on Delivery for all orders. Online payment options will be available soon.', 'Payment', '2026-01-05 10:17:35'),
(4, 'How long does delivery take?', 'Delivery typically takes 2-5 business days depending on your location.', 'Delivery', '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `market_prices`
--

CREATE TABLE `market_prices` (
  `id` int(11) NOT NULL,
  `crop_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(20) DEFAULT 'kg',
  `region` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `price_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market_prices`
--

INSERT INTO `market_prices` (`id`, `crop_name`, `price`, `unit`, `region`, `source`, `price_date`, `created_by`, `created_at`) VALUES
(1, 'Rice (Coarse)', 52.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(2, 'Rice (Fine)', 65.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(3, 'Potato', 25.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(4, 'Onion', 45.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(5, 'Tomato', 60.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(6, 'Cauliflower', 35.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35'),
(7, 'Carrot', 40.00, 'kg', 'Dhaka', 'DAM', '2026-01-05', NULL, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `link`, `is_read`, `created_at`) VALUES
(1, 1, 'order', 'New Order Received', 'Farmer farmer1 placed an order #ORD-2026-0003', 'manage_orders.php?id=3', 0, '2026-01-05 10:17:35'),
(2, 1, 'ticket', 'New Support Ticket', 'User farmer1 submitted a support ticket', 'support_tickets.php?id=1', 0, '2026-01-05 10:17:35'),
(3, 5, 'order', 'Order Confirmed', 'Your order #ORD-2026-0003 has been confirmed', 'my_orders.php', 0, '2026-01-05 10:17:35'),
(4, 3, 'message', 'New Message', 'You have a new message from farmer1', 'chat.php?user=5', 0, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `delivery_address` text NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `payment_method` enum('cash_on_delivery','online') DEFAULT 'cash_on_delivery',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `farmer_id`, `total_amount`, `delivery_address`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 'ORD-2026-0001', 5, 2400.00, 'Village: Nandail, District: Bogra', 'delivered', 'cash_on_delivery', '2026-01-05 10:17:35', '2026-01-05 10:17:35'),
(2, 'ORD-2026-0002', 6, 1950.00, 'Village: Puthia, District: Rajshahi', 'processing', 'cash_on_delivery', '2026-01-05 10:17:35', '2026-01-05 10:17:35'),
(3, 'ORD-2026-0003', 5, 850.00, 'Village: Nandail, District: Bogra', 'pending', 'cash_on_delivery', '2026-01-05 10:17:35', '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 1, 'Urea Fertilizer 50kg', 2, 1200.00),
(2, 2, 4, 'Hybrid Rice Seeds (BR28)', 3, 450.00),
(3, 2, 6, 'Insecticide Spray 1L', 1, 350.00),
(4, 3, 7, 'Hand Sprayer', 1, 850.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `expertise` varchar(100) DEFAULT NULL,
  `farm_size` decimal(10,2) DEFAULT NULL,
  `crops` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `phone`, `address`, `bio`, `expertise`, `farm_size`, `crops`, `profile_picture`) VALUES
(1, 1, 'Admin User', '01711111111', 'Dhaka, Bangladesh', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Manager User', '01722222222', 'Dhaka, Bangladesh', NULL, NULL, NULL, NULL, NULL),
(3, 3, 'Dr. Karim Ahmed', '01733333333', 'Chittagong, Bangladesh', NULL, 'Rice, Pest Control', NULL, NULL, NULL),
(4, 4, 'Prof. Fatima Rahman', '01744444444', 'Sylhet, Bangladesh', NULL, 'Vegetables, Organic Farming', NULL, NULL, NULL),
(5, 5, 'Rahim Mia', '01755555555', 'Bogra, Bangladesh', NULL, NULL, NULL, NULL, NULL),
(6, 6, 'Korim Uddin', '01766666666', 'Rajshahi, Bangladesh', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `status` enum('open','answered','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `farmer_id`, `title`, `content`, `status`, `created_at`) VALUES
(1, 5, 'When should I apply fertilizer to rice?', 'I planted rice 2 weeks ago. When is the best time to apply urea fertilizer?', 'open', '2026-01-05 10:17:35'),
(2, 6, 'My tomato plants have yellow leaves', 'The leaves of my tomato plants are turning yellow. What could be the problem and how do I fix it?', 'open', '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`id`, `order_id`, `revenue`, `cost`, `profit`, `recorded_at`) VALUES
(1, 1, 2400.00, 1800.00, 600.00, '2026-01-05 10:17:35'),
(2, 2, 1950.00, 1400.00, 550.00, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('Fertilizer','Seeds','Pesticides','Tools','Equipment') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `supplier_name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `name`, `description`, `category`, `price`, `stock`, `supplier_name`, `image`, `created_by`, `created_at`) VALUES
(1, 'Urea Fertilizer 50kg', 'High quality nitrogen fertilizer for crops', 'Fertilizer', 1200.00, 500, 'ACI Fertilizer Ltd', NULL, 1, '2026-01-05 10:17:35'),
(2, 'TSP Fertilizer 50kg', 'Triple Super Phosphate for better root growth', 'Fertilizer', 1500.00, 300, 'ACI Fertilizer Ltd', NULL, 1, '2026-01-05 10:17:35'),
(3, 'Potash Fertilizer 50kg', 'Potassium fertilizer for fruit development', 'Fertilizer', 1800.00, 250, 'ACI Fertilizer Ltd', NULL, 1, '2026-01-05 10:17:35'),
(4, 'Hybrid Rice Seeds (BR28)', 'High yield rice variety', 'Seeds', 450.00, 1000, 'BADC Seeds', NULL, 1, '2026-01-05 10:17:35'),
(5, 'Vegetable Seeds Mix', 'Mixed vegetable seeds package', 'Seeds', 250.00, 800, 'Lal Teer Seeds', NULL, 1, '2026-01-05 10:17:35'),
(6, 'Insecticide Spray 1L', 'Effective pest control solution', 'Pesticides', 350.00, 400, 'Syngenta Bangladesh', NULL, 1, '2026-01-05 10:17:35'),
(7, 'Hand Sprayer', 'Manual sprayer for pesticides', 'Tools', 850.00, 150, 'Local Supplier', NULL, 1, '2026-01-05 10:17:35'),
(8, 'Garden Hoe', 'Durable farming hoe', 'Tools', 450.00, 200, 'Local Supplier', NULL, 1, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `status` enum('open','in_progress','resolved','closed') DEFAULT 'open',
  `admin_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `subject`, `message`, `category`, `priority`, `status`, `admin_response`, `created_at`, `updated_at`) VALUES
(1, 5, 'Payment issue', 'I paid for my order but status shows pending', 'Payment', 'high', 'open', NULL, '2026-01-05 10:17:35', '2026-01-05 10:17:35'),
(2, 3, 'Cannot edit my tips', 'Getting error when trying to edit my posted tips', 'Technical', 'medium', 'open', NULL, '2026-01-05 10:17:35', '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `task_date` date NOT NULL,
  `task_type` varchar(50) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `farmer_id`, `title`, `description`, `task_date`, `task_type`, `completed`, `created_at`) VALUES
(1, 5, 'Apply fertilizer to rice field', 'Apply urea fertilizer to the main field', '2026-01-07', 'Fertilizing', 0, '2026-01-05 10:17:35'),
(2, 5, 'Check irrigation system', 'Ensure water pump is working properly', '2026-01-10', 'Watering', 0, '2026-01-05 10:17:35'),
(3, 6, 'Harvest tomatoes', 'Harvest ripe tomatoes from greenhouse', '2026-01-06', 'Harvesting', 0, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `expert_id`, `title`, `content`, `category`, `created_at`) VALUES
(1, 3, 'Best Time to Plant Rice', 'The best time to plant rice in Bangladesh is during the monsoon season (June-July). Ensure proper land preparation and use quality seeds for better yield.', 'Rice', '2026-01-05 10:17:35'),
(2, 3, 'Pest Control for Rice', 'Monitor your rice fields regularly for pests. Use integrated pest management techniques and only apply pesticides when necessary.', 'Pest Control', '2026-01-05 10:17:35'),
(3, 4, 'Organic Vegetable Farming', 'Use compost and organic fertilizers for healthier vegetables. Crop rotation helps prevent soil depletion and reduces pest problems.', 'Vegetables', '2026-01-05 10:17:35'),
(4, 4, 'Water Management Tips', 'Proper irrigation is crucial. Water your crops early morning or late evening to minimize evaporation. Install drip irrigation for efficiency.', 'General', '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','management','expert','farmer') NOT NULL,
  `status` enum('active','suspended') DEFAULT 'active',
  `verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `status`, `verified`, `created_at`) VALUES
(1, 'admin', 'admin@agrismart.com', '123456', 'admin', 'active', 1, '2026-01-05 10:17:35'),
(2, 'manager1', 'manager1@agrismart.com', '123456', 'management', 'active', 1, '2026-01-05 10:17:35'),
(3, 'expert1', 'expert1@agrismart.com', '123456', 'expert', 'active', 1, '2026-01-05 10:17:35'),
(4, 'expert2', 'expert2@agrismart.com', '123456', 'expert', 'active', 1, '2026-01-05 10:17:35'),
(5, 'farmer1', 'farmer1@agrismart.com', '123456', 'farmer', 'active', 1, '2026-01-05 10:17:35'),
(6, 'farmer2', 'farmer2@agrismart.com', '123456', 'farmer', 'active', 1, '2026-01-05 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `weather_forecast`
--

CREATE TABLE `weather_forecast` (
  `id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `forecast_date` date NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `humidity` int(11) DEFAULT NULL,
  `rainfall` decimal(5,2) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weather_forecast`
--

INSERT INTO `weather_forecast` (`id`, `location`, `forecast_date`, `temperature`, `humidity`, `rainfall`, `description`, `created_by`, `created_at`) VALUES
(1, 'Dhaka', '2026-01-05', 32.00, 75, 0.00, 'Partly cloudy', NULL, '2026-01-05 10:17:35'),
(2, 'Dhaka', '2026-01-06', 33.00, 78, 5.00, 'Light rain expected', NULL, '2026-01-05 10:17:35'),
(3, 'Dhaka', '2026-01-07', 31.00, 80, 15.00, 'Moderate rain', NULL, '2026-01-05 10:17:35'),
(4, 'Dhaka', '2026-01-08', 30.00, 82, 20.00, 'Heavy rain', NULL, '2026-01-05 10:17:35'),
(5, 'Dhaka', '2026-01-09', 31.00, 79, 10.00, 'Scattered showers', NULL, '2026-01-05 10:17:35'),
(6, 'Dhaka', '2026-01-10', 32.00, 76, 2.00, 'Mostly sunny', NULL, '2026-01-05 10:17:35'),
(7, 'Dhaka', '2026-01-11', 33.00, 74, 0.00, 'Clear sky', NULL, '2026-01-05 10:17:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `expert_id` (`expert_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_prices`
--
ALTER TABLE `market_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expert_id` (`expert_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `weather_forecast`
--
ALTER TABLE `weather_forecast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `market_prices`
--
ALTER TABLE `market_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `revenue`
--
ALTER TABLE `revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weather_forecast`
--
ALTER TABLE `weather_forecast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `market_prices`
--
ALTER TABLE `market_prices`
  ADD CONSTRAINT `market_prices_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `revenue`
--
ALTER TABLE `revenue`
  ADD CONSTRAINT `revenue_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD CONSTRAINT `shop_products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `tips_ibfk_1` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weather_forecast`
--
ALTER TABLE `weather_forecast`
  ADD CONSTRAINT `weather_forecast_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;


