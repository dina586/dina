<?php

class DefaultController extends Controller
{
	public $layout='//layouts/tmp_admin';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('getCall'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('chagePrice', 'index', 'upload', 'getEmpty', 'mini', 'clear', 'write', 'uploadWatermark', 'watermarkTest'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionUpload() {
	
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		
		$cFile = Yii::app()->cFile;
		
		/*Загрузка файла на сервер*/
		$uploader = new qqFileUploader(array('xls'), 9*1024*1024);
		$result = $uploader->handleUpload($temp);
		$tempFile = Yii::app()->cFile->set($temp.$result['filename']);
		
		/*Переименовываем файл и перемещаем его*/
		if($result['success'] == 1 && $tempFile->exists) {
			$fileName = 'catalog';
			$tempFile->setBasename($fileName.'.xls');
			
		}
		/*Вывод результата*/
		$result = json_encode($result);
		echo $result;
	}
	
	/* Изменение цен в каталоге
	A - Артикул;
	B - Каталог;
	C - Наименование;
	D - Цена;
	*/
	public function actionChagePrice() {
		set_time_limit(3600000);
		ini_set("memory_limit","256M");
		
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		$phpExcelPath = Yii::getPathOfAlias('ext.exel.phpexcel');
		require_once $phpExcelPath . DS . 'PHPExcel.php';
		require_once $phpExcelPath . DS.'PHPExcel'.DS.'IOFactory.php';
		spl_autoload_register(array('YiiBase', 'autoload'));
		$objPHPExcel = new PHPExcel();
	
		$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'catalog.xls';
		
		$chunkSize = 100;		//размер считываемых строк за раз
		$startRow = 1;			//начинаем читать со строки 2, в PHPExcel первая строка имеет индекс 1, и как правило это строка заголовков
		$exit = false;			//флаг выхода
		$empty_value = 0;		//счетчик пустых знаений
		
		if(isset($_POST['withFiles'])) 
			$needFiles = $_POST['withFiles'];
		if(isset($_POST['old'])) 
			$needOld = $_POST['old'];
		
		if(file_exists($file)) {
			
			$objReader = PHPExcel_IOFactory::createReaderForFile($file);
			
			$objReader->setReadDataOnly(true);
			
			$chunkFilter = new ChunkReadFilter(); 
			$objReader->setReadFilter($chunkFilter); 
			//внешний цикл, пока файл не кончится
			while ( !$exit ) 
			{
			    $chunkFilter->setRows($startRow,$chunkSize); 	//устанавливаем знаечние фильтра
			    $objPHPExcel = $objReader->load($file);		//открываем файл
			    $objPHPExcel->setActiveSheetIndex(0);		//устанавливаем индекс активной страницы
			    $objWorksheet = $objPHPExcel->getActiveSheet();	//делаем активной нужную страницу
			   
				for ($row = $startRow; $row <= $startRow + $chunkSize; $row++) {
					for ($col = 0; $col < 4; $col++) {
						$cell = $objWorksheet->getCellByColumnAndRow($col, $row);
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						if($col == 3)
							$exelArray[$row][$col] = (int)trim($val);
						else 
							$exelArray[$row][$col] = $val;
					}
					
					//Удаляем пустые значения из массива
					if(empty($exelArray[$row][1]) || empty($exelArray[$row][1]) || empty($exelArray[$row][2]) || empty($exelArray[$row][3])) {
						unset($exelArray[$row]);
					}
					
					//Выход из скрипта при пустых строчках
					$value = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()));		//получаем первое знаение в строке
					if ( empty($value) )		//проверяем значение на пустоту
			            $empty_value++;			
			        if ($empty_value == 5)		//после трех пустых значений, завершаем обработку файла, думая, что это конец
			        {	
			            $exit = true;	
			            continue;		
			        }
				}
				
			    $objPHPExcel->disconnectWorksheets(); 		//чистим 
			    unset($objPHPExcel); 						//память
			    $startRow += $chunkSize;					//переходим на следующий шаг цикла, увеличивая строку, с которой будем читать файл
			}
		}
		
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		//Обновление цен
		if(count($exelArray)>0) {
			foreach($exelArray as $value) {
				$data = Product::model()->find('articul=:articul', array('articul'=>$value[0]));
				
				if(count($data)>0){
					Product::model()->updateByPk($data->id, array('price'=>$value[3]));
					$productId = $data->id;
				} else {
					$name = $this->formName($value[2], $value[0]);
					$content = '<p>'.$value[2].'</p>';
					$productId = $this->saveProduct($name, $content, $value);
					$this->saveCatalogs($value, $productId);
				}
				
				$articul[$productId] = strtolower($value[0]);
				Yii::app()->cFile->createDir(0775, $dir.$productId.DS.'original');
				Yii::app()->cFile->createDir(0775, $dir.$productId.DS.'thumbnails');
			}
			
			if($needFiles == 1)
				$this->findFiles($articul);
			if($needOld == 1)
				$this->deleteOld($articul);
			unset($articul, $exelArray);
		}
	}
	
