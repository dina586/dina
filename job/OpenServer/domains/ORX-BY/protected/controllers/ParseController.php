<?php
define('DS', DIRECTORY_SEPARATOR);
Yii::import('application.modules.shop.models.*');
Yii::import('application.extensions.simpleHtml.*');

class ParseController extends Controller
{
	public $fistCatalog = array('Цветы', 'Розы', 'Букеты', 'Композиции', 'Повод', 'Кому', 'Подарки', 'Оформления');
	public $startCatalog = 45;
	public function actionStart() {
		//header("Content-Type: text/html; charset=windows-1251");
		/*set_time_limit(3600000);
		ini_set("memory_limit","1500M");
		
		$result = $this->get_web_page('http://maredifior.ru/');
		
		if ( $result['errno'] != 0 )
		   	echo '... ошибка: неправильный url, таймаут, зацикливание ...';
		
		if ( $result['http_code'] != 200 )
		    echo '... ошибка: нет страницы, нет прав ...';
		//Yii::app()->db->createCommand()->truncateTable(Connect::model()->tableName());
		
		$this->saveParentLinks();
		
		$html = new simple_html_dom;
		$html->load($result['content']);
		$catalogs = $html->find("#mainmenu ul li"); 
		$i = -1;
		
		foreach($catalogs as $cLink) {
			if(in_array($cLink->getElementByTagName('a')->plaintext, $this->fistCatalog)) {
				$i++;
				continue;
			}
			$name =  trim($cLink->getElementByTagName('a')->plaintext);
			$data = Catalog::model()->find('name=:name AND parent_id =:parent_id', array(':name'=>$name, ':parent_id'=>$i));
			if(count($data)==0) {
				$c = new Catalog;
				$c -> name = $name;
				$c -> parent_id = $i;
				$c -> position = 1000;
				$c -> save();
			}
			$data = Catalog::model()->find('name=:name AND parent_id =:parent_id', array(':name'=>$name, ':parent_id'=>$i));
			$links[$data->id] = 'http://maredifior.ru'.$cLink->getElementByTagName('a')->href.'?show_all&CallModule=lists&action=get_catalog';
		}
		$a = 0;
		foreach($links as $id => $link){
			if($a < $this->startCatalog) {
				$a++;
				continue;
			}
			$res = $this->get_web_page($link);
			$json = json_decode($res['content']);
			$html = new simple_html_dom;
			$html->load($json->result);
			$productsLinks = $html->find(".name");
			$this->saveProduct($productsLinks, $id);
			sleep(1);
		}*/
		/*$data = Product::model()->findAll();
		foreach($data as $c) {
			$cost = $c->price * 195;
			$cost = round($cost, -3);
			Product::model()->updateByPk($c->id, array('price'=>$cost));
		}*/
	}
	public function saveProduct($productsLinks, $id) {
		$c = 0;
		foreach($productsLinks as $l) {
			$link = $l->getElementByTagName('a')->href;
			$link = 'http://maredifior.ru'.$link;
			sleep(1);
			$this->savePage($link, $id);
		}
	}
	public function  savePage($link, $id) {
		
		$rest = $this->get_web_page($link);
		$html = new simple_html_dom;
		$html->load($rest['content']);
		$name = $html->find("#content h1", 0)->plaintext;
		$content = $html->find(".full_item_desc", 0)-> innertext;
		
		$cost = $html->find(".full_item_cart .price span", 0)->plaintext;
		$cost = str_replace(" ","",$cost);
		$cost = (int)$cost;
		$cost = $cost * 195;
		$cost = round($cost, -3);
		
		$data = Product::model()->find('name=:name AND price=:price', array(':name'=>$name, ':price'=>$cost));
		if(count($data)==0) {
			$product = new Product(); 
			$product -> setIsNewRecord(true); 
			$product -> name = $name;
			$product -> price = $cost;
			$product -> position = 1000;
			$product -> is_view = 1;
			$product -> content = $content;
			$product -> share_price = 0;
			$product ->date = date("Y-m-d");
			$product -> save(false);
			
			$data = Product::model()->find('name=:name AND price=:price', array(':name'=>$name, ':price'=>$cost));
			
			$prod_id = $data->id;
			$img = $html->find(".full_item_img .rotate-main-image", 0)->href;
			$img = 'http://maredifior.ru'.$img;
			
			$imgName = $prod_id.'.png';
			$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
			$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS.$prod_id.DS;
	
			file_put_contents($temp.$imgName, '');
			$this->curl_download($img, $temp.$imgName);
			
			Yii::app()->cFile->createDir(0775, $path.'original');
			Yii::app()->cFile->createDir(0775, $path.'thumbnails');
			
			$frontImage = $this->imgRes($temp, $imgName, $path);
			Product::model()->updateByPk($prod_id, array('front_image'=>$frontImage));
			
			$images = $html->find(".full_item_thumbs a");
			foreach($images as $image) {
				$img = 'http://maredifior.ru'.$image->href;
				$imgName = $prod_id.'.png';
				$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
				$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS.$prod_id.DS;
		
				file_put_contents($temp.$imgName, '');
				$this->curl_download($img, $temp.$imgName);
				
				Yii::app()->cFile->createDir(0775, $path.'original');
				Yii::app()->cFile->createDir(0775, $path.'thumbnails');
				
				$this->imgRes($temp, $imgName, $path);
			}
			
			$c = Catalog::model()->findByPk($id);
			$connect = new Connect();
			$connect -> setIsNewRecord(true); 
			$connect -> catalog_id = $c->parent_id;
			$connect -> product_id = $prod_id;
			$connect -> save();
			
			$connect = new Connect();
			$connect -> setIsNewRecord(true); 
			$connect -> catalog_id = $id;
			$connect -> product_id = $prod_id;
			$connect -> save();
		}
	}
	
