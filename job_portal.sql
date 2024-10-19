-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2024 at 08:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dầu khí', 0, '2024-10-06 23:52:50', '2024-10-05 03:17:37'),
(2, 'Công nghệ thông tin', 1, '2024-08-21 23:52:50', '2024-08-21 23:52:50'),
(4, 'Social Media', 0, '2024-08-21 23:52:50', '2024-08-21 23:52:50'),
(5, 'Construction & Engineering', 1, '2024-08-21 23:52:50', '2024-10-05 03:19:38'),
(20, 'test 122', 1, '2024-10-04 01:54:13', '2024-10-05 07:40:40'),
(21, 'demo 1', 1, '2024-10-08 06:50:13', '2024-10-08 07:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `career_id` bigint UNSIGNED NOT NULL,
  `job_type_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `vacancy` int NOT NULL,
  `salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `benefits` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `responsibility` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `qualifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `isFeatured` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `career_id`, `job_type_id`, `user_id`, `vacancy`, `salary`, `location`, `description`, `benefits`, `responsibility`, `qualifications`, `keywords`, `experience`, `company_name`, `company_location`, `company_website`, `status`, `isFeatured`, `created_at`, `updated_at`) VALUES
(103, 'Judy Bechtelar', 5, 1, 2, 5, '$5036', 'Clintonfort', '11Aut inventore quia suscipit et deserunt rerum quia. Est et voluptas cumque aut expedita est in. Quos repudiandae quia animi ipsa labore qui a. Eaque non nihil quo repellendus explicabo.', 'Natus facilis maiores rem expedita. Consequatur inventore quis iure. Autem in numquam sed quam et quis. Ea ipsa error quasi expedita modi qui ipsa. Adipisci necessitatibus placeat non veritatis.', 'Cum et veritatis esse provident. Deleniti qui ab saepe pariatur voluptatem. Autem quasi deleniti consectetur dolores sed sed est. Excepturi qui soluta repellendus ad saepe vitae similique.', 'Magni dolorem enim maiores et. Ea sequi qui dolore assumenda. Autem dolores rerum corporis culpa ut soluta et.', NULL, '1', 'Blaze Collier', 'South Bernitaburgh', NULL, 1, 1, '2024-10-07 19:03:43', '2024-10-19 08:03:27'),
(105, 'Ernestine Swaniawski', 1, 5, 3, 1, '$7684', 'West Nickolasmouth', 'Voluptatum expedita id ducimus dignissimos et laboriosam. Dicta vel veniam dolorum quia cumque ratione. Et quasi harum eum accusantium. Perspiciatis sint aut aliquam praesentium sequi exercitationem.', 'Odio sapiente ratione voluptate quia consequatur et. Fugiat autem voluptas incidunt possimus saepe dolores. Qui esse quos a quia modi blanditiis aut. Quo cumque et inventore rem reprehenderit illo.', 'Quis est et repudiandae error veniam. Ipsa dolorem corporis recusandae commodi ut. Eligendi ea rerum numquam suscipit qui dolor. Earum et earum molestiae quam accusantium.', 'Fugit adipisci illo voluptatibus et. Perferendis sed occaecati rem est voluptatem animi ut. Cupiditate sint hic et et ut et dolor quae.', 'java', '6', 'Garett Legros', 'Runolfssonton', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(106, 'Baylee Hauck', 1, 5, 3, 5, '$9349', 'Lake Rosella', 'Sint id tempora enim esse. Officiis corrupti officia et rerum error quidem iure non.', 'Enim aut enim rerum distinctio consequuntur. Fuga est ad quia unde eius sed.', 'Natus aspernatur earum sunt totam. Deleniti velit voluptatum ducimus illo placeat. Temporibus tempora et quisquam nostrum rerum. Doloribus voluptatem velit necessitatibus recusandae modi.', 'Ea est aperiam et voluptatibus quia illo. Voluptas fugit quos dolores natus impedit inventore et. Blanditiis voluptatem et voluptatibus reiciendis. Omnis culpa esse deserunt quis et pariatur.', 'laravel', '5', 'Ms. Opal Larkin', 'Tillmanshire', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(108, 'Prof. Rosemary Gleason', 5, 2, 2, 1, '$5111', 'Ignatiusfurt', 'Optio omnis qui eos voluptatem aut. Eaque magnam est voluptatem est sed est quod fugiat. Laborum omnis necessitatibus ipsa veritatis voluptate cumque.', 'Et dolorem et error ad autem. A est quis quam iste quia et quisquam aliquid. Non corporis quo quas blanditiis ipsam enim sed sit.', 'Atque explicabo debitis vel. Molestiae quis dolore vel assumenda corrupti ab libero nulla. Similique recusandae rerum quis eum dolores qui non. Dignissimos perferendis accusamus quas corrupti iste.', 'Voluptatum quisquam rerum et qui ea. Eos qui quisquam eos. Dignissimos consequatur doloribus asperiores voluptatum veritatis dicta aut. Eius et sit omnis nam accusantium doloremque quo.', NULL, '1', 'Mazie Lebsack Jr.', 'East Gaetano', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(109, 'Julianne Murray', 5, 2, 3, 5, '$8962', 'Madilynhaven', 'Voluptas eveniet ut magnam est. Aspernatur dolorem vero mollitia aut. Cumque dolorum natus dolorem autem repellat quae.', 'Qui nihil fugiat ipsum corrupti. Aut sed quam ipsa velit voluptatem eveniet minus. Et qui eum officia suscipit quod. Dicta explicabo neque ducimus minima.', 'Sint quam consequatur et eum. Ut eveniet error suscipit tempora provident sit. Fugit reiciendis totam et commodi voluptatem recusandae eos saepe.', 'Quod architecto rem consectetur sit magni. Quia id quos eos iste deserunt laborum. Dolor est aliquam maxime et vel est dolores distinctio. Itaque repellat tempora voluptas soluta eum quod sunt.', NULL, '5', 'Mrs. Margaret Renner', 'Binstown', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(110, 'Prof. Torrance Douglas II', 5, 4, 1, 4, '$6658', 'Johnstonview', 'Nihil pariatur labore delectus quasi consequatur hic. Reiciendis qui vel itaque enim qui soluta. Dolores ut consectetur dicta impedit qui. A quidem magni at.', 'Facilis fugiat et natus repellat aut quod. Tempora eaque modi vel ducimus voluptas. Sunt facilis aut voluptas labore est vel et. Magni odit molestias nobis.', 'Qui autem autem quia aut facilis occaecati. Optio labore debitis possimus non. Illo eum tempora quis praesentium repudiandae.', 'Praesentium eaque perspiciatis rerum cupiditate velit quisquam. Quia recusandae minima non commodi. Placeat id fuga quis nobis molestiae et perspiciatis.', NULL, '4', 'Demario Runolfsson', 'Davistown', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(111, 'Miss Alyson Senger', 1, 4, 3, 4, '$7016', 'Lake Reuben', 'Culpa eius similique itaque quas debitis beatae officiis. Assumenda fuga et doloribus inventore dicta quae consectetur. Sit quidem atque dolores voluptates earum.', 'Ut voluptate et nam ducimus. Quod vitae aut molestiae sunt repudiandae id. Est temporibus et autem natus.', 'Reiciendis voluptatem ipsam et vitae facilis sint voluptates. Dignissimos explicabo ut fugiat ut enim officiis. Enim doloribus quam earum qui quam.', 'Nostrum quis autem omnis accusantium doloribus commodi. Ea ab eos unde omnis consequatur est provident. Nihil et repellendus et dignissimos voluptatum accusantium et.', NULL, '3', 'Mrs. Tabitha Bode Jr.', 'New Eastermouth', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(112, 'Jewel Ledner', 5, 5, 1, 5, '$2283', 'Tannerstad', 'Vel et doloremque et facere quo aut officia. Omnis ipsum magnam neque vero sit enim. At ad eligendi ut voluptas quos. In qui omnis dolorum odio dolor et veniam cumque.', 'Libero aut laudantium quis id. Sit dolore impedit ut illum. Dolorem vero velit ea odit eaque molestiae. Similique excepturi repellendus commodi ipsa. Magni ut esse ex omnis error.', 'Velit libero aut ipsa architecto. Non sit quam sit repellat voluptatem. Consequuntur et perspiciatis laborum.', 'Officia beatae et consequatur qui quis optio nisi. Vitae nemo voluptates iusto voluptatem adipisci numquam. Nostrum et quo quasi minus.', NULL, '5', 'Deonte Romaguera', 'West Kylabury', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(114, 'Zena Bauch', 2, 1, 1, 5, '$6938', 'Dooleyberg', 'Accusantium earum vitae ad magni quis cumque. Similique est deleniti asperiores et autem nulla. Aperiam asperiores occaecati distinctio rerum ipsam dicta dolore. Voluptatibus eos nulla adipisci enim.', 'Molestiae excepturi voluptatem aut autem inventore vel porro et. Praesentium autem aperiam eum praesentium ipsam illum nesciunt. Et voluptatibus deserunt sequi perspiciatis.', 'Deserunt nisi aut et doloremque eos qui. Dicta ut et et eum architecto corporis consequatur. Error minus in vitae est assumenda harum et et.', 'Suscipit laborum quod unde non omnis voluptate molestias. Maxime facere a voluptatem tenetur et quia excepturi. Ipsum sed omnis fuga dolorum iste incidunt qui. Fugit qui autem quos.', NULL, '3', 'Freeda Effertz', 'East Madieland', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(115, 'Lavon Jakubowski I', 2, 5, 3, 3, '$9567', 'Shayneton', 'Ut ipsam mollitia facilis maiores quam quaerat. Et et officia similique et. Odit fugiat accusantium quo dolore quia voluptas voluptatum.', 'Consequatur ab voluptate in doloremque eveniet nihil aliquam. Rem itaque in rerum et. Quaerat quo assumenda facere molestiae quae distinctio accusamus.', 'Nostrum sequi numquam voluptas harum laborum velit. Id doloribus unde deserunt ullam exercitationem rerum ea. Repudiandae doloribus quia magnam eveniet sed.', 'Sed asperiores officiis id ipsa. Explicabo autem dicta perspiciatis vitae et ab autem. Delectus id et debitis ullam. Sit quo error omnis iure quisquam maxime rem. Aut provident ut natus est ea.', NULL, '9', 'Tracy Nolan', 'Everettetown', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(116, 'Lance Schuppe', 4, 2, 1, 4, '$1501', 'South Ludiefort', 'Itaque consectetur optio maxime. Sunt libero quo laborum quis sit est. Animi sapiente officiis occaecati aut est reiciendis. Aspernatur reiciendis dolor praesentium ratione aut et.', 'Dolorem architecto eum itaque aperiam aspernatur. Neque voluptatem id commodi vero autem aut. Eveniet provident in quaerat ipsam dolorem assumenda. Officiis dignissimos aut sed ullam.', 'Autem natus fuga dolorem sint. Dolorem natus sunt ex fuga voluptatem rerum dolorum. Quidem veritatis dolores maiores qui ipsam eos.', 'Non non laborum ipsum iure beatae soluta omnis ut. Dicta non est voluptas dolores sed. Tempora dicta est est voluptatum modi ut.', NULL, '8', 'Vickie Lynch', 'Morarstad', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(118, 'Dr. Lon Bayer', 1, 2, 1, 3, '$6971', 'Port Aditya', 'Nemo maiores voluptatem labore mollitia consectetur. Voluptates necessitatibus id veritatis atque. Aliquam quaerat architecto assumenda.', 'Voluptate autem autem expedita quia veritatis. Explicabo rerum ipsum eligendi dicta neque veniam. Qui libero animi dolorem necessitatibus quidem consequatur reiciendis.', 'Illum earum sit placeat consectetur autem sequi magni quia. Alias dicta aliquid sed tenetur itaque occaecati. Aut reprehenderit cum deserunt voluptatem.', 'Sequi aspernatur est porro sapiente. Natus maxime aut eos. Voluptatibus qui consequatur reprehenderit asperiores quae perferendis. Quibusdam expedita quis earum aut harum.', NULL, '10', 'Isidro Labadie PhD', 'Katelynborough', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(119, 'Arch Schumm', 4, 1, 1, 1, '$7424', 'Dickinsonberg', 'In nobis doloremque nobis voluptatibus est repudiandae incidunt saepe. Enim non id voluptas in voluptatem architecto quaerat. Ducimus itaque dolores consequatur at corrupti deserunt.', 'Consequatur minima aliquam corporis recusandae. Ea tenetur qui necessitatibus impedit molestias. Officia est a dolorem magnam.', 'Qui voluptatum iure fugit corporis voluptatum quia. Dolorem ad molestias aut reiciendis officiis est aliquid aut. Nulla non qui consequatur magnam voluptates amet.', 'Animi occaecati eaque ut voluptatem voluptatem. Officia dolor exercitationem optio vero velit. Qui quae inventore non exercitationem possimus ea rerum.', NULL, '9', 'Alicia Haley I', 'Port Artfurt', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(120, 'Jonas Bernier', 5, 5, 3, 2, '$7046', 'Levishire', 'Sit magnam consectetur debitis. Minus ut eaque sunt at natus quia non. Voluptate ad tempore ullam dignissimos iure est. Sit autem quae rerum quia nam impedit voluptate.', 'Facere sit asperiores perspiciatis earum voluptatem. Ad suscipit placeat ut cum quae magnam. Inventore alias fuga voluptas ipsam eius id rem.', 'Ut asperiores vel nulla enim ex. Consequuntur vel laboriosam nulla fugiat consectetur. Autem non ad at soluta aspernatur architecto id quo. Qui voluptas totam beatae exercitationem quos dicta omnis.', 'Non totam voluptatem labore quo sed nesciunt officia. Voluptatibus dolor eaque repellendus sunt voluptas voluptatum praesentium.', NULL, '7', 'Albina Kris', 'Lake Darlene', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(121, 'Osborne Morar', 2, 5, 2, 2, '$3043', 'North Brice', 'Adipisci laborum libero iste ut. Harum magni aperiam commodi sequi.', 'Laboriosam ut est est. Iure eveniet ipsum consectetur atque iste ut. Nihil repudiandae ut totam perspiciatis provident aut qui. Rem sit et rerum veniam sint.', 'Eos porro aut soluta corporis. Rerum repellat ea eligendi consequatur fugit. Commodi aut ipsa odit qui suscipit ab qui. Placeat temporibus voluptates sint nulla. Asperiores numquam distinctio in.', 'Aut dicta dolorem debitis. Enim sit recusandae ut dicta eligendi nobis. Nostrum quod architecto non sit rerum nam quis. Incidunt est expedita minima dolor.', NULL, '3', 'Clyde Weissnat', 'Hodkiewiczmouth', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(122, 'Kobe Leffler', 2, 5, 3, 1, '$7851', 'Grahamville', 'Animi cupiditate ipsam laudantium quas omnis. Rerum sunt explicabo vel quo. Architecto a quasi assumenda consequatur.', 'Et doloremque nihil expedita aut minus dolorum. Beatae voluptatibus quaerat accusantium quidem qui molestiae. Non rerum et praesentium eligendi dolores doloremque.', 'Voluptatum non similique et facere ut. Optio laudantium quia eum amet porro ut. Culpa sapiente voluptatem in doloribus nobis facilis qui. Placeat non facilis sed dolor eum.', 'Tempora possimus ea adipisci et fugiat. Velit amet eum maxime neque eos commodi culpa maiores. Ad sequi blanditiis veniam ut non nesciunt.', NULL, '8', 'Dr. Dax Konopelski V', 'McKenzieberg', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(123, 'Lempi Considine Sr.', 1, 2, 1, 3, '$4044', 'Astridfurt', 'Totam quisquam molestias ipsum ipsum molestias cupiditate. Excepturi quisquam quas ab sed itaque. Voluptates laudantium vel aut soluta omnis esse. Itaque corporis maxime enim consequatur repudiandae.', 'Et cumque a debitis enim. Voluptatem sit ut et sunt ut. Maiores voluptatem voluptatem eveniet molestias. Voluptatem dolores ab commodi deserunt doloremque.', 'Doloremque non optio voluptatem culpa vel aut libero. Numquam et corporis voluptatem ab non nihil. Exercitationem accusamus veniam neque voluptatibus possimus excepturi.', 'Officiis voluptatibus accusantium sit commodi magni quaerat et. Et vero quae et qui rerum consequatur.', NULL, '3', 'Mr. Amparo Berge', 'Ortizchester', NULL, 1, 0, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(124, 'Mr. Nigel Morissette Sr.', 4, 4, 1, 2, '$9113', 'North Larissa', 'Id vero expedita repellendus eos quod. Voluptatem nihil hic sit nam. Ab laborum ea magni quidem at quia.', 'Sed consequuntur est possimus eius commodi. Sint tenetur porro et cumque est sapiente ut quis. Tempora nihil voluptatibus corrupti nam amet molestiae. Rem illum pariatur fuga asperiores.', 'Corporis ab eum neque architecto ab. Tempore iste perferendis et.', 'Optio autem porro cum tempora eum. Quas et tempora sequi sit et. Perferendis ex asperiores qui nobis.', NULL, '3', 'Mr. Tyshawn Anderson', 'Cummeratachester', NULL, 1, 1, '2024-08-22 19:03:43', '2024-08-22 19:03:43'),
(125, 'Josianne Littel', 1, 1, 1, 2, '$6280', 'Kundefurt', 'Repudiandae architecto molestiae omnis incidunt magni ipsam. Et minus sunt iusto eum repellendus quas qui. Doloremque aut quas quis vel optio soluta explicabo.', 'Voluptatem officiis consequatur est nam quia nulla numquam iusto. Quis soluta aperiam aut. Odio sed sed nisi nostrum earum. Ut optio a dolore aut.', 'Non atque corporis ex atque. Itaque qui ipsam neque aut dolor voluptatem consequuntur. Dolorum amet unde cumque aliquam. Ut non id excepturi fuga accusantium aut est.', 'Autem totam voluptates eos enim nihil facere. At quae qui nulla qui dolores sapiente ipsa voluptatibus. Ipsa totam expedita et ipsum consequatur.', NULL, '4', 'Rudy Kirlin', 'Lake Desmondchester', NULL, 1, 0, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(128, 'Evie Marvin', 4, 5, 1, 4, '$1579', 'Lake Augustus', 'Facilis exercitationem officia architecto provident commodi. Neque vitae odio qui.', 'Architecto earum et iste inventore tempore blanditiis. Quos quia sed consequuntur voluptas nihil omnis. Blanditiis deserunt ea harum nam cupiditate sint iste.', 'Est voluptatem voluptatum libero iure sed expedita necessitatibus. Quia natus et velit in consectetur.', 'Perspiciatis repudiandae consequatur omnis. Veniam nam id beatae dolore ad aut ipsum. Animi debitis sint sint.', NULL, '7', 'Audrey Muller', 'Monafurt', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(130, 'Dr. Korbin Parisian DDS', 4, 1, 1, 4, '$9258', 'Lake Catherine', 'Dolores est porro aliquam non esse repellat officiis. Recusandae dicta modi id facilis. Sequi nemo saepe maxime eaque.', 'Ut est commodi et sed illum laboriosam. Sit beatae ut suscipit laudantium. Enim quae voluptatem aut voluptates. Officiis nostrum quis quis commodi et dignissimos minima.', 'Quibusdam vitae et aliquam placeat. Perspiciatis quos molestias beatae hic. Vel explicabo accusantium blanditiis amet autem dolorem quisquam.', 'Praesentium iusto doloremque eaque sed animi non molestiae quo. Sint quod earum nostrum eum fuga autem. Vitae ut rem eos enim voluptatem quia. Iusto quis sequi dolor fuga nisi aut dolores.', NULL, '5', 'Dion Bergstrom PhD', 'North Americostad', NULL, 2, 1, '2024-08-22 19:04:26', '2024-10-04 12:14:16'),
(131, 'Carole Klein', 4, 2, 1, 3, '$8934', 'Port Kelsiport', 'Molestias corporis sed dolore dolorum commodi. Nemo qui quo porro hic veniam ab ea. Fugiat voluptatibus ullam beatae magni.', 'Quia voluptas sit quo iure in similique dolores quidem. Sapiente itaque quam accusantium iste ea in quia. Praesentium est in dolor ratione nihil qui dolores. Molestias omnis ducimus eius nam.', 'Similique accusantium libero nam qui excepturi fugit ut. Voluptatibus ut voluptas consequuntur non enim. Corrupti doloremque nisi dolores commodi.', 'Veritatis aliquid minima commodi et reprehenderit neque. Voluptatum et fuga aut in. Aut quo repellendus voluptatem nostrum ut doloribus.', NULL, '2', 'Darrion Koelpin', 'Cummingsberg', NULL, 0, 1, '2024-08-22 19:04:26', '2024-10-05 12:12:18'),
(132, 'Paris Hackett', 4, 4, 1, 1, '$6074', 'Prudencemouth', 'Iste et rerum qui modi ut in sit. Sint occaecati reprehenderit enim nesciunt. Magnam ab et et voluptatem quos.', 'Quibusdam nam quia dolores. Consectetur quo dolor ut dolor. Quam consequuntur qui ut qui ut. Aut quaerat libero est qui aut esse.', 'Qui deleniti ipsa similique dolor reprehenderit. Tempora maiores qui ut minus ut et praesentium. Alias minima fuga porro dolor est facilis non.', 'Doloremque ut cupiditate porro aliquam. Et dolore rerum provident libero. Qui dignissimos et assumenda voluptatibus voluptatem hic qui.', NULL, '5', 'Guadalupe Gaylord', 'O\'Reillyborough', NULL, 1, 0, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(133, 'Raul Gaylord', 1, 5, 1, 1, '$6630', 'Danielside', 'Ut autem iste quam at et. Rerum perspiciatis adipisci dolorem eligendi rerum. Eum ea deserunt necessitatibus minima. Perspiciatis laborum maiores voluptates dolore ratione dolore architecto.', 'Asperiores ea itaque ipsam et omnis veritatis numquam. Et est placeat sint ut. Eaque consequatur nemo consequuntur.', 'Aut numquam aliquid est consequatur. Dolorem aut nulla mollitia magnam. Voluptatum est rerum eum quaerat temporibus facilis. Cum expedita accusantium omnis quas.', 'Labore tempore hic magni a quia qui non. Perferendis labore enim sed asperiores. Distinctio occaecati voluptatem eaque aperiam. Aut qui dolore et fugiat.', NULL, '9', 'Miss Gabriella Spinka DVM', 'Johnstonfurt', NULL, 1, 0, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(134, 'Mrs. Vanessa Kuphal', 2, 3, 1, 4, '$1287', 'Arnoldside', 'Ad dolorem cum quas quia nesciunt minus. Qui tempora voluptatum at dolores unde. Et at voluptatem illum eos non incidunt. Possimus et magni cupiditate ut quis.', 'Impedit recusandae earum quia eum. Optio iste non nemo odit esse. Autem odio quam ut quas distinctio.', 'Voluptas ratione fugiat consequatur in quia soluta. Nisi quasi et voluptatem nisi quaerat sed nisi et. Aut voluptatibus voluptas quia sit iure delectus numquam. Sed quae omnis quia.', 'Minus sunt nemo non autem sunt illo dolor. Sunt doloremque ea iusto earum deleniti. Illum unde qui molestiae quia iste. Quod aut quas eum ut voluptas.', NULL, '6', 'Ms. Kaycee Wolff', 'Lynchville', NULL, 1, 0, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(135, 'Obie Bogan DVM', 2, 5, 1, 2, '$9900', 'Sanfordport', 'Rerum nesciunt suscipit vero nam deleniti ea et autem. Omnis dolorem laudantium natus quia. Architecto qui ea aut est. Cum dolor similique sunt a dolorum necessitatibus.', 'Asperiores nulla a enim id quis iure dolor. Nemo molestias dolorem eaque magni voluptates. Molestiae aliquid aliquam omnis dignissimos. Cum nulla accusamus corporis modi fuga optio.', 'Error inventore facilis quidem. Saepe et quod blanditiis nesciunt deserunt. Minima aut iusto et eveniet sint quis aliquid.', 'Et perspiciatis asperiores sed autem et distinctio. Placeat corrupti voluptatibus nulla atque quo impedit. Repudiandae alias et vel.', NULL, '7', 'Mattie Batz', 'South Julesberg', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(136, 'Dr. Sheldon Gutmann III', 1, 1, 1, 1, '$1016', 'Schroederport', 'Adipisci doloremque repellendus asperiores maxime voluptatem ut. Consequuntur architecto beatae possimus eos animi. Possimus molestiae tempora et quibusdam.', 'Accusantium ea minus perspiciatis temporibus dolor. Voluptatum occaecati earum maiores eum nihil expedita. Aliquam porro molestias fuga ad nihil. Porro est molestiae qui.', 'Explicabo non consequatur voluptas accusantium nesciunt. Non eaque autem dolores mollitia quo tempore perferendis. Fuga sunt dolorum incidunt in eos sit optio. Neque explicabo recusandae qui culpa.', 'Explicabo sit qui quo. Autem esse earum dolores et alias. Optio impedit voluptates ea iusto exercitationem voluptatibus et aliquid.', NULL, '4', 'Juvenal Lueilwitz', 'Reynoldsborough', NULL, 0, 1, '2024-08-22 19:04:26', '2024-08-31 19:42:08'),
(137, 'Rusty Bogan IV', 2, 2, 1, 2, '$6851', 'New Jerroldfurt', 'Tempora eum error voluptatem quod ea voluptate. Harum illum voluptas ex illo est voluptatem.', 'Veniam quas nihil iure quo maxime omnis. Quia necessitatibus veritatis at voluptas est consequatur. Minus dolorem ut veritatis blanditiis in.', 'Voluptas sit error voluptatibus rerum fuga ea et. Quibusdam voluptates similique quam sit id ut quasi corporis. Ut mollitia placeat reprehenderit fuga. Est impedit sit accusamus et nihil.', 'Laboriosam harum id qui qui dolores repudiandae et. Et maxime voluptas impedit vero. Soluta asperiores est ea libero repudiandae.', NULL, '6', 'Mack Von II', 'Lake Mariloutown', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(138, 'Abdul Kling', 4, 1, 1, 1, '$4457', 'Port Frederik', 'Possimus dolorem unde atque consequuntur alias. Et aliquid repellat asperiores consequatur. In adipisci eveniet non.', 'Occaecati sit nostrum et quaerat rerum rerum. Rerum nisi quam doloremque ut rerum voluptatem. Quia eum ut architecto voluptatem laborum voluptatem.', 'Tempore earum omnis non eos. Ipsum iusto quibusdam aliquid id quasi sit. Neque alias aperiam ea iure ab. Ut sapiente pariatur dignissimos reiciendis.', 'Cumque cum qui qui at nemo inventore alias. Quisquam facilis in nihil quos nesciunt a nemo. Laboriosam enim hic quibusdam mollitia possimus.', NULL, '5', 'Leon McClure', 'Barrowshaven', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(139, 'Frankie Okuneva Sr.', 4, 4, 1, 5, '$3965', 'West Jaden', 'Voluptas dolores nesciunt eos. Alias veritatis nam qui voluptates sequi commodi molestias. Distinctio id cum impedit repellat vitae id qui.', 'Dolor quia est nemo sit ea molestias. Perferendis eum fugiat nam fuga reprehenderit ut eligendi. Amet quia rem mollitia ullam fuga corrupti adipisci.', 'Dolore facere sapiente cupiditate qui pariatur. Quos molestiae consequatur voluptates eos. Harum dolorum perferendis aut. Nihil nam expedita reiciendis alias accusantium eveniet.', 'Iusto consequatur et dolor non nobis ut earum. Rerum et adipisci at qui minus quam magnam. Rem assumenda dolores unde placeat dolores.', NULL, '4', 'Ms. Maria Flatley', 'Ankundingmouth', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(140, 'Keely Lynch', 5, 3, 1, 4, '$3464', 'New Everette', 'Non voluptatem distinctio ut est eius. Et eos veritatis dolorum voluptatem quaerat quae. Quis quasi amet assumenda hic. Et et quam deserunt est saepe laborum. Ut accusantium nulla nemo provident.', 'Quo sed ut eligendi maxime. Esse corporis et fugit veritatis eos quam est. Est aut eligendi et dicta soluta amet.', 'Autem officia architecto quisquam vero alias quos assumenda. Sapiente nostrum similique fugiat ipsam at aut in. Praesentium accusantium distinctio quis magni autem iste ea.', 'Voluptas vitae omnis sint iure corrupti accusantium delectus. Veniam cupiditate harum error quia sint adipisci nemo. Fugiat eaque qui rerum adipisci repellendus ut iusto.', NULL, '6', 'Ryan McClure', 'Port Cathrine', NULL, 1, 0, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(141, 'Reece Cole', 5, 1, 1, 1, '$5941', 'East Hectorstad', 'Laudantium aut ipsam quia neque voluptate placeat. Magni necessitatibus consequatur et voluptates necessitatibus mollitia nisi. Ut odio tempora delectus nisi id velit itaque corrupti.', 'Quia soluta quibusdam consectetur porro sapiente. Illo architecto consequatur animi commodi vero architecto enim. Aut ut totam nesciunt accusantium.', 'Dolor ut et officiis pariatur quaerat ratione officiis. Adipisci sit quod dignissimos quo eius placeat. Maxime et ipsum ut nostrum voluptatibus.', 'Eum voluptatem aut voluptas occaecati aut aut. Recusandae dolorem dolorem veritatis numquam in nihil sit aliquam. Tenetur velit et excepturi consequatur facere sit omnis.', NULL, '1', 'Dana Lueilwitz', 'New Elishamouth', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(142, 'Prof. Jamel Bechtelar V', 4, 1, 1, 4, '$9408', 'Kennaville', 'Eaque nulla qui assumenda sed minima. Et ad consectetur ad et. Amet consequatur vel omnis voluptatem ex quibusdam. Et reprehenderit in quaerat rem dolorum magnam. Omnis et itaque et eum.', 'Et omnis est hic id mollitia eligendi. Magnam beatae sit odio dolorem qui aperiam voluptatem. Aliquid omnis dolor ut explicabo.', 'Aperiam inventore recusandae harum pariatur. Similique rem nobis aliquid rem. Id voluptate aut porro impedit.', 'Tempora dolorem ut esse assumenda numquam. Blanditiis facere quas quo maiores autem. Recusandae eum unde quam omnis.', NULL, '6', 'Mr. Irwin Nikolaus', 'Crookshaven', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(144, 'Cody Dibbert', 5, 3, 1, 4, '$5217', 'Carlobury', 'Distinctio aliquam saepe at at corrupti rerum unde. Voluptatem ut laudantium consectetur quibusdam. Aut error culpa ipsa sequi corrupti. Non sed est iste libero consectetur.', 'Tempora modi quos harum. Officiis nesciunt numquam incidunt nemo porro ut nihil. Quos quia quae qui ipsum qui iure. Qui ipsam dolorum inventore ut ad.', 'Sint consequatur ducimus ut accusamus libero. Aliquam autem est vero rerum quia totam. Quasi ut culpa ut veniam.', 'Totam quidem et animi laboriosam. Vitae itaque et laudantium optio. Quia error dolorem dolore alias. Unde sit ea dignissimos.', NULL, '6', 'Sebastian Predovic', 'Predovichaven', NULL, 1, 1, '2024-08-22 19:04:26', '2024-08-22 19:04:26'),
(146, 'Web Developer', 2, 4, 1, 1, '$7024', 'Port Katrine', 'Qui similique aut eveniet dolores quam ea quod. Voluptas ipsa quia blanditiis voluptatum. Ducimus et dolores vel nihil nemo dolorem ut et.\r\n\r\nQui similique aut eveniet dolores quam ea quod. Voluptas ipsa quia blanditiis voluptatum. Ducimus et dolores vel nihil nemo dolorem ut et.\r\n\r\nQui similique aut eveniet dolores quam ea quod. Voluptas ipsa quia blanditiis voluptatum. Ducimus et dolores vel nihil nemo dolorem ut et.\r\n\r\nQui similique aut eveniet dolores quam ea quod. Voluptas ipsa quia blanditiis voluptatum. Ducimus et dolores vel nihil nemo dolorem ut et.', 'Quibusdam laudantium vel doloremque rerum. Facere velit accusamus quo officia. Corporis et temporibus et assumenda impedit provident. Necessitatibus eum assumenda non vero unde.\r\n\r\n Quibusdam laudantium vel doloremque rerum. Facere velit accusamus quo officia. Corporis et temporibus et assumenda impedit provident. Necessitatibus eum assumenda non vero unde.\r\n\r\n Quibusdam laudantium vel doloremque rerum. Facere velit accusamus quo officia. Corporis et temporibus et assumenda impedit provident. Necessitatibus eum assumenda non vero unde.', 'Porro quos suscipit debitis minus enim dolorem. Ut debitis minus et. Quia saepe sequi voluptatibus exercitationem facilis optio officia.\r\n\r\nPorro quos suscipit debitis minus enim dolorem. Ut debitis minus et. Quia saepe sequi voluptatibus exercitationem facilis optio officia.', 'Nesciunt ut quis sunt nostrum quia delectus. Dignissimos fugit ut saepe officia eum. Quia eius autem harum. Iste voluptatem enim rerum adipisci saepe quae.\r\n\r\nNesciunt ut quis sunt nostrum quia delectus. Dignissimos fugit ut saepe officia eum. Quia eius autem harum. Iste voluptatem enim rerum adipisci saepe quae.', 'php,laravel,mysql', '5', 'Brandon Adams', 'New Domenicoberg', NULL, 2, 0, '2024-08-22 19:38:19', '2024-10-05 02:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `job_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `employer_id` bigint UNSIGNED NOT NULL,
  `applied_date` timestamp NOT NULL,
  `cv_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `user_id`, `employer_id`, `applied_date`, `cv_path`, `created_at`, `updated_at`) VALUES
(20, 146, 2, 1, '2024-08-26 04:55:03', '', '2024-08-26 04:55:03', '2024-08-26 04:55:03'),
(21, 135, 2, 1, '2024-08-26 04:56:11', '', '2024-08-26 04:56:11', '2024-08-26 04:56:11'),
(22, 135, 3, 1, '2024-08-26 04:57:05', '', '2024-08-26 04:57:05', '2024-08-26 04:57:05'),
(25, 128, 3, 1, '2024-08-31 03:45:02', '', '2024-08-31 03:45:02', '2024-08-31 03:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 1, '2024-08-21 23:56:33', '2024-08-21 23:56:33'),
(2, 'Part Time', 1, '2024-08-21 23:56:33', '2024-08-21 23:56:33'),
(3, 'Freelance', 1, '2024-08-21 23:56:33', '2024-08-21 23:56:33'),
(4, 'Remote', 1, '2024-08-21 23:56:33', '2024-08-21 23:56:33'),
(5, 'Contract', 1, '2024-08-21 23:56:33', '2024-08-21 23:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_22_063923_create_categories_table', 2),
(6, '2024_08_22_064004_create_job_types_table', 2),
(7, '2024_08_22_064029_create_jobs_table', 2),
(8, '2024_08_22_090129_alter_job_table', 3),
(11, '2024_08_22_105928_alter_jobs_table', 4),
(12, '2024_08_25_041556_create_job_applications_table', 5),
(13, '2024_08_27_022026_create_saved_jobs_table', 6),
(14, '2024_08_29_103402_alter_users_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('audreanne83@example.org', 'glRYpYYCBjj9FN7g5aIOMITTclwPKeOUU0yCtyxTyvTHbreQLeUxnafRzfHZ', '2024-09-02 11:49:20'),
('duongkhang6401@gmail.com', 'e4fpCeE5WeKTLLJlnCNQEolxbvVJiX3BOvrEeNhRe32ujj1X5jKkxrTvDeTq', '2024-09-20 06:38:08'),
('khangduong.dev@gmail.com', '0R7Q1C4tVXxn4rQuo5s0Sj736BXrPnBeD73X9dLQ22ZWA3inwfiH0da40E1d', '2024-09-20 06:36:49'),
('userone@gmail.com', 'SRONna1tbJSXoXcPfFEgPVtF0vcNgCvhuZw1PaYul6LMwHgpVTsPHuyAgS3h', '2024-09-20 06:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `job_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 136, 3, '2024-08-26 19:49:18', '2024-08-26 19:49:18'),
(4, 146, 3, '2024-08-27 00:23:48', '2024-08-27 00:23:48'),
(5, 125, 1, '2024-08-27 00:25:38', '2024-08-27 00:25:38'),
(9, 128, 3, '2024-08-31 03:39:51', '2024-08-31 03:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user','employer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `email_verified_at`, `password`, `image`, `designation`, `mobile`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$wNGa6JodIWTRhW8gtkFBS.o0WBOFsZPKQoOJvmNNfVcLxAVatgz8a', '1-1729324609.png', '', '0369455664', 'admin', 1, NULL, '2024-08-20 05:53:17', '2024-10-19 08:02:25'),
(2, 'Nguyễn Văn A', 'nguyenvana@gmail.com', NULL, '$2y$10$9o759dq3.ulqEnQXQMyz6.BC/dX5.gi927/sDn34YxulT3dAP3x7C', NULL, NULL, '0976584986', 'user', 1, NULL, '2024-08-20 05:54:50', '2024-10-05 10:32:05'),
(3, 'Mark Done', 'duongkhang6401@gmail.com', NULL, '$2y$10$VV1F3Jay0QujfGHqxwXL..Phva9Ru4UEUXURinp0Sh.J7ZZwv0MCS', NULL, NULL, '0973648758', 'user', 1, NULL, '2024-08-22 04:58:57', '2024-10-08 07:34:52'),
(8, 'Mathilde Kub', 'hermann.garrison@example.net', '2024-08-30 04:49:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0367804658', 'employer', 1, 'QNSkuHNHrA', '2024-08-30 04:49:13', '2024-10-06 01:57:49'),
(9, 'Daisha Turner', 'missouri.howell@example.org', '2024-08-30 04:49:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0367804658', 'user', 0, '4uDF3PXr0r', '2024-08-30 04:49:13', '2024-10-05 10:31:22'),
(10, 'Jermain Kuhic', 'nikolaus.forrest@example.net', '2024-08-30 04:49:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0367804658', 'employer', 0, '4LTTZDyoI2', '2024-08-30 04:49:13', '2024-10-08 07:50:52'),
(12, 'Armand Wehner', 'kwindler@example.net', '2024-08-30 04:49:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0976584986', 'employer', 0, 'n3nJAXHMNj', '2024-08-30 04:49:13', '2024-10-08 07:50:57'),
(15, 'Mathilde Kub', 'xhalvorson@example.com', '2024-08-30 04:49:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0367804658', 'employer', 1, 'bCCmVxAIaS', '2024-08-30 04:49:13', '2024-10-06 01:50:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_category_id_foreign` (`career_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_employer_id_foreign` (`employer_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_jobs_job_id_foreign` (`job_id`),
  ADD KEY `saved_jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `saved_jobs_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
