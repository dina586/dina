<?php
Yii::import('application.modules.email.components.EmailHelper');
class Email {

	//Имя аккаунта на гугле для smtp авторизации
	private static $username = '365WebsiteSolutions@gmail.com';
	//Пароль
	private static $password = '$accounT';
	
	protected static function config($subject = false, $message = false) {
		Yii::import('ext.phpmailer.JPhpMailer');
		
		$mail = new JPhpMailer;
		//$mail->IsSMTP(); // telling the class to use SMTP
		$mail->CharSet = 'UTF-8';
		//$mail->SMTPDebug = 2;
		$mail->SMTPAuth   = true;				// enable SMTP authentication
		$mail->SMTPSecure = "ssl";				// sets the prefix to the servier
		$mail->Host       = "smtp.googlemail.com";   // sets GMAIL as the SMTP server
		$mail->Port       = 465;					// set the SMTP port for the GMAIL server
		$mail->Username   = self::$username;  	// GMAIL username
		$mail->Password   = self::$password;    // GMAIL password
	
		if($subject)
			$mail->Subject = $subject;
		if($message)
			$mail->MsgHTML($message);
		
		return $mail;
	}
	
	/**
	 * Отправка сообщения
	 * @param string $userName
	 * @param string $userEmail
	 * @param string $emailKey
	 * @param array $data
	 * @return string
	 */
	
	public static function send($emailKey, $data, $userName = '', $userEmail = '') {
		
		$email = EmailHelper::getEmail($emailKey, $data, $userName, $userEmail);
		
		$mail = self::config($email['subject'], $email['message']);
		
		//Выбор отправки (2 - пользователю) или админу
		if($email['type'] == 2)
			$mail->AddAddress($email['userEmail'], $email['userName']);
		else {
			$mail->AddReplyTo($email['userEmail'], $email['userName']);
			$data = explode(';', Settings::getVal('admin_email'));
			
			foreach($data as $k => $v) {
				$mail->AddAddress($v, Yii::app()->name);
			}
		}
		$mail->From = Settings::getVal('smtp_from_email');
		$mail->FromName = Settings::getVal('smtp_from_name');
		
		//$mail->SetFrom(Settings::getVal('smtp_from_email'), Settings::getVal('smtp_from_name'));
	
		if(!$mail->Send())
			if($mail->SMTPDebug == 2)
				return Yii::t('admin',$email['failed_message']).'<br/>'.$mail->ErrorInfo;
			else
				return Yii::t('admin',$email['failed_message']);
		else 
			return Yii::t('admin', $email['success_message']);
	}
	
	/**
	 * Отправка тестового сообщения
	 * @param obj $model
	 * @return string
	 */
	public static function sendTest($model) {
		
		$email = EmailHelper::getEmail($model);
		$mail = self::config('Test Message - '.$email['subject'], $email['message']);
		
		$mail->AddAddress(Settings::getVal('test_email'), 'Test message');
		
		$mail->From = Settings::getVal('smtp_from_email');
		$mail->FromName = Settings::getVal('smtp_from_name');
		
		if(!$mail->Send())
			if($mail->debug == 2)
				return Yii::t('admin',$email['failed_message']).'<br/>'.$mail->ErrorInfo;
			else
				return Yii::t('admin',$email['failed_message']);
		else 
			return Yii::t('admin', $email['success_message']);
	}
	
	/**
	 * Отправка сообщения пользователю
	 */
	public static function sendUserNoReply($name, $email, $subject, $message, $fromName = '') {
		if($fromName == '')
			$fromName = Yii::app()->name;
		
		$message .= '<p style="font-size:10px; margin: 15px 0 0 0; line-height:16px;">______________________<br/>'.Yii::t('admin', "Please, don't respond to this message. It was generated automatically.").'<p>';
		$mail = self::config();
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->AddReplyTo('no-reply@'.$_SERVER['SERVER_NAME'], Yii::app()->name);
		$mail->AddAddress($email, $name);
		$mail->From = Settings::getVal('smtp_from_email');
		$mail->FromName = Settings::getVal('smtp_from_name');
		
		if(!$mail->Send())
			return false;
		else 
			return true;
	}
	
	/**
	 * Отправка сообщения админу
	 */
	public static function sendAdmin($name, $email, $subject, $message, $fromName = '') {
	
		if($fromName == '')
			$fromName = Yii::app()->name;
		$data = explode(';', Settings::getVal('admin_email'));
		
		$mail = self::config();
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->AddReplyTo($email, $name);
		$mail->From = Settings::getVal('smtp_from_email');
		$mail->FromName = Settings::getVal('smtp_from_name');
		
		foreach($data as $k => $v) {
			$mail->AddAddress($v, Yii::app()->name);
		}
		
		if(!$mail->Send())
			return false;
		else
			return true;
	}
	
}