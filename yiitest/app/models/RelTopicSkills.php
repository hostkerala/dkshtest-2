<?php

/**
 * This is the model class for table "rel_topic_skills".
 *
 * The followings are the available columns in table 'rel_topic_skills':
 * @property string $topic_id
 * @property string $skill_id
 *
 * The followings are the available model relations:
 * @property Topic $topic
 * @property Skill $skill
 */
class RelTopicSkills extends CActiveRecord
{
	public $id;
        
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RelTopicSkills the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rel_topic_skills';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, skill_id', 'length', 'max' => 11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('topic_id, skill_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
			'skill_relation' => array(self::BELONGS_TO, 'Skill', array('id', 'skill_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'topic_id' => 'Topic',
			'skill_id' => 'Skill',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('topic_id', $this->topic_id, true);
		$criteria->compare('skill_id', $this->skill_id, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}