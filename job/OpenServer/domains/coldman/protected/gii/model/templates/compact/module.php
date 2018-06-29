<?php echo "<?php\n"; ?>

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class <?php echo $this->moduleClass; ?> extends CWebModule
{
	public function init()
	{
		$this->setImport([
			'<?php echo $this->moduleID; ?>.models.*',
			'<?php echo $this->moduleID; ?>.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
