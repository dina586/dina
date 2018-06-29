<?php

class DefaultController extends Controller
{
	public $layout='//layouts/templates/admin';
	
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
				'actions'=>array('upload', 'exportUsers'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	protected function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Add new block');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		
		$this->seo($this->titles());
		return true;
	}
	
	public function actionUpload(){
		
		$file = Yii::getPathOfAlias('webroot').DS.'1.xls';
		
		if(file_exists($file)) {
			
			$objPHPExcel = $this->config();
			$objReader = PHPExcel_IOFactory::createReaderForFile($file);
			$objReader->setReadDataOnly(true);
			$chunkFilter = new ChunkReadFilter();
			$objReader->setReadFilter($chunkFilter);
			
			
			$chunkFilter->setRows($this->module->startRow, $this->module->chunkSize); 	//устанавливаем знаечние фильтра
			$objPHPExcel = $objReader->load($file);		//открываем файл
			$objPHPExcel->setActiveSheetIndex(0);		//устанавливаем индекс активной страницы
			$objWorksheet = $objPHPExcel->getActiveSheet();	//делаем активной нужную страницу
			$objWorksheet->removeRow(2,2);
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'catalog.xlsx');
			
		}
		
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function config() {
		//Подключаем эксель
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		$phpExcelPath = Yii::getPathOfAlias('application').DS.'modules'.DS.'excel'.DS.'vendors'.DS.'phpexcel';
		require_once $phpExcelPath . DS . 'PHPExcel.php';
		require_once $phpExcelPath . DS.'PHPExcel'.DS.'IOFactory.php';
		spl_autoload_register(array('YiiBase', 'autoload'));
		return new PHPExcel();
	}
	
	public function actionExportUsers() {
		set_time_limit(3600000);
		ini_set("memory_limit","1000M");
	
		$objPHPExcel = $this->config();
		
		$objPHPExcel->getProperties()->setCreator(Yii::app()->name)
		->setLastModifiedBy(Yii::app()->user->username)
		->setTitle('User list')
		->setSubject('User list');
	
		$objPHPExcel->getActiveSheet()->setTitle("User list");
	
		$objPHPExcel->setActiveSheetIndex(0);
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
		$sheet->getColumnDimension('A')->setAutoSize(true);
		
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$users = User::model()->with('roles')->findAll('roles.role != "developer"');
		if(count($users)>0):
			$i = 2;
			foreach($users as $data) {
				$sheet->setCellValue('A'.$i.'', $data->profile->firstname);
				$sheet->setCellValue('B'.$i.'', $data->profile->lastname);
				$sheet->setCellValue('C'.$i.'', Helper::viewDate($data->profile->birthday));
				$sheet->setCellValue('D'.$i.'', $data->email);
				$sheet->setCellValue('E'.$i.'', $data->profile->mobile);
				$i++;
			}
		endif;
		$fileName = System::prepairUrl('User list '.Helper::viewDate(date('Y-m-d')));
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.$fileName.'.xlsx');
		echo '/upload/temp/'.$fileName.'.xlsx';
	}
}