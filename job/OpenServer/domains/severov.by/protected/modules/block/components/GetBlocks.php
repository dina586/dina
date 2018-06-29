<?php
Yii::import('application.modules.block.models.Block');
//Виджет для вывода блоков на странице
class GetBlocks extends CWidget {
	
	//Позиция блоков на странице
	public $view;
	
	//Название тега в шапке блока
	public $tag = 'h3';
	
    public function run() {
   		$this->viewBlocks();
    }

	private function viewBlocks() {
		
		if(!$data = System::getCache($this->view, 'block_render_')) {
			
			$data = Block::model()->findAll(
				array(
					'condition'=>'page_position=:page_position AND is_view = 1',
					'params'=>array(':page_position'=>$this->view),
					'order'=>'position',
				));
			
			System::setCache($this->view, $data, 'block_render_');
		}
				
		$this->render('index', array(
			'dataProvider'=>$data,
		));
	}

}