	protected function formName($name, $articul) {
		$str = explode(' ', $name);
		foreach($str as $word) {
			$word = trim($word);
			if(preg_match('/[А-Я]/u', $word)!==0) {
				$result .= $word.' ';
			}
		}
		$result .= '- '.$articul;
		return $result;
	}
	/**
	 * Сохранение товара в базе
	 */
	protected function saveProduct($name, $content, $value) {
		$product = new Product();
		$product->setIsNewRecord(true);
		$product->name = $name;
		$product->content = $content;
		$product->description = '';
		$product->price = $value[3];
		$product->share_price = 0;
		$product->date = date("Y-m-d");
		$product->position = 1000;
		$product->is_view = 1;
		$product->in_stock = 0;
		$product->new = 0;
		$product->popular = 0;
		$product->top_season = 0;
		$product->front_image = '';
		$porudct->recently_viewed = date("Y-m-d H:i:s");
		$product->articul = $value[0];
		$product->save(false);
		return $product->id;
	}
	
	/**
	 * Сохранение каталогов в базе
	 */
	protected function saveCatalogs($value, $productId) {
		//создаем массив с каталогами
		$catalogArray = explode(' - ', $value[1]);
		foreach($catalogArray as $key => $value) {
			$catalogArray[$key] = trim($value);
		}
		$i = 0;
		
		foreach($catalogArray as $catalog) {
			$number = Catalog::model()->count("name =:name", array(':name'=>$catalog));
			if($number==0) {
				$cat = new Catalog;
				$cat->setIsNewRecord(true);
				$cat->name = $catalog;
				$cat->position = 1000;
				if($i == 0){
					$cat->parent_id = -1;
				} else {
					$data = Catalog::model()->find("name =:name", array(':name'=>$lastCatalog));
					$cat->parent_id = $data->id;
				}
				$cat->save();
			}
			$lastCatalog = $catalog;
			$i++;
			
			$data = Catalog::model()->find("name =:name", array(':name'=>$catalog));
			$catalogId = $data->id;
			$number = Connect::model()->count("catalog_id =:catalog_id AND product_id=:product_id", array(':catalog_id'=>$catalogId, ':product_id'=>$productId));
			if($number==0) {
				$connect = new Connect();
				$connect->setIsNewRecord(true);
				$connect->catalog_id = $catalogId;
				$connect->product_id = $productId;
				$connect->save();
			}
		}
	}
	
