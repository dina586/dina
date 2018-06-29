<?php 
class WebApp extends CWebApplication
{
	public function init()
	{
		parent::init();
		if(Yii::app()->language == 'en_au')
			$lang = 'en';
		else 
			$lang = Yii::app()->language;
		
		$config = array(
			'name'=>Settings::getVal('site_name'),
			'components'=>array(
				'widgetFactory'=>array(
		            'widgets'=>array(
		                'CLinkPager'=>array(
							'prevPageLabel'=>Yii::t('admin', 'previous'),
							'nextPageLabel'=>Yii::t('admin', 'next'),
		                ),
		            	'CJuiDatePicker'=>array(
		            		'options'=>array(
		            			'dateFormat'=>strtolower(Yii::app()->locale->getDateFormat('short')),
		            		)
		            	),
		            ),
                ),
			
			),
		);
		
		//$config = $this->generateSocialAccess($config);
		
		$this->checkAvailable();
		
		$this->configure($config);
   }
   
	protected function checkAvailable() {
		
		if(Settings::getVal('block_site') == 1 && trim($_SERVER['REQUEST_URI'], '/') != 'helper/default/block')
			header( 'Refresh: 0; url=/helper/default/block' );
	}
	
	protected function generateSocialAccess($config) {
		
		//Vkontakte
		if(Settings::getVal('vkontakte_client_id') != '' && Settings::getVal('vkontakte_client_secret') != '') {
			$config['components']['eauth']['services']['vkontakte'] = array(
				'client_id' => Settings::getVal('vkontakte_client_id'),
				'client_secret' => Settings::getVal('vkontakte_client_secret'),
				'class' =>'VKontakteOAuthService',	
			);
			$config['params']['social_network'][] = 'vkontakte';
		}
		
		//Facebook
		if(Settings::getVal('facebook_client_id') != '' && Settings::getVal('facebook_client_secret') != '') {
			$config['components']['eauth']['services']['facebook']= array(
				'client_id' => Settings::getVal('facebook_client_id'),
				'client_secret' => Settings::getVal('facebook_client_secret'),
				'class'=>'FacebookOAuthService',
			);
			$config['params']['social_network'][] = 'facebook';
		}
		
		//Twitter
		if(Settings::getVal('twitter_key') != '' && Settings::getVal('twitter_secret') != '') {
			$config['components']['eauth']['services']['twitter']= array(
				'key' => Settings::getVal('twitter_key'),
				'secret' => Settings::getVal('twitter_secret'),
				'class' =>'TwitterOAuthService',
			);
			$config['params']['social_network'][] = 'twitter';
		}
		
		//Linkedin
		if(Settings::getVal('linkedin_key') != '' && Settings::getVal('linkedin_secret') != '') {
			$config['components']['eauth']['services']['linkedin'] = array(
				'key' => Settings::getVal('linkedin_key'),
				'secret' => Settings::getVal('linkedin_secret'),
				'class' => 'LinkedinOAuthService',
			);
			$config['params']['social_network'][] = 'linkedin';
		}
		
		//Google+
		if(Settings::getVal('google_client_id') != '' && Settings::getVal('google_client_secret') != '') {
			$config['components']['eauth']['services']['google_oauth'] = array(
				'client_id' => Settings::getVal('google_client_id'),
				'client_secret' => Settings::getVal('google_client_secret'),
				'class' => 'GoogleOAuthService',
			);
			$config['params']['social_network'][] = 'google_oauth';
		}
		
		//Yandex
		if(Settings::getVal('yandex_client_id') != '' && Settings::getVal('yandex_client_secret') != '') {
			$config['components']['eauth']['services']['yandex_oauth'] = array(
				'client_id' => Settings::getVal('yandex_client_id'),
				'client_secret' => Settings::getVal('yandex_client_secret'),
				'class'=>'YandexOAuthService',
			);
			$config['params']['social_network'][] = 'yandex_oauth';
		}
		
		//Github
		if(Settings::getVal('github_client_id') != '' && Settings::getVal('github_client_secret') != '') {
			$config['components']['eauth']['services']['github'] = array(
				'client_id' => Settings::getVal('github_client_id'),
				'client_secret' => Settings::getVal('github_client_secret'),
				'class' => 'GitHubOAuthService',
			);
			$config['params']['social_network'][] = 'github';
		}
		
		//Mailru
		if(Settings::getVal('mailru_client_id') != '' && Settings::getVal('mailru_client_secret') != '') {
			$config['components']['eauth']['services']['mailru'] = array( 
				'client_id' => Settings::getVal('mailru_client_id'),
				'client_secret' => Settings::getVal('mailru_client_secret'),
				'class' => 'MailruOAuthService',
			);
			$config['params']['social_network'][] = 'mailru';
		}
		
		//Dropbox
		if(Settings::getVal('dropbox_client_id') != '' && Settings::getVal('dropbox_client_secret') != '') {
			$config['components']['eauth']['services']['dropbox'] = array(
				'client_id' => Settings::getVal('dropbox_client_id'),
				'client_secret' => Settings::getVal('dropbox_client_secret'),
				'class'=>'DropboxOAuthService',
			);
			$config['params']['social_network'][] = 'dropbox';
		}
		
		return $config;
		
	}
   
}
?>