-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2022 at 11:37 AM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ontiknet_sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `id` int(10) UNSIGNED NOT NULL,
  `create` tinyint(1) NOT NULL DEFAULT 0,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `update` tinyint(1) NOT NULL DEFAULT 0,
  `delete` tinyint(1) NOT NULL DEFAULT 0,
  `module_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`id`, `create`, `read`, `update`, `delete`, `module_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(2, 1, 1, 1, 1, 2, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(3, 1, 1, 1, 1, 3, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(4, 1, 1, 1, 1, 4, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(5, 1, 1, 1, 1, 5, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(6, 1, 1, 1, 1, 6, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(8, 1, 1, 1, 1, 8, 1, 1, 1, '2017-12-07 00:03:30', '2019-07-14 10:51:48'),
(9, 1, 1, 1, 1, 9, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(10, 1, 1, 1, 1, 10, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(11, 1, 1, 1, 1, 11, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(12, 1, 1, 1, 1, 12, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(13, 1, 1, 1, 1, 13, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(14, 1, 1, 1, 1, 14, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(15, 1, 1, 1, 1, 15, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(16, 1, 1, 1, 1, 16, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(17, 1, 1, 1, 1, 17, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(18, 1, 1, 1, 1, 18, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(20, 1, 1, 1, 1, 20, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(21, 1, 1, 1, 1, 21, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(23, 1, 1, 1, 1, 23, 1, 1, 1, '2017-12-07 00:03:31', '2019-07-14 10:51:49'),
(115, 1, 1, 1, 1, 1, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(116, 1, 1, 1, 1, 2, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(117, 1, 1, 1, 1, 3, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(118, 1, 1, 1, 1, 4, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(119, 1, 1, 1, 1, 5, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(120, 1, 1, 1, 1, 6, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(122, 1, 1, 1, 1, 8, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(123, 1, 1, 1, 1, 9, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(124, 1, 1, 1, 1, 10, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(125, 1, 1, 1, 1, 11, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(126, 1, 1, 1, 1, 12, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(127, 1, 1, 1, 1, 13, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(128, 1, 1, 1, 1, 14, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:12'),
(129, 1, 1, 1, 1, 15, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(130, 1, 1, 1, 1, 16, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(131, 1, 1, 1, 1, 17, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(132, 1, 1, 1, 1, 18, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(134, 1, 1, 1, 1, 20, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(135, 1, 1, 1, 1, 21, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(137, 1, 1, 1, 1, 23, 2, 1, 1, '2019-05-10 02:21:33', '2019-07-20 08:41:13'),
(241, 1, 1, 1, 1, 115, 1, 1, 1, '2019-07-14 10:51:49', '2019-07-14 10:52:02'),
(243, 1, 1, 1, 1, 115, 2, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(250, 1, 1, 1, 1, 125, 1, 1, 1, '2019-07-20 08:41:13', '2021-12-21 19:58:13'),
(251, 1, 1, 1, 1, 126, 1, 1, 1, '2019-07-20 08:41:13', '2021-12-21 19:58:13'),
(253, 1, 1, 1, 1, 19, 1, 1, 1, '2019-07-20 08:41:13', '2021-11-18 12:33:00'),
(254, 1, 1, 1, 1, 127, 1, 1, 1, '2019-07-20 08:41:13', '2021-12-21 19:58:13'),
(255, 1, 1, 1, 1, 128, 1, 1, 1, '2019-07-20 08:41:13', '2021-12-21 19:58:13'),
(256, 1, 1, 1, 1, 19, 2, 1, 1, '2021-12-21 19:41:33', '2021-12-21 19:53:33'),
(257, 1, 1, 1, 1, 125, 2, 1, 1, '2021-12-21 19:41:33', '2021-12-21 19:57:40'),
(258, 1, 1, 1, 1, 126, 2, 1, 1, '2021-12-21 19:41:33', '2021-12-21 19:57:40'),
(259, 1, 1, 1, 1, 127, 2, 1, 1, '2021-12-21 19:41:33', '2021-12-21 19:57:40'),
(260, 1, 1, 1, 1, 128, 2, 1, 1, '2021-12-21 19:41:33', '2021-12-21 19:57:40'),
(261, 1, 1, 1, 1, 116, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(262, 1, 1, 1, 1, 117, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(263, 1, 1, 1, 1, 118, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(264, 1, 1, 1, 1, 119, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(265, 1, 1, 1, 1, 120, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(266, 1, 1, 1, 1, 121, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(267, 1, 1, 1, 1, 122, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(268, 1, 1, 1, 1, 123, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(269, 1, 1, 1, 1, 124, 2, 1, 1, '2021-12-21 19:57:20', '2021-12-21 19:57:40'),
(270, 1, 1, 1, 1, 116, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(271, 1, 1, 1, 1, 117, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(272, 1, 1, 1, 1, 118, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(273, 1, 1, 1, 1, 119, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(274, 1, 1, 1, 1, 120, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(275, 1, 1, 1, 1, 121, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(276, 1, 1, 1, 1, 122, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(277, 1, 1, 1, 1, 123, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13'),
(278, 1, 1, 1, 1, 124, 1, 1, 1, '2021-12-21 19:57:55', '2021-12-21 19:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `dashboard_watchlist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_type_id` int(10) UNSIGNED NOT NULL,
  `parent_account_type_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_name`, `account_code`, `description`, `dashboard_watchlist`, `required_status`, `account_type_id`, `parent_account_type_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Advance Tax', 'Advance Tax', 'Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.', '0', '1', 3, 1, 1, 1, 1, '1975-08-19 20:44:01', '2004-03-15 14:29:20'),
(2, 'Employee Advance', 'Employee Advance', 'Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.', '0', '1', 3, 1, 1, 1, 1, '1994-11-25 17:28:57', '2015-09-24 17:47:06'),
(3, 'Cash', 'Cash', 'It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.', '0', '1', 4, 1, 1, 1, 1, '2009-03-30 19:10:49', '1976-02-11 10:27:51'),
(4, 'Undeposited Funds', 'Undeposited Funds', 'Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.', '0', '1', 4, 1, 1, 1, 1, '2015-01-18 06:17:38', '2000-02-19 03:26:55'),
(5, 'Accounts Receivable', 'Accounts Receivable', 'The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.', '0', '1', 2, 1, 1, 1, 1, '1998-10-26 21:15:41', '2002-02-15 22:45:16'),
(6, 'Inventory Asset', 'Inventory Asset', 'An account which tracks the value of goods in your inventory.', '0', '1', 7, 1, 1, 1, 1, '2017-10-16 20:14:10', '1991-09-13 22:24:35'),
(7, 'Opening Balance Adjustments', 'Opening Balance Adjustments', 'This account will hold the difference in the debits and credits entered during the opening balance.', '0', '1', 9, 2, 1, 1, 1, '1971-05-31 15:41:05', '1971-10-15 08:45:24'),
(8, 'Employee Reimbursements', 'Employee Reimbursements', 'This account can be used to track the reimbursements that are due to be paid out to employees.', '0', '1', 9, 2, 1, 1, 1, '1975-08-31 23:21:54', '1982-01-22 01:26:42'),
(9, 'Tax Payable', 'Tax Payable', 'The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.', '0', '1', 9, 2, 1, 1, 1, '1987-10-15 01:46:56', '2012-07-08 19:32:43'),
(10, 'Unearned Revenue', 'Unearned Revenue', 'A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.', '0', '1', 9, 2, 1, 1, 1, '1996-02-09 05:23:42', '2016-12-22 04:17:22'),
(11, 'Accounts Payable', 'Accounts Payable', 'This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.', '0', '1', 13, 2, 1, 1, 1, '2000-09-18 04:35:56', '2016-03-19 17:10:13'),
(12, 'Tag Adjustments', 'Tag Adjustments', 'This adjustment account tracks the transfers between different reporting tags.', '0', '1', 12, 2, 1, 1, 1, '2014-03-04 12:59:15', '1982-01-14 08:48:12'),
(13, 'Drawings', 'Drawings', 'The money withdrawn from a business by its owner can be tracked with this account.', '0', '1', 14, 3, 1, 1, 1, '1972-04-09 18:09:04', '2005-11-08 10:03:40'),
(14, 'Opening Balance Offset', 'Opening Balance Offset', 'This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.', '0', '1', 14, 3, 1, 1, 1, '1975-06-03 17:31:16', '1981-11-06 10:44:05'),
(15, 'Owner Equity', 'Owner Equity', 'The owners rights to the assets of a company can be quantified in the owner\'s equity account.', '0', '1', 14, 3, 1, 1, 1, '1999-09-19 05:25:06', '1998-01-07 08:59:05'),
(16, 'Sales', 'Sales', 'The income from the sales in your business is recorded under the sales account.', '0', '1', 15, 4, 1, 1, 1, '2015-04-07 18:20:35', '1987-07-11 13:58:58'),
(17, 'General Income', 'General Income', 'A general category of account where you can record any income which cannot be recorded into any other category.', '0', '1', 15, 4, 1, 1, 1, '1979-08-17 18:26:41', '1991-11-08 18:41:05'),
(18, 'Other Charges', 'Other Charges', 'Miscellaneous charges like adjustments made to the invoice can be recorded in this account.', '0', '1', 15, 4, 1, 1, 1, '1990-10-23 16:05:29', '1997-12-12 19:52:50'),
(19, 'Interest Income', 'Interest Income', 'A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.', '0', '1', 15, 4, 1, 1, 1, '2018-02-22 02:00:28', '2017-04-07 00:18:18'),
(20, 'Shipping Charge', 'Shipping Charge', 'Shipping charges made to the invoice will be recorded in this account.', '0', '1', 15, 4, 1, 1, 1, '2006-10-03 23:35:20', '2014-11-28 09:03:27'),
(21, 'Discount', 'Discount', 'Any reduction on your selling price as a discount can be recorded into the discount account.', '0', '1', 15, 4, 1, 1, 1, '1980-04-21 19:09:00', '1984-06-28 03:40:03'),
(22, 'Late Fee Income', 'Late Fee Income', 'Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.', '0', '1', 15, 4, 1, 1, 1, '2002-03-05 08:34:37', '1991-12-24 12:41:54'),
(23, 'Other Expenses', 'Other Expenses', 'Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.', '0', '1', 17, 5, 1, 1, 1, '1973-04-20 05:16:04', '2009-02-06 14:11:13'),
(24, 'Bad Debt', 'Bad Debt', 'Any amount which is lost and is unrecoverable is recorded into the bad debt account.', '0', '1', 17, 5, 1, 1, 1, '1990-11-06 11:47:55', '2010-03-04 10:39:30'),
(25, 'Exchange Gain or Loss', 'Exchange Gain or Loss', 'Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.', '0', '1', 19, 5, 1, 1, 1, '2010-02-24 02:55:32', '2017-11-24 10:29:02'),
(26, 'Cost of Goods Sold', 'Cost of Goods Sold', 'An expense account which tracks the value of the goods sold.', '0', '1', 18, 5, 1, 1, 1, '2005-08-06 09:11:59', '2008-06-27 08:46:29'),
(27, 'Prepaid Expense', 'Prepaid Expense', 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.', '0', '1', 3, 1, 1, 1, 1, '1994-02-07 17:46:52', '2012-03-15 17:28:46'),
(28, 'Conveyance', 'Conveyance', 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.', '0', '1', 17, 5, 1, 1, 1, '1987-07-06 19:16:48', '2015-04-03 02:21:00'),
(30, 'Agent Commission', 'Agent Commission', 'Agent Commission.', '0', '1', 3, 1, 1, 1, 1, '1994-09-18 08:04:55', '1971-02-09 02:08:09'),
(103, 'DBBL', 'DBBL', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2021-09-05 08:03:13', '2021-09-05 08:03:13'),
(104, 'test bank', 'test bank', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2021-12-06 06:47:17', '2021-12-06 06:47:17'),
(105, 'Cartoon Sell', '', '', NULL, NULL, 16, 4, 3, 26, 26, '2022-02-24 10:12:15', '2022-02-24 10:12:15'),
(106, 'Internet Bill', '', '', NULL, NULL, 19, 5, 3, 26, 26, '2022-02-24 10:13:29', '2022-02-24 10:13:29'),
(107, 'Wholesale', '', '', NULL, NULL, 15, 4, 3, 26, 26, '2022-02-24 10:51:16', '2022-02-24 10:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_account_type_id` int(10) UNSIGNED NOT NULL,
  `required_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `account_name`, `description`, `parent_account_type_id`, `required_status`, `created_at`, `updated_at`) VALUES
(1, 'Other Asset', 'Track special assets like goodwill and other intangible assets', 1, 0, '2006-12-10 00:56:44', '1992-12-23 08:58:40'),
(2, 'Accounts Receivable', 'Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices', 1, 1, '1994-11-06 19:43:24', '1988-10-12 13:13:54'),
(3, 'Other Current asset', 'Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds', 1, 0, '1997-04-02 23:06:59', '1982-07-02 01:40:37'),
(4, 'Cash', 'To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.', 1, 0, '1983-12-30 10:45:16', '1993-10-05 06:58:23'),
(5, 'Bank', 'To keep track of bank accounts like Savings, Checking, and Money Market accounts', 1, 0, '1993-07-13 01:38:48', '1996-11-21 10:32:52'),
(6, 'Fixed asset', 'Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture', 1, 0, '1975-11-13 15:16:03', '1999-03-13 21:06:20'),
(7, 'Stock', 'To keep track of your inventory assets.', 1, 0, '1988-11-03 20:37:59', '1989-02-24 14:38:31'),
(9, 'Other Current Liability', 'Any short term liability like:Customer Deposits - Tax Payable', 2, 0, '2006-11-28 12:21:19', '1983-02-11 23:23:49'),
(10, 'Credit Card', 'Create a trail of all your credit card transactions by creating a credit card account', 2, 0, '1979-12-13 17:48:02', '2003-06-04 15:14:20'),
(11, 'Long Term Liability', 'Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans', 2, 0, '1995-02-27 22:27:55', '1973-09-20 03:47:27'),
(12, 'Other Liability', 'Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc', 2, 0, '1972-05-07 08:34:12', '2007-03-24 19:11:09'),
(13, 'Accounts Payable', 'Accounts Payable', 2, 1, '2004-08-22 00:54:11', '2013-03-12 02:58:29'),
(14, 'Equity', 'Equity', 3, 0, '1996-10-13 11:29:42', '1987-06-12 21:21:30'),
(15, 'Income', 'income', 4, 0, '1997-08-12 18:56:25', '1977-05-21 10:29:56'),
(16, 'Other Income', 'Other Income', 4, 0, '2017-01-11 16:29:51', '1970-05-13 18:35:11'),
(17, 'Expense', 'Expense', 5, 0, '1984-12-11 02:20:34', '1974-12-28 10:30:16'),
(18, 'Cost of Goods Sold', 'Cost of Goods Sold', 5, 0, '2013-06-28 05:06:09', '2006-07-23 13:41:05'),
(19, 'Other Expense', 'Other Expense', 5, 0, '1989-06-15 11:22:19', '2015-04-06 07:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `particulars` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `payment_mode_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_installment` int(10) DEFAULT NULL,
  `day_interval` int(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_rates` int(11) NOT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `cms_site_id` int(10) UNSIGNED DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_tax` double NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `save` tinyint(1) DEFAULT NULL,
  `adjustment` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `order_number`, `no_of_installment`, `day_interval`, `start_date`, `bill_number`, `amount`, `due_amount`, `bill_date`, `due_date`, `item_rates`, `item_category_id`, `item_sub_category_id`, `cms_site_id`, `note`, `total_tax`, `file_name`, `file_url`, `vendor_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `save`, `adjustment`) VALUES
(11, '', 0, 0, '2021-11-20', '000001', 120, 0, '2021-11-01', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 1, 1, '2021-11-20 10:29:18', '2022-02-24 08:39:55', NULL, 0),
(12, '', 0, 0, '2021-11-20', '000002', 120, 0, '2021-11-20', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 1, 1, '2021-11-20 10:29:35', '2022-02-24 08:39:55', NULL, 0),
(13, '', 0, 0, '2021-12-21', '000003', 1000, 700, '2021-12-21', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 54, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', NULL, 0),
(14, '', 0, 0, '2021-12-21', '000004', 500, 200, '2021-12-21', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 54, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:57', NULL, 0),
(16, '', 0, 0, '2021-12-22', '000005', 0, 0, '2021-12-22', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 55, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09', NULL, 0),
(17, '', 0, 0, '2021-12-22', '000006', 0, 0, '2021-12-22', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 55, 27, 27, '2021-12-22 07:06:27', '2021-12-22 07:06:27', NULL, 0),
(19, '', 0, 0, '2022-01-29', '000007', 300, 300, '2022-01-29', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 55, 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29', NULL, 0),
(21, '', 0, 0, '2022-02-24', '000009', 6000, 0, '2016-01-01', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 54, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', NULL, 0),
(23, '', 0, 0, '2022-02-24', '000011', 40000, 0, '2022-02-24', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:40:17', NULL, 0),
(24, '', 0, 0, '2022-02-24', '000012', 26000, 0, '2010-01-01', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', NULL, 0),
(25, '', 0, 0, '2022-02-24', '000013', 0, 0, '2022-02-24', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 25, 25, '2022-02-24 08:46:12', '2022-02-24 08:46:12', NULL, 0),
(26, '', 0, 0, '2022-02-24', '000014', 42500, 22500, '2022-02-24', NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 1, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill_due_table`
--

CREATE TABLE `bill_due_table` (
  `id` int(10) NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `due_amount` varchar(191) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_due_table`
--

INSERT INTO `bill_due_table` (`id`, `bill_id`, `due_date`, `due_amount`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(11, 12, '2021-11-20', '100', 1, 1, '2021-11-20 10:29:53', '2021-11-20 10:29:53'),
(12, 11, '2021-11-20', '100', 1, 1, '2021-11-20 10:30:02', '2021-11-20 10:30:02'),
(13, 13, '2021-12-21', '700', 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25'),
(14, 14, '2021-12-21', '400', 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14'),
(16, 16, '2021-12-22', '0', 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09'),
(17, 17, '2021-12-22', '0', 27, 27, '2021-12-22 07:06:27', '2021-12-22 07:06:27'),
(19, 19, '2022-01-29', '300', 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29'),
(21, 21, '2022-02-24', '0', 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20'),
(23, 23, '2022-02-24', '0', 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:32:00'),
(24, 24, '2022-02-24', '0', 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24'),
(25, 25, '2022-02-24', '0', 25, 25, '2022-02-24 08:46:12', '2022-02-24 08:46:12'),
(26, 26, '2022-02-24', '22500', 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `bill_entry`
--

CREATE TABLE `bill_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_entry`
--

INSERT INTO `bill_entry` (`id`, `item_id`, `description`, `account_id`, `quantity`, `rate`, `tax_id`, `amount`, `bill_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(13, 140, '', 26, 12, 10, 1, 120, 12, 1, 1, '2021-11-20 10:29:35', '2021-11-20 10:29:53'),
(14, 140, '', 26, 12, 10, 1, 120, 11, 1, 1, '2021-11-20 10:29:18', '2021-11-20 10:30:02'),
(15, 144, '', 26, 10, 100, 1, 1000, 13, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25'),
(16, 145, '', 26, 10, 50, 1, 500, 14, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14'),
(18, 1427, '', 26, 9, 0, 1, 0, 16, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09'),
(19, 1428, '', 26, 5, 0, 1, 0, 16, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09'),
(20, 1430, '', 26, 6, 0, 1, 0, 17, 27, 27, '2021-12-22 07:06:27', '2021-12-22 07:06:27'),
(22, 1427, '', 26, 10, 30, 1, 300, 19, 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29'),
(26, 1064, '', 26, 60, 100, 1, 6000, 21, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20'),
(30, 1796, '', 26, 50, 800, 1, 40000, 23, 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:32:00'),
(31, 3, '', 26, 80, 325, 1, 26000, 24, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24'),
(32, 2105, '', 26, 100, 0, 1, 0, 25, 25, 25, '2022-02-24 08:46:12', '2022-02-24 08:46:12'),
(33, 1797, '', 26, 50, 850, 1, 42500, 26, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `bill_return_entries`
--

CREATE TABLE `bill_return_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_entries_id` int(10) UNSIGNED DEFAULT NULL,
  `returned_quantity` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submit`
--

CREATE TABLE `bill_submit` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_name` int(10) UNSIGNED DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL COMMENT '0=not approved, 1=approved, null=yet no deceission',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_sub_category_id` int(10) UNSIGNED NOT NULL,
  `adjustment` double DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `order_number` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_installment` int(10) DEFAULT NULL,
  `day_interval` int(10) DEFAULT NULL,
  `start_date` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submits_due_dates`
--

CREATE TABLE `bill_submits_due_dates` (
  `id` int(10) NOT NULL,
  `bill_submit_id` int(10) UNSIGNED NOT NULL,
  `due_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_submit_entries`
--

CREATE TABLE `bill_submit_entries` (
  `id` int(10) NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL,
  `bill_id` int(10) NOT NULL,
  `setting_currencies_id` int(10) UNSIGNED DEFAULT NULL,
  `setting_currency_rates` double UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `branch_description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `location`, `branch_prefix`) VALUES
(1, 'Head Office', NULL, 1, 1, '2009-02-21 02:50:25', '2019-11-05 12:34:27', NULL, 'CO'),
(2, 'Fashion House', NULL, 1, 1, '2009-02-21 02:50:25', '2019-11-05 12:34:27', NULL, 'HO'),
(3, 'Grocery Shop', '', 1, 1, '2020-01-13 03:09:02', '2020-01-13 03:09:02', NULL, ''),
(4, 'Gift Shop', '', 1, 1, '2020-01-13 03:09:02', '2020-01-13 03:09:02', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) NOT NULL,
  `subtotal` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` tinyint(4) DEFAULT 0 COMMENT '0 = %, 1 = flat',
  `tax` double DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `shipping` double DEFAULT NULL,
  `total` double NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `subtotal`, `discount`, `discount_type`, `tax`, `tax_amount`, `shipping`, `total`, `user_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(25, 3710, 12, 0, 13, 424.42, 106, 3795.22, 45, 1, 1, '2021-11-29 12:12:40', '2021-11-29 12:40:30'),
(28, 200, 0, 0, 0, 0, 0, 200, 51, 1, 1, '2021-12-12 06:07:50', '2021-12-12 06:07:50'),
(32, 50, 0, 0, 0, 0, 0, 50, 53, 26, 26, '2021-12-21 09:06:46', '2021-12-21 09:06:46'),
(39, 120, 10, 1, 0, 0, 0, 110, 0, 26, 26, '2021-12-22 03:11:08', '2021-12-22 03:11:08'),
(40, 100, 0, 0, 0, 0, 0, 100, 57, 27, 27, '2021-12-22 07:25:39', '2021-12-22 07:25:39'),
(41, 100, 0, 0, 0, 0, 0, 100, 57, 27, 27, '2021-12-22 07:34:49', '2021-12-22 07:34:49'),
(44, 1000, 100, 1, 0, 0, 0, 900, 1, 25, 25, '2021-12-23 13:00:20', '2021-12-23 13:00:20'),
(46, 25, 0, 1, 0, 0, 0, 25, 53, 26, 26, '2021-12-24 03:56:13', '2021-12-24 03:56:13'),
(47, 166, 0, 0, 0, 0, 0, 166, 54, 26, 26, '2021-12-24 04:36:31', '2021-12-24 04:36:31'),
(50, 75, 0, 0, 0, 0, 0, 75, 56, 26, 26, '2021-12-24 15:43:53', '2021-12-24 15:43:53'),
(51, 10, 0, 0, 0, 0, 0, 10, 53, 26, 26, '2021-12-24 16:20:11', '2021-12-24 16:20:11'),
(52, 20, 0, 0, 0, 0, 0, 20, 53, 26, 26, '2021-12-26 05:03:25', '2021-12-26 05:03:25'),
(53, 20, 0, 0, 0, 0, 0, 20, 53, 26, 26, '2021-12-26 10:35:43', '2021-12-26 10:35:43'),
(54, 140, 20, 1, 0, 0, 0, 120, 53, 26, 26, '2021-12-26 10:42:22', '2021-12-26 10:42:22'),
(58, 100, 0, 0, 0, 0, 0, 100, 57, 27, 27, '2022-01-29 11:05:55', '2022-01-29 11:05:55'),
(59, 450, 0, 0, 0, 0, 0, 450, 57, 27, 27, '2022-01-29 11:09:14', '2022-01-29 11:11:10'),
(61, 300, 0, 0, 0, 0, 0, 300, 57, 27, 27, '2022-02-24 05:23:41', '2022-02-24 05:23:41'),
(63, 160, 0, 0, 0, 0, 0, 160, 58, 26, 26, '2022-02-24 07:49:38', '2022-02-24 07:49:38'),
(67, 25, 0, 0, 0, 0, 0, 25, 59, 26, 26, '2022-02-24 08:28:55', '2022-02-24 08:28:55'),
(68, 25, 0, 0, 0, 0, 0, 25, 59, 26, 26, '2022-02-24 08:29:22', '2022-02-24 08:29:22'),
(70, 5, 0, 0, 0, 0, 0, 5, 59, 26, 26, '2022-02-24 08:49:39', '2022-02-24 08:49:39'),
(72, 500, 0, 0, 0, 0, 0, 500, 1, 25, 25, '2022-02-24 09:01:21', '2022-02-24 09:01:21'),
(76, 10, 0, 0, 0, 0, 0, 10, 61, 26, 26, '2022-02-24 12:22:13', '2022-02-24 12:22:13'),
(77, 50000, 0, 0, 0, 0, 0, 50000, 61, 26, 26, '2022-02-24 12:23:36', '2022-02-24 12:23:36'),
(82, 32, 2, 1, 0, 0, 0, 30, 62, 26, 26, '2022-02-26 11:35:25', '2022-02-26 11:35:25'),
(83, 5, 0, 0, 0, 0, 0, 5, 62, 26, 26, '2022-02-27 10:24:42', '2022-02-27 10:24:42'),
(84, 0, 0, 0, 0, 0, 0, 0, 62, 26, 26, '2022-03-01 05:17:36', '2022-03-01 05:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `cart_entries`
--

CREATE TABLE `cart_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `rate` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` tinyint(4) DEFAULT NULL COMMENT '0 = %, 1 = flat',
  `total` double NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_entries`
--

INSERT INTO `cart_entries` (`id`, `item_id`, `cart_id`, `quantity`, `rate`, `discount`, `discount_type`, `total`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(47, 71, 25, 2, 1800, 5, 0, 3420, 1, 1, '2021-11-29 12:12:40', '2021-11-29 12:16:41'),
(48, 4, 25, 1, 300, 10, 1, 290, 1, 1, '2021-11-29 12:12:40', '2021-11-29 12:12:40'),
(53, 7, 28, 1, 200, NULL, NULL, 200, 1, 1, '2021-12-12 06:07:50', '2021-12-12 06:07:50'),
(58, 1280, 32, 1, 10, NULL, NULL, 10, 26, 26, '2021-12-21 09:06:46', '2021-12-21 09:06:46'),
(59, 144, 32, 2, 20, NULL, NULL, 40, 26, 26, '2021-12-21 09:06:46', '2021-12-21 09:06:46'),
(66, 1065, 39, 2, 60, NULL, NULL, 120, 26, 26, '2021-12-22 03:11:08', '2021-12-22 03:11:08'),
(67, 1427, 40, 1, 100, NULL, NULL, 100, 27, 27, '2021-12-22 07:25:39', '2021-12-22 07:25:39'),
(68, 1427, 41, 1, 100, NULL, NULL, 100, 27, 27, '2021-12-22 07:34:49', '2021-12-22 07:34:49'),
(71, 1433, 44, 1, 1000, NULL, NULL, 1000, 25, 25, '2021-12-23 13:00:20', '2021-12-23 13:00:20'),
(73, 1410, 46, 1, 5, NULL, NULL, 5, 26, 26, '2021-12-24 03:56:13', '2021-12-24 03:56:13'),
(74, 1408, 46, 1, 5, NULL, NULL, 5, 26, 26, '2021-12-24 03:56:13', '2021-12-24 03:56:13'),
(75, 1402, 46, 1, 15, NULL, NULL, 15, 26, 26, '2021-12-24 03:56:13', '2021-12-24 03:56:13'),
(76, 1041, 47, 1, 60, 10, 0, 54, 26, 26, '2021-12-24 04:36:31', '2021-12-24 04:36:31'),
(77, 1044, 47, 1, 78, NULL, NULL, 78, 26, 26, '2021-12-24 04:36:31', '2021-12-24 04:36:31'),
(78, 1040, 47, 1, 34, NULL, NULL, 34, 26, 26, '2021-12-24 04:36:31', '2021-12-24 04:36:31'),
(81, 1403, 50, 5, 15, NULL, NULL, 75, 26, 26, '2021-12-24 15:43:53', '2021-12-24 15:43:53'),
(82, 1408, 51, 2, 5, NULL, NULL, 10, 26, 26, '2021-12-24 16:20:11', '2021-12-24 16:20:11'),
(83, 1421, 52, 1, 20, NULL, NULL, 20, 26, 26, '2021-12-26 05:03:25', '2021-12-26 05:03:25'),
(84, 1421, 53, 1, 20, NULL, NULL, 20, 26, 26, '2021-12-26 10:35:43', '2021-12-26 10:35:43'),
(85, 1401, 54, 2, 20, NULL, NULL, 40, 26, 26, '2021-12-26 10:42:22', '2021-12-26 10:42:22'),
(86, 1340, 54, 1, 100, NULL, NULL, 100, 26, 26, '2021-12-26 10:42:22', '2021-12-26 10:42:22'),
(91, 1427, 58, 1, 100, NULL, NULL, 100, 27, 27, '2022-01-29 11:05:55', '2022-01-29 11:05:55'),
(92, 1571, 59, 2, 150, 50, 1, 250, 27, 27, '2022-01-29 11:09:14', '2022-01-29 11:09:14'),
(93, 1427, 59, 2, 100, NULL, NULL, 200, 27, 27, '2022-01-29 11:11:10', '2022-01-29 11:11:10'),
(95, 1427, 61, 3, 100, NULL, NULL, 300, 27, 27, '2022-02-24 05:23:41', '2022-02-24 05:23:41'),
(97, 1384, 63, 5, 32, NULL, NULL, 160, 26, 26, '2022-02-24 07:49:38', '2022-02-24 07:49:38'),
(102, 1421, 67, 1, 20, NULL, NULL, 20, 26, 26, '2022-02-24 08:28:55', '2022-02-24 08:28:55'),
(103, 1408, 67, 1, 5, NULL, NULL, 5, 26, 26, '2022-02-24 08:28:55', '2022-02-24 08:28:55'),
(104, 1421, 68, 1, 20, NULL, NULL, 20, 26, 26, '2022-02-24 08:29:22', '2022-02-24 08:29:22'),
(105, 1408, 68, 1, 5, NULL, NULL, 5, 26, 26, '2022-02-24 08:29:22', '2022-02-24 08:29:22'),
(112, 847, 70, 1, 0, NULL, NULL, 0, 26, 26, '2022-02-24 08:49:39', '2022-02-24 08:49:39'),
(113, 1408, 70, 1, 5, NULL, NULL, 5, 26, 26, '2022-02-24 08:49:39', '2022-02-24 08:49:39'),
(116, 2105, 72, 5, 100, NULL, NULL, 500, 25, 25, '2022-02-24 09:01:21', '2022-02-24 09:01:21'),
(121, 1404, 76, 1, 11, 1, 1, 10, 26, 26, '2022-02-24 12:22:13', '2022-02-24 12:22:13'),
(122, 2152, 77, 1, 50000, NULL, NULL, 50000, 26, 26, '2022-02-24 12:23:36', '2022-02-24 12:23:36'),
(131, 1384, 82, 1, 32, NULL, NULL, 32, 26, 26, '2022-02-26 11:35:25', '2022-02-26 11:35:25'),
(132, 1408, 83, 1, 5, NULL, NULL, 5, 26, 26, '2022-02-27 10:24:42', '2022-02-27 10:24:42'),
(133, 1340, 84, 1, 0, NULL, NULL, 0, 26, 26, '2022-03-01 05:17:36', '2022-03-01 05:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_pic_url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_guard_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tw_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_category_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `present_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `profile_pic_url`, `display_name`, `company_name`, `email_address`, `skype_name`, `phone_number_1`, `phone_number_2`, `phone_number_3`, `billing_street`, `billing_city`, `billing_state`, `billing_zip_code`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip_code`, `shipping_country`, `father_name`, `mother_name`, `local_guard_name`, `fb_id`, `tw_id`, `about`, `contact_status`, `contact_category_id`, `agent_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `account_id`, `present_class`, `shipping_address`, `billing_address`, `longitude`, `latitude`) VALUES
(1, '', '', NULL, 'Sumis Fashion House', '', '', NULL, '13124', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 3, NULL, 2, 25, 25, '2021-11-04 08:57:24', '2021-11-04 08:57:24', NULL, NULL, '', '', NULL, NULL),
(2, 'dr.jami', '', NULL, 'dr.jami', '', '', NULL, '01726521667', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 1, NULL, 1, 1, 1, '2021-11-06 12:53:46', '2021-11-06 12:53:46', NULL, NULL, '', '', NULL, NULL),
(3, NULL, NULL, NULL, 'CO-000003', NULL, NULL, NULL, '02121515', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, NULL, 1, 1, 1, '2021-11-15 11:43:26', '2021-11-15 11:43:26', NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, 'Bank 1', NULL, NULL, NULL, '01707050601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 1, 1, '2021-11-28 07:04:34', '2021-11-28 07:04:34', NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, 'Bank 2', NULL, NULL, NULL, '01707050601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 1, 1, '2021-11-28 08:59:02', '2021-11-28 08:59:02', NULL, NULL, NULL, NULL, NULL, NULL),
(46, '', '', NULL, 'test bank', '', '', NULL, '5458185', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 5, NULL, 1, 1, 1, '2021-12-06 06:47:17', '2021-12-06 06:47:17', 104, NULL, '', '', NULL, NULL),
(47, NULL, NULL, NULL, 'shihab', NULL, NULL, NULL, '01516105144', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-09 08:40:49', '2021-12-09 08:40:49', NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, 'ali azam', NULL, NULL, NULL, '01707050602', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-11 06:33:38', '2021-12-11 06:33:38', NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, 'ali azam', NULL, NULL, NULL, '06594468307', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-11 06:35:26', '2021-12-11 06:35:26', NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, 'shihab', NULL, NULL, NULL, '06594468307', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-11 06:35:40', '2021-12-11 06:35:40', NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, 'padmavati', NULL, NULL, NULL, '01707050601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-12 06:06:06', '2021-12-12 06:06:06', NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, 'shihab', NULL, NULL, NULL, '01707050602', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-12-12 12:24:56', '2021-12-12 12:24:56', NULL, NULL, NULL, NULL, NULL, NULL),
(53, '', '', NULL, 'Grocery Customer', '', '', NULL, '1234', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 1, NULL, 3, 26, 26, '2021-12-20 18:25:00', '2021-12-20 18:25:00', NULL, NULL, '', '', NULL, NULL),
(54, '', '', NULL, 'Grocery Vendor', '', '', NULL, '234', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 4, NULL, 3, 26, 26, '2021-12-20 18:25:17', '2021-12-20 18:25:17', NULL, NULL, '', '', NULL, NULL),
(55, '', '', NULL, 'Test Vendor', '', '', NULL, '2424', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 4, NULL, 4, 27, 27, '2021-12-21 09:40:21', '2021-12-21 09:40:21', NULL, NULL, '', '', NULL, NULL),
(56, NULL, NULL, NULL, 'Aminul bhai', NULL, NULL, NULL, '01713477411', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 3, 26, 26, '2021-12-22 03:12:13', '2021-12-22 03:12:13', NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, 'General Customer', NULL, NULL, NULL, '54646', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 4, 27, 27, '2021-12-22 07:14:02', '2021-12-22 07:14:02', NULL, NULL, NULL, NULL, NULL, NULL),
(59, '', '', NULL, 'Arif', '', '', NULL, '12', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '  ', '1', 1, NULL, 3, 26, 26, '2022-02-24 08:04:15', '2022-02-24 08:34:11', NULL, NULL, '', '', NULL, NULL),
(61, '', '', NULL, 'Aple Mahmud', 'IFIC Bank', '', NULL, '890', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '    ', '1', 1, NULL, 3, 26, 26, '2022-02-24 08:54:10', '2022-02-24 09:24:51', NULL, NULL, '', '', NULL, NULL),
(62, NULL, NULL, NULL, 'habib', NULL, NULL, NULL, '01600003787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 3, 26, 26, '2022-02-24 13:14:52', '2022-02-24 13:14:52', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_category`
--

CREATE TABLE `contact_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_category_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_category`
--

INSERT INTO `contact_category` (`id`, `contact_category_name`, `contact_category_description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Customer', NULL, 1, 1, '1971-12-22 18:49:20', '1997-01-21 06:47:16'),
(2, 'Agent', NULL, 1, 1, '1979-05-15 15:26:14', '1974-03-17 10:10:59'),
(3, 'Employee', NULL, 1, 1, '1980-03-04 11:23:20', '2000-09-19 12:54:51'),
(4, 'Vendor', NULL, 1, 1, '2015-03-05 03:36:56', '1988-08-02 00:09:56'),
(5, 'Bank', NULL, 1, 1, '1979-05-15 15:26:14', '1974-03-17 10:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `credit_notes`
--

CREATE TABLE `credit_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `credit_note_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit_note_date` date NOT NULL,
  `shiping_charge` double NOT NULL,
  `adjustment` double NOT NULL,
  `total_credit_note` double NOT NULL,
  `available_credit` double NOT NULL,
  `customer_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_condition` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_notes`
--

INSERT INTO `credit_notes` (`id`, `invoice_id`, `credit_note_number`, `reference`, `credit_note_date`, `shiping_charge`, `adjustment`, `total_credit_note`, `available_credit`, `customer_note`, `terms_and_condition`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `file_url`, `item_category_id`, `item_sub_category_id`, `tax_total`, `serial`) VALUES
(1, NULL, '000001', '5848', '2021-11-01', 0, 0, 20, 5, '', '', 1, 1, 1, '2021-11-20 10:51:45', '2021-12-07 08:19:05', NULL, NULL, NULL, 0, NULL),
(2, NULL, '000002', 'Itaque veniam non i', '2021-11-20', 0, 0, 20, 250, '', '', 3, 1, 1, '2021-11-20 10:52:10', '2021-12-08 13:06:54', NULL, NULL, NULL, 0, NULL),
(5, 61, '000003', '', '2021-12-22', 0, 0, 190.46511627906978, 0, '', '', 53, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', NULL, NULL, NULL, 0, NULL),
(6, NULL, '000004', 'test', '2021-12-22', 0, 0, 50, 0, '', '', 53, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', NULL, NULL, NULL, 0, NULL),
(7, NULL, '000005', 'test', '2022-01-29', 0, 0, 50, 0, '', '', 57, 27, 27, '2022-01-29 11:17:48', '2022-01-29 11:18:11', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_entries`
--

CREATE TABLE `credit_note_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `credit_note_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_note_entries`
--

INSERT INTO `credit_note_entries` (`id`, `serial`, `quantity`, `rate`, `amount`, `discount`, `description`, `item_id`, `credit_note_id`, `tax_id`, `account_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, NULL, 2, 10, '20', '0', '', 140, 2, 2, 16, 1, 1, '2021-11-20 10:52:28', '2021-11-20 10:52:28'),
(4, NULL, 2, 10, '20', '0', '', 140, 1, 2, 16, 1, 1, '2021-11-20 10:52:38', '2021-11-20 10:52:38'),
(7, NULL, 1, 190.46511627906978, '190.46511627906978', '0', '', 144, 5, 1, 16, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28'),
(8, NULL, 1, 50, '50', '0', '', 144, 6, 2, 16, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56'),
(9, NULL, 1, 50, '50', '0', '', 1427, 7, 2, 16, 27, 27, '2022-01-29 11:17:48', '2022-01-29 11:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_payments`
--

CREATE TABLE `credit_note_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `credit_note_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_note_payments`
--

INSERT INTO `credit_note_payments` (`id`, `amount`, `invoice_id`, `credit_note_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 7, 1, 1, 1, '2021-12-07 08:19:05', '2021-12-07 08:19:05'),
(2, 5, 7, 2, 1, 1, '2021-12-07 08:19:05', '2021-12-07 08:19:05'),
(3, 50, 29, 2, 1, 1, '2021-12-08 12:53:05', '2021-12-08 12:53:05'),
(4, 50, 30, 2, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36'),
(5, 50, 31, 2, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37'),
(6, 50, 33, 2, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54'),
(7, 50, 75, 7, 27, 27, '2022-01-29 11:18:11', '2022-01-29 11:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `credit_note_refunds`
--

CREATE TABLE `credit_note_refunds` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_mode_id` int(10) UNSIGNED DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `credit_note_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_note_refunds`
--

INSERT INTO `credit_note_refunds` (`id`, `amount`, `payment_mode_id`, `date`, `reference`, `account_id`, `credit_note_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 190.46511627906978, NULL, '2021-12-22', ' ', 3, 5, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28'),
(3, 50, NULL, '2021-12-22', ' ', 3, 6, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(10) UNSIGNED NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int(10) UNSIGNED NOT NULL,
  `estimate_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attn_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading` blob DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `terms_conditions` blob DEFAULT NULL,
  `table_head` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_notation` blob DEFAULT NULL,
  `right_notation` blob DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `tax_total` double DEFAULT NULL,
  `due_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_entries`
--

CREATE TABLE `estimate_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `rate` double NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `estimate_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `excess_payment`
--

CREATE TABLE `excess_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_receives_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `paid_through_id` int(10) UNSIGNED NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_type` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_site_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expense_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `date`, `amount`, `paid_through_id`, `tax_total`, `reference`, `note`, `account_id`, `vendor_id`, `tax_id`, `tax_type`, `bank_info`, `invoice_show`, `cms_site_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `file_url`, `expense_number`) VALUES
(1, '2021-12-21', 30, 3, 0, 'test', '', 23, 53, 1, 1, '', 'on', NULL, 26, 26, '2021-12-20 18:31:14', '2021-12-20 18:31:14', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `headertemplate`
--

CREATE TABLE `headertemplate` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headerType` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `headertemplate`
--

INSERT INTO `headertemplate` (`id`, `file_url`, `headerType`, `created_at`, `updated_at`) VALUES
(1, 'uploads/template/banner.png', 0, '2018-12-21 16:59:49', '2021-10-07 10:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `receive_through_id` int(10) UNSIGNED NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `tax_type` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `income_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `customer_note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment_type` int(11) DEFAULT 0,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `due_amount` double DEFAULT NULL,
  `return_amount` double DEFAULT 0,
  `personal_note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `save` tinyint(4) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_of_installment` int(10) DEFAULT NULL,
  `day_interval` int(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `agents_id` int(10) UNSIGNED DEFAULT NULL,
  `agentcommissionAmount` double DEFAULT NULL,
  `commission_type` tinyint(4) NOT NULL DEFAULT 0,
  `payment_recieve_id` int(10) UNSIGNED DEFAULT NULL,
  `vat_adjustment` double DEFAULT NULL,
  `tax_adjustment` double DEFAULT NULL,
  `others_adjustment` double DEFAULT NULL,
  `cms_site_id` int(10) UNSIGNED DEFAULT NULL,
  `delivery_person` int(10) UNSIGNED DEFAULT NULL,
  `receive_person` int(10) UNSIGNED DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `file_name`, `file_url`, `invoice_date`, `payment_date`, `customer_note`, `tax_total`, `shipping_charge`, `adjustment_type`, `adjustment`, `total_amount`, `due_amount`, `return_amount`, `personal_note`, `save`, `reference`, `item_category_id`, `item_sub_category_id`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `no_of_installment`, `day_interval`, `start_date`, `agents_id`, `agentcommissionAmount`, `commission_type`, `payment_recieve_id`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `cms_site_id`, `delivery_person`, `receive_person`, `receive_date`, `latitude`, `longitude`) VALUES
(2, '000001', NULL, NULL, '1975-01-15', NULL, 'Qui quis exercitatio', 73449.5, 50, 0, 100, 807994.5, 807984.5, 10, 'Fugit enim quis vol', NULL, 'Itaque veniam non i', NULL, NULL, 1, 1, 1, '2021-11-15 11:31:45', '2021-11-16 07:22:15', 0, 0, '1996-08-09', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '000003', NULL, NULL, '2021-11-15', NULL, '', 0, 0, 0, 0, 300, 280, 50, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-15 12:24:44', '2021-12-07 08:19:05', 0, 0, '2021-11-15', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '000004', NULL, NULL, '2021-11-15', NULL, '', 0, 0, 0, 0, 300, 300, 10, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-15 12:25:23', '2021-11-16 07:08:13', 0, 0, '2021-11-15', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '000007', NULL, NULL, '2021-11-01', NULL, ' ', 0, 0, 0, 0, 60, 60, 0, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-20 10:37:05', '2021-11-20 10:37:55', 0, 0, '2021-11-20', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '000008', NULL, NULL, '2021-11-20', NULL, ' ', 0, 0, 0, 0, 60, 60, 0, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-20 10:37:41', '2021-11-20 10:38:07', 0, 0, '2021-11-20', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '000009', NULL, NULL, '2021-11-01', NULL, ' ', 0, 0, 0, 0, 30, 30, 0, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-20 10:48:15', '2021-11-20 10:49:10', 0, 0, '2021-11-20', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '000010', NULL, NULL, '2021-11-20', NULL, ' ', 0, 0, 0, 0, 30, 30, 0, '', NULL, '', NULL, NULL, 1, 1, 1, '2021-11-20 10:48:54', '2021-11-20 10:49:20', 0, 0, '2021-11-20', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '000011', NULL, NULL, '2021-12-06', NULL, '', 60, 40, 0, 40, 500, 400, 0, '', NULL, 'test', NULL, NULL, 1, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', 0, 0, '2021-12-06', NULL, NULL, 0, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '000012', NULL, NULL, '2021-12-07', NULL, NULL, 0, 0, 0, 0, 5000, 300, 4700, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-07 05:23:20', '2021-12-07 05:23:20', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '000013', NULL, NULL, '2021-12-07', NULL, NULL, 0, 0, 0, 0, 5000, 300, 4700, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-07 05:25:44', '2021-12-07 05:25:44', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '000014', NULL, NULL, '2021-12-07', NULL, NULL, 0, 0, 0, 0, 5000, 300, 4700, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-07 07:18:33', '2021-12-07 07:18:33', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '000015', NULL, NULL, '2021-12-07', NULL, NULL, 0, 0, 0, 0, 5000, 300, 4700, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-07 07:20:18', '2021-12-07 07:20:18', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '000016', NULL, NULL, '2021-12-07', NULL, NULL, 0, 0, 0, 0, 550, 300, 250, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '000017', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 2215, 300, 1915, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 07:13:14', '2021-12-08 07:13:14', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '000018', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 2215, 300, 1915, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '000019', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 2215, 300, 1915, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '000020', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 500, 0, 200, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:42:22', '2021-12-08 12:42:22', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '000021', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 500, 0, 200, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:42:53', '2021-12-08 12:42:53', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '000022', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 500, 0, 200, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:47:52', '2021-12-08 12:47:52', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '000023', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '000024', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:52:41', '2021-12-08 12:52:41', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '000025', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '000026', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '000027', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '000028', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:06:44', '2021-12-08 13:06:44', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '000029', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 460, 0, 160, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '000030', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:49:06', '2021-12-08 13:49:06', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '000031', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '000032', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '000033', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, '000034', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, '000035', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '000036', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, '000037', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, '000038', NULL, NULL, '2021-12-08', NULL, NULL, 0, 0, 0, 0, 380, 0, 80, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, '000039', NULL, NULL, '2021-12-09', NULL, NULL, 0, 0, 0, 0, 700, 0, 400, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, '000040', NULL, NULL, '2021-12-09', NULL, NULL, 0, 0, 0, 0, 350, 0, 50, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, '000041', NULL, NULL, '2021-12-09', NULL, NULL, 0, 0, 0, 0, 2180, 0, 380, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, '000042', NULL, NULL, '2021-12-09', NULL, NULL, 0.36, 3, 0, 2, 30, 0, 8.64, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, '2021-12-09 05:46:40', '2021-12-09 05:46:40', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, '000043', NULL, NULL, '2021-12-09', NULL, NULL, 153, 50, 0, 170, 2050, 0, 317, NULL, NULL, NULL, NULL, NULL, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, '000044', NULL, NULL, '2021-12-11', NULL, NULL, 51.21, 50, 0, 38.50300000000004, 5000, 0, 4167.23, NULL, NULL, NULL, NULL, NULL, 45, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, '000045', NULL, NULL, '2021-12-12', NULL, NULL, 166.25, 5, 0, 175, 6000, 0, 2503.75, NULL, NULL, NULL, NULL, NULL, 51, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, '000046', NULL, NULL, '2021-12-21', NULL, NULL, 38, 2, 0, -10, 420, 0, 40, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, '000047', NULL, NULL, '2021-12-21', NULL, NULL, 0, 0, 0, -20, 200, 0, 100, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, '000050', NULL, NULL, '2021-12-21', NULL, NULL, 0, 0, 0, -4.268000000000001, 81.09000000000003, 0, 918.91, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, '000051', NULL, NULL, '2021-12-22', NULL, NULL, 0, 0, 0, -0, 30, 5, 0, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, '000052', NULL, NULL, '2021-12-22', NULL, NULL, 0, 0, 0, -0, 50, 45, 0, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, '000053', NULL, NULL, '2021-12-22', NULL, NULL, 0, 0, 0, -0, 100, -900, 900, NULL, NULL, NULL, NULL, NULL, 57, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '000054', NULL, NULL, '2021-12-23', NULL, NULL, 0, 0, 0, -0, 20, -980, 980, NULL, NULL, NULL, NULL, NULL, 56, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '000055', NULL, NULL, '2021-12-24', NULL, NULL, 0, 0, 0, -0, 16000, -4000, 4000, NULL, NULL, NULL, NULL, NULL, 56, 26, 26, '2021-12-24 11:17:27', '2021-12-24 11:17:27', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '000056', NULL, NULL, '2021-12-24', NULL, NULL, 0, 0, 0, -0, 25, -75, 75, NULL, NULL, NULL, NULL, NULL, 53, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, '000057', NULL, NULL, '2022-01-10', NULL, NULL, 15, 5, 0, -50, 170, -30, 30, NULL, NULL, NULL, NULL, NULL, 1, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, '000058', NULL, NULL, '2022-01-10', NULL, NULL, 15, 5, 0, -50, 170, 0, 30, NULL, NULL, NULL, NULL, NULL, 1, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '000059', NULL, NULL, '2022-01-10', NULL, NULL, 0, 0, 0, -20, 180, 0, 20, NULL, NULL, NULL, NULL, NULL, 1, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, '000060', NULL, NULL, '2022-01-29', NULL, '', 0, 0, 0, 0, 100, 50, 0, '', NULL, '', NULL, NULL, 57, 27, 27, '2022-01-29 11:17:28', '2022-01-29 11:18:11', 0, 0, '2022-01-29', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '000061', NULL, NULL, '2022-02-24', NULL, NULL, 0, 0, 0, -0, 200, 0, 300, NULL, NULL, NULL, NULL, NULL, 57, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, '000070', NULL, NULL, '2022-02-24', NULL, '', 0, 0, 0, 0, 2400, 0, 0, '', NULL, '', NULL, NULL, 1, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', 0, 0, '2022-02-24', NULL, NULL, 0, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, '000072', NULL, NULL, '2022-02-24', NULL, '', 0, 0, 0, 0, 500, 0, 0, '', NULL, '', NULL, NULL, 1, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', 0, 0, '2022-02-24', NULL, NULL, 0, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, '000073', NULL, NULL, '2022-02-24', NULL, NULL, 0, 0, 0, -0, 170, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '000075', NULL, NULL, '2022-02-24', NULL, NULL, 0, 0, 0, -0, 4950, 0, 50, NULL, NULL, NULL, NULL, NULL, 61, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, '000076', NULL, NULL, '2022-03-01', NULL, '', 0, 0, 0, 0, 35, 35, 0, '', NULL, '', NULL, NULL, 53, 26, 26, '2022-03-01 05:16:39', '2022-03-01 05:16:39', 0, 0, '2022-03-01', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_measurements`
--

CREATE TABLE `invoices_measurements` (
  `id` int(11) UNSIGNED NOT NULL,
  `invoices_id` int(11) UNSIGNED DEFAULT NULL,
  `item_id` int(11) UNSIGNED DEFAULT NULL,
  `raw_material_id` int(11) UNSIGNED DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `used_qty` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_due_table`
--

CREATE TABLE `invoice_due_table` (
  `id` int(10) NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `amount` varchar(195) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_due_table`
--

INSERT INTO `invoice_due_table` (`id`, `invoice_id`, `due_date`, `amount`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, '2016-10-26', '807931.5', 1, 1, '2021-11-15 17:31:45', '2021-11-15 17:31:45'),
(9, 11, '2021-11-20', '60', 1, 1, '2021-11-20 16:37:56', '2021-11-20 16:37:56'),
(10, 12, '2021-11-20', '60', 1, 1, '2021-11-20 16:38:08', '2021-11-20 16:38:08'),
(12, 13, '2021-11-20', '30', 1, 1, '2021-11-20 16:49:10', '2021-11-20 16:49:10'),
(13, 14, '2021-11-20', '30', 1, 1, '2021-11-20 16:49:20', '2021-11-20 16:49:20'),
(14, 15, '2021-12-06', '400', 1, 1, '2021-12-06 12:37:15', '2021-12-06 12:37:15'),
(15, 75, '2022-01-29', '100', 27, 27, '2022-01-29 17:17:28', '2022-01-29 17:17:28'),
(22, 86, '2022-02-24', '0', 25, 25, '2022-02-24 14:47:38', '2022-02-24 14:47:38'),
(24, 88, '2022-02-24', '0', 25, 25, '2022-02-24 14:55:28', '2022-02-24 14:55:28'),
(29, 102, '2022-03-01', '35', 26, 26, '2022-03-01 11:16:39', '2022-03-01 11:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_entries`
--

CREATE TABLE `invoice_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` int(11) NOT NULL DEFAULT 0,
  `rate` double NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `carton` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_entries`
--

INSERT INTO `invoice_entries` (`id`, `quantity`, `amount`, `discount`, `discount_type`, `rate`, `description`, `item_id`, `invoice_id`, `tax_id`, `account_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `carton`, `remarks`, `serial`) VALUES
(3, 408, 734395, 5, 1, 1800, 'Itaque ut et archite', 71, 2, 1, 9, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', NULL, NULL, ''),
(7, 1, 300, 0, 0, 300, '', 4, 7, 1, 16, 1, 1, '2021-11-15 12:24:44', '2021-11-15 12:24:44', NULL, NULL, ''),
(8, 1, 300, 0, 0, 300, '', 4, 8, 1, 16, 1, 1, '2021-11-15 12:25:23', '2021-11-15 12:25:23', NULL, NULL, ''),
(18, 6, 60, 0, 0, 10, '', 140, 11, 1, 16, 1, 1, '2021-11-20 10:37:05', '2021-11-20 10:37:55', NULL, NULL, ''),
(19, 6, 60, 0, 0, 10, '', 140, 12, 1, 16, 1, 1, '2021-11-20 10:37:41', '2021-11-20 10:38:07', NULL, NULL, ''),
(22, 3, 30, 0, 0, 10, '', 140, 13, 1, 16, 1, 1, '2021-11-20 10:48:15', '2021-11-20 10:49:10', NULL, NULL, ''),
(23, 3, 30, 0, 0, 10, '', 140, 14, 1, 16, 1, 1, '2021-11-20 10:48:54', '2021-11-20 10:49:20', NULL, NULL, ''),
(24, 1, 180, 20, 1, 200, '', 3, 15, 1, 16, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', NULL, NULL, ''),
(25, 1, 180, 10, 0, 200, '', 7, 15, 1, 16, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', NULL, NULL, ''),
(26, 1, 300, NULL, 0, 300, NULL, 4, 17, 1, 16, 1, 1, '2021-12-07 05:25:44', '2021-12-07 05:25:44', NULL, NULL, NULL),
(27, 1, 300, NULL, 0, 300, NULL, 4, 18, 1, 16, 1, 1, '2021-12-07 07:18:33', '2021-12-07 07:18:33', NULL, NULL, NULL),
(28, 1, 300, NULL, 0, 300, NULL, 4, 19, 1, 16, 1, 1, '2021-12-07 07:20:18', '2021-12-07 07:20:18', NULL, NULL, NULL),
(29, 1, 300, NULL, 0, 300, NULL, 4, 20, 1, 16, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21', NULL, NULL, NULL),
(30, 1, 300, NULL, 0, 300, NULL, 4, 21, 1, 16, 1, 1, '2021-12-08 07:13:14', '2021-12-08 07:13:14', NULL, NULL, NULL),
(31, 1, 300, NULL, 0, 300, NULL, 4, 22, 1, 16, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13', NULL, NULL, NULL),
(32, 1, 300, NULL, 0, 300, NULL, 4, 23, 1, 16, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', NULL, NULL, NULL),
(33, 1, 300, NULL, 0, 300, NULL, 4, 24, 1, 16, 1, 1, '2021-12-08 12:42:23', '2021-12-08 12:42:23', NULL, NULL, NULL),
(34, 1, 300, NULL, 0, 300, NULL, 4, 25, 1, 16, 1, 1, '2021-12-08 12:42:53', '2021-12-08 12:42:53', NULL, NULL, NULL),
(35, 1, 300, NULL, 0, 300, NULL, 4, 26, 1, 16, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', NULL, NULL, NULL),
(36, 1, 300, NULL, 0, 300, NULL, 4, 27, 1, 16, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', NULL, NULL, NULL),
(37, 1, 300, NULL, 0, 300, NULL, 4, 28, 1, 16, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', NULL, NULL, NULL),
(38, 1, 300, NULL, 0, 300, NULL, 4, 29, 1, 16, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', NULL, NULL, NULL),
(39, 1, 300, NULL, 0, 300, NULL, 4, 30, 1, 16, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', NULL, NULL, NULL),
(40, 1, 300, NULL, 0, 300, NULL, 4, 31, 1, 16, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', NULL, NULL, NULL),
(41, 1, 300, NULL, 0, 300, NULL, 4, 32, 1, 16, 1, 1, '2021-12-08 13:06:44', '2021-12-08 13:06:44', NULL, NULL, NULL),
(42, 1, 300, NULL, 0, 300, NULL, 4, 33, 1, 16, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', NULL, NULL, NULL),
(43, 1, 300, NULL, 0, 300, NULL, 4, 34, 1, 16, 1, 1, '2021-12-08 13:49:06', '2021-12-08 13:49:06', NULL, NULL, NULL),
(44, 1, 300, NULL, 0, 300, NULL, 4, 35, 1, 16, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', NULL, NULL, NULL),
(45, 1, 300, NULL, 0, 300, NULL, 4, 36, 1, 16, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', NULL, NULL, NULL),
(46, 1, 300, NULL, 0, 300, NULL, 4, 37, 1, 16, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', NULL, NULL, NULL),
(47, 1, 300, NULL, 0, 300, NULL, 4, 38, 1, 16, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', NULL, NULL, NULL),
(48, 1, 300, NULL, 0, 300, NULL, 4, 39, 1, 16, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', NULL, NULL, NULL),
(49, 1, 300, NULL, 0, 300, NULL, 4, 40, 1, 16, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', NULL, NULL, NULL),
(50, 1, 300, NULL, 0, 300, NULL, 4, 41, 1, 16, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', NULL, NULL, NULL),
(51, 1, 300, NULL, 0, 300, NULL, 4, 42, 1, 16, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', NULL, NULL, NULL),
(52, 1, 300, 0, 0, 300, NULL, 4, 43, 1, 16, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', NULL, NULL, NULL),
(53, 1, 300, 0, 0, 300, NULL, 4, 44, 1, 16, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', NULL, NULL, NULL),
(54, 1, 1800, 0, 0, 1800, NULL, 71, 45, 1, 16, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', NULL, NULL, NULL),
(55, 1, 20, 0, 0, 20, NULL, 140, 46, 1, 16, 1, 1, '2021-12-09 05:46:40', '2021-12-09 05:46:40', NULL, NULL, NULL),
(56, 1, 1700, 0, 0, 1700, NULL, 70, 47, 1, 16, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL),
(57, 1, 200, 0, 0, 200, NULL, 3, 48, 1, 16, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', NULL, NULL, NULL),
(58, 2, 570.06, 0, 0, 300.03, NULL, 4, 48, 1, 16, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', NULL, NULL, NULL),
(59, 1, 1800, 0, 0, 1800, NULL, 71, 49, 1, 16, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', NULL, NULL, NULL),
(60, 1, 1700, 0, 0, 1700, NULL, 70, 49, 1, 16, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', NULL, NULL, NULL),
(66, 2, 390, 10, 1, 200, NULL, 144, 61, 1, 16, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', NULL, NULL, NULL),
(67, 1, 20, 0, 0, 20, NULL, 1280, 62, 1, 16, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', NULL, NULL, NULL),
(68, 2, 200, 0, 0, 100, NULL, 144, 62, 1, 16, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', NULL, NULL, NULL),
(71, 1, 85.36, 3, 0, 88, NULL, 1340, 65, 1, 16, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', NULL, NULL, NULL),
(72, 1, 30, 0, 0, 30, NULL, 1401, 66, 1, 16, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', NULL, NULL, NULL),
(73, 1, 50, 0, 0, 50, NULL, 1401, 67, 1, 16, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', NULL, NULL, NULL),
(74, 1, 100, 0, 0, 100, NULL, 1427, 68, 1, 16, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', NULL, NULL, NULL),
(75, 1, 20, 0, 0, 20, NULL, 1421, 69, 1, 16, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', NULL, NULL, NULL),
(76, 800, 16000, 0, 0, 20, NULL, 1421, 70, 1, 16, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', NULL, NULL, NULL),
(77, 5, 25, 0, 0, 5, NULL, 1408, 71, 1, 16, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', NULL, NULL, NULL),
(78, 1, 200, 0, 0, 200, NULL, 3, 72, 1, 16, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', NULL, NULL, NULL),
(79, 1, 200, 0, 0, 200, NULL, 3, 73, 1, 16, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', NULL, NULL, NULL),
(80, 1, 180, 20, 1, 200, NULL, 2113, 74, 1, 16, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', NULL, NULL, NULL),
(81, 1, 20, 0, 0, 20, NULL, 149, 74, 1, 16, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', NULL, NULL, NULL),
(82, 1, 100, 0, 0, 100, '', 1427, 75, 1, 16, 27, 27, '2022-01-29 11:17:28', '2022-01-29 11:17:28', NULL, NULL, ''),
(83, 2, 200, 0, 0, 100, NULL, 1427, 76, 1, 16, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', NULL, NULL, NULL),
(110, 20, 2400, 0, 0, 120, '', 2105, 86, 1, 16, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', NULL, NULL, ''),
(112, 5, 500, 0, 0, 100, '', 3, 88, 1, 16, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', NULL, NULL, ''),
(113, 3, 90, 0, 0, 30, NULL, 2113, 89, 1, 16, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', NULL, NULL, NULL),
(114, 1, 80, 20, 1, 100, NULL, 2105, 89, 1, 16, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', NULL, NULL, NULL),
(116, 2, 3000, 0, 0, 1500, NULL, 82, 91, 1, 16, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', NULL, NULL, NULL),
(117, 1, 1950, 50, 1, 2000, NULL, 66, 91, 1, 16, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', NULL, NULL, NULL),
(132, 1, 35, 0, 0, 35, '', 147, 102, 1, 16, 26, 26, '2022-03-01 05:16:39', '2022-03-01 05:16:39', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_return_entries`
--

CREATE TABLE `invoice_return_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_entries_id` int(10) UNSIGNED DEFAULT NULL,
  `returned_quantity` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `barcode_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `reorder_point` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_purchases` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_sales` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_manufacture` double DEFAULT NULL,
  `total_use` double DEFAULT NULL,
  `total_purchase_return` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(3, 'sc1234', 'jewellery', 'top', '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, '80', '9', NULL, 18, 112, 2, 25, 25, '2021-11-08 17:49:32', '2022-02-24 09:25:52', NULL, NULL, NULL, NULL, NULL),
(4, '000004', 'jewellery', 'pearl mala', '300', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:50:56', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(5, '000005', 'jewellery', 'ring', '150', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:53:16', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(6, '000006', 'jewellery', 'puthir mala', '450', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:55:46', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(7, '000007', 'bags 2', 'emoji bags', '200', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, 10, 107, 1, 1, 25, '2021-11-08 18:02:37', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(9, '000009', 'jewellery', 'mala set', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:11:54', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(10, '000010', 'jewellery', 'golden earings', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:12:49', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(11, '000011', 'jewellery', 'antique round earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:14:33', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(12, '000012', 'jewellery', 'small stone earings', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:15:22', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(13, '000013', 'jewellery', 'big stone earings', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:16:22', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(14, '000014', 'jewellery', 'antique neck piece', '450', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:18:35', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(15, '000015', 'jewellery', 'pearl stone mala', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:19:52', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(16, '000016', 'jewellery', 'big locket mala', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:21:05', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(17, '000017', 'jewellery', 'big locket mala', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:21:58', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(18, '000018', 'jewellery', 'antique mala peacock', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:23:10', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(19, '000019', 'jewellery', 'kundan set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:24:36', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(20, '000020', 'jewellery', 'antique big ', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:25:32', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(21, '000021', 'jewellery', 'antique big multi mal', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:26:25', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(22, '000022', 'jewellery', 'antique jhumka', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:27:31', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(23, '000023', 'jewellery', 'puthir earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:29:03', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(24, '000024', 'jewellery', 'tikli', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:31:08', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(25, '000025', 'jewellery', 'bracelet big', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-08 18:31:47', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(26, '000026', 'jewellery', 'bracelet set', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:33:18', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(27, '000027', 'jewellery', 'antique gold', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:34:53', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(28, '000028', 'jewellery', 'pearl earings', '470', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:35:56', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(29, '000029', 'jewellery', 'golden mala set', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:36:42', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(30, '000030', 'jewellery', 'mala set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:37:17', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(31, '000031', 'jewellery', 'pearl/kundan earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:38:55', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(32, '000032', 'jewellery', 'flower earings', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:39:40', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(33, '000033', 'jewellery', 'flower earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:40:30', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(34, '000034', 'jewellery', 'estone earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:42:52', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(35, '000035', 'jewellery', 'big earings stone', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-08 18:43:22', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(36, '000036', 'jewellery', 'stone earings', '440', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:44:54', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(37, '000037', 'jewellery', 'kundan', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:45:30', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(38, '000038', 'jewellery', 'antique mala', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:46:06', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(39, '000039', 'jewellery', 'locket set', '220', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:46:52', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(40, '000040', 'jewellery', 'chennai set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:48:40', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(41, '000041', 'jewellery', 'shuta mala set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:49:19', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(42, '000042', 'jewellery', 'antique set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:49:56', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(43, '000043', 'jewellery', 'antique set', '600', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:50:46', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(44, '000044', 'jewellery', 'antique set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:51:19', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(45, '000045', 'jewellery', 'earings', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:53:29', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(46, '000046', 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:53:58', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(47, '000047', 'jewellery', 'antique earings', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:54:32', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(48, '000048', 'jewellery', 'puthir mirror earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:55:20', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(49, '000049', 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:55:58', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(50, '000050', 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:57:28', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(51, '000051', 'jewellery', 'payel', '350', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:58:09', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(52, '000052', 'jewellery', 'tikli', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:58:39', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(53, '000053', 'jewellery', 'antique jhumka', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:59:51', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(54, '000054', 'jewellery', 'earings', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:00:22', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(55, '000055', 'jewellery', 'stone jhumka', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:02:55', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(56, '000056', 'jewellery', 'earings', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:03:21', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(57, '000057', 'jewellery', 'blue choker', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:03:54', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(58, '000058', 'jewellery', 'nolok', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:04:48', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(59, '000059', 'cotton saree', 'cotton saree', '1000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:08:29', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(60, '000060', 'cotton silk', 'cotton silk', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:12:24', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(61, '000061', 'batik silk saree', 'batik silk saree', '1550', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:13:17', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(62, '000062', 'katan+tissue', 'katan,tissue', '2500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:14:16', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(63, '000063', 'saree batik cotton', 'batik cotton', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:15:10', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(64, '000064', 'chanderi cotton ', 'chanderi cotton ', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, 1, 1, 1, '2021-11-08 19:19:29', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(65, '000065', 'malhar+boutique+kota3piece', 'malhar,boutiqe,kota3piece', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:22:02', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(66, '000066', 'embroidery', 'embroidery 3 piece', '2000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:23:26', '2022-02-24 09:15:44', NULL, NULL, NULL, NULL, NULL),
(67, '000067', 'cotton catalogue', 'cotton catalogue dress', '2300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:24:24', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(68, '000068', 'georgette,karchupi', 'georgette,karchupi dress', '5000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:27:30', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(69, '000069', 'bangla karchupi', '', '2500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:28:23', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(70, '000070', 'piyani print', 'piyani print', '1700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, 14, NULL, 1, 1, 1, '2021-11-08 19:31:04', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(71, '000071', 'batik tersel saree', 'batik tersel saree', '1800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '410', NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:04:53', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(72, '000072', 'batik online saree', 'batik online saree', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:05:57', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(73, '000073', 'batik patti saree', 'batik patti saree', '1800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:06:56', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(74, '000074', 'batik kota saree', 'batik kota saree', '2300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:07:33', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(75, '000075', 'luckhnow', 'luckhnow', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:09:28', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(76, '000076', 'bishal rakhi ', 'bishal rakhi three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:10:29', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(77, '000077', 'dupiyan', 'dupiyan three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:11:23', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(78, '000078', 'embroidery', 'embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:12:19', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(79, '000079', 'bishal sequence', 'bishal sequence three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:13:29', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(80, '000080', 'bishal indian embroidery', 'bishal indian embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:14:35', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(81, '000081', 'bishal indian embroidery', 'bishal indian embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:14:36', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(82, '000082', 'batik cotton dress', 'batik cotton dress', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:15:30', '2022-02-24 09:15:44', NULL, NULL, NULL, NULL, NULL),
(83, '000083', 'jewellery', 'diamond cut ring', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:16:07', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(84, '000084', 'jewellery', 'magnet bracelet', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:16:52', '2021-12-21 18:56:55', NULL, NULL, NULL, NULL, NULL),
(85, '000085', 'jewellery', 'small top emoji earing', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:18:09', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(86, '000086', 'jewellery', 'small jhumka earing', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:18:48', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(87, '000087', 'cotton three piece', 'cotton 3piece', '800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:20:20', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(88, '000088', 'jewellery', '\r\ntop earings', '300', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:55:00', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(89, '000089', 'jewellery', 'top earings', '400', NULL, NULL, NULL, '170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:55:39', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(90, '000090', 'jewellery', 'top earings', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:56:37', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(91, '000091', 'jewellery', 'top earings', '300', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-11 17:57:26', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(92, '000092', 'jewellery', 'top earings', '350', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:00:22', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(93, '000093', 'jewellery', 'top earings', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:01:43', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(94, '000094', 'jewellery', 'top earings', '400', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:05:44', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(95, '000095', 'jewellery', 'top earings', '450', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:06:19', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(96, '000096', 'jewellery', 'top earings', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:09:13', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(97, '000097', 'jewellery', 'top earings', '350', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:11:58', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(98, '000098', 'jewellery', 'top earings', '350', NULL, NULL, NULL, '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:15:58', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(99, '000099', 'jewellery', 'small top earings', '200', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:17:54', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(100, '000100', 'jewellery', 'top earings ', '1000', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:19:08', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(101, '000101', 'jewellery', 'churi', '350', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:21:49', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(102, '000102', 'jewellery', 'churi', '300', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:22:44', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(103, '000103', 'jewellery', 'churi', '800', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:23:32', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(104, '000104', 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:25:28', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(105, '000105', 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:26:30', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(106, '000106', 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:27:08', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(107, '000107', 'jewellery', 'churi', '600', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:29:27', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(108, '000108', 'jewellery', 'churi', '400', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:30:01', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(109, '000109', 'jewellery', 'churi', '500', NULL, NULL, NULL, '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:30:36', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(110, '000110', 'jewellery', 'churi', '400', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:31:12', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(111, '000111', 'jewellery', 'payel', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:32:13', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(112, '000112', 'jewellery', 'small locket', '300', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:45:55', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(113, '000113', 'jewellery', 'small locket', '350', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:47:12', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(114, '000114', 'jewellery', 'small locket', '250', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:48:57', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(115, '000115', 'jewellery', 'small locket', '250', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:49:58', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(116, '000116', 'jewellery', 'baby bracelet', '150', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:51:27', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(117, '000117', 'jewellery', 'baby silver', '200', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:52:52', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(118, '000118', 'jewellery', 'magnet bracelet', '250', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:53:29', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(119, '000119', 'jewellery', 'plastic bracelet', '150', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:55:13', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(120, '000120', 'jewellery', 'jhapta', '400', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:55:56', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(121, '000121', 'jewellery', 'antique stone', '500', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:57:51', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(122, '000122', 'jewellery', 'white big neck piece', '2500', NULL, NULL, NULL, '1060', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:59:34', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(123, '000123', 'jewellery', 'chennai neck piece', '2000', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:01:19', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(124, '000124', 'jewellery', 'chennai neck piece', '2000', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:02:11', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(125, '000125', 'jewellery', 'mina set', '450', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:04:00', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(126, '000126', 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:05:08', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(127, '000127', 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:06:03', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(128, '000128', 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:07:13', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(129, '000129', 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:08:03', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(130, '000130', 'jewellery', 'chik pearl', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:09:52', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(131, '000131', 'jewellery', 'big neck piece', '400', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:12:16', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(132, '000132', 'jewellery', 'chik antique', '600', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:13:26', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(133, '000133', 'jewellery', 'locket set', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:14:58', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(134, '000134', 'jewellery', 'white neck piece', '1200', NULL, NULL, NULL, '460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:15:52', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(135, '000135', 'jewellery', 'locket', '600', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:16:49', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(136, '000136', 'jewellery', 'big neck piece', '500', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:17:42', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(137, '000137', 'jewellery', 'big neck piece', '450', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:18:29', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(138, '000138', 'jewellery', 'white neck piece', '1500', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:19:25', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(139, '000139', 'jewellery', 'white neck piece', '2200', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:21:18', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(140, '000140', 'test branch item', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '28', '19', NULL, 10, 107, 2, 25, 25, '2021-11-18 08:50:56', '2022-01-07 12:52:32', NULL, NULL, NULL, NULL, 6),
(143, '000143', 'Test Item', NULL, '1200.5', NULL, NULL, NULL, '1150.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 112, 1, 1, 1, '2021-12-12 05:48:31', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(144, '000144', '28 Lota Rice loss', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '12', '4', NULL, 21, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:03:55', NULL, NULL, NULL, NULL, NULL),
(145, '8941100313497', '7up 2.25Lt', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '10', '0', NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:15', NULL, NULL, NULL, NULL, NULL),
(146, '8941100313800', '7up 1.25L', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:13', NULL, NULL, NULL, NULL, NULL),
(147, '8941100313442', '7up 600ml ', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-03-01 05:16:39', NULL, NULL, NULL, NULL, NULL),
(148, '8941100313411', '7up 250ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 06:53:28', NULL, NULL, NULL, NULL, NULL),
(149, '000149', '7 up 200 ML ', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:51', NULL, NULL, NULL, NULL, NULL),
(150, '000150', '7up Can ', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:00:39', NULL, NULL, NULL, NULL, NULL),
(151, '000151', 'Aarong Laban 250Ml', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(152, '000152', 'Aarong Laban 500Ml', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(153, '000153', 'Aarong Misty Doi', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:54', NULL, NULL, NULL, NULL, NULL),
(154, '000154', 'Aarong Sour yogurt ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(155, '000155', 'Aarong Butter 100Gm', NULL, '105', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(156, '8941101010616', 'Aarong Butter 200Gm', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:00:39', NULL, NULL, NULL, NULL, NULL),
(157, '000157', 'Aarong Milk liquid 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(158, '8941159000515', 'Aarong Milk liquid 500Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:06:03', NULL, NULL, NULL, NULL, NULL),
(159, '8941159000591', 'Aarong Milk liquid 1Lt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:06:03', NULL, NULL, NULL, NULL, NULL),
(160, '8941101010265', 'Aarong UHT Milk 200Ml', NULL, '22', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:00:39', NULL, NULL, NULL, NULL, NULL),
(161, '000161', 'Aarong UHT Milk 500Ml', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:00:39', NULL, NULL, NULL, NULL, NULL),
(162, '000162', 'Aarong Mango UHT Milk 125 Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(163, '000163', 'Aarong Mango UHT Milk 200 Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(164, '8941159000461', 'Aarong Chocolate  UHT Milk 125 Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(165, '8941101010272', 'Aarong Chocolate  UHT Milk 200 Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:59', NULL, NULL, NULL, NULL, NULL),
(166, '000166', 'Aarong Strawberry UHT Milk 125 Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(167, '000167', 'Aarong Strawberry  UHT Milk 200 Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(168, '8941101010012', 'Aarong Ghee 100 Gm', NULL, '165', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:45', NULL, NULL, NULL, NULL, NULL),
(169, '8941101010531', 'Aarong Ghee 200Gm', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(170, '8941101010548', 'Aarong Ghee 400Gm', NULL, '565', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:04:46', NULL, NULL, NULL, NULL, NULL),
(171, '000171', 'Aarong Ghee 900Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(172, '8133358131026', 'Acme Mango Fruits Drinks 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:54', NULL, NULL, NULL, NULL, NULL),
(173, '000173', 'ACI Air Freshener Orange flavour ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(174, '8139003000877', 'ACI Air Freshener Misty Wood flavour ', NULL, '215', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:23:05', NULL, NULL, NULL, NULL, NULL),
(175, '8139003000846', 'ACI Air Freshener Citrus Burst flavour ', NULL, '215', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:23:05', NULL, NULL, NULL, NULL, NULL),
(176, '000176', 'ACI Air Freshener Anti Tabac flavour ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(177, '8139003003755', 'ACI Air Freshener Pink Rose flavour ', NULL, '215', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:23:05', NULL, NULL, NULL, NULL, NULL),
(178, '000178', 'ACI Air Freshener Orchid Breeze flavour ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(179, '813903000127', 'ACI Aerosol 250ML', NULL, '185', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:59', NULL, NULL, NULL, NULL, NULL),
(180, '813903000028', 'ACI Aerosol 350ML', NULL, '255', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:23:05', NULL, NULL, NULL, NULL, NULL),
(181, '813903000035', 'ACI Aerosol 475ML', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:23:05', NULL, NULL, NULL, NULL, NULL),
(182, '000182', 'ACI Aerosol 800ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(183, '8139003003496', 'ACI Coil per pcs', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:35:32', NULL, NULL, NULL, NULL, NULL),
(184, '8189003100121', 'ACI Neem Orginal 75GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:35:32', NULL, NULL, NULL, NULL, NULL),
(185, '8941196220013', 'ACI Salt 500Gm', NULL, '17', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:35:32', NULL, NULL, NULL, NULL, NULL),
(186, '8941196220037', 'ACI Salt 1KG', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 07:35:32', NULL, NULL, NULL, NULL, NULL),
(187, '000187', 'Acquafina 1 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:59', NULL, NULL, NULL, NULL, NULL),
(188, '8902080504060', 'Acquafina 1.5LTR', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(189, '8941100310434', 'Acquafina 500ML', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(190, '000190', 'Aer Bathroom Fragrance', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(191, '000191', 'Alu Bokhara 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:56', NULL, NULL, NULL, NULL, NULL),
(192, '000192', 'Anchor Dal 1KG', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(193, '000193', 'Alach Loss', NULL, '3000', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-01-12 12:56:59', NULL, NULL, NULL, NULL, NULL),
(194, '000194', 'Atta 1kg loss', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(195, '000195', 'Ahmad Soya Sauce 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(196, '000196', 'Ahmad Hot tomato sauce 1kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(197, '000197', 'Ahmad tomato ketchup sauce 1kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(198, '000198', 'Ahmad Chili Sauce 1kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(199, '000199', 'Big Regure 1', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(200, '000200', 'Big Regure 2', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(201, '000201', 'Big Regure 3', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(202, '3086126636641', 'Big Body Regure ', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(203, '8513695155303', 'Bactrol Soap 100Ml', NULL, '34', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:46:40', NULL, NULL, NULL, NULL, NULL),
(204, '841165104802', 'Braver 250 Ml', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(205, '000205', 'Barmisk Achar', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(209, '8941190500012', 'Akiz Bread 400gm', '', '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:37:05', NULL, NULL, NULL, NULL, NULL),
(210, '8941190500050', 'Akiz Bread 200 gm', '', '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:39:44', NULL, NULL, NULL, NULL, NULL),
(211, '000211', 'Bread 65 Taka', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(212, '000212', 'Bidyut Kalu majon', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(213, '000213', 'Bidyut Neem majon', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(214, '000214', 'Biscuit all 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(215, '000215', 'Biscuit all 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(216, '000216', 'Biscuit all 15taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(217, '000217', 'Biscuit all 20 taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(218, '000218', 'Biscuit all 25 taka', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(219, '000219', 'Brush All', NULL, '00', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(220, '000220', 'Blade 3 Taka ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(221, '000221', 'Blade 5 Taka', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(222, '8901571009091', 'Brush Sensodyne Original 60 taka', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(223, '8025765271504', 'Baking Powder 150GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:25:07', NULL, NULL, NULL, NULL, NULL),
(224, '8857650351004', 'Baking Powder 100GM', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:25:22', NULL, NULL, NULL, NULL, NULL),
(225, '000225', 'Banoful Lascha Semai 200 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(226, '000226', 'Banoful vermicelli semai', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(227, '000227', 'Bonoful Biscuit Jar 800Gm', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(228, '000228', 'Bonoful Horlicks Biscuit', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(229, '000229', 'Bashundhara Atta 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(230, '000230', 'Bashundhara Atta 2KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(231, '000231', 'Bashundhara Atta 5 KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(232, '000232', 'Bashundhara Brown Atta 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(233, '000233', 'Bashundhara Brown Atta 2KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(234, '000234', 'Bashundhara Suji 500GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(235, '8941193041031', 'Bashundhara Paper Napkin', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:51:16', NULL, NULL, NULL, NULL, NULL),
(236, '8941193073162', 'Bashundhara Facial Tissue 120pcs', NULL, '72', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:51:16', NULL, NULL, NULL, NULL, NULL),
(237, '8941193042014', 'Bashundhara Kitchen Tissue', NULL, '68', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:51:16', NULL, NULL, NULL, NULL, NULL),
(238, '8941193067017', 'Bashundhara Toilet Tissue (Gold)', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 06:11:49', NULL, NULL, NULL, NULL, NULL),
(239, '8941193067024', 'Bashundhara Toilet Tissue (White)', NULL, '17', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:51:16', NULL, NULL, NULL, NULL, NULL),
(240, '8941193071618', 'Bashundhara poket Tissue', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 08:51:16', NULL, NULL, NULL, NULL, NULL),
(241, '000241', 'Bashundhara Soyabean 1 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(242, '000242', 'Bashundhara Soyabean 2 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(243, '000243', 'Bashundhara Soyabean 5 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(244, '000244', 'Boama Mosquito Coil', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(245, '000245', 'Bombay Aha Muri 230Gm', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(246, '8941154031385', 'Bombay Chanachur 150GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(247, '8909790003296', 'Bombay Chanachur 300GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(248, '000248', 'Bombay Chanachur 500GM', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(249, '000249', 'Brush Up pest mini', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:37:26', NULL, NULL, NULL, NULL, NULL),
(250, '000250', 'Bengal Tea Patha 50Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(251, '000251', 'Bengal Tea Patha 500Ml BOP', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(252, '8941155013632', 'Cocoola Egg&Chicken Noodles ', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:00:32', NULL, NULL, NULL, NULL, NULL),
(253, '000253', 'Candle 5 Taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(254, '000254', 'Candle 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(255, '000255', 'Cake 5 taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(256, '000256', 'Cake 10 Taka All', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(257, '8941100294369', 'Cerelac 400gm (12-24) Wheat & Apple Corn Flakes', NULL, '410', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:44:27', NULL, NULL, NULL, NULL, NULL),
(258, '8941100293942', 'Cerelac 350 gm(18-36)5 Fruits & Multi Grain', NULL, '450', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:45:37', NULL, NULL, NULL, NULL, NULL),
(259, '000259', 'Cerelac-3 400GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(260, '000260', 'Cerelac-4 400GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(261, '000261', 'Chira loss', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:26', NULL, NULL, NULL, NULL, NULL),
(262, '000262', 'Chira Vaja', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:44', NULL, NULL, NULL, NULL, NULL),
(263, '8941100501443', 'Chaka Ball 130GM', NULL, '17', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:46:06', NULL, NULL, NULL, NULL, NULL),
(264, '8941100501238', 'Chamak Fabric Brightner 100ML', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:46:55', NULL, NULL, NULL, NULL, NULL),
(265, '8941100501221', 'Chamak Fabric Brightner 50ML', NULL, '18', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:46:37', NULL, NULL, NULL, NULL, NULL),
(266, '8941100513873', 'Chira baza 8 Taka', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:47:38', NULL, NULL, NULL, NULL, NULL),
(267, '000267', 'Chanachur 5 taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:47:15', NULL, NULL, NULL, NULL, NULL),
(268, '000268', 'Chanachur 10 taka All', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:47:08', NULL, NULL, NULL, NULL, NULL),
(269, '000269', 'Chanachur 15 taka All', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:47:12', NULL, NULL, NULL, NULL, NULL),
(270, '000270', 'Champion Choclate (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:57', NULL, NULL, NULL, NULL, NULL),
(271, '8941100512104', 'Chashi Chinigura 1KG', NULL, '125', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:24:48', NULL, NULL, NULL, NULL, NULL),
(272, '000272', 'Chashi Chinigura 2KG', NULL, '240', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:24:58', NULL, NULL, NULL, NULL, NULL),
(273, '000273', 'Chinigura (Loose) 1KG', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:03', NULL, NULL, NULL, NULL, NULL),
(274, '8917325207057', 'Choco Fun Biscuit family size', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:27:25', NULL, NULL, NULL, NULL, NULL),
(275, '000275', 'Chola Boot 1 KG', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:27:42', NULL, NULL, NULL, NULL, NULL),
(276, '8941100515174', 'Chopstick Noodles 8 p ', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:29:07', NULL, NULL, NULL, NULL, NULL),
(277, '8941100515167', 'Chopstick Noodles  4p ', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:29:17', NULL, NULL, NULL, NULL, NULL),
(278, '000278', 'Chopstick Noodles 12pcs', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:27:50', NULL, NULL, NULL, NULL, NULL),
(279, '000279', 'Chips 5 Taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:19', NULL, NULL, NULL, NULL, NULL),
(280, '000280', 'Chips 10 Taka All', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:06', NULL, NULL, NULL, NULL, NULL),
(281, '000281', 'Chips 15 Taka All', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:08', NULL, NULL, NULL, NULL, NULL),
(282, '000282', 'Chips 20 Taka All', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:11', NULL, NULL, NULL, NULL, NULL),
(283, '000283', 'Chips 25 Taka All', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:25:16', NULL, NULL, NULL, NULL, NULL),
(284, '000284', 'Chocolate 1 taka All', NULL, '1', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(285, '000285', 'Chocolate 2 taka All', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(286, '000286', 'Chocolate 3 taka All', NULL, '3', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(287, '000287', 'Chocolate 5 taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(288, '000288', 'Chocolate 10 taka All', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(289, '000289', 'Chocolate 15 taka All', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(290, '000290', 'Chocolate Box 50 taka All', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:50:13', NULL, NULL, NULL, NULL, NULL),
(291, '840205713172', 'Chocolate Box 100 taka All', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:49:52', NULL, NULL, NULL, NULL, NULL),
(292, '000292', 'Chocolate Box 120 taka All', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:50:01', NULL, NULL, NULL, NULL, NULL),
(293, '000293', 'Chocolate Box 150 taka All', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:50:06', NULL, NULL, NULL, NULL, NULL),
(294, '000294', 'Chocolate Box 200 taka All', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:50:09', NULL, NULL, NULL, NULL, NULL),
(295, '8941155007402', 'Choco Blust Cone', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:26:44', NULL, NULL, NULL, NULL, NULL),
(296, '000296', 'Clemon 250Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:54:59', NULL, NULL, NULL, NULL, NULL),
(297, '000297', 'Clemon 500Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:55:06', NULL, NULL, NULL, NULL, NULL),
(298, '8941189600143', 'Clemon 1Lt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:54:39', NULL, NULL, NULL, NULL, NULL),
(299, '000299', 'Clemon 2 Lt', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:54:31', NULL, NULL, NULL, NULL, NULL),
(300, '8941100619766', 'Clinic Plus Shampoo 170Ml', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:55:44', NULL, NULL, NULL, NULL, NULL),
(301, '8941100619759', 'Clinic Plus Shampoo 340Ml', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:55:57', NULL, NULL, NULL, NULL, NULL),
(302, '000302', 'Clean & Clear Face Wash 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(303, '000303', 'Clean & Clear Face Wash 50ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(304, '8941100659212', 'Clear Anti Dandrof Shampoo 90ML', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:33:43', NULL, NULL, NULL, NULL, NULL),
(305, '000305', 'Clear Anti Dandrof Shampoo 180ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(306, '8941102313990', 'Clear Anti Dandrof Shampoo 350ML', NULL, '340', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 05:31:12', NULL, NULL, NULL, NULL, NULL),
(307, '000307', 'Clear Anti Hair Fall Shampoo 90ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(308, '000308', 'Clear Anti Hair Fall Shampoo 180ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(309, '000309', 'Clear Anti Hair Fall Shampoo 350ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(310, '000310', 'Clear Men Cool Menthol Shampoo 80ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(311, '8941102311354', 'Clear Men Anti-Dandruff Shampoo 180ML', NULL, '240', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:53:33', NULL, NULL, NULL, NULL, NULL),
(312, '000312', 'Clear Men Cool Menthol Shampoo 350ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(313, '8941102313969', 'Clear Men Anti-Dandruff Shampoo 330ML', NULL, '399', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:52:41', NULL, NULL, NULL, NULL, NULL),
(314, '8941102310494', 'Closeup 45 GM', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:57:53', NULL, NULL, NULL, NULL, NULL),
(315, '8941102310470', 'Closeup 100GM', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:57:07', NULL, NULL, NULL, NULL, NULL),
(316, '000316', 'Closeup 145GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(317, '8941102312344', 'Closeup 160GM', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:57:42', NULL, NULL, NULL, NULL, NULL),
(318, '000318', 'Cotton Buds 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:15:47', NULL, NULL, NULL, NULL, NULL),
(319, '000319', 'Cotton Buds 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:15:43', NULL, NULL, NULL, NULL, NULL),
(320, '000320', 'Cotton Buds Box 30 Taka', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:15:55', NULL, NULL, NULL, NULL, NULL),
(321, '000321', 'Coco Powder 80GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(322, '000322', 'Colgate Herbal 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(323, '000323', 'Colgate Herbal 200GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(324, '8901314561206', 'Colgate active salt 44 GM', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:02:14', NULL, NULL, NULL, NULL, NULL),
(325, '8901314009586', 'Colgate active salt 100 GM', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:02:41', NULL, NULL, NULL, NULL, NULL),
(326, '8901314009081', 'Colgate active salt 200 GM', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:03:14', NULL, NULL, NULL, NULL, NULL),
(327, '000327', 'Colgate Max fresh Red Gel 38 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(328, '000328', 'Colgate Max fresh Blue Gel 38 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(329, '000329', 'Colgate Max fresh Blue Gel 80 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(330, '8901314563200', 'Colgate Max fresh Red Gel 70 GM', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:05:16', NULL, NULL, NULL, NULL, NULL),
(331, '8901314309914', 'Colgate Max fresh Red Gel 150 GM', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:07:33', NULL, NULL, NULL, NULL, NULL),
(332, '8901314309921', 'Colgate Max fresh Blue Gel 150 GM', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:04:32', NULL, NULL, NULL, NULL, NULL),
(333, '8901314552563', 'Colgate Strong Teeth 46GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:06:53', NULL, NULL, NULL, NULL, NULL),
(334, '8901314305541', 'Colgate Strong Teeth 100GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:08:34', NULL, NULL, NULL, NULL, NULL),
(335, '8901314305602', 'Colgate Strong Teeth 200GM', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:06:13', NULL, NULL, NULL, NULL, NULL),
(336, '8901314081018', 'Colgate Cibaca 175 Gm', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:07:16', NULL, NULL, NULL, NULL, NULL),
(337, '8941114006255', 'Kishwan Chocolate Cookies Biscuit ', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:18:14', NULL, NULL, NULL, NULL, NULL),
(338, '4800361005500', 'Corn Flakes 275gm ', NULL, '330', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:15:15', NULL, NULL, NULL, NULL, NULL),
(339, '000339', 'Corn Flour 150GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(340, '8025765281503', 'Custard Powder 100GM', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:22:17', NULL, NULL, NULL, NULL, NULL),
(341, '8941139300024', 'CosCo Soap 80Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:15:39', NULL, NULL, NULL, NULL, NULL),
(342, '000342', 'Coca-Cola 200Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:58:20', NULL, NULL, NULL, NULL, NULL),
(343, '8907525000114', 'Coca-Cola 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:59:06', NULL, NULL, NULL, NULL, NULL),
(344, '000344', 'Coca-Cola 400Ml', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:58:31', NULL, NULL, NULL, NULL, NULL),
(345, '8907525000169', 'Coca-Cola 600Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:59:11', NULL, NULL, NULL, NULL, NULL),
(346, '8907525000190', 'Coca-Cola 1.25Lt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:00:36', NULL, NULL, NULL, NULL, NULL),
(347, '8907525000237', 'Coca-Cola 2.25Lt', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 09:58:43', NULL, NULL, NULL, NULL, NULL),
(348, '000348', 'Cute Perfumed Coconut Oil 90Ml', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:27:27', NULL, NULL, NULL, NULL, NULL),
(349, '000349', 'Cute Perfumed Coconut Oil 200Ml', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:26:47', NULL, NULL, NULL, NULL, NULL),
(350, '000350', 'Cute Perfumed Coconut Oil 330Ml', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:26:57', NULL, NULL, NULL, NULL, NULL),
(351, '4796012050220', 'CBL Choco.Mo', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(352, '4796012054228', 'CBL Next family', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(353, '4796012054006', 'CBL Chocolate Fingers ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-23 09:06:21', NULL, NULL, NULL, NULL, NULL),
(354, '8946000009631', 'Dan Cake vanilla plain 15 Taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:45:56', NULL, NULL, NULL, NULL, NULL),
(355, '000355', 'Dan Cake Chocolate  plain 15 taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:46:34', NULL, NULL, NULL, NULL, NULL),
(356, '8946000009556', 'Dan Cake Chocolate 35 Taka', '', '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-22 06:47:52', NULL, NULL, NULL, NULL, NULL),
(357, '000357', 'Dan Cake Chocolate 50 Taka', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:50:02', NULL, NULL, NULL, NULL, NULL),
(358, '745125253572', 'Dan Cake Vanilla 50 Taka', '', '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-22 06:53:16', NULL, NULL, NULL, NULL, NULL),
(359, '8946000009532', 'Dan Cake Vanila Pound Family size', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:56:27', NULL, NULL, NULL, NULL, NULL),
(360, '745125253503', 'Dan Cake Fruit cake Family size', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:55:10', NULL, NULL, NULL, NULL, NULL),
(361, '8946000009020', 'Dan Cake Marble cake Family size', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:56:19', NULL, NULL, NULL, NULL, NULL),
(362, '8946000009105', 'Dan Cake Chocolate Pound Family size', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:53:13', NULL, NULL, NULL, NULL, NULL),
(363, '8946000009839', 'Dan Cake Lemon Pound Family size', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:55:30', NULL, NULL, NULL, NULL, NULL),
(364, '745178898454', 'Dan Cake Danish Butter Cookies ', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:54:44', NULL, NULL, NULL, NULL, NULL),
(365, '8946000009884', 'Dan Cake dry cake ', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:31:32', NULL, NULL, NULL, NULL, NULL),
(366, '000366', 'Dabur Amla Hair Oil 90Ml', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:30:56', NULL, NULL, NULL, NULL, NULL),
(367, '8901207019005', 'Dabur Amla Hair Oil 180Ml', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:29:27', NULL, NULL, NULL, NULL, NULL),
(368, '8901207019012', 'Dabur Amla Hair Oil 275Ml', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:30:27', NULL, NULL, NULL, NULL, NULL),
(369, '8901207019005', 'Dabur Amla 180ML', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:29:19', NULL, NULL, NULL, NULL, NULL),
(370, '000370', 'Dabur Amla 275ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(371, '8901207045370', 'Dabur Honey 50 Gm', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:32:22', NULL, NULL, NULL, NULL, NULL),
(372, '8901207005374', 'Dabur Honey 100GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:31:56', NULL, NULL, NULL, NULL, NULL),
(373, '8901207035364', 'Dabur Honey 250GM', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:31:43', NULL, NULL, NULL, NULL, NULL),
(374, '000374', 'Dabur Honey 600GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(375, '8901207500657', 'Dabur meswak toothpaste 100gm', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:34:07', NULL, NULL, NULL, NULL, NULL),
(376, '000376', 'Dabur Red Tooth Paste 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(377, '8941154030661', 'Dalmoth chanachur 150Gm', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:46:49', NULL, NULL, NULL, NULL, NULL),
(378, '890979000534', 'Dalmoth chanachur 300Gm', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:47:02', NULL, NULL, NULL, NULL, NULL),
(379, '000379', 'Dal Vaja 5 ta All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:43:21', NULL, NULL, NULL, NULL, NULL),
(380, '000380', 'Dal Vaja 8 taka all', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:43:32', NULL, NULL, NULL, NULL, NULL),
(381, '000381', 'Dairy Milk 5 Taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:32:57', NULL, NULL, NULL, NULL, NULL),
(382, '000382', 'Dairy Milk 10Taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:32:52', NULL, NULL, NULL, NULL, NULL),
(383, '000383', 'Dairy Milk 20 Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:32:54', NULL, NULL, NULL, NULL, NULL),
(384, '8901233030548', 'Dairy Milk Cadbury 20 Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:39:16', NULL, NULL, NULL, NULL, NULL),
(385, '7622201149406', 'Dairy Milk Cadbury 40 Taka', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:39:35', NULL, NULL, NULL, NULL, NULL),
(386, '000386', 'Dairy Milk Cadbury 100 Taka', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(387, '8901233034188', 'Dairy Milk Cadbury Silk Chocolate', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:42:36', NULL, NULL, NULL, NULL, NULL),
(388, '7622201505349', 'Dairy Milk Cadbury Silk Bubbly', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:40:24', NULL, NULL, NULL, NULL, NULL),
(389, '7622201505592', 'Dairy Milk Cadbury Silk Oreo', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:41:00', NULL, NULL, NULL, NULL, NULL),
(390, '7622201505080', 'Dairy Milk Cadbury Silk HAZELNUT ', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:42:46', NULL, NULL, NULL, NULL, NULL),
(391, '7622201452674', 'Dairy Milk Cadbury Silk Fruit & NuT', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 10:41:50', NULL, NULL, NULL, NULL, NULL),
(392, '8941152000017', 'Danish Condix Milk 500GM', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:00:21', NULL, NULL, NULL, NULL, NULL),
(393, '000393', 'Danish Milk Marie Biscuit ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(394, '8941152011112', 'Danish Sweet Toast Biscuit ', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:02:03', NULL, NULL, NULL, NULL, NULL),
(395, '8941152000437', 'Danish Toast Biscuit ', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:02:14', NULL, NULL, NULL, NULL, NULL),
(396, '8941152000314', 'Danish Lexus Biscuit ', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:00:39', NULL, NULL, NULL, NULL, NULL),
(397, '8941152000222', 'Danish Orange Biscuit ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:01:35', NULL, NULL, NULL, NULL, NULL),
(398, '000398', 'Dano Daily Pusti 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(399, '000399', 'Dano Daily Pusti 500g', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(400, '000400', 'Dano Daily Pusti 200Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(401, '000401', 'Dano Daily Pusti 100gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:58', NULL, NULL, NULL, NULL, NULL),
(402, '000402', 'Dano Daily Pusti 50gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(403, '000403', 'Dano Daily Pusti Mini 18gm', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:02:43', NULL, NULL, NULL, NULL, NULL),
(404, '000404', 'Dano Full Cream 1KG BIB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(405, '000405', 'Dano Full Cream 500gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(406, '000406', 'Dano Full Cream 200gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(407, '000407', 'Dano Full Cream 100gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(408, '000408', 'Dano Power Full Cream Milk 400 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(409, '8941100283264', 'Dettol Mini Bar 10 Taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:06:27', NULL, NULL, NULL, NULL, NULL),
(410, '8941100283141', 'Dettol Cool Bar 75Gm', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:07:31', NULL, NULL, NULL, NULL, NULL),
(411, '8941100283189', 'Dettol Cool Bar 125Gm', NULL, '62', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:06:40', NULL, NULL, NULL, NULL, NULL),
(412, '8941100283165', 'Dettol Original Bar 75Ml', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:05:35', NULL, NULL, NULL, NULL, NULL),
(413, '8941100283202', 'Dettol Original Bar 125Ml', NULL, '62', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:13:29', NULL, NULL, NULL, NULL, NULL),
(414, '8941100283172', 'Dettol Skin Care Bar 75Gm', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:05:05', NULL, NULL, NULL, NULL, NULL),
(415, '8941100283196', 'Dettol Skin Care 125Gm', NULL, '62', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:04:51', NULL, NULL, NULL, NULL, NULL),
(416, '8941102833399', 'Dettol Hand Wash re-energize', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:33:41', NULL, NULL, NULL, NULL, NULL),
(417, '8941102843404', 'Dettol Hand Wash Cool 200ML Pump', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:40:44', NULL, NULL, NULL, NULL, NULL),
(418, '95507972', 'Dettle Hand Sanitizer 50Ml', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:04:03', NULL, NULL, NULL, NULL, NULL),
(419, '000419', 'Dettol Liquid 500ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(420, '000420', 'Dettol Liquid 750ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(421, '8941100315460', 'Dew 1L ', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:42:18', NULL, NULL, NULL, NULL, NULL),
(422, '8941100315415', 'Dew 250ML', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:45:21', NULL, NULL, NULL, NULL, NULL),
(423, '8941100315446', 'Dew 600ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:59:55', NULL, NULL, NULL, NULL, NULL),
(424, '000424', 'Dew 200ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:24:59', NULL, NULL, NULL, NULL, NULL),
(425, '000425', 'Dhonia asto loss', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:25:23', NULL, NULL, NULL, NULL, NULL),
(426, '000426', 'Dhonia gura loss', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:25:33', NULL, NULL, NULL, NULL, NULL),
(427, '000427', 'Digestive 125GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(428, '000428', 'Ding Dong 50ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:54:12', NULL, NULL, NULL, NULL, NULL),
(429, '9415007013396', 'Diploma 1KG', NULL, '690', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:56:28', NULL, NULL, NULL, NULL, NULL),
(430, '000430', 'Diploma 500GM', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:57:51', NULL, NULL, NULL, NULL, NULL),
(431, '9415007843542', 'Diploma 200GM', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:56:56', NULL, NULL, NULL, NULL, NULL),
(432, '000432', 'Diploma 100GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:55:19', NULL, NULL, NULL, NULL, NULL),
(433, '9415007463180', 'Doodles Stick Noodles ', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:59:29', NULL, NULL, NULL, NULL, NULL),
(434, '9415007916598', 'Doodles Noodles 8\'s', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:58:35', NULL, NULL, NULL, NULL, NULL),
(435, '000435', 'Dove Face Wash 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(436, '8901030707674', 'Dove Hair Fall Rescue Conditioner 180ML', NULL, '270', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:01:06', NULL, NULL, NULL, NULL, NULL),
(437, '8941100612057', 'Dove Hair Fall Rescue Shampoo 170 ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:06:20', NULL, NULL, NULL, NULL, NULL),
(438, '8941100612033', 'Dove Intense Repair Shampoo 170ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:09:31', NULL, NULL, NULL, NULL, NULL),
(439, '8941102314034', 'Dove Intense Repair Shampoo 340ML', NULL, '370', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:06:47', NULL, NULL, NULL, NULL, NULL),
(440, '000440', 'Dove Oxygen Moisture Shampoo 170 Ml', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:14:54', NULL, NULL, NULL, NULL, NULL),
(441, '8941100658048', 'Dove Oxygen Moisture Shampoo 340 Ml', NULL, '370', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:13:11', NULL, NULL, NULL, NULL, NULL),
(442, '8941100658079', 'Dove Nourishing Oil Shampoo 170Ml', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:03:08', NULL, NULL, NULL, NULL, NULL),
(443, '8941102314041', 'Dove Nourishing Oil Shampoo 340Ml', NULL, '370', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:13:59', NULL, NULL, NULL, NULL, NULL),
(444, '000444', 'Dove Healthy Ritual Shampoo 170Ml', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:14:59', NULL, NULL, NULL, NULL, NULL),
(445, '8901030731402', 'Dove Healthy Ritual Shampoo 340Ml', NULL, '370', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:09:51', NULL, NULL, NULL, NULL, NULL),
(446, '8901030692048', 'Dove Environmental defence Conditioner', NULL, '290', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:12:14', NULL, NULL, NULL, NULL, NULL),
(447, '8901030763878', 'Dove Soap Original 50GM', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:17:28', NULL, NULL, NULL, NULL, NULL),
(448, '8000700000005', 'Dove Soap Original 100GM', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:17:07', NULL, NULL, NULL, NULL, NULL),
(449, '067238891190', 'Dove Soap Original 135GM', NULL, '99', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:17:47', NULL, NULL, NULL, NULL, NULL),
(450, '000450', 'Darcini Masala 1kg', NULL, '600', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 11:02:59', NULL, NULL, NULL, NULL, NULL),
(451, '000451', 'Dragon No Smoke Coil', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:20:08', NULL, NULL, NULL, NULL, NULL),
(452, '000452', 'Drinko Mango flavour ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:20:52', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(453, '841165145294', 'Drinko PineApple flavour ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:22:04', NULL, NULL, NULL, NULL, NULL),
(454, '841165145331', 'Drinko Strawberry flavour ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:21:40', NULL, NULL, NULL, NULL, NULL),
(455, '841165145355', 'Drinko Litchi flavour ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:21:45', NULL, NULL, NULL, NULL, NULL),
(456, '8941149791195', 'Eagle Coil 1 pcs', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:23:42', NULL, NULL, NULL, NULL, NULL),
(457, '8941149791218', 'Eagle Chaina Coil', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:23:53', NULL, NULL, NULL, NULL, NULL),
(458, '745125275284', 'Eno Orange flavour ', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:29:31', NULL, NULL, NULL, NULL, NULL),
(459, '000459', 'Egg 1pcs', NULL, '8.75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 58, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(460, '000460', 'Eraser 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:26:30', NULL, NULL, NULL, NULL, NULL),
(461, '000461', 'Eraser 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:26:17', NULL, NULL, NULL, NULL, NULL),
(462, '000462', 'Elachi ', NULL, '3300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:24:18', NULL, NULL, NULL, NULL, NULL),
(463, '8888202045584', 'Ever soft Face wash', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:27:53', NULL, NULL, NULL, NULL, NULL),
(464, '8901248451017', 'Emami 7Oils 50ML', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:25:03', NULL, NULL, NULL, NULL, NULL),
(465, '8901248451024', 'Emami 7Oils 100ML', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:25:19', NULL, NULL, NULL, NULL, NULL),
(466, '8901248451031', 'Emami 7Oils 200ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:25:40', NULL, NULL, NULL, NULL, NULL),
(467, '000467', 'Emami 7Oils 300ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(468, '745114130471', 'Olympic Energy Biscuit 240GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:27:22', NULL, NULL, NULL, NULL, NULL),
(469, '000469', 'English Anti Lice Shampoo 125ML', NULL, '7', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 12:27:35', NULL, NULL, NULL, NULL, NULL),
(470, '000470', 'Fanta 200 Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(471, '8907525020112', 'Fanta 250 Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:54:24', NULL, NULL, NULL, NULL, NULL),
(472, '000472', 'Fanta 400Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(473, '8907525020167', 'Fanta 600 Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:54:31', NULL, NULL, NULL, NULL, NULL),
(474, '000474', 'Fanta 1.25 Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(475, '8901248428187', 'Fair & Handsome Face wash 50 GM', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:30:27', NULL, NULL, NULL, NULL, NULL),
(476, '000476', 'Fair & Handsome Face wash 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(477, '8901248459082', 'Fair & Handsome Cream for Men 15GM', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:31:09', NULL, NULL, NULL, NULL, NULL),
(478, '8901248459099', 'Fair & Handsome Cream for Men 30GM', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:31:37', NULL, NULL, NULL, NULL, NULL),
(479, '8901248253109', 'Fair & Handsome Cream for Men 30GM Indian', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:32:11', NULL, NULL, NULL, NULL, NULL),
(480, '8901248253116', 'Fair & Handsome Cream for Men 60 GM Indian', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:32:39', NULL, NULL, NULL, NULL, NULL),
(481, '8941102315109', 'Fair & Lovely Handsome Face Wash 50GM MEN', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:38:18', NULL, NULL, NULL, NULL, NULL),
(482, '000482', 'Fair & Lovely Handsome Face Wash 100GM MEN', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(483, '000483', 'Fair & Lovely Handsome Cream 15 GM MEN', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(484, '8941102311903', 'Fair & Lovely Handsome Cream 25 GM MEN', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:34:33', NULL, NULL, NULL, NULL, NULL),
(485, '8941102311910', 'Fair & Lovely Handsome Cream 50 GM MEN', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:34:51', NULL, NULL, NULL, NULL, NULL),
(486, '8941102311880', 'Fair & Lovely BB 18GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:49:43', NULL, NULL, NULL, NULL, NULL),
(487, '000487', 'Fair & Lovely BB 40GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(488, '000488', 'Fair & Lovely Body Milk 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(489, '000489', 'Fair & Lovely Body Milk 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(490, '000490', 'Fair & Lovely Cream 50GM MEN', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:34:15', NULL, NULL, NULL, NULL, NULL),
(491, '8941102311934', 'Fair & Lovely Face Wash 50GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:38:58', NULL, NULL, NULL, NULL, NULL),
(492, '8941102311767', 'Fair & Lovely Multi Vitamin 25 GM', NULL, '64', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:39:44', NULL, NULL, NULL, NULL, NULL),
(493, '8941102311743', 'Fair & Lovely Multi Vitamin 50GM', NULL, '125', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:47:39', NULL, NULL, NULL, NULL, NULL),
(494, '8901030821530', 'Fair & Lovely Multi Vitamin 80GM Indian', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-24 13:39:29', NULL, NULL, NULL, NULL, NULL),
(495, '000495', 'Fair & Lovely Multi Vitamin 100 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(496, '8941102311811', 'Fair & Lovely Winter Glow 25 GM', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:49:25', NULL, NULL, NULL, NULL, NULL),
(497, '8941102311804', 'Fair & Lovely Winter Glow 50GM', NULL, '125', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:40:49', NULL, NULL, NULL, NULL, NULL),
(498, '000498', 'Fair & Lovely Winter Glow 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(499, '000499', 'Fair & Lovely advanced multi Vitamin Body Lotion 100GM', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:51:17', NULL, NULL, NULL, NULL, NULL),
(500, '8941102311859', 'Fair & Lovely advanced multi Vitamin Body Lotion 200GM', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:51:39', NULL, NULL, NULL, NULL, NULL),
(501, '000501', 'Fast Wash 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(502, '000502', 'Fast Wash 500GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(503, '000503', 'Fire Box 20\'s', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:54:56', NULL, NULL, NULL, NULL, NULL),
(504, '000504', 'First Choice 240GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(505, '000505', 'FoGG Royal Body Spray', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(506, '8908001158305', 'FoGG Marco Body Spray', NULL, '295', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:58:24', NULL, NULL, NULL, NULL, NULL),
(507, '8904238301415', 'FoGG Master Agar Body Spray', NULL, '315', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 13:59:31', NULL, NULL, NULL, NULL, NULL),
(508, '000508', 'Food Colur 30GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(509, '000509', 'Fresh salt 500Gm', NULL, '17', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:02:32', NULL, NULL, NULL, NULL, NULL),
(510, '8941161102917', 'Fresh Salt 1Kg', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:02:54', NULL, NULL, NULL, NULL, NULL),
(511, '000511', 'Fresh Atta 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(512, '000512', 'Fresh Atta 2KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:56:59', NULL, NULL, NULL, NULL, NULL),
(513, '8941161008066', 'Fresh Facial Tissue ', NULL, '62', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:02:24', NULL, NULL, NULL, NULL, NULL),
(514, '8941161002460', 'Fresh Peper Napkin Tissue 100pcs', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:01:48', NULL, NULL, NULL, NULL, NULL),
(515, '000515', 'Fresh Toilet Tissue (white)', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:03:07', NULL, NULL, NULL, NULL, NULL),
(516, '8941161004914', 'Fresh Toilet Tissue (Gold)', NULL, '17', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:03:24', NULL, NULL, NULL, NULL, NULL),
(517, '000517', 'Fresh Pocket Tissue', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:01:54', NULL, NULL, NULL, NULL, NULL),
(518, '000518', 'Fresh Soyabean 500Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(519, '000519', 'Fresh Soyabean 1 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(520, '000520', 'Fresh Soyabean 2 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(521, '000521', 'Fresh Soyabean 3 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(522, '000522', 'Fresh Soyabean 5 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(523, '000523', 'Fresh Sugar 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(524, '8941161113029', 'Fresh Water 500ML', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:04:26', NULL, NULL, NULL, NULL, NULL),
(525, '8941161115047', 'Fresh Water 1 Lt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:04:58', NULL, NULL, NULL, NULL, NULL),
(526, '000526', 'Fresh Water 2 LT', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:03:35', NULL, NULL, NULL, NULL, NULL),
(527, '000527', 'Gul', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:14:57', NULL, NULL, NULL, NULL, NULL),
(528, '5055810007140', 'Galaxy Plus perfume spray', NULL, '280', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:05:43', NULL, NULL, NULL, NULL, NULL),
(529, '000529', 'Garnier Face Wash 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(530, '000530', 'Garnier Face Wash 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(531, '000531', 'Garnier White Complete Cream 18GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(532, '000532', 'Garnier White Complete Cream 40GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(533, '701197886667', 'Ghari Detergent 200Gm', NULL, '18', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:09:03', NULL, NULL, NULL, NULL, NULL),
(534, '701197886674', 'Ghari Detergent 500Gm', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:09:24', NULL, NULL, NULL, NULL, NULL),
(535, '701197886681', 'Ghari Detergent 1Kg', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:08:46', NULL, NULL, NULL, NULL, NULL),
(536, '745114584717', 'Ghari Detergent 2Kg', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:09:13', NULL, NULL, NULL, NULL, NULL),
(537, '4902430818803', 'Gillette Guard Matha', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-28 07:01:30', NULL, NULL, NULL, NULL, NULL),
(538, '000538', 'Gillette Blue II Razor', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:09:38', NULL, NULL, NULL, NULL, NULL),
(539, '4987176041081', 'Gillette Guard Razor', NULL, '38', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:08:27', NULL, NULL, NULL, NULL, NULL),
(540, '7702018001132', 'Gillette Saving Foam Sensitive skin 98GM', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:12:56', NULL, NULL, NULL, NULL, NULL),
(541, '4902430722155', 'Gillette Saving Foam Menthol 196GM', NULL, '272', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:12:03', NULL, NULL, NULL, NULL, NULL),
(542, '4987176030108', 'Gillette Saving Foam Regular 196GM', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:11:48', NULL, NULL, NULL, NULL, NULL),
(543, '4902430722131', 'Gillette Saving Foam Lemon Lime 196GM', NULL, '272', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:11:18', NULL, NULL, NULL, NULL, NULL),
(544, '000544', 'Gillette Saving Gel 196GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(545, '8906105100633', 'GlaxoseD 25GM patha', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:13:49', NULL, NULL, NULL, NULL, NULL),
(546, '8906105100657', 'GlaxoseD 200GM PB', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:14:14', NULL, NULL, NULL, NULL, NULL),
(547, '8906105100664', 'GlaxoseD 400GM PB', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:14:25', NULL, NULL, NULL, NULL, NULL),
(548, '000548', 'Gol Morich 1kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:13:32', NULL, NULL, NULL, NULL, NULL),
(549, '8901023016790', 'Good Night Fabric RoLl-On', NULL, '99', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:31:20', NULL, NULL, NULL, NULL, NULL),
(550, '8901157001136', 'Good Knight Power Active machine ', NULL, '149', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:16:45', NULL, NULL, NULL, NULL, NULL),
(551, '8901023011726', 'Good Knight Xpress system machine ', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:21:18', NULL, NULL, NULL, NULL, NULL),
(552, '000552', 'Good Knight Power Active Liquid', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(553, '8901023011719', 'Good Knight Xpress system Liquid', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:15:55', NULL, NULL, NULL, NULL, NULL),
(554, '8941193314067', 'Ispahani Green Tea ', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:46:40', NULL, NULL, NULL, NULL, NULL),
(555, '000555', 'GLue 20 taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 14:13:17', NULL, NULL, NULL, NULL, NULL),
(556, '8941194003717', 'Haque Chocolate Digestive biscuit', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:00:30', NULL, NULL, NULL, NULL, NULL),
(557, '8941194004547', 'Haque Toast Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:05:16', NULL, NULL, NULL, NULL, NULL),
(558, '8941194002888', 'Haque milk merry biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:01:28', NULL, NULL, NULL, NULL, NULL),
(559, '8941194002871', 'Haque Sor Malai Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:01:06', NULL, NULL, NULL, NULL, NULL),
(560, '000560', 'Haque Energy  Biscuit', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(561, '8941194002536', 'Haque Mr.Cookie Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:02:09', NULL, NULL, NULL, NULL, NULL),
(562, '8941194002628', 'Haque Sugar Free Biscuits ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:04:42', NULL, NULL, NULL, NULL, NULL),
(563, '8941194000020', 'Haque Chanachur Tok jal 125Gm', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:03:24', NULL, NULL, NULL, NULL, NULL),
(564, '000564', 'Haque Chanachur Tok jal 275Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(565, '8941194000112', 'Haque Jhal Chanachur 125Gm', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:03:57', NULL, NULL, NULL, NULL, NULL),
(566, '000566', 'Haque Jhal Chanachur 275Gm', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:04:23', NULL, NULL, NULL, NULL, NULL),
(567, '8941100282229', 'Harpic 200ml', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:06:59', NULL, NULL, NULL, NULL, NULL),
(568, '8941100282212', 'Harpic 500ML', NULL, '105', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:07:51', NULL, NULL, NULL, NULL, NULL),
(569, '8901396175025', 'Harpic 750ML', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:08:02', NULL, NULL, NULL, NULL, NULL),
(570, '8941111111006', 'Harpic Powder 200GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:08:22', NULL, NULL, NULL, NULL, NULL),
(571, '8941100282120', 'Harpic Powder 400GM', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:08:38', NULL, NULL, NULL, NULL, NULL),
(572, '000572', 'Highlighter mark pro', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:14:49', NULL, NULL, NULL, NULL, NULL),
(573, '8901138500467', 'Himalaya natural glow fairness Cream 50 GM', NULL, '185', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:20:29', NULL, NULL, NULL, NULL, NULL),
(574, '000574', 'Himalaya neem face wash 50 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(575, '8908008142000', 'Himalaya neem face wash 100 ML', NULL, '185', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:16:47', NULL, NULL, NULL, NULL, NULL),
(576, '8908008142024', 'Himalaya neem face wash 150 ML', NULL, '310', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:17:16', NULL, NULL, NULL, NULL, NULL),
(577, '8908008142048', 'Himalaya kesar face wash 100 ML', NULL, '190', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:18:42', NULL, NULL, NULL, NULL, NULL),
(578, '8908008142055', 'Himalaya kesar face wash 50 MLL', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:19:57', NULL, NULL, NULL, NULL, NULL),
(579, '8908008142062', 'Himalaya Aloe Vera face wash 100 ML', NULL, '190', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:18:19', NULL, NULL, NULL, NULL, NULL),
(580, '000580', 'Himalaya Aloe Vera face wash 150 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(581, '4902430774130', 'Head & Shoulders Anti-Hairfall 180ML', NULL, '249', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:14:32', NULL, NULL, NULL, NULL, NULL),
(582, '000582', 'Head & Shoulders\' 330ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(583, '000583', 'Head & Shoulders\' 480ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(584, '8901157025217', 'HIT 200ML Black', NULL, '275', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:25:17', NULL, NULL, NULL, NULL, NULL),
(585, '0005890115702520085', 'HIT 200ML Red', NULL, '290', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:25:33', NULL, NULL, NULL, NULL, NULL),
(586, '8906105100428', 'Horlick Mini Pack ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:25:54', NULL, NULL, NULL, NULL, NULL),
(587, '8906105100411', 'Horlicks Regular 250GM', NULL, '190', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:28:42', NULL, NULL, NULL, NULL, NULL),
(588, '8906105100398', 'Horlicks Regular 500GM', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:29:04', NULL, NULL, NULL, NULL, NULL),
(589, '8906105100442', 'Horlicks Junior 500Gm', NULL, '390', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:29:49', NULL, NULL, NULL, NULL, NULL),
(590, '8906105100527', 'Horlicks Chocolate  500GM', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:29:31', NULL, NULL, NULL, NULL, NULL),
(591, '8906105100459', 'Horlicks Lite 330Gm', NULL, '380', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:31:07', NULL, NULL, NULL, NULL, NULL),
(592, '000592', 'Horlick Women\'s Plus 500Gm', NULL, '480', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:26:05', NULL, NULL, NULL, NULL, NULL),
(593, '8906105100541', 'Horlicks Mothers Plus 350 Gm', NULL, '490', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:30:38', NULL, NULL, NULL, NULL, NULL),
(594, '831730009472', 'Pran Hot Tomato Sauce mini pack 10gm ', NULL, '3', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:38:17', NULL, NULL, NULL, NULL, NULL),
(595, '000595', 'Huggies 4-8KG (20 Pants)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(596, '000596', 'Huggies 7-12KG (38 Pants)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(597, '000597', 'Hulud Loss 1kg', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:33:13', NULL, NULL, NULL, NULL, NULL),
(598, '8941189308759', 'Ice cream loly Lemon 15 Taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:16:03', NULL, NULL, NULL, NULL, NULL),
(599, '8941189308766', 'Ice cream loly Orange l 15 Taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:16:58', NULL, NULL, NULL, NULL, NULL),
(600, '8941189302207', 'Ice Cream Milk malai 15 Taka', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:14:55', NULL, NULL, NULL, NULL, NULL),
(601, '8941189300036', 'ice Cream solankur 20 Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:00:06', NULL, NULL, NULL, NULL, NULL),
(602, '8941189302191', 'Ice Cream Chokbar 20Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:08:29', NULL, NULL, NULL, NULL, NULL),
(603, '8941189308773', 'Ice Cream Chokbar 25Taka', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:09:12', NULL, NULL, NULL, NULL, NULL),
(604, '8941189300104', 'Ice Cream Cup  Venial 20 Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:14:00', NULL, NULL, NULL, NULL, NULL),
(605, '000605', 'Ice Cream Cup  Mango 20 Taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:05:55', NULL, NULL, NULL, NULL, NULL),
(606, '000606', 'Ice Cream Mega ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(607, '000607', 'Ice Cream Machu ', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:15:06', NULL, NULL, NULL, NULL, NULL),
(608, '8941189308841', 'Ice cream cone vanilla 30 Taka', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:09:34', NULL, NULL, NULL, NULL, NULL),
(609, '8941189300234', 'Ice cream cone vanilla 50 Taka', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:10:18', NULL, NULL, NULL, NULL, NULL),
(610, '8941189300258', 'Ice cream cone Chocolates 55 Taka', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:09:22', NULL, NULL, NULL, NULL, NULL),
(611, '000611', 'Ice Cream container Vanilla 500Ml', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:05:50', NULL, NULL, NULL, NULL, NULL),
(612, '8941189300272', 'Ice Cream container Chocolates 500Ml', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:22:12', NULL, NULL, NULL, NULL, NULL),
(613, '8941189300296', 'Ice Cream container Mango  500Ml', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:04:15', NULL, NULL, NULL, NULL, NULL),
(614, '8941189300289', 'Ice Cream container strawberry 500Ml', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:05:35', NULL, NULL, NULL, NULL, NULL),
(615, '8941189300340', 'Ice Cream container Vanilla 1lt', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:25:12', NULL, NULL, NULL, NULL, NULL),
(616, '8941189300357', 'Ice Cream container Chocolates 1Lr', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:21:52', NULL, NULL, NULL, NULL, NULL),
(617, '8941189300371', 'Ice Cream container Mango 1Lt', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:22:56', NULL, NULL, NULL, NULL, NULL),
(618, '000618', 'Ice Cream container strawberry 1Lt', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:05:23', NULL, NULL, NULL, NULL, NULL),
(619, '8941189300487', 'Ice Cream Double Sunday Chocolate Cheers 1Lt', NULL, '280', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:09:42', NULL, NULL, NULL, NULL, NULL),
(620, '000620', 'Ice cream Kheer Malai 1Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(621, '000621', 'Ice Cream rasmalai 1Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(622, '000622', 'Ice Lolly 40ml (45pcX6jar)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(623, '000623', 'Ice Panda (45pcX6jar)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(624, '000624', 'Isobgul vhushi Loss 1kg', NULL, '1000', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:40:14', NULL, NULL, NULL, NULL, NULL),
(625, '000625', 'Isobgul Bhushi 45gm (144)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:00', NULL, NULL, NULL, NULL, NULL),
(626, '8941170034193', 'Sezezan Isobgul Vushi 45 GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 15:41:10', NULL, NULL, NULL, NULL, NULL),
(627, '8941193314500', 'Ispahani Mirzapore 15GM', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:04:02', NULL, NULL, NULL, NULL, NULL),
(628, '8941193314524', 'Ispahani Mirzapore 50GM', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 11:37:18', NULL, NULL, NULL, NULL, NULL),
(629, '8941193314531', 'Ispahani Mirzapore 100GM', NULL, '57', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:04:13', NULL, NULL, NULL, NULL, NULL),
(630, '8941193314548', 'Ispahani Mirzapore 200GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:04:39', NULL, NULL, NULL, NULL, NULL),
(631, '8941193314555', 'Ispahani Mirzapore 400GM', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:04:56', NULL, NULL, NULL, NULL, NULL),
(632, '8941193315088', 'Ispahani Mirzapore 500GM BOP', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:05:31', NULL, NULL, NULL, NULL, NULL),
(633, '8941193314036', 'Ispahani Tea Bag b', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:03:46', NULL, NULL, NULL, NULL, NULL),
(634, '000634', 'ISPI Tag mango mini pack', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:06:04', NULL, NULL, NULL, NULL, NULL),
(635, '8941100000722', 'ISPI Tag Orange mini pack', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:09:00', NULL, NULL, NULL, NULL, NULL),
(636, '8941193313138', 'ISPI Tag mango 125 ML', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:08:01', NULL, NULL, NULL, NULL, NULL),
(637, '000637', 'ISPI Tag Orange 125 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(638, '000638', 'IFAD Atta 1 kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(639, '000639', 'IFAD Atta 2 kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(640, '8941168013032', 'IFAD Toast biscuit ', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:53:11', NULL, NULL, NULL, NULL, NULL),
(641, '8941183001168', 'Jet detergent 200Gm', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:11:48', NULL, NULL, NULL, NULL, NULL),
(642, '8941183001151', 'Jet detergent 500Gm', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:12:07', NULL, NULL, NULL, NULL, NULL),
(643, '000643', 'Jhok Mok Dish Washing 100Gm', NULL, '12', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:39:20', NULL, NULL, NULL, NULL, NULL),
(644, '000644', 'Jhal Muri 5 taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:10:23', NULL, NULL, NULL, NULL, NULL),
(645, '000645', 'Jhal Muri 8 taka All', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:10:45', NULL, NULL, NULL, NULL, NULL),
(646, '000646', 'Jhal Muri 10 taka Al', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:10:01', NULL, NULL, NULL, NULL, NULL),
(647, '000647', 'Jems 5 taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:09:45', NULL, NULL, NULL, NULL, NULL),
(648, '000648', 'Jems 10 taka ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:09:58', NULL, NULL, NULL, NULL, NULL),
(649, '000649', 'Jems 30 taka', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:09:49', NULL, NULL, NULL, NULL, NULL),
(650, '000650', 'Jafran 1pc', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:38:51', NULL, NULL, NULL, NULL, NULL),
(651, '000651', 'Jatric 25GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(652, '000652', 'Jayfal 1PC', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(653, '000653', 'Jeera loss', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:53:38', NULL, NULL, NULL, NULL, NULL),
(654, '000654', 'Jelly 250g (36)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(655, '000655', 'Johnson Feeder Nipple ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(656, '000656', 'Johnson Feeder Nipple Box', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(657, '000657', 'Johnson Baby Soap 75GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(658, '000658', 'Johnson Baby Milk Cream 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(659, '000659', 'Johnson Baby Powder 50g ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(660, '000660', 'Johnson Baby Powder 100g ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(661, '000661', 'Johnson Baby Shampoo 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(662, '000662', 'Johnson Body Lotion 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(663, '000663', 'Johnson Baby Body Oil 100 Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(664, '000664', 'Johnson Baby Hair Oil 100 Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(665, '000665', 'Johnson Olive Body Oil 60ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(666, '000666', 'Johnson Olive Oil 100Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(667, '000667', 'Johnson Olive 150Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(668, '000668', 'Jorda Color 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(669, '8941100500484', 'Jui Coconut Oil 200ML', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:41:29', NULL, NULL, NULL, NULL, NULL),
(670, '8941100500507', 'Jui Coconut Oil 200ML TIN', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:42:03', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(671, '8941100500484', 'Jui Coconut Oil 350', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:43:32', NULL, NULL, NULL, NULL, NULL),
(672, '8941100500514', 'Jui Coconut Oil 350ML TIN', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 04:43:42', NULL, NULL, NULL, NULL, NULL),
(673, '000673', 'Junior Horlicks 400GM Jar', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(674, '000674', 'Junior Horlicks 400GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(675, '000675', 'Jibon Water 500Gm', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:14:53', NULL, NULL, NULL, NULL, NULL),
(676, '821463133100', 'Jibon Water 1 KG', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:12:38', NULL, NULL, NULL, NULL, NULL),
(677, '000677', 'Jibon Water 2 Kg', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 16:14:48', NULL, NULL, NULL, NULL, NULL),
(678, '000678', 'Kaju Badam ', NULL, '1000', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:55:30', NULL, NULL, NULL, NULL, NULL),
(679, '000679', 'Kat Badam', NULL, '800', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:55:39', NULL, NULL, NULL, NULL, NULL),
(680, '000680', 'Kalo Jeera 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(681, '000681', 'Kat Badam 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(682, '000682', 'Kewra Water 200ML', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:56:32', NULL, NULL, NULL, NULL, NULL),
(683, '000683', 'Kheshari Dal 1KG loss', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:56:47', NULL, NULL, NULL, NULL, NULL),
(684, '000684', 'Kismis ', NULL, '450', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:14:44', NULL, NULL, NULL, NULL, NULL),
(685, '8901058873412', 'Kitkat 25 taka', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:16:49', NULL, NULL, NULL, NULL, NULL),
(686, '8901058890297', 'Kitkat 30 taka ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:17:37', NULL, NULL, NULL, NULL, NULL),
(687, '8901058896411', 'Kitkat 60 taka', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:19:13', NULL, NULL, NULL, NULL, NULL),
(688, '000688', 'kitchen bar Dish Washing 100Gm', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(689, '000689', 'kitchen bar Dish Washing 300Gm', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:16:28', NULL, NULL, NULL, NULL, NULL),
(690, '8941124000984', 'Keya Laundry Soap', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 03:57:04', NULL, NULL, NULL, NULL, NULL),
(691, '745125555195', 'Keya Soap Lemon & Cocoa Butter 125 Ml box', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:03:59', NULL, NULL, NULL, NULL, NULL),
(692, '745125555188', 'Keya Soap Enriced With Vitamin E125 Ml Box', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:06:47', NULL, NULL, NULL, NULL, NULL),
(693, '8941170014935', 'Kolson Macaroni paib 200GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:21:54', NULL, NULL, NULL, NULL, NULL),
(694, '000694', 'Kolson Macaroni Paib 400', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:25:45', NULL, NULL, NULL, NULL, NULL),
(695, '8941170014935', 'Kolson Macaroni Samuk 200GM ', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:23:20', NULL, NULL, NULL, NULL, NULL),
(696, '8941170015222', 'Kolson Vermicelli 200GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:20:45', NULL, NULL, NULL, NULL, NULL),
(697, '571866149801', 'Kolson Lacca Semai ', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:21:00', NULL, NULL, NULL, NULL, NULL),
(698, '000698', 'Kool Saving Cream 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(699, '000699', 'Kool Saving Cream 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(700, '4791111106878', 'Kumarika Hair Fall Control 100ML', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:28:20', NULL, NULL, NULL, NULL, NULL),
(701, '4791111106885', 'Kumarika Hair Fall Control 200ML', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:28:40', NULL, NULL, NULL, NULL, NULL),
(702, '4791111106861', 'Kumarika Hair Fall Control 300ML', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:29:04', NULL, NULL, NULL, NULL, NULL),
(703, '4791111106892', 'Kumarika Hair Fall Control 400ML', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:29:18', NULL, NULL, NULL, NULL, NULL),
(704, '8941114000802', 'Kishwan Sweet Toast biscuit', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:15:33', NULL, NULL, NULL, NULL, NULL),
(705, '8941114006019', 'Kishwan Special Toast biscuit', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:16:01', NULL, NULL, NULL, NULL, NULL),
(706, '000706', 'Kishwan Regular Toast biscuit', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:01', NULL, NULL, NULL, NULL, NULL),
(707, '8941114006057', 'Kishwan Horlicks biscuit', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:15:10', NULL, NULL, NULL, NULL, NULL),
(708, '000708', '', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:14:11', NULL, NULL, NULL, NULL, NULL),
(709, '8941100294543', 'Lactogen-1 180GM', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:33:59', NULL, NULL, NULL, NULL, NULL),
(710, '8941100294550', 'Lactogen-1 350GM ', NULL, '500', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:34:10', NULL, NULL, NULL, NULL, NULL),
(711, '8941100294574', 'Lactogen-2 180GM', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:34:21', NULL, NULL, NULL, NULL, NULL),
(712, '8941100294581', 'Lactogen-2 350GM', NULL, '500', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:35:03', NULL, NULL, NULL, NULL, NULL),
(713, '8941100294604', 'Lactogen-3 180GM', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:34:44', NULL, NULL, NULL, NULL, NULL),
(714, '8941100294611', 'Lactogen-3 350GM', NULL, '500', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:35:00', NULL, NULL, NULL, NULL, NULL),
(715, '000715', 'Lactogen-4 350GM ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:35:08', NULL, NULL, NULL, NULL, NULL),
(716, '000716', 'Lascha Semai 200g (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(717, '846656011058', 'Pran Lacchi 100Ml', '', '12', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:46:10', NULL, NULL, NULL, NULL, NULL),
(718, '841165112449', 'Pran Lacchi 200Ml', '', '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:44:01', NULL, NULL, NULL, NULL, NULL),
(719, '000719', 'Lacchi 250Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:30:05', NULL, NULL, NULL, NULL, NULL),
(720, '000720', 'Lexus Biscuit 240GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(721, '8941147000268', 'Ligion Henna Pack hair Conditioner 30GM', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:52:53', NULL, NULL, NULL, NULL, NULL),
(722, '8941147000596', 'Ligion Henna Pack hair Conditioner 50GM', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:53:05', NULL, NULL, NULL, NULL, NULL),
(723, '8941147000251', 'Ligion Henna Powder Mehedi colour Brown ', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:54:09', NULL, NULL, NULL, NULL, NULL),
(724, '8941102313570', 'Lifebuoy Hand Wash Total 170Ml Refill', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:51:19', NULL, NULL, NULL, NULL, NULL),
(725, '000725', 'Lifebuoy Hand Wash Total 200ML Pump', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:51:04', NULL, NULL, NULL, NULL, NULL),
(726, '8941102312320', 'Lifebuoy Hand Wash Care 170mML Refill', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:30:13', NULL, NULL, NULL, NULL, NULL),
(727, '8941102310388', 'Lifebuoy Hand Wash Care 200mML Pump', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:30:39', NULL, NULL, NULL, NULL, NULL),
(728, '8941102312337', 'Lifebuoy Hand Wash Lemon 170 ML Refil', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:30:51', NULL, NULL, NULL, NULL, NULL),
(729, '8941100614099', 'Lifebuoy Hand Wash Lemon 200 Ml Pump', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:31:08', NULL, NULL, NULL, NULL, NULL),
(731, '8941102311569', 'Lifebuoy Hand Sinitizer 50Ml', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:29:58', NULL, NULL, NULL, NULL, NULL),
(732, '000732', 'Lifebuoy Neem & Aloe Vera 75GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(733, '8941100657775', 'Lifebuoy Total 100GM', NULL, '36', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:49:26', NULL, NULL, NULL, NULL, NULL),
(734, '8941100657935', 'Lifebuoy Total 150GM', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:50:35', NULL, NULL, NULL, NULL, NULL),
(735, '8941100657768', 'Lifebuoy Lemon Fresh 100GM', NULL, '36', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:55:28', NULL, NULL, NULL, NULL, NULL),
(736, '8941100658925', 'Lifebuoy Lemon Fresh 150GM', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:05:12', NULL, NULL, NULL, NULL, NULL),
(737, '8941100618332', 'Lifebuoy Care 100Gm', NULL, '36', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:55:04', NULL, NULL, NULL, NULL, NULL),
(738, '8941100656976', 'Lifebuoy Care 150Gm', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:55:16', NULL, NULL, NULL, NULL, NULL),
(739, '000739', 'Litchi Drinks 100ml (96)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(740, '000740', 'Litchi Drinks 170ml (72)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(741, '8941100289112', 'Lizol 500ML', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 05:51:46', NULL, NULL, NULL, NULL, NULL),
(742, '000742', 'Lollipop 3 Taka All', NULL, '3', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:36:04', NULL, NULL, NULL, NULL, NULL),
(743, '000743', 'Lolipop 5 ta All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:35:57', NULL, NULL, NULL, NULL, NULL),
(744, '000744', 'Lychee 2 Taka', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:49:47', NULL, NULL, NULL, NULL, NULL),
(745, '000745', 'Lychee 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:49:49', NULL, NULL, NULL, NULL, NULL),
(746, '000746', 'Lychee 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:49:40', NULL, NULL, NULL, NULL, NULL),
(747, '000747', 'Lobong 1kg', NULL, '1200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 04:36:12', NULL, NULL, NULL, NULL, NULL),
(748, '000748', 'Rashid Miniket Rice loss 1kg', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:51:05', NULL, NULL, NULL, NULL, NULL),
(749, '8941102310739', 'Lux Bar Mini rose 10 Taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:59:41', NULL, NULL, NULL, NULL, NULL),
(750, '8941102310630', 'Lux Bar Rose 75 GM', NULL, '26', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:54:18', NULL, NULL, NULL, NULL, NULL),
(751, '8941102310357', 'Lux Bar Rose 100GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:58:49', NULL, NULL, NULL, NULL, NULL),
(752, '8941102310654', 'Lux Bar Rose 150GM', NULL, '58', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:59:16', NULL, NULL, NULL, NULL, NULL),
(753, '000753', 'Lux Perfumed Bar 125GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(754, '841165127832', 'Mayonnaise 170Ml', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:00:33', NULL, NULL, NULL, NULL, NULL),
(755, '000755', 'Mozzarella Cheese 240Gm', NULL, '240', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:19:30', NULL, NULL, NULL, NULL, NULL),
(761, '8941100291344', 'Maggi Healthy Soup Chicken flavor 25GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:35:34', NULL, NULL, NULL, NULL, NULL),
(762, '8941100291351', 'Maggi Healthy Soup Thai flavor 25GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:34:57', NULL, NULL, NULL, NULL, NULL),
(763, '8941100294970', 'Maggi Masala 4GM', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:34:41', NULL, NULL, NULL, NULL, NULL),
(764, '8941100294987', 'Maggi fried rice masala 6Gm', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:37:31', NULL, NULL, NULL, NULL, NULL),
(765, '8941100294390', 'Maggi Noodles Single 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:34:25', NULL, NULL, NULL, NULL, NULL),
(766, '000766', 'Maggi Noodles Single 15 taka', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(767, '8941100295168', 'Maggi Noodles 12p', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:25:42', NULL, NULL, NULL, NULL, NULL),
(768, '8941100294420', 'Maggi Noodles 8p', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:32:34', NULL, NULL, NULL, NULL, NULL),
(769, '8941100294413', 'Maggi Noodles 4p', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:32:46', NULL, NULL, NULL, NULL, NULL),
(770, '8941100294901', 'Maggi Noodles Blast 4p', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 05:33:01', NULL, NULL, NULL, NULL, NULL),
(771, '8941100500033', 'Magic Tooth Powder 50GM', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:04:17', NULL, NULL, NULL, NULL, NULL),
(772, '8941100500132', 'Magic Tooth Powder 100GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:03:42', NULL, NULL, NULL, NULL, NULL),
(773, '8941181000057', 'Mama noodles Chicken flavour 4p', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:51:17', NULL, NULL, NULL, NULL, NULL),
(774, '8941181000132', 'Mama noodles Chicken flavour 8p', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:52:09', NULL, NULL, NULL, NULL, NULL),
(775, '000775', 'Mama noodles Chicken flavour 12p', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:51:38', NULL, NULL, NULL, NULL, NULL),
(776, '831730003258', 'Mango Bar 14gm ', NULL, '7', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:50:11', NULL, NULL, NULL, NULL, NULL),
(777, '000777', 'Mango Drinks 200ml (48)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(778, '000778', 'Marks Milk 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(779, '710535035094', 'Marks Milk 100GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:55:40', NULL, NULL, NULL, NULL, NULL),
(780, '000780', 'Marks Milk 200G', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(781, '710535035056', 'Marks Milk 500G', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:56:28', NULL, NULL, NULL, NULL, NULL),
(782, '710535035032', 'Marks Milk 1KG', NULL, '690', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 06:56:10', NULL, NULL, NULL, NULL, NULL),
(783, '8906105100565', 'Maltova 400 GM', NULL, '330', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:06:30', NULL, NULL, NULL, NULL, NULL),
(784, '000784', 'Maltova 200 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(785, '000785', 'Mess 1 Taka', NULL, '1', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:06:54', NULL, NULL, NULL, NULL, NULL),
(786, '000786', 'Mess 2 taka', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:07:20', NULL, NULL, NULL, NULL, NULL),
(787, '859875003025', 'Mediplus Normal 40 ML', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:04:57', NULL, NULL, NULL, NULL, NULL),
(788, '859875003018', 'Mediplus Normal 70 ML', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:05:17', NULL, NULL, NULL, NULL, NULL),
(789, '859875003001', 'Mediplus Normal 140 ML', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:05:29', NULL, NULL, NULL, NULL, NULL),
(790, '859875003056', 'Mediplus DS 40 GM', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-28 07:01:30', NULL, NULL, NULL, NULL, NULL),
(791, '859875003049', 'Mediplus DS 90GM', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:04:24', NULL, NULL, NULL, NULL, NULL),
(792, '859875003032', 'Mediplus DS 140GM', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:04:35', NULL, NULL, NULL, NULL, NULL),
(793, '000793', 'Meril Baby Gel Toothpaste 45GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(794, '8941100500231', 'Meril Baby Lotion 100ML', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:33:57', NULL, NULL, NULL, NULL, NULL),
(795, '000795', 'Meril Baby Lotion 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(796, '000796', 'Meril Baby Olive Oil 150ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(797, '000797', 'Meril Baby Powder 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(798, '000798', 'Meril Baby Shampoo 110ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(799, '000799', 'Meril Baby Toothbrush', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(800, '8941100500910', 'Meril Glycerine 120GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:30:44', NULL, NULL, NULL, NULL, NULL),
(801, '8941100500903', 'Meril Glycerine 60GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:30:08', NULL, NULL, NULL, NULL, NULL),
(802, '8941100500422', 'Meril Lipgel 10GM', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:29:41', NULL, NULL, NULL, NULL, NULL),
(803, '8941100500866', 'Meril Petroleum Jelly 15 GM', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:29:15', NULL, NULL, NULL, NULL, NULL),
(804, '8941100501009', 'Meril chapstick Strawberry', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:32:46', NULL, NULL, NULL, NULL, NULL),
(805, '8941100501047', 'Meril Nail Polish Remover 40ML', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:19:46', NULL, NULL, NULL, NULL, NULL),
(806, '8941100500880', 'Meril Petroleum Jelly 100ML', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:21:06', NULL, NULL, NULL, NULL, NULL),
(807, '8941100500873', 'Meril Petroleum Jelly 50ML', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:21:42', NULL, NULL, NULL, NULL, NULL),
(808, '8941100502068', 'Meril Milk Soap bar 150GM', NULL, '52', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:08:59', NULL, NULL, NULL, NULL, NULL),
(809, '8941100501917', 'Meril beli extract Soap bar 150GM', NULL, '52', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 07:09:42', NULL, NULL, NULL, NULL, NULL),
(810, '000810', 'Methi 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(811, '8941159001017', 'Milk Vita Milk 200Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:22:14', NULL, NULL, NULL, NULL, NULL),
(812, '710535868593', 'Milk Vita Milk 500Ml', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:22:39', NULL, NULL, NULL, NULL, NULL),
(813, '8941159001048', 'Milk Vita Milk 1Lt', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:21:58', NULL, NULL, NULL, NULL, NULL),
(814, '710535868340', 'Milk Vita Sour yogurt 500Gm', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-27 08:42:35', NULL, NULL, NULL, NULL, NULL),
(815, '000815', 'Millat Prickly Heat Powder', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:09:17', NULL, NULL, NULL, NULL, NULL),
(816, '000816', 'Milk Mama 15g (30pcX6jar)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(817, '000817', 'Milk Marie Biscuit 285GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:02', NULL, NULL, NULL, NULL, NULL),
(818, '000818', 'Milk Powder (Loose)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(819, '8941100314463', 'Mirinda 1L ', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:11:16', NULL, NULL, NULL, NULL, NULL),
(820, '8941100314449', 'Mirinda 600Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:11:06', NULL, NULL, NULL, NULL, NULL),
(821, '000821', 'Mirinda 250Ml', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:11:30', NULL, NULL, NULL, NULL, NULL),
(822, '000822', 'Mix Fruit Jam 440gm (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(823, '000823', 'Motor Vaja 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:15:25', NULL, NULL, NULL, NULL, NULL),
(824, '000824', 'Moida (Loose) 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(825, '000825', 'Moida loss', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(826, '000826', 'Moshur Dal (Deshi) 1 KG', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:14:31', NULL, NULL, NULL, NULL, NULL),
(827, '000827', 'Moshur Dal (Indian) 1 KG', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:14:36', NULL, NULL, NULL, NULL, NULL),
(828, '000828', 'Moshur Dal (Kangaro) 1 KG', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:14:41', NULL, NULL, NULL, NULL, NULL),
(829, '000829', 'Mother Horlicks 350GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:15:20', NULL, NULL, NULL, NULL, NULL),
(830, '000830', 'Motor Dal', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(831, '000831', 'Mountain Dew 200 ML', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:19:07', NULL, NULL, NULL, NULL, NULL),
(832, '8941100315415', 'Mountain Dew  250 ML', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:19:18', NULL, NULL, NULL, NULL, NULL),
(833, '8941100315446', 'Mountain Dew  600 ML', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:19:25', NULL, NULL, NULL, NULL, NULL),
(834, '8941100315460', 'Mountain Dew 1 Lt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:19:02', NULL, NULL, NULL, NULL, NULL),
(835, '000835', 'Mojo 250 Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:13:58', NULL, NULL, NULL, NULL, NULL),
(836, '000836', 'Mojo 500Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(837, '000837', 'Mojo 1 Lt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:13:49', NULL, NULL, NULL, NULL, NULL),
(838, '8941189600082', 'Mojo 2 Lt', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:14:26', NULL, NULL, NULL, NULL, NULL),
(839, '8941100284018', 'Mr. Brasso 350ML', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:20:00', NULL, NULL, NULL, NULL, NULL),
(840, '000840', 'Mr. Brasso Refil 350ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(841, '841165122745', 'Mr. Noodles singles 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:29:59', NULL, NULL, NULL, NULL, NULL),
(842, '846656017746', 'Mr. Noodles 12p', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:28:42', NULL, NULL, NULL, NULL, NULL),
(843, '846656003411', 'Mr. Noodles 8p', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:28:32', NULL, NULL, NULL, NULL, NULL),
(844, '841165134700', 'Mr. Noodles 4p', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:28:17', NULL, NULL, NULL, NULL, NULL),
(845, '841165118335', 'Mr. Cup Noodles ', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:28:12', NULL, NULL, NULL, NULL, NULL),
(846, '000846', 'Mr. Cup beef Noodles', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:20:03', NULL, NULL, NULL, NULL, NULL),
(847, '8941149791072', 'Mr.White powder 500Gm', NULL, '68', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-28 07:00:33', NULL, NULL, NULL, NULL, NULL),
(848, '000848', 'Mr.White powder 1Kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(849, '880196268619', 'Mum water 500Gm', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:47:52', NULL, NULL, NULL, NULL, NULL),
(850, '880196268671', 'Mum water 1Lt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:47:42', NULL, NULL, NULL, NULL, NULL),
(851, '880196268664', 'Mum water 2L', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:47:36', NULL, NULL, NULL, NULL, NULL),
(852, '841165104420', 'Muffin Cake ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:46:01', NULL, NULL, NULL, NULL, NULL),
(853, '000853', 'Mug Dal (Shonamukhi)', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:34:39', NULL, NULL, NULL, NULL, NULL),
(854, '000854', 'Mug Dal ', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-24 12:52:11', NULL, NULL, NULL, NULL, NULL),
(855, '000855', 'Muri (Chikon) loss', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 75, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-02-24 13:15:57', NULL, NULL, NULL, NULL, NULL),
(856, '000856', 'Muri 250g (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(857, '000857', 'Mustard Oil 500ML', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:36:20', NULL, NULL, NULL, NULL, NULL),
(858, '000858', 'Mustard Oil 1kg', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:48:39', NULL, NULL, NULL, NULL, NULL),
(859, '000859', 'Murich Gura Loss', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:36:03', NULL, NULL, NULL, NULL, NULL),
(860, '8941161100012', 'No.1 condensed milk ', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:52:15', NULL, NULL, NULL, NULL, NULL),
(861, '8941161104614', 'No.1 Tea Patha BOP', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:52:22', NULL, NULL, NULL, NULL, NULL),
(862, '000862', 'NAN 4 350GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(863, '000863', 'NAN Optipro-1 400GM Tin', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(864, '000864', 'Navratna Oil Mini Pack', NULL, '3', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:50:31', NULL, NULL, NULL, NULL, NULL),
(865, '8901248104029', 'Navratna Oil 50Ml', NULL, '68', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:50:28', NULL, NULL, NULL, NULL, NULL),
(866, '8901248104036', 'Navratna Oil 100Ml', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:50:20', NULL, NULL, NULL, NULL, NULL),
(867, '8901248104043', 'Navratna Oil 200Ml', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:50:15', NULL, NULL, NULL, NULL, NULL),
(868, '8901248104050', 'Navratna Oil 400Ml', NULL, '399', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:50:10', NULL, NULL, NULL, NULL, NULL),
(869, '000869', 'Nazir Rice (5k)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(870, '000870', 'Nazirshail 10kg (4)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(871, '000871', 'Nazirshail 25kg (4)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(872, '000872', 'Nazirshail 5kg (8)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(873, '000873', 'Neem Hand Wash 200ML Refil', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(874, '8936069871393', 'Noble Cafe Instant Coffee', NULL, '26', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:54:09', NULL, NULL, NULL, NULL, NULL),
(875, '8941100295311', 'Nestle MiLo 3in1', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:23:16', NULL, NULL, NULL, NULL, NULL),
(876, '8941100293317', 'Nescafe Original 3in1 mini pack', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:19:57', NULL, NULL, NULL, NULL, NULL),
(877, '8941100295182', 'Nescafe creamy latte mini pack', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:20:15', NULL, NULL, NULL, NULL, NULL),
(878, '000878', 'Nescafe Classics Mini Coffee 1.5 Gm ', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:20:26', NULL, NULL, NULL, NULL, NULL),
(879, '8901058841138', 'Nescafe Classics Coffee 50 GM', NULL, '165', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:22:34', NULL, NULL, NULL, NULL, NULL),
(880, '8901058841114', 'Nescafe Classics Coffee 100 GM', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:22:10', NULL, NULL, NULL, NULL, NULL),
(881, '000881', 'NIDO (3+) 350GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(882, '000882', 'Nido 1+ 350GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(883, '000883', 'Nivea Men 50ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(884, '000884', 'Nivea Men Body Spray 150ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(885, '8941194005919', 'NicNac Chocolates ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-24 05:23:33', NULL, NULL, NULL, NULL, NULL),
(886, '000886', 'Nocila 135GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(887, '000887', 'Nocila 200GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(888, '000888', 'Nocilla Chocolet 135gm (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(889, '000889', 'Nocilla Chocolet 190gm (12)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(890, '000890', 'Nocilla Chocolet 200gm (12)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(891, '000891', 'Nocilla Chocolet 250gm (12)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(892, '000892', 'Nocilla Chocolet 320gm (12)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(893, '000893', 'Nosila 200GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(894, '000894', 'Nutty Biscuit 250GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(895, '000895', 'ORSaline', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:57:40', NULL, NULL, NULL, NULL, NULL),
(896, '000896', 'Olive Oil 100Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(897, '000897', 'Olive Oil 150Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(898, '000898', 'Olive Oil 200Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(899, '000899', 'Olive Oil 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(900, '000900', 'Odonil Air Freshener ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(901, '745114130532', 'Olympic Soft Cake', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:55:41', NULL, NULL, NULL, NULL, NULL),
(902, '000902', 'Olympic Dry Cake Mini', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 79, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:00:55', NULL, NULL, NULL, NULL, NULL),
(903, '745114130778', 'Olympic Dry Cake 145 GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:00:21', NULL, NULL, NULL, NULL, NULL),
(904, '745114130761', 'Olympic Dry Cake 350GM', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:00:40', NULL, NULL, NULL, NULL, NULL),
(905, '745114130617', 'Olympic Tost Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:56:53', NULL, NULL, NULL, NULL, NULL),
(906, '745114130471', ' ', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:01:03', NULL, NULL, NULL, NULL, NULL),
(907, '745114130723', 'Olympic Nutty Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:54:56', NULL, NULL, NULL, NULL, NULL),
(908, '745114130631', 'Olympic Tip Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:56:01', NULL, NULL, NULL, NULL, NULL),
(909, '745114130341', 'Olympic Biscotti Biscuit', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:54:32', NULL, NULL, NULL, NULL, NULL),
(910, '745114130037', 'Olympic Lexus Biscuit', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:01:29', NULL, NULL, NULL, NULL, NULL),
(911, '8941194002888', 'Olympic merry Gold', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 06:55:24', NULL, NULL, NULL, NULL, NULL),
(912, '000912', 'Onion Deshi 1 KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(913, '000913', 'Onion Indian 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(914, '000914', 'Oral -B Cavity Defensek$$$,m$$$$$', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(915, '000915', 'Oral -B Gum Protect Tooth Brush', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(916, '000916', 'Oral -B Pro Classic Tooth Brush', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(917, '000917', 'Oral -B Pro Health Tooth Brush', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(918, '000918', 'Orange Biscuit (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(919, '000919', 'Orange Drinks 170ml (72)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(920, '000920', 'Orion Chinigura 1kg (40)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(921, '000921', 'Pantene Anti Dandruff 480ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(922, '000922', 'Pantene Anti Dandruff Coditioner 750ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(923, '000923', 'Pantene Anti Dandruff Coditioner 75ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(924, '000924', 'Pantene Anti Dandruff Shampoo 170ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(925, '000925', 'Pantene Anti Dandruff Shampoo 340ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(926, '000926', 'Pantene Hair Fall 170ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:03', NULL, NULL, NULL, NULL, NULL),
(927, '000927', 'Pantene Hair Fall Control Shampoo 340ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(928, '000928', 'Pantene Total Damame Care 340ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(929, '000929', 'Parachute Coconut Oil 340 Ml', NULL, '225', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:16:03', NULL, NULL, NULL, NULL, NULL),
(930, '000930', 'Parachute Coconut Oil 45 Ml', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:15:16', NULL, NULL, NULL, NULL, NULL),
(931, '000931', 'Parachute Coconut Oil 100 Ml', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:15:40', NULL, NULL, NULL, NULL, NULL),
(932, '000932', 'Parachute Coconut Oil 230Ml', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:15:50', NULL, NULL, NULL, NULL, NULL),
(933, '000933', 'Parachute Coconut Oil 575Ml', NULL, '305', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:16:14', NULL, NULL, NULL, NULL, NULL),
(934, '000934', 'Parachute Extra Care Oil 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:25:35', NULL, NULL, NULL, NULL, NULL),
(935, '8946000001628', 'Parachute Extra Care Oil 150ML', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:20:09', NULL, NULL, NULL, NULL, NULL),
(936, '8946000001635', 'Parachute Extra Care Oil 300ML', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:19:43', NULL, NULL, NULL, NULL, NULL),
(937, '8944000557060', 'Parachute Beliful Oil 100ML', NULL, '105', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:05:17', NULL, NULL, NULL, NULL, NULL),
(938, '000938', 'Parachute Beliful Oil 200ML', NULL, '145', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:23:13', NULL, NULL, NULL, NULL, NULL),
(939, '000939', 'Parachute Beliful Oil 300ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:20:51', NULL, NULL, NULL, NULL, NULL),
(940, '000940', 'Parachute Beliful Oil 400ML', NULL, '270', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:20:44', NULL, NULL, NULL, NULL, NULL),
(941, '000941', 'Parachute Aloe Vera Oil 150ML', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:00:29', NULL, NULL, NULL, NULL, NULL),
(942, '000942', 'Parachute Aloe Vera Oil 250ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:00:43', NULL, NULL, NULL, NULL, NULL),
(943, '8944000554632', 'Parachute Naturale Nourishing Care Shampoo 340 Ml', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:27:33', NULL, NULL, NULL, NULL, NULL),
(944, '8944000554625', 'Parachute Naturale Nourishing Care Shampoo 170Ml', NULL, '185', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:55:21', NULL, NULL, NULL, NULL, NULL),
(945, '000945', '', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:06:41', NULL, NULL, NULL, NULL, NULL),
(946, '000946', '', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:06:47', NULL, NULL, NULL, NULL, NULL),
(947, '8944000554106', 'Parachute Natural White Fair & Glowing Skin lotion 200GM', NULL, '190', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:58:19', NULL, NULL, NULL, NULL, NULL),
(948, '8944000554045', 'Parachute Natural Moisture Soft & Glowing Skin lotion 200GM', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:59:48', NULL, NULL, NULL, NULL, NULL),
(949, '8946000001550', 'Parachute Baby Lotion 100ML', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:01:50', NULL, NULL, NULL, NULL, NULL),
(950, '8946000001208', 'Parachute Baby Lotion 200ML', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 07:02:21', NULL, NULL, NULL, NULL, NULL),
(951, '000951', 'Parachute Baby Oil 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(952, '000952', 'Parachute Baby Wash 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(953, '000953', 'Peanut baza', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(954, '000954', 'Pen 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:07:38', NULL, NULL, NULL, NULL, NULL),
(955, '000955', 'Pen 6 taka', NULL, '6', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:07:41', NULL, NULL, NULL, NULL, NULL),
(956, '000956', 'Pen 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:07:36', NULL, NULL, NULL, NULL, NULL),
(957, '000957', 'Pencil 5 taka', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:07:47', NULL, NULL, NULL, NULL, NULL),
(958, '000958', 'Pencil 8 taka', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:08:14', NULL, NULL, NULL, NULL, NULL),
(959, '000959', 'Pencil 10 taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:07:44', NULL, NULL, NULL, NULL, NULL),
(960, '000960', 'Pepsi 200Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:09:14', NULL, NULL, NULL, NULL, NULL),
(961, '8941100311417', 'Pepsi 250ML', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:09:18', NULL, NULL, NULL, NULL, NULL),
(962, '000962', 'Pepsi 400Ml', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:08:57', NULL, NULL, NULL, NULL, NULL),
(963, '8941100311448', 'Pepsi 600Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:11:16', NULL, NULL, NULL, NULL, NULL),
(964, '8941100311462', 'Pepsi 1Lt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:09:10', NULL, NULL, NULL, NULL, NULL),
(965, '000965', 'Pepsi 2 Lt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:08:44', NULL, NULL, NULL, NULL, NULL),
(966, '000966', 'Pepsodent Germi Check Mini Patha', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:13:31', NULL, NULL, NULL, NULL, NULL),
(967, '8941102313877', 'Pepsodent Germi Check 45 GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:13:22', NULL, NULL, NULL, NULL, NULL),
(968, '8941102313860', 'Pepsodent Germi Check+ 100GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:12:34', NULL, NULL, NULL, NULL, NULL),
(969, '8941102314348', 'Pepsodent Germi Check 200GM', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:12:59', NULL, NULL, NULL, NULL, NULL),
(970, '000970', 'Pepsodent Sensitive Expert 40GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(971, '8941100658307', 'Pepsodent Sensitive Expert 80GM', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:14:34', NULL, NULL, NULL, NULL, NULL),
(972, '8941100658277', 'Pepsodent Sensitive Expert 140GM', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:15:12', NULL, NULL, NULL, NULL, NULL),
(973, '8941100619735', 'Pepsodent Tooth Powder 50GM', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:10:34', NULL, NULL, NULL, NULL, NULL),
(974, '8941102310265', 'Pepsodent Tooth Powder 100GM', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:15:29', NULL, NULL, NULL, NULL, NULL),
(975, '000975', 'Pesta Badam 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(976, '000976', 'Pocha Soap ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 82, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:15:36', NULL, NULL, NULL, NULL, NULL),
(977, '8941100656020', 'Pond\'s Body Lotion 100ML', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:16:22', NULL, NULL, NULL, NULL, NULL),
(978, '8941100619612', 'Pond\'s Body Lotion 200ML', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:16:44', NULL, NULL, NULL, NULL, NULL),
(979, '000979', 'Pond\'s Cold Cream 28GM', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:16:51', NULL, NULL, NULL, NULL, NULL),
(980, '8941102314843', 'Pond\'s Cold Cream 50GM', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:17:32', NULL, NULL, NULL, NULL, NULL),
(981, '000981', 'Pond\'s Talcum Powder 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(982, '000982', 'Pond\'s White Beauty Cream 25GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(983, '8941100610695', 'Pond\'s White Beauty Cream 35GM', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:18:20', NULL, NULL, NULL, NULL, NULL),
(984, '000984', 'Pond\'s White Beauty Cream 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(985, '8941100655450', 'Pond\'s White Beauty Face Wash 100GM', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:19:06', NULL, NULL, NULL, NULL, NULL),
(986, '8941100655443', 'Pond\'s White Beauty Face Wash 50GM', NULL, '99', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:19:18', NULL, NULL, NULL, NULL, NULL),
(987, '000987', 'Ponds\' Face Wash 100GM MEN', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(988, '8941100658772', 'Pond\'s Pure White facial Foam 100 Ml', NULL, '190', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-30 08:22:42', NULL, NULL, NULL, NULL, NULL),
(989, '000989', 'Pond\'s Nourishing Facial Scrub 100 Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(990, '000990', 'Postodana 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(991, '000991', 'Potata Biscuit 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(992, '000992', 'Potato 1 KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 84, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(993, '831730000233', 'Pran Mango Fruit Drinks 200Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:37:01', NULL, NULL, NULL, NULL, NULL),
(994, '000994', 'Pran Junior Fruit Drinks 125 Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(995, '846656010945', 'Pran Frooto 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:19:28', NULL, NULL, NULL, NULL, NULL),
(996, '000996', 'Pran Frooto 500Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(997, '000997', 'Pran Frooto 1Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(998, '000998', 'Pran Matha 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(999, '831730002534', 'Pran Jelly Apple flavour 200 GM', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:31:22', NULL, NULL, NULL, NULL, NULL),
(1000, '831730002466', 'Pran Jelly Orange  flavour 200 GM', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:34:30', NULL, NULL, NULL, NULL, NULL),
(1001, '831730002473', 'Pran jelly Orange flavour 350 GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:35:46', NULL, NULL, NULL, NULL, NULL),
(1002, '831730002695', 'Pran jelly mixed fruit 375 GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:34:52', NULL, NULL, NULL, NULL, NULL),
(1003, '001003', 'Pran jelly Orange flavour 375 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1004, '831730002589', 'Pran jelly Mango flavour 375 GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:31:40', NULL, NULL, NULL, NULL, NULL),
(1005, '001005', 'Pran Holud Gura 15Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1006, '831730004996', 'Pran Holud Gura 50 Gm', NULL, '28', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:25:10', NULL, NULL, NULL, NULL, NULL),
(1007, '001007', 'Pran Holud Gura 100 Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1008, '001008', 'Pran Holud Gura 200Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1009, '831730005511', 'Pran Holud Gura 200Jar', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:26:30', NULL, NULL, NULL, NULL, NULL),
(1010, '001010', 'Pran Maric  Gura 15Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1011, '001011', 'Pran Maric  Gura 50Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1012, '001012', 'Pran Maric  Gura 100Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1013, '001013', 'Pran Maric  Gura 200Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1014, '831730005504', 'Pran Maric  Gura 200Gm Jhar', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:27:49', NULL, NULL, NULL, NULL, NULL),
(1015, '001015', 'Pran Biriani Mix 40GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1016, '001016', 'Pran Chatpati Masala 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1017, '831730005719', 'Pran Cheera 500GM', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:12:03', NULL, NULL, NULL, NULL, NULL),
(1018, '831730004149', 'Pran Chinigura 1KG', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2022-01-12 10:13:36', NULL, NULL, NULL, NULL, NULL),
(1019, '001019', 'Pran Chola Boot 1 KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1020, '001020', 'Pran Firni Mix 150GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1021, '001021', 'Pran Garam Masala 40GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1022, '831730007355', 'Pran Ghee 100 GM', NULL, '165', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:21:55', NULL, NULL, NULL, NULL, NULL),
(1023, '831730007423', 'Pran Ghee 200GM', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:22:34', NULL, NULL, NULL, NULL, NULL),
(1024, '001024', 'Pran Ghee 400GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1025, '001025', 'Pran Ghee 900GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1026, '001026', 'Pran Halim Mix 200 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1027, '001027', 'Pran Kashundi 300GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1028, '001028', 'Pran Kewra Water 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1029, '001029', 'Pran Meat Masala 100GM PB', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1030, '841165107223', 'Pran Mustard Oil 1L', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:38:35', NULL, NULL, NULL, NULL, NULL),
(1031, '001031', 'Pran Mustard Oil 250ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1032, '001032', 'Pran Mustard Oil 2L', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1033, '831730005450', 'Pran Mustard Oil 500ML', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:39:21', NULL, NULL, NULL, NULL, NULL),
(1034, '001034', 'Pran Orang Jelly 375GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1035, '001035', 'Pran Panchforan 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1036, '846656003961', 'Pran Roast Masala 35GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:38:03', NULL, NULL, NULL, NULL, NULL),
(1037, '001037', 'Pran Tasting Salt 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1038, '001038', 'Pran Tasting Salt 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:04', NULL, NULL, NULL, NULL, NULL),
(1039, '831730006907', 'Pran Toast 350GM', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:47:02', NULL, NULL, NULL, NULL, NULL),
(1040, '846656005088', 'Pran Hot Tomato Sauce 250Gm', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:24:04', NULL, NULL, NULL, NULL, NULL),
(1041, '846656006405', 'Pran Hot Tomato Sauce 550Gm', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:23:47', NULL, NULL, NULL, NULL, NULL),
(1042, '001042', 'Pran Hot Tomato Sauce 750Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1043, '846656006603', 'Pran Hot Tomato Sauce 1Kg', NULL, '195', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:22:57', NULL, NULL, NULL, NULL, NULL),
(1044, '831730002268', 'Pran Hot Tomato Sauce Glass 340', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:30:15', NULL, NULL, NULL, NULL, NULL),
(1045, '841165107537', 'Pran Soya Sauce 285Ml', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:40:10', NULL, NULL, NULL, NULL, NULL),
(1046, '001046', 'Pran Vinegar 330ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1047, '001047', 'Pran Vinegar 650ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1048, '8025765174003', 'Prince Olive Hot Pickle 400 GM', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:55:59', NULL, NULL, NULL, NULL, NULL),
(1049, '8025765114009', 'Prince Mango Hot Pickle 400 GM', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:55:49', NULL, NULL, NULL, NULL, NULL),
(1050, '8025765215003', 'Prince Soya Sauce 500Ml', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:56:40', NULL, NULL, NULL, NULL, NULL),
(1051, '8857650324008', 'Prince Vinegar Sm', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:57:07', NULL, NULL, NULL, NULL, NULL),
(1052, '8857650326002', 'Prince Vinegar Big', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:00:38', NULL, NULL, NULL, NULL, NULL),
(1053, '001053', 'Prince Chinese Egg Noodles', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1054, '8025654042000', 'Prince Laccha Semai ', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 10:54:18', NULL, NULL, NULL, NULL, NULL),
(1055, '001055', 'Prince vermicelli Semai', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1056, '001056', 'Pusti Soyabeen Oil Polypace 1Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1057, '001057', 'Pusti Soyabeen Oil 500Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1058, '001058', 'Pusti Soyabeen Oil 1 Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1059, '001059', 'Pusti Soyabeen Oil 2Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1060, '001060', 'Pusti Soyabeen Oil 3 Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1061, '001061', 'Pusti Soyabeen Oil 5 Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1062, '001062', 'Richcafe mini', NULL, '4', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:17:14', NULL, NULL, NULL, NULL, NULL),
(1063, '001063', 'Richcafe 3in1', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:15:46', NULL, NULL, NULL, NULL, NULL),
(1064, '8941100511374', 'Radhuni Biriani Masala 40Gm', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '60', '0', NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:00:47', NULL, NULL, NULL, NULL, NULL),
(1065, '8941100511381', 'Radhuni Haydaravad Biriyani Masala 45Gm', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:18:36', NULL, NULL, NULL, NULL, NULL),
(1066, '8941100511206', 'Radhuni Roast Masala 35GM', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:00:36', NULL, NULL, NULL, NULL, NULL),
(1067, '8941100511398', 'Radhuni Kacchi Biriyani masala 40Gm', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:00:59', NULL, NULL, NULL, NULL, NULL),
(1068, '8941100511060', 'Radhuni Kabab Masala 50GM', NULL, '90', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:28:37', NULL, NULL, NULL, NULL, NULL),
(1069, '8941100511442', 'Radhuni Kurma Masala 30GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:28:08', NULL, NULL, NULL, NULL, NULL),
(1070, '8941100511893', 'Rahhuni Jhali Kabab Masala 50Gm', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:02:26', NULL, NULL, NULL, NULL, NULL),
(1071, '8941100511411', 'Radhuni Chicken Tandoori 50GM', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:10:25', NULL, NULL, NULL, NULL, NULL),
(1072, '8941100511404', 'Radhuni Tehary Masala 40GM', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:37:21', NULL, NULL, NULL, NULL, NULL),
(1073, '8941100511053', 'Radhuni Chopoti Masala 50GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:12:13', NULL, NULL, NULL, NULL, NULL),
(1074, '8941100511084', 'Radhuni Borhani Masala 50Gm', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:05:47', NULL, NULL, NULL, NULL, NULL),
(1075, '8941100511787', 'Radhuni Khicuri Mix 500GM', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:30:32', NULL, NULL, NULL, NULL, NULL),
(1076, '001076', 'Radhuni Faluda Mix 250GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1077, '001077', 'Radhuni Firni Mix 150GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1078, '8941100511725', 'Radhuni Halim Mix 200GM', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:18:08', NULL, NULL, NULL, NULL, NULL),
(1079, '8941100511886', 'Radhuni khir Mix 150GM', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:31:01', NULL, NULL, NULL, NULL, NULL),
(1080, '8941100511145', 'Radhuni Meat Masala 100GM', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:25:12', NULL, NULL, NULL, NULL, NULL),
(1081, '8941100511282', 'Radhuni Chicken Masala 100GM', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:06:15', NULL, NULL, NULL, NULL, NULL),
(1082, '8941100511428', 'Radhuni Kala buna Masala 80Gm', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:03:02', NULL, NULL, NULL, NULL, NULL),
(1083, '001083', 'Radhuni beaf Masala 100Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1084, '8941100511435', 'Radhuni Mejbani Beaf Masala 68GM', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:32:54', NULL, NULL, NULL, NULL, NULL),
(1085, '001085', 'Radhuni Mustard Oil 1 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1086, '8941100512647', 'Radhuni Mustard Oil 250ML', NULL, '72', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:42:56', NULL, NULL, NULL, NULL, NULL),
(1087, '001087', 'Radhuni Mustard Oil 500ML', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:43:07', NULL, NULL, NULL, NULL, NULL),
(1088, '8941100512630', 'Radhuni Mustard Oil 80ML', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:48:48', NULL, NULL, NULL, NULL, NULL),
(1089, '8941100511947', 'Radhuni White Vinegar 280ML', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:02:31', NULL, NULL, NULL, NULL, NULL),
(1090, '001090', 'Radhuni White Vinegar 540ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1091, '8941100510087', 'Radhuni Murich Gura 25Gm', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:23:54', NULL, NULL, NULL, NULL, NULL),
(1092, '8941100510094', 'Radhuni Murich Gura 50Gm', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:24:12', NULL, NULL, NULL, NULL, NULL),
(1093, '8941100510100', 'Radhuni Murich Gura 100Gm', NULL, '53', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:23:32', NULL, NULL, NULL, NULL, NULL),
(1094, '8941100510117', 'Radhuni Murich Gura 200Gm', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:23:20', NULL, NULL, NULL, NULL, NULL),
(1095, '8941100510834', 'Radhuni Hodul Gura 25 Gm', NULL, '14', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:19:12', NULL, NULL, NULL, NULL, NULL),
(1096, '8941100510018', 'Radhuni Hodul Gura 50 Gm', NULL, '28', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:19:46', NULL, NULL, NULL, NULL, NULL),
(1097, '8941100510025', 'Radhuni Hodul Gura 100Gm', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:22:08', NULL, NULL, NULL, NULL, NULL),
(1098, '8941100510032', 'Radhuni Hodul Gura 200 Gm', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:23:08', NULL, NULL, NULL, NULL, NULL),
(1099, '8941100510247', 'Radhuni Jhira Gura 15 Gm', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:20:19', NULL, NULL, NULL, NULL, NULL),
(1100, '8941100510254', 'Radhuni Jhira Gura 50Gm', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:21:21', NULL, NULL, NULL, NULL, NULL),
(1101, '8941100510261', 'Radhuni Jhira Gura 100Gm', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:22:19', NULL, NULL, NULL, NULL, NULL),
(1102, '8941100510285', 'Radhuni Jhira Gura 200 Gm', NULL, '155', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:22:48', NULL, NULL, NULL, NULL, NULL),
(1103, '8941100510162', 'Radhuni Dania Gura 15 Gm', NULL, '6', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:12:45', NULL, NULL, NULL, NULL, NULL),
(1104, '8941100510179', 'Radhuni Dania Gura 50 Gm', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:13:36', NULL, NULL, NULL, NULL, NULL),
(1105, '8941100510186', 'Radhuni Dania Gura 100 Gm', NULL, '33', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:13:44', NULL, NULL, NULL, NULL, NULL),
(1106, '8941100510193', 'Radhuni Dania Gura 200 Gm', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:14:20', NULL, NULL, NULL, NULL, NULL),
(1107, '8941100510995', 'Radhuni Paspurun Asto 50Gm', NULL, '22', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:49:45', NULL, NULL, NULL, NULL, NULL),
(1108, '8941100510988', 'Radhuni Paspurun Gura 50Gm', NULL, '22', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:56:12', NULL, NULL, NULL, NULL, NULL),
(1109, '8941100511015', 'Radhuni Gorom Masala 15 Gm', NULL, '26', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:17:01', NULL, NULL, NULL, NULL, NULL),
(1110, '8941100511022', 'Radhuni Gorom Masala 40 Gm', NULL, '68', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:17:22', NULL, NULL, NULL, NULL, NULL),
(1111, '8941100511305', 'Radhuni chicken masala 20m', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:08:05', NULL, NULL, NULL, NULL, NULL),
(1112, '8941100511138', 'Radhuni Meat masala 20m', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:24:31', NULL, NULL, NULL, NULL, NULL),
(1113, '8941100511305', 'Radhuni Beaf masala 25Gm', NULL, '18', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:04:21', NULL, NULL, NULL, NULL, NULL),
(1114, '8941100511169', 'Radhuni Fish masala 20m', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 11:16:22', NULL, NULL, NULL, NULL, NULL),
(1115, '001115', 'Rashid Bashmoti 25KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(1116, '001116', 'Rashid Chinigura 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1117, '001117', 'Rashid Miniket 20KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1118, '001118', 'Rashid Nazirshail 25KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-26 06:22:52', NULL, NULL, NULL, NULL, NULL),
(1119, '8941100500002', 'Revive Perfect Skin Powder 100GM', NULL, '45', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:14:34', NULL, NULL, NULL, NULL, NULL),
(1120, '8941100500019', 'Revive Perfect Skin Powder 200GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:11:26', NULL, NULL, NULL, NULL, NULL),
(1121, '8941100501429', 'Revive Shampoo 100Ml', NULL, '75', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:11:46', NULL, NULL, NULL, NULL, NULL),
(1122, '8941100501436', 'Revive Shampoo 200Ml', NULL, '175', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:12:14', NULL, NULL, NULL, NULL, NULL),
(1123, '001123', 'Rexona MEN 25ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1124, '001124', 'Rexona MEN 50ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1125, '001125', 'Rexona Powder Dry 25ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1126, '001126', 'Rexona Powder Dry 50ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1127, '8941102310197', 'Rin Powder 200Gm', NULL, '28', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:18:03', NULL, NULL, NULL, NULL, NULL),
(1128, '8941102314249', 'Rin Powder 500Gm', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:18:36', NULL, NULL, NULL, NULL, NULL),
(1129, '8941102314256', 'Rin Powder 1Kg', NULL, '125', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:18:30', NULL, NULL, NULL, NULL, NULL),
(1130, '8941102314263', 'Rin Power 2KG', NULL, '265', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:18:47', NULL, NULL, NULL, NULL, NULL),
(1131, '001131', 'Rose Water 180ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1132, '001132', 'Romania Lexus Biscuit', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1133, '001133', 'Romania Choco chip Biscuit', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-12 12:21:25', NULL, NULL, NULL, NULL, NULL),
(1134, '8941100513194', 'Ruchi Bar-B-Q Chanachur 150GM', NULL, '43', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:00:36', NULL, NULL, NULL, NULL, NULL),
(1135, '8941100513217', 'Ruchi Bar-B-Q Chanachur 300GM', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:47:01', NULL, NULL, NULL, NULL, NULL),
(1136, '001136', 'Ruchi Bar-B-Q Chanachur 500GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1137, '8941100513163', 'Ruchi Hot Chanachur 150Gm', NULL, '43', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:47:14', NULL, NULL, NULL, NULL, NULL),
(1138, '8941100513224', 'Ruchi Hot Chanachur 300Gm', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:50:02', NULL, NULL, NULL, NULL, NULL),
(1139, '001139', 'Ruchi Hot Chanachur 500Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1140, '8941100514337', 'Ruchi Red Chili Sauce', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:52:51', NULL, NULL, NULL, NULL, NULL),
(1141, '001141', 'Ruchi Totato Ketchup 350GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:05', NULL, NULL, NULL, NULL, NULL),
(1142, '8941100514948', 'Ruchi Alubukhara Pickle', NULL, '135', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:45:25', NULL, NULL, NULL, NULL, NULL),
(1143, '001143', 'Ruh-Afja 300ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1144, '001144', 'Ruh-Afja 750ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1145, '001145', 'Rupchanda Bashmoti 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1146, '880225150014', 'Rupchanda Chinigura 1KG', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:54:44', NULL, NULL, NULL, NULL, NULL),
(1147, '001147', 'Rupchanda Miniket 25kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1148, '001148', 'Rupchanda Mustard Oil 100ml (48)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1149, '001149', 'Rupchanda Mustard Oil 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1150, '001150', 'Rupchanda Mustard Oil 500ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1151, '001151', 'Rupchanda Nazirshail 5KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1152, '001152', 'Rupchanda Soyabean 500Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1153, '8941052011045', 'Rupchanda Soyabean 1LTR', NULL, '158', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:55:05', NULL, NULL, NULL, NULL, NULL),
(1154, '001154', 'Rupchanda Soyabean 1LTR Poly', NULL, '152', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:55:09', NULL, NULL, NULL, NULL, NULL),
(1155, '8941052011052', 'Rupchanda Soyabean 2 LTR', NULL, '318', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:51:11', NULL, NULL, NULL, NULL, NULL),
(1156, '001156', 'Rupchanda Soyabean 3 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1157, '8941052011083', 'Rupchanda Soyabean 5 LTR', NULL, '760', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:56:52', NULL, NULL, NULL, NULL, NULL),
(1158, '001158', 'Rupchanda Soyabean 8 LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1159, '001159', 'Sago Dana 500GM', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:54:07', NULL, NULL, NULL, NULL, NULL),
(1160, '001160', 'Sajeeb Soya Sauce 150ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1161, '001161', 'Sajeeb Soya Sauce 215ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1162, '001162', 'Sajeeb Soya Sauce 300ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1163, '8941170014621', 'Sajeeb Stick Noodles 180 GM', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:57:38', NULL, NULL, NULL, NULL, NULL),
(1164, '001164', 'Saki Toothbrush', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1165, '001165', 'Salcoti Cookies Biscuit 240GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1166, '001166', 'Sandalina @ Rose Soap 75Ml', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:06:18', NULL, NULL, NULL, NULL, NULL),
(1167, '8513690101251', 'Sandalina Moisturiser Soap 75Ml', NULL, '27', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:58:20', NULL, NULL, NULL, NULL, NULL),
(1168, '8513692165329', 'Sandalina Moisturiser Soap 100 Ml', NULL, '36', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:58:50', NULL, NULL, NULL, NULL, NULL),
(1169, '8513692165404', 'Sandalina Moisturiser Soap 125Ml', NULL, '44', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 06:59:20', NULL, NULL, NULL, NULL, NULL),
(1170, '001170', 'Sanora Sanitary Napkin-Belt System', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1171, '8139003002383', 'Savlon Antiseptic Cream 30GM', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:18:26', NULL, NULL, NULL, NULL, NULL),
(1172, '813903000264', 'Savlon Antiseptic Cream 60GM', NULL, '34', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:18:55', NULL, NULL, NULL, NULL, NULL),
(1173, '8139003002390', 'Savlon Antiseptic Cream 100GM', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:18:06', NULL, NULL, NULL, NULL, NULL),
(1174, '001174', 'Savlon Antiseptic Disinfectant 56 ML', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:21:04', NULL, NULL, NULL, NULL, NULL),
(1175, '001175', 'Savlon Antiseptic Disinfectant 112 ML', NULL, '44', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 91, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:20:59', NULL, NULL, NULL, NULL, NULL),
(1176, '001176', 'Savlon Hand Sanitizer 50 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1177, '8941196242183', 'Savlon Ocean blue Hand Wash 200ML Refil', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:30:10', NULL, NULL, NULL, NULL, NULL),
(1178, '8139003004851', 'Savlon Ocean blue Hand Wash 250ML pum', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:10:11', NULL, NULL, NULL, NULL, NULL),
(1179, '001179', 'Savlon Liquid 1000ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1180, '813903000301', 'Savlon Liquid 500Ml', NULL, '125', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:12:00', NULL, NULL, NULL, NULL, NULL),
(1181, '8941196243258', 'Savlon Fresh Soap Mini 10 Taka', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:08:23', NULL, NULL, NULL, NULL, NULL),
(1182, '8941196243012', 'Savlon Men Soap 100GM', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:17:23', NULL, NULL, NULL, NULL, NULL),
(1183, '8941196243128', 'Savlon Fresh Soap 75 GM', NULL, '42', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:10:14', NULL, NULL, NULL, NULL, NULL),
(1184, '8941196243135', 'Savlon Fresh Soap 100 GM', NULL, '48', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 07:11:00', NULL, NULL, NULL, NULL, NULL),
(1185, '001185', 'Saya Sauce 150ml (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1186, '001186', 'Saya Sauce 215ml (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1187, '001187', 'Saya Souce 300ml (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1188, '001188', 'School Drinks 125ml (80)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1189, '710535035322', 'Seylon Tea Bag', NULL, '85', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:20:42', NULL, NULL, NULL, NULL, NULL),
(1190, '001190', 'Select Plus Shampoo 75ML', NULL, '175', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:19:02', NULL, NULL, NULL, NULL, NULL),
(1191, '001191', 'Senora Confidence', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1192, '001192', 'Senora Economy Pack-Belt System', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1193, '001193', 'Senora Economy Pack-Panty System', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1194, '001194', 'Senora Regular Pack-Belt System', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1195, '001195', 'Senora Regular Pack-Panty System', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1196, '001196', 'Sensodyne Deep Clean TP 70GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1197, '8901571004089', 'Sensodyne Fresh Gel TP 40 GM', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:21:56', NULL, NULL, NULL, NULL, NULL),
(1198, '8901571004614', 'Sensodyne Fresh Gel TP 75 GM', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:22:22', NULL, NULL, NULL, NULL, NULL),
(1199, '8901571004102', 'Sensodyne Fresh Mint TP 40GM', NULL, '95', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:23:50', NULL, NULL, NULL, NULL, NULL),
(1200, '8901571004096', 'Sensodyne Fresh Mint TP 75GM', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:23:06', NULL, NULL, NULL, NULL, NULL),
(1201, '001201', 'Sensodyne Fresh Mint TP 150GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1202, '8901571004829', 'Sensodyne Rapid Relief TP 40GM', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:24:03', NULL, NULL, NULL, NULL, NULL),
(1203, '8901571004836', 'Sensodyne Rapid Relief TP 80GM', NULL, '280', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:26:00', NULL, NULL, NULL, NULL, NULL),
(1204, '8901571009091', 'Sensodyne Daily care Brush orginal', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:27:57', NULL, NULL, NULL, NULL, NULL),
(1205, '001205', 'Sensodyne Ultra Soft TB 1P', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1206, '001206', 'Sepnil Hand Sanitizer 100 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1207, '8941196246518', 'Septex Everyday Antiseptic Bar 100GM', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:28:49', NULL, NULL, NULL, NULL, NULL),
(1208, '001208', 'Septex Floor Cleaner 1LTR', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1209, '001209', 'Shahi Jeera 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1210, '001210', 'Shakti Toilet Cleaner 500ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1211, '001211', 'Soda 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1212, '001212', 'Shampoo 1 Taka All', NULL, '1', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:34', NULL, NULL, NULL, NULL, NULL),
(1213, '001213', 'Shampoo 2 Taka All', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:36', NULL, NULL, NULL, NULL, NULL),
(1214, '001214', 'Shampoo 3 Taka All', NULL, '3', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:37', NULL, NULL, NULL, NULL, NULL),
(1215, '001215', 'Shampoo 4 Taka All', NULL, '4', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:40', NULL, NULL, NULL, NULL, NULL),
(1216, '001216', 'Shampoo 5 Taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:44', NULL, NULL, NULL, NULL, NULL),
(1217, '001217', 'Sharp Regure ', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:37:10', NULL, NULL, NULL, NULL, NULL),
(1218, '001218', 'Sharpener 5 Taka All', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:59', NULL, NULL, NULL, NULL, NULL),
(1219, '001219', 'Sharpener 8 Taka All', NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:37:03', NULL, NULL, NULL, NULL, NULL),
(1220, '001220', 'Sharpener 10 Taka All', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:36:57', NULL, NULL, NULL, NULL, NULL),
(1221, '001221', 'Shezan Mango Fruit Drinks 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:38:43', NULL, NULL, NULL, NULL, NULL),
(1222, '8941170030157', 'Shezan Mango Fruit Drinks 200Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:39:04', NULL, NULL, NULL, NULL, NULL),
(1223, '001223', 'Shezan Junior Fruit Drinks 125 Ml', NULL, '13', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:37:08', NULL, NULL, NULL, NULL, NULL),
(1224, '001224', 'Scale plastic 20 taka', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1225, '001225', 'Softy Cake (72)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1226, '001226', 'Soyabean loss', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:37:57', NULL, NULL, NULL, NULL, NULL),
(1227, '001227', 'Special Toast (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1228, '8025765263004', 'Prince Chicken & Egg Noodles', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 10:01:27', NULL, NULL, NULL, NULL, NULL),
(1229, '8944000554311', 'Studio X Styling Shampoo 355Ml', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:48:37', NULL, NULL, NULL, NULL, NULL),
(1230, '8944000554342', 'Studio X Face Wash 50 ML', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:46:10', NULL, NULL, NULL, NULL, NULL),
(1231, '8944000554335', 'Studio X Face Wash 100 ML', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:45:26', NULL, NULL, NULL, NULL, NULL),
(1232, '8944000554953', 'Studio X Brightening Cream 30 ML', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:44:56', NULL, NULL, NULL, NULL, NULL),
(1233, '8944000554960', 'Studio X Brightening Cream 60 ML', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:45:47', NULL, NULL, NULL, NULL, NULL),
(1234, '001234', 'Sugar (Loose) 1KG', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:46:16', NULL, NULL, NULL, NULL, NULL),
(1235, '001235', 'Sonali red sugar 1Kg', NULL, '105', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:47:34', NULL, NULL, NULL, NULL, NULL),
(1236, '001236', 'Suji 500gm ', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:48:57', NULL, NULL, NULL, NULL, NULL),
(1237, '001237', 'Sunsilk  Coconut  Aloe Vera Shampoo 90Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:01:24', NULL, NULL, NULL, NULL, NULL),
(1238, '001238', 'Sunsilk Coconut Aloe Vera Shampoo 195 Ml', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:01:36', NULL, NULL, NULL, NULL, NULL),
(1239, '8941100613955', 'Sunsilk Coconut  Aloe Vera Shampoo 375Ml', NULL, '335', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:00:23', NULL, NULL, NULL, NULL, NULL),
(1240, '001240', 'Sunsilk Hijab Almond & Honey 90ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1241, '8941100657140', 'Sunsilk Hijab Almond & Honey 180ML', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:14:12', NULL, NULL, NULL, NULL, NULL),
(1242, '001242', 'Sunsilk Hijab Almond & Honey 375ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:06', NULL, NULL, NULL, NULL, NULL),
(1243, '8941102311378', 'Sunsilk Black Shine 90ML', NULL, '85', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:03:35', NULL, NULL, NULL, NULL, NULL),
(1244, '001244', 'Sunsilk Black Shine 180ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1245, '8941102314126', 'Sunsilk Black Shine 350ML', NULL, '330', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:06:07', NULL, NULL, NULL, NULL, NULL),
(1246, '001246', 'Sunsilk Hijab Fig & Mint 90ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1247, '8941100657126', 'Sunsilk Hijab Fig & Mint 180ML', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:20:15', NULL, NULL, NULL, NULL, NULL),
(1248, '001248', 'Sunsilk Hair Fall Solution 90ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1249, '001249', 'Sunsilk Hair Fall Solution 190ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1250, '8941100659601', 'Sunsilk Hair Fall Solution 375 ML', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:08:34', NULL, NULL, NULL, NULL, NULL),
(1251, '001251', 'Sunsilk Thick & Long 90ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1252, '8941100659915', 'Sunsilk Thick & Long 180ML', NULL, '185', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:07:30', NULL, NULL, NULL, NULL, NULL),
(1253, '8941100659618', 'Sunsilk Thick & Long 375ML', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:07:19', NULL, NULL, NULL, NULL, NULL),
(1254, '001254', 'Sunsilk Long & Healthy 90Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1255, '001255', 'Sunsilk Long & Healthy 180Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1256, '001256', 'Sunsilk Long & Healthy 375Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1257, '8941100652244', 'Sunsilk Perfect Straight Conditioners 80Ml', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:10:36', NULL, NULL, NULL, NULL, NULL),
(1258, '8941100501788', 'Supermom Baby Diaper 12-17KG', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:39:09', NULL, NULL, NULL, NULL, NULL),
(1259, '8941100501498', 'Supermom Baby Diaper 6-11KG', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:36:24', NULL, NULL, NULL, NULL, NULL),
(1260, '001260', 'Supermom Baby Diaper 8KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1261, '8941100501511', 'Supermom Baby Diaper 9-14KG', NULL, '115', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-01-16 08:35:04', NULL, NULL, NULL, NULL, NULL),
(1262, '001262', 'Suppar Glue ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1263, '001263', 'Supper Glue Aika', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1264, '8941102313143', 'Surf Excel 20 Gm', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 11:27:38', NULL, NULL, NULL, NULL, NULL),
(1265, '8941102313150', 'Surf Excel 50 Gm', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 11:27:15', NULL, NULL, NULL, NULL, NULL),
(1266, '001266', 'Surf Excel 200 Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:00:33', NULL, NULL, NULL, NULL, NULL),
(1267, '001267', 'Surf Excel 1Kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1268, ' 8941189600266', 'Speed 250Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:39:54', NULL, NULL, NULL, NULL, NULL),
(1269, '8941189600273', 'Speed Can 250Ml', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:40:03', NULL, NULL, NULL, NULL, NULL),
(1270, '001270', 'Sprite 200ML', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:41:54', NULL, NULL, NULL, NULL, NULL),
(1271, ' 8907525040110', 'Sprite 250Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:40:20', NULL, NULL, NULL, NULL, NULL),
(1272, '001272', 'Sprite 400ML', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:41:58', NULL, NULL, NULL, NULL, NULL),
(1273, '8907525040165', 'Sprite 600ML', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:40:35', NULL, NULL, NULL, NULL, NULL),
(1274, '8907525040196', 'Sprite 1.25Lt', NULL, '65', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:41:38', NULL, NULL, NULL, NULL, NULL),
(1275, '8907525040233', 'Sprite 2.25 Lt', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:41:48', NULL, NULL, NULL, NULL, NULL),
(1276, ' 710535035384', 'StarShips Chocolates Milk Drinks 200Ml', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:42:31', NULL, NULL, NULL, NULL, NULL),
(1277, '001277', 'StarShips Chocolates Milk Drinks 125 Ml', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 05:46:43', NULL, NULL, NULL, NULL, NULL),
(1278, '8941190500050', 'Akiz Toast 500GM', NULL, '160', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 11:28:52', NULL, NULL, NULL, NULL, NULL),
(1279, '001279', 'Tang 1.5kg Mango (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1280, '001280', 'Tang 1.5kg Orange (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1281, '001281', 'Tang 125gm Orange (48)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1282, '001282', 'Tang 2.5kg Mango (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1283, '001283', 'Tang 2.5kg Orange (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1284, '001284', 'Tang 250gm Orange (36)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1285, '001285', 'Tang 500gm Mango (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1286, '001286', 'Tang 500gm Orange (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1287, '001287', 'Tang 750gm Mango (15)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1288, '001288', 'Tang 750gm Orange (15)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1289, '001289', 'Tang Mango 1.5 KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1290, '001290', 'Tang Mango 2.5KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1291, '001291', 'Tang Mango 500GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1292, '001292', 'Tang Mango 750GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1293, '001293', 'Tang Mini Pack', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1294, '001294', 'Tang Orang 250GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1295, '001295', 'Tang Orang 500GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1296, '001296', 'Tang Orange 1.5KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1297, '001297', 'Tang Orange 125GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1298, '001298', 'Tang Orange 2.5KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1299, '001299', 'Tang Orange 750GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1300, '001300', 'Taste Me Tang  Orange Mini pack', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1301, '001301', 'Taste Me Tang  Mango Mini pack', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 11:30:57', NULL, NULL, NULL, NULL, NULL),
(1302, '001302', 'Taste Me Tang  Orange 100 Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1303, '001303', 'Taste Me Tang  Orange 200gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1304, '001304', 'Taste Me Tang  Mango 100g', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1305, '001305', 'Taste Me Tang  mango 200 gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1306, '001306', 'Tasting Salt 20g (360)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1307, '001307', 'Tasting Salt 454g (50)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1308, '001308', 'Tasting Salt 50gm (288)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1309, '001309', 'Tazza Tea patha 50 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1310, '001310', 'Tazza Tea patha 100 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1311, '001311', 'Tazza Tea patha 200 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1312, '001312', 'Tazza Tea patha 400 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1313, '001313', 'Teer Muri 500Gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1314, '001314', 'Teer Sugar 1kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1315, '001315', 'Teer Chinigura 1KG Rice ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1316, '001316', 'Teer Atta 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1317, '001317', 'Teer Atta 2kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1318, '001318', 'Teer Moida 1KG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1319, '001319', 'Teer Moida 2kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1320, '001320', 'Teer Brown Atta 1 kg', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1321, '001321', 'Teer Brown Atta 2kG', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1322, '001322', 'Teer suji 500gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1323, '001323', 'Teer Soyabean 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 94, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1324, '001324', 'Teer Soyabean 500Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1325, '001325', 'Teer Soyabean 1Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1326, '001326', 'Teer Soyabean 2Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1327, '001327', 'Teer Soyabean 3Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1328, '001328', 'Teer Soyabean 5Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1329, '001329', 'Teer Soyabean Polypack 1 Lt', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1330, '001330', 'Teer Mustard Oil 100gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1331, '001331', 'Teer Mustard Oil 250 gm', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1332, '001332', 'Tezpata 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1333, '001333', 'Tiger 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1334, '001334', 'Tiger Can 250Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1335, '001335', 'Tibbet 570 130GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(1336, '001336', 'Tibbet Ball 130GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1337, '001337', 'Tibbet Ice Cool Prickly Heat Powder 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1338, '001338', 'Tibbet Prickly Heat Powder 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1339, '001339', 'Tibbet Luxury Talcum Powder 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1340, '001340', 'Tibbet Luxury Talcum Powder 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 95, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1341, '001341', 'Tibet Snow 50GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1342, '001342', 'Tibet Snow 50GM tube ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1343, '001343', 'Tiffin Orange (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1344, '001344', 'Tiffin Strawberry (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:07', NULL, NULL, NULL, NULL, NULL),
(1345, '001345', 'Tip Biscuit 255GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1346, '001346', 'Tip Biscuit 70GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1347, '001347', 'Toast 350g (6)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1348, '001348', 'Tomato Ketchup 1kg (9)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1349, '001349', 'Tomato Ketchup 1L (9)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1350, '001350', 'Tomato Ketchup 340gm (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1351, '001351', 'Tomato Sauce 340gm (24)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1352, '8901030700743', 'Tresemme Hair Fall Defense Conditioner 190ML', NULL, '280', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:59:34', NULL, NULL, NULL, NULL, NULL),
(1353, '8941100657355', 'Tresemme Keratin Smooth 580ML', NULL, '690', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:59:34', NULL, NULL, NULL, NULL, NULL),
(1354, '001354', 'Tresemme Nourish & Replenish 190ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1355, '001355', 'Tresemme Nourish & Replenish 580ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1356, '001356', 'Ujala Nill 50Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1357, '001357', 'Ujala Nill 100Ml', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1358, '8859362502439', 'YC Men Extra Whitering Face Wash 100ML', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:33:44', NULL, NULL, NULL, NULL, NULL),
(1359, '8859362502422', 'YC Men Oil Control Face Wash 100ML', NULL, '230', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:34:05', NULL, NULL, NULL, NULL, NULL),
(1360, '8857101125703', 'YC Whitening Face Wash Milk Extract 100 ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:34:53', NULL, NULL, NULL, NULL, NULL),
(1361, '001361', 'YC Whitening Face Wash Cucumber Extract 100 ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:39:53', NULL, NULL, NULL, NULL, NULL),
(1362, '8859362505393', 'YC Whitening Face Wash Aloe vera 100 ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:35:13', NULL, NULL, NULL, NULL, NULL),
(1363, '8857101150651', 'YC Whitening Face Wash Neem Extract  100 ML', NULL, '210', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-24 06:39:08', NULL, NULL, NULL, NULL, NULL),
(1364, '001364', 'Vanilla Flavour 30GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1365, '001365', 'Vaseline Intensive Care Deep Restore Lotion 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1366, '001366', 'Vaseline Intensive Care Deep Restore Lotion 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1367, '001367', 'Vaseline Intensive Care Deep Restore Lotion 300ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1368, '001368', 'Vaseline Healthy Daily Brightening 100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1369, '001369', 'Vaseline Healthy Daily Brightening 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1370, '001370', 'Vaseline Healthy Daily Brightening 3000ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1371, '001371', 'Vaseline Intensive Care Aloe fresh  100ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1372, '001372', 'Vaseline Intensive Care Aleo fresh Lotion 200ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1373, '001373', 'Vaseline Intensive Care Aloe freshLotion 300ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1374, '8941102311682', 'Vaseline Petrolium Jelly 09 ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1375, '8941102311675', 'Vaseline Petrolium Jelly 50 ML', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1376, '001376', 'Vaseline Petrolium Jelly 100 ML Indian', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1377, '89003350', 'Vatika Hair Oil 150ML', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1378, '745125887197', 'Vatika Hair Oil 300ML', NULL, '260', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1379, '001379', 'Veet Sm', NULL, '', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1380, '8901396321606', 'Veet Big 50gm', NULL, '175', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1381, '001381', 'Vermichilli Semai (48)', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1382, '001382', 'Vim Bar 100GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1383, '8941102314287', 'Vim Bar 125GM', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1384, '8941100619452', 'Vim Bar 300GM', NULL, '32', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2022-02-28 07:01:08', NULL, NULL, NULL, NULL, NULL),
(1385, '001385', 'Vim Liquid 1000ML', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1386, '8941100618059', 'Vim Liquid 500ML', NULL, '110', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1387, '8941100618073', 'Vim Liquid Refil 250ML', NULL, '55', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1388, '8941102313204', 'Vim Liquid Refil 100Ml', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1389, '001389', 'Vim Powder 200 GM', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1390, '8941100619421', 'Vim Powder 500 GM', NULL, '35', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1391, '001391', 'Way fun 5 taka All ', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1392, '745114131058', 'Wayfun ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1393, '745114130013', 'knock wayfun', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1394, '8941102314447', 'Wheel Laundry Soap 125GM', NULL, '22', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1395, '8941100657478', 'Wheel Powder 200GM', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1396, '8941100657188', 'Wheel Powder 500Gm', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2022-02-28 07:01:30', NULL, NULL, NULL, NULL, NULL),
(1397, '8941100657171', 'Wheel Powder 1Kg', NULL, '95', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1398, '8941102314928', 'Wheel Powder 2 Kg', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1399, '001399', 'Zarda Color LOSS ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-24 06:41:48', NULL, NULL, NULL, NULL, NULL),
(1400, '001400', '3star Chocolates ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-21 18:57:08', NULL, NULL, NULL, NULL, NULL),
(1401, '001401', '5 Star Chocolates ', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2022-02-28 07:01:05', NULL, NULL, NULL, NULL, NULL),
(1402, '89006658', 'Cigarette Marlboro Advance ', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-24 05:11:59', NULL, NULL, NULL, NULL, NULL),
(1403, '50219728', 'Cigarette B&G ', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2022-02-28 07:01:35', NULL, NULL, NULL, NULL, NULL),
(1404, '50219056', 'Cigarette GL ', NULL, '11', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1405, '', 'Cigarette Lucky ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1406, '50393657', 'Cigarette star ', NULL, '7', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-24 05:18:23', NULL, NULL, NULL, NULL, NULL),
(1407, '18217766', 'Cigarette Navy', NULL, '7', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1408, '50228492', 'Cigarette Royals', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2022-02-28 07:01:25', NULL, NULL, NULL, NULL, NULL),
(1409, '95503806', 'Cigarette Hollywood ', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 08:14:24', NULL, NULL, NULL, NULL, NULL),
(1410, '8304234344520', 'Cigarette Derby', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2022-02-28 07:01:32', NULL, NULL, NULL, NULL, NULL),
(1411, '001411', 'Cigarette Sheek', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1412, '001412', 'GP  Mins Card', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1413, '001413', 'GP MB Card ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1414, '001414', 'GP Recharge card 20 taka', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1415, '001415', 'GP Recharge card 50 taka', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1416, '001416', 'Airtel Mins Card', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1417, '001417', 'Airtel Mb Card', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1418, '001418', 'Airtel Recharge Card', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1419, '001419', 'Robi Mins card ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1420, '001420', 'Robi MB Card ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1421, '001421', 'Robi Recharge Card', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '801', NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-24 11:17:28', NULL, NULL, NULL, NULL, NULL),
(1422, '001422', 'BL Mins Card ', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1423, '001423', 'BL MB card', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-22 07:32:16', NULL, NULL, NULL, NULL, NULL),
(1424, '001424', 'BL Recharge Card', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-20 17:07:07', '2021-12-23 05:14:12', NULL, NULL, NULL, NULL, NULL),
(1427, '001427', 'Eyeliner 100 BDT', '', '100', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, '20', '4', NULL, 97, NULL, 4, 27, 27, '2021-12-22 04:53:16', '2022-02-24 05:22:02', NULL, NULL, NULL, NULL, 5),
(1428, '001428', 'Mashakara 100 BDT', '', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, 97, NULL, 4, 27, 27, '2021-12-22 04:53:35', '2021-12-22 07:03:09', NULL, NULL, NULL, NULL, NULL),
(1429, '001429', 'Concealer 100 BDT', '', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, NULL, 4, 27, 27, '2021-12-22 04:56:29', '2021-12-22 05:02:24', NULL, NULL, NULL, NULL, NULL),
(1430, '001430', 'Foundation 100 BDT', '', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL, 97, NULL, 4, 27, 27, '2021-12-22 05:04:49', '2021-12-22 07:06:27', NULL, NULL, NULL, NULL, NULL),
(1431, '8941183005050', 'Fay Narcissus Air freshener', '', '220', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 112, 3, 26, 26, '2021-12-23 07:27:35', '2021-12-23 07:27:35', NULL, NULL, NULL, NULL, NULL),
(1432, '8941196246020', 'ACI Neem original 100 gm', '', '42', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, 3, 26, 26, '2021-12-23 07:37:26', '2021-12-23 07:37:26', NULL, NULL, NULL, NULL, NULL),
(1434, '8941155007280', 'Cocola Milky butter cake', '', '30', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 03:07:45', '2021-12-24 03:07:45', NULL, NULL, NULL, NULL, NULL),
(1435, '8901058871876', 'Nescafe Classic Coffee 25 gm', '', '85', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, 3, 26, 26, '2021-12-24 03:16:31', '2021-12-24 03:24:06', NULL, NULL, NULL, NULL, NULL),
(1437, '8904406003950', 'Lafz faiz pocket Deodorant', '', '99', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 04:42:44', '2021-12-24 04:42:44', NULL, NULL, NULL, NULL, NULL),
(1438, '76239878', 'Cigarette Marlboro Gold', '', '15', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 05:08:18', '2021-12-24 05:08:18', NULL, NULL, NULL, NULL, NULL),
(1439, '8941100657102', 'Sunsilk Perfect Straight 180 Ml', '', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-24 06:28:30', '2021-12-24 06:28:30', NULL, NULL, NULL, NULL, NULL),
(1440, '8941100659083', 'Sunsilk  Hijab Lime &Zpto ', '', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 3, 26, 26, '2021-12-24 06:30:18', '2021-12-24 06:30:18', NULL, NULL, NULL, NULL, NULL),
(1441, '8025765281503', 'Custard Powder 150GM', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:23:07', '2021-12-24 10:23:07', NULL, NULL, NULL, NULL, NULL),
(1442, '8904406199523', 'Lafz Olive Oil', '', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:36:03', '2021-12-24 10:36:03', NULL, NULL, NULL, NULL, NULL),
(1443, '001443', 'Lafz Tryst pocket Deodorant', '', '99', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:37:16', '2021-12-24 10:37:16', NULL, NULL, NULL, NULL, NULL),
(1444, '001444', 'Lafz Vera pocket Deodorant', '', '99', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:37:53', '2021-12-24 10:37:53', NULL, NULL, NULL, NULL, NULL),
(1445, '8946000009563', 'Dan Cake vanilla 35 Taka', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:48:33', '2021-12-24 10:48:33', NULL, NULL, NULL, NULL, NULL),
(1446, '745125253572', 'Dan Cake vanilla 50 Taka', '', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:50:39', '2021-12-24 10:50:39', NULL, NULL, NULL, NULL, NULL),
(1447, '001447', 'Dan Cake lemon 35 Taka', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 10:51:24', '2021-12-24 10:51:24', NULL, NULL, NULL, NULL, NULL),
(1448, '8941100283356', 'Dettol Hand Wash aloe vera', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 11:34:31', '2021-12-24 11:36:13', NULL, NULL, NULL, NULL, NULL),
(1449, '8941102833412', 'Dettol Hand Was cool', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 11:35:43', '2021-12-24 11:35:43', NULL, NULL, NULL, NULL, NULL),
(1450, '8941100284490', 'Dettol Hand Wash aloe vera 200ML Pump', '', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 11:41:31', '2021-12-24 11:41:31', NULL, NULL, NULL, NULL, NULL),
(1451, '7501056349288', 'Dove Soap Pink/rosa 135GM', '', '99', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 12:19:06', '2021-12-24 12:19:06', NULL, NULL, NULL, NULL, NULL),
(1452, '001452', 'Dove Soap Pink/rosa 100 GM', '', '75', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 12:19:26', '2021-12-24 12:19:26', NULL, NULL, NULL, NULL, NULL),
(1453, '001453', 'Dove Soap Pink/rosa 50 GM', '', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 12:19:46', '2021-12-24 12:19:46', NULL, NULL, NULL, NULL, NULL),
(1454, '745125275260', 'Eno Lemon flavou', '', '15', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 12:29:18', '2021-12-24 12:29:18', NULL, NULL, NULL, NULL, NULL),
(1455, '8901248268431', 'HE Passion Body Perfume ', '', '130', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 13:57:51', '2021-12-24 13:57:51', NULL, NULL, NULL, NULL, NULL),
(1456, '8901157003017', 'Good Knight Turbo machine ', '', '225', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 14:22:29', '2021-12-24 14:22:29', NULL, NULL, NULL, NULL, NULL),
(1457, '001457', 'Good Knight Turbo Liquid', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 14:23:45', '2021-12-24 14:23:45', NULL, NULL, NULL, NULL, NULL),
(1458, '8901023019715', 'Good Knight Gold Flash machine ', '', '199', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 14:30:20', '2021-12-24 14:30:20', NULL, NULL, NULL, NULL, NULL),
(1459, '8901023019722', 'Good Knight Gold Flash liquid', '', '120', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-24 14:30:56', '2021-12-27 04:07:12', NULL, NULL, NULL, NULL, NULL),
(1460, '001460', 'Polythin kara 2.5 gm', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-26 05:25:10', '2021-12-26 05:31:37', NULL, NULL, NULL, NULL, NULL),
(1461, '001461', 'Polythin White 2.5gm', '', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-26 05:27:30', '2021-12-26 05:39:37', NULL, NULL, NULL, NULL, NULL),
(1462, '001462', 'Polythin Mini 1 paket', '', '10', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-26 05:29:25', '2021-12-26 05:29:25', NULL, NULL, NULL, NULL, NULL),
(1464, '001464', 'Lux Bar Mini jasmine 10 Taka', '', '10', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:07:57', '2021-12-27 06:07:57', NULL, NULL, NULL, NULL, NULL),
(1465, '8941102310647', 'Lux Bar jasmine 75 GM', '', '26', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:10:39', '2021-12-27 06:10:39', NULL, NULL, NULL, NULL, NULL),
(1466, '8941102310364', 'Lux Bar jasmine100GM', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:11:20', '2021-12-27 06:11:20', NULL, NULL, NULL, NULL, NULL),
(1467, '8941102310661', 'Lux Bar jasmine 150 GM', '', '58', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:12:01', '2021-12-27 06:12:01', NULL, NULL, NULL, NULL, NULL),
(1468, '8941181000088', 'Mama noodles hot/spicy flavour 4p', '', '70', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:53:39', '2021-12-27 06:53:39', NULL, NULL, NULL, NULL, NULL),
(1469, '001469', 'Mama noodles hot/spicy flavour 8p', '', '135', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:54:02', '2021-12-27 06:54:02', NULL, NULL, NULL, NULL, NULL),
(1470, '001470', 'Mama noodles hot/spicy flavour 12p', '', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 06:54:22', '2021-12-27 06:54:22', NULL, NULL, NULL, NULL, NULL),
(1471, '8941100501290', 'Meril beli extract Soap bar 100GM', '', '38', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 07:10:59', '2021-12-27 07:10:59', NULL, NULL, NULL, NULL, NULL),
(1472, '8941100501726', 'Meril Miolk Soap bar 100GM', '', '38', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 07:11:38', '2021-12-27 07:11:38', NULL, NULL, NULL, NULL, NULL),
(1473, '8941100501160', 'Meril chapstick Lemon', '', '40', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 07:21:14', '2021-12-27 07:21:14', NULL, NULL, NULL, NULL, NULL),
(1474, '8941100295366', 'NIDO Forti Grow 500ml', '', '370', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-27 07:53:51', '2021-12-27 07:53:51', NULL, NULL, NULL, NULL, NULL),
(1475, '8941124000076', 'Keya Soap Lemon & Cocoa Butter 125 Ml ', '', '38', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:07:26', '2021-12-30 04:25:48', NULL, NULL, NULL, NULL, NULL),
(1476, '8941124000496', 'Keya Soap Enriced With Vitamin E125 Mll ', '', '38', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:09:11', '2021-12-30 04:09:11', NULL, NULL, NULL, NULL, NULL),
(1477, '8941124000489', 'Keya Soap Enriced With Vitamin E100 Ml ', '', '34', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:10:02', '2021-12-30 04:10:02', NULL, NULL, NULL, NULL, NULL),
(1478, '8941124000083', 'Keya Soap Lemon & Cocoa Butter 100 Ml', '', '34', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:11:18', '2021-12-30 04:11:18', NULL, NULL, NULL, NULL, NULL),
(1479, '001479', 'Kolson Macaroni Samuk 400GM ', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:23:45', '2021-12-30 04:23:45', NULL, NULL, NULL, NULL, NULL),
(1480, '001480', 'Kolson Macaroni Iskro 200GM', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:24:42', '2021-12-30 04:24:42', NULL, NULL, NULL, NULL, NULL),
(1481, '8941170014942', 'Kolson Macaroni Iskro 400GM', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 04:25:08', '2021-12-30 04:25:08', NULL, NULL, NULL, NULL, NULL),
(1482, '8944000554717', 'Parachute Naturale Anti Hair Fall shampoo 340 Ml', '', '320', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 07:39:33', '2021-12-30 07:51:56', NULL, NULL, NULL, NULL, NULL),
(1483, '8944000554700', 'Parachute Naturale Anti Hair Fall shampoo 170 Ml', '', '185', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 07:52:54', '2021-12-30 07:52:54', NULL, NULL, NULL, NULL, NULL),
(1484, '8944000554670', 'Parachute Naturale Damage Repair shampoo 340 Ml', '', '320', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 07:53:51', '2021-12-30 07:53:51', NULL, NULL, NULL, NULL, NULL),
(1485, '8944000554663', 'Parachute Naturale Damage Repair shampoo 170 Ml', '', '185', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 07:54:35', '2021-12-30 07:54:35', NULL, NULL, NULL, NULL, NULL),
(1486, '001486', 'Parachute Natural White Fair & Glowing Skin lotion 100GM', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 08:00:18', '2021-12-30 08:00:18', NULL, NULL, NULL, NULL, NULL),
(1487, '001487', 'Parachute Natural Moisture Soft & Glowing Skin lotion 100GM', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2021-12-30 08:00:50', '2021-12-30 08:00:50', NULL, NULL, NULL, NULL, NULL),
(1488, '001488', 'Eye liner', NULL, '100', NULL, NULL, NULL, '28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:44:24', NULL, NULL, NULL, NULL, NULL),
(1489, '001489', 'Mascara', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1490, '001490', 'Concealer', NULL, '100', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:28:53', NULL, NULL, NULL, NULL, NULL),
(1491, '001491', 'Foundation', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1492, '001492', 'Makeup brush', NULL, '100', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:45:48', NULL, NULL, NULL, NULL, NULL),
(1493, '001493', 'Primer', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1494, '001494', 'Lipstick-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1495, '001495', 'Makeup box', NULL, '100', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:40:39', NULL, NULL, NULL, NULL, NULL),
(1496, '001496', 'Face powder', NULL, '100', NULL, NULL, NULL, '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:46:22', NULL, NULL, NULL, NULL, NULL),
(1497, '001497', 'Beauty box', NULL, '100', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:00:45', NULL, NULL, NULL, NULL, NULL),
(1498, '001498', 'Gliter', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1499, '001499', 'Lipstick-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1500, '001500', 'Fake nail-30bdt', NULL, '30', NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:47:09', NULL, NULL, NULL, NULL, NULL),
(1501, '001501', 'Fake nail-100bdt', NULL, '100', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:46:56', NULL, NULL, NULL, NULL, NULL),
(1502, '001502', 'Kakra band-10bdt', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1503, '001503', 'Kakra band-20bdt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1504, '001504', 'Kakra band-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1505, '001505', 'Kakra band-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1506, '001506', 'Kakra band-70bdt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1507, '001507', 'Kakra band-80bdt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1508, '001508', 'Kakra band-130bdt', NULL, '130', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1509, '001509', 'Hijab pin-5bdt', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1510, '001510', 'Hijab pin-10bdt', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1511, '001511', 'Hijab pin-15bdt', NULL, '15', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1512, '001512', 'Hijab pin-20bdt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1513, '001513', 'Hijab pin-25bdt', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1514, '001514', 'Kajol', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1515, '001515', 'Nail polish-70bdt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1516, '001516', 'Puff', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1517, '001517', 'Nail polish-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1518, '001518', 'Eyelash', NULL, '50', NULL, NULL, NULL, '18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:44:38', NULL, NULL, NULL, NULL, NULL),
(1519, '001519', 'Chiruni-10bdt', NULL, '10', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1520, '001520', 'Chiruni-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1521, '001521', 'Sunglass-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1522, '001522', 'Sunglass-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1523, '001523', 'Sunglass-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1524, '001524', 'Sunglass-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1525, '001525', 'Sunglass-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1526, '001526', 'Sunglass-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1527, '001527', 'Sunglass-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1528, '001528', 'Sunglass-400bdt', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1529, '001529', 'Ceramic plate-80bdt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1530, '001530', 'Ceramic plate-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1531, '001531', 'Ceramic plate-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1532, '001532', 'Ceramic plate-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1533, '001533', 'Ceramic plate-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1534, '001534', 'Ceramic mug-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1535, '001535', 'Ceramic mug-80bdt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1536, '001536', 'Ceramic mug-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1537, '001537', 'Ceramic mug-140bdt', NULL, '140', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1538, '001538', 'Ceramic mug-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1539, '001539', 'Ceramic mug-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1540, '001540', 'Ceramic mug-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1541, '001541', 'Ceramic mug-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1542, '001542', 'Ceramic mug-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1543, '001543', 'Bag-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 18:53:21', NULL, NULL, NULL, NULL, NULL),
(1544, '001544', 'Bag-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1545, '001545', 'Bag-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1546, '001546', 'Bag-170bdt', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1547, '001547', 'Bag-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1548, '001548', 'Bag-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1549, '001549', 'Bag-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1550, '001550', 'Watch-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1551, '001551', 'Watch-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1552, '001552', 'Watch-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1553, '001553', 'Watch-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1554, '001554', 'Watch-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1555, '001555', 'Watch-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1556, '001556', 'Watch-350bdt', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1557, '001557', 'Watch-400bdt', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1558, '001558', 'Glass-70bdt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1559, '001559', 'Glass-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1560, '001560', 'Bati-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1561, '001561', 'Bati-70bdt', NULL, '70', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1562, '001562', 'Bati-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(1563, '001563', 'Bati-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1564, '001564', 'Soup bati-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1565, '001565', 'Soup bati-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1566, '001566', 'Cup pirich-100bdt', NULL, '100', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:14:27', NULL, NULL, NULL, NULL, NULL),
(1567, '001567', 'Cup pirich-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1568, '001568', 'Candy jar-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1569, '001569', 'Candy jar-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1570, '001570', 'Candy jar-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1571, '001571', 'Candy jar-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1572, '001572', 'Set-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1573, '001573', 'Set-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1574, '001574', 'Set-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1575, '001575', 'Set-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1576, '001576', 'Set-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1577, '001577', 'Set-320bdt', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1578, '001578', 'Set-350bdt', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1579, '001579', 'Set-420bdt', NULL, '420', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1580, '001580', 'Set-450bdt', NULL, '450', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1581, '001581', 'Set-600bdt', NULL, '600', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1582, '001582', 'Jar-30bdt', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1583, '001583', 'Jar-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1584, '001584', 'Pata-80bdt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1585, '001585', 'Pata-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1586, '001586', 'Service plate-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1587, '001587', 'Service plate-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1588, '001588', 'Service plate-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1589, '001589', 'Juice glass', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1590, '001590', 'Jug', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:05:34', NULL, NULL, NULL, NULL, NULL),
(1591, '001591', 'Water pot', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1592, '001592', 'Dustbin', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:05:18', NULL, NULL, NULL, NULL, NULL),
(1593, '001593', 'Handwash', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1594, '001594', 'Set bati', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1595, '001595', 'Masala bati', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1596, '001596', 'Juice pot', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1597, '001597', 'Chopper', NULL, '100', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:07:46', NULL, NULL, NULL, NULL, NULL),
(1598, '001598', 'Shuta set', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1599, '001599', 'Tissue box', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1600, '001600', 'Ice set', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:33:38', NULL, NULL, NULL, NULL, NULL),
(1601, '001601', 'Lebu chipar', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1602, '001602', 'Fish cutter', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1603, '001603', 'Astry', NULL, '100', NULL, NULL, NULL, '85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 18:52:48', NULL, NULL, NULL, NULL, NULL),
(1604, '001604', 'Glass stand', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1605, '001605', 'Oven gloves', NULL, '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:41:49', NULL, NULL, NULL, NULL, NULL),
(1606, '001606', 'Fitter', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1607, '001607', 'Tray', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1608, '001608', 'Tools set', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1609, '001609', 'Spoon', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1610, '001610', 'Fry pan', NULL, '100', NULL, NULL, NULL, '85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:37:52', NULL, NULL, NULL, NULL, NULL),
(1611, '001611', 'Karai', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1612, '001612', 'Patil', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1613, '001613', 'Sauce bottle', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1614, '001614', 'Hotpot', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:30:02', NULL, NULL, NULL, NULL, NULL),
(1615, '001615', 'Dinning mat-100bdt', NULL, '100', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:34:06', NULL, NULL, NULL, NULL, NULL),
(1616, '001616', 'Dinning mat-150bdt', NULL, '150', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:34:15', NULL, NULL, NULL, NULL, NULL),
(1617, '001617', 'Floor mat', NULL, '150', NULL, NULL, NULL, '85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:19:42', NULL, NULL, NULL, NULL, NULL),
(1618, '001618', 'Diary', NULL, '100', NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:42:00', NULL, NULL, NULL, NULL, NULL),
(1619, '001619', 'Pen box', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1620, '001620', 'Coin box', NULL, '100', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:12:33', NULL, NULL, NULL, NULL, NULL),
(1621, '001621', 'Spinner', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1622, '001622', 'Cube', NULL, '100', NULL, NULL, NULL, '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:32:43', NULL, NULL, NULL, NULL, NULL),
(1623, '001623', 'Ludu', NULL, '100', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:33:51', NULL, NULL, NULL, NULL, NULL),
(1624, '001624', 'Bus', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1625, '001625', 'Truck', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1626, '001626', 'Icecream set', NULL, '100', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:32:23', NULL, NULL, NULL, NULL, NULL),
(1627, '001627', 'Box', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1628, '001628', 'Telephone', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1629, '001629', 'Junjhuni', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:38:54', NULL, NULL, NULL, NULL, NULL),
(1630, '001630', 'Tempu', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1631, '001631', 'Guitar', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1632, '001632', 'Plane', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1633, '001633', 'Honda', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1634, '001634', 'Rifle-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1635, '001635', 'Army set', NULL, '100', NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 19:54:10', NULL, NULL, NULL, NULL, NULL),
(1636, '001636', 'Doctor set', NULL, '100', NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 20:01:43', NULL, NULL, NULL, NULL, NULL),
(1637, '001637', 'Beauty set', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1638, '001638', 'Avenger set', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 18:53:17', NULL, NULL, NULL, NULL, NULL),
(1639, '001639', 'Bat ball', NULL, '100', NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-16 19:59:57', NULL, NULL, NULL, NULL, NULL),
(1640, '001640', 'Rocket', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1641, '001641', 'Umbrella', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1642, '001642', 'Car-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1643, '001643', 'Car-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1644, '001644', 'Car-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1645, '001645', 'Car-350bdt', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1646, '001646', 'Car-400bdt', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1647, '001647', 'Car-500bdt', NULL, '500', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1648, '001648', 'Car-650bdt', NULL, '650', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1649, '001649', 'Car-750bdt', NULL, '750', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1650, '001650', 'Rifle-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1651, '001651', 'Rifle-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1652, '001652', 'Rifle-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1653, '001653', 'Fish game-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1654, '001654', 'Fish game-270bdt', NULL, '270', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1655, '001655', 'Fish game-450bdt', NULL, '450', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1656, '001656', 'Bangla doll-100bdt', NULL, '100', NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 19:55:18', NULL, NULL, NULL, NULL, NULL),
(1657, '001657', 'Bangla doll-120bdt', NULL, '120', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 19:55:27', NULL, NULL, NULL, NULL, NULL),
(1658, '001658', 'China doll-150bdt', NULL, '150', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 19:46:30', NULL, NULL, NULL, NULL, NULL),
(1659, '001659', 'China doll-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1660, '001660', 'China doll-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1661, '001661', 'China doll-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1662, '001662', 'China doll-350bdt', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1663, '001663', 'China doll-400bdt', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1664, '001664', 'China doll-550bdt', NULL, '550', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1665, '001665', 'China doll-650bdt', NULL, '650', NULL, NULL, NULL, '0.09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-15 20:00:55', NULL, NULL, NULL, NULL, NULL),
(1666, '001666', 'Flower stick-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1667, '001667', 'Flower stick-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1668, '001668', 'Flower stick-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1669, '001669', 'Flower stick-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1670, '001670', 'Flower stick-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1671, '001671', 'Flower stick-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1672, '001672', 'Flower stick-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1673, '001673', 'Flower vase-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1674, '001674', 'Flower vase-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1675, '001675', 'Flower vase-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1676, '001676', 'Flower vase-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1677, '001677', 'Flower vase-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:40:59', '2022-01-02 08:40:59', NULL, NULL, NULL, NULL, NULL),
(1678, '001678', 'Flower vase-280bdt', NULL, '280', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1679, '001679', 'Gajna Flower', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1680, '001680', 'Door bell-100bdt', NULL, '100', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:09:13', NULL, NULL, NULL, NULL, NULL),
(1681, '001681', 'Door bell-120bdt', NULL, '120', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:09:26', NULL, NULL, NULL, NULL, NULL),
(1682, '001682', 'Door bell-150bdt', NULL, '150', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:09:34', NULL, NULL, NULL, NULL, NULL),
(1683, '001683', 'Sticker', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1684, '001684', 'Lota', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1685, '001685', 'Show piece-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1686, '001686', 'Show piece-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1687, '001687', 'Show piece-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1688, '001688', 'Show piece-170bdt', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1689, '001689', 'Show piece-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1690, '001690', 'Show piece-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1691, '001691', 'Show piece-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1692, '001692', 'Show piece-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1693, '001693', 'Show piece-270bdt', NULL, '270', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1694, '001694', 'Show piece-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1695, '001695', 'Photo frame-80bdt', NULL, '80', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1696, '001696', 'Photo frame-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1697, '001697', 'Photo frame-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1698, '001698', 'Photo frame-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1699, '001699', 'Photo frame-170bdt', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1700, '001700', 'Photo frame-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1701, '001701', 'Photo frame-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1702, '001702', 'Photo frame-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1703, '001703', 'Photo frame-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1704, '001704', 'Flower tob-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1705, '001705', 'Flower tob-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1706, '001706', 'Flower tob-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1707, '001707', 'Flower tob-170bdt', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1708, '001708', 'Flower tob-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1709, '001709', 'Flower tob-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1710, '001710', 'Flower tob-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1711, '001711', 'Flower tob-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1712, '001712', 'Flower tob-270bdt', NULL, '270', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1713, '001713', 'Flower tob-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1714, '001714', 'Flower tob-320bdt', NULL, '320', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1715, '001715', 'Flower tob-350bdt', NULL, '350', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1716, '001716', 'Paposh-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1717, '001717', 'Paposh-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1718, '001718', 'Paposh-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1719, '001719', 'Paposh-170bdt', NULL, '170', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1720, '001720', 'Paposh-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1721, '001721', 'Paposh-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1722, '001722', 'Wall mat-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1723, '001723', 'Wall mat-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1724, '001724', 'Wall mat-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1725, '001725', 'Wall mat-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1726, '001726', 'Wall mat-400bdt', NULL, '400', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1727, '001727', 'Wall mat-500bdt', NULL, '500', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1728, '001728', 'Birthday foil', NULL, '180', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:11:53', NULL, NULL, NULL, NULL, NULL),
(1729, '001729', 'Birthday card', NULL, '150', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:06:49', NULL, NULL, NULL, NULL, NULL),
(1730, '001730', 'Baloon-100bdt', NULL, '100', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 19:58:39', NULL, NULL, NULL, NULL, NULL),
(1731, '001731', 'Baloon-150bdt', NULL, '150', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 19:58:51', NULL, NULL, NULL, NULL, NULL),
(1732, '001732', 'Baloon-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1733, '001733', 'Baloon-2bdt', NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1734, '001734', 'Baloon-4bdt', NULL, '4', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1735, '001735', 'Baloon-5bdt', NULL, '5', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1736, '001736', 'Candle-20bdt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1737, '001737', 'Candle-30bdt', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1738, '001738', 'Candle-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1739, '001739', 'Candle-100bdt', NULL, '100', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:13:32', NULL, NULL, NULL, NULL, NULL),
(1740, '001740', 'Candle-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1741, '001741', 'Candle-250bdt', NULL, '250', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:12:35', NULL, NULL, NULL, NULL, NULL),
(1742, '001742', 'Party spray-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1743, '001743', 'Confetti', NULL, '100', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-16 20:32:28', NULL, NULL, NULL, NULL, NULL),
(1744, '001744', 'Birthday cap-20bdt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1745, '001745', 'Birthday cap-30bdt', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1746, '001746', 'Birthday cap-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1747, '001747', 'Birthday cap-60bdt', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1748, '001748', 'Photos from', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1749, '001749', 'Jhalot', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1750, '001750', 'Churi-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1751, '001751', 'Churi-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1752, '001752', 'Churi-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1753, '001753', 'Churi-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1754, '001754', 'Churi-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1755, '001755', 'Churi-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1756, '001756', 'Mirror-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1757, '001757', 'Mirror-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1758, '001758', 'Mirror-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1759, '001759', 'Projapoti Dana', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1760, '001760', 'Key ring-30bdt', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1761, '001761', 'Key ring-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1762, '001762', 'Key ring-60bdt', NULL, '60', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1763, '001763', 'Key ring-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1764, '001764', 'Perfume-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1765, '001765', 'Perfume-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1766, '001766', 'Perfume-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1767, '001767', 'Perfume-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1768, '001768', 'Mala-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1769, '001769', 'Mala-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1770, '001770', 'Mala-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1771, '001771', 'Mala-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1772, '001772', 'Mala-220bdt', NULL, '220', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1773, '001773', 'Mala-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1774, '001774', 'Bracelet-100bdt', NULL, '100', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:13', NULL, NULL, NULL, NULL, NULL),
(1775, '001775', 'Bracelet-120bdt', NULL, '120', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:27', NULL, NULL, NULL, NULL, NULL),
(1776, '001776', 'Bracelet-150bdt', NULL, '150', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:32', NULL, NULL, NULL, NULL, NULL),
(1777, '001777', 'Bracelet-170bdt', NULL, '170', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:39', NULL, NULL, NULL, NULL, NULL),
(1778, '001778', 'Bracelet-200bdt', NULL, '200', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:50', NULL, NULL, NULL, NULL, NULL),
(1779, '001779', 'Bracelet-250bdt', NULL, '250', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-15 19:57:55', NULL, NULL, NULL, NULL, NULL),
(1780, '001780', 'Ring-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1781, '001781', 'Ring-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1782, '001782', 'Ring-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1783, '001783', 'Ring-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1784, '001784', 'Hair ring-20bdt', NULL, '20', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1785, '001785', 'Hair ring-25bdt', NULL, '25', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1786, '001786', 'Hair ring-30bdt', NULL, '30', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1787, '001787', 'Hair ring-40bdt', NULL, '40', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1788, '001788', 'Hair ring-50bdt', NULL, '50', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1789, '001789', 'Hair ring-100bdt', NULL, '100', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1790, '001790', 'Hair ring-120bdt', NULL, '120', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1791, '001791', 'Hair ring-150bdt', NULL, '150', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1792, '001792', 'Hair ring-180bdt', NULL, '180', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1793, '001793', 'Hair ring-200bdt', NULL, '200', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(1794, '001794', 'Hair ring-250bdt', NULL, '250', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1795, '001795', 'Hair ring-300bdt', NULL, '300', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 4, 27, 27, '2022-01-02 08:41:00', '2022-01-02 08:41:00', NULL, NULL, NULL, NULL, NULL),
(1796, '001796', 'one piece vinay', NULL, '2450', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-02-24 08:32:00', NULL, NULL, NULL, NULL, NULL),
(1797, '001797', 'vinay gown', NULL, '2450', NULL, NULL, NULL, '1150', NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-02-24 09:35:21', NULL, NULL, NULL, NULL, NULL),
(1798, '001798', 'gul1', NULL, '0', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1799, '001799', 'gulbahar', NULL, '0', NULL, NULL, NULL, '1850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1800, '001800', 'vinay kurti', NULL, '2450', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1801, '001801', 'gown vinay1', NULL, '0', NULL, NULL, NULL, '1700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1802, '001802', 'gown vinay2', NULL, '0', NULL, NULL, NULL, '2700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1803, '001803', 'pakistani 3p', NULL, '2900', NULL, NULL, NULL, '1900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1804, '001804', 'pakistani 3p2', NULL, '2800', NULL, NULL, NULL, '1800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1805, '001805', 'pakistani version cotton1', NULL, '2600', NULL, NULL, NULL, '1600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1806, '001806', 'anzara', NULL, '2600', NULL, NULL, NULL, '1600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1807, '001807', 'irina', NULL, '2850', NULL, NULL, NULL, '1850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1808, '001808', 'indian cotton ', NULL, '2250', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1809, '001809', 'fewna', NULL, '2500', NULL, NULL, NULL, '1500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1810, '001810', 'cotton 3p', NULL, '2450', NULL, NULL, NULL, '1450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1811, '001811', 'binsayeed3009', NULL, '2450', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1812, '001812', 'binsayed3006', NULL, '2450', NULL, NULL, NULL, '1100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1813, '001813', 'binsayed3003,8,175,3001,4', NULL, '2450', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1814, '001814', 'binsayeed urna kaj', NULL, '0', NULL, NULL, NULL, '1400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1815, '001815', 'cotton 4776,73,67,69', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1816, '001816', '4766', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1817, '001817', '170', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1818, '001818', '150', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1819, '001819', '156,100,78,76', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1820, '001820', '522,29,15,502', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1821, '001821', '133', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1822, '001822', '101,99', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1823, '001823', '4732', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1824, '001824', '4736,43', NULL, '0', NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1825, '001825', '4770,4772,53,58', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1826, '001826', '4727,4740,4775,4774,49', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1827, '001827', '4765', NULL, '0', NULL, NULL, NULL, '1350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1828, '001828', '4729', NULL, '0', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1829, '001829', '4716', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1830, '001830', '4759', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1831, '001831', '2020809', NULL, '0', NULL, NULL, NULL, '750', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1832, '001832', 'khubsoorat,stone', NULL, '0', NULL, NULL, NULL, '990', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1833, '001833', 'gold', NULL, '0', NULL, NULL, NULL, '380', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1834, '001834', '9652', NULL, '0', NULL, NULL, NULL, '550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1835, '001835', '9477', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1836, '001836', '9698', NULL, '0', NULL, NULL, NULL, '795', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1837, '001837', 'indian chinon', NULL, '0', NULL, NULL, NULL, '1350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1838, '001838', 'indian pure', NULL, '0', NULL, NULL, NULL, '1590', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1839, '001839', 'joya', NULL, '0', NULL, NULL, NULL, '1390', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1840, '001840', '9459', NULL, '0', NULL, NULL, NULL, '590', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1841, '001841', '9673', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1842, '001842', 'new ad1', NULL, '0', NULL, NULL, NULL, '795', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1843, '001843', 'new ad2', NULL, '0', NULL, NULL, NULL, '555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1844, '001844', '3002', NULL, '0', NULL, NULL, NULL, '1150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1845, '001845', 'ebusha', NULL, '0', NULL, NULL, NULL, '1350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1846, '001846', 'd223', NULL, '0', NULL, NULL, NULL, '1780', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1847, '001847', 'd192', NULL, '0', NULL, NULL, NULL, '1450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1848, '001848', 'ferdous loan', NULL, '0', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1849, '001849', 'cheap loan', NULL, '0', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1850, '001850', 'rainbow', NULL, '0', NULL, NULL, NULL, '380', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1851, '001851', '7355', NULL, '0', NULL, NULL, NULL, '1150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1852, '001852', '7483', NULL, '0', NULL, NULL, NULL, '1180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1853, '001853', '7400', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1854, '001854', '7456', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1855, '001855', 'shipon 2p', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1856, '001856', 'cotton 2p', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1857, '001857', 'patel cotton ', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1858, '001858', 'fine cotton', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1859, '001859', 'joyvijoy', NULL, '0', NULL, NULL, NULL, '2600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1860, '001860', 'ari kaj', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1861, '001861', 'jute kota', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1862, '001862', 'loan', NULL, '0', NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:07', '2022-01-07 12:55:07', NULL, NULL, NULL, NULL, NULL),
(1863, '001863', 'ad kalamkari', NULL, '0', NULL, NULL, NULL, '440', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1864, '001864', 'kalamkari', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1865, '001865', 'screen roll', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1866, '001866', 'screen print', NULL, '0', NULL, NULL, NULL, '440', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1867, '001867', 'joypuri', NULL, '0', NULL, NULL, NULL, '2250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1868, '001868', 'joypuri2', NULL, '0', NULL, NULL, NULL, '2500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1869, '001869', 'chunri', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(1870, '001870', 'moksha', NULL, '0', NULL, NULL, NULL, '2100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1871, '001871', 'G-BLACK', NULL, '0', NULL, NULL, NULL, '1850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1872, '001872', 'piyani', NULL, '0', NULL, NULL, NULL, '1350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1873, '001873', 'joypuri work', NULL, '0', NULL, NULL, NULL, '2600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1874, '001874', 'joypuri work2', NULL, '0', NULL, NULL, NULL, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1875, '001875', 'delhi boutique fsa', NULL, '0', NULL, NULL, NULL, '6000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1876, '001876', 'te30', NULL, '0', NULL, NULL, NULL, '4100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1877, '001877', 'm126291', NULL, '0', NULL, NULL, NULL, '5000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1878, '001878', 'brk9816', NULL, '0', NULL, NULL, NULL, '3900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1879, '001879', 'delhi boutique katan', NULL, '0', NULL, NULL, NULL, '3000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1880, '001880', 'delhi boutique', NULL, '0', NULL, NULL, NULL, '2900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1881, '001881', 'chanderi boutique', NULL, '0', NULL, NULL, NULL, '1900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1882, '001882', 'saree', NULL, '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1883, '001883', 'masline cotton', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1884, '001884', 'popcorn', NULL, '0', NULL, NULL, NULL, '550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1885, '001885', 'cotton check1', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1886, '001886', 'cotton check 2', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1887, '001887', 'monipuri', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1888, '001888', 'block', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1889, '001889', 'shokal shondha', NULL, '0', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1890, '001890', 'half silk jamdani ', NULL, '0', NULL, NULL, NULL, '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1891, '001891', 'jori jamdani', NULL, '0', NULL, NULL, NULL, '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1892, '001892', 'cotton jamdani1', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1893, '001893', 'cotton jamdani2', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1894, '001894', 'chunri kosh', NULL, '0', NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1895, '001895', 'than saree', NULL, '0', NULL, NULL, NULL, '260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1896, '001896', 'palace', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1897, '001897', 'kuta than', NULL, '0', NULL, NULL, NULL, '450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1898, '001898', 'carendi', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1899, '001899', 'liza', NULL, '0', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1900, '001900', 'nayantara', NULL, '0', NULL, NULL, NULL, '450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1901, '001901', 'check', NULL, '0', NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1902, '001902', 'chumki', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1903, '001903', 'maslin', NULL, '0', NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1904, '001904', 'masline ', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1905, '001905', 'makhon kuta', NULL, '0', NULL, NULL, NULL, '480', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1906, '001906', 'nakshi pair', NULL, '0', NULL, NULL, NULL, '470', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1907, '001907', 'makhon check', NULL, '0', NULL, NULL, NULL, '450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1908, '001908', 'nakshi achol ', NULL, '0', NULL, NULL, NULL, '550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1909, '001909', 'shui suta', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1910, '001910', 'pati saree', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1911, '001911', 'baby saree', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1912, '001912', 'shili saree', NULL, '0', NULL, NULL, NULL, '670', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1913, '001913', 'vip tercel', NULL, '0', NULL, NULL, NULL, '880', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1914, '001914', 'batik chumki', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1915, '001915', 'vip shiburi kuta', NULL, '0', NULL, NULL, NULL, '1550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1916, '001916', 'multi moom saree ', NULL, '0', NULL, NULL, NULL, '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1917, '001917', 'multi batik', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1918, '001918', 'vip shanai batik', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1919, '001919', 'silk saree', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1920, '001920', 'digital saree', NULL, '0', NULL, NULL, NULL, '1400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1921, '001921', 'bd queen katan', NULL, '0', NULL, NULL, NULL, '1150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1922, '001922', 'chennai katan', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1923, '001923', 'chunri silk', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1924, '001924', 'ic south katan', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1925, '001925', 'locket1', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1926, '001926', 'ad locket', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1927, '001927', 'locket2', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1928, '001928', 'churi', NULL, '0', NULL, NULL, NULL, '170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1929, '001929', 'tawaiba churi', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1930, '001930', 'boro dul', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1931, '001931', 'shita', NULL, '0', NULL, NULL, NULL, '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1932, '001932', 'stone boro dul', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1933, '001933', 'top earings', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1934, '001934', 'stone set', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1935, '001935', 'joypuri mala ', NULL, '0', NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1936, '001936', 'antique mala', NULL, '0', NULL, NULL, NULL, '280', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1937, '001937', 'choker', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1938, '001938', 'payel', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1939, '001939', 'hand batch1', NULL, '0', NULL, NULL, NULL, '190', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1940, '001940', 'hand batch2', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1941, '001941', 'bicha1', NULL, '0', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1942, '001942', 'bicha 2', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1943, '001943', 'bicha3', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1944, '001944', 'boro kataya shita', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1945, '001945', 'neck piece', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1946, '001946', 'neck piece2', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1947, '001947', 'neck piece3', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1948, '001948', 'neck peice4', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1949, '001949', 'neck peice5', NULL, '0', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1950, '001950', 'neck peice6', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1951, '001951', 'dubai gold set1', NULL, '0', NULL, NULL, NULL, '580', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1952, '001952', 'dubai gold set 2', NULL, '0', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1953, '001953', 'dubai bina', NULL, '0', NULL, NULL, NULL, '370', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1954, '001954', 'chain', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1955, '001955', 'chain 2', NULL, '0', NULL, NULL, NULL, '480', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1956, '001956', '6092churi', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1957, '001957', '2764churi', NULL, '0', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1958, '001958', '6003churi', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1959, '001959', 'plain churi', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1960, '001960', 'gajra churi', NULL, '0', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1961, '001961', '5416churi', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1962, '001962', '5364churi', NULL, '0', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1963, '001963', '4663churi', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1964, '001964', 'city plain', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1965, '001965', '618churi', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1966, '001966', '5465churi', NULL, '0', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1967, '001967', 'mina bala', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1968, '001968', '5437churi', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1969, '001969', 'baby churi', NULL, '0', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1970, '001970', 'lata churi', NULL, '0', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1971, '001971', 'batch', NULL, '0', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1972, '001972', 'magnet', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1973, '001973', 'locket', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1974, '001974', 'box top', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1975, '001975', 'neckless set', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1976, '001976', 'neckless set2', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1977, '001977', 'jhapta ', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1978, '001978', 'mina dul', NULL, '0', NULL, NULL, NULL, '660', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1979, '001979', 'locket set', NULL, '0', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1980, '001980', 'neck set', NULL, '0', NULL, NULL, NULL, '430', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1981, '001981', 'neck set 2', NULL, '0', NULL, NULL, NULL, '770', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1982, '001982', 'set', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1983, '001983', 'dul ', NULL, '0', NULL, NULL, NULL, '170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1984, '001984', '2907 churi', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1985, '001985', '4820churi', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1986, '001986', 'city churi', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1987, '001987', '720churi', NULL, '0', NULL, NULL, NULL, '190', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1988, '001988', '6004churi', NULL, '0', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1989, '001989', '3cnobena', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1990, '001990', '720kom', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1991, '001991', 'mina lata', NULL, '0', NULL, NULL, NULL, '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1992, '001992', 'jamoni lata', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1993, '001993', '1096 churi', NULL, '0', NULL, NULL, NULL, '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1994, '001994', '3l gada mina', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1995, '001995', 'mina set', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1996, '001996', 'antique jhumka', NULL, '0', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1997, '001997', 'stone earings', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1998, '001998', 'locket mala ', NULL, '0', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(1999, '001999', 'antique ring', NULL, '0', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2000, '002000', 'g.s', NULL, '0', NULL, NULL, NULL, '320', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2001, '002001', 'black polish', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2002, '002002', 'south indian locket', NULL, '0', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2003, '002003', 'indian chocker', NULL, '0', NULL, NULL, NULL, '380', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2004, '002004', 'batch1', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2005, '002005', 'batch2', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2006, '002006', 'batch3', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2007, '002007', 'g.s batch', NULL, '0', NULL, NULL, NULL, '380', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2008, '002008', 'earings1', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2009, '002009', 'earings2', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2010, '002010', 'earings3', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2011, '002011', 'earings4', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2012, '002012', 'earings5', NULL, '0', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2013, '002013', 'earings6', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2014, '002014', 'earings7', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2015, '002015', 'earings8', NULL, '0', NULL, NULL, NULL, '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2016, '002016', 'earings9', NULL, '0', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2017, '002017', 'earings10', NULL, '0', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2018, '002018', 'tikli set', NULL, '0', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2019, '002019', 'g.s ad choker', NULL, '0', NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2020, '002020', 'mala', NULL, '0', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2021, '002021', 'joypuri set', NULL, '0', NULL, NULL, NULL, '550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2022, '002022', 'joypuri choker', NULL, '0', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2023, '002023', 'joypuri kundan set', NULL, '0', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2024, '002024', 'choker set', NULL, '0', NULL, NULL, NULL, '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2025, '002025', 'kundan tayra', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2026, '002026', 'stone mala', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2027, '002027', 'a.d choker', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `item` (`id`, `barcode_no`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(2028, '002028', 'earings', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2029, '002029', 'mina kundan dul', NULL, '0', NULL, NULL, NULL, '480', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2030, '002030', 'antique earings', NULL, '0', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2031, '002031', 'a.d earings', NULL, '0', NULL, NULL, NULL, '580', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2032, '002032', 'mina earings', NULL, '0', NULL, NULL, NULL, '260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2033, '002033', 'mina peacock earings', NULL, '0', NULL, NULL, NULL, '450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2034, '002034', 'kundan earings', NULL, '0', NULL, NULL, NULL, '450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2035, '002035', 'antique set', NULL, '0', NULL, NULL, NULL, '2000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2036, '002036', 'a.d set', NULL, '0', NULL, NULL, NULL, '1600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2037, '002037', 'joypuri kundan mala', NULL, '0', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2038, '002038', '1X21', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2039, '002039', '6685-2', NULL, '0', NULL, NULL, NULL, '1100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2040, '002040', '918', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2041, '002041', '330', NULL, '0', NULL, NULL, NULL, '1100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2042, '002042', '1234', NULL, '0', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2043, '002043', 'PALL', NULL, '0', NULL, NULL, NULL, '1100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2044, '002044', 'M146', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2045, '002045', '1985', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2046, '002046', '1634', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2047, '002047', 'MO48', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2048, '002048', '9038', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2049, '002049', 'DOLL', NULL, '0', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2050, '002050', 'OO5', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2051, '002051', '4923', NULL, '0', NULL, NULL, NULL, '1350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2052, '002052', 'A-6893', NULL, '0', NULL, NULL, NULL, '1600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2053, '002053', '3311-A', NULL, '0', NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2054, '002054', 'LLBABY', NULL, '0', NULL, NULL, NULL, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2055, '002055', '2056', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2056, '002056', 'DO3', NULL, '0', NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2057, '002057', '8130', NULL, '0', NULL, NULL, NULL, '1450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2058, '002058', '8129', NULL, '0', NULL, NULL, NULL, '1450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2059, '002059', '8027', NULL, '0', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2060, '002060', '8123', NULL, '0', NULL, NULL, NULL, '1450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2061, '002061', 'B2548', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2062, '002062', '33-1', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2063, '002063', '7777-1', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2064, '002064', '3833', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2065, '002065', '9801', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2066, '002066', '92071', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2067, '002067', '8-066', NULL, '0', NULL, NULL, NULL, '1200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2068, '002068', '1918', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2069, '002069', 'O0', NULL, '0', NULL, NULL, NULL, '750', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2070, '002070', 'O1', NULL, '0', NULL, NULL, NULL, '750', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2071, '002071', 'O2', NULL, '0', NULL, NULL, NULL, '750', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2072, '002072', 'O3', NULL, '0', NULL, NULL, NULL, '780', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2073, '002073', '1092', NULL, '0', NULL, NULL, NULL, '900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2074, '002074', 'O4', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2075, '002075', '9887', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2076, '002076', 'AS91', NULL, '0', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2077, '002077', 'PRINT', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2078, '002078', '1902-1', NULL, '0', NULL, NULL, NULL, '1050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2079, '002079', '1163-2', NULL, '0', NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2080, '002080', '993-1', NULL, '0', NULL, NULL, NULL, '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2081, '002081', 'D89', NULL, '0', NULL, NULL, NULL, '850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2082, '002082', 'IRON BORO', NULL, '0', NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2083, '002083', 'IRON MIDDLE', NULL, '0', NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2084, '002084', 'IRON LITTLE', NULL, '0', NULL, NULL, NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2085, '002085', 'SUNFLOWER BIG', NULL, '0', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2086, '002086', 'SUNFLOWERMIDDLE', NULL, '0', NULL, NULL, NULL, '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2087, '002087', 'SUNFLOWER SMALL', NULL, '0', NULL, NULL, NULL, '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2088, '002088', 'MULTI', NULL, '0', NULL, NULL, NULL, '40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2089, '002089', 'COLLAR', NULL, '0', NULL, NULL, NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2090, '002090', 'EARINGS Stand1', NULL, '0', NULL, NULL, NULL, '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2091, '002091', 'EARINGS Stand2', NULL, '0', NULL, NULL, NULL, '40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2092, '002092', 'CHAINA EARINGS', NULL, '0', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2093, '002093', '10E DOLL STAND  MAKMAL', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2094, '002094', 'Churi stand', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2095, '002095', 'CHURI STONE2', NULL, '0', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2096, '002096', 'DOLL MAKMALL', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2097, '002097', 'MALA CARD', NULL, '0', NULL, NULL, NULL, '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:08', NULL, NULL, NULL, NULL, NULL),
(2098, '002098', 'push', NULL, '0', NULL, NULL, NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:08', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2099, '002099', 'MULTI SMALL', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2100, '002100', 'bala box', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2101, '002101', 'IV', NULL, '0', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2102, '002102', 'earings stand', NULL, '0', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2103, '002103', '10E DOLL', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2104, '002104', 'shoe', NULL, '0', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2105, '002105', 'watch stand', NULL, '0', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, '100', '21', NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-02-24 08:59:49', NULL, NULL, NULL, NULL, NULL),
(2106, '002106', 'chunga boro', NULL, '0', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2107, '002107', 'doll small', NULL, '0', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2108, '002108', 'doll big', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2109, '002109', 'gum', NULL, '0', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2110, '002110', '8x8', NULL, '0', NULL, NULL, NULL, '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2111, '002111', 'lakme', NULL, '0', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2112, '002112', 'ring box', NULL, '0', NULL, NULL, NULL, '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2113, '002113', '13edoll', NULL, '0', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-02-24 08:59:49', NULL, NULL, NULL, NULL, NULL),
(2114, '002114', 'bicha2', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2115, '002115', 'boro katay', NULL, '0', NULL, NULL, NULL, '950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2116, '002116', 'rajisthan', NULL, '0', NULL, NULL, NULL, '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2117, '002117', 'bhagolpuri', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2118, '002118', 'slaf cotton', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2119, '002119', 'organja', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2120, '002120', 'shamo silk', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2121, '002121', 'tissue silk', NULL, '0', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2122, '002122', 'silk japan', NULL, '0', NULL, NULL, NULL, '42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2123, '002123', 'kashmiri', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2124, '002124', 'foel print', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2125, '002125', 'white chiken', NULL, '0', NULL, NULL, NULL, '280', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2126, '002126', 'chikon', NULL, '0', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2127, '002127', 'waitless', NULL, '0', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2128, '002128', 'alani', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2129, '002129', 'staright', NULL, '0', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2130, '002130', 'silk', NULL, '0', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2131, '002131', 'katan meter', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2132, '002132', 'katan', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2133, '002133', 'magic ball ', NULL, '0', NULL, NULL, NULL, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2134, '002134', 'diamond', NULL, '0', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2135, '002135', 'karina', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2136, '002136', 'bangoly', NULL, '0', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, 2, 25, 25, '2022-01-07 12:55:09', '2022-01-07 12:55:09', NULL, NULL, NULL, NULL, NULL),
(2137, '846656002179', 'Pran Cheera 250GM', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-12 10:13:00', '2022-01-12 10:13:00', NULL, NULL, NULL, NULL, NULL),
(2138, '831730005665', 'Pran Muri 500 gm', '', '65', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-12 10:20:39', '2022-01-12 10:20:39', NULL, NULL, NULL, NULL, NULL),
(2139, '831730005672', 'Pran Muri 250 gm', '', '35', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-12 10:21:22', '2022-01-12 10:21:22', NULL, NULL, NULL, NULL, NULL),
(2140, '840205717620', 'Pran Litchi Drinks', '', '10', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-12 10:42:54', '2022-01-12 10:42:54', NULL, NULL, NULL, NULL, NULL),
(2141, '8941100511916', 'Radhuni BBQ Masla ', '', '80', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-12 11:41:20', '2022-01-12 11:41:20', NULL, NULL, NULL, NULL, NULL),
(2142, '002142', 'Sandalina @ Rose Soap 100Ml', '', '40', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:01:49', '2022-01-16 07:01:49', NULL, NULL, NULL, NULL, NULL),
(2143, '8513692165459', 'Sandalina @ Rose Soap 150Ml', '', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:02:35', '2022-01-16 07:02:35', NULL, NULL, NULL, NULL, NULL),
(2144, '002144', 'Savlon Mild Soap Mini 10 Taka', '', '10', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:08:58', '2022-01-16 07:08:58', NULL, NULL, NULL, NULL, NULL),
(2145, '8941196243098', 'Savlon Mild Soap 75 GM', '', '42', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:11:50', '2022-01-16 07:11:50', NULL, NULL, NULL, NULL, NULL),
(2146, '8941196243104', 'Savlon Mild Soap 100 GM', '', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:12:57', '2022-01-16 07:12:57', NULL, NULL, NULL, NULL, NULL),
(2147, '8941196242176', 'Savlon aloe vera Hand Wash 200ML Refil', '', '60', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 07:36:30', '2022-01-16 07:36:30', NULL, NULL, NULL, NULL, NULL),
(2148, '8139003004844', 'Savlon aloe vera Hand Wash 250ML pum', '', '80', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 08:01:21', '2022-01-16 08:01:21', NULL, NULL, NULL, NULL, NULL),
(2149, '8941196242299', 'Savlon aloe vera Hand Wash 1L ', '', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 08:13:33', '2022-01-16 08:13:34', NULL, NULL, NULL, NULL, NULL),
(2150, '8941196242282', 'Savlon Active antiseptic Hand Wash 1L ', '', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 08:14:51', '2022-01-16 08:14:51', NULL, NULL, NULL, NULL, NULL),
(2151, '8941196246532', 'Septex Vita+ Antiseptic Bar 100GM', '', '32', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, 3, 26, 26, '2022-01-16 08:29:41', '2022-01-16 08:29:41', NULL, NULL, NULL, NULL, NULL),
(2152, '002152', 'test product', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 18, 112, 3, 26, 26, '2022-02-24 10:30:24', '2022-02-28 07:01:23', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `item_category_name`, `item_category_description`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'saree ', '', 1, 1, 1, '2021-09-05 08:02:14', '2021-11-08 17:46:54'),
(8, 'jewellery', '', 1, 1, 1, '2021-11-08 17:45:37', '2021-11-08 17:45:37'),
(10, 'bags', '', 1, 1, 1, '2021-11-08 17:58:35', '2021-11-08 17:58:35'),
(11, 'delhi boutique', '', 1, 1, 1, '2021-11-08 19:17:19', '2021-11-08 19:17:19'),
(12, 'delhi boutique', '', 1, 1, 1, '2021-11-08 19:17:42', '2021-11-08 19:17:42'),
(13, 'three piece', '', 1, 1, 1, '2021-11-08 19:20:05', '2021-11-08 19:20:05'),
(14, 'delhi cotton', '', 1, 1, 1, '2021-11-08 19:29:00', '2021-11-08 19:29:00'),
(18, 'Test Category', NULL, 2, 25, 25, '2021-12-12 05:48:31', '2022-01-07 12:55:07'),
(21, 'Lota', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(22, 'Transcom', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(23, 'Aarong Dairy Milk', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(24, 'Acme', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(25, 'ACI Consumer', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(26, 'Transcom Beverages', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(27, 'Godrej Consumer Products', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(28, 'Big Masala', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(29, 'M/S Loknath Vandar', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(30, 'Alach', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(31, 'Sajeeb', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(32, 'Ahmad', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(33, 'No Brand', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(34, 'Bread 20 taka', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(35, 'Vitalac Dairy & Food Industries Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(36, 'Aasian Food Products', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(37, 'Banoful Food', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(38, 'Bashundhara Food & Beverage', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(39, 'Bashundhara Paper Mills Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(40, 'M/S Rafique Traders', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(41, 'Bombay Sweets', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(42, 'Nestle Bangladesh Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(43, 'Square Toiletries', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(44, 'Pran Nice', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(45, 'Square Food & Beverage', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(46, 'Reedisha Food & Beverage Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(47, 'Chocolate Box 50 taka All', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(48, 'Johnson & Johnson', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(49, 'Uniliver Bangladesh Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(50, 'Globe Biscuit', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(51, 'Dabur Bangladesh Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(52, 'Danish Food Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(53, 'Arla Foods', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(54, 'Reckit Benkiser', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(55, 'Orion', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(56, 'Olympic Biscuit', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(57, 'Newzealand Dairy', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(58, 'Noor Poultry', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(59, 'Emami Bangladesh', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(60, 'Anfords Bangladesh Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:04', '2021-12-20 17:07:04'),
(61, 'Kohinoor Chemicals', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(62, 'Abul Khair', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(63, 'Meghna Group', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(64, 'Meghna Paper Mills Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(65, 'Loreal Bangladesh', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(66, 'RSPL Health BD Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(67, 'Proctor & Gamble', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(68, 'Glaxosmithkline', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(69, 'Yellowcare Ltd/Multibrands Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(70, 'M.M Ispahani', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(71, 'Regard Chemical', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(72, 'Sajeeb Corporation', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(73, 'Hemas Consumer', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(74, 'Pran Noodles Group', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(75, 'Mr. Jamal', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(76, 'Bangladesh Edible Oil Ltd', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(77, 'BEOL', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(78, 'IDC Bangladesh', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(79, 'Olympic Dry Cake 145 GM', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(80, 'M/S Nannu Traders', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(81, 'Marico Bangladesh Ltd.', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(82, 'Alam Soap', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(83, 'Pran Nice Group', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(84, 'M/S Haji Abdul Karim', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(85, 'Pran Spice Group', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(86, 'Pran Rice Group', NULL, 3, 26, 26, '2021-12-20 17:07:05', '2021-12-20 17:07:05'),
(87, 'Pran Sauce Group', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(88, 'Rashid Group', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(89, 'Hamdard Laboratories', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(90, 'Matador Toothbrush Industries', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(91, 'Savlon Antiseptic Disinfectant 56 ML', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(92, 'Sensodyne Rapid Relief TP 80GM', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(93, 'City Group', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(94, 'Teer Soyabean 500Ml', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(95, 'Tibbet Luxury Talcum Powder 100GM', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(96, 'Vim Powder 500 GM', NULL, 3, 26, 26, '2021-12-20 17:07:06', '2021-12-20 17:07:06'),
(97, 'Gift Shop', 'Gift Shop', 4, 27, 27, '2021-12-22 04:52:41', '2021-12-22 04:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `item_sub_category`
--

CREATE TABLE `item_sub_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_sub_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sub_category_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_sub_category`
--

INSERT INTO `item_sub_category` (`id`, `item_category_id`, `item_sub_category_name`, `item_sub_category_description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sub Cat-01', '', 1, 1, '2021-09-05 08:02:25', '2021-09-05 08:02:25'),
(107, 10, 'bags', '', 1, 1, '2021-11-08 18:00:03', '2021-11-08 18:00:03'),
(108, 8, 'jewellery', '', 1, 1, '2021-11-08 18:05:29', '2021-11-08 18:05:29'),
(112, 18, 'Test Sub category', NULL, 1, 1, '2021-12-12 05:48:31', '2021-12-12 05:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit_credit` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_name_id` int(10) UNSIGNED NOT NULL,
  `jurnal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `journal_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `income_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_receives_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_receives_entries_id` int(10) UNSIGNED DEFAULT NULL,
  `credit_note_id` int(10) UNSIGNED DEFAULT NULL,
  `credit_note_refunds_id` int(10) UNSIGNED DEFAULT NULL,
  `expense_id` int(10) UNSIGNED DEFAULT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `bill_entry_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_made_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_made_entry_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `pr_adjustment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `salesComission_id` int(10) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `vendor_credit_id` int(10) UNSIGNED DEFAULT NULL,
  `vendor_credit_refunds_id` int(10) UNSIGNED DEFAULT NULL,
  `recurring_invoice_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `note`, `debit_credit`, `amount`, `account_name_id`, `jurnal_type`, `journal_id`, `invoice_id`, `income_id`, `payment_receives_id`, `payment_receives_entries_id`, `credit_note_id`, `credit_note_refunds_id`, `expense_id`, `bill_id`, `bank_id`, `bill_entry_id`, `payment_made_id`, `payment_made_entry_id`, `contact_id`, `tax_id`, `pr_adjustment_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `assign_date`, `salesComission_id`, `agent_id`, `vendor_credit_id`, `vendor_credit_refunds_id`, `recurring_invoice_id`) VALUES
(8, 'Qui quis exercitatio', 1, 807994.5, 5, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(9, 'Qui quis exercitatio', 1, 5, 21, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(10, 'Qui quis exercitatio', 0, 73449.5, 9, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(11, 'Qui quis exercitatio', 0, 50, 20, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(12, 'Qui quis exercitatio', 0, 100, 18, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(13, 'Qui quis exercitatio', 0, 734400, 9, 'invoice', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 11:31:45', '2021-11-15 11:31:45', '1975-01-15', NULL, NULL, NULL, NULL, NULL),
(32, '', 1, 300, 5, 'invoice', NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 12:24:44', '2021-11-15 12:24:44', '2021-11-15', NULL, NULL, NULL, NULL, NULL),
(33, '', 0, 300, 16, 'invoice', NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 12:24:44', '2021-11-15 12:24:44', '2021-11-15', NULL, NULL, NULL, NULL, NULL),
(34, '', 1, 300, 5, 'invoice', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 12:25:23', '2021-11-15 12:25:23', '2021-11-15', NULL, NULL, NULL, NULL, NULL),
(35, '', 0, 300, 16, 'invoice', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-15 12:25:23', '2021-11-15 12:25:23', '2021-11-15', NULL, NULL, NULL, NULL, NULL),
(40, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(41, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(42, NULL, 0, 0, 5, 'payment_receive1', NULL, 2, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(43, NULL, 1, 0, 10, 'payment_receive1', NULL, 2, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(44, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(45, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(46, NULL, 0, 0, 5, 'payment_receive1', NULL, 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(47, NULL, 1, 0, 10, 'payment_receive1', NULL, 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(48, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(49, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(50, NULL, 0, 0, 5, 'payment_receive1', NULL, 7, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(51, NULL, 1, 0, 10, 'payment_receive1', NULL, 7, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(52, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(53, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(54, NULL, 0, 0, 5, 'payment_receive1', NULL, 7, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(55, NULL, 1, 0, 10, 'payment_receive1', NULL, 7, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(56, NULL, 1, 10, 3, 'payment_receive2', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(57, NULL, 0, 10, 10, 'payment_receive2', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(58, NULL, 0, 10, 5, 'payment_receive1', NULL, 7, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(59, NULL, 1, 10, 10, 'payment_receive1', NULL, 7, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(60, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(61, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(62, NULL, 0, 0, 5, 'payment_receive1', NULL, 7, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(63, NULL, 1, 0, 10, 'payment_receive1', NULL, 7, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(64, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(65, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(66, NULL, 0, 0, 5, 'payment_receive1', NULL, 8, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(67, NULL, 1, 0, 10, 'payment_receive1', NULL, 8, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(72, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(73, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(74, NULL, 0, 0, 5, 'payment_receive1', NULL, 8, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(75, NULL, 1, 0, 10, 'payment_receive1', NULL, 8, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(76, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(77, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(78, NULL, 0, 0, 5, 'payment_receive1', NULL, 2, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(79, NULL, 1, 0, 10, 'payment_receive1', NULL, 2, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(80, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(81, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(82, NULL, 0, 0, 5, 'payment_receive1', NULL, 7, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(83, NULL, 1, 0, 10, 'payment_receive1', NULL, 7, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(84, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(85, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(86, NULL, 0, 0, 5, 'payment_receive1', NULL, 2, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(87, NULL, 1, 0, 10, 'payment_receive1', NULL, 2, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(88, NULL, 1, 10, 3, 'payment_receive2', NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(89, NULL, 0, 10, 10, 'payment_receive2', NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(90, NULL, 0, 10, 5, 'payment_receive1', NULL, 2, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(91, NULL, 1, 10, 10, 'payment_receive1', NULL, 2, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(92, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(93, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(94, NULL, 0, 0, 5, 'payment_receive1', NULL, 2, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(95, NULL, 1, 0, 10, 'payment_receive1', NULL, 2, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(96, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(97, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(98, NULL, 0, 0, 5, 'payment_receive1', NULL, 7, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(99, NULL, 1, 0, 10, 'payment_receive1', NULL, 7, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57', '2021-11-16', NULL, NULL, NULL, NULL, NULL),
(134, '', 0, 120, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:29:35', '2021-11-20 10:29:53', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(135, '', 1, 120, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:29:35', '2021-11-20 10:29:53', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(136, '', 0, 120, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:29:18', '2021-11-20 10:30:02', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(137, '', 1, 120, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:29:18', '2021-11-20 10:30:02', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(142, NULL, 1, 30, 11, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:35:52', '2021-11-20 10:35:52', '2021-11-01', NULL, NULL, 1, NULL, NULL),
(143, NULL, 0, 30, 26, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:35:53', '2021-11-20 10:35:53', '2021-11-01', NULL, NULL, 1, NULL, NULL),
(144, NULL, 1, 30, 11, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:36:07', '2021-11-20 10:36:07', '2021-11-20', NULL, NULL, 2, NULL, NULL),
(145, NULL, 0, 30, 26, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:36:07', '2021-11-20 10:36:07', '2021-11-20', NULL, NULL, 2, NULL, NULL),
(150, ' ', 1, 60, 5, 'invoice', NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:37:56', '2021-11-20 10:37:56', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(151, ' ', 0, 60, 16, 'invoice', NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:37:56', '2021-11-20 10:37:56', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(152, ' ', 1, 60, 5, 'invoice', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:38:07', '2021-11-20 10:38:07', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(153, ' ', 0, 60, 16, 'invoice', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:38:07', '2021-11-20 10:38:07', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(158, ' ', 1, 30, 5, 'invoice', NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:49:10', '2021-11-20 10:49:10', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(159, ' ', 0, 30, 16, 'invoice', NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:49:10', '2021-11-20 10:49:10', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(160, ' ', 1, 30, 5, 'invoice', NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:49:20', '2021-11-20 10:49:20', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(161, ' ', 0, 30, 16, 'invoice', NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:49:20', '2021-11-20 10:49:20', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(166, NULL, 0, 20, 5, '11', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:52:28', '2021-11-20 10:52:28', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(167, NULL, 1, 20, 16, '11', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:52:28', '2021-11-20 10:52:28', '2021-11-20', NULL, NULL, NULL, NULL, NULL),
(168, NULL, 0, 20, 5, '11', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:52:38', '2021-11-20 10:52:38', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(169, NULL, 1, 20, 16, '11', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-11-20 10:52:38', '2021-11-20 10:52:38', '2021-11-01', NULL, NULL, NULL, NULL, NULL),
(170, '', 1, 500, 5, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(171, '', 1, 40, 21, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(172, '', 0, 60, 9, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(173, '', 0, 40, 20, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(174, '', 0, 40, 18, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(175, '', 0, 400, 16, 'invoice', NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(176, NULL, 1, 100, 3, 'payment_receive2', NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(177, NULL, 0, 100, 10, 'payment_receive2', NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(178, NULL, 0, 100, 5, 'payment_receive1', NULL, 15, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(179, NULL, 1, 100, 10, 'payment_receive1', NULL, 15, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', '2021-12-06', NULL, NULL, NULL, NULL, NULL),
(180, NULL, 0, 300, 1, 'invoice', NULL, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:13:14', '2021-12-08 07:13:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(181, NULL, 1, 2215, 5, 'invoice', NULL, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:13:14', '2021-12-08 07:13:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(182, NULL, 0, 300, 1, 'invoice', NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(183, NULL, 1, 2215, 5, 'invoice', NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(184, NULL, 0, 300, 1, 'invoice', NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(185, NULL, 1, 2215, 5, 'invoice', NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(186, NULL, 1, 100, 5, 'payment_receive2', NULL, NULL, NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(187, NULL, 0, 100, 10, 'payment_receive2', NULL, NULL, NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(188, NULL, 0, NULL, 5, 'payment_receive1', NULL, 23, NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(189, NULL, 1, NULL, 10, 'payment_receive1', NULL, 23, NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', NULL, NULL, NULL, NULL, NULL, NULL),
(190, NULL, 1, 10, 5, 'payment_receive2', NULL, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(191, NULL, 0, 10, 10, 'payment_receive2', NULL, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(192, NULL, 0, NULL, 5, 'payment_receive1', NULL, 23, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(193, NULL, 1, NULL, 10, 'payment_receive1', NULL, 23, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', NULL, NULL, NULL, NULL, NULL, NULL),
(194, NULL, 1, 300, 5, 'payment_receive2', NULL, NULL, NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(195, NULL, 0, 300, 10, 'payment_receive2', NULL, NULL, NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(196, NULL, 0, NULL, 5, 'payment_receive1', NULL, 23, NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(197, NULL, 1, NULL, 10, 'payment_receive1', NULL, 23, NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18', NULL, NULL, NULL, NULL, NULL, NULL),
(198, NULL, 0, 300, 16, 'invoice', NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:23', '2021-12-08 12:42:23', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(199, NULL, 1, 500, 5, 'invoice', NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:23', '2021-12-08 12:42:23', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(200, NULL, 0, 300, 16, 'invoice', NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:53', '2021-12-08 12:42:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(201, NULL, 1, 500, 5, 'invoice', NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(202, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(203, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(204, NULL, 0, 20, 5, 'payment_receive1', NULL, 25, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(205, NULL, 1, 20, 10, 'payment_receive1', NULL, 25, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', NULL, NULL, NULL, NULL, NULL, NULL),
(206, NULL, 1, 30, 4, 'payment_receive2', NULL, NULL, NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(207, NULL, 0, 30, 10, 'payment_receive2', NULL, NULL, NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(208, NULL, 0, 30, 5, 'payment_receive1', NULL, 25, NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(209, NULL, 1, 30, 10, 'payment_receive1', NULL, 25, NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', NULL, NULL, NULL, NULL, NULL, NULL),
(210, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(211, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(212, NULL, 0, 50, 5, 'payment_receive1', NULL, 25, NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(213, NULL, 1, 50, 10, 'payment_receive1', NULL, 25, NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', NULL, NULL, NULL, NULL, NULL, NULL),
(214, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(215, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:55', '2021-12-08 12:42:55', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(216, NULL, 0, 0, 5, 'payment_receive1', NULL, 25, NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:55', '2021-12-08 12:42:55', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(217, NULL, 1, 0, 10, 'payment_receive1', NULL, 25, NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:42:55', '2021-12-08 12:42:55', NULL, NULL, NULL, NULL, NULL, NULL),
(218, NULL, 0, 300, 16, 'invoice', NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(219, NULL, 1, 500, 5, 'invoice', NULL, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(220, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(221, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(222, NULL, 0, 20, 5, 'payment_receive1', NULL, 26, NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(223, NULL, 1, 20, 10, 'payment_receive1', NULL, 26, NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', NULL, NULL, NULL, NULL, NULL, NULL),
(224, NULL, 1, 30, 4, 'payment_receive2', NULL, NULL, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(225, NULL, 0, 30, 10, 'payment_receive2', NULL, NULL, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(226, NULL, 0, 30, 5, 'payment_receive1', NULL, 26, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(227, NULL, 1, 30, 10, 'payment_receive1', NULL, 26, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', NULL, NULL, NULL, NULL, NULL, NULL),
(228, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(229, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(230, NULL, 0, 50, 5, 'payment_receive1', NULL, 26, NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(231, NULL, 1, 50, 10, 'payment_receive1', NULL, 26, NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', NULL, NULL, NULL, NULL, NULL, NULL),
(232, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:54', '2021-12-08 12:47:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(233, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:54', '2021-12-08 12:47:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(234, NULL, 0, 0, 5, 'payment_receive1', NULL, 26, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:54', '2021-12-08 12:47:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(235, NULL, 1, 0, 10, 'payment_receive1', NULL, 26, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:47:54', '2021-12-08 12:47:54', NULL, NULL, NULL, NULL, NULL, NULL),
(236, NULL, 0, 300, 16, 'invoice', NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(237, NULL, 1, 460, 5, 'invoice', NULL, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(238, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(239, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(240, NULL, 0, 20, 5, 'payment_receive1', NULL, 27, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(241, NULL, 1, 20, 10, 'payment_receive1', NULL, 27, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', NULL, NULL, NULL, NULL, NULL, NULL),
(242, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(243, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(244, NULL, 0, 40, 5, 'payment_receive1', NULL, 27, NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(245, NULL, 1, 40, 10, 'payment_receive1', NULL, 27, NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', NULL, NULL, NULL, NULL, NULL, NULL),
(246, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(247, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(248, NULL, 0, 50, 5, 'payment_receive1', NULL, 27, NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(249, NULL, 1, 50, 10, 'payment_receive1', NULL, 27, NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', NULL, NULL, NULL, NULL, NULL, NULL),
(250, NULL, 0, 300, 16, 'invoice', NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(251, NULL, 1, 460, 5, 'invoice', NULL, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(252, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(253, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(254, NULL, 0, 20, 5, 'payment_receive1', NULL, 28, NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(255, NULL, 1, 20, 10, 'payment_receive1', NULL, 28, NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', NULL, NULL, NULL, NULL, NULL, NULL),
(256, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(257, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(258, NULL, 0, 40, 5, 'payment_receive1', NULL, 28, NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(259, NULL, 1, 40, 10, 'payment_receive1', NULL, 28, NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', NULL, NULL, NULL, NULL, NULL, NULL),
(260, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(261, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(262, NULL, 0, 50, 5, 'payment_receive1', NULL, 28, NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(263, NULL, 1, 50, 10, 'payment_receive1', NULL, 28, NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', NULL, NULL, NULL, NULL, NULL, NULL),
(264, NULL, 0, 300, 16, 'invoice', NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(265, NULL, 1, 460, 5, 'invoice', NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(266, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(267, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(268, NULL, 0, 20, 5, 'payment_receive1', NULL, 29, NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(269, NULL, 1, 20, 10, 'payment_receive1', NULL, 29, NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', NULL, NULL, NULL, NULL, NULL, NULL),
(270, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(271, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(272, NULL, 0, 40, 5, 'payment_receive1', NULL, 29, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(273, NULL, 1, 40, 10, 'payment_receive1', NULL, 29, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', NULL, NULL, NULL, NULL, NULL, NULL),
(274, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(275, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:05', '2021-12-08 12:53:05', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(276, NULL, 0, 50, 5, 'payment_receive1', NULL, 29, NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:05', '2021-12-08 12:53:05', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(277, NULL, 1, 50, 10, 'payment_receive1', NULL, 29, NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:53:05', '2021-12-08 12:53:05', NULL, NULL, NULL, NULL, NULL, NULL),
(278, NULL, 0, 300, 16, 'invoice', NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(279, NULL, 1, 460, 5, 'invoice', NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(280, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(281, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(282, NULL, 0, 20, 5, 'payment_receive1', NULL, 30, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(283, NULL, 1, 20, 10, 'payment_receive1', NULL, 30, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', NULL, NULL, NULL, NULL, NULL, NULL),
(284, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(285, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(286, NULL, 0, 40, 5, 'payment_receive1', NULL, 30, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(287, NULL, 1, 40, 10, 'payment_receive1', NULL, 30, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', NULL, NULL, NULL, NULL, NULL, NULL),
(288, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(289, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(290, NULL, 0, 50, 5, 'payment_receive1', NULL, 30, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(291, NULL, 1, 50, 10, 'payment_receive1', NULL, 30, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', NULL, NULL, NULL, NULL, NULL, NULL),
(292, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(293, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(294, NULL, 0, 0, 5, 'payment_receive1', NULL, 30, NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(295, NULL, 1, 0, 10, 'payment_receive1', NULL, 30, NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', NULL, NULL, NULL, NULL, NULL, NULL),
(296, NULL, 0, 300, 16, 'invoice', NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(297, NULL, 1, 460, 5, 'invoice', NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(298, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(299, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(300, NULL, 0, 20, 5, 'payment_receive1', NULL, 31, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(301, NULL, 1, 20, 10, 'payment_receive1', NULL, 31, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', NULL, NULL, NULL, NULL, NULL, NULL),
(302, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(303, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `journal_entries` (`id`, `note`, `debit_credit`, `amount`, `account_name_id`, `jurnal_type`, `journal_id`, `invoice_id`, `income_id`, `payment_receives_id`, `payment_receives_entries_id`, `credit_note_id`, `credit_note_refunds_id`, `expense_id`, `bill_id`, `bank_id`, `bill_entry_id`, `payment_made_id`, `payment_made_entry_id`, `contact_id`, `tax_id`, `pr_adjustment_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `assign_date`, `salesComission_id`, `agent_id`, `vendor_credit_id`, `vendor_credit_refunds_id`, `recurring_invoice_id`) VALUES
(304, NULL, 0, 40, 5, 'payment_receive1', NULL, 31, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(305, NULL, 1, 40, 10, 'payment_receive1', NULL, 31, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', NULL, NULL, NULL, NULL, NULL, NULL),
(306, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(307, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(308, NULL, 0, 50, 5, 'payment_receive1', NULL, 31, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(309, NULL, 1, 50, 10, 'payment_receive1', NULL, 31, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', NULL, NULL, NULL, NULL, NULL, NULL),
(310, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(311, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(312, NULL, 0, 0, 5, 'payment_receive1', NULL, 31, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:38', '2021-12-08 13:06:38', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(313, NULL, 1, 0, 10, 'payment_receive1', NULL, 31, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:38', '2021-12-08 13:06:38', NULL, NULL, NULL, NULL, NULL, NULL),
(314, NULL, 0, 300, 16, 'invoice', NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(315, NULL, 1, 460, 5, 'invoice', NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(316, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(317, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(318, NULL, 0, 20, 5, 'payment_receive1', NULL, 32, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(319, NULL, 1, 20, 10, 'payment_receive1', NULL, 32, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', NULL, NULL, NULL, NULL, NULL, NULL),
(320, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(321, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(322, NULL, 0, 40, 5, 'payment_receive1', NULL, 32, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(323, NULL, 1, 40, 10, 'payment_receive1', NULL, 32, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', NULL, NULL, NULL, NULL, NULL, NULL),
(324, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(325, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(326, NULL, 0, 50, 5, 'payment_receive1', NULL, 32, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(327, NULL, 1, 50, 10, 'payment_receive1', NULL, 32, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', NULL, NULL, NULL, NULL, NULL, NULL),
(328, NULL, 0, 300, 16, 'invoice', NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(329, NULL, 1, 460, 5, 'invoice', NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(330, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(331, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(332, NULL, 0, 20, 5, 'payment_receive1', NULL, 33, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(333, NULL, 1, 20, 10, 'payment_receive1', NULL, 33, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', NULL, NULL, NULL, NULL, NULL, NULL),
(334, NULL, 1, 40, 4, 'payment_receive2', NULL, NULL, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(335, NULL, 0, 40, 10, 'payment_receive2', NULL, NULL, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(336, NULL, 0, 40, 5, 'payment_receive1', NULL, 33, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(337, NULL, 1, 40, 10, 'payment_receive1', NULL, 33, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', NULL, NULL, NULL, NULL, NULL, NULL),
(338, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(339, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(340, NULL, 0, 50, 5, 'payment_receive1', NULL, 33, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(341, NULL, 1, 50, 10, 'payment_receive1', NULL, 33, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', NULL, NULL, NULL, NULL, NULL, NULL),
(342, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:55', '2021-12-08 13:06:55', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(343, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:55', '2021-12-08 13:06:55', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(344, NULL, 0, 0, 5, 'payment_receive1', NULL, 33, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:55', '2021-12-08 13:06:55', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(345, NULL, 1, 0, 10, 'payment_receive1', NULL, 33, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:06:55', '2021-12-08 13:06:55', NULL, NULL, NULL, NULL, NULL, NULL),
(346, NULL, 0, 300, 16, 'invoice', NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(347, NULL, 1, 380, 5, 'invoice', NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(348, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(349, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(350, NULL, 0, 20, 5, 'payment_receive1', NULL, 34, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(351, NULL, 1, 20, 10, 'payment_receive1', NULL, 34, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', NULL, NULL, NULL, NULL, NULL, NULL),
(352, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(353, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(354, NULL, 0, 50, 5, 'payment_receive1', NULL, 34, NULL, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(355, NULL, 1, 50, 10, 'payment_receive1', NULL, 34, NULL, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', NULL, NULL, NULL, NULL, NULL, NULL),
(356, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(357, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(358, NULL, 0, 60, 5, 'payment_receive1', NULL, 34, NULL, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(359, NULL, 1, 60, 10, 'payment_receive1', NULL, 34, NULL, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', NULL, NULL, NULL, NULL, NULL, NULL),
(360, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(361, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(362, NULL, 0, 0, 5, 'payment_receive1', NULL, 34, NULL, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(363, NULL, 1, 0, 10, 'payment_receive1', NULL, 34, NULL, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', NULL, NULL, NULL, NULL, NULL, NULL),
(364, NULL, 0, 300, 16, 'invoice', NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(365, NULL, 1, 380, 5, 'invoice', NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(366, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(367, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(368, NULL, 0, 20, 5, 'payment_receive1', NULL, 35, NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(369, NULL, 1, 20, 10, 'payment_receive1', NULL, 35, NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', NULL, NULL, NULL, NULL, NULL, NULL),
(370, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(371, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(372, NULL, 0, 50, 5, 'payment_receive1', NULL, 35, NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(373, NULL, 1, 50, 10, 'payment_receive1', NULL, 35, NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', NULL, NULL, NULL, NULL, NULL, NULL),
(374, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(375, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(376, NULL, 0, 60, 5, 'payment_receive1', NULL, 35, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(377, NULL, 1, 60, 10, 'payment_receive1', NULL, 35, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', NULL, NULL, NULL, NULL, NULL, NULL),
(378, NULL, 0, 300, 16, 'invoice', NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(379, NULL, 1, 380, 5, 'invoice', NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(380, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(381, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(382, NULL, 0, 20, 5, 'payment_receive1', NULL, 36, NULL, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(383, NULL, 1, 20, 10, 'payment_receive1', NULL, 36, NULL, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', NULL, NULL, NULL, NULL, NULL, NULL),
(384, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(385, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(386, NULL, 0, 50, 5, 'payment_receive1', NULL, 36, NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(387, NULL, 1, 50, 10, 'payment_receive1', NULL, 36, NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', NULL, NULL, NULL, NULL, NULL, NULL),
(388, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(389, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(390, NULL, 0, 60, 5, 'payment_receive1', NULL, 36, NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(391, NULL, 1, 60, 10, 'payment_receive1', NULL, 36, NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', NULL, NULL, NULL, NULL, NULL, NULL),
(392, NULL, 0, 300, 16, 'invoice', NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(393, NULL, 1, 380, 5, 'invoice', NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(394, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(395, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(396, NULL, 0, 20, 5, 'payment_receive1', NULL, 37, NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(397, NULL, 1, 20, 10, 'payment_receive1', NULL, 37, NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', NULL, NULL, NULL, NULL, NULL, NULL),
(398, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(399, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(400, NULL, 0, 50, 5, 'payment_receive1', NULL, 37, NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(401, NULL, 1, 50, 10, 'payment_receive1', NULL, 37, NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', NULL, NULL, NULL, NULL, NULL, NULL),
(402, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(403, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(404, NULL, 0, 60, 5, 'payment_receive1', NULL, 37, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(405, NULL, 1, 60, 10, 'payment_receive1', NULL, 37, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', NULL, NULL, NULL, NULL, NULL, NULL),
(406, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:47', '2021-12-08 13:51:47', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(407, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:47', '2021-12-08 13:51:47', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(408, NULL, 0, 0, 5, 'payment_receive1', NULL, 37, NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:47', '2021-12-08 13:51:47', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(409, NULL, 1, 0, 10, 'payment_receive1', NULL, 37, NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:51:47', '2021-12-08 13:51:47', NULL, NULL, NULL, NULL, NULL, NULL),
(410, NULL, 0, 300, 16, 'invoice', NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(411, NULL, 1, 380, 5, 'invoice', NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(412, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(413, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(414, NULL, 0, 20, 5, 'payment_receive1', NULL, 38, NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(415, NULL, 1, 20, 10, 'payment_receive1', NULL, 38, NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', NULL, NULL, NULL, NULL, NULL, NULL),
(416, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(417, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(418, NULL, 0, 50, 5, 'payment_receive1', NULL, 38, NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(419, NULL, 1, 50, 10, 'payment_receive1', NULL, 38, NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', NULL, NULL, NULL, NULL, NULL, NULL),
(420, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(421, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(422, NULL, 0, 60, 5, 'payment_receive1', NULL, 38, NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(423, NULL, 1, 60, 10, 'payment_receive1', NULL, 38, NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', NULL, NULL, NULL, NULL, NULL, NULL),
(424, NULL, 0, 300, 16, 'invoice', NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(425, NULL, 1, 380, 5, 'invoice', NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(426, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(427, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(428, NULL, 0, 20, 5, 'payment_receive1', NULL, 39, NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(429, NULL, 1, 20, 10, 'payment_receive1', NULL, 39, NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', NULL, NULL, NULL, NULL, NULL, NULL),
(430, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(431, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(432, NULL, 0, 50, 5, 'payment_receive1', NULL, 39, NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(433, NULL, 1, 50, 10, 'payment_receive1', NULL, 39, NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', NULL, NULL, NULL, NULL, NULL, NULL),
(434, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(435, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(436, NULL, 0, 60, 5, 'payment_receive1', NULL, 39, NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(437, NULL, 1, 60, 10, 'payment_receive1', NULL, 39, NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', NULL, NULL, NULL, NULL, NULL, NULL),
(438, NULL, 0, 300, 16, 'invoice', NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(439, NULL, 1, 380, 5, 'invoice', NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(440, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(441, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(442, NULL, 0, 20, 5, 'payment_receive1', NULL, 40, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(443, NULL, 1, 20, 10, 'payment_receive1', NULL, 40, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', NULL, NULL, NULL, NULL, NULL, NULL),
(444, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(445, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(446, NULL, 0, 50, 5, 'payment_receive1', NULL, 40, NULL, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(447, NULL, 1, 50, 10, 'payment_receive1', NULL, 40, NULL, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', NULL, NULL, NULL, NULL, NULL, NULL),
(448, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(449, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(450, NULL, 0, 60, 5, 'payment_receive1', NULL, 40, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(451, NULL, 1, 60, 10, 'payment_receive1', NULL, 40, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', NULL, NULL, NULL, NULL, NULL, NULL),
(452, NULL, 0, 300, 16, 'invoice', NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(453, NULL, 1, 380, 5, 'invoice', NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(454, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(455, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(456, NULL, 0, 20, 5, 'payment_receive1', NULL, 41, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(457, NULL, 1, 20, 10, 'payment_receive1', NULL, 41, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', NULL, NULL, NULL, NULL, NULL, NULL),
(458, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(459, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(460, NULL, 0, 50, 5, 'payment_receive1', NULL, 41, NULL, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(461, NULL, 1, 50, 10, 'payment_receive1', NULL, 41, NULL, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', NULL, NULL, NULL, NULL, NULL, NULL),
(462, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(463, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(464, NULL, 0, 60, 5, 'payment_receive1', NULL, 41, NULL, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(465, NULL, 1, 60, 10, 'payment_receive1', NULL, 41, NULL, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', NULL, NULL, NULL, NULL, NULL, NULL),
(466, NULL, 0, 300, 16, 'invoice', NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(467, NULL, 1, 380, 5, 'invoice', NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(468, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(469, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(470, NULL, 0, 20, 5, 'payment_receive1', NULL, 42, NULL, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(471, NULL, 1, 20, 10, 'payment_receive1', NULL, 42, NULL, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', NULL, NULL, NULL, NULL, NULL, NULL),
(472, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(473, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(474, NULL, 0, 50, 5, 'payment_receive1', NULL, 42, NULL, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(475, NULL, 1, 50, 10, 'payment_receive1', NULL, 42, NULL, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', NULL, NULL, NULL, NULL, NULL, NULL),
(476, NULL, 1, 60, 103, 'payment_receive2', NULL, NULL, NULL, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(477, NULL, 0, 60, 10, 'payment_receive2', NULL, NULL, NULL, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(478, NULL, 0, 60, 5, 'payment_receive1', NULL, 42, NULL, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23', '2021-12-08', NULL, NULL, NULL, NULL, NULL),
(479, NULL, 1, 60, 10, 'payment_receive1', NULL, 42, NULL, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23', NULL, NULL, NULL, NULL, NULL, NULL),
(480, NULL, 0, 300, 16, 'invoice', NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(481, NULL, 1, 700, 5, 'invoice', NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(482, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(483, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(484, NULL, 0, 20, 5, 'payment_receive1', NULL, 43, NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(485, NULL, 1, 20, 10, 'payment_receive1', NULL, 43, NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', NULL, NULL, NULL, NULL, NULL, NULL),
(486, NULL, 1, 30, 4, 'payment_receive2', NULL, NULL, NULL, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(487, NULL, 0, 30, 10, 'payment_receive2', NULL, NULL, NULL, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(488, NULL, 0, 30, 5, 'payment_receive1', NULL, 43, NULL, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(489, NULL, 1, 30, 10, 'payment_receive1', NULL, 43, NULL, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', NULL, NULL, NULL, NULL, NULL, NULL),
(490, NULL, 1, 50, 103, 'payment_receive2', NULL, NULL, NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(491, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(492, NULL, 0, 50, 5, 'payment_receive1', NULL, 43, NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(493, NULL, 1, 50, 10, 'payment_receive1', NULL, 43, NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', NULL, NULL, NULL, NULL, NULL, NULL),
(494, NULL, 1, 20, 104, 'payment_receive2', NULL, NULL, NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(495, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(496, NULL, 0, 20, 5, 'payment_receive1', NULL, 43, NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(497, NULL, 1, 20, 10, 'payment_receive1', NULL, 43, NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', NULL, NULL, NULL, NULL, NULL, NULL),
(498, NULL, 1, 0, 3, 'payment_receive2', NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(499, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(500, NULL, 0, 0, 5, 'payment_receive1', NULL, 43, NULL, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(501, NULL, 1, 0, 10, 'payment_receive1', NULL, 43, NULL, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', NULL, NULL, NULL, NULL, NULL, NULL),
(502, NULL, 0, 300, 16, 'invoice', NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(503, NULL, 1, 350, 5, 'invoice', NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(504, NULL, 1, 50, 3, 'payment_receive2', NULL, NULL, NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(505, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(506, NULL, 0, 50, 5, 'payment_receive1', NULL, 44, NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(507, NULL, 1, 50, 10, 'payment_receive1', NULL, 44, NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', NULL, NULL, NULL, NULL, NULL, NULL),
(508, NULL, 1, 80, 4, 'payment_receive2', NULL, NULL, NULL, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(509, NULL, 0, 80, 10, 'payment_receive2', NULL, NULL, NULL, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(510, NULL, 0, 80, 5, 'payment_receive1', NULL, 44, NULL, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(511, NULL, 1, 80, 10, 'payment_receive1', NULL, 44, NULL, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', NULL, NULL, NULL, NULL, NULL, NULL),
(512, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(513, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(514, NULL, 0, 0, 5, 'payment_receive1', NULL, 44, NULL, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(515, NULL, 1, 0, 10, 'payment_receive1', NULL, 44, NULL, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', NULL, NULL, NULL, NULL, NULL, NULL),
(516, NULL, 0, 1800, 16, 'invoice', NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(517, NULL, 1, 2180, 5, 'invoice', NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(518, NULL, 1, 50, 3, 'payment_receive2', NULL, NULL, NULL, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(519, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(520, NULL, 0, 50, 5, 'payment_receive1', NULL, 45, NULL, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(521, NULL, 1, 50, 10, 'payment_receive1', NULL, 45, NULL, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', NULL, NULL, NULL, NULL, NULL, NULL),
(522, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `journal_entries` (`id`, `note`, `debit_credit`, `amount`, `account_name_id`, `jurnal_type`, `journal_id`, `invoice_id`, `income_id`, `payment_receives_id`, `payment_receives_entries_id`, `credit_note_id`, `credit_note_refunds_id`, `expense_id`, `bill_id`, `bank_id`, `bill_entry_id`, `payment_made_id`, `payment_made_entry_id`, `contact_id`, `tax_id`, `pr_adjustment_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `assign_date`, `salesComission_id`, `agent_id`, `vendor_credit_id`, `vendor_credit_refunds_id`, `recurring_invoice_id`) VALUES
(523, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(524, NULL, 0, 50, 5, 'payment_receive1', NULL, 45, NULL, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(525, NULL, 1, 50, 10, 'payment_receive1', NULL, 45, NULL, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', NULL, NULL, NULL, NULL, NULL, NULL),
(526, NULL, 1, 80, 4, 'payment_receive2', NULL, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(527, NULL, 0, 80, 10, 'payment_receive2', NULL, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(528, NULL, 0, 80, 5, 'payment_receive1', NULL, 45, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(529, NULL, 1, 80, 10, 'payment_receive1', NULL, 45, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', NULL, NULL, NULL, NULL, NULL, NULL),
(530, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(531, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(532, NULL, 0, 0, 5, 'payment_receive1', NULL, 45, NULL, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:47', '2021-12-09 05:37:47', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(533, NULL, 1, 0, 10, 'payment_receive1', NULL, 45, NULL, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:37:47', '2021-12-09 05:37:47', NULL, NULL, NULL, NULL, NULL, NULL),
(534, NULL, 0, 20, 16, 'invoice', NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(535, NULL, 1, 30, 5, 'invoice', NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(536, NULL, 0, NULL, 9, 'invoice', NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(537, NULL, 0, 3, 20, 'invoice', NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(538, NULL, 1, 2, 18, 'invoice', NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(539, NULL, 1, 0, 4, 'payment_receive2', NULL, NULL, NULL, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(540, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(541, NULL, 0, 0, 5, 'payment_receive1', NULL, 46, NULL, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(542, NULL, 1, 0, 10, 'payment_receive1', NULL, 46, NULL, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', NULL, NULL, NULL, NULL, NULL, NULL),
(543, NULL, 0, 1700, 16, 'invoice', NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(544, NULL, 1, 2050, 5, 'invoice', NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(545, NULL, 0, NULL, 9, 'invoice', NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(546, NULL, 0, 50, 20, 'invoice', NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(547, NULL, 1, 170, 18, 'invoice', NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(548, NULL, 1, 50, 3, 'payment_receive2', NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(549, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(550, NULL, 0, 50, 5, 'payment_receive1', NULL, 47, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(551, NULL, 1, 50, 10, 'payment_receive1', NULL, 47, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL, NULL, NULL, NULL),
(552, NULL, 1, 500, 4, 'payment_receive2', NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(553, NULL, 0, 500, 10, 'payment_receive2', NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(554, NULL, 0, 500, 5, 'payment_receive1', NULL, 47, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(555, NULL, 1, 500, 10, 'payment_receive1', NULL, 47, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL, NULL, NULL, NULL),
(556, NULL, 1, 1000, 103, 'payment_receive2', NULL, NULL, NULL, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(557, NULL, 0, 1000, 10, 'payment_receive2', NULL, NULL, NULL, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(558, NULL, 0, 1000, 5, 'payment_receive1', NULL, 47, NULL, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(559, NULL, 1, 1000, 10, 'payment_receive1', NULL, 47, NULL, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL, NULL, NULL, NULL),
(560, NULL, 1, 0, 104, 'payment_receive2', NULL, NULL, NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(561, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(562, NULL, 0, 0, 5, 'payment_receive1', NULL, 47, NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', '2021-12-09', NULL, NULL, NULL, NULL, NULL),
(563, NULL, 1, 0, 10, 'payment_receive1', NULL, 47, NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', NULL, NULL, NULL, NULL, NULL, NULL),
(564, NULL, 0, 200, 16, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(565, NULL, 0, 570.06, 16, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(566, NULL, 1, 5000, 5, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(567, NULL, 1, 28.503000000000043, 21, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(568, NULL, 0, NULL, 9, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(569, NULL, 0, 50, 20, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(570, NULL, 1, 38.50300000000004, 18, 'invoice', NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(571, NULL, 1, 0, 4, 'payment_receive2', NULL, NULL, NULL, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(572, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(573, NULL, 0, 0, 5, 'payment_receive1', NULL, 48, NULL, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', '2021-12-11', NULL, NULL, NULL, NULL, NULL),
(574, NULL, 1, 0, 10, 'payment_receive1', NULL, 48, NULL, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', NULL, NULL, NULL, NULL, NULL, NULL),
(575, NULL, 0, 1800, 16, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(576, NULL, 0, 1700, 16, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(577, NULL, 1, 6000, 5, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(578, NULL, 0, NULL, 9, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(579, NULL, 0, 5, 20, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(580, NULL, 1, 175, 18, 'invoice', NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(581, NULL, 1, 500, 3, 'payment_receive2', NULL, NULL, NULL, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(582, NULL, 0, 500, 10, 'payment_receive2', NULL, NULL, NULL, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(583, NULL, 0, 500, 5, 'payment_receive1', NULL, 49, NULL, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(584, NULL, 1, 500, 10, 'payment_receive1', NULL, 49, NULL, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', NULL, NULL, NULL, NULL, NULL, NULL),
(585, NULL, 1, 500, 4, 'payment_receive2', NULL, NULL, NULL, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(586, NULL, 0, 500, 10, 'payment_receive2', NULL, NULL, NULL, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(587, NULL, 0, 500, 5, 'payment_receive1', NULL, 49, NULL, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(588, NULL, 1, 500, 10, 'payment_receive1', NULL, 49, NULL, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', NULL, NULL, NULL, NULL, NULL, NULL),
(589, NULL, 1, 0, 103, 'payment_receive2', NULL, NULL, NULL, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:18', '2021-12-12 06:07:18', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(590, NULL, 0, 0, 10, 'payment_receive2', NULL, NULL, NULL, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:18', '2021-12-12 06:07:18', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(591, NULL, 0, 0, 5, 'payment_receive1', NULL, 49, NULL, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:18', '2021-12-12 06:07:18', '2021-12-12', NULL, NULL, NULL, NULL, NULL),
(592, NULL, 1, 0, 10, 'payment_receive1', NULL, 49, NULL, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, NULL, 1, 1, '2021-12-12 06:07:18', '2021-12-12 06:07:18', NULL, NULL, NULL, NULL, NULL, NULL),
(593, NULL, 0, 300, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, 1, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(594, NULL, 1, 300, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, 1, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(595, NULL, 1, 300, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(596, NULL, 0, 300, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(597, '', 0, 1000, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(598, '', 1, 1000, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(599, '', 0, 30, 3, 'expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 18:31:14', '2021-12-20 18:31:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(600, '', 1, 30, 23, 'expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 18:31:14', '2021-12-20 18:31:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(662, NULL, 0, 400, 16, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(663, NULL, 1, 420, 5, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(664, NULL, 1, 10, 21, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(665, NULL, 0, 38, 9, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(666, NULL, 0, 2, 20, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(667, NULL, 1, 10, 18, 'invoice', NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(668, NULL, 1, 100, 3, 'payment_receive2', NULL, NULL, NULL, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(669, NULL, 0, 100, 10, 'payment_receive2', NULL, NULL, NULL, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(670, NULL, 0, 100, 5, 'payment_receive1', NULL, 61, NULL, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(671, NULL, 1, 100, 10, 'payment_receive1', NULL, 61, NULL, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(672, NULL, 1, 50, 4, 'payment_receive2', NULL, NULL, NULL, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(673, NULL, 0, 50, 10, 'payment_receive2', NULL, NULL, NULL, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(674, NULL, 0, 50, 5, 'payment_receive1', NULL, 61, NULL, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(675, NULL, 1, 50, 10, 'payment_receive1', NULL, 61, NULL, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(676, NULL, 1, 100, 103, 'payment_receive2', NULL, NULL, NULL, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(677, NULL, 0, 100, 10, 'payment_receive2', NULL, NULL, NULL, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(678, NULL, 0, 100, 5, 'payment_receive1', NULL, 61, NULL, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(679, NULL, 1, 100, 10, 'payment_receive1', NULL, 61, NULL, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(680, NULL, 1, 170, 3, 'payment_receive2', NULL, NULL, NULL, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(681, NULL, 0, 170, 10, 'payment_receive2', NULL, NULL, NULL, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(682, NULL, 0, 170, 5, 'payment_receive1', NULL, 61, NULL, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(683, NULL, 1, 170, 10, 'payment_receive1', NULL, 61, NULL, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(684, NULL, 0, 100, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 2, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(685, NULL, 1, 100, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 2, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(686, NULL, 1, 100, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(687, NULL, 0, 100, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(688, '', 0, 500, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(689, '', 1, 500, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(690, '', 0, 200, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(691, '', 1, 200, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(692, '', 1, 200, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 3, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(693, '', 0, 200, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 3, NULL, 54, NULL, NULL, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(694, NULL, 0, 20, 16, 'invoice', NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(695, NULL, 0, 200, 16, 'invoice', NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(696, NULL, 1, 200, 5, 'invoice', NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(697, NULL, 1, 20, 18, 'invoice', NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(698, NULL, 1, 200, 3, 'payment_receive2', NULL, NULL, NULL, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(699, NULL, 0, 200, 10, 'payment_receive2', NULL, NULL, NULL, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(700, NULL, 0, 200, 5, 'payment_receive1', NULL, 62, NULL, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(701, NULL, 1, 200, 10, 'payment_receive1', NULL, 62, NULL, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(717, NULL, 0, 88, 16, 'invoice', NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(718, NULL, 1, 81.09000000000003, 5, 'invoice', NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(719, NULL, 1, 2.5608000000000004, 21, 'invoice', NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(720, NULL, 1, 4.268000000000001, 18, 'invoice', NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(721, NULL, 1, 81.09, 3, 'payment_receive2', NULL, NULL, NULL, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(722, NULL, 0, 81.09, 10, 'payment_receive2', NULL, NULL, NULL, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(723, NULL, 0, 81.09, 5, 'payment_receive1', NULL, 65, NULL, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(724, NULL, 1, 81.09, 10, 'payment_receive1', NULL, 65, NULL, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', '2021-12-21', NULL, NULL, NULL, NULL, NULL),
(731, NULL, 0, 190.46511627906978, 5, '11', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(732, NULL, 1, 190.46511627906978, 16, '11', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(733, NULL, 1, 190.46511627906978, 5, '12', NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(734, NULL, 0, 190.46511627906978, 3, '12', NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(735, NULL, 0, 50, 5, '11', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(736, NULL, 1, 50, 16, '11', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(737, NULL, 1, 50, 5, '12', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(738, NULL, 0, 50, 3, '12', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(739, NULL, 0, 30, 16, 'invoice', NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(740, NULL, 1, 30, 5, 'invoice', NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(741, NULL, 1, 5, 3, 'payment_receive2', NULL, NULL, NULL, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(742, NULL, 0, 5, 10, 'payment_receive2', NULL, NULL, NULL, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(743, NULL, 0, 5, 5, 'payment_receive1', NULL, 66, NULL, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(744, NULL, 1, 5, 10, 'payment_receive1', NULL, 66, NULL, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(745, NULL, 0, 50, 16, 'invoice', NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(746, NULL, 1, 50, 5, 'invoice', NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(747, NULL, 1, 5, 3, 'payment_receive2', NULL, NULL, NULL, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(748, NULL, 0, 5, 10, 'payment_receive2', NULL, NULL, NULL, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(749, NULL, 0, 5, 5, 'payment_receive1', NULL, 67, NULL, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(750, NULL, 1, 5, 10, 'payment_receive1', NULL, 67, NULL, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(751, '', 0, 0, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(752, '', 0, 0, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2021-12-22 07:06:27', '2021-12-22 07:06:27', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(753, NULL, 0, 100, 16, 'invoice', NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(754, NULL, 1, 100, 5, 'invoice', NULL, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(755, NULL, 1, 100, 3, 'payment_receive2', NULL, NULL, NULL, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(756, NULL, 0, 100, 10, 'payment_receive2', NULL, NULL, NULL, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(757, NULL, 0, 100, 5, 'payment_receive1', NULL, 68, NULL, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(758, NULL, 1, 100, 10, 'payment_receive1', NULL, 68, NULL, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', '2021-12-22', NULL, NULL, NULL, NULL, NULL),
(759, NULL, 0, 20, 16, 'invoice', NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(760, NULL, 1, 20, 5, 'invoice', NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(761, NULL, 1, 20, 3, 'payment_receive2', NULL, NULL, NULL, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(762, NULL, 0, 20, 10, 'payment_receive2', NULL, NULL, NULL, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(763, NULL, 0, 20, 5, 'payment_receive1', NULL, 69, NULL, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(764, NULL, 1, 20, 10, 'payment_receive1', NULL, 69, NULL, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', '2021-12-23', NULL, NULL, NULL, NULL, NULL),
(767, NULL, 0, 16000, 16, 'invoice', NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(768, NULL, 1, 16000, 5, 'invoice', NULL, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(769, NULL, 1, 16000, 3, 'payment_receive2', NULL, NULL, NULL, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(770, NULL, 0, 16000, 10, 'payment_receive2', NULL, NULL, NULL, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(771, NULL, 0, 16000, 5, 'payment_receive1', NULL, 70, NULL, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(772, NULL, 1, 16000, 10, 'payment_receive1', NULL, 70, NULL, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(773, NULL, 0, 25, 16, 'invoice', NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(774, NULL, 1, 25, 5, 'invoice', NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(775, NULL, 1, 25, 3, 'payment_receive2', NULL, NULL, NULL, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(776, NULL, 0, 25, 10, 'payment_receive2', NULL, NULL, NULL, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(777, NULL, 0, 25, 5, 'payment_receive1', NULL, 71, NULL, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(778, NULL, 1, 25, 10, 'payment_receive1', NULL, 71, NULL, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', '2021-12-24', NULL, NULL, NULL, NULL, NULL),
(779, NULL, 0, 200, 16, 'invoice', NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(780, NULL, 1, 170, 5, 'invoice', NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(781, NULL, 0, 15, 9, 'invoice', NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(782, NULL, 0, 5, 20, 'invoice', NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(783, NULL, 1, 50, 18, 'invoice', NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(784, NULL, 1, 170, 3, 'payment_receive2', NULL, NULL, NULL, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(785, NULL, 0, 170, 10, 'payment_receive2', NULL, NULL, NULL, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(786, NULL, 0, 170, 5, 'payment_receive1', NULL, 72, NULL, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(787, NULL, 1, 170, 10, 'payment_receive1', NULL, 72, NULL, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(788, NULL, 0, 200, 16, 'invoice', NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(789, NULL, 1, 170, 5, 'invoice', NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(790, NULL, 0, 15, 9, 'invoice', NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(791, NULL, 0, 5, 20, 'invoice', NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(792, NULL, 1, 50, 18, 'invoice', NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(793, NULL, 1, 170, 3, 'payment_receive2', NULL, NULL, NULL, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(794, NULL, 0, 170, 10, 'payment_receive2', NULL, NULL, NULL, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(795, NULL, 0, 170, 5, 'payment_receive1', NULL, 73, NULL, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(796, NULL, 1, 170, 10, 'payment_receive1', NULL, 73, NULL, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(797, NULL, 0, 200, 16, 'invoice', NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(798, NULL, 0, 20, 16, 'invoice', NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(799, NULL, 1, 180, 5, 'invoice', NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(800, NULL, 1, 20, 21, 'invoice', NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(801, NULL, 1, 20, 18, 'invoice', NULL, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(802, NULL, 1, 180, 3, 'payment_receive2', NULL, NULL, NULL, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(803, NULL, 0, 180, 10, 'payment_receive2', NULL, NULL, NULL, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(804, NULL, 0, 180, 5, 'payment_receive1', NULL, 74, NULL, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(805, NULL, 1, 180, 10, 'payment_receive1', NULL, 74, NULL, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', '2022-01-10', NULL, NULL, NULL, NULL, NULL),
(806, '', 0, 300, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(807, '', 1, 300, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(808, NULL, 1, 150, 11, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2022-01-29 11:15:48', '2022-01-29 11:15:48', '2022-01-29', NULL, NULL, 3, NULL, NULL),
(809, NULL, 0, 150, 26, 'vendor_credit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, NULL, 27, 27, '2022-01-29 11:15:48', '2022-01-29 11:15:48', '2022-01-29', NULL, NULL, 3, NULL, NULL),
(810, '', 1, 100, 5, 'invoice', NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-01-29 11:17:28', '2022-01-29 11:17:28', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(811, '', 0, 100, 16, 'invoice', NULL, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-01-29 11:17:28', '2022-01-29 11:17:28', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(812, NULL, 0, 50, 5, '11', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-01-29 11:17:48', '2022-01-29 11:17:48', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(813, NULL, 1, 50, 16, '11', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-01-29 11:17:48', '2022-01-29 11:17:48', '2022-01-29', NULL, NULL, NULL, NULL, NULL),
(814, NULL, 0, 200, 16, 'invoice', NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(815, NULL, 1, 200, 5, 'invoice', NULL, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(816, NULL, 1, 200, 3, 'payment_receive2', NULL, NULL, NULL, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(817, NULL, 0, 200, 10, 'payment_receive2', NULL, NULL, NULL, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(818, NULL, 0, 200, 5, 'payment_receive1', NULL, 76, NULL, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(819, NULL, 1, 200, 10, 'payment_receive1', NULL, 76, NULL, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(821, NULL, 0, 6000, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, 4, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL),
(822, NULL, 1, 6000, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, 4, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL),
(823, NULL, 1, 6000, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL),
(824, NULL, 0, 6000, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `journal_entries` (`id`, `note`, `debit_credit`, `amount`, `account_name_id`, `jurnal_type`, `journal_id`, `invoice_id`, `income_id`, `payment_receives_id`, `payment_receives_entries_id`, `credit_note_id`, `credit_note_refunds_id`, `expense_id`, `bill_id`, `bank_id`, `bill_entry_id`, `payment_made_id`, `payment_made_entry_id`, `contact_id`, `tax_id`, `pr_adjustment_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `assign_date`, `salesComission_id`, `agent_id`, `vendor_credit_id`, `vendor_credit_refunds_id`, `recurring_invoice_id`) VALUES
(825, '', 0, 6000, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL),
(826, '', 1, 6000, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, NULL, 54, NULL, NULL, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', '2016-01-01', NULL, NULL, NULL, NULL, NULL),
(877, '', 0, 40000, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:32:00', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(878, '', 1, 40000, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:32:00', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(890, NULL, 0, 26000, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, 5, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(891, NULL, 1, 26000, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, 5, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(892, NULL, 1, 26000, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(893, NULL, 0, 26000, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(894, '', 0, 26000, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(895, '', 1, 26000, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
(896, '', 0, 15000, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(897, '', 1, 15000, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(898, '', 1, 120, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(899, '', 0, 120, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(900, '', 1, 120, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(901, '', 0, 120, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(902, '', 1, 14760, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(903, '', 0, 14760, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, 6, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(904, '', 0, 25240, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(905, '', 1, 25240, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(906, '', 1, 25240, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, 7, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(907, '', 0, 25240, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, 7, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(908, '', 0, 0, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:46:12', '2022-02-24 08:46:12', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(909, '', 1, 2400, 5, 'invoice', NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(910, '', 0, 2400, 16, 'invoice', NULL, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(911, NULL, 1, 2400, 3, 'payment_receive2', NULL, NULL, NULL, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(912, NULL, 0, 2400, 10, 'payment_receive2', NULL, NULL, NULL, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(913, NULL, 0, 2400, 5, 'payment_receive1', NULL, 86, NULL, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(914, NULL, 1, 2400, 10, 'payment_receive1', NULL, 86, NULL, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(917, '', 1, 500, 5, 'invoice', NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(918, '', 0, 500, 16, 'invoice', NULL, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(919, NULL, 1, 500, 3, 'payment_receive2', NULL, NULL, NULL, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(920, NULL, 0, 500, 10, 'payment_receive2', NULL, NULL, NULL, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(921, NULL, 0, 500, 5, 'payment_receive1', NULL, 88, NULL, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(922, NULL, 1, 500, 10, 'payment_receive1', NULL, 88, NULL, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(923, NULL, 0, 90, 16, 'invoice', NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(924, NULL, 0, 100, 16, 'invoice', NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(925, NULL, 1, 170, 5, 'invoice', NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(926, NULL, 1, 20, 21, 'invoice', NULL, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(927, NULL, 1, 170, 3, 'payment_receive2', NULL, NULL, NULL, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(928, NULL, 0, 170, 10, 'payment_receive2', NULL, NULL, NULL, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(929, NULL, 0, 170, 5, 'payment_receive1', NULL, 89, NULL, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(930, NULL, 1, 170, 10, 'payment_receive1', NULL, 89, NULL, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(937, NULL, 0, 3000, 16, 'invoice', NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(938, NULL, 0, 2000, 16, 'invoice', NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(939, NULL, 1, 4950, 5, 'invoice', NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(940, NULL, 1, 50, 21, 'invoice', NULL, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(941, NULL, 1, 4950, 3, 'payment_receive2', NULL, NULL, NULL, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(942, NULL, 0, 4950, 10, 'payment_receive2', NULL, NULL, NULL, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(943, NULL, 0, 4950, 5, 'payment_receive1', NULL, 91, NULL, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(944, NULL, 1, 4950, 10, 'payment_receive1', NULL, 91, NULL, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(945, NULL, 0, 20000, 27, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, 8, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(946, NULL, 1, 20000, 11, 'payment_made1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, 8, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(947, NULL, 1, 20000, 27, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(948, NULL, 0, 20000, 3, 'payment_made2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(949, '', 0, 42500, 11, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(950, '', 1, 42500, 26, 'bill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, NULL, NULL, 1, NULL, NULL, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', '2022-02-24', NULL, NULL, NULL, NULL, NULL),
(998, '', 1, 35, 5, 'invoice', NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2022-03-01 05:16:39', '2022-03-01 05:16:39', '2022-03-01', NULL, NULL, NULL, NULL, NULL),
(999, '', 0, 35, 16, 'invoice', NULL, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 26, 26, '2022-03-01 05:16:39', '2022-03-01 05:16:39', '2022-03-01', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_01_18_092901_create_user_activations_table', 1),
(4, '2017_02_02_053156_create_branch_table', 1),
(5, '2017_02_02_053157_create_contact_category_table', 1),
(6, '2017_02_02_053222_create_agents_table', 1),
(7, '2017_02_02_053223_create_contact_table', 1),
(8, '2017_02_02_053225_create_customer_file_table', 1),
(9, '2017_02_10_044930_create_payment_mode_table', 1),
(10, '2017_02_10_044940_create_parent_account_type_table', 1),
(11, '2017_02_10_045717_create_account_type_table', 1),
(12, '2017_02_10_045727_create_account_table', 1),
(13, '2017_02_11_053630_create_tax_table', 1),
(14, '2017_02_11_053631_create_journal_table', 1),
(15, '2017_02_13_181447_create_item_category_table', 1),
(16, '2017_02_13_181545_create_item_table', 1),
(17, '2017_02_13_181719_create_product_table', 1),
(18, '2017_02_13_181753_create_product_phase_table', 1),
(19, '2017_02_13_181830_create_product_phase_item_table', 1),
(20, '2017_02_20_060418_create_modules_table', 1),
(21, '2017_02_20_060419_create_roles_table', 1),
(22, '2017_02_20_060456_create_access_level_table', 1),
(23, '2017_02_20_170318_create_product_phase_item_add_table', 1),
(24, '2017_03_09_071116_create_organization_profiles_table', 1),
(25, '2017_04_28_174719_create_invoices_table', 1),
(26, '2017_04_28_174745_create_invoice_entries_table', 1),
(27, '2017_04_29_161315_create_payment_receives_table', 1),
(28, '2017_04_29_161316_create_payment_receives_entries_table', 1),
(29, '2017_04_29_161406_create_credit_notes_table', 1),
(30, '2017_04_29_161420_create_credit_note_entries_table', 1),
(31, '2017_04_29_161439_create_credit_note_payments_table', 1),
(32, '2017_04_29_161458_create_credit_note_refunds_table', 1),
(33, '2017_05_05_033709_create_excess_payment_table', 1),
(34, '2015_07_15_171523_create_cms_site_table', 2),
(35, '2017_06_06_230649_create_bill_table', 2),
(36, '2017_06_06_230649_create_stock_table', 2),
(37, '2017_06_06_230716_create_bill_entry_table', 2),
(38, '2017_06_06_230904_create_payment_made_table', 2),
(39, '2017_06_06_230920_create_payment_made_entry_table', 2),
(40, '2017_07_02_093820_create_company_table', 2),
(41, '2017_07_02_093908_create_okala_table', 2),
(42, '2017_07_02_093955_create_fingerprint_table', 2),
(43, '2017_07_02_101441_create_recruitingorder_table', 2),
(44, '2017_07_02_101445_create_order_file_table', 2),
(45, '2017_07_02_101541_create_manpower_table', 2),
(46, '2017_07_02_101545_create_flight_table', 2),
(47, '2017_07_02_101552_create_relation_table', 2),
(48, '2017_07_02_111525_create_visaentrys_table', 2),
(49, '2017_07_02_112834_create_mofas_table', 2),
(50, '2017_07_02_112844_create_mofa_file_table', 2),
(51, '2017_07_02_113905_create_visa_entry_file_table', 2),
(52, '2017_07_02_113911_create_relation_mofa_visa_table', 2),
(53, '2017_07_02_114007_create_medicalSlip_table', 2),
(54, '2017_07_02_114017_create_report_file_table', 2),
(55, '2017_07_02_114116_create_musaned_table', 2),
(56, '2017_07_02_114223_create_visaStamping_table', 2),
(57, '2017_07_02_114225_create_stampingApproval_table', 2),
(58, '2017_07_02_120151_create_relation_Stam_table', 2),
(59, '2017_07_03_102404_create_visas_table', 2),
(60, '2017_07_09_053945_create_form_basis_table', 2),
(61, '2017_07_09_054306_create_medical_slip_form_table', 2),
(62, '2017_07_09_054337_create_medical_slip_form_pax_table', 2),
(63, '2017_07_09_054343_create_recruit_customer_table', 2),
(64, '2017_07_09_054400_create_medical_slip_form_pax_relation_table', 2),
(65, '2017_07_09_072348_create_bank_table', 2),
(66, '2017_07_09_105254_create_document_cat_table', 2),
(67, '2017_07_09_105323_create_document_table', 2),
(68, '2017_07_09_105359_document_category_relation_table', 2),
(69, '2017_07_10_071211_add_extracolumn_to_company_table', 2),
(70, '2017_07_10_071504_add_extracolumn_to_recruting_table', 2),
(71, '2017_07_10_102221_create_expensesector_table', 2),
(72, '2017_07_10_102313_create_recruiteexpense_table', 2),
(73, '2017_07_10_102346_create_expense_pax_table', 2),
(74, '2017_07_10_103128_create_expense_sector_pax_relation_table', 2),
(75, '2017_07_11_044752_create_agreement_paper_table', 2),
(76, '2017_07_11_044810_create_agreement_paper_pax_table', 2),
(77, '2017_07_11_044830_create_agreement_paper_pax_relation_table', 2),
(78, '2017_07_12_033953_create_incomes_table', 2),
(79, '2017_07_13_034016_create_visaacceptance_table', 2),
(80, '2017_07_13_034117_create_gamca_table', 2),
(81, '2017_07_13_034123_create_visa_process_report_table', 2),
(82, '2017_07_13_034137_create_visaacceptance_relation_table', 2),
(83, '2017_07_15_041806_add_namear_to_company_table', 2),
(84, '2017_07_15_042901_create_visaforms_table', 2),
(85, '2017_07_15_043020_create_visaformbulks_table', 2),
(86, '2017_07_15_043043_create_visaformagreement_table', 2),
(87, '2017_07_15_043130_create_visaform_and_bulk_relation_table', 2),
(88, '2017_07_15_043201_create_visaform_and_agreement_relation', 2),
(89, '2017_07_15_065551_add_submissiondate_to_visaentry_table', 2),
(90, '2017_07_16_063504_add_so_cloumn_to_visaform_table', 2),
(91, '2017_07_16_085859_add_Qualification_cloumn_to_recruitcustomer_table', 2),
(92, '2017_07_16_091948_create_immigration_clearance_table', 2),
(93, '2017_07_16_092030_create_immigration_clearance_pax_table', 2),
(94, '2017_07_16_092527_create_immigration_clearance_pax_relation_table', 2),
(95, '2017_07_19_064337_create_TicketTaxs_table', 2),
(96, '2017_07_19_070312_create_Ticketcommission_table', 2),
(97, '2017_07_19_071729_create_TicketTaxsrelation_users_table', 2),
(98, '2017_07_20_051731_create_note_sheet_table', 2),
(99, '2017_07_20_051753_create_note_sheet_pax_table', 2),
(100, '2017_07_20_051813_create_note_sheet_pax_relation_table', 2),
(101, '2017_07_20_063113_create_airline_table', 2),
(102, '2017_07_20_063202_create_airline_tax_table', 2),
(103, '2017_07_20_063236_create_ticket_hotel_table', 2),
(104, '2017_07_20_063237_create_airline_tax_relation_table', 2),
(105, '2017_07_20_063255_create_ticket_order_table', 2),
(106, '2017_07_20_063270_create_ticket_order_tax_table', 2),
(107, '2017_07_20_063316_create_ticket_order_relation_table', 2),
(108, '2017_07_20_085916_create_ticket_airlines_relation_table', 2),
(109, '2017_07_22_060301_add_order_id_to_tikcetorder_table', 2),
(110, '2017_07_22_064357_create_ticket_document_table', 2),
(111, '2017_07_22_065222_create_ticket_relation_table', 2),
(112, '2017_07_22_091918_create_backup_table', 2),
(113, '2017_07_22_125915_add_tikestan_to_backup_table', 2),
(114, '2017_07_23_072134_create_openingbalance_table', 2),
(115, '2017_07_25_051426_add_column_to_invoices_table', 2),
(116, '2017_07_25_101612_add_relationinvoice_to_invoices_table', 2),
(117, '2017_07_25_102109_create_salesComissions_table', 2),
(118, '2017_07_26_051806_add_column_tosalesComissions_table', 2),
(119, '2017_07_26_064942_add_amount_column_tosalesComissions_table', 2),
(120, '2017_07_26_121050_add_paidthrow_column_tosalesComissions_table', 2),
(121, '2017_07_29_000713_create_table_reminders_', 2),
(122, '2017_08_01_152513_create_email_table', 2),
(123, '2017_08_01_152617_create_email_relation_table', 2),
(124, '2017_08_01_173308_create_table_estimate', 2),
(125, '2017_08_01_173337_create_table_estimate_entries', 2),
(126, '2017_08_12_153258_add_aaccount_id_to_contact_table', 2),
(127, '2017_08_13_173159_create_backupshcedule_table', 2),
(128, '2017_08_20_153506_create_invoice_header_type_table', 2),
(129, '2017_08_26_181345_add_etin_to_organizationprofil_table', 2),
(130, '2017_08_27_094335_create_price_lists_table', 2),
(131, '2017_08_27_170652_add_expensenumner_to_users_table', 2),
(132, '2017_08_27_170737_add_income_numner_to_users_table', 2),
(133, '2017_09_11_111239_create_account_information_forms_table', 2),
(134, '2017_09_15_144125_create_conveyance_bills_table', 2),
(135, '2017_09_16_104832_create_conveyance_bill_lists_table', 2),
(136, '2017_09_20_115019_create_manpower_service_table', 2),
(137, '2017_09_20_130709_create_manpower_service_ticket_document_table', 2),
(138, '2017_09_20_152819_create_manpower_service_progress_status_table', 2),
(139, '2017_09_20_165633_create_manpower_service_relation_table', 2),
(140, '2017_09_24_113740_create_module_delete', 2),
(141, '2017_09_25_162241_create_reciption_categories_table', 2),
(142, '2017_09_25_162312_create_reciption_logbooks_table', 2),
(143, '2017_09_26_151605_add_location_to_branch_table', 2),
(144, '2017_09_27_152430_add_craetedby_updated_by_to_estimates_table', 2),
(145, '2017_10_03_161718_add_save_to_bill_table', 2),
(146, '2017_10_04_112216_add_save_to_expense_table', 2),
(147, '2017_10_08_124104_create_gamca_receive_submit_table', 2),
(148, '2017_10_08_124114_create_arrivel_recruit_table', 2),
(149, '2017_10_08_124142_create_gamca_file_table', 2),
(150, '2017_10_08_124854_create_gamca_file_relation_table', 2),
(151, '2017_10_09_163650_create_finger_print_files_table', 2),
(152, '2017_10_10_152202_create_trainings_table', 2),
(153, '2017_10_10_152220_create_training_files_table', 2),
(154, '2017_10_10_171208_create_completions_table', 2),
(155, '2017_10_10_171221_create_completion_files_table', 2),
(156, '2017_10_10_182235_create_fit_card_table', 2),
(157, '2017_10_10_182315_create_police_clearances_table', 2),
(158, '2017_10_10_182328_create_police_clearance_files_table', 2),
(159, '2017_10_10_182339_create_fit_card_file_table', 2),
(160, '2017_10_11_120209_create_submission_table', 2),
(161, '2017_10_11_120244_create_submission_file_table', 2),
(162, '2017_10_11_120250_create_fit_card_relation_table', 2),
(163, '2017_10_11_130916_create_confirmations_table', 2),
(164, '2017_10_11_130930_create_confirmation_files_table', 2),
(165, '2017_10_22_114851_create_customersubreference_table', 2),
(166, '2017_10_24_155236_add_votes_to_item_table', 2),
(167, '2017_10_26_120459_create_challanForm_table', 2),
(168, '2017_10_29_161460_create_journal_entries_table', 2),
(169, '2017_10_30_153235_add_assigndate_to_journalentrys_table', 2),
(170, '2017_10_30_164053_add_passport_number_to_ticketorder_table', 2),
(171, '2017_11_01_152143_add_passport_number_to_manpoerservice_table', 2),
(172, '2017_11_11_104338_create_iqamaapproval_table', 2),
(173, '2017_11_11_165620_add_column_to_invoice_entries_table', 2),
(174, '2017_11_12_103948_add_payment_recieve_id_to_invoices_table', 2),
(175, '2017_11_13_102150_add_column_to_recruit_order_table', 2),
(176, '2017_11_13_153129_drop_column_to_visa_entries_table', 2),
(177, '2017_11_13_171928_add_column_to_challan_form_table', 2),
(178, '2017_11_13_180159_add_new_column_challanform_table', 2),
(179, '2017_11_16_154015_create_recieve_table', 2),
(180, '2017_11_16_154156_create_iqama_submissions_table', 2),
(181, '2017_11_16_154219_create_insurance_table', 2),
(182, '2017_11_19_103720_create_iqama_clearance_table', 2),
(183, '2017_11_19_150619_create_iqama_receipient_table', 2),
(184, '2017_11_19_172513_add_comission_to_recruitingorder_table', 2),
(185, '2017_11_20_111124_create_iqamaacknowledgements_table', 2),
(186, '2017_11_20_173630_create_kafalas_table', 2),
(187, '2017_11_21_120952_add_visa_type_to_users_table', 2),
(188, '2017_11_22_100945_create_aftersixydays_table', 2),
(189, '2017_11_22_163439_add_cancel_for_okala_to_visaentrys_table', 2),
(190, '2017_11_23_145734_add_parent_id_to_customer_sub_reference_table', 2),
(191, '2017_11_23_155124_add_sales_commission_id_to_recruiteexpense', 2),
(192, '2017_11_27_070356_add__column_to_journal_entries_table', 2),
(193, '2017_11_27_160109_add_column_relational_passenger_to_iqamarecipient', 2),
(194, '2017_11_28_091327_add_column_upload_and_comments_to_iqamaclearance', 2),
(195, '2017_12_04_122256_create_pms__sites_table', 2),
(196, '2017_12_04_122617_create_pms__employees_table', 2),
(197, '2017_12_06_101105_add_name_to_pms_employees_table', 2),
(198, '2017_12_06_105249_add_coloum_remarks_to_stamping_approval', 2),
(199, '2017_12_06_161426_add_column_last_invoice_amount_to_recruitingorder', 2),
(200, '2017_12_06_171754_create_pms_sectors_table', 2),
(201, '2017_12_07_084328_add_column_ticket_approval_to_submission_table', 2),
(202, '2017_12_11_153022_add_column_reference_to_invoices', 2),
(203, '2017_12_14_172629_add_daily_work_hour_to_pms_employee', 2),
(204, '2017_12_18_142027_create_ticket_refunds_table', 2),
(205, '2017_12_19_123830_create_ticket_refund_others_table', 2),
(206, '2017_12_19_162639_create_contact_user_defined_function', 2),
(207, '2017_12_23_152947_add_coloum_overtime_amount_per_hour_to_pms_employee', 2),
(208, '2017_12_24_165712_create_pms_leave_settings_table', 2),
(209, '2017_12_24_165807_create_pms_leave_assigns_table', 2),
(210, '2017_12_27_105257_add_craetedby_updated_by_to_branch_table', 2),
(211, '2017_12_30_175116_create_invoice_return_entries_table', 2),
(212, '2018_01_01_100621_drop_pr_adjustment_and_note_from_invoices_table', 2),
(213, '2018_01_01_171033_create_bill_return_entries_table', 2),
(214, '2018_01_07_124433_add_remarks_column_to_recruitingorder', 2),
(215, '2018_01_07_160317_add_unit_type_column_to_item', 2),
(216, '2018_01_09_130259_add_column_invoice_bill_to_ticket_refund_others_table', 2),
(217, '2018_01_15_123101_create_pms_assign_allowances_table', 2),
(218, '2018_01_15_123130_create_pms_assign_deductions_table', 2),
(219, '2018_01_15_151835_create_pms_payroll_sheets_table', 2),
(220, '2018_01_15_170333_create_pms_payslips_table', 2),
(221, '2018_01_15_171429_create_pms_payslip_allowances_table', 2),
(222, '2018_01_15_171445_create_pms_payslip_deductions_table', 2),
(223, '2018_01_16_141349_create_pms_companies_table', 2),
(224, '2018_01_16_152355_create_pms_invoices_table', 2),
(225, '2018_01_17_095206_create_pms_settings_table', 2),
(226, '2018_01_18_171500_add_column_pms_company_id_to_pms_payroll_sheets', 2),
(227, '2018_01_20_095559_add_number_column_to_pms_payslips_table', 2),
(228, '2018_01_20_103406_create_pms_expense_sector_table', 2),
(229, '2018_01_21_112316_create_pms_receipts_table', 2),
(230, '2018_01_22_100055_create_setting_currencies_table', 2),
(231, '2018_01_22_100123_create_setting_currency_rates_table', 2),
(232, '2018_02_10_125110_create_pms_account_type_table', 2),
(233, '2018_02_10_130707_create_pms_account_sub_type_table', 2),
(234, '2018_02_10_141306_create_pms_account_table', 2),
(235, '2018_02_10_142654_create_pms_contact_category_table', 2),
(236, '2018_02_10_143051_create_pms_contact_table', 2),
(237, '2018_02_10_144904_create_pms_holiday_table', 2),
(238, '2018_02_10_150337_create_pms_advance_payment_table', 2),
(239, '2018_02_10_153142_create_pms_income_table', 2),
(240, '2018_02_11_103344_create_pmsexpenses_table', 2),
(241, '2018_02_11_104141_create_pms_payslips_payments_table', 2),
(242, '2018_02_11_145123_create_pms_expenses_payments_table', 2),
(243, '2018_04_04_104223_create_item_sub_category_table', 2),
(244, '2016_06_06_230413_create_expense_table', 3),
(245, '2018_07_17_094101_create_bill_submit_table', 3),
(246, '2018_08_15_092633_create_cms_deduction_sector_table', 3),
(247, '2018_08_15_092652_create_cms_invoices_table', 4),
(248, '2018_08_15_092654_create_cms_deduction_table', 4),
(249, '2018_09_19_155039_add_file_url_to_users_table', 4),
(250, '2018_12_07_091736_create_pms_attendance_table', 4),
(251, '2018_12_14_124217_add_coloum_absense_to_pms_attendance_table', 4),
(252, '2018_12_20_150755_add_column_overtime_to_pms_attendance', 4),
(253, '2019_09_27_125739_createlocktransaction_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `module_prefix`, `created_at`, `updated_at`) VALUES
(1, 'Contact', 'contact', '1973-04-15 14:24:06', '1970-02-17 23:40:51'),
(2, 'Contact Category', 'contact/category', '1980-12-15 00:30:11', '2004-08-23 18:21:48'),
(3, 'Account Chart', 'account-chart', '1984-11-04 11:25:32', '2011-04-07 19:16:26'),
(4, 'Inventory Item', 'inventory', '1975-12-31 16:37:21', '2011-01-16 12:38:00'),
(5, 'Inventory Category', 'inventory/category', '2008-12-22 16:08:37', '2016-07-14 17:14:45'),
(6, 'Stock Management', 'stock-management', '1995-11-01 15:06:00', '1993-06-11 04:55:21'),
(8, 'Manual Journal', 'manual-journal', '1985-07-21 16:50:23', '1999-05-02 23:58:28'),
(9, 'Bill', 'bill', '1978-10-08 14:33:25', '1991-03-03 16:30:42'),
(10, 'Credit Note', 'credit-note', '1982-09-23 20:04:00', '1991-02-23 23:22:01'),
(11, 'Credit Note Refund ', 'credit-note/refund', '1978-01-16 21:09:58', '1979-01-26 23:42:35'),
(12, 'Expense', 'expense', '1996-12-24 14:40:00', '2013-09-11 14:27:43'),
(13, 'Inventory', 'inventory', '1995-09-10 06:17:06', '1979-07-22 08:01:26'),
(14, 'Inventory Category', 'inventory/category', '1991-02-02 10:48:09', '1984-12-05 03:56:04'),
(15, 'Invoice', 'invoice', '2012-10-12 07:07:30', '2010-03-05 12:20:41'),
(16, 'Payment Made', 'payment-made', '1995-09-06 11:51:58', '1989-05-12 20:07:45'),
(17, 'Payment Received', 'payment-received', '2011-08-19 14:12:27', '1985-12-17 10:29:44'),
(18, 'Report', 'report', '2013-10-04 18:20:55', '1993-04-01 00:12:54'),
(19, 'Stock Transfer', 'stock-transfer', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(20, 'Bank', 'bank', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(21, 'Income', 'income', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(23, 'Sales Commission', 'Commission/Sales', '2017-08-26 13:00:00', '2017-08-26 13:00:00'),
(115, 'Bill Submit', 'billsubmit', '2018-01-26 20:00:00', '2018-01-26 20:00:00'),
(116, 'CRM Dailylog', 'crm/dailylog', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(117, 'CRM Status', 'crm/status', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(118, 'CRM Software Type', 'crm/software/type', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(119, 'CRM Bussiness Type', 'crm/bussiness/type', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(120, 'CRM Zone', 'crm/zone', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(121, 'CRM Report', 'crmreport', '2018-01-26 12:00:00', '2018-01-26 12:00:00'),
(122, 'Discount Management', 'offerdiscountmanagement/offers', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(123, 'Offer Calculate', 'offerdiscountmanagement/offers/calculate', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(124, 'Discount Stickers', 'offerdiscountmanagement/discount-strickers', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(125, 'Pos', 'get-pos', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(126, 'Invoice Measurements', 'invoice-measurements', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(127, 'Point of sales', 'point-of-sales', '2017-09-12 11:00:00', '2017-11-12 14:00:00'),
(128, 'Excel', 'excel', '2017-09-12 11:00:00', '2017-11-12 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `organization_profiles`
--

CREATE TABLE `organization_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_all_contact` int(11) DEFAULT 1,
  `show_all_item` int(10) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_profiles`
--

INSERT INTO `organization_profiles` (`id`, `logo`, `display_name`, `company_name`, `street`, `city`, `state`, `country`, `zip_code`, `website`, `contact_number`, `email`, `created_at`, `updated_at`, `etin`, `vat_number`, `show_all_contact`, `show_all_item`) VALUES
(1, 'logo.png', 'Ontik Technology Ltd.', 'Ontik Technology Ltd.', 'Road 32', 'Gulshan', 'Dhaka', 'Bangladesh', '1200', '', '8801996704612', 'ontiktechnology@gmail.com', '2018-01-02 09:16:42', '2021-11-18 04:44:06', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parent_account_type`
--

CREATE TABLE `parent_account_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parent_account_type`
--

INSERT INTO `parent_account_type` (`id`, `account_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 'Assets', '1986-03-24 20:19:46', '1998-11-03 13:19:41'),
(2, 'Liability', 'Liability', '1976-10-21 04:38:54', '2002-10-17 15:03:47'),
(3, 'Equity', 'Equity', '1998-10-05 19:30:59', '1979-03-18 14:46:56'),
(4, 'income', 'income', '1976-05-18 19:24:57', '1978-09-01 03:18:25'),
(5, 'Expense', 'Expense', '1999-08-19 16:14:52', '2004-08-22 11:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_made`
--

CREATE TABLE `payment_made` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `pm_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode_id` int(10) UNSIGNED DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excess_amount` double NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_made`
--

INSERT INTO `payment_made` (`id`, `amount`, `payment_date`, `pm_number`, `bank_info`, `invoice_show`, `payment_mode_id`, `reference`, `excess_amount`, `account_id`, `vendor_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `file_url`) VALUES
(1, 300, '2021-12-21', '000001', '', NULL, 1, '', 0, 3, 54, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', NULL),
(2, 100, '2021-12-21', '000002', '', NULL, 1, '', 0, 3, 54, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', NULL),
(3, 200, '2021-12-21', '000003', NULL, NULL, NULL, '', 0, 3, 54, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57', NULL),
(4, 6000, '2016-01-01', '000004', '', NULL, 1, '', 0, 3, 54, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', NULL),
(5, 26000, '2010-01-01', '000005', '', NULL, 1, '', 0, 3, 1, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', NULL),
(6, 15000, '2022-02-24', '000006', NULL, NULL, NULL, '', 0, 3, 1, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55', NULL),
(7, 25240, '2022-02-24', '000007', NULL, NULL, NULL, '', 0, 3, 1, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17', NULL),
(8, 20000, '2022-02-24', '000008', '', NULL, 1, '', 0, 3, 1, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_made_entry`
--

CREATE TABLE `payment_made_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_made_id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_made_entry`
--

INSERT INTO `payment_made_entry` (`id`, `amount`, `payment_made_id`, `bill_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 300, 1, 13, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25'),
(2, 100, 2, 14, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14'),
(3, 200, 3, 14, 26, 26, '2021-12-21 08:58:57', '2021-12-21 08:58:57'),
(4, 6000, 4, 21, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20'),
(5, 26000, 5, 24, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24'),
(6, 120, 6, 11, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55'),
(7, 120, 6, 12, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55'),
(8, 14760, 6, 23, 25, 25, '2022-02-24 08:39:55', '2022-02-24 08:39:55'),
(9, 25240, 7, 23, 25, 25, '2022-02-24 08:40:17', '2022-02-24 08:40:17'),
(10, 20000, 8, 26, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int(10) UNSIGNED NOT NULL,
  `mode_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `mode_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'Cash', '1992-03-24 08:15:55', '1993-05-21 05:18:51'),
(2, 'Bank Cheque', 'Bank Cheque', '1998-11-10 12:48:18', '2015-02-25 11:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receives`
--

CREATE TABLE `payment_receives` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `pr_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `vat_adjustment` double NOT NULL,
  `tax_adjustment` double NOT NULL,
  `others_adjustment` double NOT NULL,
  `excess_payment` double NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode_id` int(10) UNSIGNED DEFAULT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bp_amount` double DEFAULT 0,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `commission_amount` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_receives`
--

INSERT INTO `payment_receives` (`id`, `payment_date`, `pr_number`, `reference`, `bank_info`, `invoice_show`, `note`, `amount`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `excess_payment`, `file_name`, `file_url`, `payment_mode_id`, `account_id`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `bp_amount`, `agent_id`, `commission_amount`) VALUES
(2, '2021-11-16', '000001', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00', 0, NULL, 0),
(3, '2021-11-16', '000002', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52', 0, NULL, 0),
(4, '2021-11-16', '000003', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 1, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33', 0, NULL, 0),
(5, '2021-11-16', '000004', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32', 0, NULL, 0),
(6, '2021-11-16', '000005', NULL, '', 'on', NULL, 10, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12', 0, NULL, 0),
(7, '2021-11-16', '000006', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 1, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41', 0, NULL, 0),
(8, '2021-11-16', '000007', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35', 0, NULL, 0),
(10, '2021-11-16', '000008', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13', 0, NULL, 0),
(11, '2021-11-16', '000009', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16', 0, NULL, 0),
(12, '2021-11-16', '000010', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51', 0, NULL, 0),
(13, '2021-11-16', '000011', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04', 0, NULL, 0),
(14, '2021-11-16', '000012', NULL, '', 'on', NULL, 10, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33', 0, NULL, 0),
(15, '2021-11-16', '000013', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15', 0, NULL, 0),
(16, '2021-11-16', '000014', NULL, '', 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57', 0, NULL, 0),
(17, '2021-12-06', '000015', NULL, '', 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15', 0, NULL, 0),
(18, '2021-12-07', '000016', NULL, NULL, 'on', NULL, 300, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-07 07:20:19', '2021-12-07 07:20:19', 0, NULL, 0),
(19, '2021-12-07', '000017', NULL, NULL, 'on', NULL, 10, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21', 0, NULL, 0),
(20, '2021-12-07', '000018', NULL, NULL, 'on', NULL, 10, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21', 0, NULL, 0),
(21, '2021-12-08', '000019', NULL, NULL, 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13', 0, NULL, 0),
(22, '2021-12-08', '000020', NULL, NULL, 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', 0, NULL, 0),
(23, '2021-12-08', '000021', NULL, NULL, 'on', NULL, 10, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17', 0, NULL, 0),
(24, '2021-12-08', '000022', NULL, NULL, 'on', NULL, 300, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18', 0, NULL, 0),
(25, '2021-12-08', '000023', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', 0, NULL, 0),
(26, '2021-12-08', '000024', NULL, NULL, 'on', NULL, 30, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', 0, NULL, 0),
(27, '2021-12-08', '000025', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', 0, NULL, 0),
(28, '2021-12-08', '000026', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54', 0, NULL, 0),
(29, '2021-12-08', '000027', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', 0, NULL, 0),
(30, '2021-12-08', '000028', NULL, NULL, 'on', NULL, 30, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', 0, NULL, 0),
(31, '2021-12-08', '000029', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', 0, NULL, 0),
(32, '2021-12-08', '000030', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53', 0, NULL, 0),
(33, '2021-12-08', '000031', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', 0, NULL, 0),
(34, '2021-12-08', '000032', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14', 0, NULL, 0),
(35, '2021-12-08', '000033', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15', 0, NULL, 0),
(36, '2021-12-08', '000034', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', 0, NULL, 0),
(37, '2021-12-08', '000035', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', 0, NULL, 0),
(38, '2021-12-08', '000036', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42', 0, NULL, 0),
(39, '2021-12-08', '000037', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', 0, NULL, 0),
(40, '2021-12-08', '000038', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', 0, NULL, 0),
(41, '2021-12-08', '000039', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04', 0, NULL, 0),
(42, '2021-12-08', '000040', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35', 0, NULL, 0),
(43, '2021-12-08', '000041', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', 0, NULL, 0),
(44, '2021-12-08', '000042', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', 0, NULL, 0),
(45, '2021-12-08', '000043', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36', 0, NULL, 0),
(46, '2021-12-08', '000044', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', 0, NULL, 0),
(47, '2021-12-08', '000045', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', 0, NULL, 0),
(48, '2021-12-08', '000046', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', 0, NULL, 0),
(49, '2021-12-08', '000047', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37', 0, NULL, 0),
(50, '2021-12-08', '000048', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', 0, NULL, 0),
(51, '2021-12-08', '000049', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', 0, NULL, 0),
(52, '2021-12-08', '000050', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45', 0, NULL, 0),
(53, '2021-12-08', '000051', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', 0, NULL, 0),
(54, '2021-12-08', '000052', NULL, NULL, 'on', NULL, 40, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', 0, NULL, 0),
(55, '2021-12-08', '000053', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', 0, NULL, 0),
(56, '2021-12-08', '000054', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54', 0, NULL, 0),
(57, '2021-12-08', '000055', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', 0, NULL, 0),
(58, '2021-12-08', '000056', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', 0, NULL, 0),
(59, '2021-12-08', '000057', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', 0, NULL, 0),
(60, '2021-12-08', '000058', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07', 0, NULL, 0),
(61, '2021-12-08', '000059', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', 0, NULL, 0),
(62, '2021-12-08', '000060', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', 0, NULL, 0),
(63, '2021-12-08', '000061', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22', 0, NULL, 0),
(64, '2021-12-08', '000062', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', 0, NULL, 0),
(65, '2021-12-08', '000063', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32', 0, NULL, 0),
(66, '2021-12-08', '000064', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33', 0, NULL, 0),
(67, '2021-12-08', '000065', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', 0, NULL, 0),
(68, '2021-12-08', '000066', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', 0, NULL, 0),
(69, '2021-12-08', '000067', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', 0, NULL, 0),
(70, '2021-12-08', '000068', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46', 0, NULL, 0),
(71, '2021-12-08', '000069', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', 0, NULL, 0),
(72, '2021-12-08', '000070', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', 0, NULL, 0),
(73, '2021-12-08', '000071', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16', 0, NULL, 0),
(74, '2021-12-08', '000072', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15', 0, NULL, 0),
(75, '2021-12-08', '000073', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', 0, NULL, 0),
(76, '2021-12-08', '000074', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16', 0, NULL, 0),
(77, '2021-12-08', '000075', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', 0, NULL, 0),
(78, '2021-12-08', '000076', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', 0, NULL, 0),
(79, '2021-12-08', '000077', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36', 0, NULL, 0),
(80, '2021-12-08', '000078', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', 0, NULL, 0),
(81, '2021-12-08', '000079', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', 0, NULL, 0),
(82, '2021-12-08', '000080', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26', 0, NULL, 0),
(83, '2021-12-08', '000081', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', 0, NULL, 0),
(84, '2021-12-08', '000082', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22', 0, NULL, 0),
(85, '2021-12-08', '000083', NULL, NULL, 'on', NULL, 60, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23', 0, NULL, 0),
(86, '2021-12-09', '000084', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', 0, NULL, 0),
(87, '2021-12-09', '000085', NULL, NULL, 'on', NULL, 30, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', 0, NULL, 0),
(88, '2021-12-09', '000086', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', 0, NULL, 0),
(89, '2021-12-09', '000087', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 104, 3, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39', 0, NULL, 0),
(90, '2021-12-09', '000088', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40', 0, NULL, 0),
(91, '2021-12-09', '000089', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 3, 3, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49', 0, NULL, 0),
(92, '2021-12-09', '000090', NULL, NULL, 'on', NULL, 80, 0, 0, 0, 0, NULL, NULL, 1, 4, 3, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', 0, NULL, 0),
(93, '2021-12-09', '000091', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 3, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50', 0, NULL, 0),
(94, '2021-12-09', '000092', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 3, 2, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', 0, NULL, 0),
(95, '2021-12-09', '000093', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 2, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', 0, NULL, 0),
(96, '2021-12-09', '000094', NULL, NULL, 'on', NULL, 80, 0, 0, 0, 0, NULL, NULL, 1, 4, 2, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', 0, NULL, 0),
(97, '2021-12-09', '000095', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 2, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46', 0, NULL, 0),
(98, '2021-12-09', '000096', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 4, 2, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41', 0, NULL, 0),
(99, '2021-12-09', '000097', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 3, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', 0, NULL, 0),
(100, '2021-12-09', '000098', NULL, NULL, 'on', NULL, 500, 0, 0, 0, 0, NULL, NULL, 1, 4, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', 0, NULL, 0),
(101, '2021-12-09', '000099', NULL, NULL, 'on', NULL, 1000, 0, 0, 0, 0, NULL, NULL, 1, 103, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', 0, NULL, 0),
(102, '2021-12-09', '000100', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 104, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05', 0, NULL, 0),
(103, '2021-12-11', '000101', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 4, 45, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36', 0, NULL, 0),
(104, '2021-12-12', '000102', NULL, NULL, 'on', NULL, 500, 0, 0, 0, 0, NULL, NULL, 1, 3, 51, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', 0, NULL, 0),
(105, '2021-12-12', '000103', NULL, NULL, 'on', NULL, 500, 0, 0, 0, 0, NULL, NULL, 1, 4, 51, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', 0, NULL, 0),
(106, '2021-12-12', '000104', NULL, NULL, 'on', NULL, 0, 0, 0, 0, 0, NULL, NULL, 1, 103, 51, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17', 0, NULL, 0),
(116, '2021-12-21', '000105', NULL, NULL, 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', 0, NULL, 0),
(117, '2021-12-21', '000106', NULL, NULL, 'on', NULL, 50, 0, 0, 0, 0, NULL, NULL, 1, 4, 53, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', 0, NULL, 0),
(118, '2021-12-21', '000107', NULL, NULL, 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 103, 53, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', 0, NULL, 0),
(119, '2021-12-21', '000108', NULL, NULL, 'on', NULL, 170, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17', 0, NULL, 0),
(120, '2021-12-21', '000109', NULL, NULL, 'on', NULL, 200, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55', 0, NULL, 0),
(123, '2021-12-21', '000112', NULL, NULL, 'on', NULL, 81.09, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55', 0, NULL, 0),
(124, '2021-12-22', '000113', NULL, NULL, 'on', NULL, 5, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42', 0, NULL, 0),
(125, '2021-12-22', '000114', NULL, NULL, 'on', NULL, 5, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59', 0, NULL, 0),
(126, '2021-12-22', '000115', NULL, NULL, 'on', NULL, 100, 0, 0, 0, 0, NULL, NULL, 1, 3, 57, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35', 0, NULL, 0),
(127, '2021-12-23', '000116', NULL, NULL, 'on', NULL, 20, 0, 0, 0, 0, NULL, NULL, 1, 3, 56, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54', 0, NULL, 0),
(128, '2021-12-24', '000117', NULL, NULL, 'on', NULL, 16000, 0, 0, 0, 0, NULL, NULL, 1, 3, 56, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28', 0, NULL, 0),
(129, '2021-12-24', '000118', NULL, NULL, 'on', NULL, 25, 0, 0, 0, 0, NULL, NULL, 1, 3, 53, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15', 0, NULL, 0),
(130, '2022-01-10', '000119', NULL, NULL, 'on', NULL, 170, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41', 0, NULL, 0),
(131, '2022-01-10', '000120', NULL, NULL, 'on', NULL, 170, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29', 0, NULL, 0),
(132, '2022-01-10', '000121', NULL, NULL, 'on', NULL, 180, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10', 0, NULL, 0),
(133, '2022-02-24', '000122', NULL, NULL, 'on', NULL, 200, 0, 0, 0, 0, NULL, NULL, 1, 3, 57, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02', 0, NULL, 0),
(142, '2022-02-24', '000131', NULL, '', 'on', NULL, 2400, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38', 0, NULL, 0),
(143, '2022-02-24', '000132', NULL, '', 'on', NULL, 500, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28', 0, NULL, 0),
(144, '2022-02-24', '000133', NULL, NULL, 'on', NULL, 170, 0, 0, 0, 0, NULL, NULL, 1, 3, 1, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49', 0, NULL, 0),
(146, '2022-02-24', '000135', NULL, NULL, 'on', NULL, 4950, 0, 0, 0, 0, NULL, NULL, 1, 3, 61, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_receives_entries`
--

CREATE TABLE `payment_receives_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `vat_adjustment` double NOT NULL,
  `tax_adjustment` double NOT NULL,
  `others_adjustment` double NOT NULL,
  `payment_receives_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_receives_entries`
--

INSERT INTO `payment_receives_entries` (`id`, `amount`, `vat_adjustment`, `tax_adjustment`, `others_adjustment`, `payment_receives_id`, `invoice_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 0, 0, 0, 0, 2, 2, 1, 1, '2021-11-16 06:53:00', '2021-11-16 06:53:00'),
(3, 0, 0, 0, 0, 3, 2, 1, 1, '2021-11-16 06:54:52', '2021-11-16 06:54:52'),
(4, 0, 0, 0, 0, 4, 7, 1, 1, '2021-11-16 06:55:33', '2021-11-16 06:55:33'),
(5, 0, 0, 0, 0, 5, 7, 1, 1, '2021-11-16 06:57:32', '2021-11-16 06:57:32'),
(6, 10, 0, 0, 0, 6, 7, 1, 1, '2021-11-16 07:01:12', '2021-11-16 07:01:12'),
(7, 0, 0, 0, 0, 7, 7, 1, 1, '2021-11-16 07:02:41', '2021-11-16 07:02:41'),
(8, 0, 0, 0, 0, 8, 8, 1, 1, '2021-11-16 07:03:35', '2021-11-16 07:03:35'),
(10, 0, 0, 0, 0, 10, 8, 1, 1, '2021-11-16 07:08:13', '2021-11-16 07:08:13'),
(11, 0, 0, 0, 0, 11, 2, 1, 1, '2021-11-16 07:09:16', '2021-11-16 07:09:16'),
(12, 0, 0, 0, 0, 12, 7, 1, 1, '2021-11-16 07:10:51', '2021-11-16 07:10:51'),
(13, 0, 0, 0, 0, 13, 2, 1, 1, '2021-11-16 07:17:04', '2021-11-16 07:17:04'),
(14, 10, 0, 0, 0, 14, 2, 1, 1, '2021-11-16 07:20:33', '2021-11-16 07:20:33'),
(15, 0, 0, 0, 0, 15, 2, 1, 1, '2021-11-16 07:22:15', '2021-11-16 07:22:15'),
(16, 0, 0, 0, 0, 16, 7, 1, 1, '2021-11-16 07:42:57', '2021-11-16 07:42:57'),
(17, 100, 0, 0, 0, 17, 15, 1, 1, '2021-12-06 06:37:15', '2021-12-06 06:37:15'),
(18, 300, 0, 0, 0, 18, 19, 1, 1, '2021-12-07 07:20:19', '2021-12-07 07:20:19'),
(19, 10, 0, 0, 0, 19, 20, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21'),
(20, 10, 0, 0, 0, 20, 20, 1, 1, '2021-12-07 07:23:21', '2021-12-07 07:23:21'),
(21, 100, 0, 0, 0, 21, 22, 1, 1, '2021-12-08 07:17:13', '2021-12-08 07:17:13'),
(22, 100, 0, 0, 0, 22, 23, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17'),
(23, 10, 0, 0, 0, 23, 23, 1, 1, '2021-12-08 07:21:17', '2021-12-08 07:21:17'),
(24, 300, 0, 0, 0, 24, 23, 1, 1, '2021-12-08 07:21:18', '2021-12-08 07:21:18'),
(25, 20, 0, 0, 0, 25, 25, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54'),
(26, 30, 0, 0, 0, 26, 25, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54'),
(27, 50, 0, 0, 0, 27, 25, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54'),
(28, 0, 0, 0, 0, 28, 25, 1, 1, '2021-12-08 12:42:54', '2021-12-08 12:42:54'),
(29, 20, 0, 0, 0, 29, 26, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53'),
(30, 30, 0, 0, 0, 30, 26, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53'),
(31, 50, 0, 0, 0, 31, 26, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53'),
(32, 0, 0, 0, 0, 32, 26, 1, 1, '2021-12-08 12:47:53', '2021-12-08 12:47:53'),
(33, 20, 0, 0, 0, 33, 27, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14'),
(34, 40, 0, 0, 0, 34, 27, 1, 1, '2021-12-08 12:51:14', '2021-12-08 12:51:14'),
(35, 50, 0, 0, 0, 35, 27, 1, 1, '2021-12-08 12:51:15', '2021-12-08 12:51:15'),
(36, 20, 0, 0, 0, 36, 28, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42'),
(37, 40, 0, 0, 0, 37, 28, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42'),
(38, 50, 0, 0, 0, 38, 28, 1, 1, '2021-12-08 12:52:42', '2021-12-08 12:52:42'),
(39, 20, 0, 0, 0, 39, 29, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04'),
(40, 40, 0, 0, 0, 40, 29, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04'),
(41, 50, 0, 0, 0, 41, 29, 1, 1, '2021-12-08 12:53:04', '2021-12-08 12:53:04'),
(42, 20, 0, 0, 0, 42, 30, 1, 1, '2021-12-08 12:59:35', '2021-12-08 12:59:35'),
(43, 40, 0, 0, 0, 43, 30, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36'),
(44, 50, 0, 0, 0, 44, 30, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36'),
(45, 0, 0, 0, 0, 45, 30, 1, 1, '2021-12-08 12:59:36', '2021-12-08 12:59:36'),
(46, 20, 0, 0, 0, 46, 31, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37'),
(47, 40, 0, 0, 0, 47, 31, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37'),
(48, 50, 0, 0, 0, 48, 31, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37'),
(49, 0, 0, 0, 0, 49, 31, 1, 1, '2021-12-08 13:06:37', '2021-12-08 13:06:37'),
(50, 20, 0, 0, 0, 50, 32, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45'),
(51, 40, 0, 0, 0, 51, 32, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45'),
(52, 50, 0, 0, 0, 52, 32, 1, 1, '2021-12-08 13:06:45', '2021-12-08 13:06:45'),
(53, 20, 0, 0, 0, 53, 33, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54'),
(54, 40, 0, 0, 0, 54, 33, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54'),
(55, 50, 0, 0, 0, 55, 33, 1, 1, '2021-12-08 13:06:54', '2021-12-08 13:06:54'),
(56, 0, 0, 0, 0, 56, 33, 1, 1, '2021-12-08 13:06:55', '2021-12-08 13:06:55'),
(57, 20, 0, 0, 0, 57, 34, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07'),
(58, 50, 0, 0, 0, 58, 34, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07'),
(59, 60, 0, 0, 0, 59, 34, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07'),
(60, 0, 0, 0, 0, 60, 34, 1, 1, '2021-12-08 13:49:07', '2021-12-08 13:49:07'),
(61, 20, 0, 0, 0, 61, 35, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22'),
(62, 50, 0, 0, 0, 62, 35, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22'),
(63, 60, 0, 0, 0, 63, 35, 1, 1, '2021-12-08 13:50:22', '2021-12-08 13:50:22'),
(64, 20, 0, 0, 0, 64, 36, 1, 1, '2021-12-08 13:50:32', '2021-12-08 13:50:32'),
(65, 50, 0, 0, 0, 65, 36, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33'),
(66, 60, 0, 0, 0, 66, 36, 1, 1, '2021-12-08 13:50:33', '2021-12-08 13:50:33'),
(67, 20, 0, 0, 0, 67, 37, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46'),
(68, 50, 0, 0, 0, 68, 37, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46'),
(69, 60, 0, 0, 0, 69, 37, 1, 1, '2021-12-08 13:51:46', '2021-12-08 13:51:46'),
(70, 0, 0, 0, 0, 70, 37, 1, 1, '2021-12-08 13:51:47', '2021-12-08 13:51:47'),
(71, 20, 0, 0, 0, 71, 38, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16'),
(72, 50, 0, 0, 0, 72, 38, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16'),
(73, 60, 0, 0, 0, 73, 38, 1, 1, '2021-12-08 13:52:16', '2021-12-08 13:52:16'),
(74, 20, 0, 0, 0, 74, 39, 1, 1, '2021-12-08 13:55:15', '2021-12-08 13:55:15'),
(75, 50, 0, 0, 0, 75, 39, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16'),
(76, 60, 0, 0, 0, 76, 39, 1, 1, '2021-12-08 13:55:16', '2021-12-08 13:55:16'),
(77, 20, 0, 0, 0, 77, 40, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36'),
(78, 50, 0, 0, 0, 78, 40, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36'),
(79, 60, 0, 0, 0, 79, 40, 1, 1, '2021-12-08 13:55:36', '2021-12-08 13:55:36'),
(80, 20, 0, 0, 0, 80, 41, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26'),
(81, 50, 0, 0, 0, 81, 41, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26'),
(82, 60, 0, 0, 0, 82, 41, 1, 1, '2021-12-08 13:56:26', '2021-12-08 13:56:26'),
(83, 20, 0, 0, 0, 83, 42, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22'),
(84, 50, 0, 0, 0, 84, 42, 1, 1, '2021-12-08 13:57:22', '2021-12-08 13:57:22'),
(85, 60, 0, 0, 0, 85, 42, 1, 1, '2021-12-08 13:57:23', '2021-12-08 13:57:23'),
(86, 20, 0, 0, 0, 86, 43, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39'),
(87, 30, 0, 0, 0, 87, 43, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39'),
(88, 50, 0, 0, 0, 88, 43, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39'),
(89, 20, 0, 0, 0, 89, 43, 1, 1, '2021-12-09 05:33:39', '2021-12-09 05:33:39'),
(90, 0, 0, 0, 0, 90, 43, 1, 1, '2021-12-09 05:33:40', '2021-12-09 05:33:40'),
(91, 50, 0, 0, 0, 91, 44, 1, 1, '2021-12-09 05:34:49', '2021-12-09 05:34:49'),
(92, 80, 0, 0, 0, 92, 44, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50'),
(93, 0, 0, 0, 0, 93, 44, 1, 1, '2021-12-09 05:34:50', '2021-12-09 05:34:50'),
(94, 50, 0, 0, 0, 94, 45, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46'),
(95, 50, 0, 0, 0, 95, 45, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46'),
(96, 80, 0, 0, 0, 96, 45, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46'),
(97, 0, 0, 0, 0, 97, 45, 1, 1, '2021-12-09 05:37:46', '2021-12-09 05:37:46'),
(98, 0, 0, 0, 0, 98, 46, 1, 1, '2021-12-09 05:46:41', '2021-12-09 05:46:41'),
(99, 50, 0, 0, 0, 99, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05'),
(100, 500, 0, 0, 0, 100, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05'),
(101, 1000, 0, 0, 0, 101, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05'),
(102, 0, 0, 0, 0, 102, 47, 1, 1, '2021-12-09 08:42:05', '2021-12-09 08:42:05'),
(103, 0, 0, 0, 0, 103, 48, 1, 1, '2021-12-11 06:37:36', '2021-12-11 06:37:36'),
(104, 500, 0, 0, 0, 104, 49, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17'),
(105, 500, 0, 0, 0, 105, 49, 1, 1, '2021-12-12 06:07:17', '2021-12-12 06:07:17'),
(106, 0, 0, 0, 0, 106, 49, 1, 1, '2021-12-12 06:07:18', '2021-12-12 06:07:18'),
(116, 100, 0, 0, 0, 116, 61, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17'),
(117, 50, 0, 0, 0, 117, 61, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17'),
(118, 100, 0, 0, 0, 118, 61, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17'),
(119, 170, 0, 0, 0, 119, 61, 26, 26, '2021-12-20 22:16:17', '2021-12-20 22:16:17'),
(120, 200, 0, 0, 0, 120, 62, 26, 26, '2021-12-21 09:01:55', '2021-12-21 09:01:55'),
(123, 81.09, 0, 0, 0, 123, 65, 26, 26, '2021-12-21 09:53:55', '2021-12-21 09:53:55'),
(124, 5, 0, 0, 0, 124, 66, 26, 26, '2021-12-21 21:08:42', '2021-12-21 21:08:42'),
(125, 5, 0, 0, 0, 125, 67, 26, 26, '2021-12-21 21:10:59', '2021-12-21 21:10:59'),
(126, 100, 0, 0, 0, 126, 68, 27, 27, '2021-12-22 09:36:35', '2021-12-22 09:36:35'),
(127, 20, 0, 0, 0, 127, 69, 26, 26, '2021-12-22 18:35:54', '2021-12-22 18:35:54'),
(128, 16000, 0, 0, 0, 128, 70, 26, 26, '2021-12-24 11:17:28', '2021-12-24 11:17:28'),
(129, 25, 0, 0, 0, 129, 71, 26, 26, '2021-12-24 13:43:15', '2021-12-24 13:43:15'),
(130, 170, 0, 0, 0, 130, 72, 25, 25, '2022-01-10 14:10:41', '2022-01-10 14:10:41'),
(131, 170, 0, 0, 0, 131, 73, 25, 25, '2022-01-10 14:19:29', '2022-01-10 14:19:29'),
(132, 180, 0, 0, 0, 132, 74, 25, 25, '2022-01-10 14:24:10', '2022-01-10 14:24:10'),
(133, 200, 0, 0, 0, 133, 76, 27, 27, '2022-02-24 05:22:02', '2022-02-24 05:22:02'),
(143, 2400, 0, 0, 0, 142, 86, 25, 25, '2022-02-24 08:47:38', '2022-02-24 08:47:38'),
(144, 500, 0, 0, 0, 143, 88, 25, 25, '2022-02-24 08:55:28', '2022-02-24 08:55:28'),
(145, 170, 0, 0, 0, 144, 89, 25, 25, '2022-02-24 08:59:49', '2022-02-24 08:59:49'),
(147, 4950, 0, 0, 0, 146, 91, 1, 1, '2022-02-24 09:15:44', '2022-02-24 09:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_transfers`
--

CREATE TABLE `product_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `sr_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `creadit_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial_id` int(195) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_bill`
--

CREATE TABLE `recurring_bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `recurring_bill_no` varchar(195) DEFAULT NULL,
  `order_no` varchar(195) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `day_interval` int(10) DEFAULT NULL,
  `instance` int(10) DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `total_tax` double DEFAULT 0,
  `adjustment` double DEFAULT 0,
  `amount` double DEFAULT NULL,
  `cron` int(10) NOT NULL DEFAULT 0,
  `note` varchar(195) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_bill_entry`
--

CREATE TABLE `recurring_bill_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `rate` double NOT NULL,
  `amount` double NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `recurring_bill_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_invoices`
--

CREATE TABLE `recurring_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `recurring_invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_total` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `due_amount` double DEFAULT NULL,
  `personal_note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `save` tinyint(4) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_recieve_id` int(10) UNSIGNED DEFAULT NULL,
  `vat_adjustment` double DEFAULT NULL,
  `tax_adjustment` double DEFAULT NULL,
  `others_adjustment` double DEFAULT NULL,
  `cms_site_id` int(10) UNSIGNED DEFAULT NULL,
  `delivery_person` int(10) UNSIGNED DEFAULT NULL,
  `receive_person` int(10) UNSIGNED DEFAULT NULL,
  `receive_date` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_installment` varchar(195) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_interval` int(10) DEFAULT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agents_id` int(10) UNSIGNED DEFAULT NULL,
  `agentcommissionAmount` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commission_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_invoice_entries`
--

CREATE TABLE `recurring_invoice_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` int(11) NOT NULL DEFAULT 0,
  `rate` double NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `recurring_invoice_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `carton` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `reminddatetime` datetime DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Can do all the things', 1, 1, '1985-10-27 10:40:24', '2019-05-09 21:20:46'),
(2, 'Accounts Officer', 'Can add entries', 1, 1, '2012-01-07 00:55:33', '2019-05-09 21:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `salescommisions`
--

CREATE TABLE `salescommisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `agents_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scNumber` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `CustomerNote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PersonalNote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `paid_through_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_hide_show`
--

CREATE TABLE `sidebar_hide_show` (
  `id` int(11) NOT NULL,
  `sidebar_id` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_transfer_id` int(10) UNSIGNED DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `credit_note_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `stock_transfer_id`, `total`, `date`, `item_category_id`, `item_id`, `bill_id`, `credit_note_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `project_id`) VALUES
(3, 8, 786, '2021-11-20', 8, 9, NULL, NULL, 4, 1, 1, '2021-11-17 10:29:50', '2021-11-20 13:22:37', NULL),
(16, NULL, 12, '2021-11-20', 10, 140, 12, NULL, 1, 1, 1, '2021-11-20 10:29:53', '2021-11-20 10:29:53', NULL),
(17, NULL, 12, '2021-11-01', 10, 140, 11, NULL, 1, 1, 1, '2021-11-20 10:30:02', '2021-11-20 10:30:02', NULL),
(20, NULL, 2, '2021-11-20', 10, 140, NULL, 2, 1, 1, 1, '2021-11-20 10:52:28', '2021-11-20 10:52:28', NULL),
(21, NULL, 2, '2021-11-01', 10, 140, NULL, 1, 1, 1, 1, '2021-11-20 10:52:38', '2021-11-20 10:52:38', NULL),
(22, 9, 4, '2021-11-20', 10, 140, NULL, NULL, 2, 1, 1, '2021-11-20 10:55:30', '2021-11-20 10:56:36', NULL),
(23, 10, 3, '2021-11-20', 10, 140, NULL, NULL, 1, 1, 1, '2021-11-20 10:58:13', '2021-11-20 12:51:39', NULL),
(24, 11, 506, '1985-01-01', 10, 7, NULL, NULL, 2, 1, 1, '2021-11-20 13:30:01', '2021-11-20 13:30:15', NULL),
(25, NULL, 10, '2021-12-21', 21, 144, 13, NULL, 3, 26, 26, '2021-12-20 18:27:25', '2021-12-20 18:27:25', NULL),
(26, NULL, 10, '2021-12-21', 22, 145, 14, NULL, 3, 26, 26, '2021-12-21 08:58:14', '2021-12-21 08:58:14', NULL),
(30, NULL, 1, '2021-12-22', 21, 144, NULL, 5, 3, 26, 26, '2021-12-21 20:49:28', '2021-12-21 20:49:28', NULL),
(31, NULL, 1, '2021-12-22', 21, 144, NULL, 6, 3, 26, 26, '2021-12-21 21:03:56', '2021-12-21 21:03:56', NULL),
(32, NULL, 9, '2021-12-22', 97, 1427, 16, NULL, 4, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09', NULL),
(33, NULL, 5, '2021-12-22', 97, 1428, 16, NULL, 4, 27, 27, '2021-12-22 07:03:09', '2021-12-22 07:03:09', NULL),
(34, NULL, 6, '2021-12-22', 97, 1430, 17, NULL, 4, 27, 27, '2021-12-22 07:06:27', '2021-12-22 07:06:27', NULL),
(36, NULL, 10, '2022-01-29', 97, 1427, 19, NULL, 4, 27, 27, '2022-01-29 11:15:29', '2022-01-29 11:15:29', NULL),
(37, NULL, 1, '2022-01-29', 97, 1427, NULL, 7, 4, 27, 27, '2022-01-29 11:17:48', '2022-01-29 11:17:48', NULL),
(41, NULL, 60, '2016-01-01', 45, 1064, 21, NULL, 3, 26, 26, '2022-02-24 06:57:20', '2022-02-24 06:57:20', NULL),
(45, NULL, 50, '2022-02-24', 18, 1796, 23, NULL, 2, 25, 25, '2022-02-24 08:32:00', '2022-02-24 08:32:00', NULL),
(46, NULL, 80, '2010-01-01', 18, 3, 24, NULL, 2, 25, 25, '2022-02-24 08:34:24', '2022-02-24 08:34:24', NULL),
(47, NULL, 100, '2022-02-24', 18, 2105, 25, NULL, 2, 25, 25, '2022-02-24 08:46:12', '2022-02-24 08:46:12', NULL),
(48, NULL, 50, '2022-02-24', 18, 1797, 26, NULL, 2, 25, 25, '2022-02-24 09:35:21', '2022-02-24 09:35:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_serial`
--

CREATE TABLE `stock_serial` (
  `id` int(10) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock_status` int(10) UNSIGNED DEFAULT 1,
  `damage_return` int(10) UNSIGNED DEFAULT NULL COMMENT '1 = this product already user for damage return'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_serial_status`
--

CREATE TABLE `stock_serial_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_serial_status`
--

INSERT INTO `stock_serial_status` (`id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Aavailable', NULL, NULL),
(2, 'Sold', NULL, NULL),
(3, 'For Sale', NULL, NULL),
(4, 'Service in SR', NULL, NULL),
(5, 'Service In Head Office', NULL, NULL),
(6, 'Service Out From SR', NULL, NULL),
(7, 'Service Out from Head Office', NULL, NULL),
(8, 'Damage Return SR', NULL, NULL),
(9, 'Damage Return Head office', NULL, NULL),
(10, 'Unsold', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_from` int(10) UNSIGNED NOT NULL,
  `transfer_to` int(10) UNSIGNED NOT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_transfers`
--

INSERT INTO `stock_transfers` (`id`, `transfer_from`, `transfer_to`, `item_category_id`, `item_id`, `quantity`, `date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(8, 3, 4, 8, 9, 786, '2021-11-20', 1, 1, '2021-11-17 10:29:50', '2021-11-20 13:22:37'),
(9, 1, 2, 10, 140, 4, '2021-11-20', 1, 1, '2021-11-20 10:55:30', '2021-11-20 10:56:36'),
(10, 2, 1, 10, 140, 3, '2021-11-04', 1, 1, '2021-11-20 10:58:13', '2021-11-20 12:58:36'),
(11, 1, 2, 10, 7, 506, '1985-01-01', 1, 1, '2021-11-20 13:30:01', '2021-11-20 13:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount_percentage` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_name`, `amount_percentage`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '0%-tax', 0, 1, 1, '1986-05-24 08:21:22', '2009-03-16 07:52:02'),
(2, '10%-tax', 10, 1, 1, '1986-05-24 08:21:22', '2009-03-16 07:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) DEFAULT 1,
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `contact`, `note`, `email`, `password`, `type`, `activated`, `role_id`, `branch_id`, `contact_id`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Head Office User', 'lazychat-app-icon_07c9549339609d5b881cd9cdff21f961a6c7258f.png', '', '', 'test@ontik.net', '$2y$10$kg38pUJST/NWhz7nryNDHe797mT0.HuDT1hPPiOJBmVLmOVtAEr06', 0, 1, 1, 1, NULL, 1, 1, 'OmBEOK97YT6AnJHAuZmKg3V9JwQpGtfJnkwDqayX0XS3Y2p6QaCap0olDohx', '2019-01-08 20:23:44', '2021-11-18 10:08:07', NULL),
(25, 'Fashion House Admin', 'WhatsApp-Image-2021-10-30-at-11.32_7413bb4aa8615e17a59f609526db7ef3d9d8810f.jpg', '', '', 'test1@ontik.net', '$2y$10$YQDV6H2tjAH5oeAvrmhhwebe67DXd/Z36SMrxjkZiqknOD.Lutlla', 1, 1, 1, 2, NULL, 25, 25, 'SWERhPuPckI5kohp9DvidrrMN0lMhU8TS8m68HyCiXuS1pc2UM3pqmfgk9yX', '2021-11-04 08:44:56', '2021-11-18 08:48:28', NULL),
(26, 'Grocery Shop Admin', 'pp_90cc98f3209ec12ed5b113a4387725d17b7313a6.jpg', '', '', 'test2@ontik.net', '$2y$10$Gi5F5.69IcUz8Q6xCM3gOeLuN4wbcP5HRGGiLYbzLwyuS5NbSYxn.', 1, 1, 1, 3, NULL, 26, 26, '9GbOcRdccKCkhdmW5PE5Kmqx680LToTeNy379gTHT2sMnajWCnBR1QUvwgTQ', '2021-12-20 16:33:31', '2021-12-21 07:01:51', '5151515'),
(27, 'Gift Shop Admin', '', '', '', 'test3@ontik.net', '$2y$10$aJOeBE0EcYwpqwZNb7sbKujxx5B2MZ3dzKpseSy9ENwzC19XLOMg6', 1, 1, 1, 4, NULL, NULL, NULL, 'EUBkRPnO42Pk7hqlPkKAHwfKiHvC782rEVK8NYBPOH8VNJMfL8Vk2tYnrpVs', '2021-12-21 09:38:40', '2021-12-21 09:38:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 23, '248ca3daefc51a7acf595f60a8f343a0298747c81cdc3e4ef76ea6bf9ff37743', '2021-09-05 07:55:31', '2021-09-05 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit`
--

CREATE TABLE `vendor_credit` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_credit_no` int(191) NOT NULL,
  `vendor_name` int(10) UNSIGNED NOT NULL,
  `vendor_credit_date` date NOT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `sub_category` int(10) UNSIGNED NOT NULL,
  `sub_total` double NOT NULL,
  `adjustment` double NOT NULL,
  `vat_tax` double NOT NULL,
  `total` double NOT NULL,
  `presonal_note` longtext DEFAULT NULL,
  `customer_note` longtext DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_credit`
--

INSERT INTO `vendor_credit` (`id`, `vendor_credit_no`, `vendor_name`, `vendor_credit_date`, `bill_id`, `category`, `sub_category`, `sub_total`, `adjustment`, `vat_tax`, `total`, `presonal_note`, `customer_note`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-11-01', 11, 0, 0, 30, 0, 0, 30, '            \r\n        ', '        \r\n    ', ' ', 1, 1, '2021-11-20 10:32:43', '2021-11-20 10:35:52'),
(2, 2, 1, '2021-11-20', NULL, 0, 0, 30, 0, 0, 30, '            \r\n        ', '        \r\n    ', ' ', 1, 1, '2021-11-20 10:33:34', '2021-11-20 10:36:07'),
(3, 3, 55, '2022-01-29', NULL, 0, 0, 150, 0, 0, 150, '', '', '', 27, 27, '2022-01-29 11:15:48', '2022-01-29 11:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_entry`
--

CREATE TABLE `vendor_credit_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `vendor_credit_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor_credit_entry`
--

INSERT INTO `vendor_credit_entry` (`id`, `item_id`, `description`, `account_id`, `quantity`, `rate`, `tax_id`, `amount`, `vendor_credit_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 140, '', 26, 3, 10, 1, 30, 1, 1, 1, '2021-11-20 10:35:52', '2021-11-20 10:35:52'),
(4, 140, '', 26, 3, 10, 1, 30, 2, 1, 1, '2021-11-20 10:36:07', '2021-11-20 10:36:07'),
(5, 1427, '', 26, 5, 30, 1, 150, 3, 27, 27, '2022-01-29 11:15:48', '2022-01-29 11:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_payments`
--

CREATE TABLE `vendor_credit_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `vendor_credit_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_credit_refunds`
--

CREATE TABLE `vendor_credit_refunds` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `payment_mode_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `vendor_credit_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_level_module_id_foreign` (`module_id`),
  ADD KEY `access_level_role_id_foreign` (`role_id`),
  ADD KEY `access_level_created_by_foreign` (`created_by`),
  ADD KEY `access_level_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_account_type_id_foreign` (`account_type_id`),
  ADD KEY `account_parent_account_type_id_foreign` (`parent_account_type_id`),
  ADD KEY `account_branch_id_foreign` (`branch_id`),
  ADD KEY `account_created_by_foreign` (`created_by`),
  ADD KEY `account_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_type_parent_account_type_id_foreign` (`parent_account_type_id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_created_by_foreign` (`created_by`),
  ADD KEY `backup_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_contact_id_foreign` (`contact_id`),
  ADD KEY `bank_account_id_foreign` (`account_id`),
  ADD KEY `bank_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `bank_created_by_foreign` (`created_by`),
  ADD KEY `bank_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_vendor_id_foreign` (`vendor_id`),
  ADD KEY `bill_cms_site_id_foreign` (`cms_site_id`),
  ADD KEY `bill_created_by_foreign` (`created_by`),
  ADD KEY `bill_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `bill_entry`
--
ALTER TABLE `bill_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_entry_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_entry_account_id_foreign` (`account_id`),
  ADD KEY `bill_entry_tax_id_foreign` (`tax_id`),
  ADD KEY `bill_entry_item_id_foreign` (`item_id`),
  ADD KEY `bill_entry_created_by_foreign` (`created_by`),
  ADD KEY `bill_entry_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_return_entries_bill_entries_id_foreign` (`bill_entries_id`),
  ADD KEY `bill_return_entries_created_by_foreign` (`created_by`),
  ADD KEY `bill_return_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill_submit`
--
ALTER TABLE `bill_submit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_submit_account_id_foreign` (`account_id`),
  ADD KEY `bill_submit_vendor_name_foreign` (`vendor_name`),
  ADD KEY `bill_submit_created_by_foreign` (`created_by`),
  ADD KEY `bill_submit_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_submit_id` (`bill_submit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `bill_submit_entries`
--
ALTER TABLE `bill_submit_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_created_by_foreign` (`created_by`),
  ADD KEY `branch_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_entries`
--
ALTER TABLE `cart_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_contact_category_id_foreign` (`contact_category_id`),
  ADD KEY `contact_agent_id_foreign` (`agent_id`),
  ADD KEY `contact_branch_id_foreign` (`branch_id`),
  ADD KEY `contact_created_by_foreign` (`created_by`),
  ADD KEY `contact_updated_by_foreign` (`updated_by`),
  ADD KEY `contact_account_id_foreign` (`account_id`);

--
-- Indexes for table `contact_category`
--
ALTER TABLE `contact_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_category_created_by_foreign` (`created_by`),
  ADD KEY `contact_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_notes_customer_id_foreign` (`customer_id`),
  ADD KEY `credit_notes_created_by_foreign` (`created_by`),
  ADD KEY `credit_notes_updated_by_foreign` (`updated_by`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `item_category` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_entries_item_id_foreign` (`item_id`),
  ADD KEY `credit_note_entries_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `credit_note_entries_account_id_foreign` (`account_id`),
  ADD KEY `credit_note_entries_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `credit_note_payments_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_payments_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_payments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_note_refunds_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `credit_note_refunds_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `credit_note_refunds_account_id_foreign` (`account_id`),
  ADD KEY `credit_note_refunds_created_by_foreign` (`created_by`),
  ADD KEY `credit_note_refunds_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_created_by_foreign` (`created_by`),
  ADD KEY `email_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimates_customer_id_foreign` (`customer_id`),
  ADD KEY `estimates_created_by_foreign` (`created_by`),
  ADD KEY `estimates_updated_by_foreign` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`);

--
-- Indexes for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimate_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `estimate_entries_item_id_foreign` (`item_id`),
  ADD KEY `estimate_entries_estimate_id_foreign` (`estimate_id`),
  ADD KEY `estimate_entries_created_by_foreign` (`created_by`),
  ADD KEY `estimate_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `excess_payment`
--
ALTER TABLE `excess_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `excess_payment_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `excess_payment_invoice_id_foreign` (`invoice_id`),
  ADD KEY `excess_payment_created_by_foreign` (`created_by`),
  ADD KEY `excess_payment_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_paid_through_id_foreign` (`paid_through_id`),
  ADD KEY `expense_account_id_foreign` (`account_id`),
  ADD KEY `expense_cms_site_id_foreign` (`cms_site_id`),
  ADD KEY `expense_vendor_id_foreign` (`vendor_id`),
  ADD KEY `expense_tax_id_foreign` (`tax_id`),
  ADD KEY `expense_created_by_foreign` (`created_by`),
  ADD KEY `expense_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `headertemplate`
--
ALTER TABLE `headertemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_receive_through_id_foreign` (`receive_through_id`),
  ADD KEY `incomes_account_id_foreign` (`account_id`),
  ADD KEY `incomes_customer_id_foreign` (`customer_id`),
  ADD KEY `incomes_tax_id_foreign` (`tax_id`),
  ADD KEY `incomes_created_by_foreign` (`created_by`),
  ADD KEY `incomes_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_updated_by_foreign` (`updated_by`),
  ADD KEY `invoices_agents_id_foreign` (`agents_id`),
  ADD KEY `invoices_payment_recieve_id_foreign` (`payment_recieve_id`),
  ADD KEY `cms_site_id` (`cms_site_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `invoices_ibfk_1` (`item_category_id`),
  ADD KEY `invoices_ibfk_3` (`delivery_person`),
  ADD KEY `invoices_ibfk_4` (`receive_person`);

--
-- Indexes for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `raw_material_id` (`raw_material_id`),
  ADD KEY `invoices_id` (`invoices_id`) USING BTREE;

--
-- Indexes for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_entries_item_id_foreign` (`item_id`),
  ADD KEY `invoice_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `invoice_entries_account_id_foreign` (`account_id`),
  ADD KEY `invoice_entries_created_by_foreign` (`created_by`),
  ADD KEY `invoice_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_return_entries_invoice_entries_id_foreign` (`invoice_entries_id`),
  ADD KEY `invoice_return_entries_created_by_foreign` (`created_by`),
  ADD KEY `invoice_return_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_company_id_foreign` (`company_id`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_category_branch_id_foreign` (`branch_id`),
  ADD KEY `item_category_created_by_foreign` (`created_by`),
  ADD KEY `item_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sub_category_item_category_id_foreign` (`item_category_id`),
  ADD KEY `item_sub_category_created_by_foreign` (`created_by`),
  ADD KEY `item_sub_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_branch_id_foreign` (`branch_id`),
  ADD KEY `journal_created_by_foreign` (`created_by`),
  ADD KEY `journal_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_entries_journal_id_foreign` (`journal_id`),
  ADD KEY `journal_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `journal_entries_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `journal_entries_payment_receives_entries_id_foreign` (`payment_receives_entries_id`),
  ADD KEY `journal_entries_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `journal_entries_credit_note_refunds_id_foreign` (`credit_note_refunds_id`),
  ADD KEY `journal_entries_expense_id_foreign` (`expense_id`),
  ADD KEY `journal_entries_bill_id_foreign` (`bill_id`),
  ADD KEY `journal_entries_bank_id_foreign` (`bank_id`),
  ADD KEY `journal_entries_bill_entry_id_foreign` (`bill_entry_id`),
  ADD KEY `journal_entries_payment_made_id_foreign` (`payment_made_id`),
  ADD KEY `journal_entries_payment_made_entry_id_foreign` (`payment_made_entry_id`),
  ADD KEY `journal_entries_account_name_id_foreign` (`account_name_id`),
  ADD KEY `journal_entries_contact_id_foreign` (`contact_id`),
  ADD KEY `journal_entries_income_id_foreign` (`income_id`),
  ADD KEY `journal_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `journal_entries_created_by_foreign` (`created_by`),
  ADD KEY `journal_entries_updated_by_foreign` (`updated_by`),
  ADD KEY `journal_entries_salescomission_id_foreign` (`salesComission_id`),
  ADD KEY `journal_entries_agent_id_foreign` (`agent_id`),
  ADD KEY `vendore_credit_id` (`vendor_credit_id`),
  ADD KEY `vendor_credit_refunds_id` (`vendor_credit_refunds_id`),
  ADD KEY `recurring_invoice_id` (`recurring_invoice_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_profiles`
--
ALTER TABLE `organization_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_account_type`
--
ALTER TABLE `parent_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_made`
--
ALTER TABLE `payment_made`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_made_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `payment_made_account_id_foreign` (`account_id`),
  ADD KEY `payment_made_vendor_id_foreign` (`vendor_id`),
  ADD KEY `payment_made_created_by_foreign` (`created_by`),
  ADD KEY `payment_made_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_made_entry_payment_made_id_foreign` (`payment_made_id`),
  ADD KEY `payment_made_entry_bill_id_foreign` (`bill_id`),
  ADD KEY `payment_made_entry_created_by_foreign` (`created_by`),
  ADD KEY `payment_made_entry_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receives`
--
ALTER TABLE `payment_receives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_receives_payment_mode_id_foreign` (`payment_mode_id`),
  ADD KEY `payment_receives_account_id_foreign` (`account_id`),
  ADD KEY `payment_receives_customer_id_foreign` (`customer_id`),
  ADD KEY `payment_receives_created_by_foreign` (`created_by`),
  ADD KEY `payment_receives_updated_by_foreign` (`updated_by`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_receives_entries_payment_receives_id_foreign` (`payment_receives_id`),
  ADD KEY `payment_receives_entries_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payment_receives_entries_created_by_foreign` (`created_by`),
  ADD KEY `payment_receives_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `product_transfers`
--
ALTER TABLE `product_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `sr_id` (`sr_id`);

--
-- Indexes for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recurring_bill_no` (`recurring_bill_no`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `item_category_id` (`item_category_id`),
  ADD KEY `item_sub_category` (`item_sub_category_id`);

--
-- Indexes for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `recurring_bill_id` (`recurring_bill_id`);

--
-- Indexes for table `recurring_invoices`
--
ALTER TABLE `recurring_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recurring_invoices_invoice_number_unique` (`recurring_invoice_number`),
  ADD KEY `recurring_invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `recurring_invoices_created_by_foreign` (`created_by`),
  ADD KEY `recurring_invoices_updated_by_foreign` (`updated_by`),
  ADD KEY `recurring_invoices_payment_recieve_id_foreign` (`payment_recieve_id`),
  ADD KEY `cms_site_id` (`cms_site_id`),
  ADD KEY `item_sub_category_id` (`item_sub_category_id`),
  ADD KEY `recurring_invoices_ibfk_1` (`item_category_id`),
  ADD KEY `recurring_invoices_ibfk_3` (`delivery_person`),
  ADD KEY `recurring_invoices_ibfk_4` (`receive_person`);

--
-- Indexes for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recurring_invoice_entries_item_id_foreign` (`item_id`),
  ADD KEY `recurring_invoice_entries_invoice_id_foreign` (`recurring_invoice_id`),
  ADD KEY `recurring_invoice_entries_tax_id_foreign` (`tax_id`),
  ADD KEY `recurring_invoice_entries_account_id_foreign` (`account_id`),
  ADD KEY `recurring_invoice_entries_created_by_foreign` (`created_by`),
  ADD KEY `recurring_invoice_entries_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_created_by_foreign` (`created_by`),
  ADD KEY `reminders_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `salescommisions`
--
ALTER TABLE `salescommisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salescommisions_agents_id_foreign` (`agents_id`),
  ADD KEY `salescommisions_created_by_foreign` (`created_by`),
  ADD KEY `salescommisions_updated_by_foreign` (`updated_by`),
  ADD KEY `salescommisions_paid_through_id_foreign` (`paid_through_id`);

--
-- Indexes for table `sidebar_hide_show`
--
ALTER TABLE `sidebar_hide_show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_item_category_id_foreign` (`item_category_id`),
  ADD KEY `stock_item_id_foreign` (`item_id`),
  ADD KEY `stock_bill_id_foreign` (`bill_id`),
  ADD KEY `stock_credit_note_id_foreign` (`credit_note_id`),
  ADD KEY `stock_branch_id_foreign` (`branch_id`),
  ADD KEY `stock_created_by_foreign` (`created_by`),
  ADD KEY `stock_updated_by_foreign` (`updated_by`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `stock_transfer_id` (`stock_transfer_id`);

--
-- Indexes for table `stock_serial`
--
ALTER TABLE `stock_serial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `stock_serial_ibfk_4` (`updated_by`),
  ADD KEY `stock_status` (`stock_status`);

--
-- Indexes for table `stock_serial_status`
--
ALTER TABLE `stock_serial_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_from` (`transfer_from`),
  ADD KEY `transfer_to` (`transfer_to`),
  ADD KEY `transfer_item` (`item_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `item_category_id` (`item_category_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_created_by_foreign` (`created_by`),
  ADD KEY `tax_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activations_token_index` (`token`);

--
-- Indexes for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `vendore_name` (`vendor_name`);

--
-- Indexes for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendore_credit_entry_bill_id_foreign` (`vendor_credit_id`),
  ADD KEY `vendore_credit_entry_account_id_foreign` (`account_id`),
  ADD KEY `vendore_credit_entry_tax_id_foreign` (`tax_id`),
  ADD KEY `vendore_credit_entry_item_id_foreign` (`item_id`),
  ADD KEY `vendore_credit_entry_created_by_foreign` (`created_by`),
  ADD KEY `vendore_credit_entry_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `vendor_credit_id` (`vendor_credit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `vendor_credit_id` (`vendor_credit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bill_entry`
--
ALTER TABLE `bill_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submit`
--
ALTER TABLE `bill_submit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_submit_entries`
--
ALTER TABLE `bill_submit_entries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `cart_entries`
--
ALTER TABLE `cart_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `contact_category`
--
ALTER TABLE `contact_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `excess_payment`
--
ALTER TABLE `excess_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `headertemplate`
--
ALTER TABLE `headertemplate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2153;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `organization_profiles`
--
ALTER TABLE `organization_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parent_account_type`
--
ALTER TABLE `parent_account_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_made`
--
ALTER TABLE `payment_made`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_receives`
--
ALTER TABLE `payment_receives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `product_transfers`
--
ALTER TABLE `product_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_invoices`
--
ALTER TABLE `recurring_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salescommisions`
--
ALTER TABLE `salescommisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sidebar_hide_show`
--
ALTER TABLE `sidebar_hide_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `stock_serial`
--
ALTER TABLE `stock_serial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_serial_status`
--
ALTER TABLE `stock_serial_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_level`
--
ALTER TABLE `access_level`
  ADD CONSTRAINT `access_level_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_level_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_account_type_id_foreign` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_type`
--
ALTER TABLE `account_type`
  ADD CONSTRAINT `account_type_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `backup`
--
ALTER TABLE `backup`
  ADD CONSTRAINT `backup_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `backup_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_cms_site_id_foreign` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  ADD CONSTRAINT `bill_due_table_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_due_table_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_due_table_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_entry`
--
ALTER TABLE `bill_entry`
  ADD CONSTRAINT `bill_entry_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_return_entries`
--
ALTER TABLE `bill_return_entries`
  ADD CONSTRAINT `bill_return_entries_bill_entries_id_foreign` FOREIGN KEY (`bill_entries_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_return_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_return_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bill_submit`
--
ALTER TABLE `bill_submit`
  ADD CONSTRAINT `bill_submit_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submit_vendor_name_foreign` FOREIGN KEY (`vendor_name`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_submits_due_dates`
--
ALTER TABLE `bill_submits_due_dates`
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_1` FOREIGN KEY (`bill_submit_id`) REFERENCES `bill_submit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_submits_due_dates_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branch_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_contact_category_id_foreign` FOREIGN KEY (`contact_category_id`) REFERENCES `contact_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_category`
--
ALTER TABLE `contact_category`
  ADD CONSTRAINT `contact_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD CONSTRAINT `credit_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_ibfk_3` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_notes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  ADD CONSTRAINT `credit_note_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  ADD CONSTRAINT `credit_note_payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  ADD CONSTRAINT `credit_note_refunds_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credit_note_refunds_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `estimates`
--
ALTER TABLE `estimates`
  ADD CONSTRAINT `estimates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimates_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `estimate_entries`
--
ALTER TABLE `estimate_entries`
  ADD CONSTRAINT `estimate_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estimate_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `excess_payment`
--
ALTER TABLE `excess_payment`
  ADD CONSTRAINT `excess_payment_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `excess_payment_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_cms_site_id_foreign` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_receive_through_id_foreign` FOREIGN KEY (`receive_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `cms_site_id` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`delivery_person`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_4` FOREIGN KEY (`receive_person`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_payment_recieve_id_foreign` FOREIGN KEY (`payment_recieve_id`) REFERENCES `payment_receives` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices_measurements`
--
ALTER TABLE `invoices_measurements`
  ADD CONSTRAINT `invoices_measurements_invoices_id` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_measurements_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_measurements_raw_material_id` FOREIGN KEY (`raw_material_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  ADD CONSTRAINT `invoice_due_table_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_due_table_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_due_table_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  ADD CONSTRAINT `invoice_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  ADD CONSTRAINT `invoice_return_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_return_entries_invoice_entries_id_foreign` FOREIGN KEY (`invoice_entries_id`) REFERENCES `invoice_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_return_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_id` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_id` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_category`
--
ALTER TABLE `item_category`
  ADD CONSTRAINT `item_category_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  ADD CONSTRAINT `item_sub_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sub_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_account_name_id_foreign` FOREIGN KEY (`account_name_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bill_entry_id_foreign` FOREIGN KEY (`bill_entry_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_credit_note_refunds_id_foreign` FOREIGN KEY (`credit_note_refunds_id`) REFERENCES `credit_note_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_1` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_2` FOREIGN KEY (`vendor_credit_refunds_id`) REFERENCES `vendor_credit_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_ibfk_3` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_made_entry_id_foreign` FOREIGN KEY (`payment_made_entry_id`) REFERENCES `payment_made_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_receives_entries_id_foreign` FOREIGN KEY (`payment_receives_entries_id`) REFERENCES `payment_receives_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_salescomission_id_foreign` FOREIGN KEY (`salesComission_id`) REFERENCES `salescommisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_made`
--
ALTER TABLE `payment_made`
  ADD CONSTRAINT `payment_made_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  ADD CONSTRAINT `payment_made_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_made_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receives`
--
ALTER TABLE `payment_receives`
  ADD CONSTRAINT `payment_receives_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  ADD CONSTRAINT `payment_receives_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_receives_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_transfers`
--
ALTER TABLE `product_transfers`
  ADD CONSTRAINT `product_transfers_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_transfers_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_transfers_ibfk_3` FOREIGN KEY (`sr_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_bill`
--
ALTER TABLE `recurring_bill`
  ADD CONSTRAINT `recurring_bill_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_4` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_ibfk_5` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_bill_entry`
--
ALTER TABLE `recurring_bill_entry`
  ADD CONSTRAINT `recurring_bill_entry_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_bill_entry_ibfk_4` FOREIGN KEY (`recurring_bill_id`) REFERENCES `recurring_bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_invoice_entries`
--
ALTER TABLE `recurring_invoice_entries`
  ADD CONSTRAINT `recurring_invoice_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_invoice_id_foreign` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_invoice_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salescommisions`
--
ALTER TABLE `salescommisions`
  ADD CONSTRAINT `salescommisions_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salescommisions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`stock_transfer_id`) REFERENCES `stock_transfers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_serial`
--
ALTER TABLE `stock_serial`
  ADD CONSTRAINT `stock_serial_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stock_serial_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_5` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_6` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_serial_ibfk_7` FOREIGN KEY (`stock_status`) REFERENCES `stock_serial_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD CONSTRAINT `stock_transfers_ibfk_1` FOREIGN KEY (`transfer_from`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_2` FOREIGN KEY (`transfer_to`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_6` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tax`
--
ALTER TABLE `tax`
  ADD CONSTRAINT `tax_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `users_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `vendor_credit`
--
ALTER TABLE `vendor_credit`
  ADD CONSTRAINT `vendor_credit_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_ibfk_2` FOREIGN KEY (`vendor_name`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_entry`
--
ALTER TABLE `vendor_credit_entry`
  ADD CONSTRAINT `vendore_credit_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_bill_id_foreign` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendore_credit_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_payments`
--
ALTER TABLE `vendor_credit_payments`
  ADD CONSTRAINT `vendor_credit_payments_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_2` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_payments_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_credit_refunds`
--
ALTER TABLE `vendor_credit_refunds`
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_1` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_3` FOREIGN KEY (`vendor_credit_id`) REFERENCES `vendor_credit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_credit_refunds_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
