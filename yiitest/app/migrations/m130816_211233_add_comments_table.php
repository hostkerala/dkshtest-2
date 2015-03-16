<?php

class m130816_211233_add_comments_table extends CDbMigration
{
	public function up()
	{
		$sql = <<<SQL
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL COMMENT 'User id',
  `topicId` int(11) DEFAULT NULL,
  `content` text COMMENT 'Comment',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
SQL;
		$this->execute($sql);
SQL;
	}

	public function down()
	{
		$this->execute('DROP TABLE comments;');
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