	public function imgRes($temp, $imgName, $path) {
		$newImgName = date("YmdHis").'_'.rand(1,1000);
		if(file_get_contents($temp.$imgName) != '') {
			$resizeObj = new ImageResize($temp.$imgName);
        	$resizeObj -> resizeImage(1280, 1024, 'auto');
			$resizeObj -> saveImage($path.'original'.DS.$newImgName.'.jpg', 100);
           		
			$resizeObj = new ImageResize($temp.$imgName);
        	$resizeObj -> resizeImage(130, 110, 'crop');
			$resizeObj -> saveImage($path.'thumbnails'.DS.$newImgName.'.jpg', 100);
			unlink($temp.$imgName);
		}
		return $newImgName.'.jpg';
	}
	
	public function saveParentLinks() {
		foreach($this->fistCatalog as $k) {
			$data = Catalog::model()->find('name=:name AND parent_id = -1', array(':name'=>$k));
			if(count($data)==0) {
				$c = new Catalog;
				$c -> name = $k;
				$c -> parent_id = -1;
				$c -> position = 1000;
				$c -> save();
			}
		}
	}
	
	public function get_web_page($url)
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
	
	
	public function curl_download($url, $file)
	{

	// открываем файл, на сервере, на запись
    $dest_file = @fopen($file, "w");
    
    // открываем cURL-сессию
    $resource = curl_init();
    
    // устанавливаем опцию удаленного файла
    curl_setopt($resource, CURLOPT_URL, $url);
    
    // устанавливаем место на сервере, куда будет скопирован удаленной файл
    curl_setopt($resource, CURLOPT_FILE, $dest_file);
    
    // заголовки нам не нужны
    curl_setopt($resource, CURLOPT_HEADER, 0);
    
    // выполняем операцию
    curl_exec($resource);
    
    // закрываем cURL-сессию
    curl_close($resource);
    
    // закрываем файл
    fclose($dest_file);
}
	
	
}
