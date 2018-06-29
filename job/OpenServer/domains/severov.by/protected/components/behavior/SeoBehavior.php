<?php
class SeoBehavior extends CActiveRecordBehavior {
	
	//Поля содержащие мета данные
	public $title = 'seo_title';
	
	public $description = 'seo_description';
	
	public $keywords = 'seo_keywords';
	
	public $url = 'url';
	
	//Поля из которых берется инфа для генерации метаданных при их отсутствии
	public $_content = 'content';
	
	public $_keys = 'name';
	
	public function beforeValidate($event) {
		//Подготавливаем url для добавления в базу данных
		if($this->owner->isNewRecord)
			$id = false;
		else
			$id = $this->owner->id;
		$this->owner->{$this->url} = System::prepairUrl($this->owner->{$this->url}, $this->owner->name, get_class($this->owner), $id);
	}
	
	public function beforeSave($event) {
		
		//Page Title
		$this->owner->{$this->title} = $this->prepairTitle($this->owner->{$this->title}, $this->owner);
		
		//Page Description
		$this->owner->{$this->description} = $this->prepairDescription($this->owner->{$this->description}, $this->owner->{$this->_content});
	}
	
	/**
	 * Формируем заголовок страницы для сео
	 * @param string $title
	 * @param obj $owner
	 * @return string
	 */
	protected function prepairTitle($title, $owner) {
		if($title == '')
			$title = $owner->name;
		
		$criteria=new CDbCriteria;
		$criteria->compare($this->title, $title,true);
		
		if(!$owner->isNewRecord)
			$criteria->addCondition("id != ".$owner->id."");
		
		$class = get_class($owner);
		$model = new $class;
		
		$data = $model->find($criteria);
		$baseTitle = $title;
		
		$i = 2;
		
		while($data !== null) {
			$title = $baseTitle.' - '.Yii::t('admin', 'part').' '.$i;
			$criteria->compare($this->title, $title, true);
			$data = $model->find($criteria);
			$i++;
		}
		
		$title = strip_tags(str_replace("\"", "", $title));
		
		return $title;
	}
	
	/**
	 * Задаем описание страницы по умолчанию.
	 * Если описание пустое, то формируем из текста
	 * @param string $description базовое описание страницы
	 * @param string $content содержание страницы
	 * @return string
	 */
	
	protected function prepairDescription($description, $content) {
		if($description == '')
			$description = $content;
		
		$description = str_replace(array("\r\n", "\n"),' ',$description);
		$description = strip_tags(str_replace("\"", "", $description));
		$description = preg_replace('/\s+/', ' ',$description);
		return mb_substr(html_entity_decode(strip_tags($description), ENT_QUOTES), 0, 1500);
	
	}
	
}