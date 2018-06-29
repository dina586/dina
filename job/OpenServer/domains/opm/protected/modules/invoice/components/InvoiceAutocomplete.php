<?php
class InvoiceAutocomplete {
	
	public $limit = 30;
	public $term;
	
	public function init($type, $term) {
		$this->term = $term;
		
		$functions = array(1=>'products', 2=> 'services');
		$json = array();
		
		if(key_exists($type, $functions))
			$json = call_user_func_array(array($this, $functions[$type]), array());
		return json_encode($json);
	}
	
	protected function products() {
		Yii::import('application.modules.store.models.*');
		$tags = Product::model()->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'name',
			'distinct'=>true,
			'limit'=>$this->limit,
			'params'=>array(
				':keyword'=>'%'.strtr($this->term, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		
		$data = $names=array();
		foreach($tags as $tag) {
			$data[]= array(
				'label'=> $tag->name.' - $ '.Helper::viewPrice($tag->price),
				'price'=>$tag->price,
				'name'=> $tag->name
			);
		}
		return $data;
	}
	
	protected function services() {
		Yii::import('application.modules.service.models.*');	
		
		$tags = ServiceProcedure::model()->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'name',
			'distinct'=>true,
			'limit'=>$this->limit,
			'params'=>array(
				':keyword'=>'%'.strtr($this->term, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		
		$data = $names=array();
		foreach($tags as $tag) {
			$data[]= array(
				'label'=> $tag->name.' - $ '.Helper::viewPrice($tag->price),
				'price'=>$tag->price,
				'name'=> $tag->name,
			);
		}
		return $data;
	}

}