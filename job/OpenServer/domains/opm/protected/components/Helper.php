<?php
class Helper {
	public static function getPageLink($id) {
		Yii::import('application.modules.page.models.Content');
		$c = System::loadModel('Content', $id);
		return Yii::app()->createUrl('page/view/view', array('url'=>$c->url));
	}
	public static function getPageUrl($id) {
		Yii::import('application.modules.page.models.Content');
		$c = System::loadModel('Content', $id);
		return $c->url;
	}
	
	//Формирование сео заголовков для разделов с сео страницами
	public static function seoPage($title, $param = 'page')
	{
		$page = (int)Yii::app()->request->getQuery($param, 1);
		$title .= $page > 1 ? ' - '.Yii::t('admin', 'page').' ' . $page : '';
		return $title;
	}
	
	//Ссылка для перехода в сео раздел
	public static function adminMoveSeo($url){
		return '<section class = "l-grid_link">
			<a href = "'.Yii::app()->createUrl($url).'">'.Yii::t('main', 'View SEO').'</a>
		</section>';
	}
	
	//Ссылка для перехода в основной grid
	public static function adminMoveGrid($url){
		return '<section class = "l-grid_link">
			<a href = "'.Yii::app()->createUrl($url).'">'.Yii::t('main', 'Move to the list').'</a>
		</section>';
	}
	
	//Вывод ссылки внизу раздела для редактирования
	public static function editLink($url) {
		$view = '';
		if(Yii::app()->user->checkAccess('admin')){
			$view .= '<div class = "b-admin_edit">';
			$view .= BsHtml::link(Yii::t('main', 'Edit'), $url,
				array(
					'icon' => BsHtml::GLYPHICON_PENCIL,
					'class' => 'btn btn-default btn-sm',
				)
			);
			$view .= '</div>';
		}
		return $view;
	}
	
	//Вывод ссылки внизу раздела для редактирования
	public static function developerLink($url, $text = 'Create') {
		$view = '';
		if(Yii::app()->user->checkAccess('developer')){
			$view .= '<div class = "b-admin_edit">';
			$view .= BsHtml::link(Yii::t('main', $text), $url,
				array(
					'icon' => BsHtml::GLYPHICON_PENCIL,
					'class' => 'btn btn-default btn-sm',
				)
			);
			$view .= '</div>';
		}
		return $view;
	}
	
	/**
	 * Вывод обложки для file manager
	 * @param int $id идентификатор модели
	 * @param string $name имя модели
	 * @param string $link ссылка, если задана, то выводится ссылка, иначе галерея
	 * @param string $noImage если изображение не найдено
	 * @param string $type тип изображения, которое хотим получить
	 * @return string
	 */
	public static function getCover($id, $name, $link= '', $type = 'thumbnail', $noImage = ''){
		Yii::import('application.modules.file.models.FileManager');
		$view = '';
		$data = FileManager::model()->find('model_name=:model_name AND model_id = :model_id AND cover = 1', array(':model_id'=>$id, ':model_name'=>$name));
		
		if($data === null):
			if($noImage == '')
				$noImage = '<img alt = "" class = "j-lazy" src = "/images/'.Yii::app()->getModule('file')->noImage.'"/>';
			if($link == '')
				$view = $noImage;
			else 
				$view = '<a href = "'.$link.'">'.$noImage.'</a>';
		else:
			$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.$type.DS.$data->file;
				
			if(Yii::app()->cFile->set($file)->exists)
				$img = '<img alt = "'.strip_tags($data->description).'" class = "j-lazy" src = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/'.$type.'/'.$data->file.'"/>';
			else
				$img = '<img alt = "'.strip_tags($data->description).'" class = "j-lazy" src = "/images/'.Yii::app()->getModule('file')->noImage.'"/>';
				
			if($link == '') {
				$view = '<ul id= "j-photobox_gallery_cover" class = "b-images_view b-image_cover j-photobox_gallery">
						<li class = "l-inline_block">
							<a href = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/original/'.$data->file.'">'.$img.'</a>
						</li>
					</ul>';
				if(!Yii::app()->request->isAjaxRequest)
					Yii::app()->clientScript->registerPackage('photobox');
				JS::add('photobox_init', "$('.j-photobox_gallery').photobox('a',{ 'time':0, 'loop':false, 'afterClose': function(){}});");
			}
			else
				$view =  '<a href = "'.$link.'">'.$img.'</a>';
				
		endif;
		
		return $view;
	}
	
