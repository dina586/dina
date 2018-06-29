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
	public static function loadModel($class, $id=null, $url = null)
	{
		$model = null;
	
		if($id !== null)
			$model = $class::model()->findByPk($id);
		elseif($url !==null)
			$model = $class::model()->find('url=:url', array(':url'=>$url));
	
		if($model===null)
			throw new CHttpException(404, Yii::t('admin', 'The request page does not exists!'));
		return $model;
	}
}