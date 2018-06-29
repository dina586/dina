<?php


class EmailSender {

	//Имя аккаунта на гугле для smtp авторизации
	private static $username = '365WebsiteSolutions@gmail.com';
	//Пароль
	private static $password = '$accounT';

	protected static function config($subject = false, $message = false) {
		Yii::import('ext.phpmailer.JPhpMailer');

		$mail = new JPhpMailer; 
		$mail->CharSet = 'UTF-8'; 
				
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "furminatorby@gmail.com";  // GMAIL username
		$mail->Password   = "_furminator2012_";            // GMAIL password

		if ($subject)
			$mail->Subject = $subject;
		if ($message)
			$mail->MsgHTML($message);

		return $mail;
	}

	/**
	 * Отправка тестового сообщения
	 * @param obj $model
	 * @return string
	 */
	public static function sendTest($model) {

		$email = EmailHelper::getEmail($model);
		$mail = self::config('Test Message - ' . $email['subject'], $email['message']);

		$mail->AddAddress(Settings::getVal('test_email'), 'Test message');

		$mail->From = Settings::getVal('smtp_from_email');
		$mail->FromName = Settings::getVal('smtp_from_name');

		if (!$mail->Send())
			if ($mail->SMTPDebug == 2)
				return Yii::t('admin', $email['failed_message']) . '<br/>' . $mail->ErrorInfo;
			else
				return Yii::t('admin', $email['failed_message']);
		else
			return Yii::t('admin', $email['success_message']);
	}

	/**
	 * Отправка сообщения пользователю
	 */
	public static function sendUserNoReply($name, $email, $subject, $message, $fromName = '') {
		if ($fromName == '')
			$fromName = Yii::app()->name;

		$mail = self::config();
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->AddReplyTo('no-reply@' . $_SERVER['SERVER_NAME'], Yii::app()->name);
		$mail->AddAddress($email, $name);
		$mail->From = 'noreply@email.com';
		$mail->FromName = 'Заявка с сайта '.$_SERVER['SERVER_NAME'];

		if (!$mail->Send())
			return false;
		else
			return true;
	}

	/**
	 * Отправка сообщения админу
	 */
	public static function sendAdmin($name, $email, $subject, $message, $fromName = '') {

		if ($fromName == '')
			$fromName = Yii::app()->name;

		$mail = self::config();
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		//$mail->AddReplyTo($email, $name);
		$mail->From = 'noreply@email.com';
		$mail->FromName = $name;

		Yii::import('application.modules.email.models.*');
		$data = Email::model()->findAll();
		foreach($data as $view) {
			$mail->AddAddress($view->email, $view->name);
		}

		
		if (!$mail->Send()) {
			return false;
		}
		else
			return true;
	}

}
