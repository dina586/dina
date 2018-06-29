<?php
class StoreHelper {
	
	//Каталог
	public $columnsNumber = 3;
	
	//Количество записей в базе каталога
	protected $catalogCount;
	
	//Количество элементов в колонке
	protected $itemsPerColumn;
	
	//Текующая колонка
	protected $currentColumn = 0;
	
	//Массив с даными каталога sql
	protected $_category;
	
	protected $i = 1;
	
	//Переменная в которую добавляются хлебные крошки при генерации
	protected $breadcrumbs;
	
	//Сформированные html данные с каталогами
	public $viewMenu = '';
	
	public function __construct() {
		
	}
	
	/**
	 * Генерируем поля в админке с каталогами
	 * @param int $parentId индикатор для старта вывода дерева
	 * @param int $selectedValue выбранное значение
	 * @param int $selectedParentId id родителя, требуется для отмечания в radio
	 * @param int $level уровень вложенности
	 * @param string $type вывод шаблона, если radio - выводим каталог с radiobutton
	 */
	
	public function generateForm($parentId, $selectedValue, $selectedParentId, $level=-1, $type = 'radio') {
		$this->_category = $this->_getCategory();
		$this->getCatalogCount();
		if($type != 'radio')
			$selectedValue = $this->selectedArray($selectedParentId);
		
		$this->catalogChoose($parentId, $selectedValue, $selectedParentId, $level, $type);
	}
	
	/**
	 * Вывод формата цены в зависимости от языка
	 * @param float $price
	 */
	public static function viewPrice($price) {
		$price = $price * (float)Settings::getVal('price');
		$price = Helper::roundPrice($price);
		if(Yii::app()->language == 'ru')
			$price = number_format($price, 0, '', ' ');
		else
			$price = number_format($price, 2, '.', ' ');
		return $price;
	}
	
	private function getCatalogCount(){
		$customCount = $this->catalogCount = Catalog::model()->count('parent_id != 0');
		while(!$customCount % $this->columnsNumber);
			$customCount++;
		$this->itemsPerColumn = (int) ($customCount / $this->columnsNumber);
	}
	
	private function _getCategory() {
		$data = Catalog::model()->findAll(array('order'=>'name'));
		$return = array();
		foreach ($data  as $value) { //Обходим массив
			$return[$value->parent_id][] = $value;
		}
		
		return $return;
	}
	
	/**
	 * Формируем массив с id каталога для данного товара
	 * @param int $id
	 * @return array
	 */
	private function selectedArray($id) {
		$sql = Connect::model()->findAll('product_id=:product_id',array(':product_id'=>$id));
		$data = array();
		if(count($sql)>0) {
			foreach($sql as $v) {
				$data[$v->catalog_id] = $v->catalog_id;
			}
		}
		
		return $data;
	}
		
	/**
	 * Вывод Дерева каталогов для выбора
	 * @param int $parentId индикатор для старта вывода дерева
	 * @param int $selectedValue выбранное значение
	 * @param int $selectedParentId id родителя, требуется для отмечания в radio
	 * @param int $level уровень вложенности
	 * @param string $type вывод шаблона, если radio - выводим каталог
	 */
	private function catalogChoose($parentId, $selectedValue, $selectedParentId = -1, $level=-1 , $type = "radio") {

		if (isset($this->_category[$parentId])) {
			foreach ($this->_category[$parentId] as $value) {
				
				if($parentId == -1 && $this->currentColumn * $this->itemsPerColumn < $this->i) {
					if($this->currentColumn * $this->itemsPerColumn != 0)
						echo '</div>';
					
					if($this->i < $this->catalogCount+1){
						$width = (int) (100/$this->columnsNumber);
						echo '<div style = "width:'.$width.'%" class = "c-catalog_tree">';
					}
					$this->currentColumn++;
				}
				
				$this->i++; 
				$level++;

				if($type == 'radio')
					$this->viewCatalog($value, $selectedValue, $level, $selectedParentId, $type);
				else
					$this->viewProduct($value, $selectedValue, $level, $selectedParentId, $type);
				
				$level--;
			
				if($value->parent_id == -1 && $this->i-1 == $this->catalogCount) {
				
					echo '</div>';
				}
				
			}
		}
	}
	
	/**
	 * Шаблон вывода данных для каталога
	 * @param obj $value
	 */
	private function viewCatalog($value, $selectedValue, $level, $selectedParentId, $type) {
		if($this->i == 2){
			if($selectedValue == -1)
				$checked = ' checked';
			else
				$checked = '';
			
			if($selectedParentId == -1)
				$checked = ' checked';
				
			echo '<div class = "l-row l-radio_button b-catalog_level_'.$level.$checked.'">';
				echo '<input type = "radio" value = "-1" name = "Catalog[parent_id]" id = "catalog_list_0"'.$checked.'/>';
				echo '<label for = "catalog_list_0">'.Yii::t('shop', 'Not selected (parent directory)').'</label>';
			echo '</div>';
		}
		
		if($value->id == $selectedParentId)
			$checked = ' checked';
		else
			$checked = '';
			
		echo '<div style= "margin-left:'.($level * 25).'px;" class = "l-row l-'.$type.'_button b-catalog_level_'.$level.$checked.'">';
			if($value->id != $selectedValue)
				echo '<input type = "radio" value = "'.$value->id.'" name = "Catalog[parent_id]" id = "catalog_list_'.$value->id.'"'.$checked.'/>';
			echo '<label for = "catalog_list_'.$value->id.'">'.$value->name.'</label>';
		echo '</div>';
		$this->catalogChoose($value->id, $selectedValue, $selectedParentId, $level, $type);
	}
	
