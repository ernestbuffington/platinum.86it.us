-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2021 at 04:46 AM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platinum_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_ads`
--

CREATE TABLE `nukec30_ads_ads` (
  `id_ads` int(11) NOT NULL,
  `id_catg` mediumint(9) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `ads_desc` text NOT NULL,
  `imageads` varchar(50) NOT NULL,
  `curr` tinyint(4) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `submitter` mediumint(9) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `dateposted` int(11) NOT NULL DEFAULT '0',
  `validuntil` int(11) NOT NULL DEFAULT '0',
  `hits` mediumint(9) NOT NULL DEFAULT '0',
  `language` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_box`
--

CREATE TABLE `nukec30_ads_box` (
  `id_save` int(11) NOT NULL,
  `id_ads` int(10) UNSIGNED DEFAULT NULL,
  `owner` int(11) NOT NULL DEFAULT '0',
  `id_catg` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `ads_desc` text NOT NULL,
  `imageads` varchar(80) NOT NULL,
  `curr` varchar(25) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `submiter` int(11) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `dateposted` int(11) NOT NULL DEFAULT '0',
  `validuntil` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_catg`
--

CREATE TABLE `nukec30_ads_catg` (
  `id_catg` mediumint(9) NOT NULL,
  `catg` varchar(50) DEFAULT NULL,
  `catg_desc` text,
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `image` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'english',
  `hits` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_comments`
--

CREATE TABLE `nukec30_ads_comments` (
  `no_comment` int(11) NOT NULL,
  `id_ads` int(11) NOT NULL DEFAULT '0',
  `commentby` mediumint(9) NOT NULL DEFAULT '0',
  `subject` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `hostname` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_config`
--

CREATE TABLE `nukec30_ads_config` (
  `nukecprefix` varchar(30) DEFAULT NULL,
  `folder_name` varchar(30) NOT NULL,
  `ModuleTitle` varchar(150) NOT NULL,
  `AdsTitleLength` varchar(5) NOT NULL,
  `AdsContentLength` varchar(6) NOT NULL,
  `Waiting` tinyint(4) NOT NULL DEFAULT '0',
  `PerPage` tinyint(4) NOT NULL DEFAULT '0',
  `UseImgCatg` tinyint(4) NOT NULL DEFAULT '0',
  `PostInMainCatg` tinyint(4) NOT NULL DEFAULT '0',
  `MemberRequired` tinyint(4) NOT NULL DEFAULT '0',
  `AdsComment` tinyint(4) NOT NULL DEFAULT '0',
  `PopAds` tinyint(4) NOT NULL DEFAULT '0',
  `UploadImg` tinyint(4) NOT NULL DEFAULT '0',
  `MaxImgSize` varchar(5) NOT NULL,
  `MaxImgHeight` varchar(5) NOT NULL,
  `MaxImgWidth` varchar(5) NOT NULL,
  `ThumbToHeight` tinyint(4) NOT NULL DEFAULT '0',
  `ThumbToWidth` tinyint(4) NOT NULL DEFAULT '0',
  `ThumbHeight` varchar(5) NOT NULL,
  `ThumbWidth` varchar(5) NOT NULL,
  `UploadPath` varchar(150) NOT NULL,
  `UploadPathRev` varchar(100) NOT NULL,
  `CatgPath` varchar(150) NOT NULL,
  `CatgPathRev` varchar(100) NOT NULL,
  `MaxAllowedAds` smallint(6) NOT NULL DEFAULT '0',
  `adsbgcolor1` varchar(10) NOT NULL,
  `adsbgcolor2` varchar(10) NOT NULL,
  `adsbgcolor3` varchar(10) NOT NULL,
  `adsbgcolor4` varchar(10) NOT NULL,
  `adsbgcolor5` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_currency`
--

CREATE TABLE `nukec30_ads_currency` (
  `no` tinyint(4) NOT NULL,
  `curr` varchar(10) NOT NULL,
  `country` varchar(60) NOT NULL DEFAULT '0000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_custom`
--

CREATE TABLE `nukec30_ads_custom` (
  `custom_id` smallint(6) NOT NULL,
  `custom_title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `weight` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `language` varchar(50) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_disclaimer`
--

CREATE TABLE `nukec30_ads_disclaimer` (
  `no` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_duration`
--

CREATE TABLE `nukec30_ads_duration` (
  `id_duration` tinyint(4) NOT NULL,
  `duration_value` smallint(6) NOT NULL DEFAULT '0',
  `duration_alias` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_filter`
--

CREATE TABLE `nukec30_ads_filter` (
  `word_id` smallint(6) NOT NULL,
  `bad_word` varchar(50) NOT NULL,
  `rep_word` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nukec30_ads_imgtype`
--

CREATE TABLE `nukec30_ads_imgtype` (
  `id_typeimg` tinyint(4) NOT NULL DEFAULT '0',
  `typeimg` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_aab_config`
--

CREATE TABLE `nuke_aab_config` (
  `phpmyadmin_url` varchar(255) NOT NULL,
  `cpanel_url` varchar(255) NOT NULL,
  `mainadmin_button` smallint(1) NOT NULL DEFAULT '0',
  `forumadmin_button` smallint(1) NOT NULL DEFAULT '0',
  `phpmyadmin_button` smallint(1) NOT NULL DEFAULT '0',
  `cpanel_button` smallint(1) NOT NULL DEFAULT '0',
  `admin_logout` smallint(1) NOT NULL DEFAULT '0',
  `show_warning_image` smallint(1) NOT NULL DEFAULT '0',
  `show_warning` smallint(1) NOT NULL DEFAULT '0',
  `button_text` varchar(7) NOT NULL,
  `warning_text` varchar(255) NOT NULL,
  `fusion_menu` smallint(1) NOT NULL DEFAULT '0',
  `sentinel_menu` smallint(1) NOT NULL DEFAULT '0',
  `show_modules` smallint(1) NOT NULL DEFAULT '0',
  `show_forum` smallint(1) NOT NULL DEFAULT '0',
  `submissions` smallint(1) NOT NULL DEFAULT '0',
  `block_width` int(3) NOT NULL DEFAULT '150'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_about_us`
--

CREATE TABLE `nuke_about_us` (
  `id` int(11) NOT NULL,
  `about_data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_cache`
--

CREATE TABLE `nuke_amazon_cache` (
  `cid` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(60) NOT NULL,
  `xml` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_cart`
--

CREATE TABLE `nuke_amazon_cart` (
  `id` int(11) NOT NULL,
  `session` tinytext NOT NULL,
  `asin` varchar(10) NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_catalog`
--

CREATE TABLE `nuke_amazon_catalog` (
  `uid` int(11) NOT NULL,
  `catalog` varchar(30) NOT NULL,
  `r_catalog` varchar(30) NOT NULL,
  `l_catalog` text NOT NULL,
  `mode` varchar(20) NOT NULL,
  `button_image` varchar(255) NOT NULL,
  `no_image` varchar(255) NOT NULL,
  `locale` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_cfg`
--

CREATE TABLE `nuke_amazon_cfg` (
  `AMZVer` varchar(7) NOT NULL,
  `AMZModule_Name` varchar(255) NOT NULL,
  `AMZ_id` varchar(30) NOT NULL DEFAULT 'httpwwwnukepc-20',
  `cache_maxtime` int(6) NOT NULL DEFAULT '14400',
  `AMZMore` tinyint(1) NOT NULL DEFAULT '0',
  `AMZSingle` tinyint(1) NOT NULL DEFAULT '0',
  `AMZQuickAdd` tinyint(1) NOT NULL DEFAULT '0',
  `AMZShowReview` tinyint(1) NOT NULL DEFAULT '0',
  `AMZShowSimilar` tinyint(1) NOT NULL DEFAULT '0',
  `AMZLocale` char(2) NOT NULL DEFAULT 'us',
  `AMZReviewMod` tinyint(1) NOT NULL DEFAULT '0',
  `ImageType` char(2) NOT NULL DEFAULT 'NO',
  `default_asin` varchar(10) NOT NULL DEFAULT 'B00009TB5G',
  `AMZ_Popular` tinyint(3) NOT NULL DEFAULT '25',
  `AMZBuyBox` tinyint(1) NOT NULL DEFAULT '1',
  `AMZShowXML` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_department`
--

CREATE TABLE `nuke_amazon_department` (
  `did` int(11) NOT NULL,
  `r_catalog` varchar(30) NOT NULL,
  `items` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_items`
--

CREATE TABLE `nuke_amazon_items` (
  `iid` int(8) NOT NULL,
  `asin` varchar(10) DEFAULT NULL,
  `hits` mediumint(9) NOT NULL DEFAULT '0',
  `category` varchar(50) NOT NULL,
  `clicks` mediumint(9) NOT NULL DEFAULT '0',
  `imp` mediumint(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_nodes`
--

CREATE TABLE `nuke_amazon_nodes` (
  `nid` int(11) NOT NULL,
  `catalog` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `node` int(10) NOT NULL DEFAULT '0',
  `pnode` int(10) DEFAULT NULL,
  `locale` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_amazon_not_item`
--

CREATE TABLE `nuke_amazon_not_item` (
  `iid` int(11) NOT NULL,
  `asin` varchar(10) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_authors`
--

CREATE TABLE `nuke_authors` (
  `aid` varchar(25) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `radminsuper` tinyint(1) NOT NULL DEFAULT '1',
  `admlanguage` varchar(30) NOT NULL,
  `radminblocker` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_autonews`
--

CREATE TABLE `nuke_autonews` (
  `anid` int(11) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `aid` varchar(25) NOT NULL,
  `title` varchar(80) NOT NULL,
  `time` varchar(19) NOT NULL,
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `topic` int(3) NOT NULL DEFAULT '1',
  `informant` varchar(25) NOT NULL,
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL DEFAULT '0',
  `alanguage` varchar(30) NOT NULL,
  `acomm` int(1) NOT NULL DEFAULT '0',
  `associated` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banned_ip`
--

CREATE TABLE `nuke_banned_ip` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner`
--

CREATE TABLE `nuke_banner` (
  `bid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL,
  `clickurl` varchar(200) NOT NULL,
  `alttext` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `dateend` datetime DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `ad_class` varchar(5) NOT NULL,
  `ad_code` text NOT NULL,
  `ad_width` int(4) DEFAULT '0',
  `ad_height` int(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_campaigns`
--

CREATE TABLE `nuke_banner_campaigns` (
  `campaigns_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_clients`
--

CREATE TABLE `nuke_banner_clients` (
  `cid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `contact` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `login` varchar(10) NOT NULL,
  `passwd` varchar(10) NOT NULL,
  `extrainfo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_plans`
--

CREATE TABLE `nuke_banner_plans` (
  `pid` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `delivery` varchar(10) NOT NULL,
  `delivery_type` varchar(25) NOT NULL,
  `price` varchar(25) NOT NULL DEFAULT '0',
  `buy_links` text NOT NULL,
  `buy_links2` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_positions`
--

CREATE TABLE `nuke_banner_positions` (
  `apid` int(10) NOT NULL,
  `position_number` int(5) NOT NULL DEFAULT '0',
  `position_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_stats`
--

CREATE TABLE `nuke_banner_stats` (
  `stats_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_terms`
--

CREATE TABLE `nuke_banner_terms` (
  `terms_body` text NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_thanks`
--

CREATE TABLE `nuke_banner_thanks` (
  `thanks_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banreq`
--

CREATE TABLE `nuke_banreq` (
  `id` int(4) NOT NULL,
  `user_name` text NOT NULL,
  `reason` longtext NOT NULL,
  `active` char(3) NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbacronyms`
--

CREATE TABLE `nuke_bbacronyms` (
  `acronym_id` mediumint(9) NOT NULL,
  `acronym` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbadmin_nav_module`
--

CREATE TABLE `nuke_bbadmin_nav_module` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `modulname` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbadmin_pm`
--

CREATE TABLE `nuke_bbadmin_pm` (
  `admin_id` int(10) DEFAULT '0',
  `admin_redirect_id` int(10) DEFAULT '0',
  `admin_deny` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbadvanced_username_color`
--

CREATE TABLE `nuke_bbadvanced_username_color` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_color` varchar(6) NOT NULL,
  `group_weight` smallint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade`
--

CREATE TABLE `nuke_bbarcade` (
  `arcade_name` varchar(255) NOT NULL,
  `arcade_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_categories`
--

CREATE TABLE `nuke_bbarcade_categories` (
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL,
  `arcade_cattitle` varchar(100) NOT NULL,
  `arcade_nbelmt` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `arcade_catorder` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `arcade_catauth` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_comments`
--

CREATE TABLE `nuke_bbarcade_comments` (
  `game_id` mediumint(8) NOT NULL DEFAULT '0',
  `comments_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_fav`
--

CREATE TABLE `nuke_bbarcade_fav` (
  `order` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `game_id` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments`
--

CREATE TABLE `nuke_bbattachments` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `user_id_1` mediumint(8) NOT NULL DEFAULT '0',
  `user_id_2` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_config`
--

CREATE TABLE `nuke_bbattachments_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_desc`
--

CREATE TABLE `nuke_bbattachments_desc` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL,
  `physical_filename` varchar(255) NOT NULL,
  `real_filename` varchar(255) NOT NULL,
  `download_count` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `filesize` int(20) NOT NULL DEFAULT '0',
  `filetime` int(11) NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattach_quota`
--

CREATE TABLE `nuke_bbattach_quota` (
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `quota_type` smallint(2) NOT NULL DEFAULT '0',
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattributes`
--

CREATE TABLE `nuke_bbattributes` (
  `attribute_id` int(11) NOT NULL,
  `attribute_type` smallint(1) NOT NULL DEFAULT '0',
  `attribute` varchar(255) NOT NULL DEFAULT '',
  `attribute_image` varchar(255) NOT NULL DEFAULT '',
  `attribute_color` varchar(6) NOT NULL DEFAULT '',
  `attribute_date_format` varchar(25) DEFAULT NULL,
  `attribute_position` tinyint(1) NOT NULL DEFAULT '0',
  `attribute_administrator` tinyint(1) DEFAULT '0',
  `attribute_moderator` tinyint(1) DEFAULT '0',
  `attribute_author` tinyint(1) DEFAULT '0',
  `attribute_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_access`
--

CREATE TABLE `nuke_bbauth_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `auth_view` tinyint(1) NOT NULL DEFAULT '0',
  `auth_read` tinyint(1) NOT NULL DEFAULT '0',
  `auth_post` tinyint(1) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(1) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(1) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(1) NOT NULL DEFAULT '0',
  `auth_globalannounce` tinyint(1) DEFAULT NULL,
  `auth_vote` tinyint(1) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(1) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(1) NOT NULL DEFAULT '0',
  `auth_mod` tinyint(1) NOT NULL DEFAULT '0',
  `auth_download` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_arcade_access`
--

CREATE TABLE `nuke_bbauth_arcade_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbbanlist`
--

CREATE TABLE `nuke_bbbanlist` (
  `ban_id` mediumint(8) UNSIGNED NOT NULL,
  `ban_userid` mediumint(8) NOT NULL DEFAULT '0',
  `ban_ip` varchar(8) NOT NULL,
  `ban_email` varchar(255) DEFAULT NULL,
  `ban_time` int(11) DEFAULT NULL,
  `ban_expire_time` int(11) DEFAULT NULL,
  `ban_by_userid` mediumint(8) DEFAULT NULL,
  `ban_priv_reason` text,
  `ban_pub_reason_mode` tinyint(1) DEFAULT NULL,
  `ban_pub_reason` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbbuddies`
--

CREATE TABLE `nuke_bbbuddies` (
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `buddy_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcanned`
--

CREATE TABLE `nuke_bbcanned` (
  `canned_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `canned_title` varchar(100) NOT NULL,
  `canned_message` text NOT NULL,
  `canned_enable_bbcode` tinyint(1) NOT NULL DEFAULT '0',
  `canned_move_after_post` tinyint(1) NOT NULL DEFAULT '0',
  `canned_lock_after_post` tinyint(1) NOT NULL DEFAULT '0',
  `sortorder` smallint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcash`
--

CREATE TABLE `nuke_bbcash` (
  `cash_id` smallint(6) NOT NULL,
  `cash_order` smallint(6) NOT NULL DEFAULT '0',
  `cash_settings` smallint(4) NOT NULL DEFAULT '3313',
  `cash_dbfield` varchar(64) NOT NULL DEFAULT 'user_cash',
  `cash_name` varchar(64) NOT NULL DEFAULT 'cash',
  `cash_default` int(11) NOT NULL DEFAULT '0',
  `cash_decimals` tinyint(2) NOT NULL DEFAULT '0',
  `cash_imageurl` varchar(255) NOT NULL,
  `cash_exchange` int(11) NOT NULL DEFAULT '1',
  `cash_perpost` int(11) NOT NULL DEFAULT '25',
  `cash_postbonus` int(11) NOT NULL DEFAULT '2',
  `cash_perreply` int(11) NOT NULL DEFAULT '25',
  `cash_maxearn` int(11) NOT NULL DEFAULT '75',
  `cash_perpm` int(11) NOT NULL DEFAULT '0',
  `cash_perchar` int(11) NOT NULL DEFAULT '20',
  `cash_allowance` tinyint(1) NOT NULL DEFAULT '0',
  `cash_allowanceamount` int(11) NOT NULL DEFAULT '0',
  `cash_allowancetime` tinyint(2) NOT NULL DEFAULT '2',
  `cash_allowancenext` int(11) NOT NULL DEFAULT '0',
  `cash_forumlist` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcash_events`
--

CREATE TABLE `nuke_bbcash_events` (
  `event_name` varchar(32) NOT NULL,
  `event_data` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcash_exchange`
--

CREATE TABLE `nuke_bbcash_exchange` (
  `ex_cash_id1` int(11) NOT NULL DEFAULT '0',
  `ex_cash_id2` int(11) NOT NULL DEFAULT '0',
  `ex_cash_enabled` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcash_groups`
--

CREATE TABLE `nuke_bbcash_groups` (
  `group_id` mediumint(6) NOT NULL DEFAULT '0',
  `group_type` tinyint(2) NOT NULL DEFAULT '0',
  `cash_id` smallint(6) NOT NULL DEFAULT '0',
  `cash_perpost` int(11) NOT NULL DEFAULT '0',
  `cash_postbonus` int(11) NOT NULL DEFAULT '0',
  `cash_perreply` int(11) NOT NULL DEFAULT '0',
  `cash_perchar` int(11) NOT NULL DEFAULT '0',
  `cash_maxearn` int(11) NOT NULL DEFAULT '0',
  `cash_perpm` int(11) NOT NULL DEFAULT '0',
  `cash_allowance` tinyint(1) NOT NULL DEFAULT '0',
  `cash_allowanceamount` int(11) NOT NULL DEFAULT '0',
  `cash_allowancetime` tinyint(2) NOT NULL DEFAULT '2',
  `cash_allowancenext` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcash_log`
--

CREATE TABLE `nuke_bbcash_log` (
  `log_id` int(11) NOT NULL,
  `log_time` int(11) NOT NULL DEFAULT '0',
  `log_type` smallint(6) NOT NULL DEFAULT '0',
  `log_action` varchar(255) NOT NULL,
  `log_text` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcategories`
--

CREATE TABLE `nuke_bbcategories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbconfig`
--

CREATE TABLE `nuke_bbconfig` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbconfirm`
--

CREATE TABLE `nuke_bbconfirm` (
  `confirm_id` char(32) NOT NULL,
  `session_id` char(32) NOT NULL,
  `code` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcustom_canned`
--

CREATE TABLE `nuke_bbcustom_canned` (
  `custom_canned_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `custom_canned_title` varchar(100) NOT NULL,
  `custom_canned_message` text NOT NULL,
  `sortorder` smallint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbdisallow`
--

CREATE TABLE `nuke_bbdisallow` (
  `disallow_id` mediumint(8) UNSIGNED NOT NULL,
  `disallow_username` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextensions`
--

CREATE TABLE `nuke_bbextensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `extension` varchar(100) NOT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextension_groups`
--

CREATE TABLE `nuke_bbextension_groups` (
  `group_id` mediumint(8) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `upload_icon` varchar(100) DEFAULT NULL,
  `max_filesize` int(20) NOT NULL DEFAULT '0',
  `forum_permissions` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbfavorites`
--

CREATE TABLE `nuke_bbfavorites` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbflags`
--

CREATE TABLE `nuke_bbflags` (
  `flag_id` int(10) NOT NULL,
  `flag_name` varchar(50) DEFAULT NULL,
  `flag_image` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforbidden_extensions`
--

CREATE TABLE `nuke_bbforbidden_extensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `extension` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforums`
--

CREATE TABLE `nuke_bbforums` (
  `forum_id` smallint(5) UNSIGNED NOT NULL,
  `cat_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_desc` text,
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '1',
  `forum_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_topics` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_notify` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `prune_next` int(11) DEFAULT NULL,
  `prune_enable` tinyint(1) NOT NULL DEFAULT '1',
  `auth_view` tinyint(2) NOT NULL DEFAULT '0',
  `auth_read` tinyint(2) NOT NULL DEFAULT '0',
  `auth_post` tinyint(2) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(2) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(2) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(2) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(2) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(2) NOT NULL DEFAULT '0',
  `auth_globalannounce` tinyint(2) NOT NULL DEFAULT '3',
  `auth_vote` tinyint(2) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(2) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(2) NOT NULL DEFAULT '0',
  `auth_download` tinyint(2) NOT NULL DEFAULT '0',
  `attached_forum_id` mediumint(8) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforums_watch`
--

CREATE TABLE `nuke_bbforums_watch` (
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforum_prune`
--

CREATE TABLE `nuke_bbforum_prune` (
  `prune_id` mediumint(8) UNSIGNED NOT NULL,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `prune_days` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `prune_freq` tinyint(4) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgamehash`
--

CREATE TABLE `nuke_bbgamehash` (
  `gamehash_id` char(32) NOT NULL,
  `game_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `hash_date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgames`
--

CREATE TABLE `nuke_bbgames` (
  `game_id` mediumint(8) NOT NULL,
  `game_pic` varchar(50) NOT NULL,
  `game_desc` varchar(255) NOT NULL,
  `game_highscore` int(11) NOT NULL DEFAULT '0',
  `game_highdate` int(11) NOT NULL DEFAULT '0',
  `game_highuser` mediumint(8) NOT NULL DEFAULT '0',
  `game_name` varchar(50) NOT NULL,
  `game_swf` varchar(50) NOT NULL,
  `game_scorevar` varchar(20) NOT NULL,
  `game_type` tinyint(4) NOT NULL DEFAULT '0',
  `game_width` mediumint(5) NOT NULL DEFAULT '550',
  `game_height` varchar(5) NOT NULL DEFAULT '380',
  `game_order` mediumint(8) NOT NULL DEFAULT '0',
  `game_set` mediumint(8) NOT NULL DEFAULT '0',
  `arcade_catid` mediumint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgames_rate`
--

CREATE TABLE `nuke_bbgames_rate` (
  `game_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `rate` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgroups`
--

CREATE TABLE `nuke_bbgroups` (
  `group_id` mediumint(8) NOT NULL,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_name` varchar(40) NOT NULL,
  `group_description` varchar(255) NOT NULL,
  `group_moderator` mediumint(8) NOT NULL DEFAULT '0',
  `group_single_user` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbhackgame`
--

CREATE TABLE `nuke_bbhackgame` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `game_id` mediumint(8) NOT NULL DEFAULT '0',
  `date_hack` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs`
--

CREATE TABLE `nuke_bblogs` (
  `id_log` mediumint(10) NOT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `topic_id` mediumint(10) DEFAULT '0',
  `user_id` mediumint(8) DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `user_ip` varchar(8) NOT NULL DEFAULT '0',
  `time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs_config`
--

CREATE TABLE `nuke_bblogs_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbnotes`
--

CREATE TABLE `nuke_bbnotes` (
  `id` int(8) NOT NULL DEFAULT '0',
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts`
--

CREATE TABLE `nuke_bbposts` (
  `post_id` mediumint(8) UNSIGNED NOT NULL,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) NOT NULL DEFAULT '0',
  `post_time` int(11) NOT NULL DEFAULT '0',
  `poster_ip` varchar(8) NOT NULL,
  `post_username` varchar(25) DEFAULT NULL,
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) NOT NULL DEFAULT '1',
  `post_edit_time` int(11) DEFAULT NULL,
  `post_edit_count` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `post_attachment` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts_text`
--

CREATE TABLE `nuke_bbposts_text` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) NOT NULL,
  `post_subject` varchar(60) DEFAULT NULL,
  `post_text` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs`
--

CREATE TABLE `nuke_bbprivmsgs` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT '0',
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_date` int(11) NOT NULL DEFAULT '0',
  `privmsgs_ip` varchar(8) NOT NULL,
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attachment` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_archive`
--

CREATE TABLE `nuke_bbprivmsgs_archive` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT '0',
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_date` int(11) NOT NULL DEFAULT '0',
  `privmsgs_ip` varchar(8) NOT NULL,
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_text`
--

CREATE TABLE `nuke_bbprivmsgs_text` (
  `privmsgs_text_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbproxies`
--

CREATE TABLE `nuke_bbproxies` (
  `ip_address` char(8) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `port` char(4) DEFAULT '0',
  `last_checked` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbquota_limits`
--

CREATE TABLE `nuke_bbquota_limits` (
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL,
  `quota_desc` varchar(20) NOT NULL,
  `quota_limit` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbranks`
--

CREATE TABLE `nuke_bbranks` (
  `rank_id` smallint(5) UNSIGNED NOT NULL,
  `rank_title` varchar(50) NOT NULL,
  `rank_min` mediumint(8) NOT NULL DEFAULT '0',
  `rank_max` mediumint(8) NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) DEFAULT '0',
  `rank_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreport`
--

CREATE TABLE `nuke_bbreport` (
  `report_id` mediumint(8) NOT NULL,
  `cat_id` mediumint(8) NOT NULL DEFAULT '0',
  `report_status` tinyint(1) NOT NULL DEFAULT '0',
  `report_date` int(11) NOT NULL DEFAULT '0',
  `report_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `report_update_user` mediumint(8) DEFAULT NULL,
  `report_update_time` int(11) DEFAULT NULL,
  `report_info` varchar(100) NOT NULL,
  `report_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreport_cat`
--

CREATE TABLE `nuke_bbreport_cat` (
  `cat_id` mediumint(8) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_type` tinyint(1) NOT NULL DEFAULT '0',
  `cat_auth` tinyint(1) NOT NULL DEFAULT '0',
  `cat_explain` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbscores`
--

CREATE TABLE `nuke_bbscores` (
  `game_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `score_game` int(11) NOT NULL DEFAULT '0',
  `score_date` int(11) NOT NULL DEFAULT '0',
  `score_time` int(11) NOT NULL DEFAULT '0',
  `score_set` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_results`
--

CREATE TABLE `nuke_bbsearch_results` (
  `search_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `session_id` varchar(32) NOT NULL,
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordlist`
--

CREATE TABLE `nuke_bbsearch_wordlist` (
  `word_text` varchar(50) NOT NULL,
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word_common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordmatch`
--

CREATE TABLE `nuke_bbsearch_wordmatch` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `word_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `title_match` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions`
--

CREATE TABLE `nuke_bbsessions` (
  `session_id` char(32) NOT NULL,
  `session_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `session_start` int(11) NOT NULL DEFAULT '0',
  `session_time` int(11) NOT NULL DEFAULT '0',
  `session_ip` char(8) NOT NULL DEFAULT '0',
  `session_page` int(11) NOT NULL DEFAULT '0',
  `session_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `session_admin` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions_keys`
--

CREATE TABLE `nuke_bbsessions_keys` (
  `key_id` varchar(32) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `last_ip` varchar(8) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsmilies`
--

CREATE TABLE `nuke_bbsmilies` (
  `smilies_id` smallint(5) UNSIGNED NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  `smile_stat` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes`
--

CREATE TABLE `nuke_bbthemes` (
  `themes_id` mediumint(8) UNSIGNED NOT NULL,
  `template_name` varchar(30) NOT NULL,
  `style_name` varchar(30) NOT NULL,
  `head_stylesheet` varchar(100) DEFAULT NULL,
  `body_background` varchar(100) DEFAULT NULL,
  `body_bgcolor` varchar(6) DEFAULT NULL,
  `body_text` varchar(6) DEFAULT NULL,
  `body_link` varchar(6) DEFAULT NULL,
  `body_vlink` varchar(6) DEFAULT NULL,
  `body_alink` varchar(6) DEFAULT NULL,
  `body_hlink` varchar(6) DEFAULT NULL,
  `tr_color1` varchar(6) DEFAULT NULL,
  `tr_color2` varchar(6) DEFAULT NULL,
  `tr_color3` varchar(6) DEFAULT NULL,
  `tr_class1` varchar(25) DEFAULT NULL,
  `tr_class2` varchar(25) DEFAULT NULL,
  `tr_class3` varchar(25) DEFAULT NULL,
  `th_color1` varchar(6) DEFAULT NULL,
  `th_color2` varchar(6) DEFAULT NULL,
  `th_color3` varchar(6) DEFAULT NULL,
  `th_class1` varchar(25) DEFAULT NULL,
  `th_class2` varchar(25) DEFAULT NULL,
  `th_class3` varchar(25) DEFAULT NULL,
  `td_color1` varchar(6) DEFAULT NULL,
  `td_color2` varchar(6) DEFAULT NULL,
  `td_color3` varchar(6) DEFAULT NULL,
  `td_class1` varchar(25) DEFAULT NULL,
  `td_class2` varchar(25) DEFAULT NULL,
  `td_class3` varchar(25) DEFAULT NULL,
  `fontface1` varchar(50) DEFAULT NULL,
  `fontface2` varchar(50) DEFAULT NULL,
  `fontface3` varchar(50) DEFAULT NULL,
  `fontsize1` tinyint(4) DEFAULT NULL,
  `fontsize2` tinyint(4) DEFAULT NULL,
  `fontsize3` tinyint(4) DEFAULT NULL,
  `fontcolor1` varchar(6) DEFAULT NULL,
  `fontcolor2` varchar(6) DEFAULT NULL,
  `fontcolor3` varchar(6) DEFAULT NULL,
  `span_class1` varchar(25) DEFAULT NULL,
  `span_class2` varchar(25) DEFAULT NULL,
  `span_class3` varchar(25) DEFAULT NULL,
  `img_size_poll` smallint(5) UNSIGNED DEFAULT NULL,
  `img_size_privmsg` smallint(5) UNSIGNED DEFAULT NULL,
  `online_color` varchar(6) DEFAULT NULL,
  `offline_color` varchar(6) DEFAULT NULL,
  `hidden_color` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes_name`
--

CREATE TABLE `nuke_bbthemes_name` (
  `themes_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `tr_color1_name` char(50) DEFAULT NULL,
  `tr_color2_name` char(50) DEFAULT NULL,
  `tr_color3_name` char(50) DEFAULT NULL,
  `tr_class1_name` char(50) DEFAULT NULL,
  `tr_class2_name` char(50) DEFAULT NULL,
  `tr_class3_name` char(50) DEFAULT NULL,
  `th_color1_name` char(50) DEFAULT NULL,
  `th_color2_name` char(50) DEFAULT NULL,
  `th_color3_name` char(50) DEFAULT NULL,
  `th_class1_name` char(50) DEFAULT NULL,
  `th_class2_name` char(50) DEFAULT NULL,
  `th_class3_name` char(50) DEFAULT NULL,
  `td_color1_name` char(50) DEFAULT NULL,
  `td_color2_name` char(50) DEFAULT NULL,
  `td_color3_name` char(50) DEFAULT NULL,
  `td_class1_name` char(50) DEFAULT NULL,
  `td_class2_name` char(50) DEFAULT NULL,
  `td_class3_name` char(50) DEFAULT NULL,
  `fontface1_name` char(50) DEFAULT NULL,
  `fontface2_name` char(50) DEFAULT NULL,
  `fontface3_name` char(50) DEFAULT NULL,
  `fontsize1_name` char(50) DEFAULT NULL,
  `fontsize2_name` char(50) DEFAULT NULL,
  `fontsize3_name` char(50) DEFAULT NULL,
  `fontcolor1_name` char(50) DEFAULT NULL,
  `fontcolor2_name` char(50) DEFAULT NULL,
  `fontcolor3_name` char(50) DEFAULT NULL,
  `span_class1_name` char(50) DEFAULT NULL,
  `span_class2_name` char(50) DEFAULT NULL,
  `span_class3_name` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthread_kicker`
--

CREATE TABLE `nuke_bbthread_kicker` (
  `kick_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `kicker` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `kick_time` int(11) NOT NULL DEFAULT '0',
  `kicker_status` int(2) NOT NULL DEFAULT '0',
  `kicker_username` varchar(30) NOT NULL,
  `kicked_username` varchar(30) NOT NULL,
  `topic_title` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics`
--

CREATE TABLE `nuke_bbtopics` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL,
  `forum_id` smallint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_title` char(60) NOT NULL,
  `topic_poster` mediumint(8) NOT NULL DEFAULT '0',
  `topic_time` int(11) NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_replies` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_vote` tinyint(1) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `topic_attribute` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics_watch`
--

CREATE TABLE `nuke_bbtopics_watch` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbuser_group`
--

CREATE TABLE `nuke_bbuser_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_desc`
--

CREATE TABLE `nuke_bbvote_desc` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT '0',
  `vote_length` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_results`
--

CREATE TABLE `nuke_bbvote_results` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `vote_option_id` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `vote_option_text` varchar(255) NOT NULL,
  `vote_result` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_voters`
--

CREATE TABLE `nuke_bbvote_voters` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `vote_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `vote_user_ip` char(8) NOT NULL,
  `vote_cast` tinyint(4) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbwords`
--

CREATE TABLE `nuke_bbwords` (
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word` char(100) NOT NULL,
  `replacement` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbwpm`
--

CREATE TABLE `nuke_bbwpm` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blocks`
--

CREATE TABLE `nuke_blocks` (
  `bid` int(10) NOT NULL,
  `bkey` varchar(15) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL,
  `bposition` char(1) NOT NULL,
  `weight` int(10) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '1',
  `refresh` int(10) NOT NULL DEFAULT '0',
  `time` varchar(14) NOT NULL DEFAULT '0',
  `blanguage` varchar(30) NOT NULL,
  `blockfile` varchar(255) NOT NULL,
  `view` int(1) NOT NULL DEFAULT '0',
  `groups` text NOT NULL,
  `expire` varchar(14) NOT NULL DEFAULT '0',
  `action` char(1) NOT NULL,
  `subscription` int(1) NOT NULL DEFAULT '0',
  `display` varchar(255) NOT NULL DEFAULT 'All'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_alerts`
--

CREATE TABLE `nuke_blog_alerts` (
  `alert_id` int(11) NOT NULL,
  `blog_id` mediumint(13) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(25) NOT NULL,
  `alert_date` date NOT NULL DEFAULT '0000-00-00',
  `alert_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_badwords`
--

CREATE TABLE `nuke_blog_badwords` (
  `word_id` int(11) NOT NULL,
  `word_bad` varchar(48) NOT NULL,
  `word_good` varchar(48) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_blogs`
--

CREATE TABLE `nuke_blog_blogs` (
  `blog_id` mediumint(13) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_title` varchar(255) NOT NULL,
  `blog_body` text NOT NULL,
  `blog_mood` int(11) NOT NULL DEFAULT '0',
  `blog_date` date NOT NULL DEFAULT '0000-00-00',
  `blog_update` date NOT NULL DEFAULT '0000-00-00',
  `blog_status` tinyint(1) NOT NULL DEFAULT '1',
  `blog_comments` tinyint(1) NOT NULL DEFAULT '1',
  `blog_views` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_comments`
--

CREATE TABLE `nuke_blog_comments` (
  `comm_id` mediumint(13) NOT NULL,
  `blog_id` mediumint(13) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `comm_body` text NOT NULL,
  `comm_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_config`
--

CREATE TABLE `nuke_blog_config` (
  `config_key` varchar(24) NOT NULL,
  `config_value` text NOT NULL,
  `config_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_friends`
--

CREATE TABLE `nuke_blog_friends` (
  `friend_id` mediumint(14) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `friend_uid` int(11) NOT NULL DEFAULT '0',
  `friend_username` varchar(25) NOT NULL,
  `friend_added` date NOT NULL DEFAULT '0000-00-00',
  `friend_visit` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_messages`
--

CREATE TABLE `nuke_blog_messages` (
  `mess_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` mediumint(14) NOT NULL DEFAULT '0',
  `blog_title` varchar(255) NOT NULL,
  `blog_date` date NOT NULL DEFAULT '0000-00-00',
  `aid` varchar(48) NOT NULL,
  `mess_date` date NOT NULL DEFAULT '0000-00-00',
  `mess_body` text NOT NULL,
  `mess_read` tinyint(1) NOT NULL DEFAULT '0',
  `mess_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_moods`
--

CREATE TABLE `nuke_blog_moods` (
  `mood_id` int(11) NOT NULL,
  `mood_title` varchar(128) NOT NULL,
  `mood_image` varchar(24) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blog_users`
--

CREATE TABLE `nuke_blog_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `user_last` date NOT NULL DEFAULT '0000-00-00',
  `user_blogs` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_comments`
--

CREATE TABLE `nuke_comments` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL,
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_config`
--

CREATE TABLE `nuke_config` (
  `sitename` varchar(255) NOT NULL,
  `nukeurl` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `startdate` varchar(50) NOT NULL,
  `adminmail` varchar(255) NOT NULL,
  `anonpost` tinyint(1) NOT NULL DEFAULT '0',
  `Default_Theme` varchar(255) NOT NULL,
  `foot1` text NOT NULL,
  `foot2` text NOT NULL,
  `foot3` text NOT NULL,
  `commentlimit` int(9) NOT NULL DEFAULT '4096',
  `anonymous` varchar(255) NOT NULL,
  `minpass` tinyint(1) NOT NULL DEFAULT '5',
  `pollcomm` tinyint(1) NOT NULL DEFAULT '1',
  `articlecomm` tinyint(1) NOT NULL DEFAULT '1',
  `broadcast_msg` tinyint(1) NOT NULL DEFAULT '1',
  `my_headlines` tinyint(1) NOT NULL DEFAULT '1',
  `top` int(3) NOT NULL DEFAULT '10',
  `storyhome` int(2) NOT NULL DEFAULT '10',
  `user_news` tinyint(1) NOT NULL DEFAULT '1',
  `oldnum` int(2) NOT NULL DEFAULT '30',
  `ultramode` tinyint(1) NOT NULL DEFAULT '0',
  `banners` tinyint(1) NOT NULL DEFAULT '1',
  `adb_chk` tinyint(1) NOT NULL DEFAULT '0',
  `backend_title` varchar(255) NOT NULL,
  `backend_language` varchar(10) NOT NULL,
  `language` varchar(100) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `multilingual` tinyint(1) NOT NULL DEFAULT '0',
  `useflags` tinyint(1) NOT NULL DEFAULT '1',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `notify_email` varchar(255) NOT NULL,
  `notify_subject` varchar(255) NOT NULL,
  `notify_message` varchar(255) NOT NULL,
  `notify_from` varchar(255) NOT NULL,
  `moderate` tinyint(1) NOT NULL DEFAULT '0',
  `admingraphic` tinyint(1) NOT NULL DEFAULT '1',
  `httpref` tinyint(1) NOT NULL DEFAULT '1',
  `httprefmax` int(5) NOT NULL DEFAULT '1000',
  `CensorMode` tinyint(1) NOT NULL DEFAULT '3',
  `CensorReplace` varchar(10) NOT NULL,
  `copyright` text NOT NULL,
  `Version_Num` varchar(14) NOT NULL,
  `displayerror` tinyint(1) NOT NULL DEFAULT '0',
  `admin_pos` tinyint(4) NOT NULL DEFAULT '1',
  `login_bar` int(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_counter`
--

CREATE TABLE `nuke_counter` (
  `type` varchar(80) NOT NULL DEFAULT '',
  `var` varchar(80) NOT NULL DEFAULT '',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_albums`
--

CREATE TABLE `nuke_cpg_albums` (
  `aid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT '0',
  `uploads` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `comments` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `votes` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `pos` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `pic_count` int(11) NOT NULL DEFAULT '0',
  `thumb` int(11) NOT NULL DEFAULT '0',
  `last_addition` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stat_uptodate` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_categories`
--

CREATE TABLE `nuke_cpg_categories` (
  `cid` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `catname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `subcat_count` int(11) NOT NULL DEFAULT '0',
  `alb_count` int(11) NOT NULL DEFAULT '0',
  `pic_count` int(11) NOT NULL DEFAULT '0',
  `stat_uptodate` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_comments`
--

CREATE TABLE `nuke_cpg_comments` (
  `pid` mediumint(10) NOT NULL DEFAULT '0',
  `msg_id` mediumint(10) NOT NULL,
  `msg_author` varchar(25) NOT NULL,
  `msg_body` text NOT NULL,
  `msg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `author_md5_id` varchar(32) NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `msg_raw_ip` tinytext,
  `msg_hdr_ip` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_config`
--

CREATE TABLE `nuke_cpg_config` (
  `name` varchar(40) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_exif`
--

CREATE TABLE `nuke_cpg_exif` (
  `filename` varchar(255) NOT NULL,
  `exifData` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_installs`
--

CREATE TABLE `nuke_cpg_installs` (
  `cpg_id` tinyint(3) NOT NULL,
  `dirname` varchar(20) NOT NULL,
  `prefix` varchar(20) NOT NULL,
  `version` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_pictures`
--

CREATE TABLE `nuke_cpg_pictures` (
  `pid` int(11) NOT NULL,
  `aid` int(11) NOT NULL DEFAULT '0',
  `filepath` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `total_filesize` int(11) NOT NULL DEFAULT '0',
  `pwidth` smallint(6) NOT NULL DEFAULT '0',
  `pheight` smallint(6) NOT NULL DEFAULT '0',
  `hits` int(10) NOT NULL DEFAULT '0',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `owner_name` varchar(40) NOT NULL DEFAULT '',
  `pic_rating` int(11) NOT NULL DEFAULT '0',
  `votes` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `caption` text NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `approved` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `user1` varchar(255) NOT NULL DEFAULT '',
  `user2` varchar(255) NOT NULL DEFAULT '',
  `user3` varchar(255) NOT NULL DEFAULT '',
  `user4` varchar(255) NOT NULL DEFAULT '',
  `url_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `randpos` int(11) NOT NULL DEFAULT '0',
  `pic_raw_ip` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pic_hdr_ip` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_usergroups`
--

CREATE TABLE `nuke_cpg_usergroups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_quota` int(11) NOT NULL DEFAULT '0',
  `has_admin_access` tinyint(4) NOT NULL DEFAULT '0',
  `can_rate_pictures` tinyint(4) NOT NULL DEFAULT '0',
  `can_send_ecards` tinyint(4) NOT NULL DEFAULT '0',
  `can_post_comments` tinyint(4) NOT NULL DEFAULT '0',
  `can_upload_pictures` tinyint(4) NOT NULL DEFAULT '0',
  `can_create_albums` tinyint(4) NOT NULL DEFAULT '0',
  `pub_upl_need_approval` tinyint(4) NOT NULL DEFAULT '1',
  `priv_upl_need_approval` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cpg_votes`
--

CREATE TABLE `nuke_cpg_votes` (
  `pic_id` mediumint(9) NOT NULL DEFAULT '0',
  `user_md5_id` varchar(32) NOT NULL,
  `vote_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_credits`
--

CREATE TABLE `nuke_credits` (
  `credit_id` int(11) NOT NULL,
  `credit_name` varchar(60) DEFAULT NULL,
  `credit_author` varchar(20) DEFAULT NULL,
  `credit_link` varchar(30) DEFAULT NULL,
  `credit_description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_czuser`
--

CREATE TABLE `nuke_czuser` (
  `id` int(9) NOT NULL,
  `show_lost_pw` varchar(10) NOT NULL,
  `show_online_total` varchar(10) NOT NULL,
  `show_pm` varchar(10) NOT NULL,
  `waiting` varchar(10) NOT NULL,
  `user_gc` varchar(10) NOT NULL,
  `groups` varchar(10) NOT NULL,
  `posts` varchar(10) NOT NULL,
  `avatars` varchar(10) NOT NULL,
  `bbranks` varchar(10) NOT NULL,
  `showmost` varchar(10) NOT NULL,
  `showstaffonline` varchar(10) NOT NULL,
  `show_hits` varchar(10) NOT NULL,
  `show_ip` varchar(10) NOT NULL,
  `shortnames` varchar(10) NOT NULL,
  `tooltip` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_czuser_botlist`
--

CREATE TABLE `nuke_czuser_botlist` (
  `bot_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `bot_ip` varchar(15) NOT NULL,
  `bot_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_czuser_conf`
--

CREATE TABLE `nuke_czuser_conf` (
  `user_ip` varchar(24) NOT NULL,
  `pms` varchar(24) NOT NULL,
  `spoint` varchar(24) NOT NULL,
  `user_posts` varchar(24) NOT NULL,
  `avatar` varchar(24) NOT NULL,
  `bbranks` varchar(24) NOT NULL,
  `most` varchar(24) NOT NULL,
  `hits` varchar(24) NOT NULL,
  `groups` varchar(24) NOT NULL,
  `tooltip` varchar(24) NOT NULL,
  `online` varchar(24) NOT NULL,
  `guests` varchar(24) NOT NULL,
  `chopped` varchar(24) NOT NULL,
  `pick` varchar(24) NOT NULL,
  `ordermode` varchar(24) NOT NULL,
  `charnum` varchar(24) NOT NULL,
  `davatar` varchar(24) NOT NULL,
  `duser` varchar(24) NOT NULL,
  `demail` varchar(24) NOT NULL,
  `dreg` varchar(24) NOT NULL,
  `dgender` varchar(24) NOT NULL,
  `dpost` varchar(24) NOT NULL,
  `dtheme` varchar(24) NOT NULL,
  `dwhere` varchar(24) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_czuser_info`
--

CREATE TABLE `nuke_czuser_info` (
  `pic` varchar(40) NOT NULL,
  `view` varchar(40) NOT NULL,
  `king` tinyint(2) NOT NULL DEFAULT '0',
  `gname` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_czuser_mostonline`
--

CREATE TABLE `nuke_czuser_mostonline` (
  `total` int(10) NOT NULL DEFAULT '0',
  `members` int(10) NOT NULL DEFAULT '0',
  `spiders` int(10) NOT NULL DEFAULT '0',
  `nonmembers` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_dfw_block_img`
--

CREATE TABLE `nuke_dfw_block_img` (
  `welc_note` varchar(255) NOT NULL DEFAULT '',
  `your_ip` varchar(255) NOT NULL DEFAULT '',
  `posts` varchar(255) NOT NULL DEFAULT '',
  `logout` varchar(255) NOT NULL DEFAULT '',
  `pm_img` varchar(255) NOT NULL DEFAULT '',
  `pm_unread` varchar(255) NOT NULL DEFAULT '',
  `pm_read` varchar(255) NOT NULL DEFAULT '',
  `mbr_stats` varchar(255) NOT NULL DEFAULT '',
  `mbr_latest` varchar(255) NOT NULL DEFAULT '',
  `mbr_today` varchar(255) NOT NULL DEFAULT '',
  `mbr_yesterday` varchar(255) NOT NULL DEFAULT '',
  `mbr_waiting` varchar(255) NOT NULL DEFAULT '',
  `mbr_overall` varchar(255) NOT NULL DEFAULT '',
  `bbgroups` varchar(255) NOT NULL DEFAULT '',
  `nsngroups` varchar(255) NOT NULL DEFAULT '',
  `online_member` varchar(255) NOT NULL DEFAULT '',
  `online_guest` varchar(255) NOT NULL DEFAULT '',
  `sub_img` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_dfw_cfg`
--

CREATE TABLE `nuke_dfw_cfg` (
  `cfg_nm` varchar(255) NOT NULL DEFAULT '',
  `cfg_val` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_dfw_code`
--

CREATE TABLE `nuke_dfw_code` (
  `id` mediumint(8) NOT NULL,
  `title` char(20) NOT NULL,
  `code` text,
  `desc` varchar(100) DEFAULT '',
  `lang` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_dfw_img`
--

CREATE TABLE `nuke_dfw_img` (
  `pic` varchar(40) NOT NULL DEFAULT '',
  `view` varchar(40) NOT NULL DEFAULT '',
  `king` tinyint(2) NOT NULL DEFAULT '0',
  `gname` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_dfw_tooltip_img`
--

CREATE TABLE `nuke_dfw_tooltip_img` (
  `tipimage_username` varchar(255) NOT NULL DEFAULT '',
  `tipimage_email` varchar(255) NOT NULL DEFAULT '',
  `tipimage_regdate` varchar(255) NOT NULL DEFAULT '',
  `tipimage_group` varchar(255) NOT NULL DEFAULT '',
  `tipimage_posts` varchar(255) NOT NULL DEFAULT '',
  `tipimage_theme` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_don_config`
--

CREATE TABLE `nuke_don_config` (
  `name` varchar(25) NOT NULL DEFAULT '',
  `subtype` varchar(20) NOT NULL DEFAULT '',
  `value` varchar(200) NOT NULL DEFAULT '0',
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_don_financial`
--

CREATE TABLE `nuke_don_financial` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `num` varchar(16) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `descr` varchar(128) NOT NULL DEFAULT '',
  `amount` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_don_transactions`
--

CREATE TABLE `nuke_don_transactions` (
  `id` int(8) UNSIGNED NOT NULL,
  `business` varchar(50) NOT NULL DEFAULT '',
  `txn_id` varchar(20) NOT NULL DEFAULT '',
  `item_name` varchar(60) NOT NULL DEFAULT '',
  `item_number` varchar(40) NOT NULL DEFAULT '',
  `quantity` varchar(6) NOT NULL DEFAULT '',
  `invoice` varchar(40) NOT NULL DEFAULT '',
  `custom` varchar(127) NOT NULL DEFAULT '',
  `tax` varchar(10) NOT NULL DEFAULT '',
  `option_name1` varchar(60) NOT NULL DEFAULT '',
  `option_selection1` varchar(127) NOT NULL DEFAULT '',
  `option_name2` varchar(60) NOT NULL DEFAULT '',
  `option_selection2` varchar(127) NOT NULL DEFAULT '',
  `memo` text NOT NULL,
  `payment_status` varchar(15) NOT NULL DEFAULT '',
  `payment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `txn_type` varchar(15) NOT NULL DEFAULT '',
  `mc_gross` varchar(10) NOT NULL DEFAULT '',
  `mc_fee` varchar(10) NOT NULL DEFAULT '',
  `mc_currency` varchar(5) NOT NULL DEFAULT '',
  `settle_amount` varchar(12) NOT NULL DEFAULT '',
  `exchange_rate` varchar(10) NOT NULL DEFAULT '',
  `first_name` varchar(127) NOT NULL DEFAULT '',
  `last_name` varchar(127) NOT NULL DEFAULT '',
  `address_street` varchar(127) NOT NULL DEFAULT '',
  `address_city` varchar(127) NOT NULL DEFAULT '',
  `address_state` varchar(127) NOT NULL DEFAULT '',
  `address_zip` varchar(20) NOT NULL DEFAULT '',
  `address_country` varchar(127) NOT NULL DEFAULT '',
  `address_status` varchar(15) NOT NULL DEFAULT '',
  `payer_email` varchar(127) NOT NULL DEFAULT '',
  `payer_status` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_don_translog`
--

CREATE TABLE `nuke_don_translog` (
  `id` int(11) NOT NULL,
  `log_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `payment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logentry` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_categories`
--

CREATE TABLE `nuke_downloads_categories` (
  `cid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `ns_cat_note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_downloads`
--

CREATE TABLE `nuke_downloads_downloads` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `downloadratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `homepage` varchar(200) NOT NULL,
  `ns_compat` varchar(30) NOT NULL,
  `ns_des_img` varchar(100) NOT NULL,
  `ns_disable` tinyint(1) NOT NULL DEFAULT '0',
  `ns_mirror_one` varchar(255) NOT NULL,
  `ns_mirror_two` varchar(255) NOT NULL,
  `ns_dl_down_note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_editorials`
--

CREATE TABLE `nuke_downloads_editorials` (
  `downloadid` int(11) NOT NULL DEFAULT '0',
  `adminid` varchar(60) NOT NULL,
  `editorialtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_modrequest`
--

CREATE TABLE `nuke_downloads_modrequest` (
  `requestid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL,
  `brokendownload` int(3) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `homepage` varchar(200) NOT NULL,
  `ns_compat` varchar(30) NOT NULL,
  `ns_des_img` varchar(100) NOT NULL,
  `ns_mirror_one` varchar(255) NOT NULL,
  `ns_mirror_two` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_newdownload`
--

CREATE TABLE `nuke_downloads_newdownload` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `submitter` varchar(60) NOT NULL,
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `homepage` varchar(200) NOT NULL,
  `ns_compat` varchar(30) NOT NULL,
  `ns_des_img` varchar(100) NOT NULL,
  `ns_mirror_one` varchar(255) NOT NULL,
  `ns_mirror_two` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_downloads_votedata`
--

CREATE TABLE `nuke_downloads_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL,
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqanswer`
--

CREATE TABLE `nuke_faqanswer` (
  `id` tinyint(4) NOT NULL,
  `id_cat` tinyint(4) NOT NULL DEFAULT '0',
  `question` varchar(255) DEFAULT NULL,
  `answer` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqcategories`
--

CREATE TABLE `nuke_faqcategories` (
  `id_cat` tinyint(3) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `flanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_fga_config`
--

CREATE TABLE `nuke_fga_config` (
  `glance_enable` varchar(1) NOT NULL DEFAULT '2',
  `glance_news_forum_id` varchar(255) NOT NULL,
  `glance_num_news` varchar(255) NOT NULL,
  `glance_num_recent` varchar(255) NOT NULL,
  `glance_recent_ignore` varchar(255) NOT NULL,
  `glance_news_heading` varchar(255) NOT NULL,
  `glance_recent_heading` varchar(255) NOT NULL,
  `glance_show_new_bullets` varchar(10) NOT NULL,
  `glance_track` varchar(255) NOT NULL,
  `glance_auth_read` varchar(255) NOT NULL,
  `glance_topic_length` varchar(255) NOT NULL,
  `glance_direct_latest` varchar(255) NOT NULL,
  `glance_version` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_forum_message`
--

CREATE TABLE `nuke_forum_message` (
  `mid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL,
  `expire` int(7) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `view` int(1) NOT NULL DEFAULT '1',
  `mlanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_category`
--

CREATE TABLE `nuke_gcal_category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_cat_group`
--

CREATE TABLE `nuke_gcal_cat_group` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_config`
--

CREATE TABLE `nuke_gcal_config` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL DEFAULT 'Calendar of Events',
  `image` varchar(255) NOT NULL,
  `min_year` int(10) UNSIGNED NOT NULL DEFAULT '2006',
  `max_year` int(10) UNSIGNED NOT NULL DEFAULT '2037',
  `user_submit` enum('off','members','anyone','groups') NOT NULL DEFAULT 'off',
  `req_approval` tinyint(1) NOT NULL DEFAULT '1',
  `allowed_tags` text NOT NULL,
  `allowed_attrs` text NOT NULL,
  `version` varchar(16) NOT NULL,
  `time_in_24` tinyint(1) NOT NULL DEFAULT '0',
  `short_date_format` varchar(16) NOT NULL,
  `reg_date_format` varchar(16) NOT NULL,
  `long_date_format` varchar(16) NOT NULL,
  `first_day_of_week` tinyint(1) NOT NULL DEFAULT '0',
  `auto_link` tinyint(1) NOT NULL DEFAULT '0',
  `location_required` tinyint(1) NOT NULL DEFAULT '0',
  `details_required` tinyint(1) NOT NULL DEFAULT '0',
  `email_notify` tinyint(1) NOT NULL DEFAULT '0',
  `email_to` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_msg` varchar(255) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `show_cat_legend` tinyint(1) NOT NULL DEFAULT '1',
  `wysiwyg` tinyint(1) NOT NULL DEFAULT '0',
  `user_update` tinyint(1) NOT NULL DEFAULT '0',
  `weekends` set('0','1','2','3','4','5','6') NOT NULL DEFAULT '0,6',
  `rsvp` enum('off','on','email') NOT NULL DEFAULT 'off',
  `rsvp_email_subject` varchar(255) NOT NULL DEFAULT 'Event RSVP Notification',
  `groups_submit` text NOT NULL,
  `groups_no_approval` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_event`
--

CREATE TABLE `nuke_gcal_event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `no_time` tinyint(1) NOT NULL DEFAULT '1',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `location` text NOT NULL,
  `category` int(11) NOT NULL,
  `repeat_type` enum('none','daily','weekly','monthly','yearly') NOT NULL DEFAULT 'none',
  `details` text NOT NULL,
  `interval_val` int(11) NOT NULL,
  `no_end_date` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `weekly_days` set('0','1','2','3','4','5','6') NOT NULL,
  `monthly_by_day` tinyint(1) NOT NULL,
  `submitted_by` varchar(25) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `rsvp` enum('off','on','email') NOT NULL DEFAULT 'off'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_exception`
--

CREATE TABLE `nuke_gcal_exception` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_gcal_rsvp`
--

CREATE TABLE `nuke_gcal_rsvp` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_google_bot_detector`
--

CREATE TABLE `nuke_google_bot_detector` (
  `detect_id` int(8) NOT NULL,
  `detect_time` int(11) NOT NULL DEFAULT '0',
  `detect_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_groups`
--

CREATE TABLE `nuke_groups` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `points` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_groups_points`
--

CREATE TABLE `nuke_groups_points` (
  `id` int(10) NOT NULL,
  `points` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_headlines`
--

CREATE TABLE `nuke_headlines` (
  `hid` int(11) NOT NULL,
  `sitename` varchar(30) NOT NULL,
  `headlinesurl` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_categories`
--

CREATE TABLE `nuke_hnl_categories` (
  `cid` int(11) NOT NULL,
  `ctitle` varchar(50) NOT NULL,
  `cdescription` text NOT NULL,
  `cblocklimit` int(4) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_cfg`
--

CREATE TABLE `nuke_hnl_cfg` (
  `cfg_nm` varchar(255) NOT NULL,
  `cfg_val` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_newsletters`
--

CREATE TABLE `nuke_hnl_newsletters` (
  `nid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '1',
  `topic` varchar(100) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `filename` varchar(32) NOT NULL,
  `datesent` date DEFAULT NULL,
  `view` int(1) NOT NULL DEFAULT '0',
  `groups` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_honeypot`
--

CREATE TABLE `nuke_honeypot` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `realname` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `potnum` varchar(1) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_journal`
--

CREATE TABLE `nuke_journal` (
  `jid` int(11) NOT NULL,
  `aid` varchar(30) NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `bodytext` text NOT NULL,
  `mood` varchar(48) NOT NULL,
  `pdate` varchar(48) NOT NULL,
  `ptime` varchar(48) NOT NULL,
  `status` varchar(48) NOT NULL,
  `mtime` varchar(48) NOT NULL,
  `mdate` varchar(48) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_journal_comments`
--

CREATE TABLE `nuke_journal_comments` (
  `cid` int(11) NOT NULL,
  `rid` varchar(48) NOT NULL,
  `aid` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `pdate` varchar(48) NOT NULL,
  `ptime` varchar(48) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_journal_stats`
--

CREATE TABLE `nuke_journal_stats` (
  `id` int(11) NOT NULL,
  `joid` varchar(48) NOT NULL,
  `nop` varchar(48) NOT NULL,
  `ldp` varchar(24) NOT NULL,
  `ltp` varchar(24) NOT NULL,
  `micro` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_lastseen`
--

CREATE TABLE `nuke_lastseen` (
  `id` int(15) NOT NULL,
  `username` text NOT NULL,
  `date` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_legal_cfg`
--

CREATE TABLE `nuke_legal_cfg` (
  `contact_email` varchar(255) NOT NULL DEFAULT 'legal@MySite.com',
  `contact_subject` varchar(255) NOT NULL DEFAULT 'Legal Notice Inquiry',
  `country` varchar(255) NOT NULL DEFAULT 'United States of America'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_legal_docs`
--

CREATE TABLE `nuke_legal_docs` (
  `did` int(11) NOT NULL,
  `doc_name` varchar(32) NOT NULL,
  `doc_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_legal_text`
--

CREATE TABLE `nuke_legal_text` (
  `tid` int(11) NOT NULL,
  `doc_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_legal_text_map`
--

CREATE TABLE `nuke_legal_text_map` (
  `mid` mediumint(9) NOT NULL,
  `did` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `language` varchar(32) NOT NULL DEFAULT 'english'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_categories`
--

CREATE TABLE `nuke_links_categories` (
  `cid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_editorials`
--

CREATE TABLE `nuke_links_editorials` (
  `linkid` int(11) NOT NULL DEFAULT '0',
  `adminid` varchar(60) NOT NULL,
  `editorialtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_links`
--

CREATE TABLE `nuke_links_links` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `linkratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_modrequest`
--

CREATE TABLE `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL,
  `brokenlink` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_newlink`
--

CREATE TABLE `nuke_links_newlink` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `submitter` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_votedata`
--

CREATE TABLE `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL,
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us`
--

CREATE TABLE `nuke_link_us` (
  `id` int(255) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `site_image` varchar(255) NOT NULL,
  `site_description` varchar(255) NOT NULL,
  `site_hits` varchar(255) NOT NULL,
  `site_status` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `button_type` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us_config`
--

CREATE TABLE `nuke_link_us_config` (
  `my_image` varchar(255) NOT NULL,
  `fade_effect` varchar(15) NOT NULL,
  `marquee` varchar(15) NOT NULL,
  `marquee_direction` varchar(15) NOT NULL,
  `marquee_scroll` varchar(15) NOT NULL,
  `block_height` varchar(15) NOT NULL,
  `show_clicks` varchar(15) NOT NULL,
  `button_seperate` varchar(15) NOT NULL,
  `user_submit` varchar(15) NOT NULL,
  `button_method` varchar(15) NOT NULL,
  `button_height` varchar(15) NOT NULL,
  `button_width` varchar(15) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `button_standard` varchar(15) NOT NULL,
  `button_banner` varchar(15) NOT NULL,
  `button_resource` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_mail_config`
--

CREATE TABLE `nuke_mail_config` (
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `mailer` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_host` varchar(255) NOT NULL DEFAULT '',
  `smtp_helo` varchar(255) NOT NULL DEFAULT '',
  `smtp_port` int(10) NOT NULL DEFAULT '25',
  `smtp_auth` tinyint(1) NOT NULL DEFAULT '0',
  `smtp_uname` varchar(255) NOT NULL DEFAULT '',
  `smtp_passw` varchar(255) NOT NULL DEFAULT '',
  `sendmail_path` varchar(255) NOT NULL DEFAULT '/usr/sbin/sendmail',
  `smtp_encrypt` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_encrypt_method` tinyint(4) NOT NULL DEFAULT '0',
  `reply_to` varchar(255) NOT NULL,
  `debug_level` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_main`
--

CREATE TABLE `nuke_main` (
  `main_module` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_MA_mapcfg`
--

CREATE TABLE `nuke_MA_mapcfg` (
  `keyfld` int(11) NOT NULL,
  `apptxt` longtext NOT NULL,
  `admaddr` text NOT NULL,
  `emdetail` tinyint(1) NOT NULL DEFAULT '0',
  `fpdetail` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` smallint(5) NOT NULL DEFAULT '0',
  `tytxt` longtext NOT NULL,
  `noapptxt` longtext NOT NULL,
  `appson` tinyint(1) NOT NULL DEFAULT '1',
  `current` tinyint(1) NOT NULL DEFAULT '0',
  `formtitle` varchar(64) NOT NULL DEFAULT '',
  `appslimit` tinyint(1) NOT NULL DEFAULT '0',
  `appslimitno` int(11) NOT NULL DEFAULT '0',
  `appsfull` tinyint(1) NOT NULL DEFAULT '0',
  `group_add` mediumint(8) NOT NULL DEFAULT '0',
  `block_multi_apps` tinyint(1) NOT NULL DEFAULT '1',
  `email_admin` tinyint(1) NOT NULL DEFAULT '1',
  `mailgroup` tinyint(1) NOT NULL DEFAULT '0',
  `topicwatch` tinyint(1) NOT NULL DEFAULT '0',
  `emuser` tinyint(1) NOT NULL DEFAULT '0',
  `formno` int(11) NOT NULL DEFAULT '0',
  `annon` tinyint(1) NOT NULL DEFAULT '0',
  `VertAlign` tinyint(1) NOT NULL DEFAULT '0',
  `auto_group` tinyint(1) NOT NULL DEFAULT '0',
  `approvtxt` longtext NOT NULL,
  `denytxt` longtext NOT NULL,
  `formlist` tinyint(1) NOT NULL DEFAULT '0',
  `compat` tinyint(1) NOT NULL DEFAULT '0',
  `emhtml` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_MA_mapp`
--

CREATE TABLE `nuke_MA_mapp` (
  `fldnum` int(10) UNSIGNED NOT NULL,
  `fldord` int(11) NOT NULL DEFAULT '0',
  `fldname` text NOT NULL,
  `requrd` char(1) NOT NULL DEFAULT '',
  `inuse` char(1) NOT NULL DEFAULT '',
  `format` char(1) NOT NULL DEFAULT '',
  `parent` smallint(6) NOT NULL DEFAULT '0',
  `isdel` tinyint(1) NOT NULL DEFAULT '0',
  `formno` int(11) NOT NULL DEFAULT '0',
  `rgextxt` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_MA_mappresp`
--

CREATE TABLE `nuke_MA_mappresp` (
  `recno` bigint(11) NOT NULL,
  `appnum` bigint(20) NOT NULL DEFAULT '0',
  `userno` bigint(20) NOT NULL DEFAULT '0',
  `qno` bigint(20) NOT NULL DEFAULT '0',
  `response` longtext NOT NULL,
  `adate` text NOT NULL,
  `formno` int(11) NOT NULL DEFAULT '0',
  `appstatus` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu`
--

CREATE TABLE `nuke_menu` (
  `mid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `weight` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu_cat`
--

CREATE TABLE `nuke_menu_cat` (
  `cid` int(11) NOT NULL,
  `cat` varchar(50) NOT NULL,
  `weight` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_message`
--

CREATE TABLE `nuke_message` (
  `mid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL,
  `expire` int(7) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `view` int(1) NOT NULL DEFAULT '1',
  `groups` text NOT NULL,
  `mlanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules`
--

CREATE TABLE `nuke_modules` (
  `mid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `view` int(1) NOT NULL DEFAULT '0',
  `groups` text NOT NULL,
  `inmenu` tinyint(1) NOT NULL DEFAULT '1',
  `mod_group` int(10) DEFAULT '0',
  `mcid` int(11) NOT NULL DEFAULT '1',
  `admins` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules_categories`
--

CREATE TABLE `nuke_modules_categories` (
  `mcid` int(11) NOT NULL,
  `mcname` varchar(60) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_mostonline`
--

CREATE TABLE `nuke_mostonline` (
  `total` int(10) NOT NULL DEFAULT '0',
  `members` int(10) NOT NULL DEFAULT '0',
  `nonmembers` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_newpages`
--

CREATE TABLE `nuke_newpages` (
  `pid` int(10) NOT NULL,
  `cid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `uname` varchar(40) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `clanguage` varchar(30) NOT NULL DEFAULT 'english'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_news_config`
--

CREATE TABLE `nuke_news_config` (
  `newsrows` int(1) NOT NULL DEFAULT '1',
  `bookmark` int(1) NOT NULL DEFAULT '0',
  `rblocks` int(1) NOT NULL DEFAULT '0',
  `showtags` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnba_banners`
--

CREATE TABLE `nuke_nsnba_banners` (
  `bid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `pid` tinyint(1) NOT NULL DEFAULT '0',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(200) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `alttext` varchar(255) NOT NULL DEFAULT '',
  `code` tinyint(1) NOT NULL DEFAULT '0',
  `flash` tinyint(1) NOT NULL DEFAULT '0',
  `height` int(4) NOT NULL DEFAULT '60',
  `width` int(4) NOT NULL DEFAULT '468',
  `datestr` date NOT NULL DEFAULT '0000-00-00',
  `dateend` date NOT NULL DEFAULT '0000-00-00',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnba_clients`
--

CREATE TABLE `nuke_nsnba_clients` (
  `cid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `login` varchar(25) NOT NULL DEFAULT '',
  `passwd` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnba_config`
--

CREATE TABLE `nuke_nsnba_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnba_placements`
--

CREATE TABLE `nuke_nsnba_placements` (
  `pid` int(11) NOT NULL,
  `title` varchar(60) NOT NULL DEFAULT '',
  `plcdesc` text NOT NULL,
  `imgdis` varchar(200) NOT NULL DEFAULT 'plc-banner.png',
  `max_height` int(4) NOT NULL DEFAULT '60',
  `max_width` int(4) NOT NULL DEFAULT '468',
  `max_size` int(6) NOT NULL DEFAULT '30720',
  `imgban` varchar(200) NOT NULL DEFAULT 'ban-banner.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_blocks`
--

CREATE TABLE `nuke_nsncb_blocks` (
  `rid` tinyint(2) NOT NULL DEFAULT '0',
  `cgid` tinyint(2) NOT NULL DEFAULT '0',
  `cbid` tinyint(2) NOT NULL DEFAULT '0',
  `title` varchar(60) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `wtype` tinyint(1) NOT NULL DEFAULT '0',
  `width` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_config`
--

CREATE TABLE `nuke_nsncb_config` (
  `cgid` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `height` smallint(6) NOT NULL DEFAULT '0',
  `count` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_accesses`
--

CREATE TABLE `nuke_nsngd_accesses` (
  `username` varchar(60) NOT NULL,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `uploads` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_categories`
--

CREATE TABLE `nuke_nsngd_categories` (
  `cid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `whoadd` tinyint(2) NOT NULL DEFAULT '0',
  `uploaddir` varchar(255) NOT NULL,
  `canupload` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_config`
--

CREATE TABLE `nuke_nsngd_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_downloads`
--

CREATE TABLE `nuke_nsngd_downloads` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `sub_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `version` varchar(20) NOT NULL,
  `homepage` varchar(255) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_extensions`
--

CREATE TABLE `nuke_nsngd_extensions` (
  `eid` int(11) NOT NULL,
  `ext` varchar(6) NOT NULL,
  `file` tinyint(1) NOT NULL DEFAULT '0',
  `image` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_mods`
--

CREATE TABLE `nuke_nsngd_mods` (
  `rid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `modifier` varchar(60) NOT NULL,
  `sub_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `brokendownload` int(3) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `version` varchar(20) NOT NULL,
  `homepage` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngd_new`
--

CREATE TABLE `nuke_nsngd_new` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `submitter` varchar(60) NOT NULL,
  `sub_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `version` varchar(20) NOT NULL,
  `homepage` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngr_config`
--

CREATE TABLE `nuke_nsngr_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngr_groups`
--

CREATE TABLE `nuke_nsngr_groups` (
  `gid` int(11) NOT NULL,
  `gname` varchar(32) NOT NULL,
  `gdesc` text NOT NULL,
  `gpublic` tinyint(1) NOT NULL DEFAULT '0',
  `glimit` int(11) NOT NULL DEFAULT '0',
  `phpBB` int(11) NOT NULL DEFAULT '0',
  `muid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsngr_users`
--

CREATE TABLE `nuke_nsngr_users` (
  `gid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `uname` varchar(25) NOT NULL,
  `trial` tinyint(1) NOT NULL DEFAULT '0',
  `notice` tinyint(1) NOT NULL DEFAULT '0',
  `sdate` int(14) NOT NULL DEFAULT '0',
  `edate` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnml_config`
--

CREATE TABLE `nuke_nsnml_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnml_issues`
--

CREATE TABLE `nuke_nsnml_issues` (
  `nid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) DEFAULT NULL,
  `text_plain` mediumtext,
  `text_html` mediumtext,
  `sent` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnml_lists`
--

CREATE TABLE `nuke_nsnml_lists` (
  `lid` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnml_tracked`
--

CREATE TABLE `nuke_nsnml_tracked` (
  `tid` int(11) NOT NULL,
  `mid` int(11) NOT NULL DEFAULT '0',
  `nid` int(11) NOT NULL DEFAULT '0',
  `lid` int(11) NOT NULL DEFAULT '0',
  `sent` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnml_users`
--

CREATE TABLE `nuke_nsnml_users` (
  `mid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '0',
  `html` int(2) NOT NULL DEFAULT '0',
  `act_key` int(11) NOT NULL DEFAULT '0',
  `joined` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_2_config`
--

CREATE TABLE `nuke_nsnsp_2_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_2_sites`
--

CREATE TABLE `nuke_nsnsp_2_sites` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(60) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `site_image` varchar(255) NOT NULL,
  `site_status` int(1) NOT NULL DEFAULT '0',
  `site_hits` int(10) NOT NULL DEFAULT '0',
  `site_date` date NOT NULL DEFAULT '0000-00-00',
  `site_description` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_config`
--

CREATE TABLE `nuke_nsnsp_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_sites`
--

CREATE TABLE `nuke_nsnsp_sites` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(60) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `site_image` varchar(255) NOT NULL,
  `site_status` int(1) NOT NULL DEFAULT '0',
  `site_hits` int(10) NOT NULL DEFAULT '0',
  `site_date` date NOT NULL DEFAULT '0000-00-00',
  `site_description` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_admins`
--

CREATE TABLE `nuke_nsnst_admins` (
  `aid` varchar(25) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `password_md5` varchar(60) NOT NULL,
  `password_crypt` varchar(60) NOT NULL,
  `protected` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ips`
--

CREATE TABLE `nuke_nsnst_blocked_ips` (
  `ip_addr` varchar(15) NOT NULL,
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(60) NOT NULL,
  `user_agent` text NOT NULL,
  `date` int(20) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT '0',
  `query_string` text NOT NULL,
  `get_string` text NOT NULL,
  `post_string` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `remote_addr` varchar(32) NOT NULL,
  `remote_port` varchar(11) NOT NULL,
  `request_method` varchar(10) NOT NULL,
  `expires` int(20) NOT NULL DEFAULT '0',
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ranges`
--

CREATE TABLE `nuke_nsnst_blocked_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT '0',
  `expires` int(20) NOT NULL DEFAULT '0',
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blockers`
--

CREATE TABLE `nuke_nsnst_blockers` (
  `blocker` int(4) NOT NULL DEFAULT '0',
  `block_name` varchar(20) NOT NULL,
  `activate` int(4) NOT NULL DEFAULT '0',
  `block_type` int(4) NOT NULL DEFAULT '0',
  `email_lookup` int(4) NOT NULL DEFAULT '0',
  `forward` varchar(255) NOT NULL,
  `reason` varchar(20) NOT NULL,
  `template` varchar(255) NOT NULL,
  `duration` int(20) NOT NULL DEFAULT '0',
  `htaccess` int(4) NOT NULL DEFAULT '0',
  `list` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_cidrs`
--

CREATE TABLE `nuke_nsnst_cidrs` (
  `cidr` int(2) NOT NULL DEFAULT '0',
  `hosts` int(10) NOT NULL DEFAULT '0',
  `mask` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_config`
--

CREATE TABLE `nuke_nsnst_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_countries`
--

CREATE TABLE `nuke_nsnst_countries` (
  `c2c` char(2) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_excluded_ranges`
--

CREATE TABLE `nuke_nsnst_excluded_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_flood`
--

CREATE TABLE `nuke_nsnst_flood` (
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `lastpost` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_harvesters`
--

CREATE TABLE `nuke_nsnst_harvesters` (
  `hid` int(2) NOT NULL,
  `harvester` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_ip2country`
--

CREATE TABLE `nuke_nsnst_ip2country` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `c2c` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_protected_ranges`
--

CREATE TABLE `nuke_nsnst_protected_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_referers`
--

CREATE TABLE `nuke_nsnst_referers` (
  `rid` int(2) NOT NULL,
  `referer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_strings`
--

CREATE TABLE `nuke_nsnst_strings` (
  `sid` int(2) NOT NULL,
  `string` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_tracked_ips`
--

CREATE TABLE `nuke_nsnst_tracked_ips` (
  `tid` int(10) NOT NULL,
  `ip_addr` varchar(15) NOT NULL DEFAULT '',
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(60) NOT NULL DEFAULT '',
  `user_agent` text NOT NULL,
  `refered_from` text NOT NULL,
  `date` int(20) NOT NULL DEFAULT '0',
  `page` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL DEFAULT '',
  `client_ip` varchar(32) NOT NULL DEFAULT '',
  `remote_addr` varchar(32) NOT NULL DEFAULT '',
  `remote_port` varchar(11) NOT NULL DEFAULT '',
  `request_method` varchar(10) NOT NULL DEFAULT '',
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_config`
--

CREATE TABLE `nuke_nsnwb_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_members`
--

CREATE TABLE `nuke_nsnwb_members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_members_positions`
--

CREATE TABLE `nuke_nsnwb_members_positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `position_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_projects`
--

CREATE TABLE `nuke_nsnwb_projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `priority_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `project_percent` float NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `featured` tinyint(2) NOT NULL DEFAULT '0',
  `date_created` int(14) NOT NULL DEFAULT '0',
  `date_started` int(14) NOT NULL DEFAULT '0',
  `date_finished` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_projects_members`
--

CREATE TABLE `nuke_nsnwb_projects_members` (
  `project_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_projects_priorities`
--

CREATE TABLE `nuke_nsnwb_projects_priorities` (
  `priority_id` int(11) NOT NULL,
  `priority_name` varchar(30) NOT NULL,
  `priority_weight` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_projects_status`
--

CREATE TABLE `nuke_nsnwb_projects_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_tasks`
--

CREATE TABLE `nuke_nsnwb_tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `task_name` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `priority_id` int(11) NOT NULL DEFAULT '1',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `task_percent` float NOT NULL DEFAULT '0',
  `date_created` int(14) NOT NULL DEFAULT '0',
  `date_started` int(14) NOT NULL DEFAULT '0',
  `date_finished` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_tasks_members`
--

CREATE TABLE `nuke_nsnwb_tasks_members` (
  `task_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_tasks_priorities`
--

CREATE TABLE `nuke_nsnwb_tasks_priorities` (
  `priority_id` int(11) NOT NULL,
  `priority_name` varchar(30) NOT NULL,
  `priority_weight` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwb_tasks_status`
--

CREATE TABLE `nuke_nsnwb_tasks_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_config`
--

CREATE TABLE `nuke_nsnwp_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_reports`
--

CREATE TABLE `nuke_nsnwp_reports` (
  `report_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `report_name` varchar(255) NOT NULL,
  `report_description` text NOT NULL,
  `submitter_name` varchar(32) NOT NULL,
  `submitter_email` varchar(255) NOT NULL,
  `submitter_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `date_submitted` int(14) NOT NULL DEFAULT '0',
  `date_commented` int(14) NOT NULL DEFAULT '0',
  `date_modified` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_reports_comments`
--

CREATE TABLE `nuke_nsnwp_reports_comments` (
  `comment_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL DEFAULT '0',
  `commenter_name` varchar(32) NOT NULL,
  `commenter_email` varchar(255) NOT NULL,
  `commenter_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `comment_description` text NOT NULL,
  `date_commented` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_reports_members`
--

CREATE TABLE `nuke_nsnwp_reports_members` (
  `report_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_reports_status`
--

CREATE TABLE `nuke_nsnwp_reports_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwp_reports_types`
--

CREATE TABLE `nuke_nsnwp_reports_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_config`
--

CREATE TABLE `nuke_nsnwr_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_requests`
--

CREATE TABLE `nuke_nsnwr_requests` (
  `request_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `request_name` varchar(255) NOT NULL,
  `request_description` text NOT NULL,
  `submitter_name` varchar(32) NOT NULL,
  `submitter_email` varchar(255) NOT NULL,
  `submitter_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `date_submitted` int(14) NOT NULL DEFAULT '0',
  `date_commented` int(14) NOT NULL DEFAULT '0',
  `date_modified` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_requests_comments`
--

CREATE TABLE `nuke_nsnwr_requests_comments` (
  `comment_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL DEFAULT '0',
  `commenter_name` varchar(32) NOT NULL,
  `commenter_email` varchar(255) NOT NULL,
  `commenter_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `comment_description` text NOT NULL,
  `date_commented` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_requests_members`
--

CREATE TABLE `nuke_nsnwr_requests_members` (
  `request_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_requests_status`
--

CREATE TABLE `nuke_nsnwr_requests_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnwr_requests_types`
--

CREATE TABLE `nuke_nsnwr_requests_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_contact_add`
--

CREATE TABLE `nuke_ns_contact_add` (
  `address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_contact_dept`
--

CREATE TABLE `nuke_ns_contact_dept` (
  `did` int(3) NOT NULL,
  `dept_name` varchar(60) DEFAULT NULL,
  `dept_email` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_contact_phone`
--

CREATE TABLE `nuke_ns_contact_phone` (
  `pid` int(3) NOT NULL,
  `phone_name` varchar(60) DEFAULT NULL,
  `phone_num` varchar(60) DEFAULT NULL,
  `fax_num` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_contact_show`
--

CREATE TABLE `nuke_ns_contact_show` (
  `show_add` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_add_modify`
--

CREATE TABLE `nuke_ns_downloads_add_modify` (
  `ns_dl_add` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_anon_add` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_auto_add` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_allow_html` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_affiliate_links` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_add_email` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_add_filesize` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_add_compat` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_mod` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_mod_anon` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_owner_mod` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_auth`
--

CREATE TABLE `nuke_ns_downloads_auth` (
  `ns_dl_auth_list` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_auth_lim` tinyint(2) NOT NULL DEFAULT '0',
  `ns_dl_auth_pp` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_blocks`
--

CREATE TABLE `nuke_ns_downloads_blocks` (
  `ns_dl_show_block` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_show_all` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_show_num` int(2) NOT NULL DEFAULT '0',
  `ns_dl_left_block` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_right_block` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_desc_img`
--

CREATE TABLE `nuke_ns_downloads_desc_img` (
  `ns_dl_des_img` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_des_img_pos` char(2) NOT NULL,
  `ns_dl_des_img_width` int(3) NOT NULL DEFAULT '0',
  `ns_dl_des_img_height` int(3) NOT NULL DEFAULT '0',
  `ns_dl_pop_win` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_pop_win_width` int(4) NOT NULL DEFAULT '0',
  `ns_dl_pop_win_height` int(4) NOT NULL DEFAULT '0',
  `ns_dl_pop_conform` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_use_standard` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_fetch`
--

CREATE TABLE `nuke_ns_downloads_fetch` (
  `ns_getit` tinyint(1) NOT NULL DEFAULT '0',
  `ns_getit_image` tinyint(1) NOT NULL DEFAULT '0',
  `ns_getit_color` varchar(10) NOT NULL,
  `ns_getit_msg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_field`
--

CREATE TABLE `nuke_ns_downloads_field` (
  `fid` int(5) NOT NULL,
  `fname` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_field_perm`
--

CREATE TABLE `nuke_ns_downloads_field_perm` (
  `ns_dl_field_vers` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_field_comp` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_field_file` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_field_date` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_field_hits` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_field_rate` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_general`
--

CREATE TABLE `nuke_ns_downloads_general` (
  `ns_download_image` varchar(255) NOT NULL,
  `ns_download_image_pos` int(3) NOT NULL DEFAULT '0',
  `ns_dl_show_sub_cats` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_show_num` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_show_full` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_num_per_page` tinyint(2) NOT NULL DEFAULT '10',
  `ns_dl_num_results` tinyint(2) NOT NULL DEFAULT '10',
  `ns_dl_sort_order` tinyint(2) NOT NULL DEFAULT '1',
  `ns_dl_down_button` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_foot_button` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_reg_down` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_right_blocks` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_link_bar` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_show_engines` tinyint(1) NOT NULL DEFAULT '0',
  `ns_cat_image` varchar(255) NOT NULL,
  `ns_cat_image_pos` int(3) NOT NULL DEFAULT '0',
  `ns_subcat_image` varchar(255) NOT NULL,
  `ns_subcat_image_pos` int(3) NOT NULL DEFAULT '0',
  `ns_featured_image` varchar(255) NOT NULL,
  `ns_featured_image_pos` int(3) NOT NULL DEFAULT '0',
  `ns_dl_main_note` text NOT NULL,
  `ns_dl_main_note_show` tinyint(1) NOT NULL DEFAULT '0',
  `prbgcolor1` varchar(10) NOT NULL,
  `prbgcolor2` varchar(10) NOT NULL,
  `tttextcolor` varchar(10) NOT NULL,
  `tbtextcolor` varchar(10) NOT NULL,
  `ns_dl_open_new` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_mirror_link` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_view_dis` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_empty_cat` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_new_pop`
--

CREATE TABLE `nuke_ns_downloads_new_pop` (
  `ns_dl_num_new_one` tinyint(2) NOT NULL DEFAULT '7',
  `ns_dl_num_new_two` tinyint(2) NOT NULL DEFAULT '14',
  `ns_dl_num_new_three` tinyint(2) NOT NULL DEFAULT '30',
  `ns_dl_newimage_on` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_new_one` int(3) NOT NULL DEFAULT '1',
  `ns_dl_new_two` int(3) NOT NULL DEFAULT '3',
  `ns_dl_new_three` int(3) NOT NULL DEFAULT '7',
  `ns_dl_num_top` int(3) NOT NULL DEFAULT '25',
  `ns_dl_num_top_num` tinyint(2) NOT NULL DEFAULT '10',
  `ns_dl_num_top_per` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_num_pop` int(4) NOT NULL DEFAULT '200',
  `ns_dl_num_pop_num` tinyint(2) NOT NULL DEFAULT '10',
  `ns_dl_num_pop_per` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_popimage_on` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_num_pop_image` varchar(100) NOT NULL,
  `ns_dl_new_image1` varchar(100) NOT NULL,
  `ns_dl_new_image2` varchar(100) NOT NULL,
  `ns_dl_new_image3` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_nfeatured`
--

CREATE TABLE `nuke_ns_downloads_nfeatured` (
  `fdid` int(5) NOT NULL,
  `lid` int(5) NOT NULL DEFAULT '0',
  `ns_dl_feat_det` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_feat_dlength` varchar(10) NOT NULL,
  `ns_dl_feat_dimg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_rating`
--

CREATE TABLE `nuke_ns_downloads_rating` (
  `ns_dl_outside_vote` tinyint(1) NOT NULL DEFAULT '1',
  `ns_dl_anon_wait_days` int(6) NOT NULL DEFAULT '7',
  `ns_dl_outside_wait_days` int(6) NOT NULL DEFAULT '7',
  `ns_dl_anon_weight` int(6) NOT NULL DEFAULT '5',
  `ns_dl_outside_weight` int(6) NOT NULL DEFAULT '20',
  `ns_dl_main_dec` tinyint(1) NOT NULL DEFAULT '2',
  `ns_dl_detail_dec` tinyint(1) NOT NULL DEFAULT '4'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_recommend`
--

CREATE TABLE `nuke_ns_downloads_recommend` (
  `ns_dl_rec` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_rec_num` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_rec_msg` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_rec_stats` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_rec_stats_user` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_rec_email` text NOT NULL,
  `ns_dl_rec_subject` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_recom_dlstats`
--

CREATE TABLE `nuke_ns_downloads_recom_dlstats` (
  `rdid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT '0',
  `ns_dl_rec_title` varchar(255) NOT NULL,
  `ns_dl_rec_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_recom_usrstats`
--

CREATE TABLE `nuke_ns_downloads_recom_usrstats` (
  `rduid` int(11) NOT NULL,
  `rdid` int(11) NOT NULL DEFAULT '0',
  `lid` int(11) NOT NULL DEFAULT '0',
  `ns_dl_rec_rname` varchar(255) NOT NULL,
  `ns_dl_rec_remail` varchar(255) NOT NULL,
  `ns_dl_rec_uip` varchar(25) NOT NULL,
  `ns_dl_rec_rnum` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_table_form`
--

CREATE TABLE `nuke_ns_downloads_table_form` (
  `tid` int(5) NOT NULL,
  `id` int(5) NOT NULL DEFAULT '0',
  `width` int(3) NOT NULL DEFAULT '0',
  `cpad` int(3) NOT NULL DEFAULT '0',
  `cspace` int(3) NOT NULL DEFAULT '0',
  `align` int(3) NOT NULL DEFAULT '0',
  `bdr` int(3) NOT NULL DEFAULT '0',
  `bdrclr` varchar(10) NOT NULL,
  `trclr` varchar(10) NOT NULL,
  `tdclr` varchar(10) NOT NULL,
  `bgclr` varchar(10) NOT NULL,
  `bgimg` varchar(100) NOT NULL,
  `act` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_table_html`
--

CREATE TABLE `nuke_ns_downloads_table_html` (
  `thid` int(5) NOT NULL,
  `id` int(5) NOT NULL DEFAULT '0',
  `html_open` text NOT NULL,
  `html_close` text NOT NULL,
  `act` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_theme`
--

CREATE TABLE `nuke_ns_downloads_theme` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_theme_mode`
--

CREATE TABLE `nuke_ns_downloads_theme_mode` (
  `id` int(5) NOT NULL DEFAULT '0',
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `mset` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ns_downloads_upload`
--

CREATE TABLE `nuke_ns_downloads_upload` (
  `ns_dl_file_dir` varchar(150) NOT NULL,
  `ns_dl_image_dir` varchar(150) NOT NULL,
  `ns_dl_allow_file` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_allow_img` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_file_size` int(15) NOT NULL DEFAULT '0',
  `ns_dl_image_size` int(15) NOT NULL DEFAULT '0',
  `ns_dl_file_ext` varchar(255) NOT NULL,
  `ns_dl_image_ext` varchar(255) NOT NULL,
  `ns_dl_use_resize` tinyint(1) NOT NULL DEFAULT '0',
  `ns_dl_netpath` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_optimize_gain`
--

CREATE TABLE `nuke_optimize_gain` (
  `gain` decimal(10,3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages`
--

CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL,
  `cid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `counter` int(10) NOT NULL DEFAULT '0',
  `clanguage` varchar(30) NOT NULL,
  `uname` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages_categories`
--

CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL,
  `cimg` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages_feat`
--

CREATE TABLE `nuke_pages_feat` (
  `cid` int(10) NOT NULL DEFAULT '0',
  `pid` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_platinum_technology`
--

CREATE TABLE `nuke_platinum_technology` (
  `name` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pollcomments`
--

CREATE TABLE `nuke_pollcomments` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `pollID` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL,
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_check`
--

CREATE TABLE `nuke_poll_check` (
  `ip` varchar(20) NOT NULL,
  `time` varchar(14) NOT NULL,
  `pollID` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_data`
--

CREATE TABLE `nuke_poll_data` (
  `pollID` int(11) NOT NULL DEFAULT '0',
  `optionText` char(50) NOT NULL,
  `optionCount` int(11) NOT NULL DEFAULT '0',
  `voteID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_desc`
--

CREATE TABLE `nuke_poll_desc` (
  `pollID` int(11) NOT NULL,
  `pollTitle` varchar(100) NOT NULL,
  `timeStamp` int(11) NOT NULL DEFAULT '0',
  `voters` mediumint(9) NOT NULL DEFAULT '0',
  `planguage` varchar(30) NOT NULL,
  `artid` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_public_messages`
--

CREATE TABLE `nuke_public_messages` (
  `mid` int(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` varchar(14) DEFAULT NULL,
  `who` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_queue`
--

CREATE TABLE `nuke_queue` (
  `qid` smallint(5) UNSIGNED NOT NULL,
  `uid` mediumint(9) NOT NULL DEFAULT '0',
  `uname` varchar(40) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `story` text,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `topic` varchar(20) NOT NULL,
  `alanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_quotes`
--

CREATE TABLE `nuke_quotes` (
  `qid` int(10) UNSIGNED NOT NULL,
  `quote` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_referer`
--

CREATE TABLE `nuke_referer` (
  `rid` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_related`
--

CREATE TABLE `nuke_related` (
  `rid` int(11) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews`
--

CREATE TABLE `nuke_reviews` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `reviewer` varchar(25) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT '0',
  `cover` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `url_title` varchar(50) NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '0',
  `rlanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_add`
--

CREATE TABLE `nuke_reviews_add` (
  `id` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `reviewer` varchar(25) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `url_title` varchar(50) NOT NULL,
  `rlanguage` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_comments`
--

CREATE TABLE `nuke_reviews_comments` (
  `cid` int(10) NOT NULL,
  `rid` int(10) NOT NULL DEFAULT '0',
  `userid` varchar(25) NOT NULL,
  `date` datetime DEFAULT NULL,
  `comments` text,
  `score` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_main`
--

CREATE TABLE `nuke_reviews_main` (
  `title` varchar(100) DEFAULT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_security_agents`
--

CREATE TABLE `nuke_security_agents` (
  `agent_name` varchar(20) NOT NULL,
  `agent_fullname` varchar(30) DEFAULT NULL,
  `agent_hostname` varchar(30) DEFAULT NULL,
  `agent_url` varchar(80) DEFAULT NULL,
  `agent_ban` int(1) NOT NULL DEFAULT '0',
  `agent_desc` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_seomodules`
--

CREATE TABLE `nuke_seomodules` (
  `name` text NOT NULL,
  `use` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_session`
--

CREATE TABLE `nuke_session` (
  `uname` varchar(25) NOT NULL,
  `time` varchar(14) NOT NULL,
  `host_addr` varchar(48) NOT NULL,
  `guest` int(1) NOT NULL DEFAULT '0',
  `module` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shopitems`
--

CREATE TABLE `nuke_shopitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `shop` varchar(32) NOT NULL,
  `sdesc` varchar(80) NOT NULL,
  `ldesc` text NOT NULL,
  `cost` int(20) UNSIGNED DEFAULT '100',
  `stock` tinyint(3) UNSIGNED DEFAULT '10',
  `maxstock` tinyint(3) UNSIGNED DEFAULT '100',
  `sold` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `accessforum` int(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shops`
--

CREATE TABLE `nuke_shops` (
  `id` int(10) UNSIGNED NOT NULL,
  `shopname` char(32) NOT NULL,
  `shoptype` char(32) NOT NULL,
  `type` char(32) NOT NULL,
  `restocktime` int(20) UNSIGNED DEFAULT '86400',
  `restockedtime` int(20) UNSIGNED DEFAULT '0',
  `restockamount` int(4) UNSIGNED DEFAULT '5',
  `amountearnt` int(20) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_censor`
--

CREATE TABLE `nuke_shoutbox_censor` (
  `id` int(9) NOT NULL,
  `text` varchar(30) NOT NULL,
  `replacement` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_conf`
--

CREATE TABLE `nuke_shoutbox_conf` (
  `id` int(9) NOT NULL DEFAULT '0',
  `color1` varchar(20) NOT NULL,
  `color2` varchar(20) NOT NULL,
  `date` varchar(5) NOT NULL,
  `time` varchar(5) NOT NULL,
  `number` varchar(5) NOT NULL,
  `ipblock` varchar(5) NOT NULL,
  `nameblock` varchar(5) NOT NULL,
  `censor` varchar(5) NOT NULL,
  `tablewidth` char(3) NOT NULL,
  `urlonoff` varchar(5) NOT NULL,
  `delyourlastpost` varchar(5) NOT NULL,
  `anonymouspost` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `themecolors` varchar(5) NOT NULL,
  `textWidth` varchar(4) NOT NULL,
  `nameWidth` varchar(4) NOT NULL,
  `smiliesPerRow` varchar(4) NOT NULL,
  `reversePosts` varchar(4) NOT NULL,
  `timeOffset` varchar(10) NOT NULL,
  `urlanononoff` varchar(10) NOT NULL,
  `pointspershout` varchar(5) NOT NULL,
  `shoutsperpage` varchar(5) NOT NULL,
  `serverTimezone` varchar(5) NOT NULL,
  `blockxxx` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_date`
--

CREATE TABLE `nuke_shoutbox_date` (
  `id` int(5) NOT NULL DEFAULT '0',
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_emoticons`
--

CREATE TABLE `nuke_shoutbox_emoticons` (
  `id` int(9) NOT NULL,
  `text` varchar(20) NOT NULL,
  `image` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_ipblock`
--

CREATE TABLE `nuke_shoutbox_ipblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_manage_count`
--

CREATE TABLE `nuke_shoutbox_manage_count` (
  `id` int(9) NOT NULL,
  `admin` varchar(25) NOT NULL,
  `aCount` varchar(5) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_nameblock`
--

CREATE TABLE `nuke_shoutbox_nameblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_shouts`
--

CREATE TABLE `nuke_shoutbox_shouts` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `ip` varchar(39) DEFAULT NULL,
  `timestamp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_sticky`
--

CREATE TABLE `nuke_shoutbox_sticky` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `stickySlot` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_themes`
--

CREATE TABLE `nuke_shoutbox_themes` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockColor1` varchar(20) DEFAULT NULL,
  `blockColor2` varchar(20) DEFAULT NULL,
  `border` varchar(20) DEFAULT NULL,
  `menuColor1` varchar(20) DEFAULT NULL,
  `menuColor2` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_theme_images`
--

CREATE TABLE `nuke_shoutbox_theme_images` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockArrowColor` varchar(50) NOT NULL,
  `blockBackgroundImage` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_version`
--

CREATE TABLE `nuke_shoutbox_version` (
  `id` int(5) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `datechecked` char(2) NOT NULL,
  `versionreported` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart`
--

CREATE TABLE `nuke_simplecart` (
  `main` text NOT NULL,
  `referrals` text NOT NULL,
  `policies` text NOT NULL,
  `terms` text NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart_config`
--

CREATE TABLE `nuke_simplecart_config` (
  `scmail` varchar(255) NOT NULL DEFAULT 'admin@MySite.com',
  `scsubject` varchar(255) NOT NULL DEFAULT 'SimpleCart Catalog Order',
  `sccontact` varchar(255) NOT NULL DEFAULT 'sales@MySite.com',
  `sccontactsubject` varchar(255) NOT NULL DEFAULT 'SimpleCart Product Inquiry',
  `scname` varchar(255) NOT NULL DEFAULT 'SimpleCart Online Store'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart_featured`
--

CREATE TABLE `nuke_simplecart_featured` (
  `c4_desc` varchar(255) NOT NULL DEFAULT 'Insert Category Description Here',
  `c4` varchar(50) NOT NULL,
  `c4p1_img` varchar(255) NOT NULL,
  `c4p1_tit` varchar(50) NOT NULL,
  `c4p1_desc` text NOT NULL,
  `c4p1_buy` text NOT NULL,
  `c4p1_cart` text NOT NULL,
  `c4p1_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p2_img` varchar(255) NOT NULL,
  `c4p2_tit` varchar(50) NOT NULL,
  `c4p2_desc` text NOT NULL,
  `c4p2_buy` text NOT NULL,
  `c4p2_cart` text NOT NULL,
  `c4p2_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p3_img` varchar(255) NOT NULL,
  `c4p3_tit` varchar(50) NOT NULL,
  `c4p3_desc` text NOT NULL,
  `c4p3_buy` text NOT NULL,
  `c4p3_cart` text NOT NULL,
  `c4p3_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p4_img` varchar(255) NOT NULL,
  `c4p4_tit` varchar(50) NOT NULL,
  `c4p4_desc` text NOT NULL,
  `c4p4_buy` text NOT NULL,
  `c4p4_cart` text NOT NULL,
  `c4p4_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p5_img` varchar(255) NOT NULL,
  `c4p5_tit` varchar(50) NOT NULL,
  `c4p5_desc` text NOT NULL,
  `c4p5_buy` text NOT NULL,
  `c4p5_cart` text NOT NULL,
  `c4p5_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p6_img` varchar(255) NOT NULL,
  `c4p6_tit` varchar(50) NOT NULL,
  `c4p6_desc` text NOT NULL,
  `c4p6_buy` text NOT NULL,
  `c4p6_cart` text NOT NULL,
  `c4p6_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p7_img` varchar(255) NOT NULL,
  `c4p7_tit` varchar(50) NOT NULL,
  `c4p7_desc` text NOT NULL,
  `c4p7_buy` text NOT NULL,
  `c4p7_cart` text NOT NULL,
  `c4p7_active` tinyint(1) NOT NULL DEFAULT '1',
  `c4p8_img` varchar(255) NOT NULL,
  `c4p8_tit` varchar(50) NOT NULL,
  `c4p8_desc` text NOT NULL,
  `c4p8_buy` text NOT NULL,
  `c4p8_cart` text NOT NULL,
  `c4p8_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart_products`
--

CREATE TABLE `nuke_simplecart_products` (
  `c1_desc` varchar(255) NOT NULL DEFAULT 'Insert Category Description Here',
  `c1` varchar(50) NOT NULL,
  `c1p1_img` varchar(255) NOT NULL,
  `c1p1_tit` varchar(50) NOT NULL,
  `c1p1_desc` text NOT NULL,
  `c1p1_buy` text NOT NULL,
  `c1p1_cart` text NOT NULL,
  `c1p1_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p2_img` varchar(255) NOT NULL,
  `c1p2_tit` varchar(50) NOT NULL,
  `c1p2_desc` text NOT NULL,
  `c1p2_buy` text NOT NULL,
  `c1p2_cart` text NOT NULL,
  `c1p2_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p3_img` varchar(255) NOT NULL,
  `c1p3_tit` varchar(50) NOT NULL,
  `c1p3_desc` text NOT NULL,
  `c1p3_buy` text NOT NULL,
  `c1p3_cart` text NOT NULL,
  `c1p3_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p4_img` varchar(255) NOT NULL,
  `c1p4_tit` varchar(50) NOT NULL,
  `c1p4_desc` text NOT NULL,
  `c1p4_buy` text NOT NULL,
  `c1p4_cart` text NOT NULL,
  `c1p4_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p5_img` varchar(255) NOT NULL,
  `c1p5_tit` varchar(50) NOT NULL,
  `c1p5_desc` text NOT NULL,
  `c1p5_buy` text NOT NULL,
  `c1p5_cart` text NOT NULL,
  `c1p5_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p6_img` varchar(255) NOT NULL,
  `c1p6_tit` varchar(50) NOT NULL,
  `c1p6_desc` text NOT NULL,
  `c1p6_buy` text NOT NULL,
  `c1p6_cart` text NOT NULL,
  `c1p6_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p7_img` varchar(255) NOT NULL,
  `c1p7_tit` varchar(50) NOT NULL,
  `c1p7_desc` text NOT NULL,
  `c1p7_buy` text NOT NULL,
  `c1p7_cart` text NOT NULL,
  `c1p7_active` tinyint(1) NOT NULL DEFAULT '1',
  `c1p8_img` varchar(255) NOT NULL,
  `c1p8_tit` varchar(50) NOT NULL,
  `c1p8_desc` text NOT NULL,
  `c1p8_buy` text NOT NULL,
  `c1p8_cart` text NOT NULL,
  `c1p8_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart_services`
--

CREATE TABLE `nuke_simplecart_services` (
  `c2_desc` varchar(255) NOT NULL DEFAULT 'Insert Category Description Here',
  `c2` varchar(50) NOT NULL,
  `c2p1_img` varchar(255) NOT NULL,
  `c2p1_tit` varchar(50) NOT NULL,
  `c2p1_desc` text NOT NULL,
  `c2p1_buy` text NOT NULL,
  `c2p1_cart` text NOT NULL,
  `c2p1_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p2_img` varchar(255) NOT NULL,
  `c2p2_tit` varchar(50) NOT NULL,
  `c2p2_desc` text NOT NULL,
  `c2p2_buy` text NOT NULL,
  `c2p2_cart` text NOT NULL,
  `c2p2_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p3_img` varchar(255) NOT NULL,
  `c2p3_tit` varchar(50) NOT NULL,
  `c2p3_desc` text NOT NULL,
  `c2p3_buy` text NOT NULL,
  `c2p3_cart` text NOT NULL,
  `c2p3_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p4_img` varchar(255) NOT NULL,
  `c2p4_tit` varchar(50) NOT NULL,
  `c2p4_desc` text NOT NULL,
  `c2p4_buy` text NOT NULL,
  `c2p4_cart` text NOT NULL,
  `c2p4_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p5_img` varchar(255) NOT NULL,
  `c2p5_tit` varchar(50) NOT NULL,
  `c2p5_desc` text NOT NULL,
  `c2p5_buy` text NOT NULL,
  `c2p5_cart` text NOT NULL,
  `c2p5_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p6_img` varchar(255) NOT NULL,
  `c2p6_tit` varchar(50) NOT NULL,
  `c2p6_desc` text NOT NULL,
  `c2p6_buy` text NOT NULL,
  `c2p6_cart` text NOT NULL,
  `c2p6_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p7_img` varchar(255) NOT NULL,
  `c2p7_tit` varchar(50) NOT NULL,
  `c2p7_desc` text NOT NULL,
  `c2p7_buy` text NOT NULL,
  `c2p7_cart` text NOT NULL,
  `c2p7_active` tinyint(1) NOT NULL DEFAULT '1',
  `c2p8_img` varchar(255) NOT NULL,
  `c2p8_tit` varchar(50) NOT NULL,
  `c2p8_desc` text NOT NULL,
  `c2p8_buy` text NOT NULL,
  `c2p8_cart` text NOT NULL,
  `c2p8_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_simplecart_specials`
--

CREATE TABLE `nuke_simplecart_specials` (
  `c3_desc` varchar(255) NOT NULL DEFAULT 'Insert Category Description Here',
  `c3` varchar(50) NOT NULL,
  `c3p1_img` varchar(255) NOT NULL,
  `c3p1_tit` varchar(50) NOT NULL,
  `c3p1_desc` text NOT NULL,
  `c3p1_buy` text NOT NULL,
  `c3p1_cart` text NOT NULL,
  `c3p1_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p2_img` varchar(255) NOT NULL,
  `c3p2_tit` varchar(50) NOT NULL,
  `c3p2_desc` text NOT NULL,
  `c3p2_buy` text NOT NULL,
  `c3p2_cart` text NOT NULL,
  `c3p2_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p3_img` varchar(255) NOT NULL,
  `c3p3_tit` varchar(50) NOT NULL,
  `c3p3_desc` text NOT NULL,
  `c3p3_buy` text NOT NULL,
  `c3p3_cart` text NOT NULL,
  `c3p3_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p4_img` varchar(255) NOT NULL,
  `c3p4_tit` varchar(50) NOT NULL,
  `c3p4_desc` text NOT NULL,
  `c3p4_buy` text NOT NULL,
  `c3p4_cart` text NOT NULL,
  `c3p4_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p5_img` varchar(255) NOT NULL,
  `c3p5_tit` varchar(50) NOT NULL,
  `c3p5_desc` text NOT NULL,
  `c3p5_buy` text NOT NULL,
  `c3p5_cart` text NOT NULL,
  `c3p5_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p6_img` varchar(255) NOT NULL,
  `c3p6_tit` varchar(50) NOT NULL,
  `c3p6_desc` text NOT NULL,
  `c3p6_buy` text NOT NULL,
  `c3p6_cart` text NOT NULL,
  `c3p6_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p7_img` varchar(255) NOT NULL,
  `c3p7_tit` varchar(50) NOT NULL,
  `c3p7_desc` text NOT NULL,
  `c3p7_buy` text NOT NULL,
  `c3p7_cart` text NOT NULL,
  `c3p7_active` tinyint(1) NOT NULL DEFAULT '1',
  `c3p8_img` varchar(255) NOT NULL,
  `c3p8_tit` varchar(50) NOT NULL,
  `c3p8_desc` text NOT NULL,
  `c3p8_buy` text NOT NULL,
  `c3p8_cart` text NOT NULL,
  `c3p8_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire`
--

CREATE TABLE `nuke_sommaire` (
  `groupmenu` int(2) NOT NULL DEFAULT '0',
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `lien` text,
  `hr` char(2) DEFAULT NULL,
  `center` char(2) DEFAULT NULL,
  `bgcolor` tinytext,
  `invisible` int(1) DEFAULT NULL,
  `class` tinytext,
  `bold` char(2) DEFAULT NULL,
  `new` char(2) DEFAULT NULL,
  `listbox` char(2) DEFAULT NULL,
  `dynamic` char(2) DEFAULT NULL,
  `date_debut` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `date_fin` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `days` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire_categories`
--

CREATE TABLE `nuke_sommaire_categories` (
  `id` int(11) NOT NULL,
  `groupmenu` int(2) NOT NULL DEFAULT '0',
  `module` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `new` char(2) DEFAULT NULL,
  `new_days` tinyint(4) NOT NULL DEFAULT '-1',
  `class` varchar(20) DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  `sublevel` tinyint(3) NOT NULL DEFAULT '0',
  `date_debut` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `date_fin` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `days` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_staff`
--

CREATE TABLE `nuke_staff` (
  `id` int(3) NOT NULL DEFAULT '0',
  `sid` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` mediumtext NOT NULL,
  `rank` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_staff_cat`
--

CREATE TABLE `nuke_staff_cat` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_staff_config`
--

CREATE TABLE `nuke_staff_config` (
  `latest` int(3) NOT NULL DEFAULT '0',
  `img_url` mediumtext NOT NULL,
  `staff_join_page` mediumtext NOT NULL,
  `ranks` int(3) NOT NULL DEFAULT '0',
  `index_bl` int(3) NOT NULL DEFAULT '0',
  `copyright_txt` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_date`
--

CREATE TABLE `nuke_stats_date` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `date` tinyint(4) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_hour`
--

CREATE TABLE `nuke_stats_hour` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `date` tinyint(4) NOT NULL DEFAULT '0',
  `hour` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_month`
--

CREATE TABLE `nuke_stats_month` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_year`
--

CREATE TABLE `nuke_stats_year` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stories`
--

CREATE TABLE `nuke_stories` (
  `sid` int(11) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `aid` varchar(25) NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hometext` text,
  `bodytext` text NOT NULL,
  `comments` int(11) DEFAULT '0',
  `counter` mediumint(8) UNSIGNED DEFAULT NULL,
  `topic` int(3) NOT NULL DEFAULT '1',
  `informant` varchar(25) NOT NULL,
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL DEFAULT '0',
  `alanguage` varchar(30) NOT NULL,
  `acomm` int(1) NOT NULL DEFAULT '0',
  `haspoll` int(1) NOT NULL DEFAULT '0',
  `pollID` int(10) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `associated` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stories_cat`
--

CREATE TABLE `nuke_stories_cat` (
  `catid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_subscriptions`
--

CREATE TABLE `nuke_subscriptions` (
  `id` int(10) NOT NULL,
  `userid` int(10) DEFAULT '0',
  `subscription_expire` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tags`
--

CREATE TABLE `nuke_tags` (
  `tag` varchar(25) NOT NULL,
  `cid` int(10) NOT NULL DEFAULT '0',
  `whr` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tags_temp`
--

CREATE TABLE `nuke_tags_temp` (
  `tag` varchar(25) NOT NULL,
  `cid` int(10) NOT NULL DEFAULT '0',
  `whr` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_themeconsole`
--

CREATE TABLE `nuke_themeconsole` (
  `marq1` varchar(255) NOT NULL DEFAULT 'This is line 1 from ThemeConsole mod so you can change and edit this message with simplicity.',
  `marq2` varchar(255) NOT NULL DEFAULT 'This is line 2 from ThemeConsole mod so you can change and edit this message with simplicity.',
  `marq3` varchar(255) NOT NULL DEFAULT 'This is line 2 from ThemeConsole mod so you can change and edit this message with simplicity.',
  `marq4` varchar(255) NOT NULL DEFAULT 'This is line 4 from ThemeConsole mod so you can change and edit this message with simplicity.',
  `marq5` varchar(255) NOT NULL DEFAULT 'This is line 5 from ThemeConsole mod so you can change and edit this message with simplicity.',
  `marqstyle` int(2) NOT NULL DEFAULT '99',
  `link1text` varchar(255) NOT NULL DEFAULT 'Home',
  `link1` varchar(255) NOT NULL DEFAULT 'index.php',
  `link2text` varchar(255) NOT NULL DEFAULT 'Forums',
  `link2` varchar(255) NOT NULL DEFAULT 'modules.php?name=Forums',
  `link3text` varchar(255) NOT NULL DEFAULT 'Downloads',
  `link3` varchar(255) NOT NULL DEFAULT 'modules.php?name=PrivateDownloads',
  `link4text` varchar(255) NOT NULL DEFAULT 'Gallery',
  `link4` varchar(255) NOT NULL DEFAULT 'modules.php?name=coppermine',
  `link5text` varchar(255) NOT NULL DEFAULT 'Credits',
  `link5` varchar(255) NOT NULL DEFAULT 'modules.php?name=Credits',
  `link6text` varchar(255) NOT NULL,
  `link6` varchar(255) NOT NULL,
  `link7text` varchar(255) NOT NULL,
  `link7` varchar(255) NOT NULL,
  `sitewidth` varchar(255) NOT NULL DEFAULT '100%',
  `searchbox` int(1) NOT NULL DEFAULT '0',
  `flashswitch` int(1) NOT NULL DEFAULT '1',
  `disrightclick` int(1) NOT NULL DEFAULT '0',
  `adminright` int(1) NOT NULL DEFAULT '0',
  `disselectall` int(1) NOT NULL DEFAULT '0',
  `adminselect` int(1) NOT NULL DEFAULT '0',
  `themename` varchar(255) NOT NULL,
  `encrypt` int(1) NOT NULL DEFAULT '0',
  `pubbox` varchar(10) NOT NULL DEFAULT '#1C1E2C',
  `pubboxtext` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_topics`
--

CREATE TABLE `nuke_topics` (
  `topicid` int(3) NOT NULL,
  `topicname` varchar(20) DEFAULT NULL,
  `topicimage` varchar(20) DEFAULT NULL,
  `topictext` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_top_sites`
--

CREATE TABLE `nuke_top_sites` (
  `lid` int(11) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `urlban` varchar(100) NOT NULL,
  `imagewidth` int(3) NOT NULL DEFAULT '0',
  `imageheight` int(3) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `linkratingsummary` double(6,1) NOT NULL DEFAULT '0.0',
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `validation` char(1) NOT NULL DEFAULT 'N',
  `mailsent` char(1) NOT NULL DEFAULT 'N',
  `adminrate` varchar(20) NOT NULL,
  `makeweblink` tinyint(1) NOT NULL DEFAULT '0',
  `weblinkcat` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_top_sites_categories`
--

CREATE TABLE `nuke_top_sites_categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_top_sites_config`
--

CREATE TABLE `nuke_top_sites_config` (
  `autovalidation` tinyint(1) NOT NULL DEFAULT '0',
  `evaluation` tinyint(1) NOT NULL DEFAULT '1',
  `perpage` int(2) NOT NULL DEFAULT '10',
  `linksresults` int(2) NOT NULL DEFAULT '10',
  `anonwaitdays` int(2) NOT NULL DEFAULT '15',
  `outsidewaitdays` int(2) NOT NULL DEFAULT '15',
  `useoutsidevoting` int(2) NOT NULL DEFAULT '1',
  `maxaffichage` int(3) NOT NULL DEFAULT '10',
  `categorie_option` tinyint(1) NOT NULL DEFAULT '1',
  `receivemail` tinyint(1) NOT NULL DEFAULT '1',
  `delafterxdays` tinyint(1) NOT NULL DEFAULT '0',
  `delxdays` int(4) NOT NULL DEFAULT '5',
  `nextdatedeletevote` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `latest` int(2) NOT NULL DEFAULT '10',
  `resizeimage` tinyint(1) NOT NULL DEFAULT '0',
  `maxwidth` int(4) NOT NULL DEFAULT '468',
  `maxheight` int(4) NOT NULL DEFAULT '60',
  `altbgcolor1` varchar(7) NOT NULL DEFAULT '#64C1F4',
  `altbgcolor2` varchar(7) NOT NULL DEFAULT '#64C1F4',
  `flashbanoption` tinyint(1) NOT NULL DEFAULT '0',
  `weblinkoption` tinyint(1) NOT NULL DEFAULT '0',
  `notebyjava` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '1.4'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_top_sites_votedata`
--

CREATE TABLE `nuke_top_sites_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_categories`
--

CREATE TABLE `nuke_tutorials_categories` (
  `tc_id` int(11) NOT NULL,
  `tc_title` varchar(50) NOT NULL,
  `tc_description` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_config`
--

CREATE TABLE `nuke_tutorials_config` (
  `tutsperpage` tinyint(2) NOT NULL DEFAULT '10',
  `hitsforpopular` varchar(5) NOT NULL DEFAULT '5000',
  `toptutorials` tinyint(2) NOT NULL DEFAULT '10',
  `anonwaitdays` tinyint(2) NOT NULL DEFAULT '1',
  `anonweight` tinyint(2) NOT NULL DEFAULT '10',
  `detailvotedecimal` tinyint(1) NOT NULL DEFAULT '2',
  `mainvotedecimal` tinyint(1) NOT NULL DEFAULT '1',
  `mostpoptutorials` tinyint(2) NOT NULL DEFAULT '10',
  `tutorialvotemin` tinyint(3) NOT NULL DEFAULT '25',
  `show_links_num` tinyint(1) NOT NULL DEFAULT '0',
  `maxfavs` tinyint(2) NOT NULL DEFAULT '10',
  `rightblocks` tinyint(1) NOT NULL DEFAULT '1',
  `searchtutorials` tinyint(2) NOT NULL DEFAULT '10',
  `submit_on` tinyint(1) NOT NULL DEFAULT '1',
  `approve_on` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_favorites`
--

CREATE TABLE `nuke_tutorials_favorites` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `t_id` int(11) NOT NULL DEFAULT '0',
  `showlist` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_levels`
--

CREATE TABLE `nuke_tutorials_levels` (
  `sid` int(10) NOT NULL,
  `title` varchar(60) NOT NULL,
  `weight` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_submit`
--

CREATE TABLE `nuke_tutorials_submit` (
  `t_submitid` int(10) NOT NULL,
  `tc_id` int(10) NOT NULL DEFAULT '0',
  `t_title` varchar(255) NOT NULL,
  `t_text` longtext NOT NULL,
  `t_submitdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `t_counter` int(10) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `tutorialsratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `author` varchar(60) NOT NULL,
  `author_email` varchar(60) NOT NULL DEFAULT '0',
  `author_homepage` varchar(200) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_tutorials`
--

CREATE TABLE `nuke_tutorials_tutorials` (
  `t_id` int(10) NOT NULL,
  `tc_id` int(10) NOT NULL DEFAULT '0',
  `t_title` varchar(255) NOT NULL,
  `t_text` longtext NOT NULL,
  `t_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `t_counter` int(10) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `tutorialsratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `author` varchar(60) NOT NULL,
  `author_email` varchar(60) NOT NULL DEFAULT '0',
  `author_homepage` varchar(200) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL,
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_tutorials_votedata`
--

CREATE TABLE `nuke_tutorials_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL,
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_categories`
--

CREATE TABLE `nuke_universal_categories` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(60) NOT NULL,
  `description` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_cfg`
--

CREATE TABLE `nuke_universal_cfg` (
  `name` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_comments`
--

CREATE TABLE `nuke_universal_comments` (
  `cid` int(10) NOT NULL,
  `vid` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_items`
--

CREATE TABLE `nuke_universal_items` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL,
  `votes` int(10) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `comments` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `submitter` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL,
  `lastdate` datetime DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `youremail` varchar(120) NOT NULL,
  `bbcode_uid` varchar(10) DEFAULT NULL,
  `language` varchar(30) NOT NULL DEFAULT 'english',
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_modify`
--

CREATE TABLE `nuke_universal_modify` (
  `id` int(11) NOT NULL DEFAULT '0',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `submitter` varchar(100) NOT NULL,
  `youremail` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_queue`
--

CREATE TABLE `nuke_universal_queue` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `submitter` varchar(100) NOT NULL,
  `youremail` varchar(120) NOT NULL,
  `language` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_related`
--

CREATE TABLE `nuke_universal_related` (
  `rid` int(11) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_universal_requests`
--

CREATE TABLE `nuke_universal_requests` (
  `id` int(11) NOT NULL,
  `itemtitle` varchar(120) NOT NULL,
  `submitter` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users`
--

CREATE TABLE `nuke_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(25) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `femail` varchar(255) NOT NULL,
  `user_website` varchar(255) NOT NULL,
  `user_avatar` varchar(255) NOT NULL,
  `user_regdate` varchar(20) NOT NULL,
  `user_icq` varchar(15) DEFAULT NULL,
  `user_occ` varchar(100) DEFAULT NULL,
  `user_from` varchar(100) DEFAULT NULL,
  `user_interests` varchar(150) NOT NULL,
  `user_sig` varchar(255) DEFAULT NULL,
  `user_viewemail` tinyint(2) DEFAULT NULL,
  `user_theme` int(3) DEFAULT NULL,
  `user_aim` varchar(18) DEFAULT NULL,
  `user_yim` varchar(25) DEFAULT NULL,
  `user_msnm` varchar(25) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL,
  `storynum` tinyint(4) NOT NULL DEFAULT '10',
  `umode` varchar(10) NOT NULL,
  `uorder` tinyint(1) NOT NULL DEFAULT '0',
  `thold` tinyint(1) NOT NULL DEFAULT '0',
  `noscore` tinyint(1) NOT NULL DEFAULT '0',
  `bio` tinytext NOT NULL,
  `ublockon` tinyint(1) NOT NULL DEFAULT '0',
  `ublock` tinytext NOT NULL,
  `theme` varchar(255) NOT NULL,
  `commentmax` int(11) NOT NULL DEFAULT '4096',
  `counter` int(11) NOT NULL DEFAULT '0',
  `newsletter` int(1) NOT NULL DEFAULT '0',
  `user_posts` int(10) NOT NULL DEFAULT '0',
  `user_attachsig` int(2) NOT NULL DEFAULT '1',
  `user_rank` int(10) NOT NULL DEFAULT '0',
  `user_level` int(10) NOT NULL DEFAULT '1',
  `broadcast` tinyint(1) NOT NULL DEFAULT '1',
  `popmeson` tinyint(1) NOT NULL DEFAULT '0',
  `user_active` tinyint(1) DEFAULT '1',
  `user_session_time` int(11) NOT NULL DEFAULT '0',
  `user_session_page` smallint(5) NOT NULL DEFAULT '0',
  `user_lastvisit` int(11) NOT NULL DEFAULT '0',
  `user_timezone` varchar(6) NOT NULL DEFAULT '2',
  `user_style` tinyint(4) DEFAULT NULL,
  `user_lang` varchar(255) NOT NULL DEFAULT 'english',
  `user_dateformat` varchar(14) NOT NULL DEFAULT 'D M d, Y g:i a',
  `user_new_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `user_unread_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) NOT NULL DEFAULT '0',
  `user_emailtime` int(11) DEFAULT NULL,
  `user_allowhtml` tinyint(1) DEFAULT '1',
  `user_allowbbcode` tinyint(1) DEFAULT '1',
  `user_allowsmile` tinyint(1) DEFAULT '1',
  `user_allowavatar` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_pm` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) NOT NULL DEFAULT '1',
  `user_notify` tinyint(1) NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_popup_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_avatar_type` tinyint(4) NOT NULL DEFAULT '3',
  `user_sig_bbcode_uid` varchar(10) DEFAULT NULL,
  `user_actkey` varchar(32) DEFAULT NULL,
  `user_newpasswd` varchar(32) DEFAULT NULL,
  `last_ip` varchar(15) NOT NULL DEFAULT '0',
  `user_color_gc` varchar(6) DEFAULT NULL,
  `user_color_gi` text,
  `user_quickreply` tinyint(1) NOT NULL DEFAULT '0',
  `user_allow_arcadepm` tinyint(4) NOT NULL DEFAULT '0',
  `kick_ban` int(2) NOT NULL DEFAULT '0',
  `user_wordwrap` smallint(2) NOT NULL DEFAULT '70',
  `agreedtos` tinyint(1) NOT NULL DEFAULT '0',
  `user_view_log` tinyint(4) NOT NULL DEFAULT '0',
  `user_effects` varchar(255) DEFAULT NULL,
  `user_privs` varchar(255) DEFAULT NULL,
  `user_custitle` text,
  `user_specmsg` text,
  `user_items` text,
  `user_trade` text,
  `points` decimal(11,2) NOT NULL DEFAULT '0.00',
  `user_cash` decimal(11,2) NOT NULL DEFAULT '0.00',
  `last_seen_blocker` int(11) NOT NULL DEFAULT '0',
  `user_login_tries` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `user_last_login_try` int(11) NOT NULL DEFAULT '0',
  `user_gender` tinyint(4) NOT NULL DEFAULT '0',
  `user_birthday` int(11) NOT NULL DEFAULT '999999',
  `user_next_birthday_greeting` int(11) NOT NULL DEFAULT '0',
  `user_from_flag` varchar(25) DEFAULT NULL,
  `user_group_cp` int(11) NOT NULL DEFAULT '2',
  `user_group_list_cp` varchar(100) NOT NULL DEFAULT '2',
  `user_active_cp` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `user_rank2` int(11) DEFAULT '-1',
  `user_rank3` int(11) DEFAULT '-2',
  `user_rank4` int(11) DEFAULT '-2',
  `user_rank5` int(11) DEFAULT '-2',
  `user_time_mode` tinyint(4) NOT NULL DEFAULT '6',
  `user_dst_time_lag` tinyint(4) NOT NULL DEFAULT '60',
  `user_pc_timeOffsets` varchar(11) NOT NULL DEFAULT '0',
  `user_quickreply_mode` tinyint(1) NOT NULL DEFAULT '1',
  `user_open_quickreply` tinyint(1) NOT NULL DEFAULT '1',
  `user_avatar_dimensions` varchar(255) DEFAULT NULL,
  `user_birthday2` int(8) DEFAULT NULL,
  `birthday_display` tinyint(1) NOT NULL DEFAULT '0',
  `birthday_greeting` tinyint(1) NOT NULL DEFAULT '0',
  `user_topics` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `user_regip` char(8) NOT NULL DEFAULT '0',
  `lastsitevisit` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_config`
--

CREATE TABLE `nuke_users_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_fields`
--

CREATE TABLE `nuke_users_fields` (
  `fid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'field',
  `value` varchar(255) DEFAULT NULL,
  `size` int(3) DEFAULT NULL,
  `need` int(1) NOT NULL DEFAULT '1',
  `pos` int(3) DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_field_values`
--

CREATE TABLE `nuke_users_field_values` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `fid` int(10) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_temp`
--

CREATE TABLE `nuke_users_temp` (
  `user_id` int(10) NOT NULL,
  `username` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `check_num` varchar(50) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `requestor` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_temp_field_values`
--

CREATE TABLE `nuke_users_temp_field_values` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `fid` int(10) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream`
--

CREATE TABLE `nuke_video_stream` (
  `id` int(11) NOT NULL,
  `flash` int(1) NOT NULL DEFAULT '0',
  `vidname` varchar(100) DEFAULT NULL,
  `description` text,
  `url` text,
  `imgurl` varchar(255) NOT NULL,
  `thumbimg` varchar(255) NOT NULL,
  `width` int(3) DEFAULT NULL,
  `height` int(3) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `views` int(9) DEFAULT '0',
  `rating` int(9) DEFAULT NULL,
  `rates` int(9) NOT NULL DEFAULT '0',
  `category` int(9) DEFAULT NULL,
  `request` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream_broken`
--

CREATE TABLE `nuke_video_stream_broken` (
  `id` int(11) NOT NULL,
  `brokenvidid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream_categories`
--

CREATE TABLE `nuke_video_stream_categories` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `parent` int(9) NOT NULL DEFAULT '0',
  `permission` int(1) NOT NULL DEFAULT '0',
  `adult` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream_comments`
--

CREATE TABLE `nuke_video_stream_comments` (
  `id` int(9) NOT NULL,
  `vidid` mediumint(9) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream_points`
--

CREATE TABLE `nuke_video_stream_points` (
  `id` int(9) NOT NULL,
  `points` int(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_video_stream_settings`
--

CREATE TABLE `nuke_video_stream_settings` (
  `id` int(1) NOT NULL,
  `commentED` int(1) NOT NULL DEFAULT '0',
  `commentV` int(1) NOT NULL DEFAULT '0',
  `sendED` int(1) NOT NULL DEFAULT '0',
  `sendV` int(1) NOT NULL DEFAULT '0',
  `brokenED` int(1) NOT NULL DEFAULT '0',
  `brokenV` int(1) NOT NULL DEFAULT '0',
  `submitED` int(1) NOT NULL DEFAULT '0',
  `submitV` int(1) NOT NULL DEFAULT '0',
  `submitC` int(1) NOT NULL DEFAULT '0',
  `ratingED` int(1) NOT NULL DEFAULT '0',
  `ratingV` int(1) NOT NULL DEFAULT '0',
  `viewV` int(1) NOT NULL DEFAULT '0',
  `downloadED` int(1) NOT NULL DEFAULT '0',
  `downloadV` int(1) NOT NULL DEFAULT '0',
  `embededED` int(1) NOT NULL DEFAULT '0',
  `embededV` int(1) NOT NULL DEFAULT '0',
  `limitvids` int(9) NOT NULL DEFAULT '10',
  `avmaxwidth` int(3) NOT NULL DEFAULT '0',
  `avmaxheight` int(3) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '4.5'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_webcrawlers`
--

CREATE TABLE `nuke_webcrawlers` (
  `webcrawler` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_whoiswhere`
--

CREATE TABLE `nuke_whoiswhere` (
  `username` varchar(25) NOT NULL,
  `time` varchar(14) NOT NULL,
  `host_addr` varchar(48) NOT NULL,
  `guest` int(1) NOT NULL DEFAULT '0',
  `module` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nukec30_ads_ads`
--
ALTER TABLE `nukec30_ads_ads`
  ADD PRIMARY KEY (`id_ads`);

--
-- Indexes for table `nukec30_ads_box`
--
ALTER TABLE `nukec30_ads_box`
  ADD PRIMARY KEY (`id_save`);

--
-- Indexes for table `nukec30_ads_catg`
--
ALTER TABLE `nukec30_ads_catg`
  ADD PRIMARY KEY (`id_catg`);

--
-- Indexes for table `nukec30_ads_comments`
--
ALTER TABLE `nukec30_ads_comments`
  ADD PRIMARY KEY (`no_comment`);

--
-- Indexes for table `nukec30_ads_currency`
--
ALTER TABLE `nukec30_ads_currency`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `nukec30_ads_custom`
--
ALTER TABLE `nukec30_ads_custom`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `nukec30_ads_disclaimer`
--
ALTER TABLE `nukec30_ads_disclaimer`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `nukec30_ads_duration`
--
ALTER TABLE `nukec30_ads_duration`
  ADD PRIMARY KEY (`id_duration`);

--
-- Indexes for table `nukec30_ads_filter`
--
ALTER TABLE `nukec30_ads_filter`
  ADD PRIMARY KEY (`word_id`);

--
-- Indexes for table `nuke_about_us`
--
ALTER TABLE `nuke_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_amazon_cache`
--
ALTER TABLE `nuke_amazon_cache`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `date_time` (`time`);

--
-- Indexes for table `nuke_amazon_cart`
--
ALTER TABLE `nuke_amazon_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_amazon_catalog`
--
ALTER TABLE `nuke_amazon_catalog`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `catalog` (`catalog`),
  ADD KEY `r_catalog` (`r_catalog`),
  ADD KEY `locale` (`locale`);

--
-- Indexes for table `nuke_amazon_department`
--
ALTER TABLE `nuke_amazon_department`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `nuke_amazon_items`
--
ALTER TABLE `nuke_amazon_items`
  ADD PRIMARY KEY (`iid`),
  ADD KEY `asin` (`asin`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `nuke_amazon_nodes`
--
ALTER TABLE `nuke_amazon_nodes`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `catalog` (`catalog`),
  ADD KEY `locale` (`locale`);

--
-- Indexes for table `nuke_amazon_not_item`
--
ALTER TABLE `nuke_amazon_not_item`
  ADD PRIMARY KEY (`iid`),
  ADD KEY `asin` (`asin`);

--
-- Indexes for table `nuke_authors`
--
ALTER TABLE `nuke_authors`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `nuke_autonews`
--
ALTER TABLE `nuke_autonews`
  ADD PRIMARY KEY (`anid`),
  ADD KEY `anid` (`anid`);

--
-- Indexes for table `nuke_banned_ip`
--
ALTER TABLE `nuke_banned_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_banner`
--
ALTER TABLE `nuke_banner`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `bid` (`bid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_banner_clients`
--
ALTER TABLE `nuke_banner_clients`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_banner_plans`
--
ALTER TABLE `nuke_banner_plans`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `nuke_banner_positions`
--
ALTER TABLE `nuke_banner_positions`
  ADD PRIMARY KEY (`apid`),
  ADD KEY `position_number` (`position_number`);

--
-- Indexes for table `nuke_banreq`
--
ALTER TABLE `nuke_banreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_bbacronyms`
--
ALTER TABLE `nuke_bbacronyms`
  ADD PRIMARY KEY (`acronym_id`);

--
-- Indexes for table `nuke_bbadvanced_username_color`
--
ALTER TABLE `nuke_bbadvanced_username_color`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `nuke_bbarcade`
--
ALTER TABLE `nuke_bbarcade`
  ADD PRIMARY KEY (`arcade_name`);

--
-- Indexes for table `nuke_bbarcade_categories`
--
ALTER TABLE `nuke_bbarcade_categories`
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `nuke_bbattachments`
--
ALTER TABLE `nuke_bbattachments`
  ADD KEY `attach_id_post_id` (`attach_id`,`post_id`),
  ADD KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `privmsgs_id` (`privmsgs_id`);

--
-- Indexes for table `nuke_bbattachments_config`
--
ALTER TABLE `nuke_bbattachments_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbattachments_desc`
--
ALTER TABLE `nuke_bbattachments_desc`
  ADD PRIMARY KEY (`attach_id`),
  ADD KEY `filetime` (`filetime`),
  ADD KEY `physical_filename` (`physical_filename`),
  ADD KEY `filesize` (`filesize`);

--
-- Indexes for table `nuke_bbattach_quota`
--
ALTER TABLE `nuke_bbattach_quota`
  ADD KEY `quota_type` (`quota_type`);

--
-- Indexes for table `nuke_bbattributes`
--
ALTER TABLE `nuke_bbattributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `nuke_bbauth_access`
--
ALTER TABLE `nuke_bbauth_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `nuke_bbauth_arcade_access`
--
ALTER TABLE `nuke_bbauth_arcade_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `nuke_bbbanlist`
--
ALTER TABLE `nuke_bbbanlist`
  ADD PRIMARY KEY (`ban_id`),
  ADD KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`);

--
-- Indexes for table `nuke_bbcanned`
--
ALTER TABLE `nuke_bbcanned`
  ADD PRIMARY KEY (`canned_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `nuke_bbcash`
--
ALTER TABLE `nuke_bbcash`
  ADD PRIMARY KEY (`cash_id`);

--
-- Indexes for table `nuke_bbcash_events`
--
ALTER TABLE `nuke_bbcash_events`
  ADD PRIMARY KEY (`event_name`);

--
-- Indexes for table `nuke_bbcash_exchange`
--
ALTER TABLE `nuke_bbcash_exchange`
  ADD PRIMARY KEY (`ex_cash_id1`,`ex_cash_id2`);

--
-- Indexes for table `nuke_bbcash_groups`
--
ALTER TABLE `nuke_bbcash_groups`
  ADD PRIMARY KEY (`group_id`,`group_type`,`cash_id`);

--
-- Indexes for table `nuke_bbcash_log`
--
ALTER TABLE `nuke_bbcash_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `nuke_bbcategories`
--
ALTER TABLE `nuke_bbcategories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_order` (`cat_order`);

--
-- Indexes for table `nuke_bbconfig`
--
ALTER TABLE `nuke_bbconfig`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbconfirm`
--
ALTER TABLE `nuke_bbconfirm`
  ADD PRIMARY KEY (`session_id`,`confirm_id`);

--
-- Indexes for table `nuke_bbcustom_canned`
--
ALTER TABLE `nuke_bbcustom_canned`
  ADD PRIMARY KEY (`custom_canned_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `nuke_bbdisallow`
--
ALTER TABLE `nuke_bbdisallow`
  ADD PRIMARY KEY (`disallow_id`);

--
-- Indexes for table `nuke_bbextensions`
--
ALTER TABLE `nuke_bbextensions`
  ADD PRIMARY KEY (`ext_id`);

--
-- Indexes for table `nuke_bbextension_groups`
--
ALTER TABLE `nuke_bbextension_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `nuke_bbfavorites`
--
ALTER TABLE `nuke_bbfavorites`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `nuke_bbflags`
--
ALTER TABLE `nuke_bbflags`
  ADD PRIMARY KEY (`flag_id`);

--
-- Indexes for table `nuke_bbforbidden_extensions`
--
ALTER TABLE `nuke_bbforbidden_extensions`
  ADD PRIMARY KEY (`ext_id`);

--
-- Indexes for table `nuke_bbforums`
--
ALTER TABLE `nuke_bbforums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `forums_order` (`forum_order`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `forum_last_post_id` (`forum_last_post_id`);

--
-- Indexes for table `nuke_bbforums_watch`
--
ALTER TABLE `nuke_bbforums_watch`
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notify_status` (`notify_status`);

--
-- Indexes for table `nuke_bbforum_prune`
--
ALTER TABLE `nuke_bbforum_prune`
  ADD PRIMARY KEY (`prune_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `nuke_bbgames`
--
ALTER TABLE `nuke_bbgames`
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `nuke_bbgames_rate`
--
ALTER TABLE `nuke_bbgames_rate`
  ADD PRIMARY KEY (`game_id`,`user_id`);

--
-- Indexes for table `nuke_bbgroups`
--
ALTER TABLE `nuke_bbgroups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_single_user` (`group_single_user`);

--
-- Indexes for table `nuke_bblogs`
--
ALTER TABLE `nuke_bblogs`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `nuke_bblogs_config`
--
ALTER TABLE `nuke_bblogs_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbposts`
--
ALTER TABLE `nuke_bbposts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `post_time` (`post_time`);

--
-- Indexes for table `nuke_bbposts_text`
--
ALTER TABLE `nuke_bbposts_text`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `nuke_bbprivmsgs`
--
ALTER TABLE `nuke_bbprivmsgs`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

--
-- Indexes for table `nuke_bbprivmsgs_archive`
--
ALTER TABLE `nuke_bbprivmsgs_archive`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

--
-- Indexes for table `nuke_bbprivmsgs_text`
--
ALTER TABLE `nuke_bbprivmsgs_text`
  ADD PRIMARY KEY (`privmsgs_text_id`);

--
-- Indexes for table `nuke_bbproxies`
--
ALTER TABLE `nuke_bbproxies`
  ADD PRIMARY KEY (`ip_address`);

--
-- Indexes for table `nuke_bbquota_limits`
--
ALTER TABLE `nuke_bbquota_limits`
  ADD PRIMARY KEY (`quota_limit_id`);

--
-- Indexes for table `nuke_bbranks`
--
ALTER TABLE `nuke_bbranks`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `nuke_bbreport`
--
ALTER TABLE `nuke_bbreport`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `report_update_user` (`report_update_user`);

--
-- Indexes for table `nuke_bbreport_cat`
--
ALTER TABLE `nuke_bbreport_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `nuke_bbscores`
--
ALTER TABLE `nuke_bbscores`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bbsearch_results`
--
ALTER TABLE `nuke_bbsearch_results`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `nuke_bbsearch_wordlist`
--
ALTER TABLE `nuke_bbsearch_wordlist`
  ADD PRIMARY KEY (`word_id`),
  ADD KEY `word_id` (`word_text`);

--
-- Indexes for table `nuke_bbsearch_wordmatch`
--
ALTER TABLE `nuke_bbsearch_wordmatch`
  ADD KEY `word_id` (`word_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `nuke_bbsessions`
--
ALTER TABLE `nuke_bbsessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_user_id` (`session_user_id`),
  ADD KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`);

--
-- Indexes for table `nuke_bbsessions_keys`
--
ALTER TABLE `nuke_bbsessions_keys`
  ADD PRIMARY KEY (`key_id`,`user_id`),
  ADD KEY `last_login` (`last_login`);

--
-- Indexes for table `nuke_bbsmilies`
--
ALTER TABLE `nuke_bbsmilies`
  ADD PRIMARY KEY (`smilies_id`);

--
-- Indexes for table `nuke_bbthemes`
--
ALTER TABLE `nuke_bbthemes`
  ADD PRIMARY KEY (`themes_id`);

--
-- Indexes for table `nuke_bbthemes_name`
--
ALTER TABLE `nuke_bbthemes_name`
  ADD PRIMARY KEY (`themes_id`);

--
-- Indexes for table `nuke_bbthread_kicker`
--
ALTER TABLE `nuke_bbthread_kicker`
  ADD PRIMARY KEY (`kick_id`);

--
-- Indexes for table `nuke_bbtopics`
--
ALTER TABLE `nuke_bbtopics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_moved_id` (`topic_moved_id`),
  ADD KEY `topic_status` (`topic_status`),
  ADD KEY `topic_type` (`topic_type`),
  ADD KEY `topic_last_post_id` (`topic_last_post_id`);

--
-- Indexes for table `nuke_bbtopics_watch`
--
ALTER TABLE `nuke_bbtopics_watch`
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notify_status` (`notify_status`);

--
-- Indexes for table `nuke_bbuser_group`
--
ALTER TABLE `nuke_bbuser_group`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bbvote_desc`
--
ALTER TABLE `nuke_bbvote_desc`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `nuke_bbvote_results`
--
ALTER TABLE `nuke_bbvote_results`
  ADD KEY `vote_option_id` (`vote_option_id`),
  ADD KEY `vote_id` (`vote_id`);

--
-- Indexes for table `nuke_bbvote_voters`
--
ALTER TABLE `nuke_bbvote_voters`
  ADD KEY `vote_id` (`vote_id`),
  ADD KEY `vote_user_id` (`vote_user_id`),
  ADD KEY `vote_user_ip` (`vote_user_ip`);

--
-- Indexes for table `nuke_bbwords`
--
ALTER TABLE `nuke_bbwords`
  ADD PRIMARY KEY (`word_id`);

--
-- Indexes for table `nuke_blocks`
--
ALTER TABLE `nuke_blocks`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `bid` (`bid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_blog_alerts`
--
ALTER TABLE `nuke_blog_alerts`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `nuke_blog_badwords`
--
ALTER TABLE `nuke_blog_badwords`
  ADD PRIMARY KEY (`word_id`);

--
-- Indexes for table `nuke_blog_blogs`
--
ALTER TABLE `nuke_blog_blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `nuke_blog_comments`
--
ALTER TABLE `nuke_blog_comments`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `nuke_blog_friends`
--
ALTER TABLE `nuke_blog_friends`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indexes for table `nuke_blog_messages`
--
ALTER TABLE `nuke_blog_messages`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `nuke_blog_moods`
--
ALTER TABLE `nuke_blog_moods`
  ADD PRIMARY KEY (`mood_id`);

--
-- Indexes for table `nuke_blog_users`
--
ALTER TABLE `nuke_blog_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `nuke_comments`
--
ALTER TABLE `nuke_comments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_config`
--
ALTER TABLE `nuke_config`
  ADD PRIMARY KEY (`sitename`);

--
-- Indexes for table `nuke_cpg_albums`
--
ALTER TABLE `nuke_cpg_albums`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `alb_category` (`category`);

--
-- Indexes for table `nuke_cpg_categories`
--
ALTER TABLE `nuke_cpg_categories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cat_parent` (`parent`),
  ADD KEY `cat_pos` (`pos`),
  ADD KEY `cat_owner_id` (`owner_id`);

--
-- Indexes for table `nuke_cpg_comments`
--
ALTER TABLE `nuke_cpg_comments`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `com_pic_id` (`pid`);

--
-- Indexes for table `nuke_cpg_config`
--
ALTER TABLE `nuke_cpg_config`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `nuke_cpg_exif`
--
ALTER TABLE `nuke_cpg_exif`
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `nuke_cpg_installs`
--
ALTER TABLE `nuke_cpg_installs`
  ADD PRIMARY KEY (`cpg_id`);

--
-- Indexes for table `nuke_cpg_pictures`
--
ALTER TABLE `nuke_cpg_pictures`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pic_hits` (`hits`),
  ADD KEY `pic_rate` (`pic_rating`),
  ADD KEY `aid_approved` (`aid`,`approved`),
  ADD KEY `randpos` (`randpos`),
  ADD KEY `pic_aid` (`aid`);
ALTER TABLE `nuke_cpg_pictures` ADD FULLTEXT KEY `search` (`title`,`caption`,`keywords`,`filename`,`user1`,`user2`,`user3`,`user4`);

--
-- Indexes for table `nuke_cpg_usergroups`
--
ALTER TABLE `nuke_cpg_usergroups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `nuke_cpg_votes`
--
ALTER TABLE `nuke_cpg_votes`
  ADD PRIMARY KEY (`pic_id`,`user_md5_id`);

--
-- Indexes for table `nuke_credits`
--
ALTER TABLE `nuke_credits`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `nuke_czuser`
--
ALTER TABLE `nuke_czuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_czuser_botlist`
--
ALTER TABLE `nuke_czuser_botlist`
  ADD PRIMARY KEY (`bot_id`);

--
-- Indexes for table `nuke_czuser_info`
--
ALTER TABLE `nuke_czuser_info`
  ADD PRIMARY KEY (`view`);

--
-- Indexes for table `nuke_czuser_mostonline`
--
ALTER TABLE `nuke_czuser_mostonline`
  ADD PRIMARY KEY (`total`);

--
-- Indexes for table `nuke_dfw_cfg`
--
ALTER TABLE `nuke_dfw_cfg`
  ADD PRIMARY KEY (`cfg_nm`);

--
-- Indexes for table `nuke_dfw_code`
--
ALTER TABLE `nuke_dfw_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_dfw_img`
--
ALTER TABLE `nuke_dfw_img`
  ADD PRIMARY KEY (`view`);

--
-- Indexes for table `nuke_don_financial`
--
ALTER TABLE `nuke_don_financial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_don_transactions`
--
ALTER TABLE `nuke_don_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_don_translog`
--
ALTER TABLE `nuke_don_translog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_downloads_categories`
--
ALTER TABLE `nuke_downloads_categories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_downloads_downloads`
--
ALTER TABLE `nuke_downloads_downloads`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_downloads_editorials`
--
ALTER TABLE `nuke_downloads_editorials`
  ADD PRIMARY KEY (`downloadid`),
  ADD KEY `downloadid` (`downloadid`);

--
-- Indexes for table `nuke_downloads_modrequest`
--
ALTER TABLE `nuke_downloads_modrequest`
  ADD PRIMARY KEY (`requestid`),
  ADD UNIQUE KEY `requestid` (`requestid`);

--
-- Indexes for table `nuke_downloads_newdownload`
--
ALTER TABLE `nuke_downloads_newdownload`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_downloads_votedata`
--
ALTER TABLE `nuke_downloads_votedata`
  ADD PRIMARY KEY (`ratingdbid`),
  ADD KEY `ratingdbid` (`ratingdbid`);

--
-- Indexes for table `nuke_faqanswer`
--
ALTER TABLE `nuke_faqanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indexes for table `nuke_faqcategories`
--
ALTER TABLE `nuke_faqcategories`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indexes for table `nuke_fga_config`
--
ALTER TABLE `nuke_fga_config`
  ADD PRIMARY KEY (`glance_news_forum_id`);

--
-- Indexes for table `nuke_forum_message`
--
ALTER TABLE `nuke_forum_message`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`);

--
-- Indexes for table `nuke_gcal_category`
--
ALTER TABLE `nuke_gcal_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_gcal_cat_group`
--
ALTER TABLE `nuke_gcal_cat_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `nuke_gcal_config`
--
ALTER TABLE `nuke_gcal_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_gcal_event`
--
ALTER TABLE `nuke_gcal_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approved` (`approved`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `repeat_type` (`repeat_type`);

--
-- Indexes for table `nuke_gcal_exception`
--
ALTER TABLE `nuke_gcal_exception`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `nuke_gcal_rsvp`
--
ALTER TABLE `nuke_gcal_rsvp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`,`user_id`);

--
-- Indexes for table `nuke_google_bot_detector`
--
ALTER TABLE `nuke_google_bot_detector`
  ADD PRIMARY KEY (`detect_id`);

--
-- Indexes for table `nuke_groups`
--
ALTER TABLE `nuke_groups`
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_groups_points`
--
ALTER TABLE `nuke_groups_points`
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_headlines`
--
ALTER TABLE `nuke_headlines`
  ADD PRIMARY KEY (`hid`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `nuke_hnl_categories`
--
ALTER TABLE `nuke_hnl_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_hnl_cfg`
--
ALTER TABLE `nuke_hnl_cfg`
  ADD PRIMARY KEY (`cfg_nm`);

--
-- Indexes for table `nuke_hnl_newsletters`
--
ALTER TABLE `nuke_hnl_newsletters`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_honeypot`
--
ALTER TABLE `nuke_honeypot`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nuke_journal`
--
ALTER TABLE `nuke_journal`
  ADD PRIMARY KEY (`jid`),
  ADD KEY `jid` (`jid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `nuke_journal_comments`
--
ALTER TABLE `nuke_journal_comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `nuke_journal_stats`
--
ALTER TABLE `nuke_journal_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_lastseen`
--
ALTER TABLE `nuke_lastseen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nuke_legal_docs`
--
ALTER TABLE `nuke_legal_docs`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `nuke_legal_text`
--
ALTER TABLE `nuke_legal_text`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `nuke_legal_text_map`
--
ALTER TABLE `nuke_legal_text_map`
  ADD UNIQUE KEY `mid` (`mid`,`did`,`tid`);

--
-- Indexes for table `nuke_links_categories`
--
ALTER TABLE `nuke_links_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_links_editorials`
--
ALTER TABLE `nuke_links_editorials`
  ADD PRIMARY KEY (`linkid`);

--
-- Indexes for table `nuke_links_links`
--
ALTER TABLE `nuke_links_links`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_links_modrequest`
--
ALTER TABLE `nuke_links_modrequest`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `nuke_links_newlink`
--
ALTER TABLE `nuke_links_newlink`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_links_votedata`
--
ALTER TABLE `nuke_links_votedata`
  ADD PRIMARY KEY (`ratingdbid`);

--
-- Indexes for table `nuke_link_us`
--
ALTER TABLE `nuke_link_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_mail_config`
--
ALTER TABLE `nuke_mail_config`
  ADD PRIMARY KEY (`mailer`);

--
-- Indexes for table `nuke_MA_mapcfg`
--
ALTER TABLE `nuke_MA_mapcfg`
  ADD UNIQUE KEY `keyfld` (`keyfld`);

--
-- Indexes for table `nuke_MA_mapp`
--
ALTER TABLE `nuke_MA_mapp`
  ADD UNIQUE KEY `fldnum` (`fldnum`);

--
-- Indexes for table `nuke_MA_mappresp`
--
ALTER TABLE `nuke_MA_mappresp`
  ADD PRIMARY KEY (`recno`);

--
-- Indexes for table `nuke_menu`
--
ALTER TABLE `nuke_menu`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_menu_cat`
--
ALTER TABLE `nuke_menu_cat`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_message`
--
ALTER TABLE `nuke_message`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`);

--
-- Indexes for table `nuke_modules`
--
ALTER TABLE `nuke_modules`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `mid` (`mid`),
  ADD KEY `title` (`title`),
  ADD KEY `custom_title` (`custom_title`);

--
-- Indexes for table `nuke_modules_categories`
--
ALTER TABLE `nuke_modules_categories`
  ADD PRIMARY KEY (`mcid`),
  ADD KEY `mcid` (`mcid`),
  ADD KEY `mcname` (`mcname`);

--
-- Indexes for table `nuke_mostonline`
--
ALTER TABLE `nuke_mostonline`
  ADD PRIMARY KEY (`total`);

--
-- Indexes for table `nuke_newpages`
--
ALTER TABLE `nuke_newpages`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_nsnba_banners`
--
ALTER TABLE `nuke_nsnba_banners`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `bid` (`bid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_nsnba_clients`
--
ALTER TABLE `nuke_nsnba_clients`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_nsnba_config`
--
ALTER TABLE `nuke_nsnba_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnba_placements`
--
ALTER TABLE `nuke_nsnba_placements`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `nuke_nsncb_blocks`
--
ALTER TABLE `nuke_nsncb_blocks`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `nuke_nsncb_config`
--
ALTER TABLE `nuke_nsncb_config`
  ADD PRIMARY KEY (`cgid`),
  ADD UNIQUE KEY `cfgid` (`cgid`);

--
-- Indexes for table `nuke_nsngd_accesses`
--
ALTER TABLE `nuke_nsngd_accesses`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `nuke_nsngd_categories`
--
ALTER TABLE `nuke_nsngd_categories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_nsngd_config`
--
ALTER TABLE `nuke_nsngd_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsngd_downloads`
--
ALTER TABLE `nuke_nsngd_downloads`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_nsngd_extensions`
--
ALTER TABLE `nuke_nsngd_extensions`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `ext` (`eid`);

--
-- Indexes for table `nuke_nsngd_mods`
--
ALTER TABLE `nuke_nsngd_mods`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `nuke_nsngd_new`
--
ALTER TABLE `nuke_nsngd_new`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_nsngr_config`
--
ALTER TABLE `nuke_nsngr_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsngr_groups`
--
ALTER TABLE `nuke_nsngr_groups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `nuke_nsnml_config`
--
ALTER TABLE `nuke_nsnml_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnml_issues`
--
ALTER TABLE `nuke_nsnml_issues`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `nuke_nsnml_lists`
--
ALTER TABLE `nuke_nsnml_lists`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `nuke_nsnml_tracked`
--
ALTER TABLE `nuke_nsnml_tracked`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `nuke_nsnml_users`
--
ALTER TABLE `nuke_nsnml_users`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `nuke_nsnsp_2_config`
--
ALTER TABLE `nuke_nsnsp_2_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnsp_2_sites`
--
ALTER TABLE `nuke_nsnsp_2_sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `nuke_nsnsp_config`
--
ALTER TABLE `nuke_nsnsp_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnsp_sites`
--
ALTER TABLE `nuke_nsnsp_sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `nuke_nsnst_admins`
--
ALTER TABLE `nuke_nsnst_admins`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `nuke_nsnst_blocked_ips`
--
ALTER TABLE `nuke_nsnst_blocked_ips`
  ADD PRIMARY KEY (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`),
  ADD KEY `c2c` (`c2c`),
  ADD KEY `date` (`date`),
  ADD KEY `expires` (`expires`),
  ADD KEY `reason` (`reason`);

--
-- Indexes for table `nuke_nsnst_blocked_ranges`
--
ALTER TABLE `nuke_nsnst_blocked_ranges`
  ADD PRIMARY KEY (`ip_lo`,`ip_hi`),
  ADD KEY `c2c` (`c2c`),
  ADD KEY `date` (`date`),
  ADD KEY `expires` (`expires`),
  ADD KEY `reason` (`reason`);

--
-- Indexes for table `nuke_nsnst_blockers`
--
ALTER TABLE `nuke_nsnst_blockers`
  ADD PRIMARY KEY (`blocker`);

--
-- Indexes for table `nuke_nsnst_cidrs`
--
ALTER TABLE `nuke_nsnst_cidrs`
  ADD PRIMARY KEY (`cidr`);

--
-- Indexes for table `nuke_nsnst_config`
--
ALTER TABLE `nuke_nsnst_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnst_countries`
--
ALTER TABLE `nuke_nsnst_countries`
  ADD PRIMARY KEY (`c2c`);

--
-- Indexes for table `nuke_nsnst_excluded_ranges`
--
ALTER TABLE `nuke_nsnst_excluded_ranges`
  ADD PRIMARY KEY (`ip_lo`,`ip_hi`),
  ADD KEY `c2c` (`c2c`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `nuke_nsnst_flood`
--
ALTER TABLE `nuke_nsnst_flood`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `nuke_nsnst_harvesters`
--
ALTER TABLE `nuke_nsnst_harvesters`
  ADD PRIMARY KEY (`harvester`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `nuke_nsnst_ip2country`
--
ALTER TABLE `nuke_nsnst_ip2country`
  ADD PRIMARY KEY (`ip_lo`,`ip_hi`),
  ADD KEY `c2c` (`c2c`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `nuke_nsnst_protected_ranges`
--
ALTER TABLE `nuke_nsnst_protected_ranges`
  ADD PRIMARY KEY (`ip_lo`,`ip_hi`),
  ADD KEY `c2c` (`c2c`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `nuke_nsnst_referers`
--
ALTER TABLE `nuke_nsnst_referers`
  ADD PRIMARY KEY (`referer`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `nuke_nsnst_strings`
--
ALTER TABLE `nuke_nsnst_strings`
  ADD PRIMARY KEY (`string`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_nsnst_tracked_ips`
--
ALTER TABLE `nuke_nsnst_tracked_ips`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `ip_addr` (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `user_agent` (`user_agent`(255)),
  ADD KEY `refered_from` (`refered_from`(255)),
  ADD KEY `date` (`date`),
  ADD KEY `page` (`page`(255)),
  ADD KEY `c2c` (`c2c`);

--
-- Indexes for table `nuke_nsnwb_members`
--
ALTER TABLE `nuke_nsnwb_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `nuke_nsnwb_members_positions`
--
ALTER TABLE `nuke_nsnwb_members_positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `nuke_nsnwb_projects`
--
ALTER TABLE `nuke_nsnwb_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `nuke_nsnwb_projects_members`
--
ALTER TABLE `nuke_nsnwb_projects_members`
  ADD KEY `project_id` (`project_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `nuke_nsnwb_projects_priorities`
--
ALTER TABLE `nuke_nsnwb_projects_priorities`
  ADD PRIMARY KEY (`priority_id`),
  ADD KEY `priority_id` (`priority_id`);

--
-- Indexes for table `nuke_nsnwb_projects_status`
--
ALTER TABLE `nuke_nsnwb_projects_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `nuke_nsnwb_tasks`
--
ALTER TABLE `nuke_nsnwb_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `nuke_nsnwb_tasks_members`
--
ALTER TABLE `nuke_nsnwb_tasks_members`
  ADD KEY `task_id` (`task_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `nuke_nsnwb_tasks_priorities`
--
ALTER TABLE `nuke_nsnwb_tasks_priorities`
  ADD PRIMARY KEY (`priority_id`),
  ADD KEY `priority_id` (`priority_id`);

--
-- Indexes for table `nuke_nsnwb_tasks_status`
--
ALTER TABLE `nuke_nsnwb_tasks_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `nuke_nsnwp_reports`
--
ALTER TABLE `nuke_nsnwp_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `nuke_nsnwp_reports_comments`
--
ALTER TABLE `nuke_nsnwp_reports_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `nuke_nsnwp_reports_status`
--
ALTER TABLE `nuke_nsnwp_reports_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `nuke_nsnwp_reports_types`
--
ALTER TABLE `nuke_nsnwp_reports_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `nuke_nsnwr_requests`
--
ALTER TABLE `nuke_nsnwr_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `nuke_nsnwr_requests_comments`
--
ALTER TABLE `nuke_nsnwr_requests_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `nuke_nsnwr_requests_status`
--
ALTER TABLE `nuke_nsnwr_requests_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `nuke_nsnwr_requests_types`
--
ALTER TABLE `nuke_nsnwr_requests_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `nuke_ns_contact_dept`
--
ALTER TABLE `nuke_ns_contact_dept`
  ADD PRIMARY KEY (`did`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `nuke_ns_contact_phone`
--
ALTER TABLE `nuke_ns_contact_phone`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `nuke_ns_downloads_field`
--
ALTER TABLE `nuke_ns_downloads_field`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `nuke_ns_downloads_nfeatured`
--
ALTER TABLE `nuke_ns_downloads_nfeatured`
  ADD PRIMARY KEY (`fdid`),
  ADD KEY `fdid` (`fdid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `nuke_ns_downloads_recom_dlstats`
--
ALTER TABLE `nuke_ns_downloads_recom_dlstats`
  ADD PRIMARY KEY (`rdid`),
  ADD KEY `rdid` (`rdid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `nuke_ns_downloads_recom_usrstats`
--
ALTER TABLE `nuke_ns_downloads_recom_usrstats`
  ADD PRIMARY KEY (`rduid`),
  ADD KEY `rduid` (`rduid`),
  ADD KEY `rdid` (`rdid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `nuke_ns_downloads_table_form`
--
ALTER TABLE `nuke_ns_downloads_table_form`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_ns_downloads_table_html`
--
ALTER TABLE `nuke_ns_downloads_table_html`
  ADD PRIMARY KEY (`thid`),
  ADD KEY `thid` (`thid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_ns_downloads_theme`
--
ALTER TABLE `nuke_ns_downloads_theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_ns_downloads_theme_mode`
--
ALTER TABLE `nuke_ns_downloads_theme_mode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_pages`
--
ALTER TABLE `nuke_pages`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_pages_categories`
--
ALTER TABLE `nuke_pages_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_pollcomments`
--
ALTER TABLE `nuke_pollcomments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `pollID` (`pollID`);

--
-- Indexes for table `nuke_poll_desc`
--
ALTER TABLE `nuke_poll_desc`
  ADD PRIMARY KEY (`pollID`),
  ADD KEY `pollID` (`pollID`);

--
-- Indexes for table `nuke_public_messages`
--
ALTER TABLE `nuke_public_messages`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `nuke_queue`
--
ALTER TABLE `nuke_queue`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `nuke_quotes`
--
ALTER TABLE `nuke_quotes`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `nuke_referer`
--
ALTER TABLE `nuke_referer`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `nuke_related`
--
ALTER TABLE `nuke_related`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `nuke_reviews`
--
ALTER TABLE `nuke_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_reviews_add`
--
ALTER TABLE `nuke_reviews_add`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `nuke_reviews_comments`
--
ALTER TABLE `nuke_reviews_comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `nuke_security_agents`
--
ALTER TABLE `nuke_security_agents`
  ADD PRIMARY KEY (`agent_name`);

--
-- Indexes for table `nuke_session`
--
ALTER TABLE `nuke_session`
  ADD KEY `time` (`time`),
  ADD KEY `guest` (`guest`);

--
-- Indexes for table `nuke_shopitems`
--
ALTER TABLE `nuke_shopitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `nuke_shops`
--
ALTER TABLE `nuke_shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopname` (`shopname`);

--
-- Indexes for table `nuke_shoutbox_censor`
--
ALTER TABLE `nuke_shoutbox_censor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_conf`
--
ALTER TABLE `nuke_shoutbox_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_date`
--
ALTER TABLE `nuke_shoutbox_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_emoticons`
--
ALTER TABLE `nuke_shoutbox_emoticons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_ipblock`
--
ALTER TABLE `nuke_shoutbox_ipblock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_manage_count`
--
ALTER TABLE `nuke_shoutbox_manage_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_nameblock`
--
ALTER TABLE `nuke_shoutbox_nameblock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_shouts`
--
ALTER TABLE `nuke_shoutbox_shouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_sticky`
--
ALTER TABLE `nuke_shoutbox_sticky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_themes`
--
ALTER TABLE `nuke_shoutbox_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_theme_images`
--
ALTER TABLE `nuke_shoutbox_theme_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_version`
--
ALTER TABLE `nuke_shoutbox_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_sommaire`
--
ALTER TABLE `nuke_sommaire`
  ADD PRIMARY KEY (`groupmenu`);

--
-- Indexes for table `nuke_sommaire_categories`
--
ALTER TABLE `nuke_sommaire_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_staff`
--
ALTER TABLE `nuke_staff`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `sid` (`sid`);

--
-- Indexes for table `nuke_staff_cat`
--
ALTER TABLE `nuke_staff_cat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nuke_stories`
--
ALTER TABLE `nuke_stories`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `counter` (`counter`),
  ADD KEY `topic` (`topic`);

--
-- Indexes for table `nuke_stories_cat`
--
ALTER TABLE `nuke_stories_cat`
  ADD PRIMARY KEY (`catid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `nuke_subscriptions`
--
ALTER TABLE `nuke_subscriptions`
  ADD KEY `id` (`id`,`userid`);

--
-- Indexes for table `nuke_themeconsole`
--
ALTER TABLE `nuke_themeconsole`
  ADD KEY `themename` (`themename`);

--
-- Indexes for table `nuke_topics`
--
ALTER TABLE `nuke_topics`
  ADD PRIMARY KEY (`topicid`),
  ADD KEY `topicid` (`topicid`);

--
-- Indexes for table `nuke_top_sites`
--
ALTER TABLE `nuke_top_sites`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `nuke_top_sites_categories`
--
ALTER TABLE `nuke_top_sites_categories`
  ADD PRIMARY KEY (`catid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `catname` (`catname`);

--
-- Indexes for table `nuke_top_sites_votedata`
--
ALTER TABLE `nuke_top_sites_votedata`
  ADD PRIMARY KEY (`ratingdbid`),
  ADD KEY `ratingdbid` (`ratingdbid`);

--
-- Indexes for table `nuke_tutorials_categories`
--
ALTER TABLE `nuke_tutorials_categories`
  ADD PRIMARY KEY (`tc_id`),
  ADD KEY `tc_id` (`tc_id`),
  ADD KEY `tc_title` (`tc_title`);

--
-- Indexes for table `nuke_tutorials_favorites`
--
ALTER TABLE `nuke_tutorials_favorites`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `nuke_tutorials_levels`
--
ALTER TABLE `nuke_tutorials_levels`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `title` (`title`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_tutorials_submit`
--
ALTER TABLE `nuke_tutorials_submit`
  ADD PRIMARY KEY (`t_submitid`),
  ADD KEY `t_submitid` (`t_submitid`),
  ADD KEY `tc_id` (`tc_id`);

--
-- Indexes for table `nuke_tutorials_tutorials`
--
ALTER TABLE `nuke_tutorials_tutorials`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `tc_id` (`tc_id`);

--
-- Indexes for table `nuke_tutorials_votedata`
--
ALTER TABLE `nuke_tutorials_votedata`
  ADD PRIMARY KEY (`ratingdbid`),
  ADD KEY `ratingdbid` (`ratingdbid`);

--
-- Indexes for table `nuke_universal_categories`
--
ALTER TABLE `nuke_universal_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_universal_comments`
--
ALTER TABLE `nuke_universal_comments`
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `nuke_universal_items`
--
ALTER TABLE `nuke_universal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_universal_modify`
--
ALTER TABLE `nuke_universal_modify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_universal_queue`
--
ALTER TABLE `nuke_universal_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_universal_related`
--
ALTER TABLE `nuke_universal_related`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `nuke_universal_requests`
--
ALTER TABLE `nuke_universal_requests`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nuke_users`
--
ALTER TABLE `nuke_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `uid` (`user_id`),
  ADD KEY `uname` (`username`),
  ADD KEY `user_session_time` (`user_session_time`);

--
-- Indexes for table `nuke_users_config`
--
ALTER TABLE `nuke_users_config`
  ADD UNIQUE KEY `config_name` (`config_name`);

--
-- Indexes for table `nuke_users_fields`
--
ALTER TABLE `nuke_users_fields`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `nuke_users_field_values`
--
ALTER TABLE `nuke_users_field_values`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `nuke_users_temp`
--
ALTER TABLE `nuke_users_temp`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `nuke_users_temp_field_values`
--
ALTER TABLE `nuke_users_temp_field_values`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `nuke_video_stream`
--
ALTER TABLE `nuke_video_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_video_stream_broken`
--
ALTER TABLE `nuke_video_stream_broken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_video_stream_categories`
--
ALTER TABLE `nuke_video_stream_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_video_stream_comments`
--
ALTER TABLE `nuke_video_stream_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_video_stream_points`
--
ALTER TABLE `nuke_video_stream_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_video_stream_settings`
--
ALTER TABLE `nuke_video_stream_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_webcrawlers`
--
ALTER TABLE `nuke_webcrawlers`
  ADD PRIMARY KEY (`webcrawler`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nukec30_ads_ads`
--
ALTER TABLE `nukec30_ads_ads`
  MODIFY `id_ads` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_box`
--
ALTER TABLE `nukec30_ads_box`
  MODIFY `id_save` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_catg`
--
ALTER TABLE `nukec30_ads_catg`
  MODIFY `id_catg` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_comments`
--
ALTER TABLE `nukec30_ads_comments`
  MODIFY `no_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_currency`
--
ALTER TABLE `nukec30_ads_currency`
  MODIFY `no` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_custom`
--
ALTER TABLE `nukec30_ads_custom`
  MODIFY `custom_id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_disclaimer`
--
ALTER TABLE `nukec30_ads_disclaimer`
  MODIFY `no` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_duration`
--
ALTER TABLE `nukec30_ads_duration`
  MODIFY `id_duration` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nukec30_ads_filter`
--
ALTER TABLE `nukec30_ads_filter`
  MODIFY `word_id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_about_us`
--
ALTER TABLE `nuke_about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_cache`
--
ALTER TABLE `nuke_amazon_cache`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_cart`
--
ALTER TABLE `nuke_amazon_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_catalog`
--
ALTER TABLE `nuke_amazon_catalog`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_department`
--
ALTER TABLE `nuke_amazon_department`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_items`
--
ALTER TABLE `nuke_amazon_items`
  MODIFY `iid` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_nodes`
--
ALTER TABLE `nuke_amazon_nodes`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_amazon_not_item`
--
ALTER TABLE `nuke_amazon_not_item`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_autonews`
--
ALTER TABLE `nuke_autonews`
  MODIFY `anid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banned_ip`
--
ALTER TABLE `nuke_banned_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banner`
--
ALTER TABLE `nuke_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banner_clients`
--
ALTER TABLE `nuke_banner_clients`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banner_plans`
--
ALTER TABLE `nuke_banner_plans`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banner_positions`
--
ALTER TABLE `nuke_banner_positions`
  MODIFY `apid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banreq`
--
ALTER TABLE `nuke_banreq`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbacronyms`
--
ALTER TABLE `nuke_bbacronyms`
  MODIFY `acronym_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbadvanced_username_color`
--
ALTER TABLE `nuke_bbadvanced_username_color`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbarcade_categories`
--
ALTER TABLE `nuke_bbarcade_categories`
  MODIFY `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbattachments_desc`
--
ALTER TABLE `nuke_bbattachments_desc`
  MODIFY `attach_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbattributes`
--
ALTER TABLE `nuke_bbattributes`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbbanlist`
--
ALTER TABLE `nuke_bbbanlist`
  MODIFY `ban_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcanned`
--
ALTER TABLE `nuke_bbcanned`
  MODIFY `canned_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcash`
--
ALTER TABLE `nuke_bbcash`
  MODIFY `cash_id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcash_log`
--
ALTER TABLE `nuke_bbcash_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcategories`
--
ALTER TABLE `nuke_bbcategories`
  MODIFY `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcustom_canned`
--
ALTER TABLE `nuke_bbcustom_canned`
  MODIFY `custom_canned_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbdisallow`
--
ALTER TABLE `nuke_bbdisallow`
  MODIFY `disallow_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbextensions`
--
ALTER TABLE `nuke_bbextensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbextension_groups`
--
ALTER TABLE `nuke_bbextension_groups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbfavorites`
--
ALTER TABLE `nuke_bbfavorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbflags`
--
ALTER TABLE `nuke_bbflags`
  MODIFY `flag_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbforbidden_extensions`
--
ALTER TABLE `nuke_bbforbidden_extensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbforums`
--
ALTER TABLE `nuke_bbforums`
  MODIFY `forum_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbforum_prune`
--
ALTER TABLE `nuke_bbforum_prune`
  MODIFY `prune_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbgames`
--
ALTER TABLE `nuke_bbgames`
  MODIFY `game_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbgroups`
--
ALTER TABLE `nuke_bbgroups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bblogs`
--
ALTER TABLE `nuke_bblogs`
  MODIFY `id_log` mediumint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbposts`
--
ALTER TABLE `nuke_bbposts`
  MODIFY `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbprivmsgs`
--
ALTER TABLE `nuke_bbprivmsgs`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbprivmsgs_archive`
--
ALTER TABLE `nuke_bbprivmsgs_archive`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbquota_limits`
--
ALTER TABLE `nuke_bbquota_limits`
  MODIFY `quota_limit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbranks`
--
ALTER TABLE `nuke_bbranks`
  MODIFY `rank_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbreport`
--
ALTER TABLE `nuke_bbreport`
  MODIFY `report_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbreport_cat`
--
ALTER TABLE `nuke_bbreport_cat`
  MODIFY `cat_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbsearch_wordlist`
--
ALTER TABLE `nuke_bbsearch_wordlist`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbsmilies`
--
ALTER TABLE `nuke_bbsmilies`
  MODIFY `smilies_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbthemes`
--
ALTER TABLE `nuke_bbthemes`
  MODIFY `themes_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbthread_kicker`
--
ALTER TABLE `nuke_bbthread_kicker`
  MODIFY `kick_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbtopics`
--
ALTER TABLE `nuke_bbtopics`
  MODIFY `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbvote_desc`
--
ALTER TABLE `nuke_bbvote_desc`
  MODIFY `vote_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbwords`
--
ALTER TABLE `nuke_bbwords`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blocks`
--
ALTER TABLE `nuke_blocks`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_alerts`
--
ALTER TABLE `nuke_blog_alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_badwords`
--
ALTER TABLE `nuke_blog_badwords`
  MODIFY `word_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_blogs`
--
ALTER TABLE `nuke_blog_blogs`
  MODIFY `blog_id` mediumint(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_comments`
--
ALTER TABLE `nuke_blog_comments`
  MODIFY `comm_id` mediumint(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_friends`
--
ALTER TABLE `nuke_blog_friends`
  MODIFY `friend_id` mediumint(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_messages`
--
ALTER TABLE `nuke_blog_messages`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_moods`
--
ALTER TABLE `nuke_blog_moods`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blog_users`
--
ALTER TABLE `nuke_blog_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_comments`
--
ALTER TABLE `nuke_comments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_albums`
--
ALTER TABLE `nuke_cpg_albums`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_categories`
--
ALTER TABLE `nuke_cpg_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_comments`
--
ALTER TABLE `nuke_cpg_comments`
  MODIFY `msg_id` mediumint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_installs`
--
ALTER TABLE `nuke_cpg_installs`
  MODIFY `cpg_id` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_pictures`
--
ALTER TABLE `nuke_cpg_pictures`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cpg_usergroups`
--
ALTER TABLE `nuke_cpg_usergroups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_credits`
--
ALTER TABLE `nuke_credits`
  MODIFY `credit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_czuser`
--
ALTER TABLE `nuke_czuser`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_czuser_botlist`
--
ALTER TABLE `nuke_czuser_botlist`
  MODIFY `bot_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_dfw_code`
--
ALTER TABLE `nuke_dfw_code`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_don_financial`
--
ALTER TABLE `nuke_don_financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_don_transactions`
--
ALTER TABLE `nuke_don_transactions`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_don_translog`
--
ALTER TABLE `nuke_don_translog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_downloads_categories`
--
ALTER TABLE `nuke_downloads_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_downloads_downloads`
--
ALTER TABLE `nuke_downloads_downloads`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_downloads_modrequest`
--
ALTER TABLE `nuke_downloads_modrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_downloads_newdownload`
--
ALTER TABLE `nuke_downloads_newdownload`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_downloads_votedata`
--
ALTER TABLE `nuke_downloads_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_faqanswer`
--
ALTER TABLE `nuke_faqanswer`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_faqcategories`
--
ALTER TABLE `nuke_faqcategories`
  MODIFY `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_forum_message`
--
ALTER TABLE `nuke_forum_message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_category`
--
ALTER TABLE `nuke_gcal_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_cat_group`
--
ALTER TABLE `nuke_gcal_cat_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_config`
--
ALTER TABLE `nuke_gcal_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_event`
--
ALTER TABLE `nuke_gcal_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_exception`
--
ALTER TABLE `nuke_gcal_exception`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_gcal_rsvp`
--
ALTER TABLE `nuke_gcal_rsvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_google_bot_detector`
--
ALTER TABLE `nuke_google_bot_detector`
  MODIFY `detect_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_groups`
--
ALTER TABLE `nuke_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_groups_points`
--
ALTER TABLE `nuke_groups_points`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_headlines`
--
ALTER TABLE `nuke_headlines`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_hnl_categories`
--
ALTER TABLE `nuke_hnl_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_hnl_newsletters`
--
ALTER TABLE `nuke_hnl_newsletters`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_honeypot`
--
ALTER TABLE `nuke_honeypot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_journal`
--
ALTER TABLE `nuke_journal`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_journal_comments`
--
ALTER TABLE `nuke_journal_comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_journal_stats`
--
ALTER TABLE `nuke_journal_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_lastseen`
--
ALTER TABLE `nuke_lastseen`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_legal_docs`
--
ALTER TABLE `nuke_legal_docs`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_legal_text`
--
ALTER TABLE `nuke_legal_text`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_categories`
--
ALTER TABLE `nuke_links_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_links`
--
ALTER TABLE `nuke_links_links`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_modrequest`
--
ALTER TABLE `nuke_links_modrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_newlink`
--
ALTER TABLE `nuke_links_newlink`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_votedata`
--
ALTER TABLE `nuke_links_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_link_us`
--
ALTER TABLE `nuke_link_us`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_MA_mapcfg`
--
ALTER TABLE `nuke_MA_mapcfg`
  MODIFY `keyfld` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_MA_mapp`
--
ALTER TABLE `nuke_MA_mapp`
  MODIFY `fldnum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_MA_mappresp`
--
ALTER TABLE `nuke_MA_mappresp`
  MODIFY `recno` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_menu`
--
ALTER TABLE `nuke_menu`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_menu_cat`
--
ALTER TABLE `nuke_menu_cat`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_message`
--
ALTER TABLE `nuke_message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_modules`
--
ALTER TABLE `nuke_modules`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_modules_categories`
--
ALTER TABLE `nuke_modules_categories`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_newpages`
--
ALTER TABLE `nuke_newpages`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnba_banners`
--
ALTER TABLE `nuke_nsnba_banners`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnba_clients`
--
ALTER TABLE `nuke_nsnba_clients`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnba_placements`
--
ALTER TABLE `nuke_nsnba_placements`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngd_categories`
--
ALTER TABLE `nuke_nsngd_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngd_downloads`
--
ALTER TABLE `nuke_nsngd_downloads`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngd_extensions`
--
ALTER TABLE `nuke_nsngd_extensions`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngd_mods`
--
ALTER TABLE `nuke_nsngd_mods`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngd_new`
--
ALTER TABLE `nuke_nsngd_new`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsngr_groups`
--
ALTER TABLE `nuke_nsngr_groups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnml_issues`
--
ALTER TABLE `nuke_nsnml_issues`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnml_lists`
--
ALTER TABLE `nuke_nsnml_lists`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnml_tracked`
--
ALTER TABLE `nuke_nsnml_tracked`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnml_users`
--
ALTER TABLE `nuke_nsnml_users`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnsp_2_sites`
--
ALTER TABLE `nuke_nsnsp_2_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnsp_sites`
--
ALTER TABLE `nuke_nsnsp_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnst_harvesters`
--
ALTER TABLE `nuke_nsnst_harvesters`
  MODIFY `hid` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnst_referers`
--
ALTER TABLE `nuke_nsnst_referers`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnst_strings`
--
ALTER TABLE `nuke_nsnst_strings`
  MODIFY `sid` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnst_tracked_ips`
--
ALTER TABLE `nuke_nsnst_tracked_ips`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_members`
--
ALTER TABLE `nuke_nsnwb_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_members_positions`
--
ALTER TABLE `nuke_nsnwb_members_positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_projects`
--
ALTER TABLE `nuke_nsnwb_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_projects_priorities`
--
ALTER TABLE `nuke_nsnwb_projects_priorities`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_projects_status`
--
ALTER TABLE `nuke_nsnwb_projects_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_tasks`
--
ALTER TABLE `nuke_nsnwb_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_tasks_priorities`
--
ALTER TABLE `nuke_nsnwb_tasks_priorities`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwb_tasks_status`
--
ALTER TABLE `nuke_nsnwb_tasks_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwp_reports`
--
ALTER TABLE `nuke_nsnwp_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwp_reports_comments`
--
ALTER TABLE `nuke_nsnwp_reports_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwp_reports_status`
--
ALTER TABLE `nuke_nsnwp_reports_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwp_reports_types`
--
ALTER TABLE `nuke_nsnwp_reports_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwr_requests`
--
ALTER TABLE `nuke_nsnwr_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwr_requests_comments`
--
ALTER TABLE `nuke_nsnwr_requests_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwr_requests_status`
--
ALTER TABLE `nuke_nsnwr_requests_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnwr_requests_types`
--
ALTER TABLE `nuke_nsnwr_requests_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_contact_dept`
--
ALTER TABLE `nuke_ns_contact_dept`
  MODIFY `did` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_contact_phone`
--
ALTER TABLE `nuke_ns_contact_phone`
  MODIFY `pid` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_field`
--
ALTER TABLE `nuke_ns_downloads_field`
  MODIFY `fid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_nfeatured`
--
ALTER TABLE `nuke_ns_downloads_nfeatured`
  MODIFY `fdid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_recom_dlstats`
--
ALTER TABLE `nuke_ns_downloads_recom_dlstats`
  MODIFY `rdid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_recom_usrstats`
--
ALTER TABLE `nuke_ns_downloads_recom_usrstats`
  MODIFY `rduid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_table_form`
--
ALTER TABLE `nuke_ns_downloads_table_form`
  MODIFY `tid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_table_html`
--
ALTER TABLE `nuke_ns_downloads_table_html`
  MODIFY `thid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ns_downloads_theme`
--
ALTER TABLE `nuke_ns_downloads_theme`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_pages`
--
ALTER TABLE `nuke_pages`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_pages_categories`
--
ALTER TABLE `nuke_pages_categories`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_pollcomments`
--
ALTER TABLE `nuke_pollcomments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_poll_desc`
--
ALTER TABLE `nuke_poll_desc`
  MODIFY `pollID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_public_messages`
--
ALTER TABLE `nuke_public_messages`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_queue`
--
ALTER TABLE `nuke_queue`
  MODIFY `qid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_quotes`
--
ALTER TABLE `nuke_quotes`
  MODIFY `qid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_referer`
--
ALTER TABLE `nuke_referer`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_related`
--
ALTER TABLE `nuke_related`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews`
--
ALTER TABLE `nuke_reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews_add`
--
ALTER TABLE `nuke_reviews_add`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews_comments`
--
ALTER TABLE `nuke_reviews_comments`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shopitems`
--
ALTER TABLE `nuke_shopitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shops`
--
ALTER TABLE `nuke_shops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_censor`
--
ALTER TABLE `nuke_shoutbox_censor`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_emoticons`
--
ALTER TABLE `nuke_shoutbox_emoticons`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_ipblock`
--
ALTER TABLE `nuke_shoutbox_ipblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_manage_count`
--
ALTER TABLE `nuke_shoutbox_manage_count`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_nameblock`
--
ALTER TABLE `nuke_shoutbox_nameblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_shouts`
--
ALTER TABLE `nuke_shoutbox_shouts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_sticky`
--
ALTER TABLE `nuke_shoutbox_sticky`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_themes`
--
ALTER TABLE `nuke_shoutbox_themes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_theme_images`
--
ALTER TABLE `nuke_shoutbox_theme_images`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_sommaire_categories`
--
ALTER TABLE `nuke_sommaire_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_staff`
--
ALTER TABLE `nuke_staff`
  MODIFY `sid` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_staff_cat`
--
ALTER TABLE `nuke_staff_cat`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_stories`
--
ALTER TABLE `nuke_stories`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_stories_cat`
--
ALTER TABLE `nuke_stories_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_subscriptions`
--
ALTER TABLE `nuke_subscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_topics`
--
ALTER TABLE `nuke_topics`
  MODIFY `topicid` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_top_sites`
--
ALTER TABLE `nuke_top_sites`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_top_sites_categories`
--
ALTER TABLE `nuke_top_sites_categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_top_sites_votedata`
--
ALTER TABLE `nuke_top_sites_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_categories`
--
ALTER TABLE `nuke_tutorials_categories`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_favorites`
--
ALTER TABLE `nuke_tutorials_favorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_levels`
--
ALTER TABLE `nuke_tutorials_levels`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_submit`
--
ALTER TABLE `nuke_tutorials_submit`
  MODIFY `t_submitid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_tutorials`
--
ALTER TABLE `nuke_tutorials_tutorials`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_tutorials_votedata`
--
ALTER TABLE `nuke_tutorials_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_categories`
--
ALTER TABLE `nuke_universal_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_comments`
--
ALTER TABLE `nuke_universal_comments`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_items`
--
ALTER TABLE `nuke_universal_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_queue`
--
ALTER TABLE `nuke_universal_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_related`
--
ALTER TABLE `nuke_universal_related`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_universal_requests`
--
ALTER TABLE `nuke_universal_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users`
--
ALTER TABLE `nuke_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users_fields`
--
ALTER TABLE `nuke_users_fields`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users_field_values`
--
ALTER TABLE `nuke_users_field_values`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users_temp`
--
ALTER TABLE `nuke_users_temp`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users_temp_field_values`
--
ALTER TABLE `nuke_users_temp_field_values`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream`
--
ALTER TABLE `nuke_video_stream`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream_broken`
--
ALTER TABLE `nuke_video_stream_broken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream_categories`
--
ALTER TABLE `nuke_video_stream_categories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream_comments`
--
ALTER TABLE `nuke_video_stream_comments`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream_points`
--
ALTER TABLE `nuke_video_stream_points`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_video_stream_settings`
--
ALTER TABLE `nuke_video_stream_settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
