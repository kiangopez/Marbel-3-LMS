-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 01:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marbel3lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `full_name`, `username`, `password`, `image_name`) VALUES
(12, 'Administrator', 'admin', '$2y$10$b5D8dyFD1oH1znAiM5cEG.mTupcp3ghYhSq2hMzijk7R.6Z5772Fm', 'User-Image-4774.png'),
(17, 'secondadmin', 'admin2', '$2y$10$n1c6RC8W5QorSgK8vgPnyuo0LyzimCIvgaaGuxJr4rMTFWvtMEimy', 'User-Image-5893.png'),
(18, 'admin3', 'admin3', '$2y$10$WFLRrrdGPlRbsX9BAjchcOeOmiqPlmTQczJR.clWCtteeyPlh0N/S', 'User-Image-9358.png'),
(19, 'Administrator 4', 'admin4', '$2y$10$7OSbFjOLsQkbbWKrpT6tG.7yEEJZ1NoiFZxUItyEUTQlwwGvbsmka', 'User-Image-7807.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ann_admin`
--

CREATE TABLE `ann_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `announcement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ann_admin`
--

INSERT INTO `ann_admin` (`id`, `announcement`) VALUES
(2, 'Announcement:\r\nAll admins to note their daily progress\r\nDouble check student details before enrolling.'),
(5, 'an important message'),
(9, 'Another announcement');

-- --------------------------------------------------------

--
-- Table structure for table `ann_student`
--

CREATE TABLE `ann_student` (
  `id` int(11) UNSIGNED NOT NULL,
  `announcement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ann_student`
--

INSERT INTO `ann_student` (`id`, `announcement`) VALUES
(1, 'STUDENT ANNOUNCEMENT'),
(2, 'WELCOME STUDENTS!'),
(3, 'Marbel 3 LMS is your new platform in studying.\r\n\r\nKindly check all your enrolled subjects in the dashboard.\r\n\r\nFor all questions and concerns, contact your teacher in the LMS chat.');

-- --------------------------------------------------------

--
-- Table structure for table `ann_teacher`
--

CREATE TABLE `ann_teacher` (
  `id` int(11) UNSIGNED NOT NULL,
  `announcement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ann_teacher`
--

INSERT INTO `ann_teacher` (`id`, `announcement`) VALUES
(1, 'TEACHER ANNOUNCEMENT!!!!'),
(2, 'Announcement:\r\nGood day Teachers!\r\nGuide all the students and attend to all their concerns.\r\nNew assignments will be posted on April 30, 2022.\r\nRemind to upload new lessons every week.');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `quiz_question_id` int(11) NOT NULL,
  `answer_text` varchar(100) NOT NULL,
  `choices` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories_tbl`
--

CREATE TABLE `categories_tbl` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_tbl`
--

INSERT INTO `categories_tbl` (`category_id`, `category_name`, `category_code`) VALUES
(1, 'Kinder', 'KD1'),
(2, 'Grade 1', 'GD1'),
(3, 'Grade 2', 'GD2'),
(4, 'Grade 3', 'GD3');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `end_event`) VALUES
(8, 'School Calendar Created', '2022-05-31 00:00:00', '2022-06-01 00:00:00'),
(10, 'almost finished the chat', '2022-06-02 00:00:00', '2022-06-03 00:00:00'),
(13, 'Finish the subject files and quizzes', '2022-06-04 23:30:00', '2022-06-11 23:30:00'),
(14, 'Website quality checking.', '2022-06-12 00:00:00', '2022-06-19 00:00:00'),
(15, 'another event', '2022-06-03 00:00:00', '2022-06-04 00:00:00'),
(16, '.....', '2022-06-08 00:00:00', '2022-06-09 00:00:00'),
(17, '.....', '2022-06-02 00:00:00', '2022-06-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `upload_date` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--


-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_name` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `message_status` varchar(100) NOT NULL,
  `read_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

-- --------------------------------------------------------

--
-- Table structure for table `message_sent`
--

CREATE TABLE `message_sent` (
  `message_sent_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_name` varchar(250) NOT NULL,
  `sender_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_sent`
--


-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `question_type_id` int(11) NOT NULL,
  `question_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`question_type_id`, `question_type`) VALUES
