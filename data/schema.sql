CREATE TABLE IF NOT EXISTS `enumeration` (
  `enumeration_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`enumeration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `enumeration_item` (
  `enumeration_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `enumeration_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `long_name` varchar(100) NOT NULL,
  `order` int(2) NOT NULL,
  PRIMARY KEY (`enumeration_item_id`),
  KEY `enumeration_id` (`enumeration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
