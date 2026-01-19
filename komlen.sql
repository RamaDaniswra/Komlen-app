-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Jan 2026 pada 04.26
-- Versi server: 8.0.30
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komlen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint NOT NULL,
  `comic_id` bigint NOT NULL,
  `title` varchar(255) NOT NULL,
  `number` int NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `chapters`
--

INSERT INTO `chapters` (`id`, `comic_id`, `title`, `number`, `user_id`, `created_at`, `updated_at`) VALUES
(50, 16, 'ghvrj', 1, NULL, '2025-12-30 10:51:04', '2025-12-30 10:51:04'),
(51, 16, 'rwea', 2, NULL, '2025-12-30 10:59:23', '2025-12-30 10:59:23'),
(52, 18, 'sdasax', 1, NULL, '2025-12-30 11:27:18', '2025-12-30 11:27:18'),
(53, 18, 'hjk', 2, NULL, '2025-12-30 11:30:47', '2025-12-30 11:30:47'),
(56, 16, 'gfhvjb', 3, NULL, '2026-01-04 03:04:48', '2026-01-04 03:04:48'),
(59, 10, 'Dawg', 1, NULL, '2026-01-06 19:36:58', '2026-01-06 19:36:58'),
(60, 10, 'ghja', 2, NULL, '2026-01-08 18:41:21', '2026-01-08 18:41:21'),
(61, 17, 'wlee', 1, NULL, '2026-01-10 09:16:44', '2026-01-10 09:16:44'),
(62, 24, 'Warmth', 1, NULL, '2026-01-11 00:13:23', '2026-01-11 00:13:23'),
(63, 24, 'Anget', 2, NULL, '2026-01-11 00:13:54', '2026-01-11 00:13:54'),
(64, 25, 'Faith', 1, NULL, '2026-01-11 00:23:59', '2026-01-11 00:23:59'),
(65, 25, 'Fa', 2, NULL, '2026-01-11 00:24:29', '2026-01-11 00:24:29'),
(66, 26, 'Un', 1, NULL, '2026-01-11 00:35:24', '2026-01-11 00:35:24'),
(67, 26, 'Tuk', 2, NULL, '2026-01-11 00:36:35', '2026-01-11 00:36:35'),
(68, 26, 'Mu', 3, NULL, '2026-01-11 00:37:23', '2026-01-11 00:37:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comic`
--

CREATE TABLE `comic` (
  `id` bigint NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `views_count` int UNSIGNED NOT NULL DEFAULT '0',
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uploaded_by` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `comic`
--

INSERT INTO `comic` (`id`, `title`, `author`, `description`, `views_count`, `cover_image`, `uploaded_by`, `created_at`, `updated_at`, `slug`) VALUES
(10, 'ChainsawMan', 'Tatsuki Fujimoto', 'Based guy with chainsaw on his head', 11, 'cover/WGWphshAyhnVbx3qpvE73hxFoq8Z6ibz3KGez8Hr.jpg', 1, '2025-12-08 07:16:46', '2026-01-08 18:55:13', 'ChainsawMan'),
(11, 'Goblin Slayer', 'Kumo Kagyu', 'Literally me', 0, 'cover/QQmewooaHv9IeBGbFHe3y1HbSFyqhlj6BTavdGvZ.jpg', 1, '2025-12-08 08:23:05', '2026-01-04 01:47:35', 'goblin-slayer'),
(16, 'Fairy', 'Grimm', 'Fairy Tales but dark', 95, 'cover/TxydV69MO28pOI8IQHV0sfYLOOjXFH7ywKTRSU5R.jpg', 1, '2025-12-08 11:11:09', '2026-01-08 18:39:36', 'fairy'),
(17, 'The Wayfarer', 'Michael Zaki', 'Alva was once a knight who searched many lands for a cure for Saint Serreta\'s \"sickness\". Upon learning of his dedication to the saint, Zullie the Witch used all manner of tricks and deceit in an attempt to ruin Alva, but ultimately stood by his side. In the end, Alva failed his mission and relinquished his knighthood', 4, 'cover/nTruKhIfEAbGhhVMRYQBSackhasjZU5KwKk5GBKf.jpg', 1, '2025-12-08 07:17:40', '2026-01-11 00:52:02', 'The-Wayfarer'),
(18, 'Night Rain', 'Michael Zaki', 'Errrr...', 12, 'cover/hZHGsJSGESG78MU9OcPvrFTMq9Y0EqCgEWxaFl0q.jpg', 1, '2025-12-30 11:16:41', '2026-01-06 18:12:09', 'night-rain'),
(20, 'Bearer Of The Curse', 'Maybe Michael Zaki', 'Literally Me 2', 0, 'cover/1bDkA1iHBB2OGdTPJwOeBO9VRt40ovTMwDTWi99b.jpg', 1, '2026-01-02 11:47:49', '2026-01-04 02:04:19', 'bearer-of-the-curse'),
(21, 'Sinner Hunter', 'Grimm', 'Sinner hunter or something idk', 0, 'cover/rCxXqW4JrVGFR4SjEl7U0WjxBbf3y40Ca2ILifLv.jpg', 1, '2026-01-07 20:49:43', '2026-01-18 18:57:01', 'black-trial'),
(22, 'The Slayer Of Demons', 'Probably Michael Zaki', 'Tales of the old', 0, 'cover/U7CcPThA19cziHFBreOYMjefqdWnth60i6Z7v4Fo.jpg', 1, '2026-01-07 20:50:44', '2026-01-07 20:50:44', 'the-slayer-of-demons'),
(23, 'Slave Knight Gael', 'Miyazaki', 'HAnd it Over That Thing... Your Dark SOulS', 0, 'cover/sVhOFz7AIz636FElCcFbqQyqTr2PvgxGRME4qad0.jpg', 1, '2026-01-07 20:56:02', '2026-01-07 20:56:02', 'slave-knight-gael'),
(24, 'Warmth', 'Kharisma Jati', 'Warmth...', 1, 'cover/3JfT1hpGFKnjl6XyjKtjukBD4x8eWpsM5UHrsQUh.jpg', 1, '2026-01-11 00:12:02', '2026-01-11 00:17:43', 'warmth'),
(25, 'Faithful', 'Kharisma Jati', 'Faith...', 11, 'cover/KcrvoqW7gZq0oh361PrQdW0n95qcHc4s0micr2Qh.jpg', 1, '2026-01-11 00:22:24', '2026-01-18 19:50:17', 'faithful'),
(26, 'TO YOU', 'Kuro-Neko', 'Untukmu', 10, 'cover/0208sdcNNxaFPWLsJIOyAzVDJ1hjaFZSFa2RcL1Y.jpg', 1, '2026-01-11 00:33:51', '2026-01-18 19:41:05', 'to-you');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comic_genre`
--

CREATE TABLE `comic_genre` (
  `comic_id` bigint NOT NULL,
  `genre_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `comic_genre`
--

INSERT INTO `comic_genre` (`comic_id`, `genre_id`) VALUES
(10, 1),
(10, 3),
(10, 5),
(10, 10),
(10, 16),
(11, 1),
(11, 2),
(11, 5),
(11, 11),
(11, 15),
(16, 1),
(16, 2),
(16, 5),
(16, 6),
(16, 9),
(16, 10),
(16, 11),
(16, 15),
(16, 20),
(17, 1),
(17, 2),
(17, 5),
(17, 9),
(17, 15),
(18, 1),
(18, 2),
(18, 5),
(18, 9),
(20, 1),
(20, 2),
(20, 5),
(20, 9),
(20, 15),
(18, 10),
(18, 11),
(21, 1),
(21, 2),
(21, 5),
(21, 8),
(21, 9),
(21, 10),
(22, 1),
(22, 2),
(22, 5),
(22, 9),
(22, 19),
(23, 1),
(23, 2),
(23, 5),
(23, 8),
(23, 9),
(23, 10),
(24, 3),
(24, 4),
(24, 11),
(24, 14),
(24, 17),
(25, 3),
(25, 4),
(25, 6),
(25, 11),
(25, 17),
(26, 4),
(26, 11),
(26, 15),
(26, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `chapter_id` bigint NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `chapter_id`, `parent_id`, `content`, `created_at`, `updated_at`) VALUES
(9, 2, 50, NULL, 'bagus', '2026-01-02 11:14:46', '2026-01-02 11:14:46'),
(10, 2, 51, NULL, 'mantap', '2026-01-02 11:15:08', '2026-01-02 11:15:08'),
(11, 1, 53, NULL, 'baik', '2026-01-06 18:12:09', '2026-01-06 18:12:09'),
(13, 1, 59, NULL, 'baik', '2026-01-06 19:38:12', '2026-01-06 19:38:12'),
(14, 1, 59, NULL, 'Umazing!!', '2026-01-07 18:37:26', '2026-01-07 18:37:26'),
(16, 1, 50, 9, 'ya ya saya setuju', '2026-01-07 18:53:53', '2026-01-07 18:53:53'),
(20, 1, 50, 9, 'ikr', '2026-01-07 19:42:51', '2026-01-07 19:42:51'),
(21, 1, 50, 9, 'real', '2026-01-07 19:43:05', '2026-01-07 19:43:05'),
(22, 3, 50, 9, 'real?', '2026-01-07 19:44:42', '2026-01-07 19:44:42'),
(24, 3, 50, NULL, 'baik', '2026-01-07 19:53:50', '2026-01-07 19:53:50'),
(25, 3, 50, 24, 'awea', '2026-01-07 20:04:54', '2026-01-07 20:04:54'),
(26, 3, 50, 21, 'for real', '2026-01-07 20:11:21', '2026-01-07 20:11:21'),
(27, 3, 50, 25, 'waw', '2026-01-07 20:11:53', '2026-01-07 20:11:53'),
(28, 1, 50, NULL, 'well', '2026-01-07 20:37:53', '2026-01-07 20:37:53'),
(29, 1, 50, NULL, 'bagus', '2026-01-08 18:37:50', '2026-01-08 18:37:50'),
(30, 1, 65, NULL, 'mantaop', '2026-01-18 19:41:44', '2026-01-18 19:41:44'),
(31, 1, 64, NULL, 'mantap', '2026-01-18 19:47:44', '2026-01-18 19:47:44'),
(32, 3, 64, 31, 'ya ya saya setuju', '2026-01-18 19:49:22', '2026-01-18 19:49:22'),
(33, 3, 64, NULL, 'bagus', '2026-01-18 19:49:31', '2026-01-18 19:49:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Comedy'),
(4, 'Drama'),
(5, 'Fantasy'),
(6, 'Romance'),
(7, 'Sci-Fi'),
(8, 'Horror'),
(9, 'Mystery'),
(10, 'Thriller'),
(11, 'Slice of Life'),
(12, 'Supernatural'),
(13, 'Martial Arts'),
(14, 'School'),
(15, 'Seinen'),
(16, 'Shounen'),
(17, 'Shoujo'),
(18, 'Isekai'),
(19, 'Historical'),
(20, 'Psychological');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_11_20_021109_create_comics_table', 1),
(4, '2025_11_20_021110_create_chapters_table', 1),
(5, '2025_11_20_021110_create_pages_table', 1),
(6, '2025_11_20_021111_create_genres_table', 1),
(7, '2025_11_20_021112_create_comments_table', 1),
(9, '2026_01_16_104140_create_cache_table', 0),
(10, '2026_01_16_104140_create_cache_locks_table', 0),
(11, '2026_01_16_104140_create_chapters_table', 0),
(12, '2026_01_16_104140_create_comic_table', 0),
(13, '2026_01_16_104140_create_comic_genre_table', 0),
(14, '2026_01_16_104140_create_comments_table', 0),
(15, '2026_01_16_104140_create_failed_jobs_table', 0),
(16, '2026_01_16_104140_create_genre_table', 0),
(17, '2026_01_16_104140_create_job_batches_table', 0),
(18, '2026_01_16_104140_create_jobs_table', 0),
(19, '2026_01_16_104140_create_page_table', 0),
(20, '2026_01_16_104140_create_ratings_table', 0),
(21, '2026_01_16_104140_create_user_reads_table', 0),
(22, '2026_01_16_104140_create_users_table', 0),
(23, '2026_01_16_104143_add_foreign_keys_to_chapters_table', 0),
(24, '2026_01_16_104143_add_foreign_keys_to_comic_table', 0),
(25, '2026_01_16_104143_add_foreign_keys_to_comic_genre_table', 0),
(26, '2026_01_16_104143_add_foreign_keys_to_comments_table', 0),
(27, '2026_01_16_104143_add_foreign_keys_to_page_table', 0),
(28, '2026_01_16_104143_add_foreign_keys_to_ratings_table', 0),
(29, '2026_01_16_104143_add_foreign_keys_to_user_reads_table', 0),
(30, '2026_01_16_104415_create_cache_table', 0),
(31, '2026_01_16_104415_create_cache_locks_table', 0),
(32, '2026_01_16_104415_create_chapters_table', 0),
(33, '2026_01_16_104415_create_comic_table', 0),
(34, '2026_01_16_104415_create_comic_genre_table', 0),
(35, '2026_01_16_104415_create_comments_table', 0),
(36, '2026_01_16_104415_create_failed_jobs_table', 0),
(37, '2026_01_16_104415_create_genre_table', 0),
(38, '2026_01_16_104415_create_job_batches_table', 0),
(39, '2026_01_16_104415_create_jobs_table', 0),
(40, '2026_01_16_104415_create_page_table', 0),
(41, '2026_01_16_104415_create_ratings_table', 0),
(42, '2026_01_16_104415_create_user_reads_table', 0),
(43, '2026_01_16_104415_create_users_table', 0),
(44, '2026_01_16_104418_add_foreign_keys_to_chapters_table', 0),
(45, '2026_01_16_104418_add_foreign_keys_to_comic_table', 0),
(46, '2026_01_16_104418_add_foreign_keys_to_comic_genre_table', 0),
(47, '2026_01_16_104418_add_foreign_keys_to_comments_table', 0),
(48, '2026_01_16_104418_add_foreign_keys_to_page_table', 0),
(49, '2026_01_16_104418_add_foreign_keys_to_ratings_table', 0),
(50, '2026_01_16_104418_add_foreign_keys_to_user_reads_table', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id` bigint NOT NULL,
  `chapter_id` bigint NOT NULL,
  `page_number` int NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `page`
--

INSERT INTO `page` (`id`, `chapter_id`, `page_number`, `image_path`, `created_at`, `updated_at`) VALUES
(157, 50, 1, 'chapters/EMxSyMOYWG3wg5GX0d3I675pkisXShUxoFpNvE1v.png', '2025-12-30 10:51:04', '2025-12-30 10:51:04'),
(158, 50, 2, 'chapters/5ZSrFtuHIKgIy5jTXGnOPYp4aFALiyVtJGkPNta0.png', '2025-12-30 10:51:13', '2025-12-30 10:51:13'),
(159, 50, 3, 'chapters/wudkfJz83E6j9SMWo17KKCUbVgF7DuKgnkAwrqzA.png', '2025-12-30 10:51:14', '2025-12-30 10:51:14'),
(160, 50, 4, 'chapters/pLkZib3kJFM4rJeUFDlmdTjgAtkemLnkGrNgPan9.png', '2025-12-30 10:51:16', '2025-12-30 10:51:16'),
(161, 50, 5, 'chapters/VZdlqqvCidsioZZ7JUkJnCvFHq528QJxlBtjt3X1.jpg', '2025-12-30 10:51:18', '2025-12-30 10:51:18'),
(162, 51, 1, 'chapters/JBTb3WGQ3Ld84WjwcMswJG0k7lkImYRHZkvhKd3Y.png', '2025-12-30 10:59:24', '2025-12-30 10:59:24'),
(163, 51, 2, 'chapters/xUthqWmWEtnf6c2nEmWUOQROisnSy9eIWMQDz3z8.png', '2025-12-30 10:59:25', '2025-12-30 10:59:25'),
(164, 51, 3, 'chapters/bYF4To0wQvRxKk9eED9pcoMDN4n4hRTsKjXIJ91E.png', '2025-12-30 10:59:26', '2025-12-30 10:59:26'),
(165, 51, 4, 'chapters/IqzfNs0PbWUKgAmXSNPMSjbyhdsuro81FyqnoDFu.png', '2025-12-30 10:59:27', '2025-12-30 10:59:27'),
(166, 51, 5, 'chapters/4Lqdulj4c3WcnkorF79oQD6FQfHXdsVMh3sJ43Z3.jpg', '2025-12-30 10:59:27', '2025-12-30 10:59:27'),
(167, 52, 1, 'chapters/KQdPfcsVHZWtuHLczZliLXBFufmKGAULiBEcZbug.png', '2025-12-30 11:27:18', '2025-12-30 11:27:18'),
(168, 52, 2, 'chapters/STKfdfDGZJpcM6YykjwFrMg2LPuKhSjcyuwuzSDo.jpg', '2025-12-30 11:27:18', '2025-12-30 11:27:18'),
(169, 52, 3, 'chapters/CasBdxATwlEVApCfkLMsXPYn19tW87f9Fwj9Xluq.png', '2025-12-30 11:27:19', '2025-12-30 11:27:19'),
(170, 52, 4, 'chapters/DwSkpepinRMStlg81zAEttYSJFLmgPvzXUmXzUxZ.png', '2025-12-30 11:27:19', '2025-12-30 11:27:19'),
(171, 52, 5, 'chapters/85Y8AtYBbFycaDBB7DxLp3BhbwNRlEK0nKdfDn5m.png', '2025-12-30 11:27:20', '2025-12-30 11:27:20'),
(172, 53, 1, 'chapters/RMqAE1xcSRnWma8bgfoHcNYwleCCtuY9bNwyQrOJ.png', '2025-12-30 11:30:47', '2025-12-30 11:30:47'),
(173, 53, 2, 'chapters/D30ZqU3zywvH10hf2Z4MENnG5r1LLvuWzRB6EMJj.png', '2025-12-30 11:30:48', '2025-12-30 11:30:48'),
(174, 53, 3, 'chapters/2xNbCHbe5CSJApVrk1WvbKOqiiZDJmv5bZdV70NJ.png', '2025-12-30 11:30:48', '2025-12-30 11:30:48'),
(175, 53, 4, 'chapters/UO77AyXga4nIkOQcAYrOMi3HmdHENOYtRXkgSItx.png', '2025-12-30 11:30:49', '2025-12-30 11:30:49'),
(176, 53, 5, 'chapters/JdliO5Mg3TmQz7p1nKGCcWBSO4bZBIDZkRu7lDB4.jpg', '2025-12-30 11:30:50', '2025-12-30 11:30:50'),
(177, 51, 0, 'chapters/FXSgIYqwwx6IJuB0Yp3HJMJULIMKKmYefg9JaspV.jpg', '2026-01-04 01:13:41', '2026-01-04 01:13:41'),
(187, 56, 1, 'chapters/F7TzougjohhjpJZnwWCpdDkl80BdW09HRLmiGfJu.png', '2026-01-04 03:04:48', '2026-01-04 03:04:48'),
(188, 56, 2, 'chapters/OUWyTnangm7rjmtK0k7Pqt5N6iHynOPt1YZYBkCf.png', '2026-01-04 03:04:50', '2026-01-04 03:04:50'),
(189, 56, 3, 'chapters/PrSKyOlCLd8qUj09w6swT5W5Fw4TFZQxu6ifGwpC.png', '2026-01-04 03:04:51', '2026-01-04 03:04:51'),
(190, 56, 4, 'chapters/RMiFFOM9bFJxuGzi8bicRK5KLSAFhHerABqCcInI.png', '2026-01-04 03:04:52', '2026-01-04 03:04:52'),
(198, 59, 1, 'chapters/xnLGKYEnpI32Z4RJwgwwiaFPbDrNBOQD3e2rC8I9.jpg', '2026-01-06 19:36:58', '2026-01-06 19:36:58'),
(199, 59, 2, 'chapters/h0G1FglG3tFojUlWTzn4JYeuWD1Yopn7OiIcgoVQ.jpg', '2026-01-06 19:36:59', '2026-01-06 19:36:59'),
(200, 59, 3, 'chapters/87PfglYQql4PcIYiTD5dHQFYsWmhxD0vK95Amv28.jpg', '2026-01-06 19:37:00', '2026-01-06 19:37:00'),
(201, 59, 4, 'chapters/KcegvvFMAXCQKIi4UAze5aeSf8dWezag39XmPRl5.jpg', '2026-01-06 19:37:00', '2026-01-06 19:37:00'),
(202, 59, 5, 'chapters/cV3kAOnp8WgnlAozzbinHvka2vNB2mwiBAsrZDfn.jpg', '2026-01-06 19:37:01', '2026-01-06 19:37:01'),
(203, 59, 6, 'chapters/0PS9QWzsuQZ4RqgVgOFD3II619VbB6un6CbeDsAL.jpg', '2026-01-06 19:37:01', '2026-01-06 19:37:01'),
(204, 59, 7, 'chapters/nszMpieof2Oo0kpj3MRrWaNXvmw9dZ5f8q6SiR3P.jpg', '2026-01-06 19:37:02', '2026-01-06 19:37:02'),
(205, 59, 8, 'chapters/KAkPztEBL2KO5DwcFNUgGYJGVOyeRduNAzFdW5iF.jpg', '2026-01-06 19:37:02', '2026-01-06 19:37:02'),
(206, 59, 9, 'chapters/WxG5XND65lO2LvV6ZHqfri9el1Lo1Dk9oOb3z1Rf.jpg', '2026-01-06 19:37:03', '2026-01-06 19:37:03'),
(207, 59, 10, 'chapters/KmVs65Mr8FMOnJSXSSXGTebe8806jtFjTADhhLAt.jpg', '2026-01-06 19:37:03', '2026-01-06 19:37:03'),
(208, 59, 11, 'chapters/NhShJy46U6VuGC6mCeMvSzBMfEbAG26ms6Q5JZuS.jpg', '2026-01-06 19:37:04', '2026-01-06 19:37:04'),
(209, 59, 12, 'chapters/TEM17UGY1hvG1tgYOqbDeuTMmVhLowaIJQBgJJ5B.jpg', '2026-01-06 19:37:04', '2026-01-06 19:37:04'),
(210, 59, 13, 'chapters/Ft9liTRhkpDofKonCpHuqFA4kQpbXTD621EcKsqu.jpg', '2026-01-06 19:37:04', '2026-01-06 19:37:04'),
(211, 59, 14, 'chapters/ZziD7wnqtIeIDCv9w15MmdwxYTSbapzyEYh0olQT.jpg', '2026-01-06 19:37:05', '2026-01-06 19:37:05'),
(212, 59, 15, 'chapters/YoZH4D4R0d5sfIHxHYL15NW75vO8pvHXgFfUPADg.jpg', '2026-01-06 19:37:05', '2026-01-06 19:37:05'),
(213, 59, 16, 'chapters/SOAoxXu2YxjAP64El1CiC4QuXJE8zpsMSKY5JISE.jpg', '2026-01-06 19:37:06', '2026-01-06 19:37:06'),
(214, 59, 17, 'chapters/g2M5XUlw84btzqoXCMvHUWuvbymJASj4aUnSQki3.jpg', '2026-01-06 19:37:06', '2026-01-06 19:37:06'),
(215, 59, 18, 'chapters/OxDkKtntwAczw8cuKE921EgxTAoHAWEYoWMGK9RG.jpg', '2026-01-06 19:37:07', '2026-01-06 19:37:07'),
(216, 59, 19, 'chapters/YmpMFln9oYX0CYuIhgHGgZZN0GobGI6sqjtEEDjJ.jpg', '2026-01-06 19:37:07', '2026-01-06 19:37:07'),
(217, 59, 20, 'chapters/Vj7vAVzxioYZsBnl2XM48Qfee18i4BQIwSkii7NN.jpg', '2026-01-06 19:37:08', '2026-01-06 19:37:08'),
(218, 59, 21, 'chapters/Kw2X5ZicNuZkEUes1jc3M1YGkFaVX3pa23zPHcJa.jpg', '2026-01-06 19:37:08', '2026-01-06 19:37:08'),
(219, 59, 22, 'chapters/sWkiRDHvQmH38rhqb82dzFWSm9CZ5rkkmpBEOUFL.jpg', '2026-01-06 19:37:09', '2026-01-06 19:37:09'),
(220, 59, 23, 'chapters/iPwq8mRK3MKHv6rDVyLsERvRbadW5HUAOSgLi80z.jpg', '2026-01-06 19:37:09', '2026-01-06 19:37:09'),
(221, 59, 24, 'chapters/SZ6ku780sSQ04FehHPpwK0crrP2dpfnv9ozZ3Hw7.jpg', '2026-01-06 19:37:09', '2026-01-06 19:37:09'),
(222, 59, 25, 'chapters/IDgFWSykHGRk0fwJDfaGGYGBcuOAOe2qum923iz6.jpg', '2026-01-06 19:37:10', '2026-01-06 19:37:10'),
(223, 59, 26, 'chapters/4tsGtjIprym3A0mkbzkm0GOfVgy92RK6Hr2tLgir.jpg', '2026-01-06 19:37:10', '2026-01-06 19:37:10'),
(224, 60, 1, 'chapters/v8zDWijvZemFXyD6IR6c3MeRyYwQR5CdGVVIaXN0.jpg', '2026-01-08 18:41:23', '2026-01-08 18:41:23'),
(225, 60, 2, 'chapters/TZFtiHf2jmAdM0SL06ZHFd3M8ExUCZh6YlCMiirR.jpg', '2026-01-08 18:41:24', '2026-01-08 18:41:24'),
(226, 60, 3, 'chapters/f1u0pL3EsAbkAGTlvqN2vWJQ4beLMlAvhme42J6q.jpg', '2026-01-08 18:41:25', '2026-01-08 18:41:25'),
(227, 60, 4, 'chapters/Juy3KbcEMFFkIEpZ3qzblcUVDa4vfNBuN421rgPk.jpg', '2026-01-08 18:41:26', '2026-01-08 18:41:26'),
(228, 60, 5, 'chapters/qXxXBbh6RGJPpRLC4wYeRaUcyjd7vwC6VPJnLBgX.jpg', '2026-01-08 18:41:27', '2026-01-08 18:41:27'),
(229, 61, 1, 'chapters/460mLYIXNNAtSxpootl5625MEr8k7yrRVTXQTtfJ.png', '2026-01-10 09:16:55', '2026-01-10 09:16:55'),
(230, 62, 1, 'chapters/CyW2go88kDfWkpTOVSBuBg5Kb90JgHlUCcHCjnHu.jpg', '2026-01-11 00:13:23', '2026-01-11 00:13:23'),
(231, 62, 2, 'chapters/XMVmQmNA1fWtOszsSMLL7PcFGhaI1aTYEZCBsQ0E.jpg', '2026-01-11 00:13:23', '2026-01-11 00:13:23'),
(232, 62, 3, 'chapters/oOYtx1xr0Fxz2CZlwojAY8U7go0ovH8XVbv6yFQg.jpg', '2026-01-11 00:13:24', '2026-01-11 00:13:24'),
(233, 62, 4, 'chapters/RbOiQOJmeanALKlrRKweAUoidfROSXEayiaZOwtb.jpg', '2026-01-11 00:13:24', '2026-01-11 00:13:24'),
(234, 62, 5, 'chapters/TDir5dTkIS5DhcRuNhsP1e6InnRBudkzgfPB23Oa.jpg', '2026-01-11 00:13:25', '2026-01-11 00:13:25'),
(235, 63, 1, 'chapters/S3n5EEupHJyMm8tX83PnHnqB7lH2uZKxUHFRNbB2.jpg', '2026-01-11 00:13:54', '2026-01-11 00:13:54'),
(236, 63, 2, 'chapters/ug7L9vfYwKCz9v37eBZHThC5X09DRWidqNpEMuIW.jpg', '2026-01-11 00:13:55', '2026-01-11 00:13:55'),
(237, 63, 3, 'chapters/qYtQo0XVfxb1z4XKVX8YrUCokBzy7ujyttuV1W1L.jpg', '2026-01-11 00:13:56', '2026-01-11 00:13:56'),
(238, 63, 4, 'chapters/Yx2XlGV9tqG0rKbt81B0oUyUxJnRgdQn6MWeI1yC.jpg', '2026-01-11 00:13:56', '2026-01-11 00:13:56'),
(239, 63, 5, 'chapters/GkQ7mcRSDk6H1fz2PWIOw1qyWUrxoQLuptU5qJgi.jpg', '2026-01-11 00:13:57', '2026-01-11 00:13:57'),
(240, 64, 1, 'chapters/b0UCKnmdindTxkf1ziamcIm01tOdUJxE7ke1lJtL.jpg', '2026-01-11 00:23:59', '2026-01-11 00:23:59'),
(241, 64, 2, 'chapters/Pq1lTp9qWJh6mPH82R8KLYkM3oP4ESZcvjeIsRrQ.jpg', '2026-01-11 00:24:00', '2026-01-11 00:24:00'),
(242, 64, 3, 'chapters/lRKRwNNxWAxXmmYPBRFb7SBLt9zjqqVYgiMsgB9u.jpg', '2026-01-11 00:24:01', '2026-01-11 00:24:01'),
(243, 64, 4, 'chapters/fvmkJQ706uNdFvBbyogpATQ8nk2luK76M3CbtSPF.jpg', '2026-01-11 00:24:01', '2026-01-11 00:24:01'),
(244, 64, 5, 'chapters/UeOIoSiqW2wikWgUbucarlmOvCVYUfhood9SxCEk.jpg', '2026-01-11 00:24:02', '2026-01-11 00:24:02'),
(245, 65, 1, 'chapters/RtnOzwdpUTu1tm2XZNEbJiHAKSeeGdI2NLaq8gnp.jpg', '2026-01-11 00:24:29', '2026-01-11 00:24:29'),
(246, 65, 2, 'chapters/r7tAg6F2cnghX6Y2m3KKdy9ZsCeeH4JUjtoG9k4g.jpg', '2026-01-11 00:24:30', '2026-01-11 00:24:30'),
(247, 65, 3, 'chapters/mVH52CMld48lgzVrC12An1NhNEQGHMyI6Ikszxny.jpg', '2026-01-11 00:24:30', '2026-01-11 00:24:30'),
(248, 65, 4, 'chapters/lSL4jSlcSGUbiyfTRZJFj7s5VpoChH0xwqspZsFv.jpg', '2026-01-11 00:24:31', '2026-01-11 00:24:31'),
(249, 65, 5, 'chapters/oySE4UUoahTE53YT3Z1XbsXPZu5TIxsuWkfV6UJf.jpg', '2026-01-11 00:24:31', '2026-01-11 00:24:31'),
(250, 66, 1, 'chapters/FoiRVQ5MgAVsVNZ6kL2Wh8b9M1JrLChdZ51NBsMX.jpg', '2026-01-11 00:35:24', '2026-01-11 00:35:24'),
(251, 66, 2, 'chapters/PY45dOVA7JHY7tmS7P0nLvJNkwIiTUhNSWwAmiVQ.jpg', '2026-01-11 00:35:25', '2026-01-11 00:35:25'),
(252, 66, 3, 'chapters/qgEKjovxvAva47v3n3NcOqSFQoFojdtEDFAatHZj.jpg', '2026-01-11 00:35:26', '2026-01-11 00:35:26'),
(253, 66, 4, 'chapters/rYXkBUt3MsSEs2LJW4KDoHm9fYcSIKiEnt3G9t8G.jpg', '2026-01-11 00:35:27', '2026-01-11 00:35:27'),
(254, 66, 5, 'chapters/8JD9w6hd3U6litFg9r2TCAJ6f3g348zPQahXQ0NI.jpg', '2026-01-11 00:35:28', '2026-01-11 00:35:28'),
(255, 66, 6, 'chapters/EUjL7QtAp0dr4Cbvyfa5qp8YEFoxhVakXONBxoIe.jpg', '2026-01-11 00:35:35', '2026-01-11 00:35:35'),
(256, 67, 1, 'chapters/xmeI3TSvicK8XZn3tv9l1cOqDoRPAEZWBii3GOWt.jpg', '2026-01-11 00:36:35', '2026-01-11 00:36:35'),
(257, 67, 2, 'chapters/8xrEomfLXWCYQEk4PPnHbrfKZJ0jXUeaM95NIGuQ.jpg', '2026-01-11 00:36:36', '2026-01-11 00:36:36'),
(258, 67, 3, 'chapters/Vuz8fE2MIftdlIgCcIBGsN35QwjqcjGVBOvxgzY8.jpg', '2026-01-11 00:36:37', '2026-01-11 00:36:37'),
(259, 67, 4, 'chapters/o58AKV0VTiOezvWBAPQcw4IIB5PudGkBTncFjXWX.jpg', '2026-01-11 00:36:38', '2026-01-11 00:36:38'),
(260, 67, 5, 'chapters/c8P7zCcjuiUGqwceY5gdB65uOe08kgxh9c1IUJE3.jpg', '2026-01-11 00:36:39', '2026-01-11 00:36:39'),
(261, 67, 6, 'chapters/lmVL4mHCjZhzOWBigqaUQkzHNZIYHtMg3pqUulAm.jpg', '2026-01-11 00:36:40', '2026-01-11 00:36:40'),
(262, 68, 1, 'chapters/7PJueglY16MXTYdUxeylUT3b1v0Ef2sKHqp8J8Gz.jpg', '2026-01-11 00:37:23', '2026-01-11 00:37:23'),
(263, 68, 2, 'chapters/MuUfPuC9XxgWrtrUx13po6IXJVGD7iDpraSAovu8.jpg', '2026-01-11 00:37:24', '2026-01-11 00:37:24'),
(264, 68, 3, 'chapters/EkuvzltKMgNgw5HtfV3cUnrLbhq7X6nDKnvSJ9zh.jpg', '2026-01-11 00:37:25', '2026-01-11 00:37:25'),
(265, 68, 4, 'chapters/T7lRvlCNuikf1G47DXA7RcZRg3Po3ga6CnoVVpCl.jpg', '2026-01-11 00:37:26', '2026-01-11 00:37:26'),
(266, 68, 5, 'chapters/VVFBpXfX8f2Ntkx2hoTZJhan15wjHPR63fXjgxIP.jpg', '2026-01-11 00:37:28', '2026-01-11 00:37:28'),
(267, 68, 6, 'chapters/5cvdnHlEkBBO3fYlkRTi1mLWxduyEWuUZHPie9kH.jpg', '2026-01-11 00:37:29', '2026-01-11 00:37:29'),
(268, 68, 7, 'chapters/aO6BBYbZ0d3lF3daydRaS2qeUtlg81XAdlD1Syjk.jpg', '2026-01-11 00:37:29', '2026-01-11 00:37:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `comic_id` bigint NOT NULL,
  `rating` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `comic_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 5, '2026-01-01 09:38:33', '2026-01-01 09:38:33'),
(2, 1, 16, 4, '2026-01-01 09:45:21', '2026-01-08 18:39:20'),
(3, 3, 16, 4, '2026-01-01 09:57:36', '2026-01-01 09:57:36'),
(4, 3, 18, 3, '2026-01-01 09:58:17', '2026-01-01 09:58:37'),
(5, 2, 16, 3, '2026-01-02 11:14:14', '2026-01-02 11:14:21'),
(6, 5, 18, 4, '2026-01-06 17:29:00', '2026-01-06 17:29:00'),
(7, 1, 10, 4, '2026-01-07 18:22:22', '2026-01-07 18:22:22'),
(8, 1, 17, 5, '2026-01-10 09:17:25', '2026-01-10 09:17:25'),
(9, 1, 24, 4, '2026-01-11 00:24:39', '2026-01-11 00:24:39'),
(10, 1, 25, 5, '2026-01-11 00:24:54', '2026-01-11 00:24:54'),
(11, 1, 26, 3, '2026-01-11 00:38:06', '2026-01-11 00:38:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'ram', 'ram@gmail.com', '$2y$12$5COgzjfziYVENcj6GfemYuZWsfrO0xxGnGVxmy7CsM22poA.NNW8O', 'admin', '2025-11-26 15:48:24', '2025-11-26 15:48:24'),
(2, 'rusdi', 'rusdi@gmail.com', '$2y$12$xGjVrADKB4XBYsztVrT3G.z.vOmPRLyxullIufOkj.JTxCBmyQLFq', 'user', '2025-12-05 11:33:33', '2025-12-06 04:05:02'),
(3, 'Cirno', 'cirno@gmail.com', '$2y$12$Vhm6.ksi3xfFitefqtbfWe2AI3HPrTB/v/aer.e120Pcrq2kpqJKa', 'user', '2025-12-06 04:08:28', '2025-12-06 04:08:28'),
(4, 'faiz', 'faiz@gmail.com', '$2y$12$ZLd.Q6BPnYr31ByPg96G6uj12sJWNZJb7LYqz92fs9Q4aP/VYYYoW', 'user', '2025-12-07 08:43:54', '2025-12-07 08:43:54'),
(5, 'asep', 'asep@gmail.com', '$2y$12$GBlGjTTgP7LzUyCcMe1mluVtlageExVF1vdGoDRooPVEC3jZlwOve', 'user', '2026-01-06 17:27:55', '2026-01-06 17:27:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_reads`
--

CREATE TABLE `user_reads` (
  `user_id` bigint NOT NULL,
  `chapter_id` bigint NOT NULL,
  `last_read_page` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user_reads`
--

INSERT INTO `user_reads` (`user_id`, `chapter_id`, `last_read_page`, `created_at`, `updated_at`) VALUES
(1, 50, 1, '2025-12-30 10:52:52', '2025-12-30 10:52:52'),
(1, 51, 1, '2025-12-30 11:17:17', '2025-12-30 11:17:17'),
(1, 52, 1, '2025-12-30 11:27:30', '2025-12-30 11:27:30'),
(1, 53, 1, '2025-12-30 11:31:02', '2025-12-30 11:31:02'),
(3, 50, 1, '2026-01-01 09:57:45', '2026-01-01 09:57:45'),
(3, 52, 1, '2026-01-01 09:58:27', '2026-01-01 09:58:27'),
(2, 50, 1, '2026-01-02 11:14:26', '2026-01-02 11:14:26'),
(2, 51, 1, '2026-01-02 11:14:59', '2026-01-02 11:14:59'),
(1, 56, 1, '2026-01-04 03:05:11', '2026-01-04 03:05:11'),
(5, 52, 1, '2026-01-06 17:29:07', '2026-01-06 17:29:07'),
(5, 53, 1, '2026-01-06 17:29:13', '2026-01-06 17:29:13'),
(1, 59, 1, '2026-01-06 19:37:22', '2026-01-06 19:37:22'),
(1, 60, 1, '2026-01-08 18:41:50', '2026-01-08 18:41:50'),
(1, 61, 1, '2026-01-10 09:17:32', '2026-01-10 09:17:32'),
(1, 62, 1, '2026-01-11 00:17:43', '2026-01-11 00:17:43'),
(1, 66, 1, '2026-01-11 00:38:10', '2026-01-11 00:38:10'),
(1, 67, 1, '2026-01-11 00:38:16', '2026-01-11 00:38:16'),
(1, 68, 1, '2026-01-11 00:38:44', '2026-01-11 00:38:44'),
(1, 64, 1, '2026-01-18 19:41:22', '2026-01-18 19:41:22'),
(1, 65, 1, '2026-01-18 19:41:29', '2026-01-18 19:41:29'),
(3, 64, 1, '2026-01-18 19:49:06', '2026-01-18 19:49:06'),
(3, 65, 1, '2026-01-18 19:50:17', '2026-01-18 19:50:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chaco` (`comic_id`),
  ADD KEY `chaus` (`user_id`);

--
-- Indeks untuk tabel `comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cou` (`uploaded_by`);

--
-- Indeks untuk tabel `comic_genre`
--
ALTER TABLE `comic_genre`
  ADD KEY `geco` (`comic_id`),
  ADD KEY `gege` (`genre_id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comus` (`user_id`),
  ADD KEY `comcha` (`chapter_id`),
  ADD KEY `paco` (`parent_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paer` (`chapter_id`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratus` (`user_id`),
  ADD KEY `ramic` (`comic_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `user_reads`
--
ALTER TABLE `user_reads`
  ADD KEY `usus` (`user_id`),
  ADD KEY `uscha` (`chapter_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `comic`
--
ALTER TABLE `comic`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `page`
--
ALTER TABLE `page`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chaco` FOREIGN KEY (`comic_id`) REFERENCES `comic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chaus` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `cou` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comic_genre`
--
ALTER TABLE `comic_genre`
  ADD CONSTRAINT `geco` FOREIGN KEY (`comic_id`) REFERENCES `comic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gege` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comcha` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comus` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paco` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `paer` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ramic` FOREIGN KEY (`comic_id`) REFERENCES `comic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratus` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_reads`
--
ALTER TABLE `user_reads`
  ADD CONSTRAINT `uscha` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usus` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