	/**
	 * Шаблон для вывода каталога для товара с чекбоксами
	 * @param unknown_type $value
	 * @param unknown_type $selectedValue
	 * @param unknown_type $level
	 * @param unknown_type $selectedParentId
	 * @param unknown_type $type
	 */
	private function viewProduct($value, $selectedValue, $level, $selectedParentId, $type) {
			
		if(in_array($value->id, $selectedValue))
			$checked = ' checked';
		else
			$checked = '';
			
		echo '<div style= "margin-left:'.($level * 25).'px;" class = "l-row l-'.$type.' l-radio_button j-catalot_tree_checkbox b-catalog_level_'.$level.$checked.'">';
			echo '<input type = "checkbox" class = "catalog_checkbox_'.$level.$checked.'" value = "'.$value->id.'" name = "Catalog_list[]" id = "catalog_list_'.$value->id.'"'.$checked.'/>';
			echo '<label for = "catalog_list_'.$value->id.'">'.$value->name.'</label>';
		echo '</div>';
		
		$this->catalogChoose($value->id, $selectedValue, $selectedParentId, $level, $type);
	}
	
	public function viewMenu() {
		if (Yii::app()->controller->getModule() == null || Yii::app()->controller->module->id != 'store') {
			if(!$viewMenu = System::getCache('catalog_render', 'store_')) {
				$viewMenu = $this->viewMenuData();
				System::setCache('catalog_render', $viewMenu, 'store_');
			}
		}
		else 
			$viewMenu = $this->viewMenuData();
		
		return $viewMenu;
	}
	
	protected function viewMenuData() {
		$this->_category = $this->getCatalogs();
		$this->_category[] = -1;
		$this->generateMenu(-1);
		return $this->viewMenu;
	}
	
	public function generateMenu($parent_id, $style = '') {
		$data = Catalog::model()->findAll(array('order'=>'position, name', 'condition'=>'parent_id=:parent_id AND is_view = 1', 'params' => array(':parent_id'=> $parent_id)));

		if(in_array($parent_id, $this->_category)) 
			$style = ' style = "display:block;"';
		else 
			$style = '';

		
		if(count($data)> 0) {
			$this->viewMenu .= '<ul'.$style.'>';
		}
		
		foreach($data as $value) {
			$url = Yii::app()->createUrl('store/catalog/view', array('url'=>$value->url));
			if(in_array($value->id, $this->_category))
				$class = ' active';
			else
				$class = "";

			$this->viewMenu .= '
			<li>
				<a class = "l-catalog_link '.$class.'" href = "'.$url.'">'.$value->name.'</a>';
				$this->generateMenu($value->id, $style);
			$this->viewMenu .= '</li>';
		}
		
		if(count($data)> 0) {
			$this->viewMenu .= '</ul>';
		}
	}
	
	public function getCatalogs() {
		$catalogs = array();
		$url = strtolower(Yii::app()->request->getParam('url'));
		$parentId = '';
		if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'store' && Yii::app()->controller->action->id != 'index'):
			if(Yii::app()->controller->id == 'catalog') {
				$data = Catalog::model()->find('url=:url', array(':url'=>$url));
				$id = $data->id;
				$parentId = $data->parent_id;
				$catalogs[$data -> id] = $data -> id;
			} else if (Yii::app()->controller->id == 'product'){
				$model = Product::model()->find('url=:url', array(':url'=>$url));
				if(count($model)>0){
					foreach($model->catalog as $c) {
						$catalogs[$c->id] = $c->id;
					}
				}
				return $catalogs;
		}
		
		endif;
		
		if($parentId == '') {
			return $catalogs;
		}
	
		if($parentId != -1) {
			do {
				$data = Catalog::model()->findByPk($parentId);
				$id = $data->id;
				$parentId = $data->parent_id;
				$catalogs[$data->id] = $data->id;
			}
			while($parentId != -1);
		}
		return $catalogs;
	
	}
	
	/**
	 * Генерация хлебных крошек для товара
	 * @param obj $catalogs
	 * @param string $name
	 * return array()
	 */
	public function breadcrumb($catalogs, $name) {
		$breadcrumbs = array();
		if(count($catalogs)>0){
			foreach($catalogs as $catalog) {
				$temp[$catalog->parent_id][$catalog->id] = array(
					'name'=>trim($catalog->name),
					'url'=>Yii::app()->createUrl('store/catalog/view', array('url'=>$catalog->url)),
				);
			}
			$this->genereateBreadcrumbs(-1, $temp);
		}
		
		$this->breadcrumbs[] = $name;
		return $this->breadcrumbs;
	}
	
	/**
	 * Наполняем хлебными крошками в зависимости от parent_id
	 * @param int $parentId
	 * @param array $temp
	 */
	protected function genereateBreadcrumbs($parentId, $temp) {
		if(key_exists($parentId, $temp) && count($temp[$parentId])>0) {
			foreach($temp[$parentId] as $id => $c) {
				$this->breadcrumbs[$c['name']] = $c['url'];
				$this->genereateBreadcrumbs($id, $temp);
			}
		}
	}
	public function catalogBreadcrumb($catalog) {
		$data = $catalog;
		$temp = $breadcrumbs = array();
		
		while($data !== null){
			$data = Catalog::model()->findByPk($data->parent_id);
			
			if($data === null)
				continue;
			$temp[$data->parent_id][$data->id] = array(
				'name'=>trim($data->name),
				'url'=>Yii::app()->createUrl('store/catalog/view', array('url'=>$data->url)),
			);
		}
		$this->genereateBreadcrumbs(-1, $temp);
		$this->breadcrumbs[] = $catalog->name;
		return $this->breadcrumbs;
		
	}
	
	
}