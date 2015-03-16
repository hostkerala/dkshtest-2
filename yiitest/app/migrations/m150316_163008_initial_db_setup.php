<?php

class m150316_163008_initial_db_setup extends CDbMigration
{
	public function up()
	{
		$sql = <<<SQL
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                SET time_zone = "+00:00";


                CREATE TABLE IF NOT EXISTS `categories` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

                --
                -- Dumping data for table `categories`
                --

                INSERT INTO `categories` (`id`, `name`) VALUES
                (1, 'TEST CATEGORY-1'),
                (2, 'TEST CATEGORY-2');

                CREATE TABLE IF NOT EXISTS `comments` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `userId` int(11) NOT NULL,
                  `topicId` int(11) NOT NULL,
                  `content` int(11) NOT NULL,
                  `createdAt` datetime NOT NULL,
                  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                CREATE TABLE IF NOT EXISTS `config` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `param` varchar(250) NOT NULL,
                  `value` varchar(250) NOT NULL,
                  `default_value` varchar(250) NOT NULL,
                  `label` varchar(250) NOT NULL,
                  `type` varchar(250) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                CREATE TABLE IF NOT EXISTS `rel_topic_skills` (
                  `topic_id` int(11) NOT NULL,
                  `skill_id` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                CREATE TABLE IF NOT EXISTS `skill` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(250) NOT NULL,
                  `counter` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                        
                CREATE TABLE IF NOT EXISTS `topic` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `topic_end` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `category_id` int(11) NOT NULL,
                  `title` varchar(250) NOT NULL,
                  `content` text NOT NULL,
                  `status` int(11) NOT NULL,
                  `thumbnail` varchar(250) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                        
                CREATE TABLE IF NOT EXISTS `countries` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `country_iso_2` varchar(2) NOT NULL,
                    `country_iso_3` varchar(3) NOT NULL,
                    `country_name_en` varchar(64) NOT NULL,
                    `country_name_ru` varchar(64) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                CREATE TABLE IF NOT EXISTS `states` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `state_code` varchar(64) NOT NULL,
                  `country_id` int(11) NOT NULL,
                  `state_name_en` varchar(64) NOT NULL,
                  `state_name_ru` varchar(64) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                CREATE TABLE IF NOT EXISTS `user` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `first_name` varchar(128) NOT NULL,
                  `last_name` varchar(128) NOT NULL,
                  `email` varchar(128) NOT NULL,
                  `username` varchar(128) NOT NULL,
                  `role` int(11) NOT NULL,
                  `password` varchar(128) NOT NULL,
                  `address` int(255) NOT NULL,
                  `city_id` int(255) NOT NULL,
                  `state_id` int(255) NOT NULL,
                  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `phone` varchar(15) NOT NULL,
                  `secret_key` varchar(255) NOT NULL,
                  `avatar` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `email` (`email`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                CREATE TABLE IF NOT EXISTS `zipareas` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `zip` varchar(5) NOT NULL,
                  `state` varchar(2) NOT NULL,
                  `city` varchar(255) NOT NULL,
                  `latitude` varchar(255) NOT NULL,
                  `longitude` varchar(255) NOT NULL,
                  `old_lng` varchar(255) NOT NULL,
                  `old_lat` varchar(255) NOT NULL,
                  `updated` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                        
                CREATE TABLE IF NOT EXISTS `rel_user_skills` (
                    `user_id` int(11) NOT NULL,
                    `skill_id` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                        
                CREATE TABLE IF NOT EXISTS `config` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `param` varchar(128) NOT NULL,
                  `value` varchar(255) NOT NULL,
                  `default_value` varchar(255) NOT NULL,
                  `label` varchar(255) NOT NULL,
                  `type` varchar(128) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

SQL;
                $this->execute($sql);
SQL;
                return true;
        }

	public function down()
	{
		
            
		$sql = <<<SQL
                DROP TABLE  `config`,`states`, `countries`,`rel_topic_skills`, `skill`, `topic`,`comments`, `categories`,`user`, `zipareas`;
                    
SQL;
		$this->execute($sql);
SQL;
		return true;
                //;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}