(1, 'Multiple Choice'),
(2, 'True or False');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quiz_title` varchar(100) NOT NULL,
  `quiz_description` varchar(255) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `time_limit` int(255) NOT NULL,
  `quarter` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--


-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `quiz_question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_question`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_student`
--

CREATE TABLE `quiz_student` (
  `quiz_student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_time` int(255) NOT NULL,
  `grade` int(11) NOT NULL,
  `items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_student`
--


-- --------------------------------------------------------

--
-- Table structure for table `students_tbl`
--

CREATE TABLE `students_tbl` (
  `student_id` int(11) NOT NULL,
  `USN` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_tbl`
--

INSERT INTO `students_tbl` (`student_id`, `USN`, `fname`, `lname`, `mname`, `email`, `category_id`, `password`, `image_name`) VALUES
(142, 123123, 'Kian', 'Gopez', 'Barrera', 'kian2k17@yahoo.com', 2, '$2y$10$YAuXYfZofDSObcP9e1vc7eCp/isDn5W38yPiYN6fUBxQn1TRPBcsy', 'User-Image-1587.png'),
(172, 12345351, 'Solomon', 'Crosby', 'Tallulah', 'cywyn@mailinator.com', 1, '$2y$10$OJo/nRxIRFcny0rvWmyhGOPJ1vGVpod8QkIPFVeEWqauhD9vqE9x.', ''),
(182, 144129, 'Stewart', 'Montoya', 'Lacota', 'tixajy@mailinator.com', 3, '$2y$10$PF8Z0vij8Ae91DGJTtZdyueufcqL2o5zF4Z3e3uHwYEBkH0veYeIC', ''),
(192, 65251, 'Isaiah', 'Wilkinson', 'Kelsey', 'qonanat@mailinator.com', 4, '$2y$10$T55ZmRx68LN8SHvJU31/5uDmSeg8ruXFo6pcZjivTNGEdqomZRa0e', ''),
(202, 1421512, 'Briar', 'Rojas', 'Kerry', 'nypumybak@mailinator.com', 4, '$2y$10$iAvoSMbxkJQRVnc7NQSB5O/eYowLjCNdXBfy/byuwbTuv7wiS7w0i', ''),
(212, 9812512, 'Karyn', 'Clark', 'Gray ', 'lumogiw@mailinator.com', 2, '$2y$10$poSeDD/Vo6Viy6loeD/zvOv0ezZdzTWutCt6E5F40o9CU3tlIh7Ge', ''),
(222, 211232, 'Rafael', 'Stone', 'Ramona ', 'gawoxu@mailinator.com', 3, '$2y$10$JVXuCicFUKa0lBtYB/bp7upOASuVWpdL2foYH9QU7yGIHYihhns5i', ''),
(232, 11232, 'Aaron', 'Alvarado', 'Scarlet', 'ruficirere@mailinator.com', 3, '$2y$10$MbtL4dhPPshVIhRvuDOGyuwFTAs./KEqOMT2ybuIR5MBNVMvL8iM.', ''),
(242, 60232, 'Salvador', 'Larson', 'Robin Pitts', 'kapawosis@mailinator.com', 1, '$2y$10$2GK7GIuOfwnjooVDHxzW9ubPz.ZgnkjvdCmdWo6HdX0ZgPXjdR0YG', ''),
(252, 54235, 'Maryam', 'Owens', 'Larissa', 'zowo@mailinator.com', 1, '$2y$10$ydMnyybBf1yRr27jDuihZ.OKluqopiN/WY61FDTlPPXvxxOQdSP7m', ''),
(262, 20215, 'Baxter', 'Adkins', 'Amelia', 'lynutiwo@mailinator.com', 2, '$2y$10$ue0l4JZoJowjIw6tq4gC8.q0gewuqwAGJYSYt020nJu5z8qqt5fyy', ''),
(272, 36865, 'Frances', 'Vasquez', 'Chiquita Bernard', 'kizax@mailinator.com', 1, '$2y$10$kLih/k3n7vPKvRm/SgjRKe45v33CHrv3vfDIAyDllArTsUyVHPkYS', ''),
(282, 5555334, 'Elvis', 'Gould', 'Zahir Owens', 'lexejen@mailinator.com', 4, '$2y$10$rx/giSDSJ5yPaatM2iQkn.GIx2Z5mwWHCtrC2cTgXSBxEQuiz.Foe', ''),
(292, 58561, 'Melissa', 'Murphy', 'Ira Mosley', 'sawo@mailinator.com', 3, '$2y$10$DlX4.zHxt7kyIK.CyWmyFuDNZbKypfUaQbBs9UCu43M8jlQLadQHC', ''),
(302, 921572, 'Jameson', 'Barrett', 'Ebony Santana', 'betufybi@mailinator.com', 7, '$2y$10$xnSPyAWyJP3NV43GSt8WD.jTyFUdwxmay8DMmWLe2ck7ue/wV71/q', ''),
(312, 80252516, 'Irma', 'Calderon', 'Adele Ballard', 'tybo@mailinator.com', 2, '$2y$10$gLLIf5NhJmABGwFqASPkxu6sTKkA32qJGjWJZIhzbxB9ifjtRU3Cm', ''),
(322, 31252151, 'Joelle', 'Wiley', 'Cassandra Colon', 'pyqawekyja@mailinator.com', 7, '$2y$10$hA1gJ2nlLvizZ1c35ysIMejoxWz6.tN8r4ahMjcjR8A1D4rE5TsK.', ''),
(332, 9673, 'Lila', 'Campos', 'Emi Lambert', 'fezysuguba@mailinator.com', 7, '$2y$10$C8AQQnM7arlUYOmfVOIXNuC1dVvI/O1BRx21Q7MoSCGmi.PuPIs.q', ''),
(333, 55162022, 'Zephr', 'Morris', 'Taylor Gilbert', 'hijo@mailinator.com', 4, '$2y$10$E6M8vdoPx0xBB/P1q7I.ru0Afbl9WzCDfZdhjymxyDNIpl3sI9XRK', ''),
(334, 89822022, 'Colby', 'Hatfield', 'Bo Gross', 'nasotely@mailinator.com', 1, '$2y$10$ZWiyS5Dsa/SEKMUTeBPsy.CuB27vXZYhB03KLj.E5hD/nzsyVH4/m', ''),
(335, 88782022, 'Halla', 'Boyle', 'Nissim Sexton', 'pyse@mailinator.com', 3, '$2y$10$3zX7ViK/P4P9/uv/l1irye31nyff9u0sp7ZMdEn5KND7lU0q//97C', ''),
(336, 73542022, 'Mhegs', 'Cerdena', 'Delos Santos', 'mhegscerdena@gmail.com', 3, '$2y$10$HleZJRe4E/gpL5b10/aFSeB3P8FeCoEZR.izWugpdxmbxGsApO4x6', ''),
(337, 60772022, 'Eric', 'Weber', 'Kristen Burnett', 'zuriwaqo@mailinator.com', 3, '$2y$10$VAyihupeBl9GHB9kHTVATeMXps3Yto6Q7WSTvFH/3wDb4n.TPot2a', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `student_subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`student_subject_id`, `student_id`, `subject_id`) VALUES
(3, 192, 11),
(4, 192, 5),
(5, 192, 15),
(6, 192, 11),
(7, 192, 5),
(8, 192, 15),
(9, 202, 7),
(10, 202, 12),
(11, 202, 16),
(16, 142, 8),
(17, 142, 11),
(18, 142, 5),
(20, 142, 4),
(21, 172, 4),
(22, 142, 10);

-- --------------------------------------------------------

--
-- Table structure for table `subjects_tbl`
--

CREATE TABLE `subjects_tbl` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(100) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects_tbl`
--

INSERT INTO `subjects_tbl` (`subject_id`, `subject_name`, `subject_code`, `category_id`, `image_name`, `description`) VALUES
(4, 'Literacy', 'K1-Literacy', 4, 'Subject-Banner-6775.png', 'Kinder Literacy Subject! Learn literacy with Marbel 3 Elementary School.'),
(5, 'Mathematics', 'G1-Math', 2, 'Subject-Banner-3845.png', 'Grade 1 Mathematics. You will learn addition subtraction multiplication and division.'),
(6, 'MAPEH', 'G2-MAPEH', 3, 'Subject-Banner-7069.jpg', 'Grade 2 MAPEH. Immerse in music, arts, physical education and health! '),
(7, 'Science', 'G3-Science', 4, 'Subject-Banner-9651.jpg', 'Grade 3 Science. Experiment, Learn, and Explore the wonders of Earth in this subject!'),
(8, 'Edukasyon sa Pagpapakatao', 'G1-EsP', 2, 'Subject-Banner-9618.png', 'Edukasyon sa Pagpapakatao! Maging mabuti sa kapwa upang sila ay maging mabuti rin saiyo.'),
(10, 'Numeracy', 'K1-Numeracy', 1, 'Subject-Banner-5381.png', 'Kinder 1 Numeracy'),
(11, 'English', 'G1-English', 2, 'Subject-Banner-2532.jpg', 'English Grade 1'),
(12, 'English', 'G3-English', 4, 'Subject-Banner-987.jpg', 'Grade 3 English'),
(13, 'Mothertongue', 'G2-MTBMLE', 3, 'Subject-Banner-4943.png', 'Grade 2 Mother tongue Multilingual Education'),
(14, 'Araling Panlipunan', 'G2-AP', 3, 'Subject-Banner-1099.png', 'Araling Panlipunan Grade 2'),
(15, 'Filipino', 'G1-Filipino', 2, 'Subject-Banner-9358.png', 'Filipino G1-Filipino'),
(16, 'Edukasyon sa Pagpapakatao', 'G3-EsP', 4, 'Subject-Banner-3510.png', 'Edukasyon sa Pagpapakatao Grade 3'),
(17, 'Mathematics', 'Math 41', 3, 'Subject-Banner-4662.pdf', 'asdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_tbl`
--

CREATE TABLE `teachers_tbl` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `URN` bigint(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_tbl`
--

INSERT INTO `teachers_tbl` (`teacher_id`, `fname`, `lname`, `mname`, `email`, `password`, `URN`, `image_name`) VALUES
(10, 'Shell', 'Abrahim', 'Delby', 'sheldyabrahim@gmail.com', '$2y$10$QP6RxN9/9HhcBwI6Ou2cxe1QWymNCE4oJPsAPjIMa7I0Trx2f3lw2', 0, ''),
(16, 'Dunk', 'Jonathan', 'It', 'dunkitjonathan@gmail.com', '$2y$10$wikc1VxQiThNOGu6BRMiYOQU41unjoqn5jijK6KNJLOTm5hWPJKGq', 10, 'User-Image-374.png'),
(17, 'Shad', 'Munoz', 'Beatrice Luna', 'caher@mailinator.com', '$2y$10$iZmfmMm8dOv885sH5tjvCuiGDmZ04pKdU14yUMdfWIaX.BQxp6MxW', 123123123, 'User-Image-9408.png'),
(18, 'Mark', 'Silent', 'Diego', 'simarktahimiklang@gmail.com', '$2y$10$ciCij91qJTLF1/zF3xv6QuYWIr08XIpDgu03IMZ2nm2X3ikdG7CkO', 2022, ''),
(19, 'Melissa', 'Villarreal', 'Lester Porter', 'mufis@mailinator.com', '$2y$10$8CFkkYlGGnEkLyeo5chctOsejNznKSZg8/ShlgMelWkd/y10oLjVC', 77, ''),
(20, 'Quynn', 'Mclaughlin', 'Ina Dennis', 'bodabafen@mailinator.com', '$2y$10$u3TaQNesc9CtZn/4/6vAE.EV70dzwA8GnJfmF1LQgYRA/HLv7uzLu', 4455, ''),
(21, 'Ray', 'Schwartz', 'Clarke Sutton', 'bedinex@mailinator.com', '$2y$10$Tu7YldMRO2EEqjfuTC6P9.v6xDGN.kBv.gBrimLhNQPSpgXatiXri', 125, ''),
(22, 'William', 'Nguyen', 'Ifeoma', 'waligynec@mailinator.com', '$2y$10$tXuDmeHySxGpNpDtzkB9.uXdCiXuRqNGRdO1QmXw7K5PGQY21FcoG', 9, ''),
(23, 'Melvin', 'Cannon', 'Gretchen Cummings', 'qugyjidalu@mailinator.com', '$2y$10$3NjvgxDJWTGYhoKYYSjf0.oWM1bjYQjsGKocAdZ.BCKxCayYlpbcq', 1255, ''),
(24, 'Alvin', 'Avila', 'Zia Maddox', 'cahuvosuh@mailinator.com', '$2y$10$oPA/qaSx2Aizv9TWdfy7gOPPIWsOppAHDirnqe4O3vw5sv3cnr4/K', 2156, ''),
(25, 'Orla', 'Meadows', 'Aaron Battle', 'losekonujo@mailinator.com', '$2y$10$khDMNjCvtWmqiu5z3kAmlugQRWS/qhXWeBHncJ/J24WmcJflxXJL6', 45555, ''),
(26, 'Elliott', 'Kirk', 'Hector Miller', 'jizomagaw@mailinator.com', '$2y$10$3EksuO7ybOClVqEoNXCSqu999q/DL5511zZ36Sto1Awz1CPhDG276', 9255, ''),
(27, 'Chadwick', 'Day', 'Aurelia Fuentes', 'wezunurece@mailinator.com', '$2y$10$XT1eebWyb42za5f6DAcq6eJbm8H2mTSvT2lRoAV4pd/qlVz5ufSu2', 685512, ''),
(28, 'Drew', 'Rodriquez', 'Venus Vinson', 'ramuwu@mailinator.com', '$2y$10$64PtyfcIAui4qm5vdRMr4OrCUKb8uuzezNVgl4O75rg1lHFiRsZkO', 2651254, ''),
(29, 'Seth', 'Smith', 'Quynn Peterson', 'tyli@mailinator.com', '$2y$10$bs7YqGXAuyTo5YS9Z.9u8e7WPMmp3DU1agMgl7ObhCiUdr7rn25sq', 125125, ''),
(30, 'Horsey', 'Amelia Avila', 'Galvin', 'Dejesus@gmsdf.com', '$2y$10$KDHARI.Od5JtvnzA4zqEI.8YDskElUHgCaxJXoFOz378ofYKLwOBG', 87232022, ''),
(31, 'Rebecca', 'Forbes', 'Ross Hale', 'rilotagac@mailinator.com', '$2y$10$jZTsYnZ0gFMFP4Z8gB0L5.G5VDpDQd433Mdlvi5XIU/d3D1UjRD5O', 12662022, '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_subject_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_subject_id`, `teacher_id`, `subject_id`) VALUES
(15, 10, 10),
(16, 10, 4),
(17, 10, 8),
(18, 19, 7),
(19, 19, 12),
(20, 19, 16),
(23, 18, 13),
(24, 18, 17),
(27, 16, 10),
(28, 16, 17),
(29, 16, 7),
(30, 16, 12),
(31, 16, 16),
(33, 22, 10),
(34, 22, 4),
(35, 16, 5),
(36, 16, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ann_admin`
--
ALTER TABLE `ann_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ann_student`
--
ALTER TABLE `ann_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ann_teacher`
--
ALTER TABLE `ann_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_sent`
--
ALTER TABLE `message_sent`
  ADD PRIMARY KEY (`message_sent_id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`question_type_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`quiz_question_id`);

--
-- Indexes for table `quiz_student`
--
ALTER TABLE `quiz_student`
  ADD PRIMARY KEY (`quiz_student_id`);

--
-- Indexes for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`student_subject_id`);

--
-- Indexes for table `subjects_tbl`
--
ALTER TABLE `subjects_tbl`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers_tbl`
--
ALTER TABLE `teachers_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ann_admin`
--
ALTER TABLE `ann_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ann_student`
--
ALTER TABLE `ann_student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ann_teacher`
--
ALTER TABLE `ann_teacher`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `message_sent`
--
ALTER TABLE `message_sent`
  MODIFY `message_sent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `question_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quiz_question`
--
ALTER TABLE `quiz_question`
  MODIFY `quiz_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `quiz_student`
--
ALTER TABLE `quiz_student`
  MODIFY `quiz_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `student_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subjects_tbl`
--
ALTER TABLE `subjects_tbl`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teachers_tbl`
--
ALTER TABLE `teachers_tbl`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `teacher_subject_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
