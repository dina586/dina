<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$columnName = 'id';
?>
<?php echo "<?php\n"; ?>

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{

	public $layout='//layouts/templates/admin';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			['allow',
				'actions'=>['index','view'],
				'users'=>array('*'),
			],
			['allow',
				'actions'=>['create','update', 'admin','delete'],
				'roles'=>['admin'],
			],
			['deny',
				'users'=>['*'],
			],
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Create');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Admin');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), '<?=$this->modelClass?>_page'), '', Helper::seoPage($this->titles(), '<?=$this->modelClass?>_page'));
		return true;
	}
	
	public function actionView($id)
	{
		$this->layout='//layouts/templates/base';
		$model = System::loadModel('<?=$this->modelClass?>', $id);
		
		$this->seo($model->name);
		
		$this->render('application.views.layouts.global.view',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new <?php echo $this->modelClass; ?>;

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(['view','<?=$columnName;?>'=>$model-><?=$columnName;?>]);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = System::loadModel('<?php echo $this->modelClass; ?>', $id);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(['view','<?=$columnName;?>'=>$model-><?=$columnName;?>]);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model = System::loadModel('<?php echo $this->modelClass; ?>', $id);
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
