-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2012 at 10:02 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8
-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2012 at 10:22 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_kmportal`
--
CREATE DATABASE `db_kmportal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_kmportal`;

-- 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_kmportal`
--

-- --------------------------------------------------------


--
-- Table structure for table `app_name`
--

CREATE TABLE IF NOT EXISTS `app_name` (
  `app_id` int(50) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(50) DEFAULT NULL,
  `app_desc` varchar(10000) DEFAULT NULL,
  `app_intf_diagram` varchar(100) DEFAULT NULL,
  `FULLFORM` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`app_id`),
  UNIQUE KEY `app_name` (`app_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `app_name`
--

INSERT INTO `app_name` (`app_id`, `app_name`, `app_desc`, `app_intf_diagram`, `FULLFORM`) VALUES
(2, 'AIB', 'AIB is the strategic orchestration system which co-ordinates L2C fulfilment.', 'AIB.jpg,AIB_DataFlow.jpg', 'Agile Integration Broker'),
(3, 'SI', 'SI is front end to manage work items', 'SI.jpg', 'System Integration');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(50) DEFAULT NULL,
  `related_word` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `keyword_desc` varchar(1000) DEFAULT NULL,
  `keyword_info` varchar(50) DEFAULT NULL,
  `keyword_diagram` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`keyword_id`),
  KEY `keyword_name` (`keyword_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword_name`, `related_word`, `type`, `keyword_desc`, `keyword_info`, `keyword_diagram`) VALUES
(2, 'AIB', 'AIB', 'Application ', 'AIB is the strategic orchestration system', 'Agile Integration Broker', 'AIB.jpg,AIB_DataFlow.jpg'),
(3, 'SI', 'SI', 'Application ', 'SI is front end to manage work items', 'System Integration', 'SI.jpg'),
(4, 'ACT0011', 'Place,LIMS Design Templates', 'KSU/KCI/ACT', 'Once an order has been created on LIMS this request is sent to initiate the dleiveyr process within LIMS', 'place, LIMS Design Templates', 'Default.jpg'),
(5, 'ACT001', 'Excess Construction Charges', 'KSU/KCI/ACT', 'Excess Construction Charges,Openreach Response Handler', 'Excess Construction Charges', 'Default.jpg'),
(6, 'ACT0019', 'Cancel', 'KSU/KCI/ACT', 'LIMS Design Templates,This request is sent to LIMS in order to cancel the LIMS order ', 'Cancel', 'Default.jpg'),
(7, 'ACT002', 'Customer Promised Date', 'KSU/KCI/ACT', 'Orchestration Calculate CPD MCO Process Sent to CRM only if CPD > CRD and Customer Intervention Required (Product Rule within the process (provide only))', 'Customer Promised Date', 'Default.jpg'),
(8, 'ACT0021', 'Manual Route', 'KSU/KCI/ACT', 'LIMS response handlers,This request is sent to the netork design system to instruct that the service is to be routed manually', 'Manual Route', 'Default.jpg'),
(9, 'ACT0022', 'Automatic Route', 'KSU/KCI/ACT', 'LIMS response handlers,This request is sent to the netork design system to instruct that the service is to be routed automatically', 'Automatic Route', 'Default.jpg'),
(10, 'ACT0028', 'Replace', 'KSU/KCI/ACT', 'LIMS Design Templates,This request is sent to LIMS ion reciept of an Amend request. The order must be replaced on LIMS before the amendment can be made to the MRS order. ', 'Replace', 'Default.jpg'),
(11, 'ACT003', 'Customer Handover', 'KSU/KCI/ACT', 'MCO Process Sent to CRM only if Customer Handover required (controlled by PPE Rule)', 'Customer Handover', 'Default.jpg'),
(12, 'ACT0031', 'Check Design', 'KSU/KCI/ACT', 'LIMS response handlers,After all sub orders have reach a status of design complete the design is checked to determine the solution is still valid', 'Check Design', 'Default.jpg'),
(13, 'ACT0041', 'Activate', 'KSU/KCI/ACT', 'LIMS response handlers,This request is sent to the Network design system to initiate the activation of a service', 'Activate', 'Default.jpg'),
(14, 'ACT0051', 'Close', 'KSU/KCI/ACT', 'LIMS response handlers,This request is sent to the Network design system to close the order', 'Close', 'Default.jpg'),
(15, 'ACT0061', 'Match', 'KSU/KCI/ACT', 'LIMS Design Templates,This is the initial activity request sent to LIMS in case of a SimProvide order', 'Match', 'Default.jpg'),
(16, 'ACT0100', 'Update to Design Complete', 'KSU/KCI/ACT', 'Openreach Response Handler Sent to LIMS', 'Update to Design Complete', 'Default.jpg'),
(17, 'ACT0100', 'Update to Design Complete', 'KSU/KCI/ACT', 'PACS Provide/Cease Template Sent to LIMS', 'Update to Design Complete', 'Default.jpg'),
(18, 'ACT0101', 'Update to Build Complete', 'KSU/KCI/ACT', 'Openreach Response Handler Sent to LIMS', 'Update to Build Complete', 'Default.jpg'),
(19, 'ACT0101', 'Update to Build Complete', 'KSU/KCI/ACT', 'PACS Provide/Cease Template Sent to LIMS', 'Update to Build Complete', 'Default.jpg'),
(20, 'KSU002', 'NotPossibleToFulfill', 'KSU/KCI/ACT', 'Openreach Response Handler Only sent if Openreach has evaluated sub order identified that it is not possible to fulfil the customer order. ', 'NotPossibleToFulfill', '1408426264719.jpg'),
(21, 'KSU003', 'Acknowledged', 'KSU/KCI/ACT', 'Orchestration KSU003 Acknowledgement Sent from Orchestration on receipted of an Order from CRM', 'Acknowledged', 'Default.jpg'),
(22, 'KSU004', 'Service Id allocated', 'KSU/KCI/ACT', 'Orchestration Allocate ServiceId Sent from Orchestration if Service ID Allocated there. Not used anymore since service id is allocated by the CRM system. Due to historical reasons', 'Service Id allocated', 'Default.jpg'),
(23, 'KSU005', 'CPD provided', 'KSU/KCI/ACT', 'Orchestration KSU005 Notification Handler Send to CRM Once CPD has been worked out', 'CPD provided', 'Default.jpg'),
(24, 'KSU006', 'Design Complete ', 'KSU/KCI/ACT', 'Orchestration Status Update Notifications Handler ', 'Design Complete ', 'Default.jpg'),
(25, 'KSU007', 'Build complete', 'KSU/KCI/ACT', 'Orchestration Status Update Notifications Handler ', 'Build complete', 'Default.jpg'),
(26, 'KSU008', 'Build Commissioned', 'KSU/KCI/ACT', 'Orchestration Status Update Notifications Handler', 'Build Commissioned', 'Default.jpg'),
(27, 'KSU012', 'Excess Construction charges apply  ', 'KSU/KCI/ACT', 'Orchestration Status Update Notifications Handler ', 'Excess Construction charges apply  ', 'Default.jpg'),
(28, 'KSU013', 'Timescale charges apply', 'KSU/KCI/ACT', 'Openreach Response Handler Planner performs out-of-hours jobs and charges customer. ', 'Timescale charges apply', 'Default.jpg'),
(29, 'KSU014', 'Complete', 'KSU/KCI/ACT', 'Orchestration KSU014 Notification Handler Sent to CRM on completion of order', 'Complete', 'Default.jpg'),
(30, 'KSU021', 'Closed', 'KSU/KCI/ACT', 'Orchestration Cancel Sent to CRM on completion of order', 'Closed', 'Default.jpg'),
(31, 'KSU024', 'Identify Amendment Type', 'KSU/KCI/ACT', 'Orchestration Amend Orchestration KSU024 Notification Handler MRS Amend Handler Only sent for Amendments to inform CRM of the type of amendment made to the order', 'Identify Amendment Type', 'Default.jpg'),
(32, 'KSU025', 'Design Excess Construction Charges', 'KSU/KCI/ACT', 'Openreach Response Handler Sent once Excess Contrustion Charges are accepted by Customer', 'Design Excess Construction Charges', 'Default.jpg'),
(33, 'KSU026', 'Amend PONR', 'KSU/KCI/ACT', 'MRS Provide/Modify Response Handler Sent just before we ask LIMS to Activate Not sent for some of the products which have OS as their CRM', 'Amend PONR', 'Default.jpg'),
(34, 'KSU027', 'Cancel PONR', 'KSU/KCI/ACT', 'MRS Provide/Modify Response Handler,O,O,"Sent just before we ask LIMS to Activate Not sent for some of the products which have OS as their CRM"', 'Cancel PONR', 'Default.jpg'),
(35, 'KSU009', 'Delay KSU', 'KSU/KCI/ACT', 'Delay KSU Handler This is to be introduced as a part of Delay Management', 'Delay KSU', 'Default.jpg'),
(37, 'WBMC', 'Broadband , Product', 'BT Product', 'WBC is CNS product and WBMC VNS product.WBMC is NGC product.There are two types of WBMC variants â€“ Point to Point and Aggregated. WBMC offers different kinds of CP hand off options. , ', 'Wholesale Broadband Managed Connect', ',Default.jpg'),
(38, 'PMF', 'PMF', 'Module/Capability', 'AIBâ€™s core metadata/rules engine is driven based on 4 configuration xml files â€“ Products Offering (PO), Service Specification (SS),Fulfilment Interface (FI),Interface State Model (ISM) ', 'Product Metadata File', '1408435915817.jpg'),
(39, 'MOP', 'Message', 'Message', 'The Manage Order Placement (MOP) capability is the fulfilment entry point to the Service Fulfilment and Workflow (SFW) platform.  All fulfilment requests requiring any form of provisioning activity must be directed to MOP. MOP supports multiple XML dialects.  It is designed to accept both the conventional CCM-compliant XML as well as an S-Tree-compliant XML', 'Manage Order Placement ', '1408436291558.jpg'),
(40, 'PSTN', 'Product', 'BT Product', 'BT product providing calling feature', 'Public switched telephone network', '1408436352877.jpeg'),
(41, 'MSIl', 'Product', 'BT Product', 'Ethernet Multi-Service Interconnect Link (Ethernet MSIL) is a new BT Wholesale product to interconnect BTs 21CN with other Communications Providers (CP) next generation network.Ethernet MSIL provides a transparent Ethernet link allowing the CP to access BTs range of IP based services on the 21CN. Ethernet MSIL is VLAN aware and supports 21CN services such as Wholesale Broadband Connect (WBC) and NGN Call Conveyance (NGN CC).', 'Multi-Service Interconnect Link', '1408437007104.jpg'),
(42, 'Broadband, CPE and Value Added Services', 'Product', 'BT Product', 'BT product offered as broadband promotions', 'Broadband, CPE and Value Added Services', 'Default.jpg');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Table structure for table `keyword_app_mapping`
--

CREATE TABLE IF NOT EXISTS `keyword_app_mapping` (
  `keyword_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `keyword_app_remarks` varchar(1000) DEFAULT NULL,
  UNIQUE KEY `keyword_id` (`keyword_id`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keyword_app_mapping`
--


INSERT INTO `keyword_app_mapping` (`keyword_id`, `app_id`, `keyword_app_remarks`) VALUES
(2, 2, 'Not applicable. This is BT application.'),
(3, 3, 'Not applicable. This is BT application.'),
(4, 2, 'AIb raises this ACT'),
(5, 2, 'AIb raises this ACT'),
(6, 2, 'AIb raises this ACT'),
(7, 2, 'AIb raises this ACT'),
(8, 2, 'AIb raises this ACT'),
(9, 2, 'AIb raises this ACT'),
(10, 2, 'AIb raises this ACT'),
(11, 2, 'AIb raises this ACT'),
(12, 2, 'AIb raises this ACT'),
(13, 2, 'AIb raises this ACT'),
(14, 2, 'AIb raises this ACT'),
(15, 2, 'AIb raises this ACT'),
(16, 2, 'AIb raises this ACT'),
(17, 2, 'AIb raises this ACT'),
(18, 2, 'AIb raises this ACT'),
(19, 2, 'AIb raises this ACT'),
(20, 2, 'AIb raises this KSU'),
(21, 2, 'AIb raises this KSU'),
(22, 2, 'AIb raises this KSU'),
(23, 2, 'AIb raises this KSU'),
(24, 2, 'AIb raises this KSU'),
(25, 2, 'AIb raises this KSU'),
(26, 2, 'AIb raises this KSU'),
(27, 2, 'AIb raises this KSU'),
(28, 2, 'AIb raises this KSU'),
(29, 2, 'AIb raises this KSU'),
(30, 2, 'AIb raises this KSU'),
(31, 2, 'AIb raises this KSU'),
(32, 2, 'AIb raises this KSU'),
(33, 2, 'AIb raises this KSU'),
(34, 2, 'AIb raises this KSU'),
(35, 2, 'AIb raises this KSU'),
(37, 2, 'A BT product , '),
(38, 2, 'PMF is heart of AIB'),
(39, 2, 'AIb receives all All fulfilment requests in form of MOP'),
(40, 2, 'A BT product'),
(41, 2, 'A BT product'),
(42, 2, 'A BT product');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Table structure for table `log_table`
--

CREATE TABLE IF NOT EXISTS `log_table` (
  `Date` date DEFAULT NULL,
  `IP_address` varchar(20) DEFAULT NULL,
  `action_type` varchar(10) DEFAULT NULL,
  `action_detail` varchar(50) DEFAULT NULL,
  KEY `IP_address` (`IP_address`),
  KEY `action_type` (`action_type`),
  KEY `Date` (`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;