	protected function findFiles($articul) {
		$fPath = ROOT_PATH.'/../product_images/';
		$files = Yii::app()->cFile->set($fPath)->getContents(true);
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		
		foreach($files as $file) {
			$cFile = Yii::app()->cFile->set($file);
			$fileName = strtolower($cFile->getFilename());
			
			if(in_array($fileName, $articul)) {
				$id = array_search($fileName, $articul);
				if(Yii::app()->cFile->set($dir.$id.DS.'thumbnails'.DS, true)->getIsEmpty()) {
			   		$imageName = date("YmdHis").'_'.rand(1,100);
			   		$ext = 'jpg';
			   		
			   		$resizeObj = new ImageResize($cFile->getRealPath());
					$resizeObj -> resizeImage(1024, 800, 'auto');
					$resizeObj  -> saveImage($dir.$id.DS.'original'.DS.$imageName.'.'.$ext, 120);
					
					$resizeObj = new ImageResize($cFile->getRealPath());
					$resizeObj -> resizeImage(130, 110, 'crop');
					$resizeObj  -> saveImage($dir.$id.DS.'thumbnails'.DS.$imageName.'.'.$ext, 100);
					
					Product::model()->updateByPk($id, array('front_image'=>$imageName.'.'.$ext));
				}
			}
		}
		unset($fNames, $files, $articul);
	}
	protected function deleteOld($articul) {
		$products = Product::model()->findAll('articul!=""');
		foreach($products as $product) {
			if(!in_array(strtolower($product->articul), $articul)) {
				$id = $product->id;
				Product::model()->deleteByPk($id);
				Connect::model()->deleteAll('product_id=:product_id', array(':product_id'=>$id));
				
				$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS.$id.DS;			
				/*Удаляем директорию*/
				$cFile = Yii::app()->cFile->set($dir)-> delete();
			}
		}
	}
	
	public function actionGetEmpty() {
		$products = Product::model()->findAll();
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		foreach($products as $product) {
			$id = $product->id;
			$cFile = Yii::app()->cFile->set($dir.$id.DS.'thumbnails'.DS, true);
			if($cFile->exists && $cFile->getIsEmpty()) {
				$empty[$product->id] = $product->articul;
			} elseif(!$cFile->exists) {
				$empty[$product->id] = 'не создана директория';
			}
		}
		if(!empty($empty)) {
			$view = '<div class = "b-product_view"><table><thead><tr><td>№</td><td>Артикул</td></thead><tbody>';
			foreach($empty as $k=>$v) {
				$view .= '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
			}
			$view .= '</tbody></table></div>';
		} else 
			$view = 'Все позиции имеют изображения';
		echo $view;
	}
	
	public function actionClear() {
		$products = Product::model()->findAll();
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		foreach($products as $product) {
			$id = $product->id;
			$cFile = Yii::app()->cFile->set($dir.$id.DS.'thumbnails'.DS, true);
			if(!$cFile->exists || $cFile->getIsEmpty()) {
				Yii::app()->cFile->set($dir.$id.DS)->delete();
				Product::model()->deleteByPk($id);
			}
		}
	}
	
