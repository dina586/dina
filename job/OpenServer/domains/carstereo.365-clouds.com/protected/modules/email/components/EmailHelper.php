<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */

Yii::import('application.modules.email.models.*');
class EmailHelper {
	
	/**
	 * Генерация списка доступных тегов в email
	 * @param int $id емаил сообщения
	 * @return string
	 */
	public static function generateTagsAdmin($id) {
		$sqlData = EmailConnect::model()->findAll('email_id=:email_id', array(':email_id'=>$id));
		$view = '';
		if(count($sqlData)> 0) {
			$view .= '<ul>';
			foreach($sqlData as $data) {
				$view .= '<li class = "col-md-4">{'.$data->email_tag->tag.'} - '.Yii::t('admin', $data->email_tag->name).' ('.Yii::app()->getModule('email')->tagType[$data->email_tag->tag_type].')</li>';
			}
			
			$view .= '</ul>';
		}
		
		return $view;
	}
	
	/**
	 * Генерация checkbox для тегов
	 * @param int $id емаил сообщения
	 * @return string
	 */
	public static function generateTagsDeveloper($id) {
		$tags = EmailTags::model()->findAll();
		$view = '';
		
		foreach($tags as $tag) {
			$count = EmailConnect::model()->count('email_id=:email_id AND tag_id=:tag_id', array(':tag_id'=>$tag->id, ':email_id'=>$id));
			if($count > 0)
				$v = $tag->id;
			else
				$v = 0;
			$checked = $v == 0?false:true;
			$view .= '<div class = "l-row col-md-4">';
			$view .= BsHtml::checkBoxControlGroup('EmailTags['.$tag->id.']', $checked, 
				[
					'value'=>$tag->id, 
					'label' =>'{'.$tag->tag.'} - '.Yii::t('admin', $tag->name)
				]
			);
			$view .= '</div>';
		}
		
		return $view;
	}
	
	
	/**
	 * Формируем данные для емаил адреса для отправки
	 * @param mixed $key ключ емаила в базе или готовая модель
	 * @param array $data _POST данные из формы
	 */
	public static function getEmail($key, $data = array(), $userName = '', $userEmail = ''){
		if(is_object($key))
			$model = $key;
		else
			$model = System::loadModel('EmailMessage', null, $key, 'email_key');
		
		$search = $replace = $tags = array();
		$email['userName'] = $userName;
		$email['userEmail'] = $userEmail;
		
		if(count($model->tags)>0){
			foreach($model->tags as $tag) {
				$tags[] = $tag->tag;
			}
		}
		
		if(!empty($data)) {
			foreach($data as $k => $v) {
				if(in_array(strtoupper($k), $tags)) {
					$search[] = '{'.strtoupper($k).'}';
					$replace[] = $v;
				}
				if($userName == '' && strtoupper($k) == 'NAME')
					$email['userName'] = $v;
					
				if($userEmail == '' && strtoupper($k) == 'EMAIL')
					$email['userEmail'] = $v;
			}
		}
		
		$email['subject'] = str_replace($search, $replace, Yii::t('admin', $model->subject));
		$email['message'] = str_replace($search, $replace, Yii::t('admin', $model->message));
		
		if($model->header == 1)
			$email['message'] = Settings::getVal('email_header').$email['message'];
		
		if($model->footer == 1)
			$email['message'] = $email['message'].Settings::getVal('email_footer');
		
		if(trim($model->success_message) != '')
			$email['success_message'] = trim($model->success_message);
		else 
			$email['success_message'] = trim(Settings::getVal('email_send_successfully'));
		
		if(trim($model->failed_message) != '')
			$email['failed_message'] = trim($model->failed_message);
		else 
			$email['failed_message'] = trim(Settings::getVal('email_send_failed'));
		
		$email['type'] = $model->email_type;
		
		return $email;
	}
	
}