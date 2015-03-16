<?php
class PermalinkGeneratorBehavior extends CActiveRecordBehavior
{
	public $controller;
	public $action;
	public $params = array();
	public $usePk = true;

	public function getPermalink()
	{

		$this->mergeParams();
		return Yii::app()->createUrl($this->controller . '/' . $this->action, $this->params);
	}

	private function mergeParams()
	{

		if ($this->usePk) {
			if (!empty($this->params)) {

				$this->params = array_merge($this->params, array('id' => $this->owner->getPrimaryKey()));


			} else {
				$this->params = array('id' => $this->owner->getPrimaryKey());
			}
		}

	}

}