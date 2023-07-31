-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2021 at 01:22 PM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.32

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
(229, 1, 1, 1, 1, 116, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(230, 1, 1, 1, 1, 116, 2, 1, 1, '2019-05-10 02:21:34', '2019-07-20 08:41:13'),
(231, 1, 1, 1, 1, 117, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(232, 1, 1, 1, 1, 117, 2, 1, 1, '2019-05-10 02:21:34', '2019-07-20 08:41:13'),
(233, 1, 1, 1, 1, 118, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(234, 1, 1, 1, 1, 118, 2, 1, 1, '2019-05-10 02:21:34', '2019-07-20 08:41:13'),
(235, 1, 1, 1, 1, 119, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(236, 1, 1, 1, 1, 119, 2, 1, 1, '2019-05-10 02:21:34', '2019-07-20 08:41:13'),
(237, 0, 0, 0, 0, 120, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(238, 0, 0, 0, 0, 120, 2, 1, 1, '2019-05-10 02:21:34', '2019-07-20 08:41:13'),
(239, 1, 1, 1, 1, 121, 1, 1, 1, '2019-05-10 02:21:34', '2019-07-14 10:51:49'),
(241, 1, 1, 1, 1, 115, 1, 1, 1, '2019-07-14 10:51:49', '2019-07-14 10:52:02'),
(242, 1, 1, 1, 1, 121, 2, 1, 1, '2019-07-14 10:51:49', '2019-07-14 10:52:02'),
(243, 1, 1, 1, 1, 115, 2, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(244, 1, 1, 1, 1, 122, 1, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(245, 1, 1, 1, 1, 122, 2, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(246, 1, 1, 1, 1, 123, 1, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(247, 1, 1, 1, 1, 123, 2, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(248, 1, 1, 1, 1, 124, 1, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13'),
(249, 1, 1, 1, 1, 124, 2, 1, 1, '2019-07-20 08:41:13', '2019-07-20 08:41:13');

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
(103, 'DBBL', 'DBBL', NULL, NULL, '1', 5, 1, NULL, 1, 1, '2021-09-05 08:03:13', '2021-09-05 08:03:13');

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
(2, 'dr.jami', '', NULL, 'dr.jami', '', '', NULL, '01726521667', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '1', 1, NULL, 1, 1, 1, '2021-11-06 12:53:46', '2021-11-06 12:53:46', NULL, NULL, '', '', NULL, NULL);

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
  `barcode_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_manufacture` double DEFAULT NULL,
  `total_use` double DEFAULT NULL,
  `total_purchase_return` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name`, `item_about`, `item_sales_rate`, `item_sales_account`, `item_sales_description`, `item_sales_tax`, `item_purchase_rate`, `item_purchase_account`, `item_purchase_description`, `reorder_point`, `barcode`, `item_image_url`, `total_purchases`, `total_sales`, `unit_type`, `item_category_id`, `item_sub_category_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `subject_name`, `barcode_no`, `total_manufacture`, `total_use`, `total_purchase_return`) VALUES
(3, 'jewellery', 'top', '200', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:49:32', '2021-11-08 17:49:32', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'jewellery', 'pearl mala', '300', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:50:56', '2021-11-08 17:50:56', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'jewellery', 'ring', '150', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:53:16', '2021-11-08 17:53:16', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'jewellery', 'puthir mala', '450', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 17:55:46', '2021-11-08 17:55:46', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'bags', 'emoji bags', '200', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 107, 1, 1, 1, '2021-11-08 18:02:37', '2021-11-08 18:04:08', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'jewellery', 'diamond cutlet', '400', NULL, NULL, NULL, '235', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-08 18:06:08', '2021-11-08 18:10:22', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'jewellery', 'mala set', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:11:54', '2021-11-08 18:11:54', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'jewellery', 'golden earings', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:12:49', '2021-11-08 18:12:49', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'jewellery', 'antique round earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:14:33', '2021-11-08 18:14:33', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'jewellery', 'small stone earings', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:15:22', '2021-11-08 18:15:22', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'jewellery', 'big stone earings', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:16:22', '2021-11-08 18:16:22', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'jewellery', 'antique neck piece', '450', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:18:35', '2021-11-08 18:18:35', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'jewellery', 'pearl stone mala', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:19:52', '2021-11-08 18:19:52', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'jewellery', 'big locket mala', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:21:05', '2021-11-08 18:21:05', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'jewellery', 'big locket mala', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:21:58', '2021-11-08 18:21:58', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'jewellery', 'antique mala peacock', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:23:10', '2021-11-08 18:23:10', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'jewellery', 'kundan set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:24:36', '2021-11-08 18:24:36', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'jewellery', 'antique big ', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:25:32', '2021-11-08 18:25:32', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'jewellery', 'antique big multi mal', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:26:25', '2021-11-08 18:26:25', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'jewellery', 'antique jhumka', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:27:31', '2021-11-08 18:27:31', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'jewellery', 'puthir earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:29:03', '2021-11-08 18:29:03', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'jewellery', 'tikli', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:31:08', '2021-11-08 18:31:08', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'jewellery', 'bracelet big', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-08 18:31:47', '2021-11-08 18:32:23', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'jewellery', 'bracelet set', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:33:18', '2021-11-08 18:33:18', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'jewellery', 'antique gold', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:34:53', '2021-11-08 18:34:53', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'jewellery', 'pearl earings', '470', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:35:56', '2021-11-08 18:35:56', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'jewellery', 'golden mala set', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:36:42', '2021-11-08 18:36:42', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'jewellery', 'mala set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:37:17', '2021-11-08 18:37:17', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'jewellery', 'pearl/kundan earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:38:55', '2021-11-08 18:38:55', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'jewellery', 'flower earings', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:39:40', '2021-11-08 18:39:40', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'jewellery', 'flower earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:40:30', '2021-11-08 18:40:30', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'jewellery', 'estone earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:42:52', '2021-11-08 18:42:52', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'jewellery', 'big earings stone', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-08 18:43:22', '2021-11-08 18:44:22', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'jewellery', 'stone earings', '440', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:44:54', '2021-11-08 18:44:54', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'jewellery', 'kundan', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:45:30', '2021-11-08 18:45:30', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'jewellery', 'antique mala', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:46:06', '2021-11-08 18:46:06', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'jewellery', 'locket set', '220', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:46:52', '2021-11-08 18:46:52', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'jewellery', 'chennai set', '700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:48:40', '2021-11-08 18:48:40', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'jewellery', 'shuta mala set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:49:19', '2021-11-08 18:49:19', NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'jewellery', 'antique set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:49:56', '2021-11-08 18:49:56', NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'jewellery', 'antique set', '600', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:50:46', '2021-11-08 18:50:46', NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'jewellery', 'antique set', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:51:19', '2021-11-08 18:51:19', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'jewellery', 'earings', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:53:29', '2021-11-08 18:53:29', NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:53:58', '2021-11-08 18:53:58', NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'jewellery', 'antique earings', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:54:32', '2021-11-08 18:54:32', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'jewellery', 'puthir mirror earings', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:55:20', '2021-11-08 18:55:20', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:55:58', '2021-11-08 18:55:58', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'jewellery', 'earings', '200', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:57:28', '2021-11-08 18:57:28', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'jewellery', 'payel', '350', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:58:09', '2021-11-08 18:58:09', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'jewellery', 'tikli', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:58:39', '2021-11-08 18:58:39', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'jewellery', 'antique jhumka', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 18:59:51', '2021-11-08 18:59:51', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'jewellery', 'earings', '300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:00:22', '2021-11-08 19:00:22', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'jewellery', 'stone jhumka', '400', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:02:55', '2021-11-08 19:02:55', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'jewellery', 'earings', '100', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:03:21', '2021-11-08 19:03:21', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'jewellery', 'blue choker', '500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:03:54', '2021-11-08 19:03:54', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'jewellery', 'nolok', '150', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-08 19:04:48', '2021-11-08 19:04:48', NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'cotton saree', 'cotton saree', '1000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:08:29', '2021-11-08 19:08:29', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'cotton silk', 'cotton silk', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:12:24', '2021-11-08 19:12:24', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'batik silk saree', 'batik silk saree', '1550', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:13:17', '2021-11-08 19:13:17', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'katan+tissue', 'katan,tissue', '2500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:14:16', '2021-11-08 19:14:16', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'saree batik cotton', 'batik cotton', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-08 19:15:10', '2021-11-08 19:15:10', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'chanderi cotton ', 'chanderi cotton ', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, 1, 1, 1, '2021-11-08 19:19:29', '2021-11-08 19:19:29', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'malhar+boutique+kota3piece', 'malhar,boutiqe,kota3piece', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:22:02', '2021-11-08 19:22:02', NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'embroidery', 'embroidery 3 piece', '2000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:23:26', '2021-11-08 19:23:26', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'cotton catalogue', 'cotton catalogue dress', '2300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:24:24', '2021-11-08 19:24:24', NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'georgette,karchupi', 'georgette,karchupi dress', '5000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:27:30', '2021-11-08 19:27:30', NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'bangla karchupi', '', '2500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-08 19:28:23', '2021-11-08 19:28:23', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'piyani print', 'piyani print', '1700', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 1, 1, 1, '2021-11-08 19:31:04', '2021-11-08 19:31:04', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'batik tersel saree', 'batik tersel saree', '1800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:04:53', '2021-11-09 18:04:53', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'batik online saree', 'batik online saree', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:05:57', '2021-11-09 18:05:57', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'batik patti saree', 'batik patti saree', '1800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:06:56', '2021-11-09 18:06:56', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'batik kota saree', 'batik kota saree', '2300', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2021-11-09 18:07:33', '2021-11-09 18:07:33', NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'luckhnow', 'luckhnow', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:09:28', '2021-11-09 18:09:28', NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'bishal rakhi ', 'bishal rakhi three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:10:29', '2021-11-09 18:10:29', NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'dupiyan', 'dupiyan three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:11:23', '2021-11-09 18:11:23', NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'embroidery', 'embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:12:19', '2021-11-09 18:12:19', NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'bishal sequence', 'bishal sequence three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:13:29', '2021-11-09 18:13:29', NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'bishal indian embroidery', 'bishal indian embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:14:35', '2021-11-09 18:14:35', NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'bishal indian embroidery', 'bishal indian embroidery three piece', '4000', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:14:36', '2021-11-09 18:14:36', NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'batik cotton dress', 'batik cotton dress', '1500', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:15:30', '2021-11-09 18:15:30', NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'jewellery', 'diamond cut ring', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:16:07', '2021-11-09 18:16:07', NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'jewellery', 'magnet bracelet', '250', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:16:52', '2021-11-09 18:16:52', NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'jewellery', 'small top emoji earing', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:18:09', '2021-11-09 18:18:09', NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'jewellery', 'small jhumka earing', '50', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-09 18:18:48', '2021-11-09 18:18:48', NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'cotton three piece', 'cotton 3piece', '800', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 1, 1, '2021-11-09 18:20:20', '2021-11-09 18:20:20', NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'jewellery', '\r\ntop earings', '300', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:55:00', '2021-11-11 17:55:00', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'jewellery', 'top earings', '400', NULL, NULL, NULL, '170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:55:39', '2021-11-11 17:55:39', NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'jewellery', 'top earings', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 17:56:37', '2021-11-11 17:56:37', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'jewellery', 'top earings', '300', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 108, 1, 1, 1, '2021-11-11 17:57:26', '2021-11-11 17:58:52', NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'jewellery', 'top earings', '350', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:00:22', '2021-11-11 19:00:22', NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'jewellery', 'top earings', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:01:43', '2021-11-11 19:01:43', NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'jewellery', 'top earings', '400', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:05:44', '2021-11-11 19:05:44', NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'jewellery', 'top earings', '450', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:06:19', '2021-11-11 19:06:19', NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'jewellery', 'top earings', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:09:13', '2021-11-11 19:09:13', NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'jewellery', 'top earings', '350', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:11:58', '2021-11-11 19:11:58', NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'jewellery', 'top earings', '350', NULL, NULL, NULL, '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:15:58', '2021-11-11 19:15:58', NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'jewellery', 'small top earings', '200', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:17:54', '2021-11-11 19:17:54', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'jewellery', 'top earings ', '1000', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:19:08', '2021-11-11 19:19:08', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'jewellery', 'churi', '350', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:21:49', '2021-11-11 19:21:49', NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'jewellery', 'churi', '300', NULL, NULL, NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:22:44', '2021-11-11 19:22:44', NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'jewellery', 'churi', '800', NULL, NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:23:32', '2021-11-11 19:23:32', NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:25:28', '2021-11-11 19:25:28', NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:26:30', '2021-11-11 19:26:30', NULL, NULL, NULL, NULL, NULL, NULL),
(106, 'jewellery', 'churi', '700', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:27:08', '2021-11-11 19:27:08', NULL, NULL, NULL, NULL, NULL, NULL),
(107, 'jewellery', 'churi', '600', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:29:27', '2021-11-11 19:29:27', NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'jewellery', 'churi', '400', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:30:01', '2021-11-11 19:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'jewellery', 'churi', '500', NULL, NULL, NULL, '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:30:36', '2021-11-11 19:30:36', NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'jewellery', 'churi', '400', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:31:12', '2021-11-11 19:31:12', NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'jewellery', 'payel', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-11 19:32:13', '2021-11-11 19:32:13', NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'jewellery', 'small locket', '300', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:45:55', '2021-11-12 07:45:55', NULL, NULL, NULL, NULL, NULL, NULL),
(113, 'jewellery', 'small locket', '350', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:47:12', '2021-11-12 07:47:12', NULL, NULL, NULL, NULL, NULL, NULL),
(114, 'jewellery', 'small locket', '250', NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:48:57', '2021-11-12 07:48:57', NULL, NULL, NULL, NULL, NULL, NULL),
(115, 'jewellery', 'small locket', '250', NULL, NULL, NULL, '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:49:58', '2021-11-12 07:49:58', NULL, NULL, NULL, NULL, NULL, NULL),
(116, 'jewellery', 'baby bracelet', '150', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:51:27', '2021-11-12 07:51:27', NULL, NULL, NULL, NULL, NULL, NULL),
(117, 'jewellery', 'baby silver', '200', NULL, NULL, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:52:52', '2021-11-12 07:52:52', NULL, NULL, NULL, NULL, NULL, NULL),
(118, 'jewellery', 'magnet bracelet', '250', NULL, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:53:29', '2021-11-12 07:53:29', NULL, NULL, NULL, NULL, NULL, NULL),
(119, 'jewellery', 'plastic bracelet', '150', NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:55:13', '2021-11-12 07:55:13', NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'jewellery', 'jhapta', '400', NULL, NULL, NULL, '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:55:56', '2021-11-12 07:55:56', NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'jewellery', 'antique stone', '500', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:57:51', '2021-11-12 07:57:51', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'jewellery', 'white big neck piece', '2500', NULL, NULL, NULL, '1060', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 07:59:34', '2021-11-12 07:59:34', NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'jewellery', 'chennai neck piece', '2000', NULL, NULL, NULL, '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:01:19', '2021-11-12 08:01:19', NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'jewellery', 'chennai neck piece', '2000', NULL, NULL, NULL, '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:02:11', '2021-11-12 08:02:11', NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'jewellery', 'mina set', '450', NULL, NULL, NULL, '160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:04:00', '2021-11-12 08:04:00', NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:05:08', '2021-11-12 08:05:08', NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:06:03', '2021-11-12 08:06:03', NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:07:13', '2021-11-12 08:07:13', NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'jewellery', 'antique neck piece', '500', NULL, NULL, NULL, '180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:08:03', '2021-11-12 08:08:03', NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'jewellery', 'chik pearl', '350', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:09:52', '2021-11-12 08:09:52', NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'jewellery', 'big neck piece', '400', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:12:16', '2021-11-12 08:12:16', NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'jewellery', 'chik antique', '600', NULL, NULL, NULL, '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:13:26', '2021-11-12 08:13:26', NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'jewellery', 'locket set', '400', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:14:58', '2021-11-12 08:14:58', NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'jewellery', 'white neck piece', '1200', NULL, NULL, NULL, '460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:15:52', '2021-11-12 08:15:52', NULL, NULL, NULL, NULL, NULL, NULL),
(135, 'jewellery', 'locket', '600', NULL, NULL, NULL, '250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:16:49', '2021-11-12 08:16:49', NULL, NULL, NULL, NULL, NULL, NULL),
(136, 'jewellery', 'big neck piece', '500', NULL, NULL, NULL, '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:17:42', '2021-11-12 08:17:42', NULL, NULL, NULL, NULL, NULL, NULL),
(137, 'jewellery', 'big neck piece', '450', NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:18:29', '2021-11-12 08:18:29', NULL, NULL, NULL, NULL, NULL, NULL),
(138, 'jewellery', 'white neck piece', '1500', NULL, NULL, NULL, '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:19:25', '2021-11-12 08:19:25', NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'jewellery', 'white neck piece', '2200', NULL, NULL, NULL, '1250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, 1, 1, 1, '2021-11-12 08:21:18', '2021-11-12 08:21:18', NULL, NULL, NULL, NULL, NULL, NULL);

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
(14, 'delhi cotton', '', 1, 1, 1, '2021-11-08 19:29:00', '2021-11-08 19:29:00');

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
(108, 8, 'jewellery', '', 1, 1, '2021-11-08 18:05:29', '2021-11-08 18:05:29');

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
(124, 'Discount Stickers', 'offerdiscountmanagement/discount-strickers', '2017-09-12 11:00:00', '2017-11-12 14:00:00');

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
  `show_all_contact` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_profiles`
--

INSERT INTO `organization_profiles` (`id`, `logo`, `display_name`, `company_name`, `street`, `city`, `state`, `country`, `zip_code`, `website`, `contact_number`, `email`, `created_at`, `updated_at`, `etin`, `vat_number`, `show_all_contact`) VALUES
(1, 'logo.png', 'Ontik Technology Ltd.', 'Ontik Technology Ltd.', 'Road 32', 'Gulshan', 'Dhaka', 'Bangladesh', '1200', '', '8801996704612', 'ontiktechnology@gmail.com', '2018-01-02 09:16:42', '2021-10-07 10:32:40', '', '', 1);

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
(1, 'Head Office User', 'lazychat-app-icon_07c9549339609d5b881cd9cdff21f961a6c7258f.png', '', '', 'test@ontik.net', '$2y$10$kg38pUJST/NWhz7nryNDHe797mT0.HuDT1hPPiOJBmVLmOVtAEr06', 0, 1, 1, 1, NULL, 1, 1, 'YsrX2rKW8CB2vRK1Ow3jqURt6aIGup7taTYVpWo43bCXD6bSUcwfRLooMe1F', '2019-01-08 20:23:44', '2021-11-04 11:13:19', NULL),
(25, 'Fashion House Admin', 'WhatsApp-Image-2021-10-30-at-11.32_7413bb4aa8615e17a59f609526db7ef3d9d8810f.jpg', '', '', 'test1@ontik.net', '$2y$10$YQDV6H2tjAH5oeAvrmhhwebe67DXd/Z36SMrxjkZiqknOD.Lutlla', 1, 1, 1, 2, NULL, 25, 25, 'n7vJJADqixec9y03rLxGl9cTbCU6qBk6DOUjgQR3bBabWSe8X6t8ekd06Qov', '2021-11-04 08:44:56', '2021-11-04 09:04:57', NULL);

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
  ADD KEY `project_id` (`project_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_due_table`
--
ALTER TABLE `bill_due_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_entry`
--
ALTER TABLE `bill_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_category`
--
ALTER TABLE `contact_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_note_entries`
--
ALTER TABLE `credit_note_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_note_payments`
--
ALTER TABLE `credit_note_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_note_refunds`
--
ALTER TABLE `credit_note_refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_due_table`
--
ALTER TABLE `invoice_due_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_entries`
--
ALTER TABLE `invoice_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_return_entries`
--
ALTER TABLE `invoice_return_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_sub_category`
--
ALTER TABLE `item_sub_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_made_entry`
--
ALTER TABLE `payment_made_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_receives`
--
ALTER TABLE `payment_receives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_receives_entries`
--
ALTER TABLE `payment_receives_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_transfers`
--
ALTER TABLE `product_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salescommisions`
--
ALTER TABLE `salescommisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sidebar_hide_show`
--
ALTER TABLE `sidebar_hide_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=636;

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
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
