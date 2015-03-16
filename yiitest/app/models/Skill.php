<?php

/**
 * This is the model class for table "skill".
 *
 * The followings are the available columns in table 'skill':
 * @property string $id
 * @property string $name
 * @property integer $counter
 *
 * The followings are the available model relations:
 * @property RelContentSkills[] $relContentSkills
 */
class Skill extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Skill the static model class
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
		return 'skill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('counter', 'numerical', 'integerOnly' => true),
			array('name', 'length', 'max' => 128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, counter', 'safe', 'on' => 'search'),
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
			'relContentSkills' => array(self::HAS_MANY, 'RelContentSkills', 'skill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'counter' => 'Counter',
		);
	}

	public static function getAllSkill()
	{
		return $arraySkill = Yii::app()->db->createCommand()->select('name')->from('skill')->queryColumn();
	}

	public static function getTopicSkill($topic_id = '')
	{
		$str = null;
		if (!empty($topic_id)) {

			$modeltopicskills = RelTopicSkills::model()->findAllByAttributes(array('topic_id' => $topic_id));
			if ($modeltopicskills) {
				$arrayModels = CHtml::listData($modeltopicskills, 'skill_id', 'skill_relation.name');
				$str = implode(',', $arrayModels);
			}
		}
		return $str;
	}

	public function addTags($skills, $topic_id)
	{
		$arraySkills = explode(',', strtolower(strip_tags($skills)));
		foreach ($arraySkills as $skill) {
			$skillModel = Skill::model()->findByAttributes(array('name' => trim($skill)));
			if (!$skillModel) {
				$skillModel = new Skill();
				$skillModel->name = trim($skill);
				$skillModel->save();
			}
		}

		Yii::app()->db->createCommand()->delete('rel_topic_skills', 'topic_id=:topic_id', $params = array(':topic_id' => $topic_id));

		foreach ($arraySkills as $skill) {
			$skillId = Skill::model()->findByAttributes(array('name' => trim($skill)))->id;
			Yii::app()->db->createCommand()->insert('rel_topic_skills', array(
				'topic_id' => $topic_id,
				'skill_id' => $skillId,
			));
		}
		$this->countUsedSkill();
	}

	private function countUsedSkill()
	{
		$arraySkill = Yii::app()->db->createCommand()->select('id')->from('skill')->queryAll();
		if ($arraySkill) {
			foreach ($arraySkill as $value) {
				foreach ($value as $id) {
					Yii::app()->db->createCommand()->update('skill', array(
						'counter' => Yii::app()->db->createCommand()->select('COUNT(skill_id)')->from('rel_topic_skills')->where('skill_id = ' . $id)->queryScalar(),
					), 'id=:id', array(':id' => $id));
				}

			}
		}
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('counter', $this->counter);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}