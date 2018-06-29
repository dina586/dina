<?php
class System {
	
	/**
	 * Подготовка СЕО ссылки
	 * @param string $url
	 * @param string $wordName
	 * @param obj $class
	 * @param int $id
	 * @return string
	 */
	public static function prepairUrl($url, $wordName = null, $class = false, $id = false) {
		//Если сслыка пустая
		if($url == '') {
			//Обрезаем часть слова
			$url = cText::wordTrim($wordName, 30);
		}
		//И превращаем в ссылку
		$url = Translit::asURLSegment($url);
		$criteria=new CDbCriteria;
		$criteria->compare('url', $url,true);
		if($id)
			$criteria->addCondition("id != ".$id."");
	
		if($class !== false){
			$model = new $class;
			$data = $model->find($criteria);
			$baseURl = $url;
			$i=1;
			if($data !==null){
				do {
					$url = $baseURl.$i;
					$criteria->compare('url', $url,true);
					$data = $model->find($criteria);
					$i++;
				}
				while($data !== null);
			}
		}
		return $url;
	}
	
	/**
	 * Ajax валидация модели
	 * @param obj $model the model to be validated
	 */
	public static function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='b-'.Yii::app()->controller->module->id.'-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * Загрузка данных для модели в зависимости от id или url
	 * Если модель не найдена, будет возвращена ошибка 404
	 * @param string $class название класса для загрузки
	 * @param integer $id id загружаемой модели
	 * @param string $url url загружаемой модели
	 * @return the loaded model
	 * @throws CHttpException
	 */
	public static function loadModel($class, $id=null, $url = null, $column = 'url')
	{
		$model = $data = false;
		
		$m = new $class;
		
		//Проверяем, есть ли кеш
		if(isset($m->cacheBehavior)) {
			Yii::import('application.components.behavior.CacheBehavior');
			if($id != null)
				$model = self::getCache($class.'_'.$id, CacheBehavior::PREFIX);
			elseif($url !==null) 
				$model = self::getCache($class.'_'.$url, CacheBehavior::PREFIX);
		}
		
		//Кеш отсутствует, берем данные из базы
		if($model === false || !isset($m->cacheBehavior)) {
			if($id !== null)
				$model = $class::model()->findByPk($id);
			elseif($url !==null)
				$model = $class::model()->find($column.'=:url', array(':url'=>$url));
		} 
		
		//Если есть кеш компонента, пишем кеш
		if(isset($model->cacheBehavior) && $data == false && $model !== null) {
			if($id != null)
				self::setCache($class.'_'.$id, $model, CacheBehavior::PREFIX);
			elseif($url !==null)
				self::setCache($class.'_'.$url, $model, CacheBehavior::PREFIX);
		}
		
		if($model===null)
			throw new CHttpException(404, Yii::t('admin', 'The request page does not exists!'));
		return $model;
	}
	
	
	/**
	 * Получение кеша по параметру
	 * @param string $tag наименование записи
	 * @return mixed
	 */
	public static function getCache($tag, $prefix = '') {
		$cache = Yii::app()->cache->get(self::getCachePrefix($prefix).$tag);
		return $cache;
	}
	
	/**
	 * Запись в кеш, базовая функция
	 * @param string $tag наименование записи
	 * @param mixed $data данные для записи
	 */
	public static function setCache($tag, $data, $prefix = '') {
		Yii::app()->cache->set(self::getCachePrefix($prefix).$tag, $data);
	}
	
	/**
	 * Удаление кеша, базовая функция
	 * @param string $tag
	 */
	public static function deleteCache($tag, $prefix = '') {
		Yii::app()->cache->delete(self::getCachePrefix($prefix).$tag);
	}
	
	protected static function getCachePrefix($prefix) {
		Yii::import('application.components.behavior.CacheBehavior');
		if($prefix == '') {
			$behaviour = new CacheBehavior();
			$prefix = $behaviour->tagPrefix;
		}
		return $prefix;
	}
	
	/**
	 * Получения формата даты в зависимости от языка
	 * @param unknown_type $lang
	 * @return string
	 */
	public static function getDateFormat($lang = '') {
		if ($lang == '')
			$lang = Yii::app()->language;
		switch ($lang) {
			case 'en': return 'm/d/Y';
				break;
			case 'ru': return 'd.m.Y';
				break;
			default: return 'm/d/Y';
		}
	}

	public static function getDateTimeFormat($lang = '') {
		if ($lang == '')
			$lang = Yii::app()->language;
		switch ($lang) {
			case 'en': return 'm/d/Y h:i a';
				break;
			case 'ru': return 'm/d/Y h:i a';
				break;
			default: return 'm/d/Y h:i a';
		}
	}

	/**
	 * Вывод даты
	 * @param string $date
	 * @param string $type возможнные значения date, datetime
	 */
	public static function viewDate($date, $type = 'date') {
		if ($type == 'date'):
			if ($date == '0000-00-00' || $date == '')
				$date = '';
			else
				$date = date(System::getDateFormat(), strtotime($date));
		else:
			if ($date == '0000-00-00 00:00:00' || $date == '')
				$date = '';
			else
				$date = date(System::getDateTimeFormat(), strtotime($date));
		endif;

		return $date;
	}

	/**
	 * Сохранение даты в базу данных
	 * @param string $date
	 * @param string $type возможнные значения date, datetime
	 */
	public static function saveDate($date, $type = 'date') {
		if ($type == 'date'):
			if ($date == '' || $date == '0000-00-00')
				return false;
			else
				$date = date('Y-m-d', strtotime($date));
		else:
			if ($date == '' || $date == '0000-00-00 00:00:00')
				return false;
			else
				$date = date('Y-m-d H:i:s', strtotime($date));
		endif;

		return $date;
	}
	
}