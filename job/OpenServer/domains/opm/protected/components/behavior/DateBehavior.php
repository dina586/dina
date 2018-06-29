<?php
class DateBehavior extends CActiveRecordBehavior {
	
	public $date = array();
	
	public $datetime = array();
	
	public $viewDate = array();
	
	public $viewDateTime = array();
	
	public function afterFind($event) {
		$dates = array_merge($this->date, $this->viewDate);
		if(count($dates) > 0) {
			foreach($dates as $field) {
				$this->owner->{$field} = System::viewDate($this->owner->{$field});
			}
		}
		
		$dateTimes = array_merge($this->datetime, $this->viewDateTime);
		if(count($dateTimes) > 0) {
			foreach($dateTimes as $field) {
				$this->owner->{$field} = System::viewDate($this->owner->{$field}, 'datetime');
			}
		}
	}
	
	public function beforeSave($event) {
		if(count($this->date) > 0) {
			foreach($this->date as $field) {
				$this->owner->{$field} = System::saveDate($this->owner->{$field});
			}
		}
		if(count($this->datetime) > 0) {
			foreach($this->datetime as $field) {
				$this->owner->{$field} = System::saveDate($this->owner->{$field}, 'datetime');
			}
		}
	}
	
}