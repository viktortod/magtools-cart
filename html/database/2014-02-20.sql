CREATE TABLE `ProductsML` (
`ProductID` int( 11 ) NOT NULL ,
`LanguageID` int( 11 ) NOT NULL ,
`ProductName` varchar( 155 ) NOT NULL ,
`ProductShortDescription` varchar( 255 ) NOT NULL ,
`ProductDetailedDescription` text NOT NULL ,
`ProductAdditionalDescription` text NOT NULL ,
PRIMARY KEY ( `ProductID` , `LanguageID` ) ,
UNIQUE KEY `ProductName` ( `ProductName` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8

CREATE TABLE `ProductImages` (
`ProductID` INT NOT NULL ,
`ProductImageFileName` VARCHAR( 155 ) NOT NULL ,
`ProductImageWidth` INT NOT NULL ,
`ProductImageHeight` INT NOT NULL ,
`ProductImageThumb` VARCHAR( 155 ) NOT NULL ,
`ProductImageThumbWidth` INT NOT NULL ,
`ProductImageThumbHeight` INT NOT NULL ,
`ProductImageThickbox` VARCHAR( 155 ) NOT NULL ,
`ProductImageThickboxWidth` INT NOT NULL ,
`ProductImageThickboxHeight` INT NOT NULL ,
`ProductImageIsLeading` TINYINT( 1 ) NOT NULL DEFAULT '0',
`ProductImageOriginalFile` VARCHAR( 255 ) NOT NULL ,
INDEX ( `ProductID` )
) ENGINE = InnoDB;

ALTER TABLE `customers` ADD `CustomerPassword` VARCHAR( 155 ) NOT NULL AFTER `CustomerEmail`;