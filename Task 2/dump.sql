-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: csym019_assignment
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Course`
--

DROP TABLE IF EXISTS `Course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Course` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `iconPath` varchar(255) NOT NULL,
  `overview` text NOT NULL,
  `highlights` text NOT NULL,
  `course_details` text NOT NULL,
  `entry_requirements` text NOT NULL,
  `fees_uk_full_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fees_uk_part_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fees_uk_integrated_foundation_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fee_international_full` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fee_international_part` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fees_international_integrated_foundation_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fees_optional_work_placement_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `faq` text NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Course`
--

LOCK TABLES `Course` WRITE;
/*!40000 ALTER TABLE `Course` DISABLE KEYS */;
INSERT INTO `Course` VALUES (1,'Accounting and Finance','BSc (Hons)','1.png','The course will begin by considering the practical techniques involved in accounting and finance and then continue to build on skills to critically analyse the theory behind these techniques. It will also develop the interdisciplinary nature of business and integrate accounting with broader subject areas such as economics, law and human resources. There is also the option to complete a year’s accounting and finance work placement to prepare you for your future career.','The BSc Accounting and Finance degree at the University of Northampton provides a specialised pathway, a proven student support system and has progression courses available. It also offers significant exemptions from the main professional body exams.','The Accounting and Finance BSc will begin by considering the practical techniques involved in accounting and finance and then continue to develop skills to critically analyse the theory behind these techniques. It will also develop the interdisciplinary nature of business and integrate accounting with broader subject areas such as economics, law and human resources.','Standard university Accounting and Finance entry requirements,\r\nMathematics GCSE at grade C/4 or above or equivalent,\r\nAAT Level 3,\r\nF1, F2 & F3, (ACCA Diploma),\r\nIFA, AIA or CAT,\r\nIELTS 6.0 (or equivalent) with a minimum of 5.5 in all bands.','£9,250','1,550','NULL','£14,750','NULL','NULL','£1,200','The Student Experience Support Team are a team of previous graduates of the University of Northampton, they are here to support all Faculty of Business and Law students by offering a friendly listening ear and ensuring students are aware of the numerous support systems that the University has to offer. The team provide confidential 1-1 meetings in person and online where they will signpost the students to the relevant support teams to ensure they are aware of the support available for them throughout their studies. You can follow the Student Experience Support Team to see the services they offer.'),(2,'Advanced Design and Manufacturing','MSc','9.png','Our Advanced Design and Manufacturing MSc addresses the complete life cycle of a product or process, from conception through to design and manufacture to disposal. This highly applied programme develops students’ knowledge and understanding of the scientific principles underpinning engineering in the field of design and manufacturing, and of the accompanying legal, ethical and professional considerations. There is a strong focus on integrating current research and developments into learning and teaching.','The course offers the opportunity to examine emerging concepts such as Digital Manufacturing and industry 4.0. Course accredited by IMechE (Institution of Mechanical Engineers).  Application of Artificial Intelligence (AI) in real engineering problem.  Advanced product design and 3D printing mini-project. Develop a wider perspective to technology management.  Optional one-year placement for September intake students. Participative and interactive activities designed to consolidate and develop your understanding.','This Advanced Design and Manufacturing MSc programme has been developed to meet the needs of companies and industry in the UK and overseas. It is specifically designed to increase the employability of its learners in a design and manufacturing context by identifying new service, strategy and product opportunities, and conducting projects in collaboration with industrial partners. This manufacturing design programme covers areas such as digital manufacturing and industry 4.0, 3D printing and artificial intelligence.','UK institution or equivalent honours degree,\r\nknowledge of Engineering,\r\nIELTS 6.5 (or equivalent).','£8,010','£4,450','NULL','£16,500','NULL','NULL','£1,000','The assessment methods used within the design and manufacturing masters programme varies from a module to another. The main assessment methods used within the programme are Assignment (Report, Critical reflection/Journal, etc.), Essay, Presentation (Oral or Poster). However, some modules may expect to take tests, exams or hands-on activity. Students on the MSc programme will have to submit a dissertation as part of their Business Research Project Module.'),(3,'Advertising & Digital Marketing','BA (Hons)','2.png','This is an exciting time to enter the marketing communications industry as advertisers develop campaigns for an increasingly complex and interesting media landscape. Throughout this Advertising and Digital Marketing Degree, you will have the opportunity to work on a wide range of digital platforms and traditional media as you plan and create real campaigns. The degree culminates in a pitch to clients of a top global agency, providing practical preparation for work in advertising and digital marketing roles.','100% overall student satisfaction, NSS 2020, Numerous opportunities for work experience,Active student community with opportunities for collaboration across each year and a student-run Advertising Society in Northampton Students’ Union, Involvement with industry professionals – from top ad agencies, digital media companies and the Digital Northampton network','The advertising industry has been transformed by the digital and social media revolution. From start-ups to big businesses, from social enterprises to charities and the public sector, this discipline offers careers in a wide range of industry sectors. Experiences are at the heart of our advertising degree. As well as regular guest speakers and industry visits, we work on real projects with real marketing budgets. We operate as a marketing department from the first year. Typically, you will be set a brief and then develop and pitch your concept. You will work within brand guidelines, often appointing suppliers, like photographers or design agencies, to deliver your project.','BCC at A Level,\r\nDMM at BTEC,\r\nIELTS 6.0 (or equivalent) with a minimum of 5.5 in all bands.','£9,250','£1,540','£9,250','£14,750','NULL','£14,750','£1,100','Throughout our Digital Marketing and Advertising degree, you can expect taught study to be a combination of lectures, seminars and workshops. This is usually for 12 hours per week. We recommend that you spend 24 hours per week in self-directed study time.'),(4,'Architectural Technology','BSc (Hons)','3.png','The Architectural Technology degree at UON brings together project management, design and technical skills. During our Architectural Technology course, you’ll become prepared to deliver projects all the way from concept stage. You’ll learn and increase your knowledge of the industry and legislation, experience realistic projects and develop your creative skills.','Our Architectural Technology BSc (Hons) course is accredited by the Chartered Institute of Architectural Technologists (CIAT). Course lecturers run their own architectural practices giving up-to-the-moment teaching and professional guidance, including Chartered Royal Institute of British Architects (RIBA). Students studying for an Architectural Technology degree benefit from our strong links with architectural practices. Opportunities for placements. Access to a design studio and computer suite studio with current computer aided design (CAD) technology. Enjoy exhibitions, events and visits during your course.','You’ll have the chance to meet and work with local and national industry experts through project briefings, reviews, tutorials and presentations, learning the theory and practical applications of skills and creating a professional network with potential recruiters. Plus, you’ll visit construction sites across the UK and internationally, to see projects at various stages. There are opportunities to work on real-life projects, participate in national competitions and exhibitions, and be recognised in our annual degree show.','BCC at A Level,\r\nDMM at BTEC,\r\nIELTS 6.0 (or equivalent) with a minimum of 5.5 in all bands.','£9,250','£1,540','£9,250','£14,750','NULL','£14,750','NULL','With an Architectural Technology degree, you can pursue a role as a chartered architectural technologist (MCIAT), with employment opportunities available from local authorities, housing corporations and property developers, building and construction firms, architecture practices, and academic and research institutions, amongst others.'),(41,'xcjmcjn','mnvjnmv','about-us.png','n bnvg','vjjmnf','fjnjmfv','vfmjvgmvg','44',NULL,NULL,NULL,NULL,NULL,NULL,'fmmjgfmjgv');
/*!40000 ALTER TABLE `Course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Modules`
--

DROP TABLE IF EXISTS `Modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL,
  `module_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `credits` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `Modules_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Modules`
--

LOCK TABLES `Modules` WRITE;
/*!40000 ALTER TABLE `Modules` DISABLE KEYS */;
INSERT INTO `Modules` VALUES (1,1,'Financial Accounting',20),(2,1,'Cost and Management Accounting',20),(3,1,'The Accountant in Business',20),(4,1,'Financial Skills and Numeracy',20),(5,1,'The Economic Environment',20),(6,1,'Business and Company Law',20),(7,1,'Financial Management',20),(8,1,'Financial Reporting',20),(9,1,'Management Accounting',20),(10,1,'Accounting Software and Models',20),(11,1,'Taxation Theory and Practice',20),(12,1,'Digital Business and Finance',20),(13,1,'Advanced Accounting Theory and Practice',20),(14,1,'Taxation',20),(15,1,'Audit and Investigations',20),(16,1,'Corporate Finance',20),(17,1,'Management Accounting - Decision Making',20),(18,1,'Strategic Financial Management',20),(19,1,'Accounting and Finance Dissertation',40),(20,1,'Accounting Project',20),(21,1,'Project Management: Managerial Perspectives',20),(22,2,'Mathematical Modelling ',20),(23,2,'Computer-Aided Analysis and Visualization of Mechanical Systems',20),(24,2,'Individual Engineering Project',60),(25,2,'Professional Practice for Technologists',20),(26,2,'Product Design',20),(27,2,'Digital Manufacturing',20),(28,2,'Sustainable Manufacture',20),(29,3,'Foundations of Marketing ',20),(30,3,'Introduction to Marketing Communications ',20),(31,3,'Foundations of Advertising Media',20),(32,3,'Digital Marketing Essentials',20),(33,3,'Understanding Consumers',20),(34,3,'Professional Skills for Marketing Practice',20),(35,3,'Learning Through Work (WBL)',20),(36,3,'Brand Management',20),(37,3,'E-Marketing',20),(38,3,'Integrated Marketing Communications',20),(39,3,'Public Relations Management and Practice ',20),(40,3,'Professional Practice for the Creative Industries',20),(41,3,'Managing the Communications Process',20),(42,3,'Marketing Research and Insight',20),(43,3,'Customer Relationship Management',20),(44,3,'Advertising Consultancy Project',40),(45,3,'Issues in Advertising Practice',20),(46,3,'Content Creation for Marketing',20),(47,3,'Digital Entrepreneur',20),(48,3,'Consumerism and Sustainability',20),(49,3,'Marketing Dissertation ',40),(50,3,'Research Project',20),(51,4,'Visual and Technical Communication',40),(52,4,'The Architectural Technologist',20),(53,4,'Principles of Technical Design in Architecture',40),(54,4,'Architectural Design',20),(55,4,'Building Information Modelling',20),(56,4,'Practice, Regulations and Conventions in Architecture',20),(57,4,'Design Specification and Production Information',40),(58,4,'Technical Architectural Design 1',20),(59,4,'Technical Architectural Design 2',20),(60,4,'Modelling, Simulation and Visualisation',20),(62,4,'Project Management in Architecture 1',20),(64,4,'Project Management in Architecture 2',20),(65,4,'Research and Project Design for Architectural TechnologistsResearch and Project Design for Architectural Technologists',20),(66,4,'Final Major Project',40),(174,41,'vmkmv',44);
/*!40000 ALTER TABLE `Modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('admin','admin');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `icons`
--

DROP TABLE IF EXISTS `icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `icons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filePath` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icons`
--

LOCK TABLES `icons` WRITE;
/*!40000 ALTER TABLE `icons` DISABLE KEYS */;
/*!40000 ALTER TABLE `icons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-31 13:30:46
