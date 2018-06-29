<?php

class PathController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/aaa';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::import('application.modules.content.models.*');
		/*Yii::app()->db->createCommand('
			ALTER TABLE tbl_sproduct 
			ADD COLUMN `seo_description` TEXT, 
			ADD COLUMN `seo_keywords` TEXT
		')->execute();
		
		/*Yii::app()->db->createCommand('
			ALTER TABLE tbl_Scontent ADD COLUMN `seo_title` TEXT, 
			ADD COLUMN `seo_description` TEXT, 
			ADD COLUMN `seo_keywords` TEXT
		')->execute();
		
		Yii::app()->db->createCommand('
			ALTER TABLE tbl_about DROP slider_view;
		')->execute();
		
		Yii::app()->db->createCommand('
			CREATE TABLE IF NOT EXISTS `tbl_clients` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `email` varchar(255) NOT NULL,
			  `address` text NOT NULL,
			  `contacts` text NOT NULL,
			  `name` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			CREATE TABLE IF NOT EXISTS `tbl_clients_order` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `client_id` int(11) NOT NULL,
			  `product_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		')->execute();
			
			$block = Block::viewBlock(3);
			$content = '';
			foreach($block as $view){
				$content .= $view['description'];
				$content .= '<div class = "g-clear_fix"></div>';
			}
			
			$c = new Content();
			$c->setIsNewRecord(true);
			$c->id = 4;
			$c->name = 'Главная';
			$c->description = $content;
			$c->seo_title = Yii::app()->name;
			$c->save();
			Block::model()->deleteAll('block_id=3');
		
		Yii::app()->db->createCommand('
			ALTER TABLE tbl_scatalog ADD COLUMN `seo_title` TEXT, 
			ADD COLUMN `seo_description` TEXT, 
			ADD COLUMN `seo_keywords` TEXT,
			ADD COLUMN `view_on_main` INT(1) DEFAULT 0
		')->execute();
		*/
		Yii::import('application.modules.helper.components.System');
		Yii::app()->db->createCommand('
			ALTER TABLE tbl_scatalog ADD COLUMN `url` varchar(255) NOT NULL
		')->execute();
		Yii::app()->db->createCommand('
			ALTER TABLE tbl_sproduct ADD COLUMN `url` varchar(255) NOT NULL
		')->execute();
		
		$p = Product::model()->findAll();
		foreach($p as $data){
			$url = System::prepairUrl($data->url, $data->name, 'Product', $data->id);
			Product::model()->updateByPk($data->id, array('url'=>$url));
		}
		$p = Catalog::model()->findAll();
		foreach($p as $data){
			$url = System::prepairUrl($data->url, $data->name, 'Catalog', $data->id);
			Catalog::model()->updateByPk($data->id, array('url'=>$url));
		}
		Yii::app()->db->createCommand("
			CREATE TABLE IF NOT EXISTS `tbl_stock` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(255) NOT NULL,
			  `content` text NOT NULL,
			  `date` date NOT NULL,
			  `is_view` int(1) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

			--
			-- Дамп данных таблицы `tbl_stock`
			--

			INSERT INTO `tbl_stock` (`id`, `name`, `content`, `date`, `is_view`) VALUES
			(1, 'Акция на главной', '', '2014-02-27', 1),
			(2, 'Акция на внутренне', '', '2014-02-25', 1);
		")->execute();
	}

	
}
