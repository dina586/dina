<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.modules.stock.models.*');
class StockWidget extends CWidget {

	public $id;

	public function run() {
		Yii::app()->clientScript->registerPackage('countdown');
		$model = Stock::model()->findByPk($this->id);
		if ($model->is_view == 1)
			$this->render('index', array('model' => $model));
	}

	/**
	 * Формирование даты для акций
	 * @param date $date
	 * @param int $refresh
	 */
	protected function stockDate($date, $refresh = 0) {
		$newDate = new DateTime($date);
		if ($refresh == 1) {
			while ($newDate->format('Y-m-d') <= date('Y-m-d')) {
				$newDate->modify('+1 days');
			}
		}
		$dateArray = date_parse_from_format('Y-m-d', $newDate->format('Y-m-d'));
		return $dateArray;
	}

}