	//Создание кнопки - ссыкли
	public static function linkButton($label = 'Submit', $url = '#', $htmlOptions = array()) {
		$btn = BsHtml::linkButton($label, $htmlOptions);
		$btn = str_replace('"#"', '"'.$url.'"', $btn);
		return $btn;
	}
	
	/**
	 * Получение реального ip пользователя
	 * @return string
	 */
	public static function getRealIp() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))  //internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip=$_SERVER['REMOTE_ADDR'];
		
		return $ip;
	}
	
	/**
	 * Генерация ссылки на профайл пользователя
	 * @param int $userId 
	 * @return string
	 */
	public static function userLink($userId, $htmlOptions = array()) {
		$user = User::model()->findByPk($userId);
		
		if($user !== null)
			$link = CHtml::link($user->profile->lastname.' '.$user->profile->firstname, Yii::app()->createUrl('user/admin/view', array('id'=>$userId)), $htmlOptions);
		else
			$link = '';
		
		return $link;
	}
	
	public static function userName($userId) {
		$user = User::model()->findByPk($userId);
		
		if($user !== null)
			$name = $user->profile->lastname.' '.$user->profile->firstname;
		else
			$name = '';
		
		return $name;
	}

	public static function stepRedirect($url) {
		if(isset($_POST['next_step']))
			Yii::app()->controller->redirect($url);
	}
	
	public static function viewPrice($price) {
		if($price == '')
			return $price;
		if(Yii::app()->language == 'ru')
			$price = number_format($price, 0, '', ' ');
		else
			$price = number_format($price, 2, '.', ' ');
		return $price;
	}
	
	public static function viewDate($date, $formate = 'date') {
		if($date == '0000-00-00')
			return '';
		return Yii::app()->dateFormatter->format('MM/dd/yyyy', $date);	
	
	}
	public static function viewAddress($profile) {
		$address = '';
		if($profile->address != '')
			$address  .= $profile->address.', ';
		
		if($profile->apartments != '')
			$address .= 'Apt. '.$profile->apartments;
		if($profile->apartments != '')
			$address .= 'Apt. '.$profile->apartments.', ';
		if($profile->city_id != '' && $profile->city_id != 0)
			$address .= $profile->city->city_name_en.', ';
		if($profile->state_id != '' && $profile->state_id != 0)
			$address .= $profile->state->state_name.', ';
		if($profile->zip != '')
			$address .= $profile->zip.', ';
		if($profile->country_id != '' && $profile->country_id != 0)
			$address .= $profile->country->country_name_en;
		return trim($address, ', ');
	}
	
	/**
	 * Загрузка изображения lazy load
	 * @param string $path
	 * @param string $url
	 * @param string $name
	 * @param string $style
	 * @return string
	 */
	public static function loadImage($path, $url = '', $name = '', $style = '') {
		$cFile = Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').$path);
		if($cFile->exists)
			$image = '<img class = "j-lazy" data-src= "'.$path.'" src = "/images/system/pixel.png" alt = "'.$name.'" title = "'.$name.'" '.$style.'/>';
		else
			$image = '<img class = "j-lazy" data-src="/images/'.Yii::app()->getModule('helper')->noImage.'" src = "/images/system/pixel.png" alt = "'.$name.'" title = "'.$name.'" '.$style.'/>';
	
		if($url != '')
			$view = '<a title = "'.$name.'" href = "'.$url.'" target = "_blank">'.$image.'</a>';
		else
			$view = $image;
		return $view;
	}
	
	
	

}