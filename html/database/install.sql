CREATE TABLE IF NOT EXISTS `admins` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminUsername` varchar(155) NOT NULL,
  `AdminPassword` varchar(32) NOT NULL,
  `AdminPasswordAlgorithm` tinyint(4) NOT NULL DEFAULT '0',
  `AdminIsActive` tinyint(4) NOT NULL DEFAULT '1',
  `AdminCreatedDate` int(11) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `blocks` (
  `BlockID` int(11) NOT NULL AUTO_INCREMENT,
  `BlockName` varchar(150) NOT NULL,
  `BlockTemplateName` varchar(150) NOT NULL,
  `BlockIsVisible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`BlockID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `categories` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryParentID` int(11) NOT NULL,
  `CategoryImage` varchar(150) NOT NULL,
  `CategoryIsActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `categoriesml` (
  `CategoryID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `CategoryName` varchar(150) NOT NULL,
  `CategoryDescription` text NOT NULL,
  PRIMARY KEY (`CategoryID`,`LanguageID`),
  UNIQUE KEY `CategoryName` (`CategoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `customeraddress` (
  `CustomerAddressID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `CustomerAddressCityID` int(11) NOT NULL,
  `CustomerAddress` varchar(150) NOT NULL,
  `CustomerAddressIsDefault` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CustomerAddressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerFirstName` varchar(150) NOT NULL,
  `CustomerLastName` varchar(150) NOT NULL,
  `CustomerEmail` varchar(150) NOT NULL,
  `CustomerGroupID` int(11) NOT NULL DEFAULT '0',
  `CustomerIsActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `languages` (
  `LanguageID` int(11) NOT NULL AUTO_INCREMENT,
  `LanguageName` varchar(150) NOT NULL,
  `LanguageISOName` varchar(15) NOT NULL,
  `LanguageIsActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`LanguageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `modules` (
  `ModuleID` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleName` varchar(150) NOT NULL,
  `ModuleDescription` text NOT NULL,
  `ModuleClass` varchar(150) NOT NULL,
  `ModuleBlockID` int(11) NOT NULL,
  `ModuleIsInstalled` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ModuleID`),
  UNIQUE KEY `ModuleName` (`ModuleName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `pages` (
  `PageID` int(11) NOT NULL AUTO_INCREMENT,
  `PageTitle` varchar(150) NOT NULL,
  `PageContent` text NOT NULL,
  `PageIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `PageCreatedDate` int(11) NOT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCode` varchar(100) NOT NULL,
  `ProductReferrerCode` varchar(100) NOT NULL,
  `ProductGlobalPrice` decimal(10,0) NOT NULL,
  `ProductIsActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `products_categories` (
  `ProductCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ProductCategoryIsDefault` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ProductCategoryID`),
  UNIQUE KEY `ProductID` (`ProductID`,`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `products_ml` (
  `ProductID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `ProductName` varchar(155) NOT NULL,
  `ProductShortDescription` varchar(255) NOT NULL,
  `ProductDetailedDescription` text NOT NULL,
  `ProductAdditionalDescription` text NOT NULL,
  PRIMARY KEY (`ProductID`,`LanguageID`),
  UNIQUE KEY `ProductName` (`ProductName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `settings` (
  `SettingID` int(11) NOT NULL AUTO_INCREMENT,
  `SettingName` varchar(150) NOT NULL,
  `SettingDevKey` varchar(150) NOT NULL,
  `SettingValue` text NOT NULL,
  PRIMARY KEY (`SettingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `StaticTexts` (
`StaticTextID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`StaticTextDev` TEXT NOT NULL
) ENGINE = InnoDB;

ALTER TABLE `StaticTexts` CHANGE `StaticTextDev` `StaticTextDev` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

CREATE TABLE `StaticTextsContent` (
`StaticTextContentID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`StaticTextID` INT NOT NULL ,
`LanguageID` INT NOT NULL DEFAULT '1',
`StaticTextContent` TEXT NOT NULL ,
INDEX ( `StaticTextID` , `LanguageID` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `Orders` (
`OrderID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`OrderCustomerID` INT NOT NULL ,
`OrderShippingAddressID` INT NOT NULL ,
`OrderPaymentModuleID` INT NOT NULL ,
`OrderShippingModuleID` INT NOT NULL ,
`OrderAdditionalInfo` TEXT NOT NULL ,
`OrderDate` INT NOT NULL ,
INDEX ( `OrderCustomerID` , `OrderShippingAddressID` , `OrderPaymentModuleID` , `OrderShippingModuleID` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `OrderItems` (
`OrderItemID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`OrderID` INT NOT NULL ,
`ProductID` INT NOT NULL ,
`OrderItemQuantity` FLOAT NOT NULL ,
`OrderItemSinglePrice` DECIMAL( 10, 2 ) NOT NULL ,
`OrderItemSum` DECIMAL( 10, 2 ) NOT NULL ,
INDEX ( `OrderID` , `ProductID` )
) ENGINE = InnoDB;

CREATE TABLE `ShippingModules` (
`ShippingModuleID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`ShippingModuleName` VARCHAR( 150 ) NOT NULL ,
`ShippingModulePrice` DECIMAL( 10, 2 ) NOT NULL ,
`ShippingModuleIsActive` TINYINT( 1 ) NOT NULL DEFAULT '0'
) ENGINE = InnoDB;

ALTER TABLE `ShippingModules` CHANGE `ShippingModuleName` `ShippingModuleName` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

INSERT INTO `ShippingModules` (
`ShippingModuleID` ,
`ShippingModuleName` ,
`ShippingModulePrice` ,
`ShippingModuleIsActive`
)
VALUES (
'1', 'Наложен платеж', '4.00', '0'
);

CREATE TABLE `PaymentModules` (
`PaymentModuleID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`PaymentModuleName` VARCHAR( 155 ) NOT NULL ,
`PaymentModuleDevClass` VARCHAR( 155 ) NOT NULL ,
`PaymentModuleIsActive` TINYINT( 1 ) NOT NULL DEFAULT '0',
INDEX ( `PaymentModuleIsActive` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `Settings` (
`SettingID` ,
`SettingName` ,
`SettingDevKey` ,
`SettingValue`
)
VALUES (
NULL , 'Продуктови снимки ширина', 'ProductImagesWidth', '240'
), (
NULL , 'Продуктови снимки височина', 'ProductImagesHeight', '120'
);

