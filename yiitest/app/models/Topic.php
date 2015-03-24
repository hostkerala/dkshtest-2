<?php

/**
 * This is the model class for table "topic".
 *
 * The followings are the available columns in table 'topic':
 * @property string $id
 * @property string $created_at
 * @property string $topic_end
 * @property integer $user_id
 * @property string $title
 * @property integer $status
 * @property string $thumbnail
 *
 * The followings are the available model relations:
 * @property RelContentSkills[] $relContentSkills
 */
class Topic extends CActiveRecord
{
	public $skills;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topic the static model class
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
		return 'topic';
	}

	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created_at',
				'updateAttribute' => null,
				'setUpdateOnCreate' => false,
			)
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('status', 'required'),
			array('user_id, status', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 128),
			array('title, topic_end, category_id', 'required'),
			array('created_at, topic_end, content, skills', 'safe'),
			array('user_id', 'default', 'value' => Yii::app()->user->id),
			array('category_id', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, topic_end, user_id, title, status, content ,skills', 'safe', 'on' => 'search'),
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
			'relTopicSkills' => array(self::HAS_ONE, 'RelTopicSkills', array('topic_id' => 'id')),
			'comments' => array(self::HAS_MANY, 'Comment', 'topicId'),
		);
	}


	public function beforeSave()
	{
		$this->topic_end = date('Y-m-d', strtotime($this->topic_end));
		return parent::beforeSave();
	}


	public function afterSave()
	{
		$skillContent = Yii::app()->request->getPost('Skills');
		if ($skillContent)
			Skill::model()->addTags($skillContent, $this->id);
		else
			Yii::app()->db->createCommand()->delete('rel_topic_skills', 'topic_id=:topic_id', $params = array(':topic_id' => $this->id));
		return parent::afterSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Created At',
			'topic_end' => 'Topic End',
			'user_id' => 'User',
			'title' => 'Title',
			'content' => 'Content',
			'status' => 'Status',
			'category_id' => 'Category',
			'skills' => 'Skills',
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

		$criteria->with = array('relTopicSkills');

		$criteria->compare('id', $this->id, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('topic_end', $this->topic_end, true);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('relTopicSkills.skill_id', $this->skills);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        public static function isAuthor($topicId)
        {            
           $topic = self::model()->findByPk($topicId);
            if($topic->user_id == yii::app()->user->id)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
}