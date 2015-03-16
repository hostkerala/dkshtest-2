<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property string $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $slug
 */
class Page extends CActiveRecord
{

	const STATUS_DRAFT = 0;
	const STATUS_PUBLISHED = 1;

	public static function getStatusList()
	{
		return array(
			self::STATUS_DRAFT => 'Draft',
			self::STATUS_PUBLISHED => 'Published'
		);
	}

	public function getStatus()
	{
		$statusList = self::getStatusList();
		return $statusList[$this->status];
	}

	public static function getSubmenuPages()
	{
		$modelPages = Page::model()->findAllByAttributes(array('status' => Page::STATUS_PUBLISHED));
		foreach ($modelPages as $key => $page) {
			$menuPageArray[$key]['label'] = $page->title;
			$menuPageArray[$key]['url'] = $page->permalink;
		}
		return $menuPageArray;
	}

	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'permalinkBehavior' => array(
				'class' => 'PermalinkGeneratorBehavior',
				'controller' => 'page/page',
				'action' => 'view',
				'usePk' => false,
				'params' => array(
					'slug' => $this->slug
				)
			),
			"ASluggable" => array(
				"class" => "ASluggable",
				"slugTemplate" => "{title}",
				"spaceReplacement" => '_',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, status', 'required'),
			array('slug', 'unique'),
			array('status', 'numerical', 'integerOnly' => true),
			array('title, slug', 'length', 'max' => 255),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, status, slug', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'status' => 'Status',
			'slug' => 'Slug',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('slug', $this->slug, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}