<?php
/**
 * User: rocket
 * Date: 15.06.13
 * Time: 20:03
 */

class GeneralConfig extends CApplicationComponent
{
	/**
	 * array Config params
	 */
	protected $data = array();

	public function init()
	{
		$items = Config::model()->findAll();
		foreach ($items as $item) {
			if ($item->param)
				$this->data[$item->param] = $item->value === '' ? $item->default_value : $item->value;
		}
		parent::init();
	}

	/**
	 * Get param value by param name.
	 * Usage example:
	 * ===============================================
	 * Yii::app()->config->get('PARAM.NAME');
	 * ===============================================
	 * @return $value
	 */
	public function get($key)
	{
		if (isset($this->data[$key]))
			return $this->data[$key];
		else
			throw new CException('Undefined parameter ' . $key);
	}

	/**
	 * Set param value by param name.
	 * Usage example:
	 * ===============================================
	 * Yii::app()->config->set('PARAM.NAME',$new_value);
	 * @return null
	 */
	public function set($key, $value)
	{
		$model = Config::model()->findByAttributes(array('param' => $key));
		if (!$model)
			throw new CException('Undefined parameter ' . $key);

		$model->value = $value;

		if ($model->save())
			$this->data[$key] = $value;
	}

	/**
	 * Add param
	 * @param $params
	 */
	public function add($params)
	{
		if (isset($params[0]) && is_array($params[0])) {
			foreach ($params as $item)
				$this->createParameter($item);
		} elseif ($params)
			$this->createParameter($params);
	}

	/**
	 * Remove key
	 * @param $key mixt
	 */
	public function del($key)
	{
		if (is_array($key)) {
			foreach ($key as $item)
				$this->removeParameter($item);
		} elseif ($key)
			$this->removeParameter($key);
	}

	/**
	 * Create new Config record.
	 * @return null
	 */
	protected function createParameter($param)
	{
		if (!empty($param['param'])) {
			$model = Config::model()->findByAttributes(array('param' => $param['param']));
			if ($model === null)
				$model = new Config();

			$model->param = $param['param'];
			$model->label = isset($param['label']) ? $param['label'] : $param['param'];
			$model->value = isset($param['value']) ? $param['value'] : '';
			$model->default_value = isset($param['default_value']) ? $param['default_value'] : '';
			$model->type = isset($param['type']) ? $param['type'] : 'string';
			$model->save();
		}
	}

	/**
	 * Delete Config record.
	 * @return null
	 */
	protected function removeParameter($key)
	{
		if (!empty($key)) {
			$model = Config::model()->findByAttributes(array('param' => $key));
			if ($model)
				$model->delete();
		}
	}

}