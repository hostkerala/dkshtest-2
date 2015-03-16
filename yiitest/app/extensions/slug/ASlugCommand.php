<?php
/**
 * Provides a command line interface to allow slugs to be added to batches of models
 * @author Ionut Titei
 * @package extensions.slug
 */
class ASlugCommand extends CConsoleCommand
{
	/**
	 * Creates slugs for the specified model class
	 * @param string $modelClass the class of the model
	 */
	public function actionCreate($modelClass)
	{
		$criteria = new CDbCriteria;
		$slugAttribute = $modelClass::model()->ASluggable->slugAttribute;
		$criteria->addCondition("$slugAttribute = '' OR $slugAttribute IS NULL");
		foreach ($modelClass::model()->findAll($criteria) as $model) {
			echo "Generating slug for: " . $model->primaryKey . "...";
			$model->save(false);
			echo " " . $model->{$slugAttribute} . "\n";
		}
	}
}
