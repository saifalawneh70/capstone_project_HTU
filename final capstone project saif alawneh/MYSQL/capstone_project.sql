-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 08:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_img` varchar(100) NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  `date_engage` date NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_img`, `admin_phone`, `date_engage`, `activation`) VALUES
(1, 'Saif aldeen Alawneh', 'Sa123456789', 'saifalawneh70@gmail.com', '1600491172last image.png.jpeg', '0795163090', '2020-09-11', 1),
(2, 'Ali alawneh', 'Al123456789', 'ali.alawneh10@gmail.com', 'reference-image-2.jpg', '0787814498', '2020-09-12', 1),
(6, 'saleh ahmad', 'Sa123456789', 'salehahmad@yahoo.com', '1601483123articl2.jpg', '0787814498', '2020-09-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges`
--

CREATE TABLE `admin_privileges` (
  `id` int(5) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `privilges` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_privileges`
--

INSERT INTO `admin_privileges` (`id`, `admin_id`, `privilges`) VALUES
(18, 6, 'admin'),
(19, 6, 'cat'),
(20, 6, 'vendor'),
(27, 1, 'admin'),
(28, 1, 'cat'),
(29, 1, 'vendor'),
(30, 1, 'product'),
(31, 1, 'customer'),
(32, 1, 'orders');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(4) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_img` varchar(100) NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_img`, `activation`) VALUES
(1, 'ELECTRONICS', '1600806276elec1.jpeg', 1),
(2, 'CLOTHES', '1600805645images3.jpg', 1),
(3, 'Sports & Tools', '1600808637sport1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment_users`
--

CREATE TABLE `comment_users` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `product_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_users`
--

INSERT INTO `comment_users` (`id`, `name`, `email`, `phone`, `comment`, `product_id`) VALUES
(2, 'saif aldeen alawneh', 'saifalawneh70@gmail.com', '0795163090', 'Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.', 59),
(3, 'saif aldeen alawneh', 'saifalawneh70@gmail.com', '0795163090', 'Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.', 59),
(4, 'mohammad alawneh', 'mohammadmalawneh@gmail.com', '0775641234', 'Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.', 51),
(5, 'saif aldeen alawneh', 'saifalawneh70@gmail.com', '0795163090', 'Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.', 51);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(4) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_phone` varchar(20) NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `cust_email`, `cust_password`, `cust_phone`, `activation`) VALUES
(7, 'alia ahmaf', 'aliaahmad888@gmail.com', 'al123456789', '0787814498', 1),
(9, 'alaa aldeen alawneh', 'alaaalawneh50@gmail.com', 'al123456789', '0790977932', 1),
(10, 'saif alawneh', 'saifalawneh29@yahoo.com', 'sa123456789', '0787815598', 1),
(11, 'saif alawenh', 'saifalawneh70@gmail.com', 'CezleIWR', '0795163090', 1),
(12, 'laila ali', 'lailaali555@gmail.com', 'li123456789', '07878144988', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(4) NOT NULL,
  `cust_id` int(4) NOT NULL,
  `address_id` int(4) NOT NULL,
  `order_date` date NOT NULL,
  `total` decimal(4,0) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Situation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `address_id`, `order_date`, `total`, `Notes`, `Situation`) VALUES
(16, 10, 26, '2020-09-29', '3614', 'this product is gift', 1),
(18, 10, 28, '2020-09-29', '226', 'nothing', 1),
(19, 10, 29, '2020-09-29', '48', 'nothing', 1),
(20, 7, 30, '2020-09-30', '251', 'nothing', 1),
(21, 7, 31, '2020-09-30', '46', 'nothing', 1),
(22, 7, 32, '2020-10-01', '43', 'nothing', 1),
(23, 7, 33, '2020-10-01', '198', 'eeee', 1),
(24, 7, 34, '2020-10-01', '25', 'nothing', 1),
(25, 7, 35, '2020-10-01', '198', 'nothing', 1),
(26, 7, 36, '2020-10-02', '46', 'noting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `address_id` int(4) NOT NULL,
  `city` varchar(32) NOT NULL,
  `town` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`address_id`, `city`, `town`) VALUES
(26, 'Irbid', 'tayybiah'),
(28, 'Amman', 'Tlaa AlAli'),
(29, 'Amman', 'Tlaa AlAli'),
(30, 'Amman', 'Tlaa AlAli'),
(31, 'Irbid', 'tayybiah'),
(32, 'Ajloun', 'Ajloun Cas'),
(33, 'Irbid', 'tayybiah'),
(34, 'Irbid', 'tayybiah'),
(35, 'Irbid', 'tayybiah'),
(36, 'Irbid', 'tayybiah');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(4) NOT NULL,
  `order_id` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `product_price` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `product_price`) VALUES
(38, 16, 64, '1802'),
(39, 16, 64, '1802'),
(40, 18, 52, '216'),
(41, 19, 54, '38'),
(42, 20, 52, '216'),
(43, 20, 58, '25'),
(44, 21, 57, '36'),
(45, 22, 62, '33'),
(46, 23, 51, '188'),
(47, 24, 59, '15'),
(48, 25, 51, '188'),
(49, 26, 57, '36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(4) NOT NULL,
  `product_name` varchar(1000) NOT NULL,
  `product_desc` varchar(3000) NOT NULL,
  `product_price` decimal(4,0) NOT NULL,
  `quantity` int(4) NOT NULL,
  `product_date` date NOT NULL,
  `discount` int(3) NOT NULL,
  `rating` int(5) NOT NULL,
  `rating_count` int(5) NOT NULL,
  `activation` tinyint(1) NOT NULL,
  `vendor_id` int(4) NOT NULL,
  `cat_id` int(4) NOT NULL,
  `sub_cat_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`, `quantity`, `product_date`, `discount`, `rating`, `rating_count`, `activation`, `vendor_id`, `cat_id`, `sub_cat_id`) VALUES
(50, 'Apple MacBook Air , Space Gray (Latest Model)', 'Stunning 13.3-inch Retina display with True Tone technology , Backlit Magic Keyboard and Touch ID , Tenth-generation Intel Core i3 processor , Intel Iris Plus Graphics , Fast SSD storage , 8GB of memory , Stereo speakers with wider stereo sound , Two Thunderbolt 3 (USB-C) ports , Up to 11 hours of battery life , Up to 11 hours of battery life , Force Touch trackpad', '798', 10, '2020-09-23', 25, 0, 0, 1, 12, 1, 22),
(51, 'Lenovo IdeaPad 3 14', 'AMD Ryzen 5 3500U Mobile Processors with Radeon Graphics deliver powerful performance for everyday tasks , Dopoundsy Audio delivers crystal-clear sound, while the 14-inch FHD screen and narrow side bezels give you more viewing area and less clutter , Quick and quiet with Q-control – Effortlessly swap between fast & powerful performance and quiet battery saving mode , Connect with ease using Bluetooth 4.1, up to 2x2 Wi-Fi 5, three USB ports, and HDMI , Keep your privacy intact with a physical shutter for your webcam. You\'ll enjoy privacy right at your fingertips , System RAM Type: DDR4 SDRAM', '250', 0, '2020-09-23', 25, 0, 0, 1, 12, 1, 22),
(52, 'Acer Chromebook Spin 311 Convertible Laptop', 'Chromebook runs on Chrome OS - An operating system by Google that is built for the way we live today. It comes with built-in virus protection, updates automatically, boots up in seconds and continues to stay fast over time. (Internet connection is required) , All the Google apps you know and love come standard on every Chromebook, which means you can edit, download, and convert Microsoft Office files in Google Docs, Sheets and Slides , Get access to more than 2 million Android apps from Google Play to learn and do more,  Chromebooks come with built-in storage for offline access to your most important files and an additional 100GB of Google Drive space to ensure that all of your files are backed up automatically , Acer CP311-2H-C679 convertible Chromebook comes with 11.6” HD Touch IPS Display, Intel Celeron N4020, 4GB LPDDR4 Memory, 32GB eMMC, Google Chrome and Up to 10-hours battery life  ', '288', 10, '2020-09-23', 25, 0, 0, 1, 12, 1, 22),
(53, 'Apple AirPods Pro', 'Active noise cancellation for immersive sound , Transparency mode for hearing and connecting with the world around you , Three sizes of soft, tapered silicone tips for a customizable fit , Sweat and water resistant , Adaptive EQ automatically tunes music to the shape of your ear , Easy setup for all your Apple devices , Quick access to Siri by saying “Hey Siri” , The Wireless Charging Case delivers more than 24 hours of battery life', '128', 30, '2020-09-23', 0, 0, 0, 1, 12, 1, 25),
(54, 'TOZO T6 True Wireless Earbuds Bluetooth Headphones ', '[TWS & BLUETOOTH 5. 0] - Adopt the most advanced Bluetooth 5. 0 technology. TOZO T6 Support HSP, HFP, A2DP, AVRCP. Provides in-call stereo sound. Also own fast and stable transmission without tangling , [Hi-Fi Stereo Sound Quality] - TOZO T6 Offers a Truly Natural, Authentic Sound and Powerful Bass Performance with 6mm Large Size Speaker Driver , [One step pairing] - pick up 2 headsets from charging box They will connect each other automatically, then only one step easily enter mobile phone Bluetooth setting to pair the earbuds , [IPX8 waterproof]- earbuds and charging case inner Nano-coating makes it possible to waterproof for 1 meters deep for 30 minutes. It is suitable for sports to prevent water. Ideal for sweating it out at the gym . Even Wash the earbuds and base , [Charge on-the-go] - TOZO T6 wireless earbuds can last for over 6 hours\' playtime from a single charge and 24 extra hours in the compact charging case. Charging case support wireless charging. Providing convenient charging way with no strings attached ', '38', 3, '2020-09-23', 0, 0, 0, 1, 12, 1, 25),
(55, 'Feminism Quotes Feminist Gifts Womens Rights T-Shirt', 'Solid colors: 100% Cotton; Heather Grey: 90% Cotton, 10% Polyester; All Other Heathers: 50% Cotton, 50% Polyester\r\nImported , Machine wash cold with like colors, dry low heat ,  Cool Gift Idea for patriotic Men, Women - Feminist Quotes Design. Awesome present for political fan, dissent, dad, daddy, father, grandma, mom, mother, best friend, uncle, aunt, girlfriend, auntie, boy, girl on Christmas Day / New Year / Birthday , Show your support for feminism, equal rights, civil rights and women\'s rights to vote. Cool for protest march and women\'s rights march. Complete your collection of truth quotes accessories for him and her. Funny gift idea for law students, lawyers., Lightweight, Classic fit, Double-needle sleeve and bottom hem.', '21', 7, '2020-09-25', 0, 0, 0, 1, 13, 2, 33),
(56, 'Hanes Mens Pullover Ecosmart Fleece Hooded Sweatshirt', '5% polyester created from recycled plastic bottles , Imported , Pull On closure , Machine Wash ,50% cotton 50% polyester , patented low pill high-stitch density PrintPro XP fabric , two-ply hood , tag-free neck label .', '25', 0, '2020-09-22', 0, 0, 0, 1, 13, 2, 33),
(57, 'Amoretu Women Summer Tunic Dress V Neck Casual Loose Flowy Swing Shift Dresses', 'Tips: Amoretu item is manufactured by self-owned factory by 100% Dacron. Amoretu did not supply goods to any other sellers, they are selling counterfeits which is different in size, color, and design , Deep v neckline with lantern long sleeve/short sleeve/sleevelesss, super sexy, fashionable and elegant ,  Pleated loose swing dress with tunic length, solid color, ruffle, simple and plain, tiered dress, can be easily dress up and dress down ,  Above the knee length dress perfect for casual daily wear, party, club, work, office, business, vacation, beach, etc ,Perfect tunic dress for leggings, tights, or laying with coat, jackets, sweaters in spring, autumn and winter ,  NOTICE: Long sleeve dress is on sale. Short sleeve dress and tank dress had released for this colorful summer. Please refer to our size chart for choosing your most suitable one ', '36', 12, '2020-09-24', 0, 0, 0, 1, 13, 2, 32),
(58, 'Kimono For Women Kimono Cardigan Beach Cover Up Geometry Print Short Sleeve Loose', '100% Rayon , we will send this kimono by expedited shipping , and delivered by usps . only need 8-10 working days to arrive you after you confirm order. length:53.93“（137cm） , shoulder 25.59“（65cm）, sleeve7.48”（ 19cm ）. Fit for US size L-XXL. This ideal Kimono cover-up is Made from soft chiffon/Cotton material floral print ,plus size .never with Chemical smells! , Loose or slim fitting Kimono cardigan. A kimono style long cardigan with roomy half length or long sleeves,open front kimono , Stylish bathing suit cover up for swimwear, beach kimono for women. This swimsuit covers make skin cool in hot weather and A great floral print cardigan for both dressy and casual outfits. It’s a bikini cover up, beach cover up, wedding dress coverup .perfect for any occasion. Use as a finishing touch over high-waisted shorts and a crop top. Throw it over your swimsuit at the pool or beach. Pair with a pencil dress and wedges for a cute brunch outfit. Or go for a bohemian chic daytime look with a cami, distressed jeans, and booties!', '25', 12, '2020-09-25', 0, 0, 0, 1, 13, 2, 32),
(59, 'Womens Women Belong In All Places Where Decisions Are Being Made V-Neck T-Shirt', 'Solid colors: 100% Cotton; Heather Grey: 90% Cotton, 10% Polyester; All Other Heathers: 50% Cotton, 50% Polyester\r\nImported , Machine wash cold with like colors, dry low heat ,\r\nWomen Belong In All Places Where Decisions are Being Made Tee Gift,\r\nLightweight, Classic fit, Double-needle sleeve and bottom hem', '15', 21, '2020-09-26', 0, 0, 0, 1, 13, 2, 32),
(60, 'XTERRA Fitness TR150 Folding Treadmill Black', 'Large 16\" X 50\" Walking/running surface ,  Large 5 inch LCD display is easy to read and keeps you updated on speed, incline, time, distance, calories, and pulse , Speed range 0. 5 -10 MPH allows for users of all fitness levels.Pull the knob to release the deck to fold or unfold ,  12 preset programs offer unmatched variety for your workouts , 3 Manual incline settings allow for maximum variety. Side rails: plastic. Belt: 1 ply, 1. 4mm , Prop 65: this product can expose you to chemicals including toluene and acrylamide which are known to the state of California to cause cancer, birth defects, or other reproductive harm.', '332', 22, '2020-09-26', 10, 0, 0, 1, 14, 3, 28),
(61, 'Sunny Health & Fitness SF-RW5515 Magnetic Rowing Machine Rower W/LCD Monitor', 'DIGITAL MONITOR - The large LCD console displays time, count, calories, total count, scan. The convenient scan mode displays your progress to assist you in tracking all your fitness goals ,EXTRA LONG SLIDE RAIL - At 48 inches in slide rail length and 44 inches in inseam length, the SF-RW5515 can accommodate rowers of nearly any size , ADJUSTABLE MAGNETIC RESISTANCE - With a simple twist, you can increase or decrease the 8 levels of magnetic resistance, so your workout can remain challenging and effective throughout your fitness journey.\r\nTRANSPORTATION WHEELS - Built in transportation wheels for easy portability. Simply tilt and roll out for use or away for storage, no need for heavy lifting or muscle strainch Folded Dimensions: 37L X 19W X 53. 5H inches\r\nNON-SLIP FOOT PEDALS - Textured non-slip foot pedals will ensure safe footing during the most demanding and vigorous workouts! Foot straps keep your feet saddled in so you can focus on the workout without feeling unbalanced , FOAM GRIP HANDLEBARS - Help prevent calluses with the improved Sunny Health & Fitness Handle Bars. Non-Slip foam grip handlebars offer comfort while enduring those long rides.', '229', 15, '2020-09-27', 5, 0, 0, 1, 14, 3, 28),
(62, 'Little Tikes First Slide (Red/Blue) - Indoor / Outdoor Toddler Toy', 'Perfect beginner\'s slide, sized especially for younger kids (3-feet long)\r\nFolds down without tools for compact storage and moving\r\nProduct Size: 23.00\'\'L x 18.00\'\'W x 39.00\'\'H and Slide length: 38.00\'\'L.Handrails snap into place\r\nKids can use the slide inside or outside. Age- 18 months - 6 years\r\nMade in USA.Note:Push down on the item handle until an audible click is heard to ensure the handles are secure.', '33', 4, '2020-09-24', 1, 0, 0, 1, 14, 3, 26),
(63, 'Little Tikes 2 -In- 1 Snug N Secure Grow With Me Swing - Blue', 'Easy-in hinged T-bar ,\r\nStay-put shoulder straps hold baby securely in place ,\r\nAs the child grows and doesn\'t require the T-bar or straps, they store conveniently out of the way ,\r\nThis outdoor baby swing is the perfect addition to any swing set. This product does not come with anchors,\r\nMade in the USA. Maximum fall height protection up to 7 feet required.', '27', 9, '2020-09-25', 0, 0, 0, 1, 14, 3, 26),
(64, 'New Apple MacBook Pro', 'Ninth-generation 6-Core Intel Core i7 Processor ,\r\nStunning 16-inch Retina Display with True Tone technology ,\r\nTouch Bar and Touch ID ,\r\nAMD Radeon Pro 5300M Graphics with GDDR6 memory ,\r\nUltrafast SSD ,\r\nIntel UHD Graphics 630 ,\r\nSix-speaker system with force-cancelling woofers ,\r\nFour Thunderbolt 3 (USB-C) ports ,\r\nUp to 11 hours of battery life ,\r\n802.11AC Wi-Fi.', '1820', 1, '2020-09-29', 1, 0, 0, 1, 12, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `product_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_img`) VALUES
(73, 50, '1600811526mac1.jpg'),
(74, 50, '1600811526mac2.jpg'),
(75, 50, '1600811526mac4.jpg'),
(76, 51, '1600812045lenovo1.jpg'),
(77, 51, '1600812045lenovo2.jpg'),
(78, 51, '1600812045lenovo3.jpg'),
(79, 52, '1600812290acer1.jpg'),
(80, 52, '1600812290acer2.jpg'),
(81, 52, '1600812290acer3.jpg'),
(82, 53, '1600812615headset1.jpg'),
(83, 53, '1600812615headset2.jpg'),
(84, 53, '1600812615headset3.jpg'),
(85, 54, '1600812935headblack1.jpg'),
(86, 54, '1600812936headblack2.jpg'),
(87, 54, '1600812936headblack3.jpg'),
(88, 55, '1600990125tshert1.jpg'),
(89, 55, '1600990125tshertd1.jpg'),
(90, 56, '1600991840tshert2.jpg'),
(91, 56, '1600991840tshert3.jpg'),
(92, 57, '160099287361+eFuQszQL._SS1000_.jpg'),
(93, 57, '160099287461G9MnH8qsL._SS400_.jpg'),
(94, 57, '160099287461x7YIl6c0L._SS400_.jpg'),
(95, 58, '160099323561nKZrV2xwL._SS400_.jpg'),
(96, 58, '160099323571JDPvd9kcL._SS400_.jpg'),
(97, 58, '1600993235616Ufk1FLBL._SS400_.jpg'),
(104, 59, '1601000748te1.jpg'),
(105, 60, '1601132909image1.jpg'),
(106, 60, '1601132909image2.jpg'),
(107, 60, '1601132909image3.jpg'),
(108, 61, '1601133329image4.jpg'),
(109, 61, '1601133329image5.jpg'),
(110, 61, '1601133329image6.jpg'),
(111, 61, '1601133329image7.jpg'),
(112, 62, '1601134311image8.jpg'),
(113, 62, '1601134311image9.jpg'),
(114, 62, '1601134311image10.jpg'),
(115, 63, '1601134609image11.jpg'),
(116, 63, '1601134609image12.jpg'),
(117, 63, '1601134609image13.jpg'),
(122, 64, '1601535171mac5.jpg'),
(123, 64, '1601535171mac6.jpg'),
(124, 64, '1601535171mac8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(4) NOT NULL,
  `cat_id` int(4) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `cat_id`, `sub_cat_name`, `activation`) VALUES
(22, 1, 'Laptops', 1),
(25, 1, 'HeadPhone', 1),
(26, 3, 'Leisure Sports', 1),
(27, 3, 'Strength & Weights', 1),
(28, 3, 'Cardio Training', 1),
(32, 2, 'Women', 1),
(33, 2, 'Men', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(4) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_email` varchar(100) NOT NULL,
  `vendor_img` varchar(100) NOT NULL,
  `vendor_password` varchar(100) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `cat_id` int(4) NOT NULL,
  `date_engage` date NOT NULL,
  `activation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_img`, `vendor_password`, `vendor_phone`, `cat_id`, `date_engage`, `activation`) VALUES
(12, 'mohammad mamon alawneh', 'mohammadmalawneh@gmail.com', '1600810939user-lg.jpg', 'Ma123456789', '0776219747', 1, '2020-09-23', 1),
(13, 'Sara Ahmad', 'saraahmad20@yahoo.com', '1600989790reference-image-1.jpg', 'Sa123456789', '0778851510', 2, '2020-09-25', 1),
(14, 'rahaf bttah', 'rahafbttah24@gmail.com', '16011325641.png', 'Ra123456789', '0784875895', 3, '2020-09-26', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comment_users`
--
ALTER TABLE `comment_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_users`
--
ALTER TABLE `comment_users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `address_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
