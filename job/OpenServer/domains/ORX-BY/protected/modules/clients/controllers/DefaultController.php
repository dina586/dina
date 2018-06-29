<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tmp_admin';
	
	public $defaultAction = 'admin';
	
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'export'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	

	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		COrder::model()->deleteAll('client_id=:client_id', array(':client_id'=>$id));
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new Clients('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Clients']))
			$model->attributes=$_GET['Clients'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionExport() {
		set_time_limit(3600000);
		ini_set("memory_limit","1000M");
		Yii::import('application.modules.clients.models.*');
		
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		$phpExcelPath = Yii::getPathOfAlias('ext.exel.phpexcel');
		require_once $phpExcelPath . DS . 'PHPExcel.php';
		require_once $phpExcelPath . DS.'PHPExcel'.DS.'IOFactory.php';
		spl_autoload_register(array('YiiBase', 'autoload'));
		
		$exelColumns = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',13=>'N',14=>'O',15=>'P',16=>'Q',17=>'R',18=>'S',19=>'T',20=>'U',21=>'V',22=>'W',23=>'X',24=>'Y',25=>'Z',26=>'AA',27=>'AB',28=>'AC',29=>'AD',30=>'AE',31=>'AF',32=>'AG',33=>'AH',34=>'AI',35=>'AJ',36=>'AK',37=>'AL',38=>'AM',39=>'AN',40=>'AO',41=>'AP',42=>'AQ',43=>'AR',44=>'AS',45=>'AT',46=>'AU',47=>'AV',48=>'AW',49=>'AX',50=>'AY',51=>'AZ',52=>'BA',53=>'BB',54=>'BC',55=>'BD',56=>'BE',57=>'BF',58=>'BG',59=>'BH',60=>'BI',61=>'BJ',62=>'BK',63=>'BL',64=>'BM',65=>'BN',66=>'BO',67=>'BP',68=>'BQ',69=>'BR',70=>'BS',71=>'BT',72=>'BU',73=>'BV',74=>'BW',75=>'BX',76=>'BY',77=>'BZ');
		
		$objPHPExcel = new PHPExcel();
			
		$objPHPExcel->getProperties()->setCreator(Yii::app()->name)
		                ->setLastModifiedBy($_SERVER['SERVER_NAME'])
		                ->setTitle("Site clients")
		                ->setSubject("Site clients")
		                ->setDescription("Клиенты ".$_SERVER['SERVER_NAME'])
		                ->setKeywords("Клиенты " .$_SERVER['SERVER_NAME'])
		                ->setCategory("Клиенты " .$_SERVER['SERVER_NAME']);
		$objPHPExcel->getActiveSheet()->setTitle('Клиенты ' .$_SERVER['SERVER_NAME']);
		
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Имя')
            ->setCellValue('B1', 'Email')
            ->setCellValue('C1', 'Телефон')
            ->setCellValue('D1', 'Покупки');
		$sheet = $objPHPExcel->getActiveSheet();
        
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getStyle('B')->getAlignment()->setWrapText(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getStyle('C')->getAlignment()->setWrapText(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getStyle('D')->getAlignment()->setWrapText(true);
		
		$products = Clients::model()->findAll();
		$i = 2;
		foreach($products as $product) {
			$sheet->setCellValue('A'.$i.'', $product->name);
			$sheet->setCellValue('B'.$i.'', $product->email);
			$sheet->setCellValue('C'.$i.'', $product->contacts);
			$clientOrder ='';
			$a = 0;
			foreach($product->order as $view) {
				if($a>0) 
					$clientOrder .= "\r\n".$view->name;
				else 
					$clientOrder .= $view->name;
				$a++;
			}
			$sheet->setCellValue('D'.$i.'', $clientOrder);
			$i++;
		}
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		Yii::app()->cFile->createDir(0775, $dir);
		Yii::app()->cFile->set($dir, true)->setPermissions('0777');
		
		$objWriter->save(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'clients.xlsx');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clients the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clients::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
