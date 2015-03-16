<?php
/**
 * ASluggable deals with creating search engine friendly URL slugs for ActiveRecords
 * @author Ionut Titei
 * @package extensions.slug
 */
class ASluggable extends CActiveRecordBehavior
{
	/**
	 * The name of the attribute to store this slug in
	 * @var string
	 */
	public $slugAttribute = "slug";

	/**
	 * The template to use when generating the slug.
	 * e.g. if you wanted to use the attributes name
	 * and id when generating the slug:
	 * <pre>
	 * $this->slugTemplate = "{name} {id}";
	 * </pre>
	 * @var string
	 */
	public $slugTemplate;

	/**
	 * Whether the slug should be lower case or not
	 * @var boolean
	 */
	public $lowercase = true;

	/**
	 * The string to replace spaces with
	 * @var string
	 */
	public $spaceReplacement = "-";

	/**
	 * Finds a model based on its slug.
	 * @param string $slug The slug to search for
	 * @param mixed $params The parameters to bind if any.
	 * @param integer|boolean $cacheDuration The duration in seconds to cache the
	 * results of this query for, defaults to false meaning do not cache.
	 * @return CActiveRecord The found model, or null if nothing is found.
	 */
	public function findBySlug($slug, $params = null, $cacheDuration = false)
	{
		if ($cacheDuration !== false) {
			return $this->getOwner()->cache($cacheDuration, (isset($this->getOwner()->cacheable) ? $this->getOwner()->cacheDependency : null))->findByAttributes(array($this->slugAttribute => $slug), $params);
		} else {
			return $this->getOwner()->findByAttributes(array($this->slugAttribute => $slug), $params);
		}
	}

	/**
	 * Triggered before the model saves, this is where the slug attribute is actually set
	 * @see CActiveRecordBehavior::beforeSave()
	 * @param CModelEvent $event the raised event
	 * @return boolean
	 */
	public function beforeSave($event)
	{
		if ($this->getOwner()->{$this->slugAttribute} == "") {
			$this->getOwner()->{$this->slugAttribute} = $this->createSlug();
		}
		return true;
	}

	/**
	 * Creates a slug from the given attributes
	 * @return string the unique slug
	 */
	public function createSlug()
	{
		$tokens = array();

		foreach ($this->getOwner()->getAttributes() as $i => $v) {
			$tokens["{$i}"] = $v;
		}
		$text = strtr($this->slugTemplate, $tokens);
		$clean = self::cleanText($text, $this->spaceReplacement);
		if ($clean == "") {
			$clean = get_class($this->getOwner());
		}
		if ($this->lowercase) {
			$clean = strtolower($clean);
		}
		return self::checkUniqueSlug($clean);
	}

	/**
	 * Cleans a string ready to be put in a slug
	 * @param string $text the text to be cleaned
	 * @param string $spaceReplacement the character to replace disallowed characters with
	 * @return string the cleaned text
	 */
	public static function cleanText($text, $spaceReplacement = "-")
	{
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
		$clean = preg_replace("/[^a-zA-Z0-9_| -]/", '', $clean);
		$clean = trim($clean);
		$clean = preg_replace("/[\/_| -]+/", $spaceReplacement, $clean);
		return trim($clean);
	}

	/**
	 * Ensures the given slug is unique in the database
	 * @param string $text The text to check
	 * @return string The unique slug
	 */
	public function checkUniqueSlug($text)
	{
		$sql = "SELECT COUNT(" . $this->getOwner()->getMetaData()->tableSchema->primaryKey . ") FROM " . $this->getOwner()->tableName() . " WHERE " . $this->slugAttribute . " = :slug";
		$cmd = yii::app()->db->createCommand($sql);
		$cmd->bindValue(":slug", $text);
		$result = $cmd->queryScalar();
		if ($result > 0) {
			$sql = "SELECT COUNT(" . $this->getOwner()->getMetaData()->tableSchema->primaryKey . ") FROM " . $this->getOwner()->tableName() . " WHERE " . $this->slugAttribute . " LIKE :slug";
			$cmd = yii::app()->db->createCommand($sql);
			$cmd->bindValue(":slug", $text . $this->spaceReplacement . "%");
			$result = $cmd->queryScalar() + 2;
			$text .= $this->spaceReplacement . $result;
		}
		return $text;


	}
}