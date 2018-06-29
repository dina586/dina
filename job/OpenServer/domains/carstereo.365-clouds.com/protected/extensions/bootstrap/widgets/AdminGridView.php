<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('zii.widgets.grid.CGridView');

/**
 * Bootstrap grid view.
 */
class AdminGridView extends CGridView {

	/**
	 * @var type string
	 * Классы таблицы по умолчанию
	 */
	public $type = 'table table-striped table-vcenter';

	/**
	 * @var string the CSS class name for the pager container. Defaults to 'pagination'.
	 */
	public $pagerCssClass = 'pagination pull-right';

	/**
	 * @var array the configuration for the pager.
	 * Defaults to <code>array('class'=>'ext.bootstrap.widgets.TbPager')</code>.
	 */
	public $pager = array('class' => 'bootstrap.widgets.BsPager');

	/**
	 * @var string the URL of the CSS file used by this grid view.
	 * Defaults to false, meaning that no CSS will be included.
	 */
	public $cssFile = false;

	/**
	 * @var string the template to be used to control the layout of various sections in the view.
	 */
	public $template = "{summary}{items}\n{pager}";

	public $setAutoWidth = true;
	
	public $cleverWidth = true;
	
	/**
	 * Initializes the widget.
	 */
	public function init() {
		$baseScriptUrl = $this->baseScriptUrl;
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='table-responsive grid-view';
		
		parent::init();
		$classes = array();
		if (isset($this->type) && !empty($this->type)) {
			if (is_string($this->type)) {
				$this->type = explode(' ', $this->type);
			}

			foreach ($this->type as $type) {
				$classes[] .= $type;
			}
		}
		if (!empty($classes)) {
			$classes = implode(' ', $classes);
			if (isset($this->itemsCssClass)) {
				$this->itemsCssClass .= ' ' . $classes;
			} else {
				$this->itemsCssClass = $classes;
			}
		}

		if ($baseScriptUrl === null) {
			$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('bootstrap.widgets.assets')) . '/gridview';
		}

		if ($this->cssFile === false) {
			$this->cssFile = $baseScriptUrl . '/styles.css';
		}

		Yii::app()->getClientScript()->registerCssFile($this->cssFile);
	}

	/**
	 * Creates column objects and initializes them.
	 */
	protected function initColumns() {
		if($this->setAutoWidth === true)
			$this->setColumnsWidth();
		foreach ($this->columns as $i => $column) {
			if (is_array($column) && !isset($column['class'])) {
				$this->columns[$i]['class'] = 'bootstrap.widgets.AdminDataColumn';
			}
		}

		parent::initColumns();
	}

	/**
	 * Расчет ширин колонок
	 */
	protected function setColumnsWidth() {
		$c = $totalWidth = 0;
		$percentWidth = 1;

		foreach ($this->columns as $i => $column) {
			
			if(isset($column['visible']) && !$column['visible'])
			{
				unset($this->columns[$i]);
				continue;
			}
			
			if(!is_array($this->columns[$i]))
				$this->columns[$i] = array('name'=>$this->columns[$i], 'value'=>'$data->'.$this->columns[$i]);
			
			
			if(isset($this->columns[$i]['class']) && $this->columns[$i]['class'] == 'bootstrap.widgets.AdminButtonColumn') {
				if(!isset($this->columns[$i]['width']))
					$column['width'] = $this->columns[$i]['width'] = 10;
				
				if(!isset($this->columns[$i]['htmlOptions']['class'])) 
					$this->columns[$i]['htmlOptions']['class'] = 'btn-group-xs text-center l-nowrap button-column';
			}
			
			if(isset($column['width'])) {
				$totalWidth += (float)$column['width'];
				$c++;
			}
			
		}
		$currentWidth = $totalWidth;
		
		//Общее кол-во колонок
		$count = count($this->columns);
		
		//Средняя ширина колонки
		$itemWidth = 100/$count;

		//Если общая ширина не превышает 80 %
		if($currentWidth < 80 && $count != $c)
			$itemWidth = (100 - $currentWidth)/($count-$c);
		elseif($this->cleverWidth === true) {
			
			//Добавляем колонки с неуказанным размером
			$totalWidth += $itemWidth*($count-$c);
			
			if($totalWidth >= 100 || ($count == $c && $totalWidth < 100)) 
				$percentWidth = 100/$totalWidth;
		}
		
		foreach ($this->columns as $i => $column) {
			if(isset($column['width']))
				$width = $column['width'];
			else
				$width = $itemWidth;
			$width = $width * $percentWidth;
			
			$this->columns[$i]['htmlOptions']['style'] = 'width:'.$width.'%';

		}
	}
	/**
	 * Creates a column based on a shortcut column specification string.
	 * @param mixed $text the column specification string
	 * @return \AdminDataColumn|\CDataColumn the column instance
	 * @throws CException if the column format is incorrect
	 */
	protected function createDataColumn($text) {
		if (!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
			throw new CException(Yii::t(
				'zii', 'The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'
			));
		}
		$column = new AdminDataColumn($this);
		$column->name = $matches[1];
		if (isset($matches[3]) && $matches[3] !== '') {
			$column->type = $matches[3];
		}
		if (isset($matches[5])) {
			$column->header = $matches[5];
		}
		return $column;
	}

	public function registerClientScript() {
		$id = $this->getId();

		if ($this->ajaxUpdate === false)
			$ajaxUpdate = false;
		else {
			$ajaxUpdate = array_unique(preg_split('/\s*,\s*/', $this->ajaxUpdate, -1, PREG_SPLIT_NO_EMPTY)); /* .','.$id */
			if (empty($ajaxUpdate)) {
				$ajaxUpdate[] = $id;
			}
		}

		$options = array(
			'ajaxUpdate' => $ajaxUpdate,
			'ajaxVar' => $this->ajaxVar,
			'pagerClass' => $this->pagerCssClass,
			'loadingClass' => $this->loadingCssClass,
			'filterClass' => $this->filterCssClass,
			'tableClass' => $this->itemsCssClass,
			'selectableRows' => $this->selectableRows,
			'enableHistory' => $this->enableHistory,
			'updateSelector' => $this->updateSelector,
			'filterSelector' => $this->filterSelector
		);
		if ($this->ajaxUrl !== null)
			$options['url'] = CHtml::normalizeUrl($this->ajaxUrl);
		if ($this->ajaxType !== null)
			$options['ajaxType'] = strtoupper($this->ajaxType);
		if ($this->enablePagination)
			$options['pageVar'] = $this->dataProvider->getPagination()->pageVar;
		foreach (array('beforeAjaxUpdate', 'afterAjaxUpdate', 'ajaxUpdateError', 'selectionChanged') as $event) {
			if ($this->$event !== null) {
				if ($this->$event instanceof CJavaScriptExpression)
					$options[$event] = $this->$event;
				else
					$options[$event] = new CJavaScriptExpression($this->$event);
			}
		}

		$options = CJavaScript::encode($options);
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('bbq');
		if ($this->enableHistory)
			$cs->registerCoreScript('history');
		$cs->registerScriptFile($this->baseScriptUrl . '/jquery.yiigridview.js', CClientScript::POS_END);
		$cs->registerScript(__CLASS__ . '#' . $id, "jQuery('#$id').yiiGridView($options);");
	}

}
