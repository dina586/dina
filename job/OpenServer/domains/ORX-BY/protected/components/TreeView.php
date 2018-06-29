<?php

class TreeView extends  CWidget {
	private $catalogArray;
	
	public function __construct($productID) {
		$this->catalogArray = $this->formCatalogArray(Connect::getProductCatalogs($productID));
		
	}
	private function formCatalogArray($catalog) {
		if(count($catalog) > 0) {
		foreach($catalog as $key => $value)
			$catalogArray[$key] =  $value['catalog_id'];
		}
		else {
			$catalogArray = array();
		}
		return $catalogArray;
	}
	private function checkCatalog($id) {
		if(in_array($id, $this->catalogArray)){
			return 'checked';
		}
		else {
			return false;
		}
	}
	
	/*public function formTree($parent_id, $padding = -20) {
		$data = Catalog::model()->findAll(array('order'=>'name', 'condition'=>'parent_id=:parent_id', 'params' => array(':parent_id'=> $parent_id)));
		$padding = $padding + 20;
		foreach($data as $value) {
			if($parent_id == -1){
				echo '<div class = "j-catalog_form_list">';
			}
			$checked = $this->checkCatalog($value->id);
			echo '<div style = "padding-left:'.$padding.'px" class = "row checkbox">';
				echo '<input type = "checkbox" name = "Catalog_list['.$value->id.']" id = "catalog_list_'.$value->id.'" '.$checked.'/>';
				echo '<label for = "catalog_list_'.$value->id.'">'.$value->name.'</label>';
				self::formTree($value->id, $padding);
			echo '</div>';
			
			if($parent_id == -1){
				echo '</div>';
			}
		}
	}*/
	public function formTree($parent_id, $class = '') {
		$data = Catalog::model()->findAll(array('order'=>'name', 'condition'=>'parent_id=:parent_id', 'params' => array(':parent_id'=> $parent_id)));
		if(count($data)> 0) {
			echo '<ul>';
		}
			foreach($data as $value) {
				$checked = $this->checkCatalog($value->id);
				if($parent_id == -1) {
					$class = "catalog_list_parent";
				}
				echo '<li class = "row checkbox '.$class.'">';
					echo '<input type = "checkbox" name = "Catalog_list['.$value->id.']" id = "catalog_list_'.$value->id.'" '.$checked.'/>';
					echo '<label for = "catalog_list_'.$value->id.'">'.$value->name.'</label>';
					self::formTree($value->id);
				echo '</li>';
				
			}
		if(count($data)> 0) {
			echo '</ul>';
		}
	}
	
	protected function checkboxVerify($checkbox){
		$result=0;
		if(isset($checkbox) && ($checkbox) == 'on'){
			$result=1; 
		} 
		return $result;
	}
	public static function viewMenu($parent_id, $class = '') {
		$data = Catalog::model()->findAll(array('order'=>'position, name', 'condition'=>'parent_id=:parent_id', 'params' => array(':parent_id'=> $parent_id)));
	
		if(count($data)> 0) {
			echo '<ul class = "'.$class.'">';
		}
			foreach($data as $value) {
				$url = Yii::app()->createUrl('/shop/catalog/view', array('url'=>$value->url));
				echo '
				<li>
					<a href = "'.$url.'">'.$value->name.'</a>';
					self::viewMenu($value->id);
				echo '</li>';
				
			}
		if(count($data)> 0) {
			echo '</ul>';
		}
	}
	
	
}