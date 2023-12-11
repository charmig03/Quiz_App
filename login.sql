-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 05:36 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `question_text` varchar(255) NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `sub_id`, `question_text`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`) VALUES
(18, 1, 'What is PHP?', 'PHP is an open-source programming language', 'PHP is used to develop dynamic and interactive websites', 'PHP is a server-side scripting language', 'All of the mentioned', 4),
(80, 1, 'what is js ?', 'language', 'nothing', 'type of c', 'All of the mentioned', 3),
(19, 1, 'What does PHP stand for?', 'PHP stands for Preprocessor Home Page', 'PHP stands for Pretext Hypertext Processor', 'PHP stands for Hypertext Preprocessor', 'PHP stands for Personal Hyper Processor', 3),
(21, 1, 'Which of the following is the correct way to add a comment in PHP code?', '#', '//', '/* */', 'All of the mentioned', 4),
(36, 2, 'Which of the following is not a difference between HTML and XHTML?', 'Charset in both html and xhtml is â€œtext/htmlâ€', 'Tags and attributes are case-insensitive in HTML but not in XHTML', 'Special characters must be escaped using character entities in XHTML unlike HTML', 'Charset in html is â€œtext/htmlâ€ where as in xhtml it is â€œapplication/xml+xhtmlâ€', 1),
(22, 1, 'Which of the following is the default file extension of PHP files?', '.php', '.ph', '.xml', '.html', 1),
(23, 1, 'How to define a function in PHP?', 'functionName(parameters) {function body}', 'function {function body}', 'function functionName(parameters) {function body}', 'data type functionName(parameters) {function body}', 3),
(81, 1, ' Which variable is used to collect form data sent with both the GET and POST methods?', '$_BOTH', '$REQUEST', '$_REQUEST', '$BOTH', 3),
(27, 1, 'Which of the following PHP functions can be used to get the current memory usage?', 'memory_get_usage()', 'memory_get_peak_usage()', 'get_peak_usage()', 'get_usage()', 1),
(28, 1, 'Which one of the following PHP function is used to determine a fileâ€™s last access time?', 'filetime()', 'fileatime()', 'fileltime()', 'filectime()', 2),
(31, 1, ' What does PDO stand for?', 'PHP Database Orientation', 'PHP Data Orientation', ' PHP Data Object', 'PHP Database Object', 3),
(33, 2, 'HTML stands for __________', 'HyperText Markup Language', 'HyperText Machine Language', 'HyperText Marking Language', 'HighText Marking Language', 1),
(52, 2, 'Which of the following is an HTML specification used to add more information to HTML tags', 'Modifydata', 'Minidata', 'Macrodata', 'Microdata', 4),
(38, 2, 'What is DOM in HTML?', 'Language dependent application programming', 'Hierarchy of objects in ASP.NET', 'Application programming interface', 'Convention for representing and interacting with objects in html documents', 4),
(55, 2, 'The correct sequence of HTML tags for starting a webpage is', 'Head, Title, HTML, body', 'HTML, Body, Title, Head', 'HTML, Head, Title, Body', 'HTML, Head, Title, Body', 3),
(42, 2, 'Which of the following is not the element associated with the HTML table layout?', 'alignment', 'color', 'size', 'spanning', 2),
(43, 2, 'Which element is used for or styling HTML5 layout?', 'CSS', 'jQuery', 'JavaScript', 'PHP', 1),
(45, 2, ' HTML is a subset of ___________', 'SGMT', 'SGML', 'SGME', 'XHTML', 2),
(53, 2, ' How many sizes of headers are available in HTML by default?', '3', '5', '4', '6', 4),
(54, 2, 'What are the types of lists available in HTML?', 'Ordered and Unordered List.', 'Unordered and Unordered List.', 'Ordered ', 'Unordered List.', 1),
(51, 2, 'Which attribute specifies a unique alphanumeric identifier to be associated with an element?', 'type', 'article', 'id', 'class', 3),
(56, 2, 'What are the types of unordered or bulleted list in HTML?', 'disc, square, triangle', 'polygon, triangle, circle', 'disc, circle, square', 'All of the above', 3),
(82, 5, 'swds', 'eggg', 'nothing', 'type of c', '$BOTH', 3),
(87, 5, 'what is js ?', 'language', 'nothing', 'type of c', 'type of c++', 3),
(88, 2, 'what is html?', 'language', 'nothing', 'type of c', 'All of the mentioned', 3),
(86, 5, 'what is js ?', 'language', 'nothing', 'type of c', 'type of c++', 2),
(61, 3, 'Which keyword is used for function in Python language?', 'Function', 'def', 'Fun', 'Define', 2),
(62, 3, 'Python supports the creation of anonymous functions at runtime, using a construct called __________', 'pi', 'anonymous', 'lambda', 'none of the mentioned', 3),
(63, 3, 'What is the order of precedence in python?', 'Exponential, Parentheses, Multiplication, Division, Addition, Subtraction', 'Exponential, Parentheses, Division, Multiplication, Addition, Subtraction', 'Parentheses, Exponential, Multiplication, Division, Subtraction, Addition', 'Parentheses, Exponential, Multiplication, Division, Addition, Subtraction', 4),
(64, 3, 'What does pip stand for python?', 'Pip Installs Python', 'Pip Installs Packages', 'Preferred Installer Program', ' All of the mentioned', 3),
(65, 3, 'Which of the following is not a core data type in Python programming?', 'Tuples', 'Lists', 'Class', 'Dictionary', 3),
(66, 3, 'Which of these is the definition for packages in Python?', ' set of main modules', 'A folder of python modules', 'A number of files containing Python definitions and statements', 'A set of programs making use of Python modules', 2),
(67, 3, 'Which one of the following is not a keyword in Python language?', 'pass', 'eval', 'assert', 'nonlocal', 2),
(68, 3, 'Which module in the python standard library parses options received from the command line?', 'getarg', 'getopt', 'main', 'os', 2),
(69, 3, 'What is the maximum possible length of an identifier in Python?', '79 characters', '31 characters', '63 characters', 'none of the mentioned', 4),
(70, 3, 'What are the two main types of functions in Python?', 'System function', 'Custom function', 'Built-in function & User defined function', 'User function', 3),
(71, 3, 'The process of pickling in Python includes ____________', 'conversion of a Python object hierarchy into byte stream', 'conversion of a datatable into a list', 'conversion of a byte stream into Python object hierarchy', 'conversion of a list into a datatable', 1),
(72, 4, 'Which statement is true about Java?', 'Java is a sequence-dependent programming language', 'Java is a code dependent programming language', 'Java is a platform-dependent programming language', 'Java is a platform-independent programming language', 4),
(73, 4, 'Which component is used to compile, debug and execute the java programs?', 'JRE', 'JIT', 'JDK', 'JVM', 3),
(74, 4, 'Which one of the following is not a Java feature?', 'Object-oriented', 'Use of pointers', 'Portable', 'Dynamic and Extensible', 2),
(75, 4, 'Which of these cannot be used for a variable name in Java?', 'identifier & keyword', 'identifier', 'keyword', 'none of the mentioned', 3),
(76, 4, 'what is js ?', 'language', 'nothing', '123', 'none of the mentioned', 3),
(77, 5, 'what is js ?', 'language', 'nothing', 'type of c', 'All of the mentioned', 1),
(78, 5, 'what is js ?', 'language', 'bjndvb', '123', '.html', 2),
(79, 4, 'what is js ?', 'language', 'nothing', 'type of c', '.html', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `img_icon` char(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `subject_name`, `img_icon`, `description`) VALUES
(1, 'php', 'php.png', 'PHP '),
(2, 'HTML', 'html.png', 'HTML'),
(3, 'Python', 'python.png', 'Python'),
(4, 'JAVA', 'java.png', 'Java'),
(5, 'CSS', 'css.png', 'CSS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'abc', 'ab', 1),
(5, 'charmi', '12345', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
