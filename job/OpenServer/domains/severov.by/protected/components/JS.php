<?php
Yii::import('system.web.CClientScript');
class JS extends CClientScript {
	
	/**
	 * @param array массив с собранными подключаемыми скриптами
	 */
	private static $_scripts = array();
	
	/**
	 * Скрипт сбора js скриптов. Если аякс запрос, то собираем скрипты для вывода, иначе используем yii-шный метов
	 * @param string $name
	 * @param string $script
	 * @param mixed $type
	 */
	public static function add($name, $script, $type = 3) {
		if(Yii::app()->request->isAjaxRequest)
			self::$_scripts[$name] = $script;
		else
			Yii::app()->clientScript->registerScript($name, $script, $type);
	}
	
	public static function view() {
		$view = '';
		if(count(self::$_scripts)>0) {
			foreach(self::$_scripts as $k=>$v) {
				$view.= $v;
			}
			echo '<script type = "text/javascript">'.$view.'</script>';
		}
		
	}
	
}