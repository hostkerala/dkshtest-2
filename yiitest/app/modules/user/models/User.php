<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $address
 * @property integer $city_id
 * @property integer $state_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $phone
 * @property string $secret_key
 * @property string $avatar
 */
class User extends CActiveRecord
{

	
        public $country;
    
        const ROLE_USER = 0;
	const ROLE_ADMIN = 1;

	public $oldPassword;
	public $skills;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}


	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created_at',
				'updateAttribute' => 'updated_at',
				'setUpdateOnCreate' => true,
			)
		);
	}

	/**
	 * @return boolean
	 */
	public function beforeSave()
	{

		if (!$this->isNewRecord)
			$this->saveUserSkills();

		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, username', 'required', 'on' => 'create'), //Scenario Create new User record
			array('email', 'email'),
			array('email, username', 'unique'),
                        array('city_id, state_id,email, username, country','required','on'=>'update'),
			array('city_id', 'numerical', 'integerOnly' => true),
			array('username, email', 'length', 'max' => 128),
//			array('phone', 'length', 'max'=>64),
			array('created_at, updated_at, role, password, address', 'safe'),
			array('secret_key, avatar, city_id, state_id', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, address, city_id, state_id, created_at, updated_at, phone, avatar', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'city' => array(self::BELONGS_TO, 'Zipareas', 'city_id'),
			'state' => array(self::BELONGS_TO, 'States', array('state_code' => 'state_id')),
			'skills' => array(self::MANY_MANY, 'Skill', 'rel_user_skills(user_id, skill_id)'),
			'comments' => array(self::HAS_MANY, 'Comment', 'commentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'role' => 'Role',
			'city_id' => 'City',
			'state_id' => 'State',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'phone' => 'Phone',
			'avatar' => 'Avatar',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('city_id', $this->city_id);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);
		$criteria->compare('phone', $this->phone, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * @param string $password
	 * @return array cities by user state
	 */
	public function getUserCityList()
	{
		if ($this->state_id) {
			$criteria = new CDbCriteria();
			$criteria->condition = 't.state = :state';
			$criteria->params = array(':state' => $this->state_id);
			$criteria->group = 't.city';
			$cityArray = Zipareas::model()->findAll($criteria);
			return $cityArray = CHtml::listData($cityArray, 'id', 'city');
		}
		return array();
	}

	/**
	 * Check user password
	 * @param string $password
	 * @return boolean
	 */
	public function checkPassword($password, $hash = true)
	{
		if ($hash)
			return (md5($password) === $this->password);
		else
			return ($password === $this->password);
	}

	/**
	 * Hash Password
	 * @return password hash
	 */
	public function setHashPassword()
	{
		$this->password = md5($this->password);
	}

	/**
	 * Get Roles List
	 * @return array()
	 */
	public static function getRoles()
	{
		return array(self::ROLE_USER => 'User', self::ROLE_ADMIN => 'Admin');
	}

	/**
	 * Create user Uploads directories
	 * @return bool
	 */
	public static function createUserUploadsFolder($userId)
	{
		$path = 'uploads/users/' . $userId;
		$old = umask(0);
		mkdir($path, 0777);
		mkdir($path . '/avatar', 0777);
		mkdir($path . '/files', 0777);
		umask($old);
	}

	public function saveUserSkills()
	{
		$skillsToDb = array();
		$skills = explode(',', $this->skills);


		foreach ($skills as $skill) {
			$skill = trim(mb_strtolower($skill, 'utf-8'));
			if ($skill == '') {
				continue;
			}
			$skillsToDb[] = $skill;
		}

		$criteria = new CDbCriteria();
		$criteria->distinct = TRUE;
		$criteria->addInCondition('name', $skillsToDb);
		$models = Skill::model()->findAll($criteria);
		$skillIdList = array();
		foreach ($models as $model) {
			$skillIdList[] = $model->id;
			unset($skillsToDb[array_search($model->name, $skillsToDb)]);
		}

		$sql = "DELETE FROM rel_user_skills WHERE user_id = $this->id ";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":user", $this->id, PDO::PARAM_INT);
		$command->execute();


		foreach ($skillsToDb as $skill) {
			$model = new Skill;
			$model->name = $skill;
			if ($model->save()) {
				$skillIdList[] = $model->id;
			}
		}


		foreach ($skillIdList as $skillId) {
			$sql = "INSERT INTO  rel_user_skills (user_id, skill_id) VALUES (:user, :skill)";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(":user", $this->id, PDO::PARAM_INT);
			$command->bindValue(":skill", $skillId, PDO::PARAM_INT);
			$command->execute();
		}

	}

	/**
	 * get User skills
	 * @return array
	 */
	public function getUserSkills()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_id = :id';
		$criteria->params = array(':id' => $this->id);
		$criteria->join = 'JOIN rel_user_skills t1 ON t.id = t1.skill_id';

		$tags = Yii::app()->db->commandBuilder->createFindCommand('skill', $criteria)->queryAll();

		return $tags;
	}

	/**
	 * get User skills
	 * @return string
	 */
	public function getUserSkillsString()
	{
		$skills = $this->userSkills;
		$result = array();
		foreach ($skills as $skill) {
			$result[] = $skill['name'];
		}
		return implode(',', $result);
	}
}