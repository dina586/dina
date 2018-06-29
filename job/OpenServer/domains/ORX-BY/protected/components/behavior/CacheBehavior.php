<?php
class CacheBehavior extends CActiveRecordBehavior {
	
	const PREFIX = '__cache__';
	
	public $column  = 'url';
	
	public $tags = array();
	
	public $tagPrefix = '__tag__';
	
	public function afterSave($event){
		$this->base();
	}
	
	public function afterDelete($event) {
		$this->base();
	}
	
	protected function base() {
		System::deleteCache(get_class($this->owner).'_'.$this->owner->id, self::PREFIX);
		
		if(isset($this->owner->{$this->column}))
			System::deleteCache(get_class($this->owner).'_'.$this->owner->{$this->column}, self::PREFIX);
		
		if(count($this->tags)>0) {
			foreach($this->tags as $tag) {
				System::deleteCache($tag, $this->tagPrefix);
			}
		}
	}
	
}