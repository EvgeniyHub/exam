CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;