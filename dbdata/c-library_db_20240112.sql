-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 09:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c-library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_status_tb`
--

CREATE TABLE `book_status_tb` (
  `status_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `borrowed_at` date DEFAULT current_timestamp(),
  `due_back` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_tb`
--

CREATE TABLE `book_tb` (
  `book_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `authors` varchar(50) DEFAULT NULL,
  `registered_at` date NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_tb`
--

INSERT INTO `book_tb` (`book_id`, `title`, `description`, `authors`, `registered_at`, `image_url`) VALUES
(222, 'PHP 5 For Dummies', 'Covers the latest major release of PHP, the most popular opensource Web scripting language, in the friendly, easy-to-understandFor Dummies style PHP is installed on nearly nine million servers, and usage hasgrown at the rate of 6.5 percent per month for the past twoyears PHP is easy to learn, well suited for Web development, and canbe embedded with HTML, making it a good choice for creating dynamicWeb pages for e-commerce sites and other Web applications; adatabase-friendly language, it connects easily to Sybase, MySQL,mSQL, Oracle, and other databases Explains how to acquire and install PHP, how PHP\'s featuresmake it a useful scripting language, and how to use PHP for threeof the most common applications: interactive Web sites, databasestorage, and common operating system tasks', 'Janet Valade', '2024-01-11', 'http://books.google.com/books/content?id=Q9OP0ClTTvIC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(223, 'Pro PHP Security', '* One of the first books devoted solely to PHP security * Covers a wide swath of both defensive and proactive security measures, showing readers how to create captchas, validate email, fend off SQL injection attacks, and more * Methods discussed are compatible with PHP 3, 4, and 5', 'Chris Snyder, Michael Southwell', '2024-01-11', 'http://books.google.com/books/content?id=lVXnmsCCd3wC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(224, 'Extending and Embedding PHP', 'Teaches every PHP developer how to increase the performance and functionality of PHP- based websites, programs and applications.', 'Sara Golemon', '2024-01-11', 'http://books.google.com/books/content?id=zMbGvK17_tYC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(225, 'Programming PHP', 'This is a comprehensive guide to PHP, a simple yet powerful language for creating dynamic web content. It is a detailed reference to the language and its applications, including such topics as form processing, sessions, databases, XML, and graphics and Covers PHP 4, the latest version.', 'Rasmus Lerdorf, Kevin Tatroe', '2024-01-11', 'http://books.google.com/books/content?id=aqJQAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(226, 'PHP Functions Essential Reference', 'This guide extensively covers the latest developments through PHP4, including extensive coverage of Zend. PHP functions are clearly illustrated with detailed examples, and there is unbeatable coverage of using PHP alongside MySQL.', 'Zak Greant, Graeme Merrall, Torben Wilson, Brett M', '2024-01-11', 'http://books.google.com/books/content?id=ehSpcjvPxcAC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(227, 'PHP for the Web', 'With PHP for the World Wide Web, Fourth Edition: Visual QuickStart Guide, readers can start from the beginning to get a tour of the programming language, or look up specific tasks to learn just what they need to know. This task-based visual reference guide uses step-by-step instructions and plenty of screenshots to teach beginning and intermediate users this popular open-source scripting language. Leading technology author Larry Ullman guides readers through the latest developments including use and awareness of HTML5 with PHP. Other addressed changes include removal of outdated functions and more efficient ways to tackle common needs. Both beginning users, who want a thorough introduction to the technology, and more intermediate users, who are looking for a convenient reference, will find what they need here--in straightforward language and through readily accessible examples.', 'Larry Ullman', '2024-01-11', 'http://books.google.com/books/content?id=0sGIpzsckNAC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(228, 'Learning PHP', 'Explores features of PHP 5.x and the enhancements in the latest relese, PHP 7.', 'David Sklar', '2024-01-11', 'http://books.google.com/books/content?id=HpX4CwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(229, 'PHP in Action', 'To keep programming productive and enjoyable, state-of-the-art practices andprinciples are essential. Object-oriented programming and design help managecomplexity by keeping components cleanly separated. Unit testing helps preventendless, exhausting debugging sessions. Refactoring keeps code supple andreadable. PHP offers all this-and more. PHP in Action shows you how to apply PHP techniques and principles to all themost common challenges of web programming, including: Web presentation and templates User interaction including the Model-View-Contoller architecture Input validation and form handling Database connection and querying and abstraction Object persistence Purchase of the print book comes with an offer of a free PDF, ePub, and Kindle eBook from Manning. Also available is all code from the book.', 'Marcus Baker, Chris Shiflett, Dagfinn Reiersol', '2024-01-11', 'http://books.google.com/books/content?id=KjszEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(230, 'PHP and MySQL for Dynamic Web Sites, Fourth Edition', 'It hasn\'t taken Web developers long to discover that when it comes to creating dynamic, database-driven Web sites, MySQL and PHP provide a winning open-source combination. Add this book to the mix, and there\'s no limit to the powerful, interactive Web sites that developers can create. With step-by-step instructions, complete scripts, and expert tips to guide readers, veteran author and database designer Larry Ullman gets right down to business: After grounding readers with separate discussions of first the scripting language (PHP) and then the database program (MySQL), he goes on to cover security, sessions and cookies, and using additional Web tools, with several sections devoted to creating sample applications. This guide is indispensable for beginning to intermediate level Web designers who want to replace their static sites with something dynamic. In this edition, the bulk of the new material covers the latest features and techniques with PHP and MySQL. Also new to this edition are chapters introducing jQuery and object-oriented programming techniques.', 'Larry Ullman', '2024-01-11', 'http://books.google.com/books/content?id=44uIVmlM3XoC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(231, 'Real-World Solutions for Developing High-Quality PHP Frameworks and Applications', 'Learn to develop high-quality applications and frameworks in PHP Packed with in-depth information and step-by-step guidance, this book escorts you through the process of creating, maintaining and extending sustainable software of high quality with PHP. World-renowned PHP experts present real-world case studies for developing high-quality applications and frameworks in PHP that can easily be adapted to changing business requirements. . They offer different approaches to solving typical development and quality assurance problems that every developer needs to know and master. Details the process for creating high-quality PHP frameworks and applications that can easily be adapted to changing business requirements Covers the planning, execution, and automation of tests for the different layers and tiers of a Web application Demonstrates how to establish a successful development process Shares real-world case studies from well-known companies and their PHP experts With this book, you’ll learn to develop high-quality PHP frameworks and applications that can easily be maintained with reasonable cost and effort.', 'Sebastian Bergmann, Stefan Priebsch', '2024-01-11', 'http://books.google.com/books/content?id=K5dYi2HfAOYC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(232, 'Vancouver', 'Vancouver is a startlingly beautiful city of dreams and desires. Its mountains, rivers, ocean, and islands are arresting to the eye and exciting to the soul. The long and varied human history of this magical place is irresistibly grand and eventful. Vancouver -- the city, the land -- has al-ways been a place of appetites, of licenses offered and liberties taken. Since the time the humans crossed the Bering Strait and journeyed down the Pacific Coast seeking a fabled land of plenty, Vancouver, caught between soaring mountains and a vast ocean, has been a destiny for the spirit. Beginning in the dying era of the last Ice Age, Vancouver unfolds with the story of Tooke, the last survivor of a Siberian people and ancestor to the first nations of Vancouver. Moving through history in a rich, ever-expanding tapestry, Vancouver reveals a fascinating cast of characters. Long before recorded history, a young girl faces the terrifying prospect of marriage into a faraway tribe. Hundreds of years later, a Georgian cartographer aboard a Spanish exploration fleet nearly meets his end at the hands of her descendants. In the passing of the next centuries, a Scottish trapper becomes the reluctant leader of a fur-trading outpost on Vancouver\'s shores, and a Chinese peasant boy seeks an elusive fortune. The burgeoning colony of Vancouver lures a turn-of-the-century British adventurer and a German noble. In modern times, a superstar singer and film actress meets her destiny in the form of a young native girl struggling to free herself from the city\'s impoverished downtown eastside. The characters of Vancouver are all vastly different, yet they all share something -- a powerful attraction to a grand and giving land. Their stories intertwine, touching the extremes of human experience: riches, bravery, betrayal, crime, passion, and forbidden love.', 'David Cruise, Alison Griffiths', '2024-01-11', 'http://books.google.com/books/content?id=bp5lGwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(233, 'Relocation 101', 'No description.', 'Janet Auty-Carlisle, Kai Hansen', '2024-01-11', 'http://books.google.com/books/content?id=R1pF9TWEcmwC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(234, 'Active Vancouver', 'Active Vancouveroffers the reader a variety of pursuits--cycling, trail running, hiking, snowshoeing, paddling, walking, and nature treks--all within a day trip of Vancouver, British Columbia, one of the most vibrant urban regions in the world for access to recreational green space. The myriad activities featured in this unique guidebook are for locals and tourists alike who have beginner to intermediate skills in each sport. Here you\'ll find all the year-round information needed to plan a fun, energetic and educational adventure day in one of the most beautiful cities in the world. Readers are able to scan activities quickly for timing, distance, elevation and accessibility. Equally important, each activity also provides an \"Eco-Insight\" into the natural history of the locale to give the user a deeper connection with the environment. Complete with colour photographs and maps,Active Vancouveris the ultimate resource for both exciting and family-friendly outdoor recreation in and around Vancouver throughout the year.', 'Roy Jantzen', '2024-01-11', 'http://books.google.com/books/content?id=FThACQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(235, 'Vancouver, British Columbia, the Sunset Doorway of the Dominion', 'No description.', 'Vancouver Tourist Association', '2024-01-11', 'http://books.google.com/books/content?id=K5UtAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(236, 'City Making in Paradise', 'Time and again, Vancouver is recognized internationally as one of the best places to live. It achieved that reputation by breaking rules and forging its own brand of North American urbanism. City Making in Paradise details the nine most important decisions made in the Greater Vancouver region since the 1940s. Authors Mike Harcourt and Ken Cameron, themselves key players in several of these developments, reveal the political machinations, the ideological struggles and the personal commitment that lay behind each one. By tracing today’s successes back to their roots, they illustrate their central theme; that cities are the result of the daily choices we make as leaders, activists and citizens.', 'Ken Cameron, Mike Harcourt', '2024-01-11', 'http://books.google.com/books/content?id=N0k4rXDCIAwC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(237, 'Exploring Vancouver', 'Vancouver\'s streetscapes have changed drastically in recent years. New buildings representing current architectural trends are mixing with and often replacing those of earlier eras and tastes. Exploring Vancouver invites the reader to experience the city\'s continually evolving landscape in a readable, yet authoritative, guide.', 'Harold Kalman, Ron Phillips', '2024-01-11', 'http://books.google.com/books/content?id=XISIuGPVlLMC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(238, 'Portraits of Vancouver Island', '\"Chris Cheadle takes us on a tour of some of Vancouver Island\'s best and most beautiful locations. We are provided with an overview of the Island\'s history and suggestions on places to visit from the top of the island to the bottom.\"--', 'Chris Cheadle', '2024-01-11', 'http://books.google.com/books/content?id=sZ0oDAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(239, 'Fodor\'s Vancouver & Victoria', 'Full-color guide • Make your trip to Vancouver & Victoria unforgettable Customize your trip with simple planning tools • Top experiences & attractions • Best Bets for restauants and hotels • Easy-to-read color neighborhood and regional maps Explore Vancouver, Victoria, Whistlery and beyond • Discerning Fodor’s Choice picks for hotels, restaurants, sights, and more • “Word of Mouth” tips from fellow Fodor’s travelers • Best outdoor activities, museums, shopping, and whale-watching opportunities Opinions from destination experts • Fodor’s Vancouver- and Victoria-based writers reveal their favorite local haunts • Frequently updated to provide the latest information', 'Fodor\'s', '2024-01-11', 'http://books.google.com/books/content?id=QxthX2pz3iYC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(240, 'Vancouver Island and British Columbia', 'No description.', 'Matthew Macfie', '2024-01-11', 'http://books.google.com/books/content?id=YsUOAAAAYAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(241, 'Vancouver Short Stories', '\"In a sense, we haven’t got an identity until somebody tells our story. The fiction makes us real.\"--Robert Kroetsch in Creation Spanning a period of nearly eighty years, the stories in this collection present the experience of living in Vancouver as filtered through the imagination of many of Canada’s most famous writers. The romantic attitude of some of the early writers is balanced by the more sombre version of many later authors, some of whom show the city as a place of loneliness and corruption. In tone, the stories range from the grimness of Dorothy Livesay’s account of Depression misery, to the irony of Ethel Wilson’s narrative of an evening garden party, to the playfulness of George Bowering’s ellipticla story of student life. Other well-known atuhors include Pauline Johnson, Emily Carr, Malcolm Lowry, Audrey Thomas, Alice Munro, and Joy Kogawa--as well as some who have been undeservedly consigned to obscurity--M.A. Grainger, Bertrand Sinclair, Jean Burton, and William McConnell. The more prolific among the younger writers--Frances Duncan, Cynthia Flood, and Kevin Roberts--are in the process of achieving national recognition. The stories evoke a strong sense of place, of Vancouver’s essential relation to its natural setting--forest, mountains, and sea--and its existence as a modern urban centre. Individual episodes recall the great fire of 1886, turn-of-the-century loggers on Cordova Street, rum-running in the twenties, the internment of Japanese-Canadians after Pearl Harbor, the hippie era, and the modern sub-culture of beer parlours and drugs. Particular locales include downtown streets, the east end, the North Shore, U.B.C, Stanley Park, Kitsilano, and the Vancouver Aquarium. Stories of the city’s social and cultural life describe the process of growing up and growing old, family and marital matters, the Chinese community, and the legends and reality of Native Americans. Vancouver Short Stories indicates some of the ways that a particular locality has been transformed into art that, in turn, enriches our understanding of its reality and enhances our sense of identity.', 'Carole Gerson', '2024-01-11', 'http://books.google.com/books/content?id=8idOYl1-jgUC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api');

-- --------------------------------------------------------

--
-- Table structure for table `category_tb`
--

CREATE TABLE `category_tb` (
  `category_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tb`
--

INSERT INTO `category_tb` (`category_id`, `book_id`, `name`) VALUES
(210, 222, 'Computers'),
(211, 223, 'Computers'),
(212, 224, 'Electronic books'),
(213, 225, 'Computers'),
(214, 226, 'Electronic books'),
(215, 227, 'Computers'),
(216, 228, 'Computers'),
(217, 229, 'Computers'),
(218, 230, 'Computers'),
(219, 231, 'Computers'),
(220, 232, 'Fiction'),
(221, 233, 'Moving, Household'),
(222, 234, 'Travel'),
(223, 235, 'Vancouver (B.C.)'),
(224, 236, 'Architecture'),
(225, 237, 'Architecture'),
(226, 238, 'Travel'),
(227, 239, 'Travel'),
(228, 240, 'British Columbia'),
(229, 241, 'Literary Criticism');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pass` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_status_tb`
--
ALTER TABLE `book_status_tb`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `book_id_cons` (`book_id`),
  ADD KEY `user_id_cons_customer_id` (`user_id`);

--
-- Indexes for table `book_tb`
--
ALTER TABLE `book_tb`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `book_id_cons_category` (`book_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_status_tb`
--
ALTER TABLE `book_status_tb`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_tb`
--
ALTER TABLE `book_tb`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `category_tb`
--
ALTER TABLE `category_tb`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_status_tb`
--
ALTER TABLE `book_status_tb`
  ADD CONSTRAINT `book_id_cons` FOREIGN KEY (`book_id`) REFERENCES `book_tb` (`book_id`),
  ADD CONSTRAINT `user_id_cons_customer_id` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`);

--
-- Constraints for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD CONSTRAINT `book_id_cons_category` FOREIGN KEY (`book_id`) REFERENCES `book_tb` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
