<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class DateBehavior extends CActiveRecordBehavior {

	public $date = array();
	public $datetime = array();

	public function afterFind($event) {
		if (count($this->date) > 0) {
			foreach ($this->date as $field) {
				$this->owner->{$field} = System::viewDate($this->owner->{$field});
			}
		}

		if (count($this->datetime) > 0) {
			foreach ($this->datetime as $field) {
				$this->owner->{$field} = System::viewDate($this->owner->{$field}, 'datetime');
			}
		}
	}

	public function beforeSave($event) {
		if (count($this->date) > 0) {
			foreach ($this->date as $field) {
				$this->owner->{$field} = System::saveDate($this->owner->{$field});
			}
		}
		if (count($this->datetime) > 0) {
			foreach ($this->datetime as $field) {
				$this->owner->{$field} = System::saveDate($this->owner->{$field}, 'datetime');
			}
		}
	}

}