	public function actionMini() {
		set_time_limit(3600000);
		ini_set("memory_limit","256M");
		
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		$files = Yii::app()->cFile->set($dir)->getContents();
		foreach($files as $file) {
			$cFile = Yii::app()->cFile->set($file, true);
			$id = $cFile->getFilename();
			$product = Product::model()->findByPk($id);
			if(!$cFile->getIsEmpty()) {
				$originals = Yii::app()->cFile->set($dir.$id.DS.'original'.DS)->getContents();
				if(!empty($originals)){
					foreach($originals as $original){
						$orig = Yii::app()->cFile->set($original);
						$imageName = $orig->getFilename();
						$ext = $orig->getExtension();

						$resizeObj = new ImageResize($orig->getRealPath());
						$resizeObj -> resizeImage(130, 110, 'crop');
						$resizeObj  -> saveImage($dir.$id.DS.'thumbnails'.DS.$imageName.'.'.$ext, 100);
						if(count($product)>0){
							if($product->front_image == '' || !Yii::app()->cFile->set($dir.$id.DS.'thumbnails'.DS.$product->front_image)->exists) {
								Product::model()->updateByPk($product->id, array('front_image'=>$imageName.'.'.$ext));
							}
						}
					}
				}
			}
		}
	}
	public function actionWrite(){
		set_time_limit(3600000);
		ini_set("memory_limit","256M");
		
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS;
		$files = Yii::app()->cFile->set($dir)->getContents();
		if(Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'images'.DS.'watermark.png')->exists) {
			foreach($files as $file) {
			$cFile = Yii::app()->cFile->set($file, true);
			$id = $cFile->getFilename();

			if(!$cFile->getIsEmpty()) {
				$originals = Yii::app()->cFile->set($dir.$id.DS.'original'.DS)->getContents();
				if(!empty($originals)){
					foreach($originals as $original){
						$orig = Yii::app()->cFile->set($original);
						$imageName = $orig->getFilename();
						$ext = $orig->getExtension();
						
						$tulipIP = new tulipIP;
						$image = $tulipIP->loadImage($orig->getRealPath());
						$tulipIP->addWatermark($image, 'images/watermark.png', TIP_CENTER);
						$tulipIP->saveImage($dir.$id.DS.'original'.DS, $image, TIP_JPG, $imageName, 100);
					}
				}

			}
		}
			echo 'Водяные знаки были нанесены';
		}
		else 
			echo ('Отсутсвует водяной знак. Загрузите файл');
	}
	
	// We want to add a text on the diagonal of the norway picture,
	// We create a function to calculate the angle with pythagore & thales theorems
	// this is not an obligation, you can choose another rotation angle...
	public function calculAngleBtwHypoAndLeftSide($bottomSideWidth, $leftSideWidth)
	{
	    $hypothenuse = sqrt(pow($bottomSideWidth, 2) + pow($leftSideWidth, 2));
	    $bottomRightAngle = acos($bottomSideWidth / $hypothenuse) + 180 / pi();
	     
	    return -round(90 - $bottomRightAngle);
	}
	
	public function actionUploadWatermark() {
	
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		
		$cFile = Yii::app()->cFile;
		
		/*Загрузка файла на сервер*/
		$uploader = new qqFileUploader(array('png'), 9*1024*1024);
		$result = $uploader->handleUpload($temp);
		$tempFile = Yii::app()->cFile->set($temp.$result['filename']);
		
		/*Переименовываем файл и перемещаем его*/
		if($result['success'] == 1 && $tempFile->exists) {
			$fileName = 'watermark';
			$tempFile->setBasename($fileName.'.png');
			copy(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'watermark.png', Yii::getPathOfAlias('webroot').DS.'images'.DS.'watermark.png');

		}
		
		/*Вывод результата*/
		$result['random'] = rand(1, 100);
		$result = json_encode($result);
		echo $result;
	}
	public function actionWatermarkTest() {
		
		$file = Yii::getPathOfAlias('webroot').DS.'images'.DS.'test_watermark.jpg';
		$orig = Yii::app()->cFile->set($file);
		
		$tulipIP = new tulipIP;
		
		$image = $tulipIP->loadImage($orig->getRealPath());
		$tulipIP->addWatermark($image, 'images/watermark.png', TIP_CENTER);
		$tulipIP->saveImage(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS, $image, TIP_JPG, 'test_watermark', 100);
		
		echo '<a href = "/upload/temp/test_watermark.jpg" target = _blank>Скачать файл</a>';
	}
	
	/**
	 * Заказать звонок - отправка сообщения на емейл
	 */
	public function actionGetCall() {
		Yii::import('application.widgets.forms.CallForm');
		if (!Yii::app()->request->isAjaxRequest)
			$this->redirect('/site/index');

		$model = new CallForm();
		$json = ['status' => 'error', 'message' => 'Ошибка при отправке сообщения! Пожалуйста, позвоните нам!'];

		if (isset($_POST['CallForm'])) {			
			$model->attributes = $_POST['CallForm'];
			if($model->validate()){
				$message = '<p>Имя: '.$model->name.'</p>';
				$message .= '<p>Телефон: '.$model->phone.'</p>';
				EmailSender::sendAdmin($model->name, 'noreply@email.com', 'Заявка на обратный звонок', $message);
				$json['message'] = 'Ваша заявка успешно отправлена! Мы свяжемся с Вами в ближайшее время!';
				$json['status'] = 'ok';
			}
			else{
				$json['message'] = print_r($model->getErrors());
			}
		}
		
		echo json_encode($json);
		
	}
 
}