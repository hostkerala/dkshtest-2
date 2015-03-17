<?php

/**
* Created By Roopan v v <yiioverflow@gmail.com>
* Date : 17-03-2015
* Time :08:06 PM
* Initial Migration script.
*/

class m150316_163008_initial_db_setup extends CDbMigration
{
	public function up()
	{
		$sql = <<<SQL
                SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

                CREATE SCHEMA IF NOT EXISTS `17068404_0000001` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
                USE `17068404_0000001` ;

                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`categories`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`categories` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`zipareas`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`zipareas` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `zip` VARCHAR(5) NOT NULL,
                  `state` VARCHAR(2) NOT NULL,
                  `city` VARCHAR(255) NOT NULL,
                  `latitude` VARCHAR(255) NOT NULL,
                  `longitude` VARCHAR(255) NOT NULL,
                  `old_lng` VARCHAR(255) NOT NULL,
                  `old_lat` VARCHAR(255) NOT NULL,
                  `updated` INT(11) NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`countries`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`countries` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `country_iso_2` VARCHAR(2) NOT NULL,
                  `country_iso_3` VARCHAR(3) NOT NULL,
                  `country_name_en` VARCHAR(64) NOT NULL,
                  `country_name_ru` VARCHAR(64) NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`states`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`states` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `state_code` VARCHAR(64) NOT NULL,
                  `country_id` INT(11) NOT NULL,
                  `state_name_en` VARCHAR(64) NOT NULL,
                  `state_name_ru` VARCHAR(64) NOT NULL,
                  PRIMARY KEY (`id`),
                  INDEX `fk_states_countries1_idx` (`country_id` ASC),
                  CONSTRAINT `fk_states_countries1`
                    FOREIGN KEY (`country_id`)
                    REFERENCES `17068404_0000001`.`countries` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_danish_ci;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`user`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`user` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `first_name` VARCHAR(128) NULL,
                  `last_name` VARCHAR(128) NULL,
                  `email` VARCHAR(128) NOT NULL,
                  `username` VARCHAR(128) NOT NULL,
                  `role` INT(11) NULL,
                  `password` VARCHAR(128) NULL,
                  `address` INT(255) NULL,
                  `city_id` INT(11) NULL,
                  `created_at` DATETIME NULL,
                  `updated_at` TIMESTAMP NULL,
                  `phone` VARCHAR(15) NULL,
                  `secret_key` VARCHAR(255) NULL,
                  `avatar` VARCHAR(255) NULL,
                  `state_id` INT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE INDEX `email` (`email` ASC),
                  INDEX `fk_user_states1_idx` (`state_id` ASC),
                  INDEX `fk_user_zipareas2_idx` (`city_id` ASC),
                  CONSTRAINT `fk_user_zipareas2`
                    FOREIGN KEY (`city_id`)
                    REFERENCES `17068404_0000001`.`zipareas` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_user_states1`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `17068404_0000001`.`states` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`topic`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`topic` (
                  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `topic_end` INT(11) NOT NULL,
                  `user_id` INT(11) NOT NULL,
                  `category_id` INT(11) NOT NULL,
                  `title` VARCHAR(250) NOT NULL,
                  `content` TEXT NOT NULL,
                  `status` INT(11) NULL,
                  `thumbnail` VARCHAR(250) NOT NULL,
                  `id` INT NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`comments`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`comments` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `content` TEXT NOT NULL,
                  `createdAt` DATETIME NOT NULL,
                  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `userId` INT NULL,
                  `topicId` INT NULL,
                  `user_id` INT(11) NOT NULL,
                  `topic_id` INT NOT NULL,
                  PRIMARY KEY (`id`),
                  INDEX `fk_comments_user_idx` (`user_id` ASC),
                  INDEX `fk_comments_topic1_idx` (`topic_id` ASC),
                  CONSTRAINT `fk_comments_user`
                    FOREIGN KEY (`user_id`)
                    REFERENCES `17068404_0000001`.`user` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_comments_topic1`
                    FOREIGN KEY (`topic_id`)
                    REFERENCES `17068404_0000001`.`topic` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`config`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`config` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `param` VARCHAR(128) NOT NULL,
                  `value` VARCHAR(255) NOT NULL,
                  `default_value` VARCHAR(255) NOT NULL,
                  `label` VARCHAR(255) NOT NULL,
                  `type` VARCHAR(128) NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`skill`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`skill` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(128) NOT NULL,
                  `counter` INT(11) NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`rel_user_skills`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`rel_user_skills` (
                  `skill_id` INT(11) NOT NULL,
                  `user_id` INT(11) NOT NULL,
                  PRIMARY KEY (`skill_id`, `user_id`),
                  INDEX `fk_skill_has_user_user1_idx` (`user_id` ASC),
                  INDEX `fk_skill_has_user_skill1_idx` (`skill_id` ASC))
                ENGINE = MEMORY
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`rel_topic_category`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`rel_topic_category` (
                  `categories_id` INT NOT NULL,
                  `topic_id` INT NOT NULL,
                  PRIMARY KEY (`categories_id`, `topic_id`),
                  INDEX `fk_categories_has_topic_topic1_idx` (`topic_id` ASC),
                  INDEX `fk_categories_has_topic_categories1_idx` (`categories_id` ASC),
                  CONSTRAINT `fk_categories_has_topic_categories1`
                    FOREIGN KEY (`categories_id`)
                    REFERENCES `17068404_0000001`.`categories` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_categories_has_topic_topic1`
                    FOREIGN KEY (`topic_id`)
                    REFERENCES `17068404_0000001`.`topic` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`rel_topic_skills`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`rel_topic_skills` (
                  `skill_id` INT(11) NOT NULL,
                  `topic_id` INT NOT NULL,
                  PRIMARY KEY (`skill_id`, `topic_id`),
                  INDEX `fk_skill_has_topic_topic1_idx` (`topic_id` ASC),
                  INDEX `fk_skill_has_topic_skill1_idx` (`skill_id` ASC),
                  CONSTRAINT `fk_skill_has_topic_skill1`
                    FOREIGN KEY (`skill_id`)
                    REFERENCES `17068404_0000001`.`skill` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_skill_has_topic_topic1`
                    FOREIGN KEY (`topic_id`)
                    REFERENCES `17068404_0000001`.`topic` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
                DEFAULT CHARACTER SET = utf8;


                -- -----------------------------------------------------
                -- Table `17068404_0000001`.`pages`
                -- -----------------------------------------------------
                CREATE TABLE IF NOT EXISTS `17068404_0000001`.`pages` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `title` VARCHAR(255) NULL,
                  `slug` VARCHAR(255) NULL,
                  `content` TEXT NULL,
                  `status` INT(1) NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC))
                ENGINE = InnoDB;


                SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SQL;
                $this->execute($sql);
SQL;
                return true;
        }

	public function down()
	{
		
            
                $sql = <<<SQL
                DROP TABLE  `comments`, `config`, `pages`, `rel_topic_category`, `rel_topic_skills`, `rel_user_skills`, `skill`, `topic`, `user`, `zipareas`, `categories`, `states`, `countries`;

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