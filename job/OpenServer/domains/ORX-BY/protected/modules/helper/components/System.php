<?php
class System {
	
	/**
	 * ���������� ��� ������
	 * @param string $url
	 * @param string $wordName
	 * @param obj $class
	 * @param int $id
	 * @return string
	 */
	public static function prepairUrl($url, $wordName = null, $class = false, $id = false) {
		//���� ������ ������
		if($url == '') {
			//�������� ����� �����
			$url = cText::wordTrim($wordName, 30);
		}
		//� ���������� � ������
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
	 * Ajax ��������� ������
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
	 * �������� ������ ��� ������ � ����������� �� id ��� url
	 * ���� ������ �� �������, ����� ���������� ������ 404
	 * @param string $class �������� ������ ��� ��������
	 * @param integer $id id ����������� ������
	 * @param string $url url ����������� ������
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