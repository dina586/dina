<?php
class ParseController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout ='//layouts/templates/admin';
	public $pageSize = 16;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'csv':
				return Yii::t('main','Загрузка CSV файла');
				break;
					
			case 'create':
				return Yii::t('shop', 'Add new product');
				break;
					
			case 'update':
				return Yii::t('shop', 'Edit product');
				break;
					
			case 'admin':
				return Yii::t('shop', 'Manage products');
				break;
			case 'seo':
				return Yii::t('shop', 'Manage SEO');
				break;
		}
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('start', 'csv', 'csvImport'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	public $linksArray = array(
		'http://slesarka.by/catalog/instrument/',
		'http://slesarka.by/catalog/oborudovanie/',	
		'http://slesarka.by/catalog/osnastka-raskhodniki/',	
		'http://slesarka.by/catalog/ruchnoy-instrument/',	
		'http://slesarka.by/catalog/ruchnoy-instrument/',	
		'http://slesarka.by/catalog/spetsodezhda/',	
	);
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionStart() {
		header('Content-Type: text/html; charset=utf-8');
		set_time_limit(3600000);
		ini_set("memory_limit","1500M");
		Yii::import('application.modules.store.extensions.simpleHtml.SimpleHTMLDOM');
		Yii::import('application.modules.store.extensions.simpleHtml.simple_html_dom');
		foreach($this->linksArray as $pp) {
			//$result = $this->getWebPage('http://slesarka.by/catalog/instrument/');
			$result = $this->getWebPage($pp);
			
			if ( $result['errno'] != 0 )
			   	echo '... ошибка: неправильный url, таймаут, зацикливание ...';
			
			if ( $result['http_code'] != 200 )
			    echo '... ошибка: нет страницы, нет прав ...';
			
			$html = new simple_html_dom;
			$html->load($result['content']);
			
			$parentCatalog = $html->find(".catalog-sub-section-list .sub-header", 0)->plaintext;
			$globalParentId = $this->saveCatalog($parentCatalog, -1);
			$menuLinks = $html->find(".b-menu2 .parent");
			$i = 0;
			
			/*
			 * Work
			 */
			
			foreach($menuLinks as $link) {
				$name = $link->find('a',0)->plaintext;
				$id = $this->saveCatalog($name, $globalParentId);
				$childMenu = $html->find(".b-menu2 .parent",$i)->find("ul li");
				$href =  'http://slesarka.by'.$link->find('a',0)->href;
				echo $href;
				echo '<br/>';
				$resultCatalog = $this->getWebPage($href);
				$htmlCatalog = new simple_html_dom;
				$htmlCatalog->load($resultCatalog['content']);
				$s = $htmlCatalog->find('.catalog-sub-section-list .row a');
				$arr = array();
				
				foreach($s as $p) {
					$this->saveCatalog($p->plaintext, $id, 'http://slesarka.by'.$p->find('img',0)->src);
				}
				
	
				$i ++;
				
			}
		}
	}
	
	public function saveImage($imgPath, $id) {
		if($imgPath != ''){
		$f = file_get_contents($imgPath);
		
		$fName = explode('/', $imgPath);
		$fName = end($fName);

		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.$fName;
		
		file_put_contents(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.$fName, $f);
		//$imgPath = Yii::getPathOfAlias('webroot').DS.'4f0f2b2ee46230d170bbb00fb6d118af.jpg';
		
		$white = new Imagick();
		$white->newImage(183, 136, new ImagickPixel('white'));
		$white->setImageFormat('jpg');
		
		$image = new Imagick($path);
		//$image->readImageFile($handle);
		
		$white->compositeImage($image,
			Imagick::COMPOSITE_DEFAULT, 
			(((($white->getImageWidth()) - ($image->getImageWidth())))/2), 
			(((($white->getImageHeight()) - ($image->getImageHeight())))/2)
		);
		
		$white->writeImage(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'catalog'.DS.$id.'.jpg');
		}
		
	}
	
	public function saveCatalog($name, $parendId, $imgPath = '') {
		$name = trim(preg_replace(array('/\)/', '/\d+/', '/\(/'), '', $name));
		$count = Catalog::model()->find('name=:name AND parent_id = :parent_id', array(':name'=>$name, ':parent_id'=>$parendId));
		if($count === null) {
			$catalog = new Catalog();
			$catalog->name = $name;
			$catalog->parent_id = $parendId;
			$catalog->position = 1000;
			$catalog->is_view = 1;
			$catalog->save();
			$id = $catalog->id;
		} else
			$id = $count->id;
			$this->saveImage($imgPath, $id);
		return $id;
	}
	
	
	public function getWebPage($url)
	{
		$uagent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";
	
		$ch = curl_init( $url );
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
		curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
		curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
		curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 12000); // таймаут соединения
		curl_setopt($ch, CURLOPT_TIMEOUT, 12000);        // таймаут ответа
		curl_setopt($ch, CURLOPT_MAXREDIRS, 30);       // останавливаться после 10-ого редиректа
	
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );
	
		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}
	
	public function actionCsv() {
		$this->render('csv');
	}
	
	/**
	 * Загрузка csv файла
	 */
	public function actionCsvImport() {
		set_time_limit(3600000);
		ini_set("memory_limit","128M");
	
		Yii::import("ext.ajaxFileUpload.qqFileUploader");
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
	
		$cFile = Yii::app()->cFile;
	
		/*Загрузка файла на сервер*/
		$uploader = new qqFileUploader(array('csv'), 10*1024*1024);
		$result = $uploader->handleUpload($temp);
		
		$tempFile = Yii::app()->cFile->set($temp.$result['filename']);
		/*Переименовываем файл и перемещаем его*/
		if($result['success'] == 1 && $tempFile->exists) {
			$message = $this->importCsv($temp.$result['filename']);
		} else 
			$message = 'При загрузке csv файла прозиошла ошибка! Пожалуйста, попробуйте ещё раз.';
		$result['imagedata'] = $message;
		/*Вывод результата*/
		$result = json_encode($result);
		echo $result;
	}
	
	public function importCsv($path) {
		$status = array('insert'=>0, 'update'=>0);
		
		if (($handle = fopen($path, "r")) !== false) {
			Product::model()->updateAll(array('status'=>0));
			while (($data = fgetcsv($handle, 1000, ";")) !== false) {
				if(trim($data[1]) != '') {
					$data[0] = iconv("WINDOWS-1251", "UTF-8", $data[0]);
					$data[1] = iconv("WINDOWS-1251", "UTF-8", $data[1]);
					$data[2] = iconv("WINDOWS-1251", "UTF-8", $data[2]);
					$model = Product::model()->find('articul=:articul', array(':articul'=>$data[1]));
					if($model===null) {
						$model = new Product;
						$model -> position = 1000;
						$model -> articul = $data[1];
						$model -> is_view = 1;
						$model->date = date('Y-m-d');
						$model->popular = 0;
						$model->is_new = 0;
						$model->stock = 0;
						$status['insert']++;
					} else 
						$status['update']++;
					$model->price = str_replace(',', '.', $data[3]);
					$model->name = $data[0];
					$model->ext = $data[2];
					$model->status = 1;
					if($data[0] != '' || $data[1] != '' || $data[3] != '')
						$model->save();
				}
			}
			fclose($handle);
			$message = '<p>Добавлено новых позиций: '.$status['insert'].'</p>';
			$message.= '<p>Обновлено позиций: '.$status['update'].'</p>';
			$message.= '<p>Доступно в каталоге: '.Product::model()->count('status=1').'</p>';
			$message.= '<p>Нет в наличии: '.Product::model()->count('status=0').'</p>';
		} else 
			$message = '<p>Невозмно получить доступ к csv файлу!</p>';
		return $message;
	}